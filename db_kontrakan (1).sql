-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 06, 2024 at 04:36 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_kontrakan`
--

-- --------------------------------------------------------

--
-- Table structure for table `kritik_saran`
--

CREATE TABLE `kritik_saran` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `pesan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kamar`
--

CREATE TABLE `tbl_kamar` (
  `id_kamar` int(11) NOT NULL,
  `no_kamar` varchar(256) NOT NULL,
  `kode_kamar` varchar(256) NOT NULL,
  `deskripsi` text NOT NULL,
  `fasilitas` text NOT NULL,
  `harga` varchar(256) NOT NULL,
  `foto` text NOT NULL,
  `status` int(11) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_kamar`
--

INSERT INTO `tbl_kamar` (`id_kamar`, `no_kamar`, `kode_kamar`, `deskripsi`, `fasilitas`, `harga`, `foto`, `status`, `date_created`) VALUES
(8, '1', 'A1', 'kamar 1', '[\"AC\",\"Kasur\",\"Lemari\",\"Halaman Beratap\"]', '10000', '[\"Unofficial_JavaScript_logo_2_svg.png\",\"start-button-png.png\"]', 1, 1724781379),
(9, '2', 'A2', 'kw2', '[\"Kasur\",\"Lemari\",\"Halaman Beratap\"]', '20000', '[\"31966835-616646978671627-8368327808673382400-n-7760776e00a2639107f6e5ce5ad6425d.jpg\",\"67278491-619094375165933-7492227512777448989-n-90df2930a675a5983f09f9fb90db0a8f.jpg\"]', 2, 1725357143);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_keluhan`
--

CREATE TABLE `tbl_keluhan` (
  `id_keluhan` int(11) NOT NULL,
  `id_kamar` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `keluhan` text NOT NULL,
  `gambar` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_laporan`
--

