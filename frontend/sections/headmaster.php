<?php
include '../config/connection.php';

// ambil 1 data headmaster terbaru
$qHeadmasters = "SELECT * FROM headmasters ORDER BY id DESC LIMIT 1";
$result = mysqli_query($connect, $qHeadmasters) or die(mysqli_error($connect));
$item = $result->fetch_object();
?>
<style>
  .section-bg.dark-background {
    background: #191919 !important;
    clip-path: none !important;
  }
</style>
<section id="headmasters" class="headmasters section section-bg dark-background">
  <div class="container position-relative">

    <div class="row gy-5 align-items-center">

      <!-- Foto Kepala Sekolah -->
      <div class="col-xl-5 d-flex justify-content-center" data-aos="fade-up" data-aos-delay="100">
        <div class="card shadow-lg border-0 rounded-3" style="width:100%; max-width:350px; background-color:#252323;">
          <img src="../storages/headmasters/<?= $item->headmaster_photo ?>"
            class="card-img-top rounded-top-3"
            alt="Foto Kepala Sekolah">
          <div class="card-body text-center">
            <h5 class="card-title mb-1 text-white fw-bold"><?= $item->headmaster_name ?></h5>
            <p class="text-white fw-bold">Kepala SMK Negeri 3 Banjar</p>
          </div>
        </div>
      </div>

      <!-- Deskripsi Sambutan -->
      <div class="col-xl-7" data-aos="fade-up" data-aos-delay="200">
        <h3 class="fw-bold text-white">Sambutan Kepala Sekolah</h3>
        <p style="text-align: justify; color: white; font-size: 1.1rem;">
          <?= $item->headmaster_description ?>
        </p>
      </div>

    </div>

  </div>
</section>