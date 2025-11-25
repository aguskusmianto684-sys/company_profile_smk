<?php
$page = "blog";
include '../../partials/header.php';
include '../../partials/sidebar.php';
include '../../partials/navbar.php';
include '../../actions/blogs/show.php'; // ambil $blog
?>

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header" style="background: linear-gradient(135deg, white, #0077b6, #90e0ef); border: none;">
                        <h5>Edit Data Berita</h5>
                    </div>
                    <div class="card-body">
                        <form action="../../actions/blogs/update.php?id=<?= $blog->id ?>" method="POST" enctype="multipart/form-data">

                            <div class="mb-3">
                                <label class="form-label">Judul</label>
                                <input type="text" class="form-control" name="title"
                                    value="<?= htmlspecialchars($blog->title) ?>" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Penulis</label>
                                <input type="text" class="form-control" name="author"
                                    value="<?= htmlspecialchars($blog->author) ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="dateInput" class="form-label">Tanggal</label>
                                <input type="date" name="date" class="form-control" id="dateInput" required value="<?= $blog->date ?>">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Konten</label>
                                <textarea name="content" class="form-control" rows="5" required><?= htmlspecialchars($blog->content) ?></textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Gambar</label><br>
                                <img src="../../../storages/blogs/<?= $blog->image ?>" style="width:100px; height:100px; object-fit:contain; margin-bottom:10px;">
                                <input type="file" class="form-control" name="image">
                            </div>

                            <button type="submit" class="btn btn-warning">Edit</button>
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