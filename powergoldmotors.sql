-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 01, 2021 at 04:57 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `powergoldmotors`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts_table`
--

CREATE TABLE `accounts_table` (
  `id` int(11) NOT NULL,
  `members_id` text NOT NULL,
  `invoice_no` text NOT NULL,
  `invoice_date` text NOT NULL,
  `debit_amount` text NOT NULL,
  `credit_amount` text NOT NULL,
  `blance` text NOT NULL,
  `narration` text NOT NULL,
  `paid_id` text NOT NULL,
  `dues_id` int(11) NOT NULL,
  `blance_id` int(11) NOT NULL,
  `gn_date` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `admin_user`
--

CREATE TABLE `admin_user` (
  `id` int(11) NOT NULL,
  `first_name` text NOT NULL,
  `last_name` text NOT NULL,
  `username` text,
  `password` text,
  `role` text,
  `role_id` text,
  `photo` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_user`
--

INSERT INTO `admin_user` (`id`, `first_name`, `last_name`, `username`, `password`, `role`, `role_id`, `photo`) VALUES
(6, 'Azizar', 'Rahman', 'aziz', 'e9b74cd3c4c1600ee591fd56360b89db', '', '1', 'img/user/30bcebf655.jpg'),
(5, 'Seller', 'One', 'admin_1', '21232f297a57a5a743894a0e4a801fc3', '', '2', 'img/user/c4cc560f7f.jpg'),
(7, 'shafik', 'Hossain', 'admin3', 'd41d8cd98f00b204e9800998ecf8427e', NULL, '2', 'img/user/fca72b9571.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `bank_details`
--

CREATE TABLE `bank_details` (
  `id` int(11) NOT NULL,
  `account_code` text,
  `bank_name` text,
  `account` text,
  `amount_credit` text,
  `amount_debit` text,
  `notes` text NOT NULL,
  `date` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bank_details`
--

INSERT INTO `bank_details` (`id`, `account_code`, `bank_name`, `account`, `amount_credit`, `amount_debit`, `notes`, `date`) VALUES
(1, '1002', '', '10011001010', '1000', '', 'test     ', '2020-12-01'),
(2, '1002', '', '10011001010', '1000', '', '1000', '2020-12-01'),
(3, '1002', '', '10011001010', '1000', '', 'google.com\r\n ', '2020-12-01'),
(4, '1001', '', '100020030', '2000', '', 'dd', '2020-12-03'),
(5, '1001', '', '100020030', '2000', '', 'dd', '2020-12-03'),
(6, '1001', '', '100020030', '10000', NULL, '11', '2020-12-30');

-- --------------------------------------------------------

--
-- Table structure for table `bank_info`
--

CREATE TABLE `bank_info` (
  `id` int(11) NOT NULL,
  `code` text NOT NULL,
  `name` text NOT NULL,
  `account` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bank_info`
--

INSERT INTO `bank_info` (`id`, `code`, `name`, `account`) VALUES
(6, '1002', 'Rupali Bank ', '10011001010'),
(5, '1001', 'Dutch Bangla Bank', '100020030');

-- --------------------------------------------------------

--
-- Table structure for table `brand_name`
--

CREATE TABLE `brand_name` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brand_name`
--

INSERT INTO `brand_name` (`id`, `name`) VALUES
(1, 'RFL');

-- --------------------------------------------------------

--
-- Table structure for table `company_info`
--

CREATE TABLE `company_info` (
  `id` int(11) NOT NULL,
  `company_name_first_part` text NOT NULL,
  `comapnay_name_last_part` text NOT NULL,
  `address` text NOT NULL,
  `tag` text NOT NULL,
  `logo` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company_info`
--

INSERT INTO `company_info` (`id`, `company_name_first_part`, `comapnay_name_last_part`, `address`, `tag`, `logo`) VALUES
(1, 'POWER GOLD', 'MOTORS LIMITED', 'Cha-103, Uttar Badda (Near Badda General Hospital Road) Dhaka-1212', '(All Kinds of Electrical Motors Importers & Marketing)', 'img/logo/f22646ebb4.png');

-- --------------------------------------------------------

--
-- Table structure for table `distributor`
--

CREATE TABLE `distributor` (
  `id` int(11) NOT NULL,
  `ac` text NOT NULL,
  `first_name` text NOT NULL,
  `last_name` text NOT NULL,
  `mobile_number` text NOT NULL,
  `location_id` text NOT NULL,
  `store_name` text NOT NULL,
  `Address` text NOT NULL,
  `membership_date` text NOT NULL,
  `status` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `distributor`
--

INSERT INTO `distributor` (`id`, `ac`, `first_name`, `last_name`, `mobile_number`, `location_id`, `store_name`, `Address`, `membership_date`, `status`) VALUES
(1, '1001', 'Demo User', 'Demo Last Nam', '01916859326', '8', 'Aziz Store', 'Middle Badda, Dhaka', '', '1'),
(2, '1005', 'Shifat', 'Hossain', '0101', '4', 'Shifat Store', 'Gulshan-1', '', '1');

-- --------------------------------------------------------

--
-- Table structure for table `distributor_location`
--

CREATE TABLE `distributor_location` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `distributor_location`
--

INSERT INTO `distributor_location` (`id`, `name`) VALUES
(1, 'Badda'),
(2, 'Rampura'),
(3, 'Malibagh'),
(4, 'Gulshan-1'),
(5, 'Mohakhali'),
(6, 'Uttara'),
(7, 'Dhanmondi '),
(8, 'Gabtoli');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(11) NOT NULL,
  `Employee_id` varchar(255) DEFAULT NULL,
  `First_Name` varchar(255) DEFAULT NULL,
  `Last_Name` varchar(255) DEFAULT NULL,
  `Desigination` varchar(255) DEFAULT NULL,
  `DOB` varchar(255) DEFAULT NULL,
  `Joining_Date` varchar(255) DEFAULT NULL,
  `Mobile_number` varchar(255) DEFAULT NULL,
  `edu_qulification` varchar(255) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `Salary` varchar(255) DEFAULT NULL,
  `Status_employee` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `Employee_id`, `First_Name`, `Last_Name`, `Desigination`, `DOB`, `Joining_Date`, `Mobile_number`, `edu_qulification`, `Address`, `Salary`, `Status_employee`) VALUES
(1, '001', 'Md. Mahfuzur', 'Rahman', 'Imam', '2020-09-01', '2020-09-01', '0', 'Kamil', 'Missionpara', '13000', '1'),
(2, '002', 'Md.Shahidul Islam', 'Sayeed', 'Mowazzin', '2020-09-01', '2020-09-01', '01749582650', 'Alim', 'Missionpara', '12000', '1'),
(3, '003', 'Mawlana', 'Habibullah', 'Khadem', '2020-09-01', '2020-09-01', '01758423523', 'Hafez', 'Kishoreganj', '8000', '1');

-- --------------------------------------------------------

--
-- Table structure for table `expens`
--

CREATE TABLE `expens` (
  `id` int(11) NOT NULL,
  `head` text NOT NULL,
  `narration` text NOT NULL,
  `amount` text NOT NULL,
  `date` date NOT NULL,
  `salary_date` text NOT NULL,
  `head_id` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `expens`
--

INSERT INTO `expens` (`id`, `head`, `narration`, `amount`, `date`, `salary_date`, `head_id`) VALUES
(1, '1', 'Eletric Bill', '3000', '2020-12-16', '0000-00-00', '1'),
(2, '2', 'ddd', '22222', '2020-12-01', '0000-00-00', '2'),
(3, '1', 'dd', '100', '2020-12-31', '0000-00-00', '1');

-- --------------------------------------------------------

--
-- Table structure for table `expens_head`
--

CREATE TABLE `expens_head` (
  `id` int(50) NOT NULL,
  `expense_head` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `expens_head`
--

INSERT INTO `expens_head` (`id`, `expense_head`) VALUES
(1, 'Electric Bill'),
(2, 'Gas Bill'),
(4, 'Development work'),
(5, 'Misc. Expenses');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` int(11) NOT NULL,
  `invoice_no` text,
  `distributor_id` int(11) DEFAULT NULL,
  `invoice_total` text,
  `invoice_subtotal` text,
  `tax` text,
  `tax_amount` text,
  `amount_paid` text,
  `amount_due` text,
  `notes` text,
  `created` text,
  `updated` datetime DEFAULT NULL,
  `uuid` varchar(75) DEFAULT NULL,
  `reciept_cat` text NOT NULL,
  `saller_id` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `invoice_no`, `distributor_id`, `invoice_total`, `invoice_subtotal`, `tax`, `tax_amount`, `amount_paid`, `amount_due`, `notes`, `created`, `updated`, `uuid`, `reciept_cat`, `saller_id`) VALUES
(9, '10001', 1001, '400.00', '400.00', '', '0', '2', '398.00', ' ', '2020-12-31', NULL, NULL, '1', NULL),
(10, '10002', 1001, '200.00', '200.00', '', '0', '', '200.00', ' ', '2021-01-01', NULL, NULL, '1', '6'),
(11, '10003', 1001, '200.00', '200.00', '', '0', '', '200.00', ' ', '2021-01-01', NULL, NULL, '1', '6');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_details`
--

CREATE TABLE `invoice_details` (
  `id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `product_id` varchar(25) DEFAULT NULL,
  `product_name` varchar(250) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` text,
  `purchase_price` text,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice_details`
--

INSERT INTO `invoice_details` (`id`, `invoice_id`, `product_id`, `product_name`, `quantity`, `price`, `purchase_price`, `date`) VALUES
(10, 11, '1002', 'Pro Name', 1, '200', '100', '2021-01-01 16:39:04'),
(9, 10, '1002', 'Pro Name', 1, '200', '100', '2021-01-01 16:03:31'),
(8, 9, '1002', 'Pro Name', 2, '200', '100', '2020-12-31 18:11:55');

-- --------------------------------------------------------

--
-- Table structure for table `product_catagory`
--

CREATE TABLE `product_catagory` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_catagory`
--

INSERT INTO `product_catagory` (`id`, `name`) VALUES
(1, 'Motor'),
(2, 'Gash'),
(3, 'stove');

-- --------------------------------------------------------

--
-- Table structure for table `product_table`
--

CREATE TABLE `product_table` (
  `id` int(11) NOT NULL,
  `product_code` text NOT NULL,
  `product_name` text NOT NULL,
  `product_cat_id` text NOT NULL,
  `brand_id` text NOT NULL,
  `unite_price` text NOT NULL,
  `discount` text NOT NULL,
  `status` text NOT NULL,
  `description` text NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_table`
--

INSERT INTO `product_table` (`id`, `product_code`, `product_name`, `product_cat_id`, `brand_id`, `unite_price`, `discount`, `status`, `description`, `created_date`) VALUES
(4, '1002', 'Gas Stove', '2', '1', '200', '0', '1', 'Gas Stove', '2020-12-09 12:27:44'),
(3, '1001', 'Motor', '1', '1', '300', '0', '1', 'Test', '2020-12-09 12:28:18'),
(5, '1003', 'Weighting Scall', '3', '1', '300', '0', '1', 'Test', '2020-12-09 10:20:28');

-- --------------------------------------------------------

--
-- Table structure for table `purches_product`
--

CREATE TABLE `purches_product` (
  `id` int(11) NOT NULL,
  `invoice_no` text NOT NULL,
  `product_id` text NOT NULL,
  `catagory_id` text NOT NULL,
  `brand_id` text NOT NULL,
  `purches_quntity` text NOT NULL,
  `purches_price` text NOT NULL,
  `unite_price` text NOT NULL,
  `discount` text NOT NULL,
  `product_description` text NOT NULL,
  `purchase_total` text,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purches_product`
--

INSERT INTO `purches_product` (`id`, `invoice_no`, `product_id`, `catagory_id`, `brand_id`, `purches_quntity`, `purches_price`, `unite_price`, `discount`, `product_description`, `purchase_total`, `date`) VALUES
(1, '', '1002', '2', '1', '10', '100', '200', '0', '', '1000', '2020-12-09 12:26:44'),
(2, '', '1001', '1', '1', '10', '200', '300', '0', '', '2000', '2020-11-09 12:27:00');

-- --------------------------------------------------------

--
-- Table structure for table `return_invoices`
--

CREATE TABLE `return_invoices` (
  `id` int(11) NOT NULL,
  `distributor_id` text,
  `return_invoice_id` text NOT NULL,
  `invoice_total` text,
  `invoice_subtotal` text,
  `tax` text,
  `tax_amount` text,
  `amount_paid` text,
  `amount_due` text,
  `notes` text,
  `created` text,
  `updated` datetime DEFAULT NULL,
  `uuid` varchar(75) DEFAULT NULL,
  `reciept_cat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `return_invoices`
--

INSERT INTO `return_invoices` (`id`, `distributor_id`, `return_invoice_id`, `invoice_total`, `invoice_subtotal`, `tax`, `tax_amount`, `amount_paid`, `amount_due`, `notes`, `created`, `updated`, `uuid`, `reciept_cat`) VALUES
(3, '1005', '7', '660.00', '600.00', '10', '60.00', '0', '660.00', ' ', '2020-12-29', NULL, NULL, '1'),
(4, '1005', '4', '1980.00', '1800.00', '10', '180.00', '1980', '0.00', ' ', '2020-12-29', NULL, NULL, '1'),
(5, '1005', '2', '440.00', '400.00', '10', '40.00', '440', '0.00', ' ', '2020-12-29', NULL, NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `return_invoice_details`
--

CREATE TABLE `return_invoice_details` (
  `id` int(11) NOT NULL,
  `return_invoice_id` text NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `product_id` varchar(25) DEFAULT NULL,
  `product_name` varchar(250) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` text,
  `purchase_price` text,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `return_invoice_details`
--

INSERT INTO `return_invoice_details` (`id`, `return_invoice_id`, `invoice_id`, `product_id`, `product_name`, `quantity`, `price`, `purchase_price`, `date`) VALUES
(13, '6', 4, '1001', 'Pro Name', 2, '300', '200', '2020-12-31 07:24:33'),
(12, '5', 4, '1002', 'Pro Name', 6, '200', '100', '2020-12-31 07:24:33'),
(11, '7', 7, '1001', 'Pro Name', 2, '300', '200', '2020-12-31 06:58:04'),
(14, '3', 2, '1002', 'Pro Name', 2, '200', '100', '2020-12-31 11:27:01');

-- --------------------------------------------------------

--
-- Table structure for table `salary_payment`
--

CREATE TABLE `salary_payment` (
  `id` int(50) NOT NULL,
  `Employee_id` text,
  `salary_amount` text,
  `advanced_payment` text,
  `gn_date` date DEFAULT NULL,
  `invoice_date` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `salary_payment`
--

INSERT INTO `salary_payment` (`id`, `Employee_id`, `salary_amount`, `advanced_payment`, `gn_date`, `invoice_date`) VALUES
(1, '001', '13000', '0', '2020-09-24', '2020-09-24'),
(2, '002', '12000', '0', '2020-09-24', '2020-09-24'),
(3, '003', '8000', '0', '2020-09-24', '2020-09-24');

-- --------------------------------------------------------

--
-- Table structure for table `stock_product`
--

CREATE TABLE `stock_product` (
  `id` int(11) NOT NULL,
  `product_code` text NOT NULL,
  `catogry_id` text NOT NULL,
  `brand_id` text NOT NULL,
  `stock_quantity` text NOT NULL,
  `discount` text NOT NULL,
  `purches_price` text NOT NULL,
  `price` text NOT NULL,
  `saler_id` text NOT NULL,
  `status_id` text,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock_product`
--

INSERT INTO `stock_product` (`id`, `product_code`, `catogry_id`, `brand_id`, `stock_quantity`, `discount`, `purches_price`, `price`, `saler_id`, `status_id`, `date`) VALUES
(1, '1002', '2', '1', '2', '0', '100', '200', '5', NULL, '2021-01-01 16:39:04'),
(2, '1001', '1', '1', '9', '0', '200', '300', '5', NULL, '2020-12-31 07:24:33');

-- --------------------------------------------------------

--
-- Table structure for table `temp_invoices`
--

CREATE TABLE `temp_invoices` (
  `id` int(11) NOT NULL,
  `distributor_id` int(11) DEFAULT NULL,
  `invoice_total` text,
  `invoice_subtotal` text,
  `tax` text,
  `tax_amount` text,
  `amount_paid` text,
  `amount_due` text,
  `notes` text,
  `created` text,
  `updated` datetime DEFAULT NULL,
  `uuid` varchar(75) DEFAULT NULL,
  `reciept_cat` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `temp_invoice_details`
--

CREATE TABLE `temp_invoice_details` (
  `id` int(11) NOT NULL,
  `disCode` text NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `product_id` varchar(25) DEFAULT NULL,
  `product_name` varchar(250) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` text,
  `purchase_price` text,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `temp_invoice_details`
--

INSERT INTO `temp_invoice_details` (`id`, `disCode`, `invoice_id`, `product_id`, `product_name`, `quantity`, `price`, `purchase_price`, `date`) VALUES
(16, '1001', 10002, '1002 ', NULL, 1, '200', 'purchase price', '2021-01-01 15:32:00'),
(14, '1001', 10002, '1002 ', NULL, 2, '200', 'purchase price', '2021-01-01 15:32:05'),
(17, '1001 ', 10002, '1002 ', NULL, 10, '200', 'purchase price', '2021-01-01 15:40:49'),
(20, '1001 ', 10003, '1002 ', NULL, 2, '200', 'purchase price', '2021-01-01 16:38:32');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts_table`
--
ALTER TABLE `accounts_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_user`
--
ALTER TABLE `admin_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank_details`
--
ALTER TABLE `bank_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank_info`
--
ALTER TABLE `bank_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brand_name`
--
ALTER TABLE `brand_name`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_info`
--
ALTER TABLE `company_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `distributor`
--
ALTER TABLE `distributor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `distributor_location`
--
ALTER TABLE `distributor_location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expens`
--
ALTER TABLE `expens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expens_head`
--
ALTER TABLE `expens_head`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice_details`
--
ALTER TABLE `invoice_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_invoice_details_invoices_idx` (`invoice_id`);

--
-- Indexes for table `product_catagory`
--
ALTER TABLE `product_catagory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_table`
--
ALTER TABLE `product_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purches_product`
--
ALTER TABLE `purches_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `return_invoices`
--
ALTER TABLE `return_invoices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `return_invoice_details`
--
ALTER TABLE `return_invoice_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_invoice_details_invoices_idx` (`invoice_id`);

--
-- Indexes for table `salary_payment`
--
ALTER TABLE `salary_payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_product`
--
ALTER TABLE `stock_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `temp_invoices`
--
ALTER TABLE `temp_invoices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `temp_invoice_details`
--
ALTER TABLE `temp_invoice_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_invoice_details_invoices_idx` (`invoice_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts_table`
--
ALTER TABLE `accounts_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `admin_user`
--
ALTER TABLE `admin_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `bank_details`
--
ALTER TABLE `bank_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `bank_info`
--
ALTER TABLE `bank_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `brand_name`
--
ALTER TABLE `brand_name`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `company_info`
--
ALTER TABLE `company_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `distributor`
--
ALTER TABLE `distributor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `distributor_location`
--
ALTER TABLE `distributor_location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `expens`
--
ALTER TABLE `expens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `expens_head`
--
ALTER TABLE `expens_head`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `invoice_details`
--
ALTER TABLE `invoice_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `product_catagory`
--
ALTER TABLE `product_catagory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `product_table`
--
ALTER TABLE `product_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `purches_product`
--
ALTER TABLE `purches_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `return_invoices`
--
ALTER TABLE `return_invoices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `return_invoice_details`
--
ALTER TABLE `return_invoice_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `salary_payment`
--
ALTER TABLE `salary_payment`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `stock_product`
--
ALTER TABLE `stock_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `temp_invoices`
--
ALTER TABLE `temp_invoices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `temp_invoice_details`
--
ALTER TABLE `temp_invoice_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
