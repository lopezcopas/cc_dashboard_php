-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 26, 2020 at 06:21 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cc_dashboard_php`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `first` varchar(20) NOT NULL,
  `last` varchar(20) NOT NULL,
  `address_line_one` varchar(256) NOT NULL,
  `address_line_two` varchar(256) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(20) NOT NULL,
  `zip` varchar(10) NOT NULL,
  `date_joined` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `first`, `last`, `address_line_one`, `address_line_two`, `city`, `state`, `zip`, `date_joined`) VALUES
(1, 'Copas', 'Lopez', '', '', '', '', '', '2020-06-25 18:00:00'),
(2, 'Shelley', 'Burkett', '', '', '', '', '', '2020-06-25 17:17:46');

-- --------------------------------------------------------

--
-- Table structure for table `customers_email`
--

CREATE TABLE `customers_email` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `email_address` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers_email`
--

INSERT INTO `customers_email` (`id`, `customer_id`, `email_address`) VALUES
(1, 1, 'lopezcopas@gmail.com'),
(2, 2, 'shelley.p.burkett@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `customers_organization`
--

CREATE TABLE `customers_organization` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `organization_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers_organization`
--

INSERT INTO `customers_organization` (`id`, `customer_id`, `organization_id`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `customers_phone`
--

CREATE TABLE `customers_phone` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `phone_number` varchar(14) NOT NULL,
  `extension` varchar(5) NOT NULL,
  `type` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers_phone`
--

INSERT INTO `customers_phone` (`id`, `customer_id`, `phone_number`, `extension`, `type`) VALUES
(1, 1, '(512) 931-9744', '', 'Mobile'),
(2, 2, '(281) 827-6485', '', 'Mobile');

-- --------------------------------------------------------

--
-- Table structure for table `finishing`
--

CREATE TABLE `finishing` (
  `id` int(11) NOT NULL,
  `description` varchar(256) NOT NULL,
  `minimum` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `finishing`
--

INSERT INTO `finishing` (`id`, `description`, `minimum`) VALUES
(1, 'Cutting', 0),
(2, 'Laminating', 2),
(3, 'Hand Trimming', 0.25);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` varchar(9) NOT NULL,
  `description` varchar(100) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `organization_id` int(11) NOT NULL,
  `taken_date` timestamp NULL DEFAULT NULL,
  `proof_date` datetime DEFAULT NULL,
  `due_date` datetime DEFAULT NULL,
  `editing_user` int(11) DEFAULT NULL,
  `location` varchar(20) NOT NULL,
  `payment_status` varchar(20) NOT NULL,
  `total` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `description`, `customer_id`, `organization_id`, `taken_date`, `proof_date`, `due_date`, `editing_user`, `location`, `payment_status`, `total`) VALUES
('C-2196389', '', 2, 2, '2020-06-24 22:00:00', NULL, '2020-06-26 16:00:00', NULL, 'Production', 'Pending', 0),
('C-5381344', 'Invites', 1, 0, '2020-06-25 15:00:00', NULL, '2020-06-25 16:00:00', NULL, 'Printing', 'Pending', 15.07),
('C-7266552', 'Summer Flyers', 1, 1, '2020-06-25 23:00:00', '2020-06-26 12:00:00', NULL, NULL, 'Holding', 'Pending', 29.23);

-- --------------------------------------------------------

--
-- Table structure for table `orders_finishing`
--

CREATE TABLE `orders_finishing` (
  `id` int(11) NOT NULL,
  `order_item_id` varchar(11) NOT NULL,
  `finishing_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders_finishing`
--

INSERT INTO `orders_finishing` (`id`, `order_item_id`, `finishing_id`) VALUES
(1, '2', 1),
(2, '3', 2),
(3, '3', 3);

-- --------------------------------------------------------

--
-- Table structure for table `orders_items`
--

CREATE TABLE `orders_items` (
  `id` int(11) NOT NULL,
  `order_id` varchar(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `type` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL,
  `total` float NOT NULL,
  `quantity` int(6) NOT NULL,
  `width` float NOT NULL,
  `height` float NOT NULL,
  `duplex` tinyint(1) NOT NULL,
  `color` varchar(20) NOT NULL,
  `stock` int(11) NOT NULL,
  `note` varchar(256) NOT NULL,
  `address_line_one` varchar(256) NOT NULL,
  `address_line_two` varchar(256) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(20) NOT NULL,
  `zip` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders_items`
--

INSERT INTO `orders_items` (`id`, `order_id`, `name`, `type`, `status`, `total`, `quantity`, `width`, `height`, `duplex`, `color`, `stock`, `note`, `address_line_one`, `address_line_two`, `city`, `state`, `zip`) VALUES
(1, 'C-7266552', 'Flyers', 'Printing', 'Incomplete', 27, 50, 8.5, 11, 0, 'Color', 1, '', '', '', '', '', ''),
(2, 'C-5381344', 'Invitations', 'Printing', 'Incomplete', 13.92, 50, 5, 7, 1, 'Color', 1, '', '', '', '', '', ''),
(3, 'C-2196389', 'Flyers', 'Printing', 'Incomplete', 0, 16, 8.5, 11, 0, 'Color', 2, '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `organizations`
--

CREATE TABLE `organizations` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone_number` varchar(14) DEFAULT NULL,
  `isTaxExempt` tinyint(1) NOT NULL,
  `tax_id` varchar(10) DEFAULT NULL,
  `hasAccount` tinyint(1) NOT NULL,
  `account_id` varchar(10) DEFAULT NULL,
  `account_contact` int(11) DEFAULT NULL,
  `useContractPricing` tinyint(1) NOT NULL,
  `contract_pricing_id` int(11) DEFAULT NULL,
  `address_line_one` varchar(256) DEFAULT NULL,
  `address_line_two` varchar(256) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(20) DEFAULT NULL,
  `zip` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `organizations`
--

INSERT INTO `organizations` (`id`, `name`, `phone_number`, `isTaxExempt`, `tax_id`, `hasAccount`, `account_id`, `account_contact`, `useContractPricing`, `contract_pricing_id`, `address_line_one`, `address_line_two`, `city`, `state`, `zip`) VALUES
(1, 'Copy Corner', '(979) 694-2679', 0, '', 1, 'COPY', 1, 1, 1, '2307 Texas Ave. S', 'Suite B', 'College Station', 'Texas', '77845'),
(2, 'Fuzzy\'s Taco Shop', NULL, 0, NULL, 0, NULL, 2, 0, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `statuses`
--

CREATE TABLE `statuses` (
  `id` int(11) NOT NULL,
  `status` varchar(100) NOT NULL,
  `color` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `statuses`
--

INSERT INTO `statuses` (`id`, `status`, `color`) VALUES
(1, 'Holding', 'rgb(200, 0, 0)');

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `id` int(11) NOT NULL,
  `description` varchar(256) NOT NULL,
  `coating` int(1) NOT NULL,
  `width` float NOT NULL,
  `height` float NOT NULL,
  `type` varchar(20) NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`id`, `description`, `coating`, `width`, `height`, `type`, `modified`) VALUES
(1, '28# Matte Text 8.5x11', 0, 8.5, 11, 'text', '2020-06-25 18:00:00'),
(2, '80# Matte Cover 8.5x11', 0, 8.5, 11, 'cover', '2020-06-25 20:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers_email`
--
ALTER TABLE `customers_email`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers_organization`
--
ALTER TABLE `customers_organization`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers_phone`
--
ALTER TABLE `customers_phone`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `finishing`
--
ALTER TABLE `finishing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders_finishing`
--
ALTER TABLE `orders_finishing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders_items`
--
ALTER TABLE `orders_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `organizations`
--
ALTER TABLE `organizations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `statuses`
--
ALTER TABLE `statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customers_email`
--
ALTER TABLE `customers_email`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customers_organization`
--
ALTER TABLE `customers_organization`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customers_phone`
--
ALTER TABLE `customers_phone`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `finishing`
--
ALTER TABLE `finishing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders_finishing`
--
ALTER TABLE `orders_finishing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders_items`
--
ALTER TABLE `orders_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `organizations`
--
ALTER TABLE `organizations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `statuses`
--
ALTER TABLE `statuses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
