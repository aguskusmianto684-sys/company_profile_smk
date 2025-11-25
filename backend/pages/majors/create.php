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
                <h5>Tambah Data Jurusan</h5>
            </div>
            <div class="card-body">
                <form action="../../actions/majors/store.php" method="POST" enctype="multipart/form-data">

                    <div class="mb-3">
                        <label for="majors_nameInput" class="form-label">Nama</label>
                        <input type="text" class="form-control" name="majors_name" id="majors_nameInput" placeholder="Masukan nama jurusan..." required>
                    </div>
                    <div class="mb-3">
                        <label for="headInput" class="form-label">Kepala</label>
                        <input type="text" name="head" class="form-control" id="headInput" placeholder="Masukan nama kepala jurusan..." required>
                    </div>
                    <div class="mb-3">
                        <label for="majors_descriptionInput" class="form-label">Deskripsi</label>
                        <textarea name="majors_description" id="majors_descriptionInput" class="form-control" placeholder="Masukan deskripsi jurusan" rows="30"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="majors_imageInput" class="form-label">Gambar</label>
                        <input type="file" name="majors_image" id="majors_imageInput" class="form-control" required>
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