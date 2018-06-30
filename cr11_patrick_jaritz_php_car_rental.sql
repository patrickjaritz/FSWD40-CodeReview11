-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Erstellungszeit: 30. Jun 2018 um 12:36
-- Server-Version: 10.1.33-MariaDB
-- PHP-Version: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `cr11_patrick_jaritz_php_car_rental`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `car`
--

CREATE TABLE `car` (
  `car_id` int(11) NOT NULL,
  `car_type` varchar(55) DEFAULT NULL,
  `car_name` varchar(55) DEFAULT NULL,
  `gps_lat` int(11) DEFAULT NULL,
  `gps_long` int(11) DEFAULT NULL,
  `fk_office_id` int(11) DEFAULT NULL,
  `available` varchar(9) DEFAULT NULL,
  `fk_office_lat` int(11) DEFAULT NULL,
  `fk_office_long` int(11) DEFAULT NULL,
  `car_image` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `car`
--

INSERT INTO `car` (`car_id`, `car_type`, `car_name`, `gps_lat`, `gps_long`, `fk_office_id`, `available`, `fk_office_lat`, `fk_office_long`, `car_image`) VALUES
(1, 'Van', 'VW', NULL, NULL, 1, 'yes', NULL, NULL, 'https://cdn.mattaki.com/volkswagen/static-assets/vehicles/content-pieces/transporter/grades/crewvan.png'),
(2, 'Sports', 'Ferrari', NULL, NULL, 2, 'yes', NULL, NULL, 'https://www.beneluxcar.es/wp-content/uploads/2017/04/f12_berlinetta.png'),
(3, 'Coupe', 'Audi', NULL, NULL, 3, 'yes', NULL, NULL, 'https://st.motortrend.ca/uploads/sites/10/2015/11/2016-audi-s5-coupe-premium-plus-coupe-angular-front.png'),
(4, 'Limousine', 'Mercedes', NULL, NULL, 4, 'yes', NULL, NULL, 'https://www.luxorlimo.com/uploads/CatalogPhotoModel/326/image/2014-mercedes-benz-s550high.details-front.png'),
(5, 'Sports', 'Lamborghini', NULL, NULL, 5, 'yes', NULL, NULL, 'http://pngimg.com/uploads/lamborghini/lamborghini_PNG10683.png'),
(6, 'Coupe', 'Tesla', NULL, NULL, 1, 'no', NULL, NULL, 'http://www.tesladealer.com/wp-content/uploads/2014/03/tesla-car-4.png'),
(7, 'Limousine', 'BMW', NULL, NULL, 2, 'yes', NULL, NULL, 'https://www.mountainlimo.ca/wp-content/uploads/2017/09/BMW-7-Series-Sedan.png'),
(8, 'Sports', 'Peugeot', NULL, NULL, 3, 'yes', NULL, NULL, 'https://purepng.com/public/uploads/large/purepng.com-peugeot-vision-gran-turismo-carcarvehicletransportpeugeot-9615246602850wdib.png'),
(9, 'Coupe', 'Citroen', NULL, NULL, 4, 'yes', NULL, NULL, 'http://www.citroenorigins.fr/sites/default/files/styles/1600/public/cx_46_1620x1000.png?itok=Jw6jXv3p'),
(10, 'Limousine', 'Jaguar', NULL, NULL, 5, 'yes', NULL, NULL, 'https://di-uploads-pod6.dealerinspire.com/jaguarcoloradosprings/uploads/2016/03/Jag_XJ_190615_22.png'),
(11, 'Sports', 'Porsche', NULL, NULL, 1, 'no', NULL, NULL, 'http://pngimg.com/uploads/porsche/porsche_PNG10625.png'),
(12, 'Van', 'Renault', NULL, NULL, 2, 'yes', NULL, NULL, 'http://www.newvehiclesolutions.co.uk/system/models/images/000/015/942/original/Screen_Shot_2016-02-11_at_18.03.25.png'),
(13, 'Limousine', 'Volvo', NULL, NULL, 3, 'yes', NULL, NULL, 'https://www.sixt.co.uk/fileadmin/_processed_/csm_volvo-s60-4d-blau-2014_f5c52040f3.png');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `first_name` varchar(21) DEFAULT NULL,
  `last_name` varchar(21) DEFAULT NULL,
  `user_email` varchar(55) DEFAULT NULL,
  `user_pass` int(21) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `customer`
--

INSERT INTO `customer` (`customer_id`, `first_name`, `last_name`, `user_email`, `user_pass`) VALUES
(2, 'Susi', 'Flusi', 'susi@mail.com', 1111111),
(4, 'Anna', 'Bananna', 'anna@mail.com', 1111111),
(5, 'Peter', 'Kneter', 'peter@mail.com', 1111111),
(6, 'Patze', 'Bratze', 'patze@mail.com', 1111111);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `office`
--

CREATE TABLE `office` (
  `office_id` int(11) NOT NULL,
  `office_name` varchar(55) DEFAULT NULL,
  `office_address` varchar(55) DEFAULT NULL,
  `office_lat` float(11,8) DEFAULT NULL,
  `office_long` float(11,8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `office`
--

INSERT INTO `office` (`office_id`, `office_name`, `office_address`, `office_lat`, `office_long`) VALUES
(1, 'Landstrasse Office', 'Am Heumarkt 2a', 48.20451355, 16.37922859),
(2, 'City Office', 'Coburgbastei 4', 48.20586014, 16.37446022),
(3, 'Brigittenau Office', 'Wallensteinstrasse 59', 48.23134613, 16.37383842),
(4, 'Doebling Office', 'Grinzinger Strasse 86', 48.25382233, 16.35650253),
(5, 'Neubau Office', 'Schottenfeldgasse 3', 48.19723129, 16.34163666);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `car`
--
ALTER TABLE `car`
  ADD PRIMARY KEY (`car_id`),
  ADD KEY `fk_office_id` (`fk_office_id`);

--
-- Indizes für die Tabelle `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indizes für die Tabelle `office`
--
ALTER TABLE `office`
  ADD PRIMARY KEY (`office_id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT für Tabelle `office`
--
ALTER TABLE `office`
  MODIFY `office_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `car`
--
ALTER TABLE `car`
  ADD CONSTRAINT `car_ibfk_1` FOREIGN KEY (`fk_office_id`) REFERENCES `office` (`office_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
