<?php
include '../config/connection.php';

// Ambil data terbaru dari abouts
$qAbout = "SELECT * FROM abouts ORDER BY id ASC LIMIT 1";
$resAbout = mysqli_query($connect, $qAbout);
$itemAbout = $resAbout->fetch_object();

// Ambil semua data social media
$qSocmed = "SELECT * FROM social_media ORDER BY id ASC";
$resSocmed = mysqli_query($connect, $qSocmed);
?>
<style>
    /* Overlay gradasi */
    .hero::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(180deg, rgba(0, 0, 0, 0.6) 0%, rgba(0, 0, 0, 0.85) 100%);
        z-index: 1;
    }

    /* Typing effect untuk slogan */
    .slogan-text {
        display: inline-block;
        border-right: 2px solid #fff;
        white-space: nowrap;
        overflow: hidden;
        width: 0;
        animation: typing 4s steps(40, end) forwards, blink 0.7s infinite;
    }

    /* Animasi mengetik */
    @keyframes typing {
        from {
            width: 0
        }

        to {
            width: 100%
        }
    }

    /* Animasi cursor blink */
    @keyframes blink {
        50% {
            border-color: transparent
        }
    }

    /* Hilangkan cursor setelah selesai */
    .slogan-text.finished {
        border-right: none !important;
    }



    /* Efek glow icon */
    .social-links a {
        transition: all 0.3s ease;
    }

    .social-links a:hover {
        color: #0d6efd !important;
        text-shadow: 0 0 12px rgba(13, 110, 253, 0.7);
        transform: scale(1.2);
    }

    /* Floating animation untuk tombol */
    .btn-main,
    .btn-video {
        animation: float 3s ease-in-out infinite;
    }

    @keyframes float {

        0%,
        100% {
            transform: translateY(0)
        }

        50% {
            transform: translateY(-6px)
        }
    }


    /* Style umum */
    .btn-main,
    .btn-video {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 16px;
        padding: 12px 32px;
        border-radius: 50px;
        text-decoration: none;
        transition: all 0.3s ease;
        min-width: 180px;
        text-align: center;
        cursor: pointer;
        letter-spacing: 0.5px;
    }

    /* Tombol utama */
    .btn-main {
        background: linear-gradient(135deg, #007bff, #0056b3);
        /* gradasi biru */
        color: #fff;
        box-shadow: 0 6px 14px rgba(0, 123, 255, 0.3);
    }

    .btn-main:hover {
        background: linear-gradient(135deg, #0069d9, #004999);
        transform: translateY(-3px) scale(1.03);
        box-shadow: 0 8px 20px rgba(0, 123, 255, 0.4);
        color: #fff;
    }

    /* Tombol video */
    /* Tombol video */
    .btn-video {
        background: transparent;
        color: #fff;
        /* teks putih */
        border: 2px solid #007bff;
        font-size: 15px;
        padding: 10px 26px;
        min-width: 150px;
        box-shadow: 0 4px 10px rgba(0, 123, 255, 0.1);
    }

    .btn-video i {
        font-size: 18px;
        margin-right: 6px;
        color: #fff;
        /* icon juga putih */
        transition: all 0.3s ease;
    }

    .btn-video:hover {
        background: linear-gradient(135deg, #007bff, #0056b3);
        border-color: transparent;
        color: #fff;
        transform: translateY(-2px) scale(1.02);
        box-shadow: 0 6px 16px rgba(0, 123, 255, 0.35);
    }

    .btn-video:hover i {
        color: #fff;
        /* tetap putih pas hover */
    }
</style>
<section id="hero" class="hero section py-0">
    <div class="container-fluid p-0">
        <div class="row g-0">
            <div class="col-12" style="position: relative; width: 100%; height: 100vh; overflow: hidden;">

                <!-- background video -->
                <iframe
                    src="https://www.youtube.com/embed/FW1Ywl82DyM?si=uo_FP9vylcBAav6o&controls=0&start=240&autoplay=1&mute=1&loop=1&playlist=FW1Ywl82DyM"
                    title="YouTube video player"
                    frameborder="0"
                    allow="autoplay; encrypted-media; picture-in-picture"
                    allowfullscreen
                    style="
                        position: absolute;
                        top: 50%;
                        left: 50%;
                        width: 120%;
                        height: 120%;
                        transform: translate(-50%, -50%);
                        pointer-events: none;
                    ">
                </iframe>



                <!-- konten hero (text di tengah) -->
                <div class="container position-relative h-100 d-flex flex-column align-items-center justify-content-center text-center text-white" style="z-index: 2;">
                    <h2 data-aos="fade-up" data-aos-delay="100">
                        <?= htmlspecialchars($itemAbout->school_name ?? 'Nama Sekolah') ?>
                    </h2>
                    <!-- slogan berjalan -->
                    <div class="slogan-wrapper" data-aos="fade-up" data-aos-delay="200">
                        <p class="slogan-text">
                            <?= htmlspecialchars($itemAbout->school_tagline ?? 'Tagline sekolah tampil di sini') ?>
                        </p>
                    </div>


                    <!-- tombol -->
                    <div class="d-flex mt-4 justify-content-center align-items-center"
                        data-aos="fade-up" data-aos-delay="300" style="gap: 15px;">
                        <a href="#major" class="btn-main">Lihat Jurusan</a>
                        <a href="https://youtu.be/FW1Ywl82DyM?si=dYNG9VfSykCD67gT"
                            target="blank"class="btn-video d-flex align-items-center">
                            <i class="bi bi-play-circle-fill"></i>
                            <span>Lihat Vidio</span>
                        </a>
                    </div>



                    <!-- social links -->
                    <div class="social-links d-flex mt-4"
                        style="gap: 20px; font-size: 28px;"
                        data-aos="fade-up" data-aos-delay="400">
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

            </div>
        </div>
    </div>
</section>
<script>
  document.addEventListener("DOMContentLoaded", function () {
    const slogan = document.querySelector(".slogan-text");
    slogan.addEventListener("animationend", function (e) {
      if (e.animationName === "typing") {
        slogan.classList.add("finished");
      }
    });
  });
</script>
<!-- /Hero Section -->