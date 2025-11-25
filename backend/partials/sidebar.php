<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<style>
  /* Link biasa */
  .sidebar .nav .nav-item .nav-link {
    color: #000 !important;
    /* teks selalu hitam */
    display: flex;
    align-items: center;
    gap: 10px;
    transition: all 0.3s ease-in-out;
    padding: 10px 15px;
    border-radius: 6px;
  }

  /* Icon di tengah (square background) */
  .sidebar .nav .nav-item .nav-link .icon {
    width: 35px;
    height: 35px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 8px;
    background: #f9f9f9;
    font-size: 16px;
    transition: all 0.3s ease;
    color: #000 !important;
    /* icon selalu hitam */
  }

  /* Hover efek */
  .sidebar .nav .nav-item .nav-link:hover {
    background: #f0f0f0;
    /* background abu */
    color: #000 !important;
    /* teks tetap hitam */
  }

  .sidebar .nav .nav-item .nav-link:hover .icon {
    background: #007bff;
    /* boleh kasih efek biru */
    color: #000 !important;
    /* icon tetap hitam */
  }

  /* Link aktif */
  .sidebar .nav .nav-item .nav-link.active {
    background: #007bff;
    /* background biru */
    color: #000 !important;
    /* teks tetap hitam */
    font-weight: bold;
  }

  .sidebar .nav .nav-item .nav-link.active .icon {
    background: #fff;
    color: #000 !important;
    /* icon tetap hitam */
  }

  /* SEMUA teks sidebar jadi hitam */
  .sidebar .nav .nav-item .nav-link .nav-link-text {
    color: #000 !important;
  }

  /* Saat sidebar minimize (icon only), sembunyikan teks */
  .sidebar-icon-only .sidebar .nav .nav-item .nav-link .nav-link-text {
    display: none !important;
  }

  /* Biar icon tetap center ketika minimize */
  .sidebar-icon-only .sidebar .nav .nav-item .nav-link {
    justify-content: center !important;
    padding: 12px !important;
  }

  /* Biar icon tetap center ketika minimize */
  .sidebar-icon-only .sidebar .nav .nav-item .nav-link .icon {
    margin: 0 !important;
  }

  /* Pastikan semua ikon di sidebar selalu hitam */
  .sidebar .nav .nav-item .nav-link .icon i {
    color: #000 !important;
  }

  /* Hover: ikon tetap hitam */
  .sidebar .nav .nav-item .nav-link:hover .icon i {
    color: #000 !important;
  }

  /* Aktif: ikon tetap hitam */
  .sidebar .nav .nav-item .nav-link.active .icon i {
    color: #000 !important;
  }

  /* Biar item terakhir selalu di paling bawah */
  .sidebar .nav {
    display: flex;
    flex-direction: column;
    height: 100%;
    padding-bottom: 15px;
  }

  .sidebar .nav .nav-item.mt-auto {
    margin-top: auto;
    /* dorong ke bawah */
  }
  
</style>

