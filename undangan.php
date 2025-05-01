<?php
// Menyertakan header halaman
include '.includes/header.php';
?>
<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Judul halaman -->
    <div class="row">
        <!-- Form untuk menambahkan postingan baru -->
        <div class="col-md-10">
            <div class="card mb-4">
                <div class="card-body">
                    <form method="POST" action="proses_undangan.php" enctype="multipart/form-data">
                        <!-- Input untuk judul postingan -->
                        <div class="mb-3">
                            <label for="namatamu" class="form-label">Nama Tamu</label>
                            <input type="text" class="form-control" name="namatamu" required>
                        </div>
                        <!-- Input untuk mengunggah gambar -->

                        <!-- Dropdown untuk memilih kategori -->
                        <div class="mb-3">
                            <label for="nama_acara" class="form-label">Nama Acara</label>
                            <select class="form-select" name="nama_acara" required>
                                <option value="" selected disabled>Pilih salah satu</option>
             <?php
                                $query = "SELECT * FROM acara"; // Query untuk mengambil data kategori
                                $result = $conn->query($query); // Menjalankan query
                                if ($result->num_rows > 0) { // Jika terdapat data kategori
                                    while ($row = $result->fetch_assoc()) { // Iterasi setiap kategori
                                        echo "<option value='" . $row["acara_id"] . "'>" . $row["nama_acara"] . " / ". $row["tgl_acara"] .  " / ". $row["lokasi_acara"] . "</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md">
                            <label class="from-label">Status Kehadiran</label>
                            <div class="form-check mt-3">
                                <input name="status_kehadiran" class="form-check-input" type="radio" value="" id="defaultRadio1">
                                <label class="form-check-label" for="defaultRadio1"> HADIR </label>
                            </div>
                            <div class="form-check mt-3">
                                <input name="status_kehadiran" class="form-check-input" type="radio" value="" id="defaultRadio1">
                                <label class="form-check-label" for="defaultRadio1"> TIDAK HADIR </label>
                            </div>
                            <div class="form-check mt-3">
                                <input name="status_kehadiran" class="form-check-input" type="radio" value="" id="defaultRadio1">
                                <label class="form-check-label" for="defaultRadio1"> RAGU-RAGU </label>
                            </div>
                          </div>
                          <label for="acara_id" class="form-label">Email</label>
                          <input type="email" class="form-control" name="email" placeholder="name@example.com">
                        <!-- Textarea untuk konten postingan -->
                        <!-- Tombol submit -->
                        <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
// Menyertakan footer halaman
include '.includes/footer.php';
?>