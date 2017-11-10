-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Inang: 127.0.0.1
-- Waktu pembuatan: 13 Jan 2016 pada 15.33
-- Versi Server: 5.6.11
-- Versi PHP: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Basis data: `perpus_smaba`
--
CREATE DATABASE IF NOT EXISTS `perpus_smaba` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `perpus_smaba`;

-- --------------------------------------------------------

--
-- Struktur dari tabel `buku`
--

CREATE TABLE IF NOT EXISTS `buku` (
  `id_buku` int(9) NOT NULL AUTO_INCREMENT,
  `jeneng_buku` varchar(50) NOT NULL,
  `id_kategori` int(9) NOT NULL,
  `id_pengarang` int(9) NOT NULL,
  `id_tahun` int(3) NOT NULL,
  `stock_awal` int(4) DEFAULT NULL,
  PRIMARY KEY (`id_buku`),
  KEY `id_kategori` (`id_kategori`),
  KEY `id_pengarang` (`id_pengarang`),
  KEY `id_tahun` (`id_tahun`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data untuk tabel `buku`
--

INSERT INTO `buku` (`id_buku`, `jeneng_buku`, `id_kategori`, `id_pengarang`, `id_tahun`, `stock_awal`) VALUES
(15, 'ini budi', 2, 3, 2, 200),
(17, 'keajaiban dunia', 1, 1, 1, 10),
(18, 'tanda kebesaran ALLAH', 1, 1, 2, 20);

--
-- Trigger `buku`
--
DROP TRIGGER IF EXISTS `auto_insert_stock`;
DELIMITER //
CREATE TRIGGER `auto_insert_stock` AFTER INSERT ON `buku`
 FOR EACH ROW insert into stock_buku(id_buku,stock_now)values(New.id_buku,New.stock_awal)
//
DELIMITER ;
DROP TRIGGER IF EXISTS `delete_auto_stock`;
DELIMITER //
CREATE TRIGGER `delete_auto_stock` AFTER DELETE ON `buku`
 FOR EACH ROW DELETE FROM stock_buku WHERE id_buku=old.id_buku
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE IF NOT EXISTS `kategori` (
  `id_kategori` int(9) NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(30) NOT NULL,
  PRIMARY KEY (`id_kategori`),
  UNIQUE KEY `nama_kategori` (`nama_kategori`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'ilmiah'),
(2, 'sastra');

-- --------------------------------------------------------

--
-- Struktur dari tabel `lvl`
--

CREATE TABLE IF NOT EXISTS `lvl` (
  `level` varchar(20) NOT NULL,
  PRIMARY KEY (`level`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `lvl`
--

INSERT INTO `lvl` (`level`) VALUES
('admin'),
('petugas');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengarang`
--

CREATE TABLE IF NOT EXISTS `pengarang` (
  `id_pengarang` int(9) NOT NULL AUTO_INCREMENT,
  `jeneng_pengarang` varchar(50) NOT NULL,
  PRIMARY KEY (`id_pengarang`),
  UNIQUE KEY `jeneng_pengarang` (`jeneng_pengarang`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data untuk tabel `pengarang`
--

INSERT INTO `pengarang` (`id_pengarang`, `jeneng_pengarang`) VALUES
(1, 'harun yahya'),
(3, 'irham ajah');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pinjam`
--

CREATE TABLE IF NOT EXISTS `pinjam` (
  `id_pinjam` int(6) NOT NULL AUTO_INCREMENT,
  `NIS` int(11) NOT NULL,
  `id_buku` int(9) NOT NULL,
  `hari_pinjam` varchar(11) NOT NULL,
  `hari_deadline` varchar(11) NOT NULL,
  `hari_kembali` varchar(11) DEFAULT NULL,
  `status` varchar(11) DEFAULT NULL,
  `denda` int(9) DEFAULT NULL,
  PRIMARY KEY (`id_pinjam`),
  KEY `NIS` (`NIS`),
  KEY `id_buku` (`id_buku`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data untuk tabel `pinjam`
--

INSERT INTO `pinjam` (`id_pinjam`, `NIS`, `id_buku`, `hari_pinjam`, `hari_deadline`, `hari_kembali`, `status`, `denda`) VALUES
(12, 10996, 17, '01/13/2016 ', ' 01/13/2016', '01/13/2016', 'kembali', 0),
(13, 11039, 15, '01/10/2016 ', ' 01/10/2016', '01/13/2016', 'kembali', 600),
(14, 11030, 18, '01/13/2016 ', ' 01/13/2016', '01/13/2016', 'kembali', 0);

--
-- Trigger `pinjam`
--
DROP TRIGGER IF EXISTS `update1_stock`;
DELIMITER //
CREATE TRIGGER `update1_stock` AFTER INSERT ON `pinjam`
 FOR EACH ROW UPDATE stock_buku SET stock_now=stock_now-1 WHERE id_buku=NEW.id_buku
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `stock_buku`
--

CREATE TABLE IF NOT EXISTS `stock_buku` (
  `id_buku` int(9) NOT NULL AUTO_INCREMENT,
  `stock_now` int(5) NOT NULL,
  PRIMARY KEY (`id_buku`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data untuk tabel `stock_buku`
--

INSERT INTO `stock_buku` (`id_buku`, `stock_now`) VALUES
(15, 200),
(17, 10),
(18, 20);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tahun`
--

CREATE TABLE IF NOT EXISTS `tahun` (
  `id_tahun` int(9) NOT NULL AUTO_INCREMENT,
  `nama_tahun` int(4) NOT NULL,
  PRIMARY KEY (`id_tahun`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data untuk tabel `tahun`
--

INSERT INTO `tahun` (`id_tahun`, `nama_tahun`) VALUES
(1, 2015),
(2, 2016);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_siswa`
--

CREATE TABLE IF NOT EXISTS `tb_siswa` (
  `id_siswa` int(20) NOT NULL AUTO_INCREMENT,
  `nama_siswa` varchar(20) NOT NULL,
  `alamat_siswa` varchar(20) NOT NULL,
  PRIMARY KEY (`id_siswa`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data untuk tabel `tb_siswa`
--

INSERT INTO `tb_siswa` (`id_siswa`, `nama_siswa`, `alamat_siswa`) VALUES
(12, 'irham2', 'sokaraja2'),
(13, 'ediaa', 'ediads');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE IF NOT EXISTS `tb_user` (
  `id_login` int(20) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(225) NOT NULL,
  `level` varchar(20) NOT NULL,
  `foto` varchar(20) NOT NULL,
  PRIMARY KEY (`id_login`),
  KEY `level` (`level`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id_login`, `username`, `password`, `level`, `foto`) VALUES
(4, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', '1452510292.jpg'),
(6, 'ian', 'a71a448d3d8474653e831749b8e71fcc', 'petugas', '1452518814.jpg'),
(8, 'irham', '94d72ffd8d33de4f486b795446cff440', 'admin', '1452517458.jpg');

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_pinjam`
--
CREATE TABLE IF NOT EXISTS `v_pinjam` (
`id_pinjam` int(6)
,`denda` int(9)
,`hari_deadline` varchar(11)
,`status` varchar(11)
,`NIS` int(11)
,`id_buku` int(9)
,`hari_pinjam` varchar(11)
,`hari_kembali` varchar(11)
,`jeneng_buku` varchar(50)
,`NISN` bigint(30)
,`nama` varchar(50)
);
-- --------------------------------------------------------

--
-- Struktur untuk view `v_pinjam`
--
DROP TABLE IF EXISTS `v_pinjam`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_pinjam` AS select `a`.`id_pinjam` AS `id_pinjam`,`a`.`denda` AS `denda`,`a`.`hari_deadline` AS `hari_deadline`,`a`.`status` AS `status`,`a`.`NIS` AS `NIS`,`a`.`id_buku` AS `id_buku`,`a`.`hari_pinjam` AS `hari_pinjam`,`a`.`hari_kembali` AS `hari_kembali`,`b`.`jeneng_buku` AS `jeneng_buku`,`c`.`NISN` AS `NISN`,`c`.`nama` AS `nama` from ((`pinjam` `a` join `buku` `b`) join `sia_fix`.`siswa` `c`) where ((`a`.`id_buku` = `b`.`id_buku`) and (`a`.`NIS` = `c`.`NIS`));

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD CONSTRAINT `karang1` FOREIGN KEY (`id_pengarang`) REFERENCES `pengarang` (`id_pengarang`),
  ADD CONSTRAINT `kat1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`),
  ADD CONSTRAINT `tah1` FOREIGN KEY (`id_tahun`) REFERENCES `tahun` (`id_tahun`);

--
-- Ketidakleluasaan untuk tabel `pinjam`
--
ALTER TABLE `pinjam`
  ADD CONSTRAINT `pinjam1` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id_buku`);

--
-- Ketidakleluasaan untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD CONSTRAINT `level1` FOREIGN KEY (`level`) REFERENCES `lvl` (`level`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
