<?php

$page = "users";
include '../../partials/header.php';
include '../../partials/sidebar.php';
include '../../partials/navbar.php';

// ambil id dari url
$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: ./index.php");
    exit;
}

include '../../../config/connection.php';

// query ambil data user berdasarkan id
$qUser = "SELECT * FROM users WHERE id = $id LIMIT 1";
$result = mysqli_query($connect, $qUser) or die(mysqli_error($connect));
$user = mysqli_fetch_object($result);

if (!$user) {
    echo "<div class='alert alert-danger'>Data user tidak ditemukan.</div>";
    include '../../partials/footer.php';
    include '../../partials/script.php';
    exit;
}
?>

<!-- content -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header" style="background: linear-gradient(135deg, white, #0077b6, #90e0ef); border: none;">
                        <h5>Detail Data Pengguna</h5>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="mb-3">
                                <label class="form-label">ID</label>
                                <input type="text" class="form-control" value="<?= $user->id ?>" disabled>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Nama</label>
                                <input type="text" class="form-control" value="<?= $user->name ?>" disabled>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" value="<?= $user->email ?>" disabled>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Akses</label>
                                <input type="role" class="form-control" value="<?= $user->role ?>" disabled>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Password (terenkripsi)</label>
                                <input type="password" id="passwordField" class="form-control" value="<?= $user->password ?>" disabled>
                                <input type="checkbox" id="togglePassword" onclick="togglePasswordVisibility()"> Tampilkan Password
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Dibuat</label>
                                <input type="text" class="form-control" value="<?= $user->created_at ?>" disabled>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Diperbarui</label>
                                <input type="text" class="form-control" value="<?= $user->updated_at ?>" disabled>
                            </div>

                            <a href="./index.php" class="btn btn-primary">Kembali</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script>
            function togglePasswordVisibility() {
                var field = document.getElementById("passwordField");
                if (field.type === "password") {
                    field.type = "text";
                } else {
                    field.type = "password";
                }
            }
        </script>

        <?php
        include '../../partials/footer.php';
        include '../../partials/script.php';
        ?>
