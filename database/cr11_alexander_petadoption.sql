-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 28. Mrz 2020 um 16:37
-- Server-Version: 10.4.11-MariaDB
-- PHP-Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `cr11_alexander_petadoption`
--
CREATE DATABASE IF NOT EXISTS `cr11_alexander_petadoption` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `cr11_alexander_petadoption`;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `large`
--

CREATE TABLE `large` (
  `id` int(11) NOT NULL,
  `location` varchar(100) NOT NULL,
  `image` varchar(255) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `hobbies` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `large`
--

INSERT INTO `large` (`id`, `location`, `image`, `name`, `description`, `hobbies`) VALUES
(1, 'Kettenbrueckengasse 6, 1050 Vienna', 'https://cdn.pixabay.com/photo/2017/09/07/23/02/rhodesian-ridgeback-2727035__480.jpg', 'dog', 'The domestic dog is a member of the genus Canis, which forms part of the wolf-like canids, and is the most widely abundant terrestrial carnivore.', 'walking tour'),
(2, 'Kettenbrueckengasse 7, 1050 Vienna', 'https://cdn.pixabay.com/photo/2014/12/11/13/31/cat-564202__480.jpg', 'cat', 'The cat (Felis catus) is a domestic species of small carnivorous mammal.', 'catch mice'),
(3, 'Kettenbrueckengasse 7, 1050 Vienna', 'https://cdn.pixabay.com/photo/2016/09/08/20/44/grey-owl-1655462__480.jpg', 'owl', 'Owls are birds from the order Strigiformes, which includes about 200 species of mostly solitary and nocturnal birds of prey typified by an upright stance, a large, broad head, binocular vision, binaural hearing, sharp talons, and feathers adapted for sile', 'catch mice'),
(4, 'Kettenbrueckengasse 7, 1050 Vienna', 'https://cdn.pixabay.com/photo/2010/12/23/13/36/parrot-4078__480.jpg', 'parrot', 'Parrots, also known as psittacines /ˈsɪtəsaɪnz/,[1][2] are birds of the roughly 393 species in 92 genera comprising the order Psittaciformes, found mostly in tropical and subtropical regions.', 'imitate voice');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `senior`
--

CREATE TABLE `senior` (
  `id` int(11) NOT NULL,
  `location` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `name` varchar(50) NOT NULL,
  `age` int(7) NOT NULL,
  `hobbies` varchar(255) NOT NULL,
  `availability_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `senior`
--

INSERT INTO `senior` (`id`, `location`, `image`, `description`, `name`, `age`, `hobbies`, `availability_date`) VALUES
(1, 'Kettenbrueckengasse 7, 1050 Vienna', 'https://cdn.pixabay.com/photo/2017/10/04/08/42/turtle-2815539__480.png', 'turtle', 'animal', 9, 'walk slowly', '2020-01-01'),
(2, 'Kettenbrueckengasse 7, 1050 Vienna', 'https://cdn.pixabay.com/photo/2015/09/25/19/01/dinosaurs-958011__480.jpg', 'dinosaur', 'animal', 10, 'walk quickly', '2020-01-01'),
(3, 'Kettenbrueckengasse 7, 1050 Vienna', 'https://cdn.pixabay.com/photo/2017/08/16/03/04/chimp-2646308__480.jpg', 'monkey', 'animal', 11, 'climb trees', '2020-01-01'),
(4, 'Kettenbrueckengasse 7, 1050 Vienna', 'https://cdn.pixabay.com/photo/2016/02/15/13/26/horse-1201143__480.jpg', 'horse', 'animal', 12, 'climb trees', '2020-01-01');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `small`
--

CREATE TABLE `small` (
  `id` int(11) NOT NULL,
  `location` varchar(100) NOT NULL,
  `image` varchar(255) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `website` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `small`
--

INSERT INTO `small` (`id`, `location`, `image`, `name`, `description`, `website`) VALUES
(1, 'Kettenbrueckengasse 1, 1050 Vienna', 'https://cdn.pixabay.com/photo/2017/07/25/01/22/cat-2536662__480.jpg', 'cat', 'The cat (Felis catus) is a domestic species of small carnivorous mammal.', 'https://www.zoovienna.at/en/'),
(2, 'Kettenbrueckengasse 2, 1050 Vienna', 'https://cdn.pixabay.com/photo/2016/01/05/17/51/dog-1123016__480.jpg', 'dog', 'The domestic dog (Canis familiaris when considered a distinct species or Canis lupus familiaris when considered a subspecies of the wolf) is a member of the genus Canis (canines), which forms part of the wolf-like canids, and is the most widely abundant t', 'https://www.zoovienna.at/en/'),
(3, 'Kettenbrueckengasse 3, 1050 Vienna', 'https://cdn.pixabay.com/photo/2016/10/01/20/54/mouse-1708347__480.jpg', 'mouse', 'A mouse, plural mice, is a small rodent characteristically having a pointed snout, small rounded ears, a body-length scaly tail, and a high breeding rate.', 'https://www.zoovienna.at/en/'),
(4, 'Kettenbrueckengasse 4, 1050 Vienna', 'https://cdn.pixabay.com/photo/2016/07/29/18/42/spider-1555216__480.jpg', 'spider', 'Spiders (order Araneae) are air-breathing arthropods that have eight legs and chelicerae with fangs able to inject venom.', 'https://www.zoovienna.at/en/');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` enum('user','admin') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `status`) VALUES
(1, 'Alexander Schaedlich', 'aaa@gmail.com', '4f56fe65c8bd5296ca6a5f95faa0d65fb54b1ad8a87a1f816c7206803bcff938', 'admin'),
(2, 'John Doe', 'jjj@gmail.com', '6cee67bc7a4cf88da9fea57255c80b6e699974aaa7911da9a4b7be07dd102054', 'user');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `large`
--
ALTER TABLE `large`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `senior`
--
ALTER TABLE `senior`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `small`
--
ALTER TABLE `small`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `large`
--
ALTER TABLE `large`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT für Tabelle `senior`
--
ALTER TABLE `senior`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT für Tabelle `small`
--
ALTER TABLE `small`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT für Tabelle `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
