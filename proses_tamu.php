<?php
// Menghubungkan file konfigurasi database
include 'config.php';

// Memulai sesi PHP
session_start();

// Mendapatkan ID pengguna dari sesi
$user_Id = $_SESSION["user_id"];

// Menangani form untuk menambahkan postingan baru
if (isset($_POST['simpan'])) {
    // Mendapatkan data dari form
    // $tamu_id = $_POST["tamu_id"]; // Judul postingan
    $nama_tamu = $_POST["namatamu"]; // Konten postingan
    $email = $_POST["email"]; // ID kategori
    if (isset($_POST['status_kehadiran'])){
      $status_kehadiran = $_POST["status_kehadiran"];
  }

        $query = "INSERT INTO tamu ( namatamu, email, status_kehadiran) VALUES ('$nama_tamu', '$email','$status_kehadiran')";
        if ($conn->query($query) === TRUE) {
            $_SESSION['notification'] = [
                'type' => 'primary',
                'message' => 'Post succesfully added.'
            ];
        } else {
            $_SESSION['notification'] = [
                'type' => 'danger',
                'message' => 'Error adding post: ' . $conn->error
            ];
        }
        
            header('Location: tamu.php');
            exit();
    }

// Proses penghapusan postingan

    if (isset($_POST['delete'])) {
        $tamu_id = $_POST['tamu_id'];

        // Query untuk menghapus post berdasarkan ID
        $exec = mysqli_query($conn, "DELETE FROM tamu WHERE tamu_id='$tamu_id'");

        if ($exec) {
            $_SESSION['notification'] = [
                'message' => 'Post successfully deleted.',
                'type' => 'primary',
            ];
        } else {
            $_SESSION['notification'] = [
                'message' => 'Error deleting post: ' . mysqli_error($conn),
                'type' => 'danger',
            ];
        }

        // Redirect kembali ke halaman dashboard
        header('Location: tamu.php');
        exit();
    }
// Mengangani pembaruan data postingan
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['update'])) {
  // Mendapatkan data dari form
  $tamuID = $_POST['tamu_id'];
  $nama_tamu = $_POST["namatamu"]; // Konten postingan
    $email = $_POST["email"]; // ID kategori
    if (isset($_POST['status_kehadiran'])){
      $status_kehadiran = $_POST["status_kehadiran"];
    }

  // Update data postingan di database
  $queryUpdate = "UPDATE tamu SET namatamu = '$nama_tamu', email = '$email', status_kehadiran = '$status_kehadiran' WHERE tamu_id = '$tamuID'";
  $conn->query($queryUpdate);

  if ($conn->query($queryUpdate) === TRUE) {
    // Session notifikasi
    $_SESSION['notification'] = [
      'type' => 'primary',
      'message' => 'Postingkan berhasil diperbarui.'
    ];
  } else {
    // Session notifikasi gagal
  $_SESSION['notification'] = [
    'type' => 'danger',
    'message' => 'gagal memperbarui postingan.'
  ];
}
//arahkan ke halaman dashboard
header ('Location: tamu.php');
exit();
}