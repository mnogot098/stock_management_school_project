-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Mar 31, 2021 at 12:38 PM
-- Server version: 5.7.28
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stock`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `category` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category`, `created_at`, `updated_at`) VALUES
(1, 'Category A', '2021-02-21 16:47:09', '2021-02-21 16:47:09'),
(2, 'Category B', '2021-02-21 16:47:09', '2021-02-21 16:47:09'),
(3, 'Category C', '2021-02-21 16:47:09', '2021-02-21 16:47:09');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

DROP TABLE IF EXISTS `invoices`;
CREATE TABLE IF NOT EXISTS `invoices` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `supplier_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(8,2) NOT NULL,
  `finalized` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `invoices_supplier_id_foreign` (`supplier_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1002 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `date`, `supplier_id`, `amount`, `finalized`) VALUES
(1000, '2021-03-29 13:16:03', 1, '1500.00', 1),
(1001, '2021-03-30 19:44:59', 1, '1500.00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2021_03_03_164553_categories', 1),
(2, '2021_03_03_162953_products', 2),
(3, '2021_03_03_170513_suppliers', 3),
(4, '2021_03_24_175030_shipments', 4),
(5, '2021_03_25_133300_update_shipments', 5),
(8, '2021_03_29_121235_invoices', 6);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `label` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `supplier_id` bigint(20) UNSIGNED NOT NULL,
  `buying_cost` decimal(8,2) NOT NULL,
  `selling_cost` decimal(8,2) NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`),
  KEY `products_category_id_foreign` (`category_id`),
  KEY `supplier_id` (`supplier_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `label`, `description`, `category_id`, `quantity`, `supplier_id`, `buying_cost`, `selling_cost`, `created_at`, `updated_at`) VALUES
(1, 'Product A', 'Lorem ipsum dolor sit amet, \r\nconsectetur adipiscing elit.', 1, 1540, 1, '120.00', '150.00', '2021-02-21 16:47:09', '2021-03-30 18:44:59'),
(2, 'Product B', 'Lorem ipsum dolor sit amet, \r\nconsectetur adipiscing elit.', 2, 3000, 1, '120.00', '150.00', '2021-02-21 16:47:09', '2021-03-26 17:01:49'),
(3, 'Product C', 'Lorem ipsum.', 1, 400, 1, '120.00', '150.00', '2021-02-21 16:47:09', '2021-03-26 11:25:55'),
(4, 'Product E', 'Lorem ipsum', 1, 300, 1, '120.00', '150.00', '2021-03-05 13:12:34', '2021-03-05 13:12:34');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(300) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `name`) VALUES
(1, 'Admin'),
(2, 'Employee');

-- --------------------------------------------------------

--
-- Table structure for table `shipments`
--

DROP TABLE IF EXISTS `shipments`;
CREATE TABLE IF NOT EXISTS `shipments` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `shipment_type_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `total_price` decimal(8,2) NOT NULL,
  `finalized` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `shipments_product_id_foreign` (`product_id`),
  KEY `type_id` (`shipment_type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1018 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shipments`
--

INSERT INTO `shipments` (`id`, `date`, `shipment_type_id`, `quantity`, `product_id`, `total_price`, `finalized`) VALUES
(1000, '2021-03-10', 1, 400, 1, '500.00', 0),
(1001, '2021-03-25', 2, 100, 2, '15000.50', 1),
(1002, '2021-03-30', 1, 300, 1, '1300.00', 0),
(1008, '2020-10-13', 1, 200, 3, '3245.00', 1),
(1007, '2021-03-31', 1, 300, 4, '1300.00', 0),
(1009, '2021-02-16', 2, 211, 4, '31650.00', 0),
(1010, '2021-01-01', 2, 400, 1, '60000.00', 0),
(1011, '2021-02-16', 2, 500, 2, '75000.00', 0),
(1012, '2021-04-13', 2, 200, 2, '30000.00', 0),
(1013, '2021-03-29', 2, 70, 2, '10500.00', 0),
(1014, '2021-06-15', 2, 30, 1, '4500.00', 0),
(1015, '2021-07-08', 2, 100, 2, '15000.00', 0),
(1016, '2021-08-10', 1, 10, 1, '1500.00', 1),
(1017, '2021-09-28', 2, 30, 1, '4500.00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `shipment_types`
--

DROP TABLE IF EXISTS `shipment_types`;
CREATE TABLE IF NOT EXISTS `shipment_types` (
  `id` int(11) NOT NULL,
  `type` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `shipment_types`
--

INSERT INTO `shipment_types` (`id`, `type`) VALUES
(1, 'Incoming'),
(2, 'Outgoing');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

DROP TABLE IF EXISTS `suppliers`;
CREATE TABLE IF NOT EXISTS `suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `first_name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `first_name`, `last_name`, `email`, `address`, `phone_number`, `created_at`, `updated_at`) VALUES
(1, 'Mohamed', 'Mohamed', 'mohamed@gmail.com', 'some random address 13', '12345678', '2021-02-21 16:47:09', '2021-02-21 16:47:09'),
(2, 'Ali', 'Ali', 'Ali@gmail.com', 'some random address 13', '123456789', '2021-02-21 16:47:09', '2021-03-22 14:21:01'),
(3, 'Jamal', 'Jamal', 'jamal@gmail.com', 'some random address 13', '12345678', '2021-02-21 16:47:09', '2021-02-21 16:47:09'),
(4, 'Mohcine', 'BAADI', 'baadimohsin@gmail.com', 'some random address', '123456789', '2021-03-05 13:59:39', '2021-03-05 13:59:39');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `role_id` (`role_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `address`, `phone_number`, `role_id`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Mohcine', 'BAADI', 'some random address', '12345678', 1, 'admin@gmail.com', NULL, '$2y$10$V2gIR1ECLM6Y6QmeBLUhHeqPfI8.mRteLlmvrCTDj2ZqKQMu6k48q', 'kTueOnMfLLpyUW1aJH6UOeZNswA76WoHokdIxajMLqe9l6IMEEiVykC375eR', '2021-02-21 16:47:09', '2021-03-25 20:54:36'),
(2, 'someone', 'BAADI', 'random', '1234234523', 2, 'ba3di1999@gmail.com', NULL, '$2y$10$b95l/xYKX1AHokBIvCLxT.lM2P/Hl3itcEQqCMdfHXbW4.kJfnKsO', NULL, '2021-03-22 16:12:55', '2021-03-22 16:42:52'),
(4, 'employee', 'employee', 'randomm', '123456789', 2, 'employee@gmail.com', NULL, '$2y$10$cwRGidyUBs3QYGTQz8TxmuHMIiXGtY1CpfJbeqyY6eb0Irf.K5q6i', NULL, '2021-03-23 12:47:46', '2021-03-30 11:02:55');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
