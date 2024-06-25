-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 19 Jun 2024 pada 16.18
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
-- Database: `sembako_queue`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `queues`
--

CREATE TABLE `queues` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `queue_number` int(11) NOT NULL,
  `status` enum('Pending','Processing','Completed') NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `queues`
--

INSERT INTO `queues` (`id`, `user_id`, `queue_number`, `status`, `created_at`) VALUES
(25, 1, 1, '', '2024-06-17 12:21:16'),
(26, 2, 2, '', '2024-06-17 12:21:46'),
(28, 3, 3, '', '2024-06-17 12:26:06'),
(31, 4, 4, '', '2024-06-18 08:00:16'),
(32, 5, 0, 'Pending', '2024-06-19 08:50:55'),
(33, 5, 5, '', '2024-06-19 08:51:08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `phonenumber` varchar(20) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `fullname`, `username`, `phonenumber`, `password`, `created_at`) VALUES
(1, '2', '2', '2', '$2y$10$hoJZaNmrIwwyimIPGDXHYeEAocuVJAodt6TWkCsRrfPjfHGhgR4VO', '2024-06-17 11:37:53'),
(2, 'Ryan Aric Ardhani', 'ryanarc', '081292907172', '$2y$10$3aVsvqCthH63Et4AEWuOLubMTeLYXvBFV.vOMI7JavuaRE8dQhUvu', '2024-06-17 12:17:22'),
(3, 'Syarofil Anam', 'kaizen', '012', '$2y$10$xW0OV0LSx0da.7dQdW2R5.saOxfWA2.kaPmDkti7UqY5XGBfKoQVW', '2024-06-17 12:24:21'),
(4, 'Soluna Sela Fadilah', 'lunaela', '08989880211', '$2y$10$FPNRQmko/AK/dHdex4c24.vmJ/kPDVQYJ8lar0TjetSZAG6RWu0Q.', '2024-06-18 07:14:32'),
(5, 'Muhammad Rafli Febriansyah', 'rapli', '08121212121212', '$2y$10$rQT.dBdCsOC/xP6wBXZz5.vKZiDhDmr4JicpRAwOE/DsHpUMA6ag6', '2024-06-19 08:50:55');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `queues`
--
ALTER TABLE `queues`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `queues`
--
ALTER TABLE `queues`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `queues`
--
ALTER TABLE `queues`
  ADD CONSTRAINT `queues_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
