-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 02, 2024 at 05:44 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lapms`
--

-- --------------------------------------------------------

--
-- Table structure for table `agent`
--

CREATE TABLE `agent` (
  `id` int(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `agent`
--

INSERT INTO `agent` (`id`, `name`, `address`, `contact`, `created_at`, `updated_at`, `deleted_at`, `status`) VALUES
(4, 'ALFRED SIAREZ', 'BISLIG SURIGAO DEL SURs', '09104562225', '2023-08-20 22:10:44', '2023-08-20 22:17:18', NULL, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `borrower`
--

CREATE TABLE `borrower` (
  `id` int(255) NOT NULL,
  `borrower_no` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `contact` varchar(12) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `borrower`
--

INSERT INTO `borrower` (`id`, `borrower_no`, `name`, `contact`, `address`, `status`, `created_at`, `updated_at`) VALUES
(1, NULL, 'HELEN CULIAO', '09199533529', 'TIBUGNCO RELOCATION DAVAO CITY', 'Active', '2023-08-20 22:59:15', '2023-08-20 22:59:15'),
(2, NULL, 'LUCITA TEKIKO', '09199533529', 'KABAYAN RELOCATION DAVAO CITY', 'Active', '2023-08-20 22:59:42', '2023-08-20 22:59:42'),
(3, NULL, 'ANTONIO TEKIKO', '09199533529', 'TAGUM DAVAO DEL NORTE', 'Active', '2023-08-20 23:04:20', '2023-08-20 23:06:18'),
(4, NULL, 'FITZ ANGELO TEKIKO', '09199533529', 'KABAYAN DAVAO CITY', 'Active', '2023-08-20 23:08:43', '2023-08-21 10:51:25'),
(5, NULL, 'DEBRA DAWN TEKIKO', '09106533622', 'SASA DAVAO CITY', 'Active', '2023-08-21 07:09:57', '2023-08-21 07:09:57');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `loans`
--

CREATE TABLE `loans` (
  `id` int(255) NOT NULL,
  `principal` varchar(255) DEFAULT NULL,
  `interest_rate` varchar(255) DEFAULT NULL,
  `monthly_payment` varchar(255) DEFAULT NULL,
  `loan_terms` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loans`
--

INSERT INTO `loans` (`id`, `principal`, `interest_rate`, `monthly_payment`, `loan_terms`, `created_at`, `updated_at`) VALUES
(1, '100000', '1', '101000', NULL, '2023-08-06 07:46:08', '2023-08-06 07:46:08');

-- --------------------------------------------------------

--
-- Table structure for table `loan_details`
--

