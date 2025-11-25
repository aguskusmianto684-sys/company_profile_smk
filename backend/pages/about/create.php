<?php
$page = "about";
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
                <h5>Tambah Data Tentang Sekolah</h5>
            </div>
            <div class="card-body">
                <form action="../../actions/about/store.php" method="POST" enctype="multipart/form-data">

                    <div class="mb-3">
                        <label for="school_nameInput" class="form-label">Nama Sekolah</label>
                        <input type="text" class="form-control" name="school_name" id="school_nameInput" placeholder="Masukan Nama sekolah..." required>
                    </div>
                    <div class="mb-3">
                        <label for="school_taglineInput" class="form-label">Slogan Sekolah</label>
                        <input type="text" name="school_tagline" class="form-control" id="school_taglineInput" placeholder="Masukan slogan sekolah..." required>
                    </div>
                    <div class="mb-3">
                        <label for="sinceInput" class="form-label">Tanggal Berdiri Sekolah</label>
                        <input type="date" name="since" class="form-control" id="sinceInput" required>
                    </div>
                    <div class="mb-3">
                        <label for="alamatInput" class="form-label">Alamat</label>
                        <textarea name="alamat" id="alamatInput" class="form-control" placeholder="Masukan alamat sekolah" rows="5"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="school_descriptionInput" class="form-label">Deskripsi Sekolah</label>
                        <textarea type="text" name="school_description" id="school_descriptionInput" class="form-control" placeholder="Masukan Deskripsi" rows="5"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="school_bannerInput" class="form-label">Banner Sekolah</label>
                        <input type="file" name="school_banner" id="school_bannerInput" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="school_logoInput" class="form-label">Logo Sekolah</label>
                        <input type="file" name="school_logo" id="school_logoInput" class="form-control" required>
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