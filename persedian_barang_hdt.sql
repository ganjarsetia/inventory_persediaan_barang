-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Waktu pembuatan: 04. Mei 2012 jam 21:25
-- Versi Server: 5.1.41
-- Versi PHP: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `persedian_barang_hdt`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admins`
--

CREATE TABLE IF NOT EXISTS `admins` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `nama_lengkap` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `level` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT 'user',
  `blokir` enum('Y','N') CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT 'N',
  `create` datetime DEFAULT NULL,
  `lastupdate` datetime DEFAULT NULL,
  `lastlogin` datetime DEFAULT NULL,
  `ipaddress` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`username`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `admins`
--

INSERT INTO `admins` (`username`, `password`, `nama_lengkap`, `level`, `blokir`, `create`, `lastupdate`, `lastlogin`, `ipaddress`) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrator', 'admin', 'N', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2012-05-04 21:13:14', '::1'),
('baakpsi', '5f4dcc3b5aa765d61d8327deb882cf99', 'baakpsi', 'user', 'N', '0000-00-00 00:00:00', '2012-05-04 15:28:31', '2012-05-04 16:30:42', '::1'),
('deddy', '8b509a9032c0160d358f61473b4f7c57', 'Deddy Rusdiansyah,S.Kom', 'admin', 'N', '0000-00-00 00:00:00', '2012-05-04 16:38:18', '2012-05-04 16:35:06', '::1'),
('hdt', '2ad202b4999db3676097a15e7a8d1982', 'help desk technology', 'admin', 'N', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', ''),
('udin', '6bec9c852847242e384a4d5ac0962ba0', 'Udin Sedunia', 'user', 'N', '0000-00-00 00:00:00', '2012-05-04 16:38:26', '2012-05-04 16:41:05', '::1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE IF NOT EXISTS `barang` (
  `kode_barang` char(15) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `satuan` char(10) NOT NULL,
  `harga_beli` bigint(20) NOT NULL,
  `harga_jual` bigint(20) NOT NULL,
  `stok_awal` int(11) NOT NULL,
  PRIMARY KEY (`kode_barang`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`kode_barang`, `nama_barang`, `satuan`, `harga_beli`, `harga_jual`, `stok_awal`) VALUES
('B001', 'Hardisk 40Gb', 'PCS', 230000, 250000, 5),
('B002', 'Hardisk 60Gb', 'PCS', 240000, 260000, 4),
('B003', 'Hardisk 80Gb', 'PCS', 250000, 270000, 7),
('B005', 'Keyboard PS2', 'PCS', 35000, 45000, 70),
('B006', 'Mouse PS2', 'PCS', 25000, 30000, 0),
('B007', 'Processor Dual Core', 'PCS', 1200000, 1400000, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembelian`
--

