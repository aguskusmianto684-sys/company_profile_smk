<?php
include '../config/connection.php';

// Ambil keyword dari GET
$keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';

// Ambil data terbaru dari abouts
$qAbouts = "SELECT * FROM abouts ORDER BY id asc LIMIT 1";
$result = mysqli_query($connect, $qAbouts) or die(mysqli_error($connect));
$about = mysqli_fetch_assoc($result);

$qContact = "SELECT * FROM contacts ORDER BY id asc LIMIT 1";
$result = mysqli_query($connect, $qContact) or die(mysqli_error($connect));
$contact = mysqli_fetch_assoc($result);

// Ambil 4 galeri terbaru
$qGalleries = "SELECT * FROM galleries ORDER BY id DESC LIMIT 4";
$rGalleries = mysqli_query($connect, $qGalleries) or die(mysqli_error($connect));

// Ambil semua data social media
$qSocmed = "SELECT * FROM social_media ORDER BY id ASC";
$resSocmed = mysqli_query($connect, $qSocmed);

// Query guru
$qteachers = "SELECT * FROM teachers";
if (!empty($keyword)) {
    $safe_keyword = mysqli_real_escape_string($connect, $keyword);
    $qteachers .= " WHERE teachers_name LIKE '%$safe_keyword%' 
                    OR teachers_major LIKE '%$safe_keyword%'
                    OR jk LIKE '%$safe_keyword%'";
}
$qteachers .= " ORDER BY id DESC";
$result = mysqli_query($connect, $qteachers) or die(mysqli_error($connect));
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMKN 3 Banjar</title>
    <link href="temp_user/assets/img/logosmk.png" rel="icon">
    <!-- Vendor CSS Files -->
    <link href="temp_user/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="temp_user/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="temp_user/assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="temp_user/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="temp_user/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="temp_user/assets/css/main.css" rel="stylesheet">
    <!-- Fonts -->
