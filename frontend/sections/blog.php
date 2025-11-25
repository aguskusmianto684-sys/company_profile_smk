<?php
include '../config/connection.php';

// Ambil semua blog terbaru
$qBlogs = "SELECT * FROM blogs ORDER BY id DESC";
$result = mysqli_query($connect, $qBlogs) or die(mysqli_error($connect));
$blogs = [];
while ($row = $result->fetch_object()) {
  $blogs[] = $row;
}
?>

<!-- Swiper CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

<!-- GLightbox -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" />
<script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>

<style>
  /* Paksa container slider berita punya ruang buat pagination */
.swiper.blog-slider {
  position: relative !important;
  padding-bottom: 70px !important; /* kasih ruang bawah */
}

/* Paksa pagination muncul di bawah container */
.swiper.blog-slider > .swiper-pagination {
  position: absolute !important;
  bottom: 15px !important;
  left: 0 !important;
  width: 100% !important;
  text-align: center !important;
  z-index: 9999 !important;
}

/* Styling bullet pagination */
.swiper.blog-slider .swiper-pagination-bullet {
  background: #6c757d !important;
  opacity: 0.5 !important;
  margin: 0 6px !important;
}

.swiper.blog-slider .swiper-pagination-bullet-active {
  background: #0056b3 !important;
  opacity: 1 !important;
  transform: scale(1.2);
}

  .card-text {
    text-align: justify;
  }

  .glightbox-container .gdesc-inner {
    max-width: 900px;
    text-align: justify;
    margin: auto;
  }

  .swiper-button-next,
  .swiper-button-prev {
    color: black !important;
  }

  /* Pagination custom */
  .swiper-pagination-bullet {
    background: #fff !important; /* warna default putih */
    opacity: 1;
  }

  .swiper-pagination-bullet-active {
    background: #007bff !important; /* warna aktif biru */
  }

  /* Tombol biru gradasi */
  .btn-blue-gradient {
    display: inline-block;
    padding: 12px 32px;
    border-radius: 50px;
    background: linear-gradient(135deg, #007bff, #0056b3);
    color: #fff !important;
    font-weight: 600;
    font-size: 16px;
    text-decoration: none;
    transition: all 0.3s ease;
    box-shadow: 0 6px 14px rgba(0, 123, 255, 0.3);
    letter-spacing: 0.5px;
  }

  .btn-blue-gradient:hover {
    background: linear-gradient(135deg, #0069d9, #004999);
    color: #fff !important;
    transform: translateY(-3px) scale(1.03);
    box-shadow: 0 8px 20px rgba(0, 123, 255, 0.45);
  }

  .meta-info {
    font-size: 0.85rem;
    color: #6c757d;
    margin-bottom: 8px;
  }

  .meta-info i {
    margin-right: 4px;
  }

  .meta-info span {
    margin-right: 12px;
  }
  .section {
  padding: 50px 0 !important;
}

.section-title {
  margin-bottom: 33px !important;
}

  
</style>

<section id="blogs" class="blogs section section-bg dark-background">
  <div class="container section-title" data-aos="fade-up">
    <h2 >Berita</h2>
    <p>Berita mengenai SMKN 3 Banjar</p>
  </div>

  <div class="container">
    <div class="swiper blog-slider">
      <div class="swiper-wrapper">
        <?php foreach ($blogs as $item):
          $imagePath = "../storages/blogs/" . $item->image;
          $desc = strip_tags($item->content);
          $shortDesc = strlen($desc) > 120 ? substr($desc, 0, 120) . "..." : $desc;
          $date = !empty($item->date) ? date("d M Y", strtotime($item->date)) : "";
        ?>
          <div class="swiper-slide">
            <div class="card h-100 shadow-sm border-0">
              <img src="<?= $imagePath ?>" class="card-img-top" style="height:220px;object-fit:cover;" alt="<?= $item->title ?>">

              <div class="card-body d-flex flex-column">
                <h5 class="card-title fw-bold"><?= $item->title ?></h5>

                <!-- meta info -->
                <div class="meta-info">
                  <span><i class="bi bi-calendar-event"></i><?= $date ?></span>
                  <span><i class="bi bi-person"></i><?= $item->author ?></span>
                </div>

                <p class="card-text"><?= $shortDesc ?></p>

                <a href="#detail-<?= $item->id ?>" class="btn btn-sm btn-outline-primary mt-auto align-self-start glightbox" data-glightbox="type:inline">
                  <i class="bi bi-zoom-in"></i> Detail
                </a>
              </div>
            </div>

            <!-- Konten Detail -->
            <div id="detail-<?= $item->id ?>" style="display:none;">
              <div class="row-100" style="max-width:900px;">
                <h2><?= $item->title ?></h2>
                <p class="text-muted"><i class="bi bi-calendar-event"></i> <?= $date ?> | <i class="bi bi-person"></i> <?= $item->author ?></p>
                <img src="<?= $imagePath ?>" class="img-fluid mb-3" style="max-height:400px;object-fit:cover;" alt="Detail Blog">
                <p style="text-align:justify;"><?= nl2br($item->content) ?></p>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>

      <!-- Navigation -->
      <div class="swiper-button-next"></div>
      <div class="swiper-button-prev"></div>
      <!-- Pagination -->
      <div class="swiper-pagination mt-3"></div>
    </div>

    <div class="text-center mt-5">
      <a href="semua_blog.php" class="btn-blue-gradient">Lihat Selengkapnya</a>
    </div>
  </div>
</section>

<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
  document.addEventListener("DOMContentLoaded", function() {
    // Swiper slider
    new Swiper(".blog-slider", {
      slidesPerView: 3,
      spaceBetween: 20,
      loop: true,
      speed: 800,
      slidesPerGroup: 1, // geser 1 card per klik
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
      autoplay: {
        delay: 4000,
        disableOnInteraction: false,
      },
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
      breakpoints: {
        0: {
          slidesPerView: 1
        },
        768: {
          slidesPerView: 2
        },
        992: {
          slidesPerView: 3
        }
      }
    });

    // GLightbox
    GLightbox({
      selector: '.glightbox',
      touchNavigation: true,
      loop: true,
      zoomable: true
    });
  });
</script>
