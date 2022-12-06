-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 27 Nov 2022 pada 07.43
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `play_music_coox`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `lagu`
--

CREATE TABLE `lagu` (
  `id_lagu` int(11) NOT NULL,
  `judul_lagu` varchar(255) NOT NULL,
  `penyanyi` varchar(255) NOT NULL,
  `file_poster` varchar(255) NOT NULL,
  `file_lagu` varchar(255) NOT NULL,
  `kategori` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `lagu`
--

INSERT INTO `lagu` (`id_lagu`, `judul_lagu`, `penyanyi`, `file_poster`, `file_lagu`, `kategori`) VALUES
(1, 'Tak Ingin Usai', 'Kesisya Levronka', '1.jpg', '1.mp3', 'non-premium'),
(2, 'Rumah Singgah', 'Fabio Asher', '2.jpg', '2.mp3', 'premium'),
(3, 'Peri Cintaku', 'Ziva Magnolya', '3.jpg', '3.mp3', 'premium'),
(4, 'Pura-pura Lupa', 'Mahen', '4.jpg', '4.mp3', 'premium'),
(5, 'Kisah Sempurna', 'Mahalini', '5.jpg', '5.mp3', 'non-premium'),
(6, 'Bertahan Terluka', 'Fabio Asher', '6.jpg', '6.mp3', 'premium'),
(7, 'It\'s Ok If You Forget Me', 'Astrid S', '7.jpg', '7.mp3', 'premium'),
(8, 'Hati-Hati Di Jalan', 'Tulus', '8.jpg', '8.mp3', 'premium'),
(9, 'Lantas', 'Juicy luicy', '9.jpg', '9.mp3', 'premium'),
(10, 'Hingga Tua Bersama', 'Rizky Febian', '10.jpg', '10.mp3', 'premium'),
(11, 'Now I Know', 'Kaleb J', '11.jpg', '11.mp3', 'non-premium'),
(12, 'Janji Setia', 'Tiara Andini', '12.jpg', '12.mp3', 'premium'),
(13, 'Line Without A Hook', 'Kaleb J', '13.jpg', '13.mp3', 'non-premium'),
(14, 'Interaksi', 'Tulus', '14.jpg', '14.mp3', 'premium'),
(15, 'Langit Favorit', 'Luthfi Aulia', '15.jpg', '15.mp3', 'premium'),
(16, 'Angel Baby', 'Troye Sivan', '16.jpg', '16.mp3', 'premium'),
(17, 'Cinta Datang Terlambat', 'Maudy Ayunda', '17.jpg', '17.mp3', 'premium'),
(18, 'Ajarkan Aku', 'Arvian Dwi', '18.jpg', '18.mp3', 'premium'),
(19, 'Sisa Rasa', 'Mahalini', '19.jpg', '19.mp3', 'non-premium'),
(20, 'Merasa Indah', 'Tiara Andini', '20.jpg', '20.mp3', 'premium'),
(21, 'Mesin Waktu', 'Budi Doremi', '21.jpg', '21.mp3', 'premium'),
(22, 'Kalau Bosan', 'Lydora', '22.jpg', '22.mp3', 'premium'),
(23, 'Bahaya', 'Arsy feat Tiara Andini', '23.jpg', '23.mp3', 'premium'),
(24, 'Until I found You', 'Stephen Sanchez', '24.jpg', '24.mp3', 'premium'),
(25, 'Putus Atau Terus', 'Judika', '25.jpg', '25.mp3', 'premium'),
(26, 'Mungkin Hari Ini Esok Atau Nanti', 'Anneth Delliecia', '26.jpg', '26.mp3', 'premium'),
(27, 'It\'s Only Me', 'Kaleb J', '27.jpg', '27.mp3', 'non-premium'),
(28, 'Terpikat Senyumu', 'Idgitaf', '28.jpg', '28.mp3', 'premium'),
(29, 'Sebatas Formalitas', 'Danar Widianto', '29.jpg', '29.mp3', 'premium'),
(30, 'Runtuh', 'Feby feat Fiersa B', '30.jpg', '30.mp3', 'premium'),
(33, 'Hayya Hayya ( Better Together )', 'Aisha, Davido, Trinidad Cardona', '33.jpg', '33.mp3', 'premium');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$u3kWpX3nkjt3Zh/w.3SnvePYwzHTHSO1wT4xOB/3r2N81qKL0.oLq'),
(6, 'berlyand', '$2y$10$y05jYOqqR4Pj/hUCbAev1uLCakLbny7U5zCPtZoG7/O6CpPuQUysK'),
(8, 'afif123', '$2y$10$gFGR9w87OswbJ0DRvHQNnebe22U.DaCeoRF8srHSCRYKDb62TGWGq');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `lagu`
--
ALTER TABLE `lagu`
  ADD PRIMARY KEY (`id_lagu`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `lagu`
--
ALTER TABLE `lagu`
  MODIFY `id_lagu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
