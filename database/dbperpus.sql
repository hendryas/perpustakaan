-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 25 Nov 2023 pada 10.12
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbperpus`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `manajemen_buku`
--

CREATE TABLE `manajemen_buku` (
  `id_manajemen_buku` int(11) NOT NULL,
  `judul` varchar(125) DEFAULT NULL,
  `penulis` varchar(125) DEFAULT NULL,
  `penerbit` varchar(125) DEFAULT NULL,
  `tahun_terbit` datetime DEFAULT NULL,
  `jumlah_kopi` int(11) DEFAULT NULL,
  `stok` int(11) DEFAULT NULL,
  `image` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `manajemen_buku`
--

INSERT INTO `manajemen_buku` (`id_manajemen_buku`, `judul`, `penulis`, `penerbit`, `tahun_terbit`, `jumlah_kopi`, `stok`, `image`) VALUES
(2, 'Sharlock Holmes', 'Agus ', 'Arthur Conan Doyle', '0000-00-00 00:00:00', 1000, 2, 'buku_1700903183.jpg'),
(3, 'sakomoto days', 'hajime', 'hajime', '2023-11-22 00:00:00', 100, 509, 'buku_1700664914.jpg'),
(4, 'Detective Conan', 'Dani', 'Gramedia', '2023-11-25 00:00:00', 20, 100, 'buku_1700745247.jpg'),
(5, 'Melangkah', 'J. S Khairen', 'Gramedia Widiasarana Indonesia', '2020-03-20 00:00:00', 231, 100, 'buku_1700902918.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `notifikasi_admin`
--

CREATE TABLE `notifikasi_admin` (
  `id_notifikasi_admin` int(11) NOT NULL,
  `id_manajemen_buku` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `pesan` varchar(256) DEFAULT NULL,
  `status_notif` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `notifikasi_admin`
--

INSERT INTO `notifikasi_admin` (`id_notifikasi_admin`, `id_manajemen_buku`, `id_user`, `pesan`, `status_notif`) VALUES
(1, 2, 13, 'Berhasil meminjam buku Sharlock Holmes pada tanggal 2023-11-23', 1),
(2, 4, 16, 'Berhasil meminjam buku Detective Conan pada tanggal 2023-11-24', 1),
(3, 3, 16, 'Berhasil meminjam buku sakomoto days pada tanggal 2023-11-25', 1),
(4, 5, 16, 'Berhasil meminjam buku Melangkah pada tanggal 2023-11-26', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `notifikasi_user`
--

CREATE TABLE `notifikasi_user` (
  `id_notifikasi_user` int(11) NOT NULL,
  `id_manajemen_buku` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `pesan` varchar(256) DEFAULT NULL,
  `status_notif` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `notifikasi_user`
--

INSERT INTO `notifikasi_user` (`id_notifikasi_user`, `id_manajemen_buku`, `id_user`, `pesan`, `status_notif`) VALUES
(1, 2, 13, 'Berhasil meminjam buku Sharlock Holmes', 0),
(2, 4, 16, 'Berhasil meminjam buku Detective Conan', 1),
(3, 3, 16, 'Berhasil meminjam buku sakomoto days', 1),
(4, 5, 16, 'Berhasil meminjam buku Melangkah', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `id_peminjam_buku` int(11) NOT NULL,
  `jumlah_bayar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjam_buku`
--

CREATE TABLE `peminjam_buku` (
  `id_peminjam_buku` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_manajemen_buku` int(11) DEFAULT NULL,
  `tanggal_pinjam` datetime DEFAULT NULL,
  `tanggal_pengembalian` datetime DEFAULT NULL,
  `status_pengembalian` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `peminjam_buku`
--

