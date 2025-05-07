<?php
// Database configuration
$host = 'localhost';
$dbname = 'cybersecure_hub';
$username = 'root';
$password = '';

try {
    // First connect without database to create it if it doesn't exist
    $pdo = new PDO("mysql:host=$host", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Create database if it doesn't exist
    $pdo->exec("CREATE DATABASE IF NOT EXISTS $dbname");
    
    // Connect to the database
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    
    // Create tables if they don't exist
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS questions (
            id INT AUTO_INCREMENT PRIMARY KEY,
            title TEXT NOT NULL,
            description TEXT,
            user_id INT,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP
        );
        
        CREATE TABLE IF NOT EXISTS answers (
            id INT AUTO_INCREMENT PRIMARY KEY,
            question_id INT NOT NULL,
            answer_text TEXT NOT NULL,
            user_id INT,
            votes INT DEFAULT 0,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (question_id) REFERENCES questions(id) ON DELETE CASCADE
        );
        
        CREATE TABLE IF NOT EXISTS votes (
            id INT AUTO_INCREMENT PRIMARY KEY,
            answer_id INT NOT NULL,
            user_id INT NOT NULL,
            vote_type ENUM('up', 'down') NOT NULL,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (answer_id) REFERENCES answers(id) ON DELETE CASCADE
        );
    ");
    
    // Check if we need to insert sample data
    $stmt = $pdo->query("SELECT COUNT(*) FROM questions");
    $questionCount = $stmt->fetchColumn();
    
    if ($questionCount == 0) {
        // Insert sample questions
        $pdo->exec("
            INSERT INTO questions (title, description) VALUES
            ('How to create a strong password?', 'What are the best practices for creating a strong password that is both secure and memorable?'),
            ('Is public Wi-Fi safe to use?', 'I often use public Wi-Fi at coffee shops. What security measures should I take?'),
            ('What is two-factor authentication?', 'Can someone explain what 2FA is and why it\'s important?')
        ");
        
        // Insert sample answers
        $pdo->exec("
            INSERT INTO answers (question_id, answer_text) VALUES
            (1, 'A strong password should be at least 12 characters long and include a mix of uppercase, lowercase, numbers, and special characters. Consider using a passphrase instead of a single word.'),
            (1, 'Use a password manager to generate and store unique passwords for each account. This way, you only need to remember one master password.'),
            (2, 'Public Wi-Fi is generally not safe. Always use a VPN when connecting to public networks, and avoid accessing sensitive information like banking websites.'),
            (3, 'Two-factor authentication adds an extra layer of security by requiring a second form of verification (like a code sent to your phone) in addition to your password.')
        ");
    }
    
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?> 