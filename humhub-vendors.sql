-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 08, 2021 at 09:39 PM
-- Server version: 5.7.32
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `humhub`
--

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `id` bigint(20) NOT NULL,
  `vendor_name` varchar(100) NOT NULL,
  `vendor_type` tinyint(4) NOT NULL,
  `subtype` int(11) DEFAULT NULL,
  `vendor_contact` varchar(60) DEFAULT NULL,
  `vendor_phone` varchar(30) DEFAULT NULL,
  `vendor_email` varchar(60) DEFAULT NULL,
  `vendor_area` varchar(60) DEFAULT NULL,
  `vendor_recommended_user_id` int(11) DEFAULT NULL,
  `vendor_rating` tinyint(4) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`id`, `vendor_name`, `vendor_type`, `subtype`, `vendor_contact`, `vendor_phone`, `vendor_email`, `vendor_area`, `vendor_recommended_user_id`, `vendor_rating`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(2, 'Vendor 2.5', 5, 1, 'Vendor 2 Contact Name', '444-333-2345', 'vendor2.5@cosco.com', 'Area 1', 2, 0, '2021-08-19 00:00:00', 4, '2021-08-19 00:00:00', 4),
(3, 'Vendor 3', 4, 1, 'Matt Stevens', '123-555-7575', 'matt@v3.com', 'Area 51', 4, 4, '2021-08-19 00:00:00', 4, '2021-08-19 00:00:00', 4),
(5, 'Vendor 12', 3, 1, 'Bob Jones', '', 'jones@mail.com', 'San Fran', 1, 2, '2021-08-19 00:00:00', 4, '2021-08-19 00:00:00', 4),
(6, 'Vendor 14', 5, 1, 'Sam', '', 'sam@vendor14.com', 'Lima', 4, NULL, '2021-08-19 00:00:00', 4, '2021-08-19 00:00:00', 4),
(7, 'Vendor 15', 3, 1, 'Bill', '654-342-1324', '', 'North Fork', 4, 3, '2021-08-19 00:00:00', 4, '2021-08-19 00:00:00', 4),
(8, 'Vendor 16', 4, 1, 'Amy', '', 'amy@vendor16.com', 'Central', 4, 3, '2021-08-19 00:00:00', 4, '2021-09-03 08:15:53', 4),
(9, 'Thomson Appraisers ', 3, 1, 'Larry', '546-555-8479', 'tom@thomson.com', 'North Bend', 4, NULL, '2021-08-19 00:00:00', 4, '2021-08-19 00:00:00', 4),
(10, 'Vendor 17', 2, 1, 'Mike Jones', '765-555-3241', 'mike@mail.com', 'Buford', 4, NULL, '2021-08-19 00:00:00', 4, '2021-08-19 00:00:00', 4),
(11, 'Vendor 18', 2, 1, 'Matt Stevens', '345-555-2345', 'matt@v3.com', 'Buford', 4, NULL, '2021-08-19 00:00:00', 4, '2021-08-19 00:00:00', 4),
(12, 'Vendor 19', 5, 1, 'Barbra King', '546-555-8479', 'barbra@king.org', 'Metro', 4, NULL, '2021-08-19 00:00:00', 4, '2021-08-19 00:00:00', 4),
(13, 'Vendor 19', 2, 1, 'Barbra King', '546-555-8479', 'barbra@king.org', 'Metro', 4, NULL, '2021-08-19 00:00:00', 4, '2021-08-19 00:00:00', 4),
(14, 'Wells Accountanting', 4, 1, 'Brian Wells', '287-555-7681', 'b@wells.com', 'Buford', 4, 1, '2021-08-19 00:00:00', 4, '2021-09-02 17:18:01', 4),
(15, 'Vendor 20', 5, 1, 'Sam', '898-555-8476', 'sam@vendor20.com', 'Rome', 4, NULL, '2021-08-19 00:00:00', 4, '2021-08-19 00:00:00', 4),
(16, 'Vendor 21', 2, 1, 'Sue Hall', '653-555-7171', 'sue@hall.com', 'Buford', 4, NULL, '2021-08-19 00:00:00', 4, '2021-08-19 00:00:00', 4),
(17, 'Vendor 22', 2, 1, 'Malon', '546-555-8479', 'malon@mail.com', 'Buford', 4, NULL, '2021-08-19 00:00:00', 4, '2021-08-19 00:00:00', 4),
(18, 'Vendor 23', 2, 1, 'Lloyed', '987-555-2637', 'lloyed@vendor.com', 'Buford', 4, NULL, '2021-08-19 00:00:00', 4, '2021-08-19 00:00:00', 4),
(19, 'Vendor 25', 2, 1, 'Jean', '546-555-8479', 'jean@vendor.com', 'Buford', 4, NULL, '2021-08-19 00:00:00', 4, '2021-08-19 00:00:00', 4),
(20, 'Container Vendor', 4, 1, 'Lester', '546-555-8479', 'lester@home.com', 'Midtown', 4, 1, '2021-08-19 00:00:00', 4, '2021-08-19 00:00:00', 4),
(21, 'Vendor 47', 3, 1, 'Lewis', '645-555-5431', 'lewis@home.com', 'Midtown', 4, NULL, '2021-08-19 00:00:00', 4, '2021-08-19 00:00:00', 4),
(22, 'Happy Appraisers', 3, 1, 'Hal Smith', '465-555-8597', 'hal@home.com', 'Midtown', 4, NULL, '2021-08-19 00:00:00', 4, '2021-08-19 00:00:00', 4),
(23, 'Belmont appraisers', 3, 1, 'bob', '546-555-8479', 'bob@super.com', 'Midtown', 4, NULL, '2021-08-19 00:00:00', 4, '2021-08-19 00:00:00', 4),
(24, 'Vallery Accountants', 4, 1, 'Bob Samuels', '546-555-8479', 'bob@super.com', 'Midtown', 4, NULL, '2021-08-19 00:00:00', 4, '2021-08-19 00:00:00', 4),
(25, 'Earth Appraisers', 3, 1, 'Sally Niles', '654-342-1324', 'sally@bufordsales.com', 'Buford', 4, NULL, '2021-08-19 00:00:00', 4, '2021-08-19 00:00:00', 4),
(26, 'New Accounting', 4, 1, 'Valery', '785-555-9864', 'valery@new.com', 'Midtown', 4, NULL, '2021-08-19 00:00:00', 4, '2021-08-19 00:00:00', 4),
(27, 'AAA Accounting', 8, 47, 'Tomson', '888-555-2345', 'tom@aaa.com', 'Midtown', 4, 1, '2021-08-19 00:00:00', 4, '2021-08-29 14:52:26', 4),
(28, 'BBB Accounting', 8, 47, 'Bob', '888-555-2345', 'bob@accouting.com', 'Buford', 4, 5, '2021-08-19 00:00:00', 4, '2021-09-03 07:44:53', 4),
(29, 'CCC Accounting', 8, 1, 'Bob', '888-555-2345', 'bob@accouting.com', 'Midtown', 4, NULL, '2021-08-19 00:00:00', 4, '2021-09-02 18:35:05', 4),
(30, 'DDD Accounting', 4, 1, 'Bob', '888-555-2345', 'bob@accouting.com', 'Buford', NULL, NULL, '2021-08-19 00:00:00', 4, '2021-08-19 00:00:00', 4),
(31, 'AWA Accounting', 8, 1, 'Victor', '888-555-2345', 'victor@good.com', 'Midtown', 4, 3, '2021-08-23 15:27:03', 4, '2021-09-02 18:37:51', 4),
(32, 'AVA Accounting', 8, 1, 'Lisa', '888-555-2345', 'lisa@mail.com', 'Midtown', NULL, NULL, '2021-08-25 21:01:06', 4, '2021-08-25 21:01:06', 4),
(33, 'AZA Accounting', 8, 1, 'Lisa', '888-555-2345', 'lisa@mail.com', 'Midtown', NULL, NULL, '2021-08-25 21:14:41', 4, '2021-08-25 21:14:41', 4),
(34, 'ACH Accounting', 8, 47, 'Lisa', '888-555-2345', 'lisa@mail.com', 'Midtown', NULL, NULL, '2021-08-29 15:00:07', 4, '2021-08-29 15:00:07', 4),
(35, 'Last Chance Lender', 2, 35, 'Linn', '888-555-2345', 'linn@lastchance.com', 'Midtown', NULL, NULL, '2021-09-08 18:21:26', 4, '2021-09-08 18:21:26', 4),
(36, 'Odd Designs', 6, 1, 'William', '958-555-3763', 'will@home.com', 'Midtown', NULL, NULL, '2021-09-08 18:26:19', 4, '2021-09-08 18:26:19', 4);

