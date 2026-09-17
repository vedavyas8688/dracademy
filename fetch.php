<?php
header('Content-Type: application/json; charset=UTF-8');
header('Cache-Control: no-cache, no-store, must-revalidate');
header('Pragma: no-cache');
header('Expires: 0');

$blogsDir = __DIR__ . '/blogs';
$statsFile = $blogsDir . '/blog_stats.json';

if (!is_dir($blogsDir)) {
    echo json_encode([]);
    exit;
}

$statsData = [];
if (file_exists($statsFile)) {
    $decodedStats = json_decode(@file_get_contents($statsFile), true);
    if (is_array($decodedStats)) {
        $statsData = $decodedStats;
    }
}

function cleanText($text) {
    $text = html_entity_decode(strip_tags($text), ENT_QUOTES | ENT_HTML5, 'UTF-8');
    $text = preg_replace('/\s+/', ' ', $text);
    return trim($text);
}

function extractMetaContent($content, $attrName, $attrValue) {
    $pattern = '/<meta[^>]*' . preg_quote($attrName, '/') . '\s*=\s*["\']' . preg_quote($attrValue, '/') . '["\'][^>]*content\s*=\s*["\']([^"\']+)["\'][^>]*>/is';
    if (preg_match($pattern, $content, $matches)) {
        return trim($matches[1]);
    }

    $patternReverse = '/<meta[^>]*content\s*=\s*["\']([^"\']+)["\'][^>]*' . preg_quote($attrName, '/') . '\s*=\s*["\']' . preg_quote($attrValue, '/') . '["\'][^>]*>/is';
    if (preg_match($patternReverse, $content, $matches)) {
        return trim($matches[1]);
    }

    return '';
}

function extractPhpStringVariable($content, $variableName) {
    $escapedVariable = preg_quote($variableName, '/');

    $singleQuotePattern = '/\$' . $escapedVariable . '\s*=\s*\'((?:\\\\.|[^\'])*)\'\s*;/s';
    if (preg_match($singleQuotePattern, $content, $matches)) {
        return stripcslashes($matches[1]);
    }

    $doubleQuotePattern = '/\$' . $escapedVariable . '\s*=\s*"((?:\\\\.|[^"])*)"\s*;/s';
    if (preg_match($doubleQuotePattern, $content, $matches)) {
        return stripcslashes($matches[1]);
    }

    return '';
}

function validDate($date) {
    if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) {
        return false;
    }

    [$year, $month, $day] = explode('-', $date);
    return checkdate((int)$month, (int)$day, (int)$year);
}

function dateFromFileName($fileNameWithoutExt) {
    if (preg_match('/^(\d{4})-(\d{2})-(\d{2})-(.+)$/', $fileNameWithoutExt, $matches)) {
        $date = $matches[1] . '-' . $matches[2] . '-' . $matches[3];
        return validDate($date) ? $date : '';
    }
    return '';
}

function titleFromFileName($fileNameWithoutExt) {
    $name = preg_replace('/^\d{4}-\d{2}-\d{2}-/', '', $fileNameWithoutExt);
    $name = str_replace('-', ' ', $name);
    $name = preg_replace('/\s+/', ' ', $name);
    return ucwords(trim($name));
}

$files = scandir($blogsDir);
$blogs = [];

