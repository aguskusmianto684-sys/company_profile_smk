<?php
include '../config/connection.php';

// Ambil semua data achievements
$qAchievements = "SELECT * FROM achievements ORDER BY id DESC";
$result = mysqli_query($connect, $qAchievements) or die(mysqli_error($connect));
?>
<style>
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
        font-size: 14px;
        color: #6c757d;
        margin-bottom: 10px;
    }

    .meta-info i {
        margin-right: 6px;
    }
    /* Pastikan container slider ada ruang untuk pagination */
.swiper.achievements-slider {
  position: relative !important;
  padding-bottom: 70px !important; /* ruang kosong bawah */
}

/* Paksa pagination absolute di bawah container */
.swiper.achievements-slider > .swiper-pagination {
  position: absolute !important;
  bottom: 15px !important;
  left: 0 !important;
  width: 100% !important;
  text-align: center !important;
  z-index: 10 !important;
}

/* Styling bullet */
.swiper.achievements-slider .swiper-pagination-bullet {
  background: #6c757d !important;
  opacity: 0.5 !important;
  margin: 0 6px !important;
}

.swiper.achievements-slider .swiper-pagination-bullet-active {
  background: #0056b3 !important;
  opacity: 1 !important;
  transform: scale(1.2);
}

</style>
<section id="achievements" class="achievements section section-bg dark-background">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
        <h2>Prestasi</h2>
        <p>Beberapa pencapaian terbaik dari siswa/i SMKN 3 Banjar</p>
    </div>
    <!-- End Section Title -->

    <div class="container">

        <!-- Swiper Container -->
        <div class="swiper achievements-slider" data-aos="fade-up" data-aos-delay="100">
            <div class="swiper-wrapper">

                <?php while ($row = mysqli_fetch_object($result)):
                    $imagePath = !empty($row->image)
                        ? "../storages/achievements/" . htmlspecialchars($row->image)
                        : "../assets/img/no-image.png";
                    $desc = strip_tags($row->description);
                ?>
                    <div class="swiper-slide">
                        <div class="card h-100 shadow-sm border-0 text-center">

                            <!-- Gambar prestasi -->
                            <img src="<?= $imagePath ?>"
                                alt="<?= htmlspecialchars($row->title) ?>"
                                class="card-img-top"
                                style="height:220px; object-fit:cover;">

                            <!-- Isi Card -->
                            <div class="card-body d-flex flex-column text-start">

                                <!-- Judul -->
                                <h4 class="card-title fw-bold mb-2">
                                    <?= htmlspecialchars($row->title) ?>
                                </h4>

                                <!-- Info tanggal & author -->
                                <div class="meta-info d-flex gap-3 mb-2">
                                    <span><i class="bi bi-calendar3"></i><?= date("d M Y", strtotime($row->date)) ?></span>
                                    <span><i class="bi bi-person"></i><?= htmlspecialchars($row->author) ?></span>
                                </div>

                                <!-- Deskripsi -->
                                <p class="card-text text-dark mb-3" style="text-align:justify; flex-grow:1;">
                                    <?= strlen($desc) > 100 ? substr($desc, 0, 100) . "..." : $desc ?>
                                </p>

                                <!-- Tombol detail selalu di bawah -->
                                <a href="<?= $imagePath ?>"
                                    title="<?= htmlspecialchars($row->title) . ' - ' . htmlspecialchars($desc) ?>"
                                    data-gallery="gallery-achievements"
                                    class="btn btn-sm btn-outline-primary glightbox mt-auto align-self-start">
                                    <i class="bi bi-zoom-in"></i> Detail
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>

            </div>
            <!-- Pagination & Navigation -->
            <div class="swiper-pagination"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>

        <!-- Tombol Lihat Selengkapnya -->
        <div class="text-center mt-5">
            <a href="semua_prestasi.php" class="btn-blue-gradient">Lihat Selengkapnya</a>
        </div>

    </div>
</section>

<!-- SwiperJS CSS & JS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        new Swiper(".achievements-slider", {
            slidesPerView: 3,
            spaceBetween: 30,
            loop: true,
            autoplay: {
                delay: 3500,
                disableOnInteraction: false,
            },
            speed: 900,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            breakpoints: {
                320: {
                    slidesPerView: 1
                },
                768: {
                    slidesPerView: 2
                },
                1024: {
                    slidesPerView: 3
                }
            }
        });
    });
</script>