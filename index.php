<?php
require_once __DIR__ . '/db.php';
require_once 'includes/header.php';
require_once 'includes/functions.php';

$topQuestions = getTopQuestions(5);
?>

<div class="row">
    <div class="col-md-8">
        <h1 class="mb-4">Welcome to CyberSecure Hub</h1>
        <p class="lead">Your trusted community for cybersecurity knowledge sharing and learning.</p>
        
        <div class="card mb-4">
            <div class="card-body">
                <h2 class="card-title">Top Questions</h2>
                <?php if ($topQuestions): ?>
                    <div class="list-group">
                        <?php foreach ($topQuestions as $question): ?>
                            <a href="questions/view.php?id=<?php echo $question['id']; ?>" class="list-group-item list-group-item-action">
                                <h5 class="mb-1"><?php echo sanitizeInput($question['title']); ?></h5>
                                <small class="text-muted">
                                    <?php echo $question['answer_count']; ?> answers • 
                                    Posted <?php echo formatDate($question['created_at']); ?>
                                </small>
                            </a>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p>No questions yet. Be the first to ask!</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Quick Security Tips</h3>
                <ul class="list-unstyled">
                    <li class="mb-2">🔒 Use strong, unique passwords for each account</li>
                    <li class="mb-2">🔐 Enable two-factor authentication when available</li>
                    <li class="mb-2">📱 Keep your software and devices updated</li>
                    <li class="mb-2">🔍 Be cautious of suspicious emails and links</li>
                </ul>
                <a href="questions/tips/tips.php" class="btn btn-primary">View All Tips</a>
            </div>
        </div>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?> 