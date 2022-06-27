-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 24 Jun 2022 pada 14.42
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uaspweb2022`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `obat`
--

CREATE TABLE `obat` (
  `id_obat` int(15) NOT NULL,
  `nama_obat` varchar(15) DEFAULT NULL,
  `dosis` varchar(30) DEFAULT NULL,
  `stok` int(15) DEFAULT NULL,
  `komposisi` varchar(225) DEFAULT NULL,
  `tgl_kadaluwarsa` date DEFAULT NULL,
  `kegunaan` text DEFAULT NULL,
  `harga_obat` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `obat`
--

INSERT INTO `obat` (`id_obat`, `nama_obat`, `dosis`, `stok`, `komposisi`, `tgl_kadaluwarsa`, `kegunaan`, `harga_obat`) VALUES
(12631, 'Vicks Formula 4', 'Gunakan setiap 4 jam sesuai ke', 19, 'Setiap 5ml mengandung: Dextromethrophan Hydrobromide 5mg Doxylamine Succinate 2mg', '2025-09-28', 'Meredakan batuk tidak berdahak, bersin-bersin, alergi dan memberikan rasa hangat di tenggorokan', 'Rp.22000'),
(12632, 'Paramex', 'Dewasa dan anak-anak diatas 12', 20, 'Mengandung 250 mg paracetamol, 150 mg propifenazon, 50 mg kafein, dan 1 mg dexchlorpheniramine maleate', '2025-03-03', 'Meringankan sakit kepala dan sakit gigi', 'Rp.5000'),
(12633, 'Paracetamol 500', 'Dewasa: 1-2 kaplet, 3-4 kali p', 25, 'Setiap tablet mengandung Paracetamol 500 mg', '2025-04-07', 'Meredakan nyeri ringan hingga sedang seperti sakit kepala, sakit gigi, nyeri otot, serta menurunkan demam', 'Rp.5000'),
(12634, 'Lanakeloid-E Cr', '1-2 kali sehari', 18, 'Centella Asiatica Phytosome 1 %, vit.E 0.2 %', '2024-04-08', 'Membantu proses penyembuhan luka bakar ringan', 'Rp.120000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `nama_pelanggan` varchar(50) DEFAULT NULL,
  `jenis_kelamin` varchar(50) DEFAULT NULL,
  `telepon` varchar(15) DEFAULT NULL,
  `umur` int(3) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `alamat` varchar(200) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nama_pelanggan`, `jenis_kelamin`, `telepon`, `umur`, `tanggal_lahir`, `alamat`, `username`, `password`) VALUES
(13451, 'Nur Laila', 'Perempuan', '082283967780', 20, '2002-03-03', 'Indragiri Hilir', 'laila18', 'laila123'),
(13452, 'apis', 'laki laki', '0895618290', 20, '2002-03-02', 'Pekanbaru', 'apis12', 'apis13');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `id_obat` int(11) NOT NULL,
  `jumlah_obat` varchar(50) DEFAULT NULL,
  `tgl_transaksi` date DEFAULT NULL,
  `harga_obat` varchar(50) NOT NULL,
  `total_harga` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_pelanggan`, `id_obat`, `jumlah_obat`, `tgl_transaksi`, `harga_obat`, `total_harga`) VALUES
(6782, 13452, 12632, '1', '2022-06-23', 'Rp.5000', 'Rp.5000');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`id_obat`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`,`id_pelanggan`,`id_obat`),
  ADD KEY `id_obat` (`id_obat`),
  ADD KEY `id_pelanggan` (`id_pelanggan`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `obat`
--
ALTER TABLE `obat`
  MODIFY `id_obat` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12635;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_obat`) REFERENCES `obat` (`id_obat`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
