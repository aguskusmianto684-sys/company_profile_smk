<?php
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
                        <h5>Ubah Data Guru</h5>
                    </div>
                    <div class="card-body">
                        <?php
                        include '../../actions/teachers/show.php';
                        ?>
                        <form action="../../actions/teachers/update.php?id=<?= $teacher->id ?>" method="POST" enctype="multipart/form-data">

                            <div class="mb-3">
                                <label for="teachers_nameInput" class="form-label">Nama</label>
                                <input type="text" class="form-control" name="teachers_name" id="teachers_nameInput" placeholder="Masukan nama guru..." required value="<?= $teacher->teachers_name ?>">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Jenis Kelamin</label>
                                <select class="form-select form-control" id="jkInput" name="jk" required style="height: 45px;">
                                    <option value="" disabled selected>Pilih Jenis Kelamin</option>
                                    <option value="Laki-laki" <?= $teacher->jk == 'Laki-laki' ? 'selected' : '' ?>>Laki-Laki</option>
                                    <option value="Perempuan" <?= $teacher->jk == 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
                                </select>
                            </div>


                            <div class="mb-3">
                                <label for="teachers_majorInput" class="form-label">Jurusan</label>
                                <input type="text" name="teachers_major" class="form-control" id="teachers_majorInput" placeholder="Masukan jurusan guru..." required value="<?= $teacher->teachers_major ?>">
                            </div>

                            <div class="mb-3">
                                <label for="teachers_photoInput" class="form-label">Foto</label>
                                <img src="../../../storages/teachers/<?= $teacher->teachers_photo ?>" alt="Foto Guru"
                                    class="d-block mb-2" style="width:120px; height:auto; object-fit:cover; border-radius:6px;">
                                <input type="file" name="teachers_photo" id="teachers_photoInput" class="form-control">
                            </div>

                            <button type="submit" class="btn btn-warning" name="tombol">Edit</button>
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