-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 13, 2025 at 01:11 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12
-- DATABASE NAME: bengkel_wahyu_putra

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bengkel_wahyu_putra`
--

-- --------------------------------------------------------

--
-- Table structure for table `negosiasi_penawaran`
--

CREATE TABLE `negosiasi_penawaran` (
  `id_negosiasi` int(11) NOT NULL,
  `id_penawaran` int(11) NOT NULL,
  `waktu_negosiasi` datetime NOT NULL DEFAULT current_timestamp(),
  `jenis_negosiasi` enum('Harga','Estimasi','Harga & Estimasi','Lainnya') NOT NULL,
  `harga_tawaran` int(11) DEFAULT NULL,
  `estimasi_tawaran` varchar(50) DEFAULT NULL,
  `catatan` text DEFAULT NULL,
  `status_negosiasi` enum('Menunggu','Diterbitkan Penawaran Baru') NOT NULL DEFAULT 'Menunggu'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `negosiasi_penawaran`
--

INSERT INTO `negosiasi_penawaran` (`id_negosiasi`, `id_penawaran`, `waktu_negosiasi`, `jenis_negosiasi`, `harga_tawaran`, `estimasi_tawaran`, `catatan`, `status_negosiasi`) VALUES
(1, 2, '2025-05-21 20:16:22', 'Lainnya', NULL, NULL, 'Jangan sampai terlalu lama hingga 6 bulan', 'Diterbitkan Penawaran Baru'),
(2, 8, '2025-06-10 07:39:58', 'Harga', 10000000, NULL, 'kalau bisa harganya direndahkan', 'Diterbitkan Penawaran Baru');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_pelanggan` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `tgl_daftar` datetime NOT NULL DEFAULT current_timestamp(),
  `no_telp` char(12) NOT NULL,
  `jenis_akun` enum('Pribadi','Perusahaan') DEFAULT NULL,
  `nama_perusahaan` varchar(500) DEFAULT NULL,
  `role` enum('Admin','User') NOT NULL DEFAULT 'User'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `password`, `nama_pelanggan`, `email`, `tgl_daftar`, `no_telp`, `jenis_akun`, `nama_perusahaan`, `role`) VALUES
