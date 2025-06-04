-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Jun 2025 pada 12.50
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sumbermaju`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `ID` int(10) NOT NULL,
  `Nama_Barang` varchar(50) NOT NULL,
  `Harga` int(255) NOT NULL,
  `Quantity` int(255) NOT NULL DEFAULT 0,
  `gambar` varchar(255) NOT NULL DEFAULT 'default.jpg',
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `satuan` int(11) NOT NULL,
  `supplier` int(11) DEFAULT NULL,
  `minimumbeli` int(11) NOT NULL,
  `maximumbeli` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`ID`, `Nama_Barang`, `Harga`, `Quantity`, `gambar`, `updated_at`, `created_at`, `satuan`, `supplier`, `minimumbeli`, `maximumbeli`) VALUES
(2, 'Semen Baturaja', 1000000, 942, '680bfba5fe116523bb324fc97c0e0a59.png', '2025-05-23 06:37:26', '2025-04-26 10:36:30', 2, 3, 100, 200),
(9, 'paku', 5000, 7, 'bab582e819e26b4a8daac10ecf32a88b.png', '2025-05-23 06:37:20', '2025-05-01 00:17:53', 2, 3, 10, 0),
(11, 'beton nipu', 500, 0, '0a5f0cb95b19fe17816faa26e87a7802.png', '2025-05-16 02:24:02', '2025-05-16 02:24:02', 4, NULL, 10, 100);

-- --------------------------------------------------------

--
-- Struktur dari tabel `beban`
--

CREATE TABLE `beban` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `updated_at` date NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `beban`
--

INSERT INTO `beban` (`id`, `nama`, `quantity`, `updated_at`, `created_at`) VALUES
(3, 'ARNOLDUS JULIO PRATAMA', 123456, '2025-05-09', '2025-05-09'),
(4, 'galihcool', 765432, '2025-05-09', '2025-05-09'),
(5, 'Pak Yani', 5000000, '2025-05-09', '2025-05-09');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `job_batches`
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
-- Struktur dari tabel `keranjang`
--

CREATE TABLE `keranjang` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `barang_id` int(11) NOT NULL,
  `harga` int(255) NOT NULL,
  `jumlah_barang` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_04_23_022618_create_sumbermaju_table', 1),
(5, '2025_04_23_023154_create_storages_table', 2),
(6, '2025_04_23_084625_create_settings_table', 2),
(7, '2025_04_23_084642_create_keranjang_table', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `satuan`
--

CREATE TABLE `satuan` (
  `ID` int(50) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `satuan`
--

INSERT INTO `satuan` (`ID`, `nama`, `updated_at`, `created_at`) VALUES
(2, 'Gram', '2025-05-16 01:15:14', '2025-04-22 23:30:12'),
(4, 'sak', '2025-04-26 20:19:28', '2025-04-26 20:19:28'),
(5, 'ENAK', '2025-04-26 21:08:49', '2025-04-26 21:08:41');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
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
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('gp1YkEbMzBkodSrscOMD7kxueWDNbD1TjknLvNVc', 2, '192.168.240.122', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiUnd1MVJGY256eTB0aXFDTkh2YURjTGxHcm1kT1B3SmtJTnBWcjhMNSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly8xOTIuMTY4LjI0MC4xODE6ODAwMC9TdG9yYWdlIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MjtzOjU6InRoZW1lIjtzOjY6ImFjdGl2ZSI7fQ==', 1748007261),
('IEQZqgVT3XOwZpXiyHfhWQfRpg7Mz9phyf67Sp0R', 2, '192.168.240.82', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoienBGWVhtaUR0UkthMHhwRE5BWDZxQmhnVW9pelFVZnBKMGxteW5FOCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly8xOTIuMTY4LjI0MC4xODE6ODAwMC9QaXV0YW5nIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mjt9', 1748002382),
('JIZJYGxMC0IV1FUO6slMfXaTWjUsfSK519NwcFzy', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiQjU5SEhJdzR5MW1mYWpwQldmVnJ2THJ0eURRZmM2SkZRTU5JRGpDYiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly9lcm5pLnRlc3QvcGVuZ2d1bmE/c2VhcmNoPXBha3UiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToyO3M6NToidGhlbWUiO3M6MDoiIjt9', 1748009118);

-- --------------------------------------------------------

--
-- Struktur dari tabel `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nama` varchar(100) NOT NULL,
  `jumlah` varchar(100) NOT NULL,
  `harga` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `settings`
--

INSERT INTO `settings` (`id`, `created_at`, `updated_at`, `nama`, `jumlah`, `harga`) VALUES
(5, '2025-04-23 02:58:19', '2025-04-23 02:58:19', 'semen', '2', 130000.00),
(6, '2025-04-23 02:58:37', '2025-04-23 02:58:37', 'peler', '11', 122000.00);

-- --------------------------------------------------------

--
-- Struktur dari tabel `storages`
--

CREATE TABLE `storages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `supplier`
--

