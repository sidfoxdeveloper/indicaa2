-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 18, 2020 at 05:05 PM
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
-- Table structure for table `base_port_used_for_freight_costing`
--

CREATE TABLE IF NOT EXISTS `base_port_used_for_freight_costing` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Base Ports' AUTO_INCREMENT=3 ;

--
-- Dumping data for table `base_port_used_for_freight_costing`
--

INSERT INTO `base_port_used_for_freight_costing` (`id`, `name`, `created_at`, `modified_at`) VALUES
(1, 'Base Port - 1', '2020-04-03 00:00:00', '2020-04-03 11:53:55'),
(2, 'Base Port - 2', '2020-04-03 05:25:09', '2020-04-03 11:56:12');

-- --------------------------------------------------------

--
-- Table structure for table `branch_code`
--

CREATE TABLE IF NOT EXISTS `branch_code` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Barcodes' AUTO_INCREMENT=11 ;

--
-- Dumping data for table `branch_code`
--

INSERT INTO `branch_code` (`id`, `name`, `created_at`, `modified_at`) VALUES
(1, 'BT-2255-333', '2020-03-30 06:48:06', '2020-03-30 13:18:06'),
(2, 'BT-2255-111', '2020-03-30 06:48:06', '2020-03-30 13:18:06'),
(3, 'BT-2255-222', '2020-03-30 06:48:06', '2020-03-30 13:18:06'),
(4, 'BT-2255-444', '2020-03-30 06:48:06', '2020-03-30 13:18:06'),
(5, 'BT-2255-555', '2020-03-30 06:48:06', '2020-03-30 13:18:06'),
(6, 'BT-2255-666', '2020-03-30 06:48:06', '2020-03-30 13:18:06'),
(7, 'BT-2255-777', '2020-03-30 06:48:06', '2020-03-30 13:18:06'),
(8, 'BT-2255-888', '2020-03-30 06:48:06', '2020-03-30 13:18:06'),
(9, 'BT-2255-999', '2020-03-30 06:48:06', '2020-03-30 13:18:06'),
(10, 'BT-2255-1010', '2020-03-30 06:48:06', '2020-03-30 13:18:06');

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
  `branch_code_id` varchar(255) NOT NULL,
  `shipping_agent_id` int(11) NOT NULL,
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
  `material_code_id` varchar(255) NOT NULL COMMENT 'Super admin will enter',
  `material_description` text NOT NULL COMMENT '1000 CHARACTERS',
  `material_quality_code` varchar(255) NOT NULL COMMENT 'Not mandatory',
  `shipping_line` varchar(255) NOT NULL COMMENT 'Super admin will enter',
  `supplier` varchar(255) NOT NULL COMMENT 'Admin will enter for each country',
  `seal_number_id` text NOT NULL COMMENT 'multiple comma seprated(,)',
  `remarks` text NOT NULL,
  `exchange_rate` enum('master','optional') NOT NULL COMMENT 'Radio button - 1. Master exchange rate   2. OP exchange rate',
  `transporter` enum('Yes','No') NOT NULL DEFAULT 'Yes' COMMENT 'NAME OF TRANSPORTER(Is it country sepecific - YES)  -  manage by EMO',
  `shipped_to_storage` datetime NOT NULL COMMENT 'should not be less than the date placed in the yard',
  `storage` varchar(255) NOT NULL COMMENT 'EMO will enter',
  `shifted_to_terminal` datetime NOT NULL COMMENT 'should not be less than the date placed in the yard',
  `terminal` varchar(255) NOT NULL COMMENT 'EMO will enter',
  `shifted_to_port` datetime NOT NULL COMMENT 'should not be less than the date placed in the terminal',
  `port_of_loading` varchar(255) NOT NULL COMMENT 'EMO will enter',
  `grn_number` varchar(255) NOT NULL,
  `grn_date` datetime NOT NULL COMMENT 'should not be less than the date shifter to port',
  `base_port_used_for_freight_costing` int(11) NOT NULL COMMENT 'super admin will enter',
  `ls_number` varchar(255) NOT NULL,
  `vo_number` varchar(255) NOT NULL,
  `status_super_admin` enum('1','2') NOT NULL COMMENT 'super admin will enter the values',
  `status` enum('draft','pending_upload','not_verified_by_country_manager','verified_by_country_manager') NOT NULL DEFAULT 'draft',
  `vessel_name` varchar(255) NOT NULL,
  `voyage` varchar(255) NOT NULL,
  `sob_date` datetime NOT NULL,
  `bli_date` date NOT NULL,
  `original_bl_number` text NOT NULL,
  `ho_order_number` text NOT NULL,
  `ex_yard_price` text NOT NULL,
  `cnf1` int(11) NOT NULL COMMENT 'Enter data in 3 currency . Final LR will be in show only in USD',
  `cnf2` int(11) NOT NULL,
  `cnf3` int(11) NOT NULL,
  `fob1` int(11) NOT NULL COMMENT 'Super admin will assign 3 currency for each country',
  `fob2` int(11) NOT NULL,
  `fob3` int(11) NOT NULL,
  `fca1` int(11) NOT NULL,
  `fca2` int(11) NOT NULL,
  `fca3` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `containers`
--

