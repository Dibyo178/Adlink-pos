-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 05, 2023 at 11:32 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `adlink_pos`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `catid` int(11) NOT NULL,
  `category` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`catid`, `category`) VALUES
(1, 'Mobile'),
(2, 'Laptop'),
(4, 'Computer'),
(6, 'Tablets'),
(9, 'ipad'),
(10, 'bags'),
(11, 'Toys'),
(12, 'Books'),
(13, 'Headphones'),
(14, 'Speakers'),
(15, 'Baby Products'),
(16, 'Furnitures'),
(17, 'Mobile Cases'),
(18, 'Mobile Covers'),
(19, 'Mobile Screen Protectors'),
(20, 'Power Banks'),
(21, 'Pen Drives'),
(22, 'Memory Cards'),
(23, 'Printers'),
(24, 'Monitors'),
(25, 'Security Camaras'),
(26, 'Watches'),
(27, 'Sun Glasses'),
(28, 'Shoes'),
(29, 'Wallets'),
(30, 'Smart Watches'),
(31, 'Hard Disk'),
(32, 'External Hard Disks'),
(33, 'Bluetooth Speakers'),
(34, 'Lens'),
(35, 'Tripod'),
(36, 'Bp Monitors'),
(37, 'Mobile');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer`
--

CREATE TABLE `tbl_customer` (
  `cid` int(11) NOT NULL,
  `c_name` text NOT NULL,
  `c_mobile` varchar(200) NOT NULL,
  `c_address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_customer`
--

INSERT INTO `tbl_customer` (`cid`, `c_name`, `c_mobile`, `c_address`) VALUES
(3, 'hkjj', '01711273896', 'Pathantula, Modina Market, Sylhet'),
(4, 'Loknath Ghani Sorisha Mill', '01711273896', 'xzcvzsvcszdf');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_invoice`
--

