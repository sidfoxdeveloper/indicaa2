-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 29, 2020 at 09:23 PM
-- Server version: 5.5.53-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `indicaa`
--

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE IF NOT EXISTS `companies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `name`, `created_at`, `modified_at`) VALUES
(3, 'Relience', '2020-03-20 11:56:23', '2020-03-20 10:56:23'),
(4, 'TATA', '2020-03-20 12:06:04', '2020-03-20 11:06:04');

-- --------------------------------------------------------

--
-- Table structure for table `containers`
--

CREATE TABLE IF NOT EXISTS `containers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL COMMENT 'Auto fill by super admin',
  `company_id` int(11) NOT NULL COMMENT ' Autofill Super admin ',
  `yard_id` int(11) NOT NULL COMMENT 'Autofill Super admin',
  `container_size_id` int(11) NOT NULL,
  `empty_depot_name_id` int(11) NOT NULL COMMENT 'Admin will enter for each country',
  `shipping_line_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `empty_container_received` datetime NOT NULL,
  `container_placed_yard` datetime NOT NULL COMMENT 'SHOULD NOT BE LESS THAN the Empty container received date.',
  `container_number` varchar(255) NOT NULL COMMENT 'Format - 4 ALPHABETS "-" 6 DIGITS "-" 1 DIGIT',
  `tare_weight` varchar(255) NOT NULL COMMENT 'textbox - num with 3 decimal place,   -- container weight with out material',
  `gross_weight` varchar(255) NOT NULL COMMENT 'textbox - num with 3 decimal place',
  `net_weight` varchar(255) NOT NULL,
  `net_weight_supplier` varchar(255) NOT NULL,
  `net_weight_yard` varchar(255) NOT NULL,
  `port_of_destination` varchar(255) NOT NULL,
  `pay_load` varchar(255) NOT NULL COMMENT 'textbox - num with 3,   decimal place,   min 21 T and MAX 29,  Show notification to admin and Country manager if is below or above this value',
  `material_code` varchar(255) NOT NULL COMMENT 'Super admin will enter',
  `material_description` text NOT NULL COMMENT '1000 CHARACTERS',
  `material_quality_code` varchar(255) NOT NULL COMMENT 'Not mandatory',
  `shipping_line` varchar(255) NOT NULL COMMENT 'Super admin will enter',
  `supplier` varchar(255) NOT NULL COMMENT 'Admin will enter for each country',
  `seal_number` text NOT NULL COMMENT 'multiple comma seprated(,)',
  `remarks` text NOT NULL,
  `exchange_rate` enum('master','optional') NOT NULL COMMENT 'Radio button - 1. Master exchange rate   2. OP exchange rate',
  `branch_code` varchar(255) NOT NULL COMMENT 'drop-down Super admin will enter',
  `shipping_agent` int(11) NOT NULL COMMENT 'EMO will enter',
  `transporter` enum('1','2') NOT NULL,
  `shipped_to_storage` datetime NOT NULL COMMENT 'should not be less than the date placed in the yard',
  `storage` int(11) NOT NULL COMMENT 'EMO will enter',
  `shifted_to_terminal` datetime NOT NULL COMMENT 'should not be less than the date placed in the yard',
  `terminal` varchar(255) NOT NULL COMMENT 'EMO will enter',
  `shifted_to_port` datetime NOT NULL COMMENT 'should not be less than the date placed in the terminal',
  `port_of_loading` int(11) NOT NULL COMMENT 'EMO will enter',
  `grn_number` varchar(255) NOT NULL,
  `grn_date` datetime NOT NULL COMMENT 'should not be less than the date shifter to port',
  `base_port_used_for_freight_costing` int(11) NOT NULL COMMENT 'super admin will enter',
  `ls_number` varchar(255) NOT NULL,
  `vo_number` varchar(255) NOT NULL,
  `status_super_admin` enum('1','2') NOT NULL COMMENT 'super admin will enter the values',
  `status` enum('draft','pending_upload','not_verified_by_country_manager','verified_by_country_manger') NOT NULL DEFAULT 'draft',
  `vessel_name` varchar(255) NOT NULL,
  `voyage` varchar(255) NOT NULL,
  `sob_date` datetime NOT NULL,
  `bli_number` datetime NOT NULL,
  `original_bl_number` text NOT NULL,
  `ho_order_number` text NOT NULL,
  `ex_yard_price` text NOT NULL,
  `cnf` text NOT NULL COMMENT 'Enter data in 3 currency . Final LR will be in show only in USD',
  `fob` text NOT NULL COMMENT 'Super admin will assign 3 currency for each country',
  `fca` text NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `containers`
--

INSERT INTO `containers` (`id`, `user_id`, `country_id`, `company_id`, `yard_id`, `container_size_id`, `empty_depot_name_id`, `shipping_line_id`, `supplier_id`, `empty_container_received`, `container_placed_yard`, `container_number`, `tare_weight`, `gross_weight`, `net_weight`, `net_weight_supplier`, `net_weight_yard`, `port_of_destination`, `pay_load`, `material_code`, `material_description`, `material_quality_code`, `shipping_line`, `supplier`, `seal_number`, `remarks`, `exchange_rate`, `branch_code`, `shipping_agent`, `transporter`, `shipped_to_storage`, `storage`, `shifted_to_terminal`, `terminal`, `shifted_to_port`, `port_of_loading`, `grn_number`, `grn_date`, `base_port_used_for_freight_costing`, `ls_number`, `vo_number`, `status_super_admin`, `status`, `vessel_name`, `voyage`, `sob_date`, `bli_number`, `original_bl_number`, `ho_order_number`, `ex_yard_price`, `cnf`, `fob`, `fca`, `created_at`, `modified_at`) VALUES
(4, 6, 1, 3, 1, 1, 1, 1, 1, '2020-03-24 00:00:00', '2020-03-25 00:00:00', 'ABCD-123456-1', '11', '600GM', '5566', '6565656', '5090', 'rajkot', '55T', 'MTCode', 'materail description', '9898989', '', '', '1', 'this remarks of app', 'master', '', 0, '1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 0, '', '0000-00-00 00:00:00', 0, '', '', '1', 'not_verified_by_country_manager', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', '', '', '', '2020-03-25 19:28:46', '2020-03-29 12:52:56'),
(5, 6, 1, 3, 1, 1, 1, 1, 1, '2020-03-24 00:00:00', '2020-03-25 00:00:00', 'ABCD-123456-2', '11', '600GM', '5566', '6565656', '5090', 'rajkot', '55T', 'MTCode', 'materail description', '9898989', '', '', '1', 'this remarks of app', 'master', '', 0, '1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 0, '', '0000-00-00 00:00:00', 0, '', '', '1', 'not_verified_by_country_manager', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', '', '', '', '2020-03-25 19:28:46', '2020-03-29 12:53:28'),
(6, 6, 1, 3, 1, 1, 1, 1, 1, '2020-03-24 00:00:00', '2020-03-25 00:00:00', 'ABCD-123456-3', '11', '600GM', '5566', '6565656', '5090', 'rajkot', '55T', 'MTCode', 'materail description', '9898989', '', '', '1', 'this remarks of app', 'master', '', 0, '1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 0, '', '0000-00-00 00:00:00', 0, '', '', '1', 'not_verified_by_country_manager', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', '', '', '', '2020-03-25 19:28:46', '2020-03-29 12:53:28'),
(7, 6, 1, 3, 1, 1, 1, 1, 1, '2020-03-24 00:00:00', '2020-03-25 00:00:00', 'ABCD-123456-4', '11', '600GM', '5566', '6565656', '5090', 'rajkot', '55T', 'MTCode', 'materail description', '9898989', '', '', '1', 'this remarks of app', 'master', '', 0, '1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 0, '', '0000-00-00 00:00:00', 0, '', '', '1', 'not_verified_by_country_manager', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', '', '', '', '2020-03-25 19:28:46', '2020-03-29 12:53:28'),
(8, 6, 1, 3, 1, 1, 1, 1, 1, '2020-03-24 00:00:00', '2020-03-25 00:00:00', 'ABCD-123456-5', '11', '600GM', '5566', '6565656', '5090', 'rajkot', '55T', 'MTCode', 'materail description', '9898989', '', '', '1', 'this remarks of app', 'master', '', 0, '1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 0, '', '0000-00-00 00:00:00', 0, '', '', '1', 'not_verified_by_country_manager', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', '', '', '', '2020-03-25 19:28:46', '2020-03-29 12:53:28'),
(9, 6, 1, 3, 1, 1, 1, 1, 1, '2020-03-24 00:00:00', '2020-03-25 00:00:00', 'ABCD-123456-6', '11', '600GM', '5566', '6565656', '5090', 'rajkot', '55T', 'MTCode', 'materail description', '9898989', '', '', '1', 'this remarks of app', 'master', '', 0, '1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 0, '', '0000-00-00 00:00:00', 0, '', '', '1', 'not_verified_by_country_manager', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', '', '', '', '2020-03-25 19:28:46', '2020-03-29 12:53:28'),
(10, 6, 1, 3, 1, 1, 1, 1, 1, '2020-03-24 00:00:00', '2020-03-25 00:00:00', 'ABCD-123456-7', '11', '600GM', '5566', '6565656', '5090', 'rajkot', '55T', 'MTCode', 'materail description', '9898989', '', '', '1', 'this remarks of app', 'master', '', 0, '1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 0, '', '0000-00-00 00:00:00', 0, '', '', '1', 'not_verified_by_country_manager', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', '', '', '', '2020-03-25 19:28:46', '2020-03-29 12:53:28'),
(11, 6, 1, 3, 1, 1, 1, 1, 1, '2020-03-24 00:00:00', '2020-03-25 00:00:00', 'ABCD-123456-8', '11', '600GM', '5566', '6565656', '5090', 'rajkot', '55T', 'MTCode', 'materail description', '9898989', '', '', '1', 'this remarks of app', 'master', '', 0, '1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 0, '', '0000-00-00 00:00:00', 0, '', '', '1', 'not_verified_by_country_manager', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', '', '', '', '2020-03-25 19:28:46', '2020-03-29 12:53:28'),
(12, 6, 1, 3, 1, 1, 1, 1, 1, '2020-03-24 00:00:00', '2020-03-25 00:00:00', 'ABCD-123456-9', '11', '600GM', '5566', '6565656', '5090', 'rajkot', '55T', 'MTCode', 'materail description', '9898989', '', '', '1', 'this remarks of app', 'master', '', 0, '1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 0, '', '0000-00-00 00:00:00', 0, '', '', '1', 'not_verified_by_country_manager', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', '', '', '', '2020-03-25 19:28:46', '2020-03-29 12:53:28'),
(13, 6, 1, 3, 1, 1, 1, 1, 1, '2020-03-24 00:00:00', '2020-03-25 00:00:00', 'ABCD-123456-10', '11', '600GM', '5566', '6565656', '5090', 'rajkot', '55T', 'MTCode', 'materail description', '9898989', '', '', '1', 'this remarks of app', 'master', '', 0, '1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 0, '', '0000-00-00 00:00:00', 0, '', '', '1', 'verified_by_country_manger', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', '', '', '', '2020-03-25 19:28:46', '2020-03-29 12:53:28');

-- --------------------------------------------------------

--
-- Table structure for table `containers_archive`
--

CREATE TABLE IF NOT EXISTS `containers_archive` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `container_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `container_images`
--

