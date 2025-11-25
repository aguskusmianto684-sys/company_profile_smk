<?php
include '../config/connection.php';

// Ambil keyword pencarian (jika ada)
$keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : "";

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



// Query data ekstrakurikuler
$qEkskul = "SELECT * FROM extracurriculars";
if (!empty($keyword)) {
    $qEkskul .= " WHERE name LIKE '%$keyword%' OR coach LIKE '%$keyword%' OR description LIKE '%$keyword%'";
}
$qEkskul .= " ORDER BY id DESC";
$result = mysqli_query($connect, $qEkskul) or die(mysqli_error($connect));

// Cek apakah user klik tombol lihat selengkapnya
$lihatId = isset($_GET['lihat']) ? intval($_GET['lihat']) : 0;
$lihatEkskul = null;
if ($lihatId) {
    $qlihat = "SELECT * FROM extracurriculars WHERE id = $lihatId";
    $resLihat = mysqli_query($connect, $qlihat);
    if (mysqli_num_rows($resLihat) > 0) {
        $lihatEkskul = mysqli_fetch_object($resLihat);
    }
}

// Card besar untuk search otomatis
$searchEkskul = null;
if (!$lihatEkskul && !empty($keyword) && mysqli_num_rows($result) > 0) {
    $searchEkskul = mysqli_fetch_object($result); // ambil pertama hasil search
}
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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: #f4f6f9;
            font-family: 'Segoe UI', sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .content {
            flex: 1;
        }

        /* Banner biru */
        .banner {
            background: linear-gradient(135deg, #023e8a, #0096c7);
            color: white;
            padding: 60px 20px;
            text-align: center;
            border-bottom-left-radius: 20px;
            border-bottom-right-radius: 20px;
        }

        .banner h2 {
            font-weight: 700;
        }

        .banner p {
            font-size: 18px;
            margin-top: 10px;
        }

        .card {
            border-radius: 14px;
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }

        .card:hover {
            transform: translateY(-6px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.12);
        }

        .card img {
            width: 100%;
            object-fit: contain;
        }

        .card-title {
            font-size: 20px;
            font-weight: 600;
            color: black;
        }

        .card-text {
            text-align: justify;
        }

        /* Badge Coach */
        .badge-coach {
            background: #e0f0ff;
            color: #000;
            font-weight: bold;
            font-size: 14px;
            padding: 6px 14px;
            border-radius: 20px;
            display: inline-block;
        }

        .card-large {
            border-radius: 14px;
            padding: 20px;
            margin-bottom: 40px;
            background: #fff;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .card-large img {
            max-height: 400px;
            width: auto;
            object-fit: contain;
            margin-bottom: 15px;
        }

        /* Tambahan untuk card kecil */
        .card-body {
            display: flex;
            flex-direction: column;
        }

        .card-body p {
            flex-grow: 1;
            /* isi teks akan mendorong tombol ke bawah */
        }

        /* Styling tombol */
        .btn-primary {
            background-color: #0d6efd;
            /* default bootstrap */
            border: none;
        }

        .btn-primary:hover {
            background-color: #0b5ed7;
            /* hover */
        }

        .btn-primary:active {
            background-color: #023e8a !important;
            /* biru tua saat diklik */
            box-shadow: none !important;
        }

        /* Tombol "Lihat Selengkapnya" default putih */
        .btn-lihat {
            background-color: #fff !important;
            color: #0d6efd !important;
            border: 2px solid #0d6efd !important;
            transition: all 0.3s ease-in-out;
            border-radius: 6px;
            padding: 6px 14px;
            font-weight: 500;
        }

        /* Hover */
        .btn-lihat:hover {
            background-color: #0d6efd !important;
            color: #fff !important;
        }

        /* Active (saat diklik) */
        .btn-lihat:active {
            background-color: #023e8a !important;
            border-color: #023e8a !important;
            color: #fff !important;
            box-shadow: none !important;
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
        /* Logo ekskul seragam */
/* Logo ekskul seragam */
.card-body img,
.card-large img {
    width: 150px;       /* sedang, tidak terlalu besar */
    height: 150px;
    object-fit: contain;
    margin: 0 auto 15px;
    display: block;
}

/* Rapikan jarak container ke footer */
.container {
    margin-bottom: 20px !important; /* tadinya 60px, jadi lebih dekat */
}

/* Kalau card besar kebawahnya terlalu jauh, bisa dikurangi juga */
.card-large {
    margin-bottom: 25px; /* tadinya 40px */
}


    </style>
</head>

<body>
    <div class="content">

        <div class="banner">
            <h2>Daftar Ekstrakurikuler SMKN 3 Banjar</h2>
            <p>Kegiatan penunjang minat dan bakat siswa</p>
            <!-- Breadcrumb di dalam banner -->
            <nav aria-label="breadcrumb" class="d-flex justify-content-center mt-3">
                <ol class="breadcrumb bg-transparent m-0 p-0">
                    <li class="breadcrumb-item"><a href="./index.php" class="text-white">Beranda</a></li>
                    <li class="breadcrumb-item"><a href="./index.php#extracurriculars" class="text-white">Organisasi</a></li>
                    <li class="breadcrumb-item active text-white"><a href="./index.php#extracurriculars" class="text-white">Kontak</a></li>
                </ol>
            </nav>
        </div>

        <div class="container mt-4 pb-5">


            <!-- Tombol kembali -->
            <!-- <div class="mb-4">
                <a href="./index.php#extracurriculars" class="btn btn-outline-primary px-4">← Kembali ke Ekstrakurikuler</a>
            </div> -->

            <!-- Form Search -->
            <div class="d-flex justify-content-center my-5">
                <form method="get" role="search" class="search-box w-75">
                    <div class="input-group input-group-lg shadow-sm rounded-pill overflow-hidden">
                        <input type="text" name="keyword" class="form-control border-0"
                            placeholder=" Cari nama ekskul atau pembina..."
                            value="<?= htmlspecialchars($keyword) ?>">
                        <?php if (!empty($keyword)): ?>
                            <a href="./semua_ekstrakulikuler.php" class="bg-white border-0 d-flex align-items-center px-2">
                                <i class="bi bi-x-circle text-secondary"></i>
                            </a>
                        <?php endif; ?>
                        <button class="btn btn-primary px-4" type="submit">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </form>
            </div>


            <!-- Card Besar -->
            <?php if ($lihatEkskul): ?>
                <div class="card-large" id="lihatSelengkapnya">
                    <img src="../storages/extracurriculars/<?= $lihatEkskul->image ?>" alt="<?= $lihatEkskul->name ?>">
                    <h3 class="card-title"><?= $lihatEkskul->name ?></h3>
                    <?php if ($lihatEkskul->coach): ?>
                        <span class="badge-coach">Pembina: <?= $lihatEkskul->coach ?></span>
                    <?php endif; ?>
                    <p class="card-text mt-3"><?= nl2br($lihatEkskul->description) ?></p>
                </div>
            <?php elseif ($searchEkskul): ?>
                <div class="card-large" id="lihatSelengkapnya">
                    <img src="../storages/extracurriculars/<?= $searchEkskul->image ?>" alt="<?= $searchEkskul->name ?>">
                    <h3 class="card-title"><?= $searchEkskul->name ?></h3>
                    <?php if ($searchEkskul->coach): ?>
                        <span class="badge-coach">Pembina: <?= $searchEkskul->coach ?></span>
                    <?php endif; ?>
                    <p class="card-text mt-3"><?= nl2br($searchEkskul->description) ?></p>
                </div>
            <?php endif; ?>

            <!-- Grid Card Kecil -->
            <div class="row g-4">
                <?php if (mysqli_num_rows($result) > 0): ?>
                    <?php
                    mysqli_data_seek($result, 0); // reset pointer
                    while ($item = mysqli_fetch_object($result)):
                        // skip card besar yang sudah ditampilkan
                        if (($lihatEkskul && $item->id == $lihatEkskul->id) || ($searchEkskul && $item->id == $searchEkskul->id)) continue;
                    ?>
                        <div class="col-md-6 col-lg-4">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-body text-center p-4 d-flex flex-column">
                                    <img src="../storages/extracurriculars/<?= $item->image ?>" alt="<?= $item->name ?>" class="img-fluid mb-3">
                                    <h5 class="card-title"><?= $item->name ?></h5>
                                    <?php if ($item->coach): ?>
                                        <span class="badge-coach my-2">Pembina: <?= $item->coach ?></span>
                                    <?php endif; ?>
                                    <p class="card-text text-secondary mt-3 flex-grow-1">
                                        <?= strlen($item->description) > 100 ? substr($item->description, 0, 100) . '...' : $item->description ?>
                                    </p>
                                    <a href="?lihat=<?= $item->id ?>&keyword=<?= urlencode($keyword) ?>"
                                        class="btn btn-lihat mt-auto">Lihat Selengkapnya</a>

                                </div>
                            </div>
                        </div>

                    <?php endwhile; ?>
                <?php else: ?>
                    <div class="col-12 text-center text-muted">
                        <p>Tidak ada ekstrakurikuler ditemukan.</p>
                    </div>
                <?php endif; ?>
            </div>

        </div>
    </div>

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