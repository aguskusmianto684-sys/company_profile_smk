<?php
include '../config/connection.php';

// Ambil semua data Organisasi
$qEkstra = "SELECT * FROM extracurriculars ORDER BY id DESC";
$result = mysqli_query($connect, $qEkstra) or die(mysqli_error($connect));
?>

<!-- Swiper CSS & GLightbox CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" />
<script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>

<style>
    /* Paksa container swiper punya ruang untuk pagination */
.swiper.mySwiper {
  position: relative !important;
  padding-bottom: 70px !important; /* ruang kosong di bawah */
}

/* Paksa pagination selalu di bawah container */
.swiper.mySwiper > .swiper-pagination {
  position: absolute !important;
  bottom: 15px !important;
  left: 0 !important;
  width: 100% !important;
  text-align: center !important;
  z-index: 9999 !important;
}

/* Styling bullet */
.swiper.mySwiper .swiper-pagination-bullet {
  background: #6c757d !important;
  opacity: 0.5 !important;
  margin: 0 6px !important;
}

.swiper.mySwiper .swiper-pagination-bullet-active {
  background: #0056b3 !important;
  opacity: 1 !important;
  transform: scale(1.2);
}

    .swiper-slide .card {
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        height: 100%;
    }

    .swiper-slide .card {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        /* supaya tombol tetap di bawah */
        height: 100%;
    }

    .swiper-slide .card-footer {
        display: flex;
        justify-content: flex-start;
        /* tombol di kiri */
        padding: 0.5rem 1rem;
        background: transparent;
        border-top: none;
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
</style>

<section id="extracurriculars" class="py-5" style="background:#000; color:#fff;">
    <div class="container">
        <!-- Section Title -->
        <div class="section-title text-center mb-5" data-aos="fade-up">
            <h2 class="fw-bold text-white text-uppercase">Organisasi</h2>
            <p class="fw-semibold text-light">Kegiatan organisasi yang ada di SMKN 3 Banjar.</p>
        </div>

        <?php if (mysqli_num_rows($result) > 0): ?>
            <div class="swiper mySwiper" data-aos="fade-up" data-aos-delay="200">
                <div class="swiper-wrapper">
                    <?php while ($ekstra = mysqli_fetch_object($result)): ?>
                        <div class="swiper-slide">
                            <div class="card h-100 text-center p-4 border-0 shadow-lg"
                                style="background:#fff; color:#222; border-radius:15px; position:relative; transition: all 0.5s ease;">

                                <!-- Logo/Ikon -->
                                <?php if (!empty($ekstra->image)): ?>
                                    <img src="../storages/extracurriculars/<?= htmlspecialchars($ekstra->image) ?>"
                                        alt="<?= htmlspecialchars($ekstra->name) ?>"
                                        class="mx-auto d-block mb-3"
                                        style="width:140px; height:140px; object-fit:contain;">
                                <?php else: ?>
                                    <span class="text-muted">Tidak ada gambar</span>
                                <?php endif; ?>

                                <!-- Nama -->
                                <h5 class="fw-bold mb-1"><?= htmlspecialchars($ekstra->name) ?></h5>

                                <!-- Coach -->
                                <p class="mb-2 text-secondary small">
                                    <i class="bi bi-person-check"></i>
                                    <strong>Pembina:</strong> <?= !empty($ekstra->coach) ? htmlspecialchars($ekstra->coach) : '-' ?>
                                </p>

                                <!-- Deskripsi Singkat -->
                                <p class="small mb-4 text-muted text-justify">
                                    <?= !empty($ekstra->description)
                                        ? htmlspecialchars(substr($ekstra->description, 0, 120)) . '...'
                                        : 'Belum ada deskripsi.' ?>
                                </p>

                                <!-- Tombol Detail di kiri bawah -->
                                <div class="card-footer">
                                    <a href="#detail-<?= $ekstra->id ?>"
                                        class="btn btn-sm btn-outline-primary glightbox"
                                        data-glightbox="type:inline">
                                        <i class="bi bi-zoom-in"></i> Detail
                                    </a>
                                </div>


                            </div>
                        </div>

                        <!-- Konten Detail (disembunyikan) -->
<div id="detail-<?= $ekstra->id ?>" style="display:none;">
  <div style="max-width:900px; margin:auto; text-align:center;"> 
      <!-- Tambah text-align:center -->
      
      <!-- Nama -->
      <h2 class="mb-3"><?= htmlspecialchars($ekstra->name) ?></h2>
      
      <!-- Gambar -->
      <?php if (!empty($ekstra->image)): ?>
          <img src="../storages/extracurriculars/<?= htmlspecialchars($ekstra->image) ?>"
              class="img-fluid mb-3"
              style="max-height:300px; object-fit:contain; display:block; margin:auto;"
              alt="Detail Organisasi">
      <?php endif; ?>

      <!-- Pembina -->
      <p class="fw-semibold">
          <i class="bi bi-person-check"></i>
          <strong>Pembina:</strong> <?= !empty($ekstra->coach) ? htmlspecialchars($ekstra->coach) : '-' ?>
      </p>

      <!-- Deskripsi tetap justify biar rapi -->
      <p class="mt-3" style="text-align:justify;">
          <?= nl2br(htmlspecialchars($ekstra->description)) ?>
      </p>
  </div>
</div>

                    <?php endwhile; ?>
                </div>

                <!-- Navigation -->
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                <!-- Pagination -->
                <div class="swiper-pagination"></div>
            </div>
        <?php else: ?>
            <p class="text-center text-light">Belum ada data organisasi yang tersedia.</p>
        <?php endif; ?>

            <div class="text-center mt-5">
      <a href="semua_ekstrakulikuler.php" class="btn-blue-gradient">Lihat Selengkapnya</a>
    </div>
    </div>
</section>

<!-- Custom CSS -->
<style>
    #extracurriculars .card:hover {
        transform: translateY(-10px);
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.35);
    }

    .swiper {
        padding: 50px 0;
    }

    .swiper-button-next,
    .swiper-button-prev {
        color: #fff;
        transition: all 0.3s ease;
    }

    .swiper-button-next:hover,
    .swiper-button-prev:hover {
        color: #0d6efd;
    }

    .swiper-pagination-bullet {
        background: #fff;
        opacity: 0.6;
    }

    .swiper-pagination-bullet-active {
        background: #0d6efd;
        opacity: 1;
    }

    .swiper-wrapper {
        transition-timing-function: ease-in-out !important;
    }

    .text-justify {
        text-align: justify;
    }
</style>

<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Swiper dengan animasi lebih lambat
        var swiper = new Swiper(".mySwiper", {
            slidesPerView: 3,
            spaceBetween: 20,
            loop: true,
            speed: 1800, // animasi lebih lambat
            autoplay: {
                delay: 4000,
                disableOnInteraction: false,
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            breakpoints: {
                0: {
                    slidesPerView: 1
                },
                768: {
                    slidesPerView: 2
                },
                1200: {
                    slidesPerView: 3
                },
            },
        });

        // GLightbox HANYA SEKALI
        GLightbox({
            selector: '.glightbox',
            touchNavigation: true,
            loop: false,
            zoomable: true
        });
    });
</script>