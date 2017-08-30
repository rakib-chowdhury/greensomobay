-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2017 at 03:25 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `green`
--

-- --------------------------------------------------------

--
-- Table structure for table `account_group`
--

CREATE TABLE `account_group` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=active 0=blocked',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `account_group`
--

INSERT INTO `account_group` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Asset', 1, NULL, '2017-04-11 06:11:13'),
(2, 'Liability', 1, NULL, '2017-04-11 06:11:13'),
(3, 'Owners Equity', 1, NULL, '2017-04-11 06:11:13'),
(4, 'Income', 1, NULL, '2017-04-11 06:11:13'),
(5, 'Expense', 1, NULL, '2017-04-11 06:11:13');

-- --------------------------------------------------------

--
-- Table structure for table `admission_share`
--

CREATE TABLE `admission_share` (
  `id` int(11) NOT NULL,
  `type` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=admission 2=share',
  `price` double NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=active 0=blocked',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admission_share`
--

INSERT INTO `admission_share` (`id`, `type`, `price`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 20, 1, NULL, '2017-04-13 09:23:57'),
(2, 1, 50, 1, NULL, '2017-04-13 09:24:04');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `attendance_date` date NOT NULL,
  `is_attend` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=absent 1=present 2=leave',
  `emp_id` int(11) NOT NULL,
  `added_by` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=checked 0=unchecked',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blood_group`
--

CREATE TABLE `blood_group` (
  `id` int(11) NOT NULL,
  `blood_grp_name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `blood_grp_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=active 0=blocked'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `blood_group`
--

INSERT INTO `blood_group` (`id`, `blood_grp_name`, `blood_grp_status`) VALUES
(1, '''ও'' পজেটিভ (O +ve)', 1),
(2, '''এ'' পজেটিভ (A +ve)', 1),
(3, '''বি'' পজেটিভ (B +ve)', 1),
(4, '''এবি'' পজেটিভ (AB +ve)', 1),
(5, '''ও'' নেগেটিভ (O -ve)', 1),
(6, '''এ'' নেগেটিভ (A -ve) ', 1),
(7, '''বি'' নেগেটিভ (B -ve) ', 1),
(8, '''এবি'' নেগেটিভ (AB -ve)', 1);

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `division_id` int(10) UNSIGNED NOT NULL,
  `district_id` int(10) UNSIGNED NOT NULL,
  `subDistrict_id` int(10) UNSIGNED NOT NULL,
  `specified_location` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=active 0=blocked',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `name`, `division_id`, `district_id`, `subDistrict_id`, `specified_location`, `status`, `created_at`, `updated_at`) VALUES
(1, 'পঞ্চগড়', 7, 59, 450, 'পঞ্চগড় শাখা', 1, '2017-03-15 04:33:29', '2017-03-19 23:17:30'),
(3, 'আটোয়ারী', 7, 59, 447, 'আটোয়ারী শাখা', 1, '2017-03-19 23:18:54', '2017-03-19 23:18:54'),
(4, 'ds', 7, 59, 447, 'sdgs', 1, '2017-03-26 18:00:00', '2017-03-27 02:12:43');

-- --------------------------------------------------------

--
-- Table structure for table `company_account`
--

CREATE TABLE `company_account` (
  `id` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `debit` double NOT NULL,
  `credit` double NOT NULL,
  `group_id` int(11) NOT NULL,
  `account_group_id` int(11) NOT NULL,
  `sub_account_group_id` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=checked',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `company_account`
--

INSERT INTO `company_account` (`id`, `transaction_id`, `description`, `debit`, `credit`, `group_id`, `account_group_id`, `sub_account_group_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'member 1 এর ভর্তি ফি - ৫০ টাকা ', 50, 0, 1, 1, 0, 1, '2017-04-16 18:00:00', '2017-04-17 05:34:28'),
(2, 2, 'member 1 এর 10 টি শেয়ার এর শেয়ার মূল্য - ২০০ টাকা ', 200, 0, 2, 2, 0, 1, '2017-04-16 18:00:00', '2017-04-17 05:34:28'),
(3, 3, 'member 1 এর বাজার সঞ্চয় - ১০ টাকা ', 10, 0, 6, 0, 0, 1, '2017-04-16 18:00:00', '2017-04-17 06:27:33'),
(4, 4, 'member 1 এর 10 টি শেয়ার এর শেয়ার মূল্য - ২০০ টাকা ', 200, 0, 2, 2, 0, 1, '2017-04-16 18:00:00', '2017-04-17 06:58:35'),
(5, 5, 'member 1 এর 1 টি শেয়ার এর শেয়ার মূল্য - ২০ টাকা ', 20, 0, 2, 2, 0, 1, '2017-04-16 18:00:00', '2017-04-17 06:59:48'),
(6, 6, 'member 1 এর 1 টি শেয়ার ফেরত , শেয়ার মূল্য - ২০ টাকা ', 0, 20, 2, 2, 0, 1, '2017-04-16 18:00:00', '2017-04-17 07:14:22'),
(7, 7, 'ভ্রমণ খরচ বাবদ ব্যয় - ২০০ টাকা ', 0, 200, 0, 1, 24, 1, '2017-04-17 18:00:00', '2017-04-18 02:58:54'),
(8, 8, 'অফিস ভাড়া বাবদ ব্যয় - ৫০০০ টাকা ', 0, 5000, 0, 1, 24, 1, '2017-04-17 18:00:00', '2017-04-18 03:00:40'),
(9, 9, 'জ্বালানি খরচ বাবদ ব্যয় - ২০০ টাকা ', 0, 200, 0, 1, 24, 1, '2017-04-17 18:00:00', '2017-04-18 03:00:40'),
(10, 10, 'বিদ্যুৎ বিল বাবদ ব্যয় - ৫০০০ টাকা ', 0, 5000, 0, 1, 24, 1, '2017-04-17 18:00:00', '2017-04-18 03:00:40'),
(11, 11, 'অফিস স্টেশনারী বাবদ ব্যয় - ৫০০ টাকা ', 0, 500, 0, 1, 24, 1, '2017-04-17 18:00:00', '2017-04-18 03:06:14'),
(12, 12, 'প্রিন্টিং স্টেশনারী বাবদ ব্যয় - ৫০০ টাকা ', 0, 500, 0, 1, 24, 1, '2017-04-17 18:00:00', '2017-04-18 03:06:14'),
(13, 13, 'খবরের কাগজ বিক্রয় বাবদ আয় - ৫০০ টাকা ', 500, 0, 0, 1, 24, 1, '2017-04-17 18:00:00', '2017-04-18 03:24:44'),
(14, 14, 'member 1 এর ঋণ আদায় - ৫০ টাকা ', 50, 0, 0, 0, 0, 1, '2017-04-17 18:00:00', '2017-04-18 04:53:30'),
(15, 15, 'member 1 এর সার্ভিস চার্জ আদায় - ৫ টাকা ', 5, 0, 0, 0, 0, 1, '2017-04-17 18:00:00', '2017-04-18 04:53:30'),
(16, 16, 'member 1 এর ঋণ বীমা আদায় - ৫০ টাকা ', 50, 0, 0, 0, 0, 1, '2017-04-17 18:00:00', '2017-04-18 04:53:30'),
(17, 18, 'branch head এর 2017-04 মাসের অগ্রিম বেতন  - 210 টাকা ', 0, 210, 8, 5, 1, 1, '2017-04-18 18:00:00', '2017-04-19 05:00:28'),
(18, 19, 'atoyari field worker এর 2017-03 মাসের অগ্রিম বেতন  - 500 টাকা ', 0, 500, 8, 5, 1, 1, '2017-04-18 18:00:00', '2017-04-19 05:52:16'),
(19, 20, 'field worker 33 এর 2017-05 মাসের অগ্রিম বেতন  - 5000 টাকা ', 0, 5000, 8, 5, 1, 1, '2017-04-18 18:00:00', '2017-04-19 06:11:55'),
(20, 21, 'branch head এর 2017-04 মাসের অগ্রিম বেতন  - 2000 টাকা ', 0, 2000, 8, 5, 1, 1, '2017-04-18 18:00:00', '2017-04-19 06:20:51'),
(21, 22, 'member 1 এর বাজার সঞ্চয় - ৫০০ টাকা ', 500, 0, 6, 0, 0, 1, '2017-04-24 18:00:00', '2017-04-24 23:06:26'),
(22, 23, 'member 1 এর ঋণ আদায় - ১০০ টাকা ', 100, 0, 0, 0, 0, 1, '2017-04-24 18:00:00', '2017-04-24 23:10:41'),
(23, 24, 'member 1 এর সার্ভিস চার্জ আদায় - ৫০ টাকা ', 50, 0, 0, 0, 0, 1, '2017-04-24 18:00:00', '2017-04-24 23:10:41'),
(24, 25, 'member 1 এর ঋণ বীমা আদায় - ২০ টাকা ', 20, 0, 0, 0, 0, 1, '2017-04-24 18:00:00', '2017-04-24 23:10:41'),
(25, 26, 'member 1 এর বাজার সঞ্চয় - ৫০০ টাকা ', 500, 0, 6, 0, 0, 1, '2017-04-25 18:00:00', '2017-04-26 03:11:14'),
(26, 27, 'member 2 এর ভর্তি ফি - ৫০ টাকা ', 50, 0, 1, 1, 0, 1, '2017-04-25 18:00:00', '2017-04-26 05:11:02'),
(27, 28, 'member 2 এর 15 টি শেয়ার এর শেয়ার মূল্য - ৩০০ টাকা ', 300, 0, 2, 2, 0, 1, '2017-04-25 18:00:00', '2017-04-26 05:11:02'),
(28, 29, 'member 2 এর বাজার সঞ্চয় - ১০০ টাকা ', 100, 0, 6, 0, 0, 1, '2017-04-25 18:00:00', '2017-04-26 05:11:51');

-- --------------------------------------------------------

--
-- Table structure for table `company_info`
--

CREATE TABLE `company_info` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `logo` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `favcon` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tnt` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mobile` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `website` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `company_info`
--

INSERT INTO `company_info` (`id`, `name`, `logo`, `favcon`, `address`, `tnt`, `mobile`, `email`, `website`, `created_at`, `updated_at`) VALUES
(1, 'গ্রীন মাল্টিপারপাস কো-অপারেটিভ', 'logo.png', '', 'পঞ্চগড় সদর , রংপুর', NULL, '01839989802', 'gm.green@gmail.com', 'greensomobaybazar.com', NULL, '2017-04-02 03:47:20');

-- --------------------------------------------------------

--
-- Table structure for table `designation`
--

CREATE TABLE `designation` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `priority` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=active 0=blocked',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `designation`
--

INSERT INTO `designation` (`id`, `name`, `priority`, `status`, `created_at`, `updated_at`) VALUES
(1, 'md', 1, 1, '2017-03-20 06:57:15', '0000-00-00 00:00:00'),
(2, 'branch manager', 2, 1, '2017-03-20 06:57:15', '0000-00-00 00:00:00'),
(3, 'accountant', 3, 1, '2017-03-20 06:57:44', '0000-00-00 00:00:00'),
(4, 'field worker', 4, 1, '2017-03-20 06:57:44', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `district`
--

CREATE TABLE `district` (
  `id` int(10) NOT NULL,
  `bn_name` varchar(255) NOT NULL,
  `en_name` varchar(255) NOT NULL,
  `division_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `district`
--

INSERT INTO `district` (`id`, `bn_name`, `en_name`, `division_id`) VALUES
(1, 'নরসিংদী', 'narsingdi', 1),
(4, 'গাজীপুর', 'gazipur', 1),
(5, 'শরীয়তপুর', 'shariatpur', 1),
(6, 'নারায়ণগঞ্জ', 'narayangong', 1),
(7, 'শেরপুর', 'sherpur', 8),
(8, 'টাঙ্গাইল', 'tangail', 1),
(9, 'ময়মনসিংহ', 'maymansingh', 8),
(10, 'কিশোরগঞ্জ', 'kisoregong', 1),
(11, 'জামালপুর', 'jamalpur', 8),
(12, 'মানিকগঞ্জ', 'manikgong', 1),
(13, 'নেত্রকোণা', 'netrokona', 8),
(14, 'ঢাকা', 'dhaka', 1),
(15, 'মুন্সিগঞ্জ', 'munshigong', 1),
(16, 'রাজবাড়ী', 'rajbari', 1),
(17, 'মাদারীপুর', 'madaripur', 1),
(18, 'গোপালগঞ্জ', 'gopalgonj', 1),
(19, 'ফরিদপুর', 'faridpur', 1),
(20, 'যশোর', 'jessore', 2),
(21, 'সাতক্ষীরা', 'satkhira', 2),
(22, 'মেহেরপুর', 'meherpur', 2),
(23, 'নড়াইল', 'narail', 2),
(24, 'চুয়াডাঙ্গা', 'chuadanga', 2),
(25, 'কুষ্টিয়া', 'kushtia', 2),
(26, 'মাগুরা', 'magura', 2),
(27, 'খুলনা', 'khulna', 2),
(28, 'বাগেরহাট', 'bagerhat', 2),
(29, 'ঝিনাইদাহ', 'jhinadha', 2),
(30, 'কুমিল্লা', 'comilla', 3),
(31, 'ফেনী', 'feni', 3),
(32, 'ব্রাহ্মণবাড়িয়া', 'brahmanbaria', 3),
(33, 'রাঙ্গামাটি', 'rangamati', 3),
(34, 'নোয়াখালী', 'noakhali', 3),
(35, 'চাঁদপুর', 'chadpur', 3),
(36, 'লক্ষ্মীপুর', 'lakhipur', 3),
(37, 'চট্টগ্রাম', 'chittagong', 3),
(38, 'কক্সবাজার', 'coxsbaxar', 3),
(39, 'খাগড়াছড়ি', 'khagrachari', 3),
(40, 'বান্দরবান', 'bandarban', 3),
(41, 'সিরাজগঞ্জ', 'sirajganj', 4),
(42, 'পাবনা', 'pabol', 4),
(43, 'বগুড়া', 'bagura', 4),
(44, 'রাজশাহী', 'rajshahi', 4),
(45, 'নাটোর', 'nattore', 4),
(46, 'জয়পুরহাট', 'joypurhat', 4),
(47, 'চাঁপাইনবাবগঞ্জ', 'chapainawabganj', 4),
(48, 'নওগাঁ', 'naoga', 4),
(49, 'ঝালকাঠি', 'bagura', 5),
(50, 'পটুয়াখালী', 'rajshahi', 5),
(51, 'পিরোজপুর', 'nattore', 5),
(52, 'বরিশাল', 'joypurhat', 5),
(53, 'ভোলা', 'chapainawabganj', 5),
(54, 'বরগুনা', 'naoga', 5),
(55, 'সিলেট', 'shylet', 6),
(56, 'মৌলভীবাজার', 'moulvibazar', 6),
(57, 'হবিগঞ্জ', 'hobigonj', 6),
(58, 'সুনামগঞ্জ', 'sunamganj', 6),
(59, 'পঞ্চগড়', 'ponchogor', 7),
(60, 'দিনাজপুর', 'dinajpur', 7),
(61, 'লালমনিরহাট', 'lalmonirhat', 7),
(62, 'নীলফামারী', 'nilphamari', 7),
(63, 'গাইবান্ধা', 'gaibandha', 7),
(64, 'ঠাকুরগাঁও', 'thakurgaon', 7),
(65, 'রংপুর', 'rangpur', 7),
(66, 'কুড়িগ্রাম', 'kurigram', 7);

-- --------------------------------------------------------

--
-- Table structure for table `division`
--

CREATE TABLE `division` (
  `id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `en_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `division`
--

INSERT INTO `division` (`id`, `name`, `en_name`) VALUES
(1, 'ঢাকা', 'dhaka'),
(2, 'খুলনা', 'khulna'),
(3, 'চট্টগ্রাম', 'chittagong'),
(4, 'রাজশাহী', 'rajshahi'),
(5, 'বরিশাল', 'barisal'),
(6, 'সিলেট', 'shylet'),
(7, 'রংপুর', 'rangpur'),
(8, 'ময়মনসিংহ', 'mymensingh');

-- --------------------------------------------------------

--
-- Table structure for table `education`
--

CREATE TABLE `education` (
  `id` int(10) NOT NULL,
  `edu_name` varchar(255) NOT NULL,
  `edu_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=active 0=blocked'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `education`
--

INSERT INTO `education` (`id`, `edu_name`, `edu_status`) VALUES
(1, 'এস.এস.সি', 1),
(2, 'এইচ.এস.সি ', 1),
(3, 'বি.এ (অনার্স)', 1),
(4, 'এম. এ ', 1),
(5, 'বি.বি.এস', 1),
(6, 'বিএসএস (অনার্স)', 1),
(7, 'এমএসসি', 1),
(8, 'এল এল বি', 1),
(9, 'এল এল এম', 1),
(10, 'স্নাতক (বাণিজ্য)', 1),
(11, '৯ম শ্রেনী', 1),
(12, '৮ম শ্রেনী', 1),
(13, 'দাখিল', 1),
(14, 'আলিম', 1),
(15, 'ফাযিল', 1),
(16, 'কামিল', 1),
(17, 'বি. কম', 1),
(18, 'এম, বি, এস', 1),
(19, 'বি এসসি', 1),
(20, 'বি,এস, সি ', 1),
(21, 'বি, এড', 1),
(22, 'এম, এড ', 1),
(24, 'ডিগ্রি', 1),
(25, 'এম.কম', 1),
(26, '১০ শ্রেনি', 1),
(27, '  বি এস সি,', 1),
(28, 'বি. এস এস ', 1),
(29, 'এম. এস. এস ', 1),
(30, 'এম বি এ ', 1),
(31, 'বিএসএস(সম্মান)', 1),
(32, 'বি বি এ', 1),
(33, 'শিক্ষাগত যোগ্যতা নাই ', 1),
(34, 'অন্যান্য', 1);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(11) NOT NULL,
  `id_card_no` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nid` varchar(17) COLLATE utf8_unicode_ci NOT NULL,
  `mobile` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `basic_salary` double NOT NULL,
  `pic` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `branch_id` int(11) NOT NULL,
  `designation_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=active 2=retired 3=blocked 4=deleted',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `id_card_no`, `name`, `nid`, `mobile`, `basic_salary`, `pic`, `branch_id`, `designation_id`, `role_id`, `status`, `created_at`, `updated_at`) VALUES
(1, '000001\n', 'branch head', '45454554545454545', '01222222222', 20000, 'no_img.png', 3, 2, 2, 1, '2017-03-27 02:18:23', '2017-04-17 04:57:46'),
(2, '000002\n', 'ponchogor branch head', '98999898989898989', '01333333333', 30000, 'employee_2.jpg', 1, 2, 2, 1, '2017-03-27 02:40:22', '2017-04-26 05:10:42'),
(3, '000003', 'admin', '12354678945465465', '01111111111', 50000, 'no_img.png', 1, 1, 1, 1, NULL, '2017-04-17 04:53:13'),
(4, '000004\n', 'atoyari field worker', '52525252345235423', '01444444444', 10000, 'no_img.png', 3, 4, 4, 1, '2017-03-28 03:23:50', '2017-04-17 04:53:04'),
(5, '000005\n', 'field worker 33', '55656565656656565', '01555555555', 10000, 'employee_5.jpeg', 1, 4, 4, 1, '2017-04-17 05:00:32', '2017-04-26 05:08:59');

-- --------------------------------------------------------

--
-- Table structure for table `employee_account`
--

CREATE TABLE `employee_account` (
  `id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `debit` double NOT NULL,
  `credit` double NOT NULL,
  `group_id` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=checked',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `employee_account`
--

INSERT INTO `employee_account` (`id`, `emp_id`, `description`, `debit`, `credit`, `group_id`, `transaction_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'branch head এর 2017-04 মাসের অগ্রিম বেতন  - 210 টাকা ', 210, 0, 8, 18, 1, '2017-04-18 18:00:00', '2017-04-19 05:00:28'),
(2, 4, 'atoyari field worker এর 2017-03 মাসের অগ্রিম বেতন  - 500 টাকা ', 500, 0, 8, 19, 1, '2017-04-18 18:00:00', '2017-04-19 05:52:16'),
(3, 5, 'field worker 33 এর 2017-05 মাসের অগ্রিম বেতন  - 5000 টাকা ', 5000, 0, 8, 20, 1, '2017-04-18 18:00:00', '2017-04-19 06:11:55'),
(4, 1, 'branch head এর 2017-04 মাসের অগ্রিম বেতন  - 2000 টাকা ', 2000, 0, 8, 21, 1, '2017-04-18 18:00:00', '2017-04-19 06:20:51');

-- --------------------------------------------------------

--
-- Table structure for table `employee_details`
--

CREATE TABLE `employee_details` (
  `id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `maritial_status` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `blood_group_id` int(11) NOT NULL,
  `nationality` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `religion` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `father_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mother_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `present_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `permanent_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `education_id` int(11) NOT NULL,
  `join_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `employee_details`
--

INSERT INTO `employee_details` (`id`, `emp_id`, `dob`, `gender`, `maritial_status`, `blood_group_id`, `nationality`, `religion`, `father_name`, `mother_name`, `present_address`, `permanent_address`, `education_id`, `join_date`, `created_at`, `updated_at`) VALUES
(1, 1, '2017-04-29', 'মহিলা', 'বিবাহিত', 1, 'bangladeshi', 'মুসলিম', NULL, NULL, 'dfg', 'dfg', 1, '2017-03-27', '2017-03-27 02:18:23', '2017-04-17 04:57:46'),
(2, 2, '2017-04-18', 'পুরুষ', 'বিবাহিত', 0, NULL, 'মুসলিম', NULL, NULL, 'sd', 'sd', 1, '2017-03-27', '2017-03-27 02:40:22', '2017-04-26 05:10:42'),
(3, 3, '2017-03-08', 'পুরুষ', 'বিবাহিত', 0, 'ghjk', 'মুসলিম', NULL, NULL, 'kjl', 'hgj', 2, '0000-00-00', NULL, '2017-04-17 04:53:13'),
(4, 4, '2017-03-01', 'পুরুষ', 'বিবাহিত', 0, 'dfg', 'মুসলিম', 'fg', 'dfg', 'fdg', 'dfg', 3, '2017-03-28', '2017-03-28 03:23:50', '2017-04-17 04:53:04'),
(5, 5, '1990-04-01', 'পুরুষ', 'অবিবাহিত', 2, 'bangladeshi', 'মুসলিম', NULL, NULL, 'gdfg dfgd gdfg', 'dfg df dfgdfgd', 5, '2017-04-17', '2017-04-17 05:00:32', '2017-04-26 05:08:59');

-- --------------------------------------------------------

--
-- Table structure for table `front_datas`
--

CREATE TABLE `front_datas` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pic` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `front_datas`
--

INSERT INTO `front_datas` (`id`, `type`, `pic`, `content`, `created_at`, `updated_at`) VALUES
(1, 'achievement', 'achievement_1.jpg', '<p><span style="color: rgb(98, 98, 98); font-family: SolaimanLipi, Raleway, &quot;Open Sans Condensed&quot;, sans-serif, Oswald, &quot;Open Sans&quot;, sans-serif; font-size: 13px; letter-spacing: 0.26px; text-align: justify;">ডিজিটাল বাংলা দেশ গড়ার লক্ষে তথ্যপ্রযুক্তি-ভিত্তিক সেবা প্রদান এমনভাবে প্রসার ঘটানো হচ্ছে , যাতে আগে যেসব সেবার জন্য নানা জায়গায় ছুটতে হতো তা না করে - ঘরে বসেই কম্পিউটারে এবং মোবাইল ফোনে তা পাওয়া যায়। এর লক্ষে অসংখ্য তথ্য উপাত্ত প্রিন্টেড ডকুমেন্ট হিসেবে সংরক্ষণ করা হচ্ছে কিন্তু সেগুলো সাজানো এবং বাছাই করা খুবই কষ্ট সাধ্য ব্যাপার। এর ফলে সব চেয়ে বেশি প্রভাবিত হচ্ছে ভূমি ও আইন সংক্রান্ত বিভাগ সমূহ। কারন এই বিভাগ গুলো তেই পুরনো দলিল পত্র বার বার খুজে বের করতে হয়। তার উপর হাতে লিখা অথবা প্রিন্টেড আকারে থাকা দলিল পত্রাদি সফট কপি তে রুপান্তর করাও অনিশ্চিত ও ঝুকি পূর্ণ।</span></p><p><span style="color: rgb(98, 98, 98); font-family: SolaimanLipi, Raleway, &quot;Open Sans Condensed&quot;, sans-serif, Oswald, &quot;Open Sans&quot;, sans-serif; font-size: 13px; letter-spacing: 0.26px; text-align: justify;">ডিজিটাল বাংলা দেশ গড়ার লক্ষে তথ্যপ্রযুক্তি-ভিত্তিক সেবা প্রদান এমনভাবে প্রসার ঘটানো হচ্ছে ,</span></p><ul><li><span style="color: rgb(98, 98, 98); font-family: SolaimanLipi, Raleway, &quot;Open Sans Condensed&quot;, sans-serif, Oswald, &quot;Open Sans&quot;, sans-serif; font-size: 13px; letter-spacing: 0.26px; text-align: justify;">যাতে আগে যেসব সেবার জন্য নানা জায়গায় ছুটতে হতো তা না করে - ঘরে বসেই কম্পিউটারে এবং</span></li><li><span style="color: rgb(98, 98, 98); font-family: SolaimanLipi, Raleway, &quot;Open Sans Condensed&quot;, sans-serif, Oswald, &quot;Open Sans&quot;, sans-serif; font-size: 13px; letter-spacing: 0.26px; text-align: justify;"> মোবাইল ফোনে তা পাওয়া যায়। এর লক্ষে অসংখ্য তথ্য উপাত্ত প্রিন্টেড ডকুমেন্ট হিসেবে সংরক্ষণ করা হ</span></li><li><span style="color: rgb(98, 98, 98); font-family: SolaimanLipi, Raleway, &quot;Open Sans Condensed&quot;, sans-serif, Oswald, &quot;Open Sans&quot;, sans-serif; font-size: 13px; letter-spacing: 0.26px; text-align: justify;">চ্ছে কিন্তু সেগুলো সাজানো এবং বাছাই করা খুবই কষ্ট সাধ্য ব্যাপার। এর ফলে সব চেয়ে বেশি প্রভাবিত হ</span></li><li><span style="color: rgb(98, 98, 98); font-family: SolaimanLipi, Raleway, &quot;Open Sans Condensed&quot;, sans-serif, Oswald, &quot;Open Sans&quot;, sans-serif; font-size: 13px; letter-spacing: 0.26px; text-align: justify;">চ্ছে ভূমি ও আইন সংক্রান্ত বিভাগ সমূহ। কারন এই বিভাগ গুলো তেই পুরনো দলিল পত্র বার বার খুজে বের ক</span></li><li><span style="color: rgb(98, 98, 98); font-family: SolaimanLipi, Raleway, &quot;Open Sans Condensed&quot;, sans-serif, Oswald, &quot;Open Sans&quot;, sans-serif; font-size: 13px; letter-spacing: 0.26px; text-align: justify;">রতে হয়। তার উপর হাতে লিখা অথবা প্রিন্টেড আকারে থাকা দলিল পত্রাদি সফট কপি তে রুপান্তর করাও অনিশ্চিত ও ঝুকি পূর্ণ।</span></li></ul><p><span style="color: rgb(98, 98, 98); font-family: SolaimanLipi, Raleway, &quot;Open Sans Condensed&quot;, sans-serif, Oswald, &quot;Open Sans&quot;, sans-serif; font-size: 13px; letter-spacing: 0.26px; text-align: justify;">ডিজিটাল বাংলা দেশ গড়ার লক্ষে তথ্যপ্রযুক্তি-ভিত্তিক সেবা প্রদান এমনভাবে প্রসার ঘটানো হচ্ছে , যাতে আগে যেসব সেবার জন্য নানা জায়গায় ছুটতে হতো তা না করে - ঘরে বসেই কম্পিউটারে এবং মোবাইল ফোনে তা পাওয়া যায়। এর লক্ষে অসংখ্য তথ্য উপাত্ত প্রিন্টেড ডকুমেন্ট হিসেবে সংরক্ষণ করা হচ্ছে কিন্তু সেগুলো সাজানো এবং বাছাই করা খুবই কষ্ট সাধ্য ব্যাপার। এর ফলে সব চেয়ে বেশি প্রভাবিত হচ্ছে ভূমি ও আইন সংক্রান্ত বিভাগ সমূহ। কারন এই</span></p><p><span style="color: rgb(98, 98, 98); font-family: SolaimanLipi, Raleway, &quot;Open Sans Condensed&quot;, sans-serif, Oswald, &quot;Open Sans&quot;, sans-serif; font-size: 13px; letter-spacing: 0.26px; text-align: justify;"><br></span></p><p><span style="color: rgb(98, 98, 98); font-family: SolaimanLipi, Raleway, &quot;Open Sans Condensed&quot;, sans-serif, Oswald, &quot;Open Sans&quot;, sans-serif; font-size: 13px; letter-spacing: 0.26px; text-align: justify;"> বিভাগ গুলো তেই পুরনো দলিল পত্র বার বার খুজে বের করতে হয়। তার উপর হাতে লিখা অথবা প্রিন্টেড আকারে থাকা দলিল পত্রাদি সফট কপি তে রুপান্তর করাও অনিশ্চিত ও ঝুকি পূর্ণ।</span><span style="color: rgb(98, 98, 98); font-family: SolaimanLipi, Raleway, &quot;Open Sans Condensed&quot;, sans-serif, Oswald, &quot;Open Sans&quot;, sans-serif; font-size: 13px; letter-spacing: 0.26px; text-align: justify;"><br></span><span style="color: rgb(98, 98, 98); font-family: SolaimanLipi, Raleway, &quot;Open Sans Condensed&quot;, sans-serif, Oswald, &quot;Open Sans&quot;, sans-serif; font-size: 13px; letter-spacing: 0.26px; text-align: justify;"><br></span></p><p><span style="color: rgb(98, 98, 98); font-family: SolaimanLipi, Raleway, &quot;Open Sans Condensed&quot;, sans-serif, Oswald, &quot;Open Sans&quot;, sans-serif; font-size: 13px; letter-spacing: 0.26px; text-align: justify;"><br></span><br></p>', '2017-03-29 18:00:00', '2017-03-30 03:30:37'),
(2, 'current_work', 'current_work_2.jpg', '<p><span style="color: rgb(98, 98, 98); font-family: SolaimanLipi, Raleway, &quot;Open Sans Condensed&quot;, sans-serif, Oswald, &quot;Open Sans&quot;, sans-serif; font-size: 13px; letter-spacing: 0.26px; text-align: justify;">এ টু আই এর সার্ভিস ইনোভেশন ফান্ড এবং ইউনাইটেড ইন্টারন্যাশনাল ইউনিভারসিটি এর যৌথ উদ্যোগে বাংলা অপটিক্যাল চিহ্ন সনাক্তকারী নামে একটি সফটওয়্যার তৈরি করছে যেটা স্ক্যান্ড কাগজ বা দলিল সমূহ কে সম্পাদন করা যায় এমন ওয়ার্ড ফাইল এ রুপান্তর করে দিবে। যেটাকে আবার তার জন্য নির্ধারিত বিভাগের ডাটাবেস এ সংযুক্ত করা যাবে। ফলে পুরানো দলিল পত্র সহজেই খুজে পাওয়া যাবে এবং যারা সেবা দিবে ও সেবা নিবে উভয় ই উপকৃত হবে</span></p><p><span style="color: rgb(98, 98, 98); font-family: SolaimanLipi, Raleway, &quot;Open Sans Condensed&quot;, sans-serif, Oswald, &quot;Open Sans&quot;, sans-serif; font-size: 13px; letter-spacing: 0.26px; text-align: justify;">এ টু আই এর সার্ভিস ইনোভেশন ফান্ড এবং ইউনাইটেড ইন্টারন্যাশনাল ইউনিভারসিটি এর যৌথ উদ্যোগে বাংলা অপটিক্যাল চিহ্ন সনাক্তকারী নামে একটি সফটওয়্যার তৈরি করছে যেটা স্ক্যান্ড কাগজ বা দলিল সমূহ কে সম্পাদন করা যায় এমন ওয়ার্ড ফাইল এ রুপান্তর করে দিবে। যেটাকে আবার তার জন্য নির্ধারিত বিভাগের ডাটাবেস এ সংযুক্ত করা যাবে। ফলে পুরানো দলিল পত্র সহজেই খুজে পাওয়া যাবে এবং যারা সেবা দিবে ও সেবা নিবে উভয় ই উপকৃত হবে</span></p><p><span style="color: rgb(98, 98, 98); font-family: SolaimanLipi, Raleway, &quot;Open Sans Condensed&quot;, sans-serif, Oswald, &quot;Open Sans&quot;, sans-serif; font-size: 13px; letter-spacing: 0.26px; text-align: justify;"><br></span><br></p><p><br></p>', '2017-03-29 18:00:00', '2017-03-30 03:31:29'),
(3, 'rules', 'rules_3.jpg', '<p><span style="color: rgb(98, 98, 98); font-family: SolaimanLipi, Raleway, &quot;Open Sans Condensed&quot;, sans-serif, Oswald, &quot;Open Sans&quot;, sans-serif; font-size: 13px; letter-spacing: 0.26px; text-align: justify;">ব্যবসা পরিচালনার ক্ষেত্রে পরিবেশ অধিদপ্তরের ছাড়পত্র গুরুত্বপূর্ণ ভূমিকা পালন করে। ক্ষুদ্র, মাঝারি কিংবা বৃহৎ নির্বিশেষে সকল ধরনের ব্যবসা সুচারু ভাবে পরিচালনার ক্ষেত্রে পরিবেশ অধিদপ্তরের ছাড়পত্র অত্যাবশ্যক।কিন্তু পরিবেশ অধিদপ্তরের ছাড়পত্র পেতে বিভিন্ন ভোগান্তির শিকার হতে হয়।পরিবেশ রক্ষায় এই ছাড়পত্র বিশেষ ভূমিকা পালন করলেও পদ্ধতিগত জটিলতার কারণে জনগণ এ সেবা পেতে নানা অসুবিধার সম্মূখীন হয়ে থা</span></p><p><span style="color: rgb(98, 98, 98); font-family: SolaimanLipi, Raleway, &quot;Open Sans Condensed&quot;, sans-serif, Oswald, &quot;Open Sans&quot;, sans-serif; font-size: 13px; letter-spacing: 0.26px; text-align: justify;"><br></span></p><hr><p><span style="color: rgb(98, 98, 98); font-family: SolaimanLipi, Raleway, &quot;Open Sans Condensed&quot;, sans-serif, Oswald, &quot;Open Sans&quot;, sans-serif; font-size: 13px; letter-spacing: 0.26px; text-align: justify;">ব্যবসা পরিচালনার ক্ষেত্রে পরিবেশ অধিদপ্তরের ছাড়পত্র গুরুত্বপূর্ণ ভূমিকা পালন করে। ক্ষুদ্র, মাঝারি কিংবা বৃহৎ নির্বিশেষে সকল ধরনের ব্যবসা সুচারু ভাবে পরিচালনার ক্ষেত্রে পরিবেশ অধিদপ্তরের ছাড়পত্র অত্যাবশ্যক।কিন্তু পরিবেশ অধিদপ্তরের ছাড়পত্র পেতে বিভিন্ন ভোগান্তির শিকার হতে হয়।পরিবেশ রক্ষায় এই ছাড়পত্র বিশেষ ভূমিকা পালন করলেও পদ্ধতিগত জটিলতার কারণে জনগণ এ সেবা পেতে নানা অসুবিধার সম্মূখীন হয়ে থা</span><span style="color: rgb(98, 98, 98); font-family: SolaimanLipi, Raleway, &quot;Open Sans Condensed&quot;, sans-serif, Oswald, &quot;Open Sans&quot;, sans-serif; font-size: 13px; letter-spacing: 0.26px; text-align: justify;"><br></span><br></p>', '2017-03-29 18:00:00', '2017-03-30 03:32:04'),
(4, 'about_us', 'about_us_4.jpg', '<p><span style="color: rgb(98, 98, 98); font-family: SolaimanLipi, Raleway, "Open Sans Condensed", sans-serif, Oswald, "Open Sans", sans-serif; font-size: 13px; letter-spacing: 0.26px; text-align: justify;">অসহায় ও নিরুপায় মানুষের দু সময় এ তাদের কে সেবা দেওয়াই বীমা সেবা সংস্থা সমুহের প্রধান দায়িত্ব কিন্তু কিছু অসৎ ও প্রতারনা পূর্ণ মানুষের জন্য যারা আসলেই সেবা পাবার দাবীদার তারাই বঞ্চিত হচ্ছে। জীবন বীমা কর্পোরেশন এর অনেক খরিদ্দার যেমন প্রতারনার শিকার হচ্ছেন তেমনি আবার অনেক আবেদনকারী ও প্রতারক। অনেক অসৎ লোক ই তাদের স্বাক্ষর জাল করে এমন কি মৃত্যুর প্রমানপত্র জাল করেও টাকা দাবি করে </span></p><p><span style="color: rgb(98, 98, 98); font-family: SolaimanLipi, Raleway, "Open Sans Condensed", sans-serif, Oswald, "Open Sans", sans-serif; font-size: 13px; letter-spacing: 0.26px; text-align: justify;">অসহায় ও নিরুপায় মানুষের দু সময় এ তাদের কে সেবা দেওয়াই বীমা সেবা সংস্থা সমুহের প্রধান দায়িত্ব কিন্তু কিছু অসৎ ও প্রতারনা পূর্ণ মানুষের জন্য যারা আসলেই সেবা পাবার দাবীদার তারাই বঞ্চিত হচ্ছে। জীবন বীমা কর্পোরেশন এর অনেক খরিদ্দার যেমন প্রতারনার শিকার হচ্ছেন তেমনি আবার অনেক আবেদনকারী ও প্রতারক। অনেক অসৎ লোক ই তাদের স্বাক্ষর জাল করে এমন কি মৃত্যুর প্রমানপত্র জাল করেও টাকা দাবি করে </span></p><hr><p><span style="color: rgb(98, 98, 98); font-family: SolaimanLipi, Raleway, "Open Sans Condensed", sans-serif, Oswald, "Open Sans", sans-serif; font-size: 13px; letter-spacing: 0.26px; text-align: justify;"><br></span></p><hr><p><span style="color: rgb(98, 98, 98); font-family: SolaimanLipi, Raleway, "Open Sans Condensed", sans-serif, Oswald, "Open Sans", sans-serif; font-size: 13px; letter-spacing: 0.26px; text-align: justify;"><br></span></p><hr><p><span style="color: rgb(98, 98, 98); font-family: SolaimanLipi, Raleway, "Open Sans Condensed", sans-serif, Oswald, "Open Sans", sans-serif; font-size: 13px; letter-spacing: 0.26px; text-align: justify;">অসহায় ও নিরুপায় মানুষের দু সময় এ তাদের কে সেবা দেওয়াই বীমা সেবা সংস্থা সমুহের প্রধান দায়িত্ব কিন্তু কিছু অসৎ ও প্রতারনা পূর্ণ মানুষের জন্য যারা আসলেই সেবা পাবার দাবীদার তারাই বঞ্চিত হচ্ছে। জীবন বীমা কর্পোরেশন এর অনেক খরিদ্দার যেমন প্রতারনার শিকার হচ্ছেন তেমনি আবার অনেক আবেদনকারী ও প্রতারক। অনেক অসৎ লোক ই তাদের স্বাক্ষর জাল করে এমন কি মৃত্যুর প্রমানপত্র জাল করেও টাকা দাবি করে </span><span style="color: rgb(98, 98, 98); font-family: SolaimanLipi, Raleway, "Open Sans Condensed", sans-serif, Oswald, "Open Sans", sans-serif; font-size: 13px; letter-spacing: 0.26px; text-align: justify;"><br></span><span style="color: rgb(98, 98, 98); font-family: SolaimanLipi, Raleway, "Open Sans Condensed", sans-serif, Oswald, "Open Sans", sans-serif; font-size: 13px; letter-spacing: 0.26px; text-align: justify;"><br></span><br></p>', '2017-03-29 18:00:00', '2017-03-30 03:37:46');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `details` text COLLATE utf8_unicode_ci,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=active 0=inactive',
  `added_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `name`, `details`, `status`, `added_by`, `created_at`, `updated_at`) VALUES
(5, 'gallery_5.jpg', NULL, 1, 3, '2017-04-01 18:00:00', '2017-04-02 03:30:15'),
(6, 'gallery_6.jpg', 'fgfdgdf hfdghdf fgffgh fg f fgh fg hfgh fg hf h fg h fg h fgh fg h fg hf h fg h fg h fg h fg h fg hfgh fgh fgh fg h fg h ghfgh fg h fg hfgh fg hfgh fg h f', 1, 3, '2017-04-01 18:00:00', '2017-04-02 03:30:41');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=active 0=blocked',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Admission Fee', 1, NULL, '2017-04-11 06:12:02'),
(2, 'Share', 1, NULL, '2017-04-11 06:13:43'),
(3, 'loan', 1, NULL, '2017-04-11 06:13:43'),
(4, 'service charge', 1, NULL, '2017-04-11 06:13:43'),
(5, 'insurance', 1, NULL, '2017-04-11 06:13:43'),
(6, 'deposit', 1, NULL, '2017-04-11 06:13:43'),
(7, 'interest', 1, NULL, '2017-04-11 06:13:54'),
(8, 'Salary', 1, NULL, '2017-04-19 10:37:06');

-- --------------------------------------------------------

--
-- Table structure for table `loan_request_list`
--

CREATE TABLE `loan_request_list` (
  `id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `grantor_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `grantor_sign` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `grantor_relation` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `loan_number` int(11) NOT NULL COMMENT 'loan received number',
  `loan_amount` double NOT NULL COMMENT 'loan amount',
  `loan_pay_condition` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `last_loan_pay_date` date NOT NULL,
  `last_month_deposit` double NOT NULL,
  `second_last_month_deposit` double NOT NULL,
  `third_last_month_deposit` double NOT NULL,
  `curr_deposit_amount` double NOT NULL,
  `partial_withdrawal_amount` double NOT NULL,
  `requested_amount` double NOT NULL,
  `laon_field` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `loan_duration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `witness_one_sign` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `witness_two_sign` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `witness_three_sign` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=waiting 1=approved by field worker 2=reject by field worker 3=approved by branch head 4=reject by branch head 5=approved by admin  6=reject by admin',
  `field_worker_checked_by` int(11) DEFAULT NULL,
  `field_worker_checed_date` date DEFAULT NULL,
  `field_worker_decision` int(11) DEFAULT NULL,
  `branch_head_checked_by` int(11) DEFAULT NULL,
  `branch_head_checked_date` date DEFAULT NULL,
  `branch_head_decision` int(11) DEFAULT NULL,
  `admin_checked_by` int(11) DEFAULT NULL,
  `admin_checked_date` date DEFAULT NULL,
  `admin_decision` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `loan_request_list`
--

INSERT INTO `loan_request_list` (`id`, `member_id`, `grantor_name`, `grantor_sign`, `grantor_relation`, `loan_number`, `loan_amount`, `loan_pay_condition`, `last_loan_pay_date`, `last_month_deposit`, `second_last_month_deposit`, `third_last_month_deposit`, `curr_deposit_amount`, `partial_withdrawal_amount`, `requested_amount`, `laon_field`, `loan_duration`, `witness_one_sign`, `witness_two_sign`, `witness_three_sign`, `status`, `field_worker_checked_by`, `field_worker_checed_date`, `field_worker_decision`, `branch_head_checked_by`, `branch_head_checked_date`, `branch_head_decision`, `admin_checked_by`, `admin_checked_date`, `admin_decision`, `created_at`, `updated_at`) VALUES
(1, 1, 'eretryt', 'guardian_sign_1.jpg', 'ryu', 1, 111, 'ভাল', '2017-04-21', 68, 57, 54, 50, 56, 67, '55', '466', 'witness1_sign_1.jpg', 'witness2_sign_1.jpg', 'witness3_sign_1.jpg', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-04-15 18:00:00', '2017-04-16 04:11:37'),
(2, 1, '345', 'guardian_sign_2.jpeg', '345', 4, 34, 'ভাল', '2017-04-12', 34, 345, 345, 50, 345, 345, '45', '435', 'witness1_sign_2.jpeg', 'witness2_sign_2.jpeg', 'witness3_sign_2.jpeg', 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-04-15 18:00:00', '2017-04-16 04:28:33'),
(3, 1, '567', 'guardian_sign_3.jpeg', '567', 67, 567, 'ভাল', '2017-04-06', 567, 567, 567, 50, 567, 67, '567', '567', 'witness1_sign_3.jpeg', 'witness2_sign_3.jpeg', 'witness3_sign_3.jpeg', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-04-16 18:00:00', '2017-04-17 02:41:04'),
(4, 1, '567', 'guardian_sign_4.jpeg', '567', 6, 6, 'ভাল', '2017-04-01', 56, 567, 567, 50, 567, 567, '67', '567', 'witness1_sign_4.jpeg', 'witness2_sign_4.jpeg', 'witness3_sign_4.jpeg', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-04-16 18:00:00', '2017-04-17 02:42:24');

-- --------------------------------------------------------

--
-- Table structure for table `meeting_notices`
--

CREATE TABLE `meeting_notices` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notice` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notice_file` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(10) UNSIGNED NOT NULL,
  `registration_no` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `branch_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nid` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pic` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `share_number` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '0=waiting 1=accept 2=reject 3=member remove 4=block 5=retired 6=waiting for assign to emp 7=waiting for admssn n share ',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `registration_no`, `branch_id`, `name`, `phone`, `nid`, `pic`, `share_number`, `status`, `created_at`, `updated_at`) VALUES
(1, '000001', 3, 'member 1', '99999999999', '99999999999999999', 'member_1.jpeg', -1, 1, '2017-04-16 18:00:00', '2017-04-26 12:57:01'),
(2, '000002', 1, 'member 2', '55555555555', '66666666666666666', 'member_2.jpg', 15, 1, '2017-04-25 18:00:00', '2017-04-26 12:57:04');

-- --------------------------------------------------------

--
-- Table structure for table `member_account`
--

CREATE TABLE `member_account` (
  `id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `debit` double NOT NULL,
  `credit` double NOT NULL,
  `group_id` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=checked',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `member_account`
--

INSERT INTO `member_account` (`id`, `member_id`, `description`, `debit`, `credit`, `group_id`, `transaction_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'member 1 এর ভর্তি ফি - ৫০ টাকা ', 50, 0, 1, 1, 1, '2017-04-16 18:00:00', '2017-04-17 05:34:28'),
(2, 1, 'member 1 এর 10 টি শেয়ার এর শেয়ার মূল্য - ২০০ টাকা ', 200, 0, 2, 2, 1, '2017-04-16 18:00:00', '2017-04-17 05:34:28'),
(3, 1, 'member 1 এর বাজার সঞ্চয় - ১০ টাকা ', 10, 0, 6, 3, 1, '2017-04-16 18:00:00', '2017-04-17 06:27:33'),
(4, 1, 'member 1 এর 10 টি শেয়ার এর শেয়ার মূল্য - ২০০ টাকা ', 200, 0, 2, 4, 1, '2017-04-16 18:00:00', '2017-04-17 06:58:35'),
(5, 1, 'member 1 এর 1 টি শেয়ার এর শেয়ার মূল্য - ২০ টাকা ', 20, 0, 2, 5, 1, '2017-04-16 18:00:00', '2017-04-17 06:59:48'),
(6, 1, 'member 1 এর 1 টি শেয়ার ফেরত , শেয়ার মূল্য - ২০ টাকা ', 0, 20, 2, 6, 1, '2017-04-16 18:00:00', '2017-04-17 07:14:22'),
(7, 1, 'member 1 এর ঋণ আদায় - ৫০ টাকা ', 50, 0, 0, 14, 1, '2017-04-17 18:00:00', '2017-04-18 04:53:30'),
(8, 1, 'member 1 এর সার্ভিস চার্জ আদায় - ৫ টাকা ', 5, 0, 0, 15, 1, '2017-04-17 18:00:00', '2017-04-18 04:53:30'),
(9, 1, 'member 1 এর ঋণ বীমা আদায় - ৫০ টাকা ', 50, 0, 0, 16, 1, '2017-04-17 18:00:00', '2017-04-18 04:53:30'),
(10, 1, 'member 1 এর বাজার সঞ্চয় - ৫০০ টাকা ', 500, 0, 6, 22, 1, '2017-04-24 18:00:00', '2017-04-24 23:06:26'),
(11, 1, 'member 1 এর ঋণ আদায় - ১০০ টাকা ', 100, 0, 0, 23, 1, '2017-04-24 18:00:00', '2017-04-24 23:10:41'),
(12, 1, 'member 1 এর সার্ভিস চার্জ আদায় - ৫০ টাকা ', 50, 0, 0, 24, 1, '2017-04-24 18:00:00', '2017-04-24 23:10:41'),
(13, 1, 'member 1 এর ঋণ বীমা আদায় - ২০ টাকা ', 20, 0, 0, 25, 1, '2017-04-24 18:00:00', '2017-04-24 23:10:41'),
(14, 1, 'member 1 এর বাজার সঞ্চয় - ৫০০ টাকা ', 500, 0, 6, 26, 1, '2017-04-25 18:00:00', '2017-04-26 03:11:14'),
(15, 2, 'member 2 এর ভর্তি ফি - ৫০ টাকা ', 50, 0, 1, 27, 1, '2017-04-25 18:00:00', '2017-04-26 05:11:02'),
(16, 2, 'member 2 এর 15 টি শেয়ার এর শেয়ার মূল্য - ৩০০ টাকা ', 300, 0, 2, 28, 1, '2017-04-25 18:00:00', '2017-04-26 05:11:02'),
(17, 2, 'member 2 এর বাজার সঞ্চয় - ১০০ টাকা ', 100, 0, 6, 29, 1, '2017-04-25 18:00:00', '2017-04-26 05:11:51');

-- --------------------------------------------------------

--
-- Table structure for table `member_details`
--

CREATE TABLE `member_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `members_id` int(10) UNSIGNED NOT NULL,
  `membership_granted_at` date DEFAULT NULL,
  `occupation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guardian_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guardian_occupation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mother_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mother_occupation` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `current_location` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `current_postoffice` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `current_upazila` int(11) NOT NULL,
  `current_district` int(11) NOT NULL,
  `current_division` int(11) NOT NULL,
  `permanent_location` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permanent_postoffice` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permanent_upazila` int(11) NOT NULL,
  `permanent_district` int(11) NOT NULL,
  `permanent_division` int(11) NOT NULL,
  `gender` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birth_date` date DEFAULT NULL,
  `nationality` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `religion` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `blood_group` int(20) NOT NULL,
  `education_qualification` int(11) NOT NULL,
  `marital_status` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nominee_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nominee_relation` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nominee_picture` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `member_sign` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no_img.png',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `member_details`
--

INSERT INTO `member_details` (`id`, `members_id`, `membership_granted_at`, `occupation`, `guardian_name`, `guardian_occupation`, `mother_name`, `mother_occupation`, `current_location`, `current_postoffice`, `current_upazila`, `current_district`, `current_division`, `permanent_location`, `permanent_postoffice`, `permanent_upazila`, `permanent_district`, `permanent_division`, `gender`, `birth_date`, `nationality`, `religion`, `blood_group`, `education_qualification`, `marital_status`, `nominee_name`, `nominee_relation`, `nominee_picture`, `member_sign`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 'member 1', 'member 1', 'member 1', 'member 1', 'member 1', 'member 1', 'member 1', 447, 59, 7, 'member 1', 'member 1', 447, 59, 7, 'পুরুষ', '2000-01-02', 'bangladeshi', 'মুসলিম', 3, 2, 'বিবাহিত', 'member 1', 'member 1', 'nominee_1.jpg', 'applicant_sign_1.jpg', '2017-04-16 18:00:00', '2017-04-17 05:15:34'),
(2, 2, NULL, 'fdgs', 'dss', 'd', 'sg', 'sdg', 'sdgs', 'g', 450, 59, 7, 'sdgs', 'sdg', 450, 59, 7, 'পুরুষ', '2000-03-02', 'bangladeshi', 'মুসলিম', 1, 1, 'বিবাহিত', 'fhfh', 'dfhd', 'nominee_2.jpg', 'applicant_sign_2.jpg', '2017-04-25 18:00:00', '2017-04-26 05:07:20');

-- --------------------------------------------------------

--
-- Table structure for table `member_employee_rel`
--

CREATE TABLE `member_employee_rel` (
  `id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=active 0=inactive',
  `added_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `member_employee_rel`
--

INSERT INTO `member_employee_rel` (`id`, `emp_id`, `member_id`, `status`, `added_by`, `created_at`, `updated_at`) VALUES
(1, 4, 1, 1, 1, '2017-04-16 18:00:00', '2017-04-17 05:35:21'),
(2, 5, 2, 1, 1, '2017-04-25 18:00:00', '2017-04-26 05:11:08');

-- --------------------------------------------------------

--
-- Table structure for table `member_resignation_list`
--

CREATE TABLE `member_resignation_list` (
  `id` int(11) NOT NULL,
  `member_id` int(11) DEFAULT NULL,
  `total_amount` double NOT NULL,
  `requested_amount` double NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=waiting 1=approved by field worker 2=reject by field worker 3=approved by branch head 4=reject by branch head 5=approved by admin  6=reject by admin',
  `field_worker_checked_by` int(11) DEFAULT NULL COMMENT 'emp_id who take action',
  `field_worker_checed_date` date DEFAULT NULL,
  `field_worker_decision` int(11) DEFAULT NULL,
  `branch_head_checked_by` int(11) DEFAULT NULL,
  `branch_head_checked_date` date DEFAULT NULL,
  `branch_head_decision` int(11) DEFAULT NULL,
  `admin_checked_by` int(11) DEFAULT NULL,
  `admin_checked_date` date DEFAULT NULL,
  `admin_decision` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2017_02_12_101356_create_front_datas_table', 1),
(4, '2017_02_13_051927_create_meeting_notices_table', 1),
(5, '2017_02_26_064726_create_branches_table', 1),
(6, '2017_02_26_064828_create_members_table', 1),
(7, '2017_02_26_070252_create_member_details_table', 1),
(8, '2017_02_26_082654_create_employee_details_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `partial_withdrawal_list`
--

CREATE TABLE `partial_withdrawal_list` (
  `id` int(11) NOT NULL,
  `member_id` int(11) DEFAULT NULL,
  `total_amount` double NOT NULL,
  `requested_amount` double NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=waiting 1=approved by field worker 2=reject by field worker 3=approved by branch head 4=reject by branch head 5=approved by admin  6=reject by admin',
  `field_worker_checked_by` int(11) DEFAULT NULL COMMENT 'emp_id who checked this requested',
  `field_worker_checed_date` date DEFAULT NULL,
  `field_worker_decision` int(11) DEFAULT NULL,
  `branch_head_checked_by` int(11) DEFAULT NULL,
  `branch_head_checked_date` date DEFAULT NULL,
  `branch_head_decision` int(11) DEFAULT NULL,
  `admin_checked_by` int(11) DEFAULT NULL,
  `admin_checked_date` date DEFAULT NULL,
  `admin_decision` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `prokolpo`
--

CREATE TABLE `prokolpo` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` tinyint(4) NOT NULL COMMENT '1=deposit 2=withdraw',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=active 0=blocked',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `prokolpo`
--

INSERT INTO `prokolpo` (`id`, `name`, `type`, `status`, `created_at`, `updated_at`) VALUES
(2, 'গ্রাম সঞ্চয়', 1, 1, '2017-03-20 00:35:32', '2017-04-26 09:30:38'),
(3, 'বাজার সঞ্চয়', 1, 1, '2017-03-20 00:39:57', '2017-04-26 09:30:35'),
(4, 'পণ্য ঋণ', 2, 1, '2017-03-20 00:41:59', '2017-04-26 09:30:31'),
(5, 'ক্ষুদ্র ঋণ', 2, 1, '2017-03-20 00:42:16', '2017-03-20 00:42:16');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `priority` tinyint(4) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=active 0=inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `priority`, `status`, `created_at`, `updated_at`) VALUES
(1, 'অ্যাডমিন', 1, 1, NULL, '2017-03-27 11:28:16'),
(2, 'ব্রাঞ্চ ম্যানেজার', 2, 1, NULL, '2017-03-27 11:28:16'),
(3, 'একাউন্টেন্ট', 3, 1, NULL, '2017-03-27 11:28:16'),
(4, 'ফিল্ড ওয়ার্কার', 4, 1, NULL, '2017-03-27 11:28:16');

-- --------------------------------------------------------

--
-- Table structure for table `salary`
--

CREATE TABLE `salary` (
  `id` int(11) NOT NULL,
  `salary_month` varchar(150) COLLATE utf8_unicode_ci NOT NULL COMMENT 'month year',
  `working_day` float NOT NULL,
  `emp_id` int(11) NOT NULL,
  `basic_salary` double NOT NULL,
  `overtime` float NOT NULL,
  `bonus` double NOT NULL,
  `deduction` double NOT NULL,
  `addition` double NOT NULL,
  `advance` double NOT NULL,
  `attendence` double NOT NULL,
  `mobile` double NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=unpaied 1=paied',
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `salary`
--

INSERT INTO `salary` (`id`, `salary_month`, `working_day`, `emp_id`, `basic_salary`, `overtime`, `bonus`, `deduction`, `addition`, `advance`, `attendence`, `mobile`, `description`, `status`, `created_by`, `created_at`, `updated_at`) VALUES
(1, '2017-04', 26, 1, 20000, 0, 0, 666.6666666666666, 0, 0, 0, 0, 'Leave deduction : 666.66666666667', 0, 3, '2017-04-16 18:00:00', '2017-04-17 05:01:46'),
(2, '2017-04', 26, 2, 30000, 0, 0, 1000, 0, 0, 0, 0, 'Leave deduction : 1000', 0, 3, '2017-04-16 18:00:00', '2017-04-17 05:01:46'),
(3, '2017-04', 26, 3, 50000, 0, 0, 1666.6666666666667, 0, 0, 0, 0, 'Leave deduction : 1666.6666666667', 0, 3, '2017-04-16 18:00:00', '2017-04-17 05:01:46'),
(4, '2017-04', 26, 4, 10000, 0, 0, 333.3333333333333, 0, 0, 0, 0, 'Leave deduction : 333.33333333333', 0, 3, '2017-04-16 18:00:00', '2017-04-17 05:01:46'),
(5, '2017-04', 26, 5, 10000, 0, 0, 333.3333333333333, 0, 0, 0, 0, 'Leave deduction : 333.33333333333', 0, 3, '2017-04-16 18:00:00', '2017-04-17 05:01:46');

-- --------------------------------------------------------

--
-- Table structure for table `salary_advance`
--

CREATE TABLE `salary_advance` (
  `id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `advance_month` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `amount` double NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `advance_received` date NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=unchecked 1=checked',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `salary_advance`
--

INSERT INTO `salary_advance` (`id`, `emp_id`, `advance_month`, `amount`, `description`, `advance_received`, `transaction_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 4, '2017-03', 500, 'picnic', '2017-03-01', 19, 0, '2017-04-18 18:00:00', '2017-04-19 05:52:16'),
(2, 5, '2017-05', 5000, 'picnicbbb', '2017-05-12', 20, 0, '2017-04-18 18:00:00', '2017-04-19 06:11:55'),
(3, 1, '2017-04', 2000, 'this is test. this is test. this is test. this is test. this is test. this is test. this is test. this is test.', '2017-04-19', 21, 0, '2017-04-18 18:00:00', '2017-04-19 06:20:51');

-- --------------------------------------------------------

--
-- Table structure for table `sub_account_group`
--

CREATE TABLE `sub_account_group` (
  `id` int(11) NOT NULL,
  `account_group_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=active 0=blocked',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sub_account_group`
--

INSERT INTO `sub_account_group` (`id`, `account_group_id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 5, 'বেতন', 1, '2017-04-18 06:31:57', '2017-04-18 06:39:06'),
(2, 5, 'বোনাস', 1, '2017-04-18 06:38:27', '2017-04-18 06:39:06'),
(3, 5, 'ভ্রমণ খরচ', 1, '2017-04-18 06:38:27', '2017-04-18 06:39:06'),
(4, 5, 'অফিস ভাড়া', 1, '2017-04-18 06:38:27', '2017-04-18 06:39:06'),
(5, 5, 'বিদ্যুৎ বিল', 1, '2017-04-18 06:38:27', '2017-04-18 06:39:06'),
(6, 5, 'পানির বিল', 1, '2017-04-18 06:38:27', '2017-04-18 06:39:06'),
(7, 5, 'অফিস স্টেশনারী', 1, '2017-04-18 06:38:27', '2017-04-18 06:39:06'),
(8, 5, 'প্রিন্টিং স্টেশনারী', 1, '2017-04-18 06:38:27', '2017-04-18 06:39:06'),
(9, 5, 'টেলিফোন বিল', 1, '2017-04-18 06:38:27', '2017-04-18 06:39:06'),
(10, 5, 'জ্বালানি খরচ', 1, '2017-04-18 06:38:27', '2017-04-18 06:39:06'),
(11, 5, 'ফটোকপি খরচ', 1, '2017-04-18 06:38:27', '2017-04-18 06:39:06'),
(12, 5, 'ব্যাংক চার্জ', 1, '2017-04-18 06:38:27', '2017-04-18 06:39:06'),
(13, 5, 'মেরামত খরচ', 1, '2017-04-18 06:38:27', '2017-04-18 06:39:06'),
(14, 5, 'প্রধান কার্যালয় সুদ ধার্য ব্যয়', 1, '2017-04-18 06:38:27', '2017-04-18 06:39:06'),
(15, 5, 'অবচয় ব্যয়', 1, '2017-04-18 06:38:27', '2017-04-18 06:39:06'),
(16, 5, 'সার্ভিস চার্জ / সুদের ব্যয়', 1, '2017-04-18 06:38:27', '2017-04-18 06:39:06'),
(17, 5, 'খবরের কাগজ', 1, '2017-04-18 06:38:27', '2017-04-18 06:39:06'),
(18, 5, 'আপ্যায়ন খরচ', 1, '2017-04-18 06:38:27', '2017-04-18 06:39:06'),
(19, 5, 'বিবিধ খরচ', 1, '2017-04-18 06:38:27', '2017-04-18 06:39:06'),
(20, 5, 'পরিবহন', 1, '2017-04-18 06:38:27', '2017-04-18 06:39:06'),
(21, 5, 'প্রকল্প উন্নয়ন ব্যয়', 1, '2017-04-18 06:38:27', '2017-04-18 06:39:06'),
(22, 5, 'প্রশিক্ষণ খরচ', 1, '2017-04-18 06:38:27', '2017-04-18 06:39:06'),
(23, 5, 'কমিশন খরচ', 1, '2017-04-18 06:38:27', '2017-04-18 06:39:06'),
(24, 1, 'ক্যাশ', 1, '2017-04-17 18:00:00', '2017-04-18 09:17:26'),
(25, 4, 'খবরের কাগজ বিক্রয়', 1, '2017-04-17 18:00:00', '2017-04-18 09:17:16'),
(26, 4, 'বিবিধ আদায়', 1, '2017-04-17 18:00:00', '2017-04-18 09:17:16');

-- --------------------------------------------------------

--
-- Table structure for table `sub_group`
--

CREATE TABLE `sub_group` (
  `id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sub_group`
--

INSERT INTO `sub_group` (`id`, `group_id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 6, 'গ্রাম সঞ্চয়', 1, NULL, '2017-04-18 05:13:43'),
(2, 6, 'বাজার সঞ্চয়', 1, NULL, '2017-04-18 05:13:46');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `comment` text COLLATE utf8_unicode_ci,
  `debit` double NOT NULL,
  `credit` double NOT NULL,
  `group_id` int(11) NOT NULL,
  `sub_group_id` int(11) NOT NULL,
  `account_group_id` int(11) NOT NULL,
  `sub_account_group_id` int(11) NOT NULL DEFAULT '0',
  `member_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `transaction_date` date NOT NULL,
  `added_by` int(11) NOT NULL COMMENT 'emp_id who add',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=unchecked',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`id`, `description`, `comment`, `debit`, `credit`, `group_id`, `sub_group_id`, `account_group_id`, `sub_account_group_id`, `member_id`, `employee_id`, `transaction_date`, `added_by`, `status`, `created_at`, `updated_at`) VALUES
(1, 'member 1 এর ভর্তি ফি - ৫০ টাকা ', NULL, 50, 0, 1, 0, 1, 0, 1, 0, '2017-04-17', 1, 0, '2017-04-16 18:00:00', '2017-04-17 05:34:28'),
(2, 'member 1 এর 10 টি শেয়ার এর শেয়ার মূল্য - ২০০ টাকা ', NULL, 200, 0, 2, 0, 2, 0, 1, 0, '2017-04-17', 1, 0, '2017-04-16 18:00:00', '2017-04-17 05:34:28'),
(3, 'member 1 এর বাজার সঞ্চয় - ১০ টাকা ', NULL, 10, 0, 6, 2, 0, 0, 1, 0, '2017-04-17', 4, 0, '2017-04-16 18:00:00', '2017-04-17 06:27:33'),
(4, 'member 1 এর 10 টি শেয়ার এর শেয়ার মূল্য - ২০০ টাকা ', NULL, 200, 0, 2, 0, 2, 0, 1, 0, '2017-04-17', 1, 0, '2017-04-16 18:00:00', '2017-04-17 06:58:35'),
(5, 'member 1 এর 1 টি শেয়ার এর শেয়ার মূল্য - ২০ টাকা ', NULL, 20, 0, 2, 0, 2, 0, 1, 0, '2017-04-17', 1, 0, '2017-04-16 18:00:00', '2017-04-17 06:59:48'),
(6, 'member 1 এর 1 টি শেয়ার ফেরত , শেয়ার মূল্য - ২০ টাকা ', NULL, 0, 20, 2, 0, 2, 0, 1, 0, '2017-04-17', 1, 0, '2017-04-16 18:00:00', '2017-04-17 07:14:22'),
(7, 'ভ্রমণ খরচ বাবদ ব্যয় - ২০০ টাকা ', 'mr. a got 200tk for transport cost', 0, 200, 0, 0, 5, 3, 0, 0, '2017-04-18', 1, 0, '2017-04-17 18:00:00', '2017-04-18 02:58:54'),
(8, 'অফিস ভাড়া বাবদ ব্যয় - ৫০০০ টাকা ', 'office rent 5000', 0, 5000, 0, 0, 5, 4, 0, 0, '2017-04-18', 1, 0, '2017-04-17 18:00:00', '2017-04-18 03:00:40'),
(9, 'জ্বালানি খরচ বাবদ ব্যয় - ২০০ টাকা ', 'fuel cost 200', 0, 200, 0, 0, 5, 10, 0, 0, '2017-04-18', 1, 0, '2017-04-17 18:00:00', '2017-04-18 03:00:40'),
(10, 'বিদ্যুৎ বিল বাবদ ব্যয় - ৫০০০ টাকা ', 'current bill 5000', 0, 5000, 0, 0, 5, 5, 0, 0, '2017-04-18', 1, 0, '2017-04-17 18:00:00', '2017-04-18 03:00:40'),
(11, 'অফিস স্টেশনারী বাবদ ব্যয় - ৫০০ টাকা ', 'office stationery 500', 0, 500, 0, 0, 5, 7, 0, 0, '2017-04-18', 1, 0, '2017-04-17 18:00:00', '2017-04-18 03:06:14'),
(12, 'প্রিন্টিং স্টেশনারী বাবদ ব্যয় - ৫০০ টাকা ', 'printing stationary', 0, 500, 0, 0, 5, 8, 0, 0, '2017-04-18', 1, 0, '2017-04-17 18:00:00', '2017-04-18 03:06:14'),
(13, 'খবরের কাগজ বিক্রয় বাবদ আয় - ৫০০ টাকা ', 'paper sell', 500, 0, 0, 0, 4, 25, 0, 0, '2017-04-18', 1, 0, '2017-04-17 18:00:00', '2017-04-18 03:24:44'),
(14, 'member 1 এর ঋণ আদায় - ৫০ টাকা ', NULL, 50, 0, 3, 0, 0, 0, 1, 0, '2017-04-18', 4, 0, '2017-04-17 18:00:00', '2017-04-18 04:53:30'),
(15, 'member 1 এর সার্ভিস চার্জ আদায় - ৫ টাকা ', NULL, 5, 0, 4, 0, 0, 0, 1, 0, '2017-04-18', 4, 0, '2017-04-17 18:00:00', '2017-04-18 04:53:30'),
(16, 'member 1 এর ঋণ বীমা আদায় - ৫০ টাকা ', NULL, 50, 0, 5, 0, 0, 0, 1, 0, '2017-04-18', 4, 0, '2017-04-17 18:00:00', '2017-04-18 04:53:30'),
(17, 'branch head এর 2017-04 মাসের অগ্রিম বেতন  - 210 টাকা ', 'for hospital reasin', 0, 210, 8, 0, 5, 1, 0, 1, '2017-04-19', 1, 0, '2017-04-18 18:00:00', '2017-04-19 05:00:12'),
(18, 'branch head এর 2017-04 মাসের অগ্রিম বেতন  - 210 টাকা ', 'for hospital reasin', 0, 210, 8, 0, 5, 1, 0, 1, '2017-04-19', 1, 0, '2017-04-18 18:00:00', '2017-04-19 05:00:28'),
(19, 'atoyari field worker এর 2017-03 মাসের অগ্রিম বেতন  - 500 টাকা ', 'picnic', 0, 500, 8, 0, 5, 1, 0, 4, '2017-03-01', 1, 0, '2017-04-18 18:00:00', '2017-04-19 05:52:16'),
(20, 'field worker 33 এর 2017-05 মাসের অগ্রিম বেতন  - 5000 টাকা ', 'picnicbbb', 0, 5000, 8, 0, 5, 1, 0, 5, '2017-05-12', 1, 0, '2017-04-18 18:00:00', '2017-04-19 06:11:55'),
(21, 'branch head এর 2017-04 মাসের অগ্রিম বেতন  - 2000 টাকা ', 'this is test. this is test. this is test. this is test. this is test. this is test. this is test. this is test.', 0, 2000, 8, 0, 5, 1, 0, 1, '2017-04-19', 1, 0, '2017-04-18 18:00:00', '2017-04-19 06:20:51'),
(22, 'member 1 এর বাজার সঞ্চয় - ৫০০ টাকা ', NULL, 500, 0, 6, 2, 0, 0, 1, 0, '2017-04-25', 4, 0, '2017-04-24 18:00:00', '2017-04-24 23:06:26'),
(23, 'member 1 এর ঋণ আদায় - ১০০ টাকা ', NULL, 100, 0, 3, 0, 0, 0, 1, 0, '2017-04-25', 4, 0, '2017-04-24 18:00:00', '2017-04-24 23:10:41'),
(24, 'member 1 এর সার্ভিস চার্জ আদায় - ৫০ টাকা ', NULL, 50, 0, 4, 0, 0, 0, 1, 0, '2017-04-25', 4, 0, '2017-04-24 18:00:00', '2017-04-24 23:10:41'),
(25, 'member 1 এর ঋণ বীমা আদায় - ২০ টাকা ', NULL, 20, 0, 5, 0, 0, 0, 1, 0, '2017-04-25', 4, 0, '2017-04-24 18:00:00', '2017-04-24 23:10:41'),
(26, 'member 1 এর বাজার সঞ্চয় - ৫০০ টাকা ', NULL, 500, 0, 6, 2, 0, 0, 1, 0, '2017-04-26', 4, 0, '2017-04-25 18:00:00', '2017-04-26 03:11:14'),
(27, 'member 2 এর ভর্তি ফি - ৫০ টাকা ', NULL, 50, 0, 1, 0, 1, 0, 2, 0, '2017-04-26', 2, 0, '2017-04-25 18:00:00', '2017-04-26 05:11:02'),
(28, 'member 2 এর 15 টি শেয়ার এর শেয়ার মূল্য - ৩০০ টাকা ', NULL, 300, 0, 2, 0, 2, 0, 2, 0, '2017-04-26', 2, 0, '2017-04-25 18:00:00', '2017-04-26 05:11:02'),
(29, 'member 2 এর বাজার সঞ্চয় - ১০০ টাকা ', NULL, 100, 0, 6, 2, 0, 0, 2, 0, '2017-04-26', 5, 0, '2017-04-25 18:00:00', '2017-04-26 05:11:51');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_details`
--

CREATE TABLE `transaction_details` (
  `id` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `unit_quantity` double NOT NULL,
  `unit_price` double NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `upazilla`
--

CREATE TABLE `upazilla` (
  `id` int(10) NOT NULL,
  `bn_name` varchar(255) NOT NULL,
  `en_name` varchar(255) NOT NULL,
  `district_id` int(10) NOT NULL,
  `is_block` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=bloked'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `upazilla`
--

INSERT INTO `upazilla` (`id`, `bn_name`, `en_name`, `district_id`, `is_block`) VALUES
(1, 'সাভার', 'Savar', 14, 0),
(2, 'ধামরাই', 'Dhamrai', 14, 0),
(3, 'কেরানিগঞ্জ', 'Keranigong', 14, 0),
(4, 'নবাবগঞ্জ', 'Nobabgong', 14, 0),
(5, 'দোহার', 'Dohar', 14, 0),
(6, 'বেলাবো', 'Belabo', 1, 1),
(7, 'মনোহরদী', 'Monohardi', 1, 1),
(8, 'নরসিংদী', 'Narsingdi', 1, 1),
(9, 'পলাশ', 'Polash', 1, 1),
(10, 'রায়পুরা', 'Raipura', 1, 0),
(11, 'শিবপুর', 'Shibpur', 1, 1),
(12, 'কালীগঞ্জ', 'Kaliganj', 4, 1),
(13, 'কালিয়াকৈর', 'Kaliakair', 4, 1),
(14, 'কাপাসিয়া', 'Kapasia', 4, 0),
(15, 'গাজীপুর', 'Gazipur', 4, 0),
(16, 'শ্রীপুর', 'Sreepur', 4, 1),
(18, 'শরিয়তপুর', 'Shariatpur', 5, 0),
(19, 'নরিয়া', 'Naria', 5, 0),
(20, 'জাজিরা', 'Zajira', 5, 1),
(21, 'গোসাইরহাট', 'Gosairhat', 5, 1),
(22, 'ভেদরগঞ্জ', 'Bhedargong', 5, 1),
(23, 'ডামুড্যা', 'Damudya', 5, 1),
(24, 'আড়াইহাজার', 'Araihazar', 6, 1),
(25, 'নারায়নগঞ্জ', 'Narayangong', 6, 1),
(26, 'রূপগঞ্জ', 'Rupganj', 6, 1),
(27, 'সোনারগাঁ', 'Sonargaon', 6, 0),
(33, 'শেরপুর', 'Sherpur', 7, 0),
(34, 'নালিতাবাড়ী', 'Nalitabari', 7, 1),
(35, 'শ্রীবরদী', 'Sreebordi', 7, 1),
(36, 'নকলা', 'Nokla', 7, 0),
(37, 'ঝিনাইগাতী', 'Jhenaigati', 7, 1),
(38, 'সখিপুর', 'Shakhipur', 5, 1),
(39, 'বান্দার', 'Bandar', 6, 1),
(40, 'গোপালপুর', 'Gopalpur', 8, 1),
(41, 'বাসাইল', 'Basail', 8, 1),
(42, 'ভুয়াপুর', 'Bhuapur', 8, 1),
(43, 'দেলদুয়ার', 'Delduar', 8, 1),
(44, 'ঘাটাইল', 'Ghatail', 8, 1),
(45, 'কালিহাতী', 'Kalihati', 8, 1),
(46, 'মধুপুর', 'Madhupur', 8, 1),
(47, 'মির্জাপুর', 'Mirzapur', 8, 1),
(48, 'নগরপুর', 'Nagarpur', 8, 1),
(49, 'সখিপুর', 'Sakhipur', 8, 1),
(50, 'ধানবাড়ি', 'Dhanbari', 8, 1),
(51, 'টাঙ্গাইল সদর', 'Tangail Sadar', 8, 0),
(52, 'ভালুকা', 'Bhaluka', 9, 1),
(53, 'ধোবাউরা', 'Dhobaura', 9, 1),
(54, 'ফুলবাড়িয়া', 'Fulbaria', 9, 1),
(55, 'গফরগাঁও', 'Gaffargaon', 9, 1),
(56, 'গৌরিপুর', ' Gauripur', 9, 1),
(57, 'হালুয়াঘাট', 'Haluaghat', 9, 1),
(58, 'ঈশ্বরগঞ্জ', 'Ishwarganj', 9, 1),
(59, 'ময়মনসিংহ সদর', 'Mymensingh Sadar', 9, 1),
(60, 'মুক্তগাছা', 'Muktagachha', 9, 1),
(61, 'নান্দাইল', 'Nandail', 9, 1),
(62, 'ফুলপুর', 'Phulpur', 9, 0),
(63, 'ত্রিশাল', 'Trishal', 9, 1),
(64, 'তারাখন্দ ', 'Tara Khanda', 9, 1),
(65, 'অষ্টগ্রাম', 'Austagram', 10, 1),
(66, 'বাজিতপুর', 'Bajitpur', 10, 1),
(67, 'ভৈরব', 'Bhairab', 10, 1),
(68, 'হোসেনপুর', 'Hossainpur', 10, 1),
(69, 'ইতনা', 'Itna', 10, 1),
(70, 'করিমগঞ্জ', 'Karimganj', 10, 1),
(71, 'কাটিয়াদি', 'Katiadi', 10, 1),
(72, 'কিশোরগঞ্জ সদর', 'Kishoregong Sadar', 10, 1),
(73, 'কুলিয়ারচর', 'Kuliarchar', 10, 1),
(74, 'মিঠামাইন', 'Mithamain', 10, 1),
(75, 'নিকলি', 'Nikli', 10, 1),
(76, 'পাকুন্দিয়া', 'Pakundia', 10, 1),
(77, 'তাড়াইল', 'Tarail', 10, 1),
(78, 'বকশীগঞ্জ', 'Baksiganj', 11, 1),
(79, 'দেওয়ানগঞ্জ', 'Dewanganj', 11, 1),
(80, 'ইসলামপুর', 'Islampur', 11, 1),
(81, 'জামালপুর সদর', 'Jamalpur Sadar', 11, 0),
(82, 'মাদারগঞ্জ', 'Madarganj', 11, 0),
(83, 'মেলান্দাহা', 'Melandaha', 11, 1),
(84, 'সরিষাবাড়ী', 'Sarishabari', 11, 1),
(85, 'দৌলতপুর', 'Daulatput', 12, 1),
(86, 'ঘিওর', 'Ghior', 12, 1),
(87, 'হরিরামপুর', 'Harirampur', 12, 1),
(88, 'মানিকগঞ্জ সদর', 'Manikganj Sadar', 12, 0),
(89, 'সাটুরিয়া', 'Saturia', 12, 1),
(90, 'শিবালয়', 'Shivalaya', 12, 1),
(91, 'সিঙ্গাইর', 'Singair', 12, 1),
(92, 'আটপারা', 'Atpara', 13, 1),
(93, 'বারোহাট্টা', 'Barhatta', 13, 1),
(94, 'দুর্গাপুর', 'Durgapur', 13, 1),
(95, 'খালিয়াজুরি', 'Khaliajuri', 13, 1),
(96, 'কালমাকান্দা', 'Kalmakanda', 13, 1),
(97, 'কেন্দুয়া', 'Kendua', 13, 1),
(98, 'মাদান', 'Madan', 13, 1),
(99, 'মহানগঞ্জ', 'Mohanganj', 13, 1),
(100, 'নেত্রকোনা সদর', 'Netrokona Sadar', 13, 1),
(101, 'পুর্বাঢালা', 'Purbadhala', 13, 1),
(102, 'গজারিয়া', 'Gazaria', 15, 1),
(103, 'লোহাগঞ্জ', 'Lohaganj', 15, 1),
(104, 'মুন্সীগঞ্জ সদর', 'Munshiganj Sadar', 15, 0),
(105, 'সিরাজিদখান', 'Sirajdikhan', 15, 0),
(106, 'শ্রীনগর', 'Sreenagar', 15, 0),
(107, 'টঙ্গীবাড়ি', 'Tongibari', 15, 1),
(108, 'বালিয়াকান্দি', 'Baliakandi', 16, 1),
(109, 'গোয়ালন্দঘাট', 'Goalandaghat', 16, 1),
(110, 'পাংশা', 'Pangsha', 16, 0),
(111, 'রাজবাড়ী সদর', 'Rajbari Sadar', 16, 1),
(112, 'কালুখালি', 'Kalukhali', 16, 1),
(113, 'রাজোইর', 'Rajoir', 17, 1),
(114, 'মাদারিপুর সদর', 'Madaripur Sadar', 17, 0),
(115, 'কালকিনি', 'Kalkini', 17, 0),
(116, 'শিবচর', 'Shibchar', 17, 1),
(117, 'গোপালগঞ্জ সদর', 'Gopalganj Sadar', 18, 1),
(118, 'কাশিয়ানি', 'Kashiani', 18, 1),
(119, 'কোটালিপাড়া', 'Kotalipara', 18, 1),
(120, 'মুকসুদপুর', 'Muksudpur', 18, 1),
(121, 'টুঙ্গিপাড়া', 'Tungipara', 18, 0),
(122, 'আলফাদাঙ্গা', 'Alfadanda', 19, 1),
(123, 'ভাঙ্গা', 'Bhanga', 19, 1),
(124, 'বোয়ালমারি', 'Boalmari', 19, 1),
(125, 'চারভাদর্শন', 'Charbhadarson', 19, 1),
(126, 'ফরিদপুর সদর', 'Faridpur Sadar', 19, 0),
(127, 'মধুখালি', 'Madhukhali', 19, 1),
(128, 'নগরকান্দা', 'Nagarkanda', 19, 1),
(129, 'সদরপুর', 'Sadarpur', 19, 1),
(130, 'সালথা', 'Saltha', 19, 1),
(131, 'অভয়নগর', 'Abhaynagar', 20, 1),
(132, 'বাঘারপাড়া', 'Bagherpara', 20, 1),
(133, 'চৌগাছা', 'Chaugachha', 20, 1),
(134, 'ঝিকরগাছা', 'Jhikargachha', 20, 1),
(135, 'কেশবপুর', 'Keshabpur', 20, 1),
(136, 'যশোর সদর', 'Jessore Sadar', 20, 0),
(137, 'মনিরামপুর', 'Manirampur', 20, 1),
(138, 'শার্শা', 'Sharsha', 20, 1),
(139, 'আশাশুনি', 'Assasuni', 21, 1),
(140, 'দেবহাটা', 'Debhata', 21, 1),
(141, 'কলারোয়া', 'Kalaroa', 21, 1),
(142, 'কালিগঞ্জ', 'Kaliganj', 21, 1),
(143, 'সাতক্ষীরা সদর', 'Satkhira Sadar', 21, 1),
(144, 'শ্যামনগর', 'Shyamnagar', 21, 1),
(145, 'তালা', 'Tala', 21, 1),
(146, 'গাংনি', 'Gangni', 22, 1),
(147, 'মেহেরপুর সদর', 'Meherpur Sadar', 22, 0),
(148, 'মুজিবনগর', 'Mujibnagar', 22, 0),
(149, 'কালিয়া', 'Kalia', 23, 1),
(150, 'লোহাগড়া', 'Lohagara', 23, 1),
(151, 'নড়াইল সদর', 'Narail Sadar', 23, 0),
(153, 'আলমডাঙ্গা', 'Alamdanga', 24, 1),
(154, 'চুয়াডাঙ্গা সদর', 'Chuadangda Sadar', 24, 0),
(155, 'দামুরহুদা', 'Damurhuda', 24, 1),
(156, 'জীবননগর', 'Jibannagar', 24, 1),
(157, 'ভেড়ামারা', 'Bheramara', 25, 1),
(158, 'দৌলতপুর', 'Daulatpur', 25, 1),
(159, 'খোকসা', 'Khoksa', 25, 1),
(160, 'কুমারখালি', 'Kumarkhali', 25, 1),
(161, 'কুষ্টিয়া সদর', 'Kushtia Sadar', 25, 0),
(162, 'মিরপুর', 'Mirpur', 25, 0),
(163, 'মাগুরা সদর', 'Magura Sadar', 26, 1),
(164, 'মোহাম্মদপুর', 'Mohammadpur', 26, 0),
(165, 'সালিখা', 'Shalikha', 26, 1),
(166, 'শ্রীপুর', 'Sreepur', 26, 1),
(167, 'বটিয়াঘাটা', 'Batiaghata', 27, 1),
(168, 'দাকোপ', 'Dacope', 27, 1),
(169, 'ডুমুরিয়া', 'Dumuria', 27, 1),
(170, 'দিঘলিয়া', 'Dighalia', 27, 1),
(171, 'কয়রা', 'Koyra', 27, 1),
(172, 'পাইকগাছা', 'Paikgachha', 27, 1),
(173, 'ফুলতলা', 'Phultala', 27, 0),
(174, 'রূপসা', 'Rupsha', 27, 1),
(175, 'তেরখাদা', 'Terokhada', 27, 1),
(176, 'বাগেরহাট সদর', 'Bagerhat Sadar', 28, 0),
(177, 'চিতলমারি', 'Chitalmari', 28, 1),
(178, 'ফকিরহাট', 'Fakirhat', 28, 1),
(179, 'কচুয়া', 'Kachua', 28, 1),
(180, 'মোল্লাহাট', 'Mollahat', 28, 1),
(181, 'মোংলা', 'Mongla', 28, 1),
(182, 'মোড়েলগঞ্জ', 'Morrelganj', 28, 0),
(183, 'রামপাল', 'Rampal', 28, 1),
(184, 'শরনখোলা', 'Sarankhola', 28, 1),
(185, 'হরিনকুন্ড', 'Harinakunda', 29, 1),
(186, 'ঝিনাইদহ সদর', 'Jhenaida Sadar', 29, 1),
(187, 'কালীগঞ্জ', 'Kaliganj', 29, 1),
(188, 'কোটচাঁদপুর', 'Kotchandpur', 29, 1),
(189, 'মহেশপুর', 'Maheshpur', 29, 1),
(190, 'শৈলকূপা', 'Shailkupa', 29, 0),
(191, 'বাড়ুরা', 'Barura', 30, 1),
(192, 'ব্রাহ্মনপাড়া', 'Brahmanpara', 30, 1),
(193, 'বুড়িচং', 'Burichang', 30, 1),
(194, 'চান্দিনা', 'Chandina', 30, 0),
(195, 'চৌদ্দগ্রাম', 'Chauddagram', 30, 1),
(196, 'দাউদকান্দি', 'Daudkandi', 30, 1),
(197, 'দেবীদার', 'Debidwar', 30, 1),
(198, 'হোমনা', 'Homna', 30, 1),
(199, 'লাকসাম', 'Laksam', 30, 1),
(200, 'মুরাদনগর', 'Muradnagar', 30, 1),
(201, 'নাঙ্গালকোট', 'Nangalkot', 30, 1),
(202, 'কুমিল্লা সদর', 'Comilla Sadar', 30, 1),
(203, 'মেঘনা', 'Meghna', 30, 1),
(204, 'তিতাস', 'Titas', 30, 1),
(205, 'মনোহরগঞ্জ', 'Monohorganj', 30, 1),
(206, 'কুমিল্লা সদর দক্ষিন', 'Comilla Sadar Dakshin', 30, 1),
(207, 'ছাগলনাইয়া', 'Chhagalnaiya', 31, 0),
(208, 'দাগানভুইয়ান', 'Daganbhuiyan', 31, 1),
(209, 'ফেনী সদর', 'Feni Sadar', 31, 1),
(210, 'পরশুরাম', 'Parshuram', 31, 1),
(211, 'সোনাগাজী', 'Sonagazi', 31, 1),
(212, 'ফুলগাজী', 'Fulgazi', 31, 1),
(213, 'আখাউড়া', 'Akhaura', 32, 1),
(214, 'বঞ্চরমপুর', 'Bancharampur', 32, 1),
(215, 'ব্রাহ্মনবাড়িয়া সদর', 'Brahmanbaria Sadar', 32, 1),
(216, 'কাসবা', 'Kasba', 32, 1),
(217, 'নবীনগর', 'Nabinagar', 32, 1),
(218, 'নাসিরনগর', 'Nasirnagar', 32, 1),
(219, 'সরাইল', 'Sarail', 32, 1),
(220, 'আশুগঞ্জ', 'Ashugonj', 32, 1),
(221, 'বিজয়নগর', 'Bijoynagar', 32, 1),
(222, 'বাগাইছড়ি', 'Bagaichhari', 33, 1),
(223, 'বারকোল', 'Barkal', 33, 1),
(224, 'কাওখালী', 'Kawkhali', 33, 1),
(225, 'বেলাইছড়ি', 'Belaichhari', 33, 1),
(226, 'কাপ্তাই', 'Kaptai', 33, 1),
(227, 'জুরাইছড়ি', 'Juraichhori', 33, 1),
(228, 'লাঙ্গাদু', 'Langadu', 33, 1),
(229, 'নানিয়াচর', 'Naniyachar', 33, 1),
(230, 'রাজস্থলি', 'Rajasthali', 33, 1),
(231, 'রাঙ্গামাটি সদর', 'Rangamati Sadar', 33, 0),
(232, 'বেগমগঞ্জ', 'Begumganj', 34, 1),
(233, 'নোয়াখালি সদর', 'Noakhali Sadar', 34, 1),
(234, 'চাটখিল', 'Chatkhil', 34, 1),
(235, 'কোম্পানীগঞ্জ', 'Companigonj', 34, 0),
(236, 'হাতিয়া', 'Hatiya', 34, 1),
(237, 'সেনবাগ', 'Senbag', 34, 1),
(238, 'সোনাইমুরি', 'Sonaimuri', 34, 1),
(239, 'সুবর্নচর', 'Subarnachar', 34, 1),
(240, 'কবিরহাট', 'Kabirhat', 34, 1),
(241, 'চাঁদপুর সদর', 'Chandpur Sadar', 35, 0),
(242, 'ফরিদ্গঞ্জ', 'Faridgonj', 35, 1),
(243, 'হাইমচর', 'Maimchor', 35, 1),
(244, 'হাজিগঞ্জ', 'Hazigonj', 35, 1),
(245, 'কাচুয়া', 'Kachua', 35, 1),
(246, 'মতলব দক্ষিন', 'Matlab Dakshin', 35, 1),
(247, 'মতলব উত্তর', 'Matlab Uttar', 35, 1),
(248, 'শাহরাস্তি', 'Shahrasti', 35, 1),
(249, 'লক্ষ্মীপুর সদর', 'Lakshmipur Sadar', 36, 0),
(250, 'রায়পুর', 'Raipur', 36, 1),
(251, 'রামগঞ্জ', 'Ramganj', 36, 0),
(252, 'রামগাতী', 'Ramgati', 36, 1),
(253, 'কমলনগর', 'Kamalnogor', 36, 1),
(254, 'আনোয়ারা', 'Anwara', 37, 1),
(255, 'বানসখালী', 'Banshkhali', 37, 1),
(256, 'বোয়ালখালী', 'Boalkhali', 37, 1),
(257, 'চন্দনৈশ', 'Chandanaish', 37, 1),
(258, 'ফটিকছড়ি', 'Fatikchhari', 37, 1),
(259, 'হাটহাজারী', 'Hathazari', 37, 1),
(260, 'কর্ণফূলি', 'Karnaphuli', 37, 1),
(261, 'লোহাগড়া', 'Lohagara', 37, 1),
(262, 'মিরসরাই', 'Mirsharai', 37, 0),
(263, 'পটিয়া', 'Patiya', 37, 1),
(264, 'রাঙ্গুনিয়া', 'Rangunia', 37, 1),
(265, 'রাওজান', 'Raozan', 37, 1),
(266, 'সন্দ্বীপ', 'Sandwip', 37, 1),
(267, 'সাতকানিয়া', 'Satkania', 37, 1),
(268, 'সীতাকুন্ড', 'Sitakundo', 37, 1),
(269, 'বান্দার', 'Bandar', 37, 1),
(270, 'চন্দগাঁও', 'Chandgaon', 37, 1),
(271, 'কোটয়ালী', 'Kotwali', 37, 1),
(272, 'পাহাড়তলী', 'Pahartali', 37, 1),
(273, 'পঞ্চলাইশ', 'Panchlaish', 37, 1),
(274, 'ভুজপুর', 'Bhujpur', 37, 1),
(275, 'চকরিয়া', 'Chakaria', 38, 1),
(276, 'কক্সবাজার সদর', 'Cox''s Bazar Sadar ', 38, 1),
(277, 'কুতুবদিয়া', 'Kutubdia', 38, 1),
(278, 'মহেশখালী', 'Maheshkhali', 38, 1),
(279, 'রামু', 'Ramu', 38, 1),
(280, 'টেকনাফ', 'Teknaf', 38, 1),
(281, 'উখিয়া', 'Ukhia', 38, 1),
(282, 'পেকুয়া', 'Pekua', 38, 1),
(283, 'দীঘিনালা', 'Dighinala', 39, 1),
(284, 'খাগড়াছড়ি সদর', 'Khagrachhari Sadar', 39, 0),
(285, 'লক্ষ্মীছড়ি', 'Lakshmichhori ', 39, 1),
(286, 'মহলছড়ি', 'Mahalchhori', 39, 1),
(287, 'মানিকছড়ি', 'Manikchhori', 39, 1),
(288, 'মাটিরাঙ্গা', 'Matiranga', 39, 1),
(289, 'পঞ্চছড়ি', 'Panchachhori', 39, 1),
(290, 'রামগড়', 'Ramgarh', 39, 1),
(291, 'আলী কদম', 'Ali Kadam', 40, 1),
(292, 'বান্দরবান সদর', 'Bandarban Sadar', 40, 0),
(293, 'লামা', 'Lama', 40, 1),
(294, 'নাইক্ষংছড়ি', 'Naikhongchhori', 40, 1),
(295, 'রোয়াংছড়ি', 'Rowangchhori', 40, 1),
(296, 'রুমা', 'Ruma', 40, 1),
(297, 'থানচি', 'Thanchi', 40, 1),
(298, 'বেলকুচি', 'Belkuchi', 41, 1),
(299, 'কাজিপুর', 'Kazipur', 41, 1),
(300, 'সিরাজগঞ্জ সদর', 'Sirajgonj Sadar', 41, 0),
(301, 'চৌহলি', 'Chauhali', 41, 1),
(302, 'রায়গঞ্জ', 'Raiganj', 41, 1),
(303, 'তাড়াশ', 'Tarash', 41, 1),
(304, 'কামারখন্দ', 'Kamarkhanda', 41, 0),
(305, 'শাহজাদপুর', 'Shahjadpur', 41, 0),
(306, 'উল্লাহপাড়া', 'Ullahpara', 41, 1),
(307, 'আটাইকুলা', 'Ataikula\r\n', 42, 1),
(308, 'ভাঙ্গুরা', 'Bhangura', 42, 0),
(309, 'ঈশ্বরদী', 'Ishwardi', 42, 1),
(310, 'সুজানগর', 'Sujanagar', 42, 1),
(311, 'আটঘরিয়া', 'Atgharia', 42, 1),
(312, 'চাটমোহর', 'Chatmohor', 42, 1),
(313, 'পাবনা সদর', 'Pabna Sadar', 42, 1),
(314, 'বেড়া', 'Bera', 42, 1),
(315, 'ফরিদপুর', 'Faridpur', 42, 1),
(316, 'সান্তিয়া', 'Santhia', 42, 1),
(317, 'আদমদীঘি', 'Adamdighi', 43, 1),
(318, 'বগুড়া সদর', 'Bogra Sadar', 43, 1),
(319, 'ধুনট', 'Dhunat', 43, 1),
(320, 'ধুপচাচিয়া', 'Dhupchachia', 43, 1),
(321, 'গাবতলী', 'Gabtali', 43, 1),
(322, 'কাহালু', 'Kahaloo', 43, 1),
(323, 'নন্দীগ্রাম', 'Nandigram', 43, 1),
(324, 'সরিয়াকান্দি', 'Sariakandi', 43, 1),
(325, 'শাজাহানপুর', 'Shajahanpur', 43, 1),
(326, 'শেরপুর', 'Sherpur', 43, 0),
(327, 'শিবগঞ্জ', 'Shibganj', 43, 1),
(328, 'সোনাতলা', 'Sonatola', 43, 1),
(329, 'বাঘা', 'Bagha', 44, 1),
(330, 'বাগমারা', 'Bagmara', 44, 1),
(331, 'চারঘাট', 'Charghat', 44, 1),
(332, 'দুর্গাপুর', 'Durgapur', 44, 1),
(333, 'গোদাগাড়ী', 'Godagari', 44, 1),
(334, 'মোহনপুর', 'Mohonpur', 44, 1),
(335, 'পবা', 'Paba', 44, 1),
(336, 'পুঠিয়া', 'Puthia', 44, 1),
(337, 'তানোর', 'Tanore', 44, 0),
(338, 'বাগাতিপাড়া', 'Bagatipara', 45, 1),
(339, 'বড়াইগ্রাম', 'Baraigram', 45, 1),
(340, 'গুরুদাশপুর', 'Gurudaspur', 45, 1),
(341, 'লালপুর', 'Lalpur', 45, 1),
(342, 'নাটোর সদর', 'Natore Sadar', 45, 1),
(343, 'সিংড়া', 'Singra', 45, 1),
(344, 'নলদাঙ্গা', 'Naldanga', 45, 1),
(345, 'আক্কেল্পুর', 'Akkelpur', 46, 1),
(346, 'জয়পুরহাট সদর', 'Joypurhat Sadar', 46, 1),
(347, 'কালাই', 'Kalai', 46, 1),
(348, 'ক্ষেতলাল', 'Khetlal', 46, 1),
(349, 'পাঁচবিবি', 'Pachbibi', 46, 1),
(350, 'ভোলাহাট', 'Bholahat', 47, 1),
(351, 'গোমস্তাপুর', 'Gomostapur', 47, 1),
(352, 'নাচোল', 'Nachole', 47, 1),
(353, 'নবাবগঞ্জ সদর', 'Nawabganj Sadar', 47, 1),
(354, 'শিবগঞ্জ', 'Shibganj', 47, 1),
(355, 'আত্রাই', 'Atrai', 48, 1),
(356, 'বাদলগাছি', 'Badalgachhi', 48, 1),
(357, 'মান্দা', 'Manda', 48, 1),
(358, 'ধামুইরহাট', 'Dhamoirhat', 48, 1),
(359, 'মহাদেবপুর', 'Mohadevpur', 48, 1),
(360, 'নওগাঁ সদর', 'Naogaon Sadar', 48, 0),
(361, 'নিয়ামতপুর', 'Niamatpur', 48, 1),
(362, 'পত্নীতলা', 'Patnitala', 48, 1),
(363, 'পোরশা', 'Porsha', 48, 1),
(364, 'রানীনগর', 'Raninagar', 48, 1),
(365, 'সাপাহার', 'Sapahar', 48, 1),
(366, 'ঝালকাঠি সদর', 'Jhalkathi Sadar', 49, 0),
(367, 'কাঠালিয়া', 'Kathalia', 49, 1),
(368, 'নালচিতি', 'Nalchity', 49, 1),
(369, 'রাজাপুর', 'Rajapur', 49, 1),
(370, 'ভূপাল', 'Bhaupal', 50, 1),
(371, 'দাশমিনা', 'Dashmina', 50, 1),
(372, 'গলাচিপা', 'Galachipa', 50, 1),
(373, 'কলাপাড়া', 'Kalapara', 50, 1),
(374, 'মির্জাগঞ্জ', 'Mirzagonj', 50, 1),
(375, 'পটুয়াখালী সদর', 'Patuakhali Sadar', 50, 1),
(376, 'রাঙ্গাবালী', 'Rangabali', 50, 1),
(377, 'দুমকি', 'Dumki', 50, 1),
(378, 'ভান্ডারিয়া', 'Bhandaria', 51, 1),
(379, 'কাওখালী', 'Kawkhali', 51, 1),
(380, 'মঠবাড়িয়া', 'Mathbaria', 51, 1),
(381, 'নাজিরপুর', 'Nazirpur', 51, 1),
(382, 'পিরোজপুর সদর', 'Pirojpur Sadar', 51, 0),
(383, 'সরুপকাটি', 'Swarupkati', 51, 1),
(384, 'জিয়ানগর', 'Zianagar', 51, 1),
(385, 'আগাইলঝারা', 'Agailjhara', 52, 0),
(386, 'বাবুগঞ্জ', 'Babuganj', 52, 1),
(387, 'বাকেরগঞ্জ', 'Bakergonj', 52, 1),
(388, 'বানারিপাড়া', 'Banaripara', 52, 1),
(389, 'গাউরনদী', 'Gaurnadi', 52, 1),
(390, 'হিজলা', 'Hizla', 52, 1),
(391, 'বরিশাল সদর', 'Barishal Sadar', 52, 0),
(392, 'মেহেদীগঞ্জ', 'Mehendiganj', 52, 1),
(393, 'মুলাদি', 'Muladi', 52, 1),
(394, 'ওয়াজিরপুর', 'Wazirpur', 52, 1),
(395, 'ভোলা সদর', 'Bhola Sadar', 53, 0),
(396, 'বুরহানুদ্দিন', 'Burhanuddin', 53, 1),
(397, 'চার ফাসন', 'Char Fasson', 53, 1),
(398, 'দৌলতখান', 'Daulatkhan', 53, 1),
(399, 'লালমোহন', 'Lalmohan', 53, 1),
(400, 'মনপুরা', 'Manpura', 53, 1),
(401, 'তাজুমুদ্দিন', 'Tazumuddin', 53, 1),
(402, 'আমতলী', 'Amtali', 54, 1),
(403, 'বামনা', 'Bamna', 54, 1),
(404, 'বরগুনা সদর', 'Barguna Sadar', 54, 0),
(405, 'বেতাগী', 'Betagi', 54, 0),
(406, 'পাহাড়ঘাটা', 'Pahatghata', 54, 1),
(407, 'তালতলী', 'Taltoli', 54, 1),
(408, 'বালাগঞ্জ', 'Balaganj', 55, 1),
(409, 'বিয়ানিবাজার', 'Beanibajar', 55, 1),
(410, 'বিশ্বনাথ', 'Biswanath', 55, 1),
(411, 'কোম্পানীগঞ্জ', 'Companigonj', 55, 0),
(412, 'ফেঞ্চুগঞ্জ', 'Fenchugonj', 55, 1),
(413, 'গোলাপগঞ্জ', 'Golapgonj', 55, 1),
(414, 'গোয়াইনঘাট', 'Gowainghat', 55, 1),
(415, 'জয়ন্তপুর', 'Jaintapur', 55, 1),
(416, 'কানাইঘাট', 'Kanaighat', 55, 1),
(417, 'সিলেট সদর', 'Sylhet Sadar', 55, 0),
(418, 'জাকিগঞ্জ', 'Zakiganj', 55, 1),
(419, 'দক্ষিন সুরমা', 'South Surma', 55, 1),
(420, 'ওসমানী নগর', 'Osmani Nagar', 55, 1),
(421, 'বরলেখা', 'Barlekha', 56, 1),
(422, 'কামালগঞ্জ', 'Kamalgonj', 56, 1),
(423, 'কুলাউড়া', 'Kulaura', 56, 1),
(424, 'মৌলভিবাজার সদর', 'Moulavibazar Sadar', 56, 0),
(425, 'রাজনগর', 'Rajnagar', 56, 1),
(426, 'শ্রীমঙ্গল', 'Sreemangal', 56, 0),
(427, 'জুরি', 'Juri', 56, 1),
(428, 'আজমিরিগঞ্জ', 'Ajmiriganj', 57, 1),
(429, 'বাহুবল', 'Bahubal', 57, 1),
(430, 'বানিয়াচং', 'Baniyachong', 57, 1),
(431, 'চুনারুঘাট', 'Chunarughat', 57, 1),
(432, 'হবিগঞ্জ সদর', 'Habiganj Sadar', 57, 1),
(433, 'লাখাই', 'Lakhai', 57, 1),
(434, 'মাধবপুর', 'Madhabpur', 57, 1),
(435, 'নবীগঞ্জ', 'Nabiganj', 57, 0),
(436, 'বিশ্বম্ভপুর', 'Biswamvabpur', 58, 1),
(437, 'ছাতক', 'Chhatak', 58, 1),
(438, 'ডেরাই', 'Derai', 58, 1),
(439, 'ধর্মপাশা', 'Dharampasha', 58, 1),
(440, 'দোয়ারাবাজার', 'Dowarabazar', 58, 1),
(441, 'জগন্নাথপুর', 'Jagannathpur', 58, 1),
(442, 'জামালগঞ্জ', 'Jamalgonj', 58, 1),
(443, 'সুল্লাহ', 'Sullah', 58, 1),
(444, 'সুনামগঞ্জ সদর', 'Sunamganj Sadar', 58, 1),
(445, 'তাহিরপুর', 'Tahirpur', 58, 1),
(446, 'দক্ষিন সুনামগঞ্জ', 'Dakshin Sunamgonj', 58, 1),
(447, 'আটোয়ারি', 'Atwari', 59, 1),
(448, 'বোদা', 'Boda', 59, 1),
(449, 'দেবীগঞ্জ', 'Debiganj', 59, 1),
(450, 'পঞ্চগড় সদর', 'Panchagarh Sadar', 59, 0),
(451, 'তেতুলিয়া', 'Tetulia', 59, 1),
(452, 'বিরামপুর', 'Birampur', 60, 1),
(453, 'বীরগঞ্জ', 'Birganj', 60, 1),
(454, 'বিরাল', 'Biral', 60, 1),
(455, 'বোচাগঞ্জ', 'Bochagonj', 60, 1),
(456, 'চিরিরবান্দর', 'Chirirbandar', 60, 1),
(457, 'ফুলবাড়ী', 'Phulbari', 60, 1),
(458, 'ঘোড়াঘাট', 'Ghoraghat', 60, 1),
(459, 'হাকিমপুর', 'Hakimpur', 60, 1),
(460, 'কাহারোল', 'Kaharole', 60, 1),
(461, 'খানসামা', 'Khansama', 60, 1),
(462, 'দিনাজপুর সদর', 'Dinajpur Sadar', 60, 0),
(463, 'নবাবগঞ্জ', 'Nawabganj', 60, 1),
(464, 'পার্বতীপুর', 'Parbatipur', 60, 1),
(465, 'অদিতমারি', 'Aditmari', 61, 1),
(466, 'হাতিবান্দা', 'Hatibanda', 61, 1),
(467, 'কালীগঞ্জ', 'Kaliganj', 61, 1),
(468, 'লালমনিরহাট সদর', 'Lalmonirhat Sadar', 61, 0),
(469, 'পাটগ্রাম', 'Patgram', 61, 1),
(470, 'ডিমলা', 'Dimla', 62, 1),
(471, 'ডোমার', 'Domar', 62, 0),
(472, 'জালঢাকা', 'Jaldhaka', 62, 1),
(473, 'কিশোরগঞ্জ', 'Kishoregonj', 62, 1),
(474, 'নীলফামারি সদর', 'Nilphamari Sadar', 62, 0),
(475, 'সৈয়দপুর', 'Saidpur', 62, 1),
(476, 'ফুলছড়ি', 'Phulchhori', 63, 1),
(477, 'গাইবান্ধা সদর', 'Gaibandha Sadar', 63, 0),
(478, 'গোবিন্দগঞ্জ', 'Gobindaganj', 63, 1),
(479, 'পলাশবাড়ী', 'Palashbari', 63, 1),
(480, 'সাদুল্লাহপুর', 'Sadullahpur', 63, 1),
(481, 'সুঘাট্টা', 'Sughatta', 63, 1),
(482, 'সুন্দরগঞ্জ', 'Sundargonj', 63, 1),
(483, 'বালিয়াডাঙ্গি', 'Baliadangi', 64, 1),
(484, 'হরিপুর', 'Haripur', 64, 1),
(485, 'পীরগঞ্জ', 'Pirganj', 64, 0),
(486, 'তারাগঞ্জ', 'Taraganj', 64, 1),
(487, 'বদরগঞ্জ', 'Badarganj', 65, 1),
(488, 'গঙ্গাছড়া', 'Gangachhara', 65, 0),
(489, 'কাউনিয়া', 'Kaunia', 65, 1),
(490, 'রংপুর সদর', 'Rangpur Sadar', 65, 0),
(491, 'মিঠাপুকুর', 'Mithapukur', 65, 1),
(492, 'পীরগাছা', 'Pirgaccha', 65, 1),
(493, 'পীরগঞ্জ', 'Pirganj', 65, 1),
(494, 'তারাগঞ্জ', 'Taragonj', 65, 1),
(495, 'ভুরুঙ্গামারী', 'Bhurungamari', 66, 1),
(496, 'চর রাজিবপুর', 'Char Rajibpur', 66, 1),
(497, 'চিলমারি', 'Chilmari', 66, 1),
(498, 'ফুলবাড়ী', 'Phulbari', 66, 1),
(499, 'কুড়িগ্রাম সদর', 'Kurigram Sadar', 66, 1),
(500, 'নাগেশ্বরী', 'Nageshwari', 66, 1),
(501, 'রাজারহাট', 'Rajarhat', 66, 1),
(502, 'রাওমারি', 'Raomari', 66, 1),
(503, 'উলিপুর', 'Ulipur', 66, 1),
(504, 'রমনা', 'Ramna Thana', 14, 0),
(505, 'আদাবর', 'Adabor Thana', 14, 0),
(506, 'বাড্ডা', 'Badda Thana', 14, 0),
(507, 'বংশাল', 'Bangsal Thana', 14, 0),
(508, 'বিমানবন্দর', 'Bimanbandar Thana', 14, 0),
(509, 'ক্যান্টনমেন্ট', 'Cantonment Thana', 14, 0),
(510, 'চকবাজার', 'Chak-Bazar Thana', 14, 0),
(511, 'দক্ষিণখান', 'Dakshinkhan Thana', 14, 0),
(512, 'দারুসসালাম', 'Darus Salam Thana', 14, 0),
(513, 'ডেমরা', 'Demra Thana', 14, 0),
(514, 'ধানমন্ডি', 'Dhanmondi Thana', 14, 0),
(515, 'গেন্ডারিয়া', 'Gendaria Thana', 14, 0),
(516, 'গুলশান', 'Gulshan Thana', 14, 0),
(517, 'হাজারীবাগ', 'Hazaribagh Thana', 14, 0),
(518, 'যাত্রাবাড়ী', 'Jatrabari Thana', 14, 0),
(519, 'কদমতলী', 'Kadamtali Thana', 14, 0),
(520, 'কাফরুল', 'Kafrul Thana', 14, 0),
(521, 'কলাবাগান', 'Kalabagan Thana', 14, 0),
(522, 'কামরাঙ্গীরচর', 'Kamrangirchar Thana', 14, 0),
(523, 'খিলগাঁও', 'Khilgaon Thana', 14, 0),
(524, 'খিলক্ষেত', 'khilkhet Thana', 14, 0),
(525, 'কতোয়ালি', 'Kotwali Thana', 14, 0),
(526, 'লালবাগ', 'Lalbagh Thana', 14, 0),
(527, 'মিরপুর', 'Mirpur Thana', 14, 0),
(528, 'মোহাম্মদপুর', 'Mohammadpur Thana', 14, 0),
(529, 'মতিজিল', 'Motijheel Thana', 14, 0),
(530, 'নিউমার্কেট', 'Newmarket Thana', 14, 0),
(531, 'পল্লবী', 'Pallabi Thana', 14, 0),
(532, 'পল্টন', 'Paltan Thana', 14, 0),
(533, 'রামপুরা', 'Rampura Thana', 14, 0),
(534, 'সবুজবাগ', 'Sabujbagh Thana', 14, 0),
(535, 'শাহ আলী', 'Shah Ali Thana', 14, 0),
(536, 'শাহবাগ', 'Shahbag Thana', 14, 0),
(537, 'শেরেবাংলা', 'Sher-e-Bangla Nagar Thana', 14, 0),
(538, 'সেয়ামপুর', 'Shyampur Thana', 14, 0),
(539, 'সুত্রাপুর', 'Sutrapur Thana', 14, 0),
(540, 'তেজগাঁও', 'Tejgaon Thana', 14, 1),
(541, 'মহাখালি', 'Mohakhali Thana', 14, 0),
(542, 'তুরাগ', 'Turag Thana', 14, 0),
(543, 'উত্তরা', 'Uttara Thana', 14, 0),
(544, 'উত্তর খান', 'Uttar Khan Thana', 14, 0),
(545, 'ঠাকুরগাঁও সদর', 'thakurgao sodor', 64, 1),
(546, 'খুলনা সদর', 'khulna sadar', 27, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `emp_id` int(11) NOT NULL,
  `role` tinyint(4) NOT NULL,
  `phone` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=active 0=blocked',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `emp_id`, `role`, `phone`, `password`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 3, 1, '01111111111', '$2y$10$LH7Y4z1949hb0933g87LtO84Nov8ZTDQvGQ7.Xly.Yse87xFR23Fy', 1, 'mTs3HZxKeS73wFEEe8O2fTaPUJiU2aeSUoF71LGNKkL7i00E02uIFhD6ofHl', '2017-03-05 01:38:50', '2017-04-17 04:53:13'),
(3, 1, 2, '01222222222', '$2y$10$LH7Y4z1949hb0933g87LtO84Nov8ZTDQvGQ7.Xly.Yse87xFR23Fy', 1, '8hFyplcpxP4XvdgNor0a5WSQpi6RNudmp3mTbkfiflw1nmkbcOXXLIKygerx', '2017-03-26 18:00:00', '2017-04-17 04:57:46'),
(4, 2, 2, '01333333333', '$2y$10$LH7Y4z1949hb0933g87LtO84Nov8ZTDQvGQ7.Xly.Yse87xFR23Fy', 1, '69188', '2017-03-26 18:00:00', '2017-04-26 05:10:42'),
(5, 4, 4, '01444444444', '$2y$10$uKKnF.LrezNptJrmxt.Wi.2PNWLUA0GoidgmZsSh93yW8vHtvy.GW', 1, '74471', '2017-03-27 18:00:00', '2017-04-17 04:53:04'),
(6, 5, 4, '01555555555', '$2y$10$zCIi34Ucx16VHtCqcNMrROaav0EoHSgUjSYx8NgdzhewckAV0JpqS', 1, '26464', '2017-04-16 18:00:00', '2017-04-26 05:08:59');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_group`
--
ALTER TABLE `account_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admission_share`
--
ALTER TABLE `admission_share`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blood_group`
--
ALTER TABLE `blood_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_account`
--
ALTER TABLE `company_account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_info`
--
ALTER TABLE `company_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `designation`
--
ALTER TABLE `designation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `district`
--
ALTER TABLE `district`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `division`
--
ALTER TABLE `division`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `education`
--
ALTER TABLE `education`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_account`
--
ALTER TABLE `employee_account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_details`
--
ALTER TABLE `employee_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `front_datas`
--
ALTER TABLE `front_datas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loan_request_list`
--
ALTER TABLE `loan_request_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meeting_notices`
--
ALTER TABLE `meeting_notices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `member_account`
--
ALTER TABLE `member_account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `member_details`
--
ALTER TABLE `member_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `member_employee_rel`
--
ALTER TABLE `member_employee_rel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `member_resignation_list`
--
ALTER TABLE `member_resignation_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `partial_withdrawal_list`
--
ALTER TABLE `partial_withdrawal_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `prokolpo`
--
ALTER TABLE `prokolpo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salary`
--
ALTER TABLE `salary`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salary_advance`
--
ALTER TABLE `salary_advance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_account_group`
--
ALTER TABLE `sub_account_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_group`
--
ALTER TABLE `sub_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction_details`
--
ALTER TABLE `transaction_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `upazilla`
--
ALTER TABLE `upazilla`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account_group`
--
ALTER TABLE `account_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `admission_share`
--
ALTER TABLE `admission_share`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `blood_group`
--
ALTER TABLE `blood_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `company_account`
--
ALTER TABLE `company_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `company_info`
--
ALTER TABLE `company_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `designation`
--
ALTER TABLE `designation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `district`
--
ALTER TABLE `district`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;
--
-- AUTO_INCREMENT for table `division`
--
ALTER TABLE `division`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `education`
--
ALTER TABLE `education`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `employee_account`
--
ALTER TABLE `employee_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `employee_details`
--
ALTER TABLE `employee_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `front_datas`
--
ALTER TABLE `front_datas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `loan_request_list`
--
ALTER TABLE `loan_request_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `meeting_notices`
--
ALTER TABLE `meeting_notices`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `member_account`
--
ALTER TABLE `member_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `member_details`
--
ALTER TABLE `member_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `member_employee_rel`
--
ALTER TABLE `member_employee_rel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `member_resignation_list`
--
ALTER TABLE `member_resignation_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `partial_withdrawal_list`
--
ALTER TABLE `partial_withdrawal_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `prokolpo`
--
ALTER TABLE `prokolpo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `salary`
--
ALTER TABLE `salary`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `salary_advance`
--
ALTER TABLE `salary_advance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `sub_account_group`
--
ALTER TABLE `sub_account_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `sub_group`
--
ALTER TABLE `sub_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `transaction_details`
--
ALTER TABLE `transaction_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `upazilla`
--
ALTER TABLE `upazilla`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=547;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
