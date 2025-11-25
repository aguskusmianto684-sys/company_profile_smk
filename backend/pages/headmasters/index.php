<?php
session_start();
if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin') {
}
// Cek jika belum login, redirect ke login
if (!isset($_SESSION['logged_in'])) {
    echo "<script>
        alert('Silakan login terlebih dahulu!');
        window.location.href='../user/login.php';
    </script>";
    exit();
}

$page = "headmasters";
include __DIR__ . '/../../../config/connection.php';
include '../../partials/header.php';
include '../../partials/sidebar.php';
include '../../partials/navbar.php';

// Ambil data headmasters urut DESC
$qHeadmaster = "SELECT * FROM headmasters ORDER BY id DESC";
$result = mysqli_query($connect, $qHeadmaster) or die(mysqli_error($connect));
?>

<!-- content -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header d-flex align-items-center justify-content-between"
                        style="background: linear-gradient(135deg, white, #0077b6, #90e0ef); border: none;">
                        <h5 class="mb-0">Tabel Kepala Sekolah</h5>
                        <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'): ?>

                            <a href="create.php" class="btn btn-primary">Tambah</a>
                        <?php endif; ?>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="headmasterTable" class="table table-bordered table-hover align-middle">
                                <thead class="table-light text-center">
                                    <tr>
                                        <th style="width: 50px;">No</th>
                                        <th style="width: 100px;">Foto</th>
                                        <th style="width: 200px;">Nama</th>
                                        <th>Deskripsi</th>
                                        <th style="width: 200px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    if ($result && $result->num_rows > 0):
                                        while ($item = $result->fetch_object()):
                                    ?>
                                            <tr>
                                                <td class="text-center"><?= $no ?></td>
                                                <td class="text-center">
                                                    <?php if (!empty($item->headmaster_photo)): ?>
                                                        <img src="../../../storages/headmasters/<?= $item->headmaster_photo ?>"
                                                            alt="Foto Kepala Sekolah"
                                                            style="width:80px; height:80px; object-fit:contain; background:#f8f9fa; padding:4px;">
                                                    <?php else: ?>
                                                        <span class="text-muted">-</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="fw-bold text-uppercase"><?= $item->headmaster_name ?></td>
                                                <td><?= strlen($item->headmaster_description) > 100 ? substr($item->headmaster_description, 0, 100) . '...' : $item->headmaster_description ?></td>
                                                <td class="text-center">
                                                    <a href="./detail.php?id=<?= $item->id ?>" class="btn btn-success btn-sm">
                                                        <i class="bi bi-eye"></i>
                                                    </a>
                                                    <a href="./edit.php?id=<?= $item->id ?>" class="btn btn-warning btn-sm">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </a>
                                                    <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'): ?>
                                                        <a href="../../actions/headmasters/destroy.php?id=<?= $item->id ?>"
                                                            class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">
                                                            <i class="bi bi-trash"></i>
                                                        </a>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        <?php
                                            $no++;
                                        endwhile;
                                    else:
                                        ?>
                                        <tr>
                                            <td colspan="5" class="text-center text-muted">Belum ada data</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
        include '../../partials/footer.php';
        include '../../partials/script.php';
        ?>
