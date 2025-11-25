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
                        <h5>Tambah Data Kontak</h5>
                    </div>
                    <div class="card-body">
                        <form action="../../actions/contact/store.php" method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="contactInput" class="form-label">kontak</label>
                                <input type="text" class="form-control" name="contact" id="contactInput"
                                    placeholder="Masukan kontak..." required>
                            </div>

                            <div class="mb-3">
                                <label for="emailInput" class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" id="emailInput"
                                    placeholder="Masukan email..." required>

                            <div class="mb-3">
                                <label for="linkUrlInput" class="form-label">Tautan URL</label>
                                <input type="url" class="form-control" name="link_url" id="linkUrlInput"
                                    placeholder="Masukan taautan URL...">
                            </div>

                            <div class="mb-3">
                                <label for="iconInput" class="form-label">Ikon</label>
                                <input type="text" class="form-control" name="icon" id="iconInput"
                                    placeholder="Masukan icon..." required>
                            </div>

                            <button type="submit" class="btn btn-success me-3" name="tombol">Tambah</button>
                            <a href="./index.php" class="btn btn-primary">Kembali</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <?php
        include '../../partials/footer.php';
        include '../../partials/script.php';
        ?>
