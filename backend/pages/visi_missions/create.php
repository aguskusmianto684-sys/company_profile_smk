<?php
$page = "visi_missions"; // Menandai halaman aktif di sidebar
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
                        <h5>Tambah Data Visi & Misi</h5>
                    </div>
                    <div class="card-body">
                        <form action="../../actions/visi_missions/store.php" method="POST">
                            <div class="mb-3">
                                <label for="categoryInput" class="form-label">Kategori</label>
                                <select class="form-control" name="category" id="categoryInput" required>
                                    <option value="">Pilih Kategori</option>
                                    <option value="visi">Visi</option>
                                    <option value="misi">Misi</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="textInput" class="form-label">Teks</label>
                                <textarea name="text" id="textInput" class="form-control" placeholder="Masukan teks visi atau misi" rows="5" required></textarea>
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