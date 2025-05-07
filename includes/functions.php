<?php
require_once 'db.php';

function getTopQuestions($limit = 5) {
    global $pdo;
    $stmt = $pdo->prepare("
        SELECT q.*, COUNT(a.id) as answer_count 
        FROM questions q 
        LEFT JOIN answers a ON q.id = a.question_id 
        GROUP BY q.id 
        ORDER BY answer_count DESC 
        LIMIT :limit
    ");
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll();
}

function getQuestionById($id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM questions WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch();
}

function getAnswersForQuestion($questionId) {
    global $pdo;
    $stmt = $pdo->prepare("
        SELECT a.*, 
        (SELECT COUNT(*) FROM votes WHERE answer_id = a.id AND vote_type = 'up') as upvotes,
        (SELECT COUNT(*) FROM votes WHERE answer_id = a.id AND vote_type = 'down') as downvotes
        FROM answers a 
        WHERE a.question_id = ? 
        ORDER BY (upvotes - downvotes) DESC
    ");
    $stmt->execute([$questionId]);
    return $stmt->fetchAll();
}

function formatDate($date) {
    return date('F j, Y, g:i a', strtotime($date));
}

function sanitizeInput($input) {
    return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
}
?> 