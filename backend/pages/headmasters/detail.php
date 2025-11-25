<?php
$page = "headmasters";
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
                        <h5>Detail Data Kepala Sekolah</h5>
                    </div>
                    <div class="card-body">
                        <?php
                        include '../../actions/headmasters/show.php';
                        ?>
                        <form>
                            <div class="mb-3">
                                <label for="headmaster_nameInput" class="form-label">Nama</label>
                                <input type="text" class="form-control" value="<?= $headmaster->headmaster_name ?>" disabled>
                            </div>

                            <div class="mb-3">
                                <label for="headmaster_descriptionInput" class="form-label">Deskripsi</label>
                                <textarea class="form-control" rows="10" disabled><?= $headmaster->headmaster_description ?></textarea>
                            </div>
                            
                            <div class="mb-3">
                                <h6>Foto</h6>
                                <img src="../../../storages/headmasters/<?= $headmaster->headmaster_photo ?>"
                                    alt="Foto Kepala Sekolah"
                                    style="width:150px; height:auto; object-fit:cover; border:1px solid #ddd; border-radius:6px;">
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