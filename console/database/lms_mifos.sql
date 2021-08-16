-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Aug 16, 2021 at 11:56 AM
-- Server version: 5.7.26
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lms_mifos`
--

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE `branch` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `mobile_telephone` varchar(45) NOT NULL,
  `office_telephone` varchar(45) NOT NULL,
  `address` varchar(225) NOT NULL,
  `status` int(11) DEFAULT '13',
  `created_at` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` varchar(45) DEFAULT NULL,
  `updated_by` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`id`, `name`, `mobile_telephone`, `office_telephone`, `address`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 'Nakawa Branch', '07800056734', '07850000400', 'Nakawa Kampala Uganda', 1, 1625122616, 1, '', ''),
(2, 'Mbarara Branch', '03800655433', '03800655423', 'Mbarara Uganda', 1, 1625325429, 1, NULL, NULL),
(3, 'Upper Nanguru ', '07895776543', '0990066575', 'Kampala Uganda', 1, 1625599743, 1, '', ''),
(4, 'Masaka Branch', '0759059205', '0392059205', 'Plot 28 Masaka Road.', 1, 1625649821, 1, '', ''),
(6, 'Kawempe Branch', '0759045690', '0391506730', 'Bombo Road', 1, 1626271931, 1, '', ''),
(7, 'Kawempe Branch', '0759452456', '0323102938', 'Bombo Road', 1, 1626684680, 1, '', ''),
(8, 'Kawempe Branch', '0789234560', '0321897089', 'Bombo Road', 1, 1626847222, 1, '', ''),
(9, 'Matuga Branch', '0784567093', '0394567093', 'Matuga-Kampala', 1, 1626965591, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `chart_of_accounts`
--

CREATE TABLE `chart_of_accounts` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL COMMENT 'Header Account Type',
  `gl_code` int(11) NOT NULL COMMENT 'General Ledger Code',
  `account_name` varchar(100) NOT NULL COMMENT 'Account Name',
  `category` varchar(100) NOT NULL COMMENT 'Header/Detail',
  `account_type` int(11) NOT NULL COMMENT 'Is it an Asset,Equity,Expense,Income or Liability?',
  `description` varchar(255) NOT NULL,
  `created_at` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `chart_of_accounts`
--

INSERT INTO `chart_of_accounts` (`id`, `parent_id`, `gl_code`, `account_name`, `category`, `account_type`, `description`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, NULL, 11000, 'Current Asset', 'HEADER', 30, 'Current Asset', 1628754133, 9, NULL, NULL),
(2, NULL, 1200, 'Bank', 'HEADER', 30, 'Bank', 1628754142, 9, NULL, NULL),
(3, 2, 11010, 'Loan', 'DETAIL', 30, 'Loan', 1628754369, 10, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `id` int(11) NOT NULL,
  `reference_number` varchar(255) DEFAULT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `othername` varchar(100) DEFAULT NULL,
  `identification_type` int(11) NOT NULL,
  `identification_number` varchar(14) NOT NULL,
  `telephone` varchar(14) NOT NULL,
  `alt_telephone` varchar(14) DEFAULT NULL,
  `gender` int(20) NOT NULL,
  `marital_status` int(20) NOT NULL,
  `date_of_birth` varchar(20) NOT NULL,
  `address` varchar(500) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `person_scenario` varchar(100) NOT NULL,
  `relationship` varchar(100) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `related_to` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`id`, `reference_number`, `firstname`, `lastname`, `othername`, `identification_type`, `identification_number`, `telephone`, `alt_telephone`, `gender`, `marital_status`, `date_of_birth`, `address`, `email`, `person_scenario`, `relationship`, `status`, `related_to`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 'TGC1629015283', 'Robin', 'Muganzi', 'Paul', 3, 'CM92011045TYHK', '0789588332', '078958835', 8, 10, '1991-08-06', 'Kampala Uganda', 'muganzirobin5@gmail.com', 'CLIENT', NULL, 20, NULL, 1628504405, 2, 1629015283, 8),
(2, 'MIFO1628784723', 'Phionah', 'Nakaali', 'Nazziwa', 3, 'CF960110496EF', '0778456703', '07530023456', 9, 10, 'Aug 6, 1996', 'Katooke A', 'phionahnakaali@gmail.com', 'CLIENT', NULL, 19, NULL, 1628579595, 2, 1628784723, 10),
(3, NULL, 'Hasifa', 'Nazziwa', '', 3, 'CF760410110ED', '+256789567936', '', 8, 11, 'Aug 4, 1983', 'Katooke Kawempe', '', 'NEXTOFKIN', '23', 19, 2, 1628580760, 2, 1628890417, 8),
(5, NULL, 'kenneth', 'Mitega', '', 3, 'CM8971020489CE', '+256789054634', '', 8, 10, 'Aug 9, 2001', 'Makindye West', 'kennethmitega@gmail.com', 'NEXTOFKIN', '18', 19, 2, 1628581284, 2, 1628636442, 8),
(7, 'MIFO1628679655', 'Josephine', 'Kakuuru', 'Atuhairwe', 3, 'CF96TYR54643TE', '07895464357', '', 9, 11, 'Aug 6, 1986', 'Kisaasi Kampala', 'muganzirobin8@gmail.com', 'CLIENT', NULL, 19, NULL, 1628679061, 10, 1628679655, 10);

-- --------------------------------------------------------

--
-- Table structure for table `client_documents`
--

CREATE TABLE `client_documents` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `document_type` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `client_documents`
--

INSERT INTO `client_documents` (`id`, `client_id`, `document_type`, `name`, `description`, `file_name`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 1, NULL, 'Test', 'Test', '611262dae48c6.png', 1628594904, 8, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `loan`
--

CREATE TABLE `loan` (
  `id` int(11) NOT NULL,
  `reference_number` varchar(255) NOT NULL,
  `client_id` int(11) NOT NULL COMMENT 'Client ID',
  `loan_type` int(11) NOT NULL,
  `amount_applied_for` decimal(10,2) NOT NULL COMMENT 'Loan Amount Requested by the Client',
  `currency` int(11) NOT NULL,
  `application_date` date DEFAULT NULL,
  `amount_approved` decimal(10,2) DEFAULT NULL,
  `disbursment_date` date DEFAULT NULL,
  `status` int(11) NOT NULL COMMENT 'Loan Status',
  `interest_rate` decimal(10,2) NOT NULL,
  `interest_frequency` varchar(20) NOT NULL,
  `installment_frequency` varchar(20) NOT NULL,
  `payment_installment_amount` decimal(10,2) DEFAULT NULL,
  `installment_payment_start_date` date DEFAULT NULL,
  `installment_payment_last_date` date DEFAULT NULL,
  `interest_payment_start_date` date DEFAULT NULL,
  `interest_payment_last_date` date DEFAULT NULL,
  `amortization_method` int(11) DEFAULT NULL,
  `loan_period` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `approved_at` int(11) DEFAULT NULL,
  `approved_by` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `loan`
--

INSERT INTO `loan` (`id`, `reference_number`, `client_id`, `loan_type`, `amount_applied_for`, `currency`, `application_date`, `amount_approved`, `disbursment_date`, `status`, `interest_rate`, `interest_frequency`, `installment_frequency`, `payment_installment_amount`, `installment_payment_start_date`, `installment_payment_last_date`, `interest_payment_start_date`, `interest_payment_last_date`, `amortization_method`, `loan_period`, `created_at`, `created_by`, `approved_at`, `approved_by`, `updated_at`, `updated_by`) VALUES
(1, 'LN211628976010', 2, 1, '1000000.00', 35, '2021-08-12', '3000000.00', NULL, 20, '2.00', 'weekly', 'monthly', '1000000.00', '2021-08-12', '2021-08-29', '2021-08-14', '2021-08-14', 39, 3, 1629018579, 8, 1628941704, 8, 1629018577, 8),
(2, 'LN211628859854', 2, 1, '6000000.00', 35, '2021-08-12', NULL, NULL, 36, '2.00', 'weekly', 'monthly', '300000.00', NULL, NULL, NULL, NULL, NULL, 3, 1628859854, 8, NULL, NULL, 1628859841, 8),
(3, 'LN211628888173', 2, 1, '2000000.00', 35, '2021-08-12', NULL, NULL, 20, '2.00', 'weekly', 'monthly', '326000.00', '2021-10-08', '2021-10-08', NULL, NULL, 39, 3, 1628888173, 8, 1628888161, 8, 1628859979, 8),
(4, 'LN211628890052', 1, 1, '40000000.00', 35, '2021-08-03', NULL, NULL, 41, '2.00', 'weekly', 'monthly', '2300000.00', NULL, NULL, NULL, NULL, NULL, 3, 1628890052, 8, 1628883348, 8, NULL, NULL),
(5, 'LN211628976058', 2, 1, '80000000.00', 35, '2021-08-04', NULL, NULL, 20, '2.00', 'weekly', 'monthly', NULL, NULL, NULL, NULL, NULL, 39, 3, 1628976058, 8, 1628888134, 8, 1628976055, 8),
(6, 'LN211628902168', 2, 2, '80000000.00', 35, '2021-08-13', NULL, '2021-08-14', 41, '2.50', 'weekly', 'monthly', NULL, NULL, NULL, NULL, NULL, NULL, 3, 1629016394, 8, NULL, NULL, 1629016391, 8),
(7, 'LN211628976022', 2, 2, '80000000.00', 35, '2021-08-13', '60000.00', NULL, 20, '2.50', 'weekly', 'monthly', '80000.00', NULL, NULL, NULL, NULL, 39, 3, 1628976022, 8, 1628939820, 8, 1628976019, 8),
(8, 'LN211628938891', 2, 3, '6000000.00', 35, '2021-08-14', '5000000.00', NULL, 20, '3.00', 'Weekly', 'Monthly', '1666666.67', '2021-08-17', '2021-08-14', '2021-08-19', '2021-08-18', 39, 3, 1628938891, 8, 1628938850, 8, NULL, NULL),
(9, 'LN211629014738', 7, 1, '80000000.00', 35, '2021-08-14', '80000.00', NULL, 20, '2.00', 'weekly', 'monthly', '26666.67', NULL, '2021-08-14', '2021-08-14', NULL, 39, 3, 1629014738, 8, 1628940119, 8, 1629014735, 8),
(10, 'LN211628940918', 2, 1, '25000000.00', 35, '2021-08-14', '500000.00', NULL, 20, '2.00', 'weekly', 'monthly', '166666.67', '2021-08-14', NULL, NULL, NULL, 39, 3, 1628940918, 8, 1628940898, 8, NULL, NULL),
(11, 'LN211628941150', 2, 1, '5000000.00', 35, '2021-08-14', '900000.00', NULL, 20, '2.00', 'weekly', 'monthly', '300000.00', NULL, NULL, NULL, NULL, 40, 3, 1628941150, 8, 1628941140, 8, NULL, NULL),
(12, 'LN211628978822', 1, 1, '5000000.00', 35, '2021-08-05', NULL, NULL, 19, '2.00', 'weekly', 'monthly', NULL, NULL, NULL, NULL, NULL, NULL, 3, 1628978822, 8, NULL, NULL, NULL, NULL),
(13, 'LN211629015078', 2, 1, '50000000.00', 35, '2021-08-15', NULL, NULL, 19, '2.00', 'weekly', 'monthly', NULL, NULL, NULL, NULL, NULL, NULL, 3, 1629015078, 8, NULL, NULL, NULL, NULL),
(14, 'BUL64561344412', 1, 1, '8000000.00', 35, '2021-08-15', NULL, NULL, 19, '2.00', 'weekly', 'monthly', NULL, NULL, NULL, NULL, NULL, NULL, 3, 1629015211, 8, NULL, NULL, 1629015206, 8),
(15, 'INDL60358309598', 7, 2, '7000000.00', 35, '2021-08-16', '6000000.00', '2021-08-16', 41, '2.50', 'weekly', 'monthly', '2000000.00', '2021-08-18', '2021-10-22', '2021-08-20', '2021-09-24', 39, 3, 1629095737, 8, 1629095613, 8, NULL, NULL),
(16, 'BUL44318017769', 1, 1, '80000000.00', 35, '2021-08-16', NULL, NULL, 19, '2.00', 'weekly', 'monthly', NULL, NULL, NULL, NULL, NULL, NULL, 3, 1629096397, 8, NULL, NULL, NULL, NULL),
(17, 'AGRI59776002995', 7, 4, '4000000.00', 35, '2021-08-16', '3000000.00', NULL, 20, '2.00', 'Weekly', 'Monthly', '1000000.00', '2021-08-18', '2021-09-24', '2021-08-26', '2021-08-28', 39, 3, 1629101259, 8, 1629100948, 8, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `loan_collateral`
--

CREATE TABLE `loan_collateral` (
  `id` int(11) NOT NULL,
  `loan_id` int(11) NOT NULL,
  `description` mediumtext NOT NULL,
  `location` mediumtext,
  `type_of_collateral` int(11) NOT NULL,
  `estimated_price` decimal(23,2) NOT NULL,
  `proof_of_ownership` varchar(255) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `loan_collateral`
--

INSERT INTO `loan_collateral` (`id`, `loan_id`, `description`, `location`, `type_of_collateral`, `estimated_price`, `proof_of_ownership`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 2, 'Land Title', NULL, 37, '3000000.00', '61162e4aad760.pdf', 1628843452, 8, NULL, NULL),
(2, 1, 'Land ', 'Kampala', 37, '300000.00', '611813edf1f6f.jpg', 1628967873, 8, NULL, NULL),
(5, 1, 'The shop is in good condtitions', 'Kyebando', 38, '800000000.00', '611a0afdb3179.jpeg', 1629096616, 8, NULL, NULL),
(6, 17, 'This is his land title', 'Katooke Kampala', 37, '8000000.00', '611a1b6b8ff3b.jpg', 1629100736, 8, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `loan_guarantor`
--

CREATE TABLE `loan_guarantor` (
  `id` int(11) NOT NULL,
  `loan_id` int(11) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `othername` varchar(100) DEFAULT NULL,
  `gender` int(11) NOT NULL,
  `identification_type` int(11) NOT NULL,
  `identification_number` varchar(14) NOT NULL,
  `telephone_primary` varchar(14) NOT NULL,
  `telephone_alternative` varchar(14) DEFAULT NULL,
  `employer_name` varchar(100) DEFAULT NULL,
  `source_of_income` varchar(100) DEFAULT NULL,
  `physical_address` varchar(255) NOT NULL,
  `created_at` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `loan_guarantor`
--

INSERT INTO `loan_guarantor` (`id`, `loan_id`, `firstname`, `lastname`, `othername`, `gender`, `identification_type`, `identification_number`, `telephone_primary`, `telephone_alternative`, `employer_name`, `source_of_income`, `physical_address`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 1, 'Robin', 'Muganzi', 'Paul', 8, 3, 'CM920110546T88', '0789588332', '0750588332', NULL, 'Salary', 'Kampala Uganda', 1628838829, 8, NULL, NULL),
(2, 12, 'Phionah', 'Nakaali', 'Naziiwa', 9, 3, 'CF59005465473', '0789065467', '078546730', NULL, 'Salary', 'Katooke Kawempe', 1629095823, 8, NULL, NULL),
(3, 1, 'Penlope', 'Ashaba', '', 8, 3, 'CF90045T6467', '075200435467', '07828883457', NULL, '', 'Kyebando', 1629096397, 8, NULL, NULL),
(4, 17, 'Kenneth', 'Mitega', '', 8, 3, 'CM8904710189EF', '0786978902', '', NULL, '', 'Makyide Kamapala', 1629100344, 8, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `loan_manager_remarks`
--

CREATE TABLE `loan_manager_remarks` (
  `id` int(11) NOT NULL,
  `loan_id` int(11) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `category` varchar(20) NOT NULL,
  `remarks` varchar(500) NOT NULL,
  `created_at` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `loan_manager_remarks`
--

INSERT INTO `loan_manager_remarks` (`id`, `loan_id`, `client_id`, `category`, `remarks`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, NULL, 1, 'CLIENT', 'Approved ', 1628638131, 8, NULL, NULL),
(2, NULL, 2, 'CLIENT', 'Approved', 1628638243, 8, NULL, NULL),
(3, NULL, 1, 'CLIENT', 'Rejected', 1628638766, 8, NULL, NULL),
(4, NULL, 2, 'CLIENT', 'Rejected', 1628638893, 8, NULL, NULL),
(5, 2, NULL, 'LOAN', 'Testing', 1628848025, 8, NULL, NULL),
(6, 1, NULL, 'LOAN', 'You don\'t meet the conditions ', 1628853575, 8, NULL, NULL),
(7, 4, NULL, 'LOAN', 'You don\'t meet conditions!!', 1628854165, 8, NULL, NULL),
(8, 4, NULL, 'LOAN', 'You don\'t meet conditions!!', 1628854207, 8, NULL, NULL),
(9, 4, NULL, 'LOAN', 'You don\'t meet the requirements!!', 1628854436, 8, NULL, NULL),
(10, 1, NULL, 'LOAN', 'You don\'t meet the required requirement!!', 1628854578, 8, NULL, NULL),
(11, 4, NULL, 'LOAN', 'We are sorry', 1628854689, 8, NULL, NULL),
(12, 4, NULL, 'LOAN', 'Reply again', 1628854768, 8, NULL, NULL),
(13, 1, NULL, 'LOAN', 'You don\'t meet the required conditions', 1628854872, 8, NULL, NULL),
(14, 1, NULL, 'LOAN', 'You don\'t qualify for this loan!', 1628855346, 8, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `loan_payment_schedule`
--

CREATE TABLE `loan_payment_schedule` (
  `id` int(11) NOT NULL,
  `loan_id` int(11) NOT NULL,
  `due_date` date NOT NULL,
  `amount_p amount_principle rinci` decimal(10,2) NOT NULL,
  `amount_interest` decimal(10,2) NOT NULL,
  `amount_balance` decimal(10,2) NOT NULL,
  `payment_status` int(11) NOT NULL,
  `payment_date` date DEFAULT NULL,
  `penalty` decimal(10,2) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `loan_product`
--

CREATE TABLE `loan_product` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `product_code` varchar(45) NOT NULL,
  `description` varchar(500) NOT NULL,
  `interest_rate` decimal(10,2) NOT NULL,
  `account_to_credit` int(11) NOT NULL,
  `account_to_debit` int(11) NOT NULL,
  `processing_loan_fees` decimal(10,2) NOT NULL,
  `principal_installment_frequency` varchar(100) NOT NULL,
  `interest_frequency` varchar(100) NOT NULL,
  `minimum_amount` decimal(10,2) NOT NULL,
  `maximum_amount` float(10,2) NOT NULL,
  `maximum_repayment_period` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `penalty` decimal(10,2) NOT NULL,
  `created_at` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `loan_product`
--

INSERT INTO `loan_product` (`id`, `name`, `product_code`, `description`, `interest_rate`, `account_to_credit`, `account_to_debit`, `processing_loan_fees`, `principal_installment_frequency`, `interest_frequency`, `minimum_amount`, `maximum_amount`, `maximum_repayment_period`, `status`, `penalty`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 'Business Loan', 'BUL', 'Testing', '2.00', 3, 3, '20000.00', 'monthly', 'weekly', '100000.00', 1000000.00, 3, 1, '500000.00', 1628759424, 10, 1628898106, 8),
(2, 'Individual Loan', 'INDL', 'TEST 123', '2.50', 3, 3, '20000.00', 'monthly', 'weekly', '100000.00', 2500000.00, 3, 1, '50000.00', 1628760190, 10, 1628761068, 10),
(3, 'Salary Loan', 'SALN', 'This is a salary loan product', '3.00', 3, 3, '20000.00', 'Monthly', 'Weekly', '100000.00', 2500000.00, 3, 1, '50000.00', 1628897922, 8, 1628898114, 8),
(4, 'Agricultural Loan', 'AGRI', 'This is agricultural Loan', '2.00', 3, 3, '20000.00', 'Monthly', 'Weekly', '100000.00', 25000000.00, 3, 1, '50000.00', 1629099388, 8, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `loan_product_required_documents`
--

CREATE TABLE `loan_product_required_documents` (
  `id` int(11) NOT NULL,
  `loan_product_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `loan_product_required_documents`
--

INSERT INTO `loan_product_required_documents` (`id`, `loan_product_id`, `name`, `description`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 1, 'National ID', 'National ID', 1628762221, 10, NULL, NULL),
(2, 3, 'Monthly Payment Slips', 'Monthly Payment Slips', 1628898022, 8, NULL, NULL),
(3, 4, 'National ID', 'You are required to bring your National ID', 1629099672, 8, NULL, NULL),
(4, 4, 'LC I Letter', 'You are required to bring LC ', 1629099791, 8, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `master_data`
--

CREATE TABLE `master_data` (
  `id` int(11) NOT NULL,
  `name` varchar(225) NOT NULL,
  `description` tinytext,
  `created_by` varchar(45) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `updated_by` varchar(45) DEFAULT NULL,
  `reference_table` varchar(225) DEFAULT NULL COMMENT 'Table to which this status is applicable',
  `parent_id` int(11) DEFAULT NULL,
  `css_class` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `master_data`
--

INSERT INTO `master_data` (`id`, `name`, `description`, `created_by`, `created_at`, `updated_at`, `updated_by`, `reference_table`, `parent_id`, `css_class`) VALUES
(1, 'Active', 'Active', '1', NULL, NULL, NULL, 'status', NULL, 'success'),
(2, 'Deactivated', 'Deactivated', '1', NULL, NULL, NULL, 'status', NULL, 'danger'),
(3, 'National ID', 'National ID', '', NULL, NULL, NULL, 'identification_type', NULL, NULL),
(4, 'Voter\'s ID', 'Voter\'s ID', '2', NULL, NULL, NULL, 'identification_type', NULL, NULL),
(5, 'Passport No', 'Passport No', '1', NULL, NULL, NULL, 'identification_type', NULL, NULL),
(6, 'Driving Permit', 'Driving Permit', '1', NULL, NULL, NULL, 'identification_type', NULL, NULL),
(7, 'Work ID', 'Work ID', '2', NULL, NULL, NULL, 'identification_type', NULL, NULL),
(8, 'Male', 'Male', '2', NULL, NULL, NULL, 'sex', NULL, NULL),
(9, 'Female', 'Female', '2', NULL, NULL, NULL, 'sex', NULL, NULL),
(10, 'Married', 'Married', '1', NULL, NULL, NULL, 'marital_status', NULL, NULL),
(11, 'Single', 'Single', '1', NULL, NULL, NULL, 'marital_status', NULL, NULL),
(12, 'Widowed', 'widowed', '', NULL, NULL, NULL, 'marital_status', NULL, NULL),
(13, 'Divorced', 'Divorced', '1', NULL, NULL, NULL, 'marital_status', NULL, NULL),
(14, 'Separated', 'Separated', '1', NULL, NULL, NULL, 'marital_status', NULL, NULL),
(15, 'Staff', 'Staff', '1', NULL, NULL, NULL, 'membership_type', NULL, NULL),
(16, 'Non Staff', 'Non Staff', '1', NULL, NULL, NULL, 'membership_type', NULL, NULL),
(17, 'Sister', 'Sister', '1', NULL, NULL, NULL, 'relationship', NULL, NULL),
(18, 'Brother', 'Brother', '1', NULL, NULL, NULL, 'relationship', NULL, NULL),
(19, 'Pending', 'Pending', '2', NULL, NULL, NULL, 'status', NULL, 'warning'),
(20, 'Approved', 'Approved', '2', NULL, NULL, NULL, 'status', NULL, 'success'),
(21, 'Others', 'Others specify', '2', NULL, NULL, NULL, 'identification_type', NULL, NULL),
(22, 'Child', 'Child', '2', NULL, NULL, NULL, 'relationship', NULL, NULL),
(23, 'Mother', 'Mother', '2', NULL, NULL, NULL, 'relationship', NULL, NULL),
(24, 'Father', 'Father', '2', NULL, NULL, NULL, 'relationship', NULL, NULL),
(25, 'Wife', 'Wife', '2', NULL, NULL, NULL, 'relationship', NULL, NULL),
(26, 'Husband', 'Husband', '2', NULL, NULL, NULL, 'relationship', NULL, NULL),
(28, 'Guardian', 'Guardian', '', NULL, NULL, NULL, 'relationship', NULL, NULL),
(29, 'Others', 'Others', '', NULL, NULL, NULL, 'relationship', NULL, NULL),
(30, 'Assest', 'Asset', '2', NULL, NULL, NULL, 'account_type', NULL, NULL),
(31, 'Equity', 'Equity', '2', NULL, NULL, NULL, 'account_type', NULL, NULL),
(32, 'Expense', 'Expense', '2', NULL, NULL, NULL, 'account_type', NULL, NULL),
(33, 'Income', 'Income', '2', NULL, NULL, NULL, 'account_type', NULL, NULL),
(34, 'Liability', 'Liability', '2', NULL, NULL, NULL, 'account_type', NULL, NULL),
(35, 'UGX', 'UGX', '2', NULL, NULL, NULL, 'currency', NULL, NULL),
(36, 'Rejected', 'Rejected', '2', NULL, NULL, NULL, 'status', NULL, 'danger'),
(37, 'Land', 'Land', '2', NULL, NULL, NULL, 'type_of_collateral', NULL, NULL),
(38, 'Business', 'Business', '2', NULL, NULL, NULL, 'type_of_collateral', NULL, NULL),
(39, 'Straight line', 'Straight line', '2', NULL, NULL, NULL, 'amortization_method', NULL, NULL),
(40, 'Declining balance', 'Declining balance', '2', NULL, NULL, NULL, 'amortization_method', NULL, NULL),
(41, 'Released', 'Released', '2', NULL, NULL, NULL, 'status', NULL, 'primary');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `othername` varchar(100) DEFAULT NULL,
  `auth_key` varchar(32) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `password_status` int(11) NOT NULL DEFAULT '0',
  `password_reset_token` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `branch_id` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `verification_token` varchar(255) DEFAULT NULL,
  `profile_pic` varchar(45) DEFAULT NULL,
  `office_id` int(11) DEFAULT NULL,
  `is_admin` int(11) NOT NULL,
  `app_module` int(11) NOT NULL,
  `telephone` varchar(25) DEFAULT NULL,
  `login_at` int(11) DEFAULT NULL,
  `passwrd_reset_at` int(11) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `firstname`, `lastname`, `othername`, `auth_key`, `password_hash`, `password_status`, `password_reset_token`, `email`, `status`, `branch_id`, `created_at`, `updated_at`, `verification_token`, `profile_pic`, `office_id`, `is_admin`, `app_module`, `telephone`, `login_at`, `passwrd_reset_at`, `created_by`, `updated_by`) VALUES
(1, 'rmuganzi1', 'Robin', 'Muganzi', '', 'rYf5_CeqEB6WOX3buPugK789jv39mSZo', '$2y$10$BA/3Dlz5UGA9dWRBxkUwu..j1eGYVIMoJ7Sl20rpE8CxiU2QTztna', 0, 'R2OJOgNasmkguVkIAI2NMeOa5JLvrxPP_1621077365', 'muganzirobin5@gmail.com', 1, 0, 1587360980, 1628277073, '62AKLupZAZ1OTdBcd-xT-956WbKgdswu_1587360980', NULL, 0, 1, 1, '0789588332', NULL, NULL, 2, 1),
(2, 'pashaba', 'Penlope', 'Ashaba', '', 'OZnerVEqyfoA0NwoLvyVhXhAgl0GKd21', '$2y$10$BA/3Dlz5UGA9dWRBxkUwu..j1eGYVIMoJ7Sl20rpE8CxiU2QTztna', 0, '31IjUfphd322LxLRTitUMddsOuGDamxa_1628260313', 'penlopeashaba5@gmail.com', 1, 1, 1628260313, 1628359217, NULL, NULL, NULL, 1, 2, '0789588332', NULL, NULL, 1, 2),
(3, 'jalex', 'Alex', 'Junior', '', '3kkpWU7fexDJLrjnu7rKUPHbA90zvnR-', '$2y$13$XiGnrM0SYQKILNAn4KtC7OrL.6Sa/BpZXnUI0mDWHEYgnmgZF66VG', 0, 'lYLBpyuW0JVls-97BYjItPWzdr7L_Lmy_1628261359', 'muganzirobin7@gmail.com', 1, 1, 1628261359, 1628359211, NULL, NULL, NULL, 1, 2, '07895883456', NULL, NULL, 1, 2),
(4, 'amugume', 'Alex', 'Mugume', '', '0FOGLJBnFDJwNSlWlM9I09_w45cpBASh', '$2y$13$G/bDyEPv4mNb1c084UlI1ONMvVGFb2/m4/OAo0Wo1a2Q3qBKzfGge', 0, 'ihPy5lTpuDPKUbF5PHhleTa56t4aiMh2_1628261638', 'muganzirobin8@gmail.com', 2, 1, 1628261638, 1628363821, NULL, NULL, NULL, 1, 2, '0750588332', NULL, NULL, 1, 2),
(5, 'bmutebi', 'Bruce', 'Mutebi', 'Kapo', 'ZyGfZFqSdXqivYtJ7bLz5w6R5Do8dhMD', '$2y$13$QuG7gPY0Z.Q5BPAEYwQoP.ucE99cgF3lgvyiriOmNpcx6TyuflUCK', 0, 'X7GbAWQDBNAKop4dCevkNkvx2sHPMwya_1628262782', 'muganzirobin60@gmail.com', 1, 4, 1628262782, 1628360544, NULL, NULL, NULL, 1, 2, '0789588332', NULL, NULL, 1, 2),
(6, 'pnakaali', 'Phionah', 'Nakaali', '', '-YUfAiv3hkg-IkF9u9CAEgNldMqVZRNf', '$2y$13$mPaewVC.3Cm6aVOUrQAeq.zNz87Z7cuijwfxLJMkNiDjizXADyogK', 0, 'elFoQlj5qUrUp1wv2xs55PHc6FyoLsp7_1628275953', 'muganzirobin68@gmail.com', 1, 1, 1628275953, 1628277077, NULL, NULL, NULL, 1, 2, '0789588332', NULL, NULL, 1, 1),
(7, 'mpaul3', 'Paul', 'Paul', '', 'i7vAue8T5-mlCaUkKDn4Zb2a-AQW4QqB', '$2y$13$9wClo0FKv9nDhsu2TuhOMuhlHMwQU7MiSKj0k92OswIuCW..8xoYC', 0, '_WX6H37DDvCaRr8Aev85MeZOLx9w3BFZ_1628588264', 'muganzirobin67@gmail.com', 1, 1, 1628588264, 1628588264, NULL, NULL, NULL, 0, 2, '08966457', NULL, NULL, 2, NULL),
(9, 'pmuganzi', 'Paul', 'Paul', '', 'enbZCk425tyB4rUWHEMkAiQNoT-FUMbF', '$2y$13$pMaTeMX0geJCl3qXQ.o2C.IqPT.CdjhZpx4mwm0KFPL5YGu.pOKhG', 0, 'yj3UD5qy5fB1TcJZqu7oLG2EJSCOkqMc_1628589212', 'muganzirobin6@gmail.com', 1, 2, 1628589212, 1628589212, NULL, NULL, NULL, 0, 2, '07895467345', NULL, NULL, 2, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chart_of_accounts`
--
ALTER TABLE `chart_of_accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `identification_number` (`identification_number`),
  ADD UNIQUE KEY `telephone` (`telephone`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `client_documents`
--
ALTER TABLE `client_documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loan`
--
ALTER TABLE `loan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loan_collateral`
--
ALTER TABLE `loan_collateral`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loan_guarantor`
--
ALTER TABLE `loan_guarantor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loan_manager_remarks`
--
ALTER TABLE `loan_manager_remarks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loan_payment_schedule`
--
ALTER TABLE `loan_payment_schedule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loan_product`
--
ALTER TABLE `loan_product`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `loan_product_required_documents`
--
ALTER TABLE `loan_product_required_documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_data`
--
ALTER TABLE `master_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `chart_of_accounts`
--
ALTER TABLE `chart_of_accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `client_documents`
--
ALTER TABLE `client_documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `loan`
--
ALTER TABLE `loan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `loan_collateral`
--
ALTER TABLE `loan_collateral`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `loan_guarantor`
--
ALTER TABLE `loan_guarantor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `loan_manager_remarks`
--
ALTER TABLE `loan_manager_remarks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `loan_payment_schedule`
--
ALTER TABLE `loan_payment_schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `loan_product`
--
ALTER TABLE `loan_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `loan_product_required_documents`
--
ALTER TABLE `loan_product_required_documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `master_data`
--
ALTER TABLE `master_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
