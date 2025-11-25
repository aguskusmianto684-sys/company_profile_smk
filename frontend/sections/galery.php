<?php
include '../config/connection.php';

// Ambil semua data gallery
$qGallery = "SELECT * FROM galleries ORDER BY id DESC LIMIT 6";
$result = mysqli_query($connect, $qGallery) or die(mysqli_error($connect));
?>

<!-- Tambahkan CSS Swiper -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<style>
    /* Paksa container swiper punya ruang untuk pagination */
.swiper.myGallery {
  position: relative !important;
  padding-bottom: 70px !important; /* ruang kosong di bawah */
}

/* Paksa pagination selalu di bawah container */
.swiper.myGallery > .swiper-pagination {
  position: absolute !important;
  bottom: 15px !important;
  left: 0 !important;
  width: 100% !important;
  text-align: center !important;
  z-index: 9999 !important;
}

/* Styling bullet */
.swiper.myGallery .swiper-pagination-bullet {
  background: #6c757d !important;
  opacity: 0.5 !important;
  margin: 0 6px !important;
}

.swiper.myGallery .swiper-pagination-bullet-active {
  background: #0056b3 !important;
  opacity: 1 !important;
  transform: scale(1.2);
}

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

    .myGallery .swiper-pagination-bullet {
        background-color: #999 !important;
        opacity: 1 !important;
    }

    .myGallery .swiper-pagination-bullet-active {
        background-color: #007bff !important;
    }

.gallery-meta {
    font-size: 14px;
    color: #555;
    display: flex;
    align-items: center;
    gap: 20px; /* jarak antar item */
}

.gallery-meta i {
    margin-right: 5px;

}

</style>
<section id="gallery" class="portfolio section">
    <div class="container section-title" data-aos="fade-up">
        <h2>Galeri</h2>
        <p>Dokumentasi kegiatan dan pencapaian sekolah.</p>
    </div>

    <div class="container">
        <!-- Wrapper Swiper -->
        <div class="swiper myGallery" data-aos="fade-up" data-aos-delay="200">
            <div class="swiper-wrapper">
                <?php while ($gallery = mysqli_fetch_object($result)):
                    $imagePath = '../storages/galleries/' . $gallery->image;
                    $imageExists = !empty($gallery->image) && file_exists($imagePath);

                    // Batasi deskripsi max 100 karakter
                    $desc = htmlspecialchars($gallery->description);
                    $shortDesc = (strlen($desc) > 100) ? substr($desc, 0, 100) . "..." : $desc;

                    // Format tanggal
                    // $formattedDate = !empty($gallery->date) ? date('d M Y', strtotime($gallery->date)) : '-';
                ?>
                    <div class="swiper-slide">
                        <div class="card h-100 shadow-sm border-0">
                            <?php if ($imageExists): ?>
                                <img src="<?= $imagePath ?>"
                                    class="card-img-top"
                                    alt="<?= $desc ?>"
                                    style="height:220px;object-fit:cover;">
                            <?php else: ?>
                                <img src="assets/img/placeholder.jpg"
                                    class="card-img-top"
                                    alt="Placeholder"
                                    style="height:220px;object-fit:cover;">
                            <?php endif; ?>

                            <div class="card-body">
                                <div class="gallery-meta mt-3">
                                    <!-- <span><i class="bi bi-calendar-event"></i> <?= $formattedDate ?></span> -->
                                    <span><i class="bi bi-person"></i> <?= htmlspecialchars($gallery->author) ?></span>
                                </div>
                                <p class="card-text fw-bold text-justify"><?= $shortDesc ?></p>
                            </div>

                            <div class="card-footer bg-white border-0">
                                <?php if ($imageExists): ?>
                                    <a href="<?= $imagePath ?>"
                                        title="<?= $desc ?>"
                                        data-gallery="gallery-items"
                                        class="btn btn-sm btn-outline-primary glightbox">
                                        <i class="bi bi-zoom-in"></i> Detail
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div><!-- End Slide -->
                <?php endwhile; ?>
            </div>

            <!-- Pagination & Nav -->
            <div class="swiper-pagination"></div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>

        <div class="text-center mt-5">
            <a href="semua_galery.php" class="btn-blue-gradient">Lihat Selengkapnya</a>
        </div>
    </div>
</section>

<!-- Tambahkan JS Swiper -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    var swiper = new Swiper(".myGallery", {
        loop: true,
        spaceBetween: 20,
        centeredSlides: true,
        autoplay: {
            delay: 3000, // auto slide setiap 3 detik
            disableOnInteraction: false,
        },
        speed: 800, // kehalusan transisi (ms)
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        breakpoints: {
            640: {
                slidesPerView: 1
            },
            768: {
                slidesPerView: 2
            },
            1024: {
                slidesPerView: 3
            },
        }
    });
</script>
