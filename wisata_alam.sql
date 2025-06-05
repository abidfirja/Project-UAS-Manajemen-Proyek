-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 05 Jun 2025 pada 14.32
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
-- Database: `wisata alam`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id` int(50) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `wisata`
--

CREATE TABLE `wisata` (
  `id` int(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `deskripsi` text NOT NULL,
  `budget` varchar(255) NOT NULL,
  `fasilitas` text NOT NULL,
  `lokasi` varchar(255) NOT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `wisata`
--

INSERT INTO `wisata` (`id`, `nama`, `deskripsi`, `budget`, `fasilitas`, `lokasi`, `gambar`) VALUES
(7, 'Bukit Jokowi', 'bukit Jokowi ini juga merupakan tempat wisata yang indah untuk di kunjungi oleh para wisatawan-wisatawan tak hanya wisatawan-wisatawan saja sebagian orang-orang luar negeri sudah berliburan di tempat ini juga.\r\nTempat ini juga banyak dikenal dengan sebutan Bukit Jokowi karena kedatangan Jokowi pernah ke tempat sini pada tahun 2016 yang lalu.\r\nBukit ini menghadap langsung ke teluk Youtefa dan Samudera Pasifik\r\nPepohonan hijau yang menyegarkan mata itu berpadu dengan merahnya Jembatan Holtekamp yang mempesona', '5.000 (Hanya uang parkir)', '- Cafe\r\n- Tempat berfoto', 'https://maps.app.goo.gl/vcgx7kZwWDaBXPBn9?g_st=awb', '1748998316_bujok.jpg'),
(11, 'Pantai Base-G', 'Pantai Tanjung Ria atau yang lebih dikenal dengan Pantai Base G merupakan sebuah pantai di wilayah Jayapura Utara dengan panorama yang memukau. Menurut cerita sejarah nama “Base G” diambil karena area ini pernah digunakan sebagai homebase pasukan sekutu saat Perang Dunia II. Pada masa tersebut, pantai ini menjadi titik pengumpulan kekuatan pasukan sekutu untuk berperang dengan Pasukan Jepang di Filipina. Sedangkan huruf “G” berarti abjad yang menjadi urutan ke-7. Hal ini menjelaskan bahwa tempat ini adalah homebase ke-7 bagi tentara sekutu. Dibalik sejarah tersebut, pemandangan indah dan kondisi sekitar yang tenang juga menjadikan tempat ini wajib untuk dapat kamu kunjungi saat berada di Kota Jayapura. Selain itu, kamu juga dapat menikmati proses matahari terbit maupun tenggelam dari tepi pantai bersejarah ini dengan begitu indah.', '350', '- Pondok\r\n- Tempat duduk\r\n- Kamar mandi/Toilet', 'https://maps.app.goo.gl/b6E1iZPjVwXAZmYX7', '1749024537_pantai_base_g_1200.jpg');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `wisata`
--
ALTER TABLE `wisata`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `wisata`
--
ALTER TABLE `wisata`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
