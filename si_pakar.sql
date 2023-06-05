-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 05, 2023 at 09:16 AM
-- Server version: 8.0.30
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `si_pakar`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`, `role`) VALUES
(2, 'admin1@gmail.com', '$2y$10$jysuC3aCCI0I4EBl6G7AY.tqancUcxEQII40/YJp5yEla3lbEbAf6', 'superadmin'),
(4, 'dokter@gmail.com', '$2y$10$V.MB0a2juHWJG4JLnRW.i.GKOXu49FVflDheFsIKavsQVm8yDx.WO', 'dokter');

-- --------------------------------------------------------

--
-- Table structure for table `aturan`
--

CREATE TABLE `aturan` (
  `id_penyakit` int NOT NULL,
  `id_gejala` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `aturan`
--

INSERT INTO `aturan` (`id_penyakit`, `id_gejala`) VALUES
(7, 16),
(7, 17),
(7, 22),
(7, 23),
(7, 24),
(7, 25),
(7, 26),
(7, 27),
(8, 16),
(8, 17),
(8, 28),
(8, 29),
(8, 30),
(8, 31),
(9, 16),
(9, 17),
(9, 32),
(9, 33),
(9, 34),
(9, 35),
(9, 36),
(10, 16),
(10, 37),
(10, 38),
(10, 39),
(11, 16),
(11, 17),
(11, 28),
(11, 40),
(11, 41),
(12, 16),
(12, 17),
(12, 42),
(12, 43),
(6, 16),
(6, 17),
(6, 18),
(6, 20),
(6, 21),
(6, 18);

-- --------------------------------------------------------

--
-- Table structure for table `gejala`
--

CREATE TABLE `gejala` (
  `id` int NOT NULL,
  `nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `gejala`
--

INSERT INTO `gejala` (`id`, `nama`) VALUES
(16, 'Muncul papul'),
(17, 'Muncul pustule'),
(18, 'Muncul nodul'),
(19, 'Muncul sikratik atau scar acne'),
(20, 'Predileksinya pada area wajah, dada dan punggung'),
(21, 'Pada umumnya muncul pada usia remaja'),
(22, 'Kulit perih dan sensasi terbakar'),
(23, 'Kemerahan pada kulit yang permanen'),
(24, 'Permukaan kulit menjadi kasar, seperti membengkak'),
(25, 'Masalah pada mata (mata bengkak, kelopak mata memerah)'),
(26, 'Predileksinya pada sentral wajah yaitu hidung, pipi, dagu, kening dan alis'),
(27, 'Pada umumnya ditemukan pada usia 30-40 tahun'),
(28, 'Bintil kecil pada lipatan dagu atau bagian bibir atas'),
(29, 'Kulit berwarna merah dan bersisik'),
(30, 'Predileksinya pada area mulut, bisa menyebar disekitar hidung dan mata'),
(31, 'Pada umumnya ditemukan pada wanita muda'),
(32, 'Ada keluhan gatal'),
(33, 'Muncul warna kemerahan yang menyebar ke alis dan glabella'),
(34, 'Sekumpulan benjolan merah atau benjolan benjolan kecil berisi nanah yang berkembang disekitar folikel rambut'),
(35, 'Predileksinya pada area punggung, bahu, dan dada bagian atas, bisa meluas sampai ke leher, lengan atas dan wajah'),
(36, 'Pada umumnya ditemukan pada laki-laki atau perempuan usia 1345 tahun'),
(37, 'Permukaan kulit kasar, tidak rata atau bersisik'),
(38, 'Predileksinya pada area kulit lengan, paha, pipi, bokong. Bisa muncul di wajah , alis atau kulit kepala'),
(39, 'Pada umumnya ditemukan pada anak-anak dan remaja'),
(40, 'Benjolan yang bengkak, besar dan bernanah'),
(41, 'Pada umumnya ditemukan pada laki-laki dewasa'),
(42, 'Peradangan pada wajah dan leher'),
(43, 'Pada umumnya ditemukan pada segala umur');

-- --------------------------------------------------------

--
-- Table structure for table `obat`
--

