-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 30 Bulan Mei 2022 pada 05.34
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aqs_login`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `br_barang_hilang`
--

CREATE TABLE `br_barang_hilang` (
  `id` int(11) NOT NULL,
  `kd_brh` varchar(18) NOT NULL,
  `nama_brh` varchar(100) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `tgl_hilang` datetime DEFAULT NULL,
  `gambar1` varchar(100) DEFAULT NULL,
  `gambar2` varchar(100) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `status` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `br_barang_hilang`
--

INSERT INTO `br_barang_hilang` (`id`, `kd_brh`, `nama_brh`, `kategori`, `tgl_hilang`, `gambar1`, `gambar2`, `keterangan`, `status`) VALUES
(3, 'BRH29052022-1', 'Kunci Motor', 'Aksesoris', '2022-05-26 15:48:00', 'gmail.png', 'Eif.jpg', 'Test Kriuk', 'Y'),
(7, 'BRH29052022-5', 'Hp', 'Elektronik', '2022-05-12 16:35:00', 'flyer.jpeg', 'BGWeibanarTrisakti.jpeg', 'jhbjhbhbubihibib', 'Y'),
(8, 'BRH29052022-6', 'Laptop', 'Elektronik', '2022-05-19 16:53:00', 'Bukti_pengisian_SP2020_Online.jpg', 'KruMugiwara.png', 'Telah hilang laptop dengan ciri - ciri , jenis HP , warna hitam dan lain - lain', 'Y');

-- --------------------------------------------------------

--
-- Struktur dari tabel `br_barang_pengguna`
--

CREATE TABLE `br_barang_pengguna` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `kd_br` varchar(18) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `br_barang_pengguna`
--

INSERT INTO `br_barang_pengguna` (`id`, `user_id`, `kd_br`) VALUES
(3, 1, 'BRH29052022-1'),
(4, 1, 'BRH29052022-2'),
(5, 1, 'BRH29052022-3'),
(6, 1, 'BRH29052022-4'),
(7, 1, 'BRH29052022-5'),
(8, 1, 'BRH29052022-6'),
(9, 1, 'BRT29052022-1'),
(10, 1, 'BRT29052022-1'),
(11, 1, 'BRT29052022-1'),
(12, 1, 'BRT29052022-2'),
(13, 1, 'BRH29052022-7');

-- --------------------------------------------------------

--
-- Struktur dari tabel `br_barang_temuan`
--

CREATE TABLE `br_barang_temuan` (
  `id` int(11) NOT NULL,
  `kd_brt` varchar(18) NOT NULL,
  `nama_brt` varchar(100) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `tgl_temu` datetime DEFAULT NULL,
  `gambar1` varchar(100) DEFAULT NULL,
  `gambar2` varchar(100) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `status` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `br_barang_temuan`
--

INSERT INTO `br_barang_temuan` (`id`, `kd_brt`, `nama_brt`, `kategori`, `tgl_temu`, `gambar1`, `gambar2`, `keterangan`, `status`) VALUES
(1, 'BRT29052022-1', 'yeeye', 'Elektronik', '2022-05-07 17:50:00', '2020-03-13_11-22-533.png', 'Cholisa3.jpg', 'egwfefer', 'Y'),
(2, 'BRT29052022-2', 'tets', 'Elektronik', '2022-05-12 17:56:00', 'Astra2.jpg', 'Background-Undangan-Pernikahan-Silver1.jpg', 'wffwefeer', 'Y'),
(3, 'BRT29052022-3', 'aergreg', 'Identitas Pribadi', '2022-05-06 18:03:00', 'Coding.png', 'gmail.png', 'cwefcwefwe', 'Y'),
(4, 'BRT29052022-4', 'gergerg', 'Elektronik', '2022-05-14 18:09:00', 'logo13.png', 'potocv-bgRed3.png', 'ergerge', 'Y');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mr_kategori`
--

CREATE TABLE `mr_kategori` (
  `id` int(11) NOT NULL,
  `keterangan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `mr_kategori`
--

INSERT INTO `mr_kategori` (`id`, `keterangan`) VALUES
(1, 'Elektronik'),
(2, 'Identitas Pribadi'),
(3, 'Aksesoris'),
(4, 'Uang');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama` varchar(1000) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `nik` varchar(16) DEFAULT NULL,
  `alamat` varchar(350) DEFAULT NULL,
  `no_telp` varchar(15) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `is_active` int(11) DEFAULT NULL,
  `date` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `nama`, `email`, `password`, `gambar`, `nik`, `alamat`, `no_telp`, `role_id`, `is_active`, `date`) VALUES
