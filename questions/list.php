<?php
require_once '../includes/header.php';
require_once '../includes/functions.php';

// Get sort parameter
$sort = $_GET['sort'] ?? 'newest';
$orderBy = match($sort) {
    'newest' => 'created_at DESC',
    'oldest' => 'created_at ASC',
    'most_answered' => 'answer_count DESC',
    default => 'created_at DESC'
};

// Get all questions with answer counts
$stmt = $pdo->prepare("
    SELECT q.*, COUNT(a.id) as answer_count 
    FROM questions q 
    LEFT JOIN answers a ON q.id = a.question_id 
    GROUP BY q.id 
    ORDER BY $orderBy
");
$stmt->execute();
$questions = $stmt->fetchAll();
?>

<div class="row">
    <div class="col-md-8">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>All Questions</h1>
            <div class="btn-group">
                <a href="?sort=newest" class="btn btn-outline-secondary <?php echo $sort === 'newest' ? 'active' : ''; ?>">Newest</a>
                <a href="?sort=oldest" class="btn btn-outline-secondary <?php echo $sort === 'oldest' ? 'active' : ''; ?>">Oldest</a>
                <a href="?sort=most_answered" class="btn btn-outline-secondary <?php echo $sort === 'most_answered' ? 'active' : ''; ?>">Most Answered</a>
            </div>
        </div>
        
        <?php if ($questions): ?>
            <div class="list-group">
                <?php foreach ($questions as $question): ?>
                    <a href="view.php?id=<?php echo $question['id']; ?>" class="list-group-item list-group-item-action">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1"><?php echo sanitizeInput($question['title']); ?></h5>
                            <small class="text-muted">
                                <?php echo $question['answer_count']; ?> answers
                            </small>
                        </div>
                        <p class="mb-1"><?php echo substr(sanitizeInput($question['description']), 0, 150) . '...'; ?></p>
                        <small class="text-muted">Asked <?php echo formatDate($question['created_at']); ?></small>
                    </a>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="alert alert-info">
                No questions have been asked yet. 
                <a href="ask.php" class="alert-link">Be the first to ask!</a>
            </div>
        <?php endif; ?>
    </div>
    
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Ask a Question</h5>
                <p class="card-text">Have a cybersecurity question? Ask the community!</p>
                <a href="ask.php" class="btn btn-primary">Ask Now</a>
            </div>
        </div>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?> 