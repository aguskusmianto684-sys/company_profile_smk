<?php
$page = "message";
include '../../partials/header.php';
include '../../partials/sidebar.php';
include '../../partials/navbar.php';
include '../../actions/message/show.php';  // Include file untuk mengambil data message
?>

<!-- Konten Halaman -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Detail Pesan</h5> <!-- Judul Halaman -->
                    </div>
                    <div class="card-body">
                        <form>
                            <!-- Input untuk nama (read-only) -->
                            <div class="mb-3">
                                <label for="nameInput" class="form-label">Nama Pengirim</label>
                                <input type="text" class="form-control" value="<?= $message->name ?>" disabled>
                            </div>

                            <!-- Input untuk email (read-only) -->
                            <div class="mb-3">
                                <label for="emailInput" class="form-label">Email Pengirim</label>
                                <input type="text" class="form-control" value="<?= $message->email ?>" disabled>
                            </div>

                            <!-- Textarea untuk pesan (read-only) -->
                            <div class="mb-3">
                                <label for="messageInput" class="form-label">Pesan</label>
                                <textarea class="form-control" rows="8" disabled><?= $message->message ?></textarea>
                            </div>

                            <!-- Tombol Kembali -->
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