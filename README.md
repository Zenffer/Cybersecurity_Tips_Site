# CyberSecure Hub

A community-driven platform for cybersecurity knowledge sharing and Q&A.

## Features

- Ask and answer cybersecurity questions
- Vote on answers (upvote/downvote)
- Browse questions with sorting options
- View curated cybersecurity tips
- Modern, responsive design
- No login required

## Requirements

- PHP 7.4 or higher
- MySQL 5.7 or higher
- Apache/Nginx web server
- mod_rewrite enabled (for Apache)

## Installation

1. Clone the repository to your web server directory:
   ```bash
   git clone https://github.com/yourusername/cybersecure-hub.git
   ```

2. Create a MySQL database and import the schema:
   ```sql
   CREATE DATABASE cybersecure_hub;
   USE cybersecure_hub;
   
   CREATE TABLE questions (
     id INT AUTO_INCREMENT PRIMARY KEY,
     title TEXT NOT NULL,
     description TEXT,
     user_id INT,
     created_at DATETIME DEFAULT CURRENT_TIMESTAMP
   );
   
   CREATE TABLE answers (
     id INT AUTO_INCREMENT PRIMARY KEY,
     question_id INT NOT NULL,
     answer_text TEXT NOT NULL,
     user_id INT,
     votes INT DEFAULT 0,
     created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
     FOREIGN KEY (question_id) REFERENCES questions(id)
   );
   
   CREATE TABLE votes (
     id INT AUTO_INCREMENT PRIMARY KEY,
     answer_id INT NOT NULL,
     user_id INT NOT NULL,
     vote_type ENUM('up', 'down') NOT NULL,
     FOREIGN KEY (answer_id) REFERENCES answers(id)
   );
   ```

3. Configure the database connection:
   - Open `includes/db.php`
   - Update the database credentials:
     ```php
     $host = 'localhost';
     $dbname = 'cybersecure_hub';
     $username = 'your_username';
     $password = 'your_password';
     ```

4. Set proper permissions:
   ```bash
   chmod 755 -R /path/to/cybersecure-hub
   chmod 777 -R /path/to/cybersecure-hub/assets/uploads
   ```

5. Configure your web server:
   - For Apache, ensure mod_rewrite is enabled
   - Point your web server to the project directory
   - Set the document root to the project directory

## Directory Structure

```
/cybersecure-hub
│
├── /assets
│   ├── /css/style.css
│   ├── /js/main.js
│   └── /img/logo.png
│
├── /includes
│   ├── db.php            # Database connection
│   ├── header.php        # Top navigation + branding
│   ├── footer.php        # Footer content
│   └── functions.php     # Helper functions
│
├── /questions
│   ├── ask.php           # Submit a new question
│   ├── view.php          # View and answer a question
│   └── list.php          # Browse questions
│
├── /tips
│   └── tips.php          # Static/dynamic cybersecurity tips
│
├── index.php             # Homepage
└── README.md            # This file
```

## Usage

1. Visit the homepage to see featured questions and tips
2. Click "Ask a Question" to post a new question
3. Browse questions using the "Browse Questions" link
4. View and contribute to answers on question pages
5. Check out the cybersecurity tips for best practices

## Contributing

1. Fork the repository
2. Create a feature branch
3. Commit your changes
4. Push to the branch
5. Create a Pull Request

## License

This project is licensed under the MIT License - see the LICENSE file for details.

## Security

- All user input is sanitized
- SQL injection prevention using prepared statements
- XSS protection through output escaping
- CSRF protection on forms

## Support

For support, please open an issue in the GitHub repository or contact the maintainers. 