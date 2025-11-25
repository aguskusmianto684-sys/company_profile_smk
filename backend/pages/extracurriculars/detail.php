<?php
$page = "extracurriculars";
include '../../partials/header.php';
include '../../partials/sidebar.php';
include '../../partials/navbar.php';

include '../../../config/connection.php';

$id = $_GET['id'];
$q = "SELECT * FROM extracurriculars WHERE id = $id";
$result = mysqli_query($connect, $q) or die(mysqli_error($connect));
$ekstra = mysqli_fetch_object($result);
?>

<!-- content -->
<div class="main-panel">
    <div class="content-wrapper">
        <!-- content -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header" style="background: linear-gradient(135deg, white, #0077b6, #90e0ef); border: none;">
                        <h5>Detail Data Organisasi</h5>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="mb-3">
                                <label class="form-label">Nama</label>
                                <input type="text" class="form-control" value="<?= $ekstra->name ?>" disabled>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Pembina</label>
                                <input type="text" class="form-control" value="<?= $ekstra->coach ?>" disabled>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Gambar</label>
                                <div>
                                    <?php if (!empty($ekstra->image)): ?>
                                        <img src="../../../storages/extracurriculars/<?= $ekstra->image ?>"
                                             alt="Gambar Ekstrakurikuler"
                                             style="width:100px; height:100px; object-fit:contain;">
                                    <?php else: ?>
                                        <span class="text-muted">Tidak ada gambar</span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="descriptionInput" class="form-label">Deskripsi</label>
                                <textarea class="form-control" rows="5" disabled><?= !empty($ekstra->description) ? $ekstra->description : 'Tidak ada deskripsi' ?></textarea>
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