CREATE TABLE IF NOT EXISTS `pembelian` (
  `kode_beli` char(15) NOT NULL,
  `tgl_beli` date NOT NULL,
  `kode_supplier` char(5) NOT NULL,
  `kode_barang` char(15) NOT NULL,
  `jumlah_beli` int(11) NOT NULL,
  `harga_beli` bigint(20) NOT NULL,
  PRIMARY KEY (`kode_beli`,`kode_supplier`,`kode_barang`),
  KEY `kode_barang` (`kode_barang`),
  KEY `kode_supplier` (`kode_supplier`),
  KEY `kode_beli` (`kode_beli`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pembelian`
--

INSERT INTO `pembelian` (`kode_beli`, `tgl_beli`, `kode_supplier`, `kode_barang`, `jumlah_beli`, `harga_beli`) VALUES
('BL0001', '2012-05-01', 'SP001', 'B002', 5, 240000),
('BL0001', '2012-05-01', 'SP001', 'B005', 5, 35000),
('BL0002', '2012-05-01', 'SP002', 'B001', 2, 230000),
('BL0003', '2012-05-01', 'SP002', 'B002', 2, 240000),
('BL0003', '2012-05-01', 'SP002', 'B006', 10, 25000),
('BL0004', '2012-05-01', 'SP001', 'B001', 1, 230000),
('BL0005', '2012-05-01', 'SP001', 'B002', 2, 240000),
('BL0006', '2012-05-01', 'SP002', 'B003', 2, 250000),
('BL0007', '2012-05-01', 'SP001', 'B006', 3, 25000),
('BL0008', '2012-05-01', 'SP001', 'B001', 2, 230000),
('BL0008', '2012-05-01', 'SP001', 'B007', 2, 1200000),
('BL0009', '2012-05-02', 'SP001', 'B001', 2, 230000),
('BL0009', '2012-05-02', 'SP001', 'B002', 2, 240000),
('BL0009', '2012-05-02', 'SP001', 'B005', 2, 35000),
('BL0010', '2012-05-01', 'SP001', 'B002', 3, 240000),
('BL0011', '2012-05-01', 'SP002', 'B003', 2, 250000),
('BL0012', '2012-05-01', 'SP001', 'b002', 1, 240000),
('BL0013', '2012-05-03', 'SP001', 'B006', 2, 25000),
('BL0014', '2012-05-03', 'SP002', 'B002', 1, 240000),
('BL0015', '2012-05-03', 'SP001', 'B002', 2, 240000),
('BL0016', '2012-05-03', 'SP001', 'B005', 2, 35000),
('BL0017', '2012-05-03', 'SP002', 'B006', 4, 25000),
('BL0018', '2012-05-03', 'SP003', 'B006', 2, 25000),
('BL0019', '2012-05-03', 'SP003', 'B007', 3, 1200000),
('BL0020', '2012-05-03', 'SP003', 'B006', 5, 25000),
('BL0021', '2012-05-03', 'SP003', 'B005', 5, 35000),
('BL0022', '2012-05-03', 'SP002', 'B003', 9, 250000),
('BL0023', '2012-05-03', 'SP002', 'B006', 5, 25000),
('BL0024', '2012-05-03', 'SP001', 'B001', 2, 230000),
('BL0024', '2012-05-03', 'SP001', 'B002', 2, 240000),
('BL0025', '2012-05-03', 'SP003', 'B003', 2, 250000),
('BL0026', '2012-05-03', 'SP002', 'B002', 2, 240000),
('BL0027', '2012-05-03', 'SP001', 'B006', 2, 25000),
('BL0028', '2012-05-03', 'SP001', 'B005', 2, 35000),
('BL0029', '2012-05-03', 'SP003', 'B006', 5, 25000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjualan`
--

CREATE TABLE IF NOT EXISTS `penjualan` (
  `kode_jual` char(15) NOT NULL,
  `tgl_jual` date NOT NULL,
  `kode_barang` char(15) NOT NULL,
  `jumlah_jual` int(11) NOT NULL,
  `harga_jual` bigint(20) NOT NULL,
  `username` varchar(50) NOT NULL,
  PRIMARY KEY (`kode_jual`,`kode_barang`),
  KEY `kode_barang` (`kode_barang`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `penjualan`
--

INSERT INTO `penjualan` (`kode_jual`, `tgl_jual`, `kode_barang`, `jumlah_jual`, `harga_jual`, `username`) VALUES
('JL0001', '2012-05-04', 'B001', 2, 230000, 'admin'),
('JL0002', '2012-05-04', 'B001', 2, 230000, 'admin'),
('JL0002', '2012-05-04', 'B002', 2, 240000, 'admin'),
('JL0003', '2012-05-04', 'B003', 2, 250000, 'admin'),
('JL0004', '2012-05-04', 'B001', 2, 230000, 'admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `retur_pembelian`
--

CREATE TABLE IF NOT EXISTS `retur_pembelian` (
  `kode_retur` char(30) NOT NULL,
  `tgl_retur` date NOT NULL,
  `kode_beli` char(15) NOT NULL,
  `kode_barang` char(15) NOT NULL,
  `jumlah_retur` int(11) NOT NULL,
  PRIMARY KEY (`kode_retur`,`kode_beli`,`kode_barang`),
  KEY `kode_beli` (`kode_beli`),
  KEY `kode_barang` (`kode_barang`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `retur_pembelian`
--

INSERT INTO `retur_pembelian` (`kode_retur`, `tgl_retur`, `kode_beli`, `kode_barang`, `jumlah_retur`) VALUES
('01052012BL0001', '2012-05-01', 'BL0001', 'B002', 2),
('01052012BL0001', '2012-05-01', 'BL0001', 'B005', 3),
('03052012BL0023', '2012-05-03', 'BL0023', 'B006', 6);

-- --------------------------------------------------------

--
-- Struktur dari tabel `supplier`
--

CREATE TABLE IF NOT EXISTS `supplier` (
  `kode_supplier` char(5) NOT NULL DEFAULT '',
  `nama_supplier` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  PRIMARY KEY (`kode_supplier`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `supplier`
--

INSERT INTO `supplier` (`kode_supplier`, `nama_supplier`, `alamat`, `username`) VALUES
('SP001', 'Maju Terus,CV.', 'A.Yani 30 tes', 'admin'),
('SP002', 'Maju Mundur,CV.', 'A.Yani 31', 'admin'),
('SP003', 'Maju Lambat,PT.', 'A.Yani 32', 'admin'),
('SP004', 'Deddy', 'Tes', 'admin'),
('SP005', 'Jangan Dihapus', 'Nanti Error', 'admin'),
('SP006', 'Bantex', 'Dimana aja boleh', 'admin'),
('SP007', 'Coba lagi dong', 'biar mantap', 'admin');

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  ADD CONSTRAINT `pembelian_ibfk_1` FOREIGN KEY (`kode_barang`) REFERENCES `barang` (`kode_barang`),
  ADD CONSTRAINT `pembelian_ibfk_2` FOREIGN KEY (`kode_supplier`) REFERENCES `supplier` (`kode_supplier`);

--
-- Ketidakleluasaan untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  ADD CONSTRAINT `penjualan_ibfk_1` FOREIGN KEY (`kode_barang`) REFERENCES `barang` (`kode_barang`);

--
-- Ketidakleluasaan untuk tabel `retur_pembelian`
--
ALTER TABLE `retur_pembelian`
  ADD CONSTRAINT `retur_pembelian_ibfk_1` FOREIGN KEY (`kode_beli`) REFERENCES `pembelian` (`kode_beli`),
  ADD CONSTRAINT `retur_pembelian_ibfk_2` FOREIGN KEY (`kode_barang`) REFERENCES `barang` (`kode_barang`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