INSERT INTO `containers` (`id`, `user_id`, `country_id`, `company_id`, `yard_id`, `container_size_id`, `empty_depot_name_id`, `shipping_line_id`, `supplier_id`, `branch_code_id`, `shipping_agent_id`, `empty_container_received`, `container_placed_yard`, `container_number`, `tare_weight`, `gross_weight`, `net_weight`, `net_weight_supplier`, `net_weight_yard`, `port_of_destination`, `pay_load`, `material_code_id`, `material_description`, `material_quality_code`, `shipping_line`, `supplier`, `seal_number_id`, `remarks`, `exchange_rate`, `transporter`, `shipped_to_storage`, `storage`, `shifted_to_terminal`, `terminal`, `shifted_to_port`, `port_of_loading`, `grn_number`, `grn_date`, `base_port_used_for_freight_costing`, `ls_number`, `vo_number`, `status_super_admin`, `status`, `vessel_name`, `voyage`, `sob_date`, `bli_date`, `original_bl_number`, `ho_order_number`, `ex_yard_price`, `cnf1`, `cnf2`, `cnf3`, `fob1`, `fob2`, `fob3`, `fca1`, `fca2`, `fca3`, `created_at`, `modified_at`) VALUES
(4, 6, 2, 4, 2, 1, 2, 1, 2, '2', 2, '2020-10-20 00:00:00', '2020-10-20 00:00:00', 'AAA-555-EEE-SSS', '55T', '600GM', '10010', '1010', '5090', 'rajkot', '66T', '2', 'materail description test test test test test stest', '101010', '', '', 'Select Seal Number', 'this remarks of app', '', 'Yes', '2020-04-07 00:00:00', 'storage - 1', '2020-03-21 00:00:00', 'Terminal tesiting', '2020-03-21 00:00:00', 'Port of loading testing', 'ggggrrrnnnoooo', '2020-03-23 00:00:00', 2, 'llllssnnoo', 'vvooonnoo', '1', 'verified_by_country_manager', 'Test Vessel Name', 'Test Voyage ', '2020-04-06 00:00:00', '2020-04-05', 'xxx-xxx-xxx', 'xxx-xxx-xxx', 'xxx-xxx-xxx', 2, 1, 1, 2, 1, 1, 2, 1, 1, '2020-03-25 19:28:46', '2020-04-16 11:38:12'),
(14, 8, 2, 3, 2, 1, 2, 3, 2, '5', 2, '2020-04-10 00:00:00', '2020-04-10 00:00:00', 'ABCD-123456-1', '11T', '600GM', '5566', '6565656', '5090', 'rajkot', '55T', '2', 'materail description', '9898989', '', '', '3', 'this remarks of app', '', 'Yes', '2020-03-20 00:00:00', 'storage - 2', '2020-03-21 00:00:00', 'Terminal tesiting', '2020-03-21 00:00:00', 'Port of loading testing', 'ggggrrrnnnoooo', '2020-03-23 00:00:00', 2, 'llllssnnoo', 'vvooonnoo', '1', 'verified_by_country_manager', '88888', '999999', '2020-03-24 00:00:00', '2020-03-25', 'xxx-xxx-xxx', 'xxx-xxx-xxx', 'xxx-xxx-xxx', 2, 2, 1, 2, 2, 1, 2, 2, 1, '2020-04-01 19:28:46', '2020-04-11 06:00:55');

-- --------------------------------------------------------

--
-- Table structure for table `container_archieve`
--

CREATE TABLE IF NOT EXISTS `container_archieve` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `container_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL COMMENT 'Auto fill by super admin',
  `company_id` int(11) NOT NULL COMMENT ' Autofill Super admin ',
  `yard_id` int(11) NOT NULL COMMENT 'Autofill Super admin',
  `container_size_id` int(11) NOT NULL,
  `empty_depot_name_id` int(11) NOT NULL COMMENT 'Admin will enter for each country',
  `shipping_line_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `branch_code_id` varchar(255) NOT NULL,
  `shipping_agent_id` int(11) NOT NULL,
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
  `material_code_id` varchar(255) NOT NULL COMMENT 'Super admin will enter',
  `material_description` text NOT NULL COMMENT '1000 CHARACTERS',
  `material_quality_code` varchar(255) NOT NULL COMMENT 'Not mandatory',
  `seal_number` text NOT NULL COMMENT 'multiple comma seprated(,)',
  `remarks` text NOT NULL,
  `exchange_rate` enum('master','optional') NOT NULL COMMENT 'Radio button - 1. Master exchange rate   2. OP exchange rate',
  `transporter` enum('Yes','No') NOT NULL DEFAULT 'Yes' COMMENT 'NAME OF TRANSPORTER(Is it country sepecific - YES)  -  manage by EMO',
  `shipped_to_storage` datetime NOT NULL COMMENT 'should not be less than the date placed in the yard',
  `storage` varchar(255) NOT NULL COMMENT 'EMO will enter',
  `shifted_to_terminal` datetime NOT NULL COMMENT 'should not be less than the date placed in the yard',
  `terminal` varchar(255) NOT NULL COMMENT 'EMO will enter',
  `shifted_to_port` datetime NOT NULL COMMENT 'should not be less than the date placed in the terminal',
  `port_of_loading` varchar(255) NOT NULL COMMENT 'EMO will enter',
  `grn_number` varchar(255) NOT NULL,
  `grn_date` datetime NOT NULL COMMENT 'should not be less than the date shifter to port',
  `base_port_used_for_freight_costing` int(11) NOT NULL COMMENT 'super admin will enter',
  `ls_number` varchar(255) NOT NULL,
  `vo_number` varchar(255) NOT NULL,
  `status_super_admin` enum('1','2') NOT NULL COMMENT 'super admin will enter the values',
  `status` enum('draft','pending_upload','not_verified_by_country_manager','verified_by_country_manager') NOT NULL DEFAULT 'draft',
  `vessel_name` varchar(255) NOT NULL,
  `voyage` varchar(255) NOT NULL,
  `sob_date` datetime NOT NULL,
  `bli_number` text NOT NULL,
  `original_bl_number` text NOT NULL,
  `ho_order_number` text NOT NULL,
  `ex_yard_price` text NOT NULL,
  `cnf` varchar(255) NOT NULL COMMENT 'Enter data in 3 currency . Final LR will be in show only in USD',
  `fob` varchar(255) NOT NULL COMMENT 'Super admin will assign 3 currency for each country',
  `fca` varchar(255) NOT NULL,
  `image_stock_pile` varchar(255) NOT NULL,
  `image_empty_container` varchar(255) NOT NULL,
  `image_container_loading` varchar(255) NOT NULL,
  `image_container_seal` varchar(255) NOT NULL,
  `image_documents` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `container_archieve`
--