(1, '$2y$10$Md82Ex9bBZDhofzBkItCPOPr6clHR6i7Bu6SwZRPX06EsCJaK18U2', 'Administrator', 'admin@gmail.com', '2025-02-03 11:04:56', '081234567890', 'Pribadi', NULL, 'Admin'),
(2, '$2y$10$BL7yEN8QoLjl2zRcNizyi.pxWoiPudZP/6pxWvuLorD6pvoOoyr02', 'Budi Santosoo', 'budi1@gmail.com', '2025-01-14 14:52:27', '081234567890', 'Pribadi', NULL, 'User'),
(3, '$2y$10$RfzpfnsIFP9x22ATQ3ycSOfmRiAO.IOuNAbaPGEQaCKaEbqpYc5BG', 'Muhammad Naufal Rafa Al As\'ad', 'falrafa@gmail.com', '2025-01-08 10:13:37', '081234567890', 'Pribadi', NULL, 'User'),
(4, '$2y$10$RfXeERISlbh/VF36WtIL5eAYbkn6HDGTehwdixLOWXa6qG9.TYE.O', 'Mu\'anam', 'muanamanam21@gmail.com', '2025-02-11 09:48:00', '081234567891', 'Pribadi', NULL, 'User'),
(5, '$2y$10$0ZmQXomMvKqbYUOKXmlFVOnzgezl/9SEGjtX4aaSyd56sBsnJ/d0O', 'Dafa', 'dafafahri@gmail.com', '2025-01-14 14:58:29', '081234567890', 'Perusahaan', 'PT. Bahagia', 'User'),
(6, '$2y$10$nQJlccGkeE17G3BDGV0ROefu9nRW9LtV9.A/h0hny0gWEM2uHmMXi', 'Naufal Rafa', 'rafaasad9@gmail.com', '2025-04-08 20:01:52', '081201192', 'Pribadi', NULL, 'User'),
(7, '$2y$10$yW6hhmn5A1SDLvoTK5kwM.ktZXerUNhTELSxCW8Ubu3Gir/7ZgIcW', 'Gibran Rakabuming Raka', 'fufufafa@gmail.com', '2025-04-10 20:05:28', '089125547981', 'Perusahaan', 'PT. Indonesia', 'User'),
(9, '$2y$10$x0MTrtvS6XuW8OdnsSz0neFFk6jgrFD4IDHG5GJCxPfPITKJx0ECO', 'Nabil Aswangga Hugobama', 'Bamaground@gmail.com', '2025-05-19 09:22:00', '08973440335', 'Pribadi', NULL, 'User'),
(11, '$2y$10$Lw.tWVJ4F1aRC73r/rQs5eul8ky2qwrhZpFBVwTYqBHZ55yJC5iEe', 'Muhamad Dafa Al Fachri', 'dafafachri17@gmail.com', '2025-05-30 13:33:34', '089012229988', 'Perusahaan', 'PT. Sejahtera', 'User'),
(12, '$2y$10$/m7S4kgdVuNgHJpMgLpX3O6Im/IJtvovHvk.RKmTGHLZR7nELYzPi', 'Muhamad Dafa Al Fachri', 'dafa@gmail.com', '2025-06-10 07:36:07', '081234567890', 'Pribadi', '', 'User');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `no_pesanan` int(11) NOT NULL,
  `metode_pembayaran` enum('BCA','Mandiri') NOT NULL,
  `total_bayar` int(11) NOT NULL,
  `tgl_bayar` datetime NOT NULL DEFAULT current_timestamp(),
  `bukti_bayar` varchar(255) NOT NULL,
  `status_bayar` enum('Sedang Dikonfirmasi','Lunas') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `no_pesanan`, `metode_pembayaran`, `total_bayar`, `tgl_bayar`, `bukti_bayar`, `status_bayar`) VALUES
(1, 11, 'BCA', 15000000, '2025-05-29 19:58:22', 'bukti_11_683859eecc631.png', 'Lunas'),
(2, 13, 'BCA', 10000000, '2025-05-29 20:10:19', 'bukti_13_68385cbba7aab.jpg', 'Lunas'),
(3, 7, 'Mandiri', 3400000, '2025-05-30 21:19:08', 'bukti_7_6839be5caaa60.png', 'Lunas'),
(4, 3, 'Mandiri', 15050000, '2025-06-02 17:21:17', 'bukti_3_683d7b1dda6ec.png', 'Lunas'),
(5, 15, 'Mandiri', 10000000, '2025-06-10 07:44:23', 'bukti_15_68477fe7510a9.jpg', 'Lunas');

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan`
--

CREATE TABLE `pemesanan` (
  `no_pesanan` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `waktu_pemesanan` datetime NOT NULL DEFAULT current_timestamp(),
  `nama_jalan` varchar(100) NOT NULL,
  `kecamatan` varchar(50) NOT NULL,
  `kabupaten_kota` varchar(50) NOT NULL,
  `provinsi` varchar(30) NOT NULL,
  `kode_pos` char(5) NOT NULL,
  `detail` varchar(50) DEFAULT NULL,
  `id_service` int(11) NOT NULL,
  `estimasi` date DEFAULT NULL,
  `status_pesanan` enum('Menunggu Penawaran','Penawaran Diterbitkan','Negosiasi Penawaran','Dalam Proses','Menunggu Pembayaran','Konfirmasi Pembayaran','Selesai') NOT NULL DEFAULT 'Menunggu Penawaran'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pemesanan`
--

