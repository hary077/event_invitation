<?php
// Menyertakan header halaman
include '.includes/header.php';
include '.includes/toast_notification.php';
?>

<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Tabel data kategori -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>Data Tamu</h4>
            <!-- Tombol untuk menambah kategori baru -->

        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addTamu">Tambah Tamu</button>
        </div>
<div class="card-body">
<div class="table-responsive text-nowrap">
<table id="datatable" class="table table-hover">
<thead>
<tr class="text-center">
<th width="50px">#</th>
<th>Nama</th>
<th>Email</th>
<th>Status Kehadiran</th>
<th width="150px">Pilihan</th>
</tr>
</thead>
<tbody class="table-border-bottom-0">


<!-- Mengambil data kategori dari database -->
<?php
$index = 1;
$query = "SELECT * FROM tamu";
$exec = mysqli_query($conn, $query); // Pastikan $conn sudah didefinisikan (koneksi database)

while ($tamu = mysqli_fetch_assoc($exec)): 
?>
    <tr>
        <!-- menampilkan nomor kategori, dan opsi -->
        <td><?= $index++; ?></td>
         <td><?= $tamu['namatamu']; ?></td> 
         <td><?= $tamu['email']; ?></td> 
         <td><?= $tamu['status_kehadiran']; ?></td> 


         <td>
            <!-- dropdown untuk opsi edit dan delete -->
            <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                    <i class="bx bx-dots-vertical-rounded"></i>
                 </button>
                <div class="dropdown-menu">
                    <a href="#" class="dropdown-item" data-bs-toggle="modal"
                    data-bs-target="#editTamu_<?= $tamu['tamu_id']; ?>">
                    <i class="bx bx-edit-alt me-2"></i> Edit
                </a>
                <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#deleteTamu_<?= $tamu['tamu_id']; ?>">
                    <i class="bx bx-trash me-2"></i> Delete</a>
                </div>
            </div>
        </td>
        
    </tr>
    <div class="modal fade" id="deleteTamu_<?= $tamu['tamu_id']; ?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Hapus Acara?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="proses_tamu.php" method="POST">
                        <div>
                            <p>Tindakan ini tidak bisa dibatalkan.</p>
                            <input type="hidden" name="tamu_id" value="<?= $tamu['tamu_id']; ?>">
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
    <!-- edit tamu -->
    <div id="editTamu_<?= $tamu['tamu_id']; ?>" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Data Tamu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="proses_tamu.php" method="POST">
                    <input type="hidden" name="tamu_id" value="<?= $tamu['tamu_id']; ?>">
                    <div class="modal-body">
                    <div class="mb-3">
                            <label for="namatamu" class="form-label">Nama Tamu</label>
                            <input type="text" class="form-control" name="namatamu" required>
                        </div>
                        <div class="col-md">
                            <label class="from-label">Status Kehadiran</label>
                            <div class="form-check mt-3">
                                <input name="status_kehadiran" class="form-check-input" type="radio" value="hadir" id="defaultRadio1" <?= (isset($_POST['status_kehadiran']) && $_POST['status_kehadiran'] == 'hadir') ? 'checked' : '' ?>>
                                <label class="form-check-label" for="defaultRadio1"> HADIR </label>
                            </div>
                            <div class="form-check mt-3">
                                <input name="status_kehadiran" class="form-check-input" type="radio" value="tidak-hadir" id="defaultRadio2" <?= (isset($_POST['status_kehadiran']) && $_POST['status_kehadiran'] == 'tidak-hadir') ? 'checked' : '' ?>>
                                <label class="form-check-label" for="defaultRadio2"> TIDAK HADIR </label>
                            </div>
                            <div class="form-check mt-3">
                                <input name="status_kehadiran" class="form-check-input" type="radio" value="ragu-ragu" id="defaultRadio3" <?= (isset($_POST['status_kehadiran']) && $_POST['status_kehadiran'] == 'ragu-ragu') ? 'checked' : '' ?>>
                                <label class="form-check-label" for="defaultRadio3"> RAGU-RAGU </label>
                            </div>
                        </div>
                        <label for="acara_id" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" placeholder="name@example.com">
                        <!-- Textarea untuk konten postingan -->
                        <!-- Tombol submit -->
                        <button type="submit" name="update" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- modal untuk hapus data kategori -->
        
        <?php endwhile; ?>
</tbody>
</table>
</div>
</div>
</div>
</div>
<?php include '.includes/footer.php'; ?>

<!-- modal tambah -->
<div class="modal fade" id="addTamu" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data Tamu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="proses_tamu.php" method="POST">
                        <div class="mb-3">
                            <label for="namatamu" class="form-label">Nama Tamu</label>
                            <input type="text" class="form-control" name="namatamu" required>
                        </div>
                        <div class="col-md">
                            <label class="from-label">Status Kehadiran</label>
                            <div class="form-check mt-3">
                                <input name="status_kehadiran" class="form-check-input" type="radio" value="hadir" id="defaultRadio1" <?= (isset($_POST['status_kehadiran']) && $_POST['status_kehadiran'] == 'hadir') ? 'checked' : '' ?>>
                                <label class="form-check-label" for="defaultRadio1"> HADIR </label>
                            </div>
                            <div class="form-check mt-3">
                                <input name="status_kehadiran" class="form-check-input" type="radio" value="tidak-hadir" id="defaultRadio2" <?= (isset($_POST['status_kehadiran']) && $_POST['status_kehadiran'] == 'tidak-hadir') ? 'checked' : '' ?>>
                                <label class="form-check-label" for="defaultRadio2"> TIDAK HADIR </label>
                            </div>
                            <div class="form-check mt-3">
                                <input name="status_kehadiran" class="form-check-input" type="radio" value="ragu-ragu" id="defaultRadio3" <?= (isset($_POST['status_kehadiran']) && $_POST['status_kehadiran'] == 'ragu-ragu') ? 'checked' : '' ?>>
                                <label class="form-check-label" for="defaultRadio3"> RAGU-RAGU </label>
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