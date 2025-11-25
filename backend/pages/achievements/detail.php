<?php
$page = "achievements";
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
                        <h5>Detail Data Prestarsi</h5>
                    </div>
                    <div class="card-body">
                        <?php
                        include '../../actions/achievements/show.php';
                        ?>
                        <form>
                            <div class="mb-3">
                                <label for="titleInput" class="form-label">Judul</label>
                                <input type="text" class="form-control" value="<?= $achievement->title ?>" disabled>
                            </div>

                            <div class="mb-3">
                                <label for="authorInput" class="form-label">Penulis</label>
                                <input type="text" class="form-control" value="<?= $achievement->author ?>" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="dateInput" class="form-label">Tanggal</label>
                                <input type="date" class="form-control" value="<?= $achievement->date ?>" disabled>
                            </div>

                            <div class="mb-3">
                                <label for="descriptionInput" class="form-label">Deskripsi</label>
                                <textarea class="form-control" rows="5" disabled><?= $achievement->description ?></textarea>
                            </div>

                            <div class="mb-3">
                                <h6>Gambar</h6>
                                <img src="../../../storages/achievements/<?= $achievement->image ?>"
                                    alt="Gambar Achievement"
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