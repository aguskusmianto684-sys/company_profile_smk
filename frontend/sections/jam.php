<section id="stats" class="stats section">
  <div class="container" data-aos="fade-up" data-aos-delay="100">
    <div class="row gy-4 justify-content-center text-center">

      <!-- Jumlah Siswa -->
      <div class="col-lg-3 col-md-4 col-6 d-flex flex-column align-items-center">
        <i class="bi bi-people fs-1 text-primary"></i>
        <div class="stats-item">
          <span class="fw-bold fs-3" data-count="1200">0</span>
          <p>Siswa</p>
        </div>
      </div>

      <!-- Jumlah Guru -->
      <div class="col-lg-3 col-md-4 col-6 d-flex flex-column align-items-center">
        <i class="bi bi-person-badge fs-1 text-success"></i>
        <div class="stats-item">
          <span class="fw-bold fs-3" data-count="85">0</span>
          <p>Guru</p>
        </div>
      </div>

      <!-- Jurusan -->
      <div class="col-lg-3 col-md-4 col-6 d-flex flex-column align-items-center">
        <i class="bi bi-diagram-3 fs-1 text-warning"></i>
        <div class="stats-item">
          <span class="fw-bold fs-3" data-count="6">0</span>
          <p>Jurusan</p>
        </div>
      </div>

      <!-- Prestasi -->
      <div class="col-lg-3 col-md-4 col-6 d-flex flex-column align-items-center">
        <i class="bi bi-trophy fs-1 text-danger"></i>
        <div class="stats-item">
          <span class="fw-bold fs-3" data-count="45">0</span>
          <p>Prestasi</p>
        </div>
      </div>

    </div>
  </div>
</section>

<script>
  // Animasi angka naik
  function animateCount(el) {
    const target = +el.getAttribute("data-count");
    let count = 0;
    const speed = target / 100; // makin besar makin cepat
    const update = () => {
      count += speed;
      if (count < target) {
        el.textContent = Math.floor(count);
        requestAnimationFrame(update);
      } else {
        el.textContent = target;
      }
    };
    update();
  }

  document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll("[data-count]").forEach(el => {
      animateCount(el);
    });
  });
</script>
