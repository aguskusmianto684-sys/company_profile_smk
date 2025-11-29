-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 29, 2025 at 02:32 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `company_profile`
--

-- --------------------------------------------------------

--
-- Table structure for table `abouts`
--

CREATE TABLE `abouts` (
  `id` bigint NOT NULL,
  `school_name` varchar(255) NOT NULL,
  `school_logo` text NOT NULL,
  `school_banner` varchar(200) NOT NULL,
  `school_tagline` varchar(255) NOT NULL,
  `school_description` text NOT NULL,
  `since` date NOT NULL,
  `alamat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `abouts`
--

INSERT INTO `abouts` (`id`, `school_name`, `school_logo`, `school_banner`, `school_tagline`, `school_description`, `since`, `alamat`) VALUES
(11, 'SMKN 3 BANJAR', '1756174154_logo.png', '1756132803_banner.png', 'BERSAMA KITA BISA ', 'SMK Negeri 3 Banjar berdiri pada 1 Juni 2008 dan mulai beroperasi 20 Juni 2008 yang ditetapkan sebagai hari jadi sekolah. Berlokasi di Jl. Julaeni, Langensari, sekolah ini berkembang pesat menjadi salah satu SMK favorit di Kota Banjar. Dari awalnya hanya 244 siswa dalam 6 kelas dan 3 kompetensi keahlian (RPL, TSM, MEP), kini SMK Negeri 3 Banjar memiliki 45 kelas dengan 1.521 siswa serta 6 kompetensi keahlian yaitu TBSM, RPL, APHP, AKL, TKRO, dan APAT.Selain berprestasi di bidang akademik dan non-akademik hingga tingkat nasional, sekolah ini juga aktif mengembangkan program sekolah Adiwiyata (peduli lingkungan) dan Health Promoting School (sekolah sehat). Hingga kini, SMK Negeri 3 Banjar terus berbenah di bawah kepemimpinan para kepala sekolah yang silih berganti, dengan pimpinan terakhir adalah Bapak Rusdiharto, S.Pd sejak Maret 2025.', '2008-06-01', 'Jl. Julaeni,  Kec. Langensari, Kota Banjar, Jawa Barat 46324\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `achievements`
--

CREATE TABLE `achievements` (
  `id` bigint NOT NULL,
  `image` varchar(200) NOT NULL,
  `author` varchar(100) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `title` varchar(200) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `achievements`
--

INSERT INTO `achievements` (`id`, `image`, `author`, `date`, `title`, `description`) VALUES
(9, '1756315059_achievement.jpg', 'SMKN 3 Banjar', '2025-08-22', 'TIM FUTSAL SMKN 3 Banjar JUARA 1 Puma Futsal', 'Selamat atas prestasi yang diraih oleh TIM FUTSAL SMKN 3 Banjar sebagai JUARA 1 Puma Futsal 🔥'),
(10, '1756315417_achievement.jpg', 'SMKN 3 Banjar', '2025-08-14', 'Juara 2 Kapolres Cup X STISIP BP Banjar 2025', 'Selamat atas prestasi yang diraih Tim Bola Voli Putra menjadi Juara 2 Kapolres Cup X STISIP BP Banjar 2025'),
(11, '1756315735_achievement.jpg', 'SMKN 3 Banjar', '2025-05-16', ' Juara 1 Lomba Kriya FLS3N kota banjar', 'Selamat atas prestasi yang diraih oleh ananda\r\n▪︎ Azril Maulana - Juara 1 Lomba Kriya\r\n'),
(12, '1756315899_achievement.jpg', 'SMKN 3 Banjar', '2025-05-16', ' Lomba Online Tingkat Nasional', 'Selamat atas prestasi yang diraih oleh Sinta Dewi Anggraeni (X APAT 3) pada ajang Lomba Online Tingkat Nasional'),
(13, '1756316118_achievement.jpg', 'SMKN 3 Banjar', '2025-05-17', ' prestasi dan lolos seleksi Duta Siswa Kota Banjar', 'Selamat atas prestasi dan lolos seleksi Duta Siswa Kota Banjar yang diraih oleh Rifa Nur Rahma (X AKL 2)'),
(14, '1756316316_achievement.jpg', 'SMKN 3 Banjar', '2025-04-02', ' Juara 2  (LCTA) di Universitas Galuh Ciamis', 'Selamat atas prestasi yang di raih Sebagai juara 2 Lomba Cepat Tepat Akuntansi (LCTA) di Universitas Galuh Ciamis');

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `id` bigint NOT NULL,
  `announcements_title` varchar(255) NOT NULL,
  `announcements_image` text NOT NULL,
  `date` date DEFAULT NULL,
  `announcements_description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`id`, `announcements_title`, `announcements_image`, `date`, `announcements_description`) VALUES
