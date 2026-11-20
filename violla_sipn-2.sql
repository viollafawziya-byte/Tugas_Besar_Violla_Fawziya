-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 20 Nov 2026 pada 14.11
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
(8, '1516182939', 'Irmawati S.Pd', 'P', 708121),
(10, '6365218939', 'Sania Riska S.Kom', 'P', 708149),
(11, '3225273773', 'Ahmad Setiawan S.pd', 'L', 708150),
(12, '3352728297', 'Mutiara Zahra,S.pd.,Gr.,S.h.', 'P', 708151),
(13, '5363738869', 'Gevin Sandra S.pd', 'L', 708152),
(14, '2637282871', 'Suci Sulastri S.kom,Gr.', 'P', 708153),
(15, '2252625372', 'Vinkan Regina Pramesta, S.pd', 'P', 708157),
(16, '1254789056', 'Rifki Ahmad S.pd', 'L', 708158),
(17, '2345187903', 'Sukanda Wiguna, S.T.Gr.', 'L', 708159),
(18, '1674568399', 'Fauziah Nur Alifah, S.pd.,Gr.', 'P', 708160),
(19, '2236789450', 'Dudi Haryadi, S.pd', 'L', 708161),
(20, '3252829278', 'Siti Darajat, S.pd.,Gr', 'P', 708162),
(21, '2345272868', 'Eni Karyuniati, S.pd', 'P', 708163),
(22, '1232116780', 'Sri Umi Madiasih, S.pd, M.pd', 'P', 708165),
(23, '1637089203', 'M. Abu Darin, S.Ag', 'L', 708166),
(24, '1125262828', 'Nazwa S.pd', 'P', 708170);

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

--
-- Dumping data untuk tabel `mapel`
--

INSERT INTO `mapel` (`id`, `kode_mapel`, `nama_mapel`, `guru_id`) VALUES
(1, 'MP001', 'Pemograman', 10),
(3, 'MP002', 'Pemograman', 8),
(4, 'MP003', 'Bahasa Inggris', 11),
(5, 'MP004', 'Desain Grafis', 12),
(6, 'MP005', 'Basis Data', 14),
(7, 'MP006', 'Matematika', 13),
(8, 'MP007', 'Bahasa Indonesia', 15),
(9, 'MP008', 'Pemograman Web dan Perangkat Bergerak', 17),
(10, 'MP009', 'Bahasa Indonesia', 18),
(11, 'MP010', 'Bahasa jepang', 19),
(12, 'MP011', 'Bahasa Sunda', 20),
(14, 'MP013', 'PJOK', 16),
(15, 'MP014', 'PKN', 22),
(16, 'MP014', 'Agama', 23),
(17, 'MP0015', 'Sejarah', 21),
(18, 'MP015', 'Seni Budaya', 24);

-- --------------------------------------------------------

--
-- Struktur dari tabel `mengajar`
--