INSERT INTO `pemesanan` (`no_pesanan`, `id_pelanggan`, `waktu_pemesanan`, `nama_jalan`, `kecamatan`, `kabupaten_kota`, `provinsi`, `kode_pos`, `detail`, `id_service`, `estimasi`, `status_pesanan`) VALUES
(1, 7, '2025-03-14 00:00:00', 'Jl. S. Parman Waru', 'Waru', 'Sidoarjo', 'Jawa Timur', '61256', 'Depan warung biru', 1, NULL, 'Penawaran Diterbitkan'),
(2, 2, '2025-03-14 00:01:00', 'Perumahan', 'Waru', 'Sidoarjo', 'Jawa Timur', '61256', 'Depan warung biru', 1, NULL, 'Menunggu Penawaran'),
(3, 3, '2025-03-16 06:00:00', 'Jl. Jenggolo', 'Sidoarjo', 'Sidoarjo', 'Jawa Timur', '61256', NULL, 1, '2025-06-11', 'Selesai'),
(4, 4, '2025-03-16 07:00:00', 'Kavling Mentari III', 'Waru', 'Sidoarjo', 'Jawa Timur', '61256', 'Sebelah toko sembako', 2, NULL, 'Menunggu Penawaran'),
(5, 5, '2025-03-16 08:00:00', 'Jl. Berbek III A no. 43', 'Waru', 'Sidoarjo', 'Jawa Timur', '61256', 'Rumah tingkat', 2, NULL, 'Menunggu Penawaran'),
(6, 4, '2025-03-18 16:43:17', 'Jl. Lingkar Timur', 'Buduran', 'Sidoarjo', 'Jawa Timur', '61252', NULL, 1, NULL, 'Menunggu Penawaran'),
(7, 3, '2025-04-02 20:32:29', 'Jalan abc', 'b', 'c', 'd', '12345', 'e', 1, '2025-06-11', 'Menunggu Pembayaran'),
(8, 3, '2025-04-02 20:35:32', 'Jalan Layang', 'Layang', 'c', 'd', '12345', 'e', 1, NULL, 'Penawaran Diterbitkan'),
(9, 6, '2025-04-08 20:03:44', 'Jl. sidoarjo', 'Waru', 'Sidoarjo', 'Jawa Timur', '61256', 'Depan tikungan', 1, NULL, 'Menunggu Penawaran'),
(10, 7, '2025-04-17 11:14:39', 'Jl. sidoarjo', 'Waru', 'Sidoarjo', 'Jawa Timur', '12345', 'Depan tikungan', 2, NULL, 'Menunggu Penawaran'),
(11, 3, '2025-05-03 14:26:43', 'Perumahan Waru', 'Waru', 'Sidoarjo', 'Jawa Timur', '61251', 'Blok A6 No. 6', 2, '2025-06-11', 'Selesai'),
(12, 2, '2025-05-13 20:23:54', 'Jalan Pecantingan', 'Sidoarjo', 'Sidoarjo', 'Jawa Timur', '12345', 'Tempat di sekolah', 1, NULL, 'Penawaran Diterbitkan'),
(13, 3, '2025-05-29 20:01:52', 'Perumahan Grand Indah Land Jaya Regency Mansion Graha', 'Waru', 'Sidoarjo', 'Jawa Timur', '61215', '-', 2, NULL, 'Menunggu Penawaran'),
(14, 11, '2025-05-30 14:05:40', 'Juanda Mansion E/21', 'Sedati', 'Sidoarjo', 'Jawa Timur', '61253', 'Sedati Pedalaman', 2, NULL, 'Menunggu Penawaran'),
(15, 12, '2025-06-10 07:38:06', 'Perumahan Grand Indah Land Jaya Regency Mansion Graha', 'Waru', 'Sidoarjo', 'Jawa Timur', '61215', 'Depan warung biru', 2, '2025-06-11', 'Selesai'),
(16, 3, '2025-06-11 09:42:46', 'TES JALAN', 'TES KECAMATAN', 'TES KOTA', 'JAWA', '12345', 'HALOOO', 1, '2025-07-11', 'Dalam Proses'),
(17, 7, '2025-06-12 06:56:54', 'Jl. S. Parman Waru', 'Waru', 'Sidoarjo', 'Jawa Timur', '61215', 'Blok A6 No. 6', 2, NULL, 'Menunggu Penawaran');

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan_item`
--

CREATE TABLE `pemesanan_item` (
  `id_item` int(11) NOT NULL,
  `no_pesanan` int(11) NOT NULL,
  `nama_item` varchar(30) NOT NULL,
  `desain_gambar` varchar(255) NOT NULL,
  `material` varchar(20) NOT NULL,
  `jumlah_item` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pemesanan_item`
