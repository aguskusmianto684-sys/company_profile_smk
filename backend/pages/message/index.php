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
$page = "message"; // Menandai halaman aktif di sidebar
include __DIR__ . '/../../../config/connection.php';  // Koneksi database
include '../../partials/header.php';  // Header template
include '../../partials/sidebar.php';  // Sidebar template
include '../../partials/navbar.php';  // Navbar template

// Query untuk mengambil data message dari database
$qMessage = "SELECT * FROM message ORDER BY id DESC";
$result = mysqli_query($connect, $qMessage) or die(mysqli_error($connect));
?>

<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css"/>
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css"/>

<!-- Konten Halaman -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header" 
                         style="background: linear-gradient(135deg, white, #0077b6, #90e0ef); border: none;">
                        <h5 class="mb-0">Tabel Pesan</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="messageTable" class="table table-bordered table-hover align-middle">
                                <thead class="table-light text-center">
                                    <tr>
                                        <th style="width: 50px;">No</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Subjek</th>
                                        <th>Nomor Telepon</th>
                                        <th>Pesan</th>
                                        <th style="width: 150px;">Aksi</th>
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
                                                <td><?= htmlspecialchars($item->name) ?></td>
                                                <td><?= htmlspecialchars($item->email) ?></td>
                                                <td><?= htmlspecialchars($item->subjek) ?></td>
                                                <td><?= htmlspecialchars($item->telepon) ?></td>
                                                <td>
                                                    <?= strlen($item->message) > 100 ? substr($item->message, 0, 100) . '...' : $item->message ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'): ?>
                                                        
                                                        <a href="../../actions/message/destroy.php?id=<?= $item->id ?>"
                                                           class="btn btn-danger btn-sm"
                                                           onclick="return confirm('Apakah anda yakin ingin menghapus pesan ini?')">
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
                                            <td colspan="7" class="text-center text-muted">Belum ada pesan</td>
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
// Include footer dan script
include '../../partials/footer.php';
include '../../partials/script.php';
?>

<script>
$(document).ready(function() {
    $('#messageTable').DataTable({
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