CREATE TABLE `loan_details` (
  `id` int(255) NOT NULL,
  `borrower_id` int(255) DEFAULT NULL,
  `agent_id` int(255) DEFAULT NULL,
  `loan_no` varchar(255) DEFAULT NULL,
  `date_released` varchar(255) DEFAULT NULL,
  `due_date` varchar(255) DEFAULT NULL,
  `loan_amount` varchar(255) DEFAULT NULL,
  `balance` decimal(10,0) DEFAULT NULL,
  `interest` double DEFAULT NULL,
  `loan_term` int(255) DEFAULT NULL,
  `monthly_payment` decimal(10,0) DEFAULT NULL,
  `partial` decimal(10,0) DEFAULT NULL,
  `interest_due` double DEFAULT NULL,
  `agent` varchar(255) DEFAULT NULL,
  `Bank` varchar(255) DEFAULT NULL,
  `account_number` varchar(255) DEFAULT NULL,
  `collateral` varchar(255) DEFAULT NULL,
  `collateral_address` varchar(255) DEFAULT NULL,
  `collateral_file` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `date_effective` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loan_details`
--

INSERT INTO `loan_details` (`id`, `borrower_id`, `agent_id`, `loan_no`, `date_released`, `due_date`, `loan_amount`, `balance`, `interest`, `loan_term`, `monthly_payment`, `partial`, `interest_due`, `agent`, `Bank`, `account_number`, `collateral`, `collateral_address`, `collateral_file`, `created_at`, `updated_at`, `status`, `date_effective`) VALUES
(1, 2, 1, '23-LN-00000', '2023-02-25', NULL, '296000', '296000', 1.7, 48, '11199', '6167', 5032, NULL, 'BDO', '6767', 'ladislawa', 'davao city', '2.pdf', '2023-02-24 19:19:04', '2023-02-24 19:19:04', 'Approved', '2023-03-25'),
(2, 2, 1, '23-LN-00001', '2023-02-25', NULL, '296000', '289833', 1.7, 48, '11199', '6167', 5032, NULL, 'BDO', '6767', 'ladislawa', 'davao city', '2.pdf', '2023-02-24 19:19:11', '2023-02-24 19:22:19', 'Approved', '2023-04-25');

-- --------------------------------------------------------

--
-- Table structure for table `loan_payments`
--

CREATE TABLE `loan_payments` (
  `id` int(255) NOT NULL,
  `loan_id` int(255) DEFAULT NULL,
  `payment_date` varchar(255) DEFAULT NULL,
  `payment` decimal(10,2) DEFAULT NULL,
  `interest` decimal(10,2) DEFAULT NULL,
  `adjusted_payment` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(255) NOT NULL,
  `user_id` int(255) DEFAULT NULL,
  `type_logs` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `memorial`
--

CREATE TABLE `memorial` (
  `id` int(255) NOT NULL,
  `date_created` date DEFAULT NULL,
  `memorial_no` varchar(255) DEFAULT NULL,
  `memorial_name` varchar(255) DEFAULT NULL,
  `memorial_address` varchar(255) DEFAULT NULL,
  `sq_meter` int(255) DEFAULT NULL,
  `amount` int(255) DEFAULT NULL,
  `documents` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `rentedidle` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `memorial_sold`
--

CREATE TABLE `memorial_sold` (
  `id` int(255) NOT NULL,
  `memorial_id` int(255) DEFAULT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `customer_address` varchar(255) DEFAULT NULL,
  `contact_number` varchar(255) DEFAULT NULL,
  `amount_paid` varchar(255) DEFAULT NULL,
  `mode_of_payment` varchar(255) DEFAULT NULL,
  `account_number` varchar(255) DEFAULT NULL,
  `date_paid` date DEFAULT NULL,
  `proof_of_payment` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `code_no` varchar(255) DEFAULT NULL,
  `date_created` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_01_21_023552_create_roles_and_permissions_tables', 2),
(6, '2024_01_21_030008_common_fields', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(255) NOT NULL,
  `user_id` int(255) DEFAULT NULL,
  `payment_id` int(255) DEFAULT NULL,
  `borrower_id` int(255) DEFAULT NULL,
  `period_date` timestamp NULL DEFAULT NULL,
  `due_date` varchar(255) DEFAULT NULL,
  `date_paid` varchar(255) DEFAULT NULL,
  `mode_of_payment` varchar(255) DEFAULT NULL,
  `mode_number` varchar(255) DEFAULT NULL,
  `monthly_payment` varchar(255) DEFAULT NULL,
  `total` decimal(10,0) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `interest_due` varchar(255) DEFAULT NULL,
  `partial` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role_id` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `created_at`, `updated_at`, `role_id`) VALUES
