-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 29 Okt 2026 pada 01.44
-- Versi server: 10.4.6-MariaDB
-- Versi PHP: 8.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `violla_sipn`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `guru`
--

CREATE TABLE `guru` (
  `id` int(11) NOT NULL,
  `nip` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `guru`
--

INSERT INTO `guru` (`id`, `nip`, `nama`, `jenis_kelamin`, `user_id`) VALUES
(8, '15161829399', 'Irmawati S.Pd', 'P', 708121),
(10, '63652189397', 'Sania Riska S.Kom', 'P', 708149);

-- --------------------------------------------------------

--
-- Struktur dari tabel `mapel`
--

CREATE TABLE `mapel` (
  `id` int(11) NOT NULL,
  `kode_mapel` varchar(10) NOT NULL,
  `nama_mapel` varchar(100) NOT NULL,
  `guru_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `mengajar`
--

CREATE TABLE `mengajar` (
  `id` int(11) NOT NULL,
  `mapel_id` int(11) NOT NULL,
  `siswa_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai_rapor`
--

CREATE TABLE `nilai_rapor` (
  `id` int(11) NOT NULL,
  `siswa_id` int(11) NOT NULL,
  `mapel_id` int(11) NOT NULL,
  `nilai_kkm` int(11) NOT NULL,
  `nilai_pengetahuan` int(11) NOT NULL,
  `nilai_keterampilan` int(11) NOT NULL,
  `Keterangan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa`
--

CREATE TABLE `siswa` (
  `id` int(11) NOT NULL,
  `nis` varchar(10) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `kelas` varchar(10) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `siswa`
--

INSERT INTO `siswa` (`id`, `nis`, `nama`, `kelas`, `jenis_kelamin`, `user_id`) VALUES
(11, '10092466', 'Violla Fawziya ', 'XI RPL 4', 'P', 708116),
(12, '83631627', 'Luthfi', 'XI RPL 4', 'L', 708117),
(13, '10092466', 'Annisa Sally', 'XI RPL 3', 'P', 708120),
(14, '672838399', 'Elnino Romadhona', 'X RPL 7', 'L', 708124),
(17, '178363849', 'Richi Aldira', 'XI RPL 2', 'L', 708127),
(18, '232163780', 'Leny Fatmawati', 'X RPL 1', 'P', 708128),
(19, '15637882', 'Nayla Oktaviani', 'X RPL 5', 'P', 708129),
(20, '56373783', 'Alya Fahimah', 'XII RPL 6', 'P', 708145),
(21, '36484027', 'Naura Azzahra', 'X PPLG 1', 'P', 708146),
(22, '12536383', 'M.Putra aditia', 'XII RPL 3', 'L', 708147),
(23, '16011521', 'Reyhan Paiz', 'XI RPL 2', 'L', 708148);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','guru','siswa') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `created_at`) VALUES
(708110, 'Rivansa02', '$2y$10$nyT5T5tECLvVMQlBdv/B3O5KwEIiEMohdU4VHLkr5JO9icOdGLyWC', 'guru', '2026-10-26 11:08:43'),
(708116, 'Violla12', '$2y$10$gcIIQC0e91zPlVD1njQ9f.09jWt67Ixqsz.Y32L4HucxyYqrBE6Qe', 'siswa', '2026-10-08 05:33:19'),
(708117, 'Luthfi22', '$2y$10$JNQjD20tsSki1pPcGGdos.1Oi9H31VB9sywfG2Ov6/yDQie/EVTVW', 'siswa', '2026-10-08 06:45:56'),
(708118, 'Dhea17', '$2y$10$9.0872.mCPw6Yo4PjRlVv.a/yEpLfxnfeyBu530CMqMvK7Dl7owGe', 'admin', '2026-10-08 06:45:27'),
(708119, 'Mayang22', '$2y$10$PhwjAco1T5aD1BCufJGqYuhtfW4A2HfnQztFS/E8HuWe4a4uqLmPG', 'admin', '2026-10-15 04:29:00'),
(708120, 'Annisa17', '$2y$10$/lC9JdWpVgD2CVo81tVtnuJrPqRFlgF0zB4Wk6bFxDUUoLrZ3RAmm', 'siswa', '2026-10-15 04:29:29'),
(708121, 'Irma13', '$2y$10$TDq0JxwNaK/ZH4DskrbKp.Xx0zO/sLOGDnaTOUFaI3Hu0QdIBzgkW', 'guru', '2026-10-26 12:47:56'),
(708124, 'Elnino01', '$2y$10$wT5Q84YhNR4HERkzcqcPe.WY10JvQkaFBzH4ON9hgZqWQUUSh7aDO', 'siswa', '2026-10-26 11:40:04'),
(708127, 'Richi04', '$2y$10$oM26/Bx2ukywOz7CbYuvQ.HlaGju84Nhw5arZx8gjijT1FcDQluPa', 'siswa', '2026-10-26 12:16:16'),
(708128, 'Leny06', '$2y$10$M9XYjmaOfp4W1dEdunVcg.SvdVTupLfWSqi1L7xAvPorfaClf.PC2', 'siswa', '2026-10-28 13:08:44'),
(708129, 'Nayla06', '$2y$10$YR0y.MChSxBfqFUw5SP2MOQHPyVXk6PlgiNNPbyL0n3i5V2bJOX1q', 'siswa', '2026-10-26 12:24:01'),
(708144, 'Dea44', '$2y$10$hGKAK.3DC4wmeJTZzMYAR.81Sof1/ZhVmL9QFvI2rU.BBIhwXr6We', 'siswa', '2026-10-27 00:17:04'),
(708145, 'Alya77', '$2y$10$pY49fXTvFkEvjJwhPsrEUuwQVdssWhHX4OBysRFzy.Ych/JOVBOLy', 'siswa', '2026-10-27 00:21:21'),
(708146, 'Naura26', '$2y$10$2xqYgiBHT4Mc3Tc7ZMeSwODYiTg3MDir/NnwGQODgj6d1zDRyuV.W', 'siswa', '2026-10-28 00:12:55'),
(708147, 'Putra99', '$2y$10$mpwo9ZqkloUxQIT9Wpf5kuD3BiQ5eUdR9nYt7vov3oOPWXsbHu4Eu', 'siswa', '2026-10-28 00:46:56'),
(708148, 'Reyhan16', '$2y$10$SwxBd5Wn3c/Ba4v6Xg6WKefRZTbIEPhYhXq6FQk59gxCvuY4oQYdO', 'siswa', '2026-10-28 00:48:20'),
(708149, 'Nia44', '$2y$10$.FdfkQyjpa4RKwDSw.ruz.I0F9oJmr8rKAhjbCFcZhPenglR.iunG', 'guru', '2026-10-28 00:49:59');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `mapel`
--
ALTER TABLE `mapel`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `mengajar`
--
ALTER TABLE `mengajar`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `nilai_rapor`
--
ALTER TABLE `nilai_rapor`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `guru`
--
ALTER TABLE `guru`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `mapel`
--
ALTER TABLE `mapel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `mengajar`
--
ALTER TABLE `mengajar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `nilai_rapor`
--
ALTER TABLE `nilai_rapor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=708150;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
