<?php
session_start();
if ($_SESSION['user_role'] !== 'admin') {
    echo "<script>alert('Akses ditolak!'); window.location='index.php';</script>";
    exit();
}
$page = "users"; // Menandai halaman aktif di sidebar
include '../../partials/header.php';
include '../../partials/sidebar.php';
include '../../partials/navbar.php';
?>

<div class="main-panel">
    <div class="content-wrapper">
        <!-- content -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header" style="background: linear-gradient(135deg, white, #0077b6, #90e0ef); border: none;">
                        <h5>Tambah Data Pengguna</h5>
                    </div>
                    <div class="card-body">
                        <form action="../../actions/users/store.php" method="POST" autocomplete="off">
                            <div class="mb-3">
                                <label>Nama</label>
                                <input type="text" name="name" class="form-control" required
                                    autocomplete="off" placeholder="Masukkan nama lengkap">
                            </div>
                            <div class="mb-3">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" required
                                    autocomplete="off" placeholder="contoh: user@email.com">
                            </div>
                            <div class="mb-3">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" required
                                    autocomplete="new-password" placeholder="Masukkan password">
                            </div>
                            <div class="mb-3">
                                <label>Akses</label>
                                <select name="role" class="form-control" required>
                                    <option value="">-- Pilih Akses --</option>
                                    <option value="admin">Admin</option>
                                    <option value="staf">Staf</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-success">Simpan</button>
                            <a href="index.php" class="btn btn-primary">Kembali</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <?php
        include '../../partials/footer.php';
        include '../../partials/script.php';
        ?>