(5, 'DIRGAHAYU REPUBLIK INDONESIA ', '1756313701_announcement.jpg', '2025-08-17', 'Civitas Akademika SMKN 3 BANJAR Mengucapkan DIRGAHAYU REPUBLIK INDONESIA Ke 80'),
(6, ' (ANBK) Hari ke-2', '1756314046_announcement.jpg', '2025-07-03', 'Pelaksanaan Asesmen Nasional Berbasis Komputer (ANBK)\r\nHari ke-2'),
(7, ' (ANBK) Hari ke-1', '1756314242_announcement.jpg', '2023-07-13', 'Pelaksanaan Asesmen Nasional Berbasis Komputer (ANBK)\r\nHari ke-1');

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` bigint NOT NULL,
  `image` varchar(200) NOT NULL,
  `title` varchar(200) NOT NULL,
  `date` date DEFAULT NULL,
  `author` varchar(100) NOT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `image`, `title`, `date`, `author`, `updated_at`, `content`) VALUES
(13, '1756364939_blog.png', 'SMKN 3 Banjar Adalah Smk Unggulan Di Kota Banjar', '2025-09-02', 'SMKN 3 Banjar', '2025-09-02 02:02:02', 'SMK Negeri 3 Banjar adalah sekolah kejuruan unggulan di Kota Banjar yang fokus mencetak lulusan berkompetensi teori dan praktik sesuai dunia kerja. Dengan berbagai jurusan, fasilitas lengkap, guru berpengalaman, dan program Prakerin, sekolah ini menekankan kedisiplinan, kreativitas, dan kewirausahaan. Prestasi akademik dan non-akademik siswa membuktikan kualitasnya, menjadikan SMKN 3 Banjar tempat berkembang, berkarya, dan mempersiapkan masa depan gemilang.'),
(16, '1756542516_blog.jpg', '\"Jauhi Pergaulan Bebas, Narkoba Demi Masa Depan Cerah!\"', '2025-09-02', 'SMKN 3 Banjar', '2025-09-02 02:01:50', 'Hari ini Siswa/i Smkn 3 Banjar, mendapatkan penyuluhan penting dari kepolisian tentang bahaya pergaulan bebas, dan narkoba. 🚫💊🏍️\r\n\r\nMari bersama-sama membangun generasi yang lebih sadar hukum, tertib berlalu lintas, dan menjauhi segala bentuk penyimpangan demi masa depan yang lebih baik! 💪🔥\r\n\r\n\"Jauhi Pergaulan Bebas, Narkoba, dan Pelanggaran Lalu Lintas Demi Masa Depan Cerah!\"'),
(17, '1756543779_blog.jpg', 'Rangkaian Visitasi Akreditasi SMK Negeri 3 Banjar Tahun 2023', '2025-09-02', 'SMKN 3 Banjar', '2025-09-06 16:24:53', 'Rangkaian Visitasi Akreditasi SMK Negeri 3 Banjar Tahun 2023 telah selesai,kegiatan yg dilaksanakan selama 2 hari pada tgl 29 September 2023 & 30 September 2023 telah menguras tenaga dan pikiran. Namun semuai dapat dilaksanalan dengan baik dan lancar,ucapan terima kasih disampaikan kepada Bapak/Ibu Guru, Tata Usaha, Komite Sekolah dan seluruh siswa dan siswi SMK Negeri 3 Banjar atas usaha dan kerjasamanya. Semoga Asesor yg melaksanakan dapat memberikan penilaian yg objektif dan yg terbaik utk SMK Negeri 3 Banjar,aamiin..\\\\r\\\\n');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int NOT NULL,
  `icon` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `contact` varchar(100) NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `link_url` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `icon`, `contact`, `email`, `link_url`) VALUES
(13, 'fas fa-phone-alt', ' (0265)2734141', 'smkn3banjar@gmail.com', 'https://smkn3banjar.sch.id/gallery?search=');

-- --------------------------------------------------------

--
-- Table structure for table `extracurriculars`
--

CREATE TABLE `extracurriculars` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text,
  `coach` varchar(100) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `extracurriculars`
--

INSERT INTO `extracurriculars` (`id`, `name`, `description`, `coach`, `image`, `created_at`, `updated_at`) VALUES
(3, 'OSIS', 'OSIS merupakan kependekan dari Organisasi Siswa Intra Sekolah. Organisasi ini berada di tingkat sekolah dan dibentuk di sekolah menengah yaitu SMP dan SMA. Organisasi ini menjadi wadah berkumpulnya para siswa untuk mencapai tujuan tertentu. Organisasi ini terdiri dari susunan kepanitian yang terdiri dari ketua, wakil ketua, sekretaris, bendahara, kemudian seksi-seksi lainnya. Setiap jabatan di dalam OSIS memiliki tugas masing-masing. Kepengurusan OSIS memiliki masa kerja yang terbatas yaitu selama satu tahun dan akan diperbaharui lagi.', 'Apri Nurardiansyah, S.Pd', '1756524996_ekskul.png', '2025-08-30 03:08:01', '2025-08-30 03:36:36'),
(5, 'Pramuka', 'Kegiatan ekstrakurikuler merupakan kegiatan tambahan di luar kegiatan belajar mengajar yang biasanya dilakukan di luar sekolah atau di sekolah yang tentu saja memiliki banyak manfaat. Kegiatan ini dapat mengembangkan diri agar peserta didik menjadi lebih aktif, mempelajari kehidupan sosial, dan dapat mengembangkan karir peserta didik, selain itu ekstrakurikuler dapat memperdalam pengetahuan, memperluas wawasan, menambah keterampilan, dan membentuk karakter peserta didik sesuai dengan minat dan bakat setiap individu.', 'Cipto Rahayu, S.Pd', '1756525590_pramuka.png', '2025-08-30 03:46:30', '2025-08-30 03:46:30'),
(6, 'Paskibra', 'Paskibraka adalah singkatan dari Pasukan Pengibar Bendera dengan tugas utamanya untuk mengibarkan dan menurunkan Bendera Merah Putih dalam upacara peringatan Hari Kemerdekaan Republik Indonesia dan Proklamasi Kemerdekaan Republik Indonesia di tiga tempat, yakni tingkat kabupaten/kota, provinsi dan nasional.', 'Andi Kuswandi, S.Pd.', '1756525664_paskibra.png', '2025-08-30 03:47:44', '2025-08-30 03:48:13'),
(7, 'IRMA', 'Irma adalah ikatan remaja masjid, yang mana didalamnya terdapat beberapa program keagamaan yang dirancang oleh pembina Irma untuk memberikan bimbingan khusus kepada seluruh anggota Irma agar dapat memahami dan mengamalkan ajaran islam yang sesuai dengan ajaran Ahlussunnah waljamaah seperti belajar membaca AL-Qur’an dengan baik dan benar, belajar shalat dengan baik dan benar, belajar berpidato, belajar khutbah jum’at, adzan, puisi islami, hadroh, berorganisasi dan lain sebagainya.', 'Jamaludin, S.Pd.I', '1756525791_irma.png', '2025-08-30 03:49:51', '2025-08-30 03:49:51'),
(8, 'PMR', 'PMR yakni singkatan Palang Merah Remaja adalah wadah pembinaan dan pengembangan anggota remaja PMI, Ekstrakurikuler Palang Merah Remaja (PMR) merupakan salah satu ekstrakurikuler yang bergerak dibidang kepalangmerahan dimana ekstrakurikuler Palang Merah Remaja (PMR) adalah wadah pembinaan anggota remaja dengan tujuan membangun dan mengembangkan karakter anggota PMR yang berpedoman pada tribakti PMR dan prinsip kepalangmerahan untuk menjadi relawan masa depan.', 'Gema Patimah, S.Pd', '1756525861_pmr.png', '2025-08-30 03:51:01', '2025-08-30 03:51:01'),
(9, 'Multimedia', 'Ekstrakurikuler Multimedia adalah wadah bagi siswa untuk mengembangkan kreativitas di bidang desain grafis, fotografi, videografi, dan animasi. Kegiatan ini melatih keterampilan digital serta memberikan pengalaman nyata dalam pembuatan konten kreatif.\r\n', 'Maman Suparman, ST', '1756526329_Screenshot_2025_08_30_105417_removebg_preview.png', '2025-08-30 03:58:49', '2025-09-08 06:17:04');

-- --------------------------------------------------------

--
-- Table structure for table `galleries`
--

CREATE TABLE `galleries` (
  `id` bigint NOT NULL,
  `image` varchar(200) NOT NULL,
  `author` varchar(100) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `galleries`
--

INSERT INTO `galleries` (`id`, `image`, `author`, `date`, `description`) VALUES
(9, '1756316645_image.jpg', 'SMKN 3 Banjar', '2023-11-14', 'Kunjungan Industri Jurusan TKRO ke Balai Yasa PT. KAI dan PT. FUTAKE INDONESIA 2023'),
(10, '1756316819_Gallery-121223032250.jpg', 'SMKN 3 Banjar', '2023-11-14', 'Kunjungan Industri Jurusan TBSM ke BLPT Jogjakarta 2023'),
(11, '1756316852_Gallery-121223032046.jpg', 'SMKN 3 Banjar', '2023-11-13', 'Kunjungan Industri Jurusan APAT ke BPTPB Jogjakarta'),
(12, '1756316932_Gallery-121223031829.jpg', 'SMKN 3 Banjar', '2023-10-27', 'Workshop Implementasi Kurikulum dan Kunjungan Industri 2023'),
(13, '1756316964_Gallery-121223031552.jpg', 'SMKN 3 Banjar', '2017-07-12', 'Foto Bersama Visitasi Akreditasi SMK Negeri 3 Banjar'),
(14, '1756317004_Gallery-121223031458.jpg', 'SMKN 3 Banjar', '2016-06-15', 'Akreditasi SMK Negeri 3 Banjar, Pada Saat Rapat Bersama');

-- --------------------------------------------------------

--
-- Table structure for table `headmasters`
--

CREATE TABLE `headmasters` (
  `id` bigint NOT NULL,
  `headmaster_name` varchar(255) NOT NULL,
  `headmaster_photo` text NOT NULL,
  `headmaster_description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `headmasters`
