-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 01, 2026 at 11:47 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `penjualan`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id` int NOT NULL,
  `kode_barang` varchar(10) DEFAULT NULL,
  `nama_barang` varchar(100) DEFAULT NULL,
  `harga` int DEFAULT NULL,
  `stok` int DEFAULT NULL,
  `supplier_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id`, `kode_barang`, `nama_barang`, `harga`, `stok`, `supplier_id`) VALUES
(1, 'BRG001', 'Mouse Wireless Logitech', 12500, 50, 1),
(2, 'BRG002', 'Keyboard Mechanical', 18000, 30, 2),
(3, 'BRG003', 'Flashdisk 32GB', 15000, 75, 3),
(4, 'BRG004', 'Kabel HDMI 2 Meter', 8500, 40, 4),
(5, 'BRG005', 'Headset Gaming', 22000, 25, 5),
(6, 'BRG006', 'Mousepad Gaming', 12000, 60, 6),
(7, 'BRG007', 'Kabel USB Type-C', 9500, 80, 7),
(8, 'BRG008', 'Adaptor Charger 20W', 7000, 35, 8),
(9, 'BRG009', 'Webcam HD 1080p', 16000, 20, 9),
(10, 'BRG010', 'SSD External 256GB', 28000, 15, 10);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` varchar(20) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `jenis_kelamin` enum('L','P') DEFAULT NULL,
  `telp` varchar(12) DEFAULT NULL,
  `alamat` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `nama`, `jenis_kelamin`, `telp`, `alamat`) VALUES
('PLG001', 'Andi Pratama', 'L', '081234567801', 'Jl. Mawar No. 12, Mojokerto'),
('PLG002', 'Siti Rahmawati', 'P', '081234567802', 'Jl. Diponegoro No. 8, Surabaya'),
('PLG003', 'Budi Santoso', 'L', '081234567803', 'Jl. Ahmad Yani No. 21, Bangkalan'),
('PLG004', 'Dewi Anggraini', 'P', '081234567804', 'Jl. Merdeka No. 15, Sidoarjo'),
('PLG005', 'Rizky Firmansyah', 'L', '081234567805', 'Jl. Trunojoyo No. 7, Pamekasan'),
('PLG006', 'Nadia Putri', 'P', '081234567806', 'Jl. Pemuda No. 19, Gresik'),
('PLG007', 'Fajar Ramadhan', 'L', '081234567807', 'Jl. Veteran No. 5, Lamongan'),
('PLG008', 'Intan Permatasari', 'P', '081234567808', 'Jl. Kartini No. 11, Jombang'),
('PLG009', 'Dimas Saputra', 'L', '081234567809', 'Jl. Hayam Wuruk No. 30, Kediri'),
('PLG010', 'Aulia Safitri', 'P', '081234567810', 'Jl. Basuki Rahmat No. 4, Malang');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` int NOT NULL,
  `waktu_bayar` datetime DEFAULT NULL,
  `total` int DEFAULT NULL,
  `metode` enum('TUNAI','TRANSFER','EDC') DEFAULT NULL,
  `transaksi_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id`, `waktu_bayar`, `total`, `metode`, `transaksi_id`) VALUES
(1, '2026-10-01 09:15:00', 43000, 'TUNAI', 1),
(2, '2026-10-03 10:30:00', 32000, 'TRANSFER', 2),
(3, '2026-10-05 13:45:00', 56000, 'EDC', 3),
(4, '2026-10-07 11:20:00', 30500, 'TUNAI', 4),
(5, '2026-10-09 14:10:00', 60000, 'TRANSFER', 5),
(6, '2026-10-12 15:30:00', 42500, 'EDC', 6),
(7, '2026-10-15 09:50:00', 58000, 'TUNAI', 7),
(8, '2026-10-18 12:25:00', 49500, 'TRANSFER', 8),
(9, '2026-10-22 16:00:00', 35000, 'EDC', 9),
(10, '2026-10-25 10:15:00', 70000, 'TUNAI', 10);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` int NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `telp` varchar(12) DEFAULT NULL,
  `alamat` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `nama`, `telp`, `alamat`) VALUES
