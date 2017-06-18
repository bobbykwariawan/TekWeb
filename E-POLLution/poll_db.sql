-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 18, 2017 at 12:19 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `poll_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `comment_table`
--

CREATE TABLE `comment_table` (
  `comment_id` int(255) NOT NULL,
  `poll_id` int(255) NOT NULL,
  `comment_by` varchar(255) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `comment_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comment_table`
--

INSERT INTO `comment_table` (`comment_id`, `poll_id`, `comment_by`, `comment`, `comment_on`, `status`) VALUES
(1, 12, '1', 'hahaha', '2017-05-31 11:40:51', 1),
(2, 12, '3', 'woohoo', '2017-05-31 11:41:04', 0),
(3, 12, '5', 'HELLO', '2017-05-31 13:59:59', 1),
(4, 12, '7', 'gotta catch em all', '2017-05-31 14:02:31', 1),
(5, 13, '6', 'Submit', '2017-05-31 17:32:29', 0),
(6, 13, '6', 'Submit', '2017-05-31 17:33:00', 0),
(7, 13, '6', 'asd', '2017-05-31 17:33:36', 1),
(8, 12, '6', 'heleloe', '2017-05-31 17:34:31', 1),
(9, 1, '7', 'POKEMON!', '2017-06-01 06:55:32', 1),
(10, 13, '7', 'POKE!', '2017-06-01 06:55:58', 1),
(11, 4, '6', 'yuuhu', '2017-06-01 10:45:30', 0),
(12, 12, '3', 'AHAHAHA', '2017-06-01 14:00:42', 0),
(13, 14, '4', 'ayo2 di vote', '2017-06-17 18:56:28', 1),
(14, 14, '17', 'heyo', '2017-06-17 21:54:45', 1),
(15, 15, '14', 'aeaeae', '2017-06-17 22:01:26', 1),
(16, 14, '14', 'oioi', '2017-06-17 22:01:51', 1),
(17, 14, '18', 'hiehiehi', '2017-06-17 22:03:15', 1),
(18, 15, '1', 'heheas', '2017-06-17 22:13:51', 1);

-- --------------------------------------------------------

--
-- Table structure for table `participate_table`
--

CREATE TABLE `participate_table` (
  `participate_id` int(255) NOT NULL,
  `poll_id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `vote_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `participate_table`
--

INSERT INTO `participate_table` (`participate_id`, `poll_id`, `user_id`, `vote_on`) VALUES
(1, 1, 1, '2017-05-29 15:49:55'),
(2, 1, 2, '2017-05-29 15:49:55'),
(3, 9, 2, '2017-05-29 15:49:55'),
(4, 5, 2, '2017-05-29 15:49:55'),
(5, 2, 2, '2017-05-29 15:49:55'),
(6, 10, 2, '2017-05-29 15:49:55'),
(7, 7, 2, '2017-05-29 15:49:55'),
(9, 12, 1, '2017-05-29 16:06:31'),
(10, 12, 2, '2017-05-29 16:18:53'),
(11, 12, 6, '2017-05-30 06:38:10'),
(12, 11, 6, '2017-05-30 06:44:58'),
(13, 11, 3, '2017-05-30 06:45:28'),
(14, 9, 1, '2017-05-31 14:49:59'),
(15, 7, 6, '2017-05-31 16:07:55'),
(16, 11, 1, '2017-05-31 17:00:33'),
(17, 2, 1, '2017-05-31 17:01:14'),
(18, 7, 1, '2017-05-31 17:14:01'),
(19, 13, 6, '2017-05-31 17:29:58'),
(20, 10, 6, '2017-05-31 21:19:51'),
(21, 4, 6, '2017-06-01 10:45:23'),
(22, 12, 3, '2017-06-01 14:00:24'),
(23, 14, 17, '2017-06-17 21:54:39'),
(24, 14, 1, '2017-06-17 21:55:34'),
(25, 14, 4, '2017-06-17 21:55:56'),
(26, 15, 14, '2017-06-17 22:01:31'),
(27, 14, 14, '2017-06-17 22:01:40'),
(28, 14, 18, '2017-06-17 22:03:06'),
(29, 15, 1, '2017-06-17 22:13:32');

-- --------------------------------------------------------

--
-- Table structure for table `poll_table`
--

CREATE TABLE `poll_table` (
  `poll_id` int(255) NOT NULL,
  `poll_name` varchar(255) NOT NULL,
  `poll_question` varchar(255) NOT NULL,
  `poll_option` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `type` tinyint(1) NOT NULL,
  `post_by` varchar(255) NOT NULL,
  `post_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `poll_table`
--

