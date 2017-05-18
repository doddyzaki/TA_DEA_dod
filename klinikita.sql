-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 19 Mei 2017 pada 01.03
-- Versi Server: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `klinikita`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_detail_dmu`
--

CREATE TABLE IF NOT EXISTS `tb_detail_dmu` (
`id_detail` int(3) NOT NULL,
  `id_klinik` int(3) NOT NULL,
  `id_variabel` int(3) NOT NULL,
  `nilai_variabel` int(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data untuk tabel `tb_detail_dmu`
--

INSERT INTO `tb_detail_dmu` (`id_detail`, `id_klinik`, `id_variabel`, `nilai_variabel`) VALUES
(19, 1, 6, 6),
(20, 1, 10, 2),
(21, 1, 12, 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_klinik`
--

CREATE TABLE IF NOT EXISTS `tb_klinik` (
`id_klinik` int(3) NOT NULL,
  `cabang_klinik` varchar(30) COLLATE utf8_bin NOT NULL,
  `alamat` varchar(50) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data untuk tabel `tb_klinik`
--

INSERT INTO `tb_klinik` (`id_klinik`, `cabang_klinik`, `alamat`) VALUES
(1, 'Banyumanik', 'Jl. Setiabudi 55'),
(2, 'Tembalang', 'Jl. Setiabudi 55'),
(3, 'Setiabudi', 'Jl. Setiabudi 55'),
(6, 'Grogol', 'Jl. Sidoluhur no 49 Cemani'),
(7, 'Cemani', 'Jl. Sidomulyo no 55 Cemani'),
(8, 'Bulusan', 'Jl. Bulusan Raya');

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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=COMPACT;

--
-- Dumping data untuk tabel `tb_pengguna`
--

INSERT INTO `tb_pengguna` (`id_pengguna`, `nama`, `username`, `password`, `id_klinik`, `level`) VALUES
(1, 'admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', 0, 'a'),
(2, 'Doddy', 'doddyzaki', 'd41d8cd98f00b204e9800998ecf8427e', 1, 'p'),
(3, 'Zaki', 'zaki', '21232f297a57a5a743894a0e4a801fc3', 1, 'p'),
(4, 'Kirana', 'kirana', '21232f297a57a5a743894a0e4a801fc3', 2, 'p'),
(5, 'Kirana', 'kirana', '21232f297a57a5a743894a0e4a801fc3', 3, 'p'),
(6, 'Kirana', 'kirana', '21232f297a57a5a743894a0e4a801fc3', 4, 'p'),
(7, 'Eno', 'eno', '21232f297a57a5a743894a0e4a801fc3', 1, 'p'),
(8, 'Tanjung', 'tjg', '21232f297a57a5a743894a0e4a801fc3', 3, 'p'),
(11, 'Pramusinta', 'pramusinta', '21232f297a57a5a743894a0e4a801fc3', 7, 'p'),
(14, 'Nunuk', 'nunuktw', '21232f297a57a5a743894a0e4a801fc3', 7, 'p'),
(15, 'Jamil', 'jamil', '21232f297a57a5a743894a0e4a801fc3', 3, 'p'),
(16, 'Shiro', 'shiro', '21232f297a57a5a743894a0e4a801fc3', 7, 'p'),
(17, 'Brewok', 'brewok', '21232f297a57a5a743894a0e4a801fc3', 8, 'p');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_perhitungan_efisiensi`
--

CREATE TABLE IF NOT EXISTS `tb_perhitungan_efisiensi` (
`id_perhitungan_efisiensi` int(5) NOT NULL,
  `id_dmu` int(3) NOT NULL,
  `nilai_efisiensi` double NOT NULL,
  `rekomendasi` text COLLATE utf8_bin NOT NULL,
  `hasil_efisiensi` varchar(30) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_variabel`
--

CREATE TABLE IF NOT EXISTS `tb_variabel` (
`id_variabel` int(3) NOT NULL,
  `nama_variabel` varchar(50) COLLATE utf8_bin NOT NULL,
  `jenis_variabel` varchar(6) COLLATE utf8_bin NOT NULL,
  `satuan` varchar(50) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data untuk tabel `tb_variabel`
--

INSERT INTO `tb_variabel` (`id_variabel`, `nama_variabel`, `jenis_variabel`, `satuan`) VALUES
(6, 'Perawat SMK', 'Output', 'Orang'),
(10, 'Dokter', 'Input', 'Orang'),
(12, 'Suster', 'Input', 'Orang');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_detail_dmu`
--
ALTER TABLE `tb_detail_dmu`
 ADD PRIMARY KEY (`id_detail`);

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
MODIFY `id_detail` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `tb_klinik`
--
ALTER TABLE `tb_klinik`
MODIFY `id_klinik` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tb_pengguna`
--
ALTER TABLE `tb_pengguna`
MODIFY `id_pengguna` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `tb_perhitungan_efisiensi`
--
ALTER TABLE `tb_perhitungan_efisiensi`
MODIFY `id_perhitungan_efisiensi` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_variabel`
--
ALTER TABLE `tb_variabel`
MODIFY `id_variabel` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
