-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 29, 2023 at 01:14 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cars_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(10) NOT NULL,
  `modelYear` int(5) NOT NULL,
  `image` varchar(255) NOT NULL,
  `details` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`id`, `name`, `price`, `modelYear`, `image`, `details`) VALUES
(2, 'Audi', 800000, 2021, '49d9227b72e3edfc.jpeg', 'A car is a vehicle that has wheels, carries a small number of passengers, and is moved by an engine or a motor. Cars are also called automobiles or motor vehicles. Trucks and buses are motor vehicles as well.'),
(6, 'Mercedes', 1200000, 2022, 'fcb120c302c4d6dc.jpeg', 'A car is a vehicle that has wheels, carries a small number of passengers, and is moved by an engine or a motor. Cars are also called automobiles or motor vehicles. Trucks and buses are motor vehicles as well.'),
(7, 'BMW', 1000000, 2020, '6654ac384454d1c6.jpeg', 'A car is a vehicle that has wheels, carries a small number of passengers, and is moved by an engine or a motor. Cars are also called automobiles or motor vehicles. Trucks and buses are motor vehicles as well.'),
(8, 'Range Rover', 1500000, 2023, '050457707b558be0.jpeg', 'A car is a vehicle that has wheels, carries a small number of passengers, and is moved by an engine or a motor. Cars are also called automobiles or motor vehicles. Trucks and buses are motor vehicles as well.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
