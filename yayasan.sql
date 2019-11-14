-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 14, 2019 at 08:41 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `yayasan`
--

-- --------------------------------------------------------

--
-- Table structure for table `riw_pelaporan`
--

CREATE TABLE `riw_pelaporan` (
  `kode` varchar(6) NOT NULL,
  `id` int(11) NOT NULL,
  `pelapor` varchar(60) NOT NULL,
  `nominal_laporan` int(11) NOT NULL,
  `lampiran_laporan` longtext NOT NULL,
  `saksi` varchar(60) NOT NULL,
  `waktu_pelaporan` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `riw_pengambilan`
--

CREATE TABLE `riw_pengambilan` (
  `kode` varchar(6) NOT NULL,
  `noid` int(11) NOT NULL,
  `nama_pengaju` varchar(60) NOT NULL,
  `nominal_pengajuan` int(11) NOT NULL,
  `pengambil_dana` varchar(60) NOT NULL,
  `nominal_pengambilan` int(11) NOT NULL,
  `kasir` varchar(30) NOT NULL,
  `waktu_pengambil` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `riw_persetujuan`
--

CREATE TABLE `riw_persetujuan` (
  `kode` varchar(6) NOT NULL,
  `noid` int(11) NOT NULL,
  `nama_pengaju` varchar(60) NOT NULL,
  `nominal_pengaju` int(11) NOT NULL,
  `administrator` varchar(60) NOT NULL,
  `waktu_persetujuan` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `riw_tolak`
--

CREATE TABLE `riw_tolak` (
  `kode` varchar(6) NOT NULL,
  `noid` int(11) NOT NULL,
  `nama_pengaju` varchar(60) NOT NULL,
  `nominal_pengaju` int(11) NOT NULL,
  `administrator` varchar(60) NOT NULL,
  `waktu_tolak` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `sembunyikan` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `submission`
--

CREATE TABLE `submission` (
  `kode` varchar(9) NOT NULL,
  `noid` varchar(4) NOT NULL,
  `nama_pengajuan` varchar(60) NOT NULL,
  `waktu_pengajuan` varchar(10) NOT NULL,
  `nominal_pengajuan` bigint(20) NOT NULL,
  `lampiran` varchar(200) NOT NULL,
  `keterangan` longtext NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `no_id` int(11) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `akses` varchar(2) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `no_hp` varchar(14) NOT NULL,
  `email` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`no_id`, `username`, `password`, `akses`, `nama`, `no_hp`, `email`) VALUES
(3, 'admin', '21232f297a57a5a743894a0e4a801fc3', '1', 'Administrator', '00000', 'test@test'),
(4, 'approver', '670b14728ad9902aecba32e22fa4f6bd', '2', 'Penyetuju', '000000', 'test@test'),
(5, 'kasir', '670b14728ad9902aecba32e22fa4f6bd', '3', 'Kasir (Pemegang Uang(', '000000', 'kasir@kasir'),
(6, 'user1', '670b14728ad9902aecba32e22fa4f6bd', '4', 'User satu', '000000', 'user1@user1'),
(7, 'user2', '670b14728ad9902aecba32e22fa4f6bd', '4', 'User Dua', '000000', 'user2@user2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `riw_pelaporan`
--
ALTER TABLE `riw_pelaporan`
  ADD PRIMARY KEY (`kode`);

--
-- Indexes for table `riw_pengambilan`
--
ALTER TABLE `riw_pengambilan`
  ADD PRIMARY KEY (`kode`),
  ADD KEY `no_id` (`noid`);

--
-- Indexes for table `riw_persetujuan`
--
ALTER TABLE `riw_persetujuan`
  ADD PRIMARY KEY (`kode`),
  ADD KEY `no_id` (`noid`);

--
-- Indexes for table `riw_tolak`
--
ALTER TABLE `riw_tolak`
  ADD PRIMARY KEY (`kode`),
  ADD KEY `no_id` (`noid`);

--
-- Indexes for table `submission`
--
ALTER TABLE `submission`
  ADD PRIMARY KEY (`kode`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`no_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `no_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
