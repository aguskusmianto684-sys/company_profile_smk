<?php
$page = "majors";
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
                        <h5>Detail Data Jurusan</h5>
                    </div>
                    <div class="card-body">
                        <?php
                        include '../../actions/majors/show.php';
                        ?>
                        <form>
                            <div class="mb-3">
                                <label for="majors_nameInput" class="form-label">Nama</label>
                                <input type="text" class="form-control" value="<?= $major->majors_name ?>" disabled>
                            </div>

                            <div class="mb-3">
                                <label for="headInput" class="form-label">Kepala</label>
                                <input type="text" class="form-control" value="<?= $major->head ?>" disabled>
                            </div>

                            <div class="mb-3">
                                <label for="majors_descriptionInput" class="form-label">Deskripsi</label>
                                <textarea class="form-control" rows="30" disabled><?= $major->majors_description ?></textarea>
                            </div>
                            
                            <div class="mb-3">
                                <h6>Gambar</h6>
                                <img src="../../../storages/majors/<?= $major->majors_image ?>"
                                    alt="Gambar Jurusan"
                                    style="width:100px; height:100px; object-fit:contain;">
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