--

INSERT INTO `pemesanan_item` (`id_item`, `no_pesanan`, `nama_item`, `desain_gambar`, `material`, `jumlah_item`) VALUES
(1, 1, 'Potong besi', '1.jpg', 'Besi/Aluminium', 2),
(2, 2, 'Sparepart mesin moulding', '2.jpg', 'Logam', 1),
(3, 3, 'Logo Galon', '3.jpg', 'Nonlogam', 1),
(4, 4, 'Roda gigi', '4.jpg', 'Besi', 4),
(5, 5, 'Cetakan sapu', '5.jpg', 'Besi/Aluminium', 3),
(6, 6, 'Bubut Besi', '6.png', 'Besi', 1),
(7, 7, 'diamond', '7.pdf', 'Alam', 5),
(8, 8, 'Bubut Besi', '8.png', 'Besi', 1),
(9, 9, 'miling', '9.png', 'Besi', 3),
(10, 10, 'Potong EDM', '10.pdf', 'Aluminium', 1),
(11, 11, 'Testing', '11.jpg', 'Logam', 2),
(12, 12, 'Logo ALQADIRI', '12.jpg', 'Logam', 2),
(13, 13, 'Matras 30mm', '13.pdf', 'Aluminium', 1),
(14, 14, 'Embos Alfamaret', '14.jpg', 'Logam', 2),
(15, 15, 'Sparepart Mesin', '15.pdf', 'Besi', 5),
(16, 16, 'TES PENAWARAN', '16.jpg', 'TES MATERIAL', 1),
(17, 17, '<img src=\"https://www.google.c', '17.jpg', '<img src=\"https://ww', 3);

-- --------------------------------------------------------

--
-- Table structure for table `penawaran`
--

