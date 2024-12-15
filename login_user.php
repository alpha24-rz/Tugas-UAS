<?php
session_start();
include('db.php');

// Mengambil data dari form login
$email = $_POST['email'];
$password = $_POST['password'];

// Mengecek apakah email terdaftar di database
$sql = "SELECT * FROM users WHERE email = '$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Mengambil data pengguna
    $user = $result->fetch_assoc();

    // Memeriksa apakah password sesuai
    if (password_verify($password, $user['password'])) {
        // Menyimpan data sesi
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['name'] = $user['name'];
        $_SESSION['email'] = $user['email'];

        // Redirect ke halaman utama setelah login berhasil
        header('Location: welcome.php');
    } else {
        echo "Invalid credentials. <a href='index.php'>Try again</a>";
    }
} else {
    echo "Email not found. <a href='index.php'>Try again</a>";
}

$conn->close();
?>