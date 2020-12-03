-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 03, 2020 at 03:20 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cab`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_location`
--

CREATE TABLE `tbl_location` (
  `id` int(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `distance` bigint(255) NOT NULL,
  `is_available` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_location`
--

INSERT INTO `tbl_location` (`id`, `name`, `distance`, `is_available`) VALUES
(1, 'Charbagh', 0, 1),
(2, 'Indranagar', 10, 1),
(3, 'BBD', 30, 1),
(4, 'Barabanki', 60, 1),
(5, 'Faizabad', 100, 1),
(6, 'Basti', 150, 1),
(7, 'Gorakhpur', 210, 1),
(10, 'SRMCEM', 40, 1),
(11, 'polytechnic', 25, 0),
(12, 'tiwarganj', 30, 0),
(13, 'mahanagar', 20, 0),
(14, 'erytyhft', 65456, 0),
(15, 'rtjhdrtyh', 67565, 1),
(16, 'asasa', 44, 0),
(17, 'HPR', 1224, 1),
(22, 'sddsd', 33, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ride`
--

CREATE TABLE `tbl_ride` (
  `ride_id` int(50) NOT NULL,
  `ride_date` date NOT NULL,
  `from_distance` varchar(255) NOT NULL,
  `to_distance` varchar(255) NOT NULL,
  `total_distance` bigint(255) NOT NULL,
  `luggage` varchar(255) DEFAULT NULL,
  `total_fare` bigint(255) NOT NULL,
  `status` int(50) NOT NULL,
  `customer_user_id` int(50) NOT NULL,
  `car` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_ride`
--

INSERT INTO `tbl_ride` (`ride_id`, `ride_date`, `from_distance`, `to_distance`, `total_distance`, `luggage`, `total_fare`, `status`, `customer_user_id`, `car`) VALUES
(1, '2020-11-25', 'Charbagh', 'BBD', 30, '5', 605, 2, 4, 'cedmini'),
(2, '2020-11-25', 'Charbagh', 'Gorakhpur', 210, '20', 3260, 2, 4, 'cedsuv'),
(3, '2020-11-25', 'Charbagh', 'Indranagar', 10, '5', 345, 2, 4, 'cedmini'),
(4, '2020-11-25', 'Charbagh', 'Faizabad', 100, '5', 1793, 3, 4, 'cedsuv'),
(5, '2020-11-25', 'Barabanki', 'Charbagh', 60, '5', 1105, 3, 4, 'cedroyal'),
(6, '2020-11-25', 'Charbagh', 'Faizabad', 100, '50', 1593, 1, 4, 'cedmini'),
(8, '2020-11-26', 'Indranagar', 'Faizabad', 90, '', 1421, 0, 8, 'cedroyal'),
(9, '2020-11-26', 'Indranagar', 'Barabanki', 50, '', 915, 0, 8, 'cedroyal'),
(10, '2020-11-26', 'Charbagh', 'Barabanki', 60, '', 785, 2, 8, 'cedmicro'),
(11, '2020-11-26', 'Charbagh', 'Barabanki', 60, '', 785, 0, 8, 'cedmicro'),
(12, '2020-11-26', 'Charbagh', 'Barabanki', 60, '50', 1145, 3, 8, 'cedmini'),
(13, '2020-11-26', 'Charbagh', 'Barabanki', 60, '50', 1145, 1, 8, 'cedmini'),
(15, '2020-11-26', 'Charbagh', 'Faizabad', 100, '30', 1593, 1, 8, 'cedmini'),
(17, '2020-11-26', 'Charbagh', 'Indranagar', 10, '', 0, 3, 4, 'cedmini'),
(18, '2020-11-26', 'Charbagh', 'BBD', 30, '', 0, 3, 4, 'cedmini'),
(19, '2020-11-26', 'Charbagh', 'BBD', 30, '', 0, 3, 4, 'cedmini'),
(20, '2020-11-26', 'Charbagh', 'Charbagh', 0, '', 0, 3, 4, 'cedroyal'),
(69, '2020-12-02', 'Indranagar', 'Barabanki', 50, '', 815, 1, 4, 'cedmini'),
(70, '2020-12-02', 'Indranagar', 'Gorakhpur', 200, '64', 3345, 1, 4, 'cedsuv'),
(71, '2020-12-02', '    ', 'rtjhdrtyh', 67565, '22', 642613, 0, 4, 'cedmini'),
(72, '2020-12-02', 'Indranagar', 'rtjhdrtyh', 67555, '', 709923, 1, 4, 'cedroyal'),
(73, '2020-12-02', 'Indranagar', 'Faizabad', 90, '', 1281, 1, 4, 'cedmini'),
(74, '2020-12-02', 'Indranagar', 'Faizabad', 90, '', 1421, 1, 4, 'cedroyal'),
(75, '2020-12-03', 'Barabanki', 'Basti', 90, '5', 1471, 0, 4, 'cedroyal'),
(76, '2020-12-03', 'Charbagh', 'BBD', 30, '34', 425, 1, 4, 'cedmicro'),
(77, '2020-12-03', 'Barabanki', 'SRMCEM', 20, '', 305, 1, 4, 'cedmicro'),
(78, '2020-12-03', 'Barabanki', 'Basti', 90, '5', 1471, 1, 4, 'cedroyal'),
(79, '2020-12-03', 'Indranagar', 'Barabanki', 50, '', 665, 1, 4, 'cedmicro'),
(80, '2020-12-03', 'Indranagar', 'Faizabad', 90, '4', 1331, 1, 4, 'cedmini');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` int(50) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `dateofsignup` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `isblock` tinyint(1) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `user_name`, `name`, `dateofsignup`, `mobile`, `isblock`, `password`, `is_admin`) VALUES
(1, 'admin@gmail.com', 'admin', '2020-11-24 05:16:41', '4567891230', 1, '21232f297a57a5a743894a0e4a801fc3', 0),
(3, 'abc@gmail.com', 'vaib', '2020-12-02 12:46:29', '446578562', 1, 'e99a18c428cb38d5f260853678922e03', 1),
(4, 'vibhuvishu@gmail.com', 'vaibhav 3434', '2020-12-03 12:01:30', 'nnj', 1, 'b0baee9d279d34fa1dfd71aadb908c3f', 1),
(6, 'sarthak@gmail.com', 'sarthak', '2020-12-01 09:14:01', '7894561230', 1, '5b9b2c4eb6d27e0d8e26f828f64528c2', 1),
(8, 'ashutosh@gmail.com', 'ashutosh', '2020-11-30 05:49:33', '7894561230', 1, '87f5ce84d66c6ca661f614213858b0b4', 1),
(10, 'shanker@gmail.com', 'shanker', '2020-11-30 05:48:58', '7894561230', 1, 'e10adc3949ba59abbe56e057f20f883e', 1),
(12, 'ravi@gmail.com', 'ravi', '2020-12-03 12:00:38', '7894561230', 1, '123', 1),
(14, 'arch@gmail.com', 'arch', '2020-12-01 09:17:45', '7894561230', 1, '123', 1),
(15, 'princeshukla4321@gmail.com', 'Pranjal', '2020-12-01 01:41:51', '8543914016', 1, 'pranjal@123', 1),
(16, 'mohdaniyal@gmail.com', 'daniyal', '2020-12-01 01:44:41', '7894561230', 1, '123', 1),
(17, 'ayush@gmail.com', 'ayush', '2020-12-01 01:50:06', '123456789', 1, '202cb962ac59075b964b07152d234b70', 1),
(18, 'k@ll', 'k', '2020-12-01 01:59:16', '8543914016', 1, '8ce4b16b22b58894aa86c421e8759df3', 1),
(19, 'xyz@cedcoss.com', 'xyz', '2020-12-01 03:05:54', '7878', 1, '202cb962ac59075b964b07152d234b70', 1),
(20, 'roy01@ced.com', 'ram01', '2020-12-01 03:05:08', '77777777', 1, '202cb962ac59075b964b07152d234b70', 1),
(21, 'shashank@gmail.com', 'shashank', '2020-12-02 10:49:42', '7894561230', 0, '202cb962ac59075b964b07152d234b70', 1),
(22, 'ragu@gmail.com', 'ragu', '2020-12-02 04:00:02', '1234567889', 1, '202cb962ac59075b964b07152d234b70', 1),
(23, 'adad@gmail.com', 'adad', '2020-12-02 11:32:05', '123', 0, '202cb962ac59075b964b07152d234b70', 1),
(24, 'aa@gmail.com', 'aa', '2020-12-02 11:42:51', '34255345', 0, '6512bd43d9caa6e02c990b0a82652dca', 1),
(25, 'fhfgh@nh', 'dffg', '2020-12-02 11:44:14', '234345', 0, '6512bd43d9caa6e02c990b0a82652dca', 1),
(26, 'vaibhavsri618@gmail.com', 'ashutosh', '2020-12-03 10:22:40', '7894', 1, '202cb962ac59075b964b07152d234b70', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_location`
--
ALTER TABLE `tbl_location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_ride`
--
ALTER TABLE `tbl_ride`
  ADD PRIMARY KEY (`ride_id`),
  ADD KEY `id` (`customer_user_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_name` (`user_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_location`
--
ALTER TABLE `tbl_location`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tbl_ride`
--
ALTER TABLE `tbl_ride`
  MODIFY `ride_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_ride`
--
ALTER TABLE `tbl_ride`
  ADD CONSTRAINT `id` FOREIGN KEY (`customer_user_id`) REFERENCES `tbl_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
