-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 14, 2017 at 01:06 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `commer`
--

-- --------------------------------------------------------

--
-- Table structure for table `berita`
--

CREATE TABLE `berita` (
  `idberita` bigint(20) NOT NULL,
  `tanggal` datetime NOT NULL,
  `judul` varchar(100) DEFAULT NULL,
  `isi` text NOT NULL,
  `aktif` tinyint(1) NOT NULL,
  `gambar` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `berita`
--

INSERT INTO `berita` (`idberita`, `tanggal`, `judul`, `isi`, `aktif`, `gambar`) VALUES
(3, '2013-10-15 23:23:51', 'Promo Akhir Tahun', '<p>ajkljo kajdjas</p>', 1, 'promo.jpg'),
(4, '2013-10-15 23:24:05', 'Promo Lebaran', '<p>zasbndvanms</p>', 1, 'promo_lebaran12_1.png');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `noinvoice` varchar(6) NOT NULL,
  `tanggal` datetime NOT NULL,
  `idpelanggan` int(11) NOT NULL,
  `totalbayar` float NOT NULL,
  `transfer` tinyint(1) NOT NULL,
  `tglkirim` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`noinvoice`, `tanggal`, `idpelanggan`, `totalbayar`, `transfer`, `tglkirim`) VALUES
('T00002', '2013-10-16 06:15:51', 3, 419832, 1, '2013-10-16 06:18:24'),
('T00003', '2017-07-13 22:30:22', 5, 209916, 1, NULL),
('T00004', '2017-07-13 23:54:40', 7, 450000, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `idkategori` int(11) NOT NULL,
  `nama_kategori` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`idkategori`, `nama_kategori`) VALUES
(1, 'Baju'),
(2, 'Buku'),
(4, 'Elektronik');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `idpelanggan` int(11) NOT NULL,
  `nama` varchar(25) NOT NULL,
  `kelamin` set('L','P') NOT NULL,
  `email` varchar(100) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `kodepos` varchar(6) NOT NULL,
  `kota` varchar(25) NOT NULL,
  `telp` varchar(200) NOT NULL,
  `tanggal_daftar` date DEFAULT NULL,
  `password` varchar(32) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`idpelanggan`, `nama`, `kelamin`, `email`, `alamat`, `kodepos`, `kota`, `telp`, `tanggal_daftar`, `password`, `status`) VALUES
(7, 'maman', 'L', 'maman@gmail.com', '7jb									', '7', '7', '7', '2017-07-13', '6ffee7d3af984c95d72d813efda2d919', 0);

-- --------------------------------------------------------

--
-- Table structure for table `pengelola`
--

CREATE TABLE `pengelola` (
  `idpengelola` int(11) NOT NULL,
  `nama` varchar(32) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengelola`
--

INSERT INTO `pengelola` (`idpengelola`, `nama`, `username`, `password`) VALUES
(1, 'admin', 'admin', '827ccb0eea8a706c4c34a16891f84e7b'),
(2, 'candralab', 'candralab', '22fb32eae82ff0855bff018433e4723c');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `idproduk` int(10) NOT NULL,
  `nama_produk` varchar(200) NOT NULL,
  `idkategori` int(255) NOT NULL,
  `deskripsi` text,
  `foto` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`idproduk`, `nama_produk`, `idkategori`, `deskripsi`, `foto`) VALUES
(1, 'Model 1', 1, '					Pakain modis yang bis dipakai saat santai atau acara pesta	1				', '1.jpg'),
(2, 'model 2', 1, '					Pakain corak putih hitam dikombinasikan dengan rok hijau sangat cocok dipakai dsaat santai				', '2.jpg'),
(3, 'model 3', 1, '					Pakain kantor dan resmi yang bisa dipakai saat bertemu client atau meeting atau untuk bersantai ria saat belanja				', '3.jpg'),
(12, 'PHP and MySQL From Novice to Professional', 2, 'Up-to-date coverage of PHP 5.3 and MySQL from one of the most trusted names in PHP development, W. Jason Gilmore									', 'buku1.png'),
(13, 'Beginning Arduino', 2, 'In Beginning Arduino, Second Edition, you will learn all about the popular Arduino microcontroller by working your way through an amazing set of 50 cool projects.									', 'buku2.png'),
(14, 'Makers at Work', 2, 'Makers at Work profiles 21 of the most creative, inquisitive, and influential "makers"--people creating new products, art, and methods using computer controls, recycled items, open-source code and plans, 3D printers, and anything else that can help them turn both whacky and incredibly insightful ideas into reality. Foreword by Brad Feld									', 'buku3.png'),
(15, 'Nokia Lumia 1020', 4, 'Smartphone dari Microsoft dengan Resolusi kamera 41MP.cocok bagi fotographer Profesional									', 'lumia.jpg'),
(16, 'Samsung Galaxy S4', 4, 'Flagship smartphone dari samsung, menggunakan Android jellybean terbaru, terbaik di kelasnya 									', 's4.jpg'),
(17, 'iPhone 5s', 4, 'Produk terbaru dari Apple, dibekali dengan iOS7 menjadikan iphone produk terbaik dari apple									', 'iphone.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `stok`
--

CREATE TABLE `stok` (
  `idstok` int(11) NOT NULL,
  `idproduk` int(11) NOT NULL,
  `harga_beli` double NOT NULL,
  `harga_jual` double NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stok`
--

INSERT INTO `stok` (`idstok`, `idproduk`, `harga_beli`, `harga_jual`, `jumlah`) VALUES
(1, 1, 150000, 225000, 20),
(2, 2, 100000, 150000, 20),
(3, 3, 50000, 75000, 13),
(10, 12, 30000, 45000, 10),
(11, 13, 25000, 37500, 18),
(12, 14, 100000, 150000, 20),
(13, 15, 5000000, 7500000, 10),
(14, 16, 5000000, 7500000, 5),
(15, 17, 200000, 300000, 5);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `idtransaksi` int(11) NOT NULL,
  `noinvoice` varchar(6) NOT NULL,
  `idproduk` int(10) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`idtransaksi`, `noinvoice`, `idproduk`, `jumlah`) VALUES
(2, 'T00002', 2, 2),
(3, 'T00003', 13, 1),
(4, 'T00004', 15, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`idberita`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`noinvoice`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`idkategori`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`idpelanggan`);

--
-- Indexes for table `pengelola`
--
ALTER TABLE `pengelola`
  ADD PRIMARY KEY (`idpengelola`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`idproduk`);

--
-- Indexes for table `stok`
--
ALTER TABLE `stok`
  ADD PRIMARY KEY (`idstok`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`idtransaksi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `berita`
--
ALTER TABLE `berita`
  MODIFY `idberita` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `idkategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `idpelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `pengelola`
--
ALTER TABLE `pengelola`
  MODIFY `idpengelola` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `idproduk` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `stok`
--
ALTER TABLE `stok`
  MODIFY `idstok` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `idtransaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
