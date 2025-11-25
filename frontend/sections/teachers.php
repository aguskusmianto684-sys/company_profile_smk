<?php
include '../config/connection.php';

// Ambil semua data teachers
$qTeachers = "SELECT * FROM teachers ORDER BY id DESC";
$result = mysqli_query($connect, $qTeachers) or die(mysqli_error($connect));
$teachers = [];
while ($row = $result->fetch_object()) {
    $teachers[] = $row;
}
?>
<!-- Swiper CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

<style>
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
      transform: translateY(-3px) scale(1.03);
      box-shadow: 0 8px 20px rgba(0, 123, 255, 0.45);
  }
  .team-member {
      background: #fff;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      text-align: center;
      transition: all 0.3s ease;
  }
  .team-member:hover {
      transform: translateY(-6px);
      box-shadow: 0 8px 20px rgba(0,0,0,0.2);
  }
  /* Tinggikan kartu guru */
.team-member .member-img img {
    width: 100%;
    height: 320px; /* lebih tinggi dari sebelumnya 260px */
    object-fit: cover;
}
.team-member .member-info {
    padding: 18px;
}

</style>

<section id="teachers" class="team section section-bg dark-background">

  <!-- Section Title -->
  <div class="container section-title" data-aos="fade-up">
      <h2>Guru</h2>
      <p>Guru-guru SMK Negeri 3 Banjar adalah pendidik profesional yang siap membimbing siswa menuju kesuksesan.</p>
  </div>
  <!-- End Section Title -->

  <div class="container">
    <div class="swiper teacher-slider">
      <div class="swiper-wrapper">
        <?php foreach ($teachers as $item): ?>
          <div class="swiper-slide">
            <div class="team-member">
              <div class="member-img">
                <img src="../storages/teachers/<?= $item->teachers_photo ?>" alt="<?= $item->teachers_name ?>">
              </div>
              <div class="member-info">
                <h4><?= $item->teachers_name ?></h4>
                <span><?= $item->teachers_major ?></span>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>

      <!-- Navigasi -->
      <div class="swiper-button-next"></div>
      <div class="swiper-button-prev"></div>
      <div class="swiper-pagination"></div>
    </div>

    <div class="text-center mt-5">
        <a href="all_teachers.php" class="btn-blue-gradient">Lihat Selengkapnya</a>
    </div>
  </div>

</section>

<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
new Swiper(".teacher-slider", {
  slidesPerView: 4,
  spaceBetween: 20,
  loop: true,
  speed: 2000, // lebih cepat (default 3000 → makin kecil makin cepat)
  autoplay: {
    delay: 0, // tanpa jeda
    disableOnInteraction: false,
  },
  freeMode: true,
  freeModeMomentum: false,
  allowTouchMove: true,
  breakpoints: {
    0: { slidesPerView: 1 },
    576: { slidesPerView: 2 },
    992: { slidesPerView: 3 },
    1200: { slidesPerView: 4 }
  }
});

});
</script>
