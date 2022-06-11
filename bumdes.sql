-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 08, 2022 at 07:14 PM
-- Server version: 5.7.33
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bumdes`
--

-- --------------------------------------------------------

--
-- Table structure for table `angsuran`
--

CREATE TABLE `angsuran` (
  `id_angsuran` int(11) NOT NULL,
  `nik` varchar(255) NOT NULL,
  `nominal` varchar(255) NOT NULL,
  `waktu` int(11) NOT NULL,
  `status_angsuran` enum('BELUM LUNAS','LUNAS') NOT NULL,
  `kode_pembayaran` varchar(6) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated-at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `angsuran`
--

INSERT INTO `angsuran` (`id_angsuran`, `nik`, `nominal`, `waktu`, `status_angsuran`, `kode_pembayaran`, `created_at`, `updated-at`) VALUES
(29, '3529017011600002', '3000000', 10, 'BELUM LUNAS', 'PGMUMY', '2022-06-09 01:14:31', '2022-06-09 01:14:31'),
(28, '3529012012680001', '5000000', 10, 'BELUM LUNAS', 'JQXKZN', '2022-06-09 01:10:04', '2022-06-09 01:10:04'),
(27, '3529015305770001', '5000000', 10, 'BELUM LUNAS', 'WDZMUU', '2022-06-09 01:01:58', '2022-06-09 01:01:58'),
(26, '3529015705040003', '5000000', 10, 'BELUM LUNAS', 'LWNUYL', '2022-06-09 00:58:31', '2022-06-09 00:58:31'),
(25, '3529014519700009', '5000000', 10, 'BELUM LUNAS', 'TEQFGM', '2022-06-09 00:55:42', '2022-06-09 00:55:42'),
(24, '3529014505700006', '5000000', 10, 'BELUM LUNAS', 'FMYJVW', '2022-06-09 00:45:10', '2022-06-09 00:45:10'),
(23, '3529015008710003', '5000000', 10, 'BELUM LUNAS', 'SIGFUV', '2022-06-09 00:32:32', '2022-06-09 00:32:32'),
(22, '3539016705790006', '5000000', 10, 'BELUM LUNAS', 'TPKXJG', '2022-06-09 00:27:34', '2022-06-09 00:27:34'),
(21, '3528032710820003', '4000000', 10, 'BELUM LUNAS', 'GTPSAX', '2022-06-09 00:20:54', '2022-06-09 00:20:54'),
(20, '3529011604680015', '5000000', 10, 'BELUM LUNAS', 'SUAGXT', '2022-06-09 00:07:28', '2022-06-09 00:07:28'),
(19, '3529011202720002', '4000000', 10, 'BELUM LUNAS', 'OWXPWW', '2022-06-09 00:04:21', '2022-06-09 00:04:21'),
(18, '3529030208761154', '4000000', 10, 'BELUM LUNAS', 'CWLFDE', '2022-06-09 00:01:46', '2022-06-09 00:01:46');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `id_angsuran` int(11) NOT NULL,
  `nominal` varchar(255) NOT NULL,
  `biaya_admin` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_angsuran`, `nominal`, `biaya_admin`, `created_at`, `updated_at`) VALUES
