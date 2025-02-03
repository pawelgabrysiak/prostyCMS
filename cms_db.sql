-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 02, 2025 at 05:28 PM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms_db`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `summary` text NOT NULL,
  `content` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `format` enum('top-image','text-wrap','no-image') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `title`, `summary`, `content`, `image`, `format`, `created_at`) VALUES
(1, 'Pierwszy artykuł', 'To jest testowe streszczenie', 'To jest pełna treść artykułu', NULL, 'top-image', '2025-02-01 16:55:01'),
(2, 'Leo Messi', 'Artykuł o Leo Messim', 'Lionel Andrés Messi, urodzony 24 czerwca 1987 roku w Rosario, to jeden z najlepszych piłkarzy w historii futbolu. Przez ponad dwie dekady swojej kariery zachwycał kibiców niezwykłą techniką, szybkością i niesamowitym dryblingiem.\r\n\r\nSwoją legendę zbudował głównie w FC Barcelonie, gdzie spędził ponad 20 lat, zdobywając rekordową liczbę trofeów i tytułów. W barwach „Blaugrany” wygrał m.in. 10 mistrzostw Hiszpanii, 4 Ligi Mistrzów i 7 Złotych Piłek. W 2021 roku przeniósł się do PSG, a obecnie gra w Inter Miami.\r\n\r\nNajwiększym sukcesem w jego karierze było zdobycie Mistrzostwa Świata 2022 z reprezentacją Argentyny, co przypieczętowało jego status legendy futbolu. Messi jest nie tylko wybitnym sportowcem, ale także inspiracją dla milionów ludzi na całym świecie.\r\n\r\nKluby: FC Barcelona, PSG, Inter Miami\r\nNajważniejsze osiągnięcia: Mistrz Świata 2022, 8x Złota Piłka, rekord strzelonych goli w La Liga\r\nCytat: „Decyzje podejmuję na boisku. Piłka nożna to moja pasja.”\r\n\r\nCzy Lionel Messi to najlepszy piłkarz w historii? Dla wielu odpowiedź jest prosta – TAK!', 'messi.jpeg', 'top-image', '2025-02-01 18:08:39'),
(4, 'Lockheed SR-71 Blackbird', 'Niezwykły Samolot Szpiegowski', 'Historia i Konstrukcja\r\nLockheed SR-71 Blackbird to jeden z najbardziej zaawansowanych samolotów rozpoznawczych w historii lotnictwa. Został opracowany przez Lockheed Skunk Works na zlecenie USAF w latach 60. XX wieku, aby zastąpić U-2 i zapewnić wywiadowcze możliwości na najwyższym poziomie.\r\n\r\nSR-71 mógł operować na ekstremalnych wysokościach (ponad 26 000 metrów) i osiągać prędkości przekraczające 3 500 km/h (Mach 3.3), co pozwalało mu unikać większości zagrożeń, takich jak wrogie myśliwce i systemy obrony przeciwlotniczej.\r\n\r\nTechnologie i Osiągi\r\nKadłub wykonany z tytanu – zapewniał odporność na ekstremalne temperatury powstałe przy dużych prędkościach.\r\nSilniki Pratt & Whitney J58 – zaprojektowane specjalnie do pracy w trybie strumieniowym, zwiększały wydajność w prędkościach hipersonicznych.\r\nSystem kamer i sensorów – umożliwiał SR-71 przechwytywanie wysokiej jakości zdjęć i danych wywiadowczych z dużych wysokości.\r\n\r\nRekordy i Sukcesy\r\nSR-71 pobił wiele rekordów prędkości i wysokości lotu, a żaden z 32 wyprodukowanych egzemplarzy nigdy nie został zestrzelony – wrogowie nie byli w stanie go dogonić!\r\n\r\nNajważniejsze rekordy SR-71:\r\nNajwyższa prędkość lotu: 3 529 km/h (Mach 3.3)\r\nNajwyższy lot: 25 929 metrów\r\nNajkrótszy lot z Los Angeles do Waszyngtonu: 64 minuty!\r\n\r\n Znaczenie i Wycofanie\r\nSR-71 służył do rozpoznania strategicznego podczas Zimnej Wojny, dostarczając kluczowych informacji wywiadowczych dla Stanów Zjednoczonych. Pomimo jego fenomenalnych osiągów, rozwój satelitów szpiegowskich i dronów sprawił, że samolot został wycofany w 1998 roku.\r\n\r\nDziś SR-71 Blackbird pozostaje ikoną inżynierii lotniczej, a jego konstrukcja wciąż inspiruje nowe technologie w lotnictwie wojskowym.', 'Lockheed_SR-71_Blackbird.jpg', 'top-image', '2025-02-02 11:45:27');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'admin', '0192023a7bbd73250516f069df18b500');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
