<?php
session_start();
// Ambil data dari sesi
$user_Id = $_SESSION["user_id"];
$name = $_SESSION["name"];
$role = $_SESSION["role"];
// Ambil notifikasi jika ada, kemudian hapus dari sesi
$notification = $_SESSION['notification'] ?? null;
if ($notification) {
    unset($_SESSION['notification']);
}
/* Periksa apakah sesi username dan role sudah ada,
jika tidak arahkan ke halaman login */
if (empty($_SESSION["username"]) || empty($_SESSION["role"])) {
    $_SESSION['notification'] = [
        'type' => 'danger',
        'message' => 'Silakan Login Terlebih Dahulu!'
    ];
    header('Location: ./auth/login.php');
    exit(); // Pastikan script berhenti setelah pengalihan
}
?>