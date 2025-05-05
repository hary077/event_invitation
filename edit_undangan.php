<?php
// Memasukkan file konfigurasi database
include 'config.php';

// Memasukkan header halaman
include '.includes/header.php';

// Mengambil ID postingan yang akan diedit dari parameter URL
// .../edit_post.php?post_id=
$undanganID = $_GET['undangan_id']; // Pastikan parameter 'post_id' ada di URL

// Query untuk mengambil data postingan berdasarkan ID
$query = "SELECT * FROM undangan WHERE undangan_id = $undanganID";
$result = $conn->query($query);

// Memeriksa apakah data postingan ditemukan
if ($result->num_rows > 0) {
    $post = $result->fetch_assoc(); // Mengambil data postingan ke dalam array
} else {
    // Menampilkan pesan jika postingan tidak ditemukan
    echo "Post not found.";
    exit(); // Menghentikan eksekusi jika tidak ada postingan
}
?>

<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Judul halaman -->
    <div class="row">
        <!-- Form untuk menambahkan postingan baru -->
        <div class="col-md-10">
            <div class="card mb-4">
                <div class="card-body">
                    <form method="POST" action="proses_undangan.php" enctype="multipart/form-data">
                        <input type="hidden" name="undangan_id" value="<?php echo $undanganID; ?>">
                        <div class="mb-3">
                            <label for="nama_acara" class="form-label">Nama Acara</label>
                            <select class="form-select" name="acara_id" required>
                                <option value="" selected disabled>Pilih salah satu</option>
             <?php
                                $query = "SELECT * FROM acara"; // Query untuk mengambil data kategori
                                $result = $conn->query($query); // Menjalankan query
                                if ($result->num_rows > 0) { // Jika terdapat data kategori
                                    while ($row = $result->fetch_assoc()) { // Iterasi setiap kategori
                                        echo "<option value='" . $row["acara_id"] . "'>" . $row["nama_acara"]. "</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <!-- Input untuk judul postingan -->
                        <div class="mb-3">
                            <label for="nama_acara" class="form-label">Nama Tamu</label>
                            <select class="form-select" name="tamu_id" required>
                                <option value="" selected disabled>Pilih salah satu</option>
             <?php
                                $query = "SELECT * FROM tamu"; // Query untuk mengambil data kategori
                                $result = $conn->query($query); // Menjalankan query
                                if ($result->num_rows > 0) { // Jika terdapat data kategori
                                    while ($row = $result->fetch_assoc()) { // Iterasi setiap kategori
                                        echo "<option value='" . $row["tamu_id"] . "'>" . $row["namatamu"]. "</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <!-- Input untuk mengunggah gambar -->

                        <!-- Dropdown untuk memilih kategori -->
                       <div class="mb-3">
                        <label for="tgl_acara"class="form-label">Tanggal Diundang</label>
                        <input type="date" class="form-control" name="tanggal_diundang" required>
                       </div>
                        <!-- Textarea untuk konten postingan -->
                        <!-- Tombol submit -->
                        <button type="submit" name="update" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
// Memasukkan footer halaman
include '.includes/footer.php';
?>
