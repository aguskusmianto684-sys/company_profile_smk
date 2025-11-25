<?php
$page = "announcements";
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
                        <h5>Tambah Data Pengumuman</h5>
                    </div>
                    <div class="card-body">
                        <form action="../../actions/announcements/store.php" method="POST" enctype="multipart/form-data">

                            <div class="mb-3">
                                <label for="announcements_titleInput" class="form-label">Judul</label>
                                <input type="text" class="form-control" name="announcements_title" id="announcements_titleInput" placeholder="Masukan judul pengumuman..." required>
                            </div>
                            <div class="mb-3">
                                <label for="dateInput" class="form-label">Tanggal</label>
                                <input type="date" name="date" id="dateInput" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="announcements_descriptionInput" class="form-label">Deskripsi</label>
                                <textarea name="announcements_description" id="announcements_descriptionInput" class="form-control" placeholder="Masukan deskripsi pengumuman" rows="5"></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="announcements_imageInput" class="form-label">Gambar</label>
                                <input type="file" name="announcements_image" id="announcements_imageInput" class="form-control" required>
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