--

INSERT INTO `headmasters` (`id`, `headmaster_name`, `headmaster_photo`, `headmaster_description`) VALUES
(5, 'Rusdiharto S.pd', '1756176825_headmaster.png', 'Alhamdulillahi robbil alamin, puji syukur kami panjatkan ke hadirat Allah SWT atas rahmat dan karunia-Nya sehingga Website resmi SMK Negeri 3 Banjar dengan alamat www.smkn3banjar.sch.id\r\n dapat diperbaharui. Website ini kami hadirkan sebagai sarana informasi bagi seluruh pimpinan, guru, karyawan, siswa, serta masyarakat umum mengenai profil, kegiatan, dan fasilitas sekolah. Kami berharap Website ini menjadi media interaksi positif yang mempererat silaturahmi antar civitas akademika dan masyarakat, sekaligus wadah berbagi informasi serta aspirasi demi kemajuan sekolah kita bersama.\r\n\r\nPada kesempatan ini, saya selaku Kepala Sekolah menyampaikan rasa syukur dan kebanggaan atas amanah yang diberikan untuk memimpin SMK Negeri 3 Banjar. Tugas ini merupakan tanggung jawab besar yang hanya bisa dijalankan dengan kebersamaan, kerja keras, disiplin, dan semangat pantang menyerah dari seluruh warga sekolah. Mari kita bangun budaya sekolah yang positif, menjunjung tinggi kejujuran, kedisiplinan, dan kebersamaan agar SMK Negeri 3 Banjar mampu mencetak lulusan yang unggul, berkarakter, dan siap bersaing di masa depan. Wassalamu’alaikum warahmatullahi wabarakatuh.');

