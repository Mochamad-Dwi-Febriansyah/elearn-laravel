-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 10, 2024 at 09:02 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_perkuliahan`
--

-- --------------------------------------------------------

--
-- Table structure for table `mhs_ambil_mk`
--

CREATE TABLE `mhs_ambil_mk` (
  `id` int(11) NOT NULL,
  `mhs_idFK` int(11) NOT NULL,
  `matkul_idFK` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mhs_ambil_mk`
--

INSERT INTO `mhs_ambil_mk` (`id`, `mhs_idFK`, `matkul_idFK`) VALUES
(1, 2267000, 'DW'),
(2, 2267000, 'AL'),
(3, 2267000, 'EK'),
(4, 2267001, 'EK'),
(5, 2267001, 'SBD'),
(6, 2267001, 'GK'),
(7, 2267002, 'GK'),
(8, 2267003, 'GK'),
(9, 2267004, 'GK'),
(10, 2267003, 'AL');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mhs_ambil_mk`
--
ALTER TABLE `mhs_ambil_mk`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mhs_ambil_mk`
--
ALTER TABLE `mhs_ambil_mk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
