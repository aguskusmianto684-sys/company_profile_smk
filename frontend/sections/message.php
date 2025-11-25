<?php
include '../config/connection.php';

// Ambil data about
$qAbout = "SELECT * FROM abouts";
$result = mysqli_query($connect, $qAbout) or die(mysqli_error($connect));
$itemAbout = $result->fetch_object();
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
</style>
<section id="message" class="contact section">

    <!-- Judul Section -->
    <div class="container section-title" data-aos="fade-up">
        <h2>Kontak</h2>
        <p>Silakan hubungi kami melalui informasi berikut atau kirim pesan.</p>
    </div>
    <!-- End Section Title -->

    <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">
            <!-- Informasi Kontak -->
            <div class="col-lg-6">
                <div class="row gy-4">

                    <!-- Alamat -->
                    <div class="col-lg-12">
                        <div class="info-item d-flex flex-column justify-content-center align-items-center"
                            data-aos="fade-up" data-aos-delay="200">
                            <i class="bi bi-geo-alt"></i>
                            <h3>Alamat</h3>
                            <p><?= htmlspecialchars($itemAbout->alamat ?? '-') ?></p>
                        </div>
                    </div>

                    <!-- Telepon -->
                    <div class="col-md-6">
                        <div class="info-item d-flex flex-column justify-content-center align-items-center"
                            data-aos="fade-up" data-aos-delay="300">
                            <i class="bi bi-telephone"></i>
                            <h3>Telepon</h3>
                            <p>0265 2734141</p>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="col-md-6">
                        <div class="info-item d-flex flex-column justify-content-center align-items-center"
                            data-aos="fade-up" data-aos-delay="400">
                            <i class="bi bi-envelope"></i>
                            <h3>Email</h3>
                            <p>smkn3banjar@gmail.com</p>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Formulir Kontak -->
            <div class="col-lg-6">
                <form action="actions/message/create_message.php" method="post"
                    class="needs-validation" novalidate
                    data-aos="fade-up" data-aos-delay="500">

                    <div class="row gy-4">

                        <div class="col-md-6">
                            <div>Nama</div>
                            <input type="text" name="name" class="form-control" placeholder="Masukan nama Anda" required>
                        </div>

                        <div class="col-md-6">
                            <div>Email</div>
                            <input type="email" name="email" class="form-control" placeholder=" Masukan email Anda" required>
                        </div>

                        <div class="col-md-12">
                            <div>Nomor telepon</div>
                            <input type="text" name="telepon" class="form-control" placeholder="Masukan telepon" required>
                        </div>

                        <div class="col-md-12">
                            <div>Subjek</div>
                            <input type="text" name="subjek" class="form-control" placeholder="Masukan subjek" required>
                        </div>

                        <div class="col-md-12">
                            <div>Pesan</div>
                            <textarea name="message" class="form-control" rows="4" placeholder="Masukan pesan Anda" required></textarea>
                        </div>

                        <div class="col-md-12 text-center">
                            <button type="submit" name="submit" class="btn-blue-gradient">
                                Kirim Pesan
                            </button>
                        </div>


                    </div>
                </form>
                <script>
// Bootstrap form validation
(() => {
  'use strict'
  const forms = document.querySelectorAll('.needs-validation')
  Array.from(forms).forEach(form => {
    form.addEventListener('submit', event => {
      if (!form.checkValidity()) {
        event.preventDefault()
        event.stopPropagation()
      }
      form.classList.add('was-validated')
    }, false)
  })
})()
</script>

            </div>
            <!-- End Formulir Kontak -->

            <!-- Google Maps -->
            <div class="col-12 mt-4">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.0206990145057!2d108.63262127481384!3d-7.351571692657276!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6f7d197699ecd7%3A0x420255777005d790!2sSMK%20Negeri%203%20Banjar!5e0!3m2!1sid!2sid!4v1756439791753!5m2!1sid!2sid"
                    width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            <!-- End Google Maps -->

        </div>
    </div>
</section>
<!-- /Contact Section -->