INSERT INTO `container_archieve` (`id`, `container_id`, `user_id`, `country_id`, `company_id`, `yard_id`, `container_size_id`, `empty_depot_name_id`, `shipping_line_id`, `supplier_id`, `branch_code_id`, `shipping_agent_id`, `empty_container_received`, `container_placed_yard`, `container_number`, `tare_weight`, `gross_weight`, `net_weight`, `net_weight_supplier`, `net_weight_yard`, `port_of_destination`, `pay_load`, `material_code_id`, `material_description`, `material_quality_code`, `seal_number`, `remarks`, `exchange_rate`, `transporter`, `shipped_to_storage`, `storage`, `shifted_to_terminal`, `terminal`, `shifted_to_port`, `port_of_loading`, `grn_number`, `grn_date`, `base_port_used_for_freight_costing`, `ls_number`, `vo_number`, `status_super_admin`, `status`, `vessel_name`, `voyage`, `sob_date`, `bli_number`, `original_bl_number`, `ho_order_number`, `ex_yard_price`, `cnf`, `fob`, `fca`, `image_stock_pile`, `image_empty_container`, `image_container_loading`, `image_container_seal`, `image_documents`, `created_at`, `modified_at`) VALUES
(2, 14, 6, 1, 3, 1, 1, 1, 1, 0, '3', 1, '2020-03-24 00:00:00', '2020-03-25 00:00:00', 'ABCD-123456-1', '11T', '600GM', '5566', '6565656', '5090', 'rajkot', '55T', 'MTCode', 'materail description', '9898989', '1', 'this remarks of app', 'master', 'Yes', '2020-03-20 00:00:00', 'storage - 2', '2020-03-21 00:00:00', 'Terminal tesiting', '2020-03-21 00:00:00', 'Port of loading testing', 'ggggrrrnnnoooo', '2020-03-23 00:00:00', 1, 'llllssnnoo', 'vvooonnoo', '1', 'verified_by_country_manager', '', '', '2020-03-24 00:00:00', '2020-03-25 00:00:00', 'xxx-xxx-xxx', 'xxx-xxx-xxx', 'xxx-xxx-xxx', '1', '1', '1', '2020/03/stockpile.png', '2020/03/empty-container.png', '2020/03/loading-container.png', '2020/03/seal.jpg', '2020/03/documents.jpg', '2020-04-04 06:42:06', '2020-04-04 13:12:06'),
(3, 4, 6, 2, 4, 2, 1, 1, 1, 0, '2', 1, '2020-10-20 00:00:00', '2020-10-20 00:00:00', 'AAA-555-EEE-SSS', '55T', '600GM', '10010', '1010', '5090', 'rajkot', '66T', '2', 'materail description test test test test test stest', '101010', '1', 'this remarks of app', 'master', 'Yes', '2020-03-20 00:00:00', 'storage - 1', '2020-03-21 00:00:00', 'Terminal tesiting', '2020-03-21 00:00:00', 'Port of loading testing', 'ggggrrrnnnoooo', '2020-03-23 00:00:00', 1, 'llllssnnoo', 'vvooonnoo', '1', 'verified_by_country_manager', '', '', '2020-03-24 00:00:00', '2020-03-25 00:00:00', 'xxx-xxx-xxx', 'xxx-xxx-xxx', 'xxx-xxx-xxx', '1', '1', '1', '2020/03/stockpile.png', '2020/03/empty-container.png', '2020/03/loading-container.png', '2020/03/seal.jpg', '2020/03/documents.jpg', '2020-04-04 06:46:56', '2020-04-04 13:16:56');

-- --------------------------------------------------------

--
-- Table structure for table `container_images`
--

CREATE TABLE IF NOT EXISTS `container_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `container_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `image_status` enum('image_stock_pile','image_empty_container','image_container_loading','image_container_seal','image_documents') NOT NULL DEFAULT 'image_stock_pile' COMMENT '''image_stock_pile'',''image_empty_container'',''image_container_loading'',''image_container_seal'',''image_documents''',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='images of container' AUTO_INCREMENT=20 ;

--
-- Dumping data for table `container_images`
--

INSERT INTO `container_images` (`id`, `container_id`, `image`, `image_status`) VALUES
(3, 14, '2020/04/4f87179stockpile_2.png', 'image_stock_pile'),
(6, 14, '2020/04/3c42c66empty_container.png', 'image_empty_container'),
(7, 14, '2020/04/48645d8loading_container.png', 'image_container_loading'),
(8, 14, '2020/04/2e5c26fseal.jpg', 'image_container_seal'),
(9, 14, '2020/04/458aeccdocuments.jpg', 'image_documents'),
(10, 14, '2020/04/5368e2bstockpile.png', 'image_stock_pile'),
(11, 14, '2020/04/1cb446dempty_container.png', 'image_empty_container'),
(12, 14, '2020/04/18949faloading_container.png', 'image_container_loading'),
(13, 14, '2020/04/1984b58seal.jpg', 'image_container_seal'),
(14, 14, '2020/04/46dd3dcdocuments.jpg', 'image_documents'),
(15, 4, '2020/04/3c4f816stockpile.png', 'image_stock_pile'),
(16, 4, '2020/04/45879feempty_container.png', 'image_empty_container'),
(17, 4, '2020/04/10c1624loading_container.png', 'image_container_loading'),
(18, 4, '2020/04/42a1d58seal.jpg', 'image_container_seal'),
(19, 4, '2020/04/3503388documents.jpg', 'image_documents');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `created_at`, `modified_at`) VALUES
(1, 'Malesiya', '2020-03-20 12:01:04', '2020-03-20 11:03:14'),
(2, 'India', '2020-03-20 12:04:04', '2020-03-20 11:04:04'),
(3, 'America', '2020-04-09 12:18:05', '2020-04-09 06:48:05');

-- --------------------------------------------------------

--
-- Table structure for table `currency`
--

CREATE TABLE IF NOT EXISTS `currency` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `symbol` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='currency' AUTO_INCREMENT=3 ;

--
-- Dumping data for table `currency`
--

INSERT INTO `currency` (`id`, `country_id`, `name`, `symbol`, `created_at`, `modified_at`) VALUES
(1, 3, 'Dollar', '$', '2020-04-09 12:04:46', '2020-04-09 06:48:26'),
(2, 2, 'Indian Rupee', 'â‚¹', '2020-04-09 12:31:40', '2020-04-09 07:01:40');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Empty depot' AUTO_INCREMENT=3 ;

