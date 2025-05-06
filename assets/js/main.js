// Main JavaScript file for CyberSecure Hub

document.addEventListener('DOMContentLoaded', function() {
    // Enable Bootstrap tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Add smooth scrolling to all links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth'
                });
            }
        });
    });

    // Add confirmation for voting
    document.querySelectorAll('form[method="POST"]').forEach(form => {
        if (form.querySelector('input[name="vote"]')) {
            form.addEventListener('submit', function(e) {
                if (!confirm('Are you sure you want to submit this vote?')) {
                    e.preventDefault();
                }
            });
        }
    });

    // Add character counter for textareas
    document.querySelectorAll('textarea').forEach(textarea => {
        const maxLength = textarea.getAttribute('maxlength');
        if (maxLength) {
            const counter = document.createElement('div');
            counter.className = 'form-text text-end';
            textarea.parentNode.appendChild(counter);

            textarea.addEventListener('input', function() {
                const remaining = maxLength - this.value.length;
                counter.textContent = `${remaining} characters remaining`;
            });
        }
    });
}); 