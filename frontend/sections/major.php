<?php
include '../config/connection.php';

// Ambil semua data majors
$qmajors = "SELECT * FROM majors ORDER BY id DESC";
$result = mysqli_query($connect, $qmajors) or die(mysqli_error($connect));
?>
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
  color: #fff !important;
  transform: translateY(-3px) scale(1.03);
  box-shadow: 0 8px 20px rgba(0, 123, 255, 0.45);
}

/* Slider */
.major-slider-wrapper {
  overflow: hidden;
  width: 100%;
  position: relative;
  padding: 20px 0;
}
.major-slider {
  display: flex;
  gap: 80px;
  animation: scrollMajors 5s linear infinite; /* <-- durasi 25s */
}

.major-slider:hover {
  animation-play-state: paused;
}
.major-item {
  min-width: 260px;
  flex: 0 0 auto;
}
.major-item img {
  max-height: 230px;
  object-fit: contain;
  transition: transform 0.3s ease;
}
.major-item img:hover {
  transform: scale(1.2);
}
.major-name {
  margin-top: 15px;
  font-size: 20px;
  font-weight: bold;
  color: #fff !important;
  text-transform: uppercase;
}
@keyframes scrollMajors {
  from {
    transform: translateX(0);
  }
  to {
    transform: translateX(-50%);
  }
}
</style>

<section id="major" class="major section" style="background: #111; color: #fff; padding: 60px 0;">
  <div class="container">

    <!-- Title -->
    <div class="section-title text-center mb-5">
      <h2 class="text-white">JURUSAN</h2>
      <p>Daftar jurusan yang tersedia di sekolah kami</p>
    </div>

    <!-- Slider -->
    <div class="major-slider-wrapper">
      <div class="major-slider">
        <?php while ($item = $result->fetch_object()): ?>
          <div class="major-item text-center">
            <img src="../storages/majors/<?= $item->majors_image ?>"
                 alt="<?= $item->majors_name ?>"
                 class="img-fluid">
            <h5 class="major-name"><?= $item->majors_name ?></h5>
          </div>
        <?php endwhile; ?>

        <?php
        // ulangi lagi untuk efek infinite
        mysqli_data_seek($result, 0);
        while ($item = $result->fetch_object()): ?>
          <div class="major-item text-center">
            <img src="../storages/majors/<?= $item->majors_image ?>"
                 alt="<?= $item->majors_name ?>"
                 class="img-fluid">
            <h5 class="major-name"><?= $item->majors_name ?></h5>
          </div>
        <?php endwhile; ?>
      </div>
    </div>

    <!-- Tombol -->
    <div class="text-center mt-5">
      <a href="all_jurusan.php" class="btn-blue-gradient">Lihat Selengkapnya</a>
    </div>

  </div>
</section>
