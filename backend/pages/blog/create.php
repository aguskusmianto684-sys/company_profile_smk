<?php

$page = "blog";
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
                        <h5>Tambah Data Berita</h5>
                    </div>
                    <div class="card-body">
                        <form action="../../actions/blogs/store.php" method="POST" enctype="multipart/form-data">

                            <div class="mb-3">
                                <label for="titleInput" class="form-label">Judul</label>
                                <input type="text" class="form-control" name="title" id="titleInput" placeholder="Masukan judul berita..." required>
                            </div>

                            <div class="mb-3">
                                <label for="authorInput" class="form-label">Penulis</label>
                                <input type="text" class="form-control" name="author" id="authorInput" placeholder="Masukan nama penulis..." required>
                            </div>

                            <div class="mb-3">
                                <label for="dateInput" class="form-label">Tanggal</label>
                                <input type="date" name="date" id="dateInput" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="contentInput" class="form-label">Konten</label>
                                <textarea name="content" id="contentInput" class="form-control" placeholder="Masukan konten berita" rows="5" required></textarea>
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