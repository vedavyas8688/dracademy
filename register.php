<?php
if($_SERVER["REQUEST_METHOD"] == "POST") {

    $name         = trim($_POST['name']);
    $father_name  = trim($_POST['father_name']);
    $mobile       = trim($_POST['mobile']);
    $email        = trim($_POST['email']);
    $course       = trim($_POST['course']);

    // ---- MAIN RECEIVER ----
    $to = "info@dracademy.co.in";  // change to your main email

    // ---- CC EMAIL ----
    $cc_email = "app.dracademy@gmail.com"; // change to your CC email

    $subject = "PU ADMISSIONS";

    // ---------- HTML EMAIL TEMPLATE ----------
    $message = "
    <html>
    <body style='font-family: Arial, sans-serif; background:#f2f2f2; padding:20px;'>

        <div style='max-width:600px; margin:auto; background:#ffffff; border-radius:8px; 
            box-shadow:0 0 10px rgba(0,0,0,0.1); overflow:hidden;'>

            <div style='background:#007bff; padding:15px; color:#fff; text-align:center;'>
                <h2 style='margin:0;'>2nd PUC Admission Form Submission</h2>
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
    // ------------------------------------------

    // Email headers for HTML
    $headers  = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=UTF-8\r\n";
    $headers .= "From: DR ACADEMY <no-reply@yourdomain.com>\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "CC: $cc_email\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();

    if(mail($to, $subject, $message, $headers)) {
        header("Location: index.php");
        exit();
    } else {
        echo "<h2 style='color:red;'>Mail sending failed — server mail function not working.</h2>";
    }
}
?>
