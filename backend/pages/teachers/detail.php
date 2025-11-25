<?php
// pages/contact/detail.php
$page = "teachers"; // Menandai halaman aktif di sidebar
include '../../partials/header.php';
include '../../partials/sidebar.php';
include '../../partials/navbar.php';
?>

<!-- content -->
<div class="main-panel">
    <div class="content-wrapper">
        <!-- content -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header" style="background: linear-gradient(135deg, white, #0077b6, #90e0ef); border: none;">
                        <h5>Detail Data Guru</h5>
                    </div>
                    <div class="card-body">
                        <?php
                        include '../../actions/teachers/show.php';
                        ?>
                        <form>
                            <div class="mb-3">
                                <label for="teachers_nameInput" class="form-label">Nama</label>
                                <input type="text" class="form-control" value="<?= $teacher->teachers_name ?>" disabled>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Jenis Kelamin</label>
                                <input type="text" class="form-control" value="<?= $teacher->jk ?>" disabled>
                            </div>

                            <div class="mb-3">
                                <label for="teachers_majorInput" class="form-label">Jurusan</label>
                                <input type="text" class="form-control" value="<?= $teacher->teachers_major ?>" disabled>
                            </div>

                            <div class="mb-3">
                                <h6>Foto</h6>
                                <img src="../../../storages/teachers/<?= $teacher->teachers_photo ?>"
                                    alt="Foto Guru"
                                    style="width:150px; height:auto; object-fit:cover; border:1px solid #ddd; border-radius:6px;">
                            </div>

                            <a href="./index.php" class="btn btn-primary">Kembali</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <?php
        include '../../partials/footer.php';
        include '../../partials/script.php';
        ?>