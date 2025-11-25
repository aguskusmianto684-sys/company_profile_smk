<?php
include '../config/connection.php';

// Ambil data sekolah dari tabel abouts
$qAbouts = "SELECT * FROM abouts LIMIT 1";
$result = mysqli_query($connect, $qAbouts) or die(mysqli_error($connect));
$item = $result->fetch_object();
?>
<div class="container-fluid position-relative d-flex align-items-center justify-content-between py-2 navbar px-4">

    <!-- Logo Sekolah -->
    <a href="index.php" class="logo d-flex align-items-center me-auto text-decoration-none">
        <img src="../storages/about/<?= $item->school_logo ?>" 
             alt="logo" 
             class="img-fluid school-logo">
        <h1 class="sitename ms-2 mb-0"><?= $item->school_name ?></h1>
    </a>


    <style>

        /* Biar logo gak terlalu kecil */
.school-logo {
  height: 60px;     /* lebih besar */
  width: auto;      /* biar proporsional */
  object-fit: contain;
}

/* Biar ada jarak dari kiri */
.navbar {
  padding-left: 20px;  /* kasih space */
}

        /* NAVMENU */
        .navmenu ul {
            margin: 0;
            padding: 0;
            list-style: none;
            display: flex;
            gap: 20px;
            align-items: center;
        }

        .navmenu ul li {
            position: relative;
        }

        /* Default link */
        .navmenu ul li a {
            color: #333;
            padding: 8px 0;
            text-decoration: none;
            font-weight: 500;
            position: relative;
            transition: all 0.3s ease;
        }

        /* Hover underline animasi */
        .navmenu ul li a::after {
            content: "";
            position: absolute;
            width: 0;
            height: 2px;
            left: 0;
            bottom: -3px;
            background: #007bff;
            transition: width 0.3s ease;
        }

        .navmenu ul li a:hover::after {
            width: 100%;
        }

        /* Active link */
        .navmenu ul li a.active {
            color: #007bff;
        }

        .navmenu ul li a.active::after {
            width: 100%;
        }

        /* Dropdown */
        .navmenu .dropdown ul {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            padding: 10px 0;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            animation: fadeDown 0.3s ease;
            z-index: 100;
        }

        .navmenu .dropdown:hover ul {
            display: block;
        }

        .navmenu .dropdown ul li {
            width: 180px;
        }

        .navmenu .dropdown ul li a {
            display: block;
            padding: 8px 15px;
            color: #333;
            transition: background 0.3s ease, padding-left 0.3s ease;
        }

        .navmenu .dropdown ul li a:hover {
            background: #f8f9fa;
            padding-left: 20px;
            color: #007bff;
        }

        /* Animasi dropdown */
        @keyframes fadeDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Mobile nav toggle */
        .mobile-nav-toggle {
            font-size: 26px;
            cursor: pointer;
            color: #333;
            margin-left: 20px;
        }

        @media (max-width: 992px) {
            .navmenu ul {
                flex-direction: column;
                background: #fff;
                position: absolute;
                top: 60px;
                right: 0;
                width: 220px;
                padding: 15px;
                border-radius: 8px;
                display: none;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            }

            .navmenu ul.show {
                display: flex;
            }
        }
    </style>
<!-- NAVIGATION -->
<nav id="navmenu" class="navmenu">
        <ul class="me-5">
            <li><a href="#hero" class="nav-link">Beranda</a></li>
            <li><a href="#headmasters" class="nav-link">Sambutan</a></li>
            <li class="dropdown">
                <a href="javascript:void(0)" class="nav-link"><span>Tentang Sekolah</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                <ul>
                    <li><a href="#tabs" class="nav-link">Tentang Kami</a></li>
                    <li><a href="./all_jurusan.php" class="nav-link">Jurusan</a></li>
                    <li><a href="#visi_missions" class="nav-link">Visi & Misi</a></li>
                    <li><a href="./all_teachers.php" class="nav-link">Guru</a></li>
                    <li><a href="./semua_ekstrakulikuler.php" class="nav-link">Organisasi</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="javascript:void(0)" class="nav-link"><span>Informasi</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                <ul>
                    <li><a href="./semua_pengumuman.php" class="nav-link">Pengumuman</a></li>
                    <li><a href="./semua_blog.php" class="nav-link">Berita</a></li>
                    <li><a href="./semua_galery.php" class="nav-link">Galleri</a></li>
                    <li><a href="./semua_prestasi.php" class="nav-link">Prestasi</a></li>
                    <li><a href="./semua_testimoni.php" class="nav-link">Testimoni</a></li>
                </ul>
            </li>
            <li><a href="#message" class="nav-link">Kontak</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list" onclick="document.querySelector('.navmenu ul').classList.toggle('show')"></i>
    </nav>
</div>
<script>
document.addEventListener("DOMContentLoaded", () => {
  const navbar = document.querySelector(".navbar");
  const sections = document.querySelectorAll("section[id]");
  const navLinks = document.querySelectorAll(".navmenu .nav-link");

  // Tambah background saat scroll
  window.addEventListener("scroll", () => {
    if (window.scrollY > 50) {
      navbar.classList.add("scrolled");
    } else {
      navbar.classList.remove("scrolled");
    }

    // Scrollspy aktifkan link
    let current = "";
    sections.forEach((section) => {
      const sectionTop = section.offsetTop - 100; // offset biar pas
      const sectionHeight = section.clientHeight;
      if (window.scrollY >= sectionTop && window.scrollY < sectionTop + sectionHeight) {
        current = section.getAttribute("id");
      }
    });

    navLinks.forEach((link) => {
      link.classList.remove("active");
      if (link.getAttribute("href") === "#" + current) {
        link.classList.add("active");
      }
    });
  });
});
</script>



