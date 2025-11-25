<?php
include '../config/connection.php';

// Ambil 6 pengumuman terbaru
$qAnnouncements = "SELECT * FROM announcements ORDER BY id DESC LIMIT 6";
$result = mysqli_query($connect, $qAnnouncements) or die(mysqli_error($connect));
?>
<style>
    .card-body .btn {
        margin-top: auto;
        align-self: flex-start;
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

    /* Warna panah jadi hitam */
    .swiper-button-next,
    .swiper-button-prev {
        color: black !important;
    }

    /* --- Pagination Styling --- */
    .swiper.announcements-slider {
        position: relative !important;
        padding-bottom: 70px !important;
    }

    .swiper.announcements-slider > .swiper-pagination {
        position: absolute !important;
        bottom: 15px !important;
        left: 0 !important;
        width: 100% !important;
        text-align: center !important;
        z-index: 99 !important;
    }

    .swiper.announcements-slider .swiper-pagination-bullet {
        background: #6c757d !important;
        opacity: 0.5 !important;
        margin: 0 6px !important;
    }

    .swiper.announcements-slider .swiper-pagination-bullet-active {
        background: #0056b3 !important;
        opacity: 1 !important;
        transform: scale(1.2);
    }
</style>

<section id="announcements" class="portfolio section">

    <div class="container section-title" data-aos="fade-up">
        <h2>Pengumuman</h2>
        <p>Informasi terbaru dan pengumuman penting dari sekolah.</p>
    </div>

    <div class="container">
        <!-- Swiper -->
        <div class="swiper announcements-slider" data-aos="fade-up" data-aos-delay="200">
            <div class="swiper-wrapper">

                <?php while ($announcement = mysqli_fetch_object($result)):
                    $imagePath = '../storages/announcements/' . $announcement->announcements_image;
                    $imageExists = !empty($announcement->announcements_image) && file_exists($imagePath);

                    $desc = htmlspecialchars($announcement->announcements_description);
                    $shortDesc = (strlen($desc) > 50) ? substr($desc, 0, 50) . "..." : $desc;
                ?>
                    <div class="swiper-slide">
                        <div class="card h-100 shadow-sm border-0">
                            <?php if ($imageExists): ?>
                                <img src="<?= $imagePath ?>" class="card-img-top" alt="<?= htmlspecialchars($announcement->announcements_title) ?>" style="height:200px;object-fit:cover;">
                            <?php else: ?>
                                <img src="assets/img/placeholder.jpg" class="card-img-top" alt="Placeholder" style="height:200px;object-fit:cover;">
                            <?php endif; ?>

                            <div class="card-body d-flex flex-column">
                                <?php if (!empty($announcement->date)) : ?>
                                    <p class="text-muted mb-2">
                                        <i class="bi bi-calendar-event"></i>
                                        <?= date('d M Y', strtotime($announcement->date)) ?>
                                    </p>
                                <?php endif; ?>
                                <h5 class="card-title fw-bold"><?= htmlspecialchars($announcement->announcements_title) ?></h5>

                                <p class="card-text"><?= $shortDesc ?></p>

                                <!-- Tombol Detail -->
                                <a href="<?= $imagePath ?>"
                                    class="btn btn-sm btn-outline-primary align-self-start glightbox"
                                    data-gallery="announcements-gallery"
                                    data-title="<?= htmlspecialchars($announcement->announcements_title) ?>"
                                    data-description="<?= htmlspecialchars($announcement->announcements_description) ?>">
                                    <i class="bi bi-zoom-in"></i> Detail
                                </a>
                            </div>

                        </div>
                    </div>
                <?php endwhile; ?>

            </div>

            <!-- Tombol Navigasi -->
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>

            <!-- Pagination -->
            <div class="swiper-pagination"></div>
        </div>

        <div class="text-center mt-5">
            <a href="semua_pengumuman.php" class="btn-blue-gradient">Lihat Selengkapnya</a>
        </div>
    </div>
</section>

<!-- Swiper CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<!-- Glightbox -->
<link href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Swiper Slider
        new Swiper(".announcements-slider", {
            slidesPerView: 3,
            spaceBetween: 20,
            loop: true,
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
            speed: 800,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            pagination: {
                el: ".announcements-slider .swiper-pagination",
                clickable: true,
            },
            breakpoints: {
                0: { slidesPerView: 1 },
                768: { slidesPerView: 2 },
                1200: { slidesPerView: 3 }
            }
        });

        // Glightbox
        GLightbox({
            selector: '.glightbox',
            touchNavigation: true,
            loop: true,
            openEffect: 'zoom',
            closeEffect: 'fade',
            slideEffect: 'slide',
        });
    });
</script>
