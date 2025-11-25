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
                        <h5>Ubah Data Testimoni</h5>
                    </div>
                    <div class="card-body">
                        <?php
                        include '../../actions/testimonials/show.php';
                        ?>
                        <form action="../../actions/testimonials/update.php?id=<?= $testimonial->id ?>" method="POST" enctype="multipart/form-data">

                            <div class="mb-3">
                                <label for="nameInput" class="form-label">Nama</label>
                                <input type="text" class="form-control" name="name" id="nameInput" placeholder="Masukan nama..." required value="<?= $testimonial->name ?>">
                            </div>

                            <div class="mb-3">
                                <label for="statusInput" class="form-label">Status</label>
                                <input type="text" name="status" class="form-control" id="statusInput" placeholder="Masukan status..." required value="<?= $testimonial->status ?>">
                            </div>

                            <div class="mb-3">
                                <label for="messageInput" class="form-label">Pesan</label>
                                <textarea name="message" id="messageInput" class="form-control" placeholder="Masukan pesan testimonial" rows="5"><?= $testimonial->message ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="ratingInput" class="form-label">Rating</label>
                                <select name="rating" id="rating" class="form-control" required>
                                    <option value="5" <?= $testimonial->rating == 5 ? 'selected' : '' ?>>⭐⭐⭐⭐⭐ (5)</option>
                                    <option value="4" <?= $testimonial->rating == 4 ? 'selected' : '' ?>>⭐⭐⭐⭐ (4)</option>
                                    <option value="3" <?= $testimonial->rating == 3 ? 'selected' : '' ?>>⭐⭐⭐ (3)</option>
                                    <option value="2" <?= $testimonial->rating == 2 ? 'selected' : '' ?>>⭐⭐ (2)</option>
                                    <option value="1" <?= $testimonial->rating == 1 ? 'selected' : '' ?>>⭐ (1)</option>
                                </select>
                            </div>



                            <div class="mb-3">
                                <label for="imageInput" class="form-label">Foto</label>
                                <img src="../../../storages/testimonials/<?= $testimonial->image ?>" alt="Foto Testimonial"
                                    class="d-block mb-2" style="width:120px; height:auto; object-fit:cover; border-radius:6px;">
                                <input type="file" name="image" id="imageInput" class="form-control">
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