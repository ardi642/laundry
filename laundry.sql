-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 05, 2023 at 10:43 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laundry`
--

-- --------------------------------------------------------

--
-- Table structure for table `jenis_paket`
--

CREATE TABLE `jenis_paket` (
  `id_jenis_paket` int(11) NOT NULL,
  `jenis_paket` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jenis_paket`
--

INSERT INTO `jenis_paket` (`id_jenis_paket`, `jenis_paket`) VALUES
(3, 'Cuci Komplit'),
(4, 'Cuci Satuan'),
(2, 'Dry Clean');

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `id_karyawan` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_karyawan` varchar(50) NOT NULL,
  `no_telepon` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `level` varchar(20) NOT NULL,
  `alamat` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id_karyawan`, `username`, `password`, `nama_karyawan`, `no_telepon`, `email`, `level`, `alamat`) VALUES
(2, 'admin', '$2a$10$SmFtucwDkU51VG0I6ckr3.CtTPRufmrCjgTfip0LQt9CRtQJPNFTi', 'admin', NULL, NULL, 'admin', NULL),
(3, 'karyawan', '$2y$10$q.VSMKIm8dHwuN0JN4j5F.7LqJSE3UB26AGsfHdcd5cEyo2zK/PjO', 'karyawan', '', '', 'karyawan', '');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id_order` int(11) NOT NULL,
  `nama_pelanggan` varchar(50) NOT NULL,
  `alamat` text DEFAULT NULL,
  `no_telepon` varchar(15) DEFAULT NULL,
  `id_paket` int(11) DEFAULT NULL,
  `satuan_tertentu` varchar(50) DEFAULT NULL,
  `tarif_satuan_tertentu` int(11) DEFAULT NULL,
  `waktu_masuk` datetime DEFAULT NULL,
  `waktu_diambil` datetime DEFAULT NULL,
  `waktu_perkiraan_selesai` datetime DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `status` enum('belum diproses','proses','selesai diproses','sudah diambil','hilang') DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `total_bayar` int(11) DEFAULT NULL,
  `uang_pelanggan` int(11) DEFAULT NULL,
  `uang_kembalian` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id_order`, `nama_pelanggan`, `alamat`, `no_telepon`, `id_paket`, `satuan_tertentu`, `tarif_satuan_tertentu`, `waktu_masuk`, `waktu_diambil`, `waktu_perkiraan_selesai`, `jumlah`, `status`, `keterangan`, `total_bayar`, `uang_pelanggan`, `uang_kembalian`) VALUES
(1, 'ardiansyah latif', 'asd', '085244749346', 2, 'kg', 8000, '2023-07-04 14:12:20', NULL, '2023-07-06 16:12:20', 2, 'belum diproses', '', 16000, 30000, 14000),
(3, 'ardi', 'btn batumarupa', '12321', 2, 'kg', 8000, '2023-07-03 14:21:12', NULL, '2023-07-06 16:21:12', 3, 'belum diproses', '', 24000, 0, -24000),
(5, 'ardis', 'ardis', '12312', 3, 'pcs', 15000, '2023-07-04 14:24:23', '2023-07-04 15:16:18', '2023-07-05 14:24:23', 4, 'sudah diambil', 'adasd', 60000, 62000, 2000),
(6, 'saya', 'wdsdsdf', '081231', 3, 'pcs', 15000, '2023-07-05 14:41:43', NULL, '2023-07-06 14:41:43', 3, 'proses', '', 45000, 0, -45000),
(7, 'wall', 'asdasd', '123123', 5, 'pcs', 20000, '2023-07-05 14:50:33', NULL, '2023-07-08 16:50:33', 2, 'belum diproses', '', 40000, 50000, 10000);

-- --------------------------------------------------------

--
-- Table structure for table `paket`
--

CREATE TABLE `paket` (
  `id_paket` int(11) NOT NULL,
  `nama_paket` varchar(50) NOT NULL,
  `id_jenis_paket` int(11) NOT NULL,
  `waktu_kerja_jam` int(11) NOT NULL,
  `waktu_kerja_hari` int(11) NOT NULL,
  `satuan` varchar(50) NOT NULL,
  `tarif_satuan` int(11) NOT NULL,
  `minimal_satuan` int(11) NOT NULL,
  `keterangan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `paket`
--

INSERT INTO `paket` (`id_paket`, `nama_paket`, `id_jenis_paket`, `waktu_kerja_jam`, `waktu_kerja_hari`, `satuan`, `tarif_satuan`, `minimal_satuan`, `keterangan`) VALUES
(2, 'dry clean kilat', 2, 2, 2, 'kg', 8000, 2, ''),
(3, 'Jaket Kulit', 4, 0, 1, 'pcs', 15000, 1, ''),
(4, 'Komplit busa express', 3, 0, 1, 'kg', 5000, 1, ''),
(5, 'Kasur', 4, 2, 3, 'pcs', 20000, 1, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jenis_paket`
--
ALTER TABLE `jenis_paket`
  ADD PRIMARY KEY (`id_jenis_paket`),
  ADD UNIQUE KEY `jenis_paket` (`jenis_paket`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id_karyawan`) USING BTREE,
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id_order`),
  ADD KEY `FK_order_paket` (`id_paket`);

--
-- Indexes for table `paket`
--
ALTER TABLE `paket`
  ADD PRIMARY KEY (`id_paket`),
  ADD KEY `FK__jenis_paket` (`id_jenis_paket`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jenis_paket`
--
ALTER TABLE `jenis_paket`
  MODIFY `id_jenis_paket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id_karyawan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `paket`
--
ALTER TABLE `paket`
  MODIFY `id_paket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `FK_order_paket` FOREIGN KEY (`id_paket`) REFERENCES `paket` (`id_paket`) ON UPDATE CASCADE;

--
-- Constraints for table `paket`
--
ALTER TABLE `paket`
  ADD CONSTRAINT `FK__jenis_paket` FOREIGN KEY (`id_jenis_paket`) REFERENCES `jenis_paket` (`id_jenis_paket`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
