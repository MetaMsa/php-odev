-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 01 Oca 2025, 21:42:53
-- Sunucu sürümü: 10.4.32-MariaDB
-- PHP Sürümü: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `if0_37485059_odev`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `dershaneler`
--

CREATE TABLE `dershaneler` (
  `name` varchar(50) CHARACTER SET latin5 COLLATE latin5_turkish_ci NOT NULL,
  `ID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `dershaneler`
--

INSERT INTO `dershaneler` (`name`, `ID`) VALUES
('Final Dershanesi', 12),
('Birey', 15);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `maaslar`
--

CREATE TABLE `maaslar` (
  `ID` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `miktar` int(11) NOT NULL,
  `tarih` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `maaslar`
--

INSERT INTO `maaslar` (`ID`, `userId`, `miktar`, `tarih`) VALUES
(53, 17, 50000, '2025-01-01'),
(54, 23, 25000, '2025-01-01'),
(55, 24, 50000, '2025-01-01'),
(56, 17, 50000, '0000-00-00'),
(57, 17, 50000, '0000-00-00'),
(58, 17, 50000, '0000-00-00'),
(59, 23, 25000, '0000-00-00'),
(60, 23, 25000, '0000-00-00'),
(61, 23, 25000, '0000-00-00');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `notlar`
--

CREATE TABLE `notlar` (
  `ID` int(11) NOT NULL,
  `notu` tinyint(3) DEFAULT NULL,
  `ogrenciId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `notlar`
--

INSERT INTO `notlar` (`ID`, `notu`, `ogrenciId`) VALUES
(4, 100, 28),
(5, 0, 29),
(6, 0, 30),
(7, 0, 31),
(8, 0, 32),
(9, 0, 33),
(10, 0, 34),
(11, 0, 35),
(12, 5, 28),
(13, 50, 28),
(14, 10, 28),
(15, 10, 28),
(17, 0, 29),
(20, 0, 36),
(21, 0, 37),
(22, 0, 38),
(23, 0, 39),
(24, 0, 40);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `students`
--

CREATE TABLE `students` (
  `Ad` varchar(50) CHARACTER SET latin5 COLLATE latin5_turkish_ci NOT NULL,
  `Sinif` int(11) NOT NULL,
  `ucret` int(11) NOT NULL,
  `ID` int(11) NOT NULL,
  `dershane_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `students`
--

INSERT INTO `students` (`Ad`, `Sinif`, `ucret`, `ID`, `dershane_id`) VALUES
('Mehmet Serhat', 12, 50000, 28, 12),
('Ali Veli', 9, 10000, 29, 12),
('Osman', 11, 30000, 30, 12),
('Yeliz', 9, 20000, 31, 12),
('zeki', 11, 30000, 32, 12),
('zeki', 11, 30000, 33, 15),
('Ali', 9, 10000, 34, 12),
('Ali', 9, 10000, 35, 12),
('sadasd', 9, 20000, 36, 12),
('Mehmet Serhat', 12, 50000, 37, 12),
('Mehmet Serhat', 12, 50000, 38, 12),
('Mehmet Serhat', 12, 50000, 39, 12),
('Mehmet Serhat', 12, 50000, 40, 12);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `name` varchar(50) CHARACTER SET latin5 COLLATE latin5_turkish_ci NOT NULL,
  `email` varchar(50) CHARACTER SET latin5 COLLATE latin5_turkish_ci NOT NULL,
  `date` date NOT NULL,
  `password` varchar(50) CHARACTER SET latin5 COLLATE latin5_turkish_ci NOT NULL,
  `roles` int(10) NOT NULL,
  `dershane_id` int(10) NOT NULL,
  `ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`name`, `email`, `date`, `password`, `roles`, `dershane_id`, `ID`) VALUES
('Mehmet Serhat ASLAN', 'mehmetserhataslan955@gmail.com', '2005-01-01', '20052005Msa!', 2, 12, 17),
('ms', 'mehmetserhataslan955@gmail.com', '2005-01-01', '20052005Msa!', 1, 12, 23),
('Birey', 'mehmetserhataslan955@gmail.com', '2005-12-01', '20052005Msas!', 2, 15, 24);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `dershaneler`
--
ALTER TABLE `dershaneler`
  ADD PRIMARY KEY (`ID`);

--
-- Tablo için indeksler `maaslar`
--
ALTER TABLE `maaslar`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `userId` (`userId`);

--
-- Tablo için indeksler `notlar`
--
ALTER TABLE `notlar`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ogrenciId` (`ogrenciId`);

--
-- Tablo için indeksler `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `dershaneid` (`dershane_id`) USING BTREE;

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `dershaneid` (`dershane_id`) USING BTREE;

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `dershaneler`
--
ALTER TABLE `dershaneler`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Tablo için AUTO_INCREMENT değeri `maaslar`
--
ALTER TABLE `maaslar`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- Tablo için AUTO_INCREMENT değeri `notlar`
--
ALTER TABLE `notlar`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Tablo için AUTO_INCREMENT değeri `students`
--
ALTER TABLE `students`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `maaslar`
--
ALTER TABLE `maaslar`
  ADD CONSTRAINT `maaslar_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Tablo kısıtlamaları `notlar`
--
ALTER TABLE `notlar`
  ADD CONSTRAINT `notlar_ibfk_1` FOREIGN KEY (`ogrenciId`) REFERENCES `students` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Tablo kısıtlamaları `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `relstu` FOREIGN KEY (`dershane_id`) REFERENCES `dershaneler` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Tablo kısıtlamaları `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `rel` FOREIGN KEY (`dershane_id`) REFERENCES `dershaneler` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
