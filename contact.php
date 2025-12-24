<?php
// contact.php — simple email sender (works on most cPanel/Apache hosting).
// IMPORTANT: Configure $to email and your domain email properly.
$to = "hello@thehexer.site"; // change if needed
$subject_prefix = "[Thehexer Website] ";

function clean($s) {
  return trim(str_replace(array("\r","\n"), " ", $s));
}

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
  header("Location: /#contact");
  exit;
}

$name = clean($_POST["name"] ?? "");
$email = clean($_POST["email"] ?? "");
$phone = clean($_POST["phone"] ?? "");
$service = clean($_POST["service"] ?? "");
$message = trim($_POST["message"] ?? "");

if ($name === "" || $email === "" || $message === "") {
  header("Location: /#contact?error=1");
  exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  header("Location: /#contact?error=1");
  exit;
}

$subject = $subject_prefix . $service;
$body =
"Name: $name\n" .
"Email: $email\n" .
"Phone: $phone\n" .
"Service: $service\n\n" .
"Message:\n$message\n";

$headers = "From: ".$to."\r\n";
$headers .= "Reply-To: ".$email."\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

$ok = @mail($to, $subject, $body, $headers);

if ($ok) {
  header("Location: /#contact?sent=1");
} else {
  header("Location: /#contact?error=1");
}
exit;
?>