CREATE TABLE `tbl_laporan` (
  `id_laporan` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_kamar` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_laporan`
--

INSERT INTO `tbl_laporan` (`id_laporan`, `id_user`, `id_kamar`, `id_transaksi`) VALUES
(10, 18, 8, 1332272896);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_penghuni`
--

CREATE TABLE `tbl_penghuni` (
  `id_penghuni` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `id_kamar` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tgl_pesan` date NOT NULL,
  `checkIn` varchar(256) NOT NULL,
  `checkOut` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_penghuni`
--

INSERT INTO `tbl_penghuni` (`id_penghuni`, `id_transaksi`, `id_kamar`, `id_user`, `tgl_pesan`, `checkIn`, `checkOut`) VALUES
(12, 1332272896, 8, 18, '2024-09-03', '2024-09-03', '2024-10-03');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_riwayat`
--

CREATE TABLE `tbl_riwayat` (
  `id_riwayat` int(11) NOT NULL,
  `id_kamar` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `tgl_sewa` varchar(256) NOT NULL,
  `tgl_habis` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_riwayat`
--

INSERT INTO `tbl_riwayat` (`id_riwayat`, `id_kamar`, `id_user`, `id_transaksi`, `tgl_sewa`, `tgl_habis`) VALUES
(10, 8, 18, 1332272896, '2024-09-03', '2024-10-03');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transaksi`
--

CREATE TABLE `tbl_transaksi` (
  `order_id` char(20) NOT NULL,
  `customer_name` varchar(50) DEFAULT NULL,
  `customer_email` varchar(20) DEFAULT NULL,
  `gross_amount` int(11) DEFAULT NULL,
  `payment_type` varchar(20) DEFAULT NULL,
  `transaction_time` datetime DEFAULT NULL,
  `settlement_time` datetime DEFAULT NULL,
  `bank` varchar(20) DEFAULT NULL,
  `va_numbers` varchar(50) DEFAULT NULL,
  `status_message` text DEFAULT NULL,
  `pdf_url` text DEFAULT NULL,
  `transaction_status` char(20) DEFAULT NULL,
  `status_code` char(3) DEFAULT NULL,
  `transaction_id` varchar(200) DEFAULT NULL,
  `finish_redirect_url` text DEFAULT NULL,
  `payment_code` varchar(50) DEFAULT NULL,
  `id_kamar` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_transaksi`
--

INSERT INTO `tbl_transaksi` (`order_id`, `customer_name`, `customer_email`, `gross_amount`, `payment_type`, `transaction_time`, `settlement_time`, `bank`, `va_numbers`, `status_message`, `pdf_url`, `transaction_status`, `status_code`, `transaction_id`, `finish_redirect_url`, `payment_code`, `id_kamar`, `id_user`) VALUES
('1332272896', 'Arsyadani', 'rahmatika@gmail.com', 10000, 'qris', '2024-09-03 17:19:29', NULL, NULL, NULL, 'Success, transaction is found', NULL, 'settlement', '200', 'ef74c93b-3d25-4a4b-9133-962a87ae6248', 'http://example.com?order_id=1332272896&status_code=200&transaction_status=settlement', NULL, 8, 18);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `image` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(11) NOT NULL,
  `date_created` varchar(128) NOT NULL,
  `no_hp` varchar(256) NOT NULL,
  `alamat` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `nama`, `email`, `image`, `password`, `role_id`, `is_active`, `date_created`, `no_hp`, `alamat`) VALUES
(1, 'admin', 'admin@gmail.com', '1_1721988509.png', '$2y$10$3eL0WMQqgD0K/biy1QblO.yzeddrjpb8XxUHFYzSDot3.oAY12B0K', 1, 1, '2023-07-03 12:30:42', '0811111', 'Jogja'),
(2, 'pemilik', 'pemilik@gmail.com', 'default.jpg', '$2y$10$E/aGomYJYBSG11h3k3qgqepR89oBow5CrPkh2.U5UEffnp8f7bl7C', 1, 1, '2024-07-03 12:30:42', '', ''),
(12, 'user', 'user@gmail.com', '12_1722428884.JPG', '$2y$10$SIQtZcX6TigVzSY0Bs/Toe/00LwiHyh7x9Sk0hvqsDLh4TMhwzJ/e', 2, 1, '', '082323', 'Jogja'),
(13, 'wafianda', 'wafianda@gmail.com', '13_1721988235.png', '$2y$10$pbEJXcX5CHhQVAcHYhir7uFuVzqVG9gOViCKus7Vq5LveEZYDflLa', 2, 1, '2024-07-18 18:42:03', '0823232323', 'Padang'),
(17, 'Bejir', 'tegararsya0117@gmail.com', '17_1724743678.jpg', '$2y$10$trCEepvRM/AwNr3BQ5miAO4BVahan8GbLPupP2Hsn/1hYTpBNGELK', 1, 1, '2024-08-27 14:26:28', '081353677822', 'Desa Curug Kecamatan Tegowanu Kabupaten Grobogan'),
(18, 'Arsyadani', 'rahmatika@gmail.com', 'default.jpg', '$2y$10$1M.d/G1zD139yn5isC.dRuU132C5ANMFhPEsX.FfoVu0wCr85hGSO', 2, 1, '2024-08-28 00:39:00', '081353677822', 'Desa Curug Kecamatan Tegowanu Kabupaten Grobogan'),
(19, 'TEGAR GANTENG', 'tegar2000018243@webmail.uad.ac.id', 'default.jpg', '$2y$10$pPEmym8mH8CYsJjZDtgs6uMpywBnX40F5YIx1I7fPtwNA5h9IjYm2', 2, 1, '2024-09-03 06:56:48', '081353677822', 'Bejir');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kritik_saran`
--
ALTER TABLE `kritik_saran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_kamar`
--
ALTER TABLE `tbl_kamar`
  ADD PRIMARY KEY (`id_kamar`);

--
-- Indexes for table `tbl_keluhan`
--
ALTER TABLE `tbl_keluhan`
  ADD PRIMARY KEY (`id_keluhan`);

--
-- Indexes for table `tbl_laporan`
--
ALTER TABLE `tbl_laporan`
  ADD PRIMARY KEY (`id_laporan`);

--
-- Indexes for table `tbl_penghuni`
--
ALTER TABLE `tbl_penghuni`
  ADD PRIMARY KEY (`id_penghuni`);

--
-- Indexes for table `tbl_riwayat`
--
ALTER TABLE `tbl_riwayat`
  ADD PRIMARY KEY (`id_riwayat`);

--
-- Indexes for table `tbl_transaksi`
--
ALTER TABLE `tbl_transaksi`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kritik_saran`
--
ALTER TABLE `kritik_saran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_kamar`
--
ALTER TABLE `tbl_kamar`
  MODIFY `id_kamar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_keluhan`
--
ALTER TABLE `tbl_keluhan`
  MODIFY `id_keluhan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_laporan`
--
ALTER TABLE `tbl_laporan`
  MODIFY `id_laporan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_penghuni`
--
ALTER TABLE `tbl_penghuni`
  MODIFY `id_penghuni` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_riwayat`
--
ALTER TABLE `tbl_riwayat`
  MODIFY `id_riwayat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
