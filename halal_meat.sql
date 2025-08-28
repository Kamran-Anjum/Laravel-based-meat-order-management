-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 04, 2021 at 11:55 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `halal_meat`
--

-- --------------------------------------------------------

--
-- Table structure for table `assets`
--

CREATE TABLE `assets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `asset_category_id` int(11) NOT NULL,
  `asset_subcategory_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `document_no` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cost_amount` double(8,2) NOT NULL,
  `tax_amount` double(8,2) NOT NULL,
  `total_amount` double(8,2) NOT NULL,
  `status` int(11) NOT NULL,
  `is_assign` tinyint(2) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `assets`
--

INSERT INTO `assets` (`id`, `asset_category_id`, `asset_subcategory_id`, `name`, `document_no`, `cost_amount`, `tax_amount`, `total_amount`, `status`, `is_assign`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Shehzore', '3324', 233.00, 12.00, 245.00, 2, 0, 4, '2020-10-28 06:18:51', '2020-12-28 12:07:46'),
(2, 1, 3, 'Mehran', '002', 250000.00, 12500.00, 262000.00, 1, 0, 4, '2020-12-28 12:08:55', '2020-12-28 12:22:45'),
(3, 1, 4, '70cc', '3324', 20000.00, 2000.00, 22000.00, 1, 0, 4, '2020-12-28 12:23:35', '2020-12-28 12:23:35'),
(4, 1, 2, 'MERCEDEZ BEZ', 'EL54352', 400000.00, 75000.00, 475000.00, 1, 0, 4, '2021-01-05 14:21:38', '2021-01-05 14:21:38');

-- --------------------------------------------------------

--
-- Table structure for table `assets_categories`
--

CREATE TABLE `assets_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `is_active` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `assets_categories`
--

