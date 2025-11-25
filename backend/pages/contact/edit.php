<?php
// pages/contact/edit.php
$page = "contact";
include '../../partials/header.php';
include '../../partials/sidebar.php';
include '../../partials/navbar.php';
include '../../actions/contact/show.php';
?>

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header" style="background: linear-gradient(135deg, white, #0077b6, #90e0ef); border: none;">
                        <h5>Edit Data Kontak</h5>
                    </div>
                    <div class="card-body">
                        <form action="../../actions/contact/update.php?id=<?= $contact->id ?>" method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="contactInput" class="form-label">Kontak</label>
                                <input type="text" class="form-control" name="contact" id="contactInput"
                                    value="<?= $contact->contact ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="emailInput" class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" id="emailInput"
                                    value="<?= $contact->email ?>" required>

                                <div class="mb-3">
                                    <label for="linkUrlInput" class="form-label">Tautan URL</label>
                                    <input type="url" class="form-control" name="link_url" id="linkUrlInput"
                                        value="<?= $contact->link_url ?>">
                                </div>

                                <div class="mb-3">
                                    <label for="iconInput" class="form-label">Ikon</label>
                                    <input type="text" class="form-control" name="icon" id="iconInput"
                                        value="<?= $contact->icon ?>" required>
                                </div>


                                <button type="submit" class="btn btn-warning me-3" name="tombol">edit</button>
                                <a href="./index.php" class="btn btn-primary">Kembali</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <?php
        include '../../partials/footer.php';
        include '../../partials/script.php';
        ?>