-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 30, 2024 at 10:48 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `multicurrency_payment_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `account_id` int(11) NOT NULL,
  `account_name` varchar(50) NOT NULL,
  `account_type` varchar(40) DEFAULT NULL,
  `currency` varchar(70) DEFAULT NULL,
  `balance` int(11) NOT NULL,
  `date` date NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`account_id`, `account_name`, `account_type`, `currency`, `balance`, `date`, `user_id`) VALUES
(1, 'fixed_account', 'Savings', 'EUR', 5000, '2023-03-08', 3),
(2, 'Investment Account', 'Investment', 'GBP', 3000, '2023-03-08', 2),
(3, 'wesdfghj', 'erty', 'erty', 3456, '2001-12-15', 1);

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(50) NOT NULL,
  `admin_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_name`, `email`, `password`) VALUES
(1, 'fidelite', 'fidelite@gmail.com', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `invoice_id` int(11) NOT NULL,
  `invoice_name` varchar(60) DEFAULT NULL,
  `invoice_amount` int(11) NOT NULL,
  `due_date` date NOT NULL,
  `account_id` int(11) DEFAULT NULL,
  `transaction_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`invoice_id`, `invoice_name`, `invoice_amount`, `due_date`, `account_id`, `transaction_id`) VALUES
(1, 'sales_invoice', 1000, '2023-09-15', 3, 3),
(2, 'purchase_invoice', 2000, '2023-09-15', 4, 4),
(3, 'sale_invoice', 3000, '2023-09-15', 5, 3),
(4, 'sales_invoice', 234, '2024-04-10', 1, 1),
(5, 'purchase_invoice', 345678, '2024-04-15', 3, 3),
(6, 'purchase_invoice', 34567, '2024-04-01', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `Payment_id` int(11) NOT NULL,
  `payment_name` varchar(40) DEFAULT NULL,
  `date` date NOT NULL,
  `payment_amount` int(11) NOT NULL,
  `receipt` varchar(50) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `transaction_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`Payment_id`, `payment_name`, `date`, `payment_amount`, `receipt`, `user_id`, `transaction_id`) VALUES
(1, 'Payment 2', '2023-03-09', 2000, 'receipt2.pdf', 1, 2),
(2, 'Payment 3', '2023-03-10', 3000, 'receipt3.pdf', 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `transaction_currency`
--

CREATE TABLE `transaction_currency` (
  `transaction_id` int(11) NOT NULL,
  `transaction_code` varchar(3) NOT NULL,
  `exchange_rate` decimal(10,2) NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaction_currency`
--

INSERT INTO `transaction_currency` (`transaction_id`, `transaction_code`, `exchange_rate`, `user_id`) VALUES
(1, 'USD', 1.23, 2),
(2, 'EUR', 1.34, 5),
(3, 'GBP', 1.45, 3),
(4, 'fg', 345.80, 1),
(5, 'RWF', 23.60, 1),
(6, 'RWF', 23.60, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(50) NOT NULL,
  `user_name` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `address` varchar(40) DEFAULT NULL,
  `phone_number` varchar(10) DEFAULT NULL,
  `gender` varchar(11) NOT NULL,
  `user_currency` varchar(70) DEFAULT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `email`, `address`, `phone_number`, `gender`, `user_currency`, `password`) VALUES
(1, 'Jane ', 'jane@gmail.com', 'France', '109758351', 'female', 'EUR', ''),
(2, 'Smith', 'smith@gmail.com', 'Rwanda', '0785583546', 'male', 'RWF', ''),
(3, 'fils', 'fils@gmail.com', 'Rwanda', '+250785432', 'male', 'RWF', '12345'),
(4, 'kevine', 'kevine@gmail.com', 'RWANDA', '+234151789', 'female', 'RWF', '12345'),
(5, 'fifi', 'fifi@gmail.com', 'rwanda', '23456789', 'female', 'RWF', '12345'),
(6, 'didi', 'didi@gmail.com', 'rwanda', '23456789', 'female', 'RWF', '12345'),
(7, 'murara', 'murara@gmail.com', 'rwanda', '234567', 'male', 'rwf', '12345'),
(8, 'keke', 'keke@gmail.com', 'Rwanda', '+250962345', 'female', 'Rwf', '123456');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`invoice_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`Payment_id`);

--
-- Indexes for table `transaction_currency`
--
ALTER TABLE `transaction_currency`
  ADD PRIMARY KEY (`transaction_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `invoice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `Payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transaction_currency`
--
ALTER TABLE `transaction_currency`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
