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
                <h5>Tambah Data Kepala Sekolah</h5>
            </div>
            <div class="card-body">
                <form action="../../actions/headmasters/store.php" method="POST" enctype="multipart/form-data">

                    <div class="mb-3">
                        <label for="headmaster_nameInput" class="form-label">Nama</label>
                        <input type="text" class="form-control" name="headmaster_name" id="headmaster_nameInput" placeholder="Masukan nama kepala sekolah..." required>
                    </div>
                    <div class="mb-3">
                        <label for="headmaster_descriptionInput" class="form-label">Deskripsi</label>
                        <textarea name="headmaster_description" id="headmaster_descriptionInput" class="form-control" placeholder="Masukan deskripsi kepala sekolah" rows="5"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="headmaster_photoInput" class="form-label">Foto</label>
                        <input type="file" name="headmaster_photo" id="headmaster_photoInput" class="form-control" required>
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