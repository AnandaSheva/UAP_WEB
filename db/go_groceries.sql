-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 09, 2024 at 05:12 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `go_groceries`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` varchar(10) NOT NULL,
  `nama_barang` varchar(100) DEFAULT NULL,
  `id_jenisbarang` int(11) DEFAULT NULL,
  `id_lokasi` int(11) DEFAULT NULL,
  `stok` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `nama_barang`, `id_jenisbarang`, `id_lokasi`, `stok`) VALUES
('BRG001', 'Beras Cap Mawar', 1, 2, -116),
('BRG002', 'Minyak Bimoli', 2, 1, 28),
('BRG003', 'Minyak Tropical', 2, 3, -78),
('BRG004', 'Bawang Merah', 6, 2, 75),
('BRG005', 'Bawang Putih', 6, 2, 80),
('BRG006', 'Gulaku', 4, 1, 40),
('BRG007', 'Telur Ayam Kampung', 7, 3, 62),
('BRG008', 'Telur Bebek', 7, 3, 28),
('BRG009', 'Dada Ayam', 3, 1, 35),
('BRG010', 'Beras BMW', 1, 1, 50),
('BRG011', 'Beras Premium', 1, 3, 0),
('BRG012', 'Beras', 1, 1, 0),
('BRG013', 'minyak', 2, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `barang_keluar`
--

CREATE TABLE `barang_keluar` (
  `id_keluar` int(11) NOT NULL,
  `id_barang` varchar(10) DEFAULT NULL,
  `jumlah_barang` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barang_keluar`
--

INSERT INTO `barang_keluar` (`id_keluar`, `id_barang`, `jumlah_barang`, `tanggal`) VALUES
(1, 'BRG001', 60, '2024-05-20'),
(2, 'BRG002', 21, '2024-05-20'),
(3, 'BRG003', 27, '2024-05-20'),
(4, 'BRG004', 35, '2024-05-20'),
(5, 'BRG005', 66, '2024-05-20'),
(6, 'BRG006', 50, '2024-05-20'),
(7, 'BRG007', 36, '2024-05-20'),
(8, 'BRG008', 31, '2024-05-20'),
(9, 'BRG009', 32, '2024-05-20'),
(10, 'BRG010', 16, '2024-05-20'),
(13, 'BRG003', 98, '2024-06-09'),
(14, 'BRG004', 45, '2024-06-06'),
(15, 'BRG001', 65, '2024-06-09');

--
-- Triggers `barang_keluar`
--
DELIMITER $$
CREATE TRIGGER `after_delete_barang_keluar` AFTER DELETE ON `barang_keluar` FOR EACH ROW BEGIN
    UPDATE barang
    SET stok = stok + OLD.jumlah_barang
    WHERE id_barang = OLD.id_barang;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_stock_after_insert_out` AFTER INSERT ON `barang_keluar` FOR EACH ROW BEGIN
    UPDATE barang
    SET stok = stok - NEW.jumlah_barang
    WHERE id_barang = NEW.id_barang;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `barang_masuk`
--

CREATE TABLE `barang_masuk` (
  `id_masuk` int(11) NOT NULL,
  `id_barang` varchar(10) DEFAULT NULL,
  `jumlah_barang` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barang_masuk`
--

INSERT INTO `barang_masuk` (`id_masuk`, `id_barang`, `jumlah_barang`, `tanggal`) VALUES
(3, 'BRG003', 80, '2024-05-19'),
(6, 'BRG006', 120, '2024-05-19'),
(7, 'BRG007', 51, '2024-05-19'),
(8, 'BRG008', 75, '2024-05-19'),
(9, 'BRG009', 87, '2024-05-19'),
(10, 'BRG010', 34, '2024-05-19'),
(14, 'BRG004', 100, '2024-06-05'),
(19, 'BRG001', 1000, '2024-06-08'),
(20, 'BRG005', 80, '2024-06-09');