INSERT INTO `peminjam_buku` (`id_peminjam_buku`, `id_user`, `id_manajemen_buku`, `tanggal_pinjam`, `tanggal_pengembalian`, `status_pengembalian`) VALUES
(1, 13, 2, '2023-11-22 00:00:00', '2023-11-22 00:00:00', 1),
(2, 13, 2, '2023-11-22 00:00:00', '2023-11-23 00:00:00', 1),
(3, 16, 4, '2023-11-23 00:00:00', '2023-11-24 00:00:00', 1),
(4, 16, 3, '2023-11-24 00:00:00', '2023-11-25 00:00:00', 0),
(5, 16, 5, '2023-11-25 00:00:00', '2023-11-26 00:00:00', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `username` varchar(128) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(10) NOT NULL,
  `is_active` int(10) NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `name`, `tgl_lahir`, `gender`, `phone`, `username`, `email`, `password`, `role_id`, `is_active`, `date_created`) VALUES
(1, 'Bisri', NULL, '1', '082134703291', 'admin', 'admin@gmail.com', '$2y$10$1Y5ALImDUmwS.kCBQGzUeeo//N2l/rECscqfPRxLuLHnkzbYXNlia', 1, 1, '2022-06-13 00:00:00'),
(13, 'Vanessa Ananda', '1999-03-04', '2', '085921685125', '', 'vanessaanandaputri@gmail.com', '$2y$10$1Y5ALImDUmwS.kCBQGzUeeo//N2l/rECscqfPRxLuLHnkzbYXNlia', 2, 1, '2022-06-22 00:20:38'),
(15, 'Setiawan', '1997-06-25', '1', '085325026752', '', 'hendryas321@gmail.com', '$2y$10$1Y5ALImDUmwS.kCBQGzUeeo//N2l/rECscqfPRxLuLHnkzbYXNlia', 2, 1, '2022-07-31 12:57:56'),
(16, 'Bima', '2013-04-01', 'Laki-laki', '086352457642', '', 'bima@gmail.com', '$2y$10$1Y5ALImDUmwS.kCBQGzUeeo//N2l/rECscqfPRxLuLHnkzbYXNlia', 2, 1, '2023-04-07 06:20:23');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES
(2, 3, 2),
(13, 1, 3),
(16, 2, 7),
(17, 2, 8),
(18, 2, 6),
(19, 2, 9),
(21, 2, 14),
(25, 1, 11),
(26, 1, 1),
(27, 2, 15),
(28, 2, 16);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_has_sub_menu`
--

CREATE TABLE `user_has_sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `is_active` int(11) NOT NULL,
  `status_sub` int(11) NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `user_has_sub_menu`
--

