-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 09, 2022 at 11:47 AM
-- Server version: 5.7.36
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lanthirey_lanthirey`
--

-- --------------------------------------------------------

--
-- Table structure for table `cms`
--

CREATE TABLE `cms` (
	`cIndex` bigint(20) UNSIGNED NOT NULL,
	`cDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`cTitle` varchar(999) NOT NULL,
	`cContent` mediumtext NOT NULL,
	`cTag` varchar(999) NOT NULL,
	`cUpvote` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cms`
--

INSERT INTO `cms` (`cIndex`, `cDate`, `cTitle`, `cContent`, `cTag`, `cUpvote`) VALUES
(17, '2021-03-29 16:41:45', 'Retest 1', 'a:2:{i:0;i:1;i:1;s:19:\"Testing the website\";}', 'a:4:{i:0;s:4:\"test\";i:1;s:5:\"test1\";i:2;s:8:\"fragment\";i:3;s:9:\"lanthirey\";}', 4),
(25, '2022-02-27 08:26:06', 'Test ', 'a:3:{i:0;i:2;i:1;s:24:\"media/image_post/25a.jpg\";i:2;s:24:\"media/image_post/25b.png\";}', '', 0),
(24, '2022-02-27 08:23:44', 'Test2', 'a:4:{i:0;i:2;i:1;s:24:\"media/image_post/24a.jpg\";i:2;s:24:\"media/image_post/24b.jpg\";i:3;s:24:\"media/image_post/24c.jpg\";}', '', 2),
(20, '2022-02-26 18:12:33', 'Test', 'a:2:{i:0;i:2;i:1;s:24:\"media/image_post/20a.jpg\";}', 'a:1:{i:0;s:4:\"test\";}', 1),
(21, '2022-02-26 18:14:37', 'Test 1', 'a:5:{i:0;i:2;i:1;s:24:\"media/image_post/21a.jpg\";i:2;s:24:\"media/image_post/21b.jpg\";i:3;s:24:\"media/image_post/21c.jpg\";i:4;s:24:\"media/image_post/21d.jpg\";}', 'a:1:{i:0;s:4:\"test\";}', 0),
(22, '2022-02-26 21:40:58', 'Test Many Tags', 'a:2:{i:0;i:1;i:1;s:18:\"Testing many tags.\";}', 'a:20:{i:0;s:4:\"test\";i:1;s:5:\"test1\";i:2;s:5:\"test2\";i:3;s:5:\"test3\";i:4;s:5:\"test4\";i:5;s:5:\"test5\";i:6;s:5:\"test6\";i:7;s:5:\"test7\";i:8;s:5:\"test8\";i:9;s:5:\"test9\";i:10;s:6:\"test10\";i:11;s:6:\"test11\";i:12;s:6:\"test12\";i:13;s:6:\"test13\";i:14;s:6:\"test14\";i:15;s:6:\"test15\";i:16;s:6:\"test16\";i:17;s:6:\"test17\";i:18;s:6:\"test18\";i:19;s:6:\"test19\";}', 0),
(23, '2022-02-26 21:49:35', 'youtube test', 'a:2:{i:0;i:1;i:1;s:248:\"<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/ZtLmU0iUxm4\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>\";}', 'a:1:{i:0;s:4:\"test\";}', 0),
(26, '2022-03-03 10:57:20', 'Museum 1', 'a:2:{i:0;i:2;i:1;s:24:\"media/image_post/26a.jpg\";}', 'a:1:{i:0;s:6:\"museum\";}', 0),
(27, '2022-03-03 11:02:04', 'Museum 2', 'a:2:{i:0;i:2;i:1;s:24:\"media/image_post/27a.jpg\";}', 'a:1:{i:0;s:6:\"museum\";}', 0),
(28, '2022-03-03 11:02:45', 'Museum 3', 'a:2:{i:0;i:2;i:1;s:24:\"media/image_post/28a.jpg\";}', 'a:1:{i:0;s:6:\"museum\";}', 0),
(29, '2022-03-03 13:51:34', 'Museum Test Irregular Size', 'a:2:{i:0;i:2;i:1;s:24:\"media/image_post/29a.jpg\";}', 'a:1:{i:0;s:6:\"museum\";}', 0),
(30, '2022-03-03 13:51:42', 'Museum Test Irregular Size2', 'a:2:{i:0;i:2;i:1;s:25:\"media/image_post/30a.webp\";}', '', 0),
(31, '2022-03-03 13:51:53', 'Museum Test Irregular Size3', 'a:2:{i:0;i:2;i:1;s:24:\"media/image_post/31a.jpg\";}', 'a:1:{i:0;s:6:\"museum\";}', 0),
(32, '2022-03-06 13:37:48', 'Text test 1', 'a:2:{i:0;i:1;i:1;s:1857:\"Post-prom repose\r\n\r\ni.\r\nTwo figures lay on the ground in front of \r\na neighborhood church by the highschool.\r\nDeep green grass stained with wet dew \r\nlines the edge of their bodies.\r\nThe sky becoming pale,\r\nnight fading to anemic white-blue.\r\n\r\nThe earth turned its face slowly \r\nto lose the cool of dark.\r\nLimbs lay aloose in formal dress,\r\nsaturated with the sweaty dance floor’s breath--\r\nthe two figures, knuckles graze knuckles,\r\none foot lay an inch upon the other’s calf,\r\nanother knee lightly touching the other’s thigh\r\nnoses one face-length apart\r\nbreathing the same damp blades of grass and dirt in,\r\nfazed from outliving this long, tired night. \r\n\r\nThe day was slowly opening its eyes. \r\nBrightness irreverently shakes out\r\nthe evening’s delirium.\r\n\r\n\r\nII. \r\nA crack in the darkness\r\nreveals the brightening vault of heaven.\r\nStranded under two eyefuls of sky,\r\nthey felt like the only ones around \r\nto reckon with\r\nthe shock of being alive,\r\nawake,\r\nnew,\r\ncrusted rheum in the corners of their eyes,\r\nrisen, breathing, open, pinkening.\r\n\r\nThey walk home, hand in hand, wordless,\r\nleaving the dark spongy earth for \r\nthe albedo of unsinkable sidewalk, \r\nfootsteps were\r\nwhispers through the grass turned \r\npatter on the pavement.\r\n\r\n\r\niii\r\nTwo outlines of two lovers in the dew \r\ndisappear \r\nfrom the spot on the ground,\r\ntwo of them \r\njourney their way home\r\nbreathing easily, \r\nwondering what was ahead.\r\n\r\nWe become \r\nsentimental at what little \r\nwe seemed to be \r\njust the night before and \r\nstrolled on with rumpled collar \r\nand hair in disarray.	\r\n\r\nShrug off the garb of adolescence, \r\ngamboling through rites\r\nlike a burgeoning bloom of daisies\r\nin spring, smiling\r\nat the new chance of morning,\r\ncommencing an ever wilder, livelier\r\nfate of fortune. \r\n\r\nWe are young and strong and hopeful,\r\nand certain of everything now. \r\n\r\n\";}', 'a:2:{i:0;s:4:\"poem\";i:1;s:6:\"poetry\";}', 0),
(33, '2022-03-06 13:38:58', 'Collaborator test', 'a:2:{i:0;i:1;i:1;s:417:\"Estival lessons\r\n\r\nGoldfish-faced stoics admired my emotions.\r\nI burst into wild illness.\r\nSixty wildflowers and superb wine in that freezer.\r\nHayfever gave me a terrible voice. \r\n\r\nFruit. This was all there was.\r\nLove with sweetness and\r\nshame when it was over.\r\nI was eager despite the pain of another time.\r\nSummer disregarded caution and \r\nthrew it to the wind.\r\n\r\nSo much living left to do, \r\nso little regret.\r\n\";}', 'a:6:{i:0;s:6:\"norman\";i:1;s:13:\"collaboration\";i:2;s:6:\"collab\";i:3;s:4:\"poem\";i:4;s:6:\"poetry\";i:5;s:7:\"writing\";}', 0),
(34, '2022-03-06 13:40:20', 'Test3', 'a:3:{i:0;i:2;i:1;s:24:\"media/image_post/34a.png\";i:2;s:24:\"media/image_post/34b.jpg\";}', 'a:4:{i:0;s:4:\"test\";i:1;s:5:\"image\";i:2;s:6:\"images\";i:3;s:7:\"picture\";}', 0),
(35, '2022-03-06 15:32:53', 'Trouble Sleeping', 'a:2:{i:0;i:1;i:1;s:43:\"https://www.youtube.com/watch?v=-wc0qMerzz0\";}', 'a:2:{i:0;s:5:\"music\";i:1;s:4:\"love\";}', 0),
(36, '2022-03-06 15:34:21', 'Trouble Sleeping Video', 'a:2:{i:0;i:1;i:1;s:125:\"<p><iframe src=\"//www.youtube.com/embed/-wc0qMerzz0\" width=\"560\" height=\"314\" allowfullscreen=\"allowfullscreen\"></iframe></p>\";}', 'a:3:{i:0;s:5:\"music\";i:1;s:4:\"love\";i:2;s:4:\"test\";}', 0);

-- --------------------------------------------------------

--
-- Table structure for table `fail_tracker`
--

CREATE TABLE `fail_tracker` (
	`cIndex` bigint(20) UNSIGNED NOT NULL,
	`cAddress` varchar(255) NOT NULL,
	`cFailCount` int(10) UNSIGNED NOT NULL,
	`cFailTime` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fail_tracker`