--
-- Dumping data for table `empty_depot`
--

INSERT INTO `empty_depot` (`id`, `name`, `created_at`, `modified_at`) VALUES
(1, 'Empty depot - 1', '2020-03-27 12:57:26', '2020-04-08 04:58:08'),
(2, 'Empty depot - 2', '2020-03-27 12:57:26', '2020-04-08 04:58:08');

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
-- Table structure for table `port_of_loading`
--

CREATE TABLE IF NOT EXISTS `port_of_loading` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Port of loading' AUTO_INCREMENT=4 ;

--
-- Dumping data for table `port_of_loading`
--

INSERT INTO `port_of_loading` (`id`, `country_id`, `name`, `created_at`, `modified_at`) VALUES
(1, 2, 'Loding port - 1', '2020-04-11 04:55:21', '2020-04-11 05:55:21'),
(3, 1, 'Loding port - XXX', '2020-04-14 05:58:47', '2020-04-14 12:37:07');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='seal number' AUTO_INCREMENT=4 ;

--
-- Dumping data for table `seal_numbers`
--

INSERT INTO `seal_numbers` (`id`, `seal_number`, `created_at`, `modified_at`) VALUES
(1, '12345679', '2020-03-21 10:39:30', '2020-03-21 10:39:30'),
(2, '2222222222', '2020-03-21 10:39:30', '2020-04-08 05:37:43'),
(3, '3333333333', '2020-03-21 10:39:30', '2020-03-21 10:39:30');

-- --------------------------------------------------------

--
-- Table structure for table `settings_ca`
--

CREATE TABLE IF NOT EXISTS `settings_ca` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country_id_port_of_loading` int(11) NOT NULL,
  `port_of_loading` varchar(255) NOT NULL,
  `storage_id` int(11) NOT NULL,
  `terminal_id` int(11) NOT NULL,
  `shipping_agent_forwarder` enum('yes','no') NOT NULL,
  `name_of_transporter` enum('yes','no') NOT NULL,
  `empty_depot_id` int(11) NOT NULL,
  `yard_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `inco_terms` varchar(255) NOT NULL,
  `country_manager` varchar(255) NOT NULL,
  `inspector_id` int(11) NOT NULL,
  `bookings` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Settings' AUTO_INCREMENT=2 ;

--
-- Dumping data for table `settings_ca`
--

INSERT INTO `settings_ca` (`id`, `country_id_port_of_loading`, `port_of_loading`, `storage_id`, `terminal_id`, `shipping_agent_forwarder`, `name_of_transporter`, `empty_depot_id`, `yard_id`, `supplier_id`, `inco_terms`, `country_manager`, `inspector_id`, `bookings`, `created_at`, `modified_at`) VALUES
(1, 3, 'Port of loading', 2, 2, 'no', 'no', 2, 2, 2, 'Inco Terms', 'Countrt Manager', 6, '2020-04-14 00:00:00', '0000-00-00 00:00:00', '2020-04-15 06:31:30');

-- --------------------------------------------------------

--
-- Table structure for table `settings_cm`
--

CREATE TABLE IF NOT EXISTS `settings_cm` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country_id_port_of_loading` int(11) NOT NULL,
  `port_of_loading` varchar(255) NOT NULL,
  `storage_id` int(11) NOT NULL,
  `terminal_id` int(11) NOT NULL,
  `shipping_agent_forwarder` enum('yes','no') NOT NULL DEFAULT 'no',
  `name_of_transporter` enum('yes','no') NOT NULL DEFAULT 'no',
  `empty_depot_id` int(11) NOT NULL,
  `yard_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `inco_terms` varchar(255) NOT NULL,
  `country_manager` varchar(255) NOT NULL,
  `inspector_id` int(11) NOT NULL,
  `bookings` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `settings_emo`
--

CREATE TABLE IF NOT EXISTS `settings_emo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country_id_port_of_loading` int(11) NOT NULL,
  `port_of_loading` varchar(255) NOT NULL,
  `storage_id` int(11) NOT NULL,
  `terminal_id` int(11) NOT NULL,
  `shipping_agent_forwarder` enum('yes','no') NOT NULL DEFAULT 'no',
  `name_of_transporter` enum('yes','no') NOT NULL DEFAULT 'no',
  `empty_depot_id` int(11) NOT NULL,
  `yard_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `inco_terms` varchar(255) NOT NULL,
  `country_manager` varchar(255) NOT NULL,
  `inspector_id` int(11) NOT NULL,
  `bookings` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='emo settings' AUTO_INCREMENT=2 ;

--
-- Dumping data for table `settings_emo`
--

INSERT INTO `settings_emo` (`id`, `country_id_port_of_loading`, `port_of_loading`, `storage_id`, `terminal_id`, `shipping_agent_forwarder`, `name_of_transporter`, `empty_depot_id`, `yard_id`, `supplier_id`, `inco_terms`, `country_manager`, `inspector_id`, `bookings`, `created_at`, `modified_at`) VALUES
(1, 2, 'Port of loading', 1, 2, 'yes', 'no', 1, 1, 2, 'Inco Terms', 'Name of Countrt Manager', 6, '2020-04-06 00:00:00', '2020-04-15 00:00:00', '2020-04-14 10:24:04');

-- --------------------------------------------------------

--
-- Table structure for table `settings_sa`
--

CREATE TABLE IF NOT EXISTS `settings_sa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country_id_port_of_loading` int(11) NOT NULL,
  `port_of_loading` varchar(255) NOT NULL,
  `storage_id` int(11) NOT NULL,
  `terminal_id` int(11) NOT NULL,
  `shipping_agent_forwarder` enum('yes','no') NOT NULL,
  `name_of_transporter` enum('yes','no') NOT NULL,
  `empty_depot_id` int(11) NOT NULL,
  `yard_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `inco_terms` varchar(255) NOT NULL,
  `country_manager` varchar(255) NOT NULL,
  `inspector_id` int(11) NOT NULL,
  `bookings` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `settings_sa`
