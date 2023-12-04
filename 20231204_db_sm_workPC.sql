-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2023 at 05:18 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sm`
--
CREATE DATABASE IF NOT EXISTS `db_sm` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `db_sm`;

-- --------------------------------------------------------

--
-- Table structure for table `tb_akreditasi`
--

DROP TABLE IF EXISTS `tb_akreditasi`;
CREATE TABLE `tb_akreditasi` (
  `id_akreditasi` int(11) NOT NULL,
  `nama_akreditasi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_akreditasi`
--

INSERT INTO `tb_akreditasi` (`id_akreditasi`, `nama_akreditasi`) VALUES
(0, '-- Lainnya --'),
(1, 'A'),
(2, 'B'),
(3, 'C');

-- --------------------------------------------------------

--
-- Table structure for table `tb_bayar`
--

DROP TABLE IF EXISTS `tb_bayar`;
CREATE TABLE `tb_bayar` (
  `id_bayar` int(11) NOT NULL,
  `id_mou` int(11) DEFAULT NULL,
  `id_praktik` int(11) NOT NULL,
  `kode_bayar` text NOT NULL,
  `atas_nama_bayar` text NOT NULL,
  `noRek_bayar` text NOT NULL,
  `melalui_bayar` text NOT NULL,
  `tgl_transfer_bayar` date NOT NULL,
  `tgl_input_bayar` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `file_bayar` text NOT NULL,
  `ket_bayar` text NOT NULL,
  `status_bayar` enum('T','TERIMA','TOLAK') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_institusi`
--

