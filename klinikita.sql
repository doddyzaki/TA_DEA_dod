-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 12 Jul 2017 pada 01.47
-- Versi Server: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `klinikita2`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_detail_dmu`
--

CREATE TABLE IF NOT EXISTS `tb_detail_dmu` (
`id_detail_dmu` int(11) NOT NULL,
  `id_klinik` int(11) NOT NULL,
  `id_variabel` int(11) NOT NULL,
  `nilai_variabel` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data untuk tabel `tb_detail_dmu`
--

INSERT INTO `tb_detail_dmu` (`id_detail_dmu`, `id_klinik`, `id_variabel`, `nilai_variabel`) VALUES
(22, 1, 20, 3),
(23, 1, 21, 5),
(24, 1, 22, 6),
(25, 1, 23, 2),
(26, 1, 24, 360),
(27, 1, 25, 45),
(28, 1, 26, 296),
(29, 2, 20, 2),
(30, 2, 21, 1),
(31, 2, 22, 7),
(32, 2, 23, 1),
(33, 2, 24, 360),
(34, 2, 25, 57),
(35, 2, 26, 497),
(36, 3, 20, 2),
(37, 3, 21, 2),
(38, 3, 22, 2),
(39, 3, 23, 1),
(40, 3, 24, 360),
(41, 3, 25, 36),
(42, 3, 26, 345);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_klinik`
--