<body>
  <div class="container-scroller">

    <div class="container-fluid page-body-wrapper">
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">

          <!-- Dashboard -->
          <li class="nav-item">
            <a class="nav-link <?= ($page == 'dashboard') ? 'active' : '' ?>" href="../dashboard/index.php">
              <div class="icon"><i class="fas fa-home"></i></div>
              <span class="nav-link-text">Beranda</span>
            </a>
          </li>

          <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'): ?>
            
            <!-- About -->
            <li class="nav-item">
              <a class="nav-link <?= ($page == 'about') ? 'active' : '' ?>" href="../about/index.php">
                <div class="icon"><i class="fas fa-info-circle"></i></div>
                <span class="nav-link-text">Tentang Sekolah</span>
              </a>
            </li>
          <?php endif; ?>

          <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'): ?>
            
            <!-- Kepala Sekolah -->
            <li class="nav-item">
              <a class="nav-link <?= ($page == 'headmasters') ? 'active' : '' ?>" href="../headmasters/index.php">
                <div class="icon"><i class="fas fa-user-tie"></i></div>
                <span class="nav-link-text">Kepala Sekolah</span>
              </a>
            </li>
          <?php endif; ?>

          <!-- Visi & Misi -->
          <li class="nav-item">
            <a class="nav-link <?= ($page == 'visi_missions') ? 'active' : '' ?>" href="../visi_missions/index.php">
              <div class="icon"><i class="fas fa-bullseye"></i></div>
              <span class="nav-link-text">Visi & Misi</span>
            </a>
          </li>

          <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'): ?>
            
            <!-- Jurusan -->
            <li class="nav-item">
              <a class="nav-link <?= ($page == 'majors') ? 'active' : '' ?>" href="../majors/index.php">
                <div class="icon"><i class="fas fa-graduation-cap"></i></div>
                <span class="nav-link-text">Jurusan</span>
              </a>
            </li>
          <?php endif; ?>

          <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'): ?>
            <!-- Jurusan -->
            <li class="nav-item">
              <a class="nav-link <?= ($page == 'extracurriculars') ? 'active' : '' ?>" href="../extracurriculars/index.php">
                <div class="icon"><i class="fas fa-handshake"></i></div>
                <span class="nav-link-text">Organisasi</span>
              </a>
            </li>
          <?php endif; ?>

          <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'): ?>
            <!-- Guru -->
            <li class="nav-item">
              <a class="nav-link <?= ($page == 'teachers') ? 'active' : '' ?>" href="../teachers/index.php">
                <div class="icon"><i class="fas fa-chalkboard-teacher"></i></div>
                <span class="nav-link-text">Guru</span>
              </a>
            </li>
          <?php endif; ?>

          <!-- Pengumuman -->
          <li class="nav-item">
            <a class="nav-link <?= ($page == 'announcements') ? 'active' : '' ?>" href="../announcements/index.php">
              <div class="icon"><i class="fas fa-bullhorn"></i></div>
              <span class="nav-link-text">Pengumuman</span>
            </a>
          </li>

          <!-- Blog -->
          <li class="nav-item">
            <a class="nav-link <?= ($page == 'blog') ? 'active' : '' ?>" href="../blog/index.php">
              <div class="icon"><i class="fas fa-blog"></i></div>
              <span class="nav-link-text">Berita</span>
            </a>
          </li>

          <!-- Gallery -->
          <li class="nav-item">
            <a class="nav-link <?= ($page == 'galleries') ? 'active' : '' ?>" href="../galleries/index.php">
              <div class="icon"><i class="fas fa-images"></i></div>
              <span class="nav-link-text">Galleri</span>
            </a>
          </li>

          <!-- Prestasi -->
          <li class="nav-item">
            <a class="nav-link <?= ($page == 'achievements') ? 'active' : '' ?>" href="../achievements/index.php">
              <div class="icon"><i class="fas fa-trophy"></i></div>
              <span class="nav-link-text">Prestasi</span>
            </a>
          </li>

          <!-- Testimoni -->
          <li class="nav-item">
            <a class="nav-link <?= ($page == 'testimonials') ? 'active' : '' ?>" href="../testimonials/index.php">
              <div class="icon"><i class="fas fa-comment-dots"></i></div>
              <span class="nav-link-text">Testimoni</span>
            </a>
          </li>

          <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'): ?>
            
            <!-- Kontak -->
            <li class="nav-item">
              <a class="nav-link <?= ($page == 'contact') ? 'active' : '' ?>" href="../contact/index.php">
                <div class="icon"><i class="fas fa-phone-alt"></i></div>
                <span class="nav-link-text">Kontak</span>
              </a>
            </li>
          <?php endif; ?>

          <!-- Pesan -->
          <li class="nav-item">
            <a class="nav-link <?= ($page == 'message') ? 'active' : '' ?>" href="../message/index.php">
              <div class="icon"><i class="fas fa-envelope"></i></div>
              <span class="nav-link-text">Pesan</span>
            </a>
          </li>

          <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'): ?>
            <!-- Sosial Media -->
            <li class="nav-item">
              <a class="nav-link <?= ($page == 'social_media') ? 'active' : '' ?>" href="../social_media/index.php">
                <div class="icon"><i class="fas fa-share-alt"></i></div>
                <span class="nav-link-text">Sosial Media</span>
              </a>
            </li>
          <?php endif; ?>

          <!-- Aktivitas -->
          <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'): ?>
            <li class="nav-item">
              <a class="nav-link <?= ($page == 'aktivitas') ? 'active' : '' ?>" href="../aktivitas/index.php">
                <div class="icon"><i class="mdi mdi-chart-bar"></i></div>
                <span class="nav-link-text">Aktivitas Pengguna</span>
              </a>
            </li>
          <?php endif; ?>

          <!-- User -->

          <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'): ?>
            <li class="nav-item">
              <a class="nav-link <?= ($page == 'users') ? 'active' : '' ?>" href="../users/index.php">
                <div class="icon"><i class="fas fa-users"></i></div>
                <span class="nav-link-text">Pengguna</span>
              </a>
            </li>
          <?php endif; ?>

          <!-- Scroll to Top -->
          <li class="nav-item mt-auto"> <!-- mt-auto biar selalu dorong ke bawah -->
            <a class="nav-link" href="#" id="scrollTopBtn">
              <div class="icon"><i class="fas fa-arrow-up"></i></div>
              <span class="nav-link-text"></span></span>
            </a>
          </li>


        </ul>
      </nav>
      <script>
        document.getElementById("scrollTopBtn").addEventListener("click", function(e) {
          e.preventDefault();
          window.scrollTo({
            top: 0,
            behavior: "smooth"
          });
        });
      </script>