(16, 20, '500000', '50000', '2022-06-09 00:08:23', '2022-06-09 00:08:23'),
(15, 18, '400000', '40000', '2022-06-09 00:02:49', '2022-06-09 00:02:49'),
(17, 20, '500000', '50000', '2022-06-09 00:09:43', '2022-06-09 00:09:43'),
(18, 20, '500000', '50000', '2022-06-09 00:10:31', '2022-06-09 00:10:31'),
(19, 20, '500000', '50000', '2022-06-09 00:11:03', '2022-06-09 00:11:03'),
(20, 20, '500000', '50000', '2022-06-09 00:11:40', '2022-06-09 00:11:40'),
(21, 18, '400000', '40000', '2022-06-09 00:12:46', '2022-06-09 00:12:46'),
(22, 18, '400000', '40000', '2022-06-09 00:13:28', '2022-06-09 00:13:28'),
(23, 18, '400000', '40000', '2022-06-09 00:14:32', '2022-06-09 00:14:32'),
(24, 18, '400000', '40000', '2022-06-09 00:15:03', '2022-06-09 00:15:03'),
(28, 21, '400000', '40000', '2022-06-09 00:25:12', '2022-06-09 00:25:12'),
(27, 21, '400000', '40000', '2022-06-09 00:24:32', '2022-06-09 00:24:32'),
(29, 21, '400000', '40000', '2022-06-09 00:25:42', '2022-06-09 00:25:42'),
(30, 21, '400000', '40000', '2022-06-09 00:26:30', '2022-06-09 00:26:30'),
(31, 22, '500000', '50000', '2022-06-09 00:28:05', '2022-06-09 00:28:05'),
(32, 22, '500000', '50000', '2022-06-09 00:28:33', '2022-06-09 00:28:33'),
(33, 22, '500000', '50000', '2022-06-09 00:29:00', '2022-06-09 00:29:00'),
(34, 22, '500000', '50000', '2022-06-09 00:29:23', '2022-06-09 00:29:23'),
(35, 22, '500000', '50000', '2022-06-09 00:29:58', '2022-06-09 00:29:58'),
(36, 23, '500000', '50000', '2022-06-09 00:33:22', '2022-06-09 00:33:22'),
(37, 23, '500000', '50000', '2022-06-09 00:33:58', '2022-06-09 00:33:58'),
(38, 23, '500000', '50000', '2022-06-09 00:34:37', '2022-06-09 00:34:37'),
(39, 23, '500000', '50000', '2022-06-09 00:34:59', '2022-06-09 00:34:59'),
(40, 24, '500000', '50000', '2022-06-09 00:45:43', '2022-06-09 00:45:43'),
(41, 24, '500000', '50000', '2022-06-09 00:46:03', '2022-06-09 00:46:03'),
(42, 24, '500000', '50000', '2022-06-09 00:46:21', '2022-06-09 00:46:21'),
(43, 24, '500000', '50000', '2022-06-09 00:46:56', '2022-06-09 00:46:56'),
(44, 25, '500000', '50000', '2022-06-09 00:56:09', '2022-06-09 00:56:09'),
(45, 25, '500000', '50000', '2022-06-09 00:56:48', '2022-06-09 00:56:48'),
(46, 25, '500000', '50000', '2022-06-09 00:57:10', '2022-06-09 00:57:10'),
(47, 26, '500000', '50000', '2022-06-09 00:59:01', '2022-06-09 00:59:01'),
(48, 26, '500000', '50000', '2022-06-09 00:59:25', '2022-06-09 00:59:25'),
(49, 26, '500000', '50000', '2022-06-09 00:59:53', '2022-06-09 00:59:53'),
(50, 27, '500000', '50000', '2022-06-09 01:02:29', '2022-06-09 01:02:29'),
(51, 27, '500000', '50000', '2022-06-09 01:02:53', '2022-06-09 01:02:53'),
(52, 28, '500000', '50000', '2022-06-09 01:10:31', '2022-06-09 01:10:31'),
(53, 28, '500000', '50000', '2022-06-09 01:10:51', '2022-06-09 01:10:51'),
(54, 29, '300000', '30000', '2022-06-09 01:15:15', '2022-06-09 01:15:15');

-- --------------------------------------------------------

--
-- Table structure for table `penarikan`
--

