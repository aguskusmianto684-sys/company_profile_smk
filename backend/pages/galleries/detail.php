<?php
$page = "galleries";
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
                        <h5>Detail Data Galeri</h5>
                    </div>
                    <div class="card-body">
                        <?php
                        include '../../actions/galleries/show.php';
                        ?>
                        <form>
                            <div class="mb-3">
                                <label class="form-label">Gambar</label>
                                <div>
                                    <?php if (!empty($gallery->image)): ?>
                                        <img src="../../../storages/galleries/<?= $gallery->image ?>"
                                            alt="Gambar Galeri"
                                            style="width: 200px; height: 150px; object-fit: cover; border-radius: 8px; border: 1px solid #ddd;">
                                    <?php else: ?>
                                        <span class="text-muted">Tidak ada gambar</span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="authorInput" class="form-label">Penulis</label>
                                <input type="text" class="form-control" value="<?= $gallery->author ?>" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="dateInput" class="form-label">Tanggal</label>
                                <input type="date" class="form-control" value="<?= $gallery->date ?>" disabled>
                            </div>

                            <div class="mb-3">
                                <label for="descriptionInput" class="form-label">Deskripsi</label>
                                <textarea class="form-control" rows="5" disabled><?= !empty($gallery->description) ? $gallery->description : 'Tidak ada deskripsi' ?></textarea>
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