-- --------------------------------------------------------

--
-- Table structure for table `majors`
--

CREATE TABLE `majors` (
  `id` bigint NOT NULL,
  `majors_name` varchar(255) NOT NULL,
  `majors_image` text NOT NULL,
  `majors_description` text NOT NULL,
  `head` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `majors`
--

INSERT INTO `majors` (`id`, `majors_name`, `majors_image`, `majors_description`, `head`) VALUES
(3, 'APHP', '1756133314_major.png', 'Jurusan Agribisnis Pengolahan Hasil Pertanian dan Perikanan (APHPI)\r\nJurusan APHPI mempelajari cara mengolah hasil pertanian dan perikanan menjadi produk yang memiliki nilai tambah dan daya saing tinggi. Siswa dibekali keterampilan dalam pengolahan pangan, pengemasan, pengawetan, dan manajemen usaha di bidang agribisnis.\r\n\r\nPembelajaran menggabungkan teori dan praktik, mulai dari pengolahan bahan baku menjadi produk olahan seperti makanan, minuman, atau produk turunan lainnya, hingga strategi pemasaran dan kewirausahaan.\r\n\r\nKompetensi yang dipelajari antara lain:\r\n\r\n- Teknik pengolahan hasil pertanian dan perikanan.\r\n- Teknologi pengemasan dan pengawetan pangan.\r\n- Manajemen mutu dan keamanan pangan.\r\n- Kewirausahaan dan pemasaran produk.\r\n- Pengelolaan usaha agribisnis.\r\n\r\nPeluang kerja lulusan APHPI:\r\n\r\n- Industri pengolahan pangan.\r\n- Usaha mikro, kecil, dan menengah (UMKM).\r\n- Perusahaan agribisnis dan perikanan.\r\n- Laboratorium pengujian mutu pangan.\r\n- Wirausaha di bidang olahan pertanian dan perikanan.\r\n\r\nDengan jurusan APHPI, lulusan diharapkan menjadi tenaga kerja terampil yang siap bersaing di dunia industri maupun menjadi wirausaha mandiri.', 'Dwi Astuti S.T'),
(5, 'PPLG', '1756133266_major.png', 'Pengembangan Perangkat Lunak & Gim (PPLG)\r\nJurusan RPL mempelajari perancangan, pengembangan, dan pemeliharaan perangkat lunak untuk berbagai kebutuhan, mulai dari aplikasi desktop, web, hingga mobile. Siswa dilatih menjadi programmer, analis sistem, dan pengembang aplikasi yang kompeten, kreatif, dan siap menghadapi perkembangan teknologi.\r\n\r\nPembelajaran di PPLG menggabungkan teori dan praktik, mulai dari logika pemrograman, desain antarmuka, hingga implementasi dan pengujian aplikasi, disertai penanaman etika profesi di dunia IT.\r\n\r\nKompetensi yang dipelajari antara lain:\r\n\r\n- Pemrograman berbagai bahasa (Java, Python, PHP, JavaScript, dsb.)\r\n- Desain dan pengembangan aplikasi berbasis web, desktop, dan mobile.\r\n- Basis data dan manajemen data.\r\n- Analisis dan perancangan sistem informasi.\r\n- Pengujian dan pemeliharaan perangkat lunak.\r\n- Kewirausahaan di bidang teknologi.\r\n\r\nPeluang kerja lulusan PPLG:\r\n\r\n- Programmer / Software Developer.\r\n- Web Developer / Mobile App Developer.\r\n- Database Administrator.\r\n- System Analyst.\r\n- IT Support.\r\n\r\nWirausaha di bidang teknologi informasi urusan PPLG membekali siswa dengan keterampilan yang relevan dengan era digital, sehingga siap bersaing di dunia industri maupun menciptakan peluang kerja sendiri.', 'Yasrifan Mahzar Nurisa, S.Kom'),
(6, 'TKRO', '1756218573_major.png', 'Jurusan Teknik Kendaraan Ringan Otomotif (TKR)\r\nJurusan TKR mempelajari teknologi, perawatan, dan perbaikan kendaraan bermotor roda empat atau lebih. Siswa dibekali keterampilan dalam mendiagnosis kerusakan, melakukan servis, hingga perbaikan sistem mesin, kelistrikan, dan rangka kendaraan sesuai standar industri otomotif.\r\n\r\nPembelajaran dilaksanakan melalui teori di kelas, praktik di bengkel sekolah, serta magang di industri otomotif, sehingga lulusan memiliki kemampuan kerja nyata di lapangan.\r\n\r\nKompetensi yang dipelajari antara lain:\r\n\r\n- Perawatan dan perbaikan mesin kendaraan ringan.\r\n- Sistem pemindah tenaga dan chasis.\r\n- Sistem kelistrikan dan elektronik kendaraan.\r\n- Teknologi injeksi dan sistem kontrol modern.\r\n- Penggunaan peralatan bengkel sesuai standar.\r\n- Keselamatan kerja di bidang otomotif.\r\n\r\nPeluang kerja lulusan TKR:\r\n\r\n- Mekanik atau teknisi bengkel resmi dan umum.\r\n- Teknisi di perusahaan otomotif.\r\n- Service advisor atau parts officer.\r\n- Industri perakitan kendaraan.\r\n- Wirausaha bengkel atau jasa perawatan kendaraan.\r\n\r\nJurusan TKR mencetak tenaga kerja terampil yang siap bekerja di industri otomotif modern maupun membuka usaha mandiri di bidang perawatan kendaraan.', 'Danu Sujiwo, S.T'),
(9, 'APAT', '1756218534_major.png', 'Jurusan Agribisnis Perikanan Air Tawar (APAT)\r\nJurusan APAT mempelajari teknik budidaya, pengelolaan, dan pemasaran hasil perikanan air tawar secara modern dan berkelanjutan. Siswa dibekali keterampilan mulai dari pembenihan, pembesaran, pengolahan hasil, hingga strategi pemasaran produk perikanan.\r\n\r\nPembelajaran dilakukan melalui teori di kelas, praktik di kolam budidaya, laboratorium, hingga magang di unit usaha perikanan, sehingga lulusan menguasai keterampilan teknis sekaligus manajemen usaha.\r\n\r\nKompetensi yang dipelajari antara lain:\r\n\r\n- Pembenihan dan pembesaran ikan air tawar.\r\n- Pengelolaan kualitas air dan pakan.\r\n- Pengendalian hama dan penyakit ikan.\r\n- Pengolahan dan pengemasan hasil perikanan.\r\n- Manajemen dan pemasaran usaha perikanan.\r\n- Teknologi budidaya ramah lingkungan.\r\n\r\nPeluang kerja lulusan APAT:\r\n\r\n- Pembudidaya ikan air tawar.\r\n- Teknisi budidaya di perusahaan perikanan.\r\n- Penyuluh perikanan.\r\n- Pengolah dan pemasar hasil perikanan.\r\n- Wirausaha di bidang budidaya dan pengolahan ikan.\r\n\r\nJurusan APAT mencetak lulusan yang siap bekerja di sektor perikanan air tawar atau membangun usaha mandiri, dengan keterampilan yang relevan dan berorientasi pada keberlanjutan lingkungan.', 'Wahyudin Abdul Hadi, S.Tp'),
(11, 'TBSM', '1756218459_major.png', 'Jurusan Teknik dan Bisnis Sepeda Motor (TBSM)\r\n\r\nJurusan TBSM membekali siswa dengan keterampilan perbaikan, perawatan, dan manajemen sepeda motor modern. Pembelajaran mencakup teori di kelas, praktik di bengkel sekolah, dan magang di bengkel atau dealer resmi.\r\n\r\nKompetensi utama:\r\n\r\n- Perbaikan dan perawatan mesin sepeda motor.\r\n- Diagnosa kerusakan dan perbaikan sistem kelistrikan.\r\n- Servis komponen rem, suspensi, dan transmisi.\r\n- Pemasaran dan manajemen bengkel sepeda motor.\r\n- Penerapan teknologi otomotif terbaru.\r\n\r\nPeluang kerja:\r\n\r\n- Mekanik sepeda motor di bengkel atau dealer resmi.\r\n- Teknisi perbaikan sistem kelistrikan dan mesin.\r\n- Konsultan atau wirausaha bengkel sepeda motor.\r\n- Supervisor perawatan dan layanan otomotif.\r\n- Lulusan TBSM siap bekerja di bengkel, dealer, atau membuka usaha mandiri di bidang otomotif dengan keterampilan teknis dan manajerial yang handal.', 'Wagino, S.Pd'),
(12, 'AKL', '1756219030_major.png', 'Jurusan Akuntansi dan Keuangan Lembaga (AKL)Jurusan AKL membekali siswa dengan keterampilan dalam pengelolaan keuangan, akuntansi, dan administrasi lembaga atau organisasi. Pembelajaran meliputi teori di kelas, praktik penyusunan laporan keuangan, serta magang di perusahaan, kantor akuntan, maupun lembaga keuangan.Kompetensi utama:- Pencatatan transaksi keuangan manual maupun komputerisasi.- Penyusunan laporan keuangan perusahaan, koperasi, dan instansi pemerintah.- Pengelolaan administrasi dan kas kecil.- Pengoperasian aplikasi akuntansi (MYOB, Accurate, dll).- Analisis keuangan dan dasar-dasar audit.Peluang kerja:- Staf administrasi dan keuangan di perusahaan atau instansi.- Teller/CS perbankan.- Staf akuntansi di kantor akuntan publik.-  Pengelola koperasi atau lembaga keuangan.- Wirausaha di bidang jasa akuntansi atau bisnis mandiri.Lulusan AKL siap bekerja di perusahaan, instansi pemerintah, lembaga keuangan, maupun membuka usaha sendiri dengan bekal keterampilan akuntansi dan keuangan yang profesional.', 'Diki Zaitun, M.Pd.');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` bigint NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `telepon` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `subjek` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `name`, `email`, `telepon`, `subjek`, `message`, `created_at`) VALUES
(28, 'suga', 'aguskusmianto686@gmail.com', '085950898193', 'cccc', 'halo', '2025-09-04 04:10:33'),
(29, 'agus', 'agus@gmail.com', '083879025312', 'saja', 'dsfgn', '2025-09-10 01:35:45');

-- --------------------------------------------------------

--
-- Table structure for table `social_media`
--

CREATE TABLE `social_media` (
  `id` bigint NOT NULL,
  `icon` varchar(200) NOT NULL,
  `title` varchar(200) NOT NULL,
  `link_url` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `social_media`
--

INSERT INTO `social_media` (`id`, `icon`, `title`, `link_url`) VALUES
(8, 'bi bi-instagram', 'SMKN 3 Banjar', 'https://www.instagram.com/smkn3banjar/?hl=en'),
(9, 'bi bi-facebook', 'SMKN 3 Banjar', 'https://www.facebook.com/profile.php?id=100064902391481'),
(10, 'bi bi-youtube', 'SMKN 3 Banjar', 'https://www.youtube.com/@smkn3banjar795'),
(11, 'bi bi-twitter-x   kbjkbjkb', 'SMKN 3 Banjar', 'https://x.com/3Mit3k');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` bigint NOT NULL,
  `teachers_name` varchar(255) NOT NULL,
  `jk` varchar(255) NOT NULL,
  `teachers_photo` text NOT NULL,
  `teachers_major` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `teachers_name`, `jk`, `teachers_photo`, `teachers_major`) VALUES
