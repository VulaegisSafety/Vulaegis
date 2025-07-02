<?php
// Replace with your email
$to = "vulaegis.safety@gmail.com";

// Get form data and sanitize
$name    = htmlspecialchars(trim($_POST['name'] ?? ''));
$email   = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
$phone   = htmlspecialchars(trim($_POST['phone'] ?? ''));
$company = htmlspecialchars(trim($_POST['company'] ?? ''));
$service = htmlspecialchars(trim($_POST['service'] ?? ''));
$message = htmlspecialchars(trim($_POST['message'] ?? ''));

// Basic validation
if (!$name || !$email || !$message) {
    header('Location: contact.html?error=1');
    exit;
}

// Compose email
$subject = "New Contact Form Submission from $name";
$body = "Name: $name\n"
      . "Email: $email\n"
      . "Phone: $phone\n"
      . "Company: $company\n"
      . "Service Interest: $service\n"
      . "Message:\n$message\n";

// Headers
$headers = "From: $email\r\n"
         . "Reply-To: $email\r\n";

// Send email
$success = mail($to, $subject, $body, $headers);

// Redirect after submission
if ($success) {
    header('Location: contact.html?success=1');
} else {
    header('Location: contact.html?error=1');
}
exit;
?>
