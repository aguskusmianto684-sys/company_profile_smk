<?php

$page = "testimonials";
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
                        <h5>Detail Data Testimoni</h5>
                    </div>
                    <div class="card-body">
                        <?php
                        include '../../actions/testimonials/show.php';
                        ?>
                        <form>
                            <div class="mb-3">
                                <label for="nameInput" class="form-label">Nama</label>
                                <input type="text" class="form-control" value="<?= $testimonial->name ?>" disabled>
                            </div>

                            <div class="mb-3">
                                <label for="statusInput" class="form-label">Status</label>
                                <input type="text" class="form-control" value="<?= $testimonial->status ?>" disabled>
                            </div>

                            <div class="mb-3">
                                <label for="messageInput" class="form-label">Pesan</label>
                                <textarea class="form-control" rows="5" disabled><?= $testimonial->message ?></textarea>
                            </div>

                            <p><strong>Rating:</strong>
                                <?php if (!empty($testimonial->rating)): ?>
                                    <?php for ($i = 1; $i <= $testimonial->rating; $i++): ?>
                                        ⭐
                                    <?php endfor; ?>
                                <?php else: ?>
                                    <span class="text-muted">-</span>
                                <?php endif; ?>
                            </p>



                            <div class="mb-3">
                                <h6>Foto</h6>
                                <img src="../../../storages/testimonials/<?= $testimonial->image ?>"
                                    alt="Foto Testimonial"
                                    style="width:120px; height:auto; object-fit:cover; border-radius:6px;">
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