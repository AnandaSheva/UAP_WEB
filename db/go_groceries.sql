-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 13, 2024 at 05:37 AM
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
('BRG001', 'Beras Cap Bunga', 1, 2, 15),
('BRG002', 'Minyak Bimoli', 2, 1, 64),
('BRG003', 'Minyak Tropical', 2, 3, 20),
('BRG004', 'Bawang Merah', 6, 2, 120),
('BRG005', 'Bawang Putih', 6, 2, 90),
('BRG006', 'Gulaku', 4, 1, 40),
('BRG007', 'Telur Ayam Kampung', 7, 3, 62),
('BRG008', 'Telur Bebek', 7, 3, 28),
('BRG009', 'Dada Ayam', 3, 1, 35),
('BRG010', 'Beras BMW', 1, 1, 50);

-- --------------------------------------------------------

--
-- Table structure for table `barang_keluar`
--

CREATE TABLE `barang_keluar` (
  `id_keluar` varchar(10) NOT NULL,
  `id_barang` varchar(10) DEFAULT NULL,
  `jumlah_barang` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barang_keluar`
--

INSERT INTO `barang_keluar` (`id_keluar`, `id_barang`, `jumlah_barang`, `tanggal`) VALUES
('OUT-0001', 'BRG001', 54, '2024-05-20'),
('OUT-0002', 'BRG002', 21, '2024-05-20'),
('OUT-0003', 'BRG003', 27, '2024-05-20'),
('OUT-0004', 'BRG004', 35, '2024-05-20'),
('OUT-0005', 'BRG005', 66, '2024-05-20'),
('OUT-0006', 'BRG006', 50, '2024-05-20'),
('OUT-0007', 'BRG007', 36, '2024-05-20'),
('OUT-0008', 'BRG008', 31, '2024-05-20'),
('OUT-0009', 'BRG009', 32, '2024-05-20'),
('OUT-0010', 'BRG010', 16, '2024-05-20'),
('OUT-0011', 'BRG011', 47, '2024-05-20'),
('OUT-0012', 'BRG012', 59, '2024-05-20');

-- --------------------------------------------------------

--
-- Table structure for table `barang_masuk`
--

CREATE TABLE `barang_masuk` (
  `id_masuk` varchar(10) NOT NULL,
  `id_barang` varchar(10) DEFAULT NULL,
  `jumlah_barang` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barang_masuk`
--

INSERT INTO `barang_masuk` (`id_masuk`, `id_barang`, `jumlah_barang`, `tanggal`) VALUES
('IN-0001', 'BRG001', 86, '2024-05-19'),
('IN-0002', 'BRG002', 36, '2024-05-19'),
('IN-0003', 'BRG003', 42, '2024-05-19'),
('IN-0004', 'BRG004', 78, '2024-05-19'),
('IN-0005', 'BRG005', 90, '2024-05-19'),
('IN-0006', 'BRG006', 80, '2024-05-19'),
('IN-0007', 'BRG007', 51, '2024-05-19'),
('IN-0008', 'BRG008', 75, '2024-05-19'),
('IN-0009', 'BRG009', 87, '2024-05-19'),
('IN-0010', 'BRG010', 34, '2024-05-19'),
('IN-0011', 'BRG011', 89, '2024-05-19'),
('IN-0012', 'BRG012', 86, '2024-05-19');

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
  ADD KEY `barang_keluar_ibfk_1` (`id_barang`);

--
-- Indexes for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD PRIMARY KEY (`id_masuk`),
  ADD KEY `barang_masuk_ibfk_1` (`id_barang`);

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