INSERT INTO `poll_table` (`poll_id`, `poll_name`, `poll_question`, `poll_option`, `value`, `type`, `post_by`, `post_date`, `status`) VALUES
(1, 'Siapa orang paling ganteng', 'Aku? Dia? Kamu?', 'aku;kamu;dia', '2;0;0', 0, '1', '2017-05-26 17:26:21', 0),
(2, 'asdksakd', 'fgdfbdf', 'qwe;asd;zxc;aaa', '0;0;2;0', 0, '2', '2017-05-26 17:27:37', 2),
(3, 'AHAHAHA', 'sdgfsgdfg', 'TOTOTTO;EKEKEE;ZX', '0;0;0', 0, '1', '2017-05-27 22:15:43', 0),
(4, 'SAYA SAYA SAYA', 'sgsdfgcbcv', 'qweq;OHO;asd', '1;1;1', 1, '2', '2017-05-27 22:20:58', 1),
(5, 'KOKOOKO', 'KOEKOIK', 'OPOPOP;PIPIPI;SISISI', '1;1;1', 1, '2', '2017-05-27 23:37:24', 2),
(6, 'KIKUKU', 'KIKUKU', 'KEKE;KOKO;KIKI;KUKU;KOPOP', '0;0;0;0;0', 1, '2', '2017-05-27 23:38:04', 0),
(7, 'Qwasrs', 'Qwasrs', 'asd;zxc;xcvxcv', '2;1;0', 0, '2', '2017-05-28 00:51:04', 2),
(8, 'asdasd', 'ccc', 'ccxxz;zxeef;gffger', '0;0;0', 1, '2', '2017-05-28 00:53:34', 2),
(9, '12314235436', 'WOHOHOO?', '1231231321;434545;sfdsfsdfs', '2;1;0', 1, '2', '2017-05-28 00:54:07', 1),
(10, 'e1e21eweqw', 'e1e21eweqw', 'dffs;sdf', '1;1', 0, '2', '2017-05-28 00:54:56', 0),
(11, 'Angka Favorit', 'Berapa Angka Favorit mu?', '1;3;4', '0;2;1', 0, '1', '2017-05-29 12:50:29', 0),
(12, 'Warna terbaik', 'Apa warna favorit mu?', 'Merah;Kuning;Putih;Hitam', '1;4;1;2', 1, '1', '2017-05-29 12:52:00', 0),
(13, 'Minuman Favorit Jaman Sekarang', 'Apa minuman favoritmu?', 'Air Aki;Air AC', '1;0', 0, '6', '2017-05-31 17:29:50', 0),
(14, 'Liburan enaknya ngapain?', 'Liburan enaknya ngapain?', 'Jalan2;Tidur;Main game;Ke hutan;Pulang Kampung', '2;1;4;3;1', 1, '4', '2017-06-17 18:55:55', 0),
(15, 'aeae', 'zxczxc', 'sdddff;ssewq;zxczxv', '1;1;0', 0, '4', '2017-06-17 18:58:07', 0);

-- --------------------------------------------------------

--
-- Table structure for table `reportcomment_table`
--