(1, 'Aqsha Permana Fityantono', 'aqshapermana@gmail.com', '$2y$10$HuZZTmuKgsooSc9APNBo0emHAJFhd.M71ZKLwpqKVajI49gJUwFAG', 'Aqsha.jpeg', '3171045510770008', 'JL. SMAN 64 RT.001/RW.003 Cipayung Jakarta Selatan', '23234', 1, 1, 1648445433),
(17, 'Aqsha', 'aqshafityantono@gmail.com', '$2y$10$DvaFL87NMDUgb1vR3BrX9emGw7iXcbSGwwxiVCGUW/ibviZBJEc3i', 'user.png', NULL, NULL, NULL, 2, 1, 1650520783);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 2),
(5, 1, 0),
(6, 1, 0),
(7, 1, 0),
(8, 1, 0),
(9, 1, 0),
(10, 1, 0),
(11, 1, 0),
(12, 1, 0),
(13, 1, 0),
(14, 1, 0),
(15, 1, 0),
(16, 1, 0),
(17, 1, 0),
(18, 1, 0),
(19, 1, 0),
(23, 1, 3),
(24, 1, 74),
(26, 2, 74),
(27, 1, 75);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`) VALUES
(1, 'Admin'),
(2, 'Member'),
(3, 'Menu'),
(74, 'Barang Anda'),
(75, 'Daftar BHT');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_menu_go`
--

CREATE TABLE `user_menu_go` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) DEFAULT NULL,
  `title` varchar(64) DEFAULT NULL,
  `url` varchar(128) DEFAULT NULL,
  `icon` varchar(128) DEFAULT NULL,
  `is_active` int(11) DEFAULT NULL,
  `sub_menu_active` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_menu_go`
--

INSERT INTO `user_menu_go` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`, `sub_menu_active`) VALUES
(2, 2, 'Profile', NULL, 'fas fa-fw fa-cog', 1, 1),
(3, 3, 'Manajemen Menu', NULL, 'fas fa-fw fa-newspaper', 1, 1),
(4, 1, 'Dashboard', 'admin', 'fas fa-fw fa-tachometer-alt', 1, 0),
(10, 1, 'Role Akses', 'admin/akses', 'fab fa-fw fa-accessible-icon', 1, 0),
(18, 74, 'Barang Hilang Anda', 'barang/baranghilang', 'fas fa-fw fa-sitemap', 1, 0),
(19, 74, 'Barang Temuan Anda', 'barang/barangtemuan', 'fas fa-fw fa-file-contract', 1, 0),
(21, 1, 'Master Barang', '', 'fas fa-fw fa-server', 1, 1),
(22, 75, 'Daftar Barang Hilang', '', '', 1, 0),
(23, 75, 'Daftar Barang Temuan', '', '', 1, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role_name` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_role`
--

INSERT INTO `user_role` (`id`, `role_name`) VALUES
(1, 'Administrator'),
(2, 'Member');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_sub_menu_go`
--

CREATE TABLE `user_sub_menu_go` (
  `id` int(11) NOT NULL,
  `menu_go_id` int(11) DEFAULT NULL,
  `title` varchar(64) DEFAULT NULL,
  `url` varchar(128) DEFAULT NULL,
  `icon` varchar(64) DEFAULT NULL,
  `is_active` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_sub_menu_go`
--

INSERT INTO `user_sub_menu_go` (`id`, `menu_go_id`, `title`, `url`, `icon`, `is_active`) VALUES
(1, 2, 'Profil Member', 'member', 'fas fa-fw fa-user', 1),
(2, 2, 'Edit Profil', 'member/editUser', 'fas fa-fw fa-user-edit', 1),
(3, 3, 'Judul Menu', 'menu', 'fas fa-fw fas fa-pen-square', 1),
(4, 3, 'Menu', 'menu/addMenu', 'fas fa-fw fas fa-clone', 1),
(5, 3, 'Sub Menu', 'menu/addSubMenu', 'fas fa-fw fa-folder-plus', 1),
(11, 2, 'Ganti Password', 'member/changepassword', 'fas fa-fw fa-dice', 1),
(12, 18, 'Barang', 'baranghilang', 'fa', 1),
(14, 19, 'Barang', 'barangtemuan', 'fa', 1),
(15, 21, 'Kategori', 'master/kategori', ' ', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_token`
--

CREATE TABLE `user_token` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` varchar(128) NOT NULL,
  `date` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `br_barang_hilang`
--
ALTER TABLE `br_barang_hilang`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `br_barang_pengguna`
--
ALTER TABLE `br_barang_pengguna`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `br_barang_temuan`
--
ALTER TABLE `br_barang_temuan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `mr_kategori`
--
ALTER TABLE `mr_kategori`
  ADD PRIMARY KEY (`id`);

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
-- Indeks untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_menu_go`
--
ALTER TABLE `user_menu_go`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_sub_menu_go`
--
ALTER TABLE `user_sub_menu_go`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_token`
--
ALTER TABLE `user_token`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `br_barang_hilang`
--
ALTER TABLE `br_barang_hilang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `br_barang_pengguna`
--
ALTER TABLE `br_barang_pengguna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `br_barang_temuan`
--
ALTER TABLE `br_barang_temuan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `mr_kategori`
--
ALTER TABLE `mr_kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT untuk tabel `user_menu_go`
--
ALTER TABLE `user_menu_go`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `user_sub_menu_go`
--
ALTER TABLE `user_sub_menu_go`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `user_token`
--
ALTER TABLE `user_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
