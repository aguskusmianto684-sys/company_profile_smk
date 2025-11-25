<?php
$page = "blog";
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
                        <h5>Detail Data Berita</h5>
                    </div>
                    <div class="card-body">
                        <?php
                        include '../../actions/blogs/show.php';
                        ?>
                        <form>
                            <div class="mb-3">
                                <label for="titleInput" class="form-label">Judul</label>
                                <input type="text" class="form-control" value="<?= $blog->title ?>" disabled>
                            </div>

                            
                            <div class="mb-3">
                                <label for="authorInput" class="form-label">Penulis</label>
                                <input type="text" class="form-control" value="<?= $blog->author ?>" disabled>
                            </div>

                            <div class="mb-3">
                                <label for="dateInput" class="form-label">Tanggal</label>
                                <input type="date" class="form-control" value="<?= $blog->date ?>" disabled>
                            </div>

                            <div class="mb-3">
                                <label for="contentInput" class="form-label">Konten</label>
                                <textarea class="form-control" rows="5" disabled><?= $blog->content ?></textarea>
                            </div>

                            <div class="mb-3">
                                <h6>Gambar Blog</h6>
                                <img src="../../../storages/blogs/<?= $blog->image ?>"
                                    alt="Gambar Blog"
                                    style="width:100px; height:100px; object-fit:contain;">
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