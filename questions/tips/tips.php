<?php
require_once __DIR__ . '/../../includes/header.php';

$tips = [
    'Passwords' => [
        [
            'title' => 'Use Strong Passwords',
            'content' => 'Create passwords that are at least 12 characters long and include a mix of uppercase, lowercase, numbers, and special characters.'
        ],
        [
            'title' => 'Password Manager',
            'content' => 'Use a password manager to generate and store unique passwords for each of your accounts.'
        ],
        [
            'title' => 'Regular Updates',
            'content' => 'Change your passwords regularly, especially for critical accounts like banking and email.'
        ]
    ],
    'Phishing' => [
        [
            'title' => 'Check Email Addresses',
            'content' => 'Always verify the sender\'s email address. Legitimate companies use their domain names in email addresses.'
        ],
        [
            'title' => 'Don\'t Click Suspicious Links',
            'content' => 'Hover over links before clicking to see the actual URL. If it looks suspicious, don\'t click it.'
        ],
        [
            'title' => 'Verify Requests',
            'content' => 'If you receive an unexpected request for personal information, contact the company directly through their official channels.'
        ]
    ],
    'Safe Browsing' => [
        [
            'title' => 'Use HTTPS',
            'content' => 'Always look for the padlock icon and "https://" in the URL when entering sensitive information.'
        ],
        [
            'title' => 'Keep Software Updated',
            'content' => 'Regularly update your browser and operating system to patch security vulnerabilities.'
        ],
        [
            'title' => 'Use Ad Blockers',
            'content' => 'Consider using ad blockers and privacy extensions to prevent malicious ads and tracking.'
        ]
    ],
    'Public Wi-Fi Safety' => [
        [
            'title' => 'Use VPN',
            'content' => 'Always use a VPN when connecting to public Wi-Fi networks to encrypt your traffic.'
        ],
        [
            'title' => 'Avoid Sensitive Activities',
            'content' => 'Don\'t access banking or other sensitive accounts while on public Wi-Fi.'
        ],
        [
            'title' => 'Verify Network',
            'content' => 'Confirm the network name with staff before connecting to avoid connecting to malicious hotspots.'
        ]
    ]
];
?>

<div class="row">
    <div class="col-md-8">
        <h1 class="mb-4">Cybersecurity Tips</h1>
        
        <?php foreach ($tips as $category => $categoryTips): ?>
            <div class="card mb-4">
                <div class="card-header">
                    <h2 class="h4 mb-0"><?php echo $category; ?></h2>
                </div>
                <div class="card-body">
                    <?php foreach ($categoryTips as $tip): ?>
                        <div class="mb-4">
                            <h3 class="h5"><?php echo $tip['title']; ?></h3>
                            <p class="mb-0"><?php echo $tip['content']; ?></p>
                        </div>
                        <?php if (!$loop->last): ?>
                            <hr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h3 class="h5">Need More Help?</h3>
                <p>Have specific questions about cybersecurity? Our community is here to help!</p>
                <a href="/questions/ask.php" class="btn btn-primary">Ask a Question</a>
            </div>
        </div>
        
        <div class="card mt-4">
            <div class="card-body">
                <h3 class="h5">Stay Updated</h3>
                <p>Cybersecurity threats evolve constantly. Keep checking back for new tips and best practices.</p>
            </div>
        </div>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?> 