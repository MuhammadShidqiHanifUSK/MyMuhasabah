-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 20, 2026 at 04:07 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mymuhasabah`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-haniftes1@gmail.com|127.0.0.1', 'i:1;', 1780159430),
('laravel-cache-haniftes1@gmail.com|127.0.0.1:timer', 'i:1780159430;', 1780159430);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` varchar(255) NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` smallint(5) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_05_28_061515_create_muhasabahs_table', 2),
(5, '2026_05_28_061520_create_trackers_table', 2),
(6, '2026_05_28_064236_add_fields_to_users_table', 3),
(7, '2026_05_29_123313_update_tracker_sholat_and_tilawah', 4);

-- --------------------------------------------------------

--
-- Table structure for table `muhasabahs`
--

CREATE TABLE `muhasabahs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `mood` varchar(255) DEFAULT NULL,
  `tanggal` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `muhasabahs`
--

INSERT INTO `muhasabahs` (`id`, `user_id`, `title`, `content`, `mood`, `tanggal`, `created_at`, `updated_at`) VALUES
(1, 3, 'Day 1', 'Alhamdulillah', 'tenang', '2026-05-28', '2026-05-28 04:09:14', '2026-05-28 04:09:14'),
(2, 3, 'Hari yang penuh syukur', 'Alhamdulillah dapat THR :)', 'bersyukur', '2026-05-28', '2026-05-28 04:27:12', '2026-05-28 04:27:12'),
(3, 1, 'Hari Jumat', 'Alhamdulillah tadi pas solat jumat ketemu kawan di masjid oman :)', 'tenang', '2026-05-29', '2026-05-29 05:31:09', '2026-05-29 05:31:09'),
(4, 1, 'Dapat THR', 'Alhamdulillah dapat THR :)', 'bersyukur', '2026-05-30', '2026-05-29 22:27:27', '2026-05-29 22:28:13'),
(5, 1, 'Makan2', 'Alhamdulillah bisa makan2', 'bersyukur', '2026-05-29', '2026-05-29 22:52:29', '2026-05-29 22:52:29'),
(6, 1, 'Hari Raya Idhul Adha', 'Alhamdulillah udah hari raya, makan enak, dapat thr jg yeahh :)', 'bersyukur', '2026-05-27', '2026-05-29 23:16:59', '2026-05-29 23:16:59'),
(7, 1, 'Hari yang melelahkan', 'Yassalam banyak x tugas projectt :(', 'gelisah', '2026-05-31', '2026-05-31 00:50:36', '2026-05-31 00:50:36');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('DvAsIaRyBzBmjpVQMMv0gktv3CilMM6RMmXD5sCY', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJOTVRDd3REb1pRcXRUQldGN29QRWcwZlc2MUVKcFU1cG05OGRkOWhIIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvMTI3LjAuMC4xOjgwMDAiLCJyb3V0ZSI6bnVsbH19', 1780537627),
('owe8kUjyv1pHUdRu9BSk1VxivadCSjHqUNTBjz7o', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiIxeTdmWHBLMHV0aXdYb1pBbzlsbllsZnJBZ3Q3MVdReUR0aXZhcEZRIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvMTI3LjAuMC4xOjgwMDBcL2Rhc2hib2FyZCIsInJvdXRlIjoiZGFzaGJvYXJkIn0sImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjoyfQ==', 1780161860),
('PiTcGbk7HyIGKDAzgxVzrhvVCFD8LwY26Tgyv37k', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJFeGQ5a0ZYOVMwS09CNTBpMFdJUlA2aXNnYkZySlZsRlo3NklGSzdWIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvMTI3LjAuMC4xOjgwMDAiLCJyb3V0ZSI6bnVsbH19', 1780215982);

-- --------------------------------------------------------

--
-- Table structure for table `trackers`
--

CREATE TABLE `trackers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `shubuh` varchar(255) DEFAULT NULL,
  `dzuhur` varchar(255) DEFAULT NULL,
  `ashar` varchar(255) DEFAULT NULL,
  `maghrib` varchar(255) DEFAULT NULL,
  `isya` varchar(255) DEFAULT NULL,
  `sunnah_qabliyah_shubuh` tinyint(1) NOT NULL DEFAULT 0,
  `sunnah_qabliyah_dzuhur` tinyint(1) NOT NULL DEFAULT 0,
  `sunnah_badiyah_dzuhur` tinyint(1) NOT NULL DEFAULT 0,
  `sunnah_qabliyah_ashar` tinyint(1) NOT NULL DEFAULT 0,
  `sunnah_qabliyah_maghrib` tinyint(1) NOT NULL DEFAULT 0,
  `sunnah_badiyah_maghrib` tinyint(1) NOT NULL DEFAULT 0,
  `sunnah_qabliyah_isya` tinyint(1) NOT NULL DEFAULT 0,
  `sunnah_badiyah_isya` tinyint(1) NOT NULL DEFAULT 0,
  `tahajud` tinyint(1) NOT NULL DEFAULT 0,
  `dhuha` tinyint(1) NOT NULL DEFAULT 0,
  `witir` tinyint(1) NOT NULL DEFAULT 0,
  `tilawah` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `dzikir_pagi` tinyint(1) NOT NULL DEFAULT 0,
  `dzikir_petang` tinyint(1) NOT NULL DEFAULT 0,
  `puasa_sunnah` tinyint(1) NOT NULL DEFAULT 0,
  `sedekah` tinyint(1) NOT NULL DEFAULT 0,
  `membantu_orang` tinyint(1) NOT NULL DEFAULT 0,
  `silaturahmi` tinyint(1) NOT NULL DEFAULT 0,
  `berkata_kotor` tinyint(1) NOT NULL DEFAULT 0,
  `berbohong` tinyint(1) NOT NULL DEFAULT 0,
  `ghibah` tinyint(1) NOT NULL DEFAULT 0,
  `berkata_kasar` tinyint(1) NOT NULL DEFAULT 0,
  `merokok` tinyint(1) NOT NULL DEFAULT 0,
  `begadang_siasia` tinyint(1) NOT NULL DEFAULT 0,
  `scrolling_berlebihan` tinyint(1) NOT NULL DEFAULT 0,
  `marah_berlebihan` tinyint(1) NOT NULL DEFAULT 0,
  `iri_dengki` tinyint(1) NOT NULL DEFAULT 0,
  `sombong` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trackers`
--

INSERT INTO `trackers` (`id`, `user_id`, `tanggal`, `shubuh`, `dzuhur`, `ashar`, `maghrib`, `isya`, `sunnah_qabliyah_shubuh`, `sunnah_qabliyah_dzuhur`, `sunnah_badiyah_dzuhur`, `sunnah_qabliyah_ashar`, `sunnah_qabliyah_maghrib`, `sunnah_badiyah_maghrib`, `sunnah_qabliyah_isya`, `sunnah_badiyah_isya`, `tahajud`, `dhuha`, `witir`, `tilawah`, `dzikir_pagi`, `dzikir_petang`, `puasa_sunnah`, `sedekah`, `membantu_orang`, `silaturahmi`, `berkata_kotor`, `berbohong`, `ghibah`, `berkata_kasar`, `merokok`, `begadang_siasia`, `scrolling_berlebihan`, `marah_berlebihan`, `iri_dengki`, `sombong`, `created_at`, `updated_at`) VALUES
(1, 1, '2026-05-29', 'tepat_waktu', 'tepat_waktu', 'tepat_waktu', 'tepat_waktu', 'tepat_waktu', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 6, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-05-29 05:29:11', '2026-05-29 23:40:16'),
(2, 1, '2026-05-28', 'tepat_waktu', 'tepat_waktu', 'tepat_waktu', 'tepat_waktu', 'tepat_waktu', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-05-29 05:29:18', '2026-05-29 23:40:10'),
(3, 1, '2026-05-30', 'tepat_waktu', 'tepat_waktu', 'tepat_waktu', 'tepat_waktu', 'tepat_waktu', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 20, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-05-29 22:06:00', '2026-05-29 23:40:24'),
(4, 1, '2026-05-27', 'tepat_waktu', 'tepat_waktu', 'tepat_waktu', 'tepat_waktu', 'tepat_waktu', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-05-29 23:23:31', '2026-05-29 23:40:05'),
(5, 1, '2026-05-26', 'terlewat', 'telat', 'telat', 'tepat_waktu', 'tepat_waktu', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-05-29 23:39:31', '2026-05-29 23:39:59'),
(6, 1, '2026-05-31', 'tepat_waktu', 'tepat_waktu', 'tepat_waktu', 'tepat_waktu', 'tepat_waktu', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 12, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2026-05-31 01:25:00', '2026-05-31 01:25:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user',
  `avatar` varchar(255) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `avatar`, `bio`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'hanif', 'haniftes@gmail.com', NULL, '$2y$12$04WlPc/G6hF5Pb.ANbWcSeuylxxsGzzcfk3VJkS1imycY06cgTV3m', 'user', NULL, NULL, NULL, '2026-05-27 23:08:58', '2026-05-27 23:08:58'),
(2, 'Admin MyMuhasabah', 'admin@gmail.com', NULL, '$2y$12$g2pDjyGiPDAVRnMw21coT.5C3agjbdIu208rbwJhq13Q1cdXBaccC', 'admin', NULL, 'Administrator sistem MyMuhasabah.', NULL, '2026-05-27 23:49:23', '2026-05-27 23:49:23'),
(3, 'Fulan 1', 'fulan@gmail.com', NULL, '$2y$12$xdgdE7RYqD/hJ1UV4Yj0/OxEWFykJQbZLYUJ/NElgvonFSjaYeG3K', 'user', NULL, 'Seorang hamba yang sedang belajar muhasabah.', NULL, '2026-05-27 23:49:23', '2026-05-27 23:49:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  ADD KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `muhasabahs`
--
ALTER TABLE `muhasabahs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `muhasabahs_user_id_foreign` (`user_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `trackers`
--
ALTER TABLE `trackers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `trackers_user_id_foreign` (`user_id`);

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
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `muhasabahs`
--
ALTER TABLE `muhasabahs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `trackers`
--
ALTER TABLE `trackers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `muhasabahs`
--
ALTER TABLE `muhasabahs`
  ADD CONSTRAINT `muhasabahs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `trackers`
--
ALTER TABLE `trackers`
  ADD CONSTRAINT `trackers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
