<?php

$page = "testimonials"; // Menandai halaman aktif di sidebar
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
                        <h5>Tambah Data Testimoni</h5>
                    </div>
                    <div class="card-body">
                        <form action="../../actions/testimonials/store.php" method="POST" enctype="multipart/form-data">

                            <div class="mb-3">
                                <label for="nameInput" class="form-label">Nama</label>
                                <input type="text" class="form-control" name="name" id="nameInput" placeholder="Masukan nama..." required>
                            </div>
                            <div class="mb-3">
                                <label for="statusInput" class="form-label">Status</label>
                                <input type="text" name="status" class="form-control" id="statusInput" placeholder="Masukan status..." required>
                            </div>
                            <div class="mb-3">
                                <label for="messageInput" class="form-label">Pesan</label>
                                <textarea name="message" id="messageInput" class="form-control" placeholder="Masukan pesan testimonial" rows="5"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="rating">Rating</label>
                                <select name="rating" id="rating" class="form-control" required>
                                    <option value="5">⭐⭐⭐⭐⭐ (5)</option>
                                    <option value="4">⭐⭐⭐⭐ (4)</option>
                                    <option value="3">⭐⭐⭐ (3)</option>
                                    <option value="2">⭐⭐ (2)</option>
                                    <option value="1">⭐ (1)</option>
                                </select>
                            </div>


                            <div class="mb-3">
                                <label for="imageInput" class="form-label">Foto</label>
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