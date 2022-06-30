-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 30 jun 2022 om 17:17
-- Serverversie: 10.4.21-MariaDB
-- PHP-versie: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stardust`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20220605181646', '2022-06-05 20:16:55', 100),
('DoctrineMigrations\\Version20220605182046', '2022-06-05 20:20:52', 44),
('DoctrineMigrations\\Version20220605182402', '2022-06-05 20:24:07', 71),
('DoctrineMigrations\\Version20220605184635', '2022-06-05 20:46:52', 96),
('DoctrineMigrations\\Version20220606085647', '2022-06-06 10:56:56', 101),
('DoctrineMigrations\\Version20220606205955', '2022-06-06 23:01:48', 31),
('DoctrineMigrations\\Version20220606222204', '2022-06-07 00:22:10', 85),
('DoctrineMigrations\\Version20220610202440', '2022-06-10 22:24:54', 57),
('DoctrineMigrations\\Version20220611075641', '2022-06-11 09:56:50', 90),
('DoctrineMigrations\\Version20220612113959', '2022-06-12 13:40:07', 157),
('DoctrineMigrations\\Version20220612115719', '2022-06-12 13:57:24', 52),
('DoctrineMigrations\\Version20220617172946', '2022-06-17 19:30:02', 227);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `reservation`
--

CREATE TABLE `reservation` (
  `id` int(11) NOT NULL,
  `phone` int(11) NOT NULL,
  `days` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  `updated_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  `user_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL,
  `room_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `reservation`
--

INSERT INTO `reservation` (`id`, `phone`, `days`, `total`, `status`, `created_at`, `updated_at`, `user_id`, `name`, `email`, `check_in`, `check_out`, `room_id`) VALUES
(12, 66378364, 0, NULL, 'New', NULL, NULL, 15, 'Bechoe', 'bechoe@gmail.com', '2022-06-23', '2022-06-25', 35);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `room`
--

CREATE TABLE `room` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `reservation_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `room`
--

INSERT INTO `room` (`id`, `title`, `description`, `image`, `price`, `number`, `status`, `reservation_id`) VALUES
(35, 'luxe room 2', 'All our guestrooms are elegantly furnished with handmade furniture include luxury en-suite facilities with complimentary amenities pack, flat screen LCD TV, tea/coffee making facilities, fan, hairdryer and the finest pure white linen and towels.', '1655975864_pexels-jean-van-der-meulen-1457842.jpg', 120, 12, 1, NULL),
(38, 'test romm 3', 'oeghwhfoiyepefi', '1655985583_pexels-pixabay-164595.jpg', 340, 9, 1, NULL);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  `updated_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `name`, `image`, `created_at`, `updated_at`) VALUES
(2, 'admin@admin.com', '[\"ROLE_ADMIN\"]', '$2y$13$em00lxW6sarFSVf8tG91OeHDUBA9RacH288Jwg2t8cBF07rO7v7xC', 'Admin', NULL, '2022-06-06 23:10:40', '2022-06-06 23:10:40'),
(4, 'suliman@gmail.com', '[\"ROLE_BALIE\"]', '$2y$13$MVhGMWCXAQExdlWIXX68UOi30aHcT.PlfIRMK9U72kx6.jdxrDxRK', 'Suliman', '1654602313_4K-3840x2160-Wallpaper-Uitzicht-7.jpg', NULL, NULL),
(13, 'zakaria.ennaji@outlook.com', '[]', '$2y$13$driltOAXHsE3.lXMjPvYWewN8i63e6lMBTsz4MeE0hfhzvvq.Cfhu', 'Zakariaa', '1655982835_HealthOne.jpg', NULL, NULL),
(14, 'alaa@gmai.com', '[]', '$2y$13$LF97wWEsMR8Y7PlH0r9KwuyVsaJgjs.5HTT0C2N1t2R1XO3atTHrO', 'alaa', '1655983172_127.0.0.1.jpg', NULL, NULL),
(15, 'bechoe@gmail.com', '[]', '$2y$13$Y1FNTKFt7dK6MiaXyj01eOz0wPKE.9qQc61WRirustFbryE0Oj5hG', 'Bechoe', '1655985256_zaka.jpg', NULL, NULL);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indexen voor tabel `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Indexen voor tabel `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_42C84955A76ED395` (`user_id`),
  ADD KEY `IDX_42C8495554177093` (`room_id`);

--
-- Indexen voor tabel `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_729F519BB83297E7` (`reservation_id`);

--
-- Indexen voor tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT voor een tabel `room`
--
ALTER TABLE `room`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT voor een tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `FK_42C8495554177093` FOREIGN KEY (`room_id`) REFERENCES `room` (`id`),
  ADD CONSTRAINT `FK_42C84955A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Beperkingen voor tabel `room`
--
ALTER TABLE `room`
  ADD CONSTRAINT `FK_729F519BB83297E7` FOREIGN KEY (`reservation_id`) REFERENCES `reservation` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
