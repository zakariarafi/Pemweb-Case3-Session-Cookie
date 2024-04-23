<?php
session_start();

// Fungsi untuk memeriksa apakah pengguna sudah login
function checkLogin() {
    return isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] === true;
}

// Mengarahkan kembali ke login.html jika pengguna belum login
if (!checkLogin()) {
    header('Location: login.html');
    exit;
}

// Menghandle proses logout
if (isset($_GET['logout'])) {
    // Hapus data session
    session_unset();
    session_destroy();

    // Hapus cookie jika ada
    if (isset($_COOKIE['rememberEmail'])) {
        setcookie('rememberEmail', '', time() - 3600, "/"); // Menghapus cookie
    }

    // Redirect ke halaman login
    header('Location: login.html');
    exit;
}

// Mendapatkan email dari session untuk ditampilkan
$email = $_SESSION['email'] ?? 'No email set';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <header>
        <div class="header">
        <h3>Profile Page</h3>
        </div>
    </header>
    <div class="container">
        <h1 class="mt-5">Profile Page</h1>
        <p>Welcome, <strong><?php echo htmlspecialchars($email); ?></strong></p>
        <p>This is your profile page. You can see your details here.</p>
        
        <!-- Logout Link -->
        <a href="?logout=true" class="btn btn-danger">Logout</a>
    </div>

    <footer class="footer">
        <div class="identitskelompok">
        <div class="kelompok">Nama Anggota Kelompok</div>
        <div class="anggotakelompok"></div>
        <div class="anggota1">
        <span>
        <span class="anggota1-span">Jonathan Pande Parade Damanik</span>
        
        <span class="anggota1-span2">225150407111012</span>
        </span>
        </div>
        <div class="anggota2">
        <span>
        <span class="anggota2-span">Rubens Willsandro Taimenas </span>
        
        <span class="anggota2-span2">225150407111030</span>
        </span>
        </div>
        <div class="anggota3">
        <span>
        <span class="anggota3-span">Zakaria Rafi </span>
        
        <span class="anggota3-span2">225150407111020</span>
        </span>
        </span>
        </div>
        <div class="line"></div>
        <div class="copyright">Created by Kelompok 5 - PEMROGRAMAN WEB KELAS SI E</div>
        </div>
    </footer>
</body>
</html>