CREATE TABLE `penawaran` (
  `id_penawaran` int(11) NOT NULL,
  `no_pesanan` int(11) NOT NULL,
  `surat_penawaran` varchar(500) NOT NULL,
  `harga_penawaran` int(11) NOT NULL,
  `estimasi_penawaran` date NOT NULL,
  `tgl_penawaran` date NOT NULL DEFAULT curdate(),
  `waktu_penawaran` time NOT NULL DEFAULT curtime(),
  `status_penawaran` enum('Diterbitkan','Negosiasi','Disetujui','Terbit Baru') NOT NULL DEFAULT 'Diterbitkan'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penawaran`
--

INSERT INTO `penawaran` (`id_penawaran`, `no_pesanan`, `surat_penawaran`, `harga_penawaran`, `estimasi_penawaran`, `tgl_penawaran`, `waktu_penawaran`, `status_penawaran`) VALUES
(1, 3, 'spwp_1748600650.jpg', 15050000, '2025-06-10', '2025-05-30', '20:10:31', 'Disetujui'),
(2, 7, 'spwp_1748080432.pdf', 5000000, '2025-06-10', '2025-05-30', '20:10:31', 'Terbit Baru'),
(3, 11, '1747623324.jpg', 15000000, '2025-06-10', '2025-05-30', '20:10:31', 'Disetujui'),
(4, 12, 'spwp_1748080192.pdf', 22000000, '2025-06-10', '2025-05-30', '20:10:31', 'Diterbitkan'),
(5, 13, '1748523756.jpg', 10000000, '2025-06-10', '2025-06-10', '20:02:36', 'Disetujui'),
(7, 7, 'spwp_1748612502.pdf', 3400000, '2025-06-10', '2025-06-10', '20:41:42', 'Disetujui'),
(8, 15, 'spwp_1749515947.jpg', 12000000, '2025-06-10', '2025-06-10', '07:39:07', 'Terbit Baru'),
(9, 15, 'spwp_1749516033.jpg', 10000000, '2025-06-10', '2025-06-10', '07:40:33', 'Disetujui'),
(10, 8, 'spwp_1749523557.pdf', 30000000, '2025-06-10', '2025-06-10', '09:45:57', 'Diterbitkan'),
(11, 1, 'spwp_1749564877.jpg', 10000000, '2025-06-17', '2025-06-10', '21:14:37', 'Diterbitkan'),
(12, 16, 'spwp_1749610368.jpg', 36000000, '2025-07-11', '2025-06-11', '09:52:48', 'Disetujui');

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `id_service` int(11) NOT NULL,
  `nama_service` varchar(50) NOT NULL,
  `gambar_jasa` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`id_service`, `nama_service`, `gambar_jasa`) VALUES
(1, 'Perbaikan', 'product-2.jpg'),
(2, 'Produksi Baru', 'product-matras-2.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `negosiasi_penawaran`
--
ALTER TABLE `negosiasi_penawaran`
  ADD PRIMARY KEY (`id_negosiasi`),
  ADD KEY `id_penawaran` (`id_penawaran`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`) USING BTREE,
  ADD KEY `fk_pembayaran_relation_pemesanan` (`no_pesanan`);

--
-- Indexes for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`no_pesanan`),
  ADD KEY `fk_pemesanan_relation_service` (`id_service`),
  ADD KEY `fk_pemesanan_relation_pelanggan` (`id_pelanggan`);

--
-- Indexes for table `pemesanan_item`
--
ALTER TABLE `pemesanan_item`
  ADD PRIMARY KEY (`id_item`),
  ADD KEY `fk_pemesanan_item_relation_pemesanan` (`no_pesanan`);

--
-- Indexes for table `penawaran`
--
ALTER TABLE `penawaran`
  ADD PRIMARY KEY (`id_penawaran`),
  ADD KEY `fk_penawaran_relation_pemesanan` (`no_pesanan`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id_service`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `negosiasi_penawaran`
--
ALTER TABLE `negosiasi_penawaran`
  MODIFY `id_negosiasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `no_pesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `pemesanan_item`
--
ALTER TABLE `pemesanan_item`
  MODIFY `id_item` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `penawaran`
--
ALTER TABLE `penawaran`
  MODIFY `id_penawaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `id_service` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `negosiasi_penawaran`
--
ALTER TABLE `negosiasi_penawaran`
  ADD CONSTRAINT `negosiasi_penawaran_ibfk_1` FOREIGN KEY (`id_penawaran`) REFERENCES `penawaran` (`id_penawaran`);

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `fk_pembayaran_relation_pemesanan` FOREIGN KEY (`no_pesanan`) REFERENCES `pemesanan` (`no_pesanan`) ON UPDATE CASCADE;

--
-- Constraints for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD CONSTRAINT `fk_pemesanan_relation_pelanggan` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pemesanan_relation_service` FOREIGN KEY (`id_service`) REFERENCES `service` (`id_service`);

--
-- Constraints for table `pemesanan_item`
--
ALTER TABLE `pemesanan_item`
  ADD CONSTRAINT `fk_pemesanan_item_relation_pemesanan` FOREIGN KEY (`no_pesanan`) REFERENCES `pemesanan` (`no_pesanan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `penawaran`
--
ALTER TABLE `penawaran`
  ADD CONSTRAINT `fk_penawaran_relation_pemesanan` FOREIGN KEY (`no_pesanan`) REFERENCES `pemesanan` (`no_pesanan`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
