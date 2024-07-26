<?php

require '../config/Database.php';
require '../queue/Queue.php'; // Assuming you have a Queue class or handling

// Initialize database connection
$db = new Database();
$pdo = $db->connect();

function sendEmail($recipient, $subject, $body) {
    // Implement your email sending logic here
    return mail($recipient, $subject, $body);
}

// Process queue
$queueFile = '../queue/queue.txt'; // Adjust path as needed
if (file_exists($queueFile)) {
    $lines = file($queueFile);
    foreach ($lines as $line) {
        $message = json_decode($line, true);
        if (sendEmail($message['recipient'], $message['subject'], $message['body'])) {
            // Update status in database
            $stmt = $pdo->prepare("UPDATE emails SET status = 'sent' WHERE recipient = ? AND subject = ? AND body = ?");
            $stmt->execute([$message['recipient'], $message['subject'], $message['body']]);
        } else {
            // Handle failure
        }
    }
    // Clear the queue
    file_put_contents($queueFile, '');
}
