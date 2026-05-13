-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 13, 2026 at 11:10 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `casio`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `username` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`, `username`) VALUES
(1, 'admin@gmail.com', 'superuser', 'thuehtet');

-- --------------------------------------------------------

--
-- Table structure for table `ads`
--

CREATE TABLE `ads` (
  `id` int(11) NOT NULL,
  `img` text NOT NULL,
  `name` text NOT NULL,
  `qty` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `des` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ads`
--

INSERT INTO `ads` (`id`, `img`, `name`, `qty`, `price`, `des`) VALUES
(7, 'bg3.avif', 'New Model', 0, 23432432, 'The most pupular in 2026!!!!'),
(8, 'bg9.png', 'New Moel', 23, 400000, 'sldfjlsdjflsdjlfjsdljflsdjfljsdlfjlsdjfljsdlfjsdlkjf'),
(9, 'p4.avif', 'New Model', 23, 3200000, 'sldfjlsdjflsdjlfjsdljflsdjfljsdlfjlsdjfljsdlfjsdlkjf'),
(10, 'g5.avif', 'New Model', 237, 3200000, 'sldfjlsdjflsdjlfjsdljflsdjfljsdlfjlsdjfljsdlfjsdlkjf');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `useremail` text NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `useremail`, `message`) VALUES
(1, 'df@gmail.com', 'df'),
(2, 'test@gmial.com', 'hi that is teset'),
(3, 'test@gmial.com', 'hi'),
(4, 'ngahtetpku350@gmail.com', 'hi'),
(5, 'ngahtetpku350@gmail.com', 'hi'),
(6, 'ngahtetpku350@gmail.com', 'hi'),
(7, 'ngahtetpku350@gmail.com', 'hi');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderid` int(11) NOT NULL,
  `name` text NOT NULL,
  `unitprice` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `totalprice` int(11) NOT NULL,
  `cusname` text NOT NULL,
  `useremail` text NOT NULL,
  `phone` text NOT NULL,
  `address` text NOT NULL,
  `note` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderid`, `name`, `unitprice`, `qty`, `totalprice`, `cusname`, `useremail`, `phone`, `address`, `note`, `time`) VALUES
(19, 'Gshort', 201020, 2, 402040, 'thuehtetnaing', 'thuehtet@gmail.com', '09764931148', 'Hlaing', 'sd', '0000-00-00 00:00:00'),
(20, 'Gshort', 201020, 1, 201020, 'thuehtetnaing', 'thuehtet@gmail.com', '09764931148', 'Hlaing', 'vmsdlfsld', '0000-00-00 00:00:00'),
(21, 'Gshort', 201020, 8, 1608160, 'thuehtetnaing', 'thuehtet@gmail.com', '09764931148', 'Hlaing', 'test', '0000-00-00 00:00:00'),
(22, 'Casio', 300000, 1, 300000, 'thuehtetnaing', 'thuehtet@gmail.com', '09764931148', 'Hlaing', 'test', '2026-05-09 07:50:45'),
(23, 'Casio', 300000, 2, 600000, 'thuehtetnaing', 'thuehtet@gmail.com', '09764931148', 'Hlaing', 'ထမငိး စားတာ', '2026-05-09 10:29:35'),
(24, 'Casio', 300000, 9, 2700000, 'mgthuehtet', 'mgmg@gmail.com', '09764931148', 'Hlaing', 'asd', '2026-05-09 11:12:09'),
(25, 'Gshort', 201020, 30, 6030600, 'mgthuehtet', 'mgmg@gmail.com', '09764931148', 'Hlaing', 'df', '2026-05-10 06:02:09'),
(26, 'test', 23432432, 24, 562378368, 'mgthuehtet', 'mgmg@gmail.com', '09764931148', 'Hlaing', 'that is a testing for the adsorder process', '2026-05-11 16:20:45'),
(27, 'Casio', 300000, 1, 300000, 'thuehtetnaing', 'thuehtetnaing@gmail.com', '09764931148', 'Hlaing', 'sd', '2026-05-12 15:02:03'),
(28, 'Gshort', 201020, 1, 201020, 'thuehtetnaing', 'thuehtetnaing@gmail.com', '09764931148', 'Hlaing', 'that is a testing', '2026-05-12 16:14:13'),
(29, 'Gshort', 201020, 1, 201020, 'thuehtetnaing', 'thuehtetnaing@gmail.com', '09764931148', 'Hlaing', 'vmsdlfsld', '2026-05-12 16:42:41'),
(30, 'Gshort', 201020, 1, 201020, 'thuehtetnaing', 'thuehtetnaing@gmail.com', '09764931148', 'Hlaing', 'test', '2026-05-12 16:42:54'),
(31, 'Casio', 3200000, 19, 60800000, 'thuehtetnaing', 'thuehtetnaing@gmail.com', '09764931148', 'Hlaing', 'asd', '2026-05-12 16:44:43'),
(32, 'Casio', 3200000, 1, 3200000, 'thuehtetnaing', 'thuehtet@gmail.com', '09764931148', 'Hlaing', 'vmsdlfsld', '2026-05-13 04:07:04'),
(33, 'Casio', 300000, 9, 2700000, 'thuehtetnaing', 'thuehtet@gmail.com', '09764931148', 'Hlaing', 'df', '2026-05-13 04:25:17'),
(34, 'New Model', 3200000, 1, 3200000, 'thuehtetnaing', 'thuehtet@gmail.com', '09764931148', 'Hlaing', 'ထမငိး စားတာ', '2026-05-13 08:42:09');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `productid` int(11) NOT NULL,
  `name` text NOT NULL,
  `price` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `des` varchar(255) NOT NULL,
  `productimg` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productid`, `name`, `price`, `qty`, `des`, `productimg`) VALUES
(14, 'G-Shork', 2000000, 90, 'New Model', 'g5.avif'),
(15, 'Casio', 300000, 0, 'New Model', 'g4.avif'),
(16, 'Gshort', 201020, 0, 'sldflksdjf', 'bg3.avif'),
(17, 'Casio', 3200000, 0, 'skfdljsldkfjs', 'image.avif'),
(23, 'casio', 3200000, 23, 'that is new model', 'g9.avif'),
(24, 'BabyG', 3200000, 23, 'ff', 'bg3.avif'),
(25, 'Casio', 300000, 23, 'the new mobel in 2026', 'bg9.png');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userid` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `useremail` text NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userid`, `username`, `useremail`, `password`) VALUES
(6, 'thuehtetnaing', 'ngahtetpku350@gmail.com', 'asd'),
(7, 'thuehtet', 'ngahtetpku350@gmail.com', 'sdf'),
(8, 'thue', 'thuhtetnaing001@gmail.com', 'sd'),
(9, 'test', 'test@gmial.com', 'asd'),
(10, 'thuehtetnaing', 'thuehtet@gmail.com', 'asd'),
(11, 'mgthuehtet', 'mgmg@gmail.com', 'asd'),
(13, 'thuehtetnaing', 'thuehtetnaing@gmail.com', 'superuser');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ads`
--
ALTER TABLE `ads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderid`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ads`
--
ALTER TABLE `ads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orderid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `productid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
