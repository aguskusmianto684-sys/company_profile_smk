<?php
session_start();

// ✅ cek login
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    echo "<script>
        alert('Silakan login terlebih dahulu!');
        window.location.href='../../pages/user/login.php';
    </script>";
    exit();
}

$page = "dashboard";
include '../../partials/header.php';
include '../../partials/sidebar.php';
include '../../partials/navbar.php';

// Default value untuk nama sekolah
$school_name = "SMKN 3 BANJAR";

// Coba koneksi ke database
$config_path = '../../config/database.php';
if (file_exists($config_path)) {
    require_once $config_path;

    try {
        if (isset($conn)) {
            $query = "SELECT school_name FROM abouts LIMIT 1";
            $result = mysqli_query($conn, $query);
            if ($result && mysqli_num_rows($result) > 0) {
                $data = mysqli_fetch_assoc($result);
                $school_name = $data['school_name'];
            }
        }
    } catch (Exception $e) {
        $school_name = "SMKN 3 BANJAR";
    }
}
?>
<style>
    .table-bordered th,
    .table-bordered td {
        border: 1px solid #dee2e6 !important;
    }

    .card-body i.fas {
        font-size: 1.5rem !important;
        /* override ukuran inline 3rem */
    }
</style>

<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <!-- Statistik Cards -->
        <div class="row">
            <div class="col-12">

                <div class="row">
                    <!-- Card Welcome -->
                    <div class="col-md-12 mb-4">
                        <div class="card text-white" style="background: linear-gradient(135deg, #011936, #023e8a); border: none;">
                            <div class="card-body text-center py-5">
                                <h1 class="fw-bold">SELAMAT DATANG</h1>
                                <h3 class="mb-0 text-uppercase">Di <?= htmlspecialchars($school_name) ?></h3>
                                <div id="datetime" class="mt-2 fw-semibold"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Statistik Cepat -->
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="mx-3">
                                        <div class="bg-primary bg-opacity-10 p-3 rounded text-white">
                                            <i class="fas fa-graduation-cap" style="font-size: 3rem;"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 text-start">
                                        <h2 class="text-muted mb-1">Total Jurusan</h2>
                                        <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'): ?>

                                            <a href="../majors/index.php" class="text-decoration-none link-primary">Lihat Detail</a>
                                        <?php endif; ?>
                                    </div>
                                    <div class="ms-3 text-end">
                                        <?php
                                        $qCountMajors = "SELECT COUNT(*) as total FROM majors";
                                        $resCountMajors = mysqli_query($connect, $qCountMajors);
                                        $totalMajors = mysqli_fetch_object($resCountMajors)->total;
                                        ?>
                                        <h1 class="fw-bold text-dark mb-0"><?= $totalMajors ?></h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="mx-3">
                                        <div class="bg-success bg-opacity-10 p-3 rounded text-white">
                                            <i class="fas fa-trophy" style="font-size: 3rem;"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 text-start">
                                        <h2 class="text-muted mb-1">Total Prestasi</h2>
                                        <a href="../achievements/index.php" class="text-decoration-none link-primary">Lihat Detail</a>
                                    </div>
                                    <div class="ms-3 text-end">
                                        <?php
                                        $qCountAchievements = "SELECT COUNT(*) as total FROM achievements";
                                        $resCountAchievements = mysqli_query($connect, $qCountAchievements);
                                        $totalAchievements = mysqli_fetch_object($resCountAchievements)->total;
                                        ?>
                                        <h1 class="fw-bold text-dark mb-0"><?= $totalAchievements ?></h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="mx-3">
                                        <div class="bg-warning bg-opacity-10 p-3 rounded text-white">
                                            <i class="fas fa-chalkboard-teacher" style="font-size: 3rem;"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 text-start">
                                        <h2 class="text-muted mb-1">Total Guru</h2>
                                        <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'): ?>

                                            <a href="../teachers/index.php" class="text-decoration-none link-primary">Lihat Detail</a>
                                        <?php endif; ?>
                                    </div>
                                    <div class="ms-3 text-end">
                                        <?php
                                        $qCountTeachers = "SELECT COUNT(*) as total FROM teachers";
                                        $resCountTeachers = mysqli_query($connect, $qCountTeachers);
                                        $totalTeachers = mysqli_fetch_object($resCountTeachers)->total;
                                        ?>
                                        <h1 class="fw-bold text-dark mb-0"><?= $totalTeachers ?></h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Grafik Pie Guru & Pesan Bulanan -->
                    <div class="col-md-6 mb-4">
                        <div class="card">
                            <div class="card-header bg-info text-white"
                                style="background: linear-gradient(135deg, #023e8a, #0077b6, #90e0ef); border: none;">
                                Statistik Guru Berdasarkan Jenis Kelamin
                            </div>
                            <div class="card-body d-flex align-items-center" style="height:400px;">
                                <!-- Chart -->
                                <div style="flex:1;">
                                    <canvas id="chartGuru"></canvas>
                                </div>

                                <!-- Keterangan -->
                                <div class="ms-3" style="flex:1;">
                                    <h6>Keterangan:</h6>
                                    <ul class="list-unstyled">
                                        <?php
                                        // Query jumlah guru by gender
                                        $qTeachers = "SELECT jk, COUNT(*) as total FROM teachers GROUP BY jk";
                                        $resTeachers = mysqli_query($connect, $qTeachers);

                                        $teacherLabels = [];
                                        $teacherCounts = [];
                                        $totalGuru = 0;
                                        while ($row = mysqli_fetch_assoc($resTeachers)) {
                                            $teacherLabels[] = $row['jk'];
                                            $teacherCounts[] = (int)$row['total'];
                                            $totalGuru += (int)$row['total'];
                                        }

                                        // bikin list keterangan dengan warna sama chart
                                        $colors = ['#36A2EB', '#FF6384', '#FFCE56', '#4BC0C0'];
                                        foreach ($teacherLabels as $i => $label) {
                                            $jumlah = $teacherCounts[$i];
                                            $persen = $totalGuru > 0 ? round(($jumlah / $totalGuru) * 100, 1) : 0;
                                            $nama = ($label == 'L' ? 'Laki-laki' : ($label == 'P' ? 'Perempuan' : $label));
                                            echo "<li><span style='color:{$colors[$i]}'>●</span> {$nama}: {$jumlah} ({$persen}%)</li>";
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 mb-4">
                        <div class="card">
                            <div class="card-header text-white"
                                style="background: linear-gradient(135deg, #023e8a, #0077b6, #90e0ef); border: none;">
                                <h5 class="mb-0">Statistik Pesan Masuk per Bulan</h5>
                            </div>
                            <div class="card-body" style="height:400px;">
                                <canvas id="messagesChart"></canvas>
                            </div>
                        </div>
                    </div>

                    <!-- Aktivitas Detail -->
                    <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'): ?>
                        <div class="col-md-12 mb-4">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-center text-white"
                                    style="background: linear-gradient(135deg, #023e8a, #0077b6, #90e0ef); border: none;">
                                    <h5 class="mb-0">Detail Aktivitas User</h5>
                                    <a href="../aktivitas/index.php" class="btn btn-sm btn-primary" style="padding: 0.25rem 0.5rem;">Lihat Semua</a>
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
                                                            LIMIT 5
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
                                                                <td>" . htmlspecialchars($row['name']) . "</td>
                                                                <td class='text-center'><span class='badge bg-primary'>" . htmlspecialchars($row['activity']) . "</span></td>
                                                                <td class='text-center'>" . ($row['table_name'] ?? '-') . "</td>
                                                                <td>" . htmlspecialchars($desc) . "</td>
                                                                <td class='text-center'>" . date("d M Y H:i:s", strtotime($row['created_at'])) . "</td>
                                                            </tr>";
                                                        $no++;
                                                    }
                                                } else {
                                                    echo "<tr><td colspan='6' class='text-center'>Belum ada aktivitas detail</td></tr>";
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Recent Messages -->
                    <div class="col-md-12 mb-4">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center text-white"
                                style="background: linear-gradient(135deg, #023e8a, #0077b6, #90e0ef); border: none;">
                                <h5 class="mb-0">Pesan Terbaru</h5>
                                <a href="../message/index.php" class="btn btn-sm btn-primary" style="padding: 0.25rem 0.5rem;">Lihat Semua</a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">

                                        <thead>
                                            <tr class="text-capitalize text-center">
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Email</th>
                                                <th>Telepon</th>
                                                <th>Subjek</th>
                                                <th>Pesan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $qmessage = "SELECT * FROM message ORDER BY id DESC LIMIT 5";
                                            $resmessage = mysqli_query($connect, $qmessage);

                                            if ($resmessage && $resmessage->num_rows > 0) {
                                                $no = 1;
                                                while ($row = $resmessage->fetch_object()) {
                                                    $name = $row->name ?? '-';
                                                    $email = $row->email ?? '-';
                                                    $telepon = $row->telepon ?? '-';
                                                    $subjek = $row->subjek ?? '-';
                                                    $pesan = $row->message ?? '-';
                                                    $shortMessage = strlen($pesan) > 50 ? substr($pesan, 0, 50) . '...' : $pesan;

                                                    echo "<tr>
                                                        <td>$no</td>
                                                        <td class='text-capitalize'>" . htmlspecialchars($name) . "</td>
                                                        <td>" . htmlspecialchars($email) . "</td>
                                                        <td>" . htmlspecialchars($telepon) . "</td>
                                                        <td>" . htmlspecialchars($subjek) . "</td>
                                                        <td class='text-capitalize'>" . htmlspecialchars($shortMessage) . "</td>
                                                    </tr>";
                                                    $no++;
                                                }
                                            } else {
                                                echo "<tr><td colspan='6' class='text-center'>Tidak ada data kontak</td></tr>";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div> <!-- row -->
            </div>
        </div>

        <?php
        // ===== PIE CHART TEACHERS =====
        $qTeachers = "SELECT jk, COUNT(*) as total FROM teachers GROUP BY jk";
        $resTeachers = mysqli_query($connect, $qTeachers);
        $teacherLabels = [];
        $teacherCounts = [];
        while ($row = mysqli_fetch_assoc($resTeachers)) {
            $teacherLabels[] = $row['jk'];
            $teacherCounts[] = $row['total'];
        }

        
        // ===== CHART PESAN PER BULAN =====
        $qMessages = "SELECT MONTH(created_at) as bulan, COUNT(*) as total 
              FROM message 
              WHERE YEAR(created_at) = YEAR(CURDATE())
              GROUP BY MONTH(created_at)";

        $resMessages = mysqli_query($connect, $qMessages);

        $bulanLabels = [];
        $pesanCounts = [];
        $namaBulan = [1 => 'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
        for ($i = 1; $i <= 12; $i++) {
            $bulanLabels[] = $namaBulan[$i];
            $pesanCounts[$i] = 0;
        }
        while ($row = mysqli_fetch_assoc($resMessages)) {
            $pesanCounts[(int)$row['bulan']] = $row['total'];
        }
        ?>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>

        <script>
            // PIE CHART GURU
            const ctxGuru = document.getElementById('chartGuru').getContext('2d');
            new Chart(ctxGuru, {
                type: 'pie',
                data: {
                    labels: <?= json_encode(array_map(function ($jk) {
                                return $jk == 'L' ? 'Laki-laki' : ($jk == 'P' ? 'Perempuan' : $jk);
                            }, $teacherLabels)) ?>,
                    datasets: [{
                        data: <?= json_encode($teacherCounts) ?>,
                        backgroundColor: ['#36A2EB', '#FF6384', '#FFCE56', '#4BC0C0'],
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        },
                        datalabels: {
                            formatter: (value, ctx) => {
                                let sum = ctx.chart.data.datasets[0].data.reduce((a, b) => a + b, 0);
                                let percentage = (value * 100 / sum).toFixed(1) + "%";
                                return percentage;
                            },
                            color: '#fff',
                            font: {
                                weight: 'bold',
                                size: 14
                            }
                        }
                    }
                },
                plugins: [ChartDataLabels]
            });

            // BAR CHART PESAN
            new Chart(document.getElementById('messagesChart'), {
                type: 'bar',
                data: {
                    labels: <?= json_encode($bulanLabels) ?>,
                    datasets: [{
                        label: 'Jumlah Pesan',
                        data: <?= json_encode(array_values($pesanCounts)) ?>,
                        backgroundColor: 'blue',
                        borderRadius: 10
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1
                            }
                        }
                    }
                }
            });
        </script>
        <script>
            function updateDateTime() {
                const dt = new Date();

                // Format hari
                const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
                const months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];

                const dayName = days[dt.getDay()];
                const date = dt.getDate();
                const month = months[dt.getMonth()];
                const year = dt.getFullYear();

                // Format jam: menit:detik
                const hours = String(dt.getHours()).padStart(2, '0');
                const minutes = String(dt.getMinutes()).padStart(2, '0');
                const seconds = String(dt.getSeconds()).padStart(2, '0');

                const timeStr = `${hours}:${minutes}:${seconds}`;
                const dateStr = `${dayName}, ${date} ${month} ${year}`;

                document.getElementById('datetime').textContent = `${dateStr} | ${timeStr}`;
            }

            // Update tiap detik
            setInterval(updateDateTime, 1000);
            updateDateTime(); // update awal
        </script>

        <?php
        include '../../partials/footer.php';
        include '../../partials/script.php';
        ?>