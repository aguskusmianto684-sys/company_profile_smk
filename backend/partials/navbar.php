<?php
include __DIR__ . '/../../config/connection.php';
$qAbouts = "SELECT * FROM abouts";
$result = mysqli_query($connect, $qAbouts) or die(mysqli_error($connect));
$item = $result->fetch_object();
?>

<style>
  /* Kalau sidebar di-minimize, sembunyikan teks brand */
  .sidebar-icon-only .navbar .brand-logo .brand-text {
    display: none;
  }
</style>
<!-- partial:partials/_navbar.html -->
<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
  <div class="navbar-brand-wrapper d-flex justify-content-center">
    <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">

      <!-- Gabung logo + teks -->
      <a class="navbar-brand brand-logo d-flex align-items-center" href="index.php">
        <img src="../../../storages/about/<?= $item->school_logo ?>"
          alt="logo"
          style="height: 45px; width: auto; object-fit: contain; margin-right: 10px;" />
        <span class="brand-text" style="font-size: 17px; font-weight: bold; color: #333;"><?= $item->school_name ?></span>
      </a>

      <!-- Logo mini (muncul saat minimize) -->
      <a class="navbar-brand brand-logo-mini" href="index.php">
        <img src="../../template-admin/images/logo-mini.svg" alt="logo" />
      </a>

      <!-- Tombol minimize -->
      <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
        <span class="mdi mdi-sort-variant"></span>
      </button>
    </div>
  </div>

  <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">

    <!-- Langsung teks Login dan tombol Logout -->
     

    <li class="nav-item nav-profile dropdown d-flex align-items-center">
      <a class="nav-link dropdown-toggle d-flex align-items-center" data-toggle="dropdown" id="profileDropdown">
        <span class="mr-2" style="font-weight: bold; font-size: 16px;">
          <?= ucwords(strtolower($_SESSION['user_name'] ?? 'Guest')) ?>

        </span>
        <i class="bi bi-person-circle" style="font-size: 28px; color: #000;"></i>
      </a>
      <div class="dropdown-menu dropdown-menu-right navbar-dropdown text-center" aria-labelledby="profileDropdown">
        <a href="../../actions/auth/logout.php" class="btn btn-sm btn-danger w-75 mx-auto">
          Logout
        </a>
      </div>
    </li>

    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
      <span class="mdi mdi-menu"></span>
    </button>
  </div>
</nav>
<!-- partial -->