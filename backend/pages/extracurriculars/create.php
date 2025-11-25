<?php
$page = "extracurriculars";
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
                        <h5>Tambah Data Organisasi</h5>
                    </div>
                    <div class="card-body">
                        <form action="../../actions/extracurriculars/store.php" method="POST" enctype="multipart/form-data">
                            
                            <div class="mb-3">
                                <label for="nameInput" class="form-label">Nama</label>
                                <input type="text" name="name" id="nameInput" class="form-control" placeholder="Masukan nama organisasi" required>
                            </div>

                            <div class="mb-3">
                                <label for="coachInput" class="form-label">Pembina</label>
                                <input type="text" name="coach" id="coachInput" class="form-control" placeholder="Masukan nama pembina" required>
                            </div>

                            <div class="mb-3">
                                <label for="imageInput" class="form-label">Gambar</label>
                                <input type="file" name="image" id="imageInput" class="form-control" required>
                                <small class="text-muted">Format yang didukung: JPG, PNG, GIF. Maksimal 2MB.</small>
                            </div>

                            <div class="mb-3">
                                <label for="descriptionInput" class="form-label">Deskripsi</label>
                                <textarea name="description" id="descriptionInput" class="form-control" placeholder="Masukan deskripsi organisasi" rows="5"></textarea>
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
