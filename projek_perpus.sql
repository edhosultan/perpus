-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 29, 2022 at 06:22 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projek_perpus`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_biaya_denda`
--

CREATE TABLE `tbl_biaya_denda` (
  `id_biaya_denda` int(11) NOT NULL,
  `harga_denda` varchar(255) NOT NULL,
  `stat` varchar(255) NOT NULL,
  `tgl_tetap` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_biaya_denda`
--

INSERT INTO `tbl_biaya_denda` (`id_biaya_denda`, `harga_denda`, `stat`, `tgl_tetap`) VALUES
(1, '4000', 'Tidak Aktif', '2022-06-07'),
(11, '5000', 'Tidak Aktif', '2022-06-08'),
(12, '2000', 'Aktif', '2022-06-26');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_buku`
--

CREATE TABLE `tbl_buku` (
  `id_buku` int(11) NOT NULL,
  `buku_id` varchar(255) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `id_rak` int(11) NOT NULL,
  `sampul` varchar(255) DEFAULT NULL,
  `isbn` varchar(255) DEFAULT NULL,
  `lampiran` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `penerbit` varchar(255) DEFAULT NULL,
  `pengarang` varchar(255) DEFAULT NULL,
  `thn_buku` varchar(255) DEFAULT NULL,
  `isi` text DEFAULT NULL,
  `jml` int(11) DEFAULT NULL,
  `tgl_masuk` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_buku`
--

INSERT INTO `tbl_buku` (`id_buku`, `buku_id`, `id_kategori`, `id_rak`, `sampul`, `isbn`, `lampiran`, `title`, `penerbit`, `pengarang`, `thn_buku`, `isi`, `jml`, `tgl_masuk`) VALUES
(8, 'BK008', 2, 1, '56ee2e79ec9f68fb13d3bccbfffc898f.JPG', '132-123-234-231', NULL, 'CARA MUDAH BELAJAR PEMROGRAMAN C++', 'INFORMATIKA BANDUNG', 'BUDI RAHARJO  kok', '2012', '<table class=\"table table-bordered\" style=\"background-color: rgb(255, 255, 255); width: 653px; color: rgb(51, 51, 51);\"><tbody><tr><td style=\"padding: 8px; line-height: 1.42857; border-color: rgb(244, 244, 244);\">Tipe Buku</td><td style=\"padding: 8px; line-height: 1.42857; border-color: rgb(244, 244, 244);\">Kertas</td></tr><tr><td style=\"padding: 8px; line-height: 1.42857; border-color: rgb(244, 244, 244);\">Bahasa</td><td style=\"padding: 8px; line-height: 1.42857; border-color: rgb(244, 244, 244);\">Indonesia</td></tr></tbody></table>', 23, '2022-06-25 14:10:16'),
(11, 'BK009', 5, 1, '0', '987-876-8757-23-19', '0', 'Cara Salto', 'Shounen Jump', 'Eichi Oda', '2001', '<p>cek</p>', 142, '2022-06-26 09:13:11'),
(12, 'BK0012', 2, 1, '0', '987-876-8757-23-1', '0', 'Cara Pusing', 'Jump', 'harto', '2002', '<p>cek</p>', 14, '2022-06-26 09:14:07'),
(13, 'BK0013', 4, 1, '0', '987-876-8757-23-2', '0', 'kartun lucu', 'begi', 'BUDI RAHARJO  kok', '2002', '<p>ge</p>', 14, '2022-06-26 10:42:21'),
(14, 'BK0014', 5, 1, '0', '987-876-8757-23-4', '0', 'Cara satsetsat', 'begi', 'BUDI RAHARJO  kok', '2010', '<p>ea</p>', 53, '2022-06-26 10:43:19'),
(15, 'BK0015', 2, 1, '0', '987-876-8757-23-3', '0', 'Cara Ngoding', 'begi', 'harto', '2029', '<p>ea</p>', 53, '2022-06-26 10:44:04'),
(16, 'BK0016', 4, 1, '0', '987-876-8757-23-6', '0', 'Naruto', 'begi', 'harto', '2013', '<p>ae</p>', 24, '2022-06-26 10:44:53'),
(17, 'BK0017', 2, 1, '0', '987-876-8757-23-45', '0', 'Cara Meupdate Mantan', 'Shounen Jump', 'Eichi Oda', '2013', '<p>ea</p>', 43, '2022-06-26 10:45:42'),
(18, 'BK0018', 4, 2, '0', '987-876-8757-23-15', '0', 'bleach', 'Shounen Jump', 'edho', '2012', '<p>ea</p>', 43, '2022-06-26 10:46:33'),
(19, 'BK0019', 4, 1, '0', '987-876-8757-23-87', '0', 'HxH', 'Shounen Jump', 'Eichi Oda', '2099', '<p>ea</p>', 54, '2022-06-26 10:47:27');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_buku_rusak`
--

CREATE TABLE `tbl_buku_rusak` (
  `id_buku_rusak` int(11) NOT NULL,
  `buku_rusak_id` varchar(255) NOT NULL,
  `id_buku` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `id_rak` int(11) NOT NULL,
  `isbn` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `penerbit` varchar(255) NOT NULL,
  `pengarang` varchar(255) NOT NULL,
  `thn_buku` varchar(255) NOT NULL,
  `isi` text NOT NULL,
  `jml_rusak` int(11) NOT NULL,
  `tgl_masuk` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_denda`
--

CREATE TABLE `tbl_denda` (
  `id_denda` int(11) NOT NULL,
  `pinjam_id` varchar(255) NOT NULL,
  `denda` varchar(255) NOT NULL,
  `lama_waktu` int(11) NOT NULL,
  `tgl_denda` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_denda`
--

INSERT INTO `tbl_denda` (`id_denda`, `pinjam_id`, `denda`, `lama_waktu`, `tgl_denda`) VALUES
(3, 'PJ001', '0', 0, '2020-05-20'),
(6, 'PJ0011', '0', 0, '2022-06-07'),
(7, 'PJ0016', '0', 0, '2022-06-08'),
(8, 'PJ0020', '40000', 20, '2022-06-27'),
(9, 'PJ0017', '14000', 7, '2022-06-27');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ebook`
--

CREATE TABLE `tbl_ebook` (
  `id_ebook` int(11) NOT NULL,
  `ebook_id` varchar(255) NOT NULL,
  `id_kategori_ebook` int(11) NOT NULL,
  `sampul` varchar(255) NOT NULL,
  `judul_ebook` varchar(255) NOT NULL,
  `penerbit_ebook` varchar(20) NOT NULL,
  `pengarang_ebook` varchar(20) NOT NULL,
  `isi` text NOT NULL,
  `nama_file` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_ebook`
--

INSERT INTO `tbl_ebook` (`id_ebook`, `ebook_id`, `id_kategori_ebook`, `sampul`, `judul_ebook`, `penerbit_ebook`, `pengarang_ebook`, `isi`, `nama_file`) VALUES
(6, 'EB001', 1, '', 'Cara Cepat Ngomong', 'ikam', 'gw', '<p>kwkwk</p>', 'www.ayuk.com');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kategori`
--

CREATE TABLE `tbl_kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_kategori`
--

INSERT INTO `tbl_kategori` (`id_kategori`, `nama_kategori`) VALUES
(2, 'Pemrograman'),
(4, 'Kartun'),
(5, 'Sosial');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kategori_ebook`
--

CREATE TABLE `tbl_kategori_ebook` (
  `id_kategori_ebook` int(11) NOT NULL,
  `nama_kategori_ebook` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_kategori_ebook`
--

INSERT INTO `tbl_kategori_ebook` (`id_kategori_ebook`, `nama_kategori_ebook`) VALUES
(1, 'komik'),
(2, 'Sosial'),
(3, 'Matematika'),
(4, 'Pegetahuan Umum');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_login`
--

CREATE TABLE `tbl_login` (
  `id_login` int(11) NOT NULL,
  `anggota_id` varchar(255) NOT NULL,
  `user` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `level` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `tempat_lahir` varchar(255) NOT NULL,
  `tgl_lahir` varchar(255) NOT NULL,
  `jenkel` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `telepon` varchar(25) NOT NULL,
  `email` varchar(255) NOT NULL,
  `tgl_bergabung` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_login`
--

INSERT INTO `tbl_login` (`id_login`, `anggota_id`, `user`, `pass`, `level`, `nama`, `tempat_lahir`, `tgl_lahir`, `jenkel`, `alamat`, `telepon`, `email`, `tgl_bergabung`, `foto`) VALUES
(1, 'AG001', 'edho', '202cb962ac59075b964b07152d234b70', 'Petugas', 'Edho Hermawan,S.Kom', 'Kotabaru', '1998-06-11', 'Laki-Laki', 'JL.Yakut', '082298409734', 'edho0798@gmail.com', '2019-11-20', 'user_1654568538.JPG'),
(2, 'AG002', 'fauzan', '202cb962ac59075b964b07152d234b70', 'Anggota', 'Fauzan', 'Bekasi', '1998-11-18', 'Laki-Laki', 'Bekasi Barat', '08123123185', 'fauzanfalah21@gmail.com', '2019-11-21', 'user_1589911243.png'),
(4, 'AG003', 'lana', '202cb962ac59075b964b07152d234b70', 'Anggota', 'Maulana Bosque', 'konoha', '2022-06-22', 'Laki-Laki', 'Jl.Ichiraku', '082298409735', 'lana@gmail.com', '2022-06-09', 'user_1654740962.JPG'),
(5, 'AG005', 'adit', '202cb962ac59075b964b07152d234b70', 'Anggota', 'Adit Si bolang', 'Pelaihari', '2022-06-23', 'Laki-Laki', 'Jl.Kenangan Terindah', '082298409736', 'aditcuy@gmail.com', '2022-06-09', 'user_1654741054.JPG'),
(6, 'AG006', 'ferdy', '202cb962ac59075b964b07152d234b70', 'Anggota', 'Ferdy Si Raja Mexico', 'Sunagakure', '2022-06-10', 'Laki-Laki', 'Jl.Ichaicha', '082298409738', 'ferdyaja@gmail.com', '2022-06-09', 'user_1654741255.JPG'),
(7, 'AG007', 'ardi', '202cb962ac59075b964b07152d234b70', 'Anggota', 'Ardi Si Manis dan Lucu Abieezz', 'PT.Mencari Cinta Sejati', '2022-06-08', 'Laki-Laki', 'Jl.Mencari Titik Terang', '082298409739', 'ardiLucuAbiezz@gmail.com', '2022-06-09', 'user_1654741424.JPG'),
(8, 'AG008', 'faisal', '202cb962ac59075b964b07152d234b70', 'Anggota', 'Faisal Si Oppa Oppa ', 'Malaysia', '2022-06-07', 'Laki-Laki', 'Jl.Durian Runtuh', '082298409731', 'faisalotoke@gmail.com', '2022-06-09', 'user_1654742093.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_mailbox`
--

CREATE TABLE `tbl_mailbox` (
  `id_mailbox` int(11) NOT NULL,
  `mailbox_id` varchar(255) NOT NULL,
  `buku_id` varchar(255) NOT NULL,
  `anggota_id` varchar(255) NOT NULL,
  `tgl_transaksi` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_mailbox`
--

INSERT INTO `tbl_mailbox` (`id_mailbox`, `mailbox_id`, `buku_id`, `anggota_id`, `tgl_transaksi`, `status`) VALUES
(15, 'MB001', 'BK0017', 'AG005', '2022-06-28', 'Dipesan'),
(16, 'MB0016', 'BK0019', 'AG003', '2022-06-28', 'Dipesan');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pinjam`
--

CREATE TABLE `tbl_pinjam` (
  `id_pinjam` int(11) NOT NULL,
  `pinjam_id` varchar(255) NOT NULL,
  `anggota_id` varchar(255) NOT NULL,
  `buku_id` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `tgl_pinjam` varchar(255) NOT NULL,
  `lama_pinjam` int(11) NOT NULL,
  `tgl_balik` varchar(255) NOT NULL,
  `tgl_kembali` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_pinjam`
--

INSERT INTO `tbl_pinjam` (`id_pinjam`, `pinjam_id`, `anggota_id`, `buku_id`, `status`, `tgl_pinjam`, `lama_pinjam`, `tgl_balik`, `tgl_kembali`) VALUES
(16, 'PJ0016', 'AG002', 'BK008', 'Di Kembalikan', '2022-06-07', 1, '2022-06-08', '2022-06-08'),
(19, 'PJ0017', 'AG007', 'BK008', 'Di Kembalikan', '2022-06-19', 1, '2022-06-20', '2022-06-27'),
(20, 'PJ0020', 'AG005', 'BK008', 'Di Kembalikan', '2022-06-06', 1, '2022-06-07', '2022-06-27'),
(21, 'PJ0021', 'AG003', 'BK0012', 'Dipinjam', '2022-06-26', 2, '2022-06-28', '0'),
(22, 'PJ0022', 'AG008', 'BK0012', 'Dipinjam', '2022-06-26', 2, '2022-06-28', '0'),
(23, 'PJ0023', 'AG005', 'BK009', 'Dipinjam', '2022-06-26', 2, '2022-06-28', '0'),
(24, 'PJ0024', 'AG007', 'BK0012', 'Dipinjam', '2022-06-26', 1, '2022-06-27', '0'),
(25, 'PJ0025', 'AG006', 'BK0018', 'Dipinjam', '2022-06-26', 2, '2022-06-28', '0'),
(26, 'PJ0026', 'AG007', 'BK0015', 'Dipinjam', '2022-06-26', 2, '2022-06-28', '0'),
(27, 'PJ0027', 'AG005', 'BK0016', 'Dipinjam', '2022-05-29', 2, '2022-05-31', '0');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rak`
--

CREATE TABLE `tbl_rak` (
  `id_rak` int(11) NOT NULL,
  `nama_rak` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_rak`
--

INSERT INTO `tbl_rak` (`id_rak`, `nama_rak`) VALUES
(1, 'Rak Buku 1'),
(2, 'Rak Buku 2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_biaya_denda`
--
ALTER TABLE `tbl_biaya_denda`
  ADD PRIMARY KEY (`id_biaya_denda`);

--
-- Indexes for table `tbl_buku`
--
ALTER TABLE `tbl_buku`
  ADD PRIMARY KEY (`id_buku`);

--
-- Indexes for table `tbl_buku_rusak`
--
ALTER TABLE `tbl_buku_rusak`
  ADD PRIMARY KEY (`id_buku_rusak`);

--
-- Indexes for table `tbl_denda`
--
ALTER TABLE `tbl_denda`
  ADD PRIMARY KEY (`id_denda`);

--
-- Indexes for table `tbl_ebook`
--
ALTER TABLE `tbl_ebook`
  ADD PRIMARY KEY (`id_ebook`);

--
-- Indexes for table `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `tbl_kategori_ebook`
--
ALTER TABLE `tbl_kategori_ebook`
  ADD PRIMARY KEY (`id_kategori_ebook`);

--
-- Indexes for table `tbl_login`
--
ALTER TABLE `tbl_login`
  ADD PRIMARY KEY (`id_login`);

--
-- Indexes for table `tbl_mailbox`
--
ALTER TABLE `tbl_mailbox`
  ADD PRIMARY KEY (`id_mailbox`);

--
-- Indexes for table `tbl_pinjam`
--
ALTER TABLE `tbl_pinjam`
  ADD PRIMARY KEY (`id_pinjam`);

--
-- Indexes for table `tbl_rak`
--
ALTER TABLE `tbl_rak`
  ADD PRIMARY KEY (`id_rak`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_biaya_denda`
--
ALTER TABLE `tbl_biaya_denda`
  MODIFY `id_biaya_denda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_buku`
--
ALTER TABLE `tbl_buku`
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tbl_buku_rusak`
--
ALTER TABLE `tbl_buku_rusak`
  MODIFY `id_buku_rusak` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_denda`
--
ALTER TABLE `tbl_denda`
  MODIFY `id_denda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_ebook`
--
ALTER TABLE `tbl_ebook`
  MODIFY `id_ebook` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_kategori_ebook`
--
ALTER TABLE `tbl_kategori_ebook`
  MODIFY `id_kategori_ebook` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_login`
--
ALTER TABLE `tbl_login`
  MODIFY `id_login` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_mailbox`
--
ALTER TABLE `tbl_mailbox`
  MODIFY `id_mailbox` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tbl_pinjam`
--
ALTER TABLE `tbl_pinjam`
  MODIFY `id_pinjam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `tbl_rak`
--
ALTER TABLE `tbl_rak`
  MODIFY `id_rak` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
