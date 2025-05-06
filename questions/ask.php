<?php
require_once '../includes/header.php';
require_once '../includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = sanitizeInput($_POST['title'] ?? '');
    $description = sanitizeInput($_POST['description'] ?? '');
    
    if (empty($title) || empty($description)) {
        $error = "Please fill in all fields.";
    } else {
        try {
            $stmt = $pdo->prepare("INSERT INTO questions (title, description) VALUES (?, ?)");
            $stmt->execute([$title, $description]);
            header("Location: view.php?id=" . $pdo->lastInsertId());
            exit;
        } catch (PDOException $e) {
            $error = "An error occurred. Please try again.";
        }
    }
}
?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <h1 class="mb-4">Ask a Question</h1>
        
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        
        <div class="card">
            <div class="card-body">
                <form method="POST" action="">
                    <div class="mb-3">
                        <label for="title" class="form-label">Question Title</label>
                        <input type="text" class="form-control" id="title" name="title" required
                               value="<?php echo isset($_POST['title']) ? htmlspecialchars($_POST['title']) : ''; ?>">
                        <div class="form-text">Be specific and clear in your question title.</div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="5" required><?php 
                            echo isset($_POST['description']) ? htmlspecialchars($_POST['description']) : ''; 
                        ?></textarea>
                        <div class="form-text">Provide details about your question. What have you tried? What are you trying to achieve?</div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Submit Question</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?> 