(1, 'PT Sumber Komputer', '0315678101', 'Jl. Raya Darmo No. 10, Bangkalan'),
(2, 'CV Digital Nusantara', '0315678102', 'Jl. Ahmad Yani No. 25, Surabaya'),
(3, 'PT Teknologi Mandiri', '03415678103', 'Jl. Soekarno Hatta No. 18, Malang'),
(4, 'CV Berkah Elektronik', '03215678104', 'Jl. Mojopahit No. 42, Mojokerto'),
(5, 'PT Mitra Hardware', '0315678105', 'Jl. Rungkut Industri No. 5, Surabaya'),
(6, 'CV Global Aksesoris', '03415678106', 'Jl. Veteran No. 16, Malang'),
(7, 'PT Media Informatika', '0315678107', 'Jl. Gubeng No. 20, Surabaya'),
(8, 'CV Prima Digital', '03215678108', 'Jl. Panglima Sudirman No. 9, Sidoarjo'),
(9, 'PT Sinar Teknologi', '03515678109', 'Jl. Diponegoro No. 13, Kediri'),
(10, 'CV Cipta Komputer', '03315678110', 'Jl. Trunojoyo No. 6, Jember');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int NOT NULL,
  `waktu_transaksi` date DEFAULT NULL,
  `keterangan` text,
  `total` int DEFAULT NULL,
  `pelanggan_id` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `waktu_transaksi`, `keterangan`, `total`, `pelanggan_id`) VALUES
(1, '2026-10-01', 'Pembelian aksesoris komputer', 43000, 'PLG001'),
(2, '2026-10-03', 'Pembelian perlengkapan komputer', 32000, 'PLG002'),
(3, '2026-10-05', 'Pembelian headset dan mousepad', 56000, 'PLG003'),
(4, '2026-10-07', 'Pembelian kabel dan aksesoris', 30500, 'PLG004'),
(5, '2026-10-09', 'Pembelian perangkat penyimpanan', 60000, 'PLG005'),
(6, '2026-10-12', 'Pembelian mouse dan flashdisk', 42500, 'PLG006'),
(7, '2026-10-15', 'Pembelian keyboard dan headset', 58000, 'PLG007'),
(8, '2026-10-18', 'Pembelian kabel dan mousepad', 49500, 'PLG008'),
(9, '2026-10-22', 'Pembelian webcam dan kabel USB', 35000, 'PLG009'),
(10, '2026-10-25', 'Pembelian charger dan SSD', 70000, 'PLG010');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_detail`
--

CREATE TABLE `transaksi_detail` (
  `transaksi_id` int NOT NULL,
  `barang_id` int NOT NULL,
  `harga` int DEFAULT NULL,
  `qty` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `transaksi_detail`
--

INSERT INTO `transaksi_detail` (`transaksi_id`, `barang_id`, `harga`, `qty`) VALUES
(1, 1, 12500, 2),
(1, 2, 18000, 1),
(2, 3, 15000, 1),
(2, 4, 8500, 2),
(3, 5, 22000, 2),
(3, 6, 12000, 1),
(4, 7, 9500, 1),
(4, 8, 7000, 3),
(5, 9, 16000, 2),
(5, 10, 28000, 1),
(6, 1, 12500, 1),
(6, 3, 15000, 2),
(7, 2, 18000, 2),
(7, 5, 22000, 1),
(8, 4, 8500, 3),
(8, 6, 12000, 2),
(9, 7, 9500, 2),
(9, 9, 16000, 1),
(10, 8, 7000, 2),
(10, 10, 28000, 2);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` tinyint NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(35) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `alamat` varchar(150) DEFAULT NULL,
  `hp` varchar(20) DEFAULT NULL,
  `level` tinyint DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama`, `alamat`, `hp`, `level`) VALUES
(1, 'admin01', 'admin123', 'Agus Setiawan', 'Surabaya', '081300000001', 1),
(2, 'kasir01', 'kasir123', 'Rina Marlina', 'Mojokerto', '081300000002', 2),
(3, 'kasir02', 'kasir123', 'Doni Saputra', 'Sidoarjo', '081300000003', 2),
(4, 'admin02', 'admin456', 'Hendra Wijaya', 'Malang', '081300000004', 1),
(5, 'kasir03', 'kasir123', 'Lina Oktavia', 'Gresik', '081300000005', 2),
(6, 'kasir04', 'kasir123', 'Rudi Hartono', 'Bangkalan', '081300000006', 2),
(7, 'admin03', 'admin789', 'Maya Sari', 'Jombang', '081300000007', 1),
(8, 'kasir05', 'kasir123', 'Arif Nugroho', 'Kediri', '081300000008', 2),
(9, 'kasir06', 'kasir123', 'Dina Amelia', 'Pamekasan', '081300000009', 2),
(10, 'admin04', 'admin101', 'Bayu Prakoso', 'Lamongan', '081300000010', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `supplier_id` (`supplier_id`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaksi_id` (`transaksi_id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pelanggan_id` (`pelanggan_id`);

--
-- Indexes for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD PRIMARY KEY (`transaksi_id`,`barang_id`),
  ADD KEY `barang_id` (`barang_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` tinyint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`id`);

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`id`);

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`pelanggan_id`) REFERENCES `pelanggan` (`id`);

--
-- Constraints for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD CONSTRAINT `transaksi_detail_ibfk_1` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`id`),
  ADD CONSTRAINT `transaksi_detail_ibfk_2` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
