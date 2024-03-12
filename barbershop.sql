-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 05, 2021 at 08:42 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `barbershop`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `barber_id` int(10) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `gender` varchar(8) NOT NULL,
  `password` varchar(255) NOT NULL,
  `ic` varchar(15) NOT NULL,
  `phone_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`barber_id`, `username`, `first_name`, `last_name`, `gender`, `password`, `ic`, `phone_number`) VALUES
(1, 'Admin', 'Chong', 'Jing Er', 'Male', 'e64b78fc3bc91bcbc7dc232ba8ec59e0', '970608-10-5161', 1165465123),
(2, 'Andrew', 'Andrew', 'Chong', 'Male', '8aae3a73a9a43ee6b04dfd986fe9d136', '961203-10-5512', 108187792);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_appointment`
--

CREATE TABLE `tbl_appointment` (
  `appt_id` int(10) UNSIGNED NOT NULL,
  `customer_id` int(10) UNSIGNED NOT NULL,
  `barber_id` int(11) UNSIGNED NOT NULL,
  `service_id` int(11) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `timeslot` varchar(255) NOT NULL,
  `isCancel` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_appointment`
--

INSERT INTO `tbl_appointment` (`appt_id`, `customer_id`, `barber_id`, `service_id`, `date`, `timeslot`, `isCancel`) VALUES
(1, 1, 1, 1, '2021-05-03', '10:00AM-10:30AM', 'No'),
(2, 1, 1, 3, '2021-05-03', '10:30AM-11:00AM', 'No'),
(3, 2, 1, 1, '2021-05-06', '11:00AM-11:30AM', 'No'),
(4, 2, 1, 3, '2021-05-06', '11:30AM-12:00PM', 'No'),
(5, 1, 1, 7, '2021-05-06', '12:00PM-12:30PM', 'No'),
(6, 1, 1, 2, '2021-05-06', '12:30PM-13:00PM', 'No'),
(7, 1, 1, 8, '2021-05-06', '13:00PM-13:30PM', 'No'),
(8, 3, 1, 1, '2021-05-06', '13:30PM-14:00PM', 'No'),
(9, 3, 1, 3, '2021-05-06', '14:00PM-14:30PM', 'No'),
(10, 3, 1, 6, '2021-05-06', '14:30PM-15:00PM', 'No'),
(11, 4, 1, 4, '2021-05-06', '15:00PM-15:30PM', 'No'),
(12, 4, 1, 1, '2021-05-06', '15:30PM-16:00PM', 'No'),
(13, 1, 1, 9, '2021-05-11', '17:30PM-18:00PM', 'No'),
(14, 1, 1, 4, '2021-05-12', '21:00PM-21:30PM', 'No'),
(15, 2, 1, 4, '2021-05-13', '16:30PM-17:00PM', 'No'),
(16, 1, 1, 9, '2021-05-13', '20:00PM-20:30PM', 'No'),
(17, 2, 1, 1, '2021-05-17', '20:30PM-21:00PM', 'No'),
(18, 2, 2, 1, '2021-05-14', '20:30PM-21:00PM', 'No'),
(19, 3, 2, 3, '2021-05-17', '10:30AM-11:00AM', 'Yes'),
(20, 4, 2, 3, '2021-05-17', '10:30AM-11:00AM', 'No'),
(22, 1, 2, 9, '2021-05-18', '10:00AM-10:30AM', 'No'),
(23, 2, 1, 5, '2021-05-18', '17:30PM-18:00PM', 'No'),
(24, 1, 1, 1, '2021-05-28', '17:00PM-17:30PM', 'No'),
(25, 1, 2, 5, '2021-06-04', '18:00PM-18:30PM', 'Yes'),
(26, 2, 1, 1, '2021-06-07', '16:00PM-16:30PM', 'Yes'),
(27, 1, 2, 1, '2021-06-25', '17:30PM-18:00PM', 'No'),
(28, 1, 1, 5, '2021-06-10', '20:30PM-21:00PM', 'No'),
(31, 1, 1, 9, '2021-06-11', '14:00PM-14:30PM', 'No'),
(32, 2, 1, 11, '2021-06-18', '17:30PM-18:00PM', 'No'),
(33, 1, 2, 7, '2021-06-18', '16:30PM-17:00PM', 'No'),
(34, 9, 2, 11, '2021-06-24', '21:00PM-21:30PM', 'No'),
(35, 9, 2, 1, '2021-06-25', '18:00PM-18:30PM', 'No');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `category_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`category_id`, `title`, `image_name`, `featured`, `active`) VALUES
(1, 'HAIR', 'Barber_Category_545.PNG', 'Yes', 'Yes'),
(2, 'FACE', 'Barber_Category_986.PNG', 'Yes', 'Yes'),
(3, 'MASSAGE', 'Barber_Category_600.PNG', 'No', 'No'),
(4, 'SHAVE', 'Barber_Category_321.PNG', 'Yes', 'Yes'),
(7, 'Testing', 'Barber_Category_74.jpg', 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer`
--

CREATE TABLE `tbl_customer` (
  `customer_id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `gender` varchar(8) NOT NULL,
  `age` int(11) NOT NULL,
  `phone_number` int(11) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_customer`
--

INSERT INTO `tbl_customer` (`customer_id`, `first_name`, `last_name`, `username`, `password`, `gender`, `age`, `phone_number`, `email`) VALUES
(1, 'Joseph', 'Chong', 'Joseph', '57b3ab04538ef79da1e60396b4cd6aa4', 'male', 22, 1128758216, 'josephchong990108@gmail.com'),
(2, 'Eric', 'Tan', 'Eric', 'b75334bcccbd4d511cd5c6cea4c1ee66', 'male', 22, 172131223, 'erictan@gmail.com'),
(3, 'Kherng', 'ShiRong', 'Kherng', '917784ce799f753ccd0c3799dcb8a832', 'male', 23, 1163374128, 'kherng@gmail.com'),
(4, 'Tan', 'WeiCong', 'Tan', '83936e0bdeb2ef8f0dc1d93faca2ab0e', 'male', 22, 167956546, 'tan@gmail.com'),
(5, 'Irene', 'Chong', 'Irene', 'ff249c1a3448e6d53384c899bcac56c5', 'female', 26, 167952388, 'irene@gmail.com'),
(9, 'Chong', 'Zi Yong', 'Chong99', '950cf39e0866533c8cdc47cb5b278627', 'male', 23, 1166654872, 'ai190188@siswa.uthm.edu.my');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_newsletter`
--

CREATE TABLE `tbl_newsletter` (
  `news_id` int(10) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `ndate` date NOT NULL,
  `edate` date NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_newsletter`
--

INSERT INTO `tbl_newsletter` (`news_id`, `title`, `content`, `image_name`, `ndate`, `edate`, `active`) VALUES
(10, 'SOP', 'Dear customers, remember to follow 3W\'s when you arrive the barbershop. Wear a mask, Wash your hand, Watch your distance. Prevent virus spread is our responsibility.', 'Barber_Newsletter_510.jpg', '2021-06-01', '2021-12-31', 'Yes'),
(11, 'Hari Raya Promotion', 'Get special discount! Selamat Hari Raya!', 'Barber_Newsletter_333.jpg', '2021-06-01', '2021-06-23', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_service`
--

CREATE TABLE `tbl_service` (
  `service_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `category_id` int(11) UNSIGNED NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_service`
--

INSERT INTO `tbl_service` (`service_id`, `title`, `description`, `price`, `category_id`, `featured`, `active`) VALUES
(1, 'HAIR CUT', 'Professional with 35 years hair design experience', '35', 1, 'Yes', 'Yes'),
(2, 'HAIR COLOURING', 'Have your hair coloured to perfection by one of our top stylists.', '129', 1, 'Yes', 'Yes'),
(3, 'HAIR TREATMENT', 'This treatment battles through the first signs of hair loss, which involves our stylist expertly massaging the head to stimulate hair growth and allowing the scalp to absorb nutrients.', '199', 1, 'Yes', 'Yes'),
(4, 'HAIR WASH', 'This service addresses the cleansing and moisturizing of the hair', '10', 1, 'Yes', 'Yes'),
(5, 'FACIAL WASH', 'Deep clean on the face. Look younger, look fresh', '30', 2, 'Yes', 'Yes'),
(6, 'SHAVE AND SHAPE', 'Allow our expert barber to shave and shape your beard for a more stylish look.', '50', 4, 'Yes', 'Yes'),
(7, 'TRADITIONAL HOT TOWEL WET SHAVE', 'T&H pre-shave oil is applied with a luxurious hot towel wrap, followed by a rich shaving cream and finished with a close and comfortable shave.', '60', 4, 'Yes', 'Yes'),
(8, 'HEAD MASSAGE', 'The T&H head massage will leave you relaxed and rejuvenated. The treatment relieves tightness around the neck and shoulders and increases blood circulation, thus increasing concentration and energy.', '60', 3, 'Yes', 'Yes'),
(9, 'FACE MASSAGE', 'Over the years, our master barbers have devised a non-aggressive massage technique, which will help to stimulate, tone and tighten the skin. The massage will also promote lymphatic drainage resulting in a refreshed appearance and leaves your skin looking bright and supple.', '50', 3, 'Yes', 'Yes'),
(11, 'HAIR TATTOO', 'Get a unique and awesome hair tattoo.', '45', 1, 'Yes', 'Yes');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`barber_id`);

--
-- Indexes for table `tbl_appointment`
--
ALTER TABLE `tbl_appointment`
  ADD PRIMARY KEY (`appt_id`),
  ADD KEY `username` (`customer_id`),
  ADD KEY `barber_id` (`barber_id`),
  ADD KEY `service_id` (`service_id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `tbl_newsletter`
--
ALTER TABLE `tbl_newsletter`
  ADD PRIMARY KEY (`news_id`);

--
-- Indexes for table `tbl_service`
--
ALTER TABLE `tbl_service`
  ADD PRIMARY KEY (`service_id`),
  ADD KEY `category_id` (`category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `barber_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_appointment`
--
ALTER TABLE `tbl_appointment`
  MODIFY `appt_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `category_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `customer_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_newsletter`
--
ALTER TABLE `tbl_newsletter`
  MODIFY `news_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_service`
--
ALTER TABLE `tbl_service`
  MODIFY `service_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_appointment`
--
ALTER TABLE `tbl_appointment`
  ADD CONSTRAINT `tbl_appointment_ibfk_1` FOREIGN KEY (`service_id`) REFERENCES `tbl_service` (`service_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_appointment_ibfk_2` FOREIGN KEY (`barber_id`) REFERENCES `tbl_admin` (`barber_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_appointment_ibfk_3` FOREIGN KEY (`customer_id`) REFERENCES `tbl_customer` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_service`
--
ALTER TABLE `tbl_service`
  ADD CONSTRAINT `tbl_service_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `tbl_category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