CREATE TABLE IF NOT EXISTS `tb_klinik` (
`id_klinik` int(3) NOT NULL,
  `cabang_klinik` varchar(30) COLLATE utf8_bin NOT NULL,
  `alamat` varchar(50) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data untuk tabel `tb_klinik`
--

INSERT INTO `tb_klinik` (`id_klinik`, `cabang_klinik`, `alamat`) VALUES
(1, 'Setiabudi', 'Jl. Setiabudi 55'),
(2, 'Kalipancur', 'Jl. Abulrahman Saleh Kav. 783'),
(3, 'Kedungmundu', 'Jl. Kedungmundu Raya, Ruko Grahawahid No. 7');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pengguna`
--

CREATE TABLE IF NOT EXISTS `tb_pengguna` (
`id_pengguna` int(3) NOT NULL,
  `nama` varchar(50) COLLATE utf8_bin NOT NULL,
  `username` varchar(50) COLLATE utf8_bin NOT NULL,
  `password` varchar(50) COLLATE utf8_bin NOT NULL,
  `id_klinik` int(3) NOT NULL,
  `level` char(1) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=COMPACT;

--
-- Dumping data untuk tabel `tb_pengguna`
--

INSERT INTO `tb_pengguna` (`id_pengguna`, `nama`, `username`, `password`, `id_klinik`, `level`) VALUES
(1, 'superadmin', 'admin', '21232f297a57a5a743894a0e4a801fc3', 0, 's'),
(2, 'Murtiono', 'manajerpusat', '21232f297a57a5a743894a0e4a801fc3', 0, 'p'),
(3, 'Tiffany Sisiadewi', 'tiffany', '21232f297a57a5a743894a0e4a801fc3', 1, 'a'),
(4, 'Wahyu Saputri', 'wahyu', '21232f297a57a5a743894a0e4a801fc3', 2, 'a'),
(7, 'Retno Puji', 'retno', '21232f297a57a5a743894a0e4a801fc3', 1, 'm'),
(15, 'Jamil Kasiman', 'jamil', '21232f297a57a5a743894a0e4a801fc3', 3, 'm'),
(18, 'Tambayong', 'tambayong', '21232f297a57a5a743894a0e4a801fc3', 3, 'c'),
(20, 'Pramusinta Widhi', 'pramusinta', '21232f297a57a5a743894a0e4a801fc3', 3, 'a'),
(29, 'Laila Ethika', 'laila', '21232f297a57a5a743894a0e4a801fc3', 2, 'm'),
(30, 'Agung Rizki', 'agung', 'd41d8cd98f00b204e9800998ecf8427e', 1, 'm');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_perhitungan_efisiensi`
--

CREATE TABLE IF NOT EXISTS `tb_perhitungan_efisiensi` (
`id_perhitungan_efisiensi` int(11) NOT NULL,
  `id_klinik` int(11) NOT NULL,
  `id_variabel` int(11) NOT NULL,
  `nilai_efisiensi` double NOT NULL,
  `nilai_awal` int(11) NOT NULL,
  `rekomendasi` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=244 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data untuk tabel `tb_perhitungan_efisiensi`
--

INSERT INTO `tb_perhitungan_efisiensi` (`id_perhitungan_efisiensi`, `id_klinik`, `id_variabel`, `nilai_efisiensi`, `nilai_awal`, `rekomendasi`) VALUES
(229, 1, 20, 0.77897536394177, 3, 2),
(230, 1, 21, 0.77897536394177, 5, 1),
(231, 1, 22, 0.77897536394177, 6, 6),
(232, 1, 23, 0.77897536394177, 2, 1),
(233, 1, 24, 0.77897536394177, 360, 284),
(234, 2, 20, 1, 2, 2),
(235, 2, 21, 1, 1, 1),
(236, 2, 22, 1, 7, 7),
(237, 2, 23, 1, 1, 1),
(238, 2, 24, 1, 360, 360),
(239, 3, 20, 0.70173082089266, 2, 1),
(240, 3, 21, 0.70173082089266, 2, 1),
(241, 3, 22, 0.70173082089266, 2, 5),
(242, 3, 23, 0.70173082089266, 1, 1),
(243, 3, 24, 0.70173082089266, 360, 250);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_variabel`
--

CREATE TABLE IF NOT EXISTS `tb_variabel` (
`id_variabel` int(3) NOT NULL,
  `nama_variabel` varchar(50) COLLATE utf8_bin NOT NULL,
  `jenis_variabel` char(6) COLLATE utf8_bin NOT NULL,
  `satuan` varchar(50) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data untuk tabel `tb_variabel`
--

INSERT INTO `tb_variabel` (`id_variabel`, `nama_variabel`, `jenis_variabel`, `satuan`) VALUES
(20, 'Dokter Umum', 'Input', 'Orang'),
(21, 'Dokter Gigi', 'Input', 'Orang'),
(22, 'Perawat', 'Input', 'Orang'),
(23, 'Staff Non Medis', 'Input', 'Orang'),
(24, 'Jam Kerja', 'Input', 'Jam'),
(25, 'Omset', 'Output', 'Juta'),
(26, 'Pasien', 'Output', 'Orang');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_detail_dmu`
--
ALTER TABLE `tb_detail_dmu`
 ADD PRIMARY KEY (`id_detail_dmu`);

--
-- Indexes for table `tb_klinik`
--
ALTER TABLE `tb_klinik`
 ADD PRIMARY KEY (`id_klinik`);

--
-- Indexes for table `tb_pengguna`
--
ALTER TABLE `tb_pengguna`
 ADD PRIMARY KEY (`id_pengguna`);

--
-- Indexes for table `tb_perhitungan_efisiensi`
--
ALTER TABLE `tb_perhitungan_efisiensi`
 ADD PRIMARY KEY (`id_perhitungan_efisiensi`);

--
-- Indexes for table `tb_variabel`
--
ALTER TABLE `tb_variabel`
 ADD PRIMARY KEY (`id_variabel`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_detail_dmu`
--
ALTER TABLE `tb_detail_dmu`
MODIFY `id_detail_dmu` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT for table `tb_klinik`
--
ALTER TABLE `tb_klinik`
MODIFY `id_klinik` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tb_pengguna`
--
ALTER TABLE `tb_pengguna`
MODIFY `id_pengguna` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `tb_perhitungan_efisiensi`
--
ALTER TABLE `tb_perhitungan_efisiensi`
MODIFY `id_perhitungan_efisiensi` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=244;
--
-- AUTO_INCREMENT for table `tb_variabel`
--
ALTER TABLE `tb_variabel`
MODIFY `id_variabel` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=27;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
