-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 13, 2025 at 11:28 AM
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
-- Database: `bengkel_wahyu_putra`
--

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
  `role` enum('Admin','User') NOT NULL DEFAULT 'User'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `password`, `nama_pelanggan`, `email`, `tgl_daftar`, `no_telp`, `jenis_akun`, `role`) VALUES
(1, '$2y$10$Md82Ex9bBZDhofzBkItCPOPr6clHR6i7Bu6SwZRPX06EsCJaK18U2', 'Administrator', 'admin@gmail.com', '2025-02-03 11:04:56', '081234567890', 'Pribadi', 'Admin'),
(2, '$2y$10$BL7yEN8QoLjl2zRcNizyi.pxWoiPudZP/6pxWvuLorD6pvoOoyr02', 'Budi Santosoo', 'budi1@gmail.com', '2025-01-14 14:52:27', '081234567890', 'Pribadi', 'User'),
(3, '$2y$10$RfzpfnsIFP9x22ATQ3ycSOfmRiAO.IOuNAbaPGEQaCKaEbqpYc5BG', 'Muhammad Naufal Rafa Al As\'ad', 'falrafa@gmail.com', '2025-01-08 10:13:37', '081234567890', 'Pribadi', 'User'),
(4, '$2y$10$RfXeERISlbh/VF36WtIL5eAYbkn6HDGTehwdixLOWXa6qG9.TYE.O', 'Mu\'anam', 'muanamanam21@gmail.com', '2025-02-11 09:48:00', '081234567891', 'Pribadi', 'User'),
(5, '$2y$10$0ZmQXomMvKqbYUOKXmlFVOnzgezl/9SEGjtX4aaSyd56sBsnJ/d0O', 'Dafa', 'dafafahri@gmail.com', '2025-01-14 14:58:29', '081234567890', 'Perusahaan', 'User'),
(6, '$2y$10$6gJc5vUD4AcfXBH6I5otauLUGNSBHbF7RQIZiz00ykOJr7uvVvTdi', 'Naufal Rafa', 'rafaasad9@gmail.com', '2025-04-08 20:01:52', '081201192', 'Perusahaan', 'User'),
(7, '$2y$10$yW6hhmn5A1SDLvoTK5kwM.ktZXerUNhTELSxCW8Ubu3Gir/7ZgIcW', 'Gibran Rakabuming Raka', 'fufufafa@gmail.com', '2025-04-10 20:05:28', '089125547981', 'Perusahaan', 'User'),
(9, '$2y$10$SXmGBosmnCjTqK3j6HiozOjvTWNop3nhFCkrY0v99MnMNuewd00/O', 'Akun Percobaan', 'percobaan@gmail.com', '2025-05-02 16:24:27', '082334455667', 'Pribadi', 'User');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `kode_pembayaran` int(11) NOT NULL,
  `no_pesanan` int(11) NOT NULL,
  `metode_pembayaran` enum('Cash','Transfer') NOT NULL,
  `total_bayar` int(11) NOT NULL,
  `tgl_bayar` date NOT NULL,
  `bukti_bayar` varchar(255) NOT NULL,
  `status_bayar` enum('Belum Lunas','Lunas') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `status_pesanan` enum('Menunggu Penawaran','Penawaran Diterbitkan','Dalam Proses','Selesai') NOT NULL DEFAULT 'Menunggu Penawaran'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pemesanan`
--

INSERT INTO `pemesanan` (`no_pesanan`, `id_pelanggan`, `waktu_pemesanan`, `nama_jalan`, `kecamatan`, `kabupaten_kota`, `provinsi`, `kode_pos`, `detail`, `id_service`, `status_pesanan`) VALUES
(1, 7, '2025-03-18 00:00:00', 'Jl. S. Parman Waru', 'Waru', 'Sidoarjo', 'Jawa Timur', '61256', 'Depan warung biru', 1, 'Dalam Proses'),
(2, 2, '2025-03-16 00:00:00', 'Perumahan', 'Waru', 'Sidoarjo', 'Jawa Timur', '61256', 'Depan warung biru', 1, 'Menunggu Penawaran'),
(3, 3, '2025-03-16 00:00:00', 'Jl. Jenggolo', 'Sidoarjo', 'Sidoarjo', 'Jawa Timur', '61256', NULL, 1, 'Penawaran Diterbitkan'),
(4, 4, '2025-03-16 00:00:00', 'Kavling Mentari III', 'Waru', 'Sidoarjo', 'Jawa Timur', '61256', 'Sebelah toko sembako', 2, 'Dalam Proses'),
(5, 5, '2025-03-16 00:00:00', 'Jl. Berbek III A no. 43', 'Waru', 'Sidoarjo', 'Jawa Timur', '61256', 'Rumah tingkat', 2, 'Selesai'),
(6, 4, '2025-03-18 16:43:17', 'Jl. Lingkar Timur', 'Buduran', 'Sidoarjo', 'Jawa Timur', '61252', NULL, 1, 'Menunggu Penawaran'),
(7, 3, '2025-04-02 20:32:29', 'Jalan abc', 'b', 'c', 'd', '12345', 'e', 1, 'Penawaran Diterbitkan'),
(8, 3, '2025-04-02 20:35:32', 'Jalan Layang', 'Layang', 'c', 'd', '12345', 'e', 1, 'Selesai'),
(9, 6, '2025-04-08 20:03:44', 'Jl. sidoarjo', 'Waru', 'Sidoarjo', 'Jawa Timur', '61256', 'Depan tikungan', 1, 'Menunggu Penawaran'),
(10, 7, '2025-04-17 11:14:39', 'Jl. sidoarjo', 'Waru', 'Sidoarjo', 'Jawa Timur', '12345', 'Depan tikungan', 2, 'Menunggu Penawaran'),
(12, 3, '2025-05-03 14:26:43', 'Perumahan Waru', 'Waru', 'Sidoarjo', 'Jawa Timur', '61251', 'Blok A6 No. 6', 2, 'Menunggu Penawaran');

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan_item`
--