CREATE TABLE `obat` (
  `id` int NOT NULL,
  `nama` varchar(100) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `obat`
--

INSERT INTO `obat` (`id`, `nama`, `foto`, `deskripsi`) VALUES
(4, 'Serum Avoskin', '1683646603_Avoskin.jpg', 'Serum merupakan produk perawatan kulit yang mengandung bahan aktif yang tinggi. Manfaat face serum antara lain menjaga kulit tetap sehat.'),
(5, 'Moisturizer Elformula', '1683646754_Elformula.jpg', 'Moisturizer merupakan jenis skincare yang berfungsi untuk melembabkan kulit wajah.'),
(6, 'Sunscreen Facetology', '1683646834_facetology.jpg', 'Sunscreen atau juga dikenal dengan tabir surya adalah produk perawatan kulit berfungsi untuk melindungi kulit dari pengaruh sinar UV'),
(7, 'Serum Retinol', '1683646963_Retinol.jpg', 'Retinol merupakan salah satu jenis retinoid, yaitu turunan dari vitamin A. Bahan ini bekerja dengan cara mempercepat pergantian sel kulit mati'),
(8, 'Toner Wajah NPure', '1683647104_npure.png', 'Toner merupakan salah satu perawatan kulit dengan formula yang dikhususkan untuk membantu membersihkan sisa kotoran'),
(9, 'Serum Vit C', '1683647161_Vitc.jpeg', 'Serum vitamin C yang efektif untuk mencerahkan, ada pula yang ampuh mengatasi jerawat dan komedo.'),
(10, 'Elformula exfoliating', '1683647263_elformulaexfo.jpg', 'Exfoliating adalah sebuah cara yang dilakukan untuk mengangkat atau mengikis sel kulit mati yang berada di lapisan terluar kulit.'),
(11, 'Sunscreen vitamin c', '1685887360_android-chrome-192x192.png', 'Sunscreen untuk melindungi sinar uv');

-- --------------------------------------------------------

--
-- Table structure for table `obat_penyakit`
--

CREATE TABLE `obat_penyakit` (
  `id_penyakit` int NOT NULL,
  `id_obat` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `obat_penyakit`
--

INSERT INTO `obat_penyakit` (`id_penyakit`, `id_obat`) VALUES
(7, 4),
(7, 5),
(8, 6),
(8, 7),
(10, 5),
(10, 8),
(10, 10),
(11, 6),
(11, 7),
(11, 8),
(11, 10),
(12, 4),
(12, 6),
(12, 8),
(9, 4),
(9, 5),
(9, 6),
(9, 7),
(9, 8),
(9, 9),
(9, 10),
(6, 4),
(6, 5),
(6, 6),
(6, 7),
(6, 10);

-- --------------------------------------------------------

--
-- Table structure for table `penyakit`
--

CREATE TABLE `penyakit` (
  `id` int NOT NULL,
  `nama` varchar(50) NOT NULL,
  `penjelasan` text NOT NULL,
  `tindakan` text NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `penyakit`
--

INSERT INTO `penyakit` (`id`, `nama`, `penjelasan`, `tindakan`, `foto`) VALUES
(6, 'Acne Vulgaris', 'Acne vulgaris atau jerawat merupakan salah satu penyakit kulit yang paling umum terjadi. Kondisi ini terkadang disertai dengan peradangan (acne vulgaris inflamasi) atau tanpa peradangan (acne vulgaris noninflamasi).', 'Meski umumnya acne vulgaris hanya bersifat sementara, tetapi sering kali meninggalkan bekas luka yang terlihat jelas pada kulit. Untuk mengatasinya, Anda bisa melakukan beberapa perawatan wajah, seperti PRP, peeling, mikrodermabrasi, dan suntik filler.', '1682929569_acne vulgaris.jpg'),
(7, 'Rosacea', 'Rosacea adalah penyakit kulit wajah yang ditandai dengan kulit kemerahan disertai bintik-bintik menyerupai jerawat. Kondisi ini juga dapat menyebabkan kulit wajah menebal dan pembuluh darah di wajah membengkak.', 'Perawatan untuk penyakit kulit ini akan berfokus pada pengendalian gejalanya. Pada umumnya perawatannya akan membutuhkan kombinasi perawatan kulit dan obat yang diresepkan oleh dokter. Selain itu, durasi perawatan penyakit kulit ini juga akan tergantung pada jenis dan tingkat keparahan gejalanya.', '1682929890_rosacea.jpg'),
(8, 'Perioral dermatitis', 'Perioral dermatitis merupakan kondisi ketika kulit mengalami peradangan yang bisa berujung pada munculnya ruam dan rasa gatal yang hebat.', 'Tidak menggaruk atau menyentuh terlalu keras bagian kulit yang bermasalah. Menghentikan penggunaan obat topikal yang mengandung kortikosteroid. Menghentikan penggunaan produk perawatan kulit yang mengandung pewangi selama gejala berlangsung. Membersihkan muka dengan hanya menggunakan air selama gejala muncul.', '1682930831_perioral dermatitis.jpg'),
(9, 'Pityrosporum folliculitis', 'Folikulitis Malassezia awalnya diduga akibat Pityrosporum ovale sehingga dikenal juga Pityrosporum folliculitis. Folikulitis Malassezia atau dikenal juga sebagai fungal acne merupakan penyakit kulit akibat proliferasi/ peningkatan populasi Malassezia sp yang merupakan jamur flora normal kulit. Kondisi ini dapat terjadi akibat sumbatan folikel dan ketidakseimbangan flora normal kulit.', 'Untuk mengobati infeksi jamur dengan tepat, pasien perlu mengembalikan keseimbangan antara ragi dan bakteri di kulit. Beberapa pengobatan bisa membantu melakukannya. Penanganan menghilangkan malassezia folliculitis yakni mandi secara teratur, mengenakan pakaian lebih longgar, menggunakan sabun mandi dan obat anti jamur oral (dengan resep)', '1682930808_pityrosporum folliculitis.jpg'),
(10, 'Keratosis pilaris', 'Keratosis pilaris adalah kondisi kulit yang berbintik-bintik seperti kulit ayam dan teraba kasar. Gejala keratosis pilaris dapat berupa bintik-bintik yang teraba kasar, tetapi tidak menimbulkan gatal atau nyeri.', 'Keratosis pilaris tidak bisa dicegah, karena kondisi ini diturunkan secara genetik. Namun, penderita keratosis pilaris dapat mencegah kondisi ini memburuk dengan selalu menjaga kelembapan dan kebersihan kulit.', '1682931100_keratosis pilaris 2.jpg'),
(11, 'Gram-negative bacterical folliculitis', 'Folikulitis adalah peradangan pada folikel rambut atau tempat rambut tumbuh. Kondisi ini biasanya disebabkan oleh infeksi bakteri atau jamur. Meski sering kali tidak berbahaya, folikulitis bisa memburuk dan menyebabkan rambut hilang secara permanen.', 'Bersihkan area yang terinfeksi dengan air hangat dan sabun antibakteri. Pastikan untuk selalu menggunakan pakaian dan handuk yang bersih. Tempelkan kain yang telah direndam ke dalam campuran satu sendok teh garam dan dua gelas air ke area tubuh yang terinfeksi. Jika tidak ada garam, Anda bisa menggantinya dengan cuka putih. Hindari mencukur, menggaruk, atau mengenakan pakaian yang terlalu ketat, pada area yang terinfeksi.', '1682932005_folikulitis.jpg'),
(12, 'Pseudofolliculitis', 'Pseudofolliculitis barbae adalah peradangan akibat rambut yang tumbuh ke dalam kulit. Kondisi ini paling sering dipicu oleh pencukuran rambut terminal, yaitu rambut yang tebal, kasar, dan berpigmen yang mulai tumbuh setelah pubertas.', 'Eksfoliasi topikal dan keratolitik untuk mengangkat sel kulit mati di permukaan kulit dan melembutkan keratin rambut yang mencegah rambut berputar balik dan tumbuh dalam kulit. Seperti asam alfa-hidroksi (termasuk asam glikolat), asam salisilat, retinoid topikal, atau penggunaan lulur.', '1683648871_pseu.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `id` int NOT NULL,
  `penyakit_id` int NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `report`
--

INSERT INTO `report` (`id`, `penyakit_id`, `user_id`, `tanggal`) VALUES
(10, 6, '08123456789', '2023-05-01'),
(11, 0, '08982339050', '2023-05-02'),
(12, 6, '08982339050', '2023-05-02'),
(13, 0, '08982339050', '2023-05-02'),
(14, 0, '08982339050', '2023-05-02'),
(15, 10, '0284849', '2023-05-03'),
(16, 7, '0284849', '2023-05-08'),
(19, 9, '08982339050', '2023-05-09'),
(20, 7, '95599555', '2023-05-09'),
(21, 7, '0898234969', '2023-06-04');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `nama` varchar(50) NOT NULL,
  `no_telp` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`nama`, `no_telp`) VALUES
('Vincent', '01389455'),
('Mikhael', '0284849'),
('Vinn', '0394849949'),
('Vincent', '049966'),
('Yuen', '08123456789'),
('rytrty', '0834994'),
('Bino', '084596060'),
('Vincent', '08982339050'),
('Vincent', '0898234969'),
('Mitsuki', '13449'),
('VIncent', '3596696094'),
('Mikhael', '39559'),
('Vin', '455858586'),
('fnnf', '4949'),
('Mitsuki', '55995'),
('vin', '59606'),
('hhh', '7676776'),
('Bobi', '95599555'),
('08982339050', 'Mikhael');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `aturan`
--
ALTER TABLE `aturan`
  ADD KEY `id_gejala` (`id_gejala`),
  ADD KEY `id_penyakit` (`id_penyakit`);

--
-- Indexes for table `gejala`
--
ALTER TABLE `gejala`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `obat_penyakit`
--
ALTER TABLE `obat_penyakit`
  ADD KEY `id_obat` (`id_obat`),
  ADD KEY `id_penyakit` (`id_penyakit`);

--
-- Indexes for table `penyakit`
--
ALTER TABLE `penyakit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`id`),
  ADD KEY `penyakit_id` (`penyakit_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`no_telp`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `gejala`
--
ALTER TABLE `gejala`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `obat`
--
ALTER TABLE `obat`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `penyakit`
--
ALTER TABLE `penyakit`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `aturan`
--
ALTER TABLE `aturan`
  ADD CONSTRAINT `aturan_ibfk_1` FOREIGN KEY (`id_gejala`) REFERENCES `gejala` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `aturan_ibfk_2` FOREIGN KEY (`id_penyakit`) REFERENCES `penyakit` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `obat_penyakit`
--
ALTER TABLE `obat_penyakit`
  ADD CONSTRAINT `obat_penyakit_ibfk_1` FOREIGN KEY (`id_obat`) REFERENCES `obat` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `obat_penyakit_ibfk_2` FOREIGN KEY (`id_penyakit`) REFERENCES `penyakit` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `report`
--
ALTER TABLE `report`
  ADD CONSTRAINT `report_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`no_telp`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
