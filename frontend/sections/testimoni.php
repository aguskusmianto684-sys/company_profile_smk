<?php
include '../config/connection.php';

// Ambil 3 data terbaru
$qTesti = "SELECT * FROM testimonials ORDER BY id DESC LIMIT 3";
$resultTesti = mysqli_query($connect, $qTesti) or die(mysqli_error($connect));
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
    color: red !important;
    transform: translateY(-3px) scale(1.03);
    box-shadow: 0 8px 20px rgba(0, 123, 255, 0.45);
  }

.swiper-pagination-bullet {
  border-radius: 50%;
  transition: all 0.3s ease;
}

.swiper-pagination-bullet-active {
  transform: scale(1.2);
}


  /* Warna bintang */
  .stars {
    color: #ffc107;
    font-size: 14px;
    margin-bottom: 6px;
  }

  /* Card testimonial */
  .testimonial-item {
    border-radius: 15px;
    transition: all .35s ease;
    min-height: 320px;
    display: flex;
    flex-direction: column;
    justify-content: center;
  }
</style>

<section id="testimonials" class="testimonials section">
  <!-- Section Title -->
  <div class="container section-title" data-aos="fade-up">
    <h2>Testimoni</h2>
    <p>Berikut adalah testimoni dari Alumni, orang tua, dan mitra kami.</p>
  </div>

  <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
    <div class="swiper init-swiper">
      <div class="swiper-wrapper">
        <?php
        $testimonials = [];
        while ($row = $resultTesti->fetch_object()) {
          $testimonials[] = $row;
        }

        $repeatCount = (count($testimonials) < 6) ? 2 : 1;
        for ($r = 0; $r < $repeatCount; $r++):
          foreach ($testimonials as $item): ?>
            <div class="swiper-slide">
              <div class="testimonial-item text-center p-3 shadow-sm h-100">

                <!-- Foto -->
                <img src="../storages/testimonials/<?= $item->image ?>"
                  class="testimonial-img mb-2"
                  alt="<?= $item->name ?>"
                  style="width:70px; height:70px; object-fit:cover; border-radius:50%; margin:0 auto;">

                <!-- Bintang -->
<div class="stars">
  <?php for ($i = 1; $i <= 5; $i++): ?>
    <?php if ($i <= $item->rating): ?>
      <i class="bi bi-star-fill"></i>
    <?php else: ?>
      <i class="bi bi-star"></i>
    <?php endif; ?>
  <?php endfor; ?>
</div>


                <!-- Nama -->
                <h6 class="fw-bold mb-0"><?= $item->name ?></h6>

                <!-- Status -->
                <?php if (!empty($item->status)): ?>
                  <p class="text-muted small mb-1"><?= $item->status ?></p>
                <?php endif; ?>

                <!-- Pesan -->
                <p class="small mt-2" style="line-height:1.4;">
                  <i class="bi bi-quote quote-icon-left"></i>
                  <?= htmlspecialchars($item->message) ?>
                  <i class="bi bi-quote quote-icon-right"></i>
                </p>
              </div>
            </div>
        <?php endforeach;
        endfor; ?>
      </div>
    </div>

    <div class="text-center mt-5">
      <a href="semua_testimoni.php" class="btn-blue-gradient">Lihat Selengkapnya</a>
    </div>
  </div>
</section>

<!-- Swiper CSS & JS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    new Swiper(".init-swiper", {
      loop: true,
      speed: 800,
      autoplay: {
        delay: 3000,
        disableOnInteraction: false
      },
      slidesPerView: 1.2,
      spaceBetween: 15,
      centeredSlides: true,
      grabCursor: true,
      pagination: {
        el: ".swiper-pagination",
        clickable: true
      },
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev"
      },
      breakpoints: {
        576: {
          slidesPerView: 2.2,
          spaceBetween: 15
        },
        992: {
          slidesPerView: 3,
          spaceBetween: 20
        },
        1400: {
          slidesPerView: 4,
          spaceBetween: 25
        }
      }
    });

    // Hover animasi
    document.querySelectorAll('.testimonial-item').forEach(item => {
      item.addEventListener('mouseenter', () => {
        item.style.transform = "translateY(-6px) scale(1.05)";
        item.style.boxShadow = "0 8px 18px rgba(0,0,0,.15)";
      });
      item.addEventListener('mouseleave', () => {
        item.style.transform = "translateY(0) scale(1)";
        item.style.boxShadow = "0 2px 6px rgba(0,0,0,.1)";
      });
    });
  });
</script>