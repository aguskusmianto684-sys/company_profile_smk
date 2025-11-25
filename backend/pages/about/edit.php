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
                <div class="card"> <!-- benerin class -->
                    <div class="card-header" style="background: linear-gradient(135deg, white, #0077b6, #90e0ef); border: none;">
                        <h5>Ubah Data Tentang Sekolah</h5>
                    </div>
                    <div class="card-body">
                        <?php
                        include '../../actions/about/show.php';
                        ?>
                        <form action="../../actions/about/update.php?id=<?= $about->id ?>" method="POST" enctype="multipart/form-data">

                            <div class="mb-3">
                                <label for="school_nameInput" class="form-label">Nama Sekolah</label>
                                <input type="text" class="form-control" name="school_name" id="school_nameInput" placeholder="Masukan Nama sekolah...." required value="<?= $about->school_name ?>">
                            </div>

                            <div class="mb-3">
                                <label for="school_taglineInput" class="form-label">Slogan Sekolah</label>
                                <input type="text" name="school_tagline" class="form-control" id="school_taglineInput" placeholder="Masukan Slogan sekolah..." required value="<?= $about->school_tagline ?>">
                            </div>

                            <div class="mb-3">
                                <label for="sinceInput" class="form-label">Tanggal Berdiri Sekolah</label>
                                <input type="date" name="since" class="form-control" id="sinceInput" required value="<?= $about->since ?>">
                            </div>

                            <div class="mb-3">
                                <label for="alamatInput" class="form-label">Alamat Sekolah</label>
                                <textarea name="alamat" id="alamatInput" class="form-control" placeholder="Masukan alamat alamat" rows="5"><?= $about->alamat ?></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="school_descriptionInput" class="form-label">Deskripsi Sekolah</label>
                                <textarea name="school_description" id="school_descriptionInput" class="form-control" placeholder="Masukan Deskripsi" rows="5"><?= $about->school_description ?></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="school_bannerInput" class="form-label">Banner Sekolah</label>
                                <img src="../../../storages/about/<?= $about->school_banner ?>" alt="Banner"
                                    class="d-block mb-2" style="width:120px; height:auto; object-fit:cover; border-radius:6px;">
                                <input type="file" name="school_banner" id="school_bannerInput" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label for="school_logoInput" class="form-label">Logo Sekolah</label>
                                <img src="../../../storages/about/<?= $about->school_logo ?>" alt="Logo"
                                    class="d-block mb-2" style="width:100px; height:auto; object-fit:cover; border-radius:6px;">
                                <input type="file" name="school_logo" id="school_logoInput" class="form-control">
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