<link href="https://fonts.googleapis.com" rel="preconnect">
<link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <style>
        body {
            background: #f8f9fa;
            font-family: 'Segoe UI', sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            /* full layar */
        }

        main {
            flex: 1;
            /* isi konten akan mendorong footer ke bawah */
        }

        /* Banner */
        .banner {
            background: linear-gradient(135deg, #023e8a, #0096c7);
            color: white;
        }

        /* Kartu guru */
        .card {
            transition: transform 0.2s, box-shadow 0.2s;
            border: none;
            opacity: 0;
            transform: translateY(20px);
            animation: fadeInUp 0.6s ease forwards;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
        }

        .card-img-top {
            height: 260px;
            object-fit: cover;
            border-top-left-radius: .75rem;
            border-top-right-radius: .75rem;
        }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Search box */
        .search-box {
            max-width: 600px;
            margin: 0 auto 2rem auto;
        }

        .search-box .input-group a {
            padding: 0 .75rem;
        }

          .content {
    flex: 1;
  }

  .btn-outline-primary {
    border-radius: 10px;
    font-weight: 500;
    transition: all 0.25s ease;
  }

  .btn-outline-primary:hover {
    background: #0d47a1;
    border-color: #0d47a1;
    color: #fff;
  }

  /* breadcrumb */
  .breadcrumb {
    background: transparent;
    margin-bottom: 0;
  }

  .breadcrumb-item a {
    color: #fff;
    text-decoration: none;
  }

  .breadcrumb-item a:hover {
    text-decoration: underline;
  }

  .breadcrumb-item.active {
    color: #ddd;
  }

  .container {
    margin-bottom: 60px;
  }
    </style>
</head>

<body>

    <!-- Banner Atas -->
    <section class="py-5 text-center banner">
        <div>
            <h1 class="fw-bold display-5">Daftar Guru SMKN 3 Banjar</h1>
            <p class="lead">Profil lengkap guru dan pengajar kami</p>
            <!-- Breadcrumb di dalam banner -->
            <nav aria-label="breadcrumb" class="d-flex justify-content-center mt-3">
                <ol class="breadcrumb bg-transparent m-0 p-0">
                    <li class="breadcrumb-item"><a href="./index.php" class="text-white">Beranda</a></li>
                    <li class="breadcrumb-item"><a href="./index.php#teachers" class="text-white">Guru</a></li>
                    <li class="breadcrumb-item active text-white">Kontak</li>
                </ol>
            </nav>
        </div>
    </section>

    <main class="container">


        <!-- Form Search -->
        <form method="get" role="search" class="search-box mt-3">
            <div class="input-group input-group-lg shadow-sm rounded-pill overflow-hidden">
                <!-- input -->
                <input type="text" name="keyword" class="form-control border-0"
                    placeholder=" Cari guru atau jurusan..."
                    value="<?= htmlspecialchars($keyword) ?>">

                <!-- tombol clear (jika ada keyword) -->
                <?php if (!empty($keyword)): ?>
                    <a href="./all_teachers.php" class="bg-white border-0 d-flex align-items-center px-2">
                        <i class="bi bi-x-circle text-secondary"></i>
                    </a>
                <?php endif; ?>

                <!-- tombol cari -->
                <button class="btn btn-primary px-4" type="submit">
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </form>

        <!-- Grid Card -->
        <div class="row row-cols-2 row-cols-sm-3 row-cols-md-5 g-3">
            <?php if ($result->num_rows > 0): ?>
                <?php while ($item = $result->fetch_object()): ?>
                    <div class="col">
                        <div class="card h-100 shadow-sm rounded-3">

                            <!-- Foto Guru -->
                            <img src="../storages/teachers/<?= $item->teachers_photo ?>"
                                class="card-img-top"
                                alt="<?= $item->teachers_name ?>">

                            <div class="card-body text-center">
                                <!-- Nama Guru -->
                                <h6 class="fw-bold mb-1"><?= $item->teachers_name ?></h6>

                                <!-- Mata Pelajaran / Jurusan -->
                                <?php if (!empty($item->teachers_major)): ?>
                                    <small class="text-muted"><?= $item->teachers_major ?></small>
                                <?php endif; ?>
                            </div>

                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <!-- Kalau Tidak Ada Data -->
                <div class="col-12">
                    <div class="alert alert-warning text-center shadow-sm rounded-3 p-4">
                        <i class="bi bi-exclamation-triangle fs-3 text-warning"></i>
                        <h5 class="mt-2">Guru tidak ditemukan</h5>
                        <p class="mb-0">Coba gunakan kata kunci lain atau hapus pencarian.</p>
                        <a href="./teachers.php" class="btn btn-outline-primary mt-3">Tampilkan Semua Guru</a>
                    </div>
                </div>
            <?php endif; ?>
        </div>

    </main>

<style>/* Grid 2 kolom, masing-masing isi 4 link */
.footer-links ul {
  display: grid;
  grid-template-columns: repeat(2, 1fr); /* 2 kolom */
  gap: 10px 40px; /* baris 10px, kolom 40px */
  padding: 0;
  margin: 0;
  list-style: none;
}.footer-links ul li a {
  text-decoration: underline;
  color: #fff;
  transition: color 0.3s ease;
  display: inline-block;
}

.footer-links ul li a:hover {
  color: #0d6efd;
  text-decoration-thickness: 2px;
}
h1, h2, h3, h4, h5, h6 {
    color: white;
    font-family: var(--heading-font);
}

</style>

<footer id="footer" class="footer dark-background">
  <div class="container footer-top">
    <div class="row gy-4 justify-content-between">

      <!-- Tentang Sekolah -->
      <div class="col-lg-4 col-md-6 footer-about">
        <a href="index.php" class="logo d-flex align-items-center">
          <span class="sitename"><?= htmlspecialchars($about['school_name']); ?></span>
        </a>
        <div class="footer-contact pt-3">
          <p>
            <i class="bi bi-geo-alt-fill me-2 "></i>
            <?= htmlspecialchars($about['alamat']); ?>
          </p>
          <p class="mt-2">
            <i class="bi bi-telephone-fill me-2"></i>
            <?= htmlspecialchars($contact['contact']); ?>
          </p>
          <p class="mt-2">
            <i class="bi bi-envelope-fill me-2"></i>
            <?= htmlspecialchars($contact['email']); ?>
          </p>
        </div>

        <!-- social links -->
        <div class="social-links d-flex mt-4" style="gap: 20px; font-size: 28px;">
          <?php if (mysqli_num_rows($resSocmed) > 0): ?>
            <?php while ($soc = $resSocmed->fetch_object()): ?>
              <a href="<?= htmlspecialchars($soc->link_url) ?>"
                 target="_blank"
                 style="color: #fff;"
                 title="<?= htmlspecialchars($soc->title) ?>">
                 <i class="<?= htmlspecialchars($soc->icon) ?>"></i>
              </a>
            <?php endwhile; ?>
          <?php endif; ?>
        </div>
      </div>

      <!-- Tautan Penting -->
      <div class="col-lg-3 col-md-6 footer-links">
        <h4>Tautan Penting</h4>
        <ul>
          <li><a href="./index.php">Beranda</a></li>
          <li><a href="./index.php#tabs">Tentang Kami</a></li>
          <li><a href="./index.php#major">Jurusan</a></li>
          <li><a href="./index.php#announcements">Pengumuman</a></li>
          <li><a href="./index.php#extracurriculars">Organisasi</a></li>
          <li><a href="./index.php#visi_missions">Visi & Misi</a></li>
          <li><a href="./index.php#teachers">Guru</a></li>
          <li><a href="./index.php#blogs">Berita</a></li>
        </ul>
      </div>

      <!-- Galeri Terbaru -->
      <div class="col-lg-4 col-md-12 footer-newsletter">
        <h4 class="text-center">Galeri Terbaru</h4>
        <div class="row g-2">
          <?php while ($gal = mysqli_fetch_assoc($rGalleries)): ?>
            <div class="col-6">
              <img src="../storages/galleries/<?= htmlspecialchars($gal['image']); ?>"
                   alt="<?= htmlspecialchars($gal['description']); ?>"
                   class="img-fluid rounded shadow-sm"
                   style="height:90px; width:100%; object-fit:cover;">
            </div>
          <?php endwhile; ?>
        </div>
      </div>

    </div>
  </div>
</footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>