--

INSERT INTO `fail_tracker` (`cIndex`, `cAddress`, `cFailCount`, `cFailTime`) VALUES
(1, '49.144.53.130', 1, '2022-02-07 16:06:33'),
(2, '73.135.65.92', 0, '2022-02-26 10:54:21');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
	`cIndex` bigint(20) UNSIGNED NOT NULL,
	`cTag` varchar(255) NOT NULL,
	`cContent` mediumtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`cIndex`, `cTag`, `cContent`) VALUES
(103, 'test', 'a:7:{i:0;i:17;i:1;i:20;i:2;i:21;i:3;i:22;i:4;i:23;i:5;i:34;i:6;i:36;}'),
(104, 'test1', 'a:2:{i:0;i:17;i:1;i:22;}'),
(105, 'fragment', 'a:1:{i:0;i:17;}'),
(106, 'lanthirey', 'a:1:{i:0;i:17;}'),
(107, 'revolution', 'a:1:{i:0;i:18;}'),
(108, 'test2', 'a:1:{i:0;i:22;}'),
(109, 'test3', 'a:1:{i:0;i:22;}'),
(110, 'test4', 'a:1:{i:0;i:22;}'),
(111, 'test5', 'a:1:{i:0;i:22;}'),
(112, 'test6', 'a:1:{i:0;i:22;}'),
(113, 'test7', 'a:1:{i:0;i:22;}'),
(114, 'test8', 'a:1:{i:0;i:22;}'),
(115, 'test9', 'a:1:{i:0;i:22;}'),
(116, 'test10', 'a:1:{i:0;i:22;}'),
(117, 'test11', 'a:1:{i:0;i:22;}'),
(118, 'test12', 'a:1:{i:0;i:22;}'),
(119, 'test13', 'a:1:{i:0;i:22;}'),
(120, 'test14', 'a:1:{i:0;i:22;}'),
(121, 'test15', 'a:1:{i:0;i:22;}'),
(122, 'test16', 'a:1:{i:0;i:22;}'),
(123, 'test17', 'a:1:{i:0;i:22;}'),
(124, 'test18', 'a:1:{i:0;i:22;}'),
(125, 'test19', 'a:1:{i:0;i:22;}'),
(126, 'museum', 'a:5:{i:0;i:26;i:1;i:27;i:2;i:28;i:3;i:29;i:4;i:31;}'),
(127, 'poem', 'a:2:{i:0;i:32;i:1;i:33;}'),
(128, 'poetry', 'a:2:{i:0;i:32;i:1;i:33;}'),
(129, 'norman', 'a:1:{i:0;i:33;}'),
(130, 'collaboration', 'a:1:{i:0;i:33;}'),
(131, 'collab', 'a:1:{i:0;i:33;}'),
(132, 'writing', 'a:1:{i:0;i:33;}'),
(133, 'image', 'a:1:{i:0;i:34;}'),
(134, 'images', 'a:1:{i:0;i:34;}'),
(135, 'picture', 'a:1:{i:0;i:34;}'),
(136, 'music', 'a:2:{i:0;i:35;i:1;i:36;}'),
(137, 'love', 'a:2:{i:0;i:35;i:1;i:36;}');