(5, 'Arif Rahman Hakim, S.Pd', 'Laki-Laki', '1756208303_teacher.jpg', 'APHP'),
(15, 'Apri Nurardiansyah, S.Pd', 'Laki-Laki', '1756208228_teacher.jpg', 'sejarah'),
(16, 'Agus Gandi, M.Pd.', 'Laki-Laki', '1756208143_teacher.jpg', 'Tu'),
(17, 'Azka Dalila Nurlimatin, S.Pd', 'Perempuan', '1756208391_teacher.jpg', 'B.Jepang'),
(18, 'Budianto, S.Pd', 'Laki-Laki', '1756208578_teacher.jpg', 'AKL'),
(19, 'Bambang Budi Yitno, S.Pd.', 'Laki-Laki', '1756311331_teacher.jpg', 'b.indonesia'),
(20, 'Buntoro Dwi Mulyadi, S.Pd', 'Laki-Laki', '1756311422_teacher.jpg', 'TSM'),
(21, 'Cipto Rahayu, S.Pd', 'Laki-Laki', '1756311476_teacher.jpg', 'MTK'),
(22, 'Danu Sujiwa, ST', 'Laki-Laki', '1756311570_teacher.jpg', 'TKR'),
(23, 'Deni Anwar Kurnia, S.Si', 'Laki-Laki', '1756311679_teacher.jpg', 'APHP'),
(24, 'Darmawati, S.Si', 'Perempuan', '1756311740_teacher.jpg', 'APAT'),
(25, 'Dewi Rahmat Agustini, S.Pd', 'Perempuan', '1756312425_teacher.jpg', 'PPKN'),
(26, 'Dian Dachniar, SH.', 'Perempuan', '1756312463_teacher.jpg', 'PPKN'),
(27, 'Enceng Asikin, S.Pd', 'Laki-Laki', '1756312504_teacher.jpg', 'PJOK'),
(28, 'Fitriana Laela, S.Pd', 'Perempuan', '1756312572_teacher.jpg', 'Sejarah'),
(29, 'Gema Patimah, S.Pd', 'Perempuan', '1756312643_teacher.jpg', 'MTK'),
(30, 'Maman Suparman, ST', 'Laki-Laki', '1756312716_teacher.jpg', 'Web Developer'),
(31, 'Yusep Yanuar Sanjaya, S.Pd', 'Laki-Laki', '1756312759_teacher.jpg', 'B.Inggris'),
(32, 'Wasis Pribadhy, S.Pd', 'Laki-Laki', '1756312798_teacher.jpg', 'IPAS'),
(33, 'Wahyu Suryaman, SE.ST', 'Laki-Laki', '1756312873_teacher.jpg', 'PPL'),
(34, 'Tatik Widiyati, S.Si', 'Perempuan', '1756312920_teacher.jpg', 'IPAS'),
(35, 'Siti Maryam, S.Pd', 'Perempuan', '1756312950_teacher.jpg', 'BK'),
(36, 'Rifqi Junjunan, S.Pd', 'Laki-laki', '1756312996_teacher.jpg', 'BK');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` bigint NOT NULL,
  `image` varchar(255) NOT NULL,
  `name` varchar(200) NOT NULL,
  `rating` tinyint(1) NOT NULL DEFAULT '5',
  `status` varchar(200) NOT NULL,
  `message` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `image`, `name`, `rating`, `status`, `message`) VALUES
(26, '1756321886_testimonial.png', 'Deni Hartono', 5, 'Bekerja', 'Disini aku belajar , sangat berkesan bisa menjadi bagian keluarga besar SMK Negeri 3 Banjar (XII RPL 3)'),
(27, '1756322026_testimonial.png', 'Trigonal Media', 5, 'Usaha', 'Tempatnya luas bagus dengan fasilitas yang lengkap saya sangat nyaman selama belajar disitu.'),
(28, '1756322383_testimonial.png', 'Zaeni Nadhif Fgfhj', 3, 'Bekerja', 'Lokasinya sangat strategis berada diperbatasan antara Jawa Barat dengan Jawa Tengah.');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` enum('staf','admin') COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES
(1, 'staf', 'staf@gmail.com', NULL, '$2y$10$NeCB5695dcCWF24yB4qEJOoq88p.3wIPtDtAdLZjn8YUB.1eA9qgC', NULL, '2025-09-02 09:55:29', '2025-09-02 09:55:29', 'staf'),
(2, 'admin', 'admin@gmail.com', NULL, '$2y$10$Ij0cutKy/falMXWO7EVPIuGP0Pd7GrycVBWgAO4/s/MmLZhAudsC2', NULL, '2025-09-02 09:56:28', '2025-09-02 09:56:28', 'admin'),
(12, 'agus', 'agus@gmail.com', NULL, '$2y$10$Jk/zCDzMyl3lVMxH1FsrNe6Gq7voIjyEOONJGtjTsGmFebSu/.Bke', NULL, '2025-09-10 01:57:56', '2025-09-10 01:57:56', 'staf');

