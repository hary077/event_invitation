<?php
include (".includes/header.php");
$title = "Dashboard";
// Menyertakan file untuk menampilkan notifikasi (jika ada)
include ".includes/toast_notification.php";
?>

<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Card untuk menampilkan tabel postingan -->
    <div class="card">
        <!-- Tabel dengan baris yang dapat di-hover -->
        <div class="card">
            <!-- Header Tabel -->
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4>Semua Postingan</h4>
            </div>

            <div class="card-body">
                <!-- Tabel responsif -->
                <div class="table-responsive text-nowrap">
                    <table id="datatable" class="table table-hover">
                        <thead>
                            <tr class="text-center">
                                <th width="50px">#</th>
                                <th>Nama tamu</th>
                                <th>Nama acara</th>
                                <th>Tanggal acara</th>
                                <th>Lokasi acara</th>
                                <th>Setatus kehadiran</th>
                                <th>email</th>
                                <th width="150px">Pilihan</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            <!-- Menampilkan data dari tabel database -->
                            <?php
                            $index = 1; // Variabel untuk nomor urut
                            // Query untuk mengambil data dari tabel posts, users, dan category
                            $query = "SELECT undangan.*,namatamu, acara.nama_acara, acara.tgl_acara, acara.lokasi_acara, tamu.setatus_kehadiran, tamu.email
                                      FROM undangan INNER JOIN users ON tamu.tamu_id = users.user_id 
                                      INNER JOIN tamu ON acara.acara_id = tamu.tamu_id 
                                      WHERE undangan.acara_id = $userId";

                            // Eksekusi query
                            $exec = mysqli_query($conn, $query);

                            // Perulangan untuk menampilkan setiap baris hasil query
                            while ($post = mysqli_fetch_assoc($exec)) :
                            ?>
                                <tr>
                                    <td><?= $index++; ?></td>
                                    <td><?= $post['namatamu']; ?></td>
                                    <td><?= $post['nama_acara']; ?></td>
                                    <td><?= $post['tgl_acara']; ?></td>
                                    <td><?= $post['lokasi_acara']; ?></td>
                                    <td><?= $post['setatus_kehadiran']; ?></td>
                                    <td><?= $post['email']; ?></td>
                                    <td>
                                        <div class="dropdown">
                                            <!-- Tombol dropdown untuk Pilihan -->
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <!-- Pilihan Edit -->
                                                <a href="edit_post.php?post_id=<?= $post['undangan_id']; ?>" class="dropdown-item">
                                                    <i class="bx bx-edit-alt me-2"></i> Edit
                                                </a>
                                                <!-- Pilihan Delete -->
                                                <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#deletePost_<?= $post['undangan_id']; ?>">
                                                    <i class="bx bx-trash me-2"></i> Delete
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Modal untuk Hapus Konten Blog -->
                     <div class="modal fade" id="deletePost_<?= $post['undangan_id']; ?>" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Hapus Post?</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="proses_post.php" method="POST">
                                                    <p>Tindakan ini tidak bisa dibatalkan.</p>
                                                    <input type="hidden" name="postID" value="<?= $post['undangan_id']; ?>">
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" name="delete" class="btn btn-primary">Hapus</button>
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
</div>

<?php include (".includes/footer.php"); ?>