-- --------------------------------------------------------

--
-- Table structure for table `t_artist`
--

CREATE TABLE `t_artist` (
	`i_index` bigint(20) UNSIGNED NOT NULL,
	`s_name` varchar(255) NOT NULL,
	`s_about` mediumtext NOT NULL,
	`s_avatar` varchar(255) NOT NULL,
	`s_links` mediumtext NOT NULL,
	`s_posts` mediumtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_artist`
--

INSERT INTO `t_artist` (`i_index`, `s_name`, `s_about`, `s_avatar`, `s_links`, `s_posts`) VALUES
(2, 'Test1', 'Testing the interface ', 'media/image/artist/2.png', '[[],[],[]]', '[18,33]'),
(3, 'Alfred the Dog', 'Alfred the dog is a crazy dude who wants to go outside all the time and bring in sticks. And we love him for it. ', 'media/image/artist/3.jpg', '[[\"https:\\/\\/test.lanthirey.xyz\\/media\\/image\\/link\\/instagram.png\"],[\"@alfiethedog\"],[\"https:\\/\\/www.instagram.com\\/cutecatskittens\\/\"]]', '[]');

-- --------------------------------------------------------

--
-- Table structure for table `t_comment_approval`
--

CREATE TABLE `t_comment_approval` (
	`i_index` bigint(20) UNSIGNED NOT NULL,
	`v_post_index` varchar(255) NOT NULL,
	`v_name` varchar(255) NOT NULL,
	`t_comment` mediumtext NOT NULL,
	`v_IPA` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `t_vote`
--

CREATE TABLE `t_vote` (
	`c_index` bigint(20) UNSIGNED NOT NULL,
	`c_ipa` varchar(255) NOT NULL,
	`c_vote` int(10) UNSIGNED NOT NULL,
	`c_date` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_vote`
--

INSERT INTO `t_vote` (`c_index`, `c_ipa`, `c_vote`, `c_date`) VALUES
(1, '49.145.14.0', 5, 'O:8:\"DateTime\":3:{s:4:\"date\";s:26:\"2021-02-01 15:20:13.465053\";s:13:\"timezone_type\";i:3;s:8:\"timezone\";s:19:\"America/Los_Angeles\";}'),
(2, '49.145.14.0', 8, 'O:8:\"DateTime\":3:{s:4:\"date\";s:26:\"2021-02-01 18:18:13.890923\";s:13:\"timezone_type\";i:3;s:8:\"timezone\";s:19:\"America/Los_Angeles\";}'),
(3, '73.135.65.92', 14, 'O:8:\"DateTime\":3:{s:4:\"date\";s:26:\"2021-03-23 19:05:14.581198\";s:13:\"timezone_type\";i:3;s:8:\"timezone\";s:19:\"America/Los_Angeles\";}'),
(4, '73.135.65.92', 17, 'O:8:\"DateTime\":3:{s:4:\"date\";s:26:\"2022-02-26 10:49:13.872446\";s:13:\"timezone_type\";i:3;s:8:\"timezone\";s:19:\"America/Los_Angeles\";}'),
(5, '66.67.120.21', 17, 'O:8:\"DateTime\":3:{s:4:\"date\";s:26:\"2021-04-30 17:56:59.392681\";s:13:\"timezone_type\";i:3;s:8:\"timezone\";s:19:\"America/Los_Angeles\";}'),
(6, '49.145.7.85', 17, 'O:8:\"DateTime\":3:{s:4:\"date\";s:26:\"2021-07-15 08:39:37.394699\";s:13:\"timezone_type\";i:3;s:8:\"timezone\";s:19:\"America/Los_Angeles\";}'),
(7, '49.144.54.56', 20, 'O:8:\"DateTime\":3:{s:4:\"date\";s:26:\"2022-02-26 18:58:39.753564\";s:13:\"timezone_type\";i:3;s:8:\"timezone\";s:19:\"America/Los_Angeles\";}'),
(8, '49.144.54.56', 24, 'O:8:\"DateTime\":3:{s:4:\"date\";s:26:\"2022-02-27 08:25:31.222018\";s:13:\"timezone_type\";i:3;s:8:\"timezone\";s:19:\"America/Los_Angeles\";}'),
(9, '73.135.65.92', 24, 'O:8:\"DateTime\":3:{s:4:\"date\";s:26:\"2022-03-06 13:43:42.331975\";s:13:\"timezone_type\";i:3;s:8:\"timezone\";s:19:\"America/Los_Angeles\";}');

-- --------------------------------------------------------

--
-- Table structure for table `visitor_counter`
--

CREATE TABLE `visitor_counter` (
	`cIPA` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `visitor_counter`
--

INSERT INTO `visitor_counter` (`cIPA`) VALUES
('49.144.54.56'),
('192.54.96.17'),
('73.135.65.92'),
('49.144.60.238'),
('185.225.234.43'),
('103.234.68.118'),
('100.15.108.151'),
('103.234.68.117'),
('66.249.79.8'),
('100.36.52.62'),
('111.7.96.167'),
('174.216.148.56'),
('180.194.247.121'),
('23.118.98.244'),
('104.28.55.65'),
('72.74.213.176'),
('216.180.83.43'),
('172.117.74.220'),
('73.141.109.75'),
('172.225.111.191'),
('69.171.251.4'),
('184.163.109.196'),
('189.174.121.40'),
('74.135.17.205'),
('73.74.200.92'),
('69.243.249.216'),
('24.192.133.113'),
('152.117.79.55'),
('69.160.160.52'),
('192.181.150.27'),
('92.31.213.154'),
('74.108.110.100'),
('76.19.150.6'),
('151.224.250.38'),
('68.203.251.230'),
('172.225.236.243'),
('67.193.172.229'),
('71.201.210.221'),
('107.147.189.253'),
('172.56.44.29'),
('66.52.4.50'),
('208.104.55.110'),
('38.15.38.63'),
('107.77.207.31'),
('71.112.184.38'),
('173.27.157.31'),
('174.216.150.215'),
('112.204.173.127'),
('216.174.142.82'),
('151.230.206.136'),
('24.185.93.212'),
('184.54.59.127'),
('98.238.247.215'),
('148.72.245.100'),
('5.180.78.53'),
('174.31.247.30'),
('212.102.46.70'),
('174.92.71.61'),
('96.23.20.11'),
('95.91.239.38'),
('172.56.42.83'),
('198.54.132.141'),
('136.50.234.156'),
('172.226.2.103'),
('152.37.69.145'),
('86.155.204.130'),
('81.173.79.144'),
('73.140.250.184'),
('92.221.90.175'),
('85.76.119.98'),
('174.216.149.19'),
('183.171.184.164'),
('183.171.98.73'),
('76.91.82.202'),
('50.68.48.80'),
('83.68.251.146'),
('24.192.106.178'),
('150.249.143.202');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cms`
--
ALTER TABLE `cms`
	ADD PRIMARY KEY (`cIndex`);

--
-- Indexes for table `fail_tracker`
--
ALTER TABLE `fail_tracker`
	ADD PRIMARY KEY (`cIndex`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
	ADD PRIMARY KEY (`cIndex`);

--
-- Indexes for table `t_artist`
--
ALTER TABLE `t_artist`
	ADD PRIMARY KEY (`i_index`);

--
-- Indexes for table `t_comment_approval`
--
ALTER TABLE `t_comment_approval`
	ADD PRIMARY KEY (`i_index`);

--
-- Indexes for table `t_vote`
--
ALTER TABLE `t_vote`
	ADD PRIMARY KEY (`c_index`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cms`
--
ALTER TABLE `cms`
	MODIFY `cIndex` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `fail_tracker`
--
ALTER TABLE `fail_tracker`
	MODIFY `cIndex` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
	MODIFY `cIndex` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;

--
-- AUTO_INCREMENT for table `t_artist`
--
ALTER TABLE `t_artist`
	MODIFY `i_index` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `t_comment_approval`
--
ALTER TABLE `t_comment_approval`
	MODIFY `i_index` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `t_vote`
--
ALTER TABLE `t_vote`
	MODIFY `c_index` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