--

INSERT INTO `settings_sa` (`id`, `country_id_port_of_loading`, `port_of_loading`, `storage_id`, `terminal_id`, `shipping_agent_forwarder`, `name_of_transporter`, `empty_depot_id`, `yard_id`, `supplier_id`, `inco_terms`, `country_manager`, `inspector_id`, `bookings`, `created_at`, `modified_at`) VALUES
(1, 1, 'Port of loading', 1, 2, 'no', 'yes', 1, 2, 1, 'Inco Terms', 'Countrt Manager', 6, '2020-04-13 00:00:00', '0000-00-00 00:00:00', '2020-04-16 12:47:25');

-- --------------------------------------------------------

--
-- Table structure for table `shipping_agent`
--

CREATE TABLE IF NOT EXISTS `shipping_agent` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Shiping agent' AUTO_INCREMENT=4 ;

--
-- Dumping data for table `shipping_agent`
--

INSERT INTO `shipping_agent` (`id`, `name`, `created_at`, `modified_at`) VALUES
(1, 'Shipping Agent - A', '2020-03-31 01:18:38', '2020-03-31 07:48:38'),
(2, 'Shipping Agent - B', '2020-03-31 01:18:51', '2020-03-31 07:48:51'),
(3, 'Shipping Agent - C', '2020-03-31 01:19:12', '2020-03-31 07:49:34');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Shipping line' AUTO_INCREMENT=4 ;

--
-- Dumping data for table `shipping_line`
--

INSERT INTO `shipping_line` (`id`, `name`, `created_at`, `modified_at`) VALUES
(1, 'Shipping Line - 1', '2020-03-29 00:00:00', '2020-03-29 13:35:29'),
(2, 'Shipping Line - 2', '2020-03-29 00:00:00', '2020-03-29 13:35:29'),
(3, 'Shipping Line - 3', '2020-03-29 00:00:00', '2020-03-29 13:35:29');

-- --------------------------------------------------------

--
-- Table structure for table `storages`
--

CREATE TABLE IF NOT EXISTS `storages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='name of storages' AUTO_INCREMENT=3 ;

--
-- Dumping data for table `storages`
--

INSERT INTO `storages` (`id`, `name`, `created_at`, `modified_at`) VALUES
(1, 'Storage - 1', '2020-04-11 06:26:59', '2020-04-11 07:26:59'),
(2, 'Storage - 2', '2020-04-11 06:27:17', '2020-04-11 07:27:17');

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
-- Table structure for table `terminals`
--

CREATE TABLE IF NOT EXISTS `terminals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `terminals`
--

