-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 23, 2022 at 08:58 AM
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
(4, '351589729823728', '1500000', 3, 'LUNAS', 'NXRMWT', '2022-05-11 08:25:26', '2022-05-11 08:25:26'),
(7, '3512323423423', '15000000', 3, 'BELUM LUNAS', 'BDQLNT', '2022-05-12 07:36:35', '2022-05-12 07:36:35'),
(6, '351589729823728', '500000', 2, 'LUNAS', 'CGMYNR', '2022-05-11 08:28:24', '2022-05-11 08:28:24');

-- --------------------------------------------------------

--
-- Table structure for table `denda`
--

CREATE TABLE `denda` (
  `id_denda` int(11) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `nominal` varchar(255) NOT NULL,
  `status_denda` enum('BELUM LUNAS','LUNAS') NOT NULL,
  `kode_pembayaran` varchar(6) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `denda`
--

INSERT INTO `denda` (`id_denda`, `phone`, `nominal`, `status_denda`, `kode_pembayaran`, `created_at`, `updated_at`) VALUES
(1, '1', '0', 'BELUM LUNAS', 'OOOOO', '2022-04-14 03:41:29', '2022-04-14 03:41:29');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `id_angsuran` int(11) NOT NULL,
  `nominal` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_angsuran`, `nominal`, `created_at`, `updated_at`) VALUES
(2, 4, '1500000', '2022-05-11 09:11:06', '2022-05-11 09:11:06'),
(3, 6, '500000', '2022-05-11 09:13:24', '2022-05-11 09:13:24');

-- --------------------------------------------------------

--
-- Table structure for table `penarikan`
--

CREATE TABLE `penarikan` (
  `id_penarikan` int(11) NOT NULL,
  `nik` varchar(255) NOT NULL,
  `nominal` varchar(255) NOT NULL,
  `kode_penarikan` varchar(6) NOT NULL,
  `status_penarikan` enum('TELAH DIAMBIL','BELUM DIAMBIL') NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penarikan`
--

INSERT INTO `penarikan` (`id_penarikan`, `nik`, `nominal`, `kode_penarikan`, `status_penarikan`, `created_at`, `updated_at`) VALUES
(1, '0', '0', '000000', 'BELUM DIAMBIL', '2022-05-12 07:50:46', '2022-05-12 07:50:46'),
(3, '3512323423423', '150000000', 'OVQGOQ', 'BELUM DIAMBIL', '2022-05-12 09:46:48', '2022-05-12 09:46:48');

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

--
-- Dumping data for table `permohonan`
--

INSERT INTO `permohonan` (`id_permohonan`, `nik`, `judul_permohonan`, `nominal_permohonan`, `jenis_permohonan`, `status_permohonan`, `created_at`, `updated_at`) VALUES
(1, '351589729823728', 'test', '1500000', 'SIMPAN', 'DITOLAK', '2022-05-12 03:07:41', '2022-05-12 03:07:41'),
(4, '3512323423423', 'test', '150000', 'PENARIKAN', 'HOLD', '2022-05-12 08:51:05', '2022-05-12 08:51:05'),
(3, '3512361231826318', 'test', '150000', 'PENARIKAN', 'HOLD', '2022-05-12 03:22:10', '2022-05-12 03:22:10'),
(5, '3512323423423', 'test', '15000', 'PINJAM', 'HOLD', '2022-05-12 09:09:48', '2022-05-12 09:09:48'),
(6, '3512323423423', 'test', '156000', 'SIMPAN', 'HOLD', '2022-05-12 09:12:56', '2022-05-12 09:12:56'),
(7, '3512323423423', 'test', '12312312', 'PINJAM', 'HOLD', '2022-05-12 09:53:03', '2022-05-12 09:53:03');

-- --------------------------------------------------------

--
-- Table structure for table `pinjaman`
--

CREATE TABLE `pinjaman` (
  `id_pinjaman` int(11) NOT NULL,
  `nominal` varchar(255) NOT NULL,
  `biaya_admin` int(255) NOT NULL,
  `nik` varchar(255) NOT NULL,
  `kode_penarikan` varchar(6) NOT NULL,
  `jenis_pinjaman` enum('BIASA') NOT NULL,
  `status_pinjaman` enum('BELUM DIAMBIL','TELAH DIAMBIL') NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pinjaman`
--

INSERT INTO `pinjaman` (`id_pinjaman`, `nominal`, `biaya_admin`, `nik`, `kode_penarikan`, `jenis_pinjaman`, `status_pinjaman`, `created_at`, `updated_at`) VALUES
(8, '15000000', 20000, '3512323423423', 'GPTEAS', 'BIASA', 'BELUM DIAMBIL', '2022-05-12 09:39:37', '2022-05-12 09:39:37'),
(1, '0', 0, '0', '000000', 'BIASA', 'BELUM DIAMBIL', '2022-05-12 07:49:59', '2022-05-12 07:49:59');

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
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `simpanan`
--

INSERT INTO `simpanan` (`id_simpanan`, `nik`, `nominal`, `kode_deposit`, `jenis_simpanan`, `status_simpanan`, `created_at`, `updated_at`) VALUES
(8, '3512323423423', '150000', 'UYFDUW', 'POKOK', 'BELUM DEPOSIT', '2022-05-12 09:28:25', '2022-05-12 09:28:25'),
(7, '0', '0', '000000', 'POKOK', 'BELUM DEPOSIT', '2022-05-12 07:51:06', '2022-05-12 07:51:06');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `nik` varchar(255) DEFAULT NULL,
  `role` enum('superadmin','admin','customer') NOT NULL,
  `gender` enum('laki-laki','perempuan') NOT NULL,
  `password` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `nik`, `role`, `gender`, `password`, `alamat`, `created`, `updated_at`) VALUES
(7, 'customer', 'customer', '3512323423423', 'customer', 'laki-laki', '$2y$10$Ck593/ybbwnN6ysN8EdjpeKhJXQv.zWvY6TSU5hkkZ5drXzyc8KGO', 'Madura', '2022-05-12 07:07:25', '2022-05-12 07:07:25'),
(8, 'admin bumdes', 'admin', '3512361293182639', 'admin', 'laki-laki', '$2y$10$1k2bogNCgGvGSZAJHqGpCOEgXXDDeLYYokXmcs9ygldr4q2IhFJz2', 'Sarpaan RT 03/RW 01', '2022-05-12 07:34:45', '2022-05-12 07:34:45'),
(5, 'bumdes', 'superadmin', '3512361231826318', 'superadmin', 'laki-laki', '$2a$12$VztwJpBNyGlt2IopJmP.VuleiZThrfUCg1nJ4WO0BOVVvTyHqWS4O', 'Sarpaan RT 01/RW 01', '2022-05-11 03:04:03', '2022-05-11 03:04:03');

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
-- Indexes for table `denda`
--
ALTER TABLE `denda`
  ADD PRIMARY KEY (`id_denda`),
  ADD KEY `phone` (`phone`);

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
  ADD KEY `nik` (`nik`);

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
  ADD KEY `phone` (`nik`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `angsuran`
--
ALTER TABLE `angsuran`
  MODIFY `id_angsuran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `denda`
--
ALTER TABLE `denda`
  MODIFY `id_denda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `penarikan`
--
ALTER TABLE `penarikan`
  MODIFY `id_penarikan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `permohonan`
--
ALTER TABLE `permohonan`
  MODIFY `id_permohonan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pinjaman`
--
ALTER TABLE `pinjaman`
  MODIFY `id_pinjaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `simpanan`
--
ALTER TABLE `simpanan`
  MODIFY `id_simpanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
