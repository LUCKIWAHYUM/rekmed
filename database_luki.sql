-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 23, 2024 at 03:27 AM
-- Server version: 5.7.33
-- PHP Version: 8.1.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skripsi_luki`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `uuid` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isUsed` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`uuid`, `email`, `token`, `isUsed`, `created_at`) VALUES
('2a16b010-a96a-4d16-b579-52dc50f3ff89', 'yonatanagave@gmail.com', '976871b0646b2c055ffc6a6408048ba6', 0, '2023-12-28 14:56:29'),
('74f0ae01-1d0f-487a-b4bd-49d91dd1783b', 'officialnuzulzaif124@gmail.com', '985a92a858cec0a0c8024444af20f01c', 0, '2024-04-02 13:58:33'),
('8c40d1a7-a6c8-4d05-9ffa-08be157e4261', 'officialnuzulzaif124@gmail.com', 'f915b09ae1f430cc98b9942dfa470480', 0, '2024-04-02 14:03:16'),
('ddf0b068-d7a7-4d84-bdcc-db2ad60dcef1', 'localvalorants@gmail.com', '27e668f86a14cc8d4eb980ccc430888e', 1, '2023-09-18 07:05:45'),
('ed5ec1c1-b9a8-4b2c-8c9f-91811dcf3aa1', 'localvalorants@gmail.com', '33790bd44168c13461111d0e9de6a8ee', 0, '2023-09-19 06:17:59'),
('f63c96d5-7f55-4da2-baf6-c3412d7e023c', 'officialnuzulzaif124@gmail.com', '4a81a4838bfb11fb29345021ea8cf23c', 0, '2024-04-02 13:53:34');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_antrian`
--

CREATE TABLE `tbl_antrian` (
  `id` int(11) NOT NULL,
  `id_poli` int(11) DEFAULT NULL,
  `id_user` int(11) NOT NULL,
  `id_perawat` int(11) DEFAULT NULL,
  `id_dokter` int(11) DEFAULT NULL,
  `kode` varchar(40) NOT NULL,
  `no_periksa` varchar(10) NOT NULL,
  `status` int(4) NOT NULL COMMENT '1: Menunggu Antrian\r\n2: Pemeriksaan\r\n3: Selesai',
  `time_in` varchar(40) DEFAULT NULL,
  `time_out` varchar(40) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_antrian`
--

INSERT INTO `tbl_antrian` (`id`, `id_poli`, `id_user`, `id_perawat`, `id_dokter`, `kode`, `no_periksa`, `status`, `time_in`, `time_out`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 155, 152, '1', 'CZQ2AR', 3, '2024-04-15T10:23', NULL, '2024-04-14 21:23:06', '2024-04-16 22:20:58');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_apoteker`
--

CREATE TABLE `tbl_apoteker` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nomer_induk` varchar(20) NOT NULL,
  `status` int(3) NOT NULL COMMENT '1: Active, 2: Non Active',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_apoteker`
--

INSERT INTO `tbl_apoteker` (`id`, `id_user`, `nomer_induk`, `status`, `created_at`, `updated_at`) VALUES
(1, 153, 'APT021292AS', 1, '2024-04-12 00:35:22', '2024-04-18 00:43:32');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_dokter`
--

CREATE TABLE `tbl_dokter` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_poli` int(11) NOT NULL,
  `nomer_induk` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `telepon` varchar(15) NOT NULL,
  `jadwal_praktek` text NOT NULL,
  `status` int(3) NOT NULL COMMENT '1: Active, 2: Non Active',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_dokter`
--

INSERT INTO `tbl_dokter` (`id`, `id_user`, `id_poli`, `nomer_induk`, `alamat`, `telepon`, `jadwal_praktek`, `status`, `created_at`, `updated_at`) VALUES
(1, 152, 3, '92AS2192BSAS', 'Jl. Patimura', '628966221224', 'Senin - Jumat: 09.00 s/d 13.00 WIB\r\nSabtu - Minggu: 08.00 s/d 12.00 WIB', 1, '2024-04-11 23:58:22', '2024-04-12 00:23:19');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_foto_pemeriksaan`
--

CREATE TABLE `tbl_foto_pemeriksaan` (
  `id` varchar(40) NOT NULL,
  `id_pemeriksaan` varchar(40) NOT NULL,
  `foto` text,
  `diameter` varchar(60) DEFAULT NULL,
  `jumlah` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_foto_pemeriksaan`
--

