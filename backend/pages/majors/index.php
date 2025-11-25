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
$page = "majors";
include __DIR__ . '/../../../config/connection.php';
include '../../partials/header.php';
include '../../partials/sidebar.php';
include '../../partials/navbar.php';

// Ambil data majors urut DESC
$qMajor = "SELECT * FROM majors ORDER BY id DESC";
$result = mysqli_query($connect, $qMajor) or die(mysqli_error($connect));
?>

<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css" />

<!-- content -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header d-flex align-items-center justify-content-between"
                        style="background: linear-gradient(135deg, white, #0077b6, #90e0ef); border: none;">
                        <h5 class="mb-0">Tabel Jurusan</h5>
                        <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'): ?>

                            <a href="create.php" class="btn btn-primary">Tambah</a>
                        <?php endif; ?>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="majorsTable" class="table table-bordered table-hover align-middle">
                                <thead class="table-light text-center">
                                    <tr>
                                        <th style="width: 50px;">No</th>
                                        <th style="width: 100px;">Gambar</th>
                                        <th style="width: 180px;">Jurusan</th>
                                        <th style="width: 180px;">Kepala Jurusan</th>
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
                                                    <?php if (!empty($item->majors_image)): ?>
                                                        <img src="../../../storages/majors/<?= $item->majors_image ?>"
                                                            alt="Logo Jurusan"
                                                            style="width:80px; height:80px; object-fit:scale-down; border-radius:6px;">
                                                    <?php else: ?>
                                                        <span class="text-muted">-</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="fw-bold text-uppercase"><?= $item->majors_name ?></td>
                                                <td><?= $item->head ?></td>
                                                <td><?= strlen($item->majors_description) > 100 ? substr($item->majors_description, 0, 100) . '...' : $item->majors_description ?></td>
                                                <td class="text-center">
                                                    <a href="./detail.php?id=<?= $item->id ?>" class="btn btn-success btn-sm">
                                                        <i class="bi bi-eye"></i>
                                                    </a>
                                                    <a href="./edit.php?id=<?= $item->id ?>" class="btn btn-warning btn-sm">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </a>
                                                    <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'): ?>
                                                        <a href="../../actions/majors/destroy.php?id=<?= $item->id ?>"
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
                                            <td colspan="6" class="text-center text-muted">Belum ada data</td>
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

        <script>
            $(document).ready(function() {
                $('#majorsTable').DataTable({
                    "pageLength": 5,
                    "lengthMenu": [5, 10, 25, 50],
                    "language": {
                        "search": "Cari:",
                        "lengthMenu": "Tampilkan _MENU_ data",
                        "zeroRecords": "Data tidak ditemukan",
                        "info": "Menampilkan _START_ - _END_ dari _TOTAL_ data",
                        "infoEmpty": "Tidak ada data tersedia",
                        "infoFiltered": "(difilter dari total _MAX_ data)"
                    },
                    dom: '<"d-flex justify-content-between align-items-center mb-2"Bf>rtip',
                    buttons: [{
                            extend: 'copy',
                            text: '<i class="bi bi-clipboard"></i> Copy',
                            className: 'btn btn-secondary btn-sm'
                        },
                        {
                            extend: 'excel',
                            text: '<i class="bi bi-file-earmark-excel"></i> Excel',
                            className: 'btn btn-success btn-sm'
                        },
                        {
                            extend: 'csv',
                            text: '<i class="bi bi-filetype-csv"></i> CSV',
                            className: 'btn btn-info btn-sm text-white'
                        },
                        {
                            extend: 'pdf',
                            text: '<i class="bi bi-file-earmark-pdf"></i> PDF',
                            className: 'btn btn-danger btn-sm'
                        },
                        {
                            extend: 'print',
                            text: '<i class="bi bi-printer"></i> Print',
                            className: 'btn btn-dark btn-sm'
                        }
                    ]
                });
            });
        </script>