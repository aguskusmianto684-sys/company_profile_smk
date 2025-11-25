<?php
$page = "social_media"; // Menandai halaman aktif di sidebar
include '../../partials/header.php';
include '../../partials/sidebar.php';
include '../../partials/navbar.php';
include '../../actions/social_media/show.php';  // Include file untuk mengambil data social media
?>

<!-- Konten Halaman -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header" style="background: linear-gradient(135deg, white, #0077b6, #90e0ef); border: none;">
                        <h5>Edit Data Sosial Media</h5>  <!-- Judul Halaman -->
                    </div>
                    <div class="card-body">
                        <!-- Form untuk mengedit data social media -->
                        <form action="../../actions/social_media/update.php?id=<?= $social_media->id ?>" method="POST">
                            <!-- Input untuk icon -->
                            <div class="mb-3">
                                <label for="iconInput" class="form-label">Ikon</label>
                                <?php if (!empty($social_media->icon)): ?>
                                    <!-- Menampilkan icon saat ini -->
                                    <div class="mb-2">
                                        <i class="<?= $social_media->icon ?>" style="font-size: 24px;"></i>
                                    </div>
                                <?php endif; ?>
                                <input type="text" class="form-control" name="icon" id="iconInput" 
                                    placeholder="Contoh: bi bi-facebook" required value="<?= $social_media->icon ?>">
                            </div>
                            <!-- Input untuk title -->
                            <div class="mb-3">
                                <label for="titleInput" class="form-label">Judul</label>
                                <input type="text" name="title" class="form-control" id="titleInput" 
                                    placeholder="Masukan title..." required value="<?= $social_media->title ?>">
                            </div>
                            <!-- Input untuk URL -->
                            <div class="mb-3">
                                <label for="link_urlInput" class="form-label">Tautan</label>
                                <input type="url" name="link_url" class="form-control" id="link_urlInput" 
                                    placeholder="Masukan URL..." required value="<?= $social_media->link_url ?>">
                            </div>

                            <!-- Tombol Submit dan Kembali -->
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