INSERT INTO `tbl_foto_pemeriksaan` (`id`, `id_pemeriksaan`, `foto`, `diameter`, `jumlah`) VALUES
('67b2013e-85d3-4cf6-9c92-28c1f7b8173e', '2da1004c-1a83-4d9c-ab3f-e7a2482cf59a', 'public/images/M11vtAE26uPTwaQYS5Wnxy5LgPlBPKriNjP63jKM.png', '40', '2'),
('75e238d3-0921-479b-b7e1-fffcbbd61695', '2da1004c-1a83-4d9c-ab3f-e7a2482cf59a', 'public/images/MvTDCDB0ivwPzz7Xsy8PFklECuQVK5jbTDPCWu2Z.jpg', '25', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_log_activity`
--

CREATE TABLE `tbl_log_activity` (
  `uid` char(40) NOT NULL,
  `logType` int(11) NOT NULL DEFAULT '1' COMMENT '1: Login\r\n2: General',
  `causedBy` int(11) NOT NULL,
  `performedOn` varchar(50) NOT NULL,
  `withContent` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_log_activity`
--

INSERT INTO `tbl_log_activity` (`uid`, `logType`, `causedBy`, `performedOn`, `withContent`, `created_at`) VALUES
('00898812-b8ec-4d2b-b71d-de2a097dec2c', 2, 125, '2023-11-28 21:46:50', '{\"text\": \"Anda berhasil melakukan permintaan deposit pada tanggal 2023-11-28 21:46:50\", \"status\": \"add\"}', '2023-11-28 21:46:50'),
('008bf9c9-5cca-41e8-bd99-058068a8a7a5', 1, 1, '2024-03-31 19:34:25', '{\"status\":\"add\",\"text\":\"Login as Administrator\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/123.0.0.0 Safari\\/537.36\",\"time\":\"2024-03-31 19:34:25\"}', '2024-03-31 19:34:25'),
('009eedf7-f9cb-4cc3-a967-3418633dfdab', 1, 153, '2024-04-16 22:39:08', '{\"status\":\"add\",\"text\":\"Login as Ghina\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/123.0.0.0 Safari\\/537.36\",\"time\":\"2024-04-16 22:39:08\"}', '2024-04-16 22:39:08'),
('00b8a71f-cd82-46e6-95a8-1172c982f281', 1, 125, '2024-01-13 22:57:00', '{\"text\": \"Login as Nuzul Zaif\", \"time\": \"2024-01-13 22:57:00\", \"status\": \"add\", \"ip_address\": \"103.115.31.55\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36\"}', '2024-01-13 22:57:00'),
('00c6cc72-87b6-466e-a5a5-40581f243395', 1, 152, '2024-04-15 12:40:16', '{\"status\":\"add\",\"text\":\"Login as Dokter Irsyads\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/123.0.0.0 Safari\\/537.36\",\"time\":\"2024-04-15 12:40:14\"}', '2024-04-15 12:40:16'),
('012adb77-2940-479a-91bf-ebf5704b7419', 1, 1, '2023-12-23 11:33:34', '{\"text\": \"Login as Nuzul\", \"time\": \"2023-12-23 11:33:34\", \"status\": \"add\", \"ip_address\": \"103.115.31.53\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36\"}', '2023-12-23 11:33:34'),
('0296ada7-7cd1-4075-91eb-09110906c5d4', 1, 1, '2024-01-09 13:44:59', '{\"text\": \"Login as Nuzul\", \"time\": \"2024-01-09 13:44:59\", \"status\": \"add\", \"ip_address\": \"2001:448a:5122:4193:f0f2:1d74:bf1e:1927\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36\"}', '2024-01-09 13:44:59'),
('04a0184a-f8ac-46f4-bf8a-0750be223f35', 1, 1, '2024-01-22 12:24:08', '{\"status\":\"add\",\"text\":\"Login as Nuzul\",\"ip_address\":\"36.74.220.245\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/120.0.0.0 Safari\\/537.36\",\"time\":\"2024-01-22 12:24:08\"}', '2024-01-22 12:24:08'),
('057548f0-d25e-4b07-baae-849d3bf07404', 1, 155, '2024-04-14 19:03:22', '{\"status\":\"add\",\"text\":\"Login as Rahma\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/123.0.0.0 Safari\\/537.36\",\"time\":\"2024-04-14 19:03:20\"}', '2024-04-14 19:03:22'),
('070f287c-f898-46b4-80a8-cfbdf0916ad1', 1, 1, '2023-11-25 12:53:19', '{\"text\": \"Login as Nuzul\", \"time\": \"2023-11-25 12:53:19\", \"status\": \"add\", \"ip_address\": \"103.18.184.5\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36\"}', '2023-11-25 12:53:19'),
('086e0555-fedf-43f5-94ba-d56531536f00', 1, 159, '2024-02-20 15:26:19', '{\"status\":\"add\",\"text\":\"Login as Wali Siswa ID\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/121.0.0.0 Safari\\/537.36\",\"time\":\"2024-02-20 15:26:19\"}', '2024-02-20 15:26:19'),
('08ae229f-4624-48bb-ab92-d173bc3763e1', 1, 125, '2024-01-02 14:03:24', '{\"text\": \"Login as Nuzul Zaif\", \"time\": \"2024-01-02 14:03:24\", \"status\": \"add\", \"ip_address\": \"2001:448a:5122:35a7:a138:d9f0:c416:ddf8\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36\"}', '2024-01-02 14:03:24'),
('0955dda6-db1b-4fa5-85e4-dadd02d21f68', 1, 153, '2024-04-17 23:42:39', '{\"status\":\"add\",\"text\":\"Login as Ghina\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/123.0.0.0 Safari\\/537.36\",\"time\":\"2024-04-17 23:42:38\"}', '2024-04-17 23:42:39'),
('09ce1e74-bd43-45a8-91c5-591f51baa7a8', 1, 63, '2023-11-28 23:48:08', '{\"text\": \"Login as Muhammad\", \"time\": \"2023-11-28 23:48:08\", \"status\": \"add\", \"ip_address\": \"103.195.58.21\", \"user_agent\": \"Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:120.0) Gecko/20100101 Firefox/120.0\"}', '2023-11-28 23:48:08'),
('09f9c2aa-6948-4e8e-b362-240acfa545b1', 1, 126, '2024-01-09 13:40:49', '{\"text\": \"Login as Mhd Rizqy\", \"time\": \"2024-01-09 13:40:49\", \"status\": \"add\", \"ip_address\": \"182.253.127.186\", \"user_agent\": \"Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:121.0) Gecko/20100101 Firefox/121.0\"}', '2024-01-09 13:40:49'),
('0a251787-27aa-4bac-beb1-43c873b3db66', 1, 152, '2024-04-16 20:13:40', '{\"status\":\"add\",\"text\":\"Login as Dokter Irsyads\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/123.0.0.0 Safari\\/537.36\",\"time\":\"2024-04-16 20:13:38\"}', '2024-04-16 20:13:40'),
('0a489680-cb21-424f-b192-843a5c337375', 1, 1, '2024-01-22 13:34:32', '{\"status\":\"add\",\"text\":\"Login as Nuzul\",\"ip_address\":\"103.3.58.251\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/120.0.0.0 Safari\\/537.36\",\"time\":\"2024-01-22 13:34:32\"}', '2024-01-22 13:34:32'),
('0b04b594-9036-4789-ae60-1772890f2187', 1, 63, '2024-01-01 09:13:36', '{\"text\": \"Login as Muhammad\", \"time\": \"2024-01-01 09:13:36\", \"status\": \"add\", \"ip_address\": \"182.2.136.184\", \"user_agent\": \"Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Mobile Safari/537.36\"}', '2024-01-01 09:13:36'),
('0c772085-2697-4a8d-be28-07f750be0dd6', 1, 1, '2023-11-16 23:33:01', '{\"text\": \"Login as Nuzul\", \"time\": \"2023-11-16 23:33:01\", \"status\": \"add\", \"ip_address\": \"103.18.184.5\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36\"}', '2023-11-16 23:33:01'),
('0cc6d892-3282-467d-882b-88a5fdca376e', 1, 1, '2024-04-01 20:34:13', '{\"status\":\"add\",\"text\":\"Login as Administrator\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/123.0.0.0 Safari\\/537.36\",\"time\":\"2024-04-01 20:34:13\"}', '2024-04-01 20:34:13'),
('0ceb0e1f-c650-4c73-9313-0373a7b7a423', 1, 63, '2023-11-14 22:46:13', '{\"text\": \"Login as Muhammad\", \"time\": \"2023-11-14 22:46:13\", \"status\": \"add\", \"ip_address\": \"180.244.163.224\", \"user_agent\": \"Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:109.0) Gecko/20100101 Firefox/119.0\"}', '2023-11-14 22:46:13'),
('0da474ca-8e28-4a80-b3ad-8c975f8c503e', 1, 125, '2023-11-30 20:55:53', '{\"text\": \"Login as Nuzul Zaif\", \"time\": \"2023-11-30 20:55:53\", \"status\": \"add\", \"ip_address\": \"2001:448a:5122:2006:d54c:f40f:2d9d:b3bb\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36\"}', '2023-11-30 20:55:53'),
('0db86a35-6531-4daf-859c-cba797c6147a', 2, 125, '2023-11-28 20:49:30', '{\"text\": \"Anda berhasil melakukan permintaan deposit pada tanggal 2023-11-28 20:49:30\", \"status\": \"add\"}', '2023-11-28 20:49:30'),
('0f2093a3-732c-4d81-9615-f079d5bd52c9', 1, 125, '2023-12-12 13:13:41', '{\"text\": \"Login as Nuzul Zaif\", \"time\": \"2023-12-12 13:13:41\", \"status\": \"add\", \"ip_address\": \"103.115.31.27\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36\"}', '2023-12-12 13:13:41'),
('10104587-5426-4043-b27d-6455b364c287', 1, 125, '2024-01-01 12:50:23', '{\"text\": \"Login as Nuzul Zaif\", \"time\": \"2024-01-01 12:50:23\", \"status\": \"add\", \"ip_address\": \"103.115.31.53\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36\"}', '2024-01-01 12:50:23'),
('1111edc2-3f04-435d-9636-a697405a77bb', 2, 125, '2023-11-15 14:20:08', '{\"text\": \"Anda berhasil melakukan pembatalan tarik tunai dengan kode invoice INV-1700032587-9S1970LH pada tanggal 2023-11-15 14:20:08\", \"status\": \"minus\"}', '2023-11-15 14:20:08'),
('11171e07-b9d1-457b-9d9e-5421c8dccda4', 1, 140, '2024-01-15 20:30:45', '{\"text\": \"Login as Yunda Nadia\", \"time\": \"2024-01-15 20:30:45\", \"status\": \"add\", \"ip_address\": \"36.81.181.249\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36\"}', '2024-01-15 20:30:45'),
('111cc914-db77-4f19-b532-839b1665231d', 1, 1, '2023-12-19 11:08:27', '{\"text\": \"Login as Nuzul\", \"time\": \"2023-12-19 11:08:27\", \"status\": \"add\", \"ip_address\": \"2001:448a:5122:52f:fc7c:c4d:b974:7cbb\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36\"}', '2023-12-19 11:08:27'),
('117f29cf-c053-4e62-9fed-29f079adc62a', 1, 1, '2024-04-13 19:37:19', '{\"status\":\"add\",\"text\":\"Login as Administrator\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/123.0.0.0 Safari\\/537.36\",\"time\":\"2024-04-13 19:37:19\"}', '2024-04-13 19:37:19'),
('119cdc22-947c-4b5f-9afe-de7708a41b0b', 1, 144, '2024-04-02 21:03:44', '{\"status\":\"add\",\"text\":\"Login as User KPS\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/123.0.0.0 Safari\\/537.36\",\"time\":\"2024-04-02 21:03:44\"}', '2024-04-02 21:03:44'),
('1228023f-d02b-4276-9f75-2faa832d784c', 2, 125, '2023-11-25 14:52:45', '{\"text\": \"Anda berhasil menerima penarikan saldo sejumlah 100RB pada tanggal 2023-11-25 14:52:45\", \"status\": \"add\"}', '2023-11-25 14:52:45'),
('139acda9-0c05-4c4b-82c4-c61c4ec5e14c', 1, 125, '2023-11-17 18:11:51', '{\"text\": \"Login as Nuzul Zaif\", \"time\": \"2023-11-17 18:11:51\", \"status\": \"add\", \"ip_address\": \"103.18.184.5\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36\"}', '2023-11-17 18:11:51'),
('13b9f093-936d-4094-afce-f49df43c0607', 1, 126, '2023-11-17 18:26:49', '{\"text\": \"Login as Mhd Rizqy\", \"time\": \"2023-11-17 18:26:49\", \"status\": \"add\", \"ip_address\": \"182.3.38.176\", \"user_agent\": \"Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36\"}', '2023-11-17 18:26:49'),
('140a103a-095d-4756-b260-ae1ace8b400d', 1, 1, '2024-04-01 00:09:14', '{\"status\":\"add\",\"text\":\"Login as Administrator\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/123.0.0.0 Safari\\/537.36\",\"time\":\"2024-04-01 00:09:13\"}', '2024-04-01 00:09:14'),
('140b4ea0-d01e-4e30-9f04-7397280db42a', 2, 1, '2023-10-12 20:29:59', '{\"text\": \"Insert a new seller with name Progriva ID\", \"status\": \"add\"}', '2023-10-12 20:29:59'),
('1446fbef-13ec-490f-a441-5c8b056bc903', 1, 1, '2023-12-27 20:07:23', '{\"text\": \"Login as Nuzul\", \"time\": \"2023-12-27 20:07:23\", \"status\": \"add\", \"ip_address\": \"103.115.31.55\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36\"}', '2023-12-27 20:07:23'),
('1501611a-3058-464f-9ef2-82a630e5766f', 2, 128, '2023-11-28 00:29:26', '{\"text\": \"Anda berhasil mendaftarkan diri sebagai reseller pada tanggal 2023-11-28 00:29:26\", \"status\": \"add\"}', '2023-11-28 00:29:26'),
('15766053-de08-4e3c-8446-c477161071d6', 1, 95, '2023-12-27 13:55:59', '{\"text\": \"Login as Khoiril\", \"time\": \"2023-12-27 13:55:59\", \"status\": \"add\", \"ip_address\": \"202.80.218.36\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36\"}', '2023-12-27 13:55:59'),
('16d0c47d-bbe2-4f3d-94d7-144e0a6056dc', 1, 128, '2023-11-28 00:26:24', '{\"text\": \"Login as Yusfiwawansepriyadi\", \"time\": \"2023-11-28 00:26:24\", \"status\": \"add\", \"ip_address\": \"103.144.170.184\", \"user_agent\": \"Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Mobile Safari/537.36\"}', '2023-11-28 00:26:24'),
('16df475a-266b-402e-bfe7-b32be501f057', 1, 1, '2023-12-01 14:11:24', '{\"text\": \"Login as Nuzul\", \"time\": \"2023-12-01 14:11:24\", \"status\": \"add\", \"ip_address\": \"103.115.31.27\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36\"}', '2023-12-01 14:11:24'),
('199f32f1-c77a-40e0-9a92-39bdf3c7b5fe', 2, 1, '2024-01-31 22:27:53', '{\"status\":\"add\",\"text\":\"Insert a new user with email andromedia@gmail.com\"}', '2024-01-31 22:27:53'),
('1b93bafa-3d62-4f45-92db-4484c171bd74', 1, 125, '2023-12-20 13:49:25', '{\"text\": \"Login as Nuzul Zaif\", \"time\": \"2023-12-20 13:49:25\", \"status\": \"add\", \"ip_address\": \"2001:448a:5122:52f:1ccb:9da3:8671:f97e\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36\"}', '2023-12-20 13:49:25'),
('1cb37ded-da9c-4b9d-abbe-a2e25436b055', 1, 63, '2023-11-17 20:25:16', '{\"text\": \"Login as Muhammad\", \"time\": \"2023-11-17 20:25:16\", \"status\": \"add\", \"ip_address\": \"182.3.38.176\", \"user_agent\": \"Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Mobile Safari/537.36\"}', '2023-11-17 20:25:16'),
('1da5364f-2005-4378-83c2-345ea86c44ae', 1, 125, '2023-11-23 14:08:07', '{\"text\": \"Login as Nuzul Zaif\", \"time\": \"2023-11-23 14:08:07\", \"status\": \"add\", \"ip_address\": \"2001:448a:5122:f722:39cc:7a9a:e85d:5429\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36\"}', '2023-11-23 14:08:07'),
('1e9f8f49-8b80-43f9-b2d7-a4183e6a3936', 2, 125, '2023-11-30 21:51:41', '{\"text\": \"Anda berhasil melakukan transaksi baru pada tanggal 2023-11-30 21:51:41\", \"status\": \"add\"}', '2023-11-30 21:51:41'),
('1ed0a976-d331-401b-89cb-958b8f65bc42', 1, 95, '2023-12-15 06:20:01', '{\"text\": \"Login as Khoiril\", \"time\": \"2023-12-15 06:20:01\", \"status\": \"add\", \"ip_address\": \"202.80.216.93\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36\"}', '2023-12-15 06:20:01'),
('2063b345-22e4-4fac-9844-438aa78aa6ac', 1, 63, '2023-11-17 22:15:26', '{\"text\": \"Login as Muhammad\", \"time\": \"2023-11-17 22:15:26\", \"status\": \"add\", \"ip_address\": \"114.124.210.119\", \"user_agent\": \"Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:109.0) Gecko/20100101 Firefox/119.0\"}', '2023-11-17 22:15:26'),
('213791ec-634e-46ca-bf0f-969873cbd2f4', 1, 125, '2023-11-25 15:45:14', '{\"text\": \"Login as Nuzul Zaif\", \"time\": \"2023-11-25 15:45:14\", \"status\": \"add\", \"ip_address\": \"103.18.184.5\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36\"}', '2023-11-25 15:45:14'),
('222c5a50-8a34-4eff-b46d-39c328647b76', 2, 63, '2023-11-30 22:16:45', '{\"text\": \"Anda berhasil melakukan permintaan deposit pada tanggal 2023-11-30 22:16:45\", \"status\": \"add\"}', '2023-11-30 22:16:45'),
('224053bb-5b75-40ec-ae7a-ce842b376d0a', 1, 1, '2023-11-17 18:13:33', '{\"text\": \"Login as Nuzul\", \"time\": \"2023-11-17 18:13:33\", \"status\": \"add\", \"ip_address\": \"103.18.184.5\", \"user_agent\": \"Mozilla/5.0 (iPhone; CPU iPhone OS 14_0 like Mac OS X) AppleWebKit/603.1.30 (KHTML, like Gecko) Version/12.0.0 Mobile/15A5370a Safari/602.1\"}', '2023-11-17 18:13:33'),
('2253de2a-c3d8-49d4-88a5-3fb8ecd131bf', 1, 63, '2023-12-23 17:35:05', '{\"text\": \"Login as Muhammad\", \"time\": \"2023-12-23 17:35:05\", \"status\": \"add\", \"ip_address\": \"114.122.14.86\", \"user_agent\": \"Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Mobile Safari/537.36\"}', '2023-12-23 17:35:05'),
('23bbaea8-3809-43ff-91f5-e0d20c2b9442', 1, 1, '2024-03-27 14:51:21', '{\"status\":\"add\",\"text\":\"Login as Administrator\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/123.0.0.0 Safari\\/537.36\",\"time\":\"2024-03-27 14:51:20\"}', '2024-03-27 14:51:21'),
('249597de-1dc4-452f-ac69-c6b254c52614', 1, 125, '2024-01-15 15:36:49', '{\"text\": \"Login as Nuzul Zaif\", \"time\": \"2024-01-15 15:36:49\", \"status\": \"add\", \"ip_address\": \"2001:448a:5122:3cee:439:aa1f:8010:715\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36\"}', '2024-01-15 15:36:49'),
('258c20ae-ee40-41cf-bf4e-b0698f6b3db1', 1, 159, '2024-02-21 01:06:11', '{\"status\":\"add\",\"text\":\"Login as Wali Siswa ID\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/121.0.0.0 Safari\\/537.36\",\"time\":\"2024-02-21 01:06:09\"}', '2024-02-21 01:06:11'),
('277c48c5-bcc3-488c-84d4-b2870acd1e8a', 1, 1, '2023-11-24 21:17:40', '{\"text\": \"Login as Nuzul\", \"time\": \"2023-11-24 21:17:40\", \"status\": \"add\", \"ip_address\": \"180.253.165.121\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36\"}', '2023-11-24 21:17:40'),
('27d75940-9238-4faf-a592-66f9be6d95fb', 1, 149, '2024-02-20 12:43:43', '{\"status\":\"add\",\"text\":\"Login as Konsekir\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/121.0.0.0 Safari\\/537.36\",\"time\":\"2024-02-20 12:43:43\"}', '2024-02-20 12:43:43'),
('284056b9-4fe4-4988-b9c9-bf2ddf11bf1d', 1, 1, '2024-01-20 13:19:58', '{\"status\":\"add\",\"text\":\"Login as Nuzul\",\"ip_address\":\"114.125.72.181\",\"user_agent\":\"Mozilla\\/5.0 (iPhone; CPU iPhone OS 17_2_1 like Mac OS X) AppleWebKit\\/605.1.15 (KHTML, like Gecko) Version\\/17.2 Mobile\\/15E148 Safari\\/604.1\",\"time\":\"2024-01-20 13:19:58\"}', '2024-01-20 13:19:58'),
('28aedadc-b84a-4bb3-b96f-44b3d6b5a9ce', 1, 63, '2023-11-17 18:12:49', '{\"text\": \"Login as Muhammad\", \"time\": \"2023-11-17 18:12:49\", \"status\": \"add\", \"ip_address\": \"182.3.38.176\", \"user_agent\": \"Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:109.0) Gecko/20100101 Firefox/119.0\"}', '2023-11-17 18:12:49'),
('2a430fd8-aaf4-4a01-b45f-325f177804de', 1, 125, '2023-11-16 13:27:33', '{\"text\": \"Login as Nuzul Zaif\", \"time\": \"2023-11-16 13:27:33\", \"status\": \"add\", \"ip_address\": \"2404:8000:1005:9fa1:4037:35b8:1c97:a2e4\", \"user_agent\": \"Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:109.0) Gecko/20100101 Firefox/119.0\"}', '2023-11-16 13:27:33'),
('2a8293e3-66d5-4148-a231-e8903efd1d04', 1, 125, '2023-12-31 21:46:12', '{\"text\": \"Login as Nuzul Zaif\", \"time\": \"2023-12-31 21:46:12\", \"status\": \"add\", \"ip_address\": \"103.115.31.27\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36\"}', '2023-12-31 21:46:12'),
('2ac616c1-8d2c-4dfb-b63b-a31654d4f0f3', 2, 125, '2024-01-12 21:44:41', '{\"text\": \"Anda berhasil melakukan permintaan deposit pada tanggal 2024-01-12 21:44:41\", \"status\": \"add\"}', '2024-01-12 21:44:41'),
('2b24cd7f-6180-4ca4-afdc-1f77fc9ec8cc', 1, 63, '2023-11-20 23:37:17', '{\"text\": \"Login as Muhammad\", \"time\": \"2023-11-20 23:37:17\", \"status\": \"add\", \"ip_address\": \"182.253.245.128\", \"user_agent\": \"Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Mobile Safari/537.36\"}', '2023-11-20 23:37:17'),
('2d212bcd-75f1-4ea2-a948-79edf7360043', 1, 125, '2024-01-12 21:44:15', '{\"text\": \"Login as Nuzul Zaif\", \"time\": \"2024-01-12 21:44:15\", \"status\": \"add\", \"ip_address\": \"103.3.58.141\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36\"}', '2024-01-12 21:44:15'),
('2f6bec00-c7bc-448b-934f-c4e4e02dfe8f', 1, 125, '2023-12-01 14:18:16', '{\"text\": \"Login as Nuzul Zaif\", \"time\": \"2023-12-01 14:18:16\", \"status\": \"add\", \"ip_address\": \"103.115.31.55\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36\"}', '2023-12-01 14:18:16'),
('2fe11e0e-fab6-42c3-b12f-63628107a561', 1, 125, '2023-11-26 14:12:00', '{\"text\": \"Login as Nuzul Zaif\", \"time\": \"2023-11-26 14:12:00\", \"status\": \"add\", \"ip_address\": \"103.18.184.5\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36\"}', '2023-11-26 14:12:00'),
('30143457-5eaf-4f17-b4ff-aa54287c3cfc', 1, 1, '2024-03-25 10:33:52', '{\"status\":\"add\",\"text\":\"Login as Nuzuls\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Safari\\/537.36\",\"time\":\"2024-03-25 10:33:52\"}', '2024-03-25 10:33:52'),
('307f85a6-e5b6-43c2-ab27-1b2c00c0acdb', 1, 64, '2024-01-04 20:29:44', '{\"text\": \"Login as Ahmad\", \"time\": \"2024-01-04 20:29:44\", \"status\": \"add\", \"ip_address\": \"140.213.57.102\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36\"}', '2024-01-04 20:29:44'),
('31acfeb9-4104-4fdb-9b7f-a00b4adac393', 1, 149, '2024-03-12 10:44:35', '{\"status\":\"add\",\"text\":\"Login as Konsekirs\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Safari\\/537.36\",\"time\":\"2024-03-12 10:44:35\"}', '2024-03-12 10:44:35'),
('31aeaba4-d299-49b3-a8d7-c3ce64191b4b', 1, 125, '2023-11-16 10:05:14', '{\"text\": \"Login as Nuzul Zaif\", \"time\": \"2023-11-16 10:05:14\", \"status\": \"add\", \"ip_address\": \"2001:448a:5122:1e92:780f:82d9:c859:3ade\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36\"}', '2023-11-16 10:05:14'),
('32671a2b-169b-4bda-b336-95fb37defdb0', 1, 63, '2023-11-18 09:11:09', '{\"text\": \"Login as Muhammad\", \"time\": \"2023-11-18 09:11:09\", \"status\": \"add\", \"ip_address\": \"182.253.245.128\", \"user_agent\": \"Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:109.0) Gecko/20100101 Firefox/119.0\"}', '2023-11-18 09:11:09'),
('35533562-6e16-4e56-a747-d4c72abd985f', 1, 159, '2024-03-15 11:24:31', '{\"status\":\"add\",\"text\":\"Login as Wali Siswa IDS\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Safari\\/537.36\",\"time\":\"2024-03-15 11:24:31\"}', '2024-03-15 11:24:31'),
('36e88a51-65e4-41c4-a487-3e8eac052ee3', 1, 125, '2023-11-28 20:43:57', '{\"text\": \"Login as Nuzul Zaif\", \"time\": \"2023-11-28 20:43:57\", \"status\": \"add\", \"ip_address\": \"103.165.40.244\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36\"}', '2023-11-28 20:43:57'),
('3744f498-3875-4398-aa7e-a7475c479b08', 1, 149, '2024-02-20 01:04:41', '{\"status\":\"add\",\"text\":\"Login as Konsekir\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/121.0.0.0 Safari\\/537.36\",\"time\":\"2024-02-20 01:04:41\"}', '2024-02-20 01:04:41'),
('37ba4c7b-99ff-4a8c-8677-08745f53d3e4', 1, 125, '2023-12-25 14:30:23', '{\"text\": \"Login as Nuzul Zaif\", \"time\": \"2023-12-25 14:30:23\", \"status\": \"add\", \"ip_address\": \"2001:448a:5122:9c3:92f:45bc:536a:a465\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36\"}', '2023-12-25 14:30:23'),
('38d46764-8e45-4251-94db-e58d2b718ea3', 1, 149, '2024-03-15 11:21:37', '{\"status\":\"add\",\"text\":\"Login as Konsekirs\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Safari\\/537.36\",\"time\":\"2024-03-15 11:21:37\"}', '2024-03-15 11:21:37'),
('39249912-9deb-4f02-94d8-631c092680d7', 1, 128, '2023-12-11 09:05:30', '{\"text\": \"Login as Yusfiwawansepriyadi\", \"time\": \"2023-12-11 09:05:30\", \"status\": \"add\", \"ip_address\": \"103.144.170.148\", \"user_agent\": \"Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Mobile Safari/537.36\"}', '2023-12-11 09:05:30'),
('39ea79b1-3771-4428-b3f1-4b5f1eaaf5b5', 1, 125, '2023-11-13 20:38:59', '{\"text\": \"Login as Nuzul Zaif\", \"time\": \"2023-11-13 20:38:59\", \"status\": \"add\", \"ip_address\": \"2001:448a:5122:1e92:443d:2660:b8fa:cb2c\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36\"}', '2023-11-13 20:38:59'),
('3a2dc8c1-0425-463a-998b-b55a21f0985a', 1, 125, '2023-11-16 11:00:54', '{\"text\": \"Login as Nuzul Zaif\", \"time\": \"2023-11-16 11:00:54\", \"status\": \"add\", \"ip_address\": \"2001:448a:5122:1e92:780f:82d9:c859:3ade\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36\"}', '2023-11-16 11:00:54'),
('3b88b824-aa21-4d07-b07b-ff9bb58eb5ad', 2, 63, '2023-11-28 23:34:37', '{\"text\": \"Anda berhasil melakukan permintaan deposit pada tanggal 2023-11-28 23:34:37\", \"status\": \"add\"}', '2023-11-28 23:34:37'),
('3c287d63-8352-493e-b4e2-ebfd37717185', 1, 125, '2023-11-20 22:15:14', '{\"text\": \"Login as Nuzul Zaif\", \"time\": \"2023-11-20 22:15:14\", \"status\": \"add\", \"ip_address\": \"180.253.166.242\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36\"}', '2023-11-20 22:15:14'),
('3c2eb65d-78b7-4729-82cc-e867cfa0b116', 1, 140, '2024-01-16 06:25:04', '{\"text\": \"Login as Yunda Nadia\", \"time\": \"2024-01-16 06:25:04\", \"status\": \"add\", \"ip_address\": \"36.81.181.249\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36\"}', '2024-01-16 06:25:04'),
('3c3ec29c-7e80-429e-aec0-d27cc67c414e', 1, 63, '2023-12-17 17:31:04', '{\"text\": \"Login as Muhammad\", \"time\": \"2023-12-17 17:31:04\", \"status\": \"add\", \"ip_address\": \"103.179.248.207\", \"user_agent\": \"Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Mobile Safari/537.36\"}', '2023-12-17 17:31:04'),
('3e8f24ad-53d1-4841-94d2-e4b8f39196d7', 2, 125, '2023-12-01 18:54:52', '{\"text\": \"Anda berhasil melakukan permintaan deposit pada tanggal 2023-12-01 18:54:52\", \"status\": \"add\"}', '2023-12-01 18:54:52'),
('3fe2393a-94b0-44ce-8b99-2a90307bf33e', 1, 125, '2023-12-08 17:39:42', '{\"text\": \"Login as Nuzul Zaif\", \"time\": \"2023-12-08 17:39:42\", \"status\": \"add\", \"ip_address\": \"103.18.184.5\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36\"}', '2023-12-08 17:39:42'),
('40d7c342-a0ab-4598-b86c-8a1fe1b1b2d5', 1, 1, '2024-01-01 00:25:19', '{\"text\": \"Login as Nuzul\", \"time\": \"2024-01-01 00:25:19\", \"status\": \"add\", \"ip_address\": \"103.115.31.27\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36\"}', '2024-01-01 00:25:19'),
('4133c6be-30d2-4338-8b4f-50928bfeb05e', 2, 1, '2023-11-16 10:41:32', '{\"text\": \"Insert a new user with email mhdrizqy@postamu.com\", \"status\": \"add\"}', '2023-11-16 10:41:32'),
('416486ed-9533-40ab-b2a4-ca5a1a35e7d4', 2, 63, '2023-12-01 18:54:11', '{\"text\": \"Anda berhasil melakukan permintaan deposit pada tanggal 2023-12-01 18:54:11\", \"status\": \"add\"}', '2023-12-01 18:54:11'),
('41c45315-1e66-43e9-aab3-728d1151e495', 2, 125, '2023-11-16 13:31:17', '{\"text\": \"Anda berhasil melakukan permintaan tarik tunai pada tanggal 2023-11-16 13:31:17\", \"status\": \"minus\"}', '2023-11-16 13:31:17'),
('421249ca-4169-4474-9193-ceaa55f6453e', 1, 92, '2023-12-17 22:18:29', '{\"text\": \"Login as Aldo\", \"time\": \"2023-12-17 22:18:29\", \"status\": \"add\", \"ip_address\": \"36.69.9.197\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36\"}', '2023-12-17 22:18:29'),
('423c175c-187e-4f65-80f8-04e1388eee6e', 1, 63, '2023-12-30 11:50:29', '{\"text\": \"Login as Muhammad\", \"time\": \"2023-12-30 11:50:29\", \"status\": \"add\", \"ip_address\": \"118.99.81.217\", \"user_agent\": \"Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Mobile Safari/537.36\"}', '2023-12-30 11:50:29'),
('42df082f-95dd-4964-aec9-b5d3bc1e8ba6', 1, 125, '2023-12-23 09:44:06', '{\"text\": \"Login as Nuzul Zaif\", \"time\": \"2023-12-23 09:44:06\", \"status\": \"add\", \"ip_address\": \"103.115.31.55\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36\"}', '2023-12-23 09:44:06'),
('4366847f-95fe-4e5b-914e-27663850891a', 1, 125, '2023-11-14 21:27:56', '{\"text\": \"Login as Nuzul Zaif\", \"time\": \"2023-11-14 21:27:56\", \"status\": \"add\", \"ip_address\": \"103.18.184.5\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36\"}', '2023-11-14 21:27:56'),
('443045a4-20c2-481d-a378-9132f0bcb8f8', 1, 125, '2023-12-06 19:43:26', '{\"text\": \"Login as Nuzul Zaif\", \"time\": \"2023-12-06 19:43:26\", \"status\": \"add\", \"ip_address\": \"103.165.40.244\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36\"}', '2023-12-06 19:43:26'),
('4567c26a-67b9-436f-95f8-502dd8febe94', 1, 1, '2023-12-20 13:28:37', '{\"text\": \"Login as Nuzul\", \"time\": \"2023-12-20 13:28:37\", \"status\": \"add\", \"ip_address\": \"2001:448a:5122:52f:1ccb:9da3:8671:f97e\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36\"}', '2023-12-20 13:28:37'),
('4592a16f-5040-43a0-9d1d-487a6d741677', 1, 159, '2024-03-15 10:32:49', '{\"status\":\"add\",\"text\":\"Login as Wali Siswa IDS\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Safari\\/537.36\",\"time\":\"2024-03-15 10:32:48\"}', '2024-03-15 10:32:49'),
('49829b10-a4e6-4900-8fbf-373096e15010', 1, 1, '2023-11-25 18:32:12', '{\"text\": \"Login as Nuzul\", \"time\": \"2023-11-25 18:32:12\", \"status\": \"add\", \"ip_address\": \"103.18.184.5\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36\"}', '2023-11-25 18:32:12'),
('49cc6dba-d007-41d1-9371-394ca109b119', 1, 1, '2024-01-22 12:26:30', '{\"status\":\"add\",\"text\":\"Login as Nuzul\",\"ip_address\":\"103.3.58.251\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/120.0.0.0 Safari\\/537.36\",\"time\":\"2024-01-22 12:26:30\"}', '2024-01-22 12:26:30'),
('4a377e23-66bb-4ddb-bc53-95c300d37684', 1, 125, '2023-12-28 12:32:37', '{\"text\": \"Login as Nuzul Zaif\", \"time\": \"2023-12-28 12:32:37\", \"status\": \"add\", \"ip_address\": \"103.115.31.55\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36\"}', '2023-12-28 12:32:37'),
('4b3089ee-19ca-400a-92b1-6ff278695a3f', 2, 63, '2023-11-17 18:39:32', '{\"text\": \"Anda berhasil melakukan transaksi baru pada tanggal 2023-11-17 18:39:32\", \"status\": \"add\"}', '2023-11-17 18:39:32'),
('4b60350b-5b16-4224-9bf1-86b40a305bb1', 1, 152, '2024-04-15 12:48:25', '{\"status\":\"add\",\"text\":\"Login as Dokter Irsyads\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/123.0.0.0 Safari\\/537.36\",\"time\":\"2024-04-15 12:48:25\"}', '2024-04-15 12:48:25'),
('4c4f933f-0494-4003-8723-9fe528c00fa0', 2, 63, '2023-11-17 18:13:02', '{\"text\": \"Anda berhasil mendaftarkan diri sebagai reseller pada tanggal 2023-11-17 18:13:02\", \"status\": \"add\"}', '2023-11-17 18:13:02'),
('4c535696-3fb5-4d04-b697-3cccd2b3c00f', 1, 131, '2023-12-10 21:01:32', '{\"text\": \"Login as Arif Rizqi\", \"time\": \"2023-12-10 21:01:32\", \"status\": \"add\", \"ip_address\": \"103.157.116.123\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36 Edg/119.0.0.0\"}', '2023-12-10 21:01:32'),
('4c7da5c1-2452-40f9-a700-9c2bc41c767b', 1, 125, '2023-12-26 20:45:17', '{\"text\": \"Login as Nuzul Zaif\", \"time\": \"2023-12-26 20:45:17\", \"status\": \"add\", \"ip_address\": \"103.115.31.55\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36\"}', '2023-12-26 20:45:17'),
('4d09d30e-48df-474e-b7e2-1e746d786ca4', 1, 1, '2023-12-04 07:53:00', '{\"text\": \"Login as Nuzul\", \"time\": \"2023-12-04 07:53:00\", \"status\": \"add\", \"ip_address\": \"103.115.31.27\", \"user_agent\": \"Mozilla/5.0 (iPhone; CPU iPhone OS 15_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/15.6 Mobile/15E148 Safari/604.1\"}', '2023-12-04 07:53:00'),
('4e1328ae-1cd2-4b0f-ad4c-6da398ad5986', 1, 129, '2023-11-29 12:07:51', '{\"text\": \"Login as firmansyah\", \"time\": \"2023-11-29 12:07:51\", \"status\": \"add\", \"ip_address\": \"180.248.29.67\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:120.0) Gecko/20100101 Firefox/120.0\"}', '2023-11-29 12:07:51'),
('4eb748c4-8f1a-4f01-b10f-ccdce44581d7', 1, 128, '2023-12-05 10:39:34', '{\"text\": \"Login as Yusfiwawansepriyadi\", \"time\": \"2023-12-05 10:39:34\", \"status\": \"add\", \"ip_address\": \"103.144.170.157\", \"user_agent\": \"Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Mobile Safari/537.36\"}', '2023-12-05 10:39:34'),
('518721e4-4a7f-43db-91b7-263a13ad658b', 1, 1, '2023-12-01 14:15:48', '{\"text\": \"Login as Nuzul\", \"time\": \"2023-12-01 14:15:48\", \"status\": \"add\", \"ip_address\": \"103.115.31.51\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36\"}', '2023-12-01 14:15:48'),
('525b32c7-6320-4305-bebb-4b60249380e3', 1, 129, '2023-12-03 15:10:11', '{\"text\": \"Login as firmansyah\", \"time\": \"2023-12-03 15:10:11\", \"status\": \"add\", \"ip_address\": \"36.85.73.193\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:120.0) Gecko/20100101 Firefox/120.0\"}', '2023-12-03 15:10:11'),
('53da6b04-f2ec-44e4-a868-cff045592a45', 2, 63, '2023-11-28 23:33:04', '{\"text\": \"Anda berhasil melakukan transaksi baru pada tanggal 2023-11-28 23:33:04\", \"status\": \"add\"}', '2023-11-28 23:33:04'),
('54862b85-7513-4f39-a6b2-cdf1cfe62fda', 2, 1, '2023-11-12 20:38:11', '{\"text\": \"Anda telah menambahkan saldo kepada pengguna sebesar 50000\", \"status\": \"add\"}', '2023-11-12 20:38:11'),
('54b20860-a036-4fc2-8666-32213fd8f861', 1, 85, '2024-01-06 07:10:21', '{\"text\": \"Login as Boslink\", \"time\": \"2024-01-06 07:10:21\", \"status\": \"add\", \"ip_address\": \"103.148.24.87\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36\"}', '2024-01-06 07:10:21'),
('553d9568-a385-4aa8-9df8-6370f9cf1184', 1, 125, '2023-11-17 18:03:40', '{\"text\": \"Login as Nuzul Zaif\", \"time\": \"2023-11-17 18:03:40\", \"status\": \"add\", \"ip_address\": \"103.18.184.5\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36\"}', '2023-11-17 18:03:40'),
('561db6c9-c1fd-4788-b26c-136130243805', 1, 125, '2023-11-29 20:09:02', '{\"text\": \"Login as Nuzul Zaif\", \"time\": \"2023-11-29 20:09:02\", \"status\": \"add\", \"ip_address\": \"2001:448a:5122:386c:7983:48f8:ac06:d94a\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36\"}', '2023-11-29 20:09:02'),
('56b11a7b-107e-40b7-820d-dfa2d6b3bdef', 1, 125, '2023-12-27 14:15:25', '{\"text\": \"Login as Nuzul Zaif\", \"time\": \"2023-12-27 14:15:25\", \"status\": \"add\", \"ip_address\": \"2001:448a:5122:b640:48e9:c00a:68e7:6222\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36\"}', '2023-12-27 14:15:25'),
('5755ee10-21ea-4149-b9b0-60afed7568f1', 1, 144, '2024-03-25 12:42:43', '{\"status\":\"add\",\"text\":\"Login as User\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Safari\\/537.36\",\"time\":\"2024-03-25 12:42:43\"}', '2024-03-25 12:42:43'),
('5949a3e5-799a-40db-b550-22912fc0f5fa', 1, 1, '2023-12-26 20:46:49', '{\"text\": \"Login as Nuzul\", \"time\": \"2023-12-26 20:46:49\", \"status\": \"add\", \"ip_address\": \"103.115.31.55\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36\"}', '2023-12-26 20:46:49'),
('59d3ac9c-1cb3-4e22-b8c9-6953f597b9c6', 1, 95, '2023-12-15 15:02:37', '{\"text\": \"Login as Khoiril\", \"time\": \"2023-12-15 15:02:37\", \"status\": \"add\", \"ip_address\": \"202.80.216.93\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36\"}', '2023-12-15 15:02:37'),
('5a295384-fd71-43d2-96cc-de93e8f61e5a', 2, 63, '2023-11-28 23:48:19', '{\"text\": \"Anda berhasil melakukan permintaan deposit pada tanggal 2023-11-28 23:48:19\", \"status\": \"add\"}', '2023-11-28 23:48:19'),
('5ac03537-f234-4c5b-a518-afab7f88519d', 1, 55, '2023-12-26 15:17:16', '{\"text\": \"Login as Alhijaz\", \"time\": \"2023-12-26 15:17:16\", \"status\": \"add\", \"ip_address\": \"110.137.194.28\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36\"}', '2023-12-26 15:17:16'),
('5b65d9e7-c8c9-4c49-b659-119678603e6d', 1, 136, '2023-12-29 21:36:09', '{\"text\": \"Login as Ahmad Nur Hamid\", \"time\": \"2023-12-29 21:36:09\", \"status\": \"add\", \"ip_address\": \"2001:448a:4021:232b:e1ef:1c07:36ea:1752\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:121.0) Gecko/20100101 Firefox/121.0\"}', '2023-12-29 21:36:09'),
('5cc25ad6-0535-4bae-8e7c-b0bf8cb0cbc4', 1, 128, '2024-01-04 21:11:59', '{\"text\": \"Login as Yusfiwawansepriyadi\", \"time\": \"2024-01-04 21:11:59\", \"status\": \"add\", \"ip_address\": \"103.144.170.174\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36\"}', '2024-01-04 21:11:59'),
('5ce50c0b-5b85-4e3e-a162-01e9befb53d0', 2, 125, '2023-11-15 14:18:58', '{\"text\": \"Anda berhasil melakukan permintaan tarik tunai pada tanggal 2023-11-15 14:18:58\", \"status\": \"add\"}', '2023-11-15 14:18:58'),
('5d9c20d9-9406-4da7-98cb-0dfc1a1f8bad', 1, 1, '2023-11-27 20:22:45', '{\"text\": \"Login as Nuzul\", \"time\": \"2023-11-27 20:22:45\", \"status\": \"add\", \"ip_address\": \"103.165.40.244\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36\"}', '2023-11-27 20:22:45'),
('5e4b1ce7-14d5-4724-9524-e6243208f5b5', 2, 63, '2023-11-28 23:34:09', '{\"text\": \"Anda berhasil melakukan permintaan deposit pada tanggal 2023-11-28 23:34:09\", \"status\": \"add\"}', '2023-11-28 23:34:09'),
('5e892f9e-e80b-4e1c-97b2-8e034c2be787', 1, 128, '2023-12-06 18:12:10', '{\"text\": \"Login as Yusfiwawansepriyadi\", \"time\": \"2023-12-06 18:12:10\", \"status\": \"add\", \"ip_address\": \"103.144.170.157\", \"user_agent\": \"Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Mobile Safari/537.36\"}', '2023-12-06 18:12:10'),
('5e8a6089-d21a-4705-b0c8-b6fa5b6a5b7e', 1, 63, '2023-11-13 20:45:01', '{\"text\": \"Login as Muhammad\", \"time\": \"2023-11-13 20:45:01\", \"status\": \"add\", \"ip_address\": \"2404:8000:1005:9fa1:fccd:3e4:5263:96a7\", \"user_agent\": \"Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:109.0) Gecko/20100101 Firefox/119.0\"}', '2023-11-13 20:45:01'),
('5e954007-ed7c-4011-b98f-9aa6f4768e34', 1, 1, '2024-04-12 12:33:42', '{\"status\":\"add\",\"text\":\"Login as Administrator\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/123.0.0.0 Safari\\/537.36\",\"time\":\"2024-04-12 12:33:41\"}', '2024-04-12 12:33:42'),
('5ea6e6e8-6ad0-4197-b65f-1673644ec0f2', 1, 64, '2024-01-04 20:32:22', '{\"text\": \"Login as Ahmad\", \"time\": \"2024-01-04 20:32:22\", \"status\": \"add\", \"ip_address\": \"140.213.57.102\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36\"}', '2024-01-04 20:32:22'),
('60289760-c1b7-4bf3-a7de-1f533be4b348', 2, 129, '2023-11-29 12:09:17', '{\"text\": \"Anda berhasil mendaftarkan diri sebagai reseller pada tanggal 2023-11-29 12:09:17\", \"status\": \"add\"}', '2023-11-29 12:09:17'),
('602a4853-fd77-44d4-b4d2-50f94965c793', 1, 1, '2024-04-02 15:15:33', '{\"status\":\"add\",\"text\":\"Login as Administrator\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/123.0.0.0 Safari\\/537.36\",\"time\":\"2024-04-02 15:15:33\"}', '2024-04-02 15:15:33'),
('6135ca57-f6e4-493b-b0de-2c0ce8c490cb', 1, 139, '2024-01-07 20:13:52', '{\"text\": \"Login as andre\", \"time\": \"2024-01-07 20:13:52\", \"status\": \"add\", \"ip_address\": \"129.227.44.38\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36\"}', '2024-01-07 20:13:52'),
('64c71c09-edc7-4662-91ab-0639f4427034', 2, 125, '2023-11-13 00:35:51', '{\"text\": \"Anda berhasil mendaftarkan diri sebagai reseller pada tanggal 2023-11-13 00:35:51\", \"status\": \"add\"}', '2023-11-13 00:35:51'),
('6525c458-017b-4c4c-be9c-f7fa65080292', 1, 125, '2023-11-29 13:02:50', '{\"text\": \"Login as Nuzul Zaif\", \"time\": \"2023-11-29 13:02:50\", \"status\": \"add\", \"ip_address\": \"103.18.184.5\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36\"}', '2023-11-29 13:02:50'),
('65b217a4-7535-4746-b076-239a3a2c794a', 1, 125, '2023-11-21 19:33:13', '{\"text\": \"Login as Nuzul Zaif\", \"time\": \"2023-11-21 19:33:13\", \"status\": \"add\", \"ip_address\": \"103.165.40.244\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36\"}', '2023-11-21 19:33:13'),
('65d29ae1-dd88-4715-819f-891ccba9dad5', 1, 92, '2023-12-15 15:23:23', '{\"text\": \"Login as Aldo\", \"time\": \"2023-12-15 15:23:23\", \"status\": \"add\", \"ip_address\": \"103.144.80.227\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36\"}', '2023-12-15 15:23:23'),
('6659bfe7-c83d-42f1-900f-2b1ba7988d24', 1, 63, '2023-11-28 20:17:42', '{\"text\": \"Login as Muhammad\", \"time\": \"2023-11-28 20:17:42\", \"status\": \"add\", \"ip_address\": \"2404:8000:1027:50c9:440:2925:36c:a988\", \"user_agent\": \"Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:120.0) Gecko/20100101 Firefox/120.0\"}', '2023-11-28 20:17:42'),
('66f8353f-372b-4d46-9aee-9460458c4f0c', 1, 125, '2023-11-13 11:50:11', '{\"text\": \"Login as Nuzul Zaif\", \"time\": \"2023-11-13 11:50:10\", \"status\": \"add\", \"ip_address\": \"127.0.0.1\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36\"}', '2023-11-13 11:50:11'),
('6725248a-c678-4506-947e-02a6345c4b93', 1, 1, '2024-02-21 01:50:35', '{\"status\":\"add\",\"text\":\"Login as Nuzuls\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/121.0.0.0 Safari\\/537.36\",\"time\":\"2024-02-21 01:50:35\"}', '2024-02-21 01:50:35'),
('698412e9-7453-4edc-a605-c50fd54467fa', 1, 63, '2024-01-15 14:27:33', '{\"text\": \"Login as Muhammad\", \"time\": \"2024-01-15 14:27:33\", \"status\": \"add\", \"ip_address\": \"182.253.245.184\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36\"}', '2024-01-15 14:27:33'),
('6a4e1b92-7f25-404c-a1d8-eca031762e85', 1, 85, '2023-12-12 07:15:57', '{\"text\": \"Login as Boslink\", \"time\": \"2023-12-12 07:15:57\", \"status\": \"add\", \"ip_address\": \"103.148.24.87\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36\"}', '2023-12-12 07:15:57'),
('6ac94419-4f3d-49a6-af45-dec95aa90430', 1, 1, '2023-11-16 10:34:56', '{\"text\": \"Login as Nuzul\", \"time\": \"2023-11-16 10:34:56\", \"status\": \"add\", \"ip_address\": \"2001:448a:5122:1e92:780f:82d9:c859:3ade\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36\"}', '2023-11-16 10:34:56'),
('6b094da9-e0fe-4734-b464-ce73bb3300fd', 1, 92, '2023-11-28 20:06:39', '{\"text\": \"Login as Aldo\", \"time\": \"2023-11-28 20:06:39\", \"status\": \"add\", \"ip_address\": \"36.69.8.224\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36\"}', '2023-11-28 20:06:39'),
('6b8cec3f-53b6-4476-bb8b-c23851f1fdbb', 1, 63, '2023-12-06 10:11:39', '{\"text\": \"Login as Muhammad\", \"time\": \"2023-12-06 10:11:39\", \"status\": \"add\", \"ip_address\": \"103.195.58.21\", \"user_agent\": \"Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:120.0) Gecko/20100101 Firefox/120.0\"}', '2023-12-06 10:11:39'),
('6bac295c-6f62-490c-b592-eeb731a4d3e4', 1, 63, '2023-11-17 16:08:46', '{\"text\": \"Login as Muhammad\", \"time\": \"2023-11-17 16:08:46\", \"status\": \"add\", \"ip_address\": \"182.253.127.158\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36\"}', '2023-11-17 16:08:46'),
('6da85f1f-0633-4df8-9d0d-9f4cf83ed06a', 1, 1, '2023-11-30 21:59:27', '{\"text\": \"Login as Nuzul\", \"time\": \"2023-11-30 21:59:27\", \"status\": \"add\", \"ip_address\": \"2001:448a:5122:2006:d54c:f40f:2d9d:b3bb\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36\"}', '2023-11-30 21:59:27'),
('71ee2ab5-5b60-4286-bdc4-823603cf9939', 1, 128, '2024-01-16 03:21:28', '{\"text\": \"Login as Yusfiwawansepriyadi\", \"time\": \"2024-01-16 03:21:28\", \"status\": \"add\", \"ip_address\": \"103.144.170.157\", \"user_agent\": \"Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Mobile Safari/537.36\"}', '2024-01-16 03:21:28'),
('720562d8-d2a4-4923-9091-f0adad80e2ca', 1, 1, '2024-01-20 09:30:30', '{\"status\":\"add\",\"text\":\"Login as Nuzul\",\"ip_address\":\"103.3.58.251\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/120.0.0.0 Safari\\/537.36\",\"time\":\"2024-01-20 09:30:30\"}', '2024-01-20 09:30:30'),
('72da2ab0-f93a-4801-9577-eabbd87274e2', 2, 92, '2023-11-28 20:07:36', '{\"text\": \"Anda berhasil mendaftarkan diri sebagai reseller pada tanggal 2023-11-28 20:07:36\", \"status\": \"add\"}', '2023-11-28 20:07:36'),
('740df73e-7137-4e6d-86e1-c28bcf653004', 1, 138, '2024-01-06 13:34:47', '{\"text\": \"Login as Gp\", \"time\": \"2024-01-06 13:34:47\", \"status\": \"add\", \"ip_address\": \"117.103.68.137\", \"user_agent\": \"Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Mobile Safari/537.36\"}', '2024-01-06 13:34:47'),
('7505e72c-eea1-4603-85fc-6a911c5fd797', 1, 125, '2023-12-01 16:01:30', '{\"text\": \"Login as Nuzul Zaif\", \"time\": \"2023-12-01 16:01:30\", \"status\": \"add\", \"ip_address\": \"103.115.31.55\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36\"}', '2023-12-01 16:01:30');
INSERT INTO `tbl_log_activity` (`uid`, `logType`, `causedBy`, `performedOn`, `withContent`, `created_at`) VALUES
('7687b317-383c-493c-95c9-f448927e3418', 1, 156, '2024-02-21 01:35:13', '{\"status\":\"add\",\"text\":\"Login as Siswa\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/121.0.0.0 Safari\\/537.36\",\"time\":\"2024-02-21 01:35:12\"}', '2024-02-21 01:35:13'),
('77406f8b-b50e-4906-bc8d-a6310a676ff0', 1, 140, '2024-01-15 17:35:26', '{\"text\": \"Login as Yunda Nadia\", \"time\": \"2024-01-15 17:35:26\", \"status\": \"add\", \"ip_address\": \"36.81.181.249\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36\"}', '2024-01-15 17:35:26'),
('798c24ff-d9b7-48b7-a115-cd5fc0f7ade3', 1, 85, '2023-12-03 12:50:35', '{\"text\": \"Login as Boslink\", \"time\": \"2023-12-03 12:50:35\", \"status\": \"add\", \"ip_address\": \"114.5.246.125\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36\"}', '2023-12-03 12:50:35'),
('79eaef8a-4954-4ec8-ae29-c005421a6713', 2, 125, '2023-11-28 20:48:07', '{\"text\": \"Anda berhasil melakukan permintaan deposit pada tanggal 2023-11-28 20:48:07\", \"status\": \"add\"}', '2023-11-28 20:48:07'),
('79f37ec7-4fe2-4133-b6e1-7fd054076e3f', 1, 1, '2024-01-12 21:43:32', '{\"text\": \"Login as Nuzul\", \"time\": \"2024-01-12 21:43:32\", \"status\": \"add\", \"ip_address\": \"103.3.58.141\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36\"}', '2024-01-12 21:43:32'),
('7a4f9ca8-d2ec-41f4-9b83-0acb8403c1e7', 1, 1, '2024-04-13 13:32:37', '{\"status\":\"add\",\"text\":\"Login as Administrator\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/123.0.0.0 Safari\\/537.36\",\"time\":\"2024-04-13 13:32:37\"}', '2024-04-13 13:32:37'),
('7a6c4bec-9242-4bab-a9ba-6e3e0a28ede9', 1, 1, '2023-11-13 15:27:37', '{\"text\": \"Login as Nuzul\", \"time\": \"2023-11-13 15:27:37\", \"status\": \"add\", \"ip_address\": \"2001:448a:5122:bec2:927:bbfe:b109:882f\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36\"}', '2023-11-13 15:27:37'),
('7b0a6bd8-4141-47d7-aa39-dd0aa3f4c666', 2, 63, '2023-12-01 17:11:43', '{\"text\": \"Anda berhasil melakukan permintaan deposit pada tanggal 2023-12-01 17:11:43\", \"status\": \"add\"}', '2023-12-01 17:11:43'),
('7b60e915-ba28-4c9d-adb3-0fd10f35a8e2', 1, 94, '2023-12-19 14:45:11', '{\"text\": \"Login as Jimmy\", \"time\": \"2023-12-19 14:45:11\", \"status\": \"add\", \"ip_address\": \"180.248.24.189\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:120.0) Gecko/20100101 Firefox/120.0\"}', '2023-12-19 14:45:11'),
('7d0f92e7-a53b-4bba-946d-76fa260823ee', 2, 63, '2023-11-20 23:37:57', '{\"text\": \"Anda berhasil melakukan transaksi baru pada tanggal 2023-11-20 23:37:57\", \"status\": \"add\"}', '2023-11-20 23:37:57'),
('7db5d680-11a5-4068-84a8-d1f43b2535c1', 1, 63, '2023-11-28 23:32:10', '{\"text\": \"Login as Muhammad\", \"time\": \"2023-11-28 23:32:10\", \"status\": \"add\", \"ip_address\": \"103.195.58.21\", \"user_agent\": \"Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:120.0) Gecko/20100101 Firefox/120.0\"}', '2023-11-28 23:32:10'),
('7dd96e5c-783c-4b1b-8b18-44833bee4035', 2, 140, '2024-01-09 21:54:14', '{\"text\": \"Anda berhasil mendaftarkan diri sebagai reseller pada tanggal 2024-01-09 21:54:14\", \"status\": \"add\"}', '2024-01-09 21:54:14'),
('7e7afad7-1a59-4523-bb0a-cdf50e543b1d', 2, 63, '2023-12-01 17:12:09', '{\"text\": \"Anda berhasil melakukan permintaan deposit pada tanggal 2023-12-01 17:12:09\", \"status\": \"add\"}', '2023-12-01 17:12:09'),
('804c8111-c4bf-4bcd-93d4-c02ab7fe9e66', 1, 1, '2024-01-22 13:40:57', '{\"status\":\"add\",\"text\":\"Login as Nuzul\",\"ip_address\":\"103.3.58.251\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/120.0.0.0 Safari\\/537.36\",\"time\":\"2024-01-22 13:40:57\"}', '2024-01-22 13:40:57'),
('80be0ef0-5c24-4ba1-86b6-db643cb71958', 1, 95, '2024-01-04 08:05:30', '{\"text\": \"Login as Khoiril\", \"time\": \"2024-01-04 08:05:30\", \"status\": \"add\", \"ip_address\": \"202.80.218.36\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36\"}', '2024-01-04 08:05:30'),
('825631b3-3098-4dd9-b3e3-7d43c0aee25e', 2, 125, '2023-11-15 14:20:00', '{\"text\": \"Anda berhasil melakukan pembatalan tarik tunai dengan kode invoice INV-1700032738-EMBLLQQD pada tanggal 2023-11-15 14:20:00\", \"status\": \"minus\"}', '2023-11-15 14:20:00'),
('825d9dc5-495e-433f-9583-7bfc9c799444', 2, 1, '2023-11-16 10:40:57', '{\"text\": \"Insert a new user with email mhdrizqy@postamu.com\", \"status\": \"add\"}', '2023-11-16 10:40:57'),
('831585e3-1c11-4b78-a2f3-16391ba5e483', 2, 63, '2023-12-01 18:54:55', '{\"text\": \"Anda berhasil melakukan transaksi baru pada tanggal 2023-12-01 18:54:55\", \"status\": \"add\"}', '2023-12-01 18:54:55'),
('84284783-6529-4d22-a807-57f8ca110f52', 1, 48, '2024-01-09 05:30:48', '{\"text\": \"Login as ilham\", \"time\": \"2024-01-09 05:30:48\", \"status\": \"add\", \"ip_address\": \"111.118.140.52\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36\"}', '2024-01-09 05:30:48'),
('84b82af4-46af-4293-a49d-f55a20c28615', 1, 125, '2023-12-07 11:50:41', '{\"text\": \"Login as Nuzul Zaif\", \"time\": \"2023-12-07 11:50:41\", \"status\": \"add\", \"ip_address\": \"2001:448a:5122:4b3:5809:9993:15df:fdcb\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36\"}', '2023-12-07 11:50:41'),
('8589f558-0818-4345-b534-cc6cca4d8ac6', 1, 63, '2024-01-05 09:44:35', '{\"text\": \"Login as Muhammad\", \"time\": \"2024-01-05 09:44:35\", \"status\": \"add\", \"ip_address\": \"2404:8000:1005:95e:88ae:fe90:184c:80b9\", \"user_agent\": \"Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:121.0) Gecko/20100101 Firefox/121.0\"}', '2024-01-05 09:44:35'),
('858adeec-6a0e-4023-ae64-f603dd400d8b', 1, 1, '2024-01-13 13:58:27', '{\"text\": \"Login as Nuzul\", \"time\": \"2024-01-13 13:58:27\", \"status\": \"add\", \"ip_address\": \"103.115.31.27\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36\"}', '2024-01-13 13:58:27'),
('8605cdb8-022e-4033-a44b-312f79dd6b2d', 1, 144, '2024-04-02 15:04:39', '{\"status\":\"add\",\"text\":\"Login as User KPS\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/123.0.0.0 Safari\\/537.36\",\"time\":\"2024-04-02 15:04:39\"}', '2024-04-02 15:04:39'),
('88f90761-1fcd-405f-ba1d-8e66f594da1a', 1, 129, '2023-11-30 10:36:30', '{\"text\": \"Login as firmansyah\", \"time\": \"2023-11-30 10:36:30\", \"status\": \"add\", \"ip_address\": \"180.248.29.67\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:120.0) Gecko/20100101 Firefox/120.0\"}', '2023-11-30 10:36:30'),
('8ab71a7b-ad2a-49b5-b36e-1fed9e4cf6d1', 2, 1, '2024-01-31 22:25:16', '{\"status\":\"add\",\"text\":\"Insert a new user with email kepsek@smapa.com\"}', '2024-01-31 22:25:16'),
('8f86cc34-470b-4639-aa93-b90b2ed8c3e7', 1, 1, '2024-04-02 13:49:58', '{\"status\":\"add\",\"text\":\"Login as Administrator\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/123.0.0.0 Safari\\/537.36\",\"time\":\"2024-04-02 13:49:51\"}', '2024-04-02 13:49:58'),
('90726034-3659-46f9-aebf-77514128da72', 1, 129, '2023-12-18 13:00:43', '{\"text\": \"Login as firmansyah\", \"time\": \"2023-12-18 13:00:43\", \"status\": \"add\", \"ip_address\": \"180.248.21.42\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:120.0) Gecko/20100101 Firefox/120.0\"}', '2023-12-18 13:00:43'),
('91a22387-b511-4a44-8fbd-fbf29a6f94ce', 1, 1, '2023-11-17 18:08:29', '{\"text\": \"Login as Nuzul\", \"time\": \"2023-11-17 18:08:29\", \"status\": \"add\", \"ip_address\": \"103.18.184.5\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36\"}', '2023-11-17 18:08:29'),
('937c0147-5ecb-458a-81f3-d3b89e00e15c', 1, 1, '2023-11-23 23:28:17', '{\"text\": \"Login as Nuzul\", \"time\": \"2023-11-23 23:28:17\", \"status\": \"add\", \"ip_address\": \"103.18.184.5\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36\"}', '2023-11-23 23:28:17'),
('94e07eb1-ccc7-4f49-a833-16f72be1ee66', 2, 125, '2023-11-28 20:48:22', '{\"text\": \"Anda berhasil melakukan permintaan deposit pada tanggal 2023-11-28 20:48:22\", \"status\": \"add\"}', '2023-11-28 20:48:22'),
('96059158-2219-4131-9922-d9162121b026', 1, 1, '2023-11-13 13:27:32', '{\"text\": \"Login as Nuzul\", \"time\": \"2023-11-13 13:27:32\", \"status\": \"add\", \"ip_address\": \"127.0.0.1\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36\"}', '2023-11-13 13:27:32'),
('997314af-2b1f-4df1-8757-f310b3eaedb3', 1, 1, '2024-02-19 20:06:16', '{\"status\":\"add\",\"text\":\"Login as Nuzuls\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/121.0.0.0 Safari\\/537.36\",\"time\":\"2024-02-19 20:06:14\"}', '2024-02-19 20:06:16'),
('99fd28ac-1d71-410d-9b6f-0389979bcd31', 1, 1, '2024-01-21 20:44:49', '{\"status\":\"add\",\"text\":\"Login as Nuzul\",\"ip_address\":\"103.3.58.251\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/120.0.0.0 Safari\\/537.36\",\"time\":\"2024-01-21 20:44:49\"}', '2024-01-21 20:44:49'),
('9ae36b91-7f94-4b26-b9d5-e3586cf38a9a', 1, 144, '2024-02-21 02:05:57', '{\"status\":\"add\",\"text\":\"Login as Kepala Sekolah ID\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/121.0.0.0 Safari\\/537.36\",\"time\":\"2024-02-21 02:05:57\"}', '2024-02-21 02:05:57'),
('9b59c475-a6b0-49f7-a482-9103914e869c', 1, 125, '2023-12-21 12:02:14', '{\"text\": \"Login as Nuzul Zaif\", \"time\": \"2023-12-21 12:02:14\", \"status\": \"add\", \"ip_address\": \"2001:448a:5122:52f:554f:1d37:dfc:f7b8\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36\"}', '2023-12-21 12:02:14'),
('9bf51743-84b7-4375-9395-ea9ea864d581', 2, 125, '2023-12-01 14:19:33', '{\"text\": \"Anda berhasil melakukan permintaan deposit pada tanggal 2023-12-01 14:19:33\", \"status\": \"add\"}', '2023-12-01 14:19:33'),
('9ce9f29e-a114-4595-91da-c00248aab73e', 1, 1, '2024-03-25 23:51:03', '{\"status\":\"add\",\"text\":\"Login as Administrator\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Safari\\/537.36\",\"time\":\"2024-03-25 23:51:01\"}', '2024-03-25 23:51:03'),
('9e17bd91-f93a-4693-b07a-065a67347da8', 1, 63, '2024-01-03 11:56:49', '{\"text\": \"Login as Muhammad\", \"time\": \"2024-01-03 11:56:49\", \"status\": \"add\", \"ip_address\": \"182.0.146.163\", \"user_agent\": \"Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Mobile Safari/537.36\"}', '2024-01-03 11:56:49'),
('9ea72c45-c3fb-4739-a462-2b75c72e08a5', 1, 1, '2024-01-19 14:01:33', '{\"status\":\"add\",\"text\":\"Login as Nuzul\",\"ip_address\":\"103.115.31.53\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/120.0.0.0 Safari\\/537.36\",\"time\":\"2024-01-19 14:01:33\"}', '2024-01-19 14:01:33'),
('a0580784-78b6-4e3a-a791-3f26bf1b790a', 1, 126, '2024-01-05 09:33:02', '{\"text\": \"Login as Mhd Rizqy\", \"time\": \"2024-01-05 09:33:02\", \"status\": \"add\", \"ip_address\": \"2404:8000:1005:95e:88ae:fe90:184c:80b9\", \"user_agent\": \"Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:121.0) Gecko/20100101 Firefox/121.0\"}', '2024-01-05 09:33:02'),
('a0903e16-6b5b-4a72-9b55-1f53b6dbf893', 1, 128, '2023-12-08 15:18:50', '{\"text\": \"Login as Yusfiwawansepriyadi\", \"time\": \"2023-12-08 15:18:50\", \"status\": \"add\", \"ip_address\": \"103.144.170.148\", \"user_agent\": \"Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Mobile Safari/537.36\"}', '2023-12-08 15:18:50'),
('a0df9dfe-728f-4336-90ec-894c63a37b2f', 1, 144, '2024-03-31 19:53:04', '{\"status\":\"add\",\"text\":\"Login as User\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/123.0.0.0 Safari\\/537.36\",\"time\":\"2024-03-31 19:53:04\"}', '2024-03-31 19:53:04'),
('a101f58c-008f-416a-ba76-c11fe62cf4d4', 1, 63, '2023-11-17 18:10:10', '{\"text\": \"Login as Muhammad\", \"time\": \"2023-11-17 18:10:10\", \"status\": \"add\", \"ip_address\": \"182.3.38.176\", \"user_agent\": \"Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Mobile Safari/537.36\"}', '2023-11-17 18:10:10'),
('a14ee7d2-18a4-44dd-91bd-8e58965f0b06', 1, 125, '2023-12-19 11:04:27', '{\"text\": \"Login as Nuzul Zaif\", \"time\": \"2023-12-19 11:04:27\", \"status\": \"add\", \"ip_address\": \"2001:448a:5122:52f:fc7c:c4d:b974:7cbb\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36\"}', '2023-12-19 11:04:27'),
('a29a3e4c-6f5a-437c-849c-567ffd6a24ab', 1, 1, '2024-04-18 00:40:46', '{\"status\":\"add\",\"text\":\"Login as Administrator\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/123.0.0.0 Safari\\/537.36\",\"time\":\"2024-04-18 00:40:46\"}', '2024-04-18 00:40:46'),
('a5d13aa2-650e-4986-a304-894d6dc8ff85', 1, 1, '2024-04-13 14:02:17', '{\"status\":\"add\",\"text\":\"Login as Administrator\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/123.0.0.0 Safari\\/537.36\",\"time\":\"2024-04-13 14:02:17\"}', '2024-04-13 14:02:17'),
('a6215875-92d7-4529-80b7-e03b73e79fdd', 1, 159, '2024-03-15 11:20:38', '{\"status\":\"add\",\"text\":\"Login as Wali Siswa IDS\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Safari\\/537.36\",\"time\":\"2024-03-15 11:20:38\"}', '2024-03-15 11:20:38'),
('a631c487-68cf-4e2e-a899-96af70332eed', 2, 48, '2024-01-09 05:32:04', '{\"text\": \"Anda berhasil melakukan permintaan deposit pada tanggal 2024-01-09 05:32:04\", \"status\": \"add\"}', '2024-01-09 05:32:04'),
('a66c797c-7e9c-45d1-be79-03604308bb99', 2, 125, '2023-11-28 21:43:18', '{\"text\": \"Anda berhasil melakukan permintaan deposit pada tanggal 2023-11-28 21:43:18\", \"status\": \"add\"}', '2023-11-28 21:43:18'),
('a8d5e100-5245-422a-903f-1585716e0904', 1, 1, '2024-01-31 21:12:28', '{\"status\":\"add\",\"text\":\"Login as Nuzul\",\"ip_address\":\"103.115.31.51\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/121.0.0.0 Safari\\/537.36\",\"time\":\"2024-01-31 21:12:28\"}', '2024-01-31 21:12:28'),
('a903d028-49af-4d8d-a194-87b27678f587', 1, 128, '2024-01-09 01:51:24', '{\"text\": \"Login as Yusfiwawansepriyadi\", \"time\": \"2024-01-09 01:51:24\", \"status\": \"add\", \"ip_address\": \"103.144.170.174\", \"user_agent\": \"Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Mobile Safari/537.36\"}', '2024-01-09 01:51:24'),
('a96629e0-d99e-44b0-aa6e-aa28d60e8f15', 1, 1, '2024-02-02 14:14:55', '{\"status\":\"add\",\"text\":\"Login as Nuzuls\",\"ip_address\":\"36.73.189.247\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/121.0.0.0 Safari\\/537.36\",\"time\":\"2024-02-02 14:14:55\"}', '2024-02-02 14:14:55'),
('aa52dd64-c70a-4ab8-832b-feaf676c8a65', 1, 128, '2023-12-05 15:23:05', '{\"text\": \"Login as Yusfiwawansepriyadi\", \"time\": \"2023-12-05 15:23:05\", \"status\": \"add\", \"ip_address\": \"103.144.170.157\", \"user_agent\": \"Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Mobile Safari/537.36\"}', '2023-12-05 15:23:05'),
('aad69c58-3ab3-4668-832e-987ffa027848', 1, 1, '2024-04-13 14:57:45', '{\"status\":\"add\",\"text\":\"Login as Administrator\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/123.0.0.0 Safari\\/537.36\",\"time\":\"2024-04-13 14:57:45\"}', '2024-04-13 14:57:45'),
('ac3e0033-36c8-417c-8710-83c44124475f', 1, 128, '2024-01-07 00:46:42', '{\"text\": \"Login as Yusfiwawansepriyadi\", \"time\": \"2024-01-07 00:46:42\", \"status\": \"add\", \"ip_address\": \"103.144.170.174\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36\"}', '2024-01-07 00:46:42'),
('adb71d11-1ea1-4492-aad0-9e3323c0e105', 1, 63, '2023-11-20 16:34:14', '{\"text\": \"Login as Muhammad\", \"time\": \"2023-11-20 16:34:14\", \"status\": \"add\", \"ip_address\": \"182.3.45.200\", \"user_agent\": \"Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Mobile Safari/537.36\"}', '2023-11-20 16:34:14'),
('ae76b53e-8073-439a-bf30-04e433e1de49', 1, 129, '2023-12-11 16:10:16', '{\"text\": \"Login as firmansyah\", \"time\": \"2023-12-11 16:10:16\", \"status\": \"add\", \"ip_address\": \"180.248.24.114\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:120.0) Gecko/20100101 Firefox/120.0\"}', '2023-12-11 16:10:16'),
('aede96ff-161d-4163-9a92-c4903d21f863', 1, 128, '2023-12-30 21:57:17', '{\"text\": \"Login as Yusfiwawansepriyadi\", \"time\": \"2023-12-30 21:57:17\", \"status\": \"add\", \"ip_address\": \"182.2.52.95\", \"user_agent\": \"Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Mobile Safari/537.36\"}', '2023-12-30 21:57:17'),
('aee1928e-e86c-4fdc-a2f7-1bb9ae7a01df', 1, 85, '2023-11-28 12:54:17', '{\"text\": \"Login as Boslink\", \"time\": \"2023-11-28 12:54:17\", \"status\": \"add\", \"ip_address\": \"103.148.24.87\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36\"}', '2023-11-28 12:54:17'),
('b113bb41-8e01-4d21-81be-3a709df979bc', 1, 85, '2023-12-11 08:33:33', '{\"text\": \"Login as Boslink\", \"time\": \"2023-12-11 08:33:33\", \"status\": \"add\", \"ip_address\": \"103.148.24.87\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36\"}', '2023-12-11 08:33:33'),
('b1563530-39ce-4ce3-b981-4092688b3134', 1, 128, '2023-12-08 23:12:29', '{\"text\": \"Login as Yusfiwawansepriyadi\", \"time\": \"2023-12-08 23:12:29\", \"status\": \"add\", \"ip_address\": \"103.144.170.148\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36\"}', '2023-12-08 23:12:29'),
('b2857360-1e1e-4421-a8bc-9f53132474b1', 1, 125, '2023-11-17 18:14:21', '{\"text\": \"Login as Nuzul Zaif\", \"time\": \"2023-11-17 18:14:21\", \"status\": \"add\", \"ip_address\": \"103.18.184.5\", \"user_agent\": \"Mozilla/5.0 (iPhone; CPU iPhone OS 14_0 like Mac OS X) AppleWebKit/603.1.30 (KHTML, like Gecko) Version/12.0.0 Mobile/15A5370a Safari/602.1\"}', '2023-11-17 18:14:21'),
('b31b613d-c668-470f-af08-3146258a550f', 2, 137, '2024-01-04 20:35:12', '{\"text\": \"Anda berhasil mendaftarkan diri sebagai reseller pada tanggal 2024-01-04 20:35:12\", \"status\": \"add\"}', '2024-01-04 20:35:12'),
('b333d98e-607d-49d5-90bc-5a6c63dc7ccd', 1, 137, '2024-01-04 20:36:46', '{\"text\": \"Login as Muchammad Farid\", \"time\": \"2024-01-04 20:36:46\", \"status\": \"add\", \"ip_address\": \"140.213.57.102\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36\"}', '2024-01-04 20:36:46'),
('b4027326-8666-4d48-aecd-1601e5e1fd2c', 1, 125, '2023-12-13 18:29:23', '{\"text\": \"Login as Nuzul Zaif\", \"time\": \"2023-12-13 18:29:23\", \"status\": \"add\", \"ip_address\": \"103.115.31.51\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36\"}', '2023-12-13 18:29:23'),
('b429676d-129f-4a3c-ad1e-455e01500e81', 1, 128, '2023-12-14 11:35:08', '{\"text\": \"Login as Yusfiwawansepriyadi\", \"time\": \"2023-12-14 11:35:08\", \"status\": \"add\", \"ip_address\": \"112.215.122.13\", \"user_agent\": \"Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Mobile Safari/537.36\"}', '2023-12-14 11:35:08'),
('b5e31cbb-b266-4364-8581-dd9dde309b93', 1, 129, '2023-11-29 19:26:09', '{\"text\": \"Login as firmansyah\", \"time\": \"2023-11-29 19:26:09\", \"status\": \"add\", \"ip_address\": \"180.248.29.67\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:120.0) Gecko/20100101 Firefox/120.0\"}', '2023-11-29 19:26:09'),
('b65898a3-572e-4257-9975-8e7de23f0399', 1, 63, '2024-01-15 10:22:26', '{\"text\": \"Login as Muhammad\", \"time\": \"2024-01-15 10:22:26\", \"status\": \"add\", \"ip_address\": \"182.253.245.184\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36\"}', '2024-01-15 10:22:26'),
('b6ddc67d-db43-4c58-a793-77e57abc5d22', 1, 125, '2023-12-01 18:51:42', '{\"text\": \"Login as Nuzul Zaif\", \"time\": \"2023-12-01 18:51:42\", \"status\": \"add\", \"ip_address\": \"103.115.31.27\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36\"}', '2023-12-01 18:51:42'),
('b818d0f0-c327-4c35-a440-49f14f2ba9a1', 2, 1, '2023-11-16 10:42:17', '{\"text\": \"Insert a new user with email mhdrizqy@postamu.com\", \"status\": \"add\"}', '2023-11-16 10:42:17'),
('b9a601e4-f662-4de0-9e2b-c29a8c589fff', 2, 138, '2024-01-06 13:35:21', '{\"text\": \"Anda berhasil mendaftarkan diri sebagai reseller pada tanggal 2024-01-06 13:35:21\", \"status\": \"add\"}', '2024-01-06 13:35:21'),
('b9c74d04-f4b4-4a4a-9829-c9975b908214', 1, 149, '2024-02-21 02:04:21', '{\"status\":\"add\",\"text\":\"Login as Konsekirs\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/121.0.0.0 Safari\\/537.36\",\"time\":\"2024-02-21 02:04:21\"}', '2024-02-21 02:04:21'),
('bbb58ca2-824c-40f7-b5fb-5ad09d57a25a', 1, 125, '2023-11-30 01:04:46', '{\"text\": \"Login as Nuzul Zaif\", \"time\": \"2023-11-30 01:04:46\", \"status\": \"add\", \"ip_address\": \"103.18.184.5\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36\"}', '2023-11-30 01:04:46'),
('bbc9085a-784d-4588-a46a-f88d5db06ded', 1, 129, '2023-12-01 15:25:46', '{\"text\": \"Login as firmansyah\", \"time\": \"2023-12-01 15:25:46\", \"status\": \"add\", \"ip_address\": \"36.85.73.193\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:120.0) Gecko/20100101 Firefox/120.0\"}', '2023-12-01 15:25:46'),
('bc683347-337b-42bd-89f5-c1bd34f73bd4', 1, 1, '2024-04-14 21:06:53', '{\"status\":\"add\",\"text\":\"Login as Administrator\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/123.0.0.0 Safari\\/537.36\",\"time\":\"2024-04-14 21:06:53\"}', '2024-04-14 21:06:53'),
('c00726d4-4f6c-4431-8453-ba326c7884fb', 1, 128, '2023-12-27 23:10:54', '{\"text\": \"Login as Yusfiwawansepriyadi\", \"time\": \"2023-12-27 23:10:54\", \"status\": \"add\", \"ip_address\": \"182.2.78.225\", \"user_agent\": \"Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Mobile Safari/537.36\"}', '2023-12-27 23:10:54'),
('c01d52bb-3e57-4126-82b0-cd3381f51bc3', 1, 1, '2024-03-28 13:36:05', '{\"status\":\"add\",\"text\":\"Login as Administrator\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/123.0.0.0 Safari\\/537.36\",\"time\":\"2024-03-28 13:36:04\"}', '2024-03-28 13:36:05'),
('c110b2fb-a6b1-4a44-bc0a-26d156aa0207', 2, 125, '2023-11-16 13:35:06', '{\"text\": \"Anda berhasil melakukan transaksi baru pada tanggal 2023-11-16 13:35:06\", \"status\": \"add\"}', '2023-11-16 13:35:06'),
('c1317e66-7a72-4942-adcf-61bd914ac5d0', 1, 128, '2023-12-12 22:18:25', '{\"text\": \"Login as Yusfiwawansepriyadi\", \"time\": \"2023-12-12 22:18:25\", \"status\": \"add\", \"ip_address\": \"103.144.170.148\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36\"}', '2023-12-12 22:18:25'),
('c220c894-a177-434e-98d2-8804e678f734', 2, 63, '2023-12-12 12:48:36', '{\"text\": \"Anda berhasil melakukan permintaan deposit pada tanggal 2023-12-12 12:48:36\", \"status\": \"add\"}', '2023-12-12 12:48:36'),
('c353cb67-3599-4697-8cd2-1f8ce14b3e27', 1, 136, '2023-12-29 21:30:50', '{\"text\": \"Login as Ahmad Nur Hamid\", \"time\": \"2023-12-29 21:30:50\", \"status\": \"add\", \"ip_address\": \"2001:448a:4021:232b:e1ef:1c07:36ea:1752\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:121.0) Gecko/20100101 Firefox/121.0\"}', '2023-12-29 21:30:50'),
('c3bbf948-3b8c-4e63-a69e-2e9766f85b84', 1, 155, '2024-04-13 14:58:48', '{\"status\":\"add\",\"text\":\"Login as Rahma\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/123.0.0.0 Safari\\/537.36\",\"time\":\"2024-04-13 14:58:48\"}', '2024-04-13 14:58:48'),
('c407be98-2704-44cc-b599-4414abbcb78d', 1, 63, '2024-01-09 13:43:59', '{\"text\": \"Login as Muhammad\", \"time\": \"2024-01-09 13:43:59\", \"status\": \"add\", \"ip_address\": \"182.253.127.186\", \"user_agent\": \"Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36\"}', '2024-01-09 13:43:59'),
('c450c288-1ce7-4e55-9872-47f218d3c408', 1, 125, '2024-01-01 13:36:25', '{\"text\": \"Login as Nuzul Zaif\", \"time\": \"2024-01-01 13:36:24\", \"status\": \"add\", \"ip_address\": \"103.115.31.51\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36\"}', '2024-01-01 13:36:25'),
('c52fdc05-44cf-483f-bb8e-8ae758d8d949', 1, 63, '2023-12-01 17:11:32', '{\"text\": \"Login as Muhammad\", \"time\": \"2023-12-01 17:11:32\", \"status\": \"add\", \"ip_address\": \"103.195.58.21\", \"user_agent\": \"Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Mobile Safari/537.36\"}', '2023-12-01 17:11:32'),
('c532846e-7d85-4f7f-99ab-c6153e15ec69', 1, 85, '2023-12-01 10:04:22', '{\"text\": \"Login as Boslink\", \"time\": \"2023-12-01 10:04:22\", \"status\": \"add\", \"ip_address\": \"103.148.24.87\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36\"}', '2023-12-01 10:04:22'),
('c5d67b6b-a101-4f25-a8ca-de23a718bc86', 1, 1, '2024-03-25 13:51:58', '{\"status\":\"add\",\"text\":\"Login as Administrator\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Safari\\/537.36\",\"time\":\"2024-03-25 13:51:58\"}', '2024-03-25 13:51:58'),
('c6f9d805-d1a4-4e09-97e2-b1883b26e2aa', 1, 1, '2024-04-02 19:35:54', '{\"status\":\"add\",\"text\":\"Login as Administrator\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/123.0.0.0 Safari\\/537.36\",\"time\":\"2024-04-02 19:35:52\"}', '2024-04-02 19:35:54'),
('c7ace661-e436-4bd0-9b02-ae7adf90e9ec', 2, 125, '2023-12-01 18:55:34', '{\"text\": \"Anda berhasil melakukan permintaan deposit pada tanggal 2023-12-01 18:55:34\", \"status\": \"add\"}', '2023-12-01 18:55:34'),
('c7b031f8-d851-4ff9-9230-4dc86c737a79', 1, 128, '2023-12-23 21:05:29', '{\"text\": \"Login as Yusfiwawansepriyadi\", \"time\": \"2023-12-23 21:05:29\", \"status\": \"add\", \"ip_address\": \"103.144.170.136\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36\"}', '2023-12-23 21:05:29'),
('c7dc532e-e298-43fc-bc2d-200aba14fe57', 1, 155, '2024-04-13 14:59:35', '{\"status\":\"add\",\"text\":\"Login as Rahma\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/123.0.0.0 Safari\\/537.36\",\"time\":\"2024-04-13 14:59:35\"}', '2024-04-13 14:59:35'),
('c9cbf64d-204f-4a8a-9bbf-d6215830a989', 1, 125, '2023-12-11 11:36:30', '{\"text\": \"Login as Nuzul Zaif\", \"time\": \"2023-12-11 11:36:30\", \"status\": \"add\", \"ip_address\": \"103.115.31.27\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36\"}', '2023-12-11 11:36:30'),
('cb1be785-c654-4421-9320-76dc44a771d2', 1, 1, '2024-03-27 10:56:45', '{\"status\":\"add\",\"text\":\"Login as Administrator\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/123.0.0.0 Safari\\/537.36\",\"time\":\"2024-03-27 10:56:45\"}', '2024-03-27 10:56:45'),
('cb9d65e0-79ff-48ea-83c0-e0ef87d99979', 1, 63, '2023-11-30 22:15:52', '{\"text\": \"Login as Muhammad\", \"time\": \"2023-11-30 22:15:52\", \"status\": \"add\", \"ip_address\": \"182.0.135.57\", \"user_agent\": \"Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Mobile Safari/537.36\"}', '2023-11-30 22:15:52'),
('cca22869-9832-4cfd-8a36-9ba78c7aba7f', 1, 1, '2024-04-18 19:27:10', '{\"status\":\"add\",\"text\":\"Login as Administrator\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/123.0.0.0 Safari\\/537.36\",\"time\":\"2024-04-18 19:27:09\"}', '2024-04-18 19:27:10'),
('cd3f4ac7-c27c-43c0-bed5-673a60d85bf7', 1, 159, '2024-02-20 15:22:05', '{\"status\":\"add\",\"text\":\"Login as Wali Siswa ID\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/121.0.0.0 Safari\\/537.36\",\"time\":\"2024-02-20 15:22:05\"}', '2024-02-20 15:22:05'),
('cd96bf06-ce16-4be6-9ccf-21be8cb8a49e', 1, 128, '2023-12-13 19:01:23', '{\"text\": \"Login as Yusfiwawansepriyadi\", \"time\": \"2023-12-13 19:01:23\", \"status\": \"add\", \"ip_address\": \"140.213.175.89\", \"user_agent\": \"Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Mobile Safari/537.36\"}', '2023-12-13 19:01:23'),
('ce43b871-41dc-41a7-932e-7e04d21fac18', 2, 125, '2023-11-29 20:09:33', '{\"text\": \"Anda berhasil melakukan permintaan deposit pada tanggal 2023-11-29 20:09:33\", \"status\": \"add\"}', '2023-11-29 20:09:33'),
('ce7cf426-1678-4979-be06-6fbdf35f553a', 1, 125, '2023-12-08 23:27:21', '{\"text\": \"Login as Nuzul Zaif\", \"time\": \"2023-12-08 23:27:21\", \"status\": \"add\", \"ip_address\": \"103.18.184.5\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36\"}', '2023-12-08 23:27:21'),
('d1106273-3dfa-4b34-b7d0-8046b092492e', 1, 1, '2023-11-14 21:26:54', '{\"text\": \"Login as Nuzul\", \"time\": \"2023-11-14 21:26:54\", \"status\": \"add\", \"ip_address\": \"103.18.184.5\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36\"}', '2023-11-14 21:26:54'),
('d1734d87-6ff6-4c04-8183-2c59589c89ba', 1, 144, '2024-02-21 01:24:02', '{\"status\":\"add\",\"text\":\"Login as Kepala Sekolah\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/121.0.0.0 Safari\\/537.36\",\"time\":\"2024-02-21 01:24:02\"}', '2024-02-21 01:24:02'),
('d52e1bc9-39cd-4340-ac57-3579f3f2574b', 1, 1, '2023-12-25 14:31:37', '{\"text\": \"Login as Nuzul\", \"time\": \"2023-12-25 14:31:37\", \"status\": \"add\", \"ip_address\": \"2001:448a:5122:9c3:92f:45bc:536a:a465\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36\"}', '2023-12-25 14:31:37'),
('d5f43294-e943-40a6-92c7-81d4bc27fc48', 1, 144, '2024-03-25 12:38:08', '{\"status\":\"add\",\"text\":\"Login as User\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Safari\\/537.36\",\"time\":\"2024-03-25 12:38:08\"}', '2024-03-25 12:38:08'),
('d62dde89-206f-4286-8e9d-b97314323c46', 2, 125, '2023-11-30 21:37:26', '{\"text\": \"Anda berhasil melakukan transaksi baru pada tanggal 2023-11-30 21:37:26\", \"status\": \"add\"}', '2023-11-30 21:37:26'),
('d62fe28d-673e-4dad-97c6-e3fccfbcc658', 1, 140, '2024-01-09 21:52:37', '{\"text\": \"Login as Yunda Nadia\", \"time\": \"2024-01-09 21:52:37\", \"status\": \"add\", \"ip_address\": \"36.81.192.254\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36\"}', '2024-01-09 21:52:37'),
('d657ec30-ccfc-4262-a05f-d193d8c8911e', 2, 125, '2024-01-15 15:37:31', '{\"text\": \"Anda berhasil melakukan permintaan deposit pada tanggal 2024-01-15 15:37:31\", \"status\": \"add\"}', '2024-01-15 15:37:31'),
('d6d645e4-5d3a-42a1-8984-f40fbf6de0a1', 1, 126, '2024-01-07 19:13:21', '{\"text\": \"Login as Mhd Rizqy\", \"time\": \"2024-01-07 19:13:21\", \"status\": \"add\", \"ip_address\": \"2404:8000:1005:95e:656d:745f:41fc:e873\", \"user_agent\": \"Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:121.0) Gecko/20100101 Firefox/121.0\"}', '2024-01-07 19:13:21'),
('d7360866-1529-4184-bfa6-75362b388904', 1, 149, '2024-02-19 21:33:28', '{\"status\":\"add\",\"text\":\"Login as Nuzul Zaif Mahdiono R\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/121.0.0.0 Safari\\/537.36\",\"time\":\"2024-02-19 21:33:28\"}', '2024-02-19 21:33:28'),
('d7f4feae-1128-4f5c-b8f8-ea4af2b6b25d', 1, 133, '2023-12-13 02:04:36', '{\"text\": \"Login as Singgih Pandarmawan\", \"time\": \"2023-12-13 02:04:36\", \"status\": \"add\", \"ip_address\": \"2001:448a:5040:b9e0:5478:edbe:5158:ac9c\", \"user_agent\": \"Mozilla/5.0 (iPhone; CPU iPhone OS 17_1_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.1.2 Mobile/15E148 Safari/604.1\"}', '2023-12-13 02:04:36'),
('d8907410-b138-4c13-8f4f-f545840f56cc', 1, 156, '2024-02-21 02:04:59', '{\"status\":\"add\",\"text\":\"Login as SiswaKu\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/121.0.0.0 Safari\\/537.36\",\"time\":\"2024-02-21 02:04:59\"}', '2024-02-21 02:04:59'),
('dac2c070-3e5a-45b3-8036-67993d8f1d2c', 2, 94, '2023-12-19 14:46:25', '{\"text\": \"Anda berhasil mendaftarkan diri sebagai reseller pada tanggal 2023-12-19 14:46:25\", \"status\": \"add\"}', '2023-12-19 14:46:25'),
('dadbe375-394c-48cc-8267-9949a91863ea', 1, 95, '2023-12-27 08:52:05', '{\"text\": \"Login as Khoiril\", \"time\": \"2023-12-27 08:52:05\", \"status\": \"add\", \"ip_address\": \"202.80.218.36\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36\"}', '2023-12-27 08:52:05'),
('db2b9453-d83c-41e4-9cc2-0a6bff44454f', 1, 85, '2023-12-18 07:42:14', '{\"text\": \"Login as Boslink\", \"time\": \"2023-12-18 07:42:14\", \"status\": \"add\", \"ip_address\": \"103.148.24.87\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36\"}', '2023-12-18 07:42:14'),
('dc3e457c-78e6-43fb-b0f2-62465456ba92', 1, 1, '2024-04-18 13:44:01', '{\"status\":\"add\",\"text\":\"Login as Administrator\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/123.0.0.0 Safari\\/537.36\",\"time\":\"2024-04-18 13:43:59\"}', '2024-04-18 13:44:01'),
('dcf1c40c-381d-42d8-8529-3a3d323c0564', 1, 1, '2024-03-31 20:18:32', '{\"status\":\"add\",\"text\":\"Login as Administrator\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/123.0.0.0 Safari\\/537.36\",\"time\":\"2024-03-31 20:18:32\"}', '2024-03-31 20:18:32'),
('e0609be8-65e8-4990-8fae-fb84c50bae22', 2, 63, '2023-11-30 22:16:23', '{\"text\": \"Anda berhasil melakukan permintaan deposit pada tanggal 2023-11-30 22:16:23\", \"status\": \"add\"}', '2023-11-30 22:16:23'),
('e0ed29db-edc9-421a-91fe-21eb7e7d42e2', 1, 152, '2024-04-16 12:21:28', '{\"status\":\"add\",\"text\":\"Login as Dokter Irsyads\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/123.0.0.0 Safari\\/537.36\",\"time\":\"2024-04-16 12:21:27\"}', '2024-04-16 12:21:28'),
('e3f31e0f-c215-436c-84e9-0a3a80798928', 1, 125, '2023-11-15 09:42:10', '{\"text\": \"Login as Nuzul Zaif\", \"time\": \"2023-11-15 09:42:10\", \"status\": \"add\", \"ip_address\": \"2001:448a:5122:1e92:e45e:c074:a01e:148d\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36\"}', '2023-11-15 09:42:10'),
('e483e0ea-8fbc-4bbf-bf70-16aec8e7b239', 1, 1, '2024-01-20 10:04:07', '{\"status\":\"add\",\"text\":\"Login as Nuzul\",\"ip_address\":\"182.1.118.155\",\"user_agent\":\"Mozilla\\/5.0 (iPhone; CPU iPhone OS 17_2_1 like Mac OS X) AppleWebKit\\/605.1.15 (KHTML, like Gecko) Version\\/17.2 Mobile\\/15E148 Safari\\/604.1\",\"time\":\"2024-01-20 10:04:07\"}', '2024-01-20 10:04:07'),
('e53dc8a7-a654-4491-b379-f82bae89d7e1', 1, 85, '2023-12-18 16:32:06', '{\"text\": \"Login as Boslink\", \"time\": \"2023-12-18 16:32:06\", \"status\": \"add\", \"ip_address\": \"180.253.45.153\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36\"}', '2023-12-18 16:32:06'),
('e6900a47-0423-4d96-a624-4ea7306f8cc6', 1, 1, '2024-04-15 21:57:00', '{\"status\":\"add\",\"text\":\"Login as Administrator\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/123.0.0.0 Safari\\/537.36\",\"time\":\"2024-04-15 21:56:59\"}', '2024-04-15 21:57:00'),
('e69f8ee7-5483-4d46-a5d6-99d7f4f72dc2', 1, 134, '2023-12-25 04:21:55', '{\"text\": \"Login as Arisxd\", \"time\": \"2023-12-25 04:21:55\", \"status\": \"add\", \"ip_address\": \"103.105.28.163\", \"user_agent\": \"Mozilla/5.0 (Linux; Android 8.1.0; vivo 1814) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.45 Mobile Safari/537.36\"}', '2023-12-25 04:21:55'),
('e780a520-b64e-45dd-afbe-0c11a3a46fa0', 1, 63, '2023-12-12 12:46:32', '{\"text\": \"Login as Muhammad\", \"time\": \"2023-12-12 12:46:32\", \"status\": \"add\", \"ip_address\": \"2404:8000:1005:95e:3c77:8c44:bc70:366d\", \"user_agent\": \"Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:120.0) Gecko/20100101 Firefox/120.0\"}', '2023-12-12 12:46:32'),
('e8482bfc-4147-4c24-a3da-8308eeb6a189', 1, 152, '2024-04-15 18:20:40', '{\"status\":\"add\",\"text\":\"Login as Dokter Irsyads\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/123.0.0.0 Safari\\/537.36\",\"time\":\"2024-04-15 18:20:39\"}', '2024-04-15 18:20:40'),
('e85e2d7f-7f6c-4ec0-a810-e92c091a34a2', 1, 141, '2024-01-12 16:21:02', '{\"text\": \"Login as Ayub\", \"time\": \"2024-01-12 16:21:02\", \"status\": \"add\", \"ip_address\": \"2001:448a:4048:3b02:e8ce:1893:927e:7ddd\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36\"}', '2024-01-12 16:21:02'),
('e9136072-0af8-4f4a-a18a-b1837896e087', 1, 1, '2023-11-26 12:34:20', '{\"text\": \"Login as Nuzul\", \"time\": \"2023-11-26 12:34:20\", \"status\": \"add\", \"ip_address\": \"103.18.184.5\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36\"}', '2023-11-26 12:34:20'),
('e97dc97c-70de-4ca8-962c-f6fa488f119e', 1, 128, '2023-12-07 22:04:14', '{\"text\": \"Login as Yusfiwawansepriyadi\", \"time\": \"2023-12-07 22:04:14\", \"status\": \"add\", \"ip_address\": \"103.144.170.154\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36\"}', '2023-12-07 22:04:14'),
('ea50e7ac-09f1-49d5-a26a-f25132aad147', 1, 137, '2024-01-04 20:33:29', '{\"text\": \"Login as Muchammad Farid\", \"time\": \"2024-01-04 20:33:29\", \"status\": \"add\", \"ip_address\": \"140.213.57.102\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36\"}', '2024-01-04 20:33:29'),
('ebac6009-2ca2-4427-aa89-2ec37dd4d062', 1, 63, '2023-11-26 14:07:05', '{\"text\": \"Login as Muhammad\", \"time\": \"2023-11-26 14:07:05\", \"status\": \"add\", \"ip_address\": \"114.124.182.124\", \"user_agent\": \"Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Mobile Safari/537.36\"}', '2023-11-26 14:07:05'),
('ec3f0ff5-6f5b-491c-9452-ad5a58e59d03', 1, 95, '2023-12-06 14:29:54', '{\"text\": \"Login as Khoiril\", \"time\": \"2023-12-06 14:29:54\", \"status\": \"add\", \"ip_address\": \"202.80.217.91\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36\"}', '2023-12-06 14:29:54'),
('ec7f47ae-db77-418c-a7cb-2db4c4fd427f', 1, 1, '2024-01-19 20:45:48', '{\"status\":\"add\",\"text\":\"Login as Nuzul\",\"ip_address\":\"118.99.121.210\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/120.0.0.0 Safari\\/537.36\",\"time\":\"2024-01-19 20:45:48\"}', '2024-01-19 20:45:48'),
('ecb45484-554a-4f28-94e9-3e9cc4350566', 1, 125, '2023-12-13 18:20:49', '{\"text\": \"Login as Nuzul Zaif\", \"time\": \"2023-12-13 18:20:49\", \"status\": \"add\", \"ip_address\": \"103.115.31.55\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36\"}', '2023-12-13 18:20:49'),
('eec8f950-8d26-4c68-b116-af63bdfb7661', 1, 125, '2023-11-26 14:16:20', '{\"text\": \"Login as Nuzul Zaif\", \"time\": \"2023-11-26 14:16:20\", \"status\": \"add\", \"ip_address\": \"103.18.184.5\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36\"}', '2023-11-26 14:16:20'),
('ef5ad3ad-ebfe-421f-8bad-b2ca8a868f49', 2, 63, '2023-11-28 23:33:31', '{\"text\": \"Anda berhasil melakukan permintaan deposit pada tanggal 2023-11-28 23:33:31\", \"status\": \"add\"}', '2023-11-28 23:33:31'),
('ef9add05-b285-44ba-a1f9-d4517627e344', 1, 1, '2024-02-19 12:12:38', '{\"status\":\"add\",\"text\":\"Login as Nuzuls\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/121.0.0.0 Safari\\/537.36\",\"time\":\"2024-02-19 12:12:37\"}', '2024-02-19 12:12:38'),
('f053d34e-b9dd-4c31-9675-c996994cf65a', 1, 63, '2023-11-16 13:35:29', '{\"text\": \"Login as Muhammad\", \"time\": \"2023-11-16 13:35:29\", \"status\": \"add\", \"ip_address\": \"2404:8000:1005:9fa1:4037:35b8:1c97:a2e4\", \"user_agent\": \"Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:109.0) Gecko/20100101 Firefox/119.0\"}', '2023-11-16 13:35:29'),
('f1e96db8-872f-42ef-9fa6-992c028a9fe7', 1, 1, '2024-02-19 21:22:04', '{\"status\":\"add\",\"text\":\"Login as Nuzuls\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/121.0.0.0 Safari\\/537.36\",\"time\":\"2024-02-19 21:22:04\"}', '2024-02-19 21:22:04'),
('f2c4e28b-0735-4eac-82f1-ef35768836a8', 1, 1, '2024-01-12 22:10:28', '{\"text\": \"Login as Nuzul\", \"time\": \"2024-01-12 22:10:28\", \"status\": \"add\", \"ip_address\": \"103.3.58.141\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36\"}', '2024-01-12 22:10:28'),
('f3cc67d8-6b69-4ecb-aa50-5154198dd4ef', 1, 125, '2023-12-18 09:40:58', '{\"text\": \"Login as Nuzul Zaif\", \"time\": \"2023-12-18 09:40:58\", \"status\": \"add\", \"ip_address\": \"2001:448a:5122:52f:d80e:f0a:7560:a587\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36\"}', '2023-12-18 09:40:58'),
('f3f001d5-8f64-402e-9b5f-422c5d20e799', 1, 1, '2024-01-16 13:02:57', '{\"text\": \"Login as Nuzul\", \"time\": \"2024-01-16 13:02:57\", \"status\": \"add\", \"ip_address\": \"103.3.58.251\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36\"}', '2024-01-16 13:02:57'),
('f53bc901-24a0-434a-92e8-f06886bcd520', 1, 159, '2024-02-21 02:05:30', '{\"status\":\"add\",\"text\":\"Login as Wali Siswa IDS\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/121.0.0.0 Safari\\/537.36\",\"time\":\"2024-02-21 02:05:30\"}', '2024-02-21 02:05:30'),
('f5ef3e63-42fa-465e-bd5a-4c9a7bc2618b', 1, 152, '2024-04-15 12:47:20', '{\"status\":\"add\",\"text\":\"Login as Dokter Irsyads\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/123.0.0.0 Safari\\/537.36\",\"time\":\"2024-04-15 12:47:20\"}', '2024-04-15 12:47:20'),
('f5f99afa-8ad4-4236-9e0e-712c67f93dc4', 1, 1, '2024-03-31 14:18:27', '{\"status\":\"add\",\"text\":\"Login as Administrator\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/123.0.0.0 Safari\\/537.36\",\"time\":\"2024-03-31 14:18:27\"}', '2024-03-31 14:18:27'),
('f799fdb7-dede-4aaf-a00f-f048cdd7c9a9', 1, 125, '2023-11-25 18:48:26', '{\"text\": \"Login as Nuzul Zaif\", \"time\": \"2023-11-25 18:48:26\", \"status\": \"add\", \"ip_address\": \"103.18.184.5\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36\"}', '2023-11-25 18:48:26'),
('f9758312-aee8-4dd3-ba6b-a8aa74dac57b', 1, 125, '2023-11-19 21:50:23', '{\"text\": \"Login as Nuzul Zaif\", \"time\": \"2023-11-19 21:50:23\", \"status\": \"add\", \"ip_address\": \"103.18.184.5\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36\"}', '2023-11-19 21:50:23'),
('fb3e3432-3e80-4d47-b516-6a945c36114e', 1, 1, '2024-03-26 13:31:54', '{\"status\":\"add\",\"text\":\"Login as Administrator\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Safari\\/537.36\",\"time\":\"2024-03-26 13:31:54\"}', '2024-03-26 13:31:54'),
('fbcbba4e-ad18-4351-90aa-83b4f8188bda', 1, 126, '2023-11-16 11:10:04', '{\"text\": \"Login as Mhd Rizqy\", \"time\": \"2023-11-16 11:10:04\", \"status\": \"add\", \"ip_address\": \"2404:8000:1005:9fa1:4037:35b8:1c97:a2e4\", \"user_agent\": \"Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:109.0) Gecko/20100101 Firefox/119.0\"}', '2023-11-16 11:10:04'),
('ff3c7810-863e-4b9f-afc0-94b0ec840b31', 1, 1, '2023-11-13 20:34:03', '{\"text\": \"Login as Nuzul\", \"time\": \"2023-11-13 20:34:03\", \"status\": \"add\", \"ip_address\": \"2001:448a:5122:1e92:443d:2660:b8fa:cb2c\", \"user_agent\": \"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36\"}', '2023-11-13 20:34:03'),
('ff532d61-5c23-4169-a8e1-607c83751979', 1, 156, '2024-03-15 11:05:05', '{\"status\":\"add\",\"text\":\"Login as SiswaKu\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/122.0.0.0 Safari\\/537.36\",\"time\":\"2024-03-15 11:05:05\"}', '2024-03-15 11:05:05');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_obat`
--

CREATE TABLE `tbl_obat` (
  `id` int(11) NOT NULL,
  `kode_obat` varchar(40) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text,
  `category` int(8) NOT NULL COMMENT '1: Tablet\r\n2: Kapsul\r\n3: Kaplet\r\n4: Pil\r\n5: Puyer\r\n6: Sirup',
  `price` double NOT NULL,
  `stock` int(11) NOT NULL,
  `status` int(4) NOT NULL COMMENT '1: In Stock\r\n2: Out of Stock',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_obat`
--

INSERT INTO `tbl_obat` (`id`, `kode_obat`, `name`, `description`, `category`, `price`, `stock`, `status`, `created_at`, `updated_at`) VALUES
(1, 'AMOX0520', 'Amoxilin', 'Amoxilin', 1, 5000, 99, 1, '2024-04-12 15:20:04', '2024-04-18 00:32:32'),
(2, 'BCA002', 'Ibuprofen', 'Obat Keras', 1, 6000, 99, 1, '2024-04-16 21:59:42', '2024-04-18 00:32:32'),
(3, 'AD0212', 'Adia', 'add', 1, 4500, 99, 1, '2024-04-16 22:15:08', '2024-04-18 00:32:32');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pasien`
--

CREATE TABLE `tbl_pasien` (
  `id` int(11) NOT NULL,
  `no_ktp` varchar(19) NOT NULL,
  `no_rm` varchar(50) NOT NULL,
  `no_register` int(11) NOT NULL,
  `no_dana_sehat` varchar(20) DEFAULT NULL,
  `nama` varchar(200) NOT NULL,
  `jenis_kelamin` int(3) NOT NULL COMMENT '1: Laki-Laki, 2: Wanita',
  `tempat_lahir` varchar(100) DEFAULT NULL,
  `tanggal_lahir` date NOT NULL,
  `usia` int(11) NOT NULL,
  `agama` int(11) NOT NULL,
  `pekerjaan` text,
  `telepon` varchar(19) DEFAULT NULL,
  `status` int(3) NOT NULL COMMENT '1: Baru, 2: Lama',
  `is_anggota` int(2) NOT NULL COMMENT '1: Tidak, 2: Ya',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_pasien`
--

INSERT INTO `tbl_pasien` (`id`, `no_ktp`, `no_rm`, `no_register`, `no_dana_sehat`, `nama`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `usia`, `agama`, `pekerjaan`, `telepon`, `status`, `is_anggota`, `created_at`, `updated_at`) VALUES
(1, '35929121212121', '59210', 4212, '9921121', 'Bima Rosalinda', 1, 'Jember', '2024-04-10', 10, 1, 'Wiraswasta', '089675922092', 1, 2, '2024-04-13 13:57:10', '2024-04-18 14:18:46');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pemeriksaan`
--

CREATE TABLE `tbl_pemeriksaan` (
  `id` varchar(50) NOT NULL,
  `id_antrian` int(11) NOT NULL,
  `no_periksa` varchar(40) NOT NULL,
  `keluhan` text,
  `tinggi` int(11) NOT NULL,
  `berat` int(11) NOT NULL,
  `tekanan` varchar(40) NOT NULL,
  `nadi` varchar(40) NOT NULL,
  `alergi` text,
  `diagnosa` text,
  `tindakan` int(11) DEFAULT NULL,
  `keterangan_dokter` text,
  `keterangan` text,
  `biaya` double DEFAULT NULL,
  `status_pembayaran` int(3) NOT NULL DEFAULT '2' COMMENT '1: Lunas\r\n2. Belum',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_pemeriksaan`
--

INSERT INTO `tbl_pemeriksaan` (`id`, `id_antrian`, `no_periksa`, `keluhan`, `tinggi`, `berat`, `tekanan`, `nadi`, `alergi`, `diagnosa`, `tindakan`, `keterangan_dokter`, `keterangan`, `biaya`, `status_pembayaran`, `created_at`, `updated_at`) VALUES
('2da1004c-1a83-4d9c-ab3f-e7a2482cf59a', 1, 'CZQ2AR', 'KELUHAN DIDADA', 150, 40, '110', '40', NULL, 'Anemia', 1, 'jangan sering begadang', NULL, 45000, 1, '2024-04-14 21:26:23', '2024-04-18 21:00:51');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_perawat`
--

CREATE TABLE `tbl_perawat` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_poli` int(11) DEFAULT NULL,
  `nomer_induk` varchar(40) NOT NULL,
  `status` int(3) NOT NULL COMMENT '1: Active, 2: Non Active',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_perawat`
--

INSERT INTO `tbl_perawat` (`id`, `id_user`, `id_poli`, `nomer_induk`, `status`, `created_at`, `updated_at`) VALUES
(1, 155, NULL, '9219ASASAW', 1, '2024-04-13 14:58:36', '2024-04-13 14:58:36');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_poli`
--

CREATE TABLE `tbl_poli` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `status` int(3) NOT NULL COMMENT '1: Active, 2: Non Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_poli`
--

INSERT INTO `tbl_poli` (`id`, `name`, `status`) VALUES
(1, 'Poli Bedah', 1),
(2, 'Poli Umum', 1),
(3, 'Poli Gigi', 1),
(4, 'Poli Anak', 1),
(5, 'Poli Kulit dan Kelamin', 1),
(6, 'Poli Jantung', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_resep_pasien`
--

CREATE TABLE `tbl_resep_pasien` (
  `id` varchar(40) NOT NULL,
  `id_obat` varchar(40) NOT NULL,
  `no_resep` varchar(10) NOT NULL,
  `no_periksa` varchar(10) NOT NULL,
  `description` text,
  `is_pribadi` int(2) NOT NULL COMMENT '1: Dibeli sendiri\r\n2: Melalui Apotek',
  `status` int(4) NOT NULL COMMENT '1: Sudah Diambil\r\n2: Belum',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_resep_pasien`
--

INSERT INTO `tbl_resep_pasien` (`id`, `id_obat`, `no_resep`, `no_periksa`, `description`, `is_pribadi`, `status`, `created_at`, `updated_at`) VALUES
('81a571ca-d19d-4b98-8bd5-4f64f61eb769', '1,3,2', 'ZQAGTL', 'CZQ2AR', '1x2 hari,2x1 hari', 2, 1, '2024-04-16 22:02:23', '2024-04-18 00:33:12');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_role`
--

CREATE TABLE `tbl_role` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_role`
--

INSERT INTO `tbl_role` (`id`, `name`) VALUES
(1, 'Administrator'),
(2, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tindakan`
--

CREATE TABLE `tbl_tindakan` (
  `id` int(11) NOT NULL,
  `id_dokter` int(11) NOT NULL,
  `name` text,
  `description` text,
  `price` double NOT NULL,
  `status` int(3) NOT NULL COMMENT '1: Active, 2: Non Active',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_tindakan`
--

INSERT INTO `tbl_tindakan` (`id`, `id_dokter`, `name`, `description`, `price`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Suntik Darah Anemia', 'Suntik darah bagi penyakit anemia', 20000, 1, '2024-04-15 13:57:32', '2024-04-15 13:59:12');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `email_verified_token` text COLLATE utf8mb4_unicode_ci,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` int(11) DEFAULT '3',
  `phone` text COLLATE utf8mb4_unicode_ci,
  `status` int(11) NOT NULL DEFAULT '3' COMMENT '1: Active, 2: Non Active, 3: Deactivated, 4: Not Verified',
  `thumbnail` text COLLATE utf8mb4_unicode_ci,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `name`, `username`, `email`, `email_verified_at`, `email_verified_token`, `password`, `level`, `phone`, `status`, `thumbnail`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'admin', 'admin@tugas.com', NULL, NULL, '$2y$10$/326LL0MKwXcpSG9hVQlkuSrhQHnVkH6cB2Pvqi7VidQhcZQbqJQi', 1, NULL, 1, '', NULL, '2022-06-09 23:01:32', '2024-03-25 05:36:47'),
(144, 'User KPS', 'user', 'user@tugas.com', NULL, NULL, '$2y$10$/326LL0MKwXcpSG9hVQlkuSrhQHnVkH6cB2Pvqi7VidQhcZQbqJQi', 2, NULL, 1, '', NULL, '2024-01-31 15:25:16', '2024-03-31 16:55:24'),
(147, 'Nuzul', 'officialnuzulzaif124274', 'officialnuzulzaif124@gmail.com', NULL, NULL, '$2y$10$MnN5wMrx1TklUB/1gd8fkeSmLiNP8X7PxN7XG4slwHoTafgxmMZla', 2, NULL, 1, '', NULL, '2024-04-02 07:51:45', '2024-04-02 07:51:45'),
(152, 'Dokter Irsyads', 'dokter243', 'dokter@tugas.com', NULL, NULL, '$2y$10$LHhkkRBsLO8wOHhGA7CusOK0OsghCN6OKBH3ti3/5ggk8htrbGRLy', 2, NULL, 1, NULL, NULL, '2024-04-11 16:58:22', '2024-04-11 17:23:40'),
(153, 'Ghina', 'apoteker807', 'apoteker@tugas.com', NULL, NULL, '$2y$10$MgdgcF0JIUlG4VkLWbEvYOLsq0FEqDfDnbF9FlRuXL/q5kJYZbXoy', 2, NULL, 1, NULL, NULL, '2024-04-11 17:35:22', '2024-04-17 17:43:32'),
(155, 'Rahma', 'perawat798', 'perawat@tugas.com', NULL, NULL, '$2y$10$l8VJS8GFpFHcPfylaeEp.OL4XCBVJIrKt9ZJNIijhz7u3EXa1hVPm', 2, NULL, 1, NULL, NULL, '2024-04-13 07:58:36', '2024-04-13 07:58:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`uuid`),
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `tbl_antrian`
--
ALTER TABLE `tbl_antrian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_apoteker`
--
ALTER TABLE `tbl_apoteker`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_dokter`
--
ALTER TABLE `tbl_dokter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_foto_pemeriksaan`
--
ALTER TABLE `tbl_foto_pemeriksaan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_log_activity`
--
ALTER TABLE `tbl_log_activity`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `tbl_obat`
--
ALTER TABLE `tbl_obat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_pasien`
--
ALTER TABLE `tbl_pasien`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_pemeriksaan`
--
ALTER TABLE `tbl_pemeriksaan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_perawat`
--
ALTER TABLE `tbl_perawat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_poli`
--
ALTER TABLE `tbl_poli`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_resep_pasien`
--
ALTER TABLE `tbl_resep_pasien`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_role`
--
ALTER TABLE `tbl_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_tindakan`
--
ALTER TABLE `tbl_tindakan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_antrian`
--
ALTER TABLE `tbl_antrian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_apoteker`
--
ALTER TABLE `tbl_apoteker`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_dokter`
--
ALTER TABLE `tbl_dokter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_obat`
--
ALTER TABLE `tbl_obat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_pasien`
--
ALTER TABLE `tbl_pasien`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_perawat`
--
ALTER TABLE `tbl_perawat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_poli`
--
ALTER TABLE `tbl_poli`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_role`
--
ALTER TABLE `tbl_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_tindakan`
--
ALTER TABLE `tbl_tindakan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=156;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
