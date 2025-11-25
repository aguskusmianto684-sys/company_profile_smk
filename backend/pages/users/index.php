<?php
session_start();

// ✅ Cek login
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
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

$page = "users";
include __DIR__ . '/../../../config/connection.php';
include '../../partials/header.php';
include '../../partials/sidebar.php';
include '../../partials/navbar.php';

// Ambil data users urut DESC
$qUsers = "SELECT * FROM users ORDER BY id DESC";
$result = mysqli_query($connect, $qUsers) or die(mysqli_error($connect));
?>

<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css"/>
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css"/>

<!-- content -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="card shadow-sm">
            <div class="card-header d-flex align-items-center justify-content-between"
                style="background: linear-gradient(135deg, white, #0077b6, #90e0ef); border: none;">
                <h5 class="mb-0">Tabel Users</h5>
                <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'): ?>

                            
                    <a href="./create.php" class="btn btn-primary btn-sm">
                        <i class="bi bi-plus-circle"></i> Tambah
                    </a>
                        <?php endif; ?>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="usersTable" class="table table-bordered table-hover align-middle">
                        <thead class="table-light text-center">
                            <tr>
                                <th style="width: 50px;">No</th>
                                <th style="width: 180px;">Nama</th>
                                <th style="width: 220px;">Email</th>
                                <th style="width: 150px;">Akses</th>
                                <th style="width: 150px;">Dibuat</th>
                                <th style="width: 150px;">Diperbarui</th>
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
                                    <td class="text-uppercase"><?= htmlspecialchars($item->name) ?></td>
                                    <td><?= htmlspecialchars($item->email) ?></td>
                                    <td><?= htmlspecialchars($item->role) ?></td>
                                    <td class="text-center">
                                        <?= $item->created_at ? date("d-m-Y H:i:s", strtotime($item->created_at)) : '-' ?>
                                    </td>
                                    <td class="text-center">
                                        <?= $item->updated_at ? date("d-m-Y H:i:s", strtotime($item->updated_at)) : '-' ?>
                                    </td>
                                    <td class="text-center">
                                        <a href="./detail.php?id=<?= $item->id ?>" class="btn btn-success btn-sm">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="./edit.php?id=<?= $item->id ?>" class="btn btn-warning btn-sm">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <a href="../../actions/users/destroy.php?id=<?= $item->id ?>"
                                           class="btn btn-danger btn-sm"
                                           onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php
                                $no++;
                                endwhile;
                            else:
                            ?>
                                <tr>
                                    <td colspan="7" class="text-center text-muted">Belum ada data</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

<?php
include '../../partials/footer.php';
include '../../partials/script.php';
?>

<script>
$(document).ready(function() {
    $('#usersTable').DataTable({
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
        buttons: [
            { extend: 'copy', text: '<i class="bi bi-clipboard"></i> Copy', className: 'btn btn-secondary btn-sm' },
            { extend: 'excel', text: '<i class="bi bi-file-earmark-excel"></i> Excel', className: 'btn btn-success btn-sm' },
            { extend: 'csv', text: '<i class="bi bi-filetype-csv"></i> CSV', className: 'btn btn-info btn-sm text-white' },
            { extend: 'pdf', text: '<i class="bi bi-file-earmark-pdf"></i> PDF', className: 'btn btn-danger btn-sm' },
            { extend: 'print', text: '<i class="bi bi-printer"></i> Print', className: 'btn btn-dark btn-sm' }
        ]
    });
});
</script>
