<?php
$page = "announcements";
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
                        <h5>Ubah Data Pengumuman</h5>
                    </div>
                    <div class="card-body">
                        <?php
                        include '../../actions/announcements/show.php';
                        ?>
                        <form action="../../actions/announcements/update.php?id=<?= $announcement->id ?>" method="POST" enctype="multipart/form-data">

                            <div class="mb-3">
                                <label for="announcements_titleInput" class="form-label">Judul</label>
                                <input type="text" class="form-control" name="announcements_title" id="announcements_titleInput" placeholder="Masukan judul pengumuman..." required value="<?= $announcement->announcements_title ?>">
                            </div>

                            <div class="mb-3">
                                <label for="dateInput" class="form-label">Tanggal</label>
                                <input type="date" name="date" class="form-control" id="dateInput" required value="<?= $announcement->date ?>">
                            </div>

                            <div class="mb-3">
                                <label for="announcements_descriptionInput" class="form-label">Deskripsi</label>
                                <textarea name="announcements_description" id="announcements_descriptionInput" class="form-control" placeholder="Masukan deskripsi pengumuman" rows="5"><?= $announcement->announcements_description ?></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="announcements_imageInput" class="form-label">Gambar</label>
                                <img src="../../../storages/announcements/<?= $announcement->announcements_image ?>" alt="Gambar Pengumuman"
                                    class="d-block mb-2" style="width:120px; height:auto; object-fit:cover; border-radius:6px;">
                                <input type="file" name="announcements_image" id="announcements_imageInput" class="form-control">
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