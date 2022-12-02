-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2022 at 01:49 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rembangk_evira`
--

-- --------------------------------------------------------

--
-- Table structure for table `sensus_kec`
--

CREATE TABLE `sensus_kec` (
  `kode_prov` char(2) NOT NULL,
  `kode_kab` char(2) NOT NULL,
  `kode_kec` char(3) NOT NULL,
  `nama_kec` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sensus_kec`
--

INSERT INTO `sensus_kec` (`kode_prov`, `kode_kab`, `kode_kec`, `nama_kec`) VALUES
('33', '17', '010', 'SUMBER'),
('33', '17', '020', 'BULU'),
('33', '17', '030', 'GUNEM'),
('33', '17', '040', 'SALE'),
('33', '17', '050', 'SARANG'),
('33', '17', '060', 'SEDAN'),
('33', '17', '070', 'PAMOTAN'),
('33', '17', '080', 'SULANG'),
('33', '17', '090', 'KALIORI'),
('33', '17', '100', 'REMBANG'),
('33', '17', '110', 'PANCUR'),
('33', '17', '120', 'KRAGAN'),
('33', '17', '130', 'SLUKE'),
('33', '17', '140', 'LASEM');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sensus_kec`
--
ALTER TABLE `sensus_kec`
  ADD PRIMARY KEY (`kode_prov`,`kode_kab`,`kode_kec`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
