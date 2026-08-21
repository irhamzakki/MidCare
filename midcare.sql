-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 17, 2026 at 06:17 AM
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
-- Database: `midcare`
--

-- --------------------------------------------------------

--
-- Table structure for table `artikels`
--

CREATE TABLE `artikels` (
  `id` bigint UNSIGNED NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ringkasan` text COLLATE utf8mb4_unicode_ci,
  `isi` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('Publish','Draft') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Draft',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `edukasis`
--

CREATE TABLE `edukasis` (
  `id` bigint UNSIGNED NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ringkasan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `narasi` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Aktif',
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fitur_pengguna`
--

CREATE TABLE `fitur_pengguna` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `usia` int DEFAULT NULL,
  `jenis_kelamin` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `orangtua` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rasional` tinyint DEFAULT NULL COMMENT '1=Sangat Tidak Setuju, 5=Sangat Setuju',
  `mampu_menyelesaikan_masalah_sendiri` tinyint DEFAULT NULL,
  `mudah_putus_asa` tinyint DEFAULT NULL,
  `emosional` tinyint DEFAULT NULL,
  `mengontrol_emosi` tinyint DEFAULT NULL,
  `agresif` tinyint DEFAULT NULL,
  `diam_marah` tinyint DEFAULT NULL,
  `kontrol_fisik` tinyint DEFAULT NULL,
  `emosi_tidak_terkontrol` tinyint DEFAULT NULL,
  `fisik_sulit_dikontrol` tinyint DEFAULT NULL,
  `perilaku_baik_situasi_rumit` tinyint DEFAULT NULL,
  `tenang_saat_emosi` tinyint DEFAULT NULL,
  `kontrol_diri_saat_emosi` tinyint DEFAULT NULL,
  `kontrol_bicara` tinyint DEFAULT NULL,
  `tingkah_tidak_terkontrol` tinyint DEFAULT NULL,
  `nilai_emosi` tinyint DEFAULT NULL,
  `terima_peristiwa` tinyint DEFAULT NULL,
  `cari_dukungan` tinyint DEFAULT NULL,
  `tidak_terima_peristiwa` tinyint DEFAULT NULL,
  `terima_peristiwa_buruk` tinyint DEFAULT NULL,
  `ubah_mindset` tinyint DEFAULT NULL,
  `terima_emosi` tinyint DEFAULT NULL,
  `tidak_malu_menangis` tinyint DEFAULT NULL,
  `tidak_terima_emosi` tinyint DEFAULT NULL,
  `malu_menangis` tinyint DEFAULT NULL,
  `ayah_hargai_perasaan` tinyint DEFAULT NULL,
  `ayah_baik` tinyint DEFAULT NULL,
  `ingin_ortu_berbeda` tinyint DEFAULT NULL,
  `ayah_terima_saya` tinyint DEFAULT NULL,
  `senang_masukan_ayah` tinyint DEFAULT NULL,
  `percuma_perlihatkan_ayah` tinyint DEFAULT NULL,
  `ayah_tahu_marah` tinyint DEFAULT NULL,
  `malu_bodoh_dengan_ayah` tinyint DEFAULT NULL,
  `ayah_hargai_pendapat` tinyint DEFAULT NULL,
  `ayah_percaya_saya` tinyint DEFAULT NULL,
  `tak_mau_merepotkan_ayah` tinyint DEFAULT NULL,
  `ayah_bantu_pahami` tinyint DEFAULT NULL,
  `cerita_pada_ayah` tinyint DEFAULT NULL,
  `kurang_perhatian_ayah` tinyint DEFAULT NULL,
  `ayah_dorong_cerita` tinyint DEFAULT NULL,
  `ayah_pahami_saya` tinyint DEFAULT NULL,
  `ayah_pahami_marah` tinyint DEFAULT NULL,
  `percaya_ayah` tinyint DEFAULT NULL,
  `ayah_tidak_paham` tinyint DEFAULT NULL,
  `ayah_tidak_bisa_diandalkan` tinyint DEFAULT NULL,
  `ayah_peduli` tinyint DEFAULT NULL,
  `ibu_hargai_perasaan` tinyint DEFAULT NULL,
  `ibu_baik` tinyint DEFAULT NULL,
  `ingin_ibu_berbeda` tinyint DEFAULT NULL,
  `ibu_terima_saya` tinyint DEFAULT NULL,
  `senang_masukan_ibu` tinyint DEFAULT NULL,
  `percuma_perlihatkan_ibu` tinyint DEFAULT NULL,
  `ibu_tahu_marah` tinyint DEFAULT NULL,
  `malu_bodoh_dengan_ibu` tinyint DEFAULT NULL,
  `gundah_dengan_ibu` tinyint DEFAULT NULL,
  `ibu_tahu_sedikit` tinyint DEFAULT NULL,
  `ibu_hargai_pendapat` tinyint DEFAULT NULL,
  `ibu_percaya_saya` tinyint DEFAULT NULL,
  `tak_mau_repotkan_ibu` tinyint DEFAULT NULL,
  `ibu_bantu_pahami` tinyint DEFAULT NULL,
  `cerita_ibu` tinyint DEFAULT NULL,
  `marah_dengan_ibu` tinyint DEFAULT NULL,
  `kurang_perhatian_ibu` tinyint DEFAULT NULL,
  `ibu_dorong_cerita` tinyint DEFAULT NULL,
  `ibu_pahami_saya` tinyint DEFAULT NULL,
  `ibu_pahami_marah_saya` tinyint DEFAULT NULL,
  `percaya_ibu` tinyint DEFAULT NULL,
  `ibu_tidak_paham` tinyint DEFAULT NULL,
  `ibu_tidak_bisa_diandalkan` tinyint DEFAULT NULL,
  `ibu_peduli` tinyint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fitur_pengguna`
--

INSERT INTO `fitur_pengguna` (`id`, `nama`, `usia`, `jenis_kelamin`, `orangtua`, `rasional`, `mampu_menyelesaikan_masalah_sendiri`, `mudah_putus_asa`, `emosional`, `mengontrol_emosi`, `agresif`, `diam_marah`, `kontrol_fisik`, `emosi_tidak_terkontrol`, `fisik_sulit_dikontrol`, `perilaku_baik_situasi_rumit`, `tenang_saat_emosi`, `kontrol_diri_saat_emosi`, `kontrol_bicara`, `tingkah_tidak_terkontrol`, `nilai_emosi`, `terima_peristiwa`, `cari_dukungan`, `tidak_terima_peristiwa`, `terima_peristiwa_buruk`, `ubah_mindset`, `terima_emosi`, `tidak_malu_menangis`, `tidak_terima_emosi`, `malu_menangis`, `ayah_hargai_perasaan`, `ayah_baik`, `ingin_ortu_berbeda`, `ayah_terima_saya`, `senang_masukan_ayah`, `percuma_perlihatkan_ayah`, `ayah_tahu_marah`, `malu_bodoh_dengan_ayah`, `ayah_hargai_pendapat`, `ayah_percaya_saya`, `tak_mau_merepotkan_ayah`, `ayah_bantu_pahami`, `cerita_pada_ayah`, `kurang_perhatian_ayah`, `ayah_dorong_cerita`, `ayah_pahami_saya`, `ayah_pahami_marah`, `percaya_ayah`, `ayah_tidak_paham`, `ayah_tidak_bisa_diandalkan`, `ayah_peduli`, `ibu_hargai_perasaan`, `ibu_baik`, `ingin_ibu_berbeda`, `ibu_terima_saya`, `senang_masukan_ibu`, `percuma_perlihatkan_ibu`, `ibu_tahu_marah`, `malu_bodoh_dengan_ibu`, `gundah_dengan_ibu`, `ibu_tahu_sedikit`, `ibu_hargai_pendapat`, `ibu_percaya_saya`, `tak_mau_repotkan_ibu`, `ibu_bantu_pahami`, `cerita_ibu`, `marah_dengan_ibu`, `kurang_perhatian_ibu`, `ibu_dorong_cerita`, `ibu_pahami_saya`, `ibu_pahami_marah_saya`, `percaya_ibu`, `ibu_tidak_paham`, `ibu_tidak_bisa_diandalkan`, `ibu_peduli`, `created_at`, `updated_at`) VALUES
(1, 'Ahmad Fauzan', 18, 'Laki-laki', 'Lengkap', 4, 4, 2, 3, 4, 2, 3, 4, 2, 2, 4, 4, 4, 4, 2, 4, 4, 4, 2, 4, 4, 4, 4, 2, 2, 4, 5, 2, 5, 4, 2, 4, 2, 5, 5, 2, 4, 3, 2, 4, 5, 4, 5, 2, 2, 5, 5, 5, 2, 5, 5, 2, 4, 2, 2, 3, 5, 5, 2, 5, 4, 2, 2, 4, 5, 5, 5, 2, 2, 5, '2026-08-17 02:46:06', '2026-08-17 02:46:06'),
(2, 'Siti Aisyah', 19, 'Perempuan', 'Lengkap', 5, 5, 1, 2, 5, 1, 2, 5, 1, 1, 5, 5, 5, 5, 1, 5, 5, 5, 1, 5, 5, 5, 5, 1, 1, 5, 5, 1, 5, 5, 1, 5, 1, 5, 5, 1, 5, 4, 1, 5, 5, 5, 5, 1, 1, 5, 5, 5, 1, 5, 5, 1, 5, 1, 1, 2, 5, 5, 1, 5, 5, 1, 1, 5, 5, 5, 5, 1, 1, 5, '2026-08-17 02:46:06', '2026-08-17 02:46:06'),
(3, 'Rizky Pratama', 20, 'Laki-laki', 'Berpisah', 3, 3, 4, 4, 3, 4, 4, 3, 4, 4, 3, 3, 3, 3, 4, 3, 3, 3, 4, 3, 3, 3, 3, 4, 4, 3, 3, 4, 3, 3, 4, 3, 4, 3, 3, 4, 3, 2, 4, 3, 3, 3, 3, 4, 4, 3, 3, 3, 4, 3, 3, 4, 3, 4, 4, 4, 3, 3, 4, 3, 3, 4, 4, 3, 3, 3, 3, 4, 4, 3, '2026-08-17 02:46:06', '2026-08-17 02:46:06'),
(4, 'Dewi Lestari', 17, 'Perempuan', 'Lengkap', 4, 5, 2, 3, 4, 2, 3, 4, 2, 2, 5, 4, 5, 5, 2, 5, 5, 5, 2, 5, 4, 5, 5, 2, 2, 5, 5, 2, 5, 5, 2, 5, 2, 5, 5, 2, 5, 4, 2, 5, 5, 5, 5, 2, 2, 5, 5, 5, 2, 5, 5, 2, 4, 2, 2, 3, 5, 5, 2, 5, 5, 2, 2, 5, 5, 5, 5, 2, 2, 5, '2026-08-17 02:46:06', '2026-08-17 02:46:06'),
(5, 'Bima Saputra', 21, 'Laki-laki', 'Salah satu wafat', 2, 2, 5, 5, 2, 5, 4, 2, 5, 5, 2, 2, 2, 2, 5, 2, 2, 2, 5, 2, 2, 2, 2, 5, 5, 2, 2, 5, 2, 2, 5, 2, 5, 2, 2, 5, 2, 1, 5, 2, 2, 2, 2, 5, 5, 2, 2, 2, 5, 2, 2, 5, 2, 5, 5, 5, 2, 2, 5, 2, 2, 5, 5, 2, 2, 2, 2, 5, 5, 2, '2026-08-17 02:46:06', '2026-08-17 02:46:06'),
(6, 'Nabila Putri', 16, 'Perempuan', 'Lengkap', 5, 4, 2, 2, 5, 1, 2, 5, 1, 1, 5, 5, 5, 5, 1, 5, 5, 5, 1, 5, 5, 5, 5, 1, 1, 5, 5, 1, 5, 5, 1, 5, 1, 5, 5, 1, 5, 4, 1, 5, 5, 5, 5, 1, 1, 5, 5, 5, 1, 5, 5, 1, 5, 1, 1, 2, 5, 5, 1, 5, 5, 1, 1, 5, 5, 5, 5, 1, 1, 5, '2026-08-17 02:46:06', '2026-08-17 02:46:06'),
(7, 'Yoga Firmansyah', 22, 'Laki-laki', 'Berpisah', 3, 4, 3, 4, 3, 4, 3, 3, 4, 3, 3, 3, 3, 3, 4, 3, 3, 3, 4, 3, 3, 3, 3, 4, 4, 3, 3, 4, 3, 3, 4, 3, 4, 3, 3, 4, 3, 2, 4, 3, 3, 3, 3, 4, 4, 3, 3, 3, 4, 3, 3, 4, 3, 4, 4, 4, 3, 3, 4, 3, 3, 4, 4, 3, 3, 3, 3, 4, 4, 3, '2026-08-17 02:46:06', '2026-08-17 02:46:06'),
(8, 'Laras Anggraini', 15, 'Perempuan', 'Lengkap', 5, 5, 1, 2, 5, 1, 2, 5, 1, 1, 5, 5, 5, 5, 1, 5, 5, 5, 1, 5, 5, 5, 5, 1, 1, 5, 5, 1, 5, 5, 1, 5, 1, 5, 5, 1, 5, 4, 1, 5, 5, 5, 5, 1, 1, 5, 5, 5, 1, 5, 5, 1, 5, 1, 1, 2, 5, 5, 1, 5, 5, 1, 1, 5, 5, 5, 5, 1, 1, 5, '2026-08-17 02:46:06', '2026-08-17 02:46:06'),
(9, 'Fajar Hidayat', 23, 'Laki-laki', 'Lengkap', 4, 4, 2, 3, 4, 2, 3, 4, 2, 2, 4, 4, 4, 4, 2, 4, 4, 4, 2, 4, 4, 4, 4, 2, 2, 4, 5, 2, 5, 4, 2, 4, 2, 5, 5, 2, 4, 3, 2, 4, 5, 4, 5, 2, 2, 5, 5, 5, 2, 5, 5, 2, 4, 2, 2, 3, 5, 5, 2, 5, 4, 2, 2, 4, 5, 5, 5, 2, 2, 5, '2026-08-17 02:46:06', '2026-08-17 02:46:06'),
(10, 'Maya Kartika', 18, 'Perempuan', 'Salah satu wafat', 2, 2, 5, 5, 2, 5, 4, 2, 5, 5, 2, 2, 2, 2, 5, 2, 2, 2, 5, 2, 2, 2, 2, 5, 5, 2, 2, 5, 2, 2, 5, 2, 5, 2, 2, 5, 2, 1, 5, 2, 2, 2, 2, 5, 5, 2, 2, 2, 5, 2, 2, 5, 2, 5, 5, 5, 2, 2, 5, 2, 2, 5, 5, 2, 2, 2, 2, 5, 5, 2, '2026-08-17 02:46:06', '2026-08-17 02:46:06'),
(11, 'yanto', 22, 'Laki-laki', 'lengkap', 3, 3, 4, 4, 2, 1, 2, 2, 3, 3, 2, 2, 5, 5, 5, 5, 4, 3, 3, 3, 3, 2, 4, 2, 3, 5, 2, 2, 2, 4, 3, 1, 1, 4, 3, 4, 4, 3, 4, 5, 4, 3, 3, 4, 4, 2, 1, 3, 5, 5, 4, 3, 3, 4, 5, 4, 3, 3, 4, 5, 5, 4, 3, 3, 3, 3, 3, 4, 4, 3, '2026-08-16 22:38:41', '2026-08-16 22:38:41');

-- --------------------------------------------------------

--
-- Table structure for table `hasil_clusterings`
--

CREATE TABLE `hasil_clusterings` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `fitur_pengguna_id` bigint UNSIGNED NOT NULL,
  `cluster` int NOT NULL COMMENT 'Hasil clustering dari K-Means',
  `tingkat_risiko` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Kategori risiko dari cluster',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2026_06_07_070142_create_edukasis_table', 1),
