<section id="clients" class="clients section">
    <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="logo-slider">
            <div class="logo-track">
                <!-- 1 set logo -->
                <img src="temp_user/assets/img/clients/smkbisa.png" alt="">
                <img src="temp_user/assets/img/clients/jabar.png" alt="">
                <img src="temp_user/assets/img/clients/smkmerdeka.png" alt="">
                <img src="temp_user/assets/img/clients/mitek.png" alt="">
                <img src="temp_user/assets/img/clients/lokasi.png" alt="">
                <img src="temp_user/assets/img/clients/smkhebat.jpg" alt="">

                <!-- set logo kedua (duplikat biar mulus) -->
                <img src="temp_user/assets/img/clients/smkbisa.png" alt="">
                <img src="temp_user/assets/img/clients/jabar.png" alt="">
                <img src="temp_user/assets/img/clients/smkmerdeka.png" alt="">
                <img src="temp_user/assets/img/clients/mitek.png" alt="">
                <img src="temp_user/assets/img/clients/lokasi.png" alt="">
                <img src="temp_user/assets/img/clients/smkhebat.png" alt="">
            </div>
        </div>
    </div>
</section>

<style>
    .logo-slider {
        overflow: hidden;
        position: relative;
        width: 100%;
    }

    .logo-track {
        display: flex;
        width: max-content;
        animation: scroll 40s linear infinite;
    }

    .logo-track img {
        height: 90px;
        /* ukuran logo */
        margin: 0 40px;
        /* jarak antar logo */
        object-fit: contain;
        transition: transform 0.3s ease;
    }

    .logo-track img:hover {
        transform: scale(1.1);
    }

    @keyframes scroll {
        from {
            transform: translateX(0);
        }

        to {
            transform: translateX(-50%);
        }

        /* geser separuh, sisanya isi set kedua */
    }
</style>