-- --------------------------------------------------------

--
-- Table structure for table `user_activities`
--

CREATE TABLE `user_activities` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `activity` varchar(50) NOT NULL,
  `login_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `logout_at` timestamp NULL DEFAULT NULL,
  `ip_address` varchar(50) DEFAULT NULL,
  `user_agent` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `table_name` varchar(100) DEFAULT NULL,
  `record_id` int DEFAULT NULL,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user_activities`
--

INSERT INTO `user_activities` (`id`, `user_id`, `activity`, `login_at`, `logout_at`, `ip_address`, `user_agent`, `created_at`, `table_name`, `record_id`, `description`) VALUES
(300, 2, 'delete', '2025-09-09 08:51:32', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0', '2025-09-09 08:51:32', 'testimonials', 30, 'image=\'1757175456_testimonial.jpg\', name=\'Zaeni Nadhif Fgfhj\', rating=\'3\', status=\'Bekerja\', message=\'j\''),
(301, 2, 'update', '2025-09-10 01:11:08', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0', '2025-09-10 01:11:08', 'majors', 12, 'majors_name: \'AKL\' → \'AKL hfgdshf\''),
(302, 2, 'update', '2025-09-10 01:11:28', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0', '2025-09-10 01:11:28', 'majors', 12, 'majors_name: \'AKL hfgdshf\' → \'AKL\''),
(306, 2, 'create', '2025-09-10 01:57:56', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0', '2025-09-10 01:57:56', 'users', 12, 'name=\'agus\', email=\'agus@gmail.com\', role=\'staf\''),
(311, 2, 'create', '2025-09-10 02:02:05', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0', '2025-09-10 02:02:05', 'blogs', 25, 'Menambahkan blog baru: \'agus lapar\' oleh \'SMKN 3 Banjar\' pada tanggal \'2007-02-13\''),
(312, 2, 'delete', '2025-09-10 02:02:10', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0', '2025-09-10 02:02:10', 'blogs', 25, 'Blog dengan ID 25 dan title \'agus lapar\' dihapus'),
(313, 2, 'logout', NULL, '2025-09-10 02:11:24', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0', '2025-09-10 02:11:24', NULL, NULL, 'User logout dari sistem'),
(314, 1, 'login', '2025-09-10 02:11:34', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0', '2025-09-10 02:11:34', NULL, NULL, 'User login ke sistem'),
(315, 1, 'logout', NULL, '2025-09-10 02:45:06', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0', '2025-09-10 02:45:06', NULL, NULL, 'User logout dari sistem'),
(316, 2, 'login', '2025-09-10 02:45:11', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0', '2025-09-10 02:45:11', NULL, NULL, 'User login ke sistem'),
(317, 2, 'update', '2025-09-10 07:09:11', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0', '2025-09-10 07:09:11', 'testimonials', 28, 'Sebelum update: name=\'Zaeni Nadhif Fgfhj\', status=\'Bekerja\', message=\'Lokasinya sangat strategis berada diperbatasan antara Jawa Barat dengan Jawa Tengah.\', rating=\'4\', image=\'1756322383_testimonial.png\'; Sesudah update: name=\'Zaeni Nadhif Fgfhj\', status=\'Bekerja\', message=\'Lokasinya sangat strategis berada diperbatasan antara Jawa Barat dengan Jawa Tengah.\', rating=\'3\', image=\'1756322383_testimonial.png\''),
(318, 2, 'logout', NULL, '2025-09-11 05:06:38', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0', '2025-09-11 05:06:38', NULL, NULL, 'User logout dari sistem'),
(319, 2, 'login', '2025-09-11 07:20:27', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0', '2025-09-11 07:20:27', NULL, NULL, 'User login ke sistem'),
(320, 2, 'logout', NULL, '2025-09-15 06:32:24', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0', '2025-09-15 06:32:24', NULL, NULL, 'User logout dari sistem'),
(321, 2, 'login', '2025-09-15 06:32:30', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0', '2025-09-15 06:32:30', NULL, NULL, 'User login ke sistem'),
(322, 2, 'login', '2025-11-24 09:08:02', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-24 09:08:02', NULL, NULL, 'User login ke sistem');

-- --------------------------------------------------------

--
-- Table structure for table `visi_missions`
--

CREATE TABLE `visi_missions` (
  `id` bigint NOT NULL,
  `category` enum('visi','misi') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `visi_missions`
--

INSERT INTO `visi_missions` (`id`, `category`, `text`) VALUES
(18, 'visi', '-Terwujudnya sekolah yang berkualitas menghasilkan lulusan beriman, taqwa, berakhlaq mulia, berbudaya, unggul, tangguh, professional, bersertifikat standar Nasional dan Internasional\r\n-Menjadi sekolah kejuruan unggulan yang menghasilkan lulusan kompeten, kreatif, dan siap bersaing di dunia kerja maupun wirausaha.\r\n-Menyelenggarakan pendidikan vokasi yang berkualitas dengan kurikulum berbasis kompetensi.'),
(23, 'misi', '-Melaksanakan pembelajaran yang berbasis sains, teknologi dan budaya.\r\n-Mengimplementasikan iman, taqwa dan nilai-nilai karakter, budaya dalam kehidupan sehari-hari.\r\n-Menyelenggarakan pendidikan pelatihan bersertifikasi Nasional dan Internasional, menumbuhkan sikap profesional dalam keunggulan berprestasi dan bekerja.\r\n-Menerapkan pola pembinaan mental kedisiplinan untuk memiliki ketangguhan fisik dan mental untuk bekerja');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `abouts`
--
ALTER TABLE `abouts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `achievements`
--
ALTER TABLE `achievements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `extracurriculars`
--
ALTER TABLE `extracurriculars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `galleries`
--
ALTER TABLE `galleries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `headmasters`
--
ALTER TABLE `headmasters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `majors`
--
ALTER TABLE `majors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `social_media`
--
ALTER TABLE `social_media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_activities`
--
ALTER TABLE `user_activities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `visi_missions`
--
ALTER TABLE `visi_missions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `abouts`
--
ALTER TABLE `abouts`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `achievements`
--
ALTER TABLE `achievements`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `extracurriculars`
--
ALTER TABLE `extracurriculars`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `galleries`
--
ALTER TABLE `galleries`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `headmasters`
--
ALTER TABLE `headmasters`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `majors`
--
ALTER TABLE `majors`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `social_media`
--
ALTER TABLE `social_media`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user_activities`
--
ALTER TABLE `user_activities`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=323;

--
-- AUTO_INCREMENT for table `visi_missions`
--
ALTER TABLE `visi_missions`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_activities`
--
ALTER TABLE `user_activities`
  ADD CONSTRAINT `user_activities_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