(6, '2026_06_07_145855_create_pasiens_table', 1),
(7, '2026_06_08_073800_create_artikels_table', 1),
(8, '2026_06_08_152405_create_screenings_table', 1),
(9, '2026_07_17_170850_create_fitur_pengguna_table', 1),
(10, '2026_08_08_000000_add_role_to_users_table', 1),
(11, '2026_08_12_142635_add_psikolog_fields_to_users_table', 1),
(12, '2026_08_13_152846_create_hasil_clusterings_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pasiens`
--

CREATE TABLE `pasiens` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `usia` int DEFAULT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('Siswa','Mahasiswa','Umum') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_screening` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Belum Screening',
  `risiko_terakhir` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `screenings`
--

CREATE TABLE `screenings` (
  `id` bigint UNSIGNED NOT NULL,
  `pasien_id` bigint UNSIGNED NOT NULL,
  `skor_total` int NOT NULL DEFAULT '0',
  `kategori_risiko` enum('Ringan','Sedang','Berat') COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Selesai',
  `catatan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `role` enum('pasien','psikolog','admin') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pasien',
  `spesialisasi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_str` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `spesialisasi`, `no_str`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'admin@gmail.com', '2026-08-16 18:59:53', '$2y$12$nkH2dscmqz47bWdtZLkS3eFxQsZRb1x7i.fcRSmKx.W8mS67El.eC', 'admin', NULL, NULL, NULL, '2026-08-16 18:59:53', '2026-08-16 18:59:53'),
