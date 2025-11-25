<?php
$page = "social_media"; // Menandai halaman aktif di sidebar
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
                <div class="dard">
                    <div class="card-header" style="background: linear-gradient(135deg, white, #0077b6, #90e0ef); border: none;">
                        <h5>Detail Data About</h5>
                    </div>
                    <div class="card-body">
                        <?php
                        include '../../actions/about/show.php';
                        ?>
                        <form>
                            <div class="mb-3">
                                <label for="school_nameInput" class="form-label">Nama sekolah</label>
                                <input type="text" class="form-control" value="<?= $about->school_name ?>" disabled>
                            </div>

                            <div class="mb-3">
                                <label for="school_taglineInput" class="form-label">Slogan Sekolah</label>
                                <input type="text" class="form-control" value="<?= $about->school_tagline ?>" disabled>
                            </div>

                            <div class="mb-3">
                                <label for="sinceInput" class="form-label">Tanggal berdiri sekolah</label>
                                <input type="date" class="form-control" value="<?= $about->since ?>" disabled>
                            </div>

                            <div class="mb-3">
                                <label for="alamatInput" class="form-label">Alamat Sekolah</label>
                                <textarea class="form-control" rows="5" disabled><?= $about->alamat ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="school_descriptionInput" class="form-label">Deskripsi Sekolah</label>
                                <textarea class="form-control" rows="5" disabled><?= $about->school_description ?></textarea>
                            </div>
                            <div class="mb-3">
                                <h6>Banner Sekolah</h6>
                                <img src="../../../storages/about/<?= $about->school_banner ?>"
                                    alt="Banner"
                                    style="width:150px; height:auto; object-fit:cover; border:1px solid #ddd; border-radius:6px;">
                            </div>

                            <div class="mb-3">
                                <h6>Logo Sekolah</h6>
                                <img src="../../../storages/about/<?= $about->school_logo ?>"
                                    alt="Logo"
                                    style="width:100px; height:auto; object-fit:cover; border:1px solid #ddd; border-radius:6px;">
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