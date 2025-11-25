<?php

$page = "achievements";
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
                <h5>Tambah Data Prestarsi</h5>
            </div>
            <div class="card-body">
                <form action="../../actions/achievements/store.php" method="POST" enctype="multipart/form-data">

                    <div class="mb-3">
                        <label for="titleInput" class="form-label">Judul</label>
                        <input type="text" class="form-control" name="title" id="titleInput" placeholder="Masukan judul prestasi..." required>
                    </div>

                    <div class="mb-3">
                      <label for="authorInput" class="form-label">Penulis</label>
                      <input type="text" name="author" id="authorInput" class="form-control" placeholder="Masukkan Nama Penulis..." required>
                    </div>
                    <div class="mb-3">
                      <label for="dateInput" class="form-label">Tanggal</label>
                      <input type="date" name="date" id="dateInput" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="descriptionInput" class="form-label">Deskripsi</label>
                        <textarea name="description" id="descriptionInput" class="form-control" placeholder="Masukan deskripsi prestasi" rows="5"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="imageInput" class="form-label">Gambar</label>
                        <input type="file" name="image" id="imageInput" class="form-control" required>
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