INSERT INTO `assets_categories` (`id`, `name`, `created_by`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Vehicles', 4, 1, '2020-10-28 01:52:37', '2020-10-28 02:01:28');

-- --------------------------------------------------------

--
-- Table structure for table `assets_status`
--

CREATE TABLE `assets_status` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `assets_status`
--

INSERT INTO `assets_status` (`id`, `name`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Purchased', 4, '2020-10-27 19:00:00', '2020-10-27 19:00:00'),
(2, 'Running', 4, '2020-10-27 19:00:00', '2020-10-27 19:00:00'),
(3, 'Fault(Not Running)', 4, '2020-10-27 19:00:00', '2020-10-27 19:00:00'),
(4, 'Saled', 4, '2020-10-27 19:00:00', '2020-10-27 19:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `assets_subcategories`
--

CREATE TABLE `assets_subcategories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `asset_category_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `is_active` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `assets_subcategories`
--

INSERT INTO `assets_subcategories` (`id`, `asset_category_id`, `name`, `created_by`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 1, 'Shehzore', 4, 1, '2020-10-28 02:19:12', '2020-10-28 02:35:39'),
(2, 1, 'Truck', 4, 1, '2020-10-29 00:36:38', '2020-10-29 00:36:38'),
(3, 1, 'Car', 4, 1, '2020-10-29 00:36:57', '2020-10-29 00:36:57'),
(4, 1, 'Bike', 4, 1, '2020-10-29 00:37:07', '2020-10-29 00:37:07');

-- --------------------------------------------------------

--
-- Table structure for table `assets_vehicle_details`
--

CREATE TABLE `assets_vehicle_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `asset_id` int(11) NOT NULL,
  `reg_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `engine_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `chasis_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `assets_vehicle_details`
--

INSERT INTO `assets_vehicle_details` (`id`, `asset_id`, `reg_no`, `engine_no`, `chasis_no`, `color`, `image`, `created_at`, `updated_at`) VALUES
(1, 1, 'rre-444', 'dw44', 'tr334', NULL, 'vehicle8029727.jpg', '2020-10-28 06:18:52', '2020-12-28 12:07:46'),
(2, 2, 'H-3364', 'eng-220033', 'cha-889958', NULL, 'vehicle6125395.jpg', '2020-12-28 12:08:56', '2020-12-28 12:22:45'),
(3, 3, 'AFT-225', 'eng-220033', 'cha-889958', NULL, 'vehicle1882625.jpg', '2020-12-28 12:23:35', '2020-12-28 12:23:35'),
(4, 4, 'EL54352', '12345', '12345', NULL, 'vehicle169740.png', '2021-01-05 14:21:38', '2021-01-05 14:21:38');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_by`, `created_at`, `updated_at`) VALUES
(5, 'Andre Varer', 4, '2020-12-17 05:09:37', '2021-01-26 16:17:32'),
(8, 'LAM', 4, '2021-01-04 19:50:36', '2021-01-04 19:50:36'),
(9, 'KYLLING', 4, '2021-01-04 19:50:54', '2021-01-04 19:50:54'),
(10, 'OKSE', 4, '2021-01-04 19:51:04', '2021-01-04 19:51:04'),
(11, 'SJØMAT', 4, '2021-01-06 15:53:36', '2021-01-06 15:53:36');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `states_id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_name` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `longitude` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `latitude` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `states_id`, `country_id`, `name`, `code`, `short_name`, `longitude`, `latitude`, `created_by`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Oslo', '001', 'Oslo', '55.69.45.88', '88.54.33.69', 4, 1, '2020-09-22 06:37:59', '2020-09-22 06:37:59'),
(2, 1, 1, 'Bergen', '002', 'Brg', '56.98.78', '63.25.78', 4, 1, '2020-09-22 06:45:50', '2020-09-22 06:49:40'),
(3, 1, 1, 'Stavenger', '003', 'Stv', '56.98.78', '63.25.78', 4, 1, '2020-09-22 06:45:50', '2020-09-22 06:49:40');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_name` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `longitude` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `latitude` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `is_active` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `code`, `short_name`, `longitude`, `latitude`, `created_by`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Norway', '001', 'PK', '41.25.44.63', '25.55.87.98', 4, 1, '2020-09-22 06:31:14', '2020-09-22 06:31:26'),
(2, 'Srilanka', '002', 'SRL', '22.55.66.87', '56.23.54', 4, 1, '2020-09-22 06:43:43', '2020-09-22 06:44:05');

-- --------------------------------------------------------

--
-- Table structure for table `customer_details`
--

CREATE TABLE `customer_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `fiken_cus_id` int(11) DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cell_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bio` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `organization_no` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_person_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer_details`
--

INSERT INTO `customer_details` (`id`, `user_id`, `fiken_cus_id`, `address`, `cell_no`, `profile_image`, `bio`, `organization_no`, `contact_person_name`, `created_at`, `updated_at`) VALUES
(1, 6, 1712010346, 'Office # 1-D, Building 7/C, Lane-13,', '0303-0303030', 'customer9895701.jpg', NULL, 'org-002', 'Faisal', '2020-10-12 02:50:49', '2021-01-05 13:15:58'),
(2, 7, 1703087229, 'Office # 1-D, Building 7/C, Lane-13, Bukhari Commercial, D.H.A Phase VI', '54354352394', 'customer1038441.jpg', 'adasdasdasdfads;lasjmjeioawdjlskja;s a;oiduas jdaodjaslfja\'psjf kdfjsad;fj sdlkfjsafjadf;kljsafklf;ajfkajfjflajf', '920 997', 'waha', '2020-10-12 02:53:35', '2021-02-01 06:20:20'),
(3, 8, 1712010331, 'Office # 1-D, Building 7/C', '03030303030', 'customer8930386.jpg', NULL, NULL, NULL, '2020-10-29 02:16:08', '2020-10-29 05:01:56'),
(4, 12, 1712010331, 'Office # 1-D, Building 7/C', '03155556663', 'customer9454585.jpg', NULL, 'abcd-0056', 'Faisal', '2020-10-29 02:16:08', '2020-12-24 16:23:16'),
(5, 13, NULL, 'Office # 1-D, Building 7/C', '0315-5858654', 'customer1544386.jpg', NULL, 'org-889', 'Muzammil', '2020-12-28 09:48:19', '2020-12-28 09:48:19'),
(6, 14, NULL, 'Office # 1-D, Building 7/C', '03030303030', 'customer5637187.jpg', NULL, 'org-0025', 'Muzammil', '2020-12-28 09:57:31', '2020-12-28 09:58:15'),
(7, 16, NULL, 'Office # 1-D, Building 7/C, Lane-13', '03465858587', 'customer7052272.jpg', NULL, NULL, NULL, '2020-12-28 12:15:26', '2020-12-28 12:24:28'),
(8, 17, NULL, 'Office # 1-D, Building 7/C', '0315-5656852', 'customer5525323.jpg', NULL, '002', 'Ahsan', '2020-12-29 17:56:55', '2020-12-29 17:56:55'),
(9, 18, NULL, 'Stovner Senter', '97302020', 'customer395887.jpg', NULL, '920 997 716', 'Javed Akhter', '2020-12-31 17:36:49', '2021-01-05 13:14:53'),
(10, 19, NULL, 'Pottemarkveien 4', '97302020', NULL, NULL, NULL, NULL, '2021-01-04 18:29:39', '2021-01-04 18:29:39'),
(11, 20, NULL, 'tryg lies vie 23', 'adcbjj', 'customer8456093.jpg', NULL, '920 997 716', 'Dawood', '2021-01-05 13:10:51', '2021-01-30 20:28:42'),
(12, 21, NULL, 'Maria Dehlis vei 43, 1084 Oslo', '21 38 20 38', 'customer61812.png', NULL, '917 177 899', 'Arfan', '2021-01-05 13:22:39', '2021-01-05 13:22:39'),
(13, 22, NULL, 'Skårerveien 30, 1470 Lørenskog', '97302020', 'customer1248837.jpeg', NULL, '922 920 117', 'Inayat Ullah Awan', '2021-01-05 13:28:58', '2021-01-05 13:28:58'),
(14, 23, NULL, 'Rastastubben 1, 1476, Lørenskog', '45432841', 'customer8746722.png', NULL, '925 093 114', 'Sufiyan', '2021-01-06 20:16:55', '2021-01-06 20:16:55'),
(15, 24, NULL, 'Pottemakerveien 4, 0954 Oslo', '22 25 40 06', 'customer2160369.png', NULL, '985 859 159', 'Raju', '2021-01-06 20:25:39', '2021-01-06 20:25:39');

-- --------------------------------------------------------

--
-- Table structure for table `customer_price`
--

CREATE TABLE `customer_price` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` int(11) NOT NULL,
  `price_percent` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer_price`
--

INSERT INTO `customer_price` (`id`, `role_id`, `price_percent`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 5, '10', 4, '2020-10-12 06:39:02', '2021-01-30 21:53:40'),
(2, 6, '25', 4, '2020-10-12 06:39:22', '2020-10-12 06:39:22'),
(3, 7, '35', 4, '2020-10-12 06:39:33', '2020-10-12 06:39:33'),
(4, 8, '18', 4, '2020-10-12 06:39:43', '2020-10-12 06:39:43'),
(5, 9, '38', 4, '2020-10-12 06:39:55', '2020-10-12 06:39:55');

-- --------------------------------------------------------

--
-- Table structure for table `expences`
--

CREATE TABLE `expences` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `amount` double(8,2) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expences`
--

INSERT INTO `expences` (`id`, `name`, `type`, `amount`, `image`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Taxi Fair', 3, 520.00, 'product7525707.jpg', 4, '2020-11-19 06:34:00', '2020-12-28 11:42:44'),
(2, 'Employee Salary', 2, 50000.00, 'expence6167586.jpg', 4, '2020-12-28 12:19:29', '2020-12-28 12:19:29'),
(3, 'Goods Purchase', 1, 2500.00, 'product9126875.jpg', 4, '2020-12-28 12:21:12', '2020-12-28 12:21:52');

-- --------------------------------------------------------

--
-- Table structure for table `expence_type`
--

CREATE TABLE `expence_type` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expence_type`
--

INSERT INTO `expence_type` (`id`, `name`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Purchase', 4, '2020-11-18 19:00:00', '2020-11-18 19:00:00'),
(2, 'Salary', 4, '2020-11-18 19:00:00', '2020-11-18 19:00:00'),
(3, 'Fair', 4, '2020-11-18 19:00:00', '2020-11-18 19:00:00'),
(4, 'Fuel', 4, '2020-11-18 19:00:00', '2020-11-18 19:00:00'),
(5, 'Labour', 4, '2020-11-18 19:00:00', '2020-11-18 19:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `forward_order_stock`
--

CREATE TABLE `forward_order_stock` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_detail_id` int(11) NOT NULL,
  `forward_qty` int(11) NOT NULL,
  `balance_qty` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `forward_order_stock`
--

INSERT INTO `forward_order_stock` (`id`, `order_detail_id`, `forward_qty`, `balance_qty`, `created_at`, `updated_at`) VALUES
(1, 5, 2, 0, '2020-11-03 19:00:00', '2020-11-12 04:31:22'),
(2, 6, 3, 0, '2020-11-05 02:03:16', '2020-11-13 05:50:02'),
(3, 7, 3, 0, '2020-11-05 02:03:16', '2020-11-13 05:50:02'),
(4, 4, 2, 0, '2020-11-13 06:04:11', '2020-11-26 01:18:22'),
(5, 10, 2, 0, '2020-11-14 04:32:34', '2020-11-26 01:19:50'),
(6, 11, 5, 0, '2020-11-14 04:32:34', '2020-11-26 01:19:50'),
(7, 3, 2, 0, '2020-11-26 01:17:57', '2020-11-26 01:17:57'),
(8, 18, 12, 0, '2021-01-11 14:54:04', '2021-01-11 14:54:04'),
(9, 19, 6, 0, '2021-01-11 14:54:04', '2021-01-11 14:54:04'),
(10, 12, 100, 0, '2021-01-20 18:15:14', '2021-01-20 18:15:14'),
(11, 13, 8, 0, '2021-01-20 18:15:14', '2021-01-20 18:15:14'),
(12, 8, 1, 1, '2021-01-21 15:36:34', '2021-01-21 15:36:34'),
(13, 9, 4, 0, '2021-01-21 15:36:34', '2021-01-21 15:36:34'),
(14, 14, 6, 0, '2021-01-30 21:15:47', '2021-01-30 21:15:47'),
(15, 15, 400, 0, '2021-01-30 21:15:47', '2021-01-30 21:15:47'),
(16, 20, 90, 10, '2021-01-30 21:16:50', '2021-01-30 21:16:50'),
(17, 21, 900, 100, '2021-01-30 21:16:50', '2021-01-30 21:16:50'),
(18, 22, 52, 0, '2021-01-30 21:17:28', '2021-01-30 21:17:28'),
(19, 23, 80, 0, '2021-01-30 21:17:28', '2021-01-30 21:17:28'),
(20, 28, 150, 200, '2021-01-30 22:00:07', '2021-01-30 22:00:07'),
(21, 29, 150, 350, '2021-01-30 22:00:07', '2021-01-30 22:00:07');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_09_18_072235_create_permission_tables', 2),
(5, '2020_09_21_092709_create_category_table', 3),
(6, '2020_09_21_101609_create_subcategories_table', 4),
(7, '2020_09_21_104739_create_product_table', 5),
(8, '2020_09_21_105344_create_product_detail_table', 6),
(9, '2020_09_21_114211_create_product_sub_categories_table', 7),
(10, '2020_09_22_104628_create_suppliers_table', 8),
(11, '2020_09_22_105205_create_country_table', 9),
(12, '2020_09_22_105430_create_states_table', 10),
(13, '2020_09_22_105526_create_cities_table', 11),
(14, '2020_09_22_105811_update_country_table', 12),
(15, '2020_09_22_110512_update_states_table', 13),
(16, '2020_09_22_110728_update_state_table', 14),
(17, '2020_09_22_111123_update_states_table', 15),
(18, '2020_09_22_111211_update_cities_table', 16),
(19, '2020_09_23_075138_create_supplier_products_table', 17),
(20, '2020_09_24_095247_create_purchase_order_table', 18),
(21, '2020_09_25_112004_create_purchase_order_detail_table', 19),
(22, '2020_09_25_112736_update_purchase_order_table', 20),
(23, '2020_09_29_091516_create_purchase_order_status_table', 21),
(24, '2020_09_29_091724_create_po_priority_status_table', 22),
(25, '2020_09_30_055346_create_product_stock_table', 23),
(26, '2020_09_30_060001_create_product_stock_recieve_table', 24),
(27, '2020_10_12_065643_create_customer_details_table', 25),
(28, '2020_10_12_111429_create_customer_price_table', 26),
(29, '2020_10_13_105801_create_orders_table', 27),
(30, '2020_10_13_110725_create_order_details_table', 28),
(31, '2020_10_13_112958_create_order_periority_status', 29),
(32, '2020_10_28_063155_create_assets_categories_table', 30),
(33, '2020_10_28_070637_create_assets_subcategories_table', 31),
(34, '2020_10_28_074825_create_assets_table', 32),
(35, '2020_10_28_075233_create_assets_vehicle_details_table', 33),
(36, '2020_10_28_100147_create_assets_status_table', 34),
(37, '2020_11_04_104959_create_forward_order_stock_table', 35),
(38, '2020_11_13_061726_create_order_assign_table', 36),
(39, '2020_11_19_102341_create_expences_table', 37),
(40, '2020_11_19_102450_create_expence_type_table', 38),
(41, '2020_11_23_123738_create_wp_orders_table', 39),
(42, '2020_11_23_132809_create_wp_order_details_table', 40),
(43, '2020_11_26_123547_create_wp_order_assign_table', 41),
(44, '2020_12_17_105711_create_product_unit_table', 42),
(45, '2021_02_04_065347_add_new_columnsto_orders', 43);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_permissions`
--

INSERT INTO `model_has_permissions` (`permission_id`, `model_type`, `model_id`) VALUES
(2, 'App\\Models\\User', 3);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 3),
(3, 'App\\Models\\User', 4),
(5, 'App\\Models\\User', 6),
(5, 'App\\Models\\User', 18),
(5, 'App\\Models\\User', 20),
(6, 'App\\Models\\User', 7),
(6, 'App\\Models\\User', 12),
(6, 'App\\Models\\User', 17),
(6, 'App\\Models\\User', 21),
(6, 'App\\Models\\User', 22),
(6, 'App\\Models\\User', 23),
(7, 'App\\Models\\User', 13),
(7, 'App\\Models\\User', 14),
(9, 'App\\Models\\User', 24),
(10, 'App\\Models\\User', 8),
(10, 'App\\Models\\User', 15),
(10, 'App\\Models\\User', 16),
(10, 'App\\Models\\User', 19),
(11, 'App\\Models\\User', 5),
(12, 'App\\Models\\User', 9),
(13, 'App\\Models\\User', 10),
(14, 'App\\Models\\User', 11);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `fiken_invoice_id` int(11) NOT NULL DEFAULT 0,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cell_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ship_to_address` int(11) DEFAULT NULL,
  `bill_to_address` int(11) DEFAULT NULL,
  `billing_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shipping_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount` int(11) DEFAULT NULL,
  `total_amount` double NOT NULL,
  `priority_status` int(11) NOT NULL,
  `location_status` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `is_assign` tinyint(2) NOT NULL DEFAULT 0,
  `order_note` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_status` tinyint(4) DEFAULT NULL,
  `invoice_url` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_paid` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `fiken_invoice_id`, `name`, `cell_no`, `email`, `ship_to_address`, `bill_to_address`, `billing_address`, `shipping_address`, `discount`, `total_amount`, `priority_status`, `location_status`, `status`, `is_assign`, `order_note`, `delivery_status`, `invoice_url`, `created_by`, `order_date`, `created_at`, `updated_at`, `is_paid`) VALUES
(1, 6, 1745778575, 'Tahseen Warsi', '0303202020202', 'suffyan09@gmail.com', NULL, NULL, 'From Depo', 'Office # 1-D, Building 7/C, Lane-13, Bukhari Commercial, D.H.A Phase VI, Karachi Pakistan, N 212, 1, Norway', NULL, 67348, 3, 7, 5, 0, 'asdasdasdasda sadas', 5, 'https://api.fiken.no/api/v2/files/ad2b8e09-7b42-4ba8-ae06-46c87f449816/kontantfaktura_2020_10118.pdf', 4, '2021-02-04 07:19:59', '2020-10-16 02:59:46', '2021-02-04 02:19:59', 1),
(2, 7, 1745062754, 'Muzammil Khan', '0303202020202', 'muzammilken95@gmail.com', NULL, NULL, 'From Depo', 'Office # 1-D, Building 7/C, Lane-13, Bukhari Commercial, D.H.A Phase VI, N 212, N 212, N 212, N 212, N 212, N 212, N 212, Oslo, Norway', NULL, 6134, 2, 7, 5, 0, 'adasdasda', 5, 'https://api.fiken.no/api/v2/files/e20c2702-8b3b-4e47-b06f-e8fcd269d530/kontantfaktura_2020_10055.pdf', 4, '2021-02-04 07:22:40', '2020-10-16 06:50:03', '2021-02-04 02:22:40', 1),
(3, 6, 1745778604, 'Ahsan Khan', '0303202020202', 'muzammil@gmail.com', NULL, NULL, 'From Depo', 'abcddjsuppp, Oslo, Norway', NULL, 5693, 1, 7, 5, 0, 'sdasdas', 5, 'https://api.fiken.no/api/v2/files/01ab126a-3c8b-4df0-b5ac-e0bb612552d6/kontantfaktura_2020_10119.pdf', 4, '2021-02-04 07:28:21', '2020-10-16 06:59:53', '2021-02-04 02:28:21', 1),
(4, 6, 1830945277, 'Muzammil Khan', '0303202020202', 'muzammilken95@gmail.com', NULL, NULL, 'From Depo', 'Office # 1-D, Building 7/C, Lane-13,, Oslo, Norway', NULL, 5693, 2, 7, 5, 0, 'dasasdasd', 5, 'https://api.fiken.no/api/v2/files/9024979b-f355-47c3-972c-f15dadf0d704/kontantfaktura_2020_10219.pdf', 4, '2021-02-04 07:28:53', '2020-10-19 07:02:45', '2021-02-04 02:28:53', 1),
(5, 6, 1844661271, 'Muzammil Khan', '0303202020202', 'muzammilken95@gmail.com', NULL, NULL, 'From Depo', 'Office # 1-D, Building 7/C, Lane-13, Bergen, Norway', NULL, 14132, 3, 7, 5, 0, 'dasdasda', 5, 'https://api.fiken.no/api/v2/files/8b7665f4-a6a4-47ae-892d-bacb160196b9/kontantfaktura_2020_10220.pdf', 4, '2021-01-30 17:06:06', '2020-10-19 07:06:15', '2021-01-30 22:06:06', 0),
(6, 6, 0, 'Tahseen Warsi', '0303202020202', 'suffyan09@gmail.com', NULL, NULL, 'From Depo', 'Office # 1-D, Building 7/C,, Oslo, Norway', NULL, 6583, 3, 2, 6, 0, 'safdsfsfsadfds', 6, NULL, 4, '2021-01-26 08:37:28', '2020-11-12 05:53:41', '2021-01-26 13:37:28', 0),
(7, 7, 1853382155, 'Wahaj Admed', '0303202020202', 'wahajahmed@halalmeat.com', NULL, NULL, 'From Depo', 'Office # 1-D, Building 7/C, Lane-13, Oslo, Norway', NULL, 21900, 1, 7, 5, 0, 'dasdasda', 5, 'https://api.fiken.no/api/v2/files/cb96aca3-9086-442a-9876-35aaf52c66ef/kontantfaktura_2020_10223.pdf', 7, '2021-02-03 10:32:32', '2020-11-14 04:23:24', '2021-02-03 05:32:32', 0),
(8, 6, 0, 'Catering', '0303202020202', 'categing@gmail.com', NULL, NULL, 'From Depo', 'Office # 1-D, Building 7/C, Oslo, Norway', NULL, 3272, 3, 4, 13, 0, 'XYZ', 4, NULL, 4, '2021-01-30 16:47:10', '2020-12-28 10:36:05', '2021-01-30 21:47:10', 0),
(9, 13, 0, 'catering', '0303202020202', 'categing@gmail.com', NULL, NULL, 'From Depo', 'Office # 1-D, Building 7/C,, Bergen, Norway', NULL, 12864, 3, 6, 13, 1, 'XYZ', 15, NULL, 4, '2021-01-30 17:04:23', '2020-12-28 10:41:10', '2021-01-30 22:04:23', 0),
(10, 13, 0, 'Catering', '0303202020202', 'categing@gmail.com', NULL, NULL, 'From Depo', 'Office # 1-D, Building 7/C, Lane-13, Oslo, Norway', NULL, 5250, 3, 2, 7, 0, 'XYZ', NULL, NULL, 4, '2020-12-28 06:14:13', '2020-12-28 11:13:29', '2020-12-28 11:14:13', 0),
(11, 6, 0, 'Tahseen Warsi', '0303202020202', 'suffyan09@gmail.com', NULL, NULL, 'From Depo', 'Office # 1-D, Building 7/C, Oslo, Norway', NULL, 564.34, 3, 7, 5, 0, 'XYZ', 5, NULL, 4, '2021-01-11 09:58:49', '2021-01-11 14:53:00', '2021-01-11 14:58:49', 0),
(12, 20, 0, 'Raja Waqas Ahmed', '93944477', 'im.waqasraja@gmail.com', NULL, NULL, 'From Depo', 'Henrik Sørensensvie 43, Oslo, Norway', NULL, 48600, 3, 4, 13, 0, 'xyz', 4, NULL, 20, '2021-01-30 16:48:06', '2021-01-14 12:58:45', '2021-01-30 21:48:06', 0),
(13, 20, 0, 'Raja Waqas Ahmed', '93944477', 'im.waqasraja@gmail.com', NULL, NULL, 'From Depo', 'Henrik Sørensensvie 43, Oslo, Norway', NULL, 4377.6, 1, 4, 13, 0, 'xyz', 4, NULL, 20, '2021-01-30 16:47:52', '2021-01-14 14:34:26', '2021-01-30 21:47:52', 0),
(14, 20, 0, 'Mohammad Javed J Akhtar', '97302020', 'post@kjottsentralen.no', NULL, NULL, 'From Depo', 'Pottemarkveien 4, Oslo, Norway', NULL, 37738.8, 1, 1, 1, 0, 'oi', NULL, NULL, 20, '2021-01-16 05:00:00', '2021-01-14 14:50:18', '2021-01-14 14:50:18', 0),
(15, 6, 0, 'Muzammil Khan', '0303202020202', 'muzammilken95@gmail.com', NULL, NULL, 'From Depo', 'Office # 1-D, Building 7/C,, Oslo, Norway', NULL, 345.6, 1, 2, 1, 0, NULL, NULL, NULL, 4, '2021-01-15 05:00:00', '2021-01-15 16:41:20', '2021-01-15 16:41:20', 0),
(16, 20, 0, 'Raja Waqas Ahmed', '93944477', 'im.waqasraja@gmail.com', NULL, NULL, 'From Depo', 'Henrik Sørensensvie 43, Oslo, Norway', NULL, 51300, 2, 4, 13, 0, 'xyz', 4, NULL, 20, '2021-01-30 17:02:03', '2021-01-19 15:16:58', '2021-01-30 22:02:03', 0),
(17, 20, 0, 'Raja Waqas Ahmed', '93944477', 'im.waqasraja@gmail.com', NULL, NULL, 'From Depo', 'Henrik Sørensensvie 43, Oslo, Norway', NULL, 2880, 1, 1, 1, 0, NULL, NULL, NULL, 20, '2021-01-21 05:00:00', '2021-01-20 14:10:56', '2021-01-20 14:10:56', 0),
(18, 20, 0, 'Raja Waqas Ahmed', '93944477', 'im.waqasraja@gmail.com', NULL, NULL, 'From Depo', 'Henrik Sørensensvie 43, Oslo, Norway', NULL, 264, 1, 1, 1, 0, 'Please deliver quickly :)', NULL, NULL, 20, '2021-01-21 05:00:00', '2021-01-20 17:53:56', '2021-01-20 17:53:56', 0),
(19, 20, 0, 'Raja Waqas Ahmed', '93944477', 'im.waqasraja@gmail.com', NULL, NULL, 'From Depo', 'Henrik Sørensensvie 43, Oslo, Norway', NULL, 24467.4, 1, 1, 1, 0, 'Deliver before 11am', NULL, NULL, 20, '2021-01-28 05:00:00', '2021-01-27 15:26:56', '2021-01-27 15:26:56', 0),
(20, 20, 0, 'Raja Waqas Ahmed', '93944477', 'im.waqasraja@gmail.com', NULL, NULL, 'From Depo', 'Henrik Sørensensvie 43, Oslo, Norway', NULL, 18828, 1, 1, 1, 0, NULL, NULL, NULL, 20, '2021-01-31 05:00:00', '2021-01-30 16:48:26', '2021-01-30 16:48:26', 0);

-- --------------------------------------------------------

--
-- Table structure for table `order_assign`
--

CREATE TABLE `order_assign` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` int(11) NOT NULL,
  `rider_id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_assign`
--

INSERT INTO `order_assign` (`id`, `order_id`, `rider_id`, `vehicle_id`, `created_at`, `updated_at`) VALUES
(1, 4, 8, 1, '2020-11-13 05:04:36', '2020-11-13 05:04:36'),
(2, 3, 8, 1, '2020-11-13 06:06:02', '2020-11-13 06:06:02'),
(3, 2, 8, 1, '2020-11-25 07:01:46', '2020-11-25 07:01:46'),
(4, 5, 8, 1, '2020-11-26 01:23:17', '2020-11-26 01:23:17'),
(5, 7, 8, 1, '2020-11-26 01:23:27', '2020-11-26 01:23:27'),
(6, 11, 8, 1, '2021-01-11 14:58:35', '2021-01-11 14:58:35'),
(7, 6, 19, 1, '2021-01-26 13:37:10', '2021-01-26 13:37:10'),
(8, 9, 8, 1, '2021-01-30 22:04:23', '2021-01-30 22:04:23');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `unit_price` double NOT NULL,
  `unit` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount_amount` double NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_price` double NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `unit_price`, `unit`, `discount`, `discount_amount`, `quantity`, `total_price`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 2905, 'KG', '30%', 18302, 21, 42703, 4, '2020-10-16 02:59:46', '2020-10-16 02:59:46'),
(2, 1, 2, 2900, 'KG', '15%', 4350, 10, 24650, 4, '2020-10-16 02:59:46', '2020-10-16 02:59:46'),
(3, 2, 1, 3130, 'KG', '2%', 125.2, 2, 6260, 4, '2020-10-16 06:50:03', '2020-10-16 06:50:03'),
(4, 3, 1, 2905, 'KG', '2%', 116, 2, 5694, 4, '2020-10-16 06:59:53', '2020-10-16 06:59:53'),
(5, 4, 1, 2905, 'KG', '2%', 116, 2, 5694, 4, '2020-10-16 07:02:45', '2020-10-16 07:02:45'),
(6, 5, 1, 2905, 'KG', '2%', 174, 3, 8541, 4, '2020-10-16 07:06:15', '2020-10-16 07:06:15'),
(7, 5, 2, 2900, 'KG', '3%', 261, 3, 8439, 4, '2020-10-16 07:06:15', '2020-10-16 07:06:15'),
(8, 6, 1, 2905, 'KG', '2%', 116, 2, 5694, 4, '2020-11-12 05:53:41', '2020-11-12 05:53:41'),
(9, 6, 8, 232, 'KG', '4%', 37, 4, 891, 4, '2020-11-12 05:53:41', '2020-11-12 05:53:41'),
(10, 7, 2, 3125, 'KG', '0', 0, 2, 6250, 7, '2020-11-14 04:23:24', '2020-11-14 04:23:24'),
(11, 7, 1, 3130, 'KG', '0', 0, 5, 15650, 7, '2020-11-14 04:23:24', '2020-11-14 04:23:24'),
(12, 8, 9, 32, 'Gram', '5%', 160, 100, 3040, 4, '2020-12-28 10:36:05', '2020-12-28 10:36:05'),
(13, 8, 24, 29, 'Gram', '0%', 0, 8, 232, 4, '2020-12-28 10:36:05', '2020-12-28 10:36:05'),
(14, 9, 1, 32, 'Gram', '0%', 0, 6, 192, 4, '2020-12-28 10:41:10', '2020-12-28 10:41:10'),
(15, 9, 10, 32, 'Gram', '1%', 128, 400, 12672, 4, '2020-12-28 10:41:10', '2020-12-28 10:41:10'),
(16, 10, 9, 32, 'Gram', '1%', 16, 50, 1584, 4, '2020-12-28 11:13:29', '2020-12-28 11:13:29'),
(17, 10, 13, 65, 'Kg', '6%', 234, 60, 3666, 4, '2020-12-28 11:13:29', '2020-12-28 11:13:29'),
(18, 11, 9, 28.8, 'Gram', '0%', 0, 12, 345.6, 4, '2021-01-11 14:53:00', '2021-01-11 14:53:00'),
(19, 11, 10, 37.2, 'Gram', '2%', 4.46, 6, 218.74, 4, '2021-01-11 14:53:00', '2021-01-11 14:53:00'),
(20, 12, 32, 90, 'KG', '0', 0, 100, 9000, 20, '2021-01-14 12:58:45', '2021-01-14 12:58:45'),
(21, 12, 34, 39.6, 'KG', '0', 0, 1000, 39600, 20, '2021-01-14 12:58:45', '2021-01-14 12:58:45'),
(22, 13, 9, 28.8, 'KG', '0', 0, 52, 1497.6, 20, '2021-01-14 14:34:26', '2021-01-14 14:34:26'),
(23, 13, 12, 36, 'KG', '0', 0, 80, 2880, 20, '2021-01-14 14:34:26', '2021-01-14 14:34:26'),
(24, 14, 30, 145.2, 'KG', '0', 0, 91, 13213.2, 20, '2021-01-14 14:50:18', '2021-01-14 14:50:18'),
(25, 14, 30, 145.2, 'KG', '0', 0, 78, 11325.6, 20, '2021-01-14 14:50:18', '2021-01-14 14:50:18'),
(26, 14, 31, 132, 'KG', '0', 0, 100, 13200, 20, '2021-01-14 14:50:18', '2021-01-14 14:50:18'),
(27, 15, 9, 28.8, 'Gram', '0%', 0, 12, 345.6, 4, '2021-01-15 16:41:20', '2021-01-15 16:41:20'),
(28, 16, 32, 90, 'KG', '0', 0, 350, 31500, 20, '2021-01-19 15:16:58', '2021-01-19 15:16:58'),
(29, 16, 34, 39.6, 'KG', '0', 0, 500, 19800, 20, '2021-01-19 15:16:58', '2021-01-19 15:16:58'),
(30, 17, 9, 28.8, 'KG', '0', 0, 100, 2880, 20, '2021-01-20 14:10:56', '2021-01-20 14:10:56'),
(31, 18, 31, 132, 'KG', '0', 0, 2, 264, 20, '2021-01-20 17:53:56', '2021-01-20 17:53:56'),
(32, 19, 9, 28.8, 'KG', '0', 0, 30, 864, 20, '2021-01-27 15:26:57', '2021-01-27 15:26:57'),
(33, 19, 32, 90, 'KG', '0', 0, 200, 18000, 20, '2021-01-27 15:26:57', '2021-01-27 15:26:57'),
(34, 19, 34, 39.6, 'KG', '0', 0, 50, 1980, 20, '2021-01-27 15:26:57', '2021-01-27 15:26:57'),
(35, 19, 35, 39.6, 'KG', '0', 0, 92, 3623.4, 20, '2021-01-27 15:26:57', '2021-01-27 15:26:57'),
(36, 20, 32, 90, 'KG', '0', 0, 64, 5760, 20, '2021-01-30 16:48:26', '2021-01-30 16:48:26'),
(37, 20, 30, 145.2, 'KG', '0', 0, 90, 13068, 20, '2021-01-30 16:48:26', '2021-01-30 16:48:26');

-- --------------------------------------------------------

--
-- Table structure for table `order_location_status`
--

CREATE TABLE `order_location_status` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_location_status`
--

INSERT INTO `order_location_status` (`id`, `name`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 4, '2020-10-12 19:00:00', '2020-10-12 19:00:00'),
(2, 'Production', 4, '2020-10-12 19:00:00', '2020-10-12 19:00:00'),
(3, 'Packing', 4, '2020-10-12 19:00:00', '2020-10-12 19:00:00'),
(4, 'Transport', 4, '2020-10-12 19:00:00', '2020-10-12 19:00:00'),
(5, 'Delivered', 4, '2020-10-12 19:00:00', '2020-10-12 19:00:00'),
(6, 'Rider', 4, '2020-10-12 19:00:00', '2020-10-12 19:00:00'),
(7, 'Finance', 4, '2020-10-12 19:00:00', '2020-10-12 19:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'edit', 'web', '2020-09-18 22:00:00', '2020-09-18 23:00:00'),
(2, 'all', 'web', '2020-09-18 22:00:00', '2020-09-18 23:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `po_priority_status`
--

CREATE TABLE `po_priority_status` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `po_priority_status`
--

INSERT INTO `po_priority_status` (`id`, `name`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Normal', 4, '2020-09-27 19:00:00', '2020-09-28 19:00:00'),
(2, 'Medium', 4, '2020-09-27 19:00:00', '2020-09-28 19:00:00'),
(3, 'High', 4, '2020-09-27 19:00:00', '2020-09-28 19:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fiken_product_id` int(11) DEFAULT NULL,
  `fiken_account_code` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `sku_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `base_price` double(8,2) NOT NULL,
  `unit` int(11) NOT NULL DEFAULT 0,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(800) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `fiken_product_id`, `fiken_account_code`, `category_id`, `sku_number`, `name`, `base_price`, `unit`, `image`, `description`, `created_by`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 1710000842, '3000', 1, 'tst-001-1', 'Testing', 2504.00, 2, 'product9719018.jpg', 'asdasda asdasecsa', 4, 1, '2020-09-22 01:59:52', '2020-10-01 07:10:01'),
(2, 1703153194, '3000', 1, 'abc-123', 'Test Edit', 2500.00, 2, 'product5985727.jpg', 'eddsfsdfsd', 4, 1, '2020-09-22 02:12:13', '2020-10-01 07:14:42'),
(3, 1703153176, '3000', 1, 'tst-002', 'test 2', 343.00, 2, 'product4636088.PNG', 'ewfsdfds sdf4gfh', 4, 1, '2020-09-22 02:16:05', '2020-09-22 02:16:05'),
(4, NULL, NULL, 1, 'tst-003', 'test 3', 455.00, 1, 'product6169468.jpg', 'fsfs hdaer fdsf', 4, 1, '2020-09-22 02:17:35', '2020-09-22 02:17:35'),
(5, NULL, NULL, 1, 'tst-004', 'test 4', 212.00, 2, 'product645893.jpg', 'sadasdsdsadczxcdas', 4, 1, '2020-09-22 02:19:44', '2020-09-22 02:19:44'),
(6, NULL, NULL, 1, 'tst-005', 'test 5', 221.00, 1, 'product7557487.jpg', 'sdvsd nlgjfg', 4, 1, '2020-09-22 02:31:47', '2020-09-22 02:31:47'),
(7, NULL, NULL, 1, 'tst-006', 'test 6', 300.00, 1, 'product4191425.PNG', 'sdfl;dskfa;ld aslkjdlad ;asjd', 4, 1, '2020-09-22 04:26:12', '2020-10-28 07:02:46'),
(8, 1703153177, '3020', 2, 'chk-bnl-001', 'Boneless', 200.00, 1, 'product9735592.jpg', 'dasdsad dasda', 4, 1, '2020-09-22 06:52:42', '2020-09-22 06:52:42'),
(9, NULL, NULL, 5, '1400', 'Grillpølse per pakke', 24.00, 1, 'product4399762.jpg', NULL, 4, 1, '2020-12-17 05:28:45', '2021-01-12 16:14:27'),
(10, NULL, NULL, 5, '1401', 'Wienerpølse per pakke', 31.00, 1, 'product8341778.jpeg', 'kylling 78,74%, vann 11,81%, Solsikkeolje 7,87%,', 4, 1, '2020-12-17 06:15:20', '2020-12-17 06:17:24'),
(11, NULL, NULL, 5, '1402', 'Wienerpølse per pakke', 31.00, 1, 'product7103855.jpeg', 'kylling 78,74%, vann 11,81%, Solsikkeolje 7,87%,', 4, 1, '2020-12-17 06:52:12', '2020-12-17 07:03:56'),
(12, NULL, NULL, 5, '1403', 'Skivet salami', 30.00, 2, 'product6652316.jpg', NULL, 4, 1, '2020-12-17 06:53:28', '2020-12-17 06:53:28'),
(13, NULL, NULL, 5, '1404', 'Kebab kokt', 48.00, 2, 'product162325.jpg', NULL, 4, 1, '2020-12-17 06:54:24', '2020-12-17 06:54:24'),
(14, NULL, NULL, 5, '1405', 'Salami boks 850 gr', 60.00, 1, 'product9871058.jpg', NULL, 4, 1, '2020-12-17 06:55:20', '2020-12-17 06:55:20'),
(15, NULL, NULL, 5, '1406', 'Dansk kyllingsalamipølse', 20.00, 1, 'product6321574.jpg', NULL, 4, 1, '2020-12-17 06:56:00', '2020-12-17 06:56:00'),
(16, NULL, NULL, 5, '1407', 'Sucuk', 90.00, 3, 'product4208710.jpeg', NULL, 4, 1, '2020-12-17 06:56:51', '2020-12-17 06:56:51'),
(17, NULL, NULL, 5, '1408', 'Sucuk store', 160.00, 3, 'product3855949.jpg', NULL, 4, 1, '2020-12-17 06:57:44', '2021-01-06 19:29:36'),
(18, NULL, NULL, 5, '1409', 'Hamburger Vegan', 85.00, 1, 'product4412670.jpg', NULL, 4, 1, '2020-12-17 06:58:43', '2020-12-17 07:04:57'),
(19, NULL, NULL, 5, '1410', 'Vegan Burger', 101.00, 1, 'product9826143.jpeg', 'mspinat,vegan ost panert vann,spinat ,rasp,salt,krydder,vegetabils olje,fiber,soyaprotein,fortykninsmiddelE461', 4, 1, '2020-12-17 06:59:37', '2020-12-17 07:00:58'),
(20, NULL, NULL, 5, '1411', 'Vårrull', 75.00, 2, 'product4929559.jpeg', NULL, 4, 1, '2020-12-17 07:00:23', '2020-12-17 07:04:20'),
(21, NULL, NULL, 5, '1412', 'Pak Burger', 75.00, 2, 'product9600331.jpg', NULL, 4, 1, '2020-12-17 07:02:16', '2020-12-17 07:03:24'),
(22, NULL, NULL, 5, '1413', 'Kanda Burger', 75.00, 2, 'product9801240.jpg', NULL, 4, 1, '2020-12-17 07:06:05', '2020-12-17 07:06:05'),
(23, NULL, NULL, 5, '1414', 'Okse Burger', 75.00, 2, 'product5554932.jpg', NULL, 4, 1, '2020-12-17 07:06:39', '2020-12-17 07:06:39'),
(24, NULL, NULL, 5, '1415', 'Seekh Kebab', 80.00, 2, 'product5536357.jpg', NULL, 4, 1, '2020-12-17 07:07:21', '2020-12-17 07:07:21'),
(25, NULL, NULL, 5, '1416', 'Marinate Biff for Pizza', 110.00, 2, 'product5549219.jpg', 'storfe kjøtt 73,69% ,vann 14,74%, solsikkeolje 8,84, eddik, tandoori krydder (SELLERI , SENNEP ), aroma(SELLERI,MELK), Grillkrydder, fossfat(E450 E451), hvitløkk, svartpepper', 4, 1, '2020-12-17 07:08:45', '2020-12-17 07:08:45'),
(26, NULL, NULL, 5, 'tst-002', 'Test New product', 25.00, 1, 'product7449798.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book', 4, 1, '2020-12-23 12:52:27', '2020-12-23 13:12:34'),
(27, NULL, NULL, 1, 'nw-101', 'New Product', 27.00, 1, 'product6893625.jpg', 'Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero\'s De Finibus Bonorum et Malorum for use in a type specimen book', 4, 1, '2020-12-24 11:42:30', '2020-12-24 11:44:15'),
(28, NULL, NULL, 10, '1108', 'Lårtunge', 110.00, 2, 'product9108019.jpg', 'Halal', 4, 1, '2021-01-04 20:18:04', '2021-01-04 20:30:41'),
(29, NULL, NULL, 10, '1100', 'Flatt Biff', 179.00, 2, 'product3909904.jpeg', 'Import product', 4, 0, '2021-01-04 20:19:31', '2021-01-05 13:42:06'),
(30, NULL, NULL, 10, '1100', 'FLATTBIFF IMPORT', 121.00, 2, 'product8866765.jpeg', 'Import Produckt', 4, 1, '2021-01-04 20:20:39', '2021-01-07 14:39:54'),
(31, NULL, NULL, 10, '1106', 'RUNDBIFF', 110.00, 2, 'product7233119.png', 'Rund biff import quality', 4, 1, '2021-01-04 20:26:30', '2021-01-04 20:26:30'),
(32, NULL, NULL, 8, '1214', 'HEL LAM', 75.00, 2, 'product5147871.jpg', 'HEL LAM Karkus', 4, 1, '2021-01-05 14:11:13', '2021-01-05 14:11:13'),
(33, NULL, NULL, 5, 'tst-001-2', 'Testing', 25.00, 1, 'product1593341.jpg', 'XYZ', 4, 1, '2021-01-06 17:57:27', '2021-01-06 19:30:24'),
(34, NULL, NULL, 9, '1001', 'HEL KYLLING 1300Gram', 33.00, 2, 'product9043219.jpg', 'Hel Kylling med skinn og bein', 4, 1, '2021-01-06 18:23:11', '2021-01-14 13:11:49'),
(35, NULL, NULL, 9, '1002', 'HEL KYLLING 825Gram', 33.00, 2, 'product6527109.jpg', NULL, 4, 1, '2021-01-06 19:08:33', '2021-01-06 19:08:33'),
(36, NULL, NULL, 9, '1003', 'HEL KYLLING 975Gram', 33.00, 2, 'product1504892.jpg', 'Hel Kylling med skinn og bein. Vekt er 975gram.', 4, 1, '2021-01-06 19:10:05', '2021-01-06 19:10:05'),
(37, NULL, NULL, 9, '1004', 'Hel Kylling Marinert', 36.00, 2, 'product7723162.jpg', 'Hel kylling med skin og bein. Marinert med kryder og olije', 4, 1, '2021-01-06 19:12:56', '2021-01-06 19:12:56'),
(38, NULL, NULL, 9, '1005', 'HEL KYLLING U/S M/B', 36.00, 2, NULL, 'Hel kylling med bein og uten skinn.', 4, 1, '2021-01-06 19:56:37', '2021-01-06 19:56:37'),
(39, NULL, NULL, 9, '1006', 'HØNS', 27.00, 2, 'product5697455.jpg', 'Hel høns med skinn og bein.', 4, 1, '2021-01-06 19:59:26', '2021-01-06 19:59:26'),
(40, NULL, NULL, 10, '1113', 'OKSE KJØTTDEIG', 81.00, 2, '', 'Minced kjøtt', 4, 1, '2021-01-07 14:54:41', '2021-01-12 13:50:28'),
(41, NULL, NULL, 5, 'tst-001-1', 'Testing 2', 31.10, 1, NULL, 'XYZ', 4, 1, '2021-01-12 14:01:58', '2021-01-12 14:01:58'),
(42, NULL, NULL, 9, '1100', 'KYLLING LÅR M/S M/B', 31.50, 2, NULL, 'vby', 4, 1, '2021-01-12 14:15:11', '2021-01-12 14:15:11');

-- --------------------------------------------------------

--
-- Table structure for table `product_details`
--

CREATE TABLE `product_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `gallery_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_details`
--

INSERT INTO `product_details` (`id`, `product_id`, `gallery_image`, `created_at`, `updated_at`) VALUES
(1, 1, 'product_gallery7496106.jpg', '2020-09-22 02:57:46', '2020-09-22 02:57:46'),
(2, 1, 'product_gallery689499.jpg', '2020-09-22 02:57:55', '2020-09-22 02:57:55'),
(3, 7, 'product_gallery6416048.jpg', '2020-09-22 04:26:13', '2020-09-22 04:26:13'),
(5, 8, 'product_gallery1529454.jpg', '2020-09-22 06:52:42', '2020-09-22 06:52:42'),
(6, 8, 'product_gallery451095.jpg', '2020-09-22 06:52:43', '2020-09-22 06:52:43'),
(7, 1, 'product_gallery168813.jpg', '2020-10-01 07:08:33', '2020-10-01 07:08:33'),
(8, 1, 'product_gallery188504.jpg', '2020-10-01 07:09:00', '2020-10-01 07:09:00'),
(9, 2, 'product_gallery6756463.jpg', '2020-10-01 07:14:42', '2020-10-01 07:14:42'),
(10, 2, 'product_gallery4272222.PNG', '2020-10-01 07:14:43', '2020-10-01 07:14:43'),
(11, 9, 'product_gallery4892523.jpg', '2020-12-17 05:28:46', '2020-12-17 05:28:46'),
(12, 10, 'product_gallery935331.jpeg', '2020-12-17 06:15:21', '2020-12-17 06:15:21'),
(13, 11, 'product_gallery5554089.jpeg', '2020-12-17 06:52:12', '2020-12-17 06:52:12'),
(14, 12, 'product_gallery1726125.jpg', '2020-12-17 06:53:28', '2020-12-17 06:53:28'),
(15, 13, 'product_gallery3732554.jpg', '2020-12-17 06:54:24', '2020-12-17 06:54:24'),
(16, 14, 'product_gallery5162791.jpg', '2020-12-17 06:55:21', '2020-12-17 06:55:21'),
(17, 15, 'product_gallery1904296.jpg', '2020-12-17 06:56:00', '2020-12-17 06:56:00'),
(18, 16, 'product_gallery2783112.jpeg', '2020-12-17 06:56:51', '2020-12-17 06:56:51'),
(19, 17, 'product_gallery93337.jpg', '2020-12-17 06:57:45', '2020-12-17 06:57:45'),
(20, 18, 'product_gallery973425.jpg', '2020-12-17 06:58:43', '2020-12-17 06:58:43'),
(21, 19, 'product_gallery1382250.jpeg', '2020-12-17 06:59:37', '2020-12-17 06:59:37'),
(22, 20, 'product_gallery3064597.jpeg', '2020-12-17 07:00:23', '2020-12-17 07:00:23'),
(23, 21, 'product_gallery8125308.jpg', '2020-12-17 07:02:17', '2020-12-17 07:02:17'),
(24, 22, 'product_gallery1355121.jpg', '2020-12-17 07:06:05', '2020-12-17 07:06:05'),
(25, 23, 'product_gallery6242739.jpg', '2020-12-17 07:06:39', '2020-12-17 07:06:39'),
(26, 24, 'product_gallery7742607.jpg', '2020-12-17 07:07:21', '2020-12-17 07:07:21'),
(27, 25, 'product_gallery8922986.jpg', '2020-12-17 07:08:46', '2020-12-17 07:08:46'),
(28, 26, 'product_gallery5285758.jpg', '2020-12-23 12:52:27', '2020-12-23 12:52:27'),
(29, 26, 'product_gallery8273881.jpg', '2020-12-23 12:52:28', '2020-12-23 12:52:28'),
(30, 26, 'product_gallery8123576.jpeg', '2020-12-23 12:52:28', '2020-12-23 12:52:28'),
(31, 27, 'product_gallery1636051.jpg', '2020-12-24 11:42:31', '2020-12-24 11:42:31'),
(32, 27, 'product_gallery6507075.jpg', '2020-12-24 11:42:33', '2020-12-24 11:42:33'),
(33, 27, 'product_gallery9086536.jpg', '2020-12-24 11:42:33', '2020-12-24 11:42:33'),
(34, 34, 'product_gallery4492055.jpg', '2021-01-06 18:59:41', '2021-01-06 18:59:41');

-- --------------------------------------------------------

--
-- Table structure for table `product_stocks`
--

CREATE TABLE `product_stocks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `recieve_qty` int(11) NOT NULL,
  `sale_qty` int(11) NOT NULL,
  `balanced_qty` int(11) NOT NULL,
  `unit` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_stocks`
--

INSERT INTO `product_stocks` (`id`, `product_id`, `recieve_qty`, `sale_qty`, `balanced_qty`, `unit`, `created_at`, `updated_at`) VALUES
(1, 8, 63, 4, 59, 'KG', '2020-09-29 19:00:00', '2021-01-12 13:45:56'),
(2, 1, 75, 15, 60, 'KG', '2020-09-30 02:41:13', '2021-01-26 13:34:31'),
(3, 2, 507, 5, 502, 'KG', '2020-09-30 02:41:13', '2021-01-26 13:34:31'),
(4, 3, 0, 0, 0, 'KG', '2020-09-30 02:41:13', '2020-10-09 06:51:27'),
(5, 4, 0, 0, 0, 'KG', '2020-09-30 02:41:13', '2020-10-09 06:51:27'),
(6, 5, 0, 0, 0, 'KG', '2020-09-30 02:41:13', '2020-10-09 06:51:27'),
(7, 6, 0, 0, 0, 'KG', '2020-09-30 02:41:13', '2020-10-09 06:51:27'),
(8, 7, 0, 0, 0, 'KG', '2020-09-30 02:41:13', '2020-10-09 06:51:27'),
(9, 9, 0, 356, -356, NULL, '2020-12-17 05:28:45', '2021-01-27 15:26:57'),
(10, 10, 0, 406, -406, NULL, '2020-12-17 06:15:20', '2021-01-11 14:53:00'),
(11, 11, 0, 0, 0, NULL, '2020-12-17 06:52:12', '2020-12-17 06:52:12'),
(12, 12, 0, 80, -80, NULL, '2020-12-17 06:53:28', '2021-01-14 14:34:26'),
(13, 13, 0, 60, -60, NULL, '2020-12-17 06:54:24', '2020-12-28 11:13:29'),
(14, 14, 0, 0, 0, NULL, '2020-12-17 06:55:20', '2020-12-17 06:55:20'),
(15, 15, 0, 0, 0, NULL, '2020-12-17 06:56:00', '2020-12-17 06:56:00'),
(16, 16, 0, 0, 0, NULL, '2020-12-17 06:56:51', '2020-12-17 06:56:51'),
(17, 17, 0, 0, 0, NULL, '2020-12-17 06:57:44', '2020-12-17 06:57:44'),
(18, 18, 0, 0, 0, NULL, '2020-12-17 06:58:43', '2020-12-17 06:58:43'),
(19, 19, 0, 0, 0, NULL, '2020-12-17 06:59:37', '2020-12-17 06:59:37'),
(20, 20, 0, 0, 0, NULL, '2020-12-17 07:00:23', '2020-12-17 07:00:23'),
(21, 21, 0, 0, 0, NULL, '2020-12-17 07:02:16', '2020-12-17 07:02:16'),
(22, 22, 0, 0, 0, NULL, '2020-12-17 07:06:05', '2020-12-17 07:06:05'),
(23, 23, 0, 0, 0, NULL, '2020-12-17 07:06:39', '2020-12-17 07:06:39'),
(24, 24, 0, 8, -8, NULL, '2020-12-17 07:07:21', '2020-12-28 10:36:05'),
(25, 25, 800, 0, 800, NULL, '2020-12-17 07:08:45', '2020-12-23 13:24:53'),
(26, 26, 650, 0, 650, NULL, '2020-12-23 12:52:27', '2020-12-23 13:24:53'),
(27, 27, 700, 0, 700, NULL, '2020-12-24 11:42:30', '2020-12-24 12:02:54'),
(28, 28, 0, 0, 0, NULL, '2021-01-04 20:18:04', '2021-01-04 20:18:04'),
(29, 29, 0, 0, 0, NULL, '2021-01-04 20:19:31', '2021-01-04 20:19:31'),
(30, 30, 0, 259, -259, NULL, '2021-01-04 20:20:39', '2021-01-30 16:48:26'),
(31, 31, 600, 102, 498, NULL, '2021-01-04 20:26:30', '2021-01-30 17:49:49'),
(32, 32, 500, 714, -214, NULL, '2021-01-05 14:11:13', '2021-01-30 16:48:26'),
(33, 33, 0, 0, 0, NULL, '2021-01-06 17:57:27', '2021-01-06 17:57:27'),
(34, 34, 0, 1550, -1550, NULL, '2021-01-06 18:23:11', '2021-01-27 15:26:57'),
(35, 35, 0, 92, -92, NULL, '2021-01-06 19:08:33', '2021-01-27 15:26:57'),
(36, 36, 0, 0, 0, NULL, '2021-01-06 19:10:05', '2021-01-06 19:10:05'),
(37, 37, 0, 0, 0, NULL, '2021-01-06 19:12:56', '2021-01-06 19:12:56'),
(38, 38, 0, 0, 0, NULL, '2021-01-06 19:56:37', '2021-01-06 19:56:37'),
(39, 39, 0, 0, 0, NULL, '2021-01-06 19:59:26', '2021-01-06 19:59:26'),
(40, 40, 0, 0, 0, NULL, '2021-01-07 14:54:41', '2021-01-07 14:54:41'),
(41, 41, 0, 0, 0, NULL, '2021-01-12 14:01:58', '2021-01-12 14:01:58'),
(42, 42, 0, 0, 0, NULL, '2021-01-12 14:15:11', '2021-01-12 14:15:11');

-- --------------------------------------------------------

--
-- Table structure for table `product_stock_recieves`
--

CREATE TABLE `product_stock_recieves` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `po_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `recieve_qty` int(11) NOT NULL,
  `recieved_by` int(11) NOT NULL,
  `rec_status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_sub_categories`
--

CREATE TABLE `product_sub_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `subcategory_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_sub_categories`
--

INSERT INTO `product_sub_categories` (`id`, `product_id`, `subcategory_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2020-09-22 01:59:52', '2020-09-22 01:59:52'),
(2, 1, 2, '2020-09-22 01:59:52', '2020-09-22 01:59:52'),
(3, 2, 1, '2020-09-22 02:12:13', '2020-09-22 02:12:13'),
(4, 2, 2, '2020-09-22 02:12:13', '2020-09-22 02:12:13'),
(5, 3, 1, '2020-09-22 02:16:05', '2020-09-22 02:16:05'),
(6, 3, 2, '2020-09-22 02:16:05', '2020-09-22 02:16:05'),
(7, 4, 1, '2020-09-22 02:17:35', '2020-09-22 02:17:35'),
(8, 4, 2, '2020-09-22 02:17:35', '2020-09-22 02:17:35'),
(9, 7, 1, '2020-09-22 04:26:13', '2020-09-22 04:26:13'),
(10, 7, 2, '2020-09-22 04:26:13', '2020-09-22 04:26:13'),
(11, 8, 3, '2020-09-22 06:52:42', '2020-09-22 06:52:42'),
(13, 1, 3, '2020-10-01 07:08:33', '2020-10-01 07:08:33'),
(15, 1, 3, '2020-10-01 07:09:00', '2020-10-01 07:09:00'),
(17, 1, 3, '2020-10-01 07:10:01', '2020-10-01 07:10:01'),
(19, 2, 3, '2020-10-01 07:14:43', '2020-10-01 07:14:43'),
(20, 7, 2, '2020-10-28 07:02:38', '2020-10-28 07:02:38'),
(21, 7, 2, '2020-10-28 07:02:46', '2020-10-28 07:02:46'),
(22, 9, 4, '2020-12-17 05:28:45', '2020-12-17 05:28:45'),
(23, 10, 4, '2020-12-17 06:15:20', '2020-12-17 06:15:20'),
(24, 10, 4, '2020-12-17 06:17:24', '2020-12-17 06:17:24'),
(25, 11, 4, '2020-12-17 06:52:12', '2020-12-17 06:52:12'),
(26, 12, 5, '2020-12-17 06:53:28', '2020-12-17 06:53:28'),
(27, 13, 6, '2020-12-17 06:54:24', '2020-12-17 06:54:24'),
(28, 14, 5, '2020-12-17 06:55:20', '2020-12-17 06:55:20'),
(29, 15, 4, '2020-12-17 06:56:00', '2020-12-17 06:56:00'),
(30, 16, 4, '2020-12-17 06:56:51', '2020-12-17 06:56:51'),
(32, 18, 7, '2020-12-17 06:58:43', '2020-12-17 06:58:43'),
(33, 19, 7, '2020-12-17 06:59:37', '2020-12-17 06:59:37'),
(34, 20, 8, '2020-12-17 07:00:23', '2020-12-17 07:00:23'),
(35, 19, 7, '2020-12-17 07:00:58', '2020-12-17 07:00:58'),
(36, 21, 7, '2020-12-17 07:02:16', '2020-12-17 07:02:16'),
(37, 21, 7, '2020-12-17 07:03:24', '2020-12-17 07:03:24'),
(38, 11, 4, '2020-12-17 07:03:56', '2020-12-17 07:03:56'),
(39, 20, 8, '2020-12-17 07:04:20', '2020-12-17 07:04:20'),
(40, 18, 7, '2020-12-17 07:04:57', '2020-12-17 07:04:57'),
(41, 22, 7, '2020-12-17 07:06:05', '2020-12-17 07:06:05'),
(42, 23, 7, '2020-12-17 07:06:39', '2020-12-17 07:06:39'),
(43, 24, 6, '2020-12-17 07:07:21', '2020-12-17 07:07:21'),
(44, 25, 9, '2020-12-17 07:08:45', '2020-12-17 07:08:45'),
(47, 26, 4, '2020-12-23 13:12:34', '2020-12-23 13:12:34'),
(48, 27, 11, '2020-12-24 11:42:30', '2020-12-24 11:42:30'),
(49, 27, 3, '2020-12-24 11:44:15', '2020-12-24 11:44:15'),
(50, 27, 11, '2020-12-24 11:44:15', '2020-12-24 11:44:15'),
(51, 30, 12, '2021-01-04 20:20:39', '2021-01-04 20:20:39'),
(52, 31, 14, '2021-01-04 20:26:30', '2021-01-04 20:26:30'),
(53, 32, 31, '2021-01-05 14:11:13', '2021-01-05 14:11:13'),
(56, 35, 35, '2021-01-06 19:08:33', '2021-01-06 19:08:33'),
(57, 36, 36, '2021-01-06 19:10:05', '2021-01-06 19:10:05'),
(58, 37, 37, '2021-01-06 19:12:56', '2021-01-06 19:12:56'),
(59, 17, 5, '2021-01-06 19:29:36', '2021-01-06 19:29:36'),
(62, 33, 7, '2021-01-06 19:30:24', '2021-01-06 19:30:24'),
(64, 38, 38, '2021-01-06 19:56:37', '2021-01-06 19:56:37'),
(65, 39, 39, '2021-01-06 19:59:26', '2021-01-06 19:59:26'),
(66, 30, 12, '2021-01-07 14:39:54', '2021-01-07 14:39:54'),
(67, 40, 18, '2021-01-07 14:54:41', '2021-01-07 14:54:41'),
(68, 40, 18, '2021-01-12 13:50:28', '2021-01-12 13:50:28'),
(69, 41, 4, '2021-01-12 14:01:58', '2021-01-12 14:01:58'),
(70, 42, 45, '2021-01-12 14:15:11', '2021-01-12 14:15:11'),
(71, 9, 4, '2021-01-12 16:14:27', '2021-01-12 16:14:27'),
(72, 34, 34, '2021-01-14 13:11:49', '2021-01-14 13:11:49');

-- --------------------------------------------------------

--
-- Table structure for table `product_unit`
--

CREATE TABLE `product_unit` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_unit`
--

INSERT INTO `product_unit` (`id`, `name`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Gram', 4, '2020-12-16 19:00:00', '2020-12-16 19:00:00'),
(2, 'Kg', 4, '2020-12-16 19:00:00', '2020-12-16 19:00:00'),
(3, 'Stick', 4, '2020-12-16 19:00:00', '2020-12-16 19:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order`
--

CREATE TABLE `purchase_order` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `total_amount` double(8,2) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `order_note` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `recieve_note` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(2) NOT NULL,
  `pr_status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase_order`
--

INSERT INTO `purchase_order` (`id`, `supplier_id`, `total_amount`, `created_by`, `updated_by`, `order_note`, `recieve_note`, `status`, `pr_status`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 4, NULL, 'dasdassdsa', NULL, 4, 1, '2020-09-25 07:04:43', '2020-09-25 07:04:43'),
(2, 1, 319.00, 4, 4, 'dasdassdsa', NULL, 2, 2, '2020-09-25 07:05:14', '2020-09-30 02:43:47'),
(3, 1, 1360.00, 4, 4, 'For testing Purpose', NULL, 3, 3, '2020-09-25 07:18:11', '2020-09-30 07:09:09'),
(4, 1, 669.00, 4, 4, 'sadad', 'dasdasdas', 2, 2, '2020-10-02 05:27:03', '2020-10-20 04:40:11'),
(6, 1, 7140.00, 4, 4, 'dasfdsf fg', 'dfgdfggdfsf', 2, 3, '2020-10-19 04:57:27', '2020-10-19 06:51:27'),
(7, 1, 8561.00, 4, 4, 'rsdfdh klhdv', 'dasdasdsdasd', 2, 3, '2020-10-05 06:19:07', '2020-10-20 04:40:42'),
(8, 1, 11412.00, 4, 4, 'DASDASDASD sdfdsf', 'dsxsffghbcxzcre bn', 2, 2, '2020-10-19 01:53:32', '2020-10-20 04:41:14'),
(9, 1, 10200.00, 4, 9, 'sadasdasdsadas', 'sdfasfdsa htsdfwer bfafdfa', 2, 2, '2020-11-05 05:17:04', '2020-11-05 05:24:47'),
(10, 1, 0.00, 4, 9, 'asdasdasd', 'Test edit product received quantity is 470kg', 3, 3, '2020-11-05 05:43:06', '2021-01-26 13:34:31'),
(11, 1, 0.00, 4, 4, 'gdfgdrsgdfg', NULL, 2, 2, '2020-11-12 05:56:22', '2021-01-12 13:45:56'),
(12, 3, 31250.00, 4, 4, 'XYZ', 'XYZ', 3, 2, '2020-12-23 13:21:47', '2020-12-23 13:24:53'),
(13, 4, 17500.00, 4, 4, 'XYZ', 'XYZ', 2, 3, '2020-12-24 11:58:06', '2020-12-24 12:02:54'),
(14, 5, 34000.00, 4, 4, 'Orderd', NULL, 2, 2, '2021-01-07 14:57:02', '2021-01-07 15:00:08'),
(15, 5, 0.00, 4, 4, 'xyz', NULL, 2, 2, '2021-01-30 17:45:41', '2021-01-30 17:49:49');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order_detail`
--

CREATE TABLE `purchase_order_detail` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `p_order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `price` double(8,2) DEFAULT NULL,
  `demand_quantity` int(11) NOT NULL,
  `recieved_quantity` int(11) DEFAULT NULL,
  `total_amount` double(8,2) DEFAULT NULL,
  `recieved_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase_order_detail`
--

INSERT INTO `purchase_order_detail` (`id`, `p_order_id`, `product_id`, `price`, `demand_quantity`, `recieved_quantity`, `total_amount`, `recieved_by`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 33.00, 3, 3, 99.00, 4, '2020-09-25 07:05:14', '2020-09-30 02:43:47'),
(2, 2, 2, 44.00, 4, 4, 176.00, 4, '2020-09-25 07:05:14', '2020-09-30 02:43:47'),
(3, 2, 8, 44.00, 1, 1, 44.00, 4, '2020-09-25 07:05:14', '2020-09-30 02:43:47'),
(4, 3, 1, 250.00, 2, 2, 500.00, 4, '2020-09-25 07:18:11', '2020-09-30 07:09:10'),
(5, 3, 2, 330.00, 3, 2, 660.00, 4, '2020-09-25 07:18:11', '2020-09-30 07:09:10'),
(6, 3, 8, 200.00, 1, 1, 200.00, 4, '2020-09-25 07:18:11', '2020-09-30 07:09:10'),
(7, 4, 1, 223.00, 3, 3, 669.00, 4, '2020-10-02 05:27:03', '2020-10-20 04:40:11'),
(12, 7, 1, 233.00, 3, 3, 699.00, 4, '2020-10-05 06:19:07', '2020-10-20 04:40:42'),
(13, 7, 2, 212.00, 4, 4, 848.00, 4, '2020-10-05 06:19:07', '2020-10-20 04:40:42'),
(17, 7, 8, 334.00, 21, 21, 7014.00, 4, '2020-10-06 02:24:15', '2020-10-20 04:40:42'),
(18, 8, 1, 250.00, 30, 30, 7500.00, 4, '2020-10-07 01:53:32', '2020-10-20 04:41:14'),
(26, 8, 8, 22.00, 21, 21, 462.00, 4, '2020-10-08 02:00:33', '2020-10-20 04:41:14'),
(27, 8, 2, 345.00, 10, 10, 3450.00, 4, '2020-10-08 02:02:24', '2020-10-20 04:41:14'),
(28, 6, 1, 234.00, 22, 22, 5148.00, 4, '2020-10-09 00:43:46', '2020-10-09 06:51:27'),
(34, 6, 8, 223.00, 4, 4, 892.00, 4, '2020-10-09 01:57:51', '2020-10-09 06:51:27'),
(35, 6, 2, 220.00, 5, 5, 1100.00, 4, '2020-10-09 01:58:33', '2020-10-09 06:51:27'),
(36, 9, 2, 450.00, 12, 12, 5400.00, 9, '2020-11-05 05:17:04', '2020-11-05 05:24:47'),
(37, 9, 8, 320.00, 15, 15, 4800.00, 9, '2020-11-05 05:17:04', '2020-11-05 05:24:47'),
(38, 10, 1, 1222.00, 12, 12, 14664.00, 9, '2020-11-05 05:43:06', '2021-01-26 13:34:31'),
(39, 11, 1, 250.00, 5, NULL, 0.00, 4, '2020-11-12 05:56:22', '2021-01-12 13:45:56'),
(40, 11, 2, 210.00, 10, NULL, 0.00, 4, '2020-11-12 05:56:22', '2021-01-12 13:45:56'),
(41, 11, 8, 150.00, 16, NULL, 0.00, 4, '2020-11-12 05:56:22', '2021-01-12 13:45:56'),
(42, 12, 26, 21.00, 700, 650, 13650.00, 4, '2020-12-23 13:21:47', '2020-12-23 13:24:53'),
(43, 12, 25, 22.00, 800, 800, 17600.00, 4, '2020-12-23 13:22:36', '2020-12-23 13:24:53'),
(44, 13, 27, 25.00, 700, 700, 17500.00, 4, '2020-12-24 11:58:06', '2020-12-24 12:02:54'),
(45, 10, 2, 24.00, 500, 470, 11280.00, 9, '2020-12-24 12:00:25', '2021-01-26 13:34:31'),
(46, 14, 32, 68.00, 500, 500, 34000.00, 4, '2021-01-07 14:57:02', '2021-01-07 15:00:08'),
(47, 15, 31, 110.00, 600, 600, 0.00, 4, '2021-01-30 17:45:41', '2021-01-30 17:49:49');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order_status`
--

CREATE TABLE `purchase_order_status` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase_order_status`
--

INSERT INTO `purchase_order_status` (`id`, `name`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Ordered', 4, '2020-09-27 19:00:00', '2020-09-28 19:00:00'),
(2, 'Recieved', 4, '2020-09-27 19:00:00', '2020-09-28 19:00:00'),
(3, 'Recieved (not Complete)', 4, '2020-09-27 19:00:00', '2020-09-28 19:00:00'),
(4, 'Discard', 4, '2020-09-27 19:00:00', '2020-09-28 19:00:00'),
(5, 'Delivered(Complete)', 4, '2020-09-27 19:00:00', '2020-09-28 19:00:00'),
(6, 'Delivered (Partial)', 4, '2020-09-27 19:00:00', '2020-09-28 19:00:00'),
(7, 'Production', 4, '2020-09-27 19:00:00', '2020-09-28 19:00:00'),
(8, 'Packing (Complete)', 4, '2020-09-27 19:00:00', '2020-09-28 19:00:00'),
(9, 'Ready To Deliver(Complete)', 4, '2020-09-27 19:00:00', '2020-09-28 19:00:00'),
(10, 'Production(Partial)', 4, '2020-09-27 19:00:00', '2020-09-28 19:00:00'),
(11, 'Ready To Deliver(Partial)', 4, '2020-09-27 19:00:00', '2020-09-28 19:00:00'),
(12, 'Packing(Partial)', 4, '2020-09-27 19:00:00', '2020-09-28 19:00:00'),
(13, 'Ready To Deliver(Complete)', 4, '2020-09-27 19:00:00', '2020-09-28 19:00:00'),
(14, 'Delivering(partial)', 4, '2020-09-27 19:00:00', '2020-09-28 19:00:00'),
(15, 'Delivering(complete)', 4, '2020-09-27 19:00:00', '2020-09-28 19:00:00'),
(16, 'Not Delivered', 4, '2020-09-27 19:00:00', '2020-09-28 19:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'vendor', 'web', '2020-09-18 20:00:00', '2020-09-18 20:00:00'),
(2, 'manager', 'web', '2020-09-17 19:00:00', '2020-09-17 19:00:00'),
(3, 'super-admin', 'web', '2020-09-17 19:00:00', '2020-09-17 19:00:00'),
(4, 'supplier', 'web', '2020-09-21 01:50:20', '2020-09-21 01:50:20'),
(5, 'internal-customer', 'web', '2020-10-06 05:21:05', '2020-10-06 05:31:56'),
(6, 'external-customer', 'web', '2020-10-06 05:32:29', '2020-10-06 05:32:29'),
(7, 'private-customer', 'web', '2020-10-06 05:32:51', '2020-10-06 05:32:51'),
(8, 'coop', 'web', '2020-10-06 05:33:08', '2020-10-06 05:33:08'),
(9, 'workforce', 'web', '2020-10-06 05:34:21', '2020-10-06 05:34:21'),
(10, 'Rider', 'web', '2020-10-29 02:09:09', '2020-10-29 02:09:09'),
(11, 'production-admin', 'web', '2020-11-02 00:56:45', '2020-11-02 00:56:45'),
(12, 'packing-admin', 'web', '2020-11-03 05:44:53', '2020-11-03 05:44:53'),
(13, 'transport-admin', 'web', '2020-11-07 01:20:45', '2020-11-07 01:20:45'),
(14, 'finance-admin', 'web', '2020-11-10 06:45:37', '2020-11-10 06:45:37');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `country_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_name` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `longitude` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `latitude` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `is_active` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `country_id`, `name`, `code`, `short_name`, `longitude`, `latitude`, `created_by`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 1, 'Sindh', 'SI', 'SND', '55.62.87', '55.69.87', 4, 1, '2020-09-22 06:34:35', '2020-09-22 06:34:35'),
(2, 1, 'Punjaba', '002', 'PJ', '23.65.89', '55.63.64', 4, 1, '2020-09-22 06:44:38', '2020-09-22 06:49:22');

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

CREATE TABLE `subcategories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subcategories`
--

INSERT INTO `subcategories` (`id`, `category_id`, `name`, `created_by`, `created_at`, `updated_at`) VALUES
(4, 5, 'Pølser', 4, '2020-12-17 05:10:19', '2020-12-17 05:10:19'),
(5, 5, 'Salami', 4, '2020-12-17 05:10:42', '2020-12-17 05:10:42'),
(6, 5, 'Kebab', 4, '2020-12-17 05:11:03', '2020-12-17 05:11:03'),
(7, 5, 'Burger', 4, '2020-12-17 05:11:21', '2020-12-17 05:11:21'),
(8, 5, 'Vårrull', 4, '2020-12-17 05:11:36', '2020-12-17 05:11:36'),
(9, 5, 'Pizza', 4, '2020-12-17 05:12:02', '2020-12-17 05:12:02'),
(11, 1, 'Test Sub Category', 4, '2020-12-24 11:09:31', '2020-12-24 11:10:31'),
(12, 10, 'Flatt biff', 4, '2021-01-04 19:53:25', '2021-01-04 19:53:25'),
(13, 10, 'Lår tunge', 4, '2021-01-04 19:53:53', '2021-01-04 19:53:53'),
(14, 10, 'Rund biff', 4, '2021-01-04 19:54:35', '2021-01-04 19:54:35'),
(15, 10, 'Mørbra', 4, '2021-01-04 19:55:10', '2021-01-04 19:55:10'),
(16, 10, 'Mage', 4, '2021-01-04 19:55:22', '2021-01-04 19:55:22'),
(17, 10, 'Lever', 4, '2021-01-04 19:55:34', '2021-01-04 19:55:34'),
(18, 10, 'Kjøttdeig', 4, '2021-01-04 19:56:13', '2021-01-04 19:56:13'),
(19, 10, 'Kjøtt Medbein', 4, '2021-01-04 19:57:18', '2021-01-04 19:57:18'),
(20, 10, 'Indrefillet', 4, '2021-01-04 19:57:40', '2021-01-04 19:57:40'),
(21, 10, 'Halsel kjott', 4, '2021-01-04 19:58:17', '2021-01-04 19:58:17'),
(22, 10, 'Chuck & Blade K2 10%', 4, '2021-01-04 20:00:06', '2021-01-04 20:00:06'),
(23, 10, 'Chuck & Blade 20%', 4, '2021-01-04 20:00:47', '2021-01-04 20:00:47'),
(24, 10, 'Okse Haller', 4, '2021-01-04 20:02:45', '2021-01-04 20:02:45'),
(25, 10, 'Tunge', 4, '2021-01-04 20:02:58', '2021-01-04 20:02:58'),
(26, 8, 'Sadel', 4, '2021-01-04 20:04:50', '2021-01-04 20:04:50'),
(27, 8, 'Kottleter', 4, '2021-01-04 20:05:09', '2021-01-04 20:05:09'),
(28, 8, 'Kjøttdeig', 4, '2021-01-04 20:05:32', '2021-01-04 20:05:32'),
(29, 8, 'Bog med bein', 4, '2021-01-04 20:05:52', '2021-01-04 20:05:52'),
(30, 8, 'Lammelår Hel', 4, '2021-01-05 13:48:04', '2021-01-05 13:48:04'),
(31, 8, 'Hel lam', 4, '2021-01-05 13:49:06', '2021-01-05 13:49:06'),
(32, 9, 'Kjøttdeig', 4, '2021-01-06 15:55:04', '2021-01-06 15:55:04'),
(33, 9, 'Hel 1600gram', 4, '2021-01-06 15:56:33', '2021-01-06 15:57:32'),
(34, 9, 'Hel 1300gram', 4, '2021-01-06 15:56:34', '2021-01-06 15:56:34'),
(35, 9, 'Hel 825gram', 4, '2021-01-06 15:58:15', '2021-01-06 15:58:15'),
(36, 9, 'Hel 975gram', 4, '2021-01-06 15:58:41', '2021-01-06 15:58:41'),
(37, 9, 'Hel Marinert', 4, '2021-01-06 15:59:21', '2021-01-06 15:59:21'),
(38, 9, 'Hel U/S M/B', 4, '2021-01-06 15:59:46', '2021-01-06 15:59:46'),
(39, 9, 'Høns', 4, '2021-01-06 16:00:06', '2021-01-06 16:00:06'),
(40, 9, 'Hel Grill', 4, '2021-01-06 16:00:29', '2021-01-06 16:00:29'),
(41, 9, 'Filet 100% Naturell', 4, '2021-01-06 16:01:02', '2021-01-06 16:01:02'),
(42, 9, 'Filet Økonomi', 4, '2021-01-06 16:01:23', '2021-01-06 16:11:44'),
(43, 9, 'Filet 1kg Pakke', 4, '2021-01-06 16:16:15', '2021-01-06 16:16:15'),
(44, 9, 'Filet Strimlet', 4, '2021-01-06 16:16:57', '2021-01-06 16:16:57'),
(45, 9, 'Lår M/S M/B', 4, '2021-01-06 16:17:25', '2021-01-06 16:17:25'),
(46, 9, 'Lår M/S M/B Fersk', 4, '2021-01-06 16:17:56', '2021-01-06 16:17:56'),
(47, 9, 'Lår U/S M/B', 4, '2021-01-06 16:27:38', '2021-01-06 16:27:38'),
(48, 9, 'Lår U/S U/B', 4, '2021-01-06 16:28:31', '2021-01-06 16:28:31');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `supplier_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_id` int(11) NOT NULL,
  `state_id` int(11) DEFAULT NULL,
  `city_id` int(11) NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `supplier_name`, `contact_no`, `email`, `country_id`, `state_id`, `city_id`, `address`, `created_by`, `updated_by`, `image`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Meat Ones', '03032226669', 'meatone@gmail.com', 1, 1, 2, 'Office # 1-D, Building 7/C, Lane-13, Bukhari Commercial, D.H.A Phase VI', 4, 4, 'supplier7666049.jpg', 1, '2020-09-23 02:30:16', '2020-10-12 07:33:18'),
(3, 'Test Supplier', '+92335-9988776', 'testsupplier@halalmeat.com', 1, NULL, 1, 'Office # 1-D, Building 7/C, Lane-13', 4, NULL, 'supplier1841528.jpg', 1, '2020-12-23 13:14:34', '2020-12-23 13:14:34'),
(4, 'New Supplier Test', '0092-314-5453213', 'supplier12@gmail.com', 1, NULL, 2, 'Office No 123,Area added', 4, 4, 'supplier3944858.jpg', 1, '2020-12-24 11:47:50', '2020-12-24 11:49:24'),
(5, 'JENSEIDE', '37403400', 'jens@slaktereide.no', 1, NULL, 1, 'Gaupemyrheia 16, 4790, LILLESAND', 4, NULL, 'supplier600128.jpg', 1, '2021-01-05 13:32:37', '2021-01-05 13:32:37');

-- --------------------------------------------------------

--
-- Table structure for table `supplier_products`
--

CREATE TABLE `supplier_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `supplier_products`
--

INSERT INTO `supplier_products` (`id`, `supplier_id`, `product_id`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 4, '2020-09-23 05:03:16', '2020-09-23 05:03:16'),
(2, 1, 2, 4, '2020-09-23 05:03:16', '2020-09-23 05:03:16'),
(11, 1, 8, 4, '2020-09-23 05:17:41', '2020-09-23 05:17:41'),
(17, 3, 25, 4, '2020-12-23 13:16:05', '2020-12-23 13:16:05'),
(18, 3, 26, 4, '2020-12-23 13:16:05', '2020-12-23 13:16:05'),
(20, 4, 27, 4, '2020-12-24 11:50:59', '2020-12-24 11:50:59'),
(21, 5, 32, 4, '2021-01-05 14:11:48', '2021-01-05 14:11:48'),
(22, 5, 40, 4, '2021-01-07 14:55:34', '2021-01-07 14:55:34'),
(23, 5, 28, 4, '2021-01-14 13:13:51', '2021-01-14 13:13:51'),
(24, 5, 31, 4, '2021-01-14 13:14:05', '2021-01-14 13:14:05');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admin` int(11) DEFAULT NULL,
  `is_active` tinyint(2) NOT NULL,
  `is_assign` tinyint(2) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `admin`, `is_active`, `is_assign`, `created_at`, `updated_at`) VALUES
(3, 'admin', 'admin@halalmeat.com', NULL, '$2y$10$jT/YW0q454KTgphL3YdR9eQyxTTpZnuwGGLX4fk5NVLvGOxAgXP0e', NULL, 1, 1, 0, '2020-09-18 19:00:00', '2020-09-18 19:00:00'),
(4, 'Super Admin', 'superadmin@halalmeat.com', NULL, '$2y$10$p8tNxn4Y5nLN0q10W.x4KewuY0wHItf6f6GjW.nJYvrTkBiHU9UMC', NULL, 1, 1, 0, '2020-09-21 01:03:01', '2020-09-21 01:03:01'),
(5, 'Production', 'production@halalmeat.com', NULL, '$2y$10$p8tNxn4Y5nLN0q10W.x4KewuY0wHItf6f6GjW.nJYvrTkBiHU9UMC', NULL, 1, 1, 0, '2020-09-21 01:50:50', '2020-09-21 01:50:50'),
(6, 'Tahseen Warsi new', 'tahseenwarsi@halalmeat.com', NULL, '$2y$10$CbIMb5hyFnPU8bJlEzu6K.8.Djd8TWEsOrcb7jL5ayt50zbKA3aB2', NULL, 1, 0, 0, '2020-10-12 02:50:48', '2021-01-05 13:15:58'),
(7, 'Wahaj Ahmed', 'wahajahmed@halalmeat.com', NULL, '$2y$10$7dVRW0dVicIfJkACyCKanuVxkM5d39EIuGlHJjAk4y1yH6nCkNMz2', NULL, 1, 0, 0, '2020-10-12 02:53:34', '2021-01-05 13:17:52'),
(8, 'Ahmed Ali', 'ahmed@halalmeat.com', NULL, '$2y$10$U2LrC9tI2G6AQjCCCf0AGOpkCPfPVraXcq.yNjgZ0u1lfh5EEUgya', NULL, 1, 1, 1, '2020-10-29 02:16:07', '2021-01-30 22:04:23'),
(9, 'Packing Admin', 'packing@halalmeat.com', NULL, '$2y$10$4kW2.QkQ4GVko/r8PJD7A.vzrCXykxVyLg.O0qt9535LN5vWtxKGG', NULL, 1, 1, 0, '2020-11-03 05:48:15', '2020-11-03 05:48:15'),
(10, 'Transport Admin', 'transport@halalmeat.com', NULL, '$2y$10$FIVgI52zSGmehOJL8.vmxuXZaZT3dKDYCOzevHTKJ6p49gDYZGhzO', NULL, 1, 1, 0, '2020-11-07 01:34:58', '2020-11-07 01:34:58'),
(11, 'Finance Admin', 'finance@halalmeat.com', NULL, '$2y$10$LjJE7gbJSN7WYvgN/AvwbuwChvxPesVqcbvGr.hPMc48FQly3cy2y', NULL, 1, 1, 0, '2020-11-10 06:47:06', '2020-11-10 06:47:06'),
(12, 'Muzammil Khan', 'muzammilken95@gmail.com', NULL, '$2y$10$7dVRW0dVicIfJkACyCKanuVxkM5d39EIuGlHJjAk4y1yH6nCkNMz2', NULL, 1, 1, 0, '2020-11-13 07:01:04', '2020-12-24 16:23:16'),
(13, 'Catering', 'catering@halalmeat.com', NULL, '$2y$10$EBMTx2b8y7EhB/f8/3a7mOTwRM/PgVUhVTLxOKlb9dyhvFbXW.Wbi', NULL, 1, 1, 0, '2020-12-28 09:48:19', '2020-12-28 09:48:19'),
(14, 'Catering', 'catering@gmail.com', NULL, '$2y$10$cZOdgtj4h7kYY07czrRNW.Evx0kcTIlvMdMVES/wQszdKInliiQPS', NULL, 1, 1, 0, '2020-12-28 09:57:31', '2020-12-28 09:58:15'),
(16, 'Muhammad Suffyan', 'suffyan09@gmail.com', NULL, '$2y$10$Lz0ux/eBJR2H/iYCti73PuUsndEjfsNmrRiy1Yqm5RCdLVFHcKH46', NULL, 1, 1, 0, '2020-12-28 12:15:25', '2020-12-28 12:24:28'),
(17, 'Ahsan Khan', 'ahsankhan@gmail.com', NULL, '$2y$10$8rCg8UCPtVVUqQd/mN/XF.uyX1yi/WE3velrkNP2gjhs8i8ec0me.', NULL, 1, 1, 0, '2020-12-29 17:56:54', '2020-12-29 17:56:54'),
(18, 'Kjottsentralen Stovner Avdeling', 'Stovner@kjottsentralen.no', NULL, '$2y$10$EYuop6ukYNfnkq8eADwcXeCrbfZ8uXs/w22.Gv5NOO.DPJ7sIUfMO', NULL, 1, 1, 0, '2020-12-31 17:36:49', '2021-01-05 13:14:53'),
(19, 'Delivery boy', 'rajawaqas_82@hotmail.com', NULL, '$2y$10$hOMrMXHc9/fXLNyRwbH1mu5wd7FcTkRz32lS0XkOnPJFEQX1kNqlO', NULL, 1, 1, 0, '2021-01-04 18:29:39', '2021-01-26 13:37:28'),
(20, 'Kjøttsentralen Furuset Avdeling', 'furuset@kjottsentralen.no', NULL, '$2y$10$.wHh530dHZhqcb6BAuXJouNALJoCgxewP4Il4jcOEjQRIrpn3rsBS', NULL, 1, 1, 0, '2021-01-05 13:10:51', '2021-01-05 13:10:51'),
(21, 'DESI KITCHEN AS', 'desikitchenoslo@gmail.com', NULL, '$2y$10$qiFDUBZzzAXqUQ9D3jbS9urJIbmuRxJIUzKVQR5csVZizciVW0jVG', NULL, 1, 1, 0, '2021-01-05 13:22:38', '2021-01-05 13:22:38'),
(22, 'Kitchen Caters AS', 'post@kitchencaters.no', NULL, '$2y$10$aTORK3lBB7BrJt71hns.Lug7J4XSRKx3jOsvWW.xrAjoTGVzraVhC', NULL, 1, 1, 0, '2021-01-05 13:28:57', '2021-01-05 13:28:57'),
(23, 'New Kebabish AS', 'newkebabishlorenskog@gmail.com', NULL, '$2y$10$133h6sMVR1QtVgkffFW4MuJGuMogUNHSlKm11oAp/uJ1aOKUYIfoa', NULL, 1, 1, 0, '2021-01-06 20:16:55', '2021-01-06 20:16:55'),
(24, 'Kalbakken Kjøtt AS', 'post@kkf.no', NULL, '$2y$10$jeIIBf0YcbXd3QA/nM8MJeFH6YkTyz1IYueFylL0U6qqy6p0lQtJO', NULL, 1, 1, 0, '2021-01-06 20:25:39', '2021-01-06 20:25:39');

-- --------------------------------------------------------

--
-- Table structure for table `wp_orders`
--

CREATE TABLE `wp_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `wp_order_id` int(11) NOT NULL,
  `customer_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_cell` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `billing_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shipping_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location_status` int(11) NOT NULL,
  `delivery_status` int(11) NOT NULL,
  `is_assign` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wp_orders`
--

INSERT INTO `wp_orders` (`id`, `wp_order_id`, `customer_name`, `customer_email`, `customer_cell`, `billing_address`, `shipping_address`, `city`, `post_code`, `country`, `total_amount`, `status`, `location_status`, `delivery_status`, `is_assign`, `created_at`, `updated_at`) VALUES
(1, 10616, 'Amara Alavi', 'ammara.alavi@gmail.com', '+47 966 55 266', 'Bygdøy allé 9A,,Oslo,0257,NO', 'Bygdøy allé 9A,', 'Oslo', '0257', 'NO', '573.00', 'processing', 7, 5, 0, '2020-11-24 05:52:49', '2020-11-26 09:05:18'),
(2, 10612, 'NOURELDEEN ELBANA', 'raniaelhalwagy@ymail.com', '93954686', 'Drammensveien 90A,,OSLO,0244,NO', 'Drammensveien 90A,', 'OSLO', '0244', 'NO', '1150.00', 'completed', 1, 16, 0, '2020-11-24 05:52:49', '2020-11-27 02:23:14'),
(3, 10610, 'Iyad El-Baghdadi', 'iyad.elbaghdadi@gmail.com', '+47 966 55 277', 'Bygdøy allé 9A,,Oslo,0257,NO', 'Kongens Gate 9,', 'Oslo', '0153', 'NO', '780.00', 'failed', 2, 16, 0, '2020-11-24 05:52:49', '2020-11-24 05:52:49'),
(4, 10609, 'Wasim Tahir', 'wasim.tahir.khan@gmail.com', '98216518', 'Søndre Rød 22B, Leil 06,,Oslo,0752,NO', 'Søndre Rød 22B, Leil 06,', 'Oslo', '0752', 'NO', '1650.00', 'completed', 2, 16, 0, '2020-11-24 05:52:49', '2020-11-24 05:52:49'),
(5, 10608, 'Ejaz Yousaf', 'yousaf.ejaz@gmail.com', '95780177', 'Ludvig Karstens vei 8,,Oslo,1064,NO', 'Ludvig Karstens vei 8,', 'Oslo', '1064', 'NO', '1900.00', 'completed', 2, 16, 0, '2020-11-24 05:52:49', '2020-11-24 05:52:49'),
(6, 10594, 'erum majeed', 'erum.majeed93@hotmail.com', '46937379', 'Ravnkollbakken 25,,Oslo,0971,NO', 'Ravnkollbakken 25,', 'Oslo', '0971', 'NO', '1060.00', 'completed', 2, 16, 0, '2020-11-24 05:52:49', '2020-11-24 05:52:49'),
(7, 10593, 'Ansar Parveen', 'ittqa@hotmail.com', '98866807', 'Ankerveien 99,,Oslo,0766,NO', 'Ankerveien 99,', 'Oslo', '0766', 'NO', '1860.00', 'completed', 2, 16, 0, '2020-11-24 05:52:49', '2020-11-24 05:52:49'),
(8, 10573, 'Iyad El-Baghdadi', 'iyad.elbaghdadi@gmail.com', '+47 966 55 277', 'Bygdøy allé 9A,,Oslo,0257,NO', 'Kongens Gate 9,', 'Oslo', '0153', 'NO', '740.00', 'completed', 2, 16, 0, '2020-11-24 05:52:49', '2020-11-24 05:52:49'),
(9, 10568, 'Ejaz Yousaf', 'yousaf.ejaz@gmail.com', '95780177', 'Ludvig Karstens vei 8,,Oslo,1064,NO', 'Ludvig Karstens vei 8,', 'Oslo', '1064', 'NO', '1980.00', 'completed', 2, 16, 0, '2020-11-24 05:52:49', '2020-11-24 05:52:49'),
(10, 10559, 'Erum Majeed', 'erum.majeed93@hotmail.com', '46937379', 'Ravnkollbakken 25,,Oslo,0971,NO', 'Ravnkollbakken 25,', 'Oslo', '0971', 'NO', '690.00', 'completed', 2, 16, 0, '2020-11-24 05:52:49', '2020-11-24 05:52:49'),
(11, 10622, 'Erum Majeed', 'erum.majeed93@hotmail.com', '46937379', 'Ravnkollbakken 25,,Oslo,0971,NO', 'Ravnkollbakken 25,', 'Oslo', '0971', 'NO', '1580.00', 'processing', 1, 15, 0, '2020-11-27 07:41:47', '2020-11-27 07:41:47');

-- --------------------------------------------------------

--
-- Table structure for table `wp_order_assign`
--

CREATE TABLE `wp_order_assign` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` int(11) NOT NULL,
  `rider_id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `completed` tinyint(2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wp_order_assign`
--

INSERT INTO `wp_order_assign` (`id`, `order_id`, `rider_id`, `vehicle_id`, `completed`, `created_at`, `updated_at`) VALUES
(1, 1, 8, 1, 1, '2020-11-26 08:47:44', '2020-11-26 09:05:18');

-- --------------------------------------------------------

--
-- Table structure for table `wp_order_details`
--

CREATE TABLE `wp_order_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sku_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` double(8,2) NOT NULL,
  `subtotal_amount` double(8,2) NOT NULL,
  `tax` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_amount` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wp_order_details`
--

INSERT INTO `wp_order_details` (`id`, `order_id`, `product_id`, `product_name`, `sku_number`, `quantity`, `price`, `subtotal_amount`, `tax`, `total_amount`, `created_at`, `updated_at`) VALUES
(1, 1, 9014, 'kylling Lår Halal u/s og m/b Per kg', '9014-meat', 3, 65.00, 195.00, '0.00', 195.00, '2020-11-24 05:52:49', '2020-11-24 05:52:49'),
(2, 1, 442, 'Oksekjøttdeig Halal  per kg', '442-meat', 2, 120.00, 240.00, '0.00', 240.00, '2020-11-24 05:52:49', '2020-11-24 05:52:49'),
(3, 1, 9327, 'Lam Lår med bein i biten Halal Per kg', '9327-meat', 1, 138.00, 138.00, '0.00', 138.00, '2020-11-24 05:52:49', '2020-11-24 05:52:49'),
(4, 2, 442, 'Oksekjøttdeig Halal  per kg', '442-meat', 3, 120.00, 360.00, '0.00', 360.00, '2020-11-24 05:52:49', '2020-11-24 05:52:49'),
(5, 2, 9042, 'Okselever (Halal)', '9042-meat', 2, 60.00, 120.00, '0.00', 120.00, '2020-11-24 05:52:49', '2020-11-24 05:52:49'),
(6, 2, 9039, 'Okse Lårtunge (Halal)', '9039-meat', 2, 250.00, 500.00, '0.00', 500.00, '2020-11-24 05:52:49', '2020-11-24 05:52:49'),
(7, 2, 9072, 'Scampi 16/20 without shell', '9072-grc', 1, 170.00, 170.00, '0.00', 170.00, '2020-11-24 05:52:49', '2020-11-24 05:52:49'),
(8, 3, 9299, 'Eggs 30 pieces Large White', '9299-grc', 3, 80.00, 240.00, '0.00', 240.00, '2020-11-24 05:52:49', '2020-11-24 05:52:49'),
(9, 3, 442, 'Oksekjøttdeig Halal  per kg', '442-meat', 2, 120.00, 240.00, '0.00', 240.00, '2020-11-24 05:52:49', '2020-11-24 05:52:49'),
(10, 3, 528, 'Lammekjøttdeig Halal Per Kg', '528-meat', 3, 100.00, 300.00, '0.00', 300.00, '2020-11-24 05:52:49', '2020-11-24 05:52:49'),
(11, 4, 530, 'hel lam Halal Price Per kg  ( hel Lam 15kg = 1650kr)', '530-meat', 1, 1650.00, 1650.00, '0.00', 1650.00, '2020-11-24 05:52:49', '2020-11-24 05:52:49'),
(12, 5, 532, 'Lam Lår med bein Halal Per kg', '532-meat', 10, 140.00, 1400.00, '0.00', 1400.00, '2020-11-24 05:52:49', '2020-11-24 05:52:49'),
(13, 5, 9037, 'Okse Bankekjøtt (Halal)', '9037-meat', 2, 250.00, 500.00, '0.00', 500.00, '2020-11-24 05:52:49', '2020-11-24 05:52:49'),
(14, 6, 507, 'kyllingfillet naturall 100% Halal Per kg', '507-meat', 4, 130.00, 520.00, '0.00', 520.00, '2020-11-24 05:52:49', '2020-11-24 05:52:49'),
(15, 6, 525, 'kylling kjøttdeig Halal Per kg', '525-meat', 2, 120.00, 240.00, '0.00', 240.00, '2020-11-24 05:52:49', '2020-11-24 05:52:49'),
(16, 6, 9033, 'Okse Straganoff(Halal)', '9033-meat', 1, 300.00, 300.00, '0.00', 300.00, '2020-11-24 05:52:49', '2020-11-24 05:52:49'),
(17, 7, 530, 'hel lam Halal Price Per kg  ( hel Lam 15kg = 1650kr)', '530-meat', 1, 1650.00, 1650.00, '0.00', 1650.00, '2020-11-24 05:52:49', '2020-11-24 05:52:49'),
(18, 7, 9028, 'Marinert kylling for pizza', '9028-meat', 2, 105.00, 210.00, '0.00', 210.00, '2020-11-24 05:52:49', '2020-11-24 05:52:49'),
(19, 8, 9299, 'Eggs 30 pieces Large White', '9299-grc', 2, 80.00, 160.00, '0.00', 160.00, '2020-11-24 05:52:49', '2020-11-24 05:52:49'),
(20, 8, 442, 'Oksekjøttdeig Halal  per kg', '442-meat', 2, 120.00, 240.00, '0.00', 240.00, '2020-11-24 05:52:49', '2020-11-24 05:52:49'),
(21, 8, 528, 'Lammekjøttdeig Halal Per Kg', '528-meat', 1, 100.00, 100.00, '0.00', 100.00, '2020-11-24 05:52:49', '2020-11-24 05:52:49'),
(22, 8, 521, 'Marinated Chicken Nam Halal Per kg', '521-meat', 2, 120.00, 240.00, '0.00', 240.00, '2020-11-24 05:52:49', '2020-11-24 05:52:49'),
(23, 9, 9019, 'KyllingOvervinger Halal Per kg', '9019-meat', 1, 40.00, 40.00, '0.00', 40.00, '2020-11-24 05:52:49', '2020-11-24 05:52:49'),
(24, 9, 479, 'Helkylling U/S M/B i biter Halal', '479-meat', 2, 65.00, 130.00, '0.00', 130.00, '2020-11-24 05:52:49', '2020-11-24 05:52:49'),
(25, 9, 9014, 'kylling Lår Halal u/s og m/b Per kg', '9014-meat', 2, 65.00, 130.00, '0.00', 130.00, '2020-11-24 05:52:49', '2020-11-24 05:52:49'),
(26, 9, 507, 'kyllingfillet naturall 100% Halal Per kg', '507-meat', 2, 130.00, 260.00, '0.00', 260.00, '2020-11-24 05:52:49', '2020-11-24 05:52:49'),
(27, 9, 9037, 'Okse Bankekjøtt (Halal)', '9037-meat', 2, 250.00, 500.00, '0.00', 500.00, '2020-11-24 05:52:49', '2020-11-24 05:52:49'),
(28, 9, 462, 'Oxe Biff bibringe Halal Per KG', '462-meat', 1, 120.00, 120.00, '0.00', 120.00, '2020-11-24 05:52:49', '2020-11-24 05:52:49'),
(29, 9, 9061, 'Lammeskanke Halal Per kg', '9061-meat', 2, 140.00, 280.00, '0.00', 280.00, '2020-11-24 05:52:49', '2020-11-24 05:52:49'),
(30, 9, 532, 'Lam Lår med bein Halal Per kg', '532-meat', 3, 140.00, 420.00, '0.00', 420.00, '2020-11-24 05:52:49', '2020-11-24 05:52:49'),
(31, 9, 9026, 'Kylling Pølser Grill  500G', '9026-meat', 2, 50.00, 100.00, '0.00', 100.00, '2020-11-24 05:52:49', '2020-11-24 05:52:49'),
(32, 10, 507, 'kyllingfillet naturall 100% Halal Per kg', '507-meat', 1, 130.00, 130.00, '0.00', 130.00, '2020-11-24 05:52:49', '2020-11-24 05:52:49'),
(33, 10, 519, 'Kylling klubber lår U/S Halal Per kg', '519-meat', 8, 70.00, 560.00, '0.00', 560.00, '2020-11-24 05:52:49', '2020-11-24 05:52:49'),
(34, 11, 519, 'Kylling klubber lår U/S Halal Per kg', '519-meat', 4, 70.00, 280.00, '0.00', 280.00, '2020-11-27 07:41:47', '2020-11-27 07:41:47'),
(35, 11, 507, 'kyllingfillet naturall 100% Halal Per kg', '507-meat', 5, 130.00, 650.00, '0.00', 650.00, '2020-11-27 07:41:47', '2020-11-27 07:41:47'),
(36, 11, 525, 'kylling kjøttdeig Halal Per kg', '525-meat', 2, 120.00, 240.00, '0.00', 240.00, '2020-11-27 07:41:47', '2020-11-27 07:41:47'),
(37, 11, 9033, 'Okse Straganoff(Halal)', '9033-meat', 1, 300.00, 300.00, '0.00', 300.00, '2020-11-27 07:41:47', '2020-11-27 07:41:47'),
(38, 11, 9026, 'Kylling Pølser Grill  500G', '9026-meat', 1, 50.00, 50.00, '0.00', 50.00, '2020-11-27 07:41:47', '2020-11-27 07:41:47'),
(39, 11, 9023, 'Kylling Pølser winner 500G', '9023-meat', 1, 60.00, 60.00, '0.00', 60.00, '2020-11-27 07:41:47', '2020-11-27 07:41:47'),
(40, 12, 9014, 'kylling Lår Halal u/s og m/b Per kg', '9014-meat', 3, 65.00, 195.00, '0.00', 195.00, '2020-11-27 07:41:47', '2020-11-27 07:41:47'),
(41, 12, 442, 'Oksekjøttdeig Halal  per kg', '442-meat', 2, 120.00, 240.00, '0.00', 240.00, '2020-11-27 07:41:47', '2020-11-27 07:41:47'),
(42, 12, 9327, 'Lam Lår med bein i biten Halal Per kg', '9327-meat', 1, 138.00, 138.00, '0.00', 138.00, '2020-11-27 07:41:47', '2020-11-27 07:41:47'),
(43, 13, 442, 'Oksekjøttdeig Halal  per kg', '442-meat', 3, 120.00, 360.00, '0.00', 360.00, '2020-11-27 07:41:47', '2020-11-27 07:41:47'),
(44, 13, 9042, 'Okselever (Halal)', '9042-meat', 2, 60.00, 120.00, '0.00', 120.00, '2020-11-27 07:41:47', '2020-11-27 07:41:47'),
(45, 13, 9039, 'Okse Lårtunge (Halal)', '9039-meat', 2, 250.00, 500.00, '0.00', 500.00, '2020-11-27 07:41:47', '2020-11-27 07:41:47'),
(46, 13, 9072, 'Scampi 16/20 without shell', '9072-grc', 1, 170.00, 170.00, '0.00', 170.00, '2020-11-27 07:41:47', '2020-11-27 07:41:47'),
(47, 14, 9299, 'Eggs 30 pieces Large White', '9299-grc', 3, 80.00, 240.00, '0.00', 240.00, '2020-11-27 07:41:47', '2020-11-27 07:41:47'),
(48, 14, 442, 'Oksekjøttdeig Halal  per kg', '442-meat', 2, 120.00, 240.00, '0.00', 240.00, '2020-11-27 07:41:47', '2020-11-27 07:41:47'),
(49, 14, 528, 'Lammekjøttdeig Halal Per Kg', '528-meat', 3, 100.00, 300.00, '0.00', 300.00, '2020-11-27 07:41:47', '2020-11-27 07:41:47'),
(50, 15, 530, 'hel lam Halal Price Per kg  ( hel Lam 15kg = 1650kr)', '530-meat', 1, 1650.00, 1650.00, '0.00', 1650.00, '2020-11-27 07:41:47', '2020-11-27 07:41:47'),
(51, 16, 532, 'Lam Lår med bein Halal Per kg', '532-meat', 10, 140.00, 1400.00, '0.00', 1400.00, '2020-11-27 07:41:47', '2020-11-27 07:41:47'),
(52, 16, 9037, 'Okse Bankekjøtt (Halal)', '9037-meat', 2, 250.00, 500.00, '0.00', 500.00, '2020-11-27 07:41:47', '2020-11-27 07:41:47'),
(53, 17, 507, 'kyllingfillet naturall 100% Halal Per kg', '507-meat', 4, 130.00, 520.00, '0.00', 520.00, '2020-11-27 07:41:47', '2020-11-27 07:41:47'),
(54, 17, 525, 'kylling kjøttdeig Halal Per kg', '525-meat', 2, 120.00, 240.00, '0.00', 240.00, '2020-11-27 07:41:47', '2020-11-27 07:41:47'),
(55, 17, 9033, 'Okse Straganoff(Halal)', '9033-meat', 1, 300.00, 300.00, '0.00', 300.00, '2020-11-27 07:41:47', '2020-11-27 07:41:47'),
(56, 18, 530, 'hel lam Halal Price Per kg  ( hel Lam 15kg = 1650kr)', '530-meat', 1, 1650.00, 1650.00, '0.00', 1650.00, '2020-11-27 07:41:47', '2020-11-27 07:41:47'),
(57, 18, 9028, 'Marinert kylling for pizza', '9028-meat', 2, 105.00, 210.00, '0.00', 210.00, '2020-11-27 07:41:47', '2020-11-27 07:41:47'),
(58, 19, 9299, 'Eggs 30 pieces Large White', '9299-grc', 2, 80.00, 160.00, '0.00', 160.00, '2020-11-27 07:41:47', '2020-11-27 07:41:47'),
(59, 19, 442, 'Oksekjøttdeig Halal  per kg', '442-meat', 2, 120.00, 240.00, '0.00', 240.00, '2020-11-27 07:41:47', '2020-11-27 07:41:47'),
(60, 19, 528, 'Lammekjøttdeig Halal Per Kg', '528-meat', 1, 100.00, 100.00, '0.00', 100.00, '2020-11-27 07:41:47', '2020-11-27 07:41:47'),
(61, 19, 521, 'Marinated Chicken Nam Halal Per kg', '521-meat', 2, 120.00, 240.00, '0.00', 240.00, '2020-11-27 07:41:47', '2020-11-27 07:41:47'),
(62, 20, 9019, 'KyllingOvervinger Halal Per kg', '9019-meat', 1, 40.00, 40.00, '0.00', 40.00, '2020-11-27 07:41:47', '2020-11-27 07:41:47'),
(63, 20, 479, 'Helkylling U/S M/B i biter Halal', '479-meat', 2, 65.00, 130.00, '0.00', 130.00, '2020-11-27 07:41:47', '2020-11-27 07:41:47'),
(64, 20, 9014, 'kylling Lår Halal u/s og m/b Per kg', '9014-meat', 2, 65.00, 130.00, '0.00', 130.00, '2020-11-27 07:41:47', '2020-11-27 07:41:47'),
(65, 20, 507, 'kyllingfillet naturall 100% Halal Per kg', '507-meat', 2, 130.00, 260.00, '0.00', 260.00, '2020-11-27 07:41:47', '2020-11-27 07:41:47'),
(66, 20, 9037, 'Okse Bankekjøtt (Halal)', '9037-meat', 2, 250.00, 500.00, '0.00', 500.00, '2020-11-27 07:41:47', '2020-11-27 07:41:47'),
(67, 20, 462, 'Oxe Biff bibringe Halal Per KG', '462-meat', 1, 120.00, 120.00, '0.00', 120.00, '2020-11-27 07:41:47', '2020-11-27 07:41:47'),
(68, 20, 9061, 'Lammeskanke Halal Per kg', '9061-meat', 2, 140.00, 280.00, '0.00', 280.00, '2020-11-27 07:41:47', '2020-11-27 07:41:47'),
(69, 20, 532, 'Lam Lår med bein Halal Per kg', '532-meat', 3, 140.00, 420.00, '0.00', 420.00, '2020-11-27 07:41:47', '2020-11-27 07:41:47'),
(70, 20, 9026, 'Kylling Pølser Grill  500G', '9026-meat', 2, 50.00, 100.00, '0.00', 100.00, '2020-11-27 07:41:47', '2020-11-27 07:41:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assets`
--
ALTER TABLE `assets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assets_categories`
--
ALTER TABLE `assets_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assets_status`
--
ALTER TABLE `assets_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assets_subcategories`
--
ALTER TABLE `assets_subcategories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assets_vehicle_details`
--
ALTER TABLE `assets_vehicle_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_details`
--
ALTER TABLE `customer_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_price`
--
ALTER TABLE `customer_price`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expences`
--
ALTER TABLE `expences`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expence_type`
--
ALTER TABLE `expence_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `forward_order_stock`
--
ALTER TABLE `forward_order_stock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_assign`
--
ALTER TABLE `order_assign`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_location_status`
--
ALTER TABLE `order_location_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `po_priority_status`
--
ALTER TABLE `po_priority_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_details`
--
ALTER TABLE `product_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_stocks`
--
ALTER TABLE `product_stocks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_stock_recieves`
--
ALTER TABLE `product_stock_recieves`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_sub_categories`
--
ALTER TABLE `product_sub_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_unit`
--
ALTER TABLE `product_unit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_order`
--
ALTER TABLE `purchase_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_order_detail`
--
ALTER TABLE `purchase_order_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_order_status`
--
ALTER TABLE `purchase_order_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier_products`
--
ALTER TABLE `supplier_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `wp_orders`
--
ALTER TABLE `wp_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wp_order_assign`
--
ALTER TABLE `wp_order_assign`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wp_order_details`
--
ALTER TABLE `wp_order_details`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assets`
--
ALTER TABLE `assets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `assets_categories`
--
ALTER TABLE `assets_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `assets_status`
--
ALTER TABLE `assets_status`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `assets_subcategories`
--
ALTER TABLE `assets_subcategories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `assets_vehicle_details`
--
ALTER TABLE `assets_vehicle_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customer_details`
--
ALTER TABLE `customer_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `customer_price`
--
ALTER TABLE `customer_price`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `expences`
--
ALTER TABLE `expences`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `expence_type`
--
ALTER TABLE `expence_type`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `forward_order_stock`
--
ALTER TABLE `forward_order_stock`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `order_assign`
--
ALTER TABLE `order_assign`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `order_location_status`
--
ALTER TABLE `order_location_status`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `po_priority_status`
--
ALTER TABLE `po_priority_status`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `product_details`
--
ALTER TABLE `product_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `product_stocks`
--
ALTER TABLE `product_stocks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `product_stock_recieves`
--
ALTER TABLE `product_stock_recieves`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_sub_categories`
--
ALTER TABLE `product_sub_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `product_unit`
--
ALTER TABLE `product_unit`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `purchase_order`
--
ALTER TABLE `purchase_order`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `purchase_order_detail`
--
ALTER TABLE `purchase_order_detail`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `purchase_order_status`
--
ALTER TABLE `purchase_order_status`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `supplier_products`
--
ALTER TABLE `supplier_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `wp_orders`
--
ALTER TABLE `wp_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `wp_order_assign`
--
ALTER TABLE `wp_order_assign`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `wp_order_details`
--
ALTER TABLE `wp_order_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
