-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Agu 2024 pada 09.09
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `accesstrack`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `login`
--

INSERT INTO `login` (`id`, `email`, `password`) VALUES
(1, 'user1@example.com', 'password123'),
(2, 'user2@example.com', 'password456');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id` int(11) NOT NULL,
  `nim` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `mahasiswa`
--

INSERT INTO `mahasiswa` (`id`, `nim`, `nama`) VALUES
(1, '7111211250', 'LIBORA CARMELITA'),
(2, '7111211249', 'MUHAMMAD RIZQI ADITAMA'),
(3, '7111211248', 'DENISHA AFTANIA HAFIZA'),
(4, '7111211247', 'SESILIA AZZAHRA'),
(5, '7111211246', 'AJENG WIDIA INTAN CERELIA'),
(6, '7111211250', 'LIBORA CARMELITA'),
(7, '7111211249', 'MUHAMMAD RIZQI ADITAMA'),
(8, '7111211248', 'DENISHA AFTANIA HAFIZA'),
(9, '7111211247', 'SESILIA AZZAHRA'),
(10, '7111211246', 'AJENG WIDIA INTAN CERELIA'),
(11, '7111211245', 'BUDI SANTOSO'),
(12, '7111211244', 'RINA AMALIA'),
(13, '7111211243', 'ANDI PUTRA'),
(14, '7111211242', 'DEWI LESTARI'),
(15, '7111211241', 'JOKO SUKAMTO'),
(16, '7111211240', 'SITI AMINAH'),
(17, '7111211239', 'AGUS SALIM'),
(18, '7111211238', 'YANI RAHMAWATI'),
(19, '7111211237', 'FIKRI MAULANA'),
(20, '7111211236', 'LINA WIDYAWATI'),
(21, '7111211235', 'WAWAN KURNIAWAN'),
(22, '7111211234', 'IRMA HANDAYANI'),
(23, '7111211233', 'RIKI RAMADHAN'),
(24, '7111211232', 'TIARA PERMATA'),
(25, '7111211231', 'FERDIANSYAH PRATAMA');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawai`
--

CREATE TABLE `pegawai` (
  `id` int(11) NOT NULL,
  `nip_nid` varchar(20) NOT NULL,
  `nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pegawai`
--

INSERT INTO `pegawai` (`id`, `nip_nid`, `nama`) VALUES
(1, '412109765', 'Prof. Hikmahanto Juwana S.H., LL.M., Ph.D.'),
(2, '412150674', 'Dewi Ratih Handayani dr., M.Kes.'),
(3, '412155478', 'Prof. Dr. Agus Subagyo S.I.P., M.Si.'),
(4, '412159746', 'Dra. Indrya Ami Ruliyati Darsono M.A.'),
(5, '412152671', 'Dr. Asep Kurniawan S.E., M.T., M.I.P., ASCA., CIBA.');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelaporan_csirt`
--

CREATE TABLE `pelaporan_csirt` (
  `id_laporan` int(11) NOT NULL,
  `id_pengguna` int(11) NOT NULL,
  `tanggal_laporan` date NOT NULL,
  `namaWebsite` varchar(255) NOT NULL,
  `deskripsi_insiden` text NOT NULL,
  `status_laporan` enum('Belum Diproses','Sedang Diproses','Selesai') DEFAULT 'Belum Diproses',
  `kategori_insiden` varchar(255) DEFAULT NULL,
  `lampiran` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pelaporan_csirt`
--

INSERT INTO `pelaporan_csirt` (`id_laporan`, `id_pengguna`, `tanggal_laporan`, `namaWebsite`, `deskripsi_insiden`, `status_laporan`, `kategori_insiden`, `lampiran`) VALUES
(1, 1, '2024-08-16', 'www.contohwebsite.com', 'Terjadi downtime pada website utama.', 'Belum Diproses', 'Downtime', 'lampiran1.pdf'),
(2, 2, '2024-08-17', 'www.websitehacked.com', 'Terdeteksi aktivitas hacking pada server.', 'Sedang Diproses', 'Hacking', 'lampiran2.pdf');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengajuan_email`
--

CREATE TABLE `pengajuan_email` (
  `id` int(11) NOT NULL,
  `nim` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `prodi` varchar(100) NOT NULL,
  `email_diajukan` varchar(100) NOT NULL,
  `email_pengguna` varchar(100) NOT NULL,
  `ktm` varchar(255) NOT NULL,
  `tgl_pengajuan` date NOT NULL,
  `status_pengajuan` enum('Pending','Approved','Rejected') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengajuan_ka`
--

CREATE TABLE `pengajuan_ka` (
  `id_KA` int(11) NOT NULL,
  `id_pengguna` int(11) NOT NULL,
  `id_pengajuan` int(11) NOT NULL,
  `kwitansi` varchar(255) DEFAULT NULL,
  `Date` date DEFAULT NULL,
  `ketPengajuan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pengajuan_ka`
--

INSERT INTO `pengajuan_ka` (`id_KA`, `id_pengguna`, `id_pengajuan`, `kwitansi`, `Date`, `ketPengajuan`) VALUES
(1, 1, 101, 'KW12345', '2024-08-16', 'Pengajuan untuk akses ke area XYZ'),
(2, 2, 102, 'KW12346', '2024-08-17', 'Pengajuan untuk akses ke area ABC');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pelaporan_csirt`
--
ALTER TABLE `pelaporan_csirt`
  ADD PRIMARY KEY (`id_laporan`);

--
-- Indeks untuk tabel `pengajuan_email`
--
ALTER TABLE `pengajuan_email`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pengajuan_ka`
--
ALTER TABLE `pengajuan_ka`
  ADD PRIMARY KEY (`id_KA`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `pelaporan_csirt`
--
ALTER TABLE `pelaporan_csirt`
  MODIFY `id_laporan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `pengajuan_email`
--
ALTER TABLE `pengajuan_email`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pengajuan_ka`
--
ALTER TABLE `pengajuan_ka`
  MODIFY `id_KA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
