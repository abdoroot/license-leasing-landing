<?php

header('Content-Type: application/json');

// Only allow POST requests from the same server
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['status' => 'error', 'message' => 'Method Not Allowed']);
    exit;
}


// Sanitize and format POST data
$postData = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

if (!$postData || empty($postData)) {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'No POST data received']);
    exit;
}

$to = 'abd.200930@gmail.com';
$subject = 'readydubailicense.com lead';
$from = 'info@readydubailicense.com';

// Format the body
$body = "new lead form data:\n\n";
foreach ($postData as $key => $value) {
    $body .= ucfirst($key) . ": " . $value . "\n";
}

// Email headers
$headers = "From: $from\r\n";
$headers .= "Reply-To: $from\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

// Send the email
$sent = mail($to, $subject, $body, $headers);

// Respond in JSON
if ($sent) {
    echo json_encode(['status' => 'success', 'message' => 'Email sent successfully']);
} else {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => 'Failed to send email']);
}