-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 09, 2022 at 12:10 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ci_platform`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(16) DEFAULT NULL,
  `last_name` varchar(16) DEFAULT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone_number` int(11) NOT NULL,
  `avatar` varchar(2048) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `delete_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `first_name`, `last_name`, `email`, `password`, `phone_number`, `avatar`, `created_at`, `updated_at`, `delete_at`) VALUES
(1, 'admin', 'patel', 'admin@gmail.com', '123', 1234567890, 'avatar-5.jpg', '2022-11-22 03:55:27', '2022-12-04 06:24:07', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `banner`
--

CREATE TABLE `banner` (
  `banner_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(512) NOT NULL,
  `title` varchar(255) NOT NULL,
  `text` text NOT NULL DEFAULT '',
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `banner`
--

INSERT INTO `banner` (`banner_id`, `image`, `title`, `text`, `sort_order`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Grow-Trees-On-the-path-to-environment-sustainability-login.png', 'Sed ut perspiciatis unde omnis<br/>iste natus voluptatem.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 1, '2022-11-29 03:56:21', NULL, NULL),
(2, 'Grow-Trees-On-the-path-to-environment-sustainability-login.png', 'Sed ut perspiciatis unde omnis<br/>iste natus voluptatem.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 2, '2022-11-29 03:56:21', NULL, NULL),
(3, 'Grow-Trees-On-the-path-to-environment-sustainability-login.png', 'Sed ut perspiciatis unde omnis<br/>iste natus voluptatem.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 4, '2022-11-29 03:57:16', NULL, NULL),
(4, 'Grow-Trees-On-the-path-to-environment-sustainability-login.png', 'Sed ut perspiciatis unde omnis<br/>iste natus voluptatem.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 3, '2022-11-29 03:57:16', NULL, NULL),
(5, '190540107014---13-05-2022-08-15-43.jpg', 'hello kruti', 'i am kruti', 5, '2022-11-30 06:38:37', '2022-11-29 19:45:54', '2022-11-29 19:48:59');

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `city_id` bigint(20) UNSIGNED NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`city_id`, `country_id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'gujarat', '2022-11-10 04:13:08', NULL, NULL),
(2, 2, 'Toronto', '2022-11-16 03:43:00', NULL, NULL),
(3, 3, 'Melbourne', '2022-11-17 03:56:24', NULL, NULL),
(4, 4, 'Barcelona', '2022-11-17 03:56:24', NULL, NULL),
(5, 5, 'London', '2022-11-17 03:56:59', NULL, NULL),
(6, 6, 'Cape Town', '2022-11-17 03:56:59', NULL, NULL),
(7, 7, 'Paris', '2022-11-17 03:57:34', NULL, NULL),
(8, 8, 'New York', '2022-11-17 03:57:34', NULL, NULL),
(9, 3, 'Sydney', '2022-11-17 03:58:08', NULL, NULL),
(10, 9, 'Berlin', '2022-11-17 03:58:08', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cms_page`
--

CREATE TABLE `cms_page` (
  `cms_page_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL DEFAULT '',
  `description` text NOT NULL DEFAULT '',
  `slug` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cms_page`
--

INSERT INTO `cms_page` (`cms_page_id`, `title`, `description`, `slug`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Desktop publishing software like Aldus PageMaker including versions the leap into electronic typesetting.', 'dfdf', 'fvdv', '1', '2022-11-22 05:10:19', NULL, NULL),
(2, 'Various versions have evolved over the years Many desktop publishing packages and web page editors', 'fffergfdgdfgdfgdfgfg\r\nfgfgs\r\n\r\ndfghdf', '123', '1', '2022-11-22 05:10:19', NULL, NULL),
(7, 'hello', '', 'xxxfx', '1', '2022-11-26 13:16:57', '2022-11-28 05:08:14', '2022-11-28 05:08:20'),
(9, 'czxc', 'c', 'v', '1', '2022-11-28 06:03:50', NULL, NULL),
(10, 'xzcnzxk', 'xzcnzk', 'xcnkz', '1', '2022-11-28 06:04:02', NULL, NULL),
(11, 'cxzcn,', 'xcnxz,', 'cxznc,', '1', '2022-11-28 06:04:13', NULL, '2022-11-27 20:10:01'),
(12, 'zxczcm', 'c,c,vcxmv', 'cxcmxnm', '1', '2022-11-28 06:04:25', NULL, '2022-11-28 06:04:33'),
(13, 'cvxvxc', 'dsff', 'xxxfx', '1', '2022-11-28 08:10:39', NULL, NULL),
(14, 'fgfdgd', 'fdfggfdg', 'fggdg', '1', '2022-11-28 08:10:50', NULL, NULL),
(15, 'gfgd', 'gtret', 'fdf', '1', '2022-11-28 08:13:43', NULL, NULL),
(16, 'dfdfd', 'a', 'a', '1', '2022-11-28 08:13:55', NULL, NULL),
(17, 'fgfdg', 'fsdfs', 'dfsdfs', '1', '2022-11-28 08:14:07', NULL, NULL),
(18, 'vcxvxv', 'xcxcx', 'cxc', '1', '2022-11-28 08:14:22', NULL, NULL),
(19, 'xcxcx', 'xccx', 'xcxc', '1', '2022-11-28 08:14:33', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `comment_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `mission_id` bigint(20) UNSIGNED NOT NULL,
  `approval_status` enum('PENDING','PUBLISHED') NOT NULL DEFAULT 'PENDING',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `ISO` varchar(16) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`country_id`, `name`, `ISO`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'india', NULL, '2022-11-10 04:12:44', NULL, NULL),
(2, 'canada', NULL, '2022-11-17 03:43:00', NULL, NULL),
(3, 'australia', NULL, '2022-11-17 03:43:00', NULL, NULL),
(4, 'spain', NULL, '2022-11-17 03:45:23', NULL, NULL),
(5, 'the united kingdom', NULL, '2022-11-17 03:45:23', NULL, NULL),
(6, 'south africa', NULL, '2022-11-17 03:46:27', NULL, NULL),
(7, 'france', NULL, '2022-11-17 03:46:27', NULL, NULL),
(8, 'new york', NULL, '2022-11-17 03:53:21', NULL, NULL),
(9, 'germany', NULL, '2022-11-17 03:54:44', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `favourite_mission`
--

CREATE TABLE `favourite_mission` (
  `favourite_mission_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `mission_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `favourite_mission`
--

INSERT INTO `favourite_mission` (`favourite_mission_id`, `user_id`, `mission_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 29, 93, '2022-12-07 11:38:52', NULL, NULL),
(2, 61, 96, '2022-12-07 11:38:52', NULL, NULL),
(3, 29, 91, '2022-12-07 11:44:54', NULL, '2022-12-08 20:24:07'),
(4, 61, 93, '2022-12-07 11:50:48', NULL, NULL),
(5, 63, 91, '2022-12-08 04:31:33', NULL, NULL),
(6, 63, 96, '2022-12-08 04:31:33', NULL, NULL),
(7, 29, 92, '2022-12-09 08:11:21', NULL, NULL),
(8, 29, 94, '2022-12-09 08:11:29', NULL, NULL),
(11, 29, 98, '2022-12-09 08:31:13', NULL, '2022-12-08 20:31:19');

-- --------------------------------------------------------

--
-- Table structure for table `goal_mission`
--

CREATE TABLE `goal_mission` (
  `goal_mission_id` bigint(20) UNSIGNED NOT NULL,
  `mission_id` bigint(20) UNSIGNED NOT NULL,
  `goal_objective_text` varchar(255) DEFAULT NULL,
  `goal_value` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `goal_mission`
--

INSERT INTO `goal_mission` (`goal_mission_id`, `mission_id`, `goal_objective_text`, `goal_value`, `created_at`, `updated_at`, `deleted_at`) VALUES
(7, 95, 'plant 10,000 trees', 10000, '2022-12-05 12:32:51', NULL, NULL),
(8, 96, 'plant 10,000 trees', 10000, '2022-12-05 12:34:28', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mission`
--

CREATE TABLE `mission` (
  `mission_id` bigint(20) UNSIGNED NOT NULL,
  `theme_id` bigint(20) UNSIGNED NOT NULL,
  `city_id` bigint(20) UNSIGNED NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(128) NOT NULL,
  `short_description` text NOT NULL DEFAULT '',
  `description` text DEFAULT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `mission_type` enum('TIME','GOAL') NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0',
  `organization_name` varchar(255) DEFAULT NULL,
  `organization_detail` text DEFAULT NULL,
  `availability` enum('daily','weekly','week-end','monthly') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mission`
--

INSERT INTO `mission` (`mission_id`, `theme_id`, `city_id`, `country_id`, `title`, `short_description`, `description`, `start_date`, `end_date`, `mission_type`, `status`, `organization_name`, `organization_detail`, `availability`, `created_at`, `updated_at`, `deleted_at`) VALUES
(91, 1, 2, 2, 'Grow Trees – On the path to environment sustainability', 'Lorem ipsum dolor sit amet, consectetur  adipiscing elit, sed do eiusmod tempor incididunt ut labore...', NULL, '2019-01-10 17:46:59', '2019-02-25 17:47:31', 'TIME', '0', 'Tree Canada', NULL, NULL, '2022-12-05 12:20:27', NULL, NULL),
(92, 2, 3, 3, 'Education Supplies for Every Pair of Shoes Sold', 'Lorem ipsum dolor sit amet, consectetur dipiscing elit, sed do eiusmod tempor incididunt ut labore...', NULL, '2019-01-10 17:53:07', '2019-02-25 17:53:26', 'TIME', '0', 'Australian Paradise', NULL, NULL, '2022-12-05 12:24:42', NULL, NULL),
(93, 3, 4, 4, 'Nourish the Children in African country', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore...', NULL, NULL, NULL, 'TIME', '0', 'The Hunger', NULL, NULL, '2022-12-05 12:27:27', NULL, NULL),
(94, 1, 5, 5, 'CSR initiative stands for Coffee and Farmer Equity', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore...', NULL, NULL, NULL, 'TIME', '0', 'CSE Network', NULL, NULL, '2022-12-05 12:29:34', NULL, NULL),
(95, 4, 6, 6, 'Animal welfare & save birds campaign', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore...', NULL, NULL, NULL, 'GOAL', '0', 'JR Foundation', NULL, NULL, '2022-12-05 12:32:51', NULL, NULL),
(96, 5, 7, 7, 'Plantation and Afforestation program', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore...', NULL, NULL, NULL, 'GOAL', '0', 'Amaze Doctors', NULL, NULL, '2022-12-05 12:34:28', NULL, NULL),
(97, 6, 8, 8, 'Grow Trees – On the path to environment sustainability', 'Lorem ipsum dolor sit amet, consectetur  adipiscing elit, sed do eiusmod tempor incididunt ut labore...', NULL, NULL, NULL, 'TIME', '0', 'Tree Canada', NULL, NULL, '2022-12-05 12:41:40', NULL, NULL),
(98, 2, 9, 3, 'Education Supplies for Every Pair of Shoes Sold', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore...', NULL, '2019-01-10 18:12:40', '2019-02-25 18:13:01', 'TIME', '0', 'Tree Canada', NULL, NULL, '2022-12-05 12:44:12', NULL, NULL),
(99, 3, 10, 9, 'Nourish the Children in African country', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore...', NULL, NULL, NULL, 'TIME', '0', 'Junior Charity', NULL, NULL, '2022-12-05 12:46:08', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mission_application`
--

CREATE TABLE `mission_application` (
  `mission_application_id` bigint(20) UNSIGNED NOT NULL,
  `mission_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `applied_at` datetime NOT NULL,
  `approval_status` enum('PENDING','APPROVE','DECLINE') NOT NULL DEFAULT 'PENDING',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mission_application`
--

INSERT INTO `mission_application` (`mission_application_id`, `mission_id`, `user_id`, `applied_at`, `approval_status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(10, 97, 29, '2022-12-06 04:58:00', 'APPROVE', '2022-12-06 03:59:06', NULL, NULL),
(11, 92, 61, '2022-12-06 04:58:00', 'APPROVE', '2022-12-06 03:59:06', NULL, NULL),
(12, 92, 63, '2022-12-06 05:12:27', 'APPROVE', '2022-12-06 04:12:52', NULL, NULL),
(13, 93, 63, '2022-12-07 05:05:43', 'APPROVE', '2022-12-07 04:06:00', NULL, NULL),
(14, 92, 29, '2022-12-08 04:44:33', 'DECLINE', '2022-12-08 03:44:47', NULL, NULL),
(15, 93, 29, '2022-12-08 04:44:33', 'DECLINE', '2022-12-08 03:44:47', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mission_document`
--

CREATE TABLE `mission_document` (
  `mission_document_id` bigint(20) UNSIGNED NOT NULL,
  `mission_id` bigint(20) UNSIGNED NOT NULL,
  `document_name` varchar(255) NOT NULL DEFAULT '',
  `document_type` varchar(255) NOT NULL DEFAULT '',
  `document_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mission_invite`
--

CREATE TABLE `mission_invite` (
  `mission_invite_id` bigint(20) UNSIGNED NOT NULL,
  `mission_id` bigint(20) UNSIGNED NOT NULL,
  `from_user_id` bigint(20) UNSIGNED NOT NULL,
  `to_user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mission_media`
--

CREATE TABLE `mission_media` (
  `mission_media_id` bigint(20) UNSIGNED NOT NULL,
  `mission_id` bigint(20) UNSIGNED NOT NULL,
  `media_name` varchar(64) NOT NULL,
  `media_type` varchar(4) NOT NULL,
  `media_path` varchar(255) DEFAULT NULL,
  `de-fault` enum('0','1') NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `delete_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mission_media`
--

INSERT INTO `mission_media` (`mission_media_id`, `mission_id`, `media_name`, `media_type`, `media_path`, `de-fault`, `created_at`, `updated_at`, `delete_at`) VALUES
(38, 91, 'Grow-Trees-On-the-path-to-environment-sustainability.png', 'png', 'mvc/Assets/uplodes/Grow-Trees-On-the-path-to-environment-sustainability.png', '0', '2022-12-05 12:20:27', NULL, NULL),
(39, 92, 'Education-Supplies-for-Every--Pair-of-Shoes-Sold.png', 'png', 'mvc/Assets/uplodes/Education-Supplies-for-Every--Pair-of-Shoes-Sold.png', '0', '2022-12-05 12:24:42', NULL, NULL),
(40, 93, 'Nourish-the-Children-in--African-country.png', 'png', 'mvc/Assets/uplodes/Nourish-the-Children-in--African-country.png', '0', '2022-12-05 12:27:27', NULL, NULL),
(41, 94, 'CSR-initiative-stands-for-Coffee--and-Farmer-Equity.png', 'png', 'mvc/Assets/uplodes/CSR-initiative-stands-for-Coffee--and-Farmer-Equity.png', '0', '2022-12-05 12:29:34', NULL, NULL),
(42, 95, 'Animal-welfare-&-save-birds-campaign.png', 'png', 'mvc/Assets/uplodes/Animal-welfare-&-save-birds-campaign.png', '0', '2022-12-05 12:32:51', NULL, NULL),
(43, 96, 'Plantation-and-Afforestation-programme.png', 'png', 'mvc/Assets/uplodes/Plantation-and-Afforestation-programme.png', '0', '2022-12-05 12:34:28', NULL, NULL),
(44, 97, 'Grow-Trees-On-the-path-to-environment-sustainability.png', 'png', 'mvc/Assets/uplodes/Grow-Trees-On-the-path-to-environment-sustainability.png', '0', '2022-12-05 12:41:40', NULL, NULL),
(45, 98, 'Education-Supplies-for-Every--Pair-of-Shoes-Sold.png', 'png', 'mvc/Assets/uplodes/Education-Supplies-for-Every--Pair-of-Shoes-Sold.png', '0', '2022-12-05 12:44:12', NULL, NULL),
(46, 99, 'Nourish-the-Children-in--African-country.png', 'png', 'mvc/Assets/uplodes/Nourish-the-Children-in--African-country.png', '0', '2022-12-05 12:46:08', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mission_rating`
--

CREATE TABLE `mission_rating` (
  `mission_rating_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `mission_id` bigint(20) UNSIGNED NOT NULL,
  `rating` enum('1','2','3','4','5') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mission_rating`
--

INSERT INTO `mission_rating` (`mission_rating_id`, `user_id`, `mission_id`, `rating`, `created_at`, `updated_at`, `deleted_at`) VALUES
(22, 29, 91, '4', '2022-12-07 04:14:48', NULL, NULL),
(23, 61, 91, '2', '2022-12-07 04:15:26', NULL, NULL),
(24, 63, 92, '4', '2022-12-07 04:15:26', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mission_skill`
--

CREATE TABLE `mission_skill` (
  `mission_skill_id` bigint(20) UNSIGNED NOT NULL,
  `skill_id` bigint(20) UNSIGNED NOT NULL,
  `mission_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mission_theme`
--

CREATE TABLE `mission_theme` (
  `mission_theme_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mission_theme`
--

INSERT INTO `mission_theme` (`mission_theme_id`, `title`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Environment', 1, '2022-11-16 03:42:23', NULL, NULL),
(2, 'Children', 1, '2022-11-17 04:04:50', NULL, NULL),
(3, 'Nutrition', 1, '2022-11-17 04:04:50', NULL, NULL),
(4, 'Animals', 1, '2022-11-17 04:05:45', NULL, NULL),
(5, 'Health', 1, '2022-11-17 04:05:45', NULL, NULL),
(6, 'Education', 1, '2022-11-17 04:06:05', NULL, NULL),
(10, 'fdsfs', 0, '2022-11-28 05:04:26', '2022-11-28 05:04:38', '2022-11-28 05:05:55');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset`
--

CREATE TABLE `password_reset` (
  `email` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `password_reset`
--

INSERT INTO `password_reset` (`email`, `token`, `created_at`) VALUES
('190540107014@darshan.ac.in', '768e78024aa8fdb9b8fe87be86f6474521bdab017d', '0000-00-00 00:00:00'),
('bansi9315@gmail.com', '768e78024aa8fdb9b8fe87be86f647453f6f027447', '2022-11-11 09:32:30'),
('bansi9315@gmail.com', '768e78024aa8fdb9b8fe87be86f647452de026c76b', '2022-11-11 09:32:35'),
('krutipatel5773@gmail.com', '768e78024aa8fdb9b8fe87be86f6474574de95e760', '2022-11-11 09:55:08'),
('krutipatel5773@gmail.com', '768e78024aa8fdb9b8fe87be86f64745a8657d45aa', '2022-11-11 09:55:08'),
('190540107014@darshan.ac.in', '768e78024aa8fdb9b8fe87be86f647450ad0068667', '2022-11-11 09:56:15'),
('bansi9315@gmail.com', '768e78024aa8fdb9b8fe87be86f647454fecec7eee', '2022-11-11 09:57:49'),
('jenish@gmail.com', '768e78024aa8fdb9b8fe87be86f64745295e7df6ce', '2022-11-11 09:58:12'),
('190540107014@darshan.ac.in', '768e78024aa8fdb9b8fe87be86f64745aab219db78', '2022-11-11 09:58:28'),
('190540107014@darshan.ac.in', '768e78024aa8fdb9b8fe87be86f647453f3bdfddc7', '2022-11-11 09:59:05'),
('190540107014@darshan.ac.in', '768e78024aa8fdb9b8fe87be86f64745398fd20678', '2022-11-11 10:01:54'),
('190540107014@darshan.ac.in', '768e78024aa8fdb9b8fe87be86f64745a7e1c2da83', '2022-11-11 10:11:50'),
('190540107014@darshan.ac.in', '768e78024aa8fdb9b8fe87be86f647458afaf5c396', '2022-11-11 10:14:40'),
('190540107014@darshan.ac.in', '768e78024aa8fdb9b8fe87be86f647459d6129241c', '2022-11-11 10:15:51'),
('190540107014@darshan.ac.in', '768e78024aa8fdb9b8fe87be86f647456afd06976f', '2022-11-11 10:17:15'),
('190540107014@darshan.ac.in', '768e78024aa8fdb9b8fe87be86f647459301998fdd', '2022-11-11 10:18:15'),
('krutipatel5773@gmail.com', '768e78024aa8fdb9b8fe87be86f6474573bce09cfe', '2022-11-11 10:19:12'),
('190540107014@darshan.ac.in', '768e78024aa8fdb9b8fe87be86f647454187f97fc8', '2022-11-11 10:20:28'),
('190540107014@darshan.ac.in', '768e78024aa8fdb9b8fe87be86f6474558485ca589', '2022-11-11 10:24:36'),
('190540107014@darshan.ac.in', '768e78024aa8fdb9b8fe87be86f6474509019237f0', '2022-11-11 10:25:43'),
('190540107014@darshan.ac.in', '768e78024aa8fdb9b8fe87be86f64745d7acf9d2c1', '2022-11-11 10:26:17'),
('190540107014@darshan.ac.in', '768e78024aa8fdb9b8fe87be86f64745c2222ac88a', '2022-11-11 10:28:11'),
('190540107014@darshan.ac.in', '768e78024aa8fdb9b8fe87be86f64745867a716ed1', '2022-11-11 10:30:10'),
('190540107014@darshan.ac.in', '768e78024aa8fdb9b8fe87be86f64745392352a2a3', '2022-11-11 10:38:58'),
('190540107014@darshan.ac.in', '768e78024aa8fdb9b8fe87be86f64745a063c8db8d', '2022-11-11 10:39:42'),
('krutipatel5773@gmail.com', '768e78024aa8fdb9b8fe87be86f647452cf6f6d379', '2022-11-11 10:40:54'),
('krutipatel5773@gmail.com', '768e78024aa8fdb9b8fe87be86f647456c66085a71', '2022-11-11 10:41:50'),
('bansi9315@gmail.com', '768e78024aa8fdb9b8fe87be86f647451ffc1a5f77', '2022-11-11 10:42:06'),
('bansi9315@gmail.com', '768e78024aa8fdb9b8fe87be86f64745608e4a6e6d', '2022-11-11 10:42:53'),
('bansi9315@gmail.com', '768e78024aa8fdb9b8fe87be86f64745ac1b3af60b', '2022-11-11 10:46:51'),
('190540107014@darshan.ac.in', '768e78024aa8fdb9b8fe87be86f6474531e0baf6f0', '2022-11-11 10:47:45'),
('190540107014@darshan.ac.in', '768e78024aa8fdb9b8fe87be86f64745b28c92bd66', '2022-11-11 22:41:07'),
('190540107014@darshan.ac.in', '768e78024aa8fdb9b8fe87be86f647459b0496ac7b', '2022-11-11 22:42:36'),
('190540107014@darshan.ac.in', '768e78024aa8fdb9b8fe87be86f64745bc6055e76f', '2022-11-11 22:55:33'),
('bansi9315@gmail.com', '323214435454546556657', '2022-11-12 03:31:23'),
('bansi9315@gmail.com', '323214435454546556657', '2022-11-12 03:31:23'),
('bansi9315@gmail.com', '323214435454546556657', '2022-11-12 03:31:23'),
('bansi9315@gmail.com', '323214435454546556657', '2022-11-12 03:31:23'),
('bansi9315@gmail.com', '323214435454546556657', '2022-11-12 03:31:23'),
('bansi9315@gmail.com', '323214435454546556657', '2022-11-12 03:31:23'),
('bansi9315@gmail.com', '323214435454546556657', '2022-11-12 03:31:23'),
('bansi9315@gmail.com', '323214435454546556657', '2022-11-12 03:31:23'),
('krutipatel5773@gmail.com', '768e78024aa8fdb9b8fe87be86f647459b7269e356', '2022-11-12 03:47:31'),
('190540107014@darshan.ac.in', '768e78024aa8fdb9b8fe87be86f6474566f08e0960', '2022-11-14 05:00:08'),
('190540107014@darshan.ac.in', '768e78024aa8fdb9b8fe87be86f647459d8856e893', '2022-11-14 05:00:40'),
('krutipatel5773@gmail.com', '768e78024aa8fdb9b8fe87be86f6474588ace2fe15', '2022-11-14 05:03:29'),
('190540107014@darshan.ac.in', '768e78024aa8fdb9b8fe87be86f64745b977f3e4c6', '2022-11-14 06:22:49'),
('190540107014@darshan.ac.in', '768e78024aa8fdb9b8fe87be86f64745a434386e12', '2022-11-21 05:09:18'),
('krutipatel5773@gmail.com', '768e78024aa8fdb9b8fe87be86f64745b6f41f81ef', '2022-11-21 10:42:49'),
('krutipatel5773@gmail.com', '768e78024aa8fdb9b8fe87be86f64745fc2e1184e6', '2022-11-21 13:54:42'),
('krutipatel5773@gmail.com', '768e78024aa8fdb9b8fe87be86f6474543445bf0c3', '2022-11-23 04:21:02'),
('190540107014@darshan.ac.in', '768e78024aa8fdb9b8fe87be86f6474582865743f4', '2022-11-24 09:01:17'),
('krutipatel5773@gmail.com', '768e78024aa8fdb9b8fe87be86f64745f87f29173d', '2022-11-24 09:08:30'),
('190540107014@darshan.ac.in', '768e78024aa8fdb9b8fe87be86f6474576d182c9d3', '2022-11-24 09:11:14'),
('krutipatel5773@gmail.com', '768e78024aa8fdb9b8fe87be86f647451c62555ecd', '2022-11-24 09:15:28'),
('krutipatel5773@gmail.com', '768e78024aa8fdb9b8fe87be86f64745e8fc5fcf71', '2022-11-24 09:31:00'),
('bansi9315@gmail.com', '768e78024aa8fdb9b8fe87be86f6474592db2bd349', '2022-11-24 09:37:23'),
('190540107014@darshan.ac.in', '768e78024aa8fdb9b8fe87be86f64745f6e59dc7d8', '2022-11-24 10:48:58'),
('kruti@gmail.com', '768e78024aa8fdb9b8fe87be86f64745c489fea8c5', '2022-11-24 11:11:56'),
('bansi9315@gmail.com', '768e78024aa8fdb9b8fe87be86f647451409df8344', '2022-11-24 11:19:43'),
('bansi9315@gmail.com', '768e78024aa8fdb9b8fe87be86f6474593ca498e81', '2022-11-24 11:21:27'),
('190540107014@darshan.ac.in', '768e78024aa8fdb9b8fe87be86f6474595af4ebed5', '2022-11-24 11:22:37'),
('190540107014@darshan.ac.in', '768e78024aa8fdb9b8fe87be86f64745730881bfbe', '2022-11-24 11:23:46'),
('190540107014@darshan.ac.in', '768e78024aa8fdb9b8fe87be86f64745a887b51e1d', '2022-11-24 11:24:11'),
('190540107014@darshan.ac.in', '768e78024aa8fdb9b8fe87be86f6474589a73c85b0', '2022-11-24 11:24:50'),
('190540107014@darshan.ac.in', '768e78024aa8fdb9b8fe87be86f647454d1c755d68', '2022-11-24 11:26:11'),
('bansi9315@gmail.com', '768e78024aa8fdb9b8fe87be86f64745be475e0170', '2022-11-24 11:31:14'),
('bansi9315@gmail.com', '768e78024aa8fdb9b8fe87be86f64745a23a46439d', '2022-11-24 11:34:10'),
('190540107014@darshan.ac.in', '768e78024aa8fdb9b8fe87be86f64745c071ea89a5', '2022-11-24 11:34:55'),
('190540107014@darshan.ac.in', '768e78024aa8fdb9b8fe87be86f64745c8bda51323', '2022-11-24 11:48:28'),
('bansi9315@gmail.com', '768e78024aa8fdb9b8fe87be86f64745986fd1fe56', '2022-11-24 11:48:45'),
('bansi9315@gmail.com', '768e78024aa8fdb9b8fe87be86f64745ec7211172a', '2022-11-24 12:01:29'),
('190540107014@darshan.ac.in', '768e78024aa8fdb9b8fe87be86f64745182ddbc950', '2022-11-24 12:02:40'),
('190540107014@darshan.ac.in', '768e78024aa8fdb9b8fe87be86f64745d49d397d3b', '2022-11-25 11:44:31'),
('190540107014@darshan.ac.in', '768e78024aa8fdb9b8fe87be86f64745869c437787', '2022-11-28 11:06:21'),
('190540107014@darshan.ac.in', '768e78024aa8fdb9b8fe87be86f64745e9d148d393', '2022-11-28 11:10:50'),
('krutipatel5773@gmail.com', '768e78024aa8fdb9b8fe87be86f6474550fd720b8d', '2022-11-29 04:20:06');

-- --------------------------------------------------------

--
-- Table structure for table `skill`
--

CREATE TABLE `skill` (
  `skill_id` bigint(20) UNSIGNED NOT NULL,
  `skill_name` varchar(64) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `skill`
--

INSERT INTO `skill` (`skill_id`, `skill_name`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Anthropology', 1, '2022-11-18 04:07:17', NULL, NULL),
(2, 'Archeology', 1, '2022-11-18 04:07:17', NULL, NULL),
(3, 'Astronomy', 1, '2022-11-18 04:07:42', NULL, NULL),
(4, 'Computer Science', 1, '2022-11-18 04:07:42', NULL, NULL),
(5, 'Environmental Science', 1, '2022-11-18 04:08:01', NULL, NULL),
(6, 'History', 1, '2022-11-18 04:08:01', NULL, NULL),
(7, 'Library Sciences', 1, '2022-11-18 04:08:27', NULL, NULL),
(8, 'Mathematics', 1, '2022-11-18 04:08:27', NULL, NULL),
(9, 'Music Theory', 1, '2022-11-18 04:08:55', NULL, NULL),
(10, 'Research', 1, '2022-11-18 04:08:55', NULL, NULL),
(11, 'Administrative Support', 1, '2022-11-18 04:09:15', NULL, NULL),
(12, 'Customer Service', 1, '2022-11-18 04:09:15', NULL, NULL),
(13, 'Data Entry', 1, '2022-11-18 04:09:41', NULL, NULL),
(14, 'Executive Admin', 1, '2022-11-18 04:09:41', NULL, NULL),
(15, 'Office Management', 1, '2022-11-18 04:10:07', NULL, NULL),
(16, 'Office Reception', 1, '2022-11-18 04:10:07', NULL, NULL),
(17, 'Program Management', 1, '2022-11-18 04:10:27', NULL, NULL),
(18, 'Transactions', 1, '2022-11-18 04:10:27', NULL, NULL),
(19, 'Agronomy ', 1, '2022-11-18 04:10:48', NULL, NULL),
(20, 'Animal Care / Handling ', 1, '2022-11-18 04:10:48', NULL, NULL),
(21, 'Animal Therapy ', 1, '2022-11-18 04:11:03', NULL, NULL),
(22, 'Aquarium Maintenance', 1, '2022-11-18 04:11:03', NULL, NULL),
(23, 'Botany', 1, '2022-11-18 04:11:24', NULL, NULL),
(24, 'Environmental Education', 1, '2022-11-18 04:11:24', NULL, NULL),
(25, 'Environmental Policy', 1, '2022-11-18 04:11:37', NULL, NULL),
(26, 'Farming', 1, '2022-11-18 04:11:37', NULL, NULL),
(29, 'fgfgff', 1, '2022-11-28 04:44:08', NULL, '2022-11-28 04:44:16');

-- --------------------------------------------------------

--
-- Table structure for table `story`
--

CREATE TABLE `story` (
  `story_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `mission_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` enum('DRAFT','PENDING','PUBLISHED','DECLINED') NOT NULL DEFAULT 'DRAFT',
  `published_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `story_invite`
--

CREATE TABLE `story_invite` (
  `story_invite_id` bigint(20) UNSIGNED NOT NULL,
  `story_id` bigint(20) UNSIGNED NOT NULL,
  `from_user_id` bigint(20) UNSIGNED NOT NULL,
  `to_user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `story_media`
--

CREATE TABLE `story_media` (
  `story_media_id` bigint(20) UNSIGNED NOT NULL,
  `story_id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(8) NOT NULL,
  `path` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `timesheet`
--

CREATE TABLE `timesheet` (
  `timesheet_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `mission_id` bigint(20) UNSIGNED DEFAULT NULL,
  `time` time DEFAULT NULL,
  `action` int(11) DEFAULT NULL,
  `date_volunteered` datetime NOT NULL,
  `notes` text DEFAULT NULL,
  `status` enum('APPROVED','DECLINED','PENDING') NOT NULL DEFAULT 'PENDING',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `time_mission`
--

CREATE TABLE `time_mission` (
  `time_mission_id` bigint(20) UNSIGNED NOT NULL,
  `mission_id` bigint(20) UNSIGNED NOT NULL,
  `total_seat` int(11) DEFAULT NULL,
  `deadline` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `time_mission`
--

INSERT INTO `time_mission` (`time_mission_id`, `mission_id`, `total_seat`, `deadline`, `created_at`, `updated_at`, `deleted_at`) VALUES
(18, 91, 20, '2019-01-09 00:00:00', '2022-12-05 12:20:27', NULL, NULL),
(19, 92, NULL, '2019-01-09 00:00:00', '2022-12-05 12:24:42', NULL, NULL),
(20, 93, 20, '2019-01-09 00:00:00', '2022-12-05 12:27:27', NULL, NULL),
(21, 94, NULL, NULL, '2022-12-05 12:29:34', NULL, NULL),
(22, 97, NULL, NULL, '2022-12-05 12:41:40', NULL, NULL),
(23, 98, 10, '2019-01-09 00:00:00', '2022-12-05 12:44:12', NULL, NULL),
(24, 99, 20, '2022-12-30 10:37:00', '2022-12-09 05:07:17', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(16) DEFAULT NULL,
  `last_name` varchar(16) DEFAULT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone_number` int(11) NOT NULL,
  `avatar` varchar(2048) DEFAULT NULL,
  `why_i_volunteer` text DEFAULT NULL,
  `employee_id` varchar(16) DEFAULT NULL,
  `department` varchar(16) DEFAULT NULL,
  `city_id` bigint(20) UNSIGNED NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `profile_text` text DEFAULT NULL,
  `linked_in_url` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `first_name`, `last_name`, `email`, `password`, `phone_number`, `avatar`, `why_i_volunteer`, `employee_id`, `department`, `city_id`, `country_id`, `profile_text`, `linked_in_url`, `title`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(29, 'kruti', 'bhimani', '190540107014@darshan.ac.in', '123', 1234567890, 'volunteer6.png', NULL, '123324', 'HR', 3, 5, 'fdfdfd', NULL, NULL, '1', '2022-11-23 05:52:16', '2022-12-05 04:38:59', NULL),
(61, 'kruti', 'patel', 'krutipatel5773@gmail.com', '123', 1234567890, NULL, NULL, NULL, NULL, 1, 1, NULL, NULL, NULL, '1', '2022-11-29 04:18:13', NULL, NULL),
(63, 'bansi', 'patel', 'bansi9315@gmail.com', '123', 2147483647, 'volunteer9.png', NULL, NULL, NULL, 7, 5, NULL, NULL, NULL, '1', '2022-12-05 04:37:38', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_skill`
--

CREATE TABLE `user_skill` (
  `user_skill_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `skill_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`banner_id`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`city_id`),
  ADD KEY `city_ibfk_1` (`country_id`);

--
-- Indexes for table `cms_page`
--
ALTER TABLE `cms_page`
  ADD PRIMARY KEY (`cms_page_id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `mission_id` (`mission_id`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`country_id`);

--
-- Indexes for table `favourite_mission`
--
ALTER TABLE `favourite_mission`
  ADD PRIMARY KEY (`favourite_mission_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `mission_id` (`mission_id`);

--
-- Indexes for table `goal_mission`
--
ALTER TABLE `goal_mission`
  ADD PRIMARY KEY (`goal_mission_id`),
  ADD KEY `mission_id` (`mission_id`);

--
-- Indexes for table `mission`
--
ALTER TABLE `mission`
  ADD PRIMARY KEY (`mission_id`),
  ADD KEY `mission_ibfk_1` (`city_id`),
  ADD KEY `mission_ibfk_2` (`country_id`),
  ADD KEY `mission_ibfk_3` (`theme_id`);

--
-- Indexes for table `mission_application`
--
ALTER TABLE `mission_application`
  ADD PRIMARY KEY (`mission_application_id`),
  ADD KEY `mission_id` (`mission_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `mission_document`
--
ALTER TABLE `mission_document`
  ADD PRIMARY KEY (`mission_document_id`),
  ADD KEY `mission_id` (`mission_id`);

--
-- Indexes for table `mission_invite`
--
ALTER TABLE `mission_invite`
  ADD PRIMARY KEY (`mission_invite_id`),
  ADD KEY `from_user_id` (`from_user_id`),
  ADD KEY `to_user_id` (`to_user_id`),
  ADD KEY `mission_id` (`mission_id`);

--
-- Indexes for table `mission_media`
--
ALTER TABLE `mission_media`
  ADD PRIMARY KEY (`mission_media_id`),
  ADD KEY `mission_id` (`mission_id`);

--
-- Indexes for table `mission_rating`
--
ALTER TABLE `mission_rating`
  ADD PRIMARY KEY (`mission_rating_id`),
  ADD KEY `mission_id` (`mission_id`),
  ADD KEY `mission_rating_ibfk_2` (`user_id`);

--
-- Indexes for table `mission_skill`
--
ALTER TABLE `mission_skill`
  ADD PRIMARY KEY (`mission_skill_id`),
  ADD KEY `mission_id` (`mission_id`),
  ADD KEY `skill_id` (`skill_id`);

--
-- Indexes for table `mission_theme`
--
ALTER TABLE `mission_theme`
  ADD PRIMARY KEY (`mission_theme_id`);

--
-- Indexes for table `skill`
--
ALTER TABLE `skill`
  ADD PRIMARY KEY (`skill_id`);

--
-- Indexes for table `story`
--
ALTER TABLE `story`
  ADD PRIMARY KEY (`story_id`),
  ADD KEY `mission_id` (`mission_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `story_invite`
--
ALTER TABLE `story_invite`
  ADD PRIMARY KEY (`story_invite_id`),
  ADD KEY `story_id` (`story_id`),
  ADD KEY `from_user_id` (`from_user_id`),
  ADD KEY `to_user_id` (`to_user_id`);

--
-- Indexes for table `story_media`
--
ALTER TABLE `story_media`
  ADD PRIMARY KEY (`story_media_id`),
  ADD KEY `story_id` (`story_id`);

--
-- Indexes for table `timesheet`
--
ALTER TABLE `timesheet`
  ADD PRIMARY KEY (`timesheet_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `mission_id` (`mission_id`);

--
-- Indexes for table `time_mission`
--
ALTER TABLE `time_mission`
  ADD PRIMARY KEY (`time_mission_id`),
  ADD KEY `mission_id` (`mission_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `city_id` (`city_id`),
  ADD KEY `country_id` (`country_id`);

--
-- Indexes for table `user_skill`
--
ALTER TABLE `user_skill`
  ADD PRIMARY KEY (`user_skill_id`),
  ADD KEY `skill_id` (`skill_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `banner`
--
ALTER TABLE `banner`
  MODIFY `banner_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `city_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `cms_page`
--
ALTER TABLE `cms_page`
  MODIFY `cms_page_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `comment_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `country_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `favourite_mission`
--
ALTER TABLE `favourite_mission`
  MODIFY `favourite_mission_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `goal_mission`
--
ALTER TABLE `goal_mission`
  MODIFY `goal_mission_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `mission`
--
ALTER TABLE `mission`
  MODIFY `mission_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `mission_application`
--
ALTER TABLE `mission_application`
  MODIFY `mission_application_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `mission_document`
--
ALTER TABLE `mission_document`
  MODIFY `mission_document_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `mission_invite`
--
ALTER TABLE `mission_invite`
  MODIFY `mission_invite_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mission_media`
--
ALTER TABLE `mission_media`
  MODIFY `mission_media_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `mission_rating`
--
ALTER TABLE `mission_rating`
  MODIFY `mission_rating_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `mission_skill`
--
ALTER TABLE `mission_skill`
  MODIFY `mission_skill_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `mission_theme`
--
ALTER TABLE `mission_theme`
  MODIFY `mission_theme_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `skill`
--
ALTER TABLE `skill`
  MODIFY `skill_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `story`
--
ALTER TABLE `story`
  MODIFY `story_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `story_invite`
--
ALTER TABLE `story_invite`
  MODIFY `story_invite_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `story_media`
--
ALTER TABLE `story_media`
  MODIFY `story_media_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `timesheet`
--
ALTER TABLE `timesheet`
  MODIFY `timesheet_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `time_mission`
--
ALTER TABLE `time_mission`
  MODIFY `time_mission_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `user_skill`
--
ALTER TABLE `user_skill`
  MODIFY `user_skill_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `city`
--
ALTER TABLE `city`
  ADD CONSTRAINT `city_ibfk_1` FOREIGN KEY (`country_id`) REFERENCES `country` (`country_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`mission_id`) REFERENCES `mission` (`mission_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `favourite_mission`
--
ALTER TABLE `favourite_mission`
  ADD CONSTRAINT `favourite_mission_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `favourite_mission_ibfk_2` FOREIGN KEY (`mission_id`) REFERENCES `mission` (`mission_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `goal_mission`
--
ALTER TABLE `goal_mission`
  ADD CONSTRAINT `goal_mission_ibfk_1` FOREIGN KEY (`mission_id`) REFERENCES `mission` (`mission_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mission`
--
ALTER TABLE `mission`
  ADD CONSTRAINT `mission_ibfk_1` FOREIGN KEY (`city_id`) REFERENCES `city` (`city_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mission_ibfk_2` FOREIGN KEY (`country_id`) REFERENCES `country` (`country_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mission_ibfk_3` FOREIGN KEY (`theme_id`) REFERENCES `mission_theme` (`mission_theme_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mission_application`
--
ALTER TABLE `mission_application`
  ADD CONSTRAINT `mission_application_ibfk_1` FOREIGN KEY (`mission_id`) REFERENCES `mission` (`mission_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mission_application_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mission_document`
--
ALTER TABLE `mission_document`
  ADD CONSTRAINT `mission_document_ibfk_1` FOREIGN KEY (`mission_id`) REFERENCES `mission` (`mission_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mission_invite`
--
ALTER TABLE `mission_invite`
  ADD CONSTRAINT `mission_invite_ibfk_1` FOREIGN KEY (`from_user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mission_invite_ibfk_2` FOREIGN KEY (`to_user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mission_invite_ibfk_3` FOREIGN KEY (`mission_id`) REFERENCES `mission` (`mission_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mission_media`
--
ALTER TABLE `mission_media`
  ADD CONSTRAINT `mission_media_ibfk_1` FOREIGN KEY (`mission_id`) REFERENCES `mission` (`mission_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mission_rating`
--
ALTER TABLE `mission_rating`
  ADD CONSTRAINT `mission_rating_ibfk_1` FOREIGN KEY (`mission_id`) REFERENCES `mission` (`mission_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mission_rating_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mission_skill`
--
ALTER TABLE `mission_skill`
  ADD CONSTRAINT `mission_skill_ibfk_1` FOREIGN KEY (`mission_id`) REFERENCES `mission` (`mission_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mission_skill_ibfk_2` FOREIGN KEY (`skill_id`) REFERENCES `skill` (`skill_id`);

--
-- Constraints for table `story`
--
ALTER TABLE `story`
  ADD CONSTRAINT `story_ibfk_1` FOREIGN KEY (`mission_id`) REFERENCES `mission` (`mission_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `story_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `story_invite`
--
ALTER TABLE `story_invite`
  ADD CONSTRAINT `story_invite_ibfk_1` FOREIGN KEY (`story_id`) REFERENCES `story` (`story_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `story_invite_ibfk_2` FOREIGN KEY (`from_user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `story_invite_ibfk_3` FOREIGN KEY (`to_user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `story_media`
--
ALTER TABLE `story_media`
  ADD CONSTRAINT `story_media_ibfk_1` FOREIGN KEY (`story_id`) REFERENCES `story` (`story_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `timesheet`
--
ALTER TABLE `timesheet`
  ADD CONSTRAINT `timesheet_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `timesheet_ibfk_2` FOREIGN KEY (`mission_id`) REFERENCES `mission` (`mission_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `time_mission`
--
ALTER TABLE `time_mission`
  ADD CONSTRAINT `time_mission_ibfk_1` FOREIGN KEY (`mission_id`) REFERENCES `mission` (`mission_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`city_id`) REFERENCES `city` (`city_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_ibfk_2` FOREIGN KEY (`country_id`) REFERENCES `country` (`country_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_skill`
--
ALTER TABLE `user_skill`
  ADD CONSTRAINT `user_skill_ibfk_1` FOREIGN KEY (`skill_id`) REFERENCES `skill` (`skill_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_skill_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
