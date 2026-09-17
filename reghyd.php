<?php
$showPopup = false;

if($_SERVER["REQUEST_METHOD"] == "POST") {

    $name         = trim($_POST['name']);
    $father_name  = trim($_POST['father_name']);
    $mobile       = trim($_POST['mobile']);
    $email        = trim($_POST['email']);
    $course       = trim($_POST['course']);

    // ---- MAIN RECEIVER ----
    $to = "hyd@dracademy.co.in";

    // ---- CC EMAIL ----
    $cc_email = "app.dracademy@gmail.com";

    $subject = "Intermediate ADMISSIONS";

    // ---------- HTML EMAIL TEMPLATE ----------
    $message = "
    <html>
    <body style='font-family: Arial, sans-serif; background:#f2f2f2; padding:20px;'>

        <div style='max-width:600px; margin:auto; background:#ffffff; border-radius:8px; 
            box-shadow:0 0 10px rgba(0,0,0,0.1); overflow:hidden;'>

            <div style='background:#007bff; padding:15px; color:#fff; text-align:center;'>
                <h2 style='margin:0;'>Intermediate Admission Form Submission</h2>
            </div>

            <div style='padding:20px;'>
                <p style='font-size:16px;'>A new student has submitted the admission form. Below are the details:</p>

                <table style='width:100%; border-collapse:collapse;'>
                    <tr>
                        <td style='padding:10px; border-bottom:1px solid #ddd; font-weight:bold;'>Name:</td>
                        <td style='padding:10px; border-bottom:1px solid #ddd;'>$name</td>
                    </tr>
                    <tr>
                        <td style='padding:10px; border-bottom:1px solid #ddd; font-weight:bold;'>Father Name:</td>
                        <td style='padding:10px; border-bottom:1px solid #ddd;'>$father_name</td>
                    </tr>
                    <tr>
                        <td style='padding:10px; border-bottom:1px solid #ddd; font-weight:bold;'>Mobile:</td>
                        <td style='padding:10px; border-bottom:1px solid #ddd;'>$mobile</td>
                    </tr>
                    <tr>
                        <td style='padding:10px; border-bottom:1px solid #ddd; font-weight:bold;'>Email:</td>
                        <td style='padding:10px; border-bottom:1px solid #ddd;'>$email</td>
                    </tr>
                    <tr>
                        <td style='padding:10px; border-bottom:1px solid #ddd; font-weight:bold;'>Selected Course:</td>
                        <td style='padding:10px; border-bottom:1px solid #ddd;'>$course</td>
                    </tr>
                </table>

                <p style='margin-top:20px; font-size:14px; color:#555;'>
                    This is an automated message from your website form.
                </p>
            </div>

            <div style='background:#007bff; color:#fff; padding:10px; text-align:center;'>
                <p style='margin:0; font-size:14px;'>© ".date("Y")." www.dracademy.co.in</p>
            </div>
        </div>

    </body>
    </html>";

    // Email headers for HTML
    $headers  = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=UTF-8\r\n";
    $headers .= "From: DR ACADEMY <no-reply@yourdomain.com>\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "CC: $cc_email\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();

    if(mail($to, $subject, $message, $headers)) {
        $showPopup = true;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Admission Form</title>

<!-- Event snippet for Web Form conversion page -->
<script>
  gtag('event', 'conversion', {'send_to': 'AW-10778437068/j2E4CL-Mw9sDEMzLx5Mo'});
</script>


<style>
/* ---- FORM HIDDEN WHEN POPUP SHOWS ---- */
<?php if($showPopup){ ?>
#admissionForm { display: none; }
<?php } ?>

/* ---- POPUP DESIGN ---- */
.popup-overlay {
    display: none;
    position: fixed;
    inset: 0;
    background: linear-gradient(135deg, #ff7eb3, #7ac7ff); /* Pink-Blue Gradient */
    backdrop-filter: blur(12px);
    z-index: 9999;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
}
.popup-box {
    background: #fff;
    width: 100%;
    max-width: 650px; /* bigger popup overall */
    padding: 60px 50px; /* more spacious padding */
    border-radius: 25px;
    text-align: center;
    animation: pop .4s ease;
    box-shadow: 0 8px 45px rgba(0,0,0,0.35);
}
.popup-icon {
    width: 120px;
    height: 120px;
    margin: 0 auto 30px;
    background: linear-gradient(135deg,#28a745,#6fe08f);
    color: #fff;
    font-size: 64px;
    border-radius: 50%;
    display:flex;
    align-items:center;
    justify-content:center;
}
.popup-box h2 { 
    margin-bottom: 20px; 
    font-size: 32px;  /* bigger heading */
}
.popup-box p { 
    color: #555; 
    font-size: 20px;  /* bigger text */
    line-height: 1.6; 
}
.popup-box button {
    margin-top: 35px;
    padding: 16px 45px;
    border: none;
    border-radius: 30px;
    background: #007bff;
    color: #fff;
    font-size: 20px;  /* bigger button text */
    cursor: pointer;
    transition: 0.3s;
}
.popup-box button:hover {
    background: #0056b3;
}
@keyframes pop {
    from {transform: translateY(40px);opacity:0}
    to {transform: translateY(0);opacity:1}
}

/* --- RESPONSIVE FOR MOBILE --- */
@media (max-width: 600px){
    .popup-box {
        max-width: 95%;          /* almost full screen */
        padding: 50px 25px;      /* larger feel */
    }
    .popup-box h2 { font-size: 28px; }
    .popup-box p { font-size: 22px; }
    .popup-box button { font-size: 20px; padding: 16px 36px; }
    .popup-icon { width: 140px; height: 140px; font-size: 70px; }
}


</style>
</head>

<body>

<!-- FORM -->
<form method="POST" id="admissionForm">
    <input name="name" placeholder="Student Name" required><br><br>
    <input name="father_name" placeholder="Father Name" required><br><br>
    <input name="mobile" placeholder="Mobile" required><br><br>
    <input type="email" name="email" placeholder="Email" required><br><br>
    <input name="course" placeholder="Course" required><br><br>
    <button type="submit">Submit</button>
</form>

<!-- POPUP -->
<div id="thankYouPopup" class="popup-overlay">
    <div class="popup-box">
        <div class="popup-icon">✓</div>
        <h2>Thank You!</h2>
        <p>
            Thank you for sharing your details.<br>
            Our team will contact you soon.
        </p>
        <button onclick="closePopup()">Close</button>
    </div>
</div>

<script>
function closePopup() {
    document.getElementById("thankYouPopup").style.display = "none";
    window.location.href = "contact.html"; // redirect after closing popup
}

// Show popup immediately if form was submitted
<?php if($showPopup){ ?>
document.getElementById("thankYouPopup").style.display = "flex";
<?php } ?>
</script>

</body>
</html>
