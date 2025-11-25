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

$page = "extracurriculars";
include __DIR__ . '/../../../config/connection.php';
include '../../partials/header.php';
include '../../partials/sidebar.php';
include '../../partials/navbar.php';

// Ambil data
$qExtracurriculars = "SELECT * FROM extracurriculars ORDER BY id DESC";
$result = mysqli_query($connect, $qExtracurriculars) or die(mysqli_error($connect));
?>

<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css" />

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row mb-3">
            <div class="col-12 d-flex flex-column flex-md-row justify-content-between align-items-md-center">
                <h4 class="mb-3 mb-md-0">Tabel Organisasi</h4>
                <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'): ?>

                    <a href="create.php" class="btn btn-primary">Tambah</a>
                <?php endif; ?>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header d-flex align-items-center justify-content-between"
                        style="background: linear-gradient(135deg, white, #0077b6, #90e0ef); border: none;">
                        <h5 class="mb-0">Data Organisasi</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="ekskulTable" class="table table-bordered table-hover align-middle">
                                <thead class="table-light text-center">
                                    <tr>
                                        <th style="width: 50px;">No</th>
                                        <th>Gambar</th>
                                        <th>Nama</th>
                                        <th>Pembina</th>
                                        <th>Deskripsi</th>
                                        <th style="width: 200px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    if ($result && $result->num_rows > 0):
                                        while ($item = $result->fetch_object()):
                                            $desc = strip_tags($item->description);
                                            $desc = strlen($desc) > 100 ? substr($desc, 0, 100) . "..." : $desc;
                                    ?>
                                            <tr>
                                                <td class="text-center"><?= $no ?></td>
                                                <td class="text-center">
                                                    <?php if (!empty($item->image)): ?>
                                                        <img src="../../../storages/extracurriculars/<?= $item->image ?>"
                                                            alt="Logo Ekstrakurikuler"
                                                            style="width:100px; height:100px; object-fit:contain;">
                                                    <?php else: ?>
                                                        <span class="text-muted">-</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td><?= htmlspecialchars($item->name) ?></td>
                                                <td><?= htmlspecialchars($item->coach) ?></td>
                                                <td><?= $desc ?></td>
                                                <td class="text-center">
                                                    <a href="./detail.php?id=<?= $item->id ?>" class="btn btn-success btn-sm" title="Detail">
                                                        <i class="bi bi-eye"></i>
                                                    </a>
                                                    <a href="./edit.php?id=<?= $item->id ?>" class="btn btn-warning btn-sm" title="Edit">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </a>
                                                    <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'): ?>
                                                        <a href="../../actions/extracurriculars/destroy.php?id=<?= $item->id ?>"
                                                            class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')"
                                                            title="Hapus">
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
                $('#ekskulTable').DataTable({
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
                    ],
                    columnDefs: [{
                            targets: [1, 5],
                            orderable: false
                        } // gambar & aksi tidak bisa di-sort
                    ]
                });
            });
        </script>