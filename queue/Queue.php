<?php

class Queue {
    private $queueFile = 'queue.txt'; // Path to the queue file

    public function enqueue($message) {
        // Append the new message to the queue file
        file_put_contents($this->queueFile, json_encode($message) . PHP_EOL, FILE_APPEND);
    }

    public function dequeue() {
        if (file_exists($this->queueFile)) {
            $lines = file($this->queueFile);
            if (count($lines) > 0) {
                // Get the first line (oldest message)
                $message = array_shift($lines);
                file_put_contents($this->queueFile, implode('', $lines)); // Rewrite the file without the first line
                return json_decode($message, true);
            }
        }
        return null;
    }

    public function isEmpty() {
        return !file_exists($this->queueFile) || filesize($this->queueFile) === 0;
    }
}
