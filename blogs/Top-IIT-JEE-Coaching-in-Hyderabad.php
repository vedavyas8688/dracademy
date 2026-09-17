<?php
session_start();

$blogSlug = basename($_SERVER['PHP_SELF']);
$statsFile = __DIR__ . '/blog_stats.json';

if (!file_exists($statsFile)) {
    file_put_contents($statsFile, json_encode([], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
}

$statsData = json_decode(@file_get_contents($statsFile), true);
if (!is_array($statsData)) {
    $statsData = [];
}

if (!isset($statsData[$blogSlug])) {
    $statsData[$blogSlug] = [
        'views' => 0,
        'likes' => 0,
        'shares' => 0
    ];
}

if (isset($_GET['stats_action'])) {
    header('Content-Type: application/json; charset=UTF-8');

    $action = $_GET['stats_action'];

    if ($action === 'view') {
        $viewSessionKey = 'viewed_' . md5($blogSlug);

        if (empty($_SESSION[$viewSessionKey])) {
            $statsData[$blogSlug]['views']++;
            $_SESSION[$viewSessionKey] = true;
            file_put_contents($statsFile, json_encode($statsData, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
        }

        echo json_encode([
            'success' => true,
            'views' => (int)$statsData[$blogSlug]['views'],
            'likes' => (int)$statsData[$blogSlug]['likes'],
            'shares' => (int)$statsData[$blogSlug]['shares'],
            'liked' => !empty($_SESSION['liked_' . md5($blogSlug)])
        ]);
        exit;
    }

    if ($action === 'like') {
        $likeSessionKey = 'liked_' . md5($blogSlug);

        if (empty($_SESSION[$likeSessionKey])) {
            $statsData[$blogSlug]['likes']++;
            $_SESSION[$likeSessionKey] = true;
            file_put_contents($statsFile, json_encode($statsData, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
        }

        echo json_encode([
            'success' => true,
            'views' => (int)$statsData[$blogSlug]['views'],
            'likes' => (int)$statsData[$blogSlug]['likes'],
            'shares' => (int)$statsData[$blogSlug]['shares'],
            'liked' => true
        ]);
        exit;
    }

    if ($action === 'share') {
        $shareSessionKey = 'shared_' . md5($blogSlug);

        if (empty($_SESSION[$shareSessionKey])) {
            $statsData[$blogSlug]['shares']++;
            $_SESSION[$shareSessionKey] = true;
            file_put_contents($statsFile, json_encode($statsData, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
        }

        echo json_encode([
            'success' => true,
            'views' => (int)$statsData[$blogSlug]['views'],
            'likes' => (int)$statsData[$blogSlug]['likes'],
            'shares' => (int)$statsData[$blogSlug]['shares'],
            'shared' => true
        ]);
        exit;
    }

    echo json_encode(['success' => false]);
    exit;
}

$currentUrl = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

$blogTitle = 'Top IIT JEE Coaching in Hyderabad | DR Academy JEE Preparation Guide';
$blogDescription = 'Looking for the top IIT JEE coaching in Hyderabad? Discover how DR Academy helps students with expert faculty, structured preparation, mock tests, and complete IIT JEE guidance.';
$blogThumbnail = 'images/tmbnl/tmbnl-005.png';

$encodedUrl = urlencode($currentUrl);
$encodedTitle = urlencode($blogTitle);
?>

<?php
$blogDate = '2026-05-18';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <title><?php echo htmlspecialchars($blogTitle, ENT_QUOTES, 'UTF-8'); ?></title>
  <meta name="description" content="<?php echo htmlspecialchars($blogDescription, ENT_QUOTES, 'UTF-8'); ?>" />
  <meta name="keywords" content="IIT JEE Coaching in Hyderabad, Top IIT JEE Coaching in Hyderabad, IIT JEE Coaching Hyderabad, DR Academy Hyderabad, Best IIT JEE institute in Hyderabad, IIT JEE preparation in Hyderabad, JEE coaching centre Hyderabad, IIT coaching classes Hyderabad, JEE Main coaching Hyderabad, JEE Advanced coaching Hyderabad, Engineering entrance coaching Hyderabad, IIT JEE preparation tips" />
  <meta name="robots" content="index, follow" />
  <meta name="author" content="DR Academy" />
  <meta name="publisher" content="DR Academy" />
  <meta name="blog-date" content="<?php echo $blogDate; ?>">

  <meta property="og:title" content="<?php echo htmlspecialchars($blogTitle, ENT_QUOTES, 'UTF-8'); ?>" />
  <meta property="og:description" content="<?php echo htmlspecialchars($blogDescription, ENT_QUOTES, 'UTF-8'); ?>" />
  <meta property="og:type" content="article" />
  <meta property="og:url" content="<?php echo htmlspecialchars($currentUrl, ENT_QUOTES, 'UTF-8'); ?>" />
  <meta property="og:image:width" content="1200" />
  <meta property="og:image:height" content="630" />
  <meta property="og:image:alt" content="Students attending IIT JEE coaching classes at DR Academy Hyderabad" />

  <meta name="twitter:card" content="summary_large_image" />
  <meta name="twitter:title" content="<?php echo htmlspecialchars($blogTitle, ENT_QUOTES, 'UTF-8'); ?>" />
  <meta name="twitter:description" content="<?php echo htmlspecialchars($blogDescription, ENT_QUOTES, 'UTF-8'); ?>" />
  
  <!--Thumbnail images-->
  <meta property="og:image" content="images/tmbnl/tmbnl-005.png" />
<meta property="og:image:secure_url" content="images/tmbnl/tmbnl-005.png" />
<meta name="twitter:image" content="images/tmbnl/tmbnl-005.png" />
<meta name="thumbnail" content="images/tmbnl/tmbnl-005.png" />
  <!--Thumbnail Images-->

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

  <style>
    :root{
      --bg:#f5f8fc;
      --card:#ffffff;
      --line:#e1e8f0;
      --text:#223548;
      --muted:#617388;
      --primary:#17407a;
      --primary-2:#2f7ff7;
      --soft:#f7fafe;
      --shadow:0 10px 30px rgba(20,64,122,.08);
      --radius:18px;
      --danger:#e25d6a;
      --success:#16a34a;
    }

    body{
      margin:0;
      font-family:Arial, Helvetica, sans-serif;
      background:var(--bg);
      color:var(--text);
      line-height:1.75;
    }

    .blog-page-wrap{ padding:40px 0 60px; }

    .blog-box{
      max-width:1200px;
      margin:0 auto;
      background:#fff;
      border:1px solid var(--line);
      border-radius:24px;
      box-shadow:var(--shadow);
      overflow:hidden;
    }

    .blog-header{
      padding:28px 30px;
      border-bottom:1px solid var(--line);
      background:linear-gradient(180deg, #ffffff 0%, #f8fbff 100%);
    }

    .blog-chip{
      display:inline-block;
      padding:8px 14px;
      font-size:13px;
      font-weight:700;
      color:var(--primary);
      background:#eef5ff;
      border:1px solid #d9e7fb;
      border-radius:999px;
      margin-bottom:12px;
    }

    .blog-title{
      font-size:38px;
      line-height:1.15;
      font-weight:800;
      color:var(--primary);
      margin-bottom:10px;
    }

    .blog-subtitle{
      font-size:16px;
      color:var(--muted);
      margin-bottom:0;
    }

    .blog-top-meta{
      display:flex;
      justify-content:space-between;
      align-items:center;
      gap:16px;
      flex-wrap:wrap;
      margin-top:18px;
      padding-top:18px;
      border-top:1px solid var(--line);
    }

    .blog-meta-left,
    .blog-meta-right{
      display:flex;
      align-items:center;
      gap:10px;
      flex-wrap:wrap;
    }

    .blog-stat-btn,
    .blog-stat-box,
    .social-share-link{
      display:inline-flex;
      align-items:center;
      gap:8px;
      border-radius:999px;
      padding:9px 14px;
      font-size:14px;
      font-weight:700;
      text-decoration:none;
      border:1px solid var(--line);
      background:#fff;
      color:var(--muted);
      transition:.25s ease;
    }

    .blog-stat-box i,
    .blog-stat-btn i,
    .social-share-link i{ font-size:14px; }

    .blog-stat-btn:hover,
    .social-share-link:hover{
      transform:translateY(-2px);
      color:var(--primary);
      background:#f8fbff;
    }

    .blog-like-btn.liked{
      background:#fff1f3;
      border-color:#ffd2d8;
      color:var(--danger);
    }

    .blog-share-btn.shared{
      background:#effcf3;
      border-color:#cfeedd;
      color:var(--success);
    }

    .social-share-link.facebook{ color:#1877f2; }
    .social-share-link.instagram{ color:#e1306c; }
    .social-share-link.youtube{ color:#ff0000; }
    .social-share-link.twitter{ color:#1d9bf0; }

    .blog-main{ padding:30px; }
    .blog-sidebar{ position:sticky; top:20px; }
    .blog-section{ margin-bottom:34px; }
    .blog-section:last-child{ margin-bottom:0; }

    .blog-section h2{
      font-size:28px;
      font-weight:800;
      color:var(--primary);
      margin-bottom:14px;
    }

    .blog-section h3{
      font-size:20px;
      font-weight:800;
      color:var(--primary);
      margin:20px 0 8px;
    }

    .blog-section p{
      color:var(--muted);
      margin-bottom:14px;
    }

    .blog-section ul{
      margin:0;
      padding-left:20px;
      color:var(--muted);
    }

    .blog-section li{ margin-bottom:10px; }

    .hero-image-card,
    .sidebar-card,
    .faq-card,
    .ad-card{
      background:#fff;
      border:1px solid var(--line);
      border-radius:var(--radius);
      box-shadow:var(--shadow);
    }

    .hero-image-card{
      overflow:hidden;
      margin-bottom:26px;
    }

    .hero-image-card img{
      width:100%;
      height:470px;
      display:block;
      object-fit:cover;
    }

    .hero-image-caption{
      padding:16px 18px;
      background:#fbfdff;
      border-top:1px solid var(--line);
    }

    .hero-image-caption strong{
      display:block;
      color:var(--primary);
      margin-bottom:4px;
      font-size:18px;
    }

    .sidebar-card{
      padding:22px;
      margin-bottom:20px;
    }

    .sidebar-card:last-child{ margin-bottom:0; }

    .sidebar-title{
      font-size:22px;
      font-weight:800;
      color:var(--primary);
      margin-bottom:8px;
    }

    .sidebar-text{
      font-size:15px;
      color:var(--muted);
      margin-bottom:16px;
    }

    .recent-blog-list{
      display:flex;
      flex-direction:column;
      gap:14px;
    }

    .recent-blog-item{
      border:1px solid var(--line);
      border-radius:14px;
      background:#f9fbfe;
      padding:14px;
      transition:.25s ease;
      overflow:hidden;
    }

    .recent-blog-item:hover{
      transform:translateY(-3px);
      box-shadow:0 12px 24px rgba(20,64,122,.08);
    }

    .recent-blog-date{
      display:inline-block;
      font-size:12px;
      color:var(--muted);
      background:#edf4fd;
      border:1px solid #dbe7f7;
      padding:6px 10px;
      border-radius:999px;
      margin-bottom:10px;
    }

    .recent-blog-item h4{
      font-size:17px;
      line-height:1.45;
      font-weight:800;
      color:var(--primary);
      margin-bottom:10px;
    }

    .recent-blog-item p{
      font-size:14px;
      color:var(--muted);
      margin-bottom:12px;
      line-height:1.65;
    }

    .btn-read{
      display:inline-block;
      width:100%;
      text-align:center;
      text-decoration:none;
      background:linear-gradient(135deg, var(--primary), var(--primary-2));
      color:#fff;
      padding:11px 14px;
      border-radius:12px;
      font-weight:700;
      transition:.25s ease;
    }

    .btn-read:hover{ color:#fff; transform:translateY(-2px); }

    .btn-outline-box{
      display:inline-block;
      width:100%;
      text-align:center;
      text-decoration:none;
      background:#fff;
      color:var(--primary);
      border:1px solid var(--line);
      padding:11px 14px;
      border-radius:12px;
      font-weight:700;
      transition:.25s ease;
    }

    .btn-outline-box:hover{ color:var(--primary); background:#f8fbff; }

    .ad-card{ padding:0; overflow:hidden; }

    .ad-label{
      background:#fff7e8;
      color:#9a6a00;
      font-size:12px;
      font-weight:700;
      letter-spacing:.08em;
      text-transform:uppercase;
      padding:10px 14px;
      border-bottom:1px solid #f1dfb2;
    }

    .ad-body{
      padding:18px;
      background:linear-gradient(180deg, #ffffff 0%, #fbfdff 100%);
    }

    .ad-body img{
      width:100%;
      border-radius:14px;
      margin-bottom:14px;
      display:block;
    }

    .faq-card{
      padding:18px 20px;
      margin-bottom:12px;
      background:#fbfdff;
    }

    .faq-card h3{
      font-size:18px;
      font-weight:800;
      color:var(--primary);
      margin-bottom:6px;
    }

    .faq-card p{ margin:0; color:var(--muted); }

    .blog-footer{
      padding:22px 30px;
      border-top:1px solid var(--line);
      color:var(--muted);
      background:#fcfdff;
      font-size:14px;
    }

    .blog-footer a{
      color:var(--primary);
      text-decoration:none;
      font-weight:700;
    }

    .blog-footer a:hover{ color:var(--primary-2); }

    .recent-blog-thumb{
      width:100%;
      height:auto;
      max-height:180px;
      object-fit:contain;
      display:block;
      background:#eef4fb;
      padding:6px;
      border-radius:12px;
    }

    .recent-blog-thumb-placeholder{
      width:100%;
      height:180px;
      display:flex;
      align-items:center;
      justify-content:center;
      background:#eef4fb;
      color:#6b7c93;
      font-weight:600;
      border-radius:12px;
    }

    .recent-blog-content{ padding:12px 0 0; }

    .recent-meta-row{
      display:flex;
      justify-content:space-between;
      align-items:center;
      gap:8px;
      flex-wrap:wrap;
      margin-bottom:10px;
    }

    .recent-stats{
      display:flex;
      gap:6px;
      flex-wrap:wrap;
    }

    .recent-stat{
      display:inline-flex;
      align-items:center;
      gap:4px;
      padding:5px 8px;
      border-radius:999px;
      font-size:11px;
      font-weight:700;
      background:#ffffff;
      border:1px solid #dbe7f7;
      color:#6b7c93;
    }

    @media (max-width: 991.98px){
      .blog-main{ padding:20px; }
      .blog-title{ font-size:30px; }
      .blog-sidebar{ position:static; }
      .blog-top-meta{ align-items:flex-start; }
    }

    @media (max-width: 575.98px){
      .blog-page-wrap{ padding:20px 0 40px; }
      .blog-header{ padding:22px 18px; }
      .blog-main{ padding:16px; }
      .blog-title{ font-size:26px; }
      .blog-section h2{ font-size:24px; }
      .hero-image-card img{ height:300px; }
      .blog-stat-btn,
      .blog-stat-box,
      .social-share-link{
        font-size:13px;
        padding:8px 12px;
      }
    }
  </style>
</head>

<body>
<?php include 'includes/blog_header.php'; ?>

<div class="blog-page-wrap">
  <div class="container">
    <div class="blog-box">

      <div class="blog-header">
          
          <div class="d-flex align-items-center gap-2 flex-wrap mb-3">
          <span class="blog-chip">
            IIT JEE Coaching Guide
          </span>
        
          <span class="blog-chip" style="background:#fff7ed;color:#b45309;border-color:#fed7aa;">
            <i class="fa-solid fa-calendar-days"></i>
            <?php echo date('d M Y', strtotime($blogDate)); ?>
          </span>
</div>

        <h1 class="blog-title">Top IIT JEE Coaching in Hyderabad – Complete Guide for Students</h1>
        <p class="blog-subtitle">A practical guide for students and parents to understand what really matters while choosing IIT JEE coaching in Hyderabad.</p>

        <div class="blog-top-meta">
          <div class="blog-meta-left">
            <button type="button" class="blog-stat-btn blog-like-btn" id="likeBtn">
              <i class="fa-solid fa-heart"></i>
              <span id="likeCount">0</span>
            </button>

            <div class="blog-stat-box">
              <i class="fa-solid fa-eye"></i>
              <span id="viewCount">0</span>
            </div>

            <button type="button" class="blog-stat-btn blog-share-btn" id="shareBtn">
              <i class="fa-solid fa-share-nodes"></i>
              <span id="shareCount">0</span>
            </button>
          </div>

          <div class="blog-meta-right">
            <a class="social-share-link facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $encodedUrl; ?>" target="_blank" rel="noopener">
              <i class="fa-brands fa-facebook-f"></i> Facebook
            </a>

            <a class="social-share-link instagram" href="https://www.instagram.com/dr_academy12/" target="_blank" rel="noopener">
              <i class="fa-brands fa-instagram"></i> Instagram
            </a>

            <a class="social-share-link youtube" href="https://www.youtube.com/@dr_academy" target="_blank" rel="noopener">
              <i class="fa-brands fa-youtube"></i> YouTube
            </a>

            <a class="social-share-link twitter" href="https://twitter.com/intent/tweet?url=<?php echo $encodedUrl; ?>&text=<?php echo $encodedTitle; ?>" target="_blank" rel="noopener">
              <i class="fa-brands fa-x-twitter"></i> X
            </a>
          </div>
        </div>
      </div>

      <div class="blog-main">
        <div class="row g-4">
          <div class="col-lg-8">
            <div class="blog-content">

              <div class="hero-image-card">
                <img src="images/tmbnl/tmbnl-005.png" alt="Students attending IIT JEE coaching classes at DR Academy Hyderabad" title="IIT JEE Coaching in Hyderabad">
                <div class="hero-image-caption">
                  <strong>IIT JEE Coaching in Hyderabad</strong>
                  Students attending IIT JEE coaching classes at DR Academy Hyderabad
                </div>
              </div>

              <section class="blog-section">
                <h2>Introduction</h2>
                <p>I've talked to enough JEE aspirants to notice a pattern. Most of them walk into the preparation year with a rough idea of what they need — study more, sleep less, grind harder. That mental model doesn't survive contact with the actual exam. JEE doesn't particularly care how many hours you put in. It cares whether you understood the thing you were reading.</p>
                <p>That gap — between effort and understanding — is what most coaching institutes quietly refuse to address. It's easier to hand out thick material packets and run a schedule than to actually figure out where a student's thinking breaks down.</p>
                <p>Hyderabad has no shortage of institutes claiming to solve this. Picking the right one requires ignoring most of what they say about themselves and looking at what they actually do.</p>
              </section>

              <section class="blog-section">
                <h2>Why IIT JEE Preparation Requires Proper Guidance</h2>
                <p>JEE never made sense to me as an exam about how much a student has studied. It functions more like a test of how a student thinks under pressure. The syllabus is large, sure — but students who fail usually don't fail because they missed a topic. They fail because they never got comfortable with the kind of lateral problem-solving the paper demands.</p>
                <p>The common struggles are predictable:</p>
                <ul>
                  <li>Numericals that require three concepts working together, not one applied cleanly</li>
                  <li>Time pressure that makes familiar problems suddenly feel unfamiliar</li>
                  <li>The slow erosion of confidence that comes from irregular revision</li>
                  <li>Balancing school boards and JEE preparation without either one swallowing the other</li>
                </ul>
                <p>Most students underestimate how much of the work is mental. The subject content is learnable. Staying consistent across a full year while managing those pressures — that's where preparation genuinely gets difficult. And that's what good coaching is actually for.</p>
              </section>

              <section class="blog-section">
                <h2>Why Hyderabad is a Preferred City for IIT JEE Preparation</h2>
                <p>Students ask whether Hyderabad is worth it compared to preparing closer to home. Honestly, the city isn't magic. What it offers is density — enough serious JEE aspirants in one place that the competitive atmosphere becomes ambient rather than something a student has to manufacture alone.</p>
                <p>There's also faculty access. The number of teachers in Hyderabad who have spent years specifically with JEE preparation — not general physics or chemistry teaching, but JEE-level problem-solving — is meaningfully higher than in smaller cities.</p>
                <p>That concentration matters, especially for the paper-specific tricks and problem-solving frameworks that only come from coaching exam-specific students over many years.</p>
              </section>

              <section class="blog-section">
                <h2>Important Factors to Check Before Joining IIT JEE Coaching</h2>
                <p>The mistake most families make is treating institute selection like a product review. Highest-rated, most popular, biggest building, longest track record on the banner. None of that is useless, but none of it answers the question that matters: will this place actually help this specific student get better?</p>

                <h3>Faculty and Teaching Quality</h3>
                <p>Find out who runs the actual daily sessions. A well-known faculty name who appears twice a month and otherwise delegates is a different situation from a less-celebrated teacher who is in the classroom every day and remembers which students are slipping.</p>

                <h3>Study Material and Practice Questions</h3>
                <p>Good JEE material is selective. It should cover the right things deeply, not everything shallowly. Students don't need more material. They need better material, organized for revision.</p>

                <h3>Regular Tests and Performance Analysis</h3>
                <p>The word mock tests appears in every institute's marketing. What varies is whether those tests are taken seriously or treated as optional additions. Institutes that make tests feel uncomfortable and unavoidable are usually doing something right.</p>

                <h3>Doubt Clarification Sessions</h3>
                <p>Batch-level doubt sessions are fine for general review, but they are not a substitute for individual doubt support. A student stuck on the same electrostatics concept for two weeks needs a different kind of attention than a group Q&A can provide.</p>

                <h3>Student-Friendly Learning Environment</h3>
                <p>A good environment gives students discipline without turning preparation into panic. Students need guidance, feedback, and a classroom system that helps them stay serious without losing confidence.</p>
              </section>

              <section class="blog-section">
                <h2>DR Academy – IIT JEE Coaching in Hyderabad</h2>
                <p>Among the options students are looking at for IIT JEE coaching in Hyderabad, DR Academy keeps coming up in conversations for specific reasons rather than vague reputation.</p>
                <p>The preparation model is concept-first in a way that's actually enforced rather than just described in an information session. JEE has shifted steadily toward application-based questions over the last several years — students who approach it with memorized formulas run into problems around advanced mocks when the question wording changes slightly and they realize they don't actually know what the formula represents.</p>
                <p>The faculty at DR Academy seem to take that seriously rather than treating it as a problem the student should figure out independently.</p>
              </section>

              <section class="blog-section">
                <h2>What Makes DR Academy Different</h2>

                <h3>Concept-Based Learning Approach</h3>
                <p>DR Academy focuses on concept-first preparation. Students are trained to understand what a formula means, when it applies, and how to connect concepts across topics.</p>

                <h3>Experienced Faculty Guidance</h3>
                <p>Experienced faculty guidance matters because JEE-level problem solving requires more than chapter explanation. Students need teachers who can identify weak thinking patterns and correct them early.</p>

                <h3>Structured Preparation Strategy</h3>
                <p>The structure holds across the full year: planned coverage, topic-wise testing, revision cycles, and performance tracking that's specific rather than just a score on a sheet.</p>

                <h3>Regular Mock Tests and Analysis</h3>
                <p>A score after a mock test is information. What a student needs is interpretation — where did the time go, which question type caused the accuracy drop, and whether the issue was a concept gap or a time-pressure response.</p>

                <h3>Individual Attention for Students</h3>
                <p>Individual attention becomes useful when a student needs a different approach to a topic already taught. That kind of specific redirection requires someone tracking individual performance rather than batch averages.</p>
              </section>

              <section class="blog-section">
                <h2>Tips for Students Preparing for IIT JEE</h2>
                <p>No institute covers the full distance. The students who make the most visible improvement across a preparation year are almost always the ones who understand that coaching is a support structure, not a delivery service.</p>
                <p>Fundamentals deserve more time than most students give them. Advanced JEE problems are often built by stacking fundamental concepts in combinations that require each one to be solid.</p>
                <p>Daily problem-solving matters. Not marathon sessions — consistency. An hour of actual problem-solving every day does more over a year than five-hour sessions three times a week.</p>
                <p>Revision needs to be scheduled deliberately. The natural pull is always toward new material because it feels like progress, but going back to older chapters is necessary.</p>
                <p>Use fewer resources. Three textbooks, one question bank, and one mock series are usually enough. Students who keep adding sources are often managing anxiety, not improving preparation.</p>
              </section>

              <section class="blog-section">
                <h2>Common Mistakes JEE Aspirants Should Avoid</h2>
                <p>Ignoring the subject that feels hard is the most expensive mistake. Most students have a subject that drags, and the instinct is to spend more time on the subjects that already feel okay because progress there is visible.</p>
                <p>Avoiding mock tests because the scores feel discouraging is another repeated issue. The score at month four is not a verdict. It's diagnostic information about where preparation stands right now.</p>
                <p>Constant comparison with peers is also corrosive. JEE preparation is a long game. Two students can look very different in October and reverse completely by March. Comparison adds nothing and costs attention.</p>
              </section>

              <section class="blog-section">
                <h2>Importance of Parent Support</h2>
                <p>Parent support plays a major role during IIT JEE preparation. Students need accountability, but they also need a stable environment where low mock scores are treated as feedback, not failure.</p>
                <p>Parents can help by focusing on consistency, health, revision discipline, and communication with teachers instead of reacting only to marks. A calm support system helps students handle pressure better.</p>
              </section>

              <section class="blog-section">
                <h2>Final Thoughts</h2>
                <p>Picking the right IIT JEE coaching in Hyderabad is worth taking seriously — not because the decision is irreversible, but because time in the wrong environment doesn't come back.</p>
                <p>DR Academy offers the kind of preparation environment that holds up across the full year: concept-focused teaching, genuine individual attention, structured testing, and feedback that's specific enough to be useful.</p>
                <p>Whether it's the right fit depends on the student and what they actually need from a coaching setup.</p>
                <p>JEE doesn't reward grinding. It rewards understanding, maintained under pressure, across a long preparation period. That's a harder thing to build — and most students underestimate how much the environment they prepare in shapes whether they actually build it.</p>
              </section>

              <section class="blog-section">
                <h2>FAQs</h2>

                <div class="faq-card">
                  <h3>1. Which is the best IIT JEE coaching institute in Hyderabad?</h3>
                  <p>DR Academy is considered one of the preferred choices for IIT JEE coaching in Hyderabad because of its structured preparation, experienced faculty, and student-focused guidance.</p>
                </div>

                <div class="faq-card">
                  <h3>2. Why is coaching important for IIT JEE preparation?</h3>
                  <p>Coaching helps students improve conceptual understanding, practice advanced problems, manage time better, and stay consistent throughout preparation.</p>
                </div>

                <div class="faq-card">
                  <h3>3. Does DR Academy provide mock tests for IIT JEE students?</h3>
                  <p>Yes, DR Academy conducts regular mock tests and performance analysis sessions to help students improve accuracy and confidence.</p>
                </div>

                <div class="faq-card">
                  <h3>4. How should students choose an IIT JEE coaching institute in Hyderabad?</h3>
                  <p>Students should check faculty quality, study materials, mock tests, doubt clarification support, and overall learning environment before joining.</p>
                </div>

                <div class="faq-card">
                  <h3>5. What are the benefits of joining DR Academy for IIT JEE preparation?</h3>
                  <p>Students receive concept-based teaching, structured preparation plans, regular practice sessions, individual attention, and continuous academic support.</p>
                </div>
              </section>

              <section class="blog-section">
                <h2>Useful Links</h2>
                <ul>
                  <li><a href="https://dracademy.edu.in/" target="_blank" rel="noopener">Homepage</a></li>
                  <li><a href="https://dracademy.edu.in/about-us/" target="_blank" rel="noopener">About Us</a></li>
                  <li><a href="https://dracademy.edu.in/contact-us/" target="_blank" rel="noopener">Contact Page</a></li>
                  <li><a href="https://jeemain.nta.nic.in" target="_blank" rel="noopener">JEE Main Official Website</a></li>
                  <li><a href="https://nta.ac.in" target="_blank" rel="noopener">NTA Official Website</a></li>
                  <li><a href="https://www.education.gov.in" target="_blank" rel="noopener">Ministry of Education</a></li>
                </ul>
              </section>

            </div>
          </div>

          <div class="col-lg-4">
            <div class="blog-sidebar">

              <div class="sidebar-card">
                <h3 class="sidebar-title">Recent Blogs</h3>
                <p class="sidebar-text">Read more useful articles from DR Academy.</p>

                <div class="recent-blog-list" id="recentBlogsGrid">
                  <div class="recent-blog-item">
                    <p class="mb-0">Loading recent blogs...</p>
                  </div>
                </div>

                <div class="mt-3">
                  <a href="../blog.php" class="btn-outline-box">View All Blogs</a>
                </div>
              </div>

              <div class="sidebar-card ad-card">
                <div class="ad-label">Advertisement</div>
                <div class="ad-body">
                  <?php include '../includes/slider.php'; ?>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>

      <div class="blog-footer d-flex flex-column flex-lg-row justify-content-between gap-3 align-items-lg-center">
        <div>© 2026 DR Academy. All rights reserved.</div>
        <div class="d-flex flex-wrap gap-3">
          <a href="https://dracademy.edu.in/" target="_blank" rel="noopener">Homepage</a>
          <a href="https://dracademy.edu.in/about-us/" target="_blank" rel="noopener">About Us</a>
          <a href="https://dracademy.edu.in/contact-us/" target="_blank" rel="noopener">Contact</a>
        </div>
      </div>

    </div>
  </div>
</div>

<script>
  const BLOG_API_URL = '../fetch.php';
  const CURRENT_BLOG_URL = window.location.pathname.split('/').pop();

  async function updateShareCount() {
    try {
      const response = await fetch('?stats_action=share', { cache: 'no-store' });
      const data = await response.json();

      if (data.success) {
        document.getElementById('viewCount').textContent = data.views;
        document.getElementById('likeCount').textContent = data.likes;
        document.getElementById('shareCount').textContent = data.shares;
        document.getElementById('shareBtn').classList.add('shared');
      }
    } catch (error) {
      console.error('Error updating share count:', error);
    }
  }

  function formatRecentBlogDate(dateString) {
    if (!dateString) return 'Unknown Date';

    const parts = dateString.split('-');
    if (parts.length !== 3) return dateString;

    const year = parseInt(parts[0], 10);
    const month = parseInt(parts[1], 10) - 1;
    const day = parseInt(parts[2], 10);

    const safeDate = new Date(year, month, day);
    if (isNaN(safeDate.getTime())) return dateString;

    return safeDate.toLocaleDateString('en-IN', {
      day: '2-digit',
      month: 'short',
      year: 'numeric'
    });
  }

  function escapeRecentHtml(text) {
    const div = document.createElement('div');
    div.textContent = text || '';
    return div.innerHTML;
  }

  function generateRecentDescription(title) {
    return `Read this article about ${title.toLowerCase()}. Open the blog for full details and complete information.`;
  }

  async function loadRecentBlogs() {
    const grid = document.getElementById('recentBlogsGrid');
    if (!grid) return;

    try {
      const response = await fetch(BLOG_API_URL, { cache: 'no-store' });

      if (!response.ok) {
        throw new Error(`HTTP error! Status: ${response.status}`);
      }

      const data = await response.json();

      if (!Array.isArray(data)) {
        throw new Error('Invalid JSON response format');
      }

      const recentBlogs = data
        .filter(blog => {
          const blogFile = (blog.url || '').split('/').pop();
          return blogFile !== CURRENT_BLOG_URL;
        })
        .sort((a, b) => new Date(b.date) - new Date(a.date))
        .slice(0, 5);

      if (!recentBlogs.length) {
        grid.innerHTML = `
          <div class="recent-blog-item">
            <p class="mb-0">No recent blogs found.</p>
          </div>
        `;
        return;
      }

      grid.innerHTML = recentBlogs.map(blog => `
        <div class="recent-blog-item">
          ${blog.thumbnail ? `
            <a href="../${encodeURI(blog.url || '#')}">
              <img src="../${encodeURI(blog.thumbnail)}" 
                   class="recent-blog-thumb" 
                   alt="${escapeRecentHtml(blog.title)}">
            </a>
          ` : `
            <div class="recent-blog-thumb-placeholder">No Image</div>
          `}

          <div class="recent-blog-content">
            <div class="recent-meta-row">
              <div class="recent-blog-date">
                ${escapeRecentHtml(formatRecentBlogDate(blog.date))}
              </div>

              <div class="recent-stats">
                <span class="recent-stat">
                  <i class="fa-solid fa-eye"></i> ${Number(blog.views || 0)}
                </span>
                <span class="recent-stat">
                  <i class="fa-solid fa-heart"></i> ${Number(blog.likes || 0)}
                </span>
                <span class="recent-stat">
                  <i class="fa-solid fa-share-nodes"></i> ${Number(blog.shares || 0)}
                </span>
              </div>
            </div>

            <h4>${escapeRecentHtml(blog.title || 'Untitled Blog')}</h4>
            <p>${escapeRecentHtml(blog.description || generateRecentDescription(blog.title || 'blog'))}</p>
            <a href="../${encodeURI(blog.url || '#')}" class="btn-read">Read More</a>
          </div>
        </div>
      `).join('');

    } catch (error) {
      console.error('Error loading recent blogs:', error);
      grid.innerHTML = `
        <div class="recent-blog-item">
          <p class="mb-0">Unable to load recent blogs.</p>
        </div>
      `;
    }
  }

  async function loadBlogStats() {
    try {
      const response = await fetch('?stats_action=view', { cache: 'no-store' });
      const data = await response.json();

      if (data.success) {
        document.getElementById('viewCount').textContent = data.views;
        document.getElementById('likeCount').textContent = data.likes;
        document.getElementById('shareCount').textContent = data.shares;

        if (data.liked) {
          document.getElementById('likeBtn').classList.add('liked');
        }
      }
    } catch (error) {
      console.error('Error loading stats:', error);
    }
  }

  async function likeBlog() {
    const likeBtn = document.getElementById('likeBtn');

    if (likeBtn.classList.contains('liked')) {
      return;
    }

    try {
      const response = await fetch('?stats_action=like', { cache: 'no-store' });
      const data = await response.json();

      if (data.success) {
        document.getElementById('viewCount').textContent = data.views;
        document.getElementById('likeCount').textContent = data.likes;
        document.getElementById('shareCount').textContent = data.shares;
        likeBtn.classList.add('liked');
      }
    } catch (error) {
      console.error('Error liking blog:', error);
    }
  }

  async function shareBlog() {
    const shareData = {
      title: <?php echo json_encode($blogTitle); ?>,
      text: <?php echo json_encode($blogDescription); ?>,
      url: <?php echo json_encode($currentUrl); ?>
    };

    try {
      if (navigator.share) {
        await navigator.share(shareData);
        await updateShareCount();
      } else {
        window.open('https://twitter.com/intent/tweet?url=' + encodeURIComponent(shareData.url) + '&text=' + encodeURIComponent(shareData.title), '_blank');
        await updateShareCount();
      }
    } catch (error) {
      console.log('Share cancelled or failed', error);
    }
  }

  document.getElementById('likeBtn').addEventListener('click', likeBlog);
  document.getElementById('shareBtn').addEventListener('click', shareBlog);

  loadRecentBlogs();
  loadBlogStats();
</script>
</body>
</html>