DROP TABLE IF EXISTS `tb_institusi`;
CREATE TABLE `tb_institusi` (
  `id_institusi` int(11) NOT NULL,
  `tgl_tambah_institusi` text DEFAULT NULL,
  `tgl_ubah_institusi` text DEFAULT NULL,
  `nama_institusi` text NOT NULL,
  `akronim_institusi` varchar(10) DEFAULT NULL,
  `logo_institusi` text DEFAULT NULL,
  `alamat_institusi` text DEFAULT NULL,
  `akred_institusi` text DEFAULT NULL,
  `tglAkhirAkred_institusi` date DEFAULT NULL,
  `fileAkred_institusi` text DEFAULT NULL,
  `ket_institusi` text NOT NULL,
  `messOpsional_institusi` enum('Y','T') DEFAULT NULL,
  `tempAkronim_institusi` text DEFAULT NULL,
  `tempLogo_institusi` text DEFAULT NULL,
  `tempAlamat_institusi` text DEFAULT NULL,
  `tempAkred_institusi` text DEFAULT NULL,
  `tempTglAkhirAkred_institusi` date DEFAULT NULL,
  `tempFileAkred_institusi` text DEFAULT NULL,
  `tempStatus_institusi` text NOT NULL,
  `tempKet_institusi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_institusi`
--

INSERT INTO `tb_institusi` (`id_institusi`, `tgl_tambah_institusi`, `tgl_ubah_institusi`, `nama_institusi`, `akronim_institusi`, `logo_institusi`, `alamat_institusi`, `akred_institusi`, `tglAkhirAkred_institusi`, `fileAkred_institusi`, `ket_institusi`, `messOpsional_institusi`, `tempAkronim_institusi`, `tempLogo_institusi`, `tempAlamat_institusi`, `tempAkred_institusi`, `tempTglAkhirAkred_institusi`, `tempFileAkred_institusi`, `tempStatus_institusi`, `tempKet_institusi`) VALUES
(1, NULL, NULL, 'AKADEMI PEREKAM MEDIS DAN INFORMATIKA KESEHATAN BANDUNG', 'APIKES BDG', './_img/logo_institusi/1.png', '', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(2, NULL, NULL, 'AKPER AL-MA\'ARIF BATURAJA', '', '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(3, NULL, NULL, 'AKPER BHAKTI KENCANA BANDUNG', '', '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(4, NULL, NULL, 'AKPER BIDARA MUKTI GARUT', '', '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(5, NULL, NULL, 'AKPER BUNTET PESANTREN CIREBON', '', '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(6, NULL, NULL, 'AKPER DUSTIRA CIMAHI', '', '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(7, NULL, '2023-03-30 8:10:56', 'SEKOLAH TINGGI ILMU KESEHATAN PERMATA NUSANTARA', 'STIKES CJR', './_img/logo_institusi/7.png', 'Jl. Raya Cibeber KM. 8 Cibeber Kabupaten Cianjur', 'C', '2021-06-17', './_file/akred/akred_7_2023-03-30.pdf', '', 'Y', NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(8, NULL, NULL, 'AKPER KEBONJATI', '', '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(9, NULL, NULL, 'AKPER LUWUK', '', '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(10, NULL, NULL, 'AKPER PEMBINA PALEMBANG', '', '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(11, NULL, NULL, 'AKPER PEMDA KOLAKA', '', '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(12, NULL, NULL, 'AKPER PEMKAB LAHAT', '', '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(13, NULL, NULL, 'AKPER RS. EFARINA PURWAKARTA', '', '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(14, NULL, NULL, 'AKPER SAIFUDDIN ZUHRI INDRAMAYU', '', '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(15, NULL, NULL, 'AKPER SAWERIGADING PEMDA LUWU RAYA PALOPO', '', '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(16, NULL, NULL, 'AKPER SINTANG', '', '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(17, NULL, NULL, 'AKPER TOLITOLI', '', '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(18, NULL, NULL, 'AKPER YPDR JAKARTA', '', '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(19, NULL, NULL, 'UNIVERSITAS KRISTEN MARANATHA', '', './_img/logo_institusi/19.png', NULL, NULL, NULL, NULL, '', NULL, 'Soluta ad incidunt ', './_img/logo_institusi/temp/19.png', 'Dolor sint enim quia', 'C', '1979-10-28', './_file/akred/akred_19_2022-03-17.pdf', 'terima', ''),
(20, NULL, NULL, 'UNIVERSITAS KRISTEN KRIDA WACANA', 'UKRIDA', './_img/logo_institusi/20.png', '', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(21, NULL, NULL, 'UNIVERSITAS ISLAM BANDUNG', 'UNISBA', './_img/logo_institusi/21.png', '', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(23, NULL, NULL, 'UNIVERSITAS PADJADJARAN', 'UNPAD', './_img/logo_institusi/23.png', '', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(25, NULL, NULL, 'UNIVERSITAS JENDERAL ACHMAD YANI', 'UNJANI', './_img/logo_institusi/25.png', '', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(26, NULL, NULL, 'POLTEKKES KEMENKES BANDUNG', '', '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(27, NULL, NULL, 'POLTEKKES TNI AU CIUMBULEUIT BANDUNG', '', '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(28, NULL, NULL, 'POLTEKKES BANTEN', '', '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(29, NULL, NULL, 'POLTEKKES KEMENKES MAKASSAR', '', '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(31, NULL, '2023-10-17 7:11:20', 'UNIVERSITAS AISYIYAH BANDUNG', 'UNISYA', './_img/logo_institusi/31.png', 'Jalan KH. Ahmad Dahlan Dalam Nomor 6 Bandung', 'B', '2023-10-17', './_file/akred/akred_31_2023-10-17.pdf', '', '', NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(32, NULL, NULL, 'STIKES BANI SALEH', '', '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(33, NULL, NULL, 'STIKES BHAKTI PERTIWI LUWU RAYA PALOPO', '', '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(34, NULL, NULL, 'STIKES BINA PUTERA BANJAR', '', '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(35, NULL, NULL, 'STIKES BORNEO TARAKAN', '', '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(36, NULL, NULL, 'STIKES BUDILUHUR CIMAHI', '', '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(37, NULL, NULL, 'STIKES CIREBON', '', '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(38, NULL, NULL, 'STIKES DEHASEN BENGKULU', '', '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(39, NULL, NULL, 'STIKES DHARMA HUSADA BANDUNG', '', '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(40, NULL, NULL, 'STIKES FALETEHAN', '', '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(41, NULL, NULL, 'STIKES FORT DE KOCK', '', '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(42, NULL, '2023-10-17 7:37:37', 'INSTITUT KESEHATAN IMMANUEL BANDUNG', 'IKES', './_img/logo_institusi/42.png', 'Jl. Kopo 161 Kota Bandung', 'A', '2023-10-17', './_file/akred/akred_42_2023-10-17.pdf', '', '', NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(43, NULL, NULL, 'STIKES JENDERAL AHMAD YANI', '', '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(44, NULL, NULL, 'STIKES KARSA HUSADA GARUT', '', '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(45, NULL, NULL, 'STIKES KOTA SUKABUMI', '', '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(46, NULL, NULL, 'STIKES KUNINGAN', '', '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(47, NULL, NULL, 'STIKES MAHARDIKA CIREBON', '', '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(48, NULL, NULL, 'STIKES MEDIKA CIKARANG / IMDS', '', '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(49, NULL, NULL, 'STIKES MITRA KENCANA TASIKMALAYA', '', '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(50, NULL, NULL, 'STIKES MUHAMADIYAH CIAMIS', '', '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(51, NULL, NULL, 'STIKES NAN TONGGA LUBUK ALUNG', '', '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(52, NULL, NULL, 'STIKES PPNI JAWA BARAT', '', '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(53, NULL, NULL, 'STIKES RAJAWALI', '', '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(54, NULL, NULL, 'STIKES SANTO BORROMEUS', '', '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(55, NULL, NULL, 'UNIVERSITAS SEBELAS APRIL SUMEDANG', '', '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(56, NULL, NULL, 'STIKES SYEDZA SAINTIKA PADANG', '', '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(57, NULL, NULL, 'STIKES TANA TORAJA', '', '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(58, NULL, NULL, 'STIKES YARSI BUKIT TINGGI', '', '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(59, NULL, NULL, 'STIKES YARSI PONTIANAK', '', '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(60, NULL, NULL, 'STIKES YPIB MAJALENGKA', '', '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(61, NULL, NULL, 'UNIVERSITAS ADVENT INDONESIA', '', '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(62, NULL, NULL, 'UNIVERSITAS BALE BANDUNG', '', '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(63, NULL, NULL, 'UNIVERSITAS BINA SARANA INFORMATIKA', 'BSI', '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(64, NULL, NULL, 'UNIVERSITAS GALUH CIAMIS', '', '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(65, NULL, NULL, 'UNIVERSITAS MUHAMMADIYAH SUKABUMI', '', '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(66, NULL, NULL, 'UNIVERSITAS NEGERI GORONTALO', '', '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(68, NULL, NULL, 'UNIVERSITAS PENDIDIKAN INDONESIA', 'UPI', './_img/logo_institusi/68.png', '', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(69, NULL, NULL, 'UNIVERSITAS RESPATI INDONESIA', '', '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(70, NULL, NULL, 'UNIVERSITAS SAMRATULANGI', '', '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(71, NULL, NULL, 'UNIVERSITAS SULTAN AGENG TIRTAYASA', 'UNTIRTA', '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(72, NULL, NULL, 'POLITEKNIK TEDC BANDUNG', '', '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(73, NULL, NULL, 'UNIVERSITAS PELITA HARAPAN', '', '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(74, NULL, NULL, 'POLTEKKES YAPKESBI SUKABUMI', '', '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(75, NULL, NULL, 'AKPER YPIB MAJALENGKA', '', '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(76, NULL, '2023-04-04 5:19:53', 'UNIVERSITAS MUHAMMADIYAH TASIKMALAYA', 'UMTAS', './_img/logo_institusi/76.png', 'Jl. Tamansari KM. 2,5 Mulyasari Kec. Tamansari Kota Tasikmalaya', 'B', '2026-04-14', './_file/akred/akred_76_2023-04-04.pdf', '', 'T', NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(78, NULL, NULL, 'POLITEKNIK NEGERI SUBANG', 'POLSUB', './_img/logo_institusi/78.png', '', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(81, NULL, NULL, 'SEKOLAH TINGGI ILMU KESEHATAN INDONESIA MAJU', '', '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(82, NULL, NULL, 'UNIVERSITAS BHAKTI KENCANA', 'UBK', './_img/logo_institusi/82.png', '', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(83, NULL, NULL, 'POLTEKKES KEMENKES JAYAPURA', '', '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(84, NULL, NULL, 'POLITEKNIK NEGERI INDRAMAYU', '', '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(85, NULL, NULL, 'UNIVERSITAS KRISTEN SATYA WACANA SALATIGA', '', '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(87, '2022-05-11', NULL, 'RS JIWA PROVINSI JAWA BARAT', 'RSJ*', './_img/logo_institusi/87.png', 'Jl. Kolonel Maturi KM.7, Desa Jambudipa, Kec. Cisarua, Kab. Bandung Barat, 40551', '-- Lainnya --', '3000-01-01', './_file/akred/akred_87_2023-03-09.pdf', '', 'T', NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(88, NULL, NULL, 'UNIVERSITAS KOMPUTER INDONESIA', 'UNIKOM', './_img/logo_institusi/88.png', '', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(89, '2023-03-09', NULL, 'STIKES RS DUSTIRA', NULL, '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(90, '2023-03-14', NULL, 'POLTEKKES TASIKMALAYA', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_jenjang_pdd`
--

DROP TABLE IF EXISTS `tb_jenjang_pdd`;
CREATE TABLE `tb_jenjang_pdd` (
  `id_jenjang_pdd` int(11) NOT NULL,
  `nama_jenjang_pdd` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_jenjang_pdd`
--

INSERT INTO `tb_jenjang_pdd` (`id_jenjang_pdd`, `nama_jenjang_pdd`) VALUES
(0, '-- Lainnya --'),
(1, 'SMA'),
(2, 'SMK'),
(3, 'MA'),
(4, 'D1'),
(5, 'D2'),
(6, 'D3'),
(7, 'D4'),
(8, 'S1'),
(9, 'Profesi'),
(10, 'S2');

-- --------------------------------------------------------

--
-- Table structure for table `tb_jurusan_pdd`
--

DROP TABLE IF EXISTS `tb_jurusan_pdd`;
CREATE TABLE `tb_jurusan_pdd` (
  `id_jurusan_pdd` int(11) NOT NULL,
  `nama_jurusan_pdd` text NOT NULL,
  `akronim_jurusan_pdd` text DEFAULT NULL,
  `id_jurusan_pdd_jenis` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_jurusan_pdd`
--

INSERT INTO `tb_jurusan_pdd` (`id_jurusan_pdd`, `nama_jurusan_pdd`, `akronim_jurusan_pdd`, `id_jurusan_pdd_jenis`) VALUES
(0, '-- Lainnya --', NULL, NULL),
(1, 'Kedokteran', NULL, 1),
(2, 'Keperawatan', NULL, 2),
(3, 'Psikologi', NULL, 3),
(4, 'Informasi Teknologi', 'IT', 4),
(5, 'Farmasi', NULL, 3),
(6, 'Pekerja Sosial', 'PEKSOS', 4),
(7, 'Kesehatan Lingkungan', 'KESLING', 3),
(8, 'Rekam Medis', 'RM', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tb_jurusan_pdd_jenis`
--

DROP TABLE IF EXISTS `tb_jurusan_pdd_jenis`;
CREATE TABLE `tb_jurusan_pdd_jenis` (
  `id_jurusan_pdd_jenis` int(11) NOT NULL,
  `nama_jurusan_pdd_jenis` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_jurusan_pdd_jenis`
--

INSERT INTO `tb_jurusan_pdd_jenis` (`id_jurusan_pdd_jenis`, `nama_jurusan_pdd_jenis`) VALUES
(0, '-- Lainnya --'),
(1, 'Kedokteran'),
(2, 'Keperawatan'),
(3, 'Nakes Lainnya'),
(4, 'Non Nakes');

-- --------------------------------------------------------

--
-- Table structure for table `tb_jurusan_pdd_jenjang`
--

DROP TABLE IF EXISTS `tb_jurusan_pdd_jenjang`;
CREATE TABLE `tb_jurusan_pdd_jenjang` (
  `id_jurusan_pdd_jenjang` int(11) NOT NULL,
  `id_jurusan_pdd` int(11) NOT NULL,
  `id_jenjang_pdd` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_jurusan_pdd_jenjang`
--

INSERT INTO `tb_jurusan_pdd_jenjang` (`id_jurusan_pdd_jenjang`, `id_jurusan_pdd`, `id_jenjang_pdd`) VALUES
(1, 1, 9),
(2, 1, 9),
(3, 2, 6),
(4, 2, 7),
(5, 2, 8),
(6, 2, 9),
(7, 3, 6),
(8, 3, 7),
(9, 3, 8),
(10, 3, 9),
(11, 4, 6),
(12, 4, 7),
(13, 4, 8),
(14, 5, 9),
(15, 5, 6),
(16, 5, 7),
(17, 5, 8),
(18, 6, 6),
(19, 6, 7),
(20, 6, 8),
(21, 7, 8),
(22, 7, 7),
(23, 7, 10),
(24, 8, 7),
(25, 8, 8),
(26, 8, 10),
(27, 7, 6),
(28, 8, 6);

-- --------------------------------------------------------

--
-- Table structure for table `tb_jurusan_pdd_jenjang_profesi`
--

DROP TABLE IF EXISTS `tb_jurusan_pdd_jenjang_profesi`;
CREATE TABLE `tb_jurusan_pdd_jenjang_profesi` (
  `id_jurusan_pdd_jenjang` int(11) NOT NULL,
  `id_jurusan_pdd` int(11) NOT NULL,
  `id_jenjang_pdd` int(11) NOT NULL,
  `id_profesi_pdd` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_jurusan_pdd_jenjang_profesi`
--

INSERT INTO `tb_jurusan_pdd_jenjang_profesi` (`id_jurusan_pdd_jenjang`, `id_jurusan_pdd`, `id_jenjang_pdd`, `id_profesi_pdd`) VALUES
(1, 1, 9, 1),
(2, 1, 9, 2),
(3, 2, 6, 0),
(4, 2, 7, 0),
(5, 2, 8, 0),
(6, 2, 9, 5),
(7, 3, 6, 0),
(8, 3, 7, 0),
(9, 3, 8, 0),
(10, 3, 9, 4),
(11, 4, 6, 0),
(12, 4, 7, 0),
(13, 4, 8, 0),
(14, 5, 9, 3),
(15, 5, 6, 0),
(16, 5, 7, 0),
(17, 5, 8, 0),
(18, 6, 6, 0),
(19, 6, 7, 0),
(20, 6, 8, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_kep_nilai`
--

DROP TABLE IF EXISTS `tb_kep_nilai`;
CREATE TABLE `tb_kep_nilai` (
  `id` int(11) NOT NULL,
  `jenis_nilai` text NOT NULL,
  `judul1` text NOT NULL,
  `judul2` text NOT NULL,
  `aspek_nilai` text NOT NULL,
  `var_code` text NOT NULL,
  `tipe_data` text NOT NULL,
  `isi_data` text NOT NULL,
  `status` text NOT NULL COMMENT 'belum digunakan'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_kep_nilai`
--

INSERT INTO `tb_kep_nilai` (`id`, `jenis_nilai`, `judul1`, `judul2`, `aspek_nilai`, `var_code`, `tipe_data`, `isi_data`, `status`) VALUES
(1, 'LAPORAN PENDAHULUAN', 'ISI', '-', 'Sistematika Benar', 'A1', 'radio', '1,2,3,4', ''),
(2, 'LAPORAN PENDAHULUAN', 'ISI', '-', 'Lengkap', 'A2', 'radio', '1,2,3,4', ''),
(3, 'LAPORAN PENDAHULUAN', 'ISI', '-', 'Waktu Pengumpulan Tepat', 'A3', 'radio', '1,2,3,4', ''),
(4, 'LAPORAN PENDAHULUAN', 'ISI', '-', 'Bukan Repetisi dan Plagiasi', 'A4', 'radio', '1,2,3,4', ''),
(5, 'LAPORAN PENDAHULUAN', 'RESPONSI LP', '-', 'Mampu menguraikan pengertian', 'B1', 'radio', '1,2,3,4', ''),
(6, 'LAPORAN PENDAHULUAN', 'RESPONSI LP', '-', 'Mampu menguraikan factor penyebab', 'B2', 'radio', '1,2,3,4', ''),
(7, 'LAPORAN PENDAHULUAN', 'RESPONSI LP', '-', 'Mampu menjelaskan proses terjadinya masalah', 'B3', 'radio', '1,2,3,4', ''),
(8, 'LAPORAN PENDAHULUAN', 'RESPONSI LP', '-', 'Mampu menyebutkan masalah keperawatan jiwa yang Muncul', 'B4', 'radio', '1,2,3,4', ''),
(9, 'LAPORAN PENDAHULUAN', 'RESPONSI LP', '-', 'Mampu menjelaskan tindakan keperawatan jiwa', 'B5', 'radio', '1,2,3,4', ''),
(10, 'LAPORAN PENDAHULUAN', 'RESPONSI LP', '-', 'Mampu menyebutkan tindakan dalam aplikasi (contoh kalimat langsung)', 'B6', 'radio', '1,2,3,4', ''),
(11, 'LAPORAN PENDAHULUAN', 'REFERENSI', '-', 'Pustaka yang digunakan 10 tahun terakhir', 'C1', 'radio', '1,2,3,4', ''),
(12, 'LAPORAN PENDAHULUAN', 'REFERENSI', '-', 'Pustaka relevan dengan keperawatan jiwa', 'C2', 'radio', '1,2,3,4', ''),
(13, 'LAPORAN PENDAHULUAN', 'REFERENSI', '-', 'Menggunakan lebih dari 3 referensi text book', 'C3', 'radio', '1,2,3,4', ''),
(14, 'STRATEGI PELAKSANAAN TINDAKAN KEPERAWATAN', 'FORMAT SP', '-', 'Sesuai kaidah kalimat langsung', 'A1', 'radio', '1,2,3,4', ''),
(15, 'STRATEGI PELAKSANAAN TINDAKAN KEPERAWATAN', 'FORMAT SP', '-', 'Format SP Terisi Lengkap', 'A2', 'radio', '1,2,3,4', ''),
(16, 'STRATEGI PELAKSANAAN TINDAKAN KEPERAWATAN', 'FORMAT SP', '-', 'Fase Kerja lengkap', 'A3', 'radio', '1,2,3,4', ''),
(17, 'STRATEGI PELAKSANAAN TINDAKAN KEPERAWATAN', 'FORMAT SP', '-', 'Kesesuaian antara SP dengan Komter', 'A4', 'radio', '1,2,3,4', ''),
(18, 'STRATEGI PELAKSANAAN TINDAKAN KEPERAWATAN', 'ORIENTASI', '-', 'Melakukan salam terapeutik', 'B1', 'radio', '1,2,3,4', ''),
(19, 'STRATEGI PELAKSANAAN TINDAKAN KEPERAWATAN', 'ORIENTASI', '-', 'Melakukan evaluasi/validasi', 'B2', 'radio', '1,2,3,4', ''),
(20, 'STRATEGI PELAKSANAAN TINDAKAN KEPERAWATAN', 'ORIENTASI', '-', 'Kontrak (Topik, waktu, tempat)', 'B3', 'radio', '1,2,3,4', ''),
(21, 'STRATEGI PELAKSANAAN TINDAKAN KEPERAWATAN', 'ORIENTASI', '-', 'Tujuan tindakan/pembicaraan', 'B4', 'radio', '1,2,3,4', ''),
(22, 'STRATEGI PELAKSANAAN TINDAKAN KEPERAWATAN', 'KERJA', '-', 'Posisi, Sikap, dan teknik komter sesuai', 'C1', 'radio', '1,2,3,4', ''),
(23, 'STRATEGI PELAKSANAAN TINDAKAN KEPERAWATAN', 'KERJA', '-', 'Bersikap empati dan memperhatikan KDM Klien', 'C2', 'radio', '1,2,3,4', ''),
(24, 'STRATEGI PELAKSANAAN TINDAKAN KEPERAWATAN', 'KERJA', '-', 'Pernyataan/pertanyaan sesuai dengan tujuan yang akan Dicapai', 'C3', 'radio', '1,2,3,4', ''),
(25, 'STRATEGI PELAKSANAAN TINDAKAN KEPERAWATAN', 'KERJA', '-', 'Bersikap respek (menghargai klien)', 'C4', 'radio', '1,2,3,4', ''),
(26, 'STRATEGI PELAKSANAAN TINDAKAN KEPERAWATAN', 'KERJA', '-', 'Berfokus kepada klien dengan teknik listening', 'C5', 'radio', '1,2,3,4', ''),
(27, 'STRATEGI PELAKSANAAN TINDAKAN KEPERAWATAN', 'KERJA', '-', 'Melakukan respon non verbal yang tepat', 'C6', 'radio', '1,2,3,4', ''),
(28, 'STRATEGI PELAKSANAAN TINDAKAN KEPERAWATAN', 'TERMINASI', '-', 'Melakukan evaluasi objektif dan subjektif', 'D1', 'radio', '1,2,3,4', ''),
(29, 'STRATEGI PELAKSANAAN TINDAKAN KEPERAWATAN', 'TERMINASI', '-', 'Menyebutkan tindak lanjut', 'D2', 'radio', '1,2,3,4', ''),
(30, 'STRATEGI PELAKSANAAN TINDAKAN KEPERAWATAN', 'TERMINASI', '-', 'Melakukan kontrak yang akan datang (topik, tempat, waktu) berorientasi pada TIK', 'D3', 'radio', '1,2,3,4', ''),
(31, 'DOKUMENTASI ASUHAN KEPERAWATAN JIWA', '-', '-', 'Mengumpulkan data yang komprehensif dan akurat', 'A1', 'radio', '1,2,3,4', ''),
(32, 'DOKUMENTASI ASUHAN KEPERAWATAN JIWA', '-', '-', 'Mengidentifikasi masalah klien yang actual dan resiko', 'A2', 'radio', '1,2,3,4', ''),
(33, 'DOKUMENTASI ASUHAN KEPERAWATAN JIWA', '-', '-', 'Memprioritaskan masalah klien', 'A3', 'radio', '1,2,3,4', ''),
(34, 'DOKUMENTASI ASUHAN KEPERAWATAN JIWA', '-', '-', 'Merumuskan diagnosis berdasarkan masalah yang ditemukan sesuai dengan kebutuhan pasien', 'A4', 'radio', '1,2,3,4', ''),
(35, 'DOKUMENTASI ASUHAN KEPERAWATAN JIWA', '-', '-', 'Menetapkan tujuan tindakan sesuai dengan diagnosis', 'A5', 'radio', '1,2,3,4', ''),
(36, 'DOKUMENTASI ASUHAN KEPERAWATAN JIWA', '-', '-', 'Membuat kriteria evaluasi dengan prinsip SMART', 'A6', 'radio', '1,2,3,4', ''),
(37, 'DOKUMENTASI ASUHAN KEPERAWATAN JIWA', '-', '-', 'Menetapkan tindakan untuk mencapai tujuan', 'A7', 'radio', '1,2,3,4', ''),
(38, 'DOKUMENTASI ASUHAN KEPERAWATAN JIWA', '-', '-', 'Merencanakan kunjungan rumah', 'A8', 'radio', '1,2,3,4', ''),
(39, 'DOKUMENTASI ASUHAN KEPERAWATAN JIWA', '-', '-', 'Membuat rasional secara teoritis terhadap rencana tindakan', 'A9', 'radio', '1,2,3,4', ''),
(40, 'DOKUMENTASI ASUHAN KEPERAWATAN JIWA', '-', '-', 'Mengimplementasikan tindakan sesuai rencana', 'A10', 'radio', '1,2,3,4', ''),
(41, 'DOKUMENTASI ASUHAN KEPERAWATAN JIWA', '-', '-', 'Mencatat semua perilaku klien setelah implementasi dan melakukan penilaian keberhasilan rencana tindakan', 'A11', 'radio', '1,2,3,4', ''),
(42, 'DOKUMENTASI ASUHAN KEPERAWATAN JIWA', '-', '-', 'Mengevaluasi pencapaian kemampuan klien untuk tiap diagnosa', 'A12', 'radio', '1,2,3,4', ''),
(43, 'TERAPI AKTIVITAS KELOMPOK', 'PERENCANAAN', 'Persiapan', 'Materi', 'A1', 'radio', '1,2,3,4', ''),
(44, 'TERAPI AKTIVITAS KELOMPOK', 'PERENCANAAN', 'Persiapan', 'Alat yang digunakan', 'A2', 'radio', '1,2,3,4', ''),
(45, 'TERAPI AKTIVITAS KELOMPOK', 'PERENCANAAN', 'Persiapan', 'Setting terapis/peserta', 'A3', 'radio', '1,2,3,4', ''),
(46, 'TERAPI AKTIVITAS KELOMPOK', 'PERENCANAAN', 'Persiapan', 'Pembagian tugas terapis', 'A4', 'radio', '1,2,3,4', ''),
(47, 'TERAPI AKTIVITAS KELOMPOK', 'PELAKSANAAN', 'Sambutan', 'Salam terapeutik', 'B1', 'radio', '1,2,3,4', ''),
(48, 'TERAPI AKTIVITAS KELOMPOK', 'PELAKSANAAN', 'Sambutan', 'Memperkenalkan diri dan terapis lainnya', 'B2', 'radio', '1,2,3,4', ''),
(49, 'TERAPI AKTIVITAS KELOMPOK', 'PELAKSANAAN', 'Sambutan', 'Kontrak (waktu, tujuan, kegiatan)', 'B3', 'radio', '1,2,3,4', ''),
(50, 'TERAPI AKTIVITAS KELOMPOK', 'PELAKSANAAN', 'Sambutan', 'Menjelaskan aturan permainan TAK', 'B4', 'radio', '1,2,3,4', ''),
(51, 'TERAPI AKTIVITAS KELOMPOK', 'PELAKSANAAN', 'Pelaksanaan', 'Memodivikasi klien (peserta TAK) untuk aktif melakukan kegiatan', 'C1', 'radio', '1,2,3,4', ''),
(52, 'TERAPI AKTIVITAS KELOMPOK', 'PELAKSANAAN', 'Pelaksanaan', 'Melakukan antisipasi masalah , pada klien yang tidak aktif, meninggalkan permainan tanpa pamit,bila ada klien lain yang ingin ikut.', 'C2', 'radio', '1,2,3,4', ''),
(53, 'TERAPI AKTIVITAS KELOMPOK', 'PELAKSANAAN', 'Terminasi', 'Memotivasi klien secara kontinyu melakukan TAK', 'D1', 'radio', '1,2,3,4', ''),
(54, 'TERAPI AKTIVITAS KELOMPOK', 'PELAKSANAAN', 'Terminasi', 'Menjelaskan pencapaian tujuan', 'D2', 'radio', '1,2,3,4', ''),
(55, 'TERAPI AKTIVITAS KELOMPOK', 'PELAKSANAAN', 'Terminasi', 'Menutup kegiatan', 'D3', 'radio', '1,2,3,4', ''),
(56, 'TERAPI AKTIVITAS KELOMPOK', 'EVALUASI', '-', 'Mendokumentasikan hasil kegiatan', 'E1', 'radio', '1,2,3,4', ''),
(57, 'Terhadap Sikap Dan Perilaku Selama Melakukan Kegiatan Praktek', '-', '-', 'Kedisiplinan (tepat waktu, mengikutitata tertib)', 'A1', 'select', '10,20,30,40,50,60,70,80,90,100', ''),
(58, 'Terhadap Sikap Dan Perilaku Selama Melakukan Kegiatan Praktek', '-', '-', 'Kerjasama (dengan teman, instruktur, dan tenaga lain)', 'A2', 'select', '10,20,30,40,50,60,70,80,90,100', ''),
(59, 'Terhadap Sikap Dan Perilaku Selama Melakukan Kegiatan Praktek', '-', '-', 'Ketelitian (dalam perhitungan,analisis, evaluasi)', 'A3', 'select', '10,20,30,40,50,60,70,80,90,100', ''),
(60, 'Terhadap Sikap Dan Perilaku Selama Melakukan Kegiatan Praktek', '-', '-', 'Inisiatif (mengambil keputusan,menyelesaikan masalah)', 'A4', 'select', '10,20,30,40,50,60,70,80,90,100', ''),
(61, 'Terhadap Sikap Dan Perilaku Selama Melakukan Kegiatan Praktek', '-', '-', 'Kreativitas menyelesaikan tugas/laporan', 'A5', 'select', '10,20,30,40,50,60,70,80,90,100', ''),
(62, 'Terhadap Sikap Dan Perilaku Selama Melakukan Kegiatan Praktek', '-', '-', 'Sopan santun (dengan pasien, instruktur, pengunjung RS, dantenaga lainnya)', 'A6', 'select', '10,20,30,40,50,60,70,80,90,100', ''),
(63, 'Terhadap Sikap Dan Perilaku Selama Melakukan Kegiatan Praktek', '-', '-', 'Tanggung jawab (menyelesaikantugas individu/kelompok)', 'A7', 'select', '10,20,30,40,50,60,70,80,90,100', ''),
(64, 'Terhadap Sikap Dan Perilaku Selama Melakukan Kegiatan Praktek', '-', '-', 'Keramahan (dengan pasien, instruktur, pengunjung RS, dan tenaga lainnya)', 'A8', 'select', '10,20,30,40,50,60,70,80,90,100', '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kep_nilai_data`
--

DROP TABLE IF EXISTS `tb_kep_nilai_data`;
CREATE TABLE `tb_kep_nilai_data` (
  `id` int(11) NOT NULL,
  `id_praktikan` int(11) NOT NULL,
  `tgl_tambah` date NOT NULL,
  `tgl_ubah` date NOT NULL,
  `jenis_nilai` int(11) NOT NULL,
  `judul1` int(11) NOT NULL,
  `judul2` int(11) NOT NULL,
  `aspek_nilai` text NOT NULL,
  `nilai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_kep_nil_dokaskep`
--

DROP TABLE IF EXISTS `tb_kep_nil_dokaskep`;
CREATE TABLE `tb_kep_nil_dokaskep` (
  `id` int(11) NOT NULL,
  `tgl_input` date DEFAULT NULL,
  `tgl_ubah` date DEFAULT NULL,
  `id_praktikan` int(11) NOT NULL,
  `1` int(11) NOT NULL,
  `2` int(11) DEFAULT NULL,
  `3` int(11) DEFAULT NULL,
  `4` int(11) DEFAULT NULL,
  `5` int(11) DEFAULT NULL,
  `6` int(11) DEFAULT NULL,
  `7` int(11) DEFAULT NULL,
  `8` int(11) DEFAULT NULL,
  `9` int(11) DEFAULT NULL,
  `10` int(11) DEFAULT NULL,
  `11` int(11) DEFAULT NULL,
  `12` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_kep_nil_lap_pen`
--

DROP TABLE IF EXISTS `tb_kep_nil_lap_pen`;
CREATE TABLE `tb_kep_nil_lap_pen` (
  `id` int(11) NOT NULL,
  `tgl_input` date NOT NULL,
  `tgl_ubah` date DEFAULT NULL,
  `id_praktikan` int(11) NOT NULL,
  `A1` int(11) DEFAULT NULL,
  `A2` int(11) DEFAULT NULL,
  `A3` int(11) DEFAULT NULL,
  `A4` int(11) DEFAULT NULL,
  `B1` int(11) DEFAULT NULL,
  `B2` int(11) DEFAULT NULL,
  `B3` int(11) DEFAULT NULL,
  `B4` int(11) DEFAULT NULL,
  `B5` int(11) DEFAULT NULL,
  `B6` int(11) DEFAULT NULL,
  `C1` int(11) DEFAULT NULL,
  `C2` int(11) DEFAULT NULL,
  `C3` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_kep_nil_lap_pen`
--

INSERT INTO `tb_kep_nil_lap_pen` (`id`, `tgl_input`, `tgl_ubah`, `id_praktikan`, `A1`, `A2`, `A3`, `A4`, `B1`, `B2`, `B3`, `B4`, `B5`, `B6`, `C1`, `C2`, `C3`) VALUES
(7, '2023-03-08', NULL, 3, 1, 1, 4, 1, 3, 2, 1, 4, 1, 3, 2, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tb_kep_nil_sikapprilaku`
--

DROP TABLE IF EXISTS `tb_kep_nil_sikapprilaku`;
CREATE TABLE `tb_kep_nil_sikapprilaku` (
  `id` int(11) NOT NULL,
  `tgl_input` date NOT NULL,
  `tgl_ubah` date DEFAULT NULL,
  `id_praktikan` int(11) NOT NULL,
  `1` int(11) DEFAULT NULL,
  `2` int(11) DEFAULT NULL,
  `3` int(11) DEFAULT NULL,
  `4` int(11) DEFAULT NULL,
  `5` int(11) DEFAULT NULL,
  `6` int(11) DEFAULT NULL,
  `7` int(11) DEFAULT NULL,
  `8` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_kep_nil_sptk`
--

DROP TABLE IF EXISTS `tb_kep_nil_sptk`;
CREATE TABLE `tb_kep_nil_sptk` (
  `id` int(11) NOT NULL,
  `tgl_input` date NOT NULL,
  `tgl_ubah` date DEFAULT NULL,
  `id_praktikan` int(11) NOT NULL,
  `A1` int(11) NOT NULL,
  `A2` int(11) DEFAULT NULL,
  `A3` int(11) DEFAULT NULL,
  `A4` int(11) DEFAULT NULL,
  `B1` int(11) DEFAULT NULL,
  `B2` int(11) DEFAULT NULL,
  `B3` int(11) DEFAULT NULL,
  `B4` int(11) DEFAULT NULL,
  `C1` int(11) DEFAULT NULL,
  `C2` int(11) DEFAULT NULL,
  `C3` int(11) DEFAULT NULL,
  `C4` int(11) DEFAULT NULL,
  `C5` int(11) DEFAULT NULL,
  `C6` int(11) DEFAULT NULL,
  `D1` int(11) DEFAULT NULL,
  `D2` int(11) DEFAULT NULL,
  `D3` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_kep_nil_terakkel`
--

DROP TABLE IF EXISTS `tb_kep_nil_terakkel`;
CREATE TABLE `tb_kep_nil_terakkel` (
  `id` int(11) NOT NULL,
  `tgl_input` int(11) NOT NULL,
  `tgl_ubah` int(11) DEFAULT NULL,
  `id_praktikan` int(11) NOT NULL,
  `1-1` int(11) DEFAULT NULL,
  `1-2` int(11) DEFAULT NULL,
  `1-3` int(11) DEFAULT NULL,
  `1-4` int(11) DEFAULT NULL,
  `2A1` int(11) DEFAULT NULL,
  `2A2` int(11) DEFAULT NULL,
  `2A3` int(11) DEFAULT NULL,
  `2A4` int(11) DEFAULT NULL,
  `2B1` int(11) DEFAULT NULL,
  `2B2` int(11) DEFAULT NULL,
  `2C1` int(11) DEFAULT NULL,
  `2C2` int(11) DEFAULT NULL,
  `2C3` int(11) DEFAULT NULL,
  `3-1` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_kerjasama`
--

DROP TABLE IF EXISTS `tb_kerjasama`;
CREATE TABLE `tb_kerjasama` (
  `id` int(11) NOT NULL,
  `id_institusi` text NOT NULL,
  `tgl_input_mou` date DEFAULT NULL,
  `tgl_ubah_mou` date DEFAULT NULL,
  `tgl_mulai_mou` date DEFAULT NULL,
  `tgl_selesai_mou` date DEFAULT NULL,
  `no_pks_rsj` text NOT NULL,
  `no_pks_institusi` text NOT NULL,
  `id_jurusan_pdd` int(11) NOT NULL,
  `id_profesi_pdd` int(11) NOT NULL,
  `id_jenjang_pdd` int(11) NOT NULL,
  `file_mou` text DEFAULT NULL,
  `file_pks` text DEFAULT NULL,
  `arsip` enum('T','Y') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_kuesioner_jawaban`
--

DROP TABLE IF EXISTS `tb_kuesioner_jawaban`;
CREATE TABLE `tb_kuesioner_jawaban` (
  `id` int(11) NOT NULL,
  `id_pertanyaan` int(11) NOT NULL,
  `tgl_tambah` datetime NOT NULL,
  `tgl_ubah` datetime DEFAULT NULL,
  `jawaban` text NOT NULL,
  `nilai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_kuesioner_jawaban`
--

INSERT INTO `tb_kuesioner_jawaban` (`id`, `id_pertanyaan`, `tgl_tambah`, `tgl_ubah`, `jawaban`, `nilai`) VALUES
(19, 1, '2023-11-08 06:49:14', NULL, 'Et non qui eos ea s', 53),
(27, 17, '2023-11-09 05:26:22', NULL, 'Similique irure ut c', 46),
(28, 17, '2023-11-09 05:26:25', NULL, 'Esse provident dign', 53),
(29, 17, '2023-11-09 05:26:27', '2023-11-09 11:26:46', '1', 1),
(30, 17, '2023-11-09 05:26:31', '2023-11-09 11:26:41', '1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_kuesioner_pertanyaan`
--

DROP TABLE IF EXISTS `tb_kuesioner_pertanyaan`;
CREATE TABLE `tb_kuesioner_pertanyaan` (
  `id` int(11) NOT NULL,
  `jenis` text NOT NULL,
  `pertanyaan` text NOT NULL,
  `tgl_tambah` datetime DEFAULT NULL,
  `tgl_ubah` datetime DEFAULT NULL,
  `ket` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_kuesioner_pertanyaan`
--

INSERT INTO `tb_kuesioner_pertanyaan` (`id`, `jenis`, `pertanyaan`, `tgl_tambah`, `tgl_ubah`, `ket`) VALUES
(1, '', 'Sistematika Penyajian', '2023-05-29 09:01:07', '2023-07-26 14:35:42', '-'),
(2, '', 'Kemampuan Menyajikan', '2023-05-29 09:01:07', '2023-11-09 09:59:44', '-'),
(3, '', 'Ketepatan Waktu & Kehadiran', '2023-05-29 09:01:07', NULL, ''),
(5, '', 'Sikap dan Perilaku', '2023-05-29 09:01:07', NULL, ''),
(6, '', 'Cara Menjawab Pertanyaan dari Peserta', '2023-05-29 09:01:07', NULL, ''),
(7, '', 'Penggunaan Bahasa', '2023-05-29 09:01:07', NULL, ''),
(8, '', 'Pemberian Motivasi Kepada Peserta', '2023-05-29 09:01:07', NULL, ''),
(9, '', 'Kerapihan Berpakaian', '2023-05-29 09:01:07', NULL, ''),
(10, '', 'Tercapainya Tujuan Pembelajaran', '2023-05-29 09:01:07', NULL, ''),
(17, '', '122123', '2023-11-09 05:21:05', '2023-11-09 11:21:16', '123123');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kuesioner_sarpras`
--

DROP TABLE IF EXISTS `tb_kuesioner_sarpras`;
CREATE TABLE `tb_kuesioner_sarpras` (
  `id` int(11) NOT NULL,
  `pertanyaan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_kuesioner_sarpras`
--

INSERT INTO `tb_kuesioner_sarpras` (`id`, `pertanyaan`) VALUES
(1, 'Manfaat Program Diklat dengan Kebutuhan'),
(2, 'Kualitas Materi dapat Menambah Tingkat Keterampilan dan Pengetahuan'),
(3, 'Kelengkapan Informasi Diklat'),
(4, 'Ketersediaan, Kelengkapan dan Keberfungsian Sarana dan Bahan Diklat (Materi, Modul/ Log Book, Name Tag, Nilai)'),
(5, 'Ketersediaan dan Kebersihan Kelas, Ruangan, dan Prasarana lainnya'),
(6, 'Ketersediaan, Kebersihan dan Keberfungsian Fasilitas Olahraga, Kesehatan, Tempat Ibadah dan Sarana lainnya'),
(7, 'Ketersediaan dan Kebersihan Asrama, Ruang Makan, Toilet, dan Prasarana lainnya');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kuesioner_sarpras_jawaban`
--

DROP TABLE IF EXISTS `tb_kuesioner_sarpras_jawaban`;
CREATE TABLE `tb_kuesioner_sarpras_jawaban` (
  `id` int(11) NOT NULL,
  `id_praktikan` int(11) NOT NULL,
  `pertanyaan` int(11) NOT NULL,
  `jawaban` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_kuota`
--

DROP TABLE IF EXISTS `tb_kuota`;
CREATE TABLE `tb_kuota` (
  `id_kuota` int(11) NOT NULL,
  `id_jurusan_pdd` int(11) NOT NULL,
  `tgl_tambah_kuota` date DEFAULT NULL,
  `nama_kuota` text NOT NULL,
  `jumlah_kuota` int(11) NOT NULL,
  `ket_kuota` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_kuota`
--

INSERT INTO `tb_kuota` (`id_kuota`, `id_jurusan_pdd`, `tgl_tambah_kuota`, `nama_kuota`, `jumlah_kuota`, `ket_kuota`) VALUES
(1, 1, NULL, 'Kedokteran (KED)', 250, '2 Jurusan digabungkan'),
(2, 5, NULL, 'Farmasi (FAR)', 10, '-.'),
(3, 7, NULL, 'Kesehatan Lingkungan (KESLING)', 7, ''),
(4, 3, NULL, 'Psikologi (PSI)', 14, ''),
(5, 8, NULL, 'Rekam Medis (RM)', 14, ''),
(6, 4, NULL, 'Informasi Teknologi (IT)', 7, ''),
(7, 6, NULL, 'Pekerja Sosial (PEKSOS)', 7, ''),
(8, 2, NULL, 'Keperawatan (KEP)', 123, '-');

-- --------------------------------------------------------

--
-- Table structure for table `tb_lapor`
--

DROP TABLE IF EXISTS `tb_lapor`;
CREATE TABLE `tb_lapor` (
  `id_lapor` int(11) NOT NULL,
  `judul_lapor` text NOT NULL,
  `deskripsi_lapor` text NOT NULL,
  `level_lapor` text NOT NULL,
  `tgl_lapor` date DEFAULT NULL,
  `status_lapor` text NOT NULL,
  `nama_lapor` text NOT NULL,
  `link_lapor` text NOT NULL,
  `file_lapor` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_lapor`
--

INSERT INTO `tb_lapor` (`id_lapor`, `judul_lapor`, `deskripsi_lapor`, `level_lapor`, `tgl_lapor`, `status_lapor`, `nama_lapor`, `link_lapor`, `file_lapor`) VALUES
(1, 'Data Institusi', 'Data Institusi berbeda saat pendaftaran', 'tinggi', '2022-01-02', 'PROSES', 'Ade Ihsan', '192.168.7.89/sm/?prk', './_file/lapor/lapor_1_2022-01-03.png'),
(3, 'Data tarif', 'Data tarif Tidak Sesuai jurusan', 'sedang', '2022-01-03', 'CEK', 'Rani Riffani', '192.168.7.88/sm/?trk&dtl=1', './_file/lapor/lapor_3_2022-01-03.png');

-- --------------------------------------------------------

--
-- Table structure for table `tb_logbook_ked_coass_jkh`
--

DROP TABLE IF EXISTS `tb_logbook_ked_coass_jkh`;
CREATE TABLE `tb_logbook_ked_coass_jkh` (
  `id` int(11) NOT NULL,
  `id_praktikan` int(11) NOT NULL,
  `tgl_tambah` datetime NOT NULL,
  `tgl_ubah` datetime DEFAULT NULL,
  `tgl` date NOT NULL,
  `kegiatan` text NOT NULL,
  `topik` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_logbook_ked_coass_kyd`
--

DROP TABLE IF EXISTS `tb_logbook_ked_coass_kyd`;
CREATE TABLE `tb_logbook_ked_coass_kyd` (
  `id` int(11) NOT NULL,
  `id_praktikan` int(11) NOT NULL,
  `tgl_tambah` datetime NOT NULL,
  `tgl_ubah` datetime DEFAULT NULL,
  `ruang` enum('Poliklinik/Rawat Jalan','Intensif/Rawat Inap','IGD','Rehabilitasi Napza','ECT') NOT NULL,
  `tgl` date NOT NULL,
  `nama_pasien` text NOT NULL,
  `usia` int(11) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `medrec` text NOT NULL,
  `diagnosis` text NOT NULL,
  `terapi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_logbook_ked_coass_lppp`
--

DROP TABLE IF EXISTS `tb_logbook_ked_coass_lppp`;
CREATE TABLE `tb_logbook_ked_coass_lppp` (
  `id` int(11) NOT NULL,
  `id_praktikan` int(11) NOT NULL,
  `id_pertanyaan` int(11) NOT NULL,
  `tgl_tambah` datetime NOT NULL,
  `skor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_logbook_ked_coass_lppp_ket`
--

DROP TABLE IF EXISTS `tb_logbook_ked_coass_lppp_ket`;
CREATE TABLE `tb_logbook_ked_coass_lppp_ket` (
  `id` int(11) NOT NULL,
  `id_praktikan` int(11) NOT NULL,
  `tgl_tambah` datetime NOT NULL,
  `ket` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_logbook_ked_coass_materi`
--

DROP TABLE IF EXISTS `tb_logbook_ked_coass_materi`;
CREATE TABLE `tb_logbook_ked_coass_materi` (
  `id` int(11) NOT NULL,
  `id_praktikan` int(11) NOT NULL,
  `tgl_tambah` datetime NOT NULL,
  `tgl_ubah` datetime DEFAULT NULL,
  `materi` enum('Kuliah Pengayaan','Mini C-Ex','RPS','CRS','CSS','OSLER','DPS') NOT NULL,
  `tgl` date DEFAULT NULL,
  `topik` text NOT NULL,
  `lk` text NOT NULL,
  `dosen_pembimbing` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_logbook_ked_coass_p3d`
--

DROP TABLE IF EXISTS `tb_logbook_ked_coass_p3d`;
CREATE TABLE `tb_logbook_ked_coass_p3d` (
  `id` int(11) NOT NULL,
  `id_praktikan` int(11) NOT NULL,
  `id_pertanyaan` int(11) NOT NULL,
  `tgl_tambah` datetime NOT NULL,
  `i` text DEFAULT NULL,
  `ii` text DEFAULT NULL,
  `iii` text DEFAULT NULL,
  `iv` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_logbook_ked_coass_psw`
--

DROP TABLE IF EXISTS `tb_logbook_ked_coass_psw`;
CREATE TABLE `tb_logbook_ked_coass_psw` (
  `id` int(11) NOT NULL,
  `id_praktikan` int(11) NOT NULL,
  `tgl_tambah` datetime NOT NULL,
  `tgl_ubah` datetime DEFAULT NULL,
  `ruang` enum('Rawat Inap','Rawat Jalan','Keswara','Napza','Psikogeriatri','IGD') NOT NULL,
  `nama` text NOT NULL,
  `usia` int(11) NOT NULL,
  `dd` text NOT NULL,
  `diagnosis_kerja` text NOT NULL,
  `terapi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_logbook_ked_residen_jkh`
--

DROP TABLE IF EXISTS `tb_logbook_ked_residen_jkh`;
CREATE TABLE `tb_logbook_ked_residen_jkh` (
  `id` int(11) NOT NULL,
  `id_praktikan` int(11) NOT NULL,
  `tgl_tambah` datetime NOT NULL,
  `tgl_ubah` datetime DEFAULT NULL,
  `tgl` date NOT NULL,
  `visite_besar` enum('Y') NOT NULL,
  `rapat_klinik` enum('Y') NOT NULL,
  `acara_ilmiah` text NOT NULL,
  `matkul_dosen` text NOT NULL,
  `j_pasien_rajal` smallint(6) NOT NULL,
  `j_pasien_ranap` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_logbook_ked_residen_pi`
--

DROP TABLE IF EXISTS `tb_logbook_ked_residen_pi`;
CREATE TABLE `tb_logbook_ked_residen_pi` (
  `id` int(11) NOT NULL,
  `id_praktikan` int(11) NOT NULL,
  `tgl_tambah` datetime NOT NULL,
  `tgl_ubah` datetime DEFAULT NULL,
  `tgl` date NOT NULL,
  `semester` tinyint(4) NOT NULL,
  `jenis` text NOT NULL,
  `judul` text NOT NULL,
  `bim1` date NOT NULL,
  `bim2` date NOT NULL,
  `bim3` date NOT NULL,
  `present` date NOT NULL,
  `pembimbing` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_logbook_ked_residen_pkd`
--

DROP TABLE IF EXISTS `tb_logbook_ked_residen_pkd`;
CREATE TABLE `tb_logbook_ked_residen_pkd` (
  `id` int(11) NOT NULL,
  `id_praktikan` int(11) NOT NULL,
  `tgl_tambah` datetime NOT NULL,
  `tgl_ubah` datetime DEFAULT NULL,
  `jenis` text NOT NULL,
  `tgl` date NOT NULL,
  `semester` tinyint(4) NOT NULL,
  `no_rm` int(11) NOT NULL,
  `inisial` text NOT NULL,
  `icd10_diagnosis` text NOT NULL,
  `ket` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_logbook_ked_residen_pkd_jenis`
--

DROP TABLE IF EXISTS `tb_logbook_ked_residen_pkd_jenis`;
CREATE TABLE `tb_logbook_ked_residen_pkd_jenis` (
  `id` int(11) NOT NULL,
  `nama` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_logbook_kep_kompetensi`
--

DROP TABLE IF EXISTS `tb_logbook_kep_kompetensi`;
CREATE TABLE `tb_logbook_kep_kompetensi` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_praktikan` int(11) NOT NULL,
  `tgl_input` date NOT NULL,
  `jam_input` time NOT NULL,
  `nama` text NOT NULL,
  `tgl_pel` date NOT NULL,
  `paraf` enum('-','T','Y') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_logbook_kep_kompetensi_nama`
--

DROP TABLE IF EXISTS `tb_logbook_kep_kompetensi_nama`;
CREATE TABLE `tb_logbook_kep_kompetensi_nama` (
  `id` int(11) NOT NULL,
  `nama` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_mess`
--

DROP TABLE IF EXISTS `tb_mess`;
CREATE TABLE `tb_mess` (
  `id_mess` int(11) NOT NULL,
  `tgl_input_mess` date DEFAULT NULL,
  `tgl_ubah_mess` date DEFAULT NULL,
  `nama_mess` text DEFAULT NULL,
  `kapasitas_t_mess` int(11) NOT NULL,
  `alamat_mess` text DEFAULT NULL,
  `nama_pemilik_mess` text DEFAULT NULL,
  `telp_pemilik_mess` text DEFAULT NULL,
  `email_pemilik_mess` text DEFAULT NULL,
  `tarif_tanpa_makan_mess` int(11) NOT NULL,
  `tarif_dengan_makan_mess` int(11) NOT NULL,
  `kepemilikan_mess` enum('dalam','luar') NOT NULL,
  `id_tarif_satuan` int(11) NOT NULL,
  `id_tarif_jenis` int(11) NOT NULL,
  `fasilitas_mess` text DEFAULT NULL,
  `status_mess` enum('Y','T') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_mess`
--

INSERT INTO `tb_mess` (`id_mess`, `tgl_input_mess`, `tgl_ubah_mess`, `nama_mess`, `kapasitas_t_mess`, `alamat_mess`, `nama_pemilik_mess`, `telp_pemilik_mess`, `email_pemilik_mess`, `tarif_tanpa_makan_mess`, `tarif_dengan_makan_mess`, `kepemilikan_mess`, `id_tarif_satuan`, `id_tarif_jenis`, `fasilitas_mess`, `status_mess`) VALUES
(1, NULL, NULL, 'Mess RSJ 1 Lama', 20, 'Jl. Kolonel Maturi KM.7, Desa Jambudipa, Kec. Cisarua, Kab. Bandung Barat, 40551', 'RS Jiwa Provinsi Jawa Barat', 'Frislin Maria Agustina (PJ MESS RSJ) 081321329101', '', 20000, 100000, 'dalam', 4, 7, 'Makan 3x Sehari', 'Y'),
(2, NULL, NULL, 'Mess RSJ 2 Baru', 92, 'Jl. Kolonel Maturi KM.7, Desa Jambudipa, Kec. Cisarua, Kab. Bandung Barat, 40551', 'RS Jiwa Provinsi Jawa Barat', 'Frislin Maria Agustina (PJ MESS RSJ) 081321329101', '', 20000, 100000, 'dalam', 4, 7, '', 'Y'),
(3, NULL, '2022-10-07', 'Asrama Rifa Corporate', 100, 'Kp. Panyandaan RT. 01 RW. 14 Desa Jambudipa Kecamatan Cisarua Kab. Bandung Barat', 'Ibu Ai', '081322629909', '', 20000, 80000, 'luar', 4, 7, 'Dengan Makan 3x Sehari', 'Y'),
(4, NULL, '2022-10-07', 'Pondokan H. Ating', 100, 'Kp. Barukai Timur RT. 04 RW. 13 Desa Jambudipa Kecamatan Cisarua Kab. Bandung Barat', 'H. Ating / Hj. Siti Sutiah', '0', '', 20000, 80000, 'luar', 4, 7, '', 'Y'),
(5, NULL, '2022-10-07', 'Wisma Anugrah Ibu Nanik', 70, 'Kp. Panyandaan RT. 01 RW. 14 Desa Jambudipa Kecamatan Cisarua Kab. Bandung Barat', 'Hj. Nanik Susiani', '081320719652', '', 15000, 70000, 'luar', 4, 7, '', 'Y'),
(6, NULL, NULL, 'Pondokan dr. Hj. Meutia Laksminingrum', 0, '-', 'dr. Hj. Meutia Laksminingrum', '0', '', 0, 0, 'luar', 4, 7, '', 'Y'),
(7, NULL, '2022-10-07', 'Galuh Pakuan', 70, 'Kp. Panyandaan RT. 01 RW. 14 Desa Jambudipa Kecamatan Cisarua Kab. Bandung Barat', 'Oyo Suharya', '081320113399', '', 20000, 80000, 'luar', 4, 7, '', 'Y'),
(8, NULL, '2022-10-07', 'Pondokan Tatang', 30, 'Kp. Panyandaan RT. 01 RW. 14 Desa Jambudipa Kecamatan Cisarua Kab. Bandung Barat', 'Tatang', '089531804825', '', 20000, 80000, 'luar', 4, 7, '', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `tb_mess_pilih`
--

DROP TABLE IF EXISTS `tb_mess_pilih`;
CREATE TABLE `tb_mess_pilih` (
  `id_mess_pilih` int(11) NOT NULL,
  `id_praktik` int(11) NOT NULL,
  `id_mess` int(11) NOT NULL,
  `id_tarif_pilih` int(11) NOT NULL,
  `tgl_input_mess_pilih` date DEFAULT NULL,
  `tgl_ubah_mess_pilih` date DEFAULT NULL,
  `makan_mess_pilih` enum('T','Y') DEFAULT NULL COMMENT 'memilih mess makan (tidak digunakan)',
  `jumlah_hari_mess_pilih` int(11) NOT NULL,
  `total_tarif_mess_pilih` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_mess_tgl`
--

DROP TABLE IF EXISTS `tb_mess_tgl`;
CREATE TABLE `tb_mess_tgl` (
  `id_mess_tgl` int(11) NOT NULL,
  `mess_tgl` date NOT NULL,
  `id_mess` int(11) NOT NULL,
  `id_praktik` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_mou`
--

DROP TABLE IF EXISTS `tb_mou`;
CREATE TABLE `tb_mou` (
  `id_mou` int(11) NOT NULL,
  `id_institusi` text NOT NULL,
  `tgl_input_mou` date DEFAULT NULL,
  `tgl_ubah_mou` date DEFAULT NULL,
  `tgl_mulai_mou` date DEFAULT NULL,
  `tgl_selesai_mou` date DEFAULT NULL,
  `no_rsj_mou` text NOT NULL,
  `no_institusi_mou` text NOT NULL,
  `id_jurusan_pdd` int(11) NOT NULL,
  `id_profesi_pdd` int(11) NOT NULL,
  `id_jenjang_pdd` int(11) NOT NULL,
  `file_mou` text DEFAULT NULL,
  `file_pks` text DEFAULT NULL,
  `arsip_mou` enum('Y') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_mou`
--

INSERT INTO `tb_mou` (`id_mou`, `id_institusi`, `tgl_input_mou`, `tgl_ubah_mou`, `tgl_mulai_mou`, `tgl_selesai_mou`, `no_rsj_mou`, `no_institusi_mou`, `id_jurusan_pdd`, `id_profesi_pdd`, `id_jenjang_pdd`, `file_mou`, `file_pks`, `arsip_mou`) VALUES
(1, '87', NULL, NULL, '2022-01-05', '2023-08-18', '-', '-', 0, 0, 0, NULL, NULL, NULL),
(2, '2', NULL, NULL, '2014-02-13', '2022-01-05', '- ', '-', 0, 0, 0, NULL, NULL, NULL),
(3, '3', NULL, NULL, '2018-08-20', '2021-08-19', '119/14858/RSJ', '036/AKP/BK-A/VIII/2018', 0, 0, 0, NULL, NULL, NULL),
(4, '4', NULL, NULL, '2017-12-22', '2020-12-21', '119/19834/RSJ', '355/PKS/AKBM/XII/2017', 0, 0, 0, NULL, NULL, NULL),
(5, '5', NULL, NULL, '2019-06-19', '2022-06-18', '073/10582/RSJ', 'B. 167/AKPER BPC/VI/2019', 0, 0, 0, NULL, NULL, NULL),
(6, '6', NULL, NULL, '2018-07-06', '2021-07-05', '119/11581/RSJ', 'PKS/008/AKPER RSD/VII/2018', 0, 0, 0, NULL, NULL, NULL),
(7, '7', NULL, NULL, '2018-11-12', '2021-11-11', '119/20549A/RSJ', '420/526/AKPER/2018', 0, 0, 0, NULL, NULL, NULL),
(8, '8', NULL, NULL, '2015-01-02', '2018-01-01', '-', 'YK/AKTI/PKS/01/01/2015', 0, 0, 0, NULL, NULL, NULL),
(9, '9', NULL, NULL, '2019-02-06', '2022-02-05', '119/2418/RSJ', '032/AL.A/SKS.01/II/2019', 0, 0, 0, NULL, NULL, NULL),
(10, '10', NULL, NULL, '2013-06-12', '2016-06-11', '-', '-', 0, 0, 0, NULL, NULL, NULL),
(11, '11', NULL, NULL, '2014-07-17', '2017-07-16', '-', '-', 0, 0, 0, NULL, NULL, NULL),
(12, '12', NULL, NULL, '2014-01-21', '2017-01-20', '-', '-', 0, 0, 0, NULL, NULL, NULL),
(13, '13', NULL, NULL, '2014-03-28', '2017-03-27', '-', '-', 0, 0, 0, NULL, NULL, NULL),
(14, '14', NULL, NULL, '2018-09-12', '2021-09-11', '119/16344/RSJ', '007 KS/AKSARI/IX/2018', 0, 0, 0, NULL, NULL, NULL),
(15, '15', NULL, NULL, '2014-05-14', '2017-05-13', '-', '-', 0, 0, 0, NULL, NULL, NULL),
(16, '16', NULL, NULL, '2011-06-13', '2014-06-12', '-', '-', 0, 0, 0, NULL, NULL, NULL),
(17, '17', NULL, NULL, '2014-01-01', '2016-12-31', '-', '-', 0, 0, 0, NULL, NULL, NULL),
(18, '18', NULL, NULL, '2014-10-21', '2017-10-20', '-', '-', 0, 0, 0, NULL, NULL, NULL),
(19, '19', NULL, NULL, '2019-08-01', '2022-07-31', '119/12968/RSJ', '087/DIR/PKS-RSI/VIII/2019\nDan\n038/PKS/DN/FUKM/VIII/2019', 0, 0, 0, NULL, NULL, NULL),
(20, '20', NULL, NULL, '2019-05-29', '2022-05-28', '119/1458/RSJ', '551A/UKKW/FK/D/V/2019\nDan\n173/072-26/2019', 0, 0, 0, NULL, NULL, NULL),
(21, '21', NULL, NULL, '2019-09-17', '2022-09-16', '119/15675/RSJ', '445/1318/UHP-RS Ihsan\nDan\n108/Dek/FK/IX/2019', 0, 0, 0, NULL, NULL, NULL),
(22, '22', NULL, NULL, '2015-10-29', '2018-10-28', '07313324/RSJ/2015', '005/KS-FK UNJANI/X/2015', 0, 0, 0, NULL, NULL, NULL),
(23, '23', NULL, NULL, '2020-07-01', '2023-07-01', '119/10058/RSJ', 'HK.03.01/X.4.2.1/14120/2020\ndan 677/UN6.C/PKS/2020', 0, 0, 0, NULL, NULL, NULL),
(24, '24', NULL, NULL, '2021-12-06', '2024-12-05', '119/16520/RSJ', '1358/UN6.L/PKS/2021', 2, 2, 10, NULL, NULL, NULL),
(25, '25', NULL, NULL, '2014-03-10', '2017-03-09', '-', '-', 0, 0, 0, NULL, NULL, NULL),
(26, '26', NULL, NULL, '2018-11-19', '2021-11-18', '119/209634/RSJ', 'HK.05.01/1.6/5004/2018', 0, 0, 0, NULL, NULL, NULL),
(27, '27', NULL, NULL, '2020-01-08', '2023-01-07', '075/0409/RSJ/I/2020', '016/POLTEKKES/I/2020', 0, 0, 0, NULL, NULL, NULL),
(28, '28', NULL, NULL, '2012-06-04', '2015-06-04', '-', '-', 0, 0, 0, NULL, NULL, NULL),
(29, '29', NULL, NULL, '2014-12-12', '2017-12-11', '-', '-', 0, 0, 0, NULL, NULL, NULL),
(30, '30', NULL, NULL, '2014-09-26', '2017-09-25', '-', '-', 0, 0, 0, NULL, NULL, NULL),
(31, '31', NULL, NULL, '2019-04-08', '2022-04-07', '073/6519/RSJ', '808/MOU.02/STIKES-AB/IV/2019', 0, 0, 0, NULL, NULL, NULL),
(32, '32', NULL, NULL, '2014-01-30', '2017-01-29', '-', '-', 0, 0, 0, NULL, NULL, NULL),
(33, '33', NULL, NULL, '2012-09-07', '2015-09-07', '-', '-', 0, 0, 0, NULL, NULL, NULL),
(34, '34', NULL, NULL, '2011-07-26', '2014-07-25', '-', '-', 0, 0, 0, NULL, NULL, NULL),
(35, '35', NULL, NULL, '2012-05-03', '2015-05-03', '-', '-', 0, 0, 0, NULL, NULL, NULL),
(36, '36', NULL, NULL, '2018-07-03', '2021-07-02', '073/11261/RSJ', '505/D/BAHUK-STIKES/VII/2018', 0, 0, 0, NULL, NULL, NULL),
(37, '37', NULL, NULL, '2020-11-02', '2023-11-02', '073/0090/RSJ', '672/B/STIKESCRB/I/2018', 0, 0, 0, NULL, NULL, NULL),
(38, '38', NULL, NULL, '2014-01-01', '2016-12-31', '-', '-', 0, 0, 0, NULL, NULL, NULL),
(39, '39', NULL, NULL, '2018-07-23', '2021-07-22', '119/12949/RSJ', '120/SDHB/PKS/TU/VII/2018', 0, 0, 0, NULL, NULL, NULL),
(40, '40', NULL, NULL, '2018-07-13', '2021-07-12', '073/12321/RSJ', '810/STIKES-FA/MOU/VII/2018', 0, 0, 0, NULL, NULL, NULL),
(41, '41', NULL, NULL, '2018-09-29', '2021-09-28', '119/17531/RSJ', '1138/K/STIKES.DK/IX/2018', 0, 0, 0, NULL, NULL, NULL),
(42, '42', NULL, NULL, '2019-10-29', '2022-10-28', '073/18015/RSJ/X/2019', '270/STIKI/WK.III/X/2019', 0, 0, 0, NULL, NULL, NULL),
(43, '43', NULL, NULL, '2019-03-26', '2022-03-25', '075/4422/RSJ', 'PKS/018/STIKES/III/2019', 0, 0, 0, NULL, NULL, NULL),
(44, '44', NULL, NULL, '2018-04-30', '2021-04-29', '-', '0324/STIKES-KHG-MOU-IV/2018', 0, 0, 0, NULL, NULL, NULL),
(45, '45', NULL, NULL, '2020-12-01', '2023-12-01', '073/19852/RSJ/XII/2020', '67/HO.00.03/TU-STIKESMI/XII/2020', 0, 0, 0, NULL, NULL, NULL),
(46, '46', NULL, NULL, '2019-04-15', '2022-04-14', '073/8115/RSJ', 'B.010/STIKKU/MoU/IV/2019', 0, 0, 0, NULL, NULL, NULL),
(47, '47', NULL, NULL, '2011-03-21', '2014-03-20', '-', '-', 0, 0, 0, NULL, NULL, NULL),
(48, '48', NULL, NULL, '2014-01-01', '2016-12-31', '-', '-', 0, 0, 0, NULL, NULL, NULL),
(49, '49', NULL, NULL, '2019-01-04', '2022-01-03', '075/0239/RSJ', '057/STIKES-MK/MOU/I/2019', 0, 0, 0, NULL, NULL, NULL),
(50, '50', NULL, NULL, '2019-12-14', '2022-12-13', '073/DIKLIT-5632/III/2016', '028/III.3,AU/B/2016', 0, 0, 0, NULL, NULL, NULL),
(51, '51', NULL, NULL, '2015-04-06', '2018-04-05', '073/1965/TSJ', 'DL.02.02.1965.04.2015', 0, 0, 0, NULL, NULL, NULL),
(52, '52', NULL, NULL, '2018-09-14', '2021-09-13', '119/16549/RSJ', 'III/884.1/STIKEP/PPNI/JBR/IX/2018', 0, 0, 0, NULL, NULL, NULL),
(53, '53', NULL, NULL, '2020-06-26', '2023-06-26', '119/9816/RSJ', 'PKS.032/IKR-I/R/VI/2020', 0, 0, 0, NULL, NULL, NULL),
(54, '54', NULL, NULL, '2020-12-15', '2023-12-15', '073/20903/RSJ', '017/STIKes-SB/SP-KS/XII/2020', 0, 0, 0, NULL, NULL, NULL),
(55, '55', NULL, NULL, '2015-02-12', '2018-02-11', '073/0954/RSJ', '022/D-STIK/UN/II/2015', 0, 0, 0, NULL, NULL, NULL),
(56, '56', NULL, NULL, '2014-01-01', '2016-12-31', '', '', 0, 0, 0, NULL, NULL, NULL),
(57, '57', NULL, NULL, '2015-01-26', '2018-01-25', '073/0428/RSJ', '?/STIKES-TT/I/2015', 0, 0, 0, NULL, NULL, NULL),
(58, '58', NULL, NULL, '2014-03-03', '2017-03-02', '', '', 0, 0, 0, NULL, NULL, NULL),
(59, '59', NULL, NULL, '2016-05-02', '2019-05-02', '073/7945/RSJ/2016', '168/STIKES.YSI/V/2016', 0, 0, 0, NULL, NULL, NULL),
(60, '60', NULL, NULL, '2020-12-21', '2023-12-21', '119/21223/RSJ', 'A-46/MoU/LPPM-STIKesYPIB/XII/2020', 0, 0, 0, NULL, NULL, NULL),
(61, '61', NULL, NULL, '2014-09-12', '2017-09-11', '-', '-', 0, 0, 0, NULL, NULL, NULL),
(62, '62', NULL, NULL, '2018-11-26', '2021-11-25', '119/20217A/RSJ', '06/FIKES/UNIBA/01/XI/2018', 0, 0, 0, NULL, NULL, NULL),
(63, '63', NULL, NULL, '2012-02-15', '2015-02-14', '-', '-', 0, 0, 0, NULL, NULL, NULL),
(64, '64', NULL, NULL, '2018-09-12', '2021-09-11', '119/16531/RSJ', '13/4123/AK/KS/R/IX/2018', 0, 0, 0, NULL, NULL, NULL),
(65, '65', NULL, NULL, '2019-02-20', '2022-02-19', '119/3413/RSJ', '128/I.0/F/2019', 0, 0, 0, NULL, NULL, NULL),
(66, '66', NULL, NULL, '2018-10-15', '2021-10-14', '119/1864/RSJ', '1767/UN47.B7.5.5/F/2018', 0, 0, 0, NULL, NULL, NULL),
(67, '67', NULL, NULL, '2020-11-12', '2023-11-12', '445/18685/RSJ', '1621/UN40.C2/HK/2020', 0, 0, 0, NULL, NULL, NULL),
(68, '68', NULL, NULL, '2019-01-21', '2022-01-20', '119/1332/RSJ', '0223/UN40.A6/DN/2019', 0, 0, 0, NULL, NULL, NULL),
(69, '69', NULL, NULL, '2014-09-04', '2017-09-03', '-', '-', 0, 0, 0, NULL, NULL, NULL),
(70, '70', NULL, NULL, '2014-01-01', '2016-12-31', '-', '-', 0, 0, 0, NULL, NULL, NULL),
(71, '71', NULL, NULL, '2019-04-16', '2022-04-15', '119/6207/RSJ', 'T/5/UN43.2/HK.07.00/2019', 0, 0, 0, NULL, NULL, NULL),
(72, '72', NULL, NULL, '2019-02-01', '2022-01-31', '073/4052/RSJ', '003.01/TEDC/MOU-DIR/II/2019', 0, 0, 0, NULL, NULL, NULL),
(73, '73', NULL, NULL, '2019-03-28', '2022-03-27', '073/5921/RSJ', '002/FOM-UPH/PKS/III/2019', 0, 0, 0, NULL, NULL, NULL),
(74, '74', NULL, NULL, '2019-02-04', '2022-02-03', '119/2307/RSJ', '0098/Q/P.Y.SMI/II/2019', 0, 0, 0, NULL, NULL, NULL),
(75, '75', NULL, NULL, '2018-11-09', '2021-11-08', '119/20494/RSJ', '168/AKPER/B-MOU/IX/2018', 0, 0, 0, NULL, NULL, NULL),
(76, '76', NULL, NULL, '2019-03-11', '2022-03-10', '073/4623/RSJ', '700/FIKES-UMTAS/III/2019', 0, 0, 0, NULL, NULL, NULL),
(77, '77', NULL, NULL, '2018-07-04', '2021-07-03', '073/11279/RSJ', 'HK.05.01/1.6/2460/2018', 0, 0, 0, NULL, NULL, NULL),
(78, '78', NULL, NULL, '2019-07-10', '2022-07-09', '073/10034/RSJ', 'B/13/PL41/HL.04.03/2019', 0, 0, 0, NULL, NULL, NULL),
(79, '79', NULL, NULL, '2014-01-01', '2016-12-31', '-', '-', 0, 0, 0, NULL, NULL, NULL),
(80, '80', NULL, NULL, '2019-07-01', '2022-06-30', '073/11145/RSJ', 'PKS-  /Ffa-UNJANI/VIII/2019', 0, 0, 0, NULL, NULL, NULL),
(81, '81', NULL, NULL, '2019-04-26', '2022-04-25', '070/7441/RSJ', '1932/MOU/K/Ka./STIKIM/VI/2019', 0, 0, 0, NULL, NULL, NULL),
(82, '82', NULL, NULL, '2019-09-26', '2022-09-25', '073/16246/RSJ/IX/2019', '04/14/UBK/IX/2019', 0, 0, 0, NULL, NULL, NULL),
(83, '83', NULL, NULL, '2019-12-16', '2022-12-15', '073/21320/RSJ/XII/2019', 'HK.03.01/1.6/0012/2019', 0, 0, 0, NULL, NULL, NULL),
(84, '84', NULL, NULL, '2020-07-30', '2023-07-30', '073/11662/RSJ', '888/PL42/KS/2020', 0, 0, 0, NULL, NULL, NULL),
(85, '85', NULL, NULL, '2020-11-18', '2023-11-18', '073/18973/RSJ', '247/PKS/UKSW/XI/2020', 0, 0, 0, NULL, NULL, NULL),
(86, '86', NULL, NULL, '2020-11-02', '2023-11-02', '073/16336/RSJ', '037/PKS/DN/FKUKMXI/2020', 0, 0, 0, NULL, NULL, NULL),
(87, '29', NULL, NULL, '1984-04-12', '1987-04-12', 'Occaecat ut obcaecat', 'Cumque voluptatem A', 7, 3, 10, NULL, NULL, NULL),
(88, '1', NULL, '2022-04-24', '2010-10-20', '2013-10-20', '-', '-', 0, 0, 0, './_file/mou-pks/mou_88_2022-04-24.pdf', './_file/mou-pks/pks_88_2022-04-24.pdf', NULL),
(89, '87', '2022-04-24', '2022-04-25', '2022-04-24', '2025-04-24', '2/2/RSJ', '1/1/RSJ', 0, 0, 0, './_file/mou-pks/mou_89_2022-04-25.pdf', './_file/mou-pks/pks_89_2022-04-25.pdf', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_nilai_ked_coass`
--

DROP TABLE IF EXISTS `tb_nilai_ked_coass`;
CREATE TABLE `tb_nilai_ked_coass` (
  `id` int(11) NOT NULL,
  `id_praktikan` int(11) NOT NULL,
  `tgl_tambah` datetime NOT NULL,
  `tgl_ubah` datetime DEFAULT NULL,
  `bst` int(11) DEFAULT NULL,
  `crs` int(11) DEFAULT NULL,
  `css` int(11) DEFAULT NULL,
  `minicex` int(11) DEFAULT NULL,
  `rps` int(11) DEFAULT NULL,
  `osler` int(11) DEFAULT NULL,
  `dops` int(11) DEFAULT NULL,
  `cbd` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_nilai_ked_coass`
--

INSERT INTO `tb_nilai_ked_coass` (`id`, `id_praktikan`, `tgl_tambah`, `tgl_ubah`, `bst`, `crs`, `css`, `minicex`, `rps`, `osler`, `dops`, `cbd`) VALUES
(1, 20, '2023-06-14 00:00:00', '2023-07-05 10:01:50', 32, 77, 93, 11, 18, 25, 14, 42),
(2, 21, '2023-06-14 00:00:00', '2023-06-14 10:05:45', 62, 87, 68, 70, 78, 11, 3, 0),
(3, 300, '2023-07-26 00:00:00', '2023-08-28 04:19:08', 87, 55, 72, 95, 52, 23, 32, 67),
(5, 19, '2023-08-24 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 301, '2023-08-24 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 365, '2023-10-11 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 366, '2023-10-12 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_nilai_kep`
--

DROP TABLE IF EXISTS `tb_nilai_kep`;
CREATE TABLE `tb_nilai_kep` (
  `id_nilai_kep` int(100) NOT NULL,
  `id_pembimbing` int(11) NOT NULL,
  `id_praktik` int(11) NOT NULL,
  `id_praktikan` int(11) NOT NULL,
  `id_unit` int(11) NOT NULL,
  `lp` text NOT NULL,
  `prepost` text NOT NULL,
  `sptk` text NOT NULL,
  `penkes` text NOT NULL,
  `dokep` text NOT NULL,
  `komter` text NOT NULL,
  `tak` text NOT NULL,
  `kasus` text NOT NULL,
  `ujian` text NOT NULL,
  `sikap` text NOT NULL,
  `ket_nilai` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_nilai_upload`
--

DROP TABLE IF EXISTS `tb_nilai_upload`;
CREATE TABLE `tb_nilai_upload` (
  `id_nilai_upload` int(11) NOT NULL,
  `id_pembimbing` int(11) NOT NULL,
  `id_unit` int(11) NOT NULL,
  `id_praktik` int(11) NOT NULL,
  `tgl_tambah_nilai_upload` date DEFAULT NULL,
  `tgl_ubah_nilai_upload` date DEFAULT NULL,
  `file_nilai_upload` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_pembimbing`
--

DROP TABLE IF EXISTS `tb_pembimbing`;
CREATE TABLE `tb_pembimbing` (
  `id_pembimbing` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `tgl_tambah_pembimbing` date DEFAULT NULL,
  `tgl_ubah_pembimbing` date DEFAULT NULL,
  `no_id_pembimbing` text NOT NULL,
  `nama_pembimbing` text NOT NULL,
  `id_pembimbing_jenis` int(11) NOT NULL COMMENT '(sementara tidak digunakan)',
  `id_jurusan_pdd` int(11) NOT NULL,
  `id_jenjang_pdd` int(11) NOT NULL,
  `id_profesi_pdd` int(11) NOT NULL,
  `kali_pembimbing` int(11) NOT NULL,
  `status_pembimbing` enum('Y','T') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_pembimbing`
--

INSERT INTO `tb_pembimbing` (`id_pembimbing`, `id_user`, `tgl_tambah_pembimbing`, `tgl_ubah_pembimbing`, `no_id_pembimbing`, `nama_pembimbing`, `id_pembimbing_jenis`, `id_jurusan_pdd`, `id_jenjang_pdd`, `id_profesi_pdd`, `kali_pembimbing`, `status_pembimbing`) VALUES
(1, NULL, NULL, NULL, '198302142015031001', 'dr. Ade Kurnia Surawijawa, Sp.KJ.', 9, 1, 9, 2, 0, 'Y'),
(2, NULL, NULL, NULL, '197707272006042026', 'dr. Dhian Indriasari, Sp.KJ.', 9, 1, 9, 2, 0, 'Y'),
(3, NULL, NULL, NULL, '198305162010012016', 'dr. Dini Indriany, Sp.KJ.', 9, 1, 9, 2, 0, 'Y'),
(4, NULL, NULL, NULL, '196312011990031004', 'dr. H. Encep Supriandi, Sp.KJ. M.Kes., M.KM.', 9, 1, 9, 2, 0, 'Y'),
(5, NULL, NULL, NULL, '196208081990011001', 'dr. H. Riza Putra, Sp.KJ.', 9, 1, 9, 2, 0, 'Y'),
(6, NULL, NULL, NULL, '198601052020122005', 'dr. Hilda Puspa Indah, Sp.KJ.', 9, 1, 9, 2, 0, 'Y'),
(7, 4, NULL, NULL, '196608141991022004', 'dr. Hj. Elly Marliyani, Sp.KJ., M.K.M', 9, 1, 9, 2, 0, 'Y'),
(8, NULL, NULL, NULL, '196607132007012005', 'dr. Hj. Meutia Laksaminingrum, Sp.KJ.', 9, 1, 9, 2, 0, 'Y'),
(9, NULL, NULL, NULL, '196805271998032004', 'dr. Lenny Irawati Yohosua, Sp.KJ.', 9, 1, 9, 2, 0, 'Y'),
(10, NULL, NULL, NULL, '197507072005012006', 'dr. Lina Budiyanti, Sp.KJ. (K)', 9, 1, 9, 2, 0, 'Y'),
(11, NULL, NULL, NULL, '197506082006041013', 'dr. Yunyun Setiawan, Sp.KJ.', 9, 1, 9, 2, 0, 'Y'),
(12, NULL, NULL, NULL, '197902192011012001', 'dr. Indah KusumaDewi, Sp.KJ.', 9, 1, 9, 2, 0, 'Y'),
(13, NULL, NULL, NULL, '198302142015031001', 'Ade Kurnia Surawijaya, dr. Sp.KJ.', 8, 1, 9, 1, 0, 'Y'),
(14, NULL, NULL, NULL, '197707272006042026', 'Dhian Indriasari, dr. Sp.KJ.', 8, 1, 9, 1, 0, 'Y'),
(15, NULL, NULL, NULL, '202101228', 'Hasrini Rowawi, dr., Sp.KJ (K)., MHA', 8, 1, 9, 1, 0, 'Y'),
(16, NULL, NULL, NULL, '196805271998032004', 'Lenny Irawati Yohosua, dr. Sp.KJ.', 8, 1, 9, 1, 0, 'Y'),
(17, NULL, NULL, NULL, '197507072005012006', 'Lina Budiyanti, dr. Sp.KJ (K)', 8, 1, 9, 1, 0, 'Y'),
(18, NULL, NULL, NULL, '198601082010012013', 'Ema Marlina, S.Tr.T', 7, 8, 8, 0, 0, 'Y'),
(19, NULL, NULL, NULL, '198102122005012013', 'Yeni Susanti, Amd. RMIK', 7, 8, 6, 0, 0, 'Y'),
(20, NULL, NULL, NULL, '197105071997032005', 'Dra. Lismaniar, Psi., M.Psi', 6, 9, 10, 4, 0, 'Y'),
(21, NULL, NULL, NULL, '196508051995022002', 'Dra. Resmi Prasetyani, Psi', 6, 9, 10, 4, 0, 'Y'),
(22, NULL, NULL, NULL, '197308081999032005', 'Yuyum Rohmulyanawati, S.Sos, MPSSp', 5, 9, 10, 0, 0, 'Y'),
(23, NULL, NULL, NULL, '198805212011011003', 'Irfan Arief Sulistyawan, Amd', 3, 9, 6, 0, 0, 'Y'),
(24, NULL, NULL, '2023-01-24', '197301072005011007', 'Abdul Aziz, AMK', 4, 2, 6, 0, 0, 'Y'),
(25, 4, NULL, NULL, '197812182006042017', 'Adah Saadah, S.Kep., Ners', 4, 2, 9, 5, 0, 'Y'),
(26, NULL, NULL, NULL, '197405121997032004', 'Ade Carnisem, S.Kep., Ners', 4, 2, 9, 5, 0, 'Y'),
(27, NULL, NULL, NULL, '196607161991032004', 'Hj. Ade Saromah, S.Kep., Ners', 4, 2, 9, 5, 0, 'Y'),
(28, NULL, NULL, NULL, '197211201991031001', 'Agus Krisno, AMK', 4, 2, 6, 0, 0, 'Y'),
(29, NULL, NULL, NULL, '198109282005011007', 'Agus Kusnandar, S.Kep., Ners', 4, 2, 9, 5, 0, 'Y'),
(30, NULL, NULL, NULL, '197503081997032002', 'Ai Sriyati, S.Kep., Ners', 4, 2, 9, 5, 0, 'Y'),
(31, NULL, NULL, NULL, '198110272006042014', 'Butet Berlina, S.Kep., Ners', 4, 2, 9, 5, 0, 'Y'),
(32, NULL, NULL, NULL, '197610012005011010', 'Dedi Nurhasan, S.Kep., Ners', 4, 2, 9, 5, 0, 'Y'),
(33, NULL, NULL, NULL, '196705161991031004', 'Dedi Suhaedi, AMK', 4, 2, 6, 0, 0, 'Y'),
(34, NULL, NULL, NULL, '196904071993032008', 'Dewi Shinta Maria, AMK', 4, 2, 6, 0, 0, 'Y'),
(35, NULL, NULL, NULL, '197507041999032005', 'Dian Ratnaningsih, S.Kep., Ners', 4, 2, 9, 5, 0, 'Y'),
(36, NULL, NULL, NULL, '197609212000032001', 'Elsie Rodini, AMK', 4, 2, 6, 0, 0, 'Y'),
(37, NULL, NULL, NULL, '196411011998032001', 'Eny Budiasih, S.Kep., Ners', 4, 2, 9, 5, 0, 'Y'),
(38, NULL, NULL, NULL, '196901062000122001', 'Eri Suciati, S.Kep., Ners', 4, 2, 9, 5, 0, 'Y'),
(39, NULL, NULL, NULL, '197901212005012013', 'Ester Suryani Tampubolon, S.Kep., Ners', 4, 2, 9, 5, 0, 'Y'),
(40, NULL, NULL, NULL, '197303291999032002', 'Ettie Hikmawati, S.Kep., Ners', 4, 2, 9, 5, 0, 'Y'),
(41, NULL, NULL, NULL, '197601311999031001', 'H. Dedi Rahmadi, S.Kep.Ners', 4, 2, 9, 5, 0, 'Y'),
(42, NULL, NULL, NULL, '197612242000031004', 'H. Moch. Jimi Dirgantara, S.Kep.Ners', 4, 2, 9, 5, 0, 'Y'),
(43, NULL, NULL, NULL, '197212271996031003', 'H. Zaenurohman, S.Kep.Ners', 4, 2, 9, 5, 0, 'Y'),
(44, NULL, NULL, NULL, '197911152000032004', 'Hj. Arimbi Nurwiyanti P, S.Kep.Ners', 4, 2, 9, 5, 0, 'Y'),
(45, NULL, NULL, NULL, '197909052006042016', 'Hj. Devie Fitriyani, S.Kep.Ners', 4, 2, 9, 5, 0, 'Y'),
(46, NULL, NULL, NULL, '197807042009022004', 'Hj. Icih Susanti, S.Kep.Ners', 4, 2, 9, 5, 0, 'Y'),
(47, NULL, NULL, NULL, '196812261996032001', 'Hj. Nenti Siti Kuraesin, S.Kep., Ners', 4, 2, 9, 5, 0, 'Y'),
(48, NULL, NULL, NULL, '197902112006042015', 'Kokom Komalasari, S.Kep., Ners', 4, 2, 9, 5, 0, 'Y'),
(49, NULL, NULL, NULL, '196607151990032013', 'Komaryati, S.Kep., Ners', 4, 2, 9, 5, 0, 'Y'),
(50, NULL, NULL, NULL, '198307172009022001', 'Neng Goniah, S.Kep., Ners', 4, 2, 9, 5, 0, 'Y'),
(51, NULL, NULL, NULL, '197608072005012005', 'Nenih Nuraenih, S.Kep., Ners', 4, 2, 9, 5, 0, 'Y'),
(52, NULL, NULL, NULL, '197011111996032003', 'Ni Luh Nyoman S Puspowati, S.Kep., Ners', 4, 2, 9, 5, 0, 'Y'),
(53, NULL, NULL, NULL, '197004221998032004', 'Nirna Julaeha, S.Kep., Ners', 4, 2, 9, 5, 0, 'Y'),
(54, NULL, NULL, NULL, '197911232005012017', 'Novita Sari, S.Kep., Ners', 4, 2, 9, 5, 0, 'Y'),
(55, NULL, NULL, NULL, '198010212005012011', 'Siti Romlah, S.Kep., Ners', 4, 2, 9, 5, 0, 'Y'),
(56, NULL, NULL, NULL, '196908311998032005', 'Sri Kurniyati, S.Kep., Ners', 4, 2, 9, 5, 0, 'Y'),
(57, NULL, NULL, NULL, '196805271992032004', 'Sri Yani, S.Kep., Ners', 4, 2, 9, 5, 0, 'Y'),
(58, NULL, NULL, NULL, '198103082005012006', 'Winda Ratna Wulan, S.Kep. Ners., M.Kep.,Sp.Kep.J  ', 4, 2, 10, 5, 0, 'Y'),
(59, NULL, NULL, NULL, '197707041997031004', 'Yulforman Rotua Manalu, S.Kep., Ners', 4, 2, 9, 5, 0, 'Y'),
(60, NULL, NULL, NULL, '196707151987032002', 'Yusi Yustiah, AMK', 4, 2, 6, 0, 0, 'Y'),
(61, NULL, NULL, NULL, '196712151990032007', 'Yuyun Yunara, S.Kep., Ners', 4, 2, 9, 5, 0, 'Y'),
(62, NULL, NULL, '2022-10-07', '199409102020121008', 'Rizki Egi Purnama, S.Pd', 2, 8, 8, 0, 0, 'Y'),
(63, NULL, NULL, NULL, '196409251992031006', 'Drs. Tavip Budiawan, Apt', 1, 9, 9, 9, 0, 'Y'),
(64, NULL, NULL, NULL, '198103252011012004', 'Ekaprasetyawati, S.Si, Apt', 1, 9, 9, 9, 0, 'Y'),
(65, NULL, NULL, NULL, '197801101999032002', 'Ice Laila Nur, S.Si., Apt., M.Farm', 1, 9, 10, 9, 0, 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pembimbing_jenis`
--

DROP TABLE IF EXISTS `tb_pembimbing_jenis`;
CREATE TABLE `tb_pembimbing_jenis` (
  `id_pembimbing_jenis` int(11) NOT NULL,
  `nama_pembimbing_jenis` text NOT NULL,
  `akronim_pembimbing_jenis` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_pembimbing_jenis`
--

INSERT INTO `tb_pembimbing_jenis` (`id_pembimbing_jenis`, `nama_pembimbing_jenis`, `akronim_pembimbing_jenis`) VALUES
(1, 'Clinical Instructor Farmasi', 'CI FAR'),
(2, 'Clinical Instructor Informasi Teknologi', 'CI IT'),
(3, 'Clinical Instructor Kesehatan Lingkungan', 'CI KESLING'),
(4, 'Clinical Instructor Keperawatan', 'CI KEP'),
(5, 'Clinical Instructor Pekerja Sosial', 'CI PEKSOS'),
(6, 'Clinical Instructor Psikologi', 'CI PSI'),
(7, 'Clinical Instructor Rekam Medik', 'CI RM'),
(8, 'Program Pendidikan Dokter Spesialis', 'PPDS'),
(9, 'Program Studi Profesi Dokter', 'PSPD');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pembimbing_pilih`
--

DROP TABLE IF EXISTS `tb_pembimbing_pilih`;
CREATE TABLE `tb_pembimbing_pilih` (
  `id_pembimbing_pilih` int(11) NOT NULL,
  `id_praktik` int(11) NOT NULL,
  `id_pembimbing` int(11) NOT NULL,
  `id_unit` int(11) NOT NULL,
  `id_praktikan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_pertanyaan`
--

DROP TABLE IF EXISTS `tb_pertanyaan`;
CREATE TABLE `tb_pertanyaan` (
  `id` int(4) NOT NULL,
  `pertanyaan` varchar(200) DEFAULT NULL,
  `kategori_pertanyaan` varchar(100) DEFAULT NULL,
  `p1` text DEFAULT NULL,
  `p2` text DEFAULT NULL,
  `p3` text DEFAULT NULL,
  `keterangan` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_pertanyaan`
--

INSERT INTO `tb_pertanyaan` (`id`, `pertanyaan`, `kategori_pertanyaan`, `p1`, `p2`, `p3`, `keterangan`) VALUES
(1, 'Autoanamnesis dengan pasien', 'P3D', NULL, NULL, NULL, '4A'),
(2, 'Alloanamnesis dengan anggota keluarga/orang lain yang bermakna', 'P3D', NULL, NULL, NULL, '4A'),
(3, 'Memperoleh data mengenai keluhan/masalah 4A utama', 'P3D', NULL, NULL, NULL, '4A'),
(4, 'Menelusuri riwayat perjalanan penyakit sekarang/dahulu', 'P3D', NULL, NULL, NULL, '4A'),
(5, 'Memperoleh data bermakna mengenai riwayat 4A perkembangan, pendidikan, pekerjaan, perkawinan, kehidupan keluarga', 'P3D', NULL, NULL, NULL, '4A'),
(6, 'Pemeriksaan Psikiatri', 'P3D', NULL, NULL, NULL, ''),
(7, 'Penilaian status mental', 'P3D', NULL, NULL, NULL, '4A'),
(8, 'Penilaian kesadaran', 'P3D', NULL, NULL, NULL, '4A'),
(9, 'Penilaian persepsi orientasi intelegensi secara klinis', 'P3D', NULL, NULL, NULL, '4A'),
(10, 'Penilaian orientasi', 'P3D', NULL, NULL, NULL, '4A'),
(11, 'Penilaian intelegensi secara klinis', 'P3D', NULL, NULL, NULL, '4A'),
(12, 'Penilaian bentuk dan isi pikir', 'P3D', NULL, NULL, NULL, '4A'),
(13, 'Penilaian mood dan afek', 'P3D', NULL, NULL, NULL, '4A'),
(14, 'Penilaian motorik', 'P3D', NULL, NULL, NULL, ''),
(15, 'Penilaian pengendalian impuls', 'P3D', NULL, NULL, NULL, '4A'),
(16, 'Penilaian kemampuan menilai realitas (judgement)', 'P3D', NULL, NULL, NULL, ''),
(17, 'Penilaian kemampuan tilikan (insight)', 'P3D', NULL, NULL, NULL, '4A'),
(18, 'Penilaian kemampuan fungsional (general assessment of functioning) ', 'P3D', NULL, NULL, NULL, '4A'),
(19, 'Diagnosa dan Identifikasi Masalah', 'P3D', NULL, NULL, NULL, '4A'),
(20, 'Menegakkan diagnosis kerja berdasarkan kriteria diagnosis multiaksial', 'P3D', NULL, NULL, NULL, '4A'),
(21, 'Membuat diagnosis banding (diagnosis differensial)', 'P3D', NULL, NULL, NULL, '4A'),
(22, 'Identifikasi kedaruratan psikiatrik', 'P3D', NULL, NULL, NULL, ''),
(23, 'Identifikasi masalah di bidang fisik, psikologis, sosial', 'P3D', NULL, NULL, NULL, ''),
(24, 'Mempertimbangan prognosis', 'P3D', NULL, NULL, NULL, ''),
(25, 'Menentukan indikasi rujuk', 'P3D', NULL, NULL, NULL, ''),
(26, 'Melakukan Mini Mental State Examination', 'P3D', NULL, NULL, NULL, ''),
(27, 'Melakukan kunjungan rumah apabila diperlukan', 'P3D', NULL, NULL, NULL, ''),
(28, 'Melakukan kerjasama konsultatif dengan sejawat lainnya', 'P3D', NULL, NULL, NULL, ''),
(29, 'Memberikan terapi psikofarmaka (obat-obat antipsiko-tik, anticemas, antidepresan, antikolinergik, sedatif)', 'P3D', NULL, NULL, NULL, ''),
(30, 'Electroconvulsion therapy (ECT)', 'P3D', NULL, NULL, NULL, ''),
(31, 'Psikoterapi suportif: konselling', 'P3D', NULL, NULL, NULL, ''),
(32, 'Psikoterapi modifikasi perilaku', 'P3D', NULL, NULL, NULL, ''),
(33, 'Cognitive Behavior Therapy (CBT)', 'P3D', NULL, NULL, NULL, ''),
(34, 'Psikoterapi psikoanalitik', 'P3D', NULL, NULL, NULL, ''),
(35, 'Hipnoterapi dan terapi relaksasi', 'P3D', NULL, NULL, NULL, ''),
(36, 'Group Therapy', 'P3D', NULL, NULL, NULL, ''),
(37, 'Family Therapy', 'P3D', NULL, NULL, NULL, ''),
(38, 'Absensi dan kedisiplinan waktu', 'LPPP', 'Tidak memenuhi syarat absensi atau >_3 kali datang tidak tepat waktu', 'Memenuhi syarat absensi, pernah < 3 kali datang tidak tepat waktu', 'Memenuhi <b>syarat absensi</b> dan selalu datang tepat waktu', NULL),
(39, 'Profesionallisme terkait tugas', 'LPPP', 'Memiliki >_3 kali catatan negatif dalam pemenuhan kewajiban atau penugasan dalam periode rotasi klinik', 'Memiliki < 3 kali catatan negatif dalam pemenuhan kewajibanatau penugasan dalam periode rotasi klinik', 'Melaksanakan <b>seluruh tugas</b> dengan penuh tanggung jawab,tepat waktu dan berkomitmen', NULL),
(40, 'Profesionalisme terkait hubungan dengan berbagai pihak', 'LPPP', 'Memiliki > 3 catatan negatif terkait hubungan dengan rekan sejawat atau profesi lain', 'Memilki < 3 catatan negatif terkait hubungan dengan rekan sejawat atau profesi lain', 'Menunjukan sikap profesional saat melakukan kerja sama dengan rekan sejawat dan profesi lain.', NULL),
(41, 'Profesionalisme terkait hubungan dengan berbagai pihak', 'LPPP', 'Memiliki > 3 catatan negatif terkait hubungan dengan pembimbing klinik', 'Memiliki < catatan negatif terkait hubungan dengan pembimbing klinik', 'Menunjukan sikap profesional saat berhubungan dengan <b>pembimbing klinik</b>', NULL),
(42, 'Profesionalisme terkait hubungan dengan berbagai pihak', 'LPPP', 'Memiliki > 3 catatan negatif terkait hubungan dengan pasien dan keluarga pasien', 'Memiliki > 3 catatan negatif terkait hubungan dengan pasien dan keluarga pasien', 'Menunjukan sikap profesionalisme pada <b>pasien dan keluarga pasien.</b>', NULL),
(43, 'Profesionalisme terkait pengembanagan diri', 'LPPP', 'Menunjukan sikap yang negatif terhadap masukan / umpan balik yang diterima.', 'Mulai menunjukan sikap terbuka terhadap masukan / umpan balik namun masih perlu mengembangkan kemampuan evaluasi diri', 'Menunjukan sikap terbuka terhadap masukan / umpan balik dari dalam proses pembelajaran dan mampu mengevaluasi diri dengan baik', NULL),
(44, 'Profesionalisme terkait pengembanagan diri', 'LPPP', 'Menunjukan sikap atau perilaku negatif terhadaf proses pembelajaran yang dapat memfasilitasi peningkatan kemampuan.', 'Mulai menujukan kemauan untuk meningkatkan kemampuannya secara profesional.', 'Menunjukan kemauan dan perilaku nyata untuk meningkatkan kemampuanya secara profesional', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_pkd`
--

DROP TABLE IF EXISTS `tb_pkd`;
CREATE TABLE `tb_pkd` (
  `id_pkd` int(11) NOT NULL,
  `tgl_tambah_pkd` date NOT NULL,
  `tgl_ubah_pkd` date DEFAULT NULL,
  `nama_pemohon_pkd` text NOT NULL,
  `rincian_pkd` text NOT NULL,
  `tgl_pel_pkd` date NOT NULL,
  `nama_kor_pkd` text NOT NULL,
  `email_kor_pkd` text NOT NULL,
  `telp_kor_pkd` text NOT NULL,
  `file_surat_pkd` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_pkd`
--

INSERT INTO `tb_pkd` (`id_pkd`, `tgl_tambah_pkd`, `tgl_ubah_pkd`, `nama_pemohon_pkd`, `rincian_pkd`, `tgl_pel_pkd`, `nama_kor_pkd`, `email_kor_pkd`, `telp_kor_pkd`, `file_surat_pkd`) VALUES
(1, '2023-01-24', '2023-03-03', 'PT NOVELL PHARMACEUTICAL LABORATORIES', 'RTD Obat', '2023-02-23', 'Ade Thuto', '-', '0227208379', './_file/pkd/file_surat_pkd01b83921dd55f16e27037cda3e872ede.pdf'),
(2, '2023-08-22', '2023-08-22', 'PT Amarox Pharma Global', 'Presentasi Produk Aripiprazol di Ruang Rapat Komite Medik dengan Pemateri langsung dari Amarox', '2023-07-05', 'Tn', '-', '628', './_file/pkd/file_surat_pkddd8a533ab9d2836dacc7319245c22990.pdf'),
(3, '2023-08-22', NULL, 'PT Eisai Indonesia', 'Lemborexant : A Novel Dual Orexin Receptor Antagonist in Insomnia Treatment dengan Pemateri dari PT Eisai', '2023-07-20', 'Pak Indra dan Ibu Ela', 'e-sulasmi@hhc.eisai.co.id', '6281332578788', './_file/pkd/file_surat_pkd13ec6a19036509640b8b103fa4724a7b.pdf'),
(4, '2023-08-22', '2023-10-06', 'PT Johnson and Johnson Indonesia Two', 'Penggunaan Ruangan, Permohonan Pemateri dan Moderator (Psikiater dr. Lina, Moderator dr. Dini dan Apoteker Ibu Eka)', '2023-07-28', 'Pak Lutfi ', '-', '628118678409', './_file/pkd/file_surat_pkd0209aea775be6abce12cd610d856283a.pdf'),
(5, '2023-08-22', NULL, 'PT Meprofarm', 'Presentasi Produk Arinia dan Talox', '2023-08-15', 'Pak Angki', '-', '6281248579854', './_file/pkd/file_surat_pkd328cd99cce6ff7ccae360d4cadf505e0.pdf'),
(6, '2023-08-29', '2023-08-29', 'PT SOHO Industri Pharmasi', 'Mengenali Gejala dan Pengobatan Untuk Pasien\r\nPsikosomatis dan Anxietas', '2023-08-10', 'Pulung', '-', '6281222904636', './_file/pkd/file_surat_pkdcb68782944505f89a9ce117932024925.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pkd_tarif`
--

DROP TABLE IF EXISTS `tb_pkd_tarif`;
CREATE TABLE `tb_pkd_tarif` (
  `id_pkd_tarif` int(11) NOT NULL,
  `id_pkd` int(11) NOT NULL,
  `tgl_tambah_pkd_tarif` date DEFAULT NULL,
  `tgl_ubah_pkd_tarif` date DEFAULT NULL,
  `nama_pkd_tarif` text NOT NULL,
  `frekuensi_pkd_tarif` int(11) NOT NULL,
  `satuan_pkd_tarif` text NOT NULL,
  `jumlah_pkd_tarif` bigint(20) NOT NULL,
  `total_pkd_tarif` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_pkd_tarif`
--

INSERT INTO `tb_pkd_tarif` (`id_pkd_tarif`, `id_pkd`, `tgl_tambah_pkd_tarif`, `tgl_ubah_pkd_tarif`, `nama_pkd_tarif`, `frekuensi_pkd_tarif`, `satuan_pkd_tarif`, `jumlah_pkd_tarif`, `total_pkd_tarif`) VALUES
(1, 1, '2023-01-24', NULL, 'Sewa Aula', 1, 'per-hari / kegiatan', 1000000, 1000000),
(2, 2, '2023-08-22', NULL, 'Penggunaan Ruangan', 1, 'per-hari', 750000, 750000),
(3, 3, '2023-08-22', NULL, 'penggunaan ruangan rapat komite medik', 1, 'per-hari', 750000, 750000),
(4, 4, '2023-08-22', NULL, 'Penggunaan Ruangan, Permohonan Narasumber Psikiater dan Apoteker', 1, 'per-hari', 7500000, 7500000),
(5, 5, '2023-08-22', NULL, 'Penggunaan Ruangan', 1, 'per-hari', 750000, 750000),
(6, 6, '2023-08-29', NULL, 'Fee Speaker', 1, 'per-hari / kegiatan', 4000000, 4000000),
(7, 6, '2023-08-29', NULL, 'Fee Moderator', 1, 'per-hari / kegiatan', 3000000, 3000000),
(8, 6, '2023-08-29', NULL, 'Fee Pemakaian Ruangan Komite Medik', 1, 'per-hari', 750000, 750000);

-- --------------------------------------------------------

--
-- Table structure for table `tb_praktik`
--

DROP TABLE IF EXISTS `tb_praktik`;
CREATE TABLE `tb_praktik` (
  `id_praktik` int(11) NOT NULL,
  `id_user` text NOT NULL,
  `id_mou` int(11) NOT NULL COMMENT 'data mou dari tb_mou (sementara tidak digunakan)',
  `id_institusi` int(11) NOT NULL,
  `id_jurusan_pdd_jenis` int(11) NOT NULL,
  `id_jurusan_pdd` int(11) NOT NULL,
  `id_jenjang_pdd` int(11) NOT NULL,
  `id_profesi_pdd` int(11) NOT NULL,
  `nama_praktik` text NOT NULL COMMENT 'nama kelompok/gelombang',
  `tgl_input_praktik` text DEFAULT NULL,
  `tgl_ubah_praktik` text DEFAULT NULL,
  `tgl_mulai_praktik` date DEFAULT NULL,
  `tgl_selesai_praktik` date DEFAULT NULL,
  `jumlah_praktik` int(11) NOT NULL,
  `no_surat_praktik` text NOT NULL,
  `tgl_surat_praktik` date DEFAULT NULL,
  `surat_praktik` text DEFAULT NULL,
  `akred_institusi_praktik` text NOT NULL,
  `akred_jurusan_praktik` text NOT NULL,
  `data_praktik` text DEFAULT NULL,
  `nama_koordinator_praktik` text NOT NULL,
  `email_koordinator_praktik` text NOT NULL,
  `telp_koordinator_praktik` text NOT NULL,
  `kode_bayar_praktik` text DEFAULT NULL,
  `status_praktik` enum('Y','ARSIP') NOT NULL COMMENT 'Status Aktif/Arsip Praktik',
  `status_mess_praktik` enum('T','Y') NOT NULL COMMENT 'stasus pakai mess ',
  `status_nilai_praktik` enum('T','Y') NOT NULL COMMENT 'status nilai yang uploadkan atau diinputkan',
  `makan_mess_praktik` enum('T','Y') DEFAULT NULL COMMENT 'status memakai makan mess (sementara tidak digunakan)',
  `materi_upip_praktik` text DEFAULT NULL,
  `materi_napza_praktik` text DEFAULT NULL,
  `fileInv_praktik` text DEFAULT NULL,
  `fileNilKep_praktik` text DEFAULT NULL,
  `alasan_institusi` text DEFAULT NULL,
  `alasan_admin` text DEFAULT NULL,
  `status_alasan` enum('Y','T') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_praktikan`
--

DROP TABLE IF EXISTS `tb_praktikan`;
CREATE TABLE `tb_praktikan` (
  `id_praktikan` int(11) NOT NULL,
  `id_praktik` int(11) NOT NULL,
  `id_pembimbing` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tgl_tambah_praktikan` date DEFAULT NULL,
  `tgl_ubah_praktikan` date DEFAULT NULL,
  `foto_praktikan` text DEFAULT NULL,
  `no_id_praktikan` text NOT NULL,
  `nama_praktikan` text NOT NULL,
  `tgl_lahir_praktikan` date NOT NULL,
  `telp_praktikan` text NOT NULL,
  `wa_praktikan` text NOT NULL,
  `email_praktikan` text NOT NULL,
  `alamat_praktikan` text NOT NULL,
  `file_ijazah_praktikan` text NOT NULL,
  `file_swab_praktikan` text NOT NULL,
  `status_praktikan` enum('Y','T') NOT NULL,
  `pernyataan_praktikan` enum('T','Y') NOT NULL,
  `tgl_pernyataan` date DEFAULT NULL,
  `file_logbook` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_praktik_mess_alasan`
--

DROP TABLE IF EXISTS `tb_praktik_mess_alasan`;
CREATE TABLE `tb_praktik_mess_alasan` (
  `id` int(11) NOT NULL,
  `id_praktik` int(11) NOT NULL,
  `tgl_tambah` date NOT NULL,
  `alasan_institusi` text NOT NULL,
  `alasan_admin` text NOT NULL,
  `status` enum('Y','T') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_praktik_tgl`
--

DROP TABLE IF EXISTS `tb_praktik_tgl`;
CREATE TABLE `tb_praktik_tgl` (
  `id_praktik_tgl` int(11) NOT NULL,
  `id_praktik` int(11) NOT NULL,
  `praktik_tgl` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_profesi_pdd`
--

DROP TABLE IF EXISTS `tb_profesi_pdd`;
CREATE TABLE `tb_profesi_pdd` (
  `id_profesi_pdd` int(11) NOT NULL,
  `id_jurusan_pdd` int(11) NOT NULL,
  `nama_profesi_pdd` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_profesi_pdd`
--

INSERT INTO `tb_profesi_pdd` (`id_profesi_pdd`, `id_jurusan_pdd`, `nama_profesi_pdd`) VALUES
(0, 0, '-- Lainnya --'),
(1, 1, 'Program Pendidikan Dokter Spesialis (PPDS)/Residence'),
(2, 1, 'Program Studi Pendidikan Dokter (PSPD)/Co-ass'),
(3, 5, 'Apoteker'),
(4, 3, 'Psikolog Klinik'),
(5, 2, 'Ners');

-- --------------------------------------------------------

--
-- Table structure for table `tb_tarif`
--

DROP TABLE IF EXISTS `tb_tarif`;
CREATE TABLE `tb_tarif` (
  `id_tarif` int(11) NOT NULL,
  `tgl_tambah_tarif` date DEFAULT NULL,
  `tgl_ubah_tarif` date DEFAULT NULL,
  `nama_tarif` text NOT NULL,
  `id_tarif_satuan` int(11) NOT NULL,
  `ket_tarif` text DEFAULT NULL,
  `jumlah_tarif` float NOT NULL,
  `tipe_tarif` text NOT NULL,
  `frekuensi_tarif` int(11) NOT NULL,
  `kuantitas_tarif` int(11) NOT NULL,
  `id_jurusan_pdd` int(11) NOT NULL,
  `id_jenjang_pdd` int(11) DEFAULT NULL,
  `id_spesifikasi_pdd` int(11) DEFAULT NULL,
  `id_tarif_jenis` int(11) NOT NULL,
  `pilih_tarif` int(11) NOT NULL,
  `status_tarif` enum('y','t') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_tarif_jenis`
--

DROP TABLE IF EXISTS `tb_tarif_jenis`;
CREATE TABLE `tb_tarif_jenis` (
  `id_tarif_jenis` int(11) NOT NULL,
  `nama_tarif_jenis` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_tarif_pilih`
--

DROP TABLE IF EXISTS `tb_tarif_pilih`;
CREATE TABLE `tb_tarif_pilih` (
  `id_tarif_pilih` int(11) NOT NULL,
  `id_praktik` int(11) DEFAULT NULL,
  `tgl_tambah_tarif_pilih` date DEFAULT NULL,
  `tgl_ubah_tarif_pilih` date DEFAULT NULL,
  `nama_jenis_tarif_pilih` text NOT NULL,
  `nama_tarif_pilih` text NOT NULL,
  `nominal_tarif_pilih` int(11) NOT NULL,
  `nama_satuan_tarif_pilih` text NOT NULL,
  `frekuensi_tarif_pilih` int(11) NOT NULL,
  `kuantitas_tarif_pilih` int(11) NOT NULL,
  `jumlah_tarif_pilih` bigint(20) NOT NULL,
  `ujian_tarif_pilih` text DEFAULT NULL COMMENT '(sementara tidak digunakan)	',
  `mess_tarif_pilih` text DEFAULT NULL COMMENT '(sementara tidak digunakan)',
  `status_tarif_pilih` enum('T','Y') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_tarif_satuan`
--

DROP TABLE IF EXISTS `tb_tarif_satuan`;
CREATE TABLE `tb_tarif_satuan` (
  `id_tarif_satuan` int(11) NOT NULL,
  `nama_tarif_satuan` text NOT NULL,
  `ket_tarif_satuan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_tarif_satuan`
--

INSERT INTO `tb_tarif_satuan` (`id_tarif_satuan`, `nama_tarif_satuan`, `ket_tarif_satuan`) VALUES
(1, 'per-siswa / periode', NULL),
(2, 'per-siswa / kali', NULL),
(3, 'per-periode / kali', NULL),
(4, 'per-siswa / hari', NULL),
(5, 'per-penguji / kali', NULL),
(6, 'per-siswa / periode ujian', NULL),
(7, 'per-hari / kegiatan', NULL),
(8, 'per-minggu / orang', 'Mingguan dikali jumlah praktik'),
(9, 'per-orang', NULL),
(10, 'per-orang / penguji', NULL),
(11, 'per-hari / orang', NULL),
(12, 'per-hari', 'Maksimal 8 Jam'),
(13, 'persiswa / minggu', NULL),
(14, 'per-jam', NULL),
(15, 'per-periode', NULL),
(16, 'per-siswa', NULL),
(17, 'per-periode / materi', NULL),
(18, '-', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_tempat`
--

DROP TABLE IF EXISTS `tb_tempat`;
CREATE TABLE `tb_tempat` (
  `id_tempat` int(11) NOT NULL,
  `tgl_input_tempat` date NOT NULL,
  `tgl_ubah_tempat` date DEFAULT NULL,
  `id_tarif_jenis` int(11) NOT NULL,
  `nama_tempat` text NOT NULL,
  `kapasitas_tempat` int(11) NOT NULL,
  `id_jurusan_pdd_jenis` int(11) DEFAULT NULL,
  `tarif_tempat` int(11) NOT NULL,
  `id_tarif_satuan` int(11) NOT NULL,
  `ket_tempat` text DEFAULT NULL,
  `status_tempat` enum('Y','T') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_tempat`
--

INSERT INTO `tb_tempat` (`id_tempat`, `tgl_input_tempat`, `tgl_ubah_tempat`, `id_tarif_jenis`, `nama_tempat`, `kapasitas_tempat`, `id_jurusan_pdd_jenis`, `tarif_tempat`, `id_tarif_satuan`, `ket_tempat`, `status_tempat`) VALUES
(3, '2022-02-13', NULL, 7, 'Aula Utama', 120, 0, 1000000, 7, '-', 'Y'),
(6, '2022-02-13', NULL, 7, 'Aula Napza', 45, 0, 750000, 7, '-', 'Y'),
(9, '2022-02-13', NULL, 7, 'Ruang SPI', 45, 0, 500000, 7, '-', 'Y'),
(10, '2022-02-15', NULL, 7, 'Ruang Kelas/Ruang Diskusi', 10, 1, 30000, 4, 'Kapasitas Menyesuaikan', 'Y'),
(16, '2022-02-13', NULL, 7, 'Ruang Komite Medik', 22, 0, 750000, 7, '-', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `tb_tempat_pilih`
--

DROP TABLE IF EXISTS `tb_tempat_pilih`;
CREATE TABLE `tb_tempat_pilih` (
  `id_tempat_pilih` int(11) NOT NULL,
  `id_tempat` int(11) NOT NULL,
  `id_praktik` int(11) NOT NULL,
  `frek_tempat_pilih` int(11) NOT NULL,
  `kuan_tempat_pilih` int(11) NOT NULL,
  `total_tarif_tempat_pilih` int(11) NOT NULL,
  `tgl_input_tempat_pilih` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_unit`
--

DROP TABLE IF EXISTS `tb_unit`;
CREATE TABLE `tb_unit` (
  `id_unit` int(11) NOT NULL,
  `nama_unit` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_unit`
--

INSERT INTO `tb_unit` (`id_unit`, `nama_unit`) VALUES
(0, '-- Lainnya --'),
(2, 'Instalasi Farmasi'),
(3, 'Instalasi Gawat Darurat'),
(4, 'Instalasi Rawat Jalan'),
(5, 'Instalasi Rehabilitasi Psikososial'),
(6, 'Instalasi SIMRS'),
(7, 'Kesehatan Lingkungan (Kesling)'),
(8, 'Klinik Graha Atma (GA)'),
(10, 'Poli Psikologi'),
(11, 'Rekam Medik'),
(12, 'Ruang Garuda'),
(13, 'Ruang Gelatik'),
(14, 'Ruang Kasuari Atas'),
(15, 'Ruang Kasuari Bawah'),
(16, 'Ruang Keswara'),
(17, 'Ruang Merak'),
(18, 'Ruang Merpati'),
(19, 'Ruang Murai'),
(20, 'Ruang Napza'),
(21, 'Ruang Nuri'),
(22, 'Ruang Perkutut'),
(23, 'Ruang Rajawali'),
(24, 'Kesehatan Jiwa Masyarakat (KESWAMAS)'),
(25, 'Kedokteran');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

DROP TABLE IF EXISTS `tb_user`;
CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `id_mou` int(11) NOT NULL,
  `id_institusi` int(11) NOT NULL,
  `username_user` text NOT NULL,
  `password_user` varchar(255) NOT NULL,
  `hash_password_user` text NOT NULL,
  `nama_user` text NOT NULL,
  `email_user` text NOT NULL,
  `level_user` int(2) NOT NULL COMMENT '1 admin, 2 ip, 3 pkd, 4 CI/pembimbing, 5 praktikan',
  `no_telp_user` text NOT NULL,
  `foto_user` text DEFAULT NULL,
  `terakhir_login_user` timestamp NULL DEFAULT NULL,
  `tgl_buat_user` text NOT NULL,
  `tgl_ubah_user` text DEFAULT NULL,
  `kode_aktivasi_user` text NOT NULL,
  `status_aktivasi_user` enum('T','Y') NOT NULL,
  `status_user` enum('T','Y') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `id_mou`, `id_institusi`, `username_user`, `password_user`, `hash_password_user`, `nama_user`, `email_user`, `level_user`, `no_telp_user`, `foto_user`, `terakhir_login_user`, `tgl_buat_user`, `tgl_ubah_user`, `kode_aktivasi_user`, `status_aktivasi_user`, `status_user`) VALUES
(1, 0, 0, 'admin', '0bc3b44afc02b6a7867af3d2497303a7', '', 'ADMIN DIKLAT RS JIWA', 'admin@admin', 1, '08123145645', NULL, '2023-11-16 02:13:06', '2021-03-29', '2022-02-22', '', 'Y', 'Y'),
(4, 0, 0, 'cicoass', 'e1d5be1c7f2f456670de3d53c7b54f4a', '', 'Pembimbing', 'pembimbing@pembimbing', 4, '022123456789', NULL, '2023-10-31 08:22:12', '2023-03-02', NULL, '-', 'Y', 'Y'),
(34, 0, 0, 'adminpkd', 'e1d5be1c7f2f456670de3d53c7b54f4a', '', 'ADMIN PKD RS JIWA', 'adminpkd@admin', 3, '-', NULL, '2023-10-17 07:32:41', '2023-01-13', '2022-02-22', '', 'Y', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user_privileges`
--

DROP TABLE IF EXISTS `tb_user_privileges`;
CREATE TABLE `tb_user_privileges` (
  `id_user` int(11) NOT NULL,
  `c_kuota` enum('T','Y') NOT NULL,
  `r_kuota` enum('T','Y') NOT NULL,
  `u_kuota` enum('T','Y') NOT NULL,
  `d_kuota` enum('T','Y') NOT NULL,
  `c_akun` enum('T','Y') NOT NULL,
  `r_akun` enum('T','Y') NOT NULL,
  `u_akun` enum('T','Y') NOT NULL,
  `d_akun` enum('T','Y') NOT NULL,
  `c_praktik` enum('T','Y') NOT NULL,
  `r_praktik` enum('T','Y') NOT NULL,
  `u_praktik` enum('T','Y') NOT NULL,
  `d_praktik` enum('T','Y') NOT NULL,
  `c_praktikan` enum('T','Y') NOT NULL,
  `r_praktikan` enum('T','Y') NOT NULL,
  `u_praktikan` enum('T','Y') NOT NULL,
  `d_praktikan` enum('T','Y') NOT NULL,
  `c_praktik_mess` enum('T','Y') NOT NULL,
  `r_praktik_mess` enum('T','Y') NOT NULL,
  `u_praktik_mess` enum('T','Y') NOT NULL,
  `d_praktik_mess` enum('T','Y') NOT NULL,
  `c_praktik_pembimbing` enum('T','Y') NOT NULL,
  `r_praktik_pembimbing` enum('T','Y') NOT NULL,
  `u_praktik_pembimbing` enum('T','Y') NOT NULL,
  `d_praktik_pembimbing` enum('T','Y') NOT NULL,
  `c_praktik_tarif` enum('T','Y') NOT NULL,
  `r_praktik_tarif` enum('T','Y') NOT NULL,
  `u_praktik_tarif` enum('T','Y') NOT NULL,
  `d_praktik_tarif` enum('T','Y') NOT NULL,
  `c_praktik_bayar` enum('T','Y') NOT NULL,
  `r_praktik_bayar` enum('T','Y') NOT NULL,
  `u_praktik_bayar` enum('T','Y') NOT NULL,
  `d_praktik_bayar` enum('T','Y') NOT NULL,
  `c_narsum` enum('T','Y') NOT NULL,
  `r_narsum` enum('T','Y') NOT NULL,
  `u_narsum` enum('T','Y') NOT NULL,
  `d_narsum` enum('T','Y') NOT NULL,
  `c_daftar_pembimbing` enum('T','Y') NOT NULL,
  `r_daftar_pembimbing` enum('T','Y') NOT NULL,
  `u_daftar_pembimbing` enum('T','Y') NOT NULL,
  `d_daftar_pembimbing` enum('T','Y') NOT NULL,
  `c_praktik_nilai` enum('T','Y') NOT NULL,
  `r_praktik_nilai` enum('T','Y') NOT NULL,
  `u_praktik_nilai` enum('T','Y') NOT NULL,
  `d_praktik_nilai` enum('T','Y') NOT NULL,
  `c_arsip_praktik` enum('T','Y') NOT NULL,
  `r_arsip_praktik` enum('T','Y') NOT NULL,
  `u_arsip_praktik` enum('T','Y') NOT NULL,
  `d_arsip_praktik` enum('T','Y') NOT NULL,
  `c_pkd` enum('T','Y') NOT NULL,
  `r_pkd` enum('T','Y') NOT NULL,
  `u_pkd` enum('T','Y') NOT NULL,
  `d_pkd` enum('T','Y') NOT NULL,
  `c_logbook` enum('T','Y') NOT NULL,
  `r_logbook` enum('T','Y') NOT NULL,
  `u_logbook` enum('T','Y') NOT NULL,
  `d_logbook` enum('T','Y') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_user_privileges`
--

INSERT INTO `tb_user_privileges` (`id_user`, `c_kuota`, `r_kuota`, `u_kuota`, `d_kuota`, `c_akun`, `r_akun`, `u_akun`, `d_akun`, `c_praktik`, `r_praktik`, `u_praktik`, `d_praktik`, `c_praktikan`, `r_praktikan`, `u_praktikan`, `d_praktikan`, `c_praktik_mess`, `r_praktik_mess`, `u_praktik_mess`, `d_praktik_mess`, `c_praktik_pembimbing`, `r_praktik_pembimbing`, `u_praktik_pembimbing`, `d_praktik_pembimbing`, `c_praktik_tarif`, `r_praktik_tarif`, `u_praktik_tarif`, `d_praktik_tarif`, `c_praktik_bayar`, `r_praktik_bayar`, `u_praktik_bayar`, `d_praktik_bayar`, `c_narsum`, `r_narsum`, `u_narsum`, `d_narsum`, `c_daftar_pembimbing`, `r_daftar_pembimbing`, `u_daftar_pembimbing`, `d_daftar_pembimbing`, `c_praktik_nilai`, `r_praktik_nilai`, `u_praktik_nilai`, `d_praktik_nilai`, `c_arsip_praktik`, `r_arsip_praktik`, `u_arsip_praktik`, `d_arsip_praktik`, `c_pkd`, `r_pkd`, `u_pkd`, `d_pkd`, `c_logbook`, `r_logbook`, `u_logbook`, `d_logbook`) VALUES
(1, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

DROP TABLE IF EXISTS `test`;
CREATE TABLE `test` (
  `id` int(11) NOT NULL,
  `varchart` varchar(10) NOT NULL,
  `text` text NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`id`, `varchart`, `text`, `date`) VALUES
(7, 'd1d12', '', '2022-03-05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_akreditasi`
--
ALTER TABLE `tb_akreditasi`
  ADD PRIMARY KEY (`id_akreditasi`);

--
-- Indexes for table `tb_bayar`
--
ALTER TABLE `tb_bayar`
  ADD PRIMARY KEY (`id_bayar`);

--
-- Indexes for table `tb_institusi`
--
ALTER TABLE `tb_institusi`
  ADD PRIMARY KEY (`id_institusi`);

--
-- Indexes for table `tb_jenjang_pdd`
--
ALTER TABLE `tb_jenjang_pdd`
  ADD PRIMARY KEY (`id_jenjang_pdd`);

--
-- Indexes for table `tb_jurusan_pdd`
--
ALTER TABLE `tb_jurusan_pdd`
  ADD PRIMARY KEY (`id_jurusan_pdd`);

--
-- Indexes for table `tb_jurusan_pdd_jenis`
--
ALTER TABLE `tb_jurusan_pdd_jenis`
  ADD PRIMARY KEY (`id_jurusan_pdd_jenis`);

--
-- Indexes for table `tb_jurusan_pdd_jenjang`
--
ALTER TABLE `tb_jurusan_pdd_jenjang`
  ADD PRIMARY KEY (`id_jurusan_pdd_jenjang`);

--
-- Indexes for table `tb_jurusan_pdd_jenjang_profesi`
--
ALTER TABLE `tb_jurusan_pdd_jenjang_profesi`
  ADD PRIMARY KEY (`id_jurusan_pdd_jenjang`);

--
-- Indexes for table `tb_kep_nilai`
--
ALTER TABLE `tb_kep_nilai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_kep_nilai_data`
--
ALTER TABLE `tb_kep_nilai_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_kep_nil_dokaskep`
--
ALTER TABLE `tb_kep_nil_dokaskep`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_kep_nil_lap_pen`
--
ALTER TABLE `tb_kep_nil_lap_pen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_kep_nil_sikapprilaku`
--
ALTER TABLE `tb_kep_nil_sikapprilaku`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_kep_nil_sptk`
--
ALTER TABLE `tb_kep_nil_sptk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_kep_nil_terakkel`
--
ALTER TABLE `tb_kep_nil_terakkel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_kerjasama`
--
ALTER TABLE `tb_kerjasama`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_kuesioner_jawaban`
--
ALTER TABLE `tb_kuesioner_jawaban`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_kuesioner_pertanyaan`
--
ALTER TABLE `tb_kuesioner_pertanyaan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_kuesioner_sarpras`
--
ALTER TABLE `tb_kuesioner_sarpras`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_kuesioner_sarpras_jawaban`
--
ALTER TABLE `tb_kuesioner_sarpras_jawaban`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_kuota`
--
ALTER TABLE `tb_kuota`
  ADD PRIMARY KEY (`id_kuota`);

--
-- Indexes for table `tb_lapor`
--
ALTER TABLE `tb_lapor`
  ADD PRIMARY KEY (`id_lapor`);

--
-- Indexes for table `tb_logbook_ked_coass_jkh`
--
ALTER TABLE `tb_logbook_ked_coass_jkh`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_logbook_ked_coass_kyd`
--
ALTER TABLE `tb_logbook_ked_coass_kyd`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_logbook_ked_coass_lppp`
--
ALTER TABLE `tb_logbook_ked_coass_lppp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_logbook_ked_coass_lppp_ket`
--
ALTER TABLE `tb_logbook_ked_coass_lppp_ket`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_logbook_ked_coass_materi`
--
ALTER TABLE `tb_logbook_ked_coass_materi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_logbook_ked_coass_p3d`
--
ALTER TABLE `tb_logbook_ked_coass_p3d`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_logbook_ked_coass_psw`
--
ALTER TABLE `tb_logbook_ked_coass_psw`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_logbook_ked_residen_jkh`
--
ALTER TABLE `tb_logbook_ked_residen_jkh`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_logbook_ked_residen_pi`
--
ALTER TABLE `tb_logbook_ked_residen_pi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_logbook_ked_residen_pkd`
--
ALTER TABLE `tb_logbook_ked_residen_pkd`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_logbook_ked_residen_pkd_jenis`
--
ALTER TABLE `tb_logbook_ked_residen_pkd_jenis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_logbook_kep_kompetensi`
--
ALTER TABLE `tb_logbook_kep_kompetensi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_logbook_kep_kompetensi_nama`
--
ALTER TABLE `tb_logbook_kep_kompetensi_nama`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_mess`
--
ALTER TABLE `tb_mess`
  ADD PRIMARY KEY (`id_mess`);

--
-- Indexes for table `tb_mess_pilih`
--
ALTER TABLE `tb_mess_pilih`
  ADD PRIMARY KEY (`id_mess_pilih`);

--
-- Indexes for table `tb_mess_tgl`
--
ALTER TABLE `tb_mess_tgl`
  ADD PRIMARY KEY (`id_mess_tgl`);

--
-- Indexes for table `tb_mou`
--
ALTER TABLE `tb_mou`
  ADD PRIMARY KEY (`id_mou`);

--
-- Indexes for table `tb_nilai_ked_coass`
--
ALTER TABLE `tb_nilai_ked_coass`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_nilai_kep`
--
ALTER TABLE `tb_nilai_kep`
  ADD PRIMARY KEY (`id_nilai_kep`);

--
-- Indexes for table `tb_nilai_upload`
--
ALTER TABLE `tb_nilai_upload`
  ADD PRIMARY KEY (`id_nilai_upload`);

--
-- Indexes for table `tb_pembimbing`
--
ALTER TABLE `tb_pembimbing`
  ADD PRIMARY KEY (`id_pembimbing`);

--
-- Indexes for table `tb_pembimbing_jenis`
--
ALTER TABLE `tb_pembimbing_jenis`
  ADD PRIMARY KEY (`id_pembimbing_jenis`);

--
-- Indexes for table `tb_pembimbing_pilih`
--
ALTER TABLE `tb_pembimbing_pilih`
  ADD PRIMARY KEY (`id_pembimbing_pilih`);

--
-- Indexes for table `tb_pertanyaan`
--
ALTER TABLE `tb_pertanyaan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_pkd`
--
ALTER TABLE `tb_pkd`
  ADD PRIMARY KEY (`id_pkd`);

--
-- Indexes for table `tb_pkd_tarif`
--
ALTER TABLE `tb_pkd_tarif`
  ADD PRIMARY KEY (`id_pkd_tarif`);

--
-- Indexes for table `tb_praktik`
--
ALTER TABLE `tb_praktik`
  ADD PRIMARY KEY (`id_praktik`);

--
-- Indexes for table `tb_praktikan`
--
ALTER TABLE `tb_praktikan`
  ADD PRIMARY KEY (`id_praktikan`);

--
-- Indexes for table `tb_praktik_mess_alasan`
--
ALTER TABLE `tb_praktik_mess_alasan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_praktik_tgl`
--
ALTER TABLE `tb_praktik_tgl`
  ADD PRIMARY KEY (`id_praktik_tgl`);

--
-- Indexes for table `tb_profesi_pdd`
--
ALTER TABLE `tb_profesi_pdd`
  ADD PRIMARY KEY (`id_profesi_pdd`);

--
-- Indexes for table `tb_tarif`
--
ALTER TABLE `tb_tarif`
  ADD PRIMARY KEY (`id_tarif`);

--
-- Indexes for table `tb_tarif_jenis`
--
ALTER TABLE `tb_tarif_jenis`
  ADD PRIMARY KEY (`id_tarif_jenis`);

--
-- Indexes for table `tb_tarif_pilih`
--
ALTER TABLE `tb_tarif_pilih`
  ADD PRIMARY KEY (`id_tarif_pilih`);

--
-- Indexes for table `tb_tarif_satuan`
--
ALTER TABLE `tb_tarif_satuan`
  ADD PRIMARY KEY (`id_tarif_satuan`);

--
-- Indexes for table `tb_tempat`
--
ALTER TABLE `tb_tempat`
  ADD PRIMARY KEY (`id_tempat`);

--
-- Indexes for table `tb_tempat_pilih`
--
ALTER TABLE `tb_tempat_pilih`
  ADD PRIMARY KEY (`id_tempat_pilih`);

--
-- Indexes for table `tb_unit`
--
ALTER TABLE `tb_unit`
  ADD PRIMARY KEY (`id_unit`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `tb_user_privileges`
--
ALTER TABLE `tb_user_privileges`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_akreditasi`
--
ALTER TABLE `tb_akreditasi`
  MODIFY `id_akreditasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_bayar`
--
ALTER TABLE `tb_bayar`
  MODIFY `id_bayar` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_institusi`
--
ALTER TABLE `tb_institusi`
  MODIFY `id_institusi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `tb_jenjang_pdd`
--
ALTER TABLE `tb_jenjang_pdd`
  MODIFY `id_jenjang_pdd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tb_jurusan_pdd`
--
ALTER TABLE `tb_jurusan_pdd`
  MODIFY `id_jurusan_pdd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tb_jurusan_pdd_jenis`
--
ALTER TABLE `tb_jurusan_pdd_jenis`
  MODIFY `id_jurusan_pdd_jenis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_jurusan_pdd_jenjang`
--
ALTER TABLE `tb_jurusan_pdd_jenjang`
  MODIFY `id_jurusan_pdd_jenjang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `tb_kep_nilai`
--
ALTER TABLE `tb_kep_nilai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `tb_kep_nilai_data`
--
ALTER TABLE `tb_kep_nilai_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_kep_nil_dokaskep`
--
ALTER TABLE `tb_kep_nil_dokaskep`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_kep_nil_lap_pen`
--
ALTER TABLE `tb_kep_nil_lap_pen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_kep_nil_sikapprilaku`
--
ALTER TABLE `tb_kep_nil_sikapprilaku`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_kep_nil_sptk`
--
ALTER TABLE `tb_kep_nil_sptk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_kep_nil_terakkel`
--
ALTER TABLE `tb_kep_nil_terakkel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_kerjasama`
--
ALTER TABLE `tb_kerjasama`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_kuesioner_jawaban`
--
ALTER TABLE `tb_kuesioner_jawaban`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `tb_kuesioner_pertanyaan`
--
ALTER TABLE `tb_kuesioner_pertanyaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tb_kuesioner_sarpras`
--
ALTER TABLE `tb_kuesioner_sarpras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_kuesioner_sarpras_jawaban`
--
ALTER TABLE `tb_kuesioner_sarpras_jawaban`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_kuota`
--
ALTER TABLE `tb_kuota`
  MODIFY `id_kuota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_lapor`
--
ALTER TABLE `tb_lapor`
  MODIFY `id_lapor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_logbook_ked_coass_jkh`
--
ALTER TABLE `tb_logbook_ked_coass_jkh`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_logbook_ked_coass_kyd`
--
ALTER TABLE `tb_logbook_ked_coass_kyd`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_logbook_ked_coass_lppp`
--
ALTER TABLE `tb_logbook_ked_coass_lppp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_logbook_ked_coass_lppp_ket`
--
ALTER TABLE `tb_logbook_ked_coass_lppp_ket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_logbook_ked_coass_materi`
--
ALTER TABLE `tb_logbook_ked_coass_materi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_logbook_ked_coass_p3d`
--
ALTER TABLE `tb_logbook_ked_coass_p3d`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_logbook_ked_coass_psw`
--
ALTER TABLE `tb_logbook_ked_coass_psw`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_logbook_ked_residen_jkh`
--
ALTER TABLE `tb_logbook_ked_residen_jkh`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_logbook_ked_residen_pi`
--
ALTER TABLE `tb_logbook_ked_residen_pi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_logbook_ked_residen_pkd`
--
ALTER TABLE `tb_logbook_ked_residen_pkd`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_logbook_ked_residen_pkd_jenis`
--
ALTER TABLE `tb_logbook_ked_residen_pkd_jenis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_logbook_kep_kompetensi`
--
ALTER TABLE `tb_logbook_kep_kompetensi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_logbook_kep_kompetensi_nama`
--
ALTER TABLE `tb_logbook_kep_kompetensi_nama`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_mess`
--
ALTER TABLE `tb_mess`
  MODIFY `id_mess` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_mess_pilih`
--
ALTER TABLE `tb_mess_pilih`
  MODIFY `id_mess_pilih` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_mess_tgl`
--
ALTER TABLE `tb_mess_tgl`
  MODIFY `id_mess_tgl` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_mou`
--
ALTER TABLE `tb_mou`
  MODIFY `id_mou` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `tb_nilai_ked_coass`
--
ALTER TABLE `tb_nilai_ked_coass`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tb_nilai_kep`
--
ALTER TABLE `tb_nilai_kep`
  MODIFY `id_nilai_kep` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_nilai_upload`
--
ALTER TABLE `tb_nilai_upload`
  MODIFY `id_nilai_upload` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_pembimbing`
--
ALTER TABLE `tb_pembimbing`
  MODIFY `id_pembimbing` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `tb_pembimbing_jenis`
--
ALTER TABLE `tb_pembimbing_jenis`
  MODIFY `id_pembimbing_jenis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tb_pembimbing_pilih`
--
ALTER TABLE `tb_pembimbing_pilih`
  MODIFY `id_pembimbing_pilih` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_pertanyaan`
--
ALTER TABLE `tb_pertanyaan`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `tb_pkd`
--
ALTER TABLE `tb_pkd`
  MODIFY `id_pkd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_pkd_tarif`
--
ALTER TABLE `tb_pkd_tarif`
  MODIFY `id_pkd_tarif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_praktik`
--
ALTER TABLE `tb_praktik`
  MODIFY `id_praktik` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_praktikan`
--
ALTER TABLE `tb_praktikan`
  MODIFY `id_praktikan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_praktik_mess_alasan`
--
ALTER TABLE `tb_praktik_mess_alasan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_praktik_tgl`
--
ALTER TABLE `tb_praktik_tgl`
  MODIFY `id_praktik_tgl` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_profesi_pdd`
--
ALTER TABLE `tb_profesi_pdd`
  MODIFY `id_profesi_pdd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_tarif`
--
ALTER TABLE `tb_tarif`
  MODIFY `id_tarif` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_tarif_jenis`
--
ALTER TABLE `tb_tarif_jenis`
  MODIFY `id_tarif_jenis` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_tarif_pilih`
--
ALTER TABLE `tb_tarif_pilih`
  MODIFY `id_tarif_pilih` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_tarif_satuan`
--
ALTER TABLE `tb_tarif_satuan`
  MODIFY `id_tarif_satuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tb_tempat`
--
ALTER TABLE `tb_tempat`
  MODIFY `id_tempat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tb_tempat_pilih`
--
ALTER TABLE `tb_tempat_pilih`
  MODIFY `id_tempat_pilih` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=470;

--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
