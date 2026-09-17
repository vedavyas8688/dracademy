<?php
// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name    = htmlspecialchars($_POST['name']);
    $email   = htmlspecialchars($_POST['email']);
    $phone   = htmlspecialchars($_POST['phone']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    // Email details
    $to = "srk.cooool@gmail.com"; // Replace with your email
    $mail_subject = "New Contact Form Query: $subject";
    $body = "
        Name: $name\n
        Email: $email\n
        Phone: $phone\n
        Subject: $subject\n
        Message:\n$message
    ";

    $headers = "From: $email";

    if (mail($to, $mail_subject, $body, $headers)) {
        $success = "Your message has been sent successfully!";
    } else {
        $error = "There was an error sending your message.";
    }
}
?>

<?php if (!empty($success)) { echo "<p style='color:green;'>$success</p>"; } ?>
    <?php if (!empty($error)) { echo "<p style='color:red;'>$error</p>"; } ?>