CREATE TABLE `mengajar` (
  `id` int(11) NOT NULL,
  `mapel_id` int(11) NOT NULL,
  `siswa_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `mengajar`
--

INSERT INTO `mengajar` (`id`, `mapel_id`, `siswa_id`) VALUES
(15, 6, 11),
(16, 6, 12),
(17, 4, 19),
(19, 1, 14),
(20, 3, 19),
(21, 9, 11),
(22, 9, 12),
(23, 9, 24),
(24, 6, 24),
(25, 8, 21),
(26, 8, 14),
(27, 8, 19),
(28, 10, 11),
(29, 10, 12),
(30, 10, 13),
(31, 10, 24),
(32, 11, 24),
(33, 11, 17),
(34, 11, 23),
(35, 11, 11),
(36, 11, 12),
(37, 11, 13),
(38, 13, 11),
(39, 13, 12),
(40, 13, 13),
(42, 6, 13),
(43, 4, 11),
(44, 4, 12),
(45, 4, 13),
(46, 4, 26),
(47, 5, 11),
(48, 5, 12),
(49, 5, 13),
(50, 5, 26),
(51, 5, 24),
(52, 14, 24),
(53, 15, 11),
(54, 15, 12),
(55, 15, 13),
(56, 15, 26),
(57, 15, 24),
(58, 14, 11),
(59, 14, 12),
(60, 14, 13),
(61, 14, 26),
(62, 12, 24),
(63, 12, 11),
(64, 12, 12),
(65, 12, 13),
(66, 12, 26),
(67, 16, 24),
(68, 16, 11),
(69, 16, 12),
(70, 16, 13),
(71, 16, 26),
(72, 17, 24),
(73, 17, 11),
(74, 17, 12),
(75, 17, 13),
(76, 17, 26),
(77, 12, 11),
(78, 12, 24),
(79, 12, 28),
(80, 18, 24),
(81, 18, 28),
(82, 18, 11),
(83, 18, 12),
(84, 18, 13),
(85, 18, 29);

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

--
-- Dumping data untuk tabel `nilai_rapor`
--

INSERT INTO `nilai_rapor` (`id`, `siswa_id`, `mapel_id`, `nilai_kkm`, `nilai_pengetahuan`, `nilai_keterampilan`, `Keterangan`) VALUES
(2, 11, 6, 75, 78, 82, 'Lulus'),
(3, 12, 6, 75, 73, 80, 'Lulus'),
(4, 21, 7, 71, 79, 80, 'Lulus'),
(5, 24, 9, 75, 60, 70, 'Tidak Lulus'),
(6, 24, 6, 75, 79, 80, 'Lulus'),
(7, 17, 11, 75, 76, 79, 'Lulus'),
(8, 23, 11, 75, 78, 80, 'Lulus'),
(9, 24, 11, 75, 79, 80, 'Lulus'),
(10, 13, 11, 75, 80, 80, 'Lulus'),
(11, 12, 11, 75, 76, 79, 'Lulus'),
(12, 11, 11, 75, 79, 80, 'Lulus'),
(13, 21, 8, 75, 79, 80, 'Lulus'),
(14, 14, 8, 75, 80, 80, 'Lulus'),
(15, 19, 8, 75, 78, 79, 'Lulus'),
(16, 12, 9, 75, 78, 79, 'Lulus'),
(17, 11, 9, 75, 79, 80, 'Lulus'),
(18, 24, 16, 75, 78, 79, 'Lulus'),
(19, 13, 16, 75, 76, 79, 'Lulus'),
(20, 26, 16, 75, 79, 80, 'Lulus'),
(21, 12, 16, 75, 74, 76, 'Lulus'),
(22, 11, 16, 75, 78, 79, 'Lulus'),
(23, 24, 15, 75, 79, 80, 'Lulus'),
(24, 13, 15, 75, 79, 80, 'Lulus'),
(25, 26, 15, 75, 76, 79, 'Lulus'),
(26, 12, 15, 75, 70, 79, 'Lulus'),
(27, 11, 15, 75, 76, 79, 'Lulus'),
(28, 24, 17, 75, 77, 79, 'Lulus'),
(29, 13, 17, 75, 78, 78, 'Lulus'),
(30, 26, 17, 75, 79, 79, 'Lulus'),
(31, 11, 17, 75, 79, 78, 'Lulus'),
(32, 12, 17, 75, 70, 79, 'Lulus'),
(34, 13, 12, 75, 79, 79, 'Lulus'),
(35, 26, 12, 75, 78, 78, 'Lulus'),
(36, 12, 12, 75, 77, 77, 'Lulus'),
(37, 11, 12, 75, 79, 79, 'Lulus'),
(38, 24, 14, 75, 76, 76, 'Lulus'),
(39, 13, 14, 75, 79, 81, 'Lulus'),
(40, 26, 14, 75, 78, 81, 'Lulus'),
(41, 12, 14, 75, 79, 80, 'Lulus'),
(42, 11, 14, 75, 78, 78, 'Lulus'),
(43, 24, 10, 75, 77, 77, 'Lulus'),
(44, 13, 10, 75, 77, 78, 'Lulus'),
(45, 12, 10, 75, 76, 76, 'Lulus'),
(46, 11, 10, 75, 77, 77, 'Lulus'),
(47, 13, 6, 75, 79, 80, 'Lulus'),
(48, 28, 9, 75, 80, 82, 'Lulus'),
(49, 13, 9, 75, 79, 81, 'Lulus'),
(50, 29, 9, 75, 76, 79, 'Lulus'),
(51, 11, 18, 75, 79, 79, 'Lulus'),
(52, 12, 18, 75, 77, 78, 'Lulus'),
(53, 29, 18, 75, 80, 80, 'Lulus'),
(54, 13, 18, 75, 80, 79, 'Lulus'),
(55, 28, 18, 75, 77, 79, 'Lulus'),
(56, 24, 18, 75, 79, 82, 'Lulus'),
(57, 29, 6, 75, 79, 79, 'Lulus'),
(58, 28, 6, 75, 77, 77, 'Lulus'),
(59, 29, 12, 75, 75, 79, 'Lulus'),
(60, 28, 12, 75, 77, 80, 'Lulus'),
(61, 24, 12, 75, 77, 77, 'Lulus'),
(62, 13, 5, 75, 80, 80, 'Lulus'),
(63, 29, 5, 75, 81, 85, 'Lulus'),
(64, 12, 5, 75, 80, 81, 'Lulus'),
(65, 11, 5, 75, 80, 80, 'Lulus'),
(66, 28, 5, 75, 90, 81, 'Lulus'),
(67, 24, 5, 75, 80, 80, 'Lulus'),
(68, 33, 5, 75, 79, 79, 'Lulus'),
(69, 32, 5, 75, 77, 80, 'Lulus');

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
(13, '10092466', 'Annisa Sally', 'XI RPL 4', 'P', 708120),
(14, '672838399', 'Elnino Romadhona', 'X PPLG 2', 'L', 708124),
(17, '178363849', 'Richi Aldira', 'XI RPL 2', 'L', 708127),
(18, '232163780', 'Leny Fatmawati', 'X PPLG 1', 'P', 708128),
(19, '15637882', 'Nayla Oktaviani', 'X PPLG 3', 'P', 708129),
(20, '56373783', 'Alya Fahimah', 'XII RPL 1', 'P', 708145),
(21, '36484027', 'Naura Azzahra', 'X PPLG 1', 'P', 708146),
(22, '12536383', 'M.Putra aditia', 'XII RPL 3', 'L', 708147),
(23, '16011521', 'Reyhan Paiz', 'XI RPL 2', 'L', 708148),
(24, '12537389', 'Zahra Sabila', 'XI RPL 1', 'P', 708154),
(25, '175373937', 'Aril Putra', 'XII RPL 2', 'L', 708156),
(28, '162729729', 'Dinnar Mufidah', 'XI RPL 1', 'P', 708168),
(29, '1162728290', 'Fakhri Zailani', 'XI RPL 4', 'L', 708169),
(30, '1326272628', 'Naira Latifatunnisa', 'X RPL 7', 'P', 708171),
(31, '1726389023', 'Silvi', 'XI RPL 1', 'P', 708172),
(32, '1245678902', 'Raya', 'XI RPL 1', 'P', 708173),
(33, '1092352427', 'Lia', 'XI RPL 1', 'P', 708174);

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
(708116, 'Violla12', '$2y$10$Wl7kN1PqgPzfTnYkRqoEm.MY6AdAHzO59Vx4PBYu5nipaKxlVfjgS', 'siswa', '2026-11-20 05:23:06'),
(708117, 'Luthfi22', '$2y$10$uOKJUq4TRZU2XEuHe0EQQuCkgdQDo8D6ZM.rHnaXSYxU7x3mVq5VK', 'siswa', '2026-11-14 14:56:43'),
(708118, 'Dhea17', '$2y$10$9.0872.mCPw6Yo4PjRlVv.a/yEpLfxnfeyBu530CMqMvK7Dl7owGe', 'admin', '2026-10-08 06:45:27'),
(708119, 'Mayang22', '$2y$10$PhwjAco1T5aD1BCufJGqYuhtfW4A2HfnQztFS/E8HuWe4a4uqLmPG', 'admin', '2026-11-13 13:55:51'),
(708120, 'Annisa17', '$2y$10$/lC9JdWpVgD2CVo81tVtnuJrPqRFlgF0zB4Wk6bFxDUUoLrZ3RAmm', 'siswa', '2026-11-13 13:56:26'),
(708121, 'Irma13', '$2y$10$TDq0JxwNaK/ZH4DskrbKp.Xx0zO/sLOGDnaTOUFaI3Hu0QdIBzgkW', 'guru', '2026-10-26 12:47:56'),
(708124, 'Elnino01', '$2y$10$wT5Q84YhNR4HERkzcqcPe.WY10JvQkaFBzH4ON9hgZqWQUUSh7aDO', 'siswa', '2026-10-26 11:40:04'),
(708127, 'Richi04', '$2y$10$oM26/Bx2ukywOz7CbYuvQ.HlaGju84Nhw5arZx8gjijT1FcDQluPa', 'siswa', '2026-10-26 12:16:16'),
(708128, 'Leny06', '$2y$10$M9XYjmaOfp4W1dEdunVcg.SvdVTupLfWSqi1L7xAvPorfaClf.PC2', 'siswa', '2026-10-28 13:08:44'),
(708129, 'Nayla06', '$2y$10$YR0y.MChSxBfqFUw5SP2MOQHPyVXk6PlgiNNPbyL0n3i5V2bJOX1q', 'siswa', '2026-10-26 12:24:01'),
(708145, 'Alya77', '$2y$10$pY49fXTvFkEvjJwhPsrEUuwQVdssWhHX4OBysRFzy.Ych/JOVBOLy', 'siswa', '2026-10-27 00:21:21'),
(708146, 'Naura26', '$2y$10$2xqYgiBHT4Mc3Tc7ZMeSwODYiTg3MDir/NnwGQODgj6d1zDRyuV.W', 'siswa', '2026-10-28 00:12:55'),
(708147, 'Putra99', '$2y$10$mpwo9ZqkloUxQIT9Wpf5kuD3BiQ5eUdR9nYt7vov3oOPWXsbHu4Eu', 'siswa', '2026-10-28 00:46:56'),
(708148, 'Reyhan16', '$2y$10$SwxBd5Wn3c/Ba4v6Xg6WKefRZTbIEPhYhXq6FQk59gxCvuY4oQYdO', 'siswa', '2026-10-28 00:48:20'),
(708149, 'Nia44', '$2y$10$.FdfkQyjpa4RKwDSw.ruz.I0F9oJmr8rKAhjbCFcZhPenglR.iunG', 'guru', '2026-10-28 00:49:59'),
(708150, 'Ahmad19', '$2y$10$jxlLlNNYPpwczMwvs9WMh.pxjEQSytmEA6z0FPVKhxRlmrwqiw1wW', 'guru', '2026-11-10 02:33:56'),
(708151, 'bu muti', '$2y$10$I/o5ETAzXduqhgIhfEXLf.hdqUxbS15vwVTAeU2a5ajp3Xtfta0tG', 'guru', '2026-11-20 11:31:04'),
(708152, 'Gevin67', '$2y$10$2Y0B7ZQ6/TSmmbxU3iJkPuovOGepwsRyavrCIc9uEE3VLEC6jJwCC', 'guru', '2026-11-14 14:55:01'),
(708153, 'bu suci', '$2y$10$I91aWQmdAPpqLH7kVz6mD.TcHzsfKGPIafeEJRG1WACz8SmCP5EgC', 'guru', '2026-11-17 07:43:47'),
(708154, 'zahra44', '$2y$10$Ifm5bwpptA1tRwn0OAT04el9D1jKie2MYjagw.zEqB3.O7F9d/Beq', 'siswa', '2026-11-10 05:19:35'),
(708155, 'dinar19', '$2y$10$neqHm.UynBBOgxVuJL5pmuxSceo8bAM7qnRwdTijsVUXlFhA6ISZS', 'admin', '2026-11-14 15:44:38'),
(708156, 'Aril89', '$2y$10$VeePr1hqZzH7JEtHA3hyauFtB1INRUmXtHw19stXy4o6r37Wo9.5q', 'siswa', '2026-11-14 16:01:49'),
(708157, 'bu vinkan', '$2y$10$POnbb7oQU0EuA1lQSl.RzuDTbZYud/78TAfFC.SivrsMTsqPviqHm', 'guru', '2026-11-14 16:06:58'),
(708158, 'pa rifki', '$2y$10$RnpS7kZYgRVnAGkSrkkG5eoovm4/kr.aXem9i47HJZs5jET8wIhHG', 'guru', '2026-11-14 16:12:32'),
(708159, 'pa gugun', '$2y$10$XXsRQLxIZX4dyFCCeRCh.uU719qOkZl5FH7J7tDlvMN5aa5K1ya3q', 'guru', '2026-11-14 16:16:40'),
(708160, 'bu fauziah', '$2y$10$WEuhvZeD3yS4P9e4IPoAWuw0ihS5CdRSBFDfptGPh17pOPEv.ixw6', 'guru', '2026-11-15 00:53:13'),
(708161, 'pa dudi', '$2y$10$Kg.zpGRhdc7wA3mIFrRRMOYv/aDINuOgyEXeSAShhetHpfarTrHGW', 'guru', '2026-11-15 01:01:57'),
(708162, 'bu siti', '$2y$10$KI1gayvXYDQyOlSECo1Iw.AIjRznBN5ufCPNdqTMpBRPThPZg/Xh6', 'guru', '2026-11-17 06:52:48'),
(708163, 'bu eni', '$2y$10$habhPk4HOZAbZDHfl4B7ZenKYQ0PJAy4JLcLLF6ROYf42ZJD8r.qG', 'guru', '2026-11-17 07:10:20'),
(708165, 'bu umi', '$2y$10$p0anwj6d1ky2KxzOmqjAzucUpRmdcP0FLPzpKIm2XZw46Gs0wmGOW', 'guru', '2026-11-17 07:35:32'),
(708166, 'pa salim', '$2y$10$8Yu3QMeGBBWhP2sSrXZG7OVNlWdoeadp5SFRaH1wBMvgCakUxO5x6', 'guru', '2026-11-17 07:41:59'),
(708168, 'dinar19', '$2y$10$sdq0h5IlTE4dMjsLXFWd2em43mLJIICQXFPcpUKh3V2un7n.HWxkO', 'siswa', '2026-11-20 05:26:39'),
(708169, 'fakhri12', '$2y$10$hUQHjhkzvgxQhqKGCZi.Q.FbATd5F.D2j8vU7VCfzqGvfGKF8y3mq', 'siswa', '2026-11-20 06:12:28'),
(708170, 'nazwa10', '$2y$10$08xZkroGec4A9H4.yHpFGuDChpMe39WvM8TtBU1eB0BKqubsJgT9C', 'guru', '2026-11-20 06:14:27'),
(708171, 'naira00', '$2y$10$lTXdKfXYqJEljxE2ky0cFeV1K.u/gzN7H66h1HGfMl3kUq0igserG', 'siswa', '2026-11-20 07:19:55'),
(708172, 'silvi88', '$2y$10$7AOoTvFbfUf/xPwZ/62WHuTe9LswPpp4gEM6Ay7GXjAYDPATkstfW', 'siswa', '2026-11-20 11:36:26'),
(708173, 'raya06', '$2y$10$ay8MovWuuvSGTGCEIsE4J.TsaVtKIP/I/t7WG9hy1cFSt7CrGHita', 'siswa', '2026-11-20 11:39:45'),
(708174, 'lia77', '$2y$10$RMJvQ4J0tAa8.JJjQItnp.wO2VuPJK9rHeuHygFzjTgWVMhmKpNtS', 'siswa', '2026-11-20 11:40:21');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `mapel`
--
ALTER TABLE `mapel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `mengajar`
--
ALTER TABLE `mengajar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT untuk tabel `nilai_rapor`
--
ALTER TABLE `nilai_rapor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT untuk tabel `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=708175;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
