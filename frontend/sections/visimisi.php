<?php
include '../config/connection.php';

// Ambil semua data visi dan misi
$qVM = "SELECT * FROM visi_missions ORDER BY id ASC";
$resultVM = mysqli_query($connect, $qVM) or die(mysqli_error($connect));
?>

<section id="visi_missions" class="faq section">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
        <h2>Visi & Misi</h2>
        <p>Visi dan misi sekolah kami</p>
    </div><!-- End Section Title -->

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10" data-aos="fade-up" data-aos-delay="100">
                <div class="faq-container">

                    <?php while($row = mysqli_fetch_assoc($resultVM)) : ?>
                        <div class="faq-item <?php echo $row['category'] == 'visi' ? 'faq-active' : ''; ?>">
                            <h3><?php echo ucfirst($row['category']); ?></h3>
                            <div class="faq-content">
                                <p><?php echo $row['text']; ?></p>
                            </div>
                            <i class="faq-toggle bi bi-chevron-right"></i>
                        </div><!-- End Faq item-->
                    <?php endwhile; ?>

                </div>
            </div><!-- End Column -->
        </div>
    </div>
</section><!-- /Visi-Misi Section -->