INSERT INTO `terminals` (`id`, `name`, `created_at`, `modified_at`) VALUES
(1, 'Terminal - 1', '2020-04-11 06:35:13', '2020-04-12 18:25:43'),
(2, 'Terminal - 2', '2020-04-11 06:35:13', '2020-04-12 18:25:43');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='users' AUTO_INCREMENT=10 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `users_groups_id`, `country_id`, `company_id`, `yard_id`, `user_name`, `first_name`, `last_name`, `email`, `password`, `phone`, `location`, `image`, `status`, `app_access_days`, `rootwaystrash`, `rootwaysstatus`, `token`, `lastlogin`, `created_at`, `modified_at`) VALUES
(1, 1, 1, 3, 1, 'superadmin', 'Indicaa Group', 'Admin', 'superadmin@gmail.com', 'U5Ga0Z1aaNlYHp0MjdEdXJ1aKVVVB1TP', '1234567890', 'Sydney, Australia', '', 'permanent', 0, 0, 0, '', '2020-04-18 14:41:31', '2020-03-18 00:00:00', '2020-04-18 09:11:31'),
(2, 2, 1, 3, 1, 'manager', 'Indicaa Group ', 'Manager', 'mamager@gmail.com', 'U5Ga0Z1aaNlYHp0MjdEdXJ1aKVVVB1TP', '1234567890', '', '', 'permanent', 0, 0, 0, '', '2020-04-16 11:22:24', '2020-03-18 00:00:00', '2020-04-16 05:52:24'),
(3, 3, 1, 3, 1, 'countryadmin', 'Indicaa Group ', 'Country Admin', 'countryadmin@gmail.com', 'U5Ga0Z1aaNlYHp0MjdEdXJ1aKVVVB1TP', '1234567890', '', '', 'permanent', 0, 0, 0, '', '2020-04-16 10:36:32', '2020-03-18 00:00:00', '2020-04-16 05:06:32'),
(4, 4, 1, 3, 1, 'emoadmin', 'Indicaa Group ', 'EMO Admin', 'emoadmin@gmail.com', 'U5Ga0Z1aaNlYHp0MjdEdXJ1aKVVVB1TP', '1234567890', '', '', 'permanent', 0, 0, 0, '', '2020-04-16 17:19:04', '2020-03-18 00:00:00', '2020-04-16 11:49:04'),
(5, 5, 1, 3, 1, 'countrymanager', 'Indicaa Group ', 'Country Manager', 'countrymanager@gmail.com', 'U5Ga0Z1aaNlYHp0MjdEdXJ1aKVVVB1TP', '1234567890', '', '', 'permanent', 0, 0, 0, '', '2020-04-16 13:02:21', '2020-03-18 00:00:00', '2020-04-16 07:32:21'),
(6, 6, 1, 3, 1, 'inspector', 'Indicaa Group ', 'Inspector', 'inspector@gmail.com', '=UlVKdFVYZ1cidkSyRVbwZVZHhDeUZlUTJmRSFVVsRmTZdlUHZVb0gnVGFUP', '1234567890', 'Sydney, Australia', 'test.jpg', 'permanent', 0, 0, 0, '07ad28d62d80d8ac8bd65814a3fcb17a', '2020-03-21 06:23:42', '2020-03-18 00:00:00', '2020-03-25 06:58:42'),
(8, 6, 1, 3, 1, 'test', 'nisha', 'Testing', 'test@gmail.com', 'U5Ga0Z1aaNlYHp0MjdEdXJ1aKVVVB1TP', '1234567890', 'tst loc', '', 'limit_of_days', 600, 0, 0, 'dfbbd97a8036ea9a7e96d03b0f8d785b', '0000-00-00 00:00:00', '2020-03-20 08:15:02', '2020-04-10 06:17:09'),
(9, 6, 0, 0, 0, 'tltransport', 'Transport', 'test', 'tltransport888@gmail.com', 'QVlRHZlbnBjUxoVMV1WMSFGSShFVY9WMhFjWyFmRkV1YuJ0RaZEcLJ1RG9mWHh3UkBjWxdVVodUZtVUP', 'vinevaravine2006', '', '', 'permanent', 0, 0, 0, '', '0000-00-00 00:00:00', '2020-04-18 10:41:44', '2020-04-18 05:11:44');

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
('==QVWp0VUhlVTJFbaR1YGRWYjxmWxRFba9mUt5EUWpmST5kVWdkVuBnQi1mUUZFbW5UTFZ1VWtWODZFbwZ0UrZ1UWRVV5dFVOdkUrFDNWZlUWdVRKVnVB1TP', '==AUUFjQWZlVHZ1VWFWTUpUalVkVzRVV0tmYsZleVxGZoFGWSRXVzw2cidkSDF2R1YVZFVkeZxmU0IlMG9WVsRmTX5mQZZleNhnVGFUP', '==QVWp0VUZlTTJFbaRlTXR3VS1Ge2QlVw9kUH5EUWpmST5kVWdkVuBnQi1mUUZFbW5UTFZ1VWtWODZFbwZ0UrZ1UWRVV5dFVOdkUrFDNWZlUWdVRKVnVB1TP', '==AUVZ0RW5GaKJFbaNVTWJVU', '2020-04-18 15:07:27'),
('==QVWp0VUZlTTJ2RGR1VthnVSxmW2QlVkFmYGZFUWxGZp5kVWdkVsZ1ShJjUUZFbW9UTFZ1VWtWODZFbwZ0UrZ1UWRVV5dFVOdkUrFDNWZlUWdVRKVnVB1TP', '==AUUFjQWZlVHZ1VWFWTUpUalVkVzRVV0tmYsZleVxGZoFGWSRXVzw2cidkSDF2R1YVZFVkeZxmU0IlMG9WVsRmTX5mQZZleNhnVGFUP', '==QVWp0VUZlTT1UVxI3VthnVStmSVRlVaFmYGZFUWxGZp5kVWdkVsZ1ShJjUUZFbW9UTFZ1VWtWODZFbwZ0UrZ1UWRVV5dFVOdkUrFDNWZlUWdVRKVnVB1TP', '==AUVZ0RW5GaKJFbaNVTWJVU', '2020-04-18 15:07:27'),
('==QVWp0VUVlTTJFbah1YHFzVStmSFplVkFmYGZFUWpmSX5UVWlkVsx2UidlUzRmRk5UTFVFeW5WT1YlVwZ0UrZ1UWRVV5dFVOdkUrFDNWZlUWdVRKVnVB1TP', '=AlVGhUVup0cNFjWadlaG5kVwAXcV5WW4JlVaxkUsRmVWtmSZZVMnhnVwUTSTpmSXNleshlVGR2USJjSzdVb4RVTXh3cZVlWXZlRSpHZGRWU', '==QVWp0VUZlTTJ2RKJ3YHRnVS1GexRFboFmYGZFUWpmSX5UVWlkVsx2UidlUzRmRk5UTFVFeW5WT1YlVwZ0UrZ1UWRVV5dFVOdkUrFDNWZlUWdVRKVnVB1TP', '==AUVZ0RW5GaKJFbaVXTWJVU', '2020-04-16 13:24:52'),
('==QVWp0VUVlTTJ2RWR0YGpVYjxmWFRFbWdlYGZFUWxGZp5kVWdkVsx2bidlUUZFbWBVTFVFeW5WT1YlVwZ0UrZ1UWRVV5dFVOdkUrFDNWZlUWdVRKVnVB1TP', '==AUUFjQWZlVHZ1VWFWTUpUalVkVzRVV0tmYsZleVxGZoFGWSRXVzw2cidkSDF2R1YVZFVkeZxmU0IlMG9WVsRmTX5mQZZleNhnVGFUP', '==QVWp0VUZlTTJ2RWR1YHhnVStmWVRFbadlYGZFUWxGZp5kVWdkVsx2bidlUUZFbWBVTFVFeW5WT1YlVwZ0UrZ1UWRVV5dFVOdkUrFDNWZlUWdVRKVnVB1TP', '==AUVZ0RW5GaKJFbaNVTWJVU', '2020-04-18 15:07:27'),
('==QVWp0VUVlTTJ2RWR0YHFzVStmSFRlVkdlYGZVUV1WMO5kVWdkVuBnbidlUzRmRk9UTFVFeW5WT1YlVwZ0UrZ1UWRVV5dFVOdkUrFDNWZlUWdVRKVnVB1TP', 'QZlRIVlbKNXTxolWXpmROZFMwFXVulFeSZlWMJFbkZlVWB3RWFDcvJmRWV1VsplTjBDcVZlRkNlVxsWP', '==QVWp0VUVlTTJ2RGBlTXFzVStmSVplVWdlYGZVUV1WMO5kVWdkVuBnbidlUzRmRk9UTFVFeW5WT1YlVwZ0UrZ1UWRVV5dFVOdkUrFDNWZlUWdVRKVnVB1TP', '==AUVZ0RW5GaKJlVaVXTWJVU', '2020-04-16 17:19:08');

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
(5, '2020-03-29 21:05:26', '127.0.0.1', 'Mozilla Firefox', 1),
(5, '2020-03-30 18:27:45', '127.0.0.1', 'Mozilla Firefox', 1),
(1, '2020-03-30 18:38:56', '127.0.0.1', 'Mozilla Firefox', 1),
(5, '2020-03-31 10:29:58', '127.0.0.1', 'Mozilla Firefox', 1),
(5, '2020-03-31 12:21:08', '127.0.0.1', 'Mozilla Firefox', 1),
(4, '2020-03-31 12:53:24', '::1', 'Google Chrome', 1),
(5, '2020-03-31 15:16:34', '127.0.0.1', 'Mozilla Firefox', 1),
(1, '2020-03-31 17:54:41', '::1', 'Google Chrome', 1),
(5, '2020-04-01 09:51:32', '127.0.0.1', 'Mozilla Firefox', 1),
(5, '2020-04-01 11:15:11', '::1', 'Google Chrome', 1),
(5, '2020-04-01 12:13:40', '127.0.0.1', 'Mozilla Firefox', 1),
(5, '2020-04-01 14:02:13', '127.0.0.1', 'Mozilla Firefox', 1),
(5, '2020-04-01 15:11:48', '127.0.0.1', 'Mozilla Firefox', 1),
(5, '2020-04-02 10:48:42', '127.0.0.1', 'Mozilla Firefox', 1),
(5, '2020-04-02 11:57:59', '127.0.0.1', 'Mozilla Firefox', 1),
(5, '2020-04-02 12:58:09', '127.0.0.1', 'Mozilla Firefox', 1),
(6, '2020-04-02 14:29:26', '::1', 'Google Chrome', 0),
(5, '2020-04-02 14:29:46', '::1', 'Google Chrome', 1),
(4, '2020-04-02 14:33:12', '::1', 'Google Chrome', 1),
(3, '2020-04-02 14:36:42', '::1', 'Google Chrome', 1),
(2, '2020-04-02 14:42:42', '::1', 'Google Chrome', 1),
(1, '2020-04-02 14:44:45', '::1', 'Google Chrome', 1),
(5, '2020-04-02 15:43:32', '127.0.0.1', 'Mozilla Firefox', 1),
(5, '2020-04-02 17:23:00', '127.0.0.1', 'Mozilla Firefox', 1),
(5, '2020-04-03 09:50:50', '127.0.0.1', 'Mozilla Firefox', 1),
(5, '2020-04-03 11:14:40', '127.0.0.1', 'Mozilla Firefox', 1),
(5, '2020-04-03 12:25:39', '127.0.0.1', 'Mozilla Firefox', 1),
(5, '2020-04-03 12:55:08', '127.0.0.1', 'Mozilla Firefox', 1),
(5, '2020-04-03 14:38:30', '127.0.0.1', 'Mozilla Firefox', 1),
(5, '2020-04-03 15:29:54', '127.0.0.1', 'Mozilla Firefox', 1),
(1, '2020-04-03 15:54:00', '127.0.0.1', 'Mozilla Firefox', 1),
(5, '2020-04-03 17:09:04', '127.0.0.1', 'Mozilla Firefox', 1),
(1, '2020-04-03 17:18:26', '127.0.0.1', 'Mozilla Firefox', 1),
(5, '2020-04-03 17:29:18', '127.0.0.1', 'Mozilla Firefox', 1),
(1, '2020-04-03 18:09:22', '127.0.0.1', 'Mozilla Firefox', 1),
(5, '2020-04-03 18:16:17', '127.0.0.1', 'Mozilla Firefox', 1),
(1, '2020-04-04 10:07:08', '127.0.0.1', 'Mozilla Firefox', 1),
(1, '2020-04-04 10:48:43', '::1', 'Google Chrome', 0),
(1, '2020-04-04 10:52:21', '::1', 'Google Chrome', 1),
(3, '2020-04-04 11:22:55', '::1', 'Google Chrome', 1),
(5, '2020-04-04 11:23:22', '::1', 'Google Chrome', 1),
(1, '2020-04-04 14:09:06', '::1', 'Google Chrome', 1),
(5, '2020-04-04 14:10:12', '::1', 'Google Chrome', 1),
(5, '2020-04-04 14:38:47', '::1', 'Google Chrome', 1),
(5, '2020-04-04 14:46:23', '::1', 'Google Chrome', 1),
(5, '2020-04-04 17:49:33', '::1', 'Google Chrome', 1),
(1, '2020-04-06 12:34:17', '127.0.0.1', 'Mozilla Firefox', 1),
(5, '2020-04-06 12:46:42', '127.0.0.1', 'Mozilla Firefox', 1),
(5, '2020-04-06 14:36:09', '127.0.0.1', 'Mozilla Firefox', 1),
(1, '2020-04-06 15:58:04', '127.0.0.1', 'Mozilla Firefox', 1),
(5, '2020-04-06 15:58:22', '127.0.0.1', 'Mozilla Firefox', 1),
(5, '2020-04-06 18:26:30', '::1', 'Google Chrome', 1),
(5, '2020-04-07 09:01:13', '::1', 'Google Chrome', 1),
(5, '2020-04-07 09:43:46', '127.0.0.1', 'Mozilla Firefox', 1),
(5, '2020-04-07 10:15:34', '127.0.0.1', 'Mozilla Firefox', 1),
(5, '2020-04-07 11:57:38', '::1', 'Google Chrome', 1),
(5, '2020-04-07 15:03:10', '127.0.0.1', 'Mozilla Firefox', 1),
(5, '2020-04-07 18:33:48', '127.0.0.1', 'Mozilla Firefox', 1),
(5, '2020-04-08 09:32:57', '127.0.0.1', 'Mozilla Firefox', 1),
(5, '2020-04-08 15:11:02', '127.0.0.1', 'Mozilla Firefox', 1),
(5, '2020-04-08 15:32:13', '127.0.0.1', 'Mozilla Firefox', 1),
(5, '2020-04-08 18:20:39', '127.0.0.1', 'Mozilla Firefox', 1),
(5, '2020-04-09 09:33:43', '127.0.0.1', 'Mozilla Firefox', 1),
(1, '2020-04-09 11:50:07', '127.0.0.1', 'Mozilla Firefox', 1),
(5, '2020-04-09 12:32:44', '127.0.0.1', 'Mozilla Firefox', 1),
(5, '2020-04-09 15:29:25', '127.0.0.1', 'Mozilla Firefox', 1),
(5, '2020-04-09 17:12:30', '127.0.0.1', 'Mozilla Firefox', 1),
(5, '2020-04-10 08:48:46', '127.0.0.1', 'Mozilla Firefox', 1),
(5, '2020-04-10 09:44:34', '127.0.0.1', 'Mozilla Firefox', 1),
(5, '2020-04-10 11:27:48', '127.0.0.1', 'Mozilla Firefox', 1),
(5, '2020-04-10 11:48:00', '127.0.0.1', 'Mozilla Firefox', 1),
(4, '2020-04-10 11:52:50', '127.0.0.1', 'Mozilla Firefox', 0),
(4, '2020-04-10 11:53:24', '127.0.0.1', 'Mozilla Firefox', 1),
(4, '2020-04-10 16:38:10', '127.0.0.1', 'Mozilla Firefox', 1),
(5, '2020-04-10 16:39:05', '127.0.0.1', 'Mozilla Firefox', 1),
(4, '2020-04-10 17:08:19', '127.0.0.1', 'Mozilla Firefox', 1),
(4, '2020-04-10 18:03:21', '127.0.0.1', 'Mozilla Firefox', 1),
(4, '2020-04-11 10:27:34', '127.0.0.1', 'Mozilla Firefox', 1),
(4, '2020-04-11 11:17:16', '127.0.0.1', 'Mozilla Firefox', 1),
(4, '2020-04-11 15:27:09', '127.0.0.1', 'Mozilla Firefox', 1),
(4, '2020-04-11 17:53:07', '127.0.0.1', 'Mozilla Firefox', 1),
(4, '2020-04-12 21:13:20', '127.0.0.1', 'Mozilla Firefox', 1),
(4, '2020-04-12 22:06:32', '127.0.0.1', 'Mozilla Firefox', 1),
(4, '2020-04-12 23:54:40', '127.0.0.1', 'Mozilla Firefox', 1),
(4, '2020-04-13 01:30:22', '127.0.0.1', 'Mozilla Firefox', 1),
(4, '2020-04-14 15:31:05', '127.0.0.1', 'Mozilla Firefox', 1),
(4, '2020-04-14 16:27:39', '127.0.0.1', 'Mozilla Firefox', 1),
(1, '2020-04-14 16:29:28', '::1', 'Google Chrome', 1),
(1, '2020-04-14 16:34:29', '127.0.0.1', 'Mozilla Firefox', 1),
(4, '2020-04-14 16:51:59', '127.0.0.1', 'Mozilla Firefox', 1),
(1, '2020-04-14 16:59:45', '::1', 'Google Chrome', 1),
(1, '2020-04-14 17:21:08', '127.0.0.1', 'Mozilla Firefox', 1),
(3, '2020-04-15 09:46:49', '127.0.0.1', 'Mozilla Firefox', 1),
(3, '2020-04-15 10:22:18', '127.0.0.1', 'Mozilla Firefox', 1),
(4, '2020-04-15 10:48:29', '127.0.0.1', 'Mozilla Firefox', 1),
(3, '2020-04-15 10:49:58', '::1', 'Google Chrome', 1),
(3, '2020-04-15 11:24:29', '127.0.0.1', 'Mozilla Firefox', 1),
(4, '2020-04-15 11:27:59', '::1', 'Google Chrome', 1),
(2, '2020-04-15 12:07:42', '127.0.0.1', 'Mozilla Firefox', 1),
(3, '2020-04-15 17:21:27', '127.0.0.1', 'Mozilla Firefox', 1),
(2, '2020-04-15 17:40:49', '127.0.0.1', 'Mozilla Firefox', 1),
(3, '2020-04-16 10:33:10', '127.0.0.1', 'Mozilla Firefox', 1),
(3, '2020-04-16 10:36:32', '127.0.0.1', 'Mozilla Firefox', 1),
(5, '2020-04-16 10:39:08', '127.0.0.1', 'Mozilla Firefox', 1),
(5, '2020-04-16 10:45:54', '127.0.0.1', 'Mozilla Firefox', 1),
(1, '2020-04-16 10:51:09', '127.0.0.1', 'Mozilla Firefox', 1),
(2, '2020-04-16 10:52:47', '127.0.0.1', 'Mozilla Firefox', 1),
(2, '2020-04-16 11:22:24', '127.0.0.1', 'Mozilla Firefox', 1),
(1, '2020-04-16 11:50:09', '127.0.0.1', 'Mozilla Firefox', 1),
(1, '2020-04-16 12:25:06', '127.0.0.1', 'Mozilla Firefox', 1),
(4, '2020-04-16 12:48:55', '::1', 'Google Chrome', 1),
(5, '2020-04-16 13:02:21', '::1', 'Google Chrome', 1),
(1, '2020-04-16 17:00:16', '127.0.0.1', 'Mozilla Firefox', 1),
(4, '2020-04-16 17:19:04', '127.0.0.1', 'Mozilla Firefox', 1),
(1, '2020-04-16 18:11:30', '127.0.0.1', 'Mozilla Firefox', 1),
(1, '2020-04-18 10:39:13', '127.0.0.1', 'Mozilla Firefox', 1),
(1, '2020-04-18 14:41:31', '::1', 'Google Chrome', 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=111 ;

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
(96, 5, 'cm_container', 1, 1, 1, 1),
(97, 1, 'sa_branch', 1, 1, 1, 1),
(98, 4, 'emo_shipping_agent', 1, 1, 1, 1),
(99, 1, 'sa_base_port', 1, 1, 1, 1),
(100, 1, 'sa_currency', 1, 1, 1, 1),
(101, 5, 'cm_settings', 1, 1, 1, 1),
(102, 4, 'emo_container', 1, 1, 1, 1),
(103, 4, 'emo_settings', 1, 1, 1, 1),
(104, 1, 'sa_port_of_loading', 1, 1, 1, 1),
(105, 1, 'sa_storage', 1, 1, 1, 1),
(106, 1, 'sa_terminal', 1, 1, 1, 1),
(107, 3, 'ca_container', 1, 1, 1, 1),
(108, 3, 'ca_settings', 1, 1, 1, 1),
(109, 1, 'sa_container', 1, 1, 1, 1),
(110, 1, 'sa_settings', 1, 1, 1, 1);

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
