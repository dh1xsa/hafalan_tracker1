-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 11, 2025 at 07:33 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hafalan`
--

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `groups_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `groups_name`, `created_at`, `updated_at`) VALUES
(1, 'Kelas B', '2025-06-02 20:34:12', '2025-06-02 20:34:12'),
(2, 'Kelas A', '2025-06-02 20:34:21', '2025-06-02 20:34:21'),
(4, 'Kelas C', '2025-06-02 20:35:13', '2025-06-02 20:35:13'),
(5, 'Kelas A', '2025-06-02 20:35:46', '2025-06-02 20:35:46');

-- --------------------------------------------------------

--
-- Table structure for table `group_user`
--

CREATE TABLE `group_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `group_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `group_user`
--

INSERT INTO `group_user` (`id`, `group_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 2, 2, NULL, NULL),
(4, 4, 2, NULL, NULL),
(5, 5, 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `hafalans`
--

CREATE TABLE `hafalans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `group_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `hafalan` text NOT NULL,
  `description` text NOT NULL,
  `status` enum('belum','proses','selesai','perlu diulang') NOT NULL DEFAULT 'belum',
  `score` tinyint(3) UNSIGNED DEFAULT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hafalans`
--

INSERT INTO `hafalans` (`id`, `group_id`, `user_id`, `student_id`, `hafalan`, `description`, `status`, `score`, `date`, `created_at`, `updated_at`) VALUES
(1, 2, 2, 2, '1:1-7', 'belum begitu bagus dalam bcaan tajwid', 'selesai', NULL, '2025-06-03', '2025-06-02 21:18:54', '2025-06-02 21:18:54'),
(2, 1, 1, 4, '2:1-286', 'hebat', 'selesai', NULL, '2025-06-03', '2025-06-02 21:28:02', '2025-06-02 21:28:02');

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
(1, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(2, '2025_05_30_080755_create_groups_table', 1),
(3, '2025_05_30_080805_create_users_table', 1),
(4, '2025_05_30_080904_create_students_table', 1),
(5, '2025_05_30_080917_create_hafalans_table', 1),
(6, '2025_05_30_084834_create_group_user_table', 1),
(7, '2025_06_03_030958_create_students_pure_table', 1);

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
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `group_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `birth_date` date NOT NULL,
  `gender` enum('L','P') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `user_id`, `group_id`, `name`, `password`, `birth_date`, `gender`, `created_at`, `updated_at`) VALUES
(2, 2, 2, '1', '$2y$12$u/aINF3QksdStZthvWCxgeRAmbENXcZ8LVnquQJ1p94Y4/BD2nBMu', '2011-01-23', 'L', '2025-06-02 21:13:35', '2025-06-02 21:13:35'),
(3, 1, 1, 'Siswa 13', '$2y$12$xXMh1CqXd3q0nq4Qc6WHAeHX23Y0HVMyS1mLDPw8mJqDFrzgMb4Sq', '2012-03-30', 'L', '2025-06-02 21:23:48', '2025-06-02 21:23:48'),
(4, 1, 1, 'Siswa 10', '$2y$12$RXGaTx1NTECJ9VeMHw4jyOK4XdR8rhChIcjnE6XJbN/Rc2TPZr4cK', '2015-05-14', 'P', '2025-06-02 21:25:28', '2025-06-02 21:25:28'),
(5, 1, 1, 'Siswa 8', '$2y$12$fULgLJT.SKZH2Nq92/8OyeyVw6rGGp.cqVKUdX3cdYaoJnUej0WkG', '2011-10-15', 'L', '2025-06-02 21:25:42', '2025-06-02 21:25:42'),
(6, 1, 1, 'Siswa 30', '$2y$12$KnELnzjN6x9HV/6GQuqOY.1/J6FvzojZsg7S9HguvJf1P8cayjE0G', '2013-04-01', 'L', '2025-06-02 21:27:19', '2025-06-02 21:27:19');

-- --------------------------------------------------------

--
-- Table structure for table `students_pure`
--

CREATE TABLE `students_pure` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `birth_date` date NOT NULL,
  `gender` enum('L','P') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students_pure`
--

INSERT INTO `students_pure` (`id`, `name`, `birth_date`, `gender`, `created_at`, `updated_at`) VALUES
(1, 'Siswa 1', '2011-01-23', 'L', '2025-06-02 20:33:06', '2025-06-02 20:33:06'),
(2, 'Siswa 2', '2014-01-17', 'P', '2025-06-02 20:33:06', '2025-06-02 20:33:06'),
(3, 'Siswa 3', '2010-12-24', 'L', '2025-06-02 20:33:06', '2025-06-02 20:33:06'),
(4, 'Siswa 4', '2013-02-18', 'L', '2025-06-02 20:33:06', '2025-06-02 20:33:06'),
(5, 'Siswa 5', '2013-01-13', 'L', '2025-06-02 20:33:06', '2025-06-02 20:33:06'),
(6, 'Siswa 6', '2013-12-25', 'L', '2025-06-02 20:33:06', '2025-06-02 20:33:06'),
(7, 'Siswa 7', '2011-12-08', 'L', '2025-06-02 20:33:06', '2025-06-02 20:33:06'),
(8, 'Siswa 8', '2011-10-15', 'L', '2025-06-02 20:33:06', '2025-06-02 20:33:06'),
(9, 'Siswa 9', '2012-11-14', 'L', '2025-06-02 20:33:06', '2025-06-02 20:33:06'),
(10, 'Siswa 10', '2015-05-14', 'P', '2025-06-02 20:33:06', '2025-06-02 20:33:06'),
(11, 'Siswa 11', '2012-02-15', 'P', '2025-06-02 20:33:06', '2025-06-02 20:33:06'),
(12, 'Siswa 12', '2013-03-23', 'L', '2025-06-02 20:33:06', '2025-06-02 20:33:06'),
(13, 'Siswa 13', '2012-03-30', 'L', '2025-06-02 20:33:06', '2025-06-02 20:33:06'),
(14, 'Siswa 14', '2013-04-01', 'P', '2025-06-02 20:33:06', '2025-06-02 20:33:06'),
(15, 'Siswa 15', '2012-10-23', 'P', '2025-06-02 20:33:06', '2025-06-02 20:33:06'),
(16, 'Siswa 16', '2014-05-17', 'P', '2025-06-02 20:33:06', '2025-06-02 20:33:06'),
(17, 'Siswa 17', '2012-03-02', 'L', '2025-06-02 20:33:06', '2025-06-02 20:33:06'),
(18, 'Siswa 18', '2013-03-14', 'P', '2025-06-02 20:33:06', '2025-06-02 20:33:06'),
(19, 'Siswa 19', '2012-04-19', 'P', '2025-06-02 20:33:06', '2025-06-02 20:33:06'),
(20, 'Siswa 20', '2010-07-11', 'P', '2025-06-02 20:33:06', '2025-06-02 20:33:06'),
(21, 'Siswa 21', '2011-06-20', 'L', '2025-06-02 20:33:06', '2025-06-02 20:33:06'),
(22, 'Siswa 22', '2013-07-19', 'P', '2025-06-02 20:33:06', '2025-06-02 20:33:06'),
(23, 'Siswa 23', '2012-05-12', 'P', '2025-06-02 20:33:06', '2025-06-02 20:33:06'),
(24, 'Siswa 24', '2011-05-06', 'L', '2025-06-02 20:33:06', '2025-06-02 20:33:06'),
(25, 'Siswa 25', '2013-10-02', 'P', '2025-06-02 20:33:06', '2025-06-02 20:33:06'),
(26, 'Siswa 26', '2011-12-30', 'L', '2025-06-02 20:33:06', '2025-06-02 20:33:06'),
(27, 'Siswa 27', '2014-06-14', 'P', '2025-06-02 20:33:06', '2025-06-02 20:33:06'),
(28, 'Siswa 28', '2012-09-28', 'L', '2025-06-02 20:33:06', '2025-06-02 20:33:06'),
(29, 'Siswa 29', '2014-05-19', 'L', '2025-06-02 20:33:06', '2025-06-02 20:33:06'),
(30, 'Siswa 30', '2013-04-01', 'L', '2025-06-02 20:33:06', '2025-06-02 20:33:06'),
(31, 'Siswa 31', '2012-03-17', 'L', '2025-06-02 20:33:06', '2025-06-02 20:33:06'),
(32, 'Siswa 32', '2014-09-13', 'L', '2025-06-02 20:33:06', '2025-06-02 20:33:06'),
(33, 'Siswa 33', '2012-09-06', 'L', '2025-06-02 20:33:06', '2025-06-02 20:33:06'),
(34, 'Siswa 34', '2013-09-17', 'P', '2025-06-02 20:33:06', '2025-06-02 20:33:06'),
(35, 'Siswa 35', '2014-05-31', 'L', '2025-06-02 20:33:06', '2025-06-02 20:33:06'),
(36, 'Siswa 36', '2014-10-13', 'L', '2025-06-02 20:33:06', '2025-06-02 20:33:06'),
(37, 'Siswa 37', '2012-06-27', 'P', '2025-06-02 20:33:06', '2025-06-02 20:33:06'),
(38, 'Siswa 38', '2010-06-25', 'L', '2025-06-02 20:33:06', '2025-06-02 20:33:06'),
(39, 'Siswa 39', '2012-02-12', 'L', '2025-06-02 20:33:06', '2025-06-02 20:33:06'),
(40, 'Siswa 40', '2013-03-15', 'P', '2025-06-02 20:33:06', '2025-06-02 20:33:06'),
(41, 'Siswa 41', '2011-04-13', 'P', '2025-06-02 20:33:06', '2025-06-02 20:33:06'),
(42, 'Siswa 42', '2014-03-19', 'L', '2025-06-02 20:33:06', '2025-06-02 20:33:06'),
(43, 'Siswa 43', '2015-03-07', 'L', '2025-06-02 20:33:06', '2025-06-02 20:33:06'),
(44, 'Siswa 44', '2014-12-28', 'L', '2025-06-02 20:33:06', '2025-06-02 20:33:06'),
(45, 'Siswa 45', '2010-06-08', 'L', '2025-06-02 20:33:06', '2025-06-02 20:33:06'),
(46, 'Siswa 46', '2010-08-22', 'L', '2025-06-02 20:33:06', '2025-06-02 20:33:06'),
(47, 'Siswa 47', '2014-07-08', 'L', '2025-06-02 20:33:06', '2025-06-02 20:33:06'),
(48, 'Siswa 48', '2014-07-24', 'L', '2025-06-02 20:33:06', '2025-06-02 20:33:06'),
(49, 'Siswa 49', '2013-01-28', 'P', '2025-06-02 20:33:06', '2025-06-02 20:33:06'),
(50, 'Siswa 50', '2013-10-12', 'P', '2025-06-02 20:33:06', '2025-06-02 20:33:06');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `level` enum('1','2') NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `birth_date` date NOT NULL,
  `gender` enum('L','P') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `level`, `name`, `password`, `birth_date`, `gender`, `created_at`, `updated_at`) VALUES
(1, '2', 'pak istakim', '$2y$12$rHLR.QzclTVTlp.UCfzPEeJGyHwHcXMdHyeDvVNl7IHYMqOVsNRaS', '2025-06-03', 'L', '2025-06-02 20:33:50', '2025-06-02 20:33:50'),
(2, '2', 'ustad riski', '$2y$12$npayYAla5VkKmZ3paXyvGO.1oTF3fmrlcpHEydI8uBlQKFVNwg9/a', '2025-06-03', 'L', '2025-06-02 20:34:01', '2025-06-02 20:34:01'),
(3, '2', 'ustad Sulton', '$2y$12$RaIYDmVnWGvW24e7LwwfFe15WYo.vnoFmN35WZuKe.H/wxzDGLC9a', '2025-06-03', 'L', '2025-06-02 20:35:29', '2025-06-02 20:35:29'),
(4, '1', 'Admin', '$2y$12$PvGRvW0ia7PuDcklgjaXJuCz/hjWsgTmDvBGa0YZs3qUuu3LdzXW6', '1990-01-01', 'L', '2025-06-02 20:57:29', '2025-06-02 20:57:29'),
(5, '2', 'Guru 1', '$2y$12$vuQRV4zzFqj1jTu5YO1T4OE.hSqiCiATaloVcudj28Ppt97ZBIqae', '1985-01-15', 'P', '2025-06-02 20:57:29', '2025-06-02 20:57:29'),
(6, '2', 'Guru 2', '$2y$12$GmnitP5fH/AgOcKRGQ32AevKepMxkcaNvlnguUfARiuE5T6ytnnwK', '1985-02-15', 'L', '2025-06-02 20:57:29', '2025-06-02 20:57:29'),
(7, '2', 'Guru 3', '$2y$12$viOS5i0tbqq46oUMByRXm.o71Eb0gi0q412GJZLH82Pp5y.ynylgS', '1985-03-15', 'P', '2025-06-02 20:57:29', '2025-06-02 20:57:29'),
(8, '2', 'Guru 4', '$2y$12$O029apdjecWS1Bioj29X9.HffqNY2FthVDzgBHRZbEaowRHVrKl0S', '1985-04-15', 'L', '2025-06-02 20:57:30', '2025-06-02 20:57:30'),
(9, '2', 'Guru 5', '$2y$12$RsaiYwGiXjzKD4GYFMUSq.llWVZUBm2x1Xpi/BC2hqX5Y04GceAuS', '1985-05-15', 'P', '2025-06-02 20:57:30', '2025-06-02 20:57:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `group_user`
--
ALTER TABLE `group_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `group_user_group_id_foreign` (`group_id`),
  ADD KEY `group_user_user_id_foreign` (`user_id`);

--
-- Indexes for table `hafalans`
--
ALTER TABLE `hafalans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hafalans_group_id_foreign` (`group_id`),
  ADD KEY `hafalans_user_id_foreign` (`user_id`),
  ADD KEY `hafalans_student_id_foreign` (`student_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `students_group_id_foreign` (`group_id`),
  ADD KEY `students_user_id_foreign` (`user_id`);

--
-- Indexes for table `students_pure`
--
ALTER TABLE `students_pure`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `group_user`
--
ALTER TABLE `group_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `hafalans`
--
ALTER TABLE `hafalans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `students_pure`
--
ALTER TABLE `students_pure`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `group_user`
--
ALTER TABLE `group_user`
  ADD CONSTRAINT `group_user_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `group_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `hafalans`
--
ALTER TABLE `hafalans`
  ADD CONSTRAINT `hafalans_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `hafalans_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `hafalans_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `students_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
