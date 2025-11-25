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
                        <h5>Tambah Data Guru</h5>
                    </div>
                    <div class="card-body">
                        <form action="../../actions/teachers/store.php" method="POST" enctype="multipart/form-data">

                            <div class="mb-3">
                                <label for="teachers_nameInput" class="form-label">Nama</label>
                                <input type="text" class="form-control" name="teachers_name" id="teachers_nameInput" placeholder="Masukan nama guru..." required>
                            </div>

                            <!-- jns kelamin -->
                            <div class="mb-3">
                                <label for="jkInput" class="form-label">Jenis Kelamin</label>
                                <select class="form-select form-control" id="jkInput" name="jk" required style="height: 45px;">
                                    <option disabled selected>Pilih Jenis Kelamin</option>
                                    <option value="Laki-laki">Laki-Laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>


                            <div class="mb-3">
                                <label for="teachers_majorInput" class="form-label">Jurusan</label>
                                <input type="text" name="teachers_major" class="form-control" id="teachers_majorInput" placeholder="Masukan jurusan guru..." required>
                            </div>

                            <div class="mb-3">
                                <label for="teachers_photoInput" class="form-label">Foto</label>
                                <input type="file" name="teachers_photo" id="teachers_photoInput" class="form-control" required>
                            </div>

                            <button type="submit" class="btn btn-success me-3" name="tombol">Tambah</button>
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