-- --------------------------------------------------------

--
-- Table structure for table `vendors_ratings`
--

CREATE TABLE `vendors_ratings` (
  `rating_id` bigint(20) NOT NULL,
  `vendor_id` bigint(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_rating` tinyint(4) NOT NULL,
  `rating_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `review` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vendors_ratings`
--

INSERT INTO `vendors_ratings` (`rating_id`, `vendor_id`, `user_id`, `user_rating`, `rating_date`, `review`) VALUES
(9, 5, 1, 3, '2021-08-31 15:45:52', NULL),
(10, 3, 1, 5, '2021-08-31 15:45:52', NULL),
(11, 4, 1, 1, '2021-08-31 15:45:52', NULL),
(12, 3, 4, 3, '2021-08-31 15:45:52', NULL),
(13, 31, 4, 3, '2021-09-02 19:57:16', 'I like this vendor.'),
(14, 5, 4, 1, '2021-08-31 15:45:52', NULL),
(15, 7, 4, 3, '2021-08-31 15:45:52', NULL),
(16, 8, 4, 1, '2021-09-03 11:15:53', 'This is my rating.'),
(17, 20, 4, 1, '2021-08-31 15:45:52', NULL),
(18, 27, 4, 1, '2021-08-31 15:45:52', NULL),
(19, 31, 4, 3, '2021-09-01 19:32:39', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam'),
(20, 28, 4, 5, '2021-09-02 20:08:49', 'I do not like this vendor.'),
(21, 14, 4, 2, '2021-09-02 21:04:00', 'Helpful sometimes.'),
(22, 0, 0, 5, '2021-09-02 20:12:08', NULL),
(23, 24, 4, 2, '2021-09-02 21:10:45', 'A so so vendor.'),
(24, 34, 4, 5, '2021-09-03 10:48:50', 'This is my favorite.'),
(25, 8, 3, 5, '2021-09-03 10:55:30', 'Does fast work.');

-- --------------------------------------------------------

--
-- Table structure for table `vendor_sub_type`
--

CREATE TABLE `vendor_sub_type` (
  `subtype_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `subtype_name` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vendor_sub_type`
--

INSERT INTO `vendor_sub_type` (`subtype_id`, `type_id`, `subtype_name`) VALUES
(1, 6, 'Designers'),
(2, 6, 'Architects'),
(3, 6, 'Stagers'),
(5, 3, 'General Contractors'),
(6, 3, 'AC'),
(7, 3, 'Electricians'),
(8, 3, 'Carpentry and Trim'),
(9, 3, 'Plumbers'),
(10, 3, 'Septic'),
(11, 3, 'Make-Ready Services'),
(12, 3, 'Handyman Services'),
(13, 3, 'Roofers'),
(14, 3, 'Foundation'),
(15, 3, 'Framers'),
(16, 3, 'Drywall'),
(17, 3, 'Painters'),
(18, 3, 'Landscapers'),
(19, 3, 'Hardscape'),
(20, 3, 'Cabinets and Counters'),
(21, 3, 'Doors and Windows'),
(22, 3, 'Arborists'),
(23, 3, 'Pest Control'),
(24, 3, 'Lock Smith'),
(25, 3, 'Flooring'),
(26, 3, 'Other Contractors'),
(27, 6, 'Engineers'),
(28, 6, 'Other Home Design'),
(29, 5, 'Title'),
(30, 5, 'Contract to Close Services'),
(31, 5, 'Surveyors'),
(32, 5, 'Home Warranty'),
(33, 5, 'Inspectors'),
(34, 5, 'Other Closing Services'),
(35, 2, 'Traditional'),
(36, 2, 'Commercial'),
(37, 2, 'Hard Money'),
(38, 2, 'Other Lenders'),
(39, 7, 'Printing'),
(40, 7, 'Signs'),
(41, 7, 'Marketing Companies'),
(42, 7, 'Photographers'),
(43, 7, 'Other Marketing'),
(44, 8, 'Loan Servicing'),
(45, 8, 'Insurance Agents'),
(46, 8, 'Bookkeeping'),
(47, 8, 'CPAs'),
(48, 8, 'Public Adjusters'),
(49, 8, 'Banks'),
(50, 8, 'Other Financial Services');

-- --------------------------------------------------------

--
-- Table structure for table `vendor_types`
--

CREATE TABLE `vendor_types` (
  `type_id` tinyint(4) NOT NULL,
  `type_name` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vendor_types`
--

INSERT INTO `vendor_types` (`type_id`, `type_name`) VALUES
(2, 'Lenders'),
(3, 'Contractors'),
(4, 'Attorneys'),
(5, 'Closing Services'),
(6, 'Home Design'),
(7, 'Marketing'),
(8, 'Financial Services');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendors_ratings`
--
ALTER TABLE `vendors_ratings`
  ADD PRIMARY KEY (`rating_id`);

--
-- Indexes for table `vendor_sub_type`
--
ALTER TABLE `vendor_sub_type`
  ADD PRIMARY KEY (`subtype_id`);

--
-- Indexes for table `vendor_types`
--
ALTER TABLE `vendor_types`
  ADD PRIMARY KEY (`type_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `vendors_ratings`
--
ALTER TABLE `vendors_ratings`
  MODIFY `rating_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `vendor_sub_type`
--
ALTER TABLE `vendor_sub_type`
  MODIFY `subtype_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `vendor_types`
--
ALTER TABLE `vendor_types`
  MODIFY `type_id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