CREATE TABLE IF NOT EXISTS `container_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `container_id` int(11) NOT NULL,
  `image_stock_pile` varchar(255) NOT NULL,
  `image_empty_container` varchar(255) NOT NULL,
  `image_container_loading` varchar(255) NOT NULL,
  `image_container_seal` varchar(255) NOT NULL,
  `image_documents` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='images of container' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `container_size`
--

CREATE TABLE IF NOT EXISTS `container_size` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `container_size`
--

INSERT INTO `container_size` (`id`, `name`, `created_at`, `modified_at`) VALUES
(1, '20''', '2020-03-25 05:12:11', '2020-03-25 11:42:11'),
(2, '40''', '2020-03-25 05:13:19', '2020-03-25 11:43:19'),
(3, 'BREAKBULK', '2020-03-25 05:13:43', '2020-03-25 11:43:43');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE IF NOT EXISTS `countries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `created_at`, `modified_at`) VALUES
(1, 'Malesiya', '2020-03-20 12:01:04', '2020-03-20 11:03:14'),
(2, 'India', '2020-03-20 12:04:04', '2020-03-20 11:04:04');

-- --------------------------------------------------------

--
-- Table structure for table `empty_depot`
--

CREATE TABLE IF NOT EXISTS `empty_depot` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Empty depot' AUTO_INCREMENT=2 ;