CREATE TABLE `tbl_invoice` (
  `invoice_id` int(11) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `order_date` date NOT NULL,
  `subtotal` double NOT NULL,
  `tax` double NOT NULL,
  `discount` double NOT NULL,
  `total` double NOT NULL,
  `paid` double NOT NULL,
  `due` double NOT NULL,
  `payment_type` tinytext NOT NULL,
  `subscription` text NOT NULL,
  `mobile` text NOT NULL,
  `address` text NOT NULL,
  `qty` text NOT NULL,
  `price` text NOT NULL,
  `pid` int(11) NOT NULL,
  `barcode` text NOT NULL,
  `pname` varchar(200) NOT NULL,
  `product_id` text NOT NULL,
  `invid` int(11) NOT NULL,
  `service` int(11) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_invoice`
--

INSERT INTO `tbl_invoice` (`invoice_id`, `customer_name`, `order_date`, `subtotal`, `tax`, `discount`, `total`, `paid`, `due`, `payment_type`, `subscription`, `mobile`, `address`, `qty`, `price`, `pid`, `barcode`, `pname`, `product_id`, `invid`, `service`, `description`) VALUES
(224, 'shourov', '2023-03-23', 1900, 0, 50, 1860, 3300, -1440, 'Bkash', 'Paid', '01711273896', 'Pathantula, Modina Market, Sylhet', '', '', 0, '', '', '', 0, 10, '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_invoice_details`
--

CREATE TABLE `tbl_invoice_details` (
  `id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` double NOT NULL,
  `order_date` date NOT NULL,
  `stock` int(11) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_invoice_details`
--

INSERT INTO `tbl_invoice_details` (`id`, `invoice_id`, `product_id`, `product_name`, `qty`, `price`, `order_date`, `stock`, `description`) VALUES
(326, 224, 7, 'Apple iPad Pro', 1, 650, '2023-03-23', 0, 'dsfdsfdsfds'),
(327, 224, 6, 'Apple MacBook Pro', 1, 1250, '2023-03-23', 0, 'dsfdsfdsfds');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_notify`
--

CREATE TABLE `tbl_notify` (
  `id` int(11) NOT NULL,
  `form_id` int(11) NOT NULL,
  `to_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_notify`
--

INSERT INTO `tbl_notify` (`id`, `form_id`, `to_id`, `message`, `status`) VALUES
(43, 10, 0, '', 0),
(44, 10, 0, '', 0),
(45, 10, 0, '', 0),
(47, 25, 10, 'asdfasdfsada', 0),
(48, 10, 0, '', 0),
(49, 10, 26, 'zsczcd', 0),
(51, 10, 0, '', 0),
(52, 27, 23, 'kaj tik kori koro', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `pid` int(11) NOT NULL,
  `pname` varchar(200) NOT NULL,
  `pcategory` varchar(200) NOT NULL,
  `purchaseprice` float NOT NULL,
  `saleprice` float NOT NULL,
  `pstock` int(11) NOT NULL,
  `pdescription` varchar(250) NOT NULL,
  `pimage` varchar(200) NOT NULL,
  `user_name` varchar(200) NOT NULL,
  `date` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`pid`, `pname`, `pcategory`, `purchaseprice`, `saleprice`, `pstock`, `pdescription`, `pimage`, `user_name`, `date`) VALUES
(5, 'Redmi 5A', 'Mobile', 300, 450, 1, 'Red,Blue,Black color available', '5c738c1e4a813.jpeg', '', ''),
(6, 'Apple MacBook Pro', 'Computer', 1000, 1250, 0, 'Apple MacBook Pro ME865LL/A 13.3-Inch with Retina Display 8GB RAM, 256GB SSD ', '5c738c6be100a.jpg', '', ''),
(7, 'Apple iPad Pro', 'ipad', 500, 650, 79, 'Apple iPad Pro 12.9-Inch 64GB Space Gray', '5c738cf15aa2b.jpg', '', ''),
(8, 'Apple iPad Air', 'ipad', 500, 700, 0, 'Apple iPad Air MD785LL/B (16GB, Wi-FI, Black with Space Gray)', '5c738d2e492d0.jpg', '', ''),
(9, 'Samsung Galaxy Tab', 'Tablets', 500, 650, 68, 'SM-T590NZKAXAR Galaxy Tab A, 10.5\", Black ', '5c738db0931f7.jpg', '', ''),
(10, 'Lenovo Miix 630 Laptop', 'Laptop', 700, 900, 38, 'Qualcomm Snapdragon 835, 4 GB LPDDR4X, 128 GB UFS 2.1, Windows 10 S', '5c738e0089024.jpg', '', ''),
(11, 'Lenovo ThinkPad Helix', 'Laptop', 600, 850, 1, 'Intel Core M Dual-Core, 128GB SSD, 4GB RAM, 11.6\" FHD (1920x1080) Touch Screen  Windows 10  ', '5c738e7aae9a7.jpg', '', ''),
(12, 'Nokia 2 - Android - 8GB', 'Mobile', 500, 750, 998, 'AT&T/T-Mobile/MetroPCS/Cricket/H2O) - 5\" Screen - White   ', '5c738f3b2083c.jpg', '', ''),
(22, 'rtretr', 'Monitors', 234, 450, 20, 'xvxfvgg', '', '', ''),
(23, 'sdfdsfsd', 'Printers', 0, 45, 0, 'xzczxczxc', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_recepintiontoken`
--

CREATE TABLE `tbl_recepintiontoken` (
  `rid` int(11) NOT NULL,
  `r_name` text NOT NULL,
  `r_mobile` text NOT NULL,
  `r_address` text NOT NULL,
  `date` date NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_recepintiontoken`
--

INSERT INTO `tbl_recepintiontoken` (`rid`, `r_name`, `r_mobile`, `r_address`, `date`, `status`) VALUES
(4, 'Loknath Ghani Sorisha Mill', '01711273896', 'xzcvzsvcszdf', '2023-03-16', 'Done');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_token`
--

CREATE TABLE `tbl_token` (
  `tid` int(11) NOT NULL,
  `t_name` text NOT NULL,
  `t_mobile` text NOT NULL,
  `t_address` text NOT NULL,
  `date` date NOT NULL,
  `description` text NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_token`
--

INSERT INTO `tbl_token` (`tid`, `t_name`, `t_mobile`, `t_address`, `date`, `description`, `status`) VALUES
(13, 'Loknath Ghani Sorisha Mill', '01711273896', 'xzcvzsvcszdf', '2023-03-21', 'dgdfgdgdgsg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tokendetails`
--

CREATE TABLE `tbl_tokendetails` (
  `id` int(11) NOT NULL,
  `tid` int(11) NOT NULL,
  `sid` int(11) NOT NULL,
  `s_name` text NOT NULL,
  `qty` int(11) NOT NULL,
  `date` date NOT NULL,
  `total_feet` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tokenproduct`
--

CREATE TABLE `tbl_tokenproduct` (
  `tpid` int(11) NOT NULL,
  `pro_name` text NOT NULL,
  `pro_mobile` text NOT NULL,
  `pro_address` text NOT NULL,
  `pro_date` date NOT NULL,
  `pro_des` text NOT NULL,
  `pro_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_tokenproduct`
--

INSERT INTO `tbl_tokenproduct` (`tpid`, `pro_name`, `pro_mobile`, `pro_address`, `pro_date`, `pro_des`, `pro_status`) VALUES
(1, 'Loknath Ghani Sorisha Mill', '01711273896', 'xzcvzsvcszdf', '2023-03-15', 'sdfgsdfdsfsdfsdfsdf', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `userid` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `useremail` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `role` varchar(50) NOT NULL,
  `image` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`userid`, `username`, `useremail`, `password`, `role`, `image`) VALUES
(23, 'Reception', 'reception@gmail.com', '12345', 'User', ''),
(24, 'Grapics-Room', 'grapics@gmail.com', '12345', 'grapic', ''),
(25, 'Production', 'production@gmail.com', '12345', 'production', ''),
(26, 'warehouse', 'warehouse@gmail.com', '12345', 'warehouse', ''),
(27, 'Admin', 'admin@gmail.com', '12345', 'Admin', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_warehouse`
--

CREATE TABLE `tbl_warehouse` (
  `id` int(11) NOT NULL,
  `w_name` text NOT NULL,
  `w_address` text NOT NULL,
  `w_mobile` text NOT NULL,
  `description` text NOT NULL,
  `date` date NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_warehouse`
--

INSERT INTO `tbl_warehouse` (`id`, `w_name`, `w_address`, `w_mobile`, `description`, `date`, `status`) VALUES
(2, 'Loknath Ghani Sorisha Mill', 'xzcvzsvcszdf', '01711273896', 'dsfsdfsdf', '2023-03-20', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`catid`);

--
-- Indexes for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `tbl_invoice`
--
ALTER TABLE `tbl_invoice`
  ADD PRIMARY KEY (`invoice_id`);

--
-- Indexes for table `tbl_invoice_details`
--
ALTER TABLE `tbl_invoice_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_notify`
--
ALTER TABLE `tbl_notify`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `tbl_recepintiontoken`
--
ALTER TABLE `tbl_recepintiontoken`
  ADD PRIMARY KEY (`rid`);

--
-- Indexes for table `tbl_token`
--
ALTER TABLE `tbl_token`
  ADD PRIMARY KEY (`tid`);

--
-- Indexes for table `tbl_tokendetails`
--
ALTER TABLE `tbl_tokendetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_tokenproduct`
--
ALTER TABLE `tbl_tokenproduct`
  ADD PRIMARY KEY (`tpid`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `tbl_warehouse`
--
ALTER TABLE `tbl_warehouse`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `catid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_invoice`
--
ALTER TABLE `tbl_invoice`
  MODIFY `invoice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=225;

--
-- AUTO_INCREMENT for table `tbl_invoice_details`
--
ALTER TABLE `tbl_invoice_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=328;

--
-- AUTO_INCREMENT for table `tbl_notify`
--
ALTER TABLE `tbl_notify`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tbl_recepintiontoken`
--
ALTER TABLE `tbl_recepintiontoken`
  MODIFY `rid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_token`
--
ALTER TABLE `tbl_token`
  MODIFY `tid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_tokendetails`
--
ALTER TABLE `tbl_tokendetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_tokenproduct`
--
ALTER TABLE `tbl_tokenproduct`
  MODIFY `tpid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `tbl_warehouse`
--
ALTER TABLE `tbl_warehouse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
