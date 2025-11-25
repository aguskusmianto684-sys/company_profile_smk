<?php
$page = "achievements";
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
                        <h5>Ubah Data Prestarsi</h5>
                    </div>
                    <div class="card-body">
                        <?php
                        include '../../actions/achievements/show.php';
                        ?>
                        <form action="../../actions/achievements/update.php?id=<?= $achievement->id ?>" method="POST" enctype="multipart/form-data">

                            <div class="mb-3">
                                <label for="titleInput" class="form-label">Judul</label>
                                <input type="text" class="form-control" name="title" id="titleInput" placeholder="Masukan judul achievement..." required value="<?= $achievement->title ?>">
                            </div>

                            <div class="mb-3">
                                <label for="dateInput" class="form-label">Tanggal</label>
                                <input type="date" name="date" class="form-control" id="dateInput" required value="<?= $achievement->date ?>">
                            </div>
                            <div class="mb-3">
                                <label for="authorInput" class="form-label">Penulis</label>
                                <input type="text" name="author" class="form-control" id="authorInput" placeholder="Masukkan Nama Penulis..." required value="<?= $achievement->author ?>">
                            </div>

                            <div class="mb-3">
                                <label for="descriptionInput" class="form-label">Deskripsi</label>
                                <textarea name="description" id="descriptionInput" class="form-control" placeholder="Masukan deskripsi achievement" rows="5"><?= $achievement->description ?></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="imageInput" class="form-label">Gambar</label>
                                <img src="../../../storages/achievements/<?= $achievement->image ?>" alt="Gambar Achievement"
                                    class="d-block mb-2" style="width:120px; height:auto; object-fit:cover; border-radius:6px;">
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