<?php
session_start();
// Cek jika belum login, redirect ke login
if (!isset($_SESSION['logged_in'])) {
    echo "<script>
        alert('Silakan login terlebih dahulu!');
        window.location.href='../user/login.php';
    </script>";
    exit();
}

// ✅ Cek role superadmin
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    echo "<script>
        alert('Anda tidak punya akses ke halaman ini!');
        window.location.href='../dashboard/index.php';
    </script>";
    exit();
}
$page = "aktivitas";
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
            <!-- Aktivitas User -->
            <div class="col-md-12 mb-4">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center text-white"
                        style="background: linear-gradient(135deg, #0096c7, #00b4d8, #48cae4); border: none;">
                        <h5 class="mb-0">Tabel Aktivitas User</h5>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="activityTable" class="table table-striped table-bordered">
                                <thead>
                                    <tr class="text-capitalize text-center">
                                        <th>No</th>
                                        <th>Nama User</th>
                                        <th>Aktivitas</th>
                                        <th>Tabel</th>
                                        <th>Deskripsi</th>
                                        <th>Waktu</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $qDetail = "
    SELECT 
        ua.id,
        u.name,
        ua.activity,
        ua.table_name,
        ua.description,
        ua.created_at
    FROM user_activities ua
    LEFT JOIN users u ON ua.user_id = u.id
    ORDER BY ua.created_at DESC
    LIMIT 10
";
                                    $resDetail = mysqli_query($connect, $qDetail);

                                    if ($resDetail && mysqli_num_rows($resDetail) > 0) {
                                        $no = 1;
                                        while ($row = mysqli_fetch_assoc($resDetail)) {
                                            // Batasi deskripsi maksimal 100 karakter
                                            $desc = $row['description'] ?? '-';
                                            if (strlen($desc) > 100) {
                                                $desc = substr($desc, 0, 100) . "...";
                                            }

                                            echo "<tr>
                <td class='text-center'>$no</td>
                <td>" . htmlspecialchars($row['name'] ?? '-') . "</td>
                <td class='text-center'><span class='badge bg-primary'>" . htmlspecialchars($row['activity']) . "</span></td>
                <td class='text-center'>" . htmlspecialchars($row['table_name'] ?? '-') . "</td>
                <td>" . htmlspecialchars($desc) . "</td>
                <td class='text-center'>" . date('d M Y H:i:s', strtotime($row['created_at'])) . "</td>
                <td class='text-center'>
                    <a href='./detail.php?id=" . $row['id'] . "' class='btn btn-success btn-sm'>
                        <i class='bi bi-eye'></i>
                    </a>
             
                    <a href='../../actions/aktivitas/destroy.php?id=" . $row['id'] . "' 
                       class='btn btn-danger btn-sm'
                       onclick=\"return confirm('Apakah anda yakin ingin menghapus aktivitas ini?')\">
                        <i class='bi bi-trash'></i>
                    </a>
                   
                </td>
            </tr>";
                                            $no++;
                                        }
                                    } else {
                                        // ✅ colspan HARUS sama dengan jumlah <th> (di atas ada 7)
                                        echo "<tr><td colspan='7' class='text-center'>Belum ada aktivitas detail</td></tr>";
                                    }
                                    ?>
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
                $('#activityTable').DataTable({
                    "pageLength": 100,
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