(11, 'Can Add Property', NULL, NULL, '\0\0\0-\0\0\0\0\0\0\0\0\0\0\0\0\0€\0\0\0\0\0\0Can Edit Property\0\0 \0/\0\0\0\0\0\0\0\r\0\0\0\0\0\0€\0\0\0\0\0\0Can Delete Property\0(\0-\0\0\0\0\0\0\0\0\0'),
(12, 'Can Edit Property', NULL, NULL, '\0\0 \0/\0\0\0\0\0\0\0\r\0\0\0\0\0\0€\0\0\0\0\0\0Can Delete Property\0(\0-\0\0\0\0\0\0\0\0\0\0\0\0\0€\0\0\0\0\0\0Can View Property\0\00\0*\0\0\0\0\0\0\0\0\0\0\0\0\0€\0\0\0\0\0\0C'),
(13, 'Can Delete Property', NULL, NULL, '\0(\0-\0\0\0\0\0\0\0\0\0\0\0\0\0€\0\0\0\0\0\0Can View Property\0\00\0*\0\0\0\0\0\0\0\0\0\0\0\0\0€\0\0\0\0\0\0Can Add Tenant\0\08\0+\0\0\0\0\0\0\0\0\0\0\0\0\0€\0\0\0\0\0\0Can Ed'),
(14, 'Can View Property', NULL, NULL, '\0\00\0*\0\0\0\0\0\0\0\0\0\0\0\0\0€\0\0\0\0\0\0Can Add Tenant\0\08\0+\0\0\0\0\0\0\0\0\0\0\0\0\0€\0\0\0\0\0\0Can Edit Tenant\0\0@\0-\0\0\0\0\0\0\0\0\0\0\0\0\0€\0\0\0\0\0\0Can Dele'),
(15, 'Can Add Tenant', NULL, NULL, '\0\08\0+\0\0\0\0\0\0\0\0\0\0\0\0\0€\0\0\0\0\0\0Can Edit Tenant\0\0@\0-\0\0\0\0\0\0\0\0\0\0\0\0\0€\0\0\0\0\0\0Can Delete Tenant\0\0H\0+\0\0\0\0\0\0\0\0\0\0\0\0\0€\0\0\0\0\0\0Can V'),
(16, 'Can Edit Tenant', NULL, NULL, '\0\0@\0-\0\0\0\0\0\0\0\0\0\0\0\0\0€\0\0\0\0\0\0Can Delete Tenant\0\0H\0+\0\0\0\0\0\0\0\0\0\0\0\0\0€\0\0\0\0\0\0Can View Tenant\0\0P\02\0\0\0\0\0\0\0\0\0\0\0\0\0€\0\0\0\0\0\0'),
(17, 'Can Delete Tenant', NULL, NULL, '\0\0H\0+\0\0\0\0\0\0\0\0\0\0\0\0\0€\0\0\0\0\0\0Can View Tenant\0\0P\02\0\0\0\0\0\0\0\0\0\0\0\0\0€\0\0\0\0\0\0Can Add Tenant Payment\0\0X\03\0\0\0\0\0\0\0\0\0\0\0\0\0€\0'),
(18, 'Can View Tenant', NULL, NULL, '\0\0P\02\0\0\0\0\0\0\0\0\0\0\0\0\0€\0\0\0\0\0\0Can Add Tenant Payment\0\0X\03\0\0\0\0\0\0\0\0\0\0\0\0\0€\0\0\0\0\0\0Can Edit Tenant Payment\0\0`þ*\0\0\0\0\0\0\0'),
(19, 'Can Add Tenant Payment', NULL, NULL, '\0\0X\03\0\0\0\0\0\0\0\0\0\0\0\0\0€\0\0\0\0\0\0Can Edit Tenant Payment\0\0`þ*\0\0\0\0\0\0\0\0\0\0\0\0\0€\0\0\0\0\0\0Can View Tenant Payment\0\0\0\0\0\0\0\0\0\0\0\0\0\0'),
(20, 'Can Edit Tenant Payment', NULL, NULL, '\0\0`þ*\0\0\0\0\0\0\0\0\0\0\0\0\0€\0\0\0\0\0\0Can View Tenant Payment\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0'),
(21, 'Can View Tenant Payment', NULL, NULL, '\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0');

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `property`
--

