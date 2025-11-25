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
                        <h5>Ubah Data Jurusan</h5>
                    </div>
                    <div class="card-body">
                        <?php
                        include '../../actions/majors/show.php';
                        ?>
                        <form action="../../actions/majors/update.php?id=<?= $major->id ?>" method="POST" enctype="multipart/form-data">

                            <div class="mb-3">
                                <label for="majors_nameInput" class="form-label">Nama</label>
                                <input type="text" class="form-control" name="majors_name" id="majors_nameInput" placeholder="Masukan nama jurusan..." required value="<?= $major->majors_name ?>">
                            </div>

                            <div class="mb-3">
                                <label for="headInput" class="form-label">Kepala</label>
                                <input type="text" name="head" class="form-control" id="headInput" placeholder="Masukan nama kepala jurusan..." required value="<?= $major->head ?>">
                            </div>

                            <div class="mb-3">
                                <label for="majors_descriptionInput" class="form-label">Deskripsi</label>
                                <textarea name="majors_description" id="majors_descriptionInput" class="form-control" placeholder="Masukan deskripsi jurusan" rows="30"><?= $major->majors_description ?></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="majors_imageInput" class="form-label">Gambar</label>
                                <img src="../../../storages/majors/<?= $major->majors_image ?>" alt="Gambar Jurusan"
                                    class="d-block mb-2" style="width:120px; height:auto; object-fit:cover; border-radius:6px;">
                                <input type="file" name="majors_image" id="majors_imageInput" class="form-control">
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