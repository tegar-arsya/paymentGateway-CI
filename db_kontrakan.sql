-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Waktu pembuatan: 12 Agu 2024 pada 08.12
-- Versi server: 8.0.35
-- Versi PHP: 8.2.20

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
-- Struktur dari tabel `kritik_saran`
--

CREATE TABLE `kritik_saran` (
  `id` int NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `pesan` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kritik_saran`
--

INSERT INTO `kritik_saran` (`id`, `nama`, `email`, `judul`, `pesan`) VALUES
(2, 'Hanif', 'Hanif@gmail.com', 'Saran', 'Tambah Jumlah Kamar');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_kamar`
--

CREATE TABLE `tbl_kamar` (
  `id_kamar` int NOT NULL,
  `no_kamar` varchar(256) COLLATE utf8mb4_general_ci NOT NULL,
  `kode_kamar` varchar(256) COLLATE utf8mb4_general_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_general_ci NOT NULL,
  `harga` varchar(256) COLLATE utf8mb4_general_ci NOT NULL,
  `foto` text COLLATE utf8mb4_general_ci NOT NULL,
  `status` int NOT NULL,
  `date_created` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_kamar`
--

INSERT INTO `tbl_kamar` (`id_kamar`, `no_kamar`, `kode_kamar`, `deskripsi`, `harga`, `foto`, `status`, `date_created`) VALUES
(3, '12', 'AB12', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '750000', '[\"8k-l_wallpaper.jpg\"]', 1, 1723030336),
(5, '2', 'AB13', 'Kamar Bersih dan WC dalam', '700000', '[\"8k-stiker.jpg\"]', 1, 1723030325),
(6, '5', 'A11', 'WC dalam', '650000', '[\"8k-code.jpg\",\"8k-hello-word.jpg\",\"8k-l_wallpaper.jpg\",\"8k-stiker.jpg\"]', 1, 1723028351),
(7, '3', 'AB14', 'Kamar Mandi Dalam, ruangan lebih luas', '660000', '[\"pexels-michal.jpg\",\"pexels-pixabay-531321.jpg\"]', 0, 1723145893);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_keluhan`
--

CREATE TABLE `tbl_keluhan` (
  `id_keluhan` int NOT NULL,
  `id_kamar` int NOT NULL,
  `id_user` int NOT NULL,
  `keluhan` text COLLATE utf8mb4_general_ci NOT NULL,
  `gambar` text COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_laporan`
--

CREATE TABLE `tbl_laporan` (
  `id_laporan` int NOT NULL,
  `id_user` int NOT NULL,
  `id_kamar` int NOT NULL,
  `id_transaksi` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_laporan`
--

INSERT INTO `tbl_laporan` (`id_laporan`, `id_user`, `id_kamar`, `id_transaksi`) VALUES
(2, 13, 3, 2032564896),
(3, 15, 5, 543795322),
(4, 12, 6, 1058479270);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_penghuni`
--

CREATE TABLE `tbl_penghuni` (
  `id_penghuni` int NOT NULL,
  `id_transaksi` int NOT NULL,
  `id_kamar` int NOT NULL,
  `id_user` int NOT NULL,
  `tgl_pesan` date NOT NULL,
  `checkIn` varchar(256) COLLATE utf8mb4_general_ci NOT NULL,
  `checkOut` varchar(256) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_penghuni`
--

INSERT INTO `tbl_penghuni` (`id_penghuni`, `id_transaksi`, `id_kamar`, `id_user`, `tgl_pesan`, `checkIn`, `checkOut`) VALUES
(4, 2032564896, 3, 13, '2024-07-30', '2024-08-05', '2024-10-05'),
(6, 1058479270, 6, 12, '2024-07-31', '2024-08-01', '2024-09-01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_riwayat`
--

CREATE TABLE `tbl_riwayat` (
  `id_riwayat` int NOT NULL,
  `id_kamar` int NOT NULL,
  `id_user` int NOT NULL,
  `id_transaksi` int NOT NULL,
  `tgl_sewa` varchar(256) COLLATE utf8mb4_general_ci NOT NULL,
  `tgl_habis` varchar(256) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_riwayat`
--

INSERT INTO `tbl_riwayat` (`id_riwayat`, `id_kamar`, `id_user`, `id_transaksi`, `tgl_sewa`, `tgl_habis`) VALUES
(2, 3, 13, 2032564896, '2024-08-05', '2024-10-05'),
(3, 5, 15, 543795322, '2024-08-05', '2025-02-05'),
(4, 6, 12, 1058479270, '2024-08-01', '2024-08-25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_transaksi`
--

CREATE TABLE `tbl_transaksi` (
  `order_id` char(20) COLLATE utf8mb4_general_ci NOT NULL,
  `customer_name` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `customer_email` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `gross_amount` int DEFAULT NULL,
  `payment_type` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `transaction_time` datetime DEFAULT NULL,
  `settlement_time` datetime DEFAULT NULL,
  `bank` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `va_numbers` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status_message` text COLLATE utf8mb4_general_ci,
  `pdf_url` text COLLATE utf8mb4_general_ci,
  `transaction_status` char(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status_code` char(3) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `transaction_id` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `finish_redirect_url` text COLLATE utf8mb4_general_ci,
  `payment_code` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id_kamar` int NOT NULL,
  `id_user` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_transaksi`
--

INSERT INTO `tbl_transaksi` (`order_id`, `customer_name`, `customer_email`, `gross_amount`, `payment_type`, `transaction_time`, `settlement_time`, `bank`, `va_numbers`, `status_message`, `pdf_url`, `transaction_status`, `status_code`, `transaction_id`, `finish_redirect_url`, `payment_code`, `id_kamar`, `id_user`) VALUES
('1058479270', 'user', 'user@gmail.com', 650000, 'bank_transfer', '2024-07-31 19:35:24', NULL, 'bca', '34870321099', 'Success, transaction is found', 'https://app.sandbox.midtrans.com/snap/v1/transactions/478a7920-e549-4971-b749-89ee9edcdd65/pdf', 'settlement', '200', NULL, 'http://example.com?order_id=1058479270&status_code=200&transaction_status=settlement', NULL, 6, 12),
('2032564896', 'wafianda', 'wafianda@gmail.com', 1500000, 'bank_transfer', '2024-07-30 18:33:47', NULL, 'bca', '34870625474', 'Success, transaction is found', 'https://app.sandbox.midtrans.com/snap/v1/transactions/280a1ba9-87fd-4e4a-b108-74e384758470/pdf', 'settlement', '200', NULL, 'http://example.com?order_id=2032564896&status_code=200&transaction_status=settlement', NULL, 3, 13),
('543795322', 'putri', 'putri@gmail.com', 4200000, 'bank_transfer', '2024-07-30 18:51:44', NULL, 'bri', '348708179247802975', 'Success, transaction is found', 'https://app.sandbox.midtrans.com/snap/v1/transactions/0a44c385-90fa-4008-80d9-0eb5e1859636/pdf', 'settlement', '200', NULL, 'http://example.com?order_id=543795322&status_code=200&transaction_status=settlement', NULL, 5, 15);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` int NOT NULL,
  `nama` varchar(128) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(128) COLLATE utf8mb4_general_ci NOT NULL,
  `image` varchar(128) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(128) COLLATE utf8mb4_general_ci NOT NULL,
  `role_id` int NOT NULL,
  `is_active` int NOT NULL,
  `date_created` varchar(128) COLLATE utf8mb4_general_ci NOT NULL,
  `no_hp` varchar(256) COLLATE utf8mb4_general_ci NOT NULL,
  `alamat` varchar(256) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `nama`, `email`, `image`, `password`, `role_id`, `is_active`, `date_created`, `no_hp`, `alamat`) VALUES
(1, 'admin', 'admin@gmail.com', '1_1721988509.png', '$2y$10$3eL0WMQqgD0K/biy1QblO.yzeddrjpb8XxUHFYzSDot3.oAY12B0K', 1, 1, '2023-07-03 12:30:42', '0811111', 'Jogja'),
(2, 'pemilik', 'pemilik@gmail.com', 'default.jpg', '$2y$10$E/aGomYJYBSG11h3k3qgqepR89oBow5CrPkh2.U5UEffnp8f7bl7C', 1, 1, '2024-07-03 12:30:42', '', ''),
(12, 'user', 'user@gmail.com', '12_1722428884.JPG', '$2y$10$SIQtZcX6TigVzSY0Bs/Toe/00LwiHyh7x9Sk0hvqsDLh4TMhwzJ/e', 2, 1, '', '082323', 'Jogja'),
(13, 'wafianda', 'wafianda@gmail.com', '13_1721988235.png', '$2y$10$pbEJXcX5CHhQVAcHYhir7uFuVzqVG9gOViCKus7Vq5LveEZYDflLa', 2, 1, '2024-07-18 18:42:03', '0823232323', 'Padang');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `kritik_saran`
--
ALTER TABLE `kritik_saran`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_kamar`
--
ALTER TABLE `tbl_kamar`
  ADD PRIMARY KEY (`id_kamar`);

--
-- Indeks untuk tabel `tbl_keluhan`
--
ALTER TABLE `tbl_keluhan`
  ADD PRIMARY KEY (`id_keluhan`);

--
-- Indeks untuk tabel `tbl_laporan`
--
ALTER TABLE `tbl_laporan`
  ADD PRIMARY KEY (`id_laporan`);

--
-- Indeks untuk tabel `tbl_penghuni`
--
ALTER TABLE `tbl_penghuni`
  ADD PRIMARY KEY (`id_penghuni`);

--
-- Indeks untuk tabel `tbl_riwayat`
--
ALTER TABLE `tbl_riwayat`
  ADD PRIMARY KEY (`id_riwayat`);

--
-- Indeks untuk tabel `tbl_transaksi`
--
ALTER TABLE `tbl_transaksi`
  ADD PRIMARY KEY (`order_id`);

--
-- Indeks untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `kritik_saran`
--
ALTER TABLE `kritik_saran`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tbl_kamar`
--
ALTER TABLE `tbl_kamar`
  MODIFY `id_kamar` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tbl_keluhan`
--
ALTER TABLE `tbl_keluhan`
  MODIFY `id_keluhan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tbl_laporan`
--
ALTER TABLE `tbl_laporan`
  MODIFY `id_laporan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tbl_penghuni`
--
ALTER TABLE `tbl_penghuni`
  MODIFY `id_penghuni` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tbl_riwayat`
--
ALTER TABLE `tbl_riwayat`
  MODIFY `id_riwayat` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
