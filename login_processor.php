<?php
session_start();

// Data email dan password yang diharapkan untuk contoh (biasanya ini akan diambil dari database)
$expectedEmail = 'pemweb@gmail.com';
$expectedPassword = 'Secure123!';

// Mengambil data dari request POST
$email = isset($_POST['email']) ? $_POST['email'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';

// Fungsi untuk memverifikasi email dan password
function validateCredentials($email, $password, $expectedEmail, $expectedPassword) {
    return $email === $expectedEmail && $password === $expectedPassword;
}

// Memeriksa dan menanggapi AJAX request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (validateCredentials($email, $password, $expectedEmail, $expectedPassword)) {
        $_SESSION['isLoggedIn'] = true;
        $_SESSION['email'] = $email;

        // Mengecek dan mengatur cookie jika "Remember me" dicentang
        if (!empty($_POST['remember'])) {
            setcookie('rememberEmail', $email, time() + 86400 * 30, "/"); // Set for 30 days
        }

        echo 'Success';
    } else {
        session_unset();
        session_destroy();
        echo 'Invalid credentials';
    }
} else {
    echo 'Invalid request method';
}
?>