CREATE TABLE `pemesanan_item` (
  `id_item` int(11) NOT NULL,
  `no_pesanan` int(11) NOT NULL,
  `nama_item` varchar(30) NOT NULL,
  `desain_gambar` varchar(255) NOT NULL,
  `material` varchar(20) DEFAULT NULL,
  `jumlah_item` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pemesanan_item`
--

INSERT INTO `pemesanan_item` (`id_item`, `no_pesanan`, `nama_item`, `desain_gambar`, `material`, `jumlah_item`) VALUES
(1, 1, 'Potong besi', '1.jpg', 'Besi/Aluminium', 2),
(2, 2, 'Sparepart mesin moulding', '2.jpg', NULL, 1),
(3, 3, 'Logo Galon', '3.jpg', NULL, 1),
(4, 4, 'Roda gigi', '4.jpg', 'Besi', 4),
(5, 5, 'Cetakan sapu', '5.jpg', 'Besi/Aluminium', 3),
(6, 7, 'Ambatubut', 'mamah-aku-takut.png', 'Besi', 1),
(8, 8, 'diamond', 'iki-epep.pdf', 'Alam', 5),
(9, 9, 'Ambatubut', '11.png', 'Besi', 1),
(10, 10, 'Ambatuling', '10.png', 'Besi', 3),
(11, 12, 'Potong EDM', '12.pdf', 'Aluminium', 1);

-- --------------------------------------------------------

--
-- Table structure for table `penawaran`
--

CREATE TABLE `penawaran` (
  `id_penawaran` int(11) NOT NULL,
  `no_pesanan` int(11) NOT NULL,
  `surat_penawaran` varchar(500) NOT NULL,
  `tgl_penawaran` date NOT NULL DEFAULT curdate(),
  `status_penawaran` enum('Diterbitkan','Disetujui') NOT NULL DEFAULT 'Diterbitkan'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penawaran`
--

INSERT INTO `penawaran` (`id_penawaran`, `no_pesanan`, `surat_penawaran`, `tgl_penawaran`, `status_penawaran`) VALUES
(1, 3, '1746091057.pdf', '2025-05-01', 'Diterbitkan'),
(2, 7, '1746094065.pdf', '2025-05-01', 'Diterbitkan');

-- --------------------------------------------------------

--
-- Table structure for table `penilaian`
--

CREATE TABLE `penilaian` (
  `id_penilaian` int(11) NOT NULL,
  `no_pesanan` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `komentar` varchar(255) DEFAULT NULL,
  `tgl_penilaian` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`kode_pembayaran`),
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
-- Indexes for table `penilaian`
--
ALTER TABLE `penilaian`
  ADD PRIMARY KEY (`id_penilaian`),
  ADD KEY `fk_penilaian_relation_pemesanan` (`no_pesanan`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id_service`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `no_pesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `pemesanan_item`
--
ALTER TABLE `pemesanan_item`
  MODIFY `id_item` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `penawaran`
--
ALTER TABLE `penawaran`
  MODIFY `id_penawaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `penilaian`
--
ALTER TABLE `penilaian`
  MODIFY `id_penilaian` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `id_service` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

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
  ADD CONSTRAINT `fk_pemesanan_item_relation_pemesanan` FOREIGN KEY (`no_pesanan`) REFERENCES `pemesanan` (`no_pesanan`) ON UPDATE CASCADE;

--
-- Constraints for table `penawaran`
--
ALTER TABLE `penawaran`
  ADD CONSTRAINT `fk_penawaran_relation_pemesanan` FOREIGN KEY (`no_pesanan`) REFERENCES `pemesanan` (`no_pesanan`) ON UPDATE CASCADE;

--
-- Constraints for table `penilaian`
--
ALTER TABLE `penilaian`
  ADD CONSTRAINT `fk_penilaian_relation_pemesanan` FOREIGN KEY (`no_pesanan`) REFERENCES `pemesanan` (`no_pesanan`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