CREATE TABLE `reportcomment_table` (
  `report_id` int(255) NOT NULL,
  `comment_id` varchar(255) NOT NULL,
  `report_by` int(255) NOT NULL,
  `reason` varchar(255) NOT NULL,
  `report_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reportcomment_table`
--

INSERT INTO `reportcomment_table` (`report_id`, `comment_id`, `report_by`, `reason`, `report_date`) VALUES
(1, '10', 2, 'spamming', '2017-06-07 03:47:30'),
(2, '9', 3, 'SPAM', '2017-06-07 03:47:30'),
(3, '9', 4, 'sappams', '2017-06-07 03:47:30'),
(4, '3', 2, 'GENDENG', '2017-06-07 03:47:30'),
(5, '7', 5, 'IKI NGOMONG OPO ', '2017-06-07 05:00:36'),
(6, '13', 5, 'asd', '2017-06-17 22:17:56'),
(7, '13', 5, 'gdsssdas', '2017-06-17 22:17:56'),
(8, '13', 6, 'sfvxcvcv', '2017-06-17 22:17:56'),
(9, '13', 10, 'qweqwer', '2017-06-17 22:17:56'),
(10, '7', 7, 'tidak jelas', '2017-06-17 20:14:26'),
(11, '7', 7, 'zxvegw', '2017-06-17 20:14:30');

-- --------------------------------------------------------

--
-- Table structure for table `reportpoll_table`
--

CREATE TABLE `reportpoll_table` (
  `report_id` int(11) NOT NULL,
  `poll_id` varchar(255) NOT NULL,
  `report_by` int(255) NOT NULL,
  `reason` varchar(255) NOT NULL,
  `report_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reportpoll_table`
--

INSERT INTO `reportpoll_table` (`report_id`, `poll_id`, `report_by`, `reason`, `report_date`) VALUES
(1, '12', 4, 'gila', '2017-06-07 03:48:08'),
(2, '12', 2, 'GA ENAK DILIHAT MATA KU', '2017-06-07 03:48:08');

-- --------------------------------------------------------

--
-- Table structure for table `user_table`
--

CREATE TABLE `user_table` (
  `user_id` int(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `avatar` varchar(255) NOT NULL DEFAULT 'https://www.magogenie.com/assets/newavatar-2e71c1972b8bd7894d3f75f7f5c6fe95.jpg',
  `create_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `privilege` tinyint(1) NOT NULL DEFAULT '0',
  `theme` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `user_table`
--

INSERT INTO `user_table` (`user_id`, `user_name`, `email`, `password`, `avatar`, `create_on`, `privilege`, `theme`) VALUES
(1, 'admin', 'admin@admin.com', '$2y$10$KlJRHQ9SOBhWFB3W6OQOk.PJjLyVbrfHmCKoA7Xq6Z11qJWzJtlyK', 'https://upload.wikimedia.org/wikipedia/commons/b/b0/Barnstar_Admin.png', '2003-05-31 14:54:41', 1, 1),
(2, 'asdasd', 'asdsa@asd.asd', '$2y$10$4Yflq1fddprFm4KnAOgrZetrHDN2axQKZpGsj4cqzCMf6JvuOgR4K', 'https://www.magogenie.com/assets/newavatar-2e71c1972b8bd7894d3f75f7f5c6fe95.jpg', '2017-05-28 14:54:41', 0, 1),
(3, 'qwe', 'qweqwe@qwe.qwe', '$2y$10$eoTDWLrhfXLFPvzgBVG3keQAO6nLRsx4b0gTsSPi2/mdfwKmJyYAa', 'https://beebom-redkapmedia.netdna-ssl.com/wp-content/uploads/2016/01/Reverse-Image-Search-Engines-Apps-And-Its-Uses-2016.jpg', '2017-05-28 14:54:41', 0, 0),
(4, 'asd', 'ggg@ggg.ggg', '$2y$10$l5JFYt3ZQEOqTzB8yhkGROMhOdVvppR3FuBHhfCz293mEozvZs64a', 'https://s-media-cache-ak0.pinimg.com/736x/91/ff/d2/91ffd2be7b7d03a73a90872572c74e55.jpg', '2017-05-29 14:54:41', 0, 0),
(5, 'hello', 'asd.asd@asd.asd', '$2y$10$DQP.vgGYImYgZbp6mDgJI.55VK9PoP.LjgeMiTvTAUrKs.WrWrQJK', 'https://s-media-cache-ak0.pinimg.com/originals/5c/1b/42/5c1b42ec33683a45ba549889c6e56e0b.jpg', '2017-05-31 14:54:41', 0, 0),
(6, 'heyhey', 'heyhey@hey.hey', '$2y$10$FLVepYvqseVV50p1ZndXIu/IFbgvmwT4RTHjD.xs5Eo1OMZWs9h8K', 'http://orig01.deviantart.net/2683/f/2012/212/1/0/png_cute_anime_6_by_candybubblesweety-d59c08i.png', '2017-05-31 14:54:41', 0, 1),
(7, 'PokemonMaster123', 'asdasdasd.asdasdasd@asdasd.asd', '$2y$10$BMzvw2rLF0wGMZzqCW0JN.Kdg/jnZ0.vxV3Ka/Uc6XXKeyIpO0qMW', 'https://upload.wikimedia.org/wikipedia/commons/thumb/2/23/Pok%C3%A9_Ball.svg/1000px-Pok%C3%A9_Ball.svg.png', '2017-05-31 14:54:41', 0, 0),
(8, 'asdx', 'asd@asd.asd', '$2y$10$dGFgrfkjUlB/hTgY/SsPG.LWBu/jfe.Dj320W2hQ3uqD7jZeKnOk2', 'https://www.magogenie.com/assets/newavatar-2e71c1972b8bd7894d3f75f7f5c6fe95.jpg', '2017-06-17 15:16:35', 0, 0),
(9, 'ioi', 'ooo2@oo.oo', '$2y$10$kLE6NGLZ752Kc3Bkg5c07.EhP9CfyDXmEMM2vzkFhA74vNh3L8/3.', 'https://www.magogenie.com/assets/newavatar-2e71c1972b8bd7894d3f75f7f5c6fe95.jpg', '2017-06-17 21:16:32', 0, 0),
(10, 'kokoi', 'asda@asd.asd', '$2y$10$PrPQrJfd8Z2kDKJ8QryQv.g3s7urOE4RT8j1QTh9MIOup4IWMOe4m', 'https://www.magogenie.com/assets/newavatar-2e71c1972b8bd7894d3f75f7f5c6fe95.jpg', '2017-06-17 21:17:42', 0, 0),
(11, 'yoasi', 'jojo2@jojo.asdk', '$2y$10$1D1lkuinkQ.bzeBYGMPwkOBk9LFysPQsiOVFUqcq6hZP.bdZnTCwK', 'https://www.magogenie.com/assets/newavatar-2e71c1972b8bd7894d3f75f7f5c6fe95.jpg', '2017-06-17 21:18:01', 0, 0),
(12, 'asdxz', 'asdv@asfasf.zxc', '$2y$10$yAOL2Cr2TCGnO4kPVlqgp.wVR6LiaWAK5GEJkLAu4cDpFfGEU9CuW', 'https://www.magogenie.com/assets/newavatar-2e71c1972b8bd7894d3f75f7f5c6fe95.jpg', '2017-06-17 21:24:51', 0, 0),
(13, 'dsfda', 'AS!@asd.s', '$2y$10$3MX711aSq5cGJO8rJ8qhu.DzRUOi0s1MUKjPmoB729nhHP8UD1qZW', 'https://www.magogenie.com/assets/newavatar-2e71c1972b8bd7894d3f75f7f5c6fe95.jpg', '2017-06-17 21:37:59', 0, 0),
(14, 'fff', 'fff@ff.fff', '$2y$10$i8SQJnV38frEiRD6TxYeWOt2rxUfAtLvD2cR2YlAOjWF4mN/4oJzm', 'http://zoarchurch.co.uk/content/pages/uploaded_images/91.png', '2017-06-17 21:39:12', 0, 0),
(15, 'totatata', 'totaota@totoatt.toat', '$2y$10$DQU/uXtLbG9RXOQKkp1zF.He7mMqPwFLyv/XWn1QP3rrD6UWSkefW', 'https://www.magogenie.com/assets/newavatar-2e71c1972b8bd7894d3f75f7f5c6fe95.jpg', '2017-06-17 21:42:11', 0, 0),
(16, 'czczxc', 'asdad', '$2y$10$7GWZgfHX.FxkJy.Lr4A/JOnH41aPKOM2fqIq4H6gAJC8QLWGbVPtm', 'https://www.magogenie.com/assets/newavatar-2e71c1972b8bd7894d3f75f7f5c6fe95.jpg', '2017-06-17 21:43:30', 0, 0),
(17, 'jojojo', 'joj@jojo.asd', '$2y$10$drId993rt.M4RZy0WYKDx.Si6HlXpN5qbyITzwRTqQ/UH8eMBM0zu', 'https://i.imgur.com/BPmzHAi.gif', '2017-06-17 21:45:43', 0, 1),
(18, 'tekweb', 'tekwe@assa.asd', '$2y$10$c.jbNFdxZ5sLXEwNdEQuJuUU3.CIyNfyUMOBkf9K1LT7DNK6dyCt.', 'http://www.myeduhouse.com/datastorage/logo_institution/LOGO-UKP.png', '2017-06-17 21:46:46', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comment_table`
--
ALTER TABLE `comment_table`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `participate_table`
--
ALTER TABLE `participate_table`
  ADD PRIMARY KEY (`participate_id`);

--
-- Indexes for table `poll_table`
--
ALTER TABLE `poll_table`
  ADD PRIMARY KEY (`poll_id`);

--
-- Indexes for table `reportcomment_table`
--
ALTER TABLE `reportcomment_table`
  ADD PRIMARY KEY (`report_id`);

--
-- Indexes for table `reportpoll_table`
--
ALTER TABLE `reportpoll_table`
  ADD PRIMARY KEY (`report_id`);

--
-- Indexes for table `user_table`
--
ALTER TABLE `user_table`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comment_table`
--
ALTER TABLE `comment_table`
  MODIFY `comment_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `participate_table`
--
ALTER TABLE `participate_table`
  MODIFY `participate_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `poll_table`
--
ALTER TABLE `poll_table`
  MODIFY `poll_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `reportcomment_table`
--
ALTER TABLE `reportcomment_table`
  MODIFY `report_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `reportpoll_table`
--
ALTER TABLE `reportpoll_table`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user_table`
--
ALTER TABLE `user_table`
  MODIFY `user_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