--
-- Triggers `barang_masuk`
--
DELIMITER $$
CREATE TRIGGER `after_delete_barang_masuk` AFTER DELETE ON `barang_masuk` FOR EACH ROW BEGIN
    UPDATE barang
    SET stok = stok - OLD.jumlah_barang
    WHERE id_barang = OLD.id_barang;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_stock_after_insert_in` AFTER INSERT ON `barang_masuk` FOR EACH ROW BEGIN
	UPDATE barang
    SET stok = stok + NEW.jumlah_barang
    WHERE id_barang = NEW.id_barang;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `jenis_barang`
--

CREATE TABLE `jenis_barang` (
  `id_jenisbarang` int(11) NOT NULL,
  `jenis` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jenis_barang`
--

INSERT INTO `jenis_barang` (`id_jenisbarang`, `jenis`) VALUES
(1, 'Beras'),
(2, 'Minyak'),
(3, 'Daging'),
(4, 'Gula'),
(5, 'Garam'),
(6, 'Bawang'),
(7, 'Telur');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_kelamin`
--

CREATE TABLE `jenis_kelamin` (
  `id_jk` int(11) NOT NULL,
  `jenis_kelamin` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jenis_kelamin`
--

INSERT INTO `jenis_kelamin` (`id_jk`, `jenis_kelamin`) VALUES
(1, 'laki-laki'),
(2, 'perempuan');

-- --------------------------------------------------------

--
-- Table structure for table `lokasi_penyimpanan`
--

CREATE TABLE `lokasi_penyimpanan` (
  `id_lokasi` int(11) NOT NULL,
  `nama_lokasi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lokasi_penyimpanan`
--

INSERT INTO `lokasi_penyimpanan` (`id_lokasi`, `nama_lokasi`) VALUES
(1, 'Gudang Prima'),
(2, 'Gudang Blora'),
(3, 'Gudang Ijen');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id_pegawai` varchar(20) NOT NULL,
  `nama_pegawai` varchar(100) NOT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `no_telepon` varchar(20) DEFAULT NULL,
  `id_jk` int(11) DEFAULT NULL,
  `id_lokasi` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `nama_pegawai`, `alamat`, `no_telepon`, `id_jk`, `id_lokasi`) VALUES
('NPM01', 'Ananda Sheva H', 'Metro', '085709567374', 1, 3),
('NPM02', 'Dede Juniar Putra', 'Bandar Lampung', '082345678901', 1, 2),
('NPM03', 'Adiska Bayu', 'Mesuji', '083456789012', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`username`, `password`) VALUES
('adminganteng', 'admin123'),
('', ''),
('manajerganteng', 'manajer123'),
('admin', 'admin123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`),
  ADD KEY `id_jenisbarang` (`id_jenisbarang`),
  ADD KEY `id_lokasi` (`id_lokasi`);

--
-- Indexes for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD PRIMARY KEY (`id_keluar`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indexes for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD PRIMARY KEY (`id_masuk`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indexes for table `jenis_barang`
--
ALTER TABLE `jenis_barang`
  ADD PRIMARY KEY (`id_jenisbarang`);

--
-- Indexes for table `jenis_kelamin`
--
ALTER TABLE `jenis_kelamin`
  ADD PRIMARY KEY (`id_jk`);

--
-- Indexes for table `lokasi_penyimpanan`
--
ALTER TABLE `lokasi_penyimpanan`
  ADD PRIMARY KEY (`id_lokasi`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_pegawai`),
  ADD KEY `id_jk` (`id_jk`),
  ADD KEY `id_lokasi` (`id_lokasi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  MODIFY `id_keluar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  MODIFY `id_masuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `jenis_barang`
--
ALTER TABLE `jenis_barang`
  MODIFY `id_jenisbarang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `lokasi_penyimpanan`
--
ALTER TABLE `lokasi_penyimpanan`
  MODIFY `id_lokasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`id_jenisbarang`) REFERENCES `jenis_barang` (`id_jenisbarang`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `barang_ibfk_2` FOREIGN KEY (`id_lokasi`) REFERENCES `lokasi_penyimpanan` (`id_lokasi`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD CONSTRAINT `barang_keluar_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`);

--
-- Constraints for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD CONSTRAINT `barang_masuk_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`);

--
-- Constraints for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD CONSTRAINT `pegawai_ibfk_1` FOREIGN KEY (`id_jk`) REFERENCES `jenis_kelamin` (`id_jk`),
  ADD CONSTRAINT `pegawai_ibfk_2` FOREIGN KEY (`id_lokasi`) REFERENCES `lokasi_penyimpanan` (`id_lokasi`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
