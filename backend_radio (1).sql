-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 23, 2024 at 05:39 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `backend_radio`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_name` varchar(191) NOT NULL,
  `image` varchar(191) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `user_id`, `category_name`, `image`, `status`, `created_at`, `updated_at`) VALUES
(2, 1, 'Lillian Sears', 'uploads/categories/17110395012default-app-logo.png', 'Active', '2024-03-21 10:45:01', '2024-03-21 10:51:58'),
(3, 1, 'Hasad Shepherd', 'uploads/categories/17110402992unnamed.png', 'Active', '2024-03-21 10:58:19', '2024-03-21 10:58:19'),
(4, 1, 'Alana Haley', 'uploads/categories/17110403073pngtree-music-festival-png-image_4672455.jpg', 'Active', '2024-03-21 10:58:27', '2024-03-21 10:58:27');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `country_name` varchar(191) NOT NULL,
  `image` varchar(191) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `user_id`, `country_name`, `image`, `status`, `created_at`, `updated_at`) VALUES
(2, 1, 'Adria Hall', 'uploads/country/17110433542pngtree-music-festival-png-image_4672455.jpg', 'Active', '2024-03-21 11:49:14', '2024-03-21 12:07:43'),
(3, 1, 'Maisie Barry', 'uploads/country/17110433793south-east-bank-limited.jpg', 'Active', '2024-03-21 11:49:39', '2024-03-21 13:32:15');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) NOT NULL,
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
  `migration` varchar(191) NOT NULL,
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
(5, '2024_03_21_160649_create_categories_table', 2),
(6, '2024_03_21_170018_create_countries_table', 3),
(7, '2024_03_21_180108_create_radios_table', 4),
(9, '2024_03_21_192658_create_settings_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `radios`
--

CREATE TABLE `radios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `radio_name` varchar(191) NOT NULL,
  `radio_url` varchar(191) NOT NULL,
  `image` varchar(191) NOT NULL,
  `description` text DEFAULT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `radios`
--

INSERT INTO `radios` (`id`, `user_id`, `category_id`, `country_id`, `radio_name`, `radio_url`, `image`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 2, 'Katelyn Joyner', 'https://www.tijepizoqiteh.cc', 'uploads/radio/17110467084default-app-logo.png', '<span style=\"color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam ut purus libero. In commodo, tellus sit amet fringilla efficitur, metus neque interdum purus, et vestibulum ligula arcu sed lorem. Integer eget posuere ante. Praesent ac turpis a orci tincidunt tincidunt. In fermentum augue quis viverra bibendum. Nam et arcu nec sem scelerisque gravida quis ac felis. Mauris id rhoncus ipsum, rutrum mattis orci. Ut eu dui vitae eros malesuada molestie non a eros. Aliquam id risus vel tellus sagittis rutrum non ac lorem. Nullam rutrum tempor urna id sagittis. Quisque tortor purus, vestibulum ut quam fringilla, elementum imperdiet erat. Vestibulum sed quam consectetur, volutpat risus molestie, pulvinar ipsum.</span>', 'Active', '2024-03-21 12:45:08', '2024-03-21 13:01:11'),
(3, 1, 4, 2, 'Amir Stanton', 'https://www.reqypiruqorulyr.biz', 'uploads/radio/171104845542021-10-01.jpg', '<span style=\"color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam ut purus libero. In commodo, tellus sit amet fringilla efficitur, metus neque interdum purus, et vestibulum ligula arcu sed lorem. Integer eget posuere ante. Praesent ac turpis a orci tincidunt tincidunt. In fermentum augue quis viverra bibendum. Nam et arcu nec sem scelerisque gravida quis ac felis. Mauris id rhoncus ipsum, rutrum mattis orci. Ut eu dui vitae eros malesuada molestie non a eros. Aliquam id risus vel tellus sagittis rutrum non ac lorem. Nullam rutrum tempor urna id sagittis. Quisque tortor purus, vestibulum ut quam fringilla, elementum imperdiet erat. Vestibulum sed quam consectetur, volutpat risus molestie, pulvinar ipsum.</span>', 'Active', '2024-03-21 13:14:15', '2024-04-19 07:43:19');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `app_name` varchar(191) DEFAULT 'Online Radio',
  `app_logo` varchar(191) DEFAULT 'defaults/1711050741radio-microphone-logo-design-vector.jpg',
  `select_ads` varchar(191) DEFAULT NULL,
  `admob_app_id` varchar(191) DEFAULT NULL,
  `admob_banner_id` varchar(191) DEFAULT NULL,
  `admob_native_id` varchar(191) DEFAULT NULL,
  `abmob_interstial_id` varchar(191) DEFAULT NULL,
  `admob_ads_unit` varchar(191) DEFAULT NULL,
  `applovin_app_id` varchar(191) DEFAULT NULL,
  `applovin_banner_id` varchar(191) DEFAULT NULL,
  `applovin_native_id` varchar(191) DEFAULT NULL,
  `applovin_interstial_id` varchar(191) DEFAULT NULL,
  `applovin_ads_unit` varchar(191) DEFAULT NULL,
  `facebook_app_id` varchar(191) DEFAULT NULL,
  `facebook_banner_id` varchar(191) DEFAULT NULL,
  `facebook_native_id` varchar(191) DEFAULT NULL,
  `facebook_interstial_id` varchar(191) DEFAULT NULL,
  `facebook_ads_unit` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `app_name`, `app_logo`, `select_ads`, `admob_app_id`, `admob_banner_id`, `admob_native_id`, `abmob_interstial_id`, `admob_ads_unit`, `applovin_app_id`, `applovin_banner_id`, `applovin_native_id`, `applovin_interstial_id`, `applovin_ads_unit`, `facebook_app_id`, `facebook_banner_id`, `facebook_native_id`, `facebook_interstial_id`, `facebook_ads_unit`, `created_at`, `updated_at`) VALUES
(1, 'Online Radio', 'defaults/1711050741radio-microphone-logo-design-vector.jpg', 'admob', 'Sed blanditiis culpa', 'Asperiores sed ut ad', 'In sunt cillum aspe', 'Necessitatibus deser', 'Commodi quisquam con', 'Enim et voluptas tem', 'Et sunt dicta est de', 'Nihil voluptatem fu', 'Vero porro delectus', 'Officia dolor proide', 'Itaque optio volupt', 'Facere dolor deserun', 'Dolorem harum except', 'Consectetur enim ali', 'Repudiandae atque in', NULL, '2024-04-21 09:13:37');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` int(11) NOT NULL,
  `name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `phone` varchar(191) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) NOT NULL,
  `device_token` varchar(191) DEFAULT NULL,
  `image` varchar(191) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `name`, `email`, `phone`, `email_verified_at`, `password`, `device_token`, `image`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, 'Admin', 'admin@gmail.com', NULL, NULL, '$2y$10$YRAmtzYpG9AlzkGbHN3GIecXSnyEDlJ/z0tkc1t.qt5/Udh/09Zd.', NULL, 'uploads/users/17110518551download (2).png', NULL, NULL, '2024-03-21 14:20:26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_category_name_unique` (`category_name`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `countries_country_name_unique` (`country_name`);

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
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `radios`
--
ALTER TABLE `radios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `radios_radio_name_unique` (`radio_name`),
  ADD UNIQUE KEY `radios_radio_url_unique` (`radio_url`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `radios`
--
ALTER TABLE `radios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