CREATE TABLE `supplier` (
  `id` int(11) NOT NULL,
  `nama_supplier` varchar(255) NOT NULL,
  `kontak` varchar(100) DEFAULT NULL,
  `updated_at` date NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `supplier`
--

INSERT INTO `supplier` (`id`, `nama_supplier`, `kontak`, `updated_at`, `created_at`) VALUES
(2, 'Yanto', '088080808', '2025-05-01', '2025-05-01'),
(3, 'Galeh', '085761145701', '2025-05-01', '2025-05-01'),
(4, 'Dika', '085454686868', '2025-05-03', '2025-05-03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `kode_transaksi` varchar(255) NOT NULL,
  `metode` varchar(255) DEFAULT NULL,
  `deskripsi` varchar(400) DEFAULT NULL,
  `status_bayar` varchar(100) DEFAULT NULL,
  `total` int(11) NOT NULL,
  `no_hp` varchar(255) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `jenis` varchar(50) DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id`, `kode_transaksi`, `metode`, `deskripsi`, `status_bayar`, `total`, `no_hp`, `nama`, `created_at`, `updated_at`, `jenis`, `supplier_id`) VALUES
(2, 'TRX-681D8B3029CC3', 'tunai', 'D', NULL, 60000, NULL, '', '2025-05-08 21:57:20', '2025-05-08 21:57:20', 'Pembelian', 3),
(13, 'TX-202505160737577Ta', NULL, NULL, 'Lunas', 1000000, NULL, '', '2025-05-16 00:37:57', '2025-05-16 00:37:57', 'Pemasukan', NULL),
(15, 'TRX-6826EEEE8202C', NULL, 'tesss', NULL, 70000, NULL, '', '2025-05-16 00:53:18', '2025-05-16 00:53:18', 'Pembelian', 3),
(18, 'TX-20250516081647Bb6', 'tunai', NULL, 'Lunas', 1000000, NULL, '', '2025-05-16 01:16:47', '2025-05-16 01:16:47', 'Pemasukan', NULL),
(19, 'TX-20250516082405d37', 'tunai', NULL, 'Lunas', 21000000, NULL, '', '2025-05-16 01:24:05', '2025-05-16 01:24:05', 'Pemasukan', NULL),
(20, 'TX-20250516082443lS9', 'tunai', NULL, 'Lunas', 20000000, NULL, '', '2025-05-16 01:24:43', '2025-05-16 01:24:43', 'Pemasukan', NULL),
(21, 'TX-20250516082612991', 'tunai', NULL, 'Lunas', 30000000, NULL, '', '2025-05-16 01:26:12', '2025-05-16 01:26:12', 'Pemasukan', NULL),
(22, 'TX-20250516082701cji', 'tunai', NULL, 'Lunas', 200000000, NULL, '', '2025-05-16 01:27:01', '2025-05-16 01:27:01', 'Pemasukan', NULL),
(24, 'TX-202505160918342Km', 'transfer', NULL, 'Lunas', 1000000, NULL, '', '2025-05-16 02:18:34', '2025-05-16 02:18:34', 'Pemasukan', NULL),
(30, 'TRX-68270E47E256B', 'Kredit', 'okeee', NULL, 200000000, NULL, '', '2025-05-16 03:07:03', '2025-05-16 03:07:03', 'Pembelian', 3),
(31, 'TX-20250516104712SXu', NULL, NULL, 'Kredit', 1000000, NULL, '', '2025-05-16 03:47:12', '2025-05-16 03:47:12', 'Pemasukan', NULL),
(32, 'TX-20250516120922IVY', NULL, NULL, 'Kredit', 1000000, NULL, '', '2025-05-16 05:09:22', '2025-05-16 05:09:22', 'Pemasukan', NULL),
(33, 'TX-202505161214217rp', NULL, NULL, 'Kredit', 2000000, '082939393999', 'galih', '2025-05-16 05:14:21', '2025-05-16 05:14:21', 'Pemasukan', NULL),
(34, 'TRX-682AA2D49F895', 'kredit', 'uuuuuuu', NULL, 21000000, NULL, NULL, '2025-05-18 20:17:40', '2025-05-18 20:17:40', 'Pembelian', 3),
(35, 'TRX-682AA3EEF2F3F', 'kredit', 'qqqqqq', NULL, 12000000, NULL, NULL, '2025-05-18 20:22:22', '2025-05-18 20:22:22', 'Pembelian', 3),
(36, 'TRX-682AA4B7D8014', 'kredit', '12', NULL, 15000, NULL, NULL, '2025-05-18 20:25:43', '2025-05-18 20:25:43', 'Pembelian', 3),
(37, 'TRX-682AF2B238A64', 'tunai', 'w', NULL, 60000, NULL, NULL, '2025-05-19 01:58:26', '2025-05-19 01:58:26', 'Pembelian', 3),
(40, 'TRX-682AF5641A871', 'tunai', 'ret', NULL, 13000, NULL, NULL, '2025-05-19 02:09:56', '2025-05-19 02:09:56', 'Pembelian', 3),
(41, 'TRX-682AFF9CD413E', 'kredit', 'qw', NULL, 45000, NULL, NULL, '2025-05-19 02:53:32', '2025-05-19 02:53:32', 'Pembelian', 3),
(42, 'TRX-682AFFBB90E88', 'kredit', 'qw', NULL, 45000, NULL, NULL, '2025-05-19 02:54:03', '2025-05-19 02:54:03', 'Pembelian', 3),
(43, 'TRX-682AFFF3BDD59', 'kredit', 'qw', NULL, 45000, NULL, NULL, '2025-05-19 02:54:59', '2025-05-19 02:54:59', 'Pembelian', 3),
(44, 'TRX-682B00178477A', 'kredit', 'qw', NULL, 45000, NULL, NULL, '2025-05-19 02:55:35', '2025-05-19 02:55:35', 'Pembelian', 3),
(45, 'TRX-682B00E6EA8BA', 'kredit', 'wqas', NULL, 344, NULL, NULL, '2025-05-19 02:59:02', '2025-05-19 02:59:02', 'Pembelian', 3),
(46, 'TX-20250523113928vAI', NULL, NULL, 'Kredit', 70000, '785868668686', 'ssss', '2025-05-23 04:39:28', '2025-05-23 04:39:28', 'Pemasukan', NULL),
(47, 'TX-20250523113952LT1', 'tunai', NULL, 'Lunas', 5000, NULL, NULL, '2025-05-23 04:39:52', '2025-05-23 04:39:52', 'Pemasukan', NULL),
(48, 'TX-20250523114023kOa', 'tunai', NULL, 'Lunas', 20000, NULL, NULL, '2025-05-23 04:40:23', '2025-05-23 04:40:23', 'Pemasukan', NULL),
(49, 'TX-20250523114056GGH', NULL, NULL, 'Kredit', 25000, '8787987789', 'yanto', '2025-05-23 04:40:56', '2025-05-23 04:40:56', 'Pemasukan', NULL),
(50, 'TX-20250523115622tYL', NULL, NULL, 'Kredit', 20000, '8787987789', 'yanto', '2025-05-23 04:56:22', '2025-05-23 04:56:22', 'Pemasukan', NULL),
(51, 'TX-20250523115750Lql', 'tunai', NULL, 'Lunas', 30000, NULL, NULL, '2025-05-23 04:57:50', '2025-05-23 04:57:50', 'Pemasukan', NULL),
(52, 'TX-20250523121407wh1', NULL, NULL, 'Kredit', 5000, '089999999999', 'dika gemoy', '2025-05-23 05:14:07', '2025-05-23 05:14:07', 'Pemasukan', NULL),
(53, 'TX-20250523121836k9w', NULL, NULL, 'Kredit', 5000, '089999944444', 'arnold gemoy', '2025-05-23 05:18:36', '2025-05-23 05:18:36', 'Pemasukan', NULL),
(54, 'TX-20250523125931Fu4', 'tunai', NULL, 'Lunas', 5000, NULL, NULL, '2025-05-23 05:59:31', '2025-05-23 05:59:31', 'Pemasukan', NULL),
(55, 'TX-20250523133229WBY', 'transfer', NULL, 'Lunas', 5000, NULL, NULL, '2025-05-23 06:32:29', '2025-05-23 06:32:29', 'Pemasukan', NULL),
(56, 'TX-20250523133748QXV', NULL, NULL, 'Kredit', 3015000, '08080909090', 'fd', '2025-05-23 06:37:48', '2025-05-23 06:37:48', 'Pemasukan', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_detail`
--

CREATE TABLE `transaksi_detail` (
  `id` int(11) NOT NULL,
  `transaksi_id` int(11) NOT NULL,
  `barang_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `harga_satuan` int(11) DEFAULT NULL,
  `subtotal` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transaksi_detail`
--

INSERT INTO `transaksi_detail` (`id`, `transaksi_id`, `barang_id`, `quantity`, `harga_satuan`, `subtotal`, `updated_at`, `created_at`) VALUES
(2, 2, 9, 12, 5000, 60000, '2025-05-08 21:57:20', '2025-05-08 21:57:20'),
(11, 13, 2, 1, 1000000, 1000000, '2025-05-16 00:37:57', '2025-05-16 00:37:57'),
(13, 15, 9, 14, 5000, 70000, '2025-05-16 00:53:18', '2025-05-16 00:53:18'),
(16, 18, 2, 1, 1000000, 1000000, '2025-05-16 01:16:47', '2025-05-16 01:16:47'),
(17, 19, 2, 20, 1000000, 20000000, '2025-05-16 01:24:05', '2025-05-16 01:24:05'),
(18, 19, 2, 1, 1000000, 1000000, '2025-05-16 01:24:05', '2025-05-16 01:24:05'),
(19, 20, 2, 20, 1000000, 20000000, '2025-05-16 01:24:43', '2025-05-16 01:24:43'),
(20, 21, 2, 30, 1000000, 30000000, '2025-05-16 01:26:12', '2025-05-16 01:26:12'),
(21, 22, 2, 200, 1000000, 200000000, '2025-05-16 01:27:01', '2025-05-16 01:27:01'),
(22, 24, 2, 1, 1000000, 1000000, '2025-05-16 02:18:34', '2025-05-16 02:18:34'),
(27, 30, 2, 200, 1000000, 200000000, '2025-05-16 03:07:03', '2025-05-16 03:07:03'),
(28, 31, 2, 1, 1000000, 1000000, '2025-05-16 03:47:12', '2025-05-16 03:47:12'),
(29, 32, 2, 1, 1000000, 1000000, '2025-05-16 05:09:22', '2025-05-16 05:09:22'),
(30, 33, 2, 2, 1000000, 2000000, '2025-05-16 05:14:21', '2025-05-16 05:14:21'),
(31, 34, 2, 21, 1000000, 21000000, '2025-05-18 20:17:40', '2025-05-18 20:17:40'),
(32, 35, 2, 12, 1000000, 12000000, '2025-05-18 20:22:23', '2025-05-18 20:22:23'),
(33, 36, 9, 3, 5000, 15000, '2025-05-18 20:25:43', '2025-05-18 20:25:43'),
(34, 37, 9, 12, 5000, 60000, '2025-05-19 01:58:26', '2025-05-19 01:58:26'),
(36, 40, 2, 12, NULL, 13000, '2025-05-19 02:09:56', '2025-05-19 02:09:56'),
(37, 41, 2, 12, NULL, 45000, '2025-05-19 02:53:32', '2025-05-19 02:53:32'),
(38, 42, 2, 12, NULL, 45000, '2025-05-19 02:54:03', '2025-05-19 02:54:03'),
(39, 43, 2, 12, NULL, 45000, '2025-05-19 02:54:59', '2025-05-19 02:54:59'),
(40, 44, 2, 12, NULL, 45000, '2025-05-19 02:55:35', '2025-05-19 02:55:35'),
(41, 45, 9, 12, 5000, 344, '2025-05-19 02:59:02', '2025-05-19 02:59:02'),
(42, 46, 9, 12, 5000, 60000, '2025-05-23 04:39:28', '2025-05-23 04:39:28'),
(43, 46, 9, 2, 5000, 10000, '2025-05-23 04:39:28', '2025-05-23 04:39:28'),
(44, 46, 9, 12, 5000, 60000, '2025-05-23 04:39:28', '2025-05-23 04:39:28'),
(45, 46, 9, 2, 5000, 10000, '2025-05-23 04:39:28', '2025-05-23 04:39:28'),
(46, 47, 9, 1, 5000, 5000, '2025-05-23 04:39:52', '2025-05-23 04:39:52'),
(47, 48, 9, 1, 5000, 5000, '2025-05-23 04:40:23', '2025-05-23 04:40:23'),
(48, 48, 9, 3, 5000, 15000, '2025-05-23 04:40:23', '2025-05-23 04:40:23'),
(49, 49, 9, 5, 5000, 25000, '2025-05-23 04:40:56', '2025-05-23 04:40:56'),
(50, 50, 9, 4, 5000, 20000, '2025-05-23 04:56:22', '2025-05-23 04:56:22'),
(51, 51, 9, 6, 5000, 30000, '2025-05-23 04:57:50', '2025-05-23 04:57:50'),
(52, 52, 9, 1, 5000, 5000, '2025-05-23 05:14:07', '2025-05-23 05:14:07'),
(53, 53, 9, 1, 5000, 5000, '2025-05-23 05:18:36', '2025-05-23 05:18:36'),
(54, 54, 9, 1, 5000, 5000, '2025-05-23 05:59:31', '2025-05-23 05:59:31'),
(55, 55, 9, 1, 5000, 5000, '2025-05-23 06:32:29', '2025-05-23 06:32:29'),
(56, 56, 9, 3, 5000, 15000, '2025-05-23 06:37:48', '2025-05-23 06:37:48'),
(57, 56, 2, 3, 1000000, 3000000, '2025-05-23 06:37:48', '2025-05-23 06:37:48');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `updated_at`, `created_at`) VALUES
(2, 'galehcool', 'galehcool', '$2y$12$xedanVr1eCpcrEH7MXgAbuZuABkWP7MWqbKNud3NYfZcWej.PWOwO', '2025-04-26 09:34:36', NULL),
(3, 'arnold', 'arnld17171', '$2y$12$UosBzdu.qHN67jVc8/FHreSCd0l4EJy7YVOMK5g2KrOSrrhFTjUUG', '2025-04-22 23:06:03', '2025-04-22 22:48:49'),
(6, 'Jery', 'jeryjery', '$2y$12$10JSQJbLthWpVp9o/DadReNs8lzD3xCcpv8ZS20zv1jmrllAsaEp.', '2025-05-16 01:09:11', '2025-05-16 01:09:11'),
(7, 'Dikaler', 'dikaler', '$2y$12$Kpn4qqsHm8.XD6avb4F/L.evEHzVXhDqDlkI3t67/ZU/6qZqkyxJe', '2025-05-16 01:40:34', '2025-05-16 01:40:34');

-- --------------------------------------------------------

--
-- Struktur dari tabel `utangpiutang`
--

CREATE TABLE `utangpiutang` (
  `id` int(11) NOT NULL,
  `kode_transaksi` varchar(255) NOT NULL,
  `total` int(11) NOT NULL,
  `jenis` varchar(255) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `no_hp` varchar(255) DEFAULT NULL,
  `deskripsi` varchar(255) DEFAULT NULL,
  `jatuh_tempo` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `tanggal` timestamp NULL DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `utangpiutang`
--

INSERT INTO `utangpiutang` (`id`, `kode_transaksi`, `total`, `jenis`, `nama`, `no_hp`, `deskripsi`, `jatuh_tempo`, `created_at`, `updated_at`, `tanggal`, `status`) VALUES
(31, 'TRX-68272F11C4DC1', 105000, 'Utang', NULL, NULL, '12', '2025-05-16', '2025-05-16 05:26:57', '2025-05-16 05:26:57', NULL, 'belum'),
(32, 'UT-20250519032223LmI', 12000000, 'Utang', NULL, NULL, NULL, NULL, '2025-05-23 12:11:33', '2025-05-23 05:11:33', NULL, 'selesai'),
(40, 'TRX-682AFE35DA0A7', 13000, 'Piutang', NULL, NULL, 'ret', '2025-05-28', '2025-05-19 02:47:33', '2025-05-19 02:47:33', '2025-05-19 02:47:33', 'belum'),
(41, 'TRX-682AFED121F44', 14, 'Piutang', NULL, NULL, 'ggggg', '2025-05-29', '2025-05-19 02:50:09', '2025-05-19 02:50:09', '2025-05-19 02:50:09', 'belum'),
(42, 'TRX-682AFF6CB9ECE', 35, 'Utang', NULL, NULL, 'deeee', '2025-05-19', '2025-05-19 09:52:54', '2025-05-19 02:52:54', '2025-05-19 02:52:44', 'selesai'),
(43, 'UT-20250519095332Kg3', 45000, 'Utang', NULL, NULL, 'qw', '2025-05-19', '2025-05-19 02:53:32', '2025-05-19 02:53:32', '2025-05-19 02:53:32', 'belum'),
(44, 'UT-20250519095403Rvz', 45000, 'Utang', NULL, NULL, 'qw', '2025-05-19', '2025-05-19 02:54:03', '2025-05-19 02:54:03', '2025-05-19 02:54:03', 'belum'),
(45, 'UT-20250519095459r3V', 45000, 'Utang', NULL, NULL, 'qw', '2025-05-19', '2025-05-19 02:54:59', '2025-05-19 02:54:59', '2025-05-19 02:54:59', 'belum'),
(46, 'UT-20250519095535I9s', 45000, 'Utang', NULL, NULL, 'qw', '2025-05-19', '2025-05-23 11:50:12', '2025-05-23 04:50:12', '2025-05-19 02:55:35', 'selesai'),
(47, 'UT-20250519095902xfc', 344, 'Utang', NULL, NULL, 'wqas', '2025-05-19', '2025-05-19 09:59:25', '2025-05-19 02:59:25', '2025-05-19 02:59:02', 'selesai'),
(48, 'TRX-68305D55B3D89', 21, 'Piutang', NULL, NULL, '21', '2025-05-23', '2025-05-23 04:34:45', '2025-05-23 04:34:45', '2025-05-23 04:34:45', 'belum'),
(49, 'UT-20250523113928s0f', 70000, 'Piutang', 'ssss', '785868668686', NULL, '2025-05-24', '2025-05-23 12:13:02', '2025-05-23 05:13:02', NULL, 'selesai'),
(50, 'UT-20250523114056nLl', 25000, 'Piutang', 'yanto', '8787987789', NULL, '2025-05-25', '2025-05-23 04:40:56', '2025-05-23 04:40:56', NULL, 'belum'),
(51, 'UT-20250523115622bxH', 20000, 'Piutang', 'yanto', '8787987789', NULL, '2025-05-23', '2025-05-23 11:59:00', '2025-05-23 04:59:00', NULL, 'selesai'),
(52, 'UT-20250523121407PO3', 5000, 'Piutang', 'dika gemoy', '089999999999', NULL, '2025-05-25', '2025-05-23 05:14:07', '2025-05-23 05:14:07', NULL, 'belum'),
(53, 'UT-20250523121836KiD', 5000, 'Piutang', 'arnold gemoy', '089999944444', NULL, '2025-05-31', '2025-05-23 05:18:36', '2025-05-23 05:18:36', '2025-05-23 05:18:36', 'belum'),
(54, 'UT-20250523133748giP', 3015000, 'Piutang', 'fd', '08080909090', NULL, '2025-05-23', '2025-05-23 06:37:48', '2025-05-23 06:37:48', '2025-05-23 06:37:48', 'belum');

-- --------------------------------------------------------

--
-- Struktur dari tabel `utangpiutang_detail`
--

CREATE TABLE `utangpiutang_detail` (
  `id` int(11) NOT NULL,
  `transaksi_id` int(11) NOT NULL,
  `barang_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `harga_satuan` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `utangpiutang_detail`
--

INSERT INTO `utangpiutang_detail` (`id`, `transaksi_id`, `barang_id`, `quantity`, `harga_satuan`, `subtotal`, `updated_at`, `created_at`) VALUES
(16, 31, 9, 21, 5000, 105000, '2025-05-16 05:26:57', '2025-05-16 05:26:57'),
(17, 32, 2, 12, 1000000, 12000000, '2025-05-18 20:22:23', '2025-05-18 20:22:23'),
(19, 47, 9, 12, 5000, 344, '2025-05-19 02:59:02', '2025-05-19 02:59:02'),
(20, 49, 9, 12, 5000, 60000, '2025-05-23 04:39:28', '2025-05-23 04:39:28'),
(21, 49, 9, 2, 5000, 10000, '2025-05-23 04:39:28', '2025-05-23 04:39:28'),
(22, 50, 9, 5, 5000, 25000, '2025-05-23 04:40:56', '2025-05-23 04:40:56'),
(23, 51, 9, 4, 5000, 20000, '2025-05-23 04:56:22', '2025-05-23 04:56:22'),
(24, 52, 9, 1, 5000, 5000, '2025-05-23 05:14:07', '2025-05-23 05:14:07'),
(25, 53, 9, 1, 5000, 5000, '2025-05-23 05:18:36', '2025-05-23 05:18:36'),
(26, 54, 9, 3, 5000, 15000, '2025-05-23 06:37:48', '2025-05-23 06:37:48'),
(27, 54, 2, 3, 1000000, 3000000, '2025-05-23 06:37:48', '2025-05-23 06:37:48');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `supplier_barang` (`supplier`);

--
-- Indeks untuk tabel `beban`
--
ALTER TABLE `beban`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `satuan`
--
ALTER TABLE `satuan`
  ADD PRIMARY KEY (`ID`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `storages`
--
ALTER TABLE `storages`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaksi` (`transaksi_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `utangpiutang`
--
ALTER TABLE `utangpiutang`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `utangpiutang_detail`
--
ALTER TABLE `utangpiutang_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `utangdetail` (`transaksi_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `barang`
--
ALTER TABLE `barang`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `beban`
--
ALTER TABLE `beban`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `satuan`
--
ALTER TABLE `satuan`
  MODIFY `ID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `storages`
--
ALTER TABLE `storages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT untuk tabel `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `utangpiutang`
--
ALTER TABLE `utangpiutang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT untuk tabel `utangpiutang_detail`
--
ALTER TABLE `utangpiutang_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `supplier_barang` FOREIGN KEY (`supplier`) REFERENCES `supplier` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD CONSTRAINT `transaksi` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `utangpiutang_detail`
--
ALTER TABLE `utangpiutang_detail`
  ADD CONSTRAINT `utangdetail` FOREIGN KEY (`transaksi_id`) REFERENCES `utangpiutang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
