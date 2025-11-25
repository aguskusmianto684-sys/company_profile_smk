<?php
$page = "visi_missions";
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
                        <h5>Detail Data Visi & Misi</h5>
                    </div>
                    <div class="card-body">
                        <?php
                        include '../../actions/visi_missions/show.php';
                        ?>
                        <form>
                            <div class="mb-3">
                                <label for="categoryInput" class="form-label">Kategori</label>
                                <input type="text" class="form-control" value="<?= ucfirst($visi_misi->category) ?>" disabled>
                            </div>

                            <div class="mb-3">
                                <label for="textInput" class="form-label">Teks</label>
                                <textarea class="form-control" rows="5" disabled><?= $visi_misi->text ?></textarea>
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