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
    $acara_id = $_POST["acara_id"]; // ID kategori
    $tamu_id = $_POST["tamu_id"]; // Konten postingan
    $tanggal_diundang = $_POST["tanggal_diundang"];

        $query = "INSERT INTO undangan (acara_id, tamu_id, tanggal_diundang) VALUES ('$acara_id', '$tamu_id','$tanggal_diundang')";
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
        header('Location: dashboard.php');
        exit();
    }

  
// Proses penghapusan postingan

   if (isset($_POST['delete'])){
    $undanganID = $_POST ['undanganID'];

    $exec = mysqli_query($conn, "DELETE FROM undangan WHERE undangan_id='$undanganID'");
    if ($exec) {
      $_SESSION['notification'] = [
        'type' => 'primary',
        'message' => 'undangan berhasil dihapus'
      ];
    } else {
      $_SESSION['notification']=[
         'type' => 'danger',
        'message' => 'gagal menghapus undangan'
      ];
    }
    header('Location: dashboard.php');
    exit();
   }

   if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])){
    $undanganID = $_POST ['undangan_id'];
    $acara_id = $_POST['acara_id'];
    $tamu_id = $_POST['tamu_id'];
    $tanggal_diundang = $_POST['tanggal_diundang'];
    $query = "UPDATE undangan SET acara_id = '$acara_id', tamu_id = '$tamu_id', tanggal_diundang = '$tanggal_diundang' WHERE undangan_id = $undanganID";
    $exec = mysqli_query($conn, $query);
    
    if ($conn->query($query)===TRUE){
      $_SESSION['notification'] = [
        'type' => 'primary',
        'message' => 'undangan berhasil dihapus'
      ];
    } else {
      $_SESSION['notification']=[
         'type' => 'danger',
        'message' => 'gagal menghapus undangan'
      ];
    }
    header('Location: dashboard.php');
    exit();
   }