--
-- Dumping data for table `empty_depot`
--

INSERT INTO `empty_depot` (`id`, `name`, `created_at`, `modified_at`) VALUES
(1, 'Sydney empty depot', '2020-03-27 12:57:26', '2020-03-27 07:27:26');

-- --------------------------------------------------------

--
-- Table structure for table `material_code`
--

CREATE TABLE IF NOT EXISTS `material_code` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `material_code` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `material_code`
--

INSERT INTO `material_code` (`id`, `material_code`, `created_at`, `modified_at`) VALUES
(2, 'aaa-222-ooo-999', '2020-03-26 04:36:23', '2020-03-26 11:06:23'),
(3, 'aba-101-202-222', '2020-03-26 04:37:23', '2020-03-26 11:07:23');

-- --------------------------------------------------------

--
-- Table structure for table `seal_numbers`
--

CREATE TABLE IF NOT EXISTS `seal_numbers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `seal_number` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='seal number' AUTO_INCREMENT=2 ;

--
-- Dumping data for table `seal_numbers`
--

INSERT INTO `seal_numbers` (`id`, `seal_number`, `created_at`, `modified_at`) VALUES
(1, '12345679', '2020-03-21 10:39:30', '2020-03-21 10:39:30');

-- --------------------------------------------------------

--
-- Table structure for table `shipping_line`
--

CREATE TABLE IF NOT EXISTS `shipping_line` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Shipping line' AUTO_INCREMENT=2 ;

--
-- Dumping data for table `shipping_line`
--

INSERT INTO `shipping_line` (`id`, `name`, `created_at`, `modified_at`) VALUES
(1, 'Shipping Line - 1', '2020-03-29 00:00:00', '2020-03-29 13:35:29');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE IF NOT EXISTS `supplier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='supplier' AUTO_INCREMENT=3 ;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `country_id`, `name`, `created_at`, `modified_at`) VALUES
(1, 2, 'Supplier-1', '2020-03-27 06:06:17', '2020-03-27 13:00:50'),
(2, 2, 'Supplier-2', '2020-03-27 06:09:00', '2020-03-27 13:01:35');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `users_groups_id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `yard_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `location` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` enum('permanent','limit_of_days','blocked') NOT NULL DEFAULT 'blocked',
  `app_access_days` int(3) NOT NULL DEFAULT '0',
  `rootwaystrash` int(1) NOT NULL DEFAULT '0',
  `rootwaysstatus` int(1) NOT NULL DEFAULT '0',
  `token` varchar(255) NOT NULL COMMENT 'for mobile application',
  `lastlogin` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='users' AUTO_INCREMENT=9 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `users_groups_id`, `country_id`, `company_id`, `yard_id`, `user_name`, `first_name`, `last_name`, `email`, `password`, `phone`, `location`, `image`, `status`, `app_access_days`, `rootwaystrash`, `rootwaysstatus`, `token`, `lastlogin`, `created_at`, `modified_at`) VALUES
(1, 1, 0, 0, 0, 'superadmin', 'Indicaa Group', 'Admin', 'superadmin@gmail.com', 'U5Ga0Z1aaNlYHp0MjdEdXJ1aKVVVB1TP', '1234567890', 'Sydney, Australia', '', 'permanent', 0, 0, 0, '', '2020-03-26 18:43:55', '2020-03-18 00:00:00', '2020-03-26 13:13:55'),
(2, 2, 0, 0, 0, 'manager', 'Indicaa Group ', 'Manager', 'mamager@gmail.com', 'U5Ga0Z1aaNlYHp0MjdEdXJ1aKVVVB1TP', '1234567890', '', '', 'permanent', 0, 0, 0, '', '2020-03-19 12:32:10', '2020-03-18 00:00:00', '2020-03-19 11:32:10'),
(3, 3, 0, 0, 0, 'countryadmin', 'Indicaa Group ', 'Country Admin', 'countryadmin@gmail.com', 'U5Ga0Z1aaNlYHp0MjdEdXJ1aKVVVB1TP', '1234567890', '', '', 'permanent', 0, 0, 0, '', '2020-03-19 12:19:35', '2020-03-18 00:00:00', '2020-03-19 11:19:35'),
(4, 4, 0, 0, 0, 'emoadmin', 'Indicaa Group ', 'EMO Admin', 'emoadmin@gmail.com', 'U5Ga0Z1aaNlYHp0MjdEdXJ1aKVVVB1TP', '1234567890', '', '', 'permanent', 0, 0, 0, '', '2020-03-28 14:41:59', '2020-03-18 00:00:00', '2020-03-28 09:11:59'),
(5, 5, 0, 0, 0, 'countrymanager', 'Indicaa Group ', 'Country Manager', 'countrymanager@gmail.com', 'U5Ga0Z1aaNlYHp0MjdEdXJ1aKVVVB1TP', '1234567890', '', '', 'permanent', 0, 0, 0, '', '2020-03-29 21:05:26', '2020-03-18 00:00:00', '2020-03-29 15:35:26'),
(6, 6, 1, 3, 1, 'inspector', 'Indicaa Group ', 'Inspector', 'inspector@gmail.com', '=UlVKdFVYZ1cidkSyRVbwZVZHhDeUZlUTJmRSFVVsRmTZdlUHZVb0gnVGFUP', '1234567890', 'Sydney, Australia', 'test.jpg', 'permanent', 0, 0, 0, '07ad28d62d80d8ac8bd65814a3fcb17a', '2020-03-21 06:23:42', '2020-03-18 00:00:00', '2020-03-25 06:58:42'),
(8, 6, 0, 0, 0, 'test', 'nisha', 'Testing', 'test@gmail.com', 'U5Ga0Z1aaNlYHp0MjdEdXJ1aKVVVB1TP', '1234567890', 'tst loc', '', 'limit_of_days', 600, 0, 0, 'dfbbd97a8036ea9a7e96d03b0f8d785b', '0000-00-00 00:00:00', '2020-03-20 08:15:02', '2020-03-24 11:42:13');

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE IF NOT EXISTS `users_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8 NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `title`, `created_at`, `modified_at`) VALUES
(1, 'superadmin', '2020-03-18 16:59:58', '2020-03-19 04:35:08'),
(2, 'manager', '2020-03-18 17:59:58', '2020-03-18 12:29:58'),
(3, 'countryadmin', '2020-03-18 17:59:58', '2020-03-18 12:29:58'),
(4, 'emoadmin', '2020-03-18 17:59:58', '2020-03-18 12:29:58'),
(5, 'countrymanager', '2020-03-18 17:59:58', '2020-03-18 12:29:58'),
(6, 'inspector', '2020-03-18 17:59:58', '2020-03-18 12:29:58');

