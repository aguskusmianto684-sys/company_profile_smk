<?php
session_start();
// Cek login
if (!isset($_SESSION['logged_in'])) {
    echo "<script>
        alert('Silakan login terlebih dahulu!');
        window.location.href='../user/login.php';
    </script>";
    exit();
}

// Cek role superadmin
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

// ambil ID dari URL
$id = (int) $_GET['id'];
$qDetail = "
    SELECT 
        ua.id,
        u.name,
        ua.activity,
        ua.table_name,
        ua.record_id,
        ua.description,
        ua.ip_address,
        ua.user_agent,
        ua.created_at
    FROM user_activities ua
    LEFT JOIN users u ON ua.user_id = u.id
    WHERE ua.id = '$id'
    LIMIT 1
";
$resDetail = mysqli_query($connect, $qDetail);
$activity = mysqli_fetch_object($resDetail);
?>

<!-- content -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header" style="background: linear-gradient(135deg, white, #0077b6, #90e0ef); border: none;">
                        <h5>Detail Aktivitas User</h5>
                    </div>
                    <div class="card-body">
                        <?php if ($activity) { ?>
                        <form>
                            <div class="mb-3">
                                <label class="form-label">Nama User</label>
                                <input type="text" class="form-control" value="<?= htmlspecialchars($activity->name) ?>" disabled>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Aktivitas</label>
                                <input type="text" class="form-control" value="<?= htmlspecialchars($activity->activity) ?>" disabled>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Tabel</label>
                                <input type="text" class="form-control" value="<?= $activity->table_name ?>" disabled>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Record ID</label>
                                <input type="text" class="form-control" value="<?= $activity->record_id ?>" disabled>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Deskripsi</label>
                                <textarea class="form-control" rows="4" disabled><?= $activity->description ?></textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">IP Address</label>
                                <input type="text" class="form-control" value="<?= $activity->ip_address ?>" disabled>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">User Agent</label>
                                <textarea class="form-control" rows="2" disabled><?= $activity->user_agent ?></textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Waktu</label>
                                <input type="text" class="form-control" value="<?= date("d M Y H:i:s", strtotime($activity->created_at)) ?>" disabled>
                            </div>

                            <a href="./index.php" class="btn btn-primary">Kembali</a>
                        </form>
                        <?php } else { ?>
                            <p class="text-danger">Data aktivitas tidak ditemukan.</p>
                            <a href="./index.php" class="btn btn-primary">Kembali</a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>

        <?php
        include '../../partials/footer.php';
        include '../../partials/script.php';
        ?>
