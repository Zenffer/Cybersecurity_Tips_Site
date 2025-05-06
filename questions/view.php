<?php
require_once '../includes/header.php';
require_once '../includes/functions.php';

$questionId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$questionId) {
    header('Location: list.php');
    exit;
}

$question = getQuestionById($questionId);
if (!$question) {
    header('Location: list.php');
    exit;
}

$answers = getAnswersForQuestion($questionId);

// Handle answer submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['answer_text'])) {
    $answerText = sanitizeInput($_POST['answer_text']);
    if (!empty($answerText)) {
        try {
            $stmt = $pdo->prepare("INSERT INTO answers (question_id, answer_text) VALUES (?, ?)");
            $stmt->execute([$questionId, $answerText]);
            header("Location: view.php?id=$questionId");
            exit;
        } catch (PDOException $e) {
            $error = "An error occurred while posting your answer.";
        }
    }
}

// Handle voting
if (isset($_POST['vote']) && isset($_POST['answer_id'])) {
    $answerId = filter_input(INPUT_POST, 'answer_id', FILTER_VALIDATE_INT);
    $voteType = $_POST['vote'] === 'up' ? 'up' : 'down';
    
    try {
        $stmt = $pdo->prepare("INSERT INTO votes (answer_id, vote_type) VALUES (?, ?)");
        $stmt->execute([$answerId, $voteType]);
        header("Location: view.php?id=$questionId");
        exit;
    } catch (PDOException $e) {
        $error = "An error occurred while processing your vote.";
    }
}
?>

<div class="row">
    <div class="col-md-8">
        <h1 class="mb-4"><?php echo sanitizeInput($question['title']); ?></h1>
        
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        
        <div class="card mb-4">
            <div class="card-body">
                <p class="card-text"><?php echo nl2br(sanitizeInput($question['description'])); ?></p>
                <small class="text-muted">Asked <?php echo formatDate($question['created_at']); ?></small>
            </div>
        </div>
        
        <h2 class="mb-3">Answers</h2>
        
        <?php if ($answers): ?>
            <?php foreach ($answers as $answer): ?>
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="me-3 text-center">
                                <form method="POST" class="d-inline">
                                    <input type="hidden" name="answer_id" value="<?php echo $answer['id']; ?>">
                                    <button type="submit" name="vote" value="up" class="btn btn-sm btn-outline-secondary">
                                        ▲ <?php echo $answer['upvotes']; ?>
                                    </button>
                                </form>
                                <form method="POST" class="d-inline">
                                    <input type="hidden" name="answer_id" value="<?php echo $answer['id']; ?>">
                                    <button type="submit" name="vote" value="down" class="btn btn-sm btn-outline-secondary">
                                        ▼ <?php echo $answer['downvotes']; ?>
                                    </button>
                                </form>
                            </div>
                            <div>
                                <p class="card-text"><?php echo nl2br(sanitizeInput($answer['answer_text'])); ?></p>
                                <small class="text-muted">Posted <?php echo formatDate($answer['created_at']); ?></small>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No answers yet. Be the first to answer!</p>
        <?php endif; ?>
        
        <div class="card mt-4">
            <div class="card-body">
                <h3 class="card-title">Your Answer</h3>
                <form method="POST">
                    <div class="mb-3">
                        <textarea class="form-control" name="answer_text" rows="4" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Post Answer</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?> 