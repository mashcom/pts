-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 27, 2017 at 12:25 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `pts`
--

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE IF NOT EXISTS `reports` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `test_id` int(11) NOT NULL,
  `correct` int(11) NOT NULL,
  `incorrect` int(11) NOT NULL,
  `skipped` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `scores`
--

CREATE TABLE IF NOT EXISTS `scores` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `test_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `answer` varchar(250) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tests`
--

CREATE TABLE IF NOT EXISTS `tests` (
`id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `duration` int(11) DEFAULT '30'
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tests`
--

INSERT INTO `tests` (`id`, `name`, `description`, `created_at`, `updated_at`, `duration`) VALUES
(1, 'Numeric Reasoning Test', 'The intention of this test is to provide a glimpse into the nature of a very popular numerical test format that is based on graph, chartand table interpretation. In these tests, as well as in our practice packs, the number of data sets can vary to include one to three graphs and/or tables for each question, and up to 4 questions per each data set.', '2017-08-06 12:39:41', '2017-09-27 08:49:52', 45);

-- --------------------------------------------------------

--
-- Table structure for table `test_questions`
--

CREATE TABLE IF NOT EXISTS `test_questions` (
`id` int(11) NOT NULL,
  `test_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `answers` text NOT NULL,
  `illustration` text NOT NULL,
  `correct_answer` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `test_questions`
--

INSERT INTO `test_questions` (`id`, `test_id`, `content`, `answers`, `illustration`, `correct_answer`, `created_at`, `updated_at`) VALUES
(39, 1, 'In which year was the average number of daily swimmers the highest?', '{"A":"2003","B":"2004","C":"2005","D":"2006","E":"Cannot say"}', 'illustration_cddcfc0240193f562844387d42fdcb9c098ab508ceb7bf0b88ba7148f663bb5e2d2518ff7aaa2014.PNG', 'B', '2017-09-27 08:53:54', '2017-09-27 08:53:54'),
(40, 1, ' Assuming the children group is 50% boys and 50% girls, how many more males swam at Aldeburgh beach in 2006 than in 2005?', '{"A":"35","B":"45","C":"10","D":"5","E":"Cannot say"}', 'illustration_e288a0d70910d7b83c9c519bd8428ac9b2e2d26bd7b96147da7e9e4af42e0a29e477bbb350a3aaa5.PNG', 'D', '2017-09-27 08:57:12', '2017-09-27 08:57:12'),
(41, 1, 'How many calories originated in fat will be consumed when eating 1.5 cups of \r\nproduct X?', '{"A":"120","B":"135","C":"45","D":"90","E":"Cannot say"}', 'illustration_724c08222212da80487633b6cdfe09f0404a7785ea5d28a01e1d1e65acf8cb20c883a9e9bcafa101.PNG', 'D', '2017-09-27 08:59:11', '2017-09-27 08:59:11'),
(42, 1, 'How many grams of dietary fibre should a person who follows a 2000 calorie diet consume if he already ate an entire container  of product x today? ', '{"A":"22","B":"13","C":"19","D":"8","E":"Cannot say"}', 'illustration_acd543910eccfc9c554009d70309a0509c12959e13354b85a2d461d4e8d9501a3acefb0260c518af.PNG', 'B', '2017-09-27 09:01:05', '2017-09-27 09:01:05'),
(43, 1, 'In which of the following years did over 2/3 of  the students who took the exam \r\nnot pass it?', '{"A":"2005","B":"2006","C":"2008","D":"2009","E":"Cannot say"}', 'illustration_468458856259e6f1d5b23e235ab3e47d7798c0b3e761fc0491138a69fee585d3e8c79d7095b60ccc.PNG', 'C', '2017-09-27 09:02:46', '2017-09-27 09:02:46'),
(44, 1, 'It is known that a quarter of the students who p assed the exam in 2007, passed it at the first trial. Assuming each exam has two t rials, what percent age of all the students who took the exam that year passed it in the second trial?', '{"A":"10","B":"15","C":"30","D":"75","E":"ca"}', 'illustration_8f320ca7e75cb19b9a5f2507994c72643557ccfbb567202f804270975d6177c4e7e9d82b88cea5bb.PNG', 'C', '2017-09-27 09:04:11', '2017-09-27 09:04:11'),
(45, 1, 'Sea delivery per car (either SUV or minivan) costs $25. What were the sea \r\ndelivery costs for large family cars in 2008?', '{"A":"19 million","B":"42.5 million","C":"4505 million","D":"47.5 million","E":"Cannot say"}', 'illustration_3b52d496c83ba6b36465afba32c5a6315e014b88606bdbe33e4835805ba72db14d8da161a572db76.PNG', 'D', '2017-09-27 09:06:02', '2017-09-27 09:06:02'),
(46, 1, 'How many bi-monthly electricity bills of Smith household are higher than the national average? ', '{"A":"0","B":"1","C":"2","D":"3","E":"4"}', 'illustration_3166aa86fe6c05cca2bf3118548dcba624e5b5621c3cfaef3e78f26668589a223c888f61d181ca1b.PNG', 'C', '2017-09-27 09:07:37', '2017-09-27 09:07:37'),
(47, 1, 'On average, how much market value in Asia would  a Uranium employee create \r\nper week (52 weeks a year)? ', '{"A":"$5.3","B":"$5.5","C":"$5,7","D":"$5.9","E":"Cannot"}', 'illustration_1eb9eb7a25d820172050b16d67f174d3eb1957f49b50aadfd41a698c7efce6074a63602bf417fdec.PNG', 'A', '2017-09-27 09:10:22', '2017-09-27 09:10:22'),
(48, 1, 'In 2009, there were 667,284 unemployed in Netherlands, whose population was 27.53% of the UK for that year. With a fixed annual population increase of 0.639%, approximately how many unemployed are in the UK in 2011?', '{"A":"6 987 322","B":"4 801 138","C":"8 511 287","D":"6 895 245","E":"4 296 108"}', 'illustration_c412244152c94e396b88815b8f6c1abfc4d1a1d6120580353dc44b178c45acdb1e74dc952d9ba042.PNG', 'E', '2017-09-27 09:21:32', '2017-09-27 09:21:32'),
(49, 1, 'If the number of Chinese Insurance stocks represent ed 3.5% of all Insurance securities, approximately how many Insurance bonds  were Chinese?', '{"A":"9 200 000","B":"9 500 000","C":"10 800 000","D":"910 000","E":"1 080 000"}', 'illustration_cd68ea50b247715060777c2ffa4fded73ea149438dd7a1be0cd47d3d04bf2dc5d2b2059863dbd275.PNG', 'B', '2017-09-27 09:23:29', '2017-09-27 09:23:29'),
(50, 1, 'A rumour about an upcoming recession in Japan has reduced the value of the Yen 7% compared with the Euro. How many Euros can you now buy for 500 Yen?', '{"A":"3.5","B":"3.26","C":"3.15","D":"3.76","E":"None of the above"}', 'illustration_4ee4d155ea693578f1dc61e6ba3d1175393e9516bdcf5a84f87584c7c98ddda2656da401299fd85d.PNG', 'B', '2017-09-27 09:25:25', '2017-09-27 09:25:25'),
(51, 1, 'If the value of the company’s cash flow from operations decreased by 2.7% in 2012, and 63% of their total cash flow was from ope rations, what would be the total balance of the company, in millions? ', '{"A":"30.89","B":"41.37","C":"45.2","D":"47","E":"46.33"}', 'illustration_d05005373856e34c89b32bcf8bdcebb61b60f0ef02e6345e4902eca9e1a7467e6cde9e40ce2892ba.PNG', 'E', '2017-09-27 09:26:59', '2017-09-27 09:26:59'),
(52, 1, 'When the sale prices of Calir''s product line were decreased by 25%, £65,277 in revenues were generated in less than 2 weeks. If the sales ratio of XC to XR units was 3:4 respectively, what is the difference  in the number of units sold between the two product types? ', '{"A":"5","B":"18","C":"6","D":"22","E":"Cannot say"}', 'illustration_940b250f46b9c592394de347086eee80eafa5a101efce6a8deb8f70f7c59d02d16bf1a1baffb3b61.PNG', 'C', '2017-09-27 09:29:02', '2017-09-27 09:29:02'),
(53, 1, 'Approximately, what is the percentage growth in final energy consumption for the domestic sector in million tonnes of oil equivalent?', '{"A":"2","B":"2.08","C":"20.88","D":"23.81","E":"18.96"}', 'illustration_0e583a4f5349aeaaadca74c77da466ba91e425cb0aa49b0f63d44e5670df722fd3a0933521d6caef.PNG', 'E', '2017-09-27 09:30:46', '2017-09-27 09:30:46');

-- --------------------------------------------------------

--
-- Table structure for table `timers`
--

CREATE TABLE IF NOT EXISTS `timers` (
`id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `test_id` int(11) DEFAULT NULL,
  `expiry_time` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_admin` int(11) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `dob` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `education` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sex` enum('male','female','','') COLLATE utf8_unicode_ci DEFAULT NULL,
  `employment_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `is_admin`, `remember_token`, `created_at`, `updated_at`, `dob`, `education`, `sex`, `employment_type`, `avatar`) VALUES
(1, 'Blessing Mashoko', 'bmashcom@hotmail.com', '$2y$10$bkdRreZYkh6Sxa.Vn2fGpueNQ76MWtnKVnOqaig46dBliwSO15FpK', 1, 'MaRKqW1FxBqiw5AKQRoUmXOAvtkaIfkK9ybUOvaFSJlUPNQ2AwHItit7rAGJ', '2017-08-03 07:59:57', '2017-09-27 09:31:27', '1990-09-05', 'gggg', 'male', 'part-time', 'avatar_ef23699a0a5661beb469e6ab66bb450878ef044038967fec4924b26d80b8cdb817da554db2cbb0b3.jpg'),
(2, 'Mashcom Mashoko', 'bmashcom@gmail.com', '$2y$10$zA.CzvolObcxXLgLx.JCNOh8LpQiHkMJckeP.KfKx99iwbHkaBKBK', 0, 'MEDwPwEdgJBHWaWzjKF1Wd4ULVDU0WJHTrm09xnzy9mSjGiJAOcoubB4sUQC', '2017-08-06 09:13:42', '2017-09-14 08:47:20', NULL, NULL, NULL, '', ''),
(3, 'Noel Shava', 'noelshava@gmail.com', '$2y$10$Pl8XAufzCfBhpKbI2qUtG.GQWRTkRJNdsdeuD5c6NDUVzmo/aMzcu', 0, '3BsthWRqz55t2dNmVa2YrzJzxZ2pVa7QYWKbjp1gP0gbBlEfhJXSZW3xq3Ah', '2017-08-12 09:35:43', '2017-08-12 10:21:55', NULL, NULL, NULL, '', ''),
(4, 'Hulisani Ndou', 'hulisani@gmail.com', '$2y$10$hUYsVwrWlp90ht9W9/irdONVY0MaH1S8HevfKZ2rOCVXLk/F/g8fy', 0, 'QMaFrwnb2er1PC1v5q9vN6nBx7ZuhzXDEiDXGjCkKfpy4TF0p46HsK8hZ0DP', '2017-08-12 10:22:41', '2017-09-27 09:44:47', NULL, NULL, NULL, '', ''),
(5, 'Tinotenda Moyo', 'tino@gmail.com', '$2y$10$KLs5vy7ajYBue93mKBkWfOaySZAQ2KKabH2cXaYh7QRscGPFdLOTa', 0, NULL, '2017-08-16 04:31:22', '2017-08-16 04:31:22', NULL, NULL, NULL, '', ''),
(6, 'Blessing Mashoko', 'hulisanindou19@gmeail.com', '$2y$10$huXLZdHno/K9bczv3zQyZelYnF87.LJ.w7y3yhbYFXlSS2vQQrd4i', 0, 'bPf9MyTEhKNggyYAr0PW5fllDiAAskifWREbIFj3hoo7Coi7g0UUpCkeYMNC', '2017-09-14 20:27:08', '2017-09-14 20:27:13', NULL, NULL, NULL, '', ''),
(7, 'Robson Bobs', 'rooby@gmail.com', '$2y$10$hWp2aSuD52nbBQTiMsYEIeRyHjo/JGWAFlHlWw4IY4AsxVO2FyySq', 0, 'D7ujqhqU1CEJeQ1o5p3xaXuHKOIz9WAQe1HwpP9Nu1CgZEh8iyqpLgVOuRUc', '2017-09-14 20:30:15', '2017-09-14 20:31:19', NULL, NULL, NULL, '', ''),
(8, 'Tiku Test', 'admin@zol.co.zw', '$2y$10$If/dDImziL07wgfUAMx8TO47SLtqrwPJ6hcBwnQkXmI70wKMSrg0S', 0, 'OcJxY6FHFvWFdFihm9DRGxwkQVpsVtMjzi3tcEozZD8TEJ7Q7GQTgWS7AVLP', '2017-09-14 20:34:45', '2017-09-14 20:40:41', NULL, NULL, NULL, '', ''),
(9, '', '', '', 0, 'FuKrisaPCrhy7z0cZJwFKzhY85a0PEXdq0YSxTihWhjSJIHboIT2ISw3jAnM', '2017-09-14 20:41:40', '2017-09-14 20:43:20', '2017-08-31', 'sjdhsjhdjsh', 'male', 'internship', ''),
(10, 'Bothwell Thusa', 'bothy@gmail.com', '$2y$10$tWxh1Cw9MrV4giPgkNh/ueU1gtI09fFnzWfvgDROFJl1viRv3fZ9i', 0, '9HcW7uS1JGibVbjn5mDbYr8pAklhXxQfC4VLAG8JDNOmzlOTRBtX7LAYXIbh', '2017-09-14 20:44:03', '2017-09-14 20:48:53', '2017-02-22', 'Bsc HINFO', 'male', 'permanent', ''),
(11, 'Tatenda Gwatsvaira', 'fgwa@gmail.com', '$2y$10$8g7FneBZO7SumWTmedBG3ul.6ft.HSZ28dpMEPCZu3Ap5BUrgFWeS', 0, 'bmkdROMQHupKRy9JPQoi0DZskbnVzr0pW2K1TbkvK02xUDrT5nCWWcdBTRFC', '2017-09-18 11:56:13', '2017-09-19 10:50:07', '1993-11-07', 'BSc Information Systems Honours Degree', 'male', 'permanent', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
 ADD KEY `password_resets_email_index` (`email`), ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scores`
--
ALTER TABLE `scores`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tests`
--
ALTER TABLE `tests`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `test_questions`
--
ALTER TABLE `test_questions`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `timers`
--
ALTER TABLE `timers`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `scores`
--
ALTER TABLE `scores`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tests`
--
ALTER TABLE `tests`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `test_questions`
--
ALTER TABLE `test_questions`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=54;
--
-- AUTO_INCREMENT for table `timers`
--
ALTER TABLE `timers`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
