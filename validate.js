document.addEventListener('DOMContentLoaded', function() {
    const loginForm = document.getElementById('loginForm');

    loginForm.addEventListener('submit', function(e) {
        e.preventDefault();

        const email = document.getElementById('email').value;
        const password = document.getElementById('pwd').value;

        if (!isValidEmail(email) || !isValidPassword(password)) {
            displayError('Invalid email or password.');
        } else {
            submitCredentials(email, password);
        }
    });

    function isValidEmail(email) {
        return email.includes('@') && email.includes('.');
    }

    function isValidPassword(password) {
        return password.length >= 8 &&
               /[a-z]/.test(password) &&
               /[A-Z]/.test(password) &&
               /[0-9]/.test(password) &&
               /[\W_]/.test(password);
    }

    function displayError(message) {
        const errorModal = document.getElementById('errorModal');
        const modalBody = errorModal.querySelector('.modal-body p');
        modalBody.textContent = message;
        $('#errorModal').modal('show');
    }

    function submitCredentials(email, password) {
        fetch('login_processor.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'email=' + encodeURIComponent(email) + '&password=' + encodeURIComponent(password)
        })
        .then(response => response.text())
        .then(text => {
            if (text === 'Success') {
                window.location.href = 'profile.php';
            } else {
                displayError('Email or password is incorrect.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            displayError('There was a problem processing your login.');
        });
    }
});