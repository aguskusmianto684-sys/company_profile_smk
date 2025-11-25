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
                        <h5>Ubah Data Kepala Sekolah</h5>
                    </div>
                    <div class="card-body">
                        <?php
                        include '../../actions/headmasters/show.php';
                        ?>
                        <form action="../../actions/headmasters/update.php?id=<?= $headmaster->id ?>" method="POST" enctype="multipart/form-data">

                            <div class="mb-3">
                                <label for="headmaster_nameInput" class="form-label">Nama</label>
                                <input type="text" class="form-control" name="headmaster_name" id="headmaster_nameInput" placeholder="Masukan nama kepala sekolah..." required value="<?= $headmaster->headmaster_name ?>">
                            </div>

                            <div class="mb-3">
                                <label for="headmaster_descriptionInput" class="form-label">Deskripsi</label>
                                <textarea name="headmaster_description" id="headmaster_descriptionInput" class="form-control" placeholder="Masukan deskripsi kepala sekolah" rows="10"><?= $headmaster->headmaster_description ?></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="headmaster_photoInput" class="form-label">Foto</label>
                                <img src="../../../storages/headmasters/<?= $headmaster->headmaster_photo ?>" alt="Foto Kepala Sekolah"
                                    class="d-block mb-2" style="width:120px; height:auto; object-fit:cover; border-radius:6px;">
                                <input type="file" name="headmaster_photo" id="headmaster_photoInput" class="form-control">
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