(2, 'Psikolog Tester', 'psikolog@gmail.com', '2026-08-16 18:59:54', '$2y$12$EuGJwmi/AhqiXz43UFRb9OWHBpBcFRI9m7Ad245xtPBTWSRJFSctu', 'psikolog', 'Kesehatan Mental', 'STR-PSIKOLOG-001', NULL, '2026-08-16 18:59:54', '2026-08-16 18:59:54'),
(3, 'Pasien Tester', 'pasien@gmail.com', '2026-08-16 18:59:54', '$2y$12$iAxIyoR1Y3DUGnnUgWfaOOSbocZkxGn2jGMqfLia1vsbbZmElwIxW', 'pasien', NULL, NULL, NULL, '2026-08-16 18:59:54', '2026-08-16 18:59:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `artikels`
--
ALTER TABLE `artikels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `edukasis`
--
ALTER TABLE `edukasis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `fitur_pengguna`
--
ALTER TABLE `fitur_pengguna`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hasil_clusterings`
--
ALTER TABLE `hasil_clusterings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hasil_clusterings_user_id_foreign` (`user_id`),
  ADD KEY `hasil_clusterings_fitur_pengguna_id_foreign` (`fitur_pengguna_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pasiens`
--
ALTER TABLE `pasiens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pasiens_email_unique` (`email`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `screenings`
--
ALTER TABLE `screenings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `screenings_pasien_id_foreign` (`pasien_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `artikels`
--
ALTER TABLE `artikels`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `edukasis`
--
ALTER TABLE `edukasis`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fitur_pengguna`
--
ALTER TABLE `fitur_pengguna`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `hasil_clusterings`
--
ALTER TABLE `hasil_clusterings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `pasiens`
--
ALTER TABLE `pasiens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `screenings`
--
ALTER TABLE `screenings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `hasil_clusterings`
--
ALTER TABLE `hasil_clusterings`
  ADD CONSTRAINT `hasil_clusterings_fitur_pengguna_id_foreign` FOREIGN KEY (`fitur_pengguna_id`) REFERENCES `fitur_pengguna` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `hasil_clusterings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `screenings`
--
ALTER TABLE `screenings`
  ADD CONSTRAINT `screenings_pasien_id_foreign` FOREIGN KEY (`pasien_id`) REFERENCES `pasiens` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
