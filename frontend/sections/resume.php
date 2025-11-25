<?php
include '../config/connection.php';

// Ambil data about
$qAbout = "SELECT * FROM abouts";
$result_about = mysqli_query($connect, $qAbout) or die(mysqli_error($connect));
$itemAbout = $result_about->fetch_object();

// Ambil data achievements
$qAchievements = "SELECT * FROM achievements ORDER BY id DESC";
$result_achievements = mysqli_query($connect, $qAchievements) or die(mysqli_error($connect));
?>

<section id="resume" class="resume section">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
        <h2>Resume</h2>
        <p>Berikut adalah pencapaian dan prestasi yang telah diraih.</p>
    </div><!-- End Section Title -->

    <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row gy-4">

            <!-- Left column with summary and contact -->
            <div class="col-lg-4 h-100">
                <div class="resume-side" data-aos="fade-right" data-aos-delay="100">
                    <div class="profile-img mb-4">
                        <img src="../storages/about/<?= $itemAbout->image ?>" alt="Profile" class="img-fluid rounded">
                    </div>

                    <h3>Potret Saya</h3>
                    <p><?= $itemAbout->description ?></p>

                    <h3 class="mt-4">Contact Information</h3>
                    <ul class="contact-info list-unstyled">
                        <li><i class="bi bi-geo-alt"></i> <?= $itemAbout->address ?></li>
                        <li><i class="bi bi-envelope"></i> <?= $itemAbout->email ?></li>
                        <li><i class="bi bi-phone"></i> <?= $itemAbout->phone ?></li>
                    </ul>
                </div>
            </div>

            <!-- Right column with achievements -->
            <div class="col-lg-8 ps-4 ps-lg-5">
                <div class="resume-section" data-aos="fade-up">
                    <h3><i class="bi bi-trophy me-2"></i> Achievements</h3>

                    <?php if(mysqli_num_rows($result_achievements) > 0): ?>
                        <?php while($item = mysqli_fetch_assoc($result_achievements)): ?>
                            <div class="resume-item mb-4">
                                <h4><b><?= $item['title'] ?></b></h4>
                                <p><?= nl2br($item['description']) ?></p>
                                <div class="mt-2">
                                    <img src="../storages/achievements/<?= $item['image'] ?>" 
                                         alt="<?= $item['title'] ?>" 
                                         class="img-fluid rounded shadow-sm" 
                                         style="max-height:200px; object-fit:cover;">
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <div class="alert alert-info">Belum ada data achievements.</div>
                    <?php endif; ?>
                </div>
            </div>

        </div>
    </div>
</section><!-- /Resume Section -->
