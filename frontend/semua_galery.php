<?php
include '../config/connection.php';

$keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : "";
$showId = isset($_GET['show']) ? intval($_GET['show']) : 0;

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


// Ambil semua gallery
$qGalleries = "SELECT * FROM galleries ORDER BY id DESC";
$result = mysqli_query($connect, $qGalleries) or die(mysqli_error($connect));

$bigCard = null;
$smallCards = [];

// Tentukan bigCard & smallCards
while ($row = mysqli_fetch_object($result)) {
    if ($showId && $row->id == $showId) {
        $bigCard = $row;
    } elseif ($keyword && !$bigCard && stripos($row->description, $keyword) !== false) {
        $bigCard = $row;
    } else {
        $smallCards[] = $row;
    }
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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
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

        .banner {
            background: linear-gradient(135deg, #0d47a1, #1976d2);
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
            object-fit: cover;
            border-radius: 12px;
        }

        .card-text {
            text-align: justify;
            font-size: 14px;
            color: #555;
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

        .input-group .clear-btn {
            position: absolute;
            right: 90px;
            top: 50%;
            transform: translateY(-50%);
            border: none;
            background: transparent;
            display: none;
            cursor: pointer;
            z-index: 10;
        }
    </style>
</head>

<body>
    <div class="content">
        <div class="banner">
            <h2>Galeri SMKN 3 Banjar</h2>
            <p>Kumpulan foto kegiatan & momen terbaik</p>
            <nav aria-label="breadcrumb" class="d-flex justify-content-center mt-3">
                <ol class="breadcrumb bg-transparent m-0 p-0">
                    <li class="breadcrumb-item"><a href="./index.php" class="text-white">Beranda</a></li>
                    <li class="breadcrumb-item"><a href="./index.php#gallery" class="text-white">Galeri</a></li>
                    <li class="breadcrumb-item active text-white"><a href="./index.php#gallery" class="text-white">Kontak</a></li>
                </ol>
            </nav>
        </div>

        <div class="container my-4">

            <!-- Form Search -->
            <div class="d-flex justify-content-center my-4 position-relative">
                <form method="get" class="w-75 position-relative">
                    <div class="input-group input-group-lg shadow-sm rounded-pill overflow-hidden position-relative">
                        <input type="text" name="keyword" id="searchInput" class="form-control border-0 ps-4" placeholder="Cari foto..." value="<?= htmlspecialchars($keyword) ?>">
                        <button type="button" id="clearBtn" class="clear-btn"><i class="bi bi-x-circle fs-5 text-secondary"></i></button>
                        <button class="btn btn-primary px-4 rounded-end-pill" type="submit">Cari</button>
                    </div>
                </form>
            </div>

            <!-- Big Card -->
            <?php if ($bigCard): ?>
                <div class="card mb-5 shadow-sm border-0 mx-auto" style="max-width:800px;">
                    <?php if (!empty($bigCard->image)): ?>
                        <img src="../storages/galleries/<?= $bigCard->image ?>" alt="Galeri" class="img-fluid w-100" style="height:400px; object-fit:cover; border-top-left-radius:14px; border-top-right-radius:14px;">
                    <?php endif; ?>
                    <div class="card-body d-flex flex-column">
                        <p class="text-muted mb-2" style="font-size:14px;">
                            <i class="bi bi-calendar-event"></i>
                            <?= !empty($bigCard->date) ? date("d M Y", strtotime($bigCard->date)) : "-" ?>
                            &nbsp; | &nbsp;
                            <i class="bi bi-person-circle"></i> <?= htmlspecialchars($bigCard->author ?? "-") ?>
                        </p>
                        <p class="card-text flex-grow-1"><?= nl2br(htmlspecialchars($bigCard->description)) ?></p>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Small Cards -->
            <div class="row g-4">
                <?php foreach ($smallCards as $item): ?>
                    <?php $date = !empty($item->date) ? date("d M Y", strtotime($item->date)) : ""; ?>
                    <div class="col-md-6 col-lg-4 d-flex">
                        <div class="card h-100 border-0 shadow-sm d-flex flex-column w-100">
                            <?php if (!empty($item->image)): ?>
                                <img src="../storages/galleries/<?= $item->image ?>" alt="Galeri" class="img-fluid w-100" style="height:200px; object-fit:cover; border-top-left-radius:14px; border-top-right-radius:14px;">
                            <?php else: ?>
                                <img src="../assets/img/no-image.png" alt="no image" class="img-fluid w-100" style="height:200px; object-fit:cover; border-top-left-radius:14px; border-top-right-radius:14px;">
                            <?php endif; ?>

                            <div class="card-body d-flex flex-column">
                                <div class="d-flex justify-content-start align-items-center text-muted mb-2" style="font-size:13px;">
                                    
                                    <i class="bi bi-person-circle me-1"></i> <?= htmlspecialchars($item->author ?? "-") ?>
                                </div>

                                <p class="card-text flex-grow-1">
                                    <?= substr(strip_tags($item->description), 0, 120) ?><?= strlen($item->description) > 120 ? "..." : "" ?>
                                </p>
                                <div class="mt-auto">
                                    <a href="?show=<?= $item->id ?><?= !empty($keyword) ? "&keyword=" . urlencode($keyword) : "" ?>" class="btn btn-sm btn-outline-primary w-100">Lihat Selengkapnya</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
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
    <script>
        const searchInput = document.getElementById("searchInput");
        const clearBtn = document.getElementById("clearBtn");

        function toggleClearBtn() {
            clearBtn.style.display = searchInput.value.trim() ? "flex" : "none";
        }
        clearBtn.addEventListener("click", () => {
            searchInput.value = "";
            toggleClearBtn();
            searchInput.focus();
        });
        searchInput.addEventListener("input", toggleClearBtn);
        toggleClearBtn();
    </script>
</body>

</html>