-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 22 Bulan Mei 2023 pada 05.54
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sunday`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_chat`
--

CREATE TABLE `tb_chat` (
  `id_chat` int(11) NOT NULL,
  `id_penerima` varchar(20) DEFAULT NULL,
  `id_pengirim` varchar(20) DEFAULT NULL,
  `kode` varchar(50) DEFAULT NULL,
  `isi` text NOT NULL,
  `status` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `id_toko` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_modal`
--

CREATE TABLE `tb_modal` (
  `id_modal` int(11) NOT NULL,
  `tanggal_modal` date DEFAULT NULL,
  `keterangan_modal` text DEFAULT NULL,
  `jumlah_modal` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pegawai`
--

CREATE TABLE `tb_pegawai` (
  `id_pegawai` int(11) NOT NULL,
  `nama_pegawai` varchar(100) DEFAULT NULL,
  `alamat_pegawai` varchar(100) DEFAULT NULL,
  `nomor_pegawai` varchar(20) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `id_toko` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `tb_pegawai`
--

INSERT INTO `tb_pegawai` (`id_pegawai`, `nama_pegawai`, `alamat_pegawai`, `nomor_pegawai`, `username`, `id_toko`) VALUES
(8, 'ABAY', 'JL. BATAS KOTA', '082332122321', 'Sunfestbjbabay', 10),
(9, 'Bayu', 'Jl.asdf', '085775433123', 'Bjmbayu', 11);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pemasok`
--

CREATE TABLE `tb_pemasok` (
  `id_pemasok` int(11) NOT NULL,
  `nama_pemasok` varchar(100) DEFAULT NULL,
  `alamat_pemasok` varchar(100) DEFAULT NULL,
  `nomor_pemasok` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `tb_pemasok`
--

INSERT INTO `tb_pemasok` (`id_pemasok`, `nama_pemasok`, `alamat_pemasok`, `nomor_pemasok`) VALUES
(7, 'MINIMARKET', 'JL. PANGLIMA BATUR', '081223443221');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pembelian`
--

CREATE TABLE `tb_pembelian` (
  `id_pembelian` varchar(11) NOT NULL,
  `tanggal_pembelian` date NOT NULL,
  `keterangan_pembelian` text NOT NULL,
  `id_pemasok` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `tb_pembelian`
--

INSERT INTO `tb_pembelian` (`id_pembelian`, `tanggal_pembelian`, `keterangan_pembelian`, `id_pemasok`) VALUES
('PEM-0001', '2023-05-16', 'Secepatnya', 7);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pembelianbantu`
--

CREATE TABLE `tb_pembelianbantu` (
  `id_bantu` int(11) NOT NULL,
  `harga_pembelian` int(11) NOT NULL,
  `jumlah_pembelian` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `id_pembelian` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `tb_pembelianbantu`
--

INSERT INTO `tb_pembelianbantu` (`id_bantu`, `harga_pembelian`, `jumlah_pembelian`, `id_produk`, `id_pembelian`) VALUES
(30, 21000, 50, 10, 'PEM-0001');

--
-- Trigger `tb_pembelianbantu`
--
DELIMITER $$
CREATE TRIGGER `penjualan-hapus_copy1` AFTER DELETE ON `tb_pembelianbantu` FOR EACH ROW UPDATE tb_produk SET stok_produk = stok_produk - OLD.jumlah_pembelian
     WHERE id_produk = OLD.id_produk
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `penjualan-tambah_copy1` AFTER UPDATE ON `tb_pembelianbantu` FOR EACH ROW UPDATE tb_produk SET stok_produk = stok_produk + new.jumlah_pembelian
     WHERE id_produk = new.id_produk
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pengantaran`
--

CREATE TABLE `tb_pengantaran` (
  `id_pengantaran` int(11) NOT NULL,
  `tanggal_pengantaran` date DEFAULT NULL,
  `keterangan_pengantaran` text DEFAULT NULL,
  `id_penjualan` varchar(11) DEFAULT NULL,
  `id_pegawai` int(11) DEFAULT NULL,
  `status_pengantaran` enum('Pengantaran','Selesai') DEFAULT 'Pengantaran'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Trigger `tb_pengantaran`
--
DELIMITER $$
CREATE TRIGGER `peng-hapus` AFTER DELETE ON `tb_pengantaran` FOR EACH ROW UPDATE tb_penjualan SET status = 'Setuju'
     WHERE id_penjualan = OLD.id_penjualan
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `peng-tambah` AFTER INSERT ON `tb_pengantaran` FOR EACH ROW UPDATE tb_penjualan SET status = 'Selesai' WHERE id_penjualan = new.id_penjualan
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `pengantraan - hapus` AFTER DELETE ON `tb_pengantaran` FOR EACH ROW UPDATE tb_pegawai SET status = 'Kosong' WHERE id_pegawai = OLD.id_pegawai
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `pengantraan - tambah` AFTER INSERT ON `tb_pengantaran` FOR EACH ROW UPDATE tb_pegawai SET status = 'Antar' WHERE id_pegawai = new.id_pegawai
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `pengantraan - ubah` AFTER UPDATE ON `tb_pengantaran` FOR EACH ROW UPDATE tb_pegawai SET status = 'Kosong' WHERE id_pegawai = OLD.id_pegawai
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pengaturan`
--

CREATE TABLE `tb_pengaturan` (
  `id_pengaturan` int(11) NOT NULL,
  `nama_pengaturan` varchar(100) NOT NULL,
  `ttd` text DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `tb_pengaturan`
--

INSERT INTO `tb_pengaturan` (`id_pengaturan`, `nama_pengaturan`, `ttd`, `status`) VALUES
(1, 'ANSHARI', '1658427328395ttd.png', 'pemilik');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pengguna`
--

CREATE TABLE `tb_pengguna` (
  `id_pengguna` int(11) NOT NULL,
  `nama_lengkap` varchar(100) DEFAULT NULL,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL,
  `level` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `tb_pengguna`
--

INSERT INTO `tb_pengguna` (`id_pengguna`, `nama_lengkap`, `username`, `password`, `level`) VALUES
(2, 'Admin', 'admin', 'admin', 'Admin'),
(10, 'Pemilik', 'pemilik', 'pemilik', 'Pemilik'),
(33, 'ABAY', 'sunfestbjbabay', 'sunfestbjbabay', 'Toko'),
(34, 'Bayu', 'bjmbayu', 'bjmbayu', 'Toko');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_penjualan`
--

CREATE TABLE `tb_penjualan` (
  `id_penjualan` varchar(11) NOT NULL,
  `tanggal_penjualan` date NOT NULL,
  `keterangan_penjualan` text NOT NULL,
  `id_toko` int(11) DEFAULT NULL,
  `status` enum('Setuju','Selesai','Minta Pengantaran') DEFAULT 'Setuju',
  `nama_pegawai` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `tb_penjualan`
--

INSERT INTO `tb_penjualan` (`id_penjualan`, `tanggal_penjualan`, `keterangan_penjualan`, `id_toko`, `status`, `nama_pegawai`) VALUES
('PEN-0001', '2023-05-16', 'GAS', 10, 'Selesai', 'ABAY'),
('PEN-0002', '2023-05-17', 'CLOP', 10, 'Selesai', 'ABAY');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_penjualanbantu`
--

CREATE TABLE `tb_penjualanbantu` (
  `id_bantu` int(11) NOT NULL,
  `harga_penjualan` int(11) NOT NULL,
  `jumlah_penjualan` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `id_penjualan` varchar(11) NOT NULL,
  `id_toko` int(11) DEFAULT NULL,
  `status_penjualan` enum('0','1') DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `tb_penjualanbantu`
--

INSERT INTO `tb_penjualanbantu` (`id_bantu`, `harga_penjualan`, `jumlah_penjualan`, `id_produk`, `id_penjualan`, `id_toko`, `status_penjualan`) VALUES
(34, 30000, 10, 9, 'PEN-0001', 10, '1'),
(35, 30000, 5, 8, 'PEN-0002', 10, '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_permintaan`
--

CREATE TABLE `tb_permintaan` (
  `id_permintaan` varchar(10) NOT NULL,
  `tanggal_permintaan` date DEFAULT NULL,
  `keterangan_permintaan` text DEFAULT NULL,
  `id_toko` int(11) DEFAULT NULL,
  `status` enum('Permintaan','Setuju','Tidak Setuju','Di Terima') DEFAULT 'Permintaan',
  `alasan` text DEFAULT NULL,
  `nama_pegawai` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `tb_permintaan`
--

INSERT INTO `tb_permintaan` (`id_permintaan`, `tanggal_permintaan`, `keterangan_permintaan`, `id_toko`, `status`, `alasan`, `nama_pegawai`) VALUES
('MIN-0001', '2023-05-16', 'TOLONG CEPAT', 10, 'Tidak Setuju', 'tidak ready\r\n', 'ABAY'),
('MIN-0002', '2023-05-16', 'GOGO', 10, 'Di Terima', '-', 'ABAY'),
('MIN-0003', '2023-05-16', 'GO', 10, 'Di Terima', '-', 'ABAY'),
('MIN-0004', '2023-05-16', 'GO', 10, 'Di Terima', '-', 'ABAY'),
('MIN-0005', '2023-05-17', 'GO', 10, 'Di Terima', '-', 'ABAY'),
('MIN-0006', '2023-05-22', 'ASD', 11, 'Di Terima', '-', 'Bayu'),
('MIN-0007', '2023-05-22', 'ASD', 11, 'Di Terima', '-', 'Bayu'),
('MIN-0008', '2023-05-22', 'AAAA', 11, 'Di Terima', '-', 'Bayu');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_permintaanbantu`
--

CREATE TABLE `tb_permintaanbantu` (
  `id_bantu` int(11) NOT NULL,
  `jumlah_permintaan` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `id_permintaan` varchar(11) NOT NULL,
  `status` enum('Permintaan','Setuju','Tidak Setuju','Di Terima') DEFAULT 'Permintaan'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `tb_permintaanbantu`
--

INSERT INTO `tb_permintaanbantu` (`id_bantu`, `jumlah_permintaan`, `id_produk`, `id_permintaan`, `status`) VALUES
(53, 10, 8, 'MIN-0001', 'Tidak Setuju'),
(54, 10, 9, 'MIN-0002', 'Di Terima'),
(55, 10, 8, 'MIN-0002', 'Tidak Setuju'),
(56, 10, 10, 'MIN-0003', 'Di Terima'),
(57, 10, 10, 'MIN-0004', 'Di Terima'),
(58, 10, 11, 'MIN-0004', 'Tidak Setuju'),
(59, 10, 8, 'MIN-0005', 'Di Terima'),
(60, 10, 10, 'MIN-0005', 'Tidak Setuju'),
(61, 10, 8, 'MIN-0006', 'Di Terima'),
(62, 5, 8, 'MIN-0007', 'Di Terima'),
(63, 10, 11, 'MIN-0007', 'Di Terima'),
(64, 10, 10, 'MIN-0008', 'Di Terima'),
(65, 10, 11, 'MIN-0008', 'Tidak Setuju');

--
-- Trigger `tb_permintaanbantu`
--
DELIMITER $$
CREATE TRIGGER `penjualan-hapus_copy2` AFTER DELETE ON `tb_permintaanbantu` FOR EACH ROW BEGIN
	 IF ((OLD.status='Di Terima')) THEN
UPDATE tb_produk SET stok_produk = stok_produk + OLD.jumlah_permintaan
WHERE id_produk = OLD.id_produk;
     END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `permintaan-ubah` AFTER UPDATE ON `tb_permintaanbantu` FOR EACH ROW BEGIN
IF (new.status='Di Terima') THEN
UPDATE tb_produk SET stok_produk = stok_produk - new.jumlah_permintaan
WHERE id_produk = new.id_produk;
END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_produk`
--

CREATE TABLE `tb_produk` (
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `harga_pembelian` int(11) NOT NULL,
  `harga_penjualan` int(11) DEFAULT NULL,
  `stok_produk` int(11) NOT NULL,
  `file1` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `tb_produk`
--

INSERT INTO `tb_produk` (`id_produk`, `nama_produk`, `harga_pembelian`, `harga_penjualan`, `stok_produk`, `file1`) VALUES
(8, 'KALENG LOW SUNFEST', 16000, 30000, 5, '1684211459255.jpg'),
(9, 'KALENG LOW CREME BRULEE', 16000, 30000, 0, '1684211481853.jpg'),
(10, 'KALENG MATCHA', 21000, 35000, 30, '1684211501430.jpg'),
(11, 'KALENG RED VELVET', 21000, 35000, 10, '1684211517414.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_toko`
--

CREATE TABLE `tb_toko` (
  `id_toko` int(11) NOT NULL,
  `nama_toko` varchar(100) DEFAULT NULL,
  `alamat_toko` varchar(100) DEFAULT NULL,
  `nomor_toko` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `tb_toko`
--

INSERT INTO `tb_toko` (`id_toko`, `nama_toko`, `alamat_toko`, `nomor_toko`) VALUES
(10, 'SUNDAY FESTIVAL BANJARBARU', 'JL. MINGGU RAYA', '085775377657'),
(11, 'SUNDAY FESTIVAL BANJARMASIN', 'JL. PAL 5', '081349667341'),
(12, 'SUNDAY FESTIVAL PELAIHARI', 'JL. A YANI', '085775345733'),
(13, 'SUNDAY FESTIVAL KOTALAMA', 'JL. TEMPOE DOLOE', '085773232332');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_chat`
--
ALTER TABLE `tb_chat`
  ADD PRIMARY KEY (`id_chat`) USING BTREE;

--
-- Indeks untuk tabel `tb_modal`
--
ALTER TABLE `tb_modal`
  ADD PRIMARY KEY (`id_modal`) USING BTREE;

--
-- Indeks untuk tabel `tb_pegawai`
--
ALTER TABLE `tb_pegawai`
  ADD PRIMARY KEY (`id_pegawai`) USING BTREE,
  ADD KEY `id_toko` (`id_toko`);

--
-- Indeks untuk tabel `tb_pemasok`
--
ALTER TABLE `tb_pemasok`
  ADD PRIMARY KEY (`id_pemasok`) USING BTREE;

--
-- Indeks untuk tabel `tb_pembelian`
--
ALTER TABLE `tb_pembelian`
  ADD PRIMARY KEY (`id_pembelian`) USING BTREE,
  ADD KEY `id_pemasok` (`id_pemasok`) USING BTREE;

--
-- Indeks untuk tabel `tb_pembelianbantu`
--
ALTER TABLE `tb_pembelianbantu`
  ADD PRIMARY KEY (`id_bantu`) USING BTREE,
  ADD KEY `id_produk` (`id_produk`) USING BTREE,
  ADD KEY `id_pembelian` (`id_pembelian`) USING BTREE;

--
-- Indeks untuk tabel `tb_pengantaran`
--
ALTER TABLE `tb_pengantaran`
  ADD PRIMARY KEY (`id_pengantaran`) USING BTREE,
  ADD KEY `id_penjualan` (`id_penjualan`) USING BTREE,
  ADD KEY `id_pegawai` (`id_pegawai`) USING BTREE;

--
-- Indeks untuk tabel `tb_pengaturan`
--
ALTER TABLE `tb_pengaturan`
  ADD PRIMARY KEY (`id_pengaturan`) USING BTREE;

--
-- Indeks untuk tabel `tb_pengguna`
--
ALTER TABLE `tb_pengguna`
  ADD PRIMARY KEY (`id_pengguna`) USING BTREE,
  ADD UNIQUE KEY `username` (`username`) USING BTREE;

--
-- Indeks untuk tabel `tb_penjualan`
--
ALTER TABLE `tb_penjualan`
  ADD PRIMARY KEY (`id_penjualan`) USING BTREE,
  ADD KEY `id_toko` (`id_toko`) USING BTREE;

--
-- Indeks untuk tabel `tb_penjualanbantu`
--
ALTER TABLE `tb_penjualanbantu`
  ADD PRIMARY KEY (`id_bantu`) USING BTREE,
  ADD KEY `id_produk` (`id_produk`) USING BTREE,
  ADD KEY `id_penjualan` (`id_penjualan`) USING BTREE;

--
-- Indeks untuk tabel `tb_permintaan`
--
ALTER TABLE `tb_permintaan`
  ADD PRIMARY KEY (`id_permintaan`) USING BTREE,
  ADD KEY `id_toko` (`id_toko`) USING BTREE;

--
-- Indeks untuk tabel `tb_permintaanbantu`
--
ALTER TABLE `tb_permintaanbantu`
  ADD PRIMARY KEY (`id_bantu`) USING BTREE,
  ADD KEY `id_produk` (`id_produk`) USING BTREE,
  ADD KEY `id_penjualan` (`id_permintaan`) USING BTREE;

--
-- Indeks untuk tabel `tb_produk`
--
ALTER TABLE `tb_produk`
  ADD PRIMARY KEY (`id_produk`) USING BTREE;

--
-- Indeks untuk tabel `tb_toko`
--
ALTER TABLE `tb_toko`
  ADD PRIMARY KEY (`id_toko`) USING BTREE;

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_chat`
--
ALTER TABLE `tb_chat`
  MODIFY `id_chat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_modal`
--
ALTER TABLE `tb_modal`
  MODIFY `id_modal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tb_pegawai`
--
ALTER TABLE `tb_pegawai`
  MODIFY `id_pegawai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `tb_pemasok`
--
ALTER TABLE `tb_pemasok`
  MODIFY `id_pemasok` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tb_pembelianbantu`
--
ALTER TABLE `tb_pembelianbantu`
  MODIFY `id_bantu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT untuk tabel `tb_pengantaran`
--
ALTER TABLE `tb_pengantaran`
  MODIFY `id_pengantaran` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_pengaturan`
--
ALTER TABLE `tb_pengaturan`
  MODIFY `id_pengaturan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_pengguna`
--
ALTER TABLE `tb_pengguna`
  MODIFY `id_pengguna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT untuk tabel `tb_penjualanbantu`
--
ALTER TABLE `tb_penjualanbantu`
  MODIFY `id_bantu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT untuk tabel `tb_permintaanbantu`
--
ALTER TABLE `tb_permintaanbantu`
  MODIFY `id_bantu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT untuk tabel `tb_produk`
--
ALTER TABLE `tb_produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `tb_toko`
--
ALTER TABLE `tb_toko`
  MODIFY `id_toko` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_pegawai`
--
ALTER TABLE `tb_pegawai`
  ADD CONSTRAINT `tb_pegawai_ibfk_1` FOREIGN KEY (`id_toko`) REFERENCES `tb_toko` (`id_toko`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_pembelian`
--
ALTER TABLE `tb_pembelian`
  ADD CONSTRAINT `tb_pembelian_ibfk_1` FOREIGN KEY (`id_pemasok`) REFERENCES `tb_pemasok` (`id_pemasok`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_pembelianbantu`
--
ALTER TABLE `tb_pembelianbantu`
  ADD CONSTRAINT `tb_pembelianbantu_ibfk_1` FOREIGN KEY (`id_produk`) REFERENCES `tb_produk` (`id_produk`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_pengantaran`
--
ALTER TABLE `tb_pengantaran`
  ADD CONSTRAINT `tb_pengantaran_ibfk_1` FOREIGN KEY (`id_penjualan`) REFERENCES `tb_penjualan` (`id_penjualan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_pengantaran_ibfk_2` FOREIGN KEY (`id_pegawai`) REFERENCES `tb_pegawai` (`id_pegawai`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_penjualan`
--
ALTER TABLE `tb_penjualan`
  ADD CONSTRAINT `tb_penjualan_ibfk_2` FOREIGN KEY (`id_toko`) REFERENCES `tb_toko` (`id_toko`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_penjualanbantu`
--
ALTER TABLE `tb_penjualanbantu`
  ADD CONSTRAINT `tb_penjualanbantu_ibfk_1` FOREIGN KEY (`id_produk`) REFERENCES `tb_produk` (`id_produk`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_permintaan`
--
ALTER TABLE `tb_permintaan`
  ADD CONSTRAINT `tb_permintaan_ibfk_1` FOREIGN KEY (`id_toko`) REFERENCES `tb_toko` (`id_toko`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_permintaanbantu`
--
ALTER TABLE `tb_permintaanbantu`
  ADD CONSTRAINT `tb_permintaanbantu_ibfk_1` FOREIGN KEY (`id_produk`) REFERENCES `tb_produk` (`id_produk`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
