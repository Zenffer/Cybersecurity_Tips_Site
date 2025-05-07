<?php
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

<!-- About Section -->
<div class="row mt-5">
    <div class="col-md-12">
        <div class="card bg-light mb-4">
            <div class="card-body">
                <h2 class="card-title">About CyberSecure Hub</h2>
                <p>CyberSecure Hub is a community-driven platform dedicated to making cybersecurity knowledge accessible to everyone. Whether you're a beginner or an expert, you can ask questions, share answers, and help others stay safe online.</p>
            </div>
        </div>
    </div>
</div>

<!-- How It Works Section -->
<div class="row mb-5">
    <div class="col-md-4">
        <div class="card h-100">
            <div class="card-body text-center">
                <h3 class="card-title">1. Ask</h3>
                <p>Have a cybersecurity question? Post it and get answers from the community.</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card h-100">
            <div class="card-body text-center">
                <h3 class="card-title">2. Answer</h3>
                <p>Share your knowledge by answering questions and helping others stay secure.</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card h-100">
            <div class="card-body text-center">
                <h3 class="card-title">3. Vote</h3>
                <p>Upvote helpful answers so the best advice rises to the top.</p>
            </div>
        </div>
    </div>
</div>

<!-- Featured Tip Section -->
<div class="row mb-5">
    <div class="col-md-12">
        <div class="alert alert-info text-center">
            <strong>Featured Tip:</strong> Never reuse passwords across multiple sites. If one site is breached, all your accounts could be at risk!
        </div>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?> 