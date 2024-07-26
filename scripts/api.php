<?php

require '../config/Database.php';
require '../config/OAuth2Server.php';
require '../queue/Queue.php'; // Assuming you have a Queue class or handling

// Initialize database connection
$db = new Database();
$pdo = $db->connect();

// Initialize OAuth2 server
$oauth2 = new OAuth2Server();

// Check OAuth2 Token
if (!$oauth2->isAuthorized()) {
    http_response_code(401);
    echo json_encode(['error' => 'Unauthorized']);
    exit;
}

// API to send email
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    $recipient = $data['recipient'] ?? '';
    $subject = $data['subject'] ?? '';
    $body = $data['body'] ?? '';

    if (empty($recipient) || empty($subject) || empty($body)) {
        http_response_code(400);
        echo json_encode(['error' => 'Invalid input']);
        exit;
    }

    // Store email in the database
    $stmt = $pdo->prepare("INSERT INTO emails (recipient, subject, body) VALUES (?, ?, ?)");
    $stmt->execute([$recipient, $subject, $body]);

    // Add to the queue
    $queue = new Queue();
    $queue->enqueue([
        'recipient' => $recipient,
        'subject' => $subject,
        'body' => $body
    ]);

    echo json_encode(['success' => 'Email scheduled']);
} else {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
}
