<?php
$page = "extracurriculars";
include '../../partials/header.php';
include '../../partials/sidebar.php';
include '../../partials/navbar.php';

// ambil data extracurricular berdasarkan id
include '../../../config/connection.php';
$id = $_GET['id'];
$q = "SELECT * FROM extracurriculars WHERE id=$id";
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
                        <h5>Ubah Data Organisasi</h5>
                    </div>
                    <div class="card-body">
                        <form action="../../actions/extracurriculars/update.php?id=<?= $ekstra->id ?>" method="POST" enctype="multipart/form-data">

                            <div class="mb-3">
                                <label for="nameInput" class="form-label">Nama</label>
                                <input type="text" class="form-control" name="name" id="nameInput" 
                                       placeholder="Masukan nama organisasi..." required 
                                       value="<?= $ekstra->name ?>">
                            </div>

                            <div class="mb-3">
                                <label for="coachInput" class="form-label">Pembina</label>
                                <input type="text" class="form-control" name="coach" id="coachInput" 
                                       placeholder="Masukan nama pembina..." 
                                       value="<?= $ekstra->coach ?>">
                            </div>

                            <div class="mb-3">
                                <label for="descriptionInput" class="form-label">Deskripsi</label>
                                <textarea name="description" id="descriptionInput" 
                                          class="form-control" placeholder="Masukan deskripsi Organisasi" rows="5"><?= $ekstra->description ?></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="imageInput" class="form-label">Gambar</label><br>
                                <?php if ($ekstra->image) { ?>
                                    <img src="../../../storages/extracurriculars/<?= $ekstra->image ?>" alt="Gambar Organisasi"
                                         class="d-block mb-2" style="width:100px; height:100px; object-fit:contain;">
                                <?php } ?>
                                <input type="file" name="image" id="imageInput" class="form-control">
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
