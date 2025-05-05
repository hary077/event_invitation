<?php
// Memasukkan header halaman
include '.includes/header.php';
// Menyertakan file untuk menampilkan notifikasi (jika ada)
include '.includes/toast_notification.php';
?>

<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Tabel data kategori -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>Data Acara</h4>
            <!-- Tombol untuk menambah kategori baru -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAcara">
                Tambah Acara
            </button>
        </div>
<div class="card-body">
<div class="table-responsive text-nowrap">
<table id="datatable" class="table table-hover">
<thead>
<tr class="text-center">
<th width="50px">#</th>
<th>Nama</th>
<th>Tanggal</th>
<th>Lokasi</th>
<th>Deskripsi</th>
<th width="150px">Pilihan</th>
</tr>
</thead>
<tbody class="table-border-bottom-0">


<!-- Mengambil data kategori dari database -->
<?php
$index = 1;
$query = "SELECT * FROM acara";
$exec = mysqli_query($conn, $query); // Pastikan $conn sudah didefinisikan (koneksi database)

while ($acara = mysqli_fetch_assoc($exec)): 
?>
    <tr>
        <!-- menampilkan nomor kategori, dan opsi -->
        <td><?= $index++; ?></td>
         <td><?= $acara['nama_acara']; ?></td> 
         <td><?= $acara['tgl_acara']; ?></td> 
         <td><?= $acara['lokasi_acara']; ?></td> 
         <td><?= $acara['deskripsi']; ?></td> 


         <td>
            <!-- dropdown untuk opsi edit dan delete -->
            <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                    <i class="bx bx-dots-vertical-rounded"></i>
                 </button>
                <div class="dropdown-menu">
                    <a href="#" class="dropdown-item" data-bs-toggle="modal"
                     data-bs-target="#editAcara_<?= $acara['acara_id']; ?>">
                        <i class="bx bx-edit-alt me-2"></i> Edit
                    </a>
                    <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#deleteAcara_<?= $acara['acara_id']; ?>">
                        <i class="bx bx-trash me-2"></i> Delete</a>
                </div>
            </div>
        </td>

    </tr>
<!-- modal untuk hapus data kategori -->
<div class="modal fade" id="deleteAcara_<?= $acara['acara_id']; ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Hapus Acara?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="proses_acara.php" method="POST">
                    <div>
                        <p>Tindakan ini tidak bisa dibatalkan.</p>
                        <input type="hidden" name="acara_id" value="<?= $acara['acara_id']; ?>">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" name="delete" class="btn btn-primary">Hapus</button>
            </div>
                </form>
        </div>
    </div>
</div>
 <!-- modal untuk update kategory -->
 <div id="editAcara_<?= $acara['acara_id']; ?>" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Data Acara</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="proses_acara.php" method="POST">
                    <input type="hidden" name="acara_id" value="<?= $acara['acara_id']; ?>">
                    <div class="modal-body">
                    <div class="mb-3">
                        <label for="nama_acara" class="form-label">Nama Acara</label>
                        <input type="text" class="form-control" name="nama_acara" required>
                    </div>
                    <div class="mb-3">
                        <label for="tgl_acara" class="form-label">Tanggal Acara</label>
                        <input type="date" class="form-control" name="tgl_acara" required>
                    </div>
                    <div class="mb-3">
                        <label for="lokasi_acara" class="form-label">Lokasi</label>
                        <input type="text" class="form-control" name="lokasi_acara" required>
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <input type="text" class="form-control" name="deskripsi" required>
                    </div>
                  
                </form>
            </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" name="update" class="btn btn-warning">Update</button>
                </div>
                </form>
            </div>
        </div>
    </div>    
</div>

<?php endwhile; ?>
</tbody>
</table>
</div>
</div>
</div>
</div>
<?php include '.includes/footer.php'; ?>

<!--modal untuk tambah data kategory --> 
<div class="modal fade" id="addAcara" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="proses_acara.php" method="POST">
                    <div class="mb-3">
                        <label for="namaAcara" class="form-label">Nama Acara</label>
                        <input type="text" class="form-control" name="nama_acara" required>
                    </div>
                    <div class="mb-3">
                        <label for="tanggal" class="form-label">Tanggal Acara</label>
                        <input type="date" class="form-control" name="tgl_acara" required>
                    </div>
                    <div class="mb-3">
                        <label for="lokasi" class="form-label">Lokasi</label>
                        <input type="text" class="form-control" name="lokasi_acara" required>
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <input type="text" class="form-control" name="deskripsi" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>