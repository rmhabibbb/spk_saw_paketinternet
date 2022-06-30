-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 13, 2021 at 04:54 PM
-- Server version: 5.7.23
-- PHP Version: 5.6.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_spk_saw_paketinternet`
--

-- --------------------------------------------------------

--
-- Table structure for table `akun`
--

DROP TABLE IF EXISTS `akun`;
CREATE TABLE IF NOT EXISTS `akun` (
  `email` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `role` int(1) NOT NULL,
  `foto` text NOT NULL,
  `temp_kode` varchar(4) DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `akun`
--

INSERT INTO `akun` (`email`, `password`, `role`, `foto`, `temp_kode`) VALUES
('odd.akun2@gmail.com', 'a3dcb4d229de6fde0db5686dee47145d', 2, 'foto/default-l.jpg', NULL),
('odd.akuni@gmail.com', 'a3dcb4d229de6fde0db5686dee47145d', 2, 'foto/default-l.jpg', NULL),
('spkpaketinternetsaw@gmail.com', '25d55ad283aa400af464c76d713c07ad', 1, 'foto/default.jpg', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bobot_kriteria`
--

DROP TABLE IF EXISTS `bobot_kriteria`;
CREATE TABLE IF NOT EXISTS `bobot_kriteria` (
  `id_bobot` int(11) NOT NULL AUTO_INCREMENT,
  `keterangan` text NOT NULL,
  `nilai` int(1) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  PRIMARY KEY (`id_bobot`),
  KEY `id_kriteria` (`id_kriteria`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bobot_kriteria`
--

INSERT INTO `bobot_kriteria` (`id_bobot`, `keterangan`, `nilai`, `id_kriteria`) VALUES
(1, '< 2,1 Mbps', 1, 1),
(2, '2,2 Mbps - 4,0 Mbps', 2, 1),
(3, '4,1 Mbps - 8,0 Mbps', 3, 1),
(4, '8,1 Mbps - 12,0 Mbps', 4, 1),
(5, '> 12,1 Mbps', 5, 1),
(6, '> Rp 100.000', 2, 2),
(7, 'Rp 55.000 - Rp 100.000', 3, 2),
(9, 'Rp 25.000 - Rp 55.000', 4, 2),
(10, '< Rp 25.000', 5, 2),
(11, 'Browsing', 2, 3),
(12, 'Streaming', 3, 3),
(13, 'Download', 4, 3),
(14, 'Upload', 5, 3),
(15, 'Kuota Harian', 2, 4),
(16, 'Kuota Mingguan', 3, 4),
(17, 'Kuota Bulanan', 5, 4);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `id_customer` varchar(8) NOT NULL,
  `nama_customer` varchar(35) NOT NULL,
  `jk` varchar(20) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  PRIMARY KEY (`id_customer`),
  KEY `fk_customer_email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id_customer`, `nama_customer`, `jk`, `no_hp`, `email`) VALUES
('220212', 'RM Habibii', 'Laki - Laki', '0822895054664', 'odd.akuni@gmail.com'),
('54215029', 'Aditya Riskaaaaa', 'Laki - Laki', '082289505466', 'odd.akun2@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

DROP TABLE IF EXISTS `kriteria`;
CREATE TABLE IF NOT EXISTS `kriteria` (
  `id_kriteria` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kriteria` text NOT NULL,
  `bobot_vektor` decimal(5,2) NOT NULL,
  `tipe` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  PRIMARY KEY (`id_kriteria`),
  KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `nama_kriteria`, `bobot_vektor`, `tipe`, `email`) VALUES
(1, 'Kecepatan Koneksi', '30.00', 'Benefit', 'spkpaketinternetsaw@gmail.com'),
(2, 'Harga', '30.00', 'Cost', 'spkpaketinternetsaw@gmail.com'),
(3, 'Kapasitas Koneksi', '25.00', 'Benefit', 'spkpaketinternetsaw@gmail.com'),
(4, 'Kuota', '15.00', 'Benefit', 'spkpaketinternetsaw@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `paket`
--

DROP TABLE IF EXISTS `paket`;
CREATE TABLE IF NOT EXISTS `paket` (
  `id_paket` int(11) NOT NULL AUTO_INCREMENT,
  `id_provider` int(11) NOT NULL,
  `nama_paket` varchar(30) NOT NULL,
  `kecepatan` text NOT NULL,
  `harga` text NOT NULL,
  `kualitas` text NOT NULL,
  `kuota` text NOT NULL,
  PRIMARY KEY (`id_paket`),
  KEY `id_provider` (`id_provider`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `paket`
--

INSERT INTO `paket` (`id_paket`, `id_provider`, `nama_paket`, `kecepatan`, `harga`, `kualitas`, `kuota`) VALUES
(2, 1, 'A4', '8,1 Mbps - 12,0 Mbps', 'Rp 25.000 - Rp 55.000', 'Upload', 'Kuota Bulanan'),
(4, 3, 'A1', '4,1 Mbps - 8,0 Mbps', '> Rp 100.000', 'Streaming', 'Kuota Mingguan'),
(5, 4, 'A2', '8,1 Mbps - 12,0 Mbps', '> Rp 100.000', 'Browsing', 'Kuota Mingguan'),
(6, 5, 'A3', '4,1 Mbps - 8,0 Mbps', 'Rp 55.000 - Rp 100.000', 'Browsing', 'Kuota Bulanan'),
(7, 6, 'A5', '4,1 Mbps - 8,0 Mbps', 'Rp 55.000 - Rp 100.000', 'Download', 'Kuota Bulanan');

-- --------------------------------------------------------

--
-- Table structure for table `penilaian`
--

DROP TABLE IF EXISTS `penilaian`;
CREATE TABLE IF NOT EXISTS `penilaian` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_paket` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `id_bobot` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_paket` (`id_paket`),
  KEY `id_kriteria` (`id_kriteria`),
  KEY `id_bobot` (`id_bobot`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penilaian`
--

INSERT INTO `penilaian` (`id`, `id_paket`, `id_kriteria`, `id_bobot`) VALUES
(17, 4, 1, 3),
(18, 4, 2, 6),
(19, 4, 3, 12),
(20, 4, 4, 16),
(21, 5, 1, 4),
(22, 5, 2, 6),
(23, 5, 3, 11),
(24, 5, 4, 16),
(25, 6, 1, 3),
(26, 6, 2, 7),
(27, 6, 3, 11),
(28, 6, 4, 17),
(29, 2, 1, 4),
(30, 2, 2, 9),
(31, 2, 3, 14),
(32, 2, 4, 17),
(33, 7, 1, 3),
(34, 7, 2, 7),
(35, 7, 3, 13),
(36, 7, 4, 17);

-- --------------------------------------------------------

--
-- Table structure for table `provider`
--

DROP TABLE IF EXISTS `provider`;
CREATE TABLE IF NOT EXISTS `provider` (
  `id_provider` int(11) NOT NULL AUTO_INCREMENT,
  `nama_provider` varchar(30) NOT NULL,
  `logo` varchar(30) NOT NULL,
  `keterangan` text NOT NULL,
  PRIMARY KEY (`id_provider`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `provider`
--

INSERT INTO `provider` (`id_provider`, `nama_provider`, `logo`, `keterangan`) VALUES
(1, 'Telkomsel', 'provider/307642280497.jpg', 'PT Telekomunikasi Selular, trading as Telkomsel, is an Indonesian wireless network provider founded in 1995 and is a subsidiary of Telkom Indonesia. It is headquartered in South Jakarta. Telkomsel is the largest wireless carrier in the country with 163 million customer base as of 2018.'),
(3, 'Tri', 'provider/277090842214.jpg', '3 or Three is a global brand name under which several UMTS-based mobile phone networks and broadband internet providers operate in Hong Kong, Macau'),
(4, 'XL Axiata ', 'provider/323796577796.jpg', 'PT XL Axiata Tbk, is an Indonesia-based mobile telecommunications services operator headquartered at Jakarta. It is the second largest mobile telecommunications company in Indonesia. The operator\'s coverage includes Java, Bali, and Lombok as well as the principal cities in and around Sumatra, Kalimantan and Sulawesi.'),
(5, 'Indosat Ooredoo ', 'provider/166089569272.jpg', 'PT Indosat Tbk, is a telecommunications provider in Indonesia. The company offers wireless services for mobile phones, and to a lesser extent, broadband internet lines for homes. Indosat operates their wireless services under a few sub-brands, among them are IM3, Mentari, and Matrix.'),
(6, 'Smartfren ', 'provider/736244976311.jpg', 'PT Smartfren Telecom Tbk, commonly known as Smartfren, is an Indonesia-based wireless network operator headquartered in Central Jakarta. It is owned by Indonesian conglomerate Sinar Mas under the company PT Sinar Mas Komunikasi Teknologi.');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bobot_kriteria`
--
ALTER TABLE `bobot_kriteria`
  ADD CONSTRAINT `fk_bobot_kriteria` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `fk_customer_email` FOREIGN KEY (`email`) REFERENCES `akun` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD CONSTRAINT `fk_kriteria_email` FOREIGN KEY (`email`) REFERENCES `akun` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `paket`
--
ALTER TABLE `paket`
  ADD CONSTRAINT `fk_paket_provider` FOREIGN KEY (`id_provider`) REFERENCES `provider` (`id_provider`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `penilaian`
--
ALTER TABLE `penilaian`
  ADD CONSTRAINT `fk_nilai_bobot` FOREIGN KEY (`id_bobot`) REFERENCES `bobot_kriteria` (`id_bobot`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_nilai_kriteria` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_nilai_paket` FOREIGN KEY (`id_paket`) REFERENCES `paket` (`id_paket`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
