<?php
// CHANGE THIS to your real email address:
$to = "you@example.com";

if ($_SERVER["REQUEST_METHOD"] !== "POST" || !empty($_POST["website"])) { // honeypot field
    header("Location: index.html"); exit;
}

function clean($v) { return trim(strip_tags(str_replace(["\r", "\n"], " ", (string)$v))); }

$name     = clean($_POST["name"] ?? "");
$phone    = clean($_POST["phone"] ?? "");
$checkin  = clean($_POST["checkin"] ?? "");
$checkout = clean($_POST["checkout"] ?? "");
$guests   = clean($_POST["guests"] ?? "");
$message  = strip_tags((string)($_POST["message"] ?? ""));

if ($name === "" || $phone === "" || $checkin === "" || $checkout === "") {
    header("Location: index.html#book"); exit;
}

$body = "Name: $name\nPhone: $phone\nCheck-in: $checkin\nCheck-out: $checkout\nGuests: $guests\n\nMessage:\n$message\n";
$headers = "Content-Type: text/plain; charset=UTF-8\r\n";

mail($to, "Booking request from $name", $body, $headers);

header("Location: index.html?sent=1#book");
exit;