CREATE TABLE `penarikan` (
  `id_penarikan` int(11) NOT NULL,
  `id_simpanan` int(11) NOT NULL,
  `nominal` varchar(255) NOT NULL,
  `kode_penarikan` varchar(6) NOT NULL,
  `status_penarikan` enum('TELAH DIAMBIL','BELUM DIAMBIL') NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `permohonan`
--

CREATE TABLE `permohonan` (
  `id_permohonan` int(11) NOT NULL,
  `nik` varchar(255) NOT NULL,
  `judul_permohonan` varchar(255) NOT NULL,
  `nominal_permohonan` varchar(255) NOT NULL,
  `jenis_permohonan` enum('SIMPAN','PINJAM','PENARIKAN') NOT NULL,
  `status_permohonan` enum('HOLD','DITERIMA','DITOLAK') NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pinjaman`
--

CREATE TABLE `pinjaman` (
  `id_pinjaman` int(11) NOT NULL,
  `nominal` varchar(255) NOT NULL,
  `nik` varchar(255) NOT NULL,
  `kode_penarikan` varchar(6) NOT NULL,
  `jenis_pinjaman` enum('BIASA') NOT NULL,
  `status_pinjaman` enum('BELUM DIAMBIL','TELAH DIAMBIL') NOT NULL,
  `created_at` varchar(255) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pinjaman`
--

INSERT INTO `pinjaman` (`id_pinjaman`, `nominal`, `nik`, `kode_penarikan`, `jenis_pinjaman`, `status_pinjaman`, `created_at`, `updated_at`) VALUES
(16, '4000000', '3529030208761154', 'XNKFTQ', 'BIASA', 'TELAH DIAMBIL', '2022-01-05', '2022-06-08 23:16:43'),
(17, '4000000', '3529011202720002', 'GLTRWU', 'BIASA', 'TELAH DIAMBIL', '2022-01-05', '2022-06-08 23:41:08'),
(18, '5000000', '3539016705790006', 'AEXQMJ', 'BIASA', 'TELAH DIAMBIL', '2022-01-05', '2022-06-08 23:43:41'),
(19, '5000000', '3529011604680015', 'NGAQDT', 'BIASA', 'TELAH DIAMBIL', '2022-01-05', '2022-06-09 00:06:41'),
(20, '4000000', '3528032710820003', 'FPGHJC', 'BIASA', 'TELAH DIAMBIL', '2022-02-05', '2022-06-09 00:20:05'),
(21, '5000000', '3529015008710003', 'CCMNSQ', 'BIASA', 'TELAH DIAMBIL', '2022-02-05', '2022-06-09 00:32:02'),
(22, '5000000', '3529014505700006', 'IERIDA', 'BIASA', 'TELAH DIAMBIL', '2022-02-05', '2022-06-09 00:44:32'),
(23, '5000000', '3529014519700009', 'VJJGTQ', 'BIASA', 'TELAH DIAMBIL', '2022-03-05', '2022-06-09 00:55:17'),
(24, '5000000', '3529015705040003', 'KRXHGC', 'BIASA', 'TELAH DIAMBIL', '2022-03-05', '2022-06-09 00:57:41'),
(25, '5000000', '3529015305770001', 'GZYXGW', 'BIASA', 'TELAH DIAMBIL', '2022-04-05', '2022-06-09 01:01:24'),
(26, '5000000', '3529012012680001', 'ZVKKQI', 'BIASA', 'TELAH DIAMBIL', '2022-04-05', '2022-06-09 01:09:38'),
(27, '3000000', '3529017011600002', 'QRQAWX', 'BIASA', 'TELAH DIAMBIL', '2022-05-14', '2022-06-09 01:13:59');

-- --------------------------------------------------------

--
-- Table structure for table `simpanan`
--

CREATE TABLE `simpanan` (
  `id_simpanan` int(11) NOT NULL,
  `nik` varchar(255) NOT NULL,
  `nominal` varchar(255) NOT NULL,
  `kode_deposit` varchar(6) NOT NULL,
  `jenis_simpanan` enum('POKOK','SUKARELA') NOT NULL,
  `status_simpanan` enum('BELUM DEPOSIT','TELAH DEPOSIT') NOT NULL,
  `created_at` varchar(255) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `phone` bigint(13) NOT NULL,
  `nik` varchar(255) DEFAULT NULL,
  `role` enum('superadmin','admin','customer') NOT NULL,
  `gender` enum('laki-laki','perempuan') DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `alamat` text,
  `foto_diri` varchar(255) DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `phone`, `nik`, `role`, `gender`, `password`, `alamat`, `foto_diri`, `created`, `updated_at`) VALUES
(8, 'admin bumdes', 'admin', 81907861308, '3512361293182639', 'admin', 'laki-laki', '$2a$12$2rdrERdG1A9YxMg6dOm/P..0KqJfYwAPAk8Bh982AvISoFsQINSOq', 'Sarpaan RT 03/RW 01', '1653898358_0e9a388d637433480155.png', '2022-05-12 07:34:45', '2022-05-12 07:34:45'),
(5, 'bumdes', 'superadmin', 0, '3512361231826318', 'superadmin', 'laki-laki', '$2a$12$VztwJpBNyGlt2IopJmP.VuleiZThrfUCg1nJ4WO0BOVVvTyHqWS4O', 'Sarpaan RT 01/RW 01', NULL, '2022-05-11 03:04:03', '2022-05-11 03:04:03'),
(15, 'Enin', 'Enin', 81997125698, '3529011805660005', 'customer', 'laki-laki', '$2y$10$d7D1p854F2OmCKkw7p.7sO/TS61Ymqt/42z3lAcWcmi7dwmEgIvRG', 'Sarpaan RT 01/RW 01', NULL, '2022-06-08 21:01:53', '2022-06-08 21:01:53'),
(16, 'Feny Aulia Rahmadhani', 'Feny Aulia Rahmadhani', 81912400066, '3529014402950004', 'customer', 'perempuan', '$2y$10$DxyOfNAij1.8N.l8mFmS0.PpysgFBpPhNsUhib.flNszuJubdr91m', 'Tal Bantal RT 03/RW 01', NULL, '2022-06-08 22:12:11', '2022-06-08 22:12:11'),
(17, 'Achmad Rasyidi', 'Achmad Rasyidi', 87850679068, '3529011604680005', 'customer', 'laki-laki', '$2y$10$OTouJfM9vy7upnl3vDq1vezDDuqWGKqcMnyA3/KY5QcUbO5TPiJrO', 'Podak RT 01/RW 03', NULL, '2022-06-08 22:13:50', '2022-06-08 22:13:50'),
(18, 'Yogi Gunawan', 'Yogi Gunawan', 81939051189, '3529011604680015', 'customer', 'laki-laki', '$2y$10$mPnr39DiD/2iTD9OOtUSAemYxi3G2wjf5yBw3fwil8HcbBaexoeY6', 'Tal Bantal RT 03/RW 01', NULL, '2022-06-08 22:16:46', '2022-06-08 22:16:46'),
(19, 'Moh. Ilwan', 'Moh. Ilwan', 87850369569, '3529011101790002', 'customer', 'laki-laki', '$2y$10$M.UBPhE/2v7x8QuUdhqA/O0bNkJ5W4JIdBX94dB1AW37DCqjM8bM2', 'Tal Bantal RT 03/RW 02', NULL, '2022-06-08 22:17:39', '2022-06-08 22:17:39'),
(20, 'Erfandi', 'Erfandi', 85334350598, '3529012304740002', 'customer', 'laki-laki', '$2y$10$dJVC2NWLZ4oPFpVFQcvQIONt/6baepIlEUCWvBCcHO/SQh/vQnj8.', 'Tal Bantal RT 02/RW 02', NULL, '2022-06-08 22:20:53', '2022-06-08 22:20:53'),
(21, 'Doni Anista', 'Doni Anista', 85942368493, '3529010510940007', 'customer', 'laki-laki', '$2y$10$WozwK7zYXD5DYVLVEeIu7OvfTte7qbRkwGN5c/POJpbVHpjsLvfi6', 'Tal Bantal RT 02/RW 02', NULL, '2022-06-08 22:21:40', '2022-06-08 22:21:40'),
(22, 'Ernawati', 'Ernawati', 82330518001, '3529014306660002', 'customer', 'perempuan', '$2y$10$TmmVKYe0jBnTtfusGeLhDulKFVD1s8I/lGi./JdHWxZDeRzXi8ZYe', 'Tal Bantal RT 02/RW 02', NULL, '2022-06-08 22:22:33', '2022-06-08 22:22:33'),
(23, 'Yani Nurita', 'Yani Nurita', 81933870958, '3529015706060002', 'customer', 'perempuan', '$2y$10$2nAtfsh4YsLJwi3tofOTbOCn/DvF3nOBuEifHCZedbYuXZsbP4y4m', 'Tal Bantal RT 03/RW 02', NULL, '2022-06-08 22:24:48', '2022-06-08 22:24:48'),
(24, 'Zainal Arifin', 'Zainal Arifin', 85232889969, '3529010605390002', 'customer', 'laki-laki', '$2y$10$4JcebNNJUbjWRJeVOd1XtOquAqNrdHEoaxoT4MzdpvW6ukueIBGwm', 'Tal Bantal RT 02/RW 02', NULL, '2022-06-08 22:26:13', '2022-06-08 22:26:13'),
(25, 'Bambang Rudi Hartono', 'Bambang Rudi Hartono', 81937531351, '3529010911870004', 'customer', 'laki-laki', '$2y$10$LDFzWPcWl/4xA3r1jg6.feM3RGC0El4O28Noppfobw/VVt6FDyw4e', 'Tal Bantal RT 03/RW 02', NULL, '2022-06-08 22:27:24', '2022-06-08 22:27:24'),
(26, 'Taufik Rahman', 'Taufik Rahman', 87777211450, '3529010510660005', 'admin', 'laki-laki', '$2y$10$p2ROt1239qOPF5NimMYgcePXPrKYXhSkCiZygrSq0QDC91C97hnBS', 'Tal Bantal RT 02/RW 02', NULL, '2022-06-08 22:31:56', '2022-06-08 22:31:56'),
(27, 'Munawara', 'Munawara', 82338954793, '3529017011600002', 'customer', 'perempuan', '$2y$10$54Cx9eeuVS.DAiw86MqbY.Ej8WaMENR2aYEkeJpXRrshMnEmFkHGi', 'Tal Bantal RT 02/RW 02', NULL, '2022-06-08 22:33:08', '2022-06-08 22:33:08'),
(28, 'Mistuna', 'Mistuna', 85104106301, '3529016211710002', 'customer', 'laki-laki', '$2y$10$QQzvg17.Upo9io1I1YEH5.G2yUHXQ7LSVmQ5C3fqtzynZUEiMyfIm', 'Tal Bantal RT 02/RW 02', NULL, '2022-06-08 22:33:50', '2022-06-08 22:33:50'),
(29, 'Tuti Suryaningsih', 'Tuti Suryaningsih', 85236723464, '3529015305770001', 'customer', 'perempuan', '$2y$10$dgCfDNPw415DSxFX/N/67e3TuypGcA6bVz/xS8qUMm7dkncq7QVoa', 'Tal Bantal RT 02/RW 02', NULL, '2022-06-08 22:35:14', '2022-06-08 22:35:14'),
(30, 'Puji Sri Astutik', 'Puji Sri Astutik', 83119666256, '3528046312700140', 'customer', 'perempuan', '$2y$10$IfisEx73W1cgjc.XeklrC.EqG64Zs7Xce7AogkcCYuCc3iAihoRZq', 'Griya Mapan RT 01/RW 04', NULL, '2022-06-08 22:36:16', '2022-06-08 22:36:16'),
(31, 'Kumariyah', 'Kumariyah', 85331892021, '3529016606700001', 'customer', 'perempuan', '$2y$10$Kx1W3vVeu85l6zs2K0bLW.9KSzNXko5fbmYu8cU3PYz02V5bRyA/6', 'Podak RT 01/RW 03', NULL, '2022-06-08 22:37:21', '2022-06-08 22:37:21'),
(32, 'Endang Sari', 'Endang Sari', 87841691891, '3529014105730002', 'customer', 'perempuan', '$2y$10$dclTXRweskpqrfXAhd.gt.STRoyBewsOxlq4EqQr2DufLtG0Ic.t2', 'Tal Bantal RT 03/RW 01', NULL, '2022-06-08 22:38:42', '2022-06-08 22:38:42'),
(33, 'Sholihah', 'Sholihah', 85330266635, '3515115012900003', 'customer', 'laki-laki', '$2y$10$wZTmMKrXEmBio/qsWOQvR.ZMi9U9B5H8Itis/lELp7yFyUTxfJ4kW', 'Tal Bantal RT 03/RW 02', NULL, '2022-06-08 22:39:37', '2022-06-08 22:39:37'),
(34, 'Nofita Dwi Terisnawati', 'Nofita Dwi Terisnawati', 87750055950, '3529016711850001', 'customer', 'perempuan', '$2y$10$xeuV0YzSwpWj6aciSDwKgOMuAoSoas8CkUH1BKyvj4yWhirAquctS', 'Tal Bantal RT 03/RW 02', NULL, '2022-06-08 22:40:25', '2022-06-08 22:40:25'),
(35, 'Munalisa', 'Munalisa', 87700018696, '3529016811810005', 'customer', 'perempuan', '$2y$10$VjQMRzWGiqfUSva.cA9hAu/P3A83VK9QMcjQhIM2.aIzus1mOaCqK', 'Sarpaan RT 01/RW 01', NULL, '2022-06-08 22:41:21', '2022-06-08 22:41:21'),
(36, 'Rizki Vavan K', 'Rizki Vavan K', 85231282001, '3529012509970001', 'customer', 'laki-laki', '$2y$10$PspNurgjmoCBRkzEyFU0.OsTBn4FyVxEkHqhAO.uJU6AoNzFGi6Qa', 'Tal Bantal RT 03/RW 02', NULL, '2022-06-08 22:44:14', '2022-06-08 22:44:14'),
(37, 'Ahmad Rifa\'i', 'Ahmad Rifa\'i', 87872419355, '3529010508770006', 'customer', 'laki-laki', '$2y$10$uYX9KsHnYJy6YiGhab8E6elX.7/XZGSIB23n0OwJkyNgEvyIPM/Fa', 'Tal Bantal RT 03/RW 02', NULL, '2022-06-08 22:45:21', '2022-06-08 22:45:21'),
(38, 'Ach. Budiyono', 'Ach. Budiyono', 87831388883, '3511221104865002', 'customer', 'laki-laki', '$2y$10$Lt2S./uqEO3vbhSvMqK0yeB5JrqpNkLTCMgaTo2SCQFPm4pVm3tDe', 'Tal Bantal RT 03/RW 01', NULL, '2022-06-08 22:46:20', '2022-06-08 22:46:20'),
(39, 'Amir Mahmud', 'Amir Mahmud', 82331099590, '3529013011700002', 'customer', 'laki-laki', '$2y$10$XIGCiicfCd54/z1Jl.5De.KJTQPQxiuVLaUog2ZoGfx/sEeXaXfPS', 'Griya Mapan RT 01/RW 04', NULL, '2022-06-08 22:47:01', '2022-06-08 22:47:01'),
(40, 'Hasan Riyadi', 'Hasan Riyadi', 85232407342, '3528032710820003', 'customer', 'laki-laki', '$2y$10$j00IoiItjqCvWy2adIpjNe2KIrYmb47aHgoxYJmWSo33dGOmHWKqy', 'Sarpaan RT 01/RW 01', NULL, '2022-06-08 22:47:58', '2022-06-08 22:47:58'),
(41, 'Amaniya', 'Amaniya', 87850242066, '3529014505700006', 'customer', 'perempuan', '$2y$10$FrMzS7Uzh1YsiPWHOru1jeAhEdcgABMcG2AuL838nvWsz53SgJmM6', 'Tal Bantal RT 02/RW 02', NULL, '2022-06-08 22:48:38', '2022-06-08 22:48:38'),
(42, 'Sri Wahyuni', 'Sri Wahyuni', 87873818581, '3539016705790006', 'customer', 'perempuan', '$2y$10$89KtHFw19rPdsFGPKa93p.6V3GXmK8OrOMHv/FNpwEgq5D8TvaP3.', 'Sarpaan RT 01/RW 01', NULL, '2022-06-08 22:49:40', '2022-06-08 22:49:40'),
(43, 'Ummi Tarwiyah', 'Ummi Tarwiyah', 87863818589, '3529015008710003', 'customer', 'perempuan', '$2y$10$M4Y4ZJfgHCeyr6RoRkSxK.610tygt76akQSHVO1hXajjP5DgvUmXO', 'Tal Bantal RT 02/RW 02', NULL, '2022-06-08 22:59:04', '2022-06-08 22:59:04'),
(44, 'Moh. Ridwan', 'Moh. Ridwan', 81938439743, '3529011202720002', 'customer', 'laki-laki', '$2y$10$/Ut7pBKCdpZy2sYjU.4Gc.fvbeaWNGgMZe4Xgm4dRSN2pDosdOFRe', 'Tal Bantal RT 03/RW 02', NULL, '2022-06-08 23:07:01', '2022-06-08 23:07:01'),
(45, 'H. Maadin', 'H. Maadin', 81735792947, '3529013402960009', 'customer', 'laki-laki', '$2y$10$Jr9.loQdeReU58WLCtUG/euO4UTC1XD1Sse7AqGZjfT8Wuj8Q0n2W', 'Tal Bantal RT 03/RW 02', NULL, '2022-06-08 23:09:12', '2022-06-08 23:09:12'),
(46, 'Lestari H', 'Lestari H', 82335427744, '3529017112710002', 'customer', 'perempuan', '$2y$10$zhW64lEcu7XA1kI.DiC8BeFKjF.6Lptot53TeHw2uAX7QGa4Zlq8u', 'Tal Bantal RT 03/RW 01', NULL, '2022-06-08 23:10:13', '2022-06-08 23:10:13'),
(47, 'Saifur Rahman', 'Saifur Rahman', 81703494657, '3529030208761154', 'customer', 'laki-laki', '$2y$10$3qKRDdKCU.OLMHXeoydG8Ov5CXhEzeisI2Uri/TJd5wIIZjxXW5Da', 'Tal Bantal RT 03/RW 02', NULL, '2022-06-08 23:11:25', '2022-06-08 23:11:25'),
(48, 'Juhana', 'Juhana', 85232889967, '3529013006670041', 'customer', 'laki-laki', '$2y$10$bQJRDCOOhB92rSjyC7Tpy.f87gCsFnyMqTHunReXo8fVgFxVbVDJ.', 'Tal Bantal RT 02/RW 02', NULL, '2022-06-08 23:14:22', '2022-06-08 23:14:22'),
(49, 'Wita Hamediyanti', 'Wita Hamediyanti', 814532407327, '3529015705040003', 'customer', 'perempuan', '$2y$10$u8qMc0qKhkpNg76aNwxl3etBg/Ye.ZCAnzVL1J43piZetwv.2Nd.K', 'Tal Bantal RT 02/RW 02', NULL, '2022-06-09 00:49:14', '2022-06-09 00:49:14'),
(50, 'Alfian Dwi K', 'Alfian Dwi K', 83853092572, '3529015013660008', 'customer', 'laki-laki', '$2y$10$F7aOCZrfnUO6Vv8wMvNB.uEPliRxYhI14PbmrwusQ0.luCF6NFnMS', 'Tal Bantal RT 02/RW 02', NULL, '2022-06-09 00:50:31', '2022-06-09 00:50:31'),
(51, 'Faizal Amin', 'Faizal Amin', 81703262347, '3529025811810009', 'admin', 'laki-laki', '$2y$10$oAHc1FbrNNs8Px6lGxKnqeQ12WpGDx9vlkR.tXTWV2nW892fqDNZe', 'Tal Bantal RT 03/RW 01', NULL, '2022-06-09 00:51:45', '2022-06-09 00:51:45'),
(52, 'Triyuliana W', 'Triyuliana W', 81743992949, '3529014519700009', 'customer', 'perempuan', '$2y$10$VfrGlq/CKkw46RdD9hWikux9gVquzDeOn86MD3zTPTGGnod94J87q', 'Tal Bantal RT 03/RW 02', NULL, '2022-06-09 00:54:30', '2022-06-09 00:54:30'),
(53, 'Mistahor Rahman', 'Mistahor Rahman', 85231651447, '3529012012680001', 'customer', 'laki-laki', '$2y$10$rExK9ewaBrIEzas7fhekReE1G5eHjMIvfHknNHFY/.0G5zLtvCsla', 'Tal Bantal RT 03/RW 02', NULL, '2022-06-09 01:08:55', '2022-06-09 01:08:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `angsuran`
--
ALTER TABLE `angsuran`
  ADD PRIMARY KEY (`id_angsuran`),
  ADD KEY `phone` (`nik`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`),
  ADD KEY `id_angsuran` (`id_angsuran`);

--
-- Indexes for table `penarikan`
--
ALTER TABLE `penarikan`
  ADD PRIMARY KEY (`id_penarikan`),
  ADD KEY `nik` (`id_simpanan`);

--
-- Indexes for table `permohonan`
--
ALTER TABLE `permohonan`
  ADD PRIMARY KEY (`id_permohonan`),
  ADD KEY `phone` (`nik`);

--
-- Indexes for table `pinjaman`
--
ALTER TABLE `pinjaman`
  ADD PRIMARY KEY (`id_pinjaman`),
  ADD KEY `phone` (`nik`);

--
-- Indexes for table `simpanan`
--
ALTER TABLE `simpanan`
  ADD PRIMARY KEY (`id_simpanan`),
  ADD UNIQUE KEY `nik` (`nik`),
  ADD KEY `phone` (`nik`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nik` (`nik`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `angsuran`
--
ALTER TABLE `angsuran`
  MODIFY `id_angsuran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `penarikan`
--
ALTER TABLE `penarikan`
  MODIFY `id_penarikan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `permohonan`
--
ALTER TABLE `permohonan`
  MODIFY `id_permohonan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `pinjaman`
--
ALTER TABLE `pinjaman`
  MODIFY `id_pinjaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `simpanan`
--
ALTER TABLE `simpanan`
  MODIFY `id_simpanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