foreach ($files as $file) {
    if ($file === '.' || $file === '..' || $file === 'blog_stats.json') {
        continue;
    }

    $filePath = $blogsDir . '/' . $file;

    if (!is_file($filePath)) {
        continue;
    }

    $extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));

    if (!in_array($extension, ['php', 'html', 'htm'])) {
        continue;
    }

    $fileNameWithoutExt = pathinfo($file, PATHINFO_FILENAME);

    $content = @file_get_contents($filePath);
    if ($content === false || trim($content) === '') {
        continue;
    }

    $title = titleFromFileName($fileNameWithoutExt);
    $description = '';
    $thumbnail = '';

    /* ✅ DATE PRIORITY:
       1. <meta name="blog-date" content="2026-05-05">
       2. $blogDate = '2026-05-05';
       3. Old filename date fallback
       4. File modified date fallback
    */
    $date = extractMetaContent($content, 'name', 'blog-date');

    if (!validDate($date)) {
        if (preg_match('/\$blogDate\s*=\s*[\'"](\d{4}-\d{2}-\d{2})[\'"]\s*;/i', $content, $dateMatch)) {
            $date = $dateMatch[1];
        }
    }

    if (!validDate($date)) {
        $date = dateFromFileName($fileNameWithoutExt);
    }

    if (!validDate($date)) {
        $date = date('Y-m-d', filemtime($filePath));
    }

    $phpTitle = extractPhpStringVariable($content, 'blogTitle');

    if (!empty($phpTitle)) {
        $title = cleanText($phpTitle);
    } elseif (preg_match('/<title>(.*?)<\/title>/is', $content, $titleMatch)) {
        $pageTitle = cleanText($titleMatch[1]);
        if (!empty($pageTitle)) {
            $title = $pageTitle;
        }
    }

    $description = extractPhpStringVariable($content, 'blogDescription');

    if (empty($description)) {
        $description = extractMetaContent($content, 'name', 'description');
    }

    if (empty($description)) {
        $description = extractMetaContent($content, 'property', 'og:description');
    }

    if (empty($description) && preg_match('/<p[^>]*>(.*?)<\/p>/is', $content, $pMatch)) {
        $description = cleanText($pMatch[1]);
    }

    if (!empty($description)) {
        $description = cleanText($description);
        if (mb_strlen($description) > 140) {
            $description = mb_substr($description, 0, 137) . '...';
        }
    }

    $thumbnail = extractPhpStringVariable($content, 'blogThumbnail');

    if (empty($thumbnail)) {
        $thumbnail = extractMetaContent($content, 'property', 'og:image');
    }

    if (empty($thumbnail)) {
        $thumbnail = extractMetaContent($content, 'name', 'thumbnail');
    }

    if (empty($thumbnail)) {
        $thumbnail = extractMetaContent($content, 'name', 'twitter:image');
    }

    if (!empty($thumbnail)) {
        if (
            stripos($thumbnail, 'http://') !== 0 &&
            stripos($thumbnail, 'https://') !== 0 &&
            stripos($thumbnail, '//') !== 0 &&
            strpos($thumbnail, 'data:') !== 0
        ) {
            $thumbnail = ltrim($thumbnail, './');

            if (strpos($thumbnail, 'blogs/') !== 0) {
                $thumbnail = 'blogs/' . $thumbnail;
            }

            $thumbnail = str_replace(['blogs/blogs/', '//'], ['blogs/', '/'], $thumbnail);
        }
    }

    $views = 0;
    $likes = 0;
    $shares = 0;

    if (isset($statsData[$file]) && is_array($statsData[$file])) {
        $views = isset($statsData[$file]['views']) ? (int)$statsData[$file]['views'] : 0;
        $likes = isset($statsData[$file]['likes']) ? (int)$statsData[$file]['likes'] : 0;
        $shares = isset($statsData[$file]['shares']) ? (int)$statsData[$file]['shares'] : 0;
    }

    $blogs[] = [
        'title' => $title,
        'date' => $date,
        'url' => 'blogs/' . $file,
        'description' => $description,
        'thumbnail' => $thumbnail,
        'views' => $views,
        'likes' => $likes,
        'shares' => $shares
    ];
}

usort($blogs, function ($a, $b) {
    $dateCompare = strcmp($b['date'], $a['date']);
    if ($dateCompare !== 0) {
        return $dateCompare;
    }

    return strcasecmp($a['title'], $b['title']);
});

echo json_encode($blogs, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
exit;
?>
