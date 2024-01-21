-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 21, 2024 at 08:47 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel-vue-restuarant-spa`
--

-- --------------------------------------------------------

--
-- Table structure for table `dishes`
--

CREATE TABLE `dishes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `price` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dishes`
--

INSERT INTO `dishes` (`id`, `name`, `description`, `image_url`, `price`, `created_at`, `updated_at`) VALUES
(1, 'Dish One', 'Dish One description', '/storage/images/uQ6HYdJC6Qhkfeo5bSS7gd6gmr2813UH5LBgmTkv.jpg', 1000, '2024-01-21 13:02:24', '2024-01-21 13:02:24'),
(2, 'Dish Two', 'Dish Two description', '/storage/images/6R2NUwuU5GPpSwNMRuUOgnVokIFKwCXQ0oay2Xug.jpg', 1100, '2024-01-21 13:02:57', '2024-01-21 13:02:57'),
(3, 'Dish Three', 'Dish Three description', '/storage/images/kHrnV8rXfqMX2CpiVVl1Q8unuOOy6dtY6IT4grEb.jpg', 1300, '2024-01-21 13:03:57', '2024-01-21 13:03:57'),
(4, 'Dish Four', 'Dish Four description', '/storage/images/Wkpt1O5zOGcMLez699uDUHYbPkyGNAAk3VlGXczI.jpg', 1200, '2024-01-21 13:05:12', '2024-01-21 13:05:12'),
(5, 'Dish Five', 'Dish Five description', '/storage/images/HSnD0tjL4O7c7jIPHhsR4xT8TUrp1NSyJLDo9LCM.jpg', 2500, '2024-01-21 13:05:47', '2024-01-21 13:05:47'),
(6, 'Dish Six', 'Dish Six description', '/storage/images/OkHRzNriiSYadiwIp1TgoragnaosG50zXT7ILncS.jpg', 1500, '2024-01-21 13:07:37', '2024-01-21 13:07:37'),
(7, 'Dish Seven', 'Dish Seven description', '/storage/images/4gpGxXF0ndZPYqkwXn7sRyIdYeq7kkkdPcJABy04.jpg', 2000, '2024-01-21 13:08:06', '2024-01-21 13:08:06'),
(8, 'Dish Eight', 'Dish Eigh description', '/storage/images/G2LI5mmOZ5nAUOdHBizgs3BkOLJfLXGCLftDdb57.jpg', 2000, '2024-01-21 13:08:31', '2024-01-21 14:39:37'),
(9, 'Dish Nine', 'Dish Nine description', '/storage/images/F43sBYSRrGOivd499NVF8bvuSLEMNnVbRALg309x.jpg', 1000, '2024-01-21 13:09:19', '2024-01-21 13:09:19'),
(10, 'Dish Ten', 'Dish Ten description', '/storage/images/I42xYJOt4IiANQ3cbcAQnZJFRZ5jwLIvgYFdOVBr.jpg', 2000, '2024-01-21 13:09:42', '2024-01-21 13:09:42');

-- --------------------------------------------------------

--
-- Table structure for table `dish_user`
--

CREATE TABLE `dish_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `dish_id` bigint(20) UNSIGNED NOT NULL,
  `rating` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dish_user`
--

INSERT INTO `dish_user` (`id`, `user_id`, `dish_id`, `rating`) VALUES
(1, 1, 1, 4);

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
(14, '2014_10_12_000000_create_users_table', 1),
(15, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(16, '2019_08_19_000000_create_failed_jobs_table', 1),
(17, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(18, '2024_01_19_105936_add_username_and_nickname_to_users_table', 1),
(19, '2024_01_19_192854_create_dishes_table', 1),
(20, '2024_01_20_124842_create_dish_user_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
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
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_name` varchar(255) NOT NULL,
  `nick_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `user_name`, `nick_name`) VALUES
(1, 'admin', 'admin@gmail.com', NULL, '$2y$12$zeyC.zwsx005ukBmWVlmFe8t4qfnkRPNMgwbnhqHQ98AKdYlX24G.', NULL, '2024-01-21 12:56:52', '2024-01-21 12:56:52', 'admin', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dishes`
--
ALTER TABLE `dishes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `dishes_name_unique` (`name`),
  ADD UNIQUE KEY `dishes_description_unique` (`description`);

--
-- Indexes for table `dish_user`
--
ALTER TABLE `dish_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `dish_user_user_id_dish_id_unique` (`user_id`,`dish_id`),
  ADD KEY `dish_user_dish_id_foreign` (`dish_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_user_name_unique` (`user_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dishes`
--
ALTER TABLE `dishes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `dish_user`
--
ALTER TABLE `dish_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dish_user`
--
ALTER TABLE `dish_user`
  ADD CONSTRAINT `dish_user_dish_id_foreign` FOREIGN KEY (`dish_id`) REFERENCES `dishes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `dish_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
