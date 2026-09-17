<?php
// online-enquiry-submit.php

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index.php");
    exit();
}

/* ---------- SAFE INPUT FUNCTION ---------- */
function clean_input($key) {
    return isset($_POST[$key]) ? trim(strip_tags($_POST[$key])) : '';
}

$name       = clean_input('name');
$parent_name= clean_input('parent_name');
$email      = clean_input('email');
$gender     = clean_input('gender');
$mobile     = clean_input('mobile');
$place      = clean_input('place');
$sname      = clean_input('sname');
$mycourse   = clean_input('mycourse');
$mylocation = clean_input('mylocation');

/* ---------- BASIC VALIDATION ---------- */
if ($name === '' || $mobile === '') {
    echo "<h2 style='color:red; font-family:Arial;'>Name and WhatsApp Number are required.</h2>";
    exit();
}

if ($email !== '' && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "<h2 style='color:red; font-family:Arial;'>Invalid email address.</h2>";
    exit();
}

/* ---------- MAIL SETTINGS ---------- */
$to       = "info@dracademy.co.in";
$cc_email = "app.dracademy@gmail.com";
$subject  = "Online Enquiry - DR Academy";

/* ---------- ESCAPE OUTPUT FOR EMAIL TEMPLATE ---------- */
function e($value) {
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

$safe_name        = e($name);
$safe_parent_name = e($parent_name);
$safe_email       = e($email);
$safe_gender      = e($gender);
$safe_mobile      = e($mobile);
$safe_place       = e($place);
$safe_sname       = e($sname);
$safe_mycourse    = e($mycourse);
$safe_mylocation  = e($mylocation);

/* ---------- HTML EMAIL TEMPLATE ---------- */
$message = "
<!DOCTYPE html>
<html>
<head>
<meta charset='UTF-8'>
<title>Online Enquiry</title>
</head>
<body style='margin:0; padding:0; background:#f2f4f8; font-family:Arial, sans-serif;'>

<table width='100%' cellpadding='0' cellspacing='0' style='background:#f2f4f8; padding:25px 10px;'>
<tr>
<td align='center'>

<table width='100%' cellpadding='0' cellspacing='0' style='max-width:650px; background:#ffffff; border-radius:14px; overflow:hidden; box-shadow:0 10px 30px rgba(0,0,0,0.12);'>

<tr>
<td style='background:linear-gradient(135deg,#0b5ed7,#6610f2); padding:24px; text-align:center; color:#ffffff;'>
<h2 style='margin:0; font-size:24px;'>DR Academy Online Enquiry</h2>
<p style='margin:8px 0 0; font-size:14px;'>New admission enquiry received from website</p>
</td>
</tr>

<tr>
<td style='padding:25px;'>
<p style='font-size:16px; color:#333; margin-top:0;'>Student enquiry details are given below:</p>

<table width='100%' cellpadding='0' cellspacing='0' style='border-collapse:collapse; font-size:15px;'>
<tr>
<td style='padding:12px; border:1px solid #e5e7eb; font-weight:bold; background:#f8fafc; width:38%;'>Student Name</td>
<td style='padding:12px; border:1px solid #e5e7eb;'>$safe_name</td>
</tr>

<tr>
<td style='padding:12px; border:1px solid #e5e7eb; font-weight:bold; background:#f8fafc;'>Parent Name</td>
<td style='padding:12px; border:1px solid #e5e7eb;'>$safe_parent_name</td>
</tr>

<tr>
<td style='padding:12px; border:1px solid #e5e7eb; font-weight:bold; background:#f8fafc;'>Email</td>
<td style='padding:12px; border:1px solid #e5e7eb;'>$safe_email</td>
</tr>

<tr>
<td style='padding:12px; border:1px solid #e5e7eb; font-weight:bold; background:#f8fafc;'>WhatsApp Number</td>
<td style='padding:12px; border:1px solid #e5e7eb;'>$safe_mobile</td>
</tr>

<tr>
<td style='padding:12px; border:1px solid #e5e7eb; font-weight:bold; background:#f8fafc;'>Gender</td>
<td style='padding:12px; border:1px solid #e5e7eb;'>$safe_gender</td>
</tr>

<tr>
<td style='padding:12px; border:1px solid #e5e7eb; font-weight:bold; background:#f8fafc;'>Place</td>
<td style='padding:12px; border:1px solid #e5e7eb;'>$safe_place</td>
</tr>

<tr>
<td style='padding:12px; border:1px solid #e5e7eb; font-weight:bold; background:#f8fafc;'>School Name</td>
<td style='padding:12px; border:1px solid #e5e7eb;'>$safe_sname</td>
</tr>

<tr>
<td style='padding:12px; border:1px solid #e5e7eb; font-weight:bold; background:#f8fafc;'>Selected Course</td>
<td style='padding:12px; border:1px solid #e5e7eb;'>$safe_mycourse</td>
</tr>

<tr>
<td style='padding:12px; border:1px solid #e5e7eb; font-weight:bold; background:#f8fafc;'>Campus Location</td>
<td style='padding:12px; border:1px solid #e5e7eb;'>$safe_mylocation</td>
</tr>
</table>

<p style='margin-top:22px; color:#64748b; font-size:13px;'>This is an automated message from DR Academy website enquiry form.</p>
</td>
</tr>

<tr>
<td style='background:#111827; color:#ffffff; padding:14px; text-align:center; font-size:13px;'>
© " . date("Y") . " DR Academy. All Rights Reserved.
</td>
</tr>

</table>

</td>
</tr>
</table>

</body>
</html>";

/* ---------- EMAIL HEADERS ---------- */
$from_email = "no-reply@dracademy.co.in";

$headers  = "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8\r\n";
$headers .= "From: DR Academy <$from_email>\r\n";

if ($email !== '') {
    $headers .= "Reply-To: $email\r\n";
}

$headers .= "Cc: $cc_email\r\n";
$headers .= "X-Mailer: PHP/" . phpversion();

/* ---------- SEND MAIL ---------- */
if (mail($to, $subject, $message, $headers)) {
    header("Location: index.php?enquiry=success");
    exit();
} else {
    echo "<h2 style='color:red; font-family:Arial;'>Mail sending failed. Please check hosting mail settings.</h2>";
}
?>