-- --------------------------------------------------------

--
-- Table structure for table `users_logins`
--

CREATE TABLE IF NOT EXISTS `users_logins` (
  `tempid` text NOT NULL,
  `rootwaysusername` text NOT NULL,
  `rootwayssessionid` text NOT NULL,
  `groupuserid` text CHARACTER SET utf8 NOT NULL,
  `actiontime` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_logins`
--

INSERT INTO `users_logins` (`tempid`, `rootwaysusername`, `rootwayssessionid`, `groupuserid`, `actiontime`) VALUES
('==QVWp0VUhlVTJFbahkTWZlWjtmS2olRWdlYGZFUNRlQX5kVWZkVsx2Qi1mUvRmRk5UTFZ1VWtWODZFbwZ0UsZ1TWd1Z4dFVOdkUrFDNWZlUWdVRKVnVB1TP', '=AFVxI0VrZFMWJjVZF2R4dVZsx2cUV1Y1YVMSZ1YGZlWVxmSzZFbsNnUsRGVU1GeXVGSOhVVB1TP', '==QVWp0VUhFcSJFbaRkTWZVYjxmWVRFbOdlYGZFUNRlQX5kVWZkVsx2Qi1mUvRmRk5UTFZ1VWtWODZFbwZ0UsZ1TWd1Z4dFVOdkUrFDNWZlUWdVRKVnVB1TP', '', '2020-03-18 13:46:16'),
('==QVWp0VUVlTT1UVxMzVtRnVS1GaFplVSFmYGZFUWpmSX5kVWdkVuBnbidlUvRmRk5UTFZ1cWtWODZFbwZ0UsZ1TWd1Z4dFVOdkUrFDNWZlUWdVRKVnVB1TP', '=AVVGdkVuhmSWxGZxMGRGVVYWp1RaRlWLJmVKJ3YFpVYTVEcHVVMa9mYGplNX1GeONFMwVnVY50USJjSzdVb4RVTXh3cZVlWXZlRSpHZGRWU', '==QVWp0VUVlTTJ2RWR0Vth3VS1GaxplVkFmYGZFUWpmSX5kVWdkVuBnbidlUvRmRk5UTFZ1cWtWODZFbwZ0UsZ1TWd1Z4dFVOdkUrFDNWZlUWdVRKVnVB1TP', '==AUVZ0RW5GaOJlRaNVTWJVU', '2020-03-19 12:20:34'),
('==QVWp0VUZlTT1UVxI3VtR3VStmSFplVkFmYGZVUWxGZp5kVWdkVuBnbidlUvRmRk5UTFZ1cWtWODZFbwZ0UsZ1TWd1Z4dFVOdkUrFDNWZlUWdVRKVnVB1TP', '=AVVGdkVuhmSWxGZxMGRGVVYWp1RaRlWLJmVKJ3YFpVYTVEcHVVMa9mYGplNX1GeONFMwVnVY50USJjSzdVb4RVTXh3cZVlWXZlRSpHZGRWU', '==QVWp0VUVlTTJ2RKNzYGRmWjxmWFRFboFmYGZVUWxGZp5kVWdkVuBnbidlUvRmRk5UTFZ1cWtWODZFbwZ0UsZ1TWd1Z4dFVOdkUrFDNWZlUWdVRKVnVB1TP', '==AUVZ0RW5GaOJlRaNVTWJVU', '2020-03-19 12:20:34'),
('==QVWp0VUZlTTJ2RKNzYHRnVSxmWVRVbodUYsZVUNRlQX5kVsVkVsZ1ShJjUUZFbWBVTFVFeW5WT1YlVwZ1UsZ1TWd1Z4dFVOdkUrFDNWZlUWdVRKVnVB1TP', '==AUUFjQWZlVHZ1VWFWTUpUalVkVzRVV0tmYsZleVxGZoFGWSRXVzw2cidkSDF2R1YVZFVkeZxmU0IlMG9WVsRmTX5mQZZleNhnVGFUP', '==QVWp0VUVlTTJFbaR0Vth3VS1GaxplVwdUYsZVUNRlQX5kVsVkVsZ1ShJjUUZFbWBVTFVFeW5WT1YlVwZ1UsZ1TWd1Z4dFVOdkUrFDNWZlUWdVRKVnVB1TP', '==AUVZ0RW5GaKJFbaNVTWJVU', '2020-03-26 18:44:06'),
('==QVWp0VUhFcSJ2RGx0UshmWjxmWxRFbSdlYGZlUNRlQX5kVsVkVsx2Qi1mUvRmRk9UTFVFeW5WT1YlVwZ1UsZ1TWd1Z4dFVOdkUrFDNWZlUWdVRKVnVB1TP', '==AUUFjQWZlVHZ1VWFWTUpUalVkVzRVV0tmYsZleVxGZoFGWSRXVzw2cidkSDF2R1YVZFVkeZxmU0IlMG9WVsRmTX5mQZZleNhnVGFUP', '==QVWp0VUhFcSJFbkNzVth3VSxmWVRFbOdlYGZlUNRlQX5kVsVkVsx2Qi1mUvRmRk9UTFVFeW5WT1YlVwZ1UsZ1TWd1Z4dFVOdkUrFDNWZlUWdVRKVnVB1TP', '==AUVZ0RW5GaKJFbaNVTWJVU', '2020-03-26 18:44:06'),
('==QVWp0VUVlTTJ2RWR1UtVjVS1GeFRVbotkUH5UUWpmSX5kVWdkVuZ1UidlUYZFbW5UTVZ1cWtWODZFbwZ1UsZ1TWd1Z4dFVOdkUrFDNWZlUWdVRKVnVB1TP', '=AlVGhUVup0cNFjWadlaG5kVwAXcV5WW4JlVaxkUsRmVWtmSZZVMnhnVwUTSTpmSXNleshlVGR2USJjSzdVb4RVTXh3cZVlWXZlRSpHZGRWU', '==QVWp0VUhlVTJ2RGBlTWZVYjxmSFRlVatmUt5UUWpmSX5kVWdkVuZ1UidlUYZFbW5UTVZ1cWtWODZFbwZ1UsZ1TWd1Z4dFVOdkUrFDNWZlUWdVRKVnVB1TP', '==AUVZ0RW5GaKJFbaVXTWJVU', '2020-03-29 21:11:00'),
('==QVWp0VUVlTTJFbah1YGplWjxmWFRFbSdlYGZVUWpmSX5kVWZkVuBnUidlUYZFbWBVTFZ1cWtWODZFbwZ1UsZ1TWd1Z4dFVOdkUrFDNWZlUWdVRKVnVB1TP', '=AlVGhUVup0cNFjWadlaG5kVwAXcV5WW4JlVaxkUsRmVWtmSZZVMnhnVwUTSTpmSXNleshlVGR2USJjSzdVb4RVTXh3cZVlWXZlRSpHZGRWU', '==QVWp0VUhFcSJ2RKNzYHRnVStmSxplVadlYGZVUWpmSX5kVWZkVuBnUidlUYZFbWBVTFZ1cWtWODZFbwZ1UsZ1TWd1Z4dFVOdkUrFDNWZlUWdVRKVnVB1TP', '==AUVZ0RW5GaKJFbaVXTWJVU', '2020-03-29 21:11:00');

-- --------------------------------------------------------

--
-- Table structure for table `users_login_histories`
--

CREATE TABLE IF NOT EXISTS `users_login_histories` (
  `users_id` int(11) NOT NULL,
  `ondatetime` datetime NOT NULL,
  `ip` varchar(32) NOT NULL,
  `browser` varchar(64) NOT NULL,
  `result` int(1) NOT NULL DEFAULT '0',
  KEY `ondatetime` (`ondatetime`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_login_histories`
--

INSERT INTO `users_login_histories` (`users_id`, `ondatetime`, `ip`, `browser`, `result`) VALUES
(1, '2020-03-18 12:30:50', '::1', 'Google Chrome', 1),
(1, '2020-03-19 06:16:33', '::1', 'Google Chrome', 1),
(1, '2020-03-19 06:36:49', '::1', 'Google Chrome', 1),
(1, '2020-03-19 06:39:35', '::1', 'Google Chrome', 1),
(1, '2020-03-19 06:43:14', '::1', 'Google Chrome', 0),
(1, '2020-03-19 06:43:24', '::1', 'Google Chrome', 1),
(1, '2020-03-19 07:11:57', '::1', 'Google Chrome', 0),
(1, '2020-03-19 07:12:02', '::1', 'Google Chrome', 1),
(1, '2020-03-19 07:12:13', '::1', 'Google Chrome', 1),
(2, '2020-03-19 07:36:05', '::1', 'Google Chrome', 1),
(3, '2020-03-19 07:36:21', '::1', 'Google Chrome', 1),
(3, '2020-03-19 07:36:27', '::1', 'Google Chrome', 1),
(3, '2020-03-19 07:46:12', '::1', 'Google Chrome', 1),
(3, '2020-03-19 07:52:04', '::1', 'Google Chrome', 1),
(3, '2020-03-19 07:52:31', '::1', 'Google Chrome', 1),
(2, '2020-03-19 07:53:51', '::1', 'Google Chrome', 1),
(4, '2020-03-19 07:54:24', '::1', 'Google Chrome', 1),
(4, '2020-03-19 07:54:28', '::1', 'Google Chrome', 1),
(4, '2020-03-19 07:56:21', '::1', 'Google Chrome', 1),
(1, '2020-03-19 07:56:37', '::1', 'Google Chrome', 1),
(2, '2020-03-19 07:56:51', '::1', 'Google Chrome', 1),
(3, '2020-03-19 07:57:06', '::1', 'Google Chrome', 1),
(3, '2020-03-19 07:58:03', '::1', 'Google Chrome', 1),
(4, '2020-03-19 07:58:46', '::1', 'Google Chrome', 1),
(5, '2020-03-19 07:58:59', '::1', 'Google Chrome', 1),
(6, '2020-03-19 07:59:12', '::1', 'Google Chrome', 1),
(1, '2020-03-19 08:01:47', '::1', 'Google Chrome', 1),
(2, '2020-03-19 08:02:38', '::1', 'Google Chrome', 1),
(1, '2020-03-19 08:04:52', '::1', 'Google Chrome', 1),
(1, '2020-03-19 08:24:12', '::1', 'Google Chrome', 0),
(1, '2020-03-19 08:25:14', '::1', 'Google Chrome', 0),
(1, '2020-03-19 08:33:57', '::1', 'Google Chrome', 1),
(1, '2020-03-19 08:35:52', '::1', 'Google Chrome', 1),
(1, '2020-03-19 08:36:10', '::1', 'Google Chrome', 1),
(2, '2020-03-19 08:36:29', '::1', 'Google Chrome', 1),
(1, '2020-03-19 08:36:52', '::1', 'Google Chrome', 1),
(1, '2020-03-19 10:02:21', '::1', 'Google Chrome', 1),
(1, '2020-03-19 10:29:48', '::1', 'Google Chrome', 0),
(1, '2020-03-19 10:29:55', '::1', 'Google Chrome', 1),
(1, '2020-03-19 11:11:40', '::1', 'Google Chrome', 1),
(1, '2020-03-19 11:48:15', '::1', 'Google Chrome', 1),
(6, '2020-03-19 11:56:26', '::1', 'Google Chrome', 1),
(6, '2020-03-19 11:56:43', '::1', 'Google Chrome', 1),
(1, '2020-03-19 11:56:57', '::1', 'Google Chrome', 1),
(2, '2020-03-19 11:57:10', '::1', 'Google Chrome', 1),
(2, '2020-03-19 12:12:19', '::1', 'Google Chrome', 1),
(2, '2020-03-19 12:12:58', '::1', 'Google Chrome', 1),
(1, '2020-03-19 12:13:25', '::1', 'Google Chrome', 1),
(2, '2020-03-19 12:14:57', '::1', 'Google Chrome', 1),
(4, '2020-03-19 12:17:42', '::1', 'Google Chrome', 1),
(4, '2020-03-19 12:17:52', '::1', 'Google Chrome', 1),
(3, '2020-03-19 12:19:21', '::1', 'Google Chrome', 1),
(3, '2020-03-19 12:19:35', '::1', 'Google Chrome', 1),
(5, '2020-03-19 12:20:34', '::1', 'Google Chrome', 1),
(5, '2020-03-19 12:24:09', '::1', 'Google Chrome', 1),
(2, '2020-03-19 12:25:23', '::1', 'Google Chrome', 1),
(2, '2020-03-19 12:32:10', '::1', 'Google Chrome', 1),
(6, '2020-03-19 12:53:19', '::1', 'Google Chrome', 1),
(1, '2020-03-19 13:06:22', '::1', 'Google Chrome', 1),
(1, '2020-03-20 04:47:04', '::1', 'Google Chrome', 1),
(1, '2020-03-20 06:01:21', '::1', 'Google Chrome', 1),
(1, '2020-03-20 07:11:04', '::1', 'Google Chrome', 1),
(6, '2020-03-20 09:41:26', '::1', 'Google Chrome', 1),
(1, '2020-03-20 10:19:27', '::1', 'Google Chrome', 1),
(6, '2020-03-20 12:08:40', '::1', 'Google Chrome', 1),
(6, '2020-03-20 12:11:00', '::1', 'Google Chrome', 1),
(1, '2020-03-20 12:14:07', '::1', 'Google Chrome', 1),
(6, '2020-03-20 12:14:30', '::1', 'Google Chrome', 1),
(1, '2020-03-20 13:41:28', '::1', 'Google Chrome', 1),
(1, '2020-03-20 13:45:33', '::1', 'Google Chrome', 1),
(6, '2020-03-20 13:45:53', '::1', 'Google Chrome', 1),
(6, '2020-03-21 04:55:50', '::1', 'Google Chrome', 1),
(1, '2020-03-21 05:23:59', '::1', 'Google Chrome', 1),
(6, '2020-03-21 05:59:10', '::1', 'Mozilla Firefox', 1),
(6, '2020-03-21 06:23:42', '::1', 'Google Chrome', 1),
(1, '2020-03-21 10:33:55', '59.98.119.87', 'Google Chrome', 1),
(1, '2020-03-24 10:13:36', '127.0.0.1', 'Mozilla Firefox', 1),
(1, '2020-03-25 16:57:49', '127.0.0.1', 'Mozilla Firefox', 1),
(1, '2020-03-25 18:09:13', '127.0.0.1', 'Mozilla Firefox', 1),
(1, '2020-03-26 15:48:31', '127.0.0.1', 'Mozilla Firefox', 1),
(1, '2020-03-26 16:33:58', '127.0.0.1', 'Mozilla Firefox', 1),
(1, '2020-03-26 18:43:55', '127.0.0.1', 'Mozilla Firefox', 1),
(5, '2020-03-27 10:41:01', '127.0.0.1', 'Mozilla Firefox', 1),
(5, '2020-03-27 11:09:35', '127.0.0.1', 'Mozilla Firefox', 1),
(5, '2020-03-27 11:10:41', '127.0.0.1', 'Mozilla Firefox', 0),
(5, '2020-03-27 11:11:02', '127.0.0.1', 'Mozilla Firefox', 0),
(5, '2020-03-27 11:11:28', '127.0.0.1', 'Mozilla Firefox', 1),
(4, '2020-03-27 12:12:36', '::1', 'Google Chrome', 0),
(4, '2020-03-27 12:12:54', '::1', 'Google Chrome', 1),
(5, '2020-03-27 12:48:25', '127.0.0.1', 'Mozilla Firefox', 1),
(4, '2020-03-27 12:55:40', '127.0.0.1', 'Mozilla Firefox', 1),
(4, '2020-03-27 15:42:32', '127.0.0.1', 'Mozilla Firefox', 1),
(4, '2020-03-27 15:52:42', '127.0.0.1', 'Mozilla Firefox', 1),
(4, '2020-03-27 17:11:24', '127.0.0.1', 'Mozilla Firefox', 1),
(4, '2020-03-27 17:59:46', '127.0.0.1', 'Mozilla Firefox', 1),
(4, '2020-03-28 09:36:30', '127.0.0.1', 'Mozilla Firefox', 1),
(4, '2020-03-28 12:00:08', '127.0.0.1', 'Mozilla Firefox', 1),
(5, '2020-03-28 12:04:21', '127.0.0.1', 'Mozilla Firefox', 1),
(4, '2020-03-28 14:41:59', '127.0.0.1', 'Mozilla Firefox', 1),
(5, '2020-03-28 14:43:13', '127.0.0.1', 'Mozilla Firefox', 1),
(5, '2020-03-28 17:24:43', '127.0.0.1', 'Mozilla Firefox', 1),
(5, '2020-03-29 18:03:56', '127.0.0.1', 'Mozilla Firefox', 1),
(5, '2020-03-29 19:08:24', '127.0.0.1', 'Mozilla Firefox', 1),
(5, '2020-03-29 21:05:26', '127.0.0.1', 'Mozilla Firefox', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users_permission`
--

CREATE TABLE IF NOT EXISTS `users_permission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `users_groups_id` int(11) NOT NULL,
  `filename` text NOT NULL,
  `view` tinyint(1) NOT NULL DEFAULT '0',
  `add` tinyint(1) NOT NULL DEFAULT '0',
  `edit` tinyint(1) NOT NULL DEFAULT '0',
  `del` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=97 ;

--
-- Dumping data for table `users_permission`
--

INSERT INTO `users_permission` (`id`, `users_groups_id`, `filename`, `view`, `add`, `edit`, `del`) VALUES
(78, 1, 'account_settings', 1, 1, 1, 1),
(79, 6, 'account_settings', 1, 1, 1, 1),
(80, 2, 'account_settings', 1, 1, 1, 1),
(81, 3, 'account_settings', 1, 1, 1, 1),
(82, 4, 'account_settings', 1, 1, 1, 1),
(83, 5, 'account_settings', 1, 1, 1, 1),
(84, 1, 'sa_user', 1, 1, 1, 1),
(85, 1, 'sa_company', 1, 1, 1, 1),
(86, 1, 'sa_country', 1, 1, 1, 1),
(87, 6, 'in_container', 1, 1, 1, 1),
(88, 1, 'sa_yards', 1, 1, 1, 1),
(89, 1, 'sa_seal_numbers', 1, 1, 1, 1),
(90, 1, 'sa_container_size', 1, 1, 1, 1),
(91, 1, 'sa_material_code', 1, 1, 1, 1),
(92, 5, 'cm_home', 1, 1, 1, 1),
(93, 4, 'emo_empty_depot', 1, 1, 1, 1),
(94, 4, 'emo_supplier', 1, 1, 1, 1),
(95, 5, 'cm_containers', 1, 1, 1, 1),
(96, 5, 'cm_container', 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_images`
--

CREATE TABLE IF NOT EXISTS `user_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='user images' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `yards`
--

CREATE TABLE IF NOT EXISTS `yards` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='yards' AUTO_INCREMENT=3 ;

--
-- Dumping data for table `yards`
--

INSERT INTO `yards` (`id`, `name`, `created_at`, `modified_at`) VALUES
(1, 'Port - 1 ', '2020-03-21 05:51:11', '2020-03-21 04:52:07'),
(2, 'Port - 2', '2020-03-21 05:51:28', '2020-03-21 04:51:28');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
