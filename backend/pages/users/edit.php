<?php
include '../../../config/connection.php';
$page = "users";
include '../../partials/header.php';
include '../../partials/sidebar.php';
include '../../partials/navbar.php';

$id = $_GET['id'];
$user = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM users WHERE id='$id'"));
?>

<!-- content -->
<div class="main-panel">
    <div class="content-wrapper">
        <!-- content -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header" style="background: linear-gradient(135deg, white, #0077b6, #90e0ef); border: none;">
                        <h5>Ubah Data Pengguna</h5>
                    </div>
                    <div class="card-body">
                        <form action="../../actions/users/update.php?id=<?= $id ?>" method="POST">
                            <div class="mb-3">
                                <label>Nama</label>
                                <input type="text" name="name" class="form-control" value="<?= $user['name'] ?>" required>
                            </div>
                            <div class="mb-3">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" value="<?= $user['email'] ?>" required>
                            </div>
                            <div class="mb-3">
                                <label>Password (kosongkan jika tidak diganti)</label>
                                <input type="password" name="password" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Akses</label>
                                <select name="role" class="form-control" required>
                                    <option value="admin" <?= ($user['role'] == 'admin') ? 'selected' : '' ?>>Admin</option>
                                    <option value="staf" <?= ($user['role'] == 'staf') ? 'selected' : '' ?>>Staf</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-success">Edit</button>
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