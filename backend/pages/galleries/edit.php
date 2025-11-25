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
                        <h5>Ubah Data Galeri</h5>
                    </div>
                    <div class="card-body">
                        <?php
                        include '../../actions/galleries/show.php';
                        ?>
                        <form action="../../actions/galleries/update.php?id=<?= $gallery->id ?>" method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="imageInput" class="form-label">Gambar</label>
                                <?php if (!empty($gallery->image)): ?>
                                    <img src="../../../storages/galleries/<?= $gallery->image ?>"
                                        alt="Gambar Saat Ini"
                                        class="d-block mb-2" style="max-width: 200px; height: auto; border-radius: 6px;">
                                <?php endif; ?>
                                <input type="file" name="image" id="imageInput" class="form-control">
                                <small class="text-muted">Biarkan kosong jika tidak ingin mengubah gambar.</small>
                            </div>

                            <div class="mb-3">
                                <label for="dateInput" class="form-label">Tanggal</label>
                                <input type="date" name="date" class="form-control" id="dateInput" required value="<?= $gallery->date ?>">
                            </div>
                            <div class="mb-3">
                                <label for="authorInput" class="form-label">Penulis</label>
                                <input type="text" name="author" class="form-control" id="authorInput" placeholder="Masukkan Nama Penulis..." required value="<?= $gallery->author ?>">
                            </div>

                            <div class="mb-3">
                                <label for="descriptionInput" class="form-label">Deskripsi</label>
                                <textarea name="description" id="descriptionInput" class="form-control" placeholder="Masukan deskripsi gambar" rows="5"><?= $gallery->description ?></textarea>
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