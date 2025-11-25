<?php
include '../config/connection.php';

// Ambil semua data abouts
$qAbouts = "SELECT * FROM abouts ORDER BY id ASC limit 1";
$result = mysqli_query($connect, $qAbouts) or die(mysqli_error($connect));
?>
<style>
  .btn-get-started {
    display: inline-block;
    padding: 12px 28px;
    border-radius: 50px;
    background: linear-gradient(135deg, #007bff, #0056b3);
    /* gradasi biru */
    color: #fff;
    font-weight: 600;
    font-size: 16px;
    transition: all 0.3s ease;
    text-decoration: none;
    box-shadow: 0 6px 14px rgba(0, 123, 255, 0.3);
    letter-spacing: 0.5px;
  }

  .btn-get-started:hover {
    background: linear-gradient(135deg, #0069d9, #004999);
    /* biru lebih gelap */
    color: #fff;
    transform: translateY(-3px) scale(1.03);
    box-shadow: 0 8px 20px rgba(0, 123, 255, 0.45);
  }
</style>
<section id="tabs" class="tabs section">
  <div class="container">
    <div class="container section-title" data-aos="fade-up">
      <h2>Tentang Kami</h2>
    </div>

    <!-- Tab Navigation -->
    <ul class="nav nav-tabs row d-flex" data-aos="fade-up" data-aos-delay="100">
      <?php
      $i = 1;
      while ($row = mysqli_fetch_object($result)):
      ?>
        <li class="nav-item col-3">
          <a class="nav-link <?php if ($i == 1) echo 'active show'; ?>"
            data-bs-toggle="tab"
            data-bs-target="#tabs-tab-<?php echo $row->id; ?>">
            <!-- <i class="bi bi-building"></i> -->
            <h4 class="d-none d-lg-block">
              <?= htmlspecialchars($row->school_name) ?>
            </h4>
          </a>
        </li>
      <?php
        $i++;
      endwhile;
      ?>
    </ul>
    <!-- End Tab Nav -->

    <!-- Tab Content -->
    <div class="tab-content" data-aos="fade-up" data-aos-delay="200">
      <?php
      // Reset pointer hasil query
      mysqli_data_seek($result, 0);
      $j = 1;
      while ($row = mysqli_fetch_object($result)):
      ?>
        <div class="tab-pane fade <?php if ($j == 1) echo 'active show'; ?>" id="tabs-tab-<?php echo $row->id; ?>">
          <div class="row">
            <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0">
              <h3><?= htmlspecialchars($row->school_tagline) ?></h3>
              <p class="fst-italic" style="text-align: justify;">
                <?= nl2br(htmlspecialchars($row->school_description)) ?>
              </p>

              <ul>
                <li><i class="bi bi-geo-alt-fill"></i> <span>Alamat: <?= htmlspecialchars($row->alamat) ?></span></li>
                <li><i class="bi bi-calendar-event-fill"></i> <span>Sejak: <?= htmlspecialchars($row->since) ?></span></li>
              </ul>
            </div>
            <div class="col-lg-6 order-1 order-lg-2 text-center">
              <?php if ($row->school_banner): ?>
                <img src="../storages/about/<?= $row->school_banner ?>" alt="banner" class="img-fluid">
              <?php else: ?>
                <img src="temp_user/assets/img/working-1.jpg" alt="default" class="img-fluid">
              <?php endif; ?>
              <div class="mt-5 text-center">
                <a href="#message" class="btn-get-started">Hubungi Kami</a>
              </div>

            </div>
          </div>

        </div>
      <?php
        $j++;
      endwhile;
      ?>
    </div>
    <!-- End Tab Content -->


  </div>
</section>