INSERT INTO `user_has_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`, `status_sub`, `date_created`) VALUES
(1, 1, 'Role', 'admin/role', 'fal fa-fw fa-list', 1, 1, '2022-07-06 00:00:00'),
(3, 1, 'Management User', 'admin/user', 'fal fa-fw fa-user', 1, 1, '2022-07-06 00:00:00'),
(4, 3, 'Menu Management', '-', 'fal fa-fw fa-bars', 1, 0, '2022-08-02 20:30:48'),
(10, 5, 'Pendataan UMKM', 'pendataanumkm/cpendataanumkm', 'fal fa-fw fa-barcode', 1, 1, '2023-04-07 13:45:56'),
(11, 6, 'Pengujian', 'naivebayes/datauji', 'fal fa-fw fa-pen', 1, 1, '2023-04-08 14:13:58'),
(12, 6, 'Calon', 'naivebayes/datacalon', 'fal fa-fw fa-profile', 1, 1, '2023-04-10 09:23:34'),
(13, 7, 'Dataset', 'c45/dataset', 'fal fa-fw fa-list', 1, 1, '2023-06-10 10:54:01'),
(14, 7, 'Init', 'c45/init', 'fal fa-fw fa-book', 1, 1, '2023-06-10 10:54:37'),
(15, 7, 'Prediction', 'c45/prediction', 'fal fa-fw fa-pen', 1, 1, '2023-06-10 10:55:24'),
(16, 8, 'Enkripsi', 'md4', 'fal fa-fw fa-pen', 1, 1, '2023-07-03 13:24:50'),
(19, 9, 'Beasiswa', 'beasiswa', 'fal fa-fw fa-book', 1, 1, '2023-09-11 07:40:06'),
(24, 10, 'Presensi Peserta', 'presensi', 'fal fa-fw fa-user', 1, 1, '2023-10-10 04:38:27'),
(26, 11, 'Dashboard', 'admin', 'fal fa-fw fa-bars', 1, 1, '2023-10-11 15:13:17'),
(27, 3, 'Manajemen Buku', 'manajemenbuku', 'fal fa-fw fa-book', 1, 1, '2023-11-22 22:02:03'),
(28, 15, 'Pinjam Buku', 'buku', 'fal fa-fw fa-book', 1, 1, '2023-11-21 23:05:45'),
(29, 15, 'History Pinjam', 'historypinjam', 'fal fa-fw fa-history', 1, 1, '2023-11-22 22:11:09'),
(30, 3, 'Peminjam Buku', 'peminjambuku', 'fal fa-fw fa-book', 1, 1, '2023-11-23 21:33:30'),
(31, 16, 'Home', 'home', 'fal fa-fw fa-home', 1, 1, '2023-11-25 15:41:47');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(255) NOT NULL,
  `menu_nama` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`, `menu_nama`, `date_created`) VALUES
(1, 'Admin', 'Admin', '2022-06-14 00:00:00'),
(2, 'pesertamagang', 'Dashboard', '2023-10-11 16:49:07'),
(3, 'Master', 'Data Master', '2023-10-10 22:56:42'),
(5, 'pendataanumkm', 'Data UMKM', '2023-04-07 13:40:22'),
(10, 'presensi', 'Presensi', '2023-10-10 04:37:25'),
(11, 'dashboard', 'Dashboard', '2023-10-10 22:56:19'),
(12, 'administrator', 'Kelola Administrator', '2023-10-10 22:57:10'),
(13, 'settingadmin', 'Pengaturan', '2023-10-10 22:57:46'),
(15, 'buku', 'Buku', '2023-11-21 23:04:29'),
(16, 'home', 'Home', '2023-11-25 15:41:15');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'Admin'),
(2, 'User');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `has_sub_menu_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `is_active` int(11) NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id`, `menu_id`, `has_sub_menu_id`, `title`, `url`, `icon`, `is_active`, `date_created`) VALUES
(1, 1, 4, 'Menu Management (Level 1)', 'master/menulevel1', 'fal fa-fw fa-folder', 1, '2022-07-06 00:00:00'),
(2, 1, 4, 'Submenu Management (Level 2)', 'master/menulevel2', 'fal fa-fw fa-folder-open', 1, '2022-07-06 00:00:00'),
(3, 1, 4, 'Submenu Management (Level 3)', 'master/menulevel3', 'fal fa-fw fa-folder-open', 1, '2022-07-06 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `manajemen_buku`
--
ALTER TABLE `manajemen_buku`
  ADD PRIMARY KEY (`id_manajemen_buku`);

--
-- Indeks untuk tabel `notifikasi_admin`
--
ALTER TABLE `notifikasi_admin`
  ADD PRIMARY KEY (`id_notifikasi_admin`);

--
-- Indeks untuk tabel `notifikasi_user`
--
ALTER TABLE `notifikasi_user`
  ADD PRIMARY KEY (`id_notifikasi_user`);

--
-- Indeks untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indeks untuk tabel `peminjam_buku`
--
ALTER TABLE `peminjam_buku`
  ADD PRIMARY KEY (`id_peminjam_buku`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_has_sub_menu`
--
ALTER TABLE `user_has_sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `manajemen_buku`
--
ALTER TABLE `manajemen_buku`
  MODIFY `id_manajemen_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `notifikasi_admin`
--
ALTER TABLE `notifikasi_admin`
  MODIFY `id_notifikasi_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `notifikasi_user`
--
ALTER TABLE `notifikasi_user`
  MODIFY `id_notifikasi_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `peminjam_buku`
--
ALTER TABLE `peminjam_buku`
  MODIFY `id_peminjam_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT untuk tabel `user_has_sub_menu`
--
ALTER TABLE `user_has_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