CREATE TABLE `property` (
  `id` int(255) NOT NULL,
  `property_no` varchar(255) DEFAULT NULL,
  `property_name` varchar(255) DEFAULT NULL,
  `date_created` date DEFAULT NULL,
  `complete_address` varchar(255) DEFAULT NULL,
  `bedrooms` varchar(255) DEFAULT NULL,
  `sq` varchar(255) DEFAULT NULL,
  `carpark` varchar(255) DEFAULT NULL,
  `toilet` varchar(255) DEFAULT NULL,
  `bath` varchar(255) DEFAULT NULL,
  `monthlyrate` varchar(255) DEFAULT NULL,
  `property_type` varchar(255) DEFAULT NULL,
  `status_type` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `furnishing` varchar(255) DEFAULT NULL,
  `image1` varchar(255) DEFAULT NULL,
  `rentedidle` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `image2` varchar(45) DEFAULT NULL,
  `image3` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `permission_id` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`, `status`, `permission_id`) VALUES
(1, 'Administrator', '2024-01-21 06:13:21', '2024-01-21 06:30:17', NULL, 'Active', '11,12,13,14,15,16,17,18,19,20,21'),
(2, 'Viewer', '2024-01-21 06:14:06', '2024-01-21 06:14:06', NULL, 'Active', '14,18,21'),
(3, 'Moderator', '2024-01-21 06:26:00', '2024-01-21 06:29:59', NULL, 'Active', '11,19,15,14,13');

-- --------------------------------------------------------

--
-- Table structure for table `tenant`
--

CREATE TABLE `tenant` (
  `id` int(255) NOT NULL,
  `property_id` int(255) DEFAULT NULL,
  `date_created` date DEFAULT NULL,
  `tenant_name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `contact_number` varchar(255) DEFAULT NULL,
  `rate` varchar(255) DEFAULT NULL,
  `period` varchar(255) DEFAULT NULL,
  `duedate` date DEFAULT NULL,
  `contracts` varchar(255) DEFAULT NULL,
  `id1` varchar(255) DEFAULT NULL,
  `id2` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `tenant_no` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tenant_payment`
--

CREATE TABLE `tenant_payment` (
  `id` int(10) NOT NULL,
  `tenant_id` int(255) DEFAULT NULL,
  `property_id` int(255) DEFAULT NULL,
  `user_id` int(255) DEFAULT NULL,
  `invoice` varchar(255) DEFAULT NULL,
  `mode_of_payment` varchar(250) DEFAULT NULL,
  `acctno` varchar(255) DEFAULT NULL,
  `amount` varchar(250) DEFAULT NULL,
  `paymentproof` varchar(255) DEFAULT NULL,
  `date_paid` varchar(255) DEFAULT NULL,
  `status` varchar(250) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact_no` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_role` varchar(255) DEFAULT NULL,
  `last_login_at` timestamp NULL DEFAULT NULL,
  `last_login_ip` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `new_column` varchar(255) NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `module` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `contact_no`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `user_role`, `last_login_at`, `last_login_ip`, `status`, `new_column`, `role_id`, `module`) VALUES
(1, 'Danrick C. Tekiko', 'dcode0516@gmail.com', '09199533529', NULL, '$2y$10$G6qKUlHIjzwDrBhTNogQoefBHYEcyWcu8S94TYWyXylDsD8CyIiLu', NULL, '2023-01-24 04:43:52', '2024-01-04 03:17:09', 'Admin', '2024-01-04 03:17:09', '::1', 'Active', '', 2, 'Property Modeule'),
(2, 'password', 'al@gmail.com', '09199533529', NULL, '$2y$10$tos0uRCnc2wONsm5OdGYI.LWdSGxQR3XCwzKRSYK0K7lIh8iDE8jm', NULL, '2023-07-06 07:47:45', '2023-07-06 08:00:08', 'User', '2023-07-06 08:00:08', '::1', 'Active', '', 0, NULL),
(3, 'password', 'siarez@gmail.com', '09199533529', NULL, '$2y$10$7DEtB0QLVow9NlbOM5Ssd.c5yFdT3iqv6A6.tcjyueFLIXc0.enkC', NULL, '2023-07-06 07:48:27', '2023-07-06 07:48:27', 'User', NULL, NULL, 'Active', '', 0, NULL),
(4, 'password', 'cristal@gmail.com', '09199533529', NULL, '$2y$10$3tatTWxmeRshqRepGHdq1eR2hYbKD7OdNaS6OPNbFbbXOken7EPMO', NULL, '2023-07-06 07:50:13', '2023-07-06 07:50:13', 'User', NULL, NULL, 'Active', '', 0, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agent`
--
ALTER TABLE `agent`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `borrower`
--
ALTER TABLE `borrower`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `loans`
--
ALTER TABLE `loans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loan_details`
--
ALTER TABLE `loan_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loan_payments`
--
ALTER TABLE `loan_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `memorial`
--
ALTER TABLE `memorial`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `memorial_sold`
--
ALTER TABLE `memorial_sold`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_unique` (`name`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permission_role_permission_id_foreign` (`permission_id`),
  ADD KEY `permission_role_role_id_foreign` (`role_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `property`
--
ALTER TABLE `property`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `tenant`
--
ALTER TABLE `tenant`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tenant_payment`
--
ALTER TABLE `tenant_payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agent`
--
ALTER TABLE `agent`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `borrower`
--
ALTER TABLE `borrower`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `loans`
--
ALTER TABLE `loans`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `loan_details`
--
ALTER TABLE `loan_details`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `loan_payments`
--
ALTER TABLE `loan_payments`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `memorial`
--
ALTER TABLE `memorial`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `memorial_sold`
--
ALTER TABLE `memorial_sold`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `permission_role`
--
ALTER TABLE `permission_role`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `property`
--
ALTER TABLE `property`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tenant`
--
ALTER TABLE `tenant`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tenant_payment`
--
ALTER TABLE `tenant_payment`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
