-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Aug 16, 2021 at 11:55 AM
-- Server version: 5.7.26
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lms_masterdata`
--

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `code` varchar(20) NOT NULL,
  `brn` int(11) DEFAULT NULL,
  `contact_person` varchar(100) NOT NULL,
  `office_telephone` varchar(14) NOT NULL,
  `mobile_tephone` varchar(14) NOT NULL,
  `email` varchar(100) NOT NULL,
  `website` varchar(100) DEFAULT NULL,
  `address` varchar(500) NOT NULL,
  `status` int(11) NOT NULL,
  `logo_pic` varchar(255) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `name`, `code`, `brn`, `contact_person`, `office_telephone`, `mobile_tephone`, `email`, `website`, `address`, `status`, `logo_pic`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 'Loan Mitra Solutions Ltd', 'TGC', 232323, 'Robin Muganzi', '0789588332', '0750588332', 'muganzirobin5@gmail.com', 'ww.trustgroup.com', 'Kampala Uganda', 1, NULL, 1628244817, 1, 1628550989, 1),
(2, 'Plutinum Ltd', 'PLUT', 1212324, 'Muganzi Robin', '0789006780', '07850065478', 'plutinum23@gmail.com', 'www.plutinum.com', 'Kampala Uganda', 1, NULL, 1628423123, 1, 1628577874, 1),
(3, 'Mifos ', 'MIFO', 295643, 'Nakaali Phionah', '0785600356', '0756000546', 'pnakaali@gmail.com', '', 'Kampala Uganda', 1, NULL, 1628577361, 1, 1628577618, 1);

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
(1, 'Active', 'Active', '1', NULL, NULL, NULL, NULL, NULL, 'success'),
(2, 'Deactivated', 'Deactivated', '1', NULL, NULL, NULL, NULL, NULL, 'danger'),
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
(19, 'Pending', 'Pending', '2', NULL, NULL, NULL, NULL, NULL, 'warning'),
(20, 'Approved', 'Approved', '2', NULL, NULL, NULL, NULL, NULL, 'success'),
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
(36, 'Rejected', 'Rejected', '2', NULL, NULL, NULL, NULL, NULL, 'danger');

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
  `client_id` int(11) NOT NULL,
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

INSERT INTO `user` (`id`, `username`, `firstname`, `lastname`, `othername`, `auth_key`, `password_hash`, `password_status`, `password_reset_token`, `email`, `status`, `client_id`, `branch_id`, `created_at`, `updated_at`, `verification_token`, `profile_pic`, `office_id`, `is_admin`, `app_module`, `telephone`, `login_at`, `passwrd_reset_at`, `created_by`, `updated_by`) VALUES
(1, 'rmuganzi1', 'Robin', 'Muganzi', '', 'rYf5_CeqEB6WOX3buPugK789jv39mSZo', '$2y$10$BA/3Dlz5UGA9dWRBxkUwu..j1eGYVIMoJ7Sl20rpE8CxiU2QTztna', 0, 'R2OJOgNasmkguVkIAI2NMeOa5JLvrxPP_1621077365', 'muganzirobin58@gmail.com', 1, 1, 0, 1587360980, 1628589621, '62AKLupZAZ1OTdBcd-xT-956WbKgdswu_1587360980', NULL, 0, 1, 1, '0789588332', NULL, NULL, 2, 1),
(2, 'pashaba', 'Penlope', 'Ashaba', '', 'OZnerVEqyfoA0NwoLvyVhXhAgl0GKd21', '$2y$10$BA/3Dlz5UGA9dWRBxkUwu..j1eGYVIMoJ7Sl20rpE8CxiU2QTztna', 0, '31IjUfphd322LxLRTitUMddsOuGDamxa_1628260313', 'penlopeashaba5@gmail.com', 1, 1, 1, 1628260313, 1628359217, NULL, NULL, NULL, 1, 2, '0789588332', NULL, NULL, 1, 2),
(3, 'jalex', 'Alex', 'Junior', '', '3kkpWU7fexDJLrjnu7rKUPHbA90zvnR-', '$2y$13$XiGnrM0SYQKILNAn4KtC7OrL.6Sa/BpZXnUI0mDWHEYgnmgZF66VG', 0, 'lYLBpyuW0JVls-97BYjItPWzdr7L_Lmy_1628261359', 'muganzirobin7@gmail.com', 1, 1, 1, 1628261359, 1628359211, NULL, NULL, NULL, 1, 2, '07895883456', NULL, NULL, 1, 2),
(4, 'amugume', 'Alex', 'Mugume', '', '0FOGLJBnFDJwNSlWlM9I09_w45cpBASh', '$2y$13$G/bDyEPv4mNb1c084UlI1ONMvVGFb2/m4/OAo0Wo1a2Q3qBKzfGge', 0, 'ihPy5lTpuDPKUbF5PHhleTa56t4aiMh2_1628261638', 'muganzirobin8@gmail.com', 1, 1, 1, 1628261638, 1628590175, NULL, NULL, NULL, 1, 2, '0750588332', NULL, NULL, 1, 8),
(5, 'bmutebi', 'Bruce', 'Mutebi', 'Kapo', 'ZyGfZFqSdXqivYtJ7bLz5w6R5Do8dhMD', '$2y$13$QuG7gPY0Z.Q5BPAEYwQoP.ucE99cgF3lgvyiriOmNpcx6TyuflUCK', 0, 'X7GbAWQDBNAKop4dCevkNkvx2sHPMwya_1628262782', 'muganzirobin60@gmail.com', 1, 1, 4, 1628262782, 1628360544, NULL, NULL, NULL, 1, 2, '0789588332', NULL, NULL, 1, 2),
(6, 'pnakaali', 'Phionah', 'Nakaali', '', '-YUfAiv3hkg-IkF9u9CAEgNldMqVZRNf', '$2y$13$mPaewVC.3Cm6aVOUrQAeq.zNz87Z7cuijwfxLJMkNiDjizXADyogK', 0, 'elFoQlj5qUrUp1wv2xs55PHc6FyoLsp7_1628275953', 'muganzirobin68@gmail.com', 1, 1, 1, 1628275953, 1628590180, NULL, NULL, NULL, 1, 2, '0789588332', NULL, NULL, 1, 8),
(7, 'pnakaali15', 'Phionah', 'Nakaali', 'Nazziwa', 'arEuzMcm7_jCQyQrxkmxOiTvu0hLMYLU', '$2y$13$0T0GUJ.cneXvGfw5XbzbbO3Ft.dEDNSvb1CXF6BEUJIzUSygUC.3O', 0, 'QoGAzAuhUnAsHZe_if9EY3lzz9oH0j8y_1628577997', 'phionahnakaali4@gmail.com', 2, 2, 1, 1628577997, 1628589663, NULL, NULL, NULL, 1, 2, '0789054637', NULL, NULL, 1, 2),
(8, 'njuluis', 'Julius ', 'Nabibanya', '', 'YCRkFyuyMlNWBcYXDb7jYYggd5cKufQr', '$2y$13$s79IlshMnZiTQDiXUpnIReKHcGHoEgUs3BQjAvaHUIzIDTTedXy1.', 0, 'xw8UsfRR-M2_umoLkG4yxK4rXlQKuHIM_1628589933', 'muganzirobin62@gmail.com', 1, 1, 1, 1628589933, 1628589933, NULL, NULL, NULL, 0, 2, '0765005643', NULL, NULL, 2, NULL),
(9, 'kpaul', 'Paul', 'Kagame', '', '3kucAXFyDHr-kTIp1CHrYsaJKo7nEj3p', '$2y$13$mG2/vsV.VhYTInkZpoGsbOjGWUflv8B4J1Xw0eq.RzCbZQUH1PSZW', 0, 'PdZjsETc_wG5RNgk1nR5v-0-7seeB-XS_1628671568', 'muganzirobin50@gmail.com', 1, 0, NULL, 1628671568, 1628671568, NULL, NULL, NULL, 1, 1, '0789546345', NULL, NULL, 1, NULL),
(10, 'mlex123', 'Mugume', 'Alex', '', 'mEW6RGRlPqrt6lwKbFVRrAPdSfcwC2ie', '$2y$13$vuuYds5cvy2qSKGl9onSOuS0ksjwvhJ.y75XaVzkVCWvEC10X1DcO', 0, 'pnihTubA5Yhc7uyyJEvrso12uaBUgRQa_1628671788', 'muganzirobin69@gmail.com', 1, 3, NULL, 1628671788, 1628671788, NULL, NULL, NULL, 1, 2, '0789435467', NULL, NULL, 9, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `office_telephone` (`office_telephone`),
  ADD UNIQUE KEY `mobile_tephone` (`mobile_tephone`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `name` (`name`),
  ADD UNIQUE KEY `code` (`code`);

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
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `master_data`
--
ALTER TABLE `master_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
