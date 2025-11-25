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
                        <h5>Ubah Data Visi & Misi</h5>
                    </div>
                    <div class="card-body">
                        <?php
                        include '../../actions/visi_missions/show.php';
                        ?>
                        <form action="../../actions/visi_missions/update.php?id=<?= $visi_misi->id ?>" method="POST">
                            <div class="mb-3">
                                <label for="categoryInput" class="form-label">Kategori</label>
                                <select class="form-control" name="category" id="categoryInput" required>
                                    <option value="visi" <?= $visi_misi->category == 'visi' ? 'selected' : '' ?>>Visi</option>
                                    <option value="misi" <?= $visi_misi->category == 'misi' ? 'selected' : '' ?>>Misi</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="textInput" class="form-label">Teks</label>
                                <textarea name="text" id="textInput" class="form-control" placeholder="Masukan teks visi atau misi" rows="5" required><?= $visi_misi->text ?></textarea>
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