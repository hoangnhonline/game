-- phpMyAdmin SQL Dump
-- version 4.6.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 11, 2017 at 03:32 PM
-- Server version: 5.6.30-1+deb.sury.org~wily+2
-- PHP Version: 5.6.11-1ubuntu3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `game`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `cate_id` int(11) NOT NULL COMMENT '999 : landing page',
  `content` text,
  `is_hot` tinyint(1) NOT NULL,
  `project_id` int(11) DEFAULT NULL,
  `tab_id` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `display_order` tinyint(4) NOT NULL,
  `meta_id` bigint(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_user` tinyint(4) NOT NULL,
  `updated_user` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `articles_cate`
--

CREATE TABLE `articles_cate` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_user` tinyint(4) NOT NULL,
  `updated_user` tinyint(4) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `display_order` tinyint(4) NOT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` varchar(255) DEFAULT NULL,
  `meta_keywords` varchar(255) DEFAULT NULL,
  `custom_text` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `articles_cate`
--

INSERT INTO `articles_cate` (`id`, `name`, `slug`, `alias`, `description`, `image_url`, `created_at`, `updated_at`, `created_user`, `updated_user`, `status`, `display_order`, `meta_title`, `meta_description`, `meta_keywords`, `custom_text`) VALUES
(1, 'Topics', 'topics', 'topics', '', '', '2017-06-09 14:55:18', '2017-06-09 14:55:18', 1, 1, 1, 1, 'Topics', 'Topics', 'Topics', 'Topics');

-- --------------------------------------------------------

--
-- Table structure for table `banner`
--

CREATE TABLE `banner` (
  `id` int(11) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `ads_url` varchar(255) NOT NULL,
  `time_start` int(11) NOT NULL,
  `time_end` int(11) NOT NULL,
  `object_id` bigint(20) NOT NULL,
  `object_type` tinyint(1) NOT NULL COMMENT '1 : danh muc cha , 2 : danh mục con',
  `type` int(11) NOT NULL COMMENT '1 : không liên kết, 2 : trỏ đến 1 trang, 3',
  `display_order` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_user` tinyint(4) NOT NULL,
  `updated_user` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `block`
--

CREATE TABLE `block` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `cate`
--

CREATE TABLE `cate` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `loai_id` tinyint(4) NOT NULL,
  `display_order` tinyint(4) NOT NULL,
  `created_user` tinyint(4) NOT NULL,
  `updated_user` tinyint(4) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `meta_id` bigint(20) DEFAULT NULL,
  `is_hot` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cate`
--

INSERT INTO `cate` (`id`, `name`, `alias`, `slug`, `description`, `loai_id`, `display_order`, `created_user`, `updated_user`, `created_at`, `updated_at`, `meta_id`, `is_hot`, `status`) VALUES
(1, 'Action', 'Action', 'action', '', 1, 1, 1, 1, '2017-07-10 15:30:26', '2017-07-10 15:30:27', 1, 0, 1),
(2, 'Adventure', 'Adventure', 'adventure', '', 1, 1, 1, 1, '2017-07-10 15:30:36', '2017-07-10 15:30:36', 2, 0, 1),
(3, 'Arcade', 'Arcade', 'arcade', '', 1, 1, 1, 1, '2017-07-10 15:32:58', '2017-07-10 15:32:58', 3, 0, 1),
(4, 'Board', 'Board', 'board', '', 1, 1, 1, 1, '2017-07-10 15:33:08', '2017-07-10 15:33:08', 4, 0, 1),
(5, 'Card', 'Card', 'card', '', 1, 1, 1, 1, '2017-07-10 15:33:17', '2017-07-10 15:33:17', 5, 0, 1),
(6, 'Casino', 'Casino', 'casino', '', 1, 1, 1, 1, '2017-07-10 15:33:31', '2017-07-10 15:33:31', 6, 0, 1),
(7, 'Art & Design', 'Art & Design', 'art-design', '', 2, 1, 1, 1, '2017-07-10 15:34:17', '2017-07-10 15:34:17', 7, 0, 1),
(8, 'Auto & Vehicles', 'Auto & Vehicles', 'auto-vehicles', '', 2, 1, 1, 1, '2017-07-10 15:34:28', '2017-07-10 15:34:28', 8, 0, 1),
(9, 'Beauty', 'Beauty', 'beauty', '', 2, 1, 1, 1, '2017-07-10 15:34:37', '2017-07-10 15:34:37', 9, 0, 1),
(10, 'Books & Reference', 'Books & Reference', 'books-reference', '', 2, 1, 1, 1, '2017-07-10 15:34:49', '2017-07-10 15:34:49', 10, 0, 1),
(11, 'Business', 'Business', 'business', '', 2, 1, 1, 1, '2017-07-10 15:34:59', '2017-07-10 15:35:00', 11, 0, 1),
(12, 'Comics', 'Comics', 'comics', '', 2, 1, 1, 1, '2017-07-10 15:35:09', '2017-07-10 15:35:09', 12, 0, 1),
(13, 'Communication', 'Communication', 'communication', '', 2, 1, 1, 1, '2017-07-10 15:35:19', '2017-07-10 15:35:19', 13, 0, 1),
(14, 'Dating', 'Dating', 'dating', '', 2, 1, 1, 1, '2017-07-10 15:35:29', '2017-07-10 15:35:30', 14, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `type` tinyint(4) NOT NULL,
  `title` varchar(255) NOT NULL,
  `gender` tinyint(1) NOT NULL DEFAULT '1',
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `content` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `updated_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `gender` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `birthday` varchar(20) NOT NULL,
  `cmnd` varchar(20) DEFAULT NULL,
  `is_main` tinyint(1) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `custom_link`
--

CREATE TABLE `custom_link` (
  `id` int(11) NOT NULL,
  `link_text` varchar(255) NOT NULL,
  `link_url` varchar(255) NOT NULL,
  `display_order` int(11) NOT NULL,
  `block_id` int(11) NOT NULL COMMENT '1 : lien ket noi bat'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `loai_sp`
--

CREATE TABLE `loai_sp` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text,
  `display_order` tinyint(4) NOT NULL DEFAULT '1',
  `is_hot` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_user` tinyint(4) NOT NULL,
  `updated_user` tinyint(4) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `meta_id` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `loai_sp`
--

INSERT INTO `loai_sp` (`id`, `name`, `alias`, `slug`, `description`, `display_order`, `is_hot`, `status`, `created_user`, `updated_user`, `created_at`, `updated_at`, `meta_id`) VALUES
(1, 'GAME', 'game', 'game', 'Game', 1, 1, 1, 1, 1, '2017-07-10 00:00:00', '2017-07-10 00:00:00', 0),
(2, 'APPS', 'apps', 'apps', 'Apps', 2, 1, 1, 1, 1, '2017-07-10 00:00:00', '2017-07-10 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `meta_data`
--

CREATE TABLE `meta_data` (
  `id` bigint(20) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `keywords` varchar(255) DEFAULT NULL,
  `custom_text` text,
  `created_user` int(11) NOT NULL,
  `updated_user` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `meta_data`
--

INSERT INTO `meta_data` (`id`, `title`, `description`, `keywords`, `custom_text`, `created_user`, `updated_user`, `created_at`, `updated_at`) VALUES
(1, 'Action', '', '', '', 1, 1, '2017-07-10 15:30:26', '2017-07-10 15:30:26'),
(2, 'Adventure', '', '', '', 1, 1, '2017-07-10 15:30:36', '2017-07-10 15:30:36'),
(3, 'Arcade', '', '', '', 1, 1, '2017-07-10 15:32:58', '2017-07-10 15:32:58'),
(4, 'Board', '', '', '', 1, 1, '2017-07-10 15:33:08', '2017-07-10 15:33:08'),
(5, 'Card', '', '', '', 1, 1, '2017-07-10 15:33:17', '2017-07-10 15:33:17'),
(6, 'Casino', '', '', '', 1, 1, '2017-07-10 15:33:31', '2017-07-10 15:33:31'),
(7, 'Art & Design', '', '', '', 1, 1, '2017-07-10 15:34:17', '2017-07-10 15:34:17'),
(8, 'Auto & Vehicles', '', '', '', 1, 1, '2017-07-10 15:34:28', '2017-07-10 15:34:28'),
(9, 'Beauty', '', '', '', 1, 1, '2017-07-10 15:34:37', '2017-07-10 15:34:37'),
(10, 'Books & Reference', '', '', '', 1, 1, '2017-07-10 15:34:49', '2017-07-10 15:34:49'),
(11, 'Business', '', '', '', 1, 1, '2017-07-10 15:35:00', '2017-07-10 15:35:00'),
(12, 'Comics', '', '', '', 1, 1, '2017-07-10 15:35:09', '2017-07-10 15:35:09'),
(13, 'Communication', '', '', '', 1, 1, '2017-07-10 15:35:19', '2017-07-10 15:35:19'),
(14, 'Dating', '', '', '', 1, 1, '2017-07-10 15:35:29', '2017-07-10 15:35:29'),
(15, 'Clash of Clans', '', '', '', 1, 1, '2017-07-11 14:12:59', '2017-07-11 14:40:02'),
(16, 'Time of War APK', '', '', '', 1, 1, '2017-07-11 14:46:05', '2017-07-11 14:46:05'),
(17, '', '', '', '', 1, 1, '2017-07-11 14:49:46', '2017-07-11 14:49:46');

-- --------------------------------------------------------

--
-- Table structure for table `newsletter`
--

CREATE TABLE `newsletter` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `is_member` tinyint(1) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `updated_user` tinyint(4) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(111) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `content` text,
  `image_url` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` varchar(255) DEFAULT NULL,
  `meta_keywords` varchar(255) DEFAULT NULL,
  `custom_text` varchar(255) DEFAULT NULL,
  `created_user` tinyint(4) NOT NULL,
  `updated_user` tinyint(4) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `title`, `slug`, `alias`, `description`, `content`, `image_url`, `status`, `meta_title`, `meta_description`, `meta_keywords`, `custom_text`, `created_user`, `updated_user`, `created_at`, `updated_at`) VALUES
(1, 'About us', 'about-us', 'about us', '', 'Content default', '', 1, 'About us', 'About us', 'About us', 'About us', 1, 1, '2017-06-09 14:52:42', '2017-06-09 14:52:42');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `content` text NOT NULL,
  `thumbnail_id` bigint(20) NOT NULL,
  `loai_id` int(11) NOT NULL,
  `cate_id` int(11) NOT NULL,
  `no_star` float DEFAULT NULL,
  `author` varchar(100) DEFAULT NULL,
  `latest_version` varchar(100) DEFAULT NULL,
  `publish_date` date NOT NULL,
  `url_android` varchar(255) DEFAULT NULL,
  `req_android` varchar(50) DEFAULT NULL,
  `url_ios` varchar(255) DEFAULT NULL,
  `req_ios` varchar(50) DEFAULT NULL,
  `url_wp` varchar(255) DEFAULT NULL,
  `req_wp` varchar(50) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `is_hot` tinyint(1) NOT NULL DEFAULT '0',
  `display_order` int(11) NOT NULL DEFAULT '1' COMMENT 'danh cho bds hot',
  `meta_id` bigint(20) NOT NULL,
  `created_user` int(11) DEFAULT NULL,
  `updated_user` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `alias`, `slug`, `description`, `content`, `thumbnail_id`, `loai_id`, `cate_id`, `no_star`, `author`, `latest_version`, `publish_date`, `url_android`, `req_android`, `url_ios`, `req_ios`, `url_wp`, `req_wp`, `status`, `is_hot`, `display_order`, `meta_id`, `created_user`, `updated_user`, `created_at`, `updated_at`) VALUES
(3, 'Clash of Clans', 'Clash of Clans', 'clash-of-clans', 'From rage-&shy;filled Barbarians with glorious mustaches to pyromaniac wizards, raise your own army and lead your clan to victory! Build your village to fend off raiders, battle against millions of players worldwide, and forge a powerful clan with others to destroy enemy clans.', '<h2>What&#39;s new</h2>\r\n2017-06-28<br />\r\n9.105.9<br />\r\nVarious minor bug fixes and improvements<br />\r\n<br />\r\n9.105<br />\r\nHome Village Upgrade Blitz<br />\r\n&bull; Upgrade Cannon, Archer Tower and Inferno Tower<br />\r\n&bull; Level up P.E.K.K.A, Healer, Wizard, Miner and Wall Breaker<br />\r\n&bull; Discounts and balancing, including new Town Hall 10 levels<br />\r\n<br />\r\n<br />\r\nBuilder Base Level Up<br />\r\n&bull; Get Builder Hall level 6 and new upgrades for EVERYTHING!<br />\r\n&bull; Bring out the Bats with the new Night Witch!<br />\r\n&bull; Burn foes to a crisp with the new Roaster defense!', 1, 1, 2, 3.5, 'Supercell', '9.105.9', '2017-06-28', 'https://apkpure.com/clash-of-clans-coc/com.supercell.clashofclans/download', '4+', 'https://apkpure.com/clash-of-clans-coc/com.supercell.clashofclans/download', '5+', 'https://apkpure.com/clash-of-clans-coc/com.supercell.clashofclans/download', '3+', 1, 1, 1, 15, 1, 1, '2017-07-11 14:12:59', '2017-07-11 14:42:59'),
(4, 'Time of War APK', 'Time of War APK', 'time-of-war-apk', 'Time of War is an online war-themed real-time SLG game of 2017 that challenges you to build your unbreakable empire, put your tactical mind to test against opponents and ultimately dominate the whole world with your formidable military forces. Are you ready to partner with friends worldwide to manage city&rsquo;s resources, develop your regiment and crush anyone in PVP and PVE battles that stands in your way? Just download and play for free!', 'Features:<br />\r\n<br />\r\n● Real-time strategy and resource management<br />\r\n<br />\r\nOnly strategy talks! Multi-armies and numerous lethal arms are in your hands, which can be a big help to defeat enemies and loot everything you want. However, stronger army doesn&rsquo;t guarantee victory because dozens of tactics and strategies are of great significance in war, so just remember don&rsquo;t underestimate your weak enemies! To win, what you should do is to find resources, reinforce military strength, and leverage your talents in the upcoming war!<br />\r\n<br />\r\n<br />\r\n● Team up and build strong alliances with others<br />\r\n<br />\r\nNo man is an island. Whether you&rsquo;re rallying against a barbarian leader or marching at a PvP bully, you&rsquo;ll need allies you can trust. Join a regiment, contribute your resources and wisdom to it when in peace and you will be rewarded with a powerful shelter when in war.<br />\r\n<br />\r\n● Online PVP and PVE war battles<br />\r\n<br />\r\nEnter an amazing online battlefield where battle for control of the PVP world, and PVE enemies attack with no warning. Feel free to engage into single-player mode and multi-player warfare and fight to survive in one of most thrilling and face-paced gameplay!&nbsp;<br />\r\n<br />\r\n● Immerge into an extremely realistic war-time experience<br />\r\n<br />\r\nSet in the Second World War, Time of War presents the actual the experience of eye-catching warfare, military operation, explosive conflicts throughout the world in mobile devices, where oil snatch, land occupation, historical battles are also featured. You are the very Commander who give the order to collect resources, build forces, join alliances, crush enemies and dominate the world! Join the war and be a hero!<br />\r\n<br />\r\nConnect with Time of War<br />\r\n<br />\r\nFacebook fanpage:<br />\r\nhttps://www.facebook.com/timeofwaren<br />\r\n<br />\r\nFacebook Group：<br />\r\nhttps://www.facebook.com/groups/timeofwaren/<br />\r\n<br />\r\nPLEASE NOTE: Time of War is completely free to download and play, however some game items can also be purchased for real money. If you don&#39;t want to use this feature, please disable in-app purchases in your device&#39;s settings.<br />\r\n<br />\r\nA stable network connection is also required.', 2, 1, 1, 4, 'iyoyo Studio', '1.0.6', '2017-06-30', 'https://apkpure.com/time-of-war/com.yoyogame.tow/download?from=details', '4+', 'https://apkpure.com/time-of-war/com.yoyogame.tow/download?from=details', '5+', 'https://apkpure.com/time-of-war/com.yoyogame.tow/download?from=details', '2+', 1, 1, 1, 16, 1, 1, '2017-07-11 14:46:05', '2017-07-11 14:46:05'),
(5, 'Digital World', 'Digital World', 'digital-world', 'The fullest and coolest digimons gather here, hurry to collect the stronger and popular digimons;<br />\r\nYou can challenge Arena, Guild battle, Cross Server Battle in our game;<br />\r\nWelfare of login, battle, level up and achievement are waiting for you!', '---Super Welfare---<br />\r\n*Great reward for 7 Days, Get digimon for free*<br />\r\nTen times recharge rebate and first recharge send you super digimon.<br />\r\n<br />\r\n---Game Feature---<br />\r\n【Appearance Design】<br />\r\nProfessional painter elaborately done in design, hundreds of gorgeous and elaborate image are vividly shown on the screen!<br />\r\n<br />\r\n【Skills and Gameplay】<br />\r\nRigorous set of digimons and totally restore of relationship make team up combo powerful and amazing. You are the one to master these strongest digimon rangers! Are you ready to make the strongest team?<br />\r\n<br />\r\n【Original animation】<br />\r\nFantastic story together with popular original songs brings you purest experience of secondary element!&nbsp;<br />\r\n<br />\r\n【Complete Collection】<br />\r\nEvery iconic character you encountered in your childhood gathers here. Partners in growth stage, mature stage and so on absolutely meet your needs of image quality.<br />\r\n<br />\r\n【Abundant Training】<br />\r\nYou can develop super digimons in several ways like equipment, spirit, divine weapon, talent and constellation. Limiting strategy lead you to dominate the world.<br />\r\n<br />\r\n【Exciting Challenges】<br />\r\nEvents of Arena, instance, trial, tamers, guild battle and Challenger Tournament would be released in turns. Here are PVP, PVE instances to enrich rewards and equip your rangers!<br />\r\n<br />\r\n==Contact Us==<br />\r\n<br />\r\nFacebook Fanpage: fb.com/digitalsoul.en<br />\r\nFacebook Groups: fb.com/groups/digitalsoul.en/', 3, 1, 1, 4, 'BigBullGame ltd.', '2.0.1', '2017-05-25', 'http://www.nhaccuatui.com/bai-hat/duyen-phan-nhu-quynh.2iu0Q9dbU4pM.html', '4+', 'http://www.nhaccuatui.com/bai-hat/duyen-phan-nhu-quynh.2iu0Q9dbU4pM.html', '4+', 'http://www.nhaccuatui.com/bai-hat/duyen-phan-nhu-quynh.2iu0Q9dbU4pM.html', '4+', 1, 1, 1, 17, 1, 1, '2017-07-11 14:49:46', '2017-07-11 14:49:46'),
(6, 'Lineage2 Revolution', 'Lineage2 Revolution', 'clash-of-clans', 'From rage-&shy;filled Barbarians with glorious mustaches to pyromaniac wizards, raise your own army and lead your clan to victory! Build your village to fend off raiders, battle against millions of players worldwide, and forge a powerful clan with others to destroy enemy clans.', '<h2>What&#39;s new</h2>\r\n2017-06-28<br />\r\n9.105.9<br />\r\nVarious minor bug fixes and improvements<br />\r\n<br />\r\n9.105<br />\r\nHome Village Upgrade Blitz<br />\r\n&bull; Upgrade Cannon, Archer Tower and Inferno Tower<br />\r\n&bull; Level up P.E.K.K.A, Healer, Wizard, Miner and Wall Breaker<br />\r\n&bull; Discounts and balancing, including new Town Hall 10 levels<br />\r\n<br />\r\n<br />\r\nBuilder Base Level Up<br />\r\n&bull; Get Builder Hall level 6 and new upgrades for EVERYTHING!<br />\r\n&bull; Bring out the Bats with the new Night Witch!<br />\r\n&bull; Burn foes to a crisp with the new Roaster defense!', 4, 1, 2, 3.5, 'Supercell', '9.105.9', '2017-06-28', 'https://apkpure.com/clash-of-clans-coc/com.supercell.clashofclans/download', '4+', 'https://apkpure.com/clash-of-clans-coc/com.supercell.clashofclans/download', '5+', 'https://apkpure.com/clash-of-clans-coc/com.supercell.clashofclans/download', '3+', 1, 1, 1, 15, 1, 1, '2017-07-11 15:22:50', '2017-07-11 15:29:08'),
(7, 'GoalKeeper Challenge', 'GoalKeeper Challenge', 'clash-of-clans', 'From rage-&shy;filled Barbarians with glorious mustaches to pyromaniac wizards, raise your own army and lead your clan to victory! Build your village to fend off raiders, battle against millions of players worldwide, and forge a powerful clan with others to destroy enemy clans.', '<h2>What&#39;s new</h2>\r\n2017-06-28<br />\r\n9.105.9<br />\r\nVarious minor bug fixes and improvements<br />\r\n<br />\r\n9.105<br />\r\nHome Village Upgrade Blitz<br />\r\n&bull; Upgrade Cannon, Archer Tower and Inferno Tower<br />\r\n&bull; Level up P.E.K.K.A, Healer, Wizard, Miner and Wall Breaker<br />\r\n&bull; Discounts and balancing, including new Town Hall 10 levels<br />\r\n<br />\r\n<br />\r\nBuilder Base Level Up<br />\r\n&bull; Get Builder Hall level 6 and new upgrades for EVERYTHING!<br />\r\n&bull; Bring out the Bats with the new Night Witch!<br />\r\n&bull; Burn foes to a crisp with the new Roaster defense!', 5, 1, 2, 3.5, 'Supercell', '9.105.9', '2017-06-28', 'https://apkpure.com/clash-of-clans-coc/com.supercell.clashofclans/download', '4+', 'https://apkpure.com/clash-of-clans-coc/com.supercell.clashofclans/download', '5+', 'https://apkpure.com/clash-of-clans-coc/com.supercell.clashofclans/download', '3+', 1, 1, 1, 15, 1, 1, '2017-07-11 15:22:50', '2017-07-11 15:29:19'),
(8, 'Clash Royale', 'Clash Royale', 'clash-of-clans', 'From rage-&shy;filled Barbarians with glorious mustaches to pyromaniac wizards, raise your own army and lead your clan to victory! Build your village to fend off raiders, battle against millions of players worldwide, and forge a powerful clan with others to destroy enemy clans.', '<h2>What&#39;s new</h2>\r\n2017-06-28<br />\r\n9.105.9<br />\r\nVarious minor bug fixes and improvements<br />\r\n<br />\r\n9.105<br />\r\nHome Village Upgrade Blitz<br />\r\n&bull; Upgrade Cannon, Archer Tower and Inferno Tower<br />\r\n&bull; Level up P.E.K.K.A, Healer, Wizard, Miner and Wall Breaker<br />\r\n&bull; Discounts and balancing, including new Town Hall 10 levels<br />\r\n<br />\r\n<br />\r\nBuilder Base Level Up<br />\r\n&bull; Get Builder Hall level 6 and new upgrades for EVERYTHING!<br />\r\n&bull; Bring out the Bats with the new Night Witch!<br />\r\n&bull; Burn foes to a crisp with the new Roaster defense!', 6, 1, 2, 3.5, 'Supercell', '9.105.9', '2017-06-28', 'https://apkpure.com/clash-of-clans-coc/com.supercell.clashofclans/download', '4+', 'https://apkpure.com/clash-of-clans-coc/com.supercell.clashofclans/download', '5+', 'https://apkpure.com/clash-of-clans-coc/com.supercell.clashofclans/download', '3+', 1, 1, 1, 15, 1, 1, '2017-07-11 15:22:50', '2017-07-11 15:29:32'),
(9, 'Mobile Legends: Bang bang', 'Mobile Legends: Bang bang', 'clash-of-clans', 'From rage-&shy;filled Barbarians with glorious mustaches to pyromaniac wizards, raise your own army and lead your clan to victory! Build your village to fend off raiders, battle against millions of players worldwide, and forge a powerful clan with others to destroy enemy clans.', '<h2>What&#39;s new</h2>\r\n2017-06-28<br />\r\n9.105.9<br />\r\nVarious minor bug fixes and improvements<br />\r\n<br />\r\n9.105<br />\r\nHome Village Upgrade Blitz<br />\r\n&bull; Upgrade Cannon, Archer Tower and Inferno Tower<br />\r\n&bull; Level up P.E.K.K.A, Healer, Wizard, Miner and Wall Breaker<br />\r\n&bull; Discounts and balancing, including new Town Hall 10 levels<br />\r\n<br />\r\n<br />\r\nBuilder Base Level Up<br />\r\n&bull; Get Builder Hall level 6 and new upgrades for EVERYTHING!<br />\r\n&bull; Bring out the Bats with the new Night Witch!<br />\r\n&bull; Burn foes to a crisp with the new Roaster defense!', 7, 1, 2, 3.5, 'Supercell', '9.105.9', '2017-06-28', 'https://apkpure.com/clash-of-clans-coc/com.supercell.clashofclans/download', '4+', 'https://apkpure.com/clash-of-clans-coc/com.supercell.clashofclans/download', '5+', 'https://apkpure.com/clash-of-clans-coc/com.supercell.clashofclans/download', '3+', 1, 1, 1, 15, 1, 1, '2017-07-11 15:22:50', '2017-07-11 15:29:46'),
(10, 'Dream League Soccer 2017', 'Dream League Soccer 2017', 'clash-of-clans', 'From rage-&shy;filled Barbarians with glorious mustaches to pyromaniac wizards, raise your own army and lead your clan to victory! Build your village to fend off raiders, battle against millions of players worldwide, and forge a powerful clan with others to destroy enemy clans.', '<h2>What&#39;s new</h2>\r\n2017-06-28<br />\r\n9.105.9<br />\r\nVarious minor bug fixes and improvements<br />\r\n<br />\r\n9.105<br />\r\nHome Village Upgrade Blitz<br />\r\n&bull; Upgrade Cannon, Archer Tower and Inferno Tower<br />\r\n&bull; Level up P.E.K.K.A, Healer, Wizard, Miner and Wall Breaker<br />\r\n&bull; Discounts and balancing, including new Town Hall 10 levels<br />\r\n<br />\r\n<br />\r\nBuilder Base Level Up<br />\r\n&bull; Get Builder Hall level 6 and new upgrades for EVERYTHING!<br />\r\n&bull; Bring out the Bats with the new Night Witch!<br />\r\n&bull; Burn foes to a crisp with the new Roaster defense!', 8, 1, 2, 3.5, 'Supercell', '9.105.9', '2017-06-28', 'https://apkpure.com/clash-of-clans-coc/com.supercell.clashofclans/download', '4+', 'https://apkpure.com/clash-of-clans-coc/com.supercell.clashofclans/download', '5+', 'https://apkpure.com/clash-of-clans-coc/com.supercell.clashofclans/download', '3+', 1, 1, 1, 15, 1, 1, '2017-07-11 15:22:50', '2017-07-11 15:29:56'),
(11, 'Gangstar New Orleans OpenWorld', 'Gangstar New Orleans OpenWorld', 'clash-of-clans', 'From rage-&shy;filled Barbarians with glorious mustaches to pyromaniac wizards, raise your own army and lead your clan to victory! Build your village to fend off raiders, battle against millions of players worldwide, and forge a powerful clan with others to destroy enemy clans.', '<h2>What&#39;s new</h2>\r\n2017-06-28<br />\r\n9.105.9<br />\r\nVarious minor bug fixes and improvements<br />\r\n<br />\r\n9.105<br />\r\nHome Village Upgrade Blitz<br />\r\n&bull; Upgrade Cannon, Archer Tower and Inferno Tower<br />\r\n&bull; Level up P.E.K.K.A, Healer, Wizard, Miner and Wall Breaker<br />\r\n&bull; Discounts and balancing, including new Town Hall 10 levels<br />\r\n<br />\r\n<br />\r\nBuilder Base Level Up<br />\r\n&bull; Get Builder Hall level 6 and new upgrades for EVERYTHING!<br />\r\n&bull; Bring out the Bats with the new Night Witch!<br />\r\n&bull; Burn foes to a crisp with the new Roaster defense!', 9, 1, 2, 3.5, 'Supercell', '9.105.9', '2017-06-28', 'https://apkpure.com/clash-of-clans-coc/com.supercell.clashofclans/download', '4+', 'https://apkpure.com/clash-of-clans-coc/com.supercell.clashofclans/download', '5+', 'https://apkpure.com/clash-of-clans-coc/com.supercell.clashofclans/download', '3+', 1, 1, 1, 15, 1, 1, '2017-07-11 15:22:50', '2017-07-11 15:30:09'),
(12, 'Subway Surfers', 'Subway Surfers', 'clash-of-clans', 'From rage-&shy;filled Barbarians with glorious mustaches to pyromaniac wizards, raise your own army and lead your clan to victory! Build your village to fend off raiders, battle against millions of players worldwide, and forge a powerful clan with others to destroy enemy clans.', '<h2>What&#39;s new</h2>\r\n2017-06-28<br />\r\n9.105.9<br />\r\nVarious minor bug fixes and improvements<br />\r\n<br />\r\n9.105<br />\r\nHome Village Upgrade Blitz<br />\r\n&bull; Upgrade Cannon, Archer Tower and Inferno Tower<br />\r\n&bull; Level up P.E.K.K.A, Healer, Wizard, Miner and Wall Breaker<br />\r\n&bull; Discounts and balancing, including new Town Hall 10 levels<br />\r\n<br />\r\n<br />\r\nBuilder Base Level Up<br />\r\n&bull; Get Builder Hall level 6 and new upgrades for EVERYTHING!<br />\r\n&bull; Bring out the Bats with the new Night Witch!<br />\r\n&bull; Burn foes to a crisp with the new Roaster defense!', 10, 1, 2, 3.5, 'Supercell', '9.105.9', '2017-06-28', 'https://apkpure.com/clash-of-clans-coc/com.supercell.clashofclans/download', '4+', 'https://apkpure.com/clash-of-clans-coc/com.supercell.clashofclans/download', '5+', 'https://apkpure.com/clash-of-clans-coc/com.supercell.clashofclans/download', '3+', 1, 1, 1, 15, 1, 1, '2017-07-11 15:22:50', '2017-07-11 15:30:43'),
(13, 'FIFA 16 Soccer', 'FIFA 16 Soccer', 'clash-of-clans', 'From rage-&shy;filled Barbarians with glorious mustaches to pyromaniac wizards, raise your own army and lead your clan to victory! Build your village to fend off raiders, battle against millions of players worldwide, and forge a powerful clan with others to destroy enemy clans.', '<h2>What&#39;s new</h2>\r\n2017-06-28<br />\r\n9.105.9<br />\r\nVarious minor bug fixes and improvements<br />\r\n<br />\r\n9.105<br />\r\nHome Village Upgrade Blitz<br />\r\n&bull; Upgrade Cannon, Archer Tower and Inferno Tower<br />\r\n&bull; Level up P.E.K.K.A, Healer, Wizard, Miner and Wall Breaker<br />\r\n&bull; Discounts and balancing, including new Town Hall 10 levels<br />\r\n<br />\r\n<br />\r\nBuilder Base Level Up<br />\r\n&bull; Get Builder Hall level 6 and new upgrades for EVERYTHING!<br />\r\n&bull; Bring out the Bats with the new Night Witch!<br />\r\n&bull; Burn foes to a crisp with the new Roaster defense!', 11, 1, 2, 3.5, 'Supercell', '9.105.9', '2017-06-28', 'https://apkpure.com/clash-of-clans-coc/com.supercell.clashofclans/download', '4+', 'https://apkpure.com/clash-of-clans-coc/com.supercell.clashofclans/download', '5+', 'https://apkpure.com/clash-of-clans-coc/com.supercell.clashofclans/download', '3+', 1, 1, 1, 15, 1, 1, '2017-07-11 15:22:51', '2017-07-11 15:30:52'),
(14, 'The Sims™ Mobile', 'The Sims™ Mobile', 'clash-of-clans', 'From rage-&shy;filled Barbarians with glorious mustaches to pyromaniac wizards, raise your own army and lead your clan to victory! Build your village to fend off raiders, battle against millions of players worldwide, and forge a powerful clan with others to destroy enemy clans.', '<h2>What&#39;s new</h2>\r\n2017-06-28<br />\r\n9.105.9<br />\r\nVarious minor bug fixes and improvements<br />\r\n<br />\r\n9.105<br />\r\nHome Village Upgrade Blitz<br />\r\n&bull; Upgrade Cannon, Archer Tower and Inferno Tower<br />\r\n&bull; Level up P.E.K.K.A, Healer, Wizard, Miner and Wall Breaker<br />\r\n&bull; Discounts and balancing, including new Town Hall 10 levels<br />\r\n<br />\r\n<br />\r\nBuilder Base Level Up<br />\r\n&bull; Get Builder Hall level 6 and new upgrades for EVERYTHING!<br />\r\n&bull; Bring out the Bats with the new Night Witch!<br />\r\n&bull; Burn foes to a crisp with the new Roaster defense!', 12, 1, 2, 3.5, 'Supercell', '9.105.9', '2017-06-28', 'https://apkpure.com/clash-of-clans-coc/com.supercell.clashofclans/download', '4+', 'https://apkpure.com/clash-of-clans-coc/com.supercell.clashofclans/download', '5+', 'https://apkpure.com/clash-of-clans-coc/com.supercell.clashofclans/download', '3+', 1, 1, 1, 15, 1, 1, '2017-07-11 15:22:51', '2017-07-11 15:31:02'),
(15, 'Fate/Grand Order (English)', 'Fate-Grand Order (English)', 'clash-of-clans', 'From rage-&shy;filled Barbarians with glorious mustaches to pyromaniac wizards, raise your own army and lead your clan to victory! Build your village to fend off raiders, battle against millions of players worldwide, and forge a powerful clan with others to destroy enemy clans.', '<h2>What&#39;s new</h2>\r\n2017-06-28<br />\r\n9.105.9<br />\r\nVarious minor bug fixes and improvements<br />\r\n<br />\r\n9.105<br />\r\nHome Village Upgrade Blitz<br />\r\n&bull; Upgrade Cannon, Archer Tower and Inferno Tower<br />\r\n&bull; Level up P.E.K.K.A, Healer, Wizard, Miner and Wall Breaker<br />\r\n&bull; Discounts and balancing, including new Town Hall 10 levels<br />\r\n<br />\r\n<br />\r\nBuilder Base Level Up<br />\r\n&bull; Get Builder Hall level 6 and new upgrades for EVERYTHING!<br />\r\n&bull; Bring out the Bats with the new Night Witch!<br />\r\n&bull; Burn foes to a crisp with the new Roaster defense!', 13, 1, 2, 3.5, 'Supercell', '9.105.9', '2017-06-28', 'https://apkpure.com/clash-of-clans-coc/com.supercell.clashofclans/download', '4+', 'https://apkpure.com/clash-of-clans-coc/com.supercell.clashofclans/download', '5+', 'https://apkpure.com/clash-of-clans-coc/com.supercell.clashofclans/download', '3+', 1, 1, 1, 15, 1, 1, '2017-07-11 15:22:51', '2017-07-11 15:31:13'),
(16, 'Pokémon GO', 'Pokemon GO', 'clash-of-clans', 'From rage-&shy;filled Barbarians with glorious mustaches to pyromaniac wizards, raise your own army and lead your clan to victory! Build your village to fend off raiders, battle against millions of players worldwide, and forge a powerful clan with others to destroy enemy clans.', '<h2>What&#39;s new</h2>\r\n2017-06-28<br />\r\n9.105.9<br />\r\nVarious minor bug fixes and improvements<br />\r\n<br />\r\n9.105<br />\r\nHome Village Upgrade Blitz<br />\r\n&bull; Upgrade Cannon, Archer Tower and Inferno Tower<br />\r\n&bull; Level up P.E.K.K.A, Healer, Wizard, Miner and Wall Breaker<br />\r\n&bull; Discounts and balancing, including new Town Hall 10 levels<br />\r\n<br />\r\n<br />\r\nBuilder Base Level Up<br />\r\n&bull; Get Builder Hall level 6 and new upgrades for EVERYTHING!<br />\r\n&bull; Bring out the Bats with the new Night Witch!<br />\r\n&bull; Burn foes to a crisp with the new Roaster defense!', 14, 1, 2, 3.5, 'Supercell', '9.105.9', '2017-06-28', 'https://apkpure.com/clash-of-clans-coc/com.supercell.clashofclans/download', '4+', 'https://apkpure.com/clash-of-clans-coc/com.supercell.clashofclans/download', '5+', 'https://apkpure.com/clash-of-clans-coc/com.supercell.clashofclans/download', '3+', 1, 1, 1, 15, 1, 1, '2017-07-11 15:22:51', '2017-07-11 15:31:36'),
(17, '8 Ball Pool', '8 Ball Pool', 'clash-of-clans', 'From rage-&shy;filled Barbarians with glorious mustaches to pyromaniac wizards, raise your own army and lead your clan to victory! Build your village to fend off raiders, battle against millions of players worldwide, and forge a powerful clan with others to destroy enemy clans.', '<h2>What&#39;s new</h2>\r\n2017-06-28<br />\r\n9.105.9<br />\r\nVarious minor bug fixes and improvements<br />\r\n<br />\r\n9.105<br />\r\nHome Village Upgrade Blitz<br />\r\n&bull; Upgrade Cannon, Archer Tower and Inferno Tower<br />\r\n&bull; Level up P.E.K.K.A, Healer, Wizard, Miner and Wall Breaker<br />\r\n&bull; Discounts and balancing, including new Town Hall 10 levels<br />\r\n<br />\r\n<br />\r\nBuilder Base Level Up<br />\r\n&bull; Get Builder Hall level 6 and new upgrades for EVERYTHING!<br />\r\n&bull; Bring out the Bats with the new Night Witch!<br />\r\n&bull; Burn foes to a crisp with the new Roaster defense!', 15, 1, 2, 3.5, 'Supercell', '9.105.9', '2017-06-28', 'https://apkpure.com/clash-of-clans-coc/com.supercell.clashofclans/download', '4+', 'https://apkpure.com/clash-of-clans-coc/com.supercell.clashofclans/download', '5+', 'https://apkpure.com/clash-of-clans-coc/com.supercell.clashofclans/download', '3+', 1, 1, 1, 15, 1, 1, '2017-07-11 15:22:51', '2017-07-11 15:31:47');

-- --------------------------------------------------------

--
-- Table structure for table `product_img`
--

CREATE TABLE `product_img` (
  `id` bigint(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `display_order` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_img`
--

INSERT INTO `product_img` (`id`, `product_id`, `image_url`, `display_order`) VALUES
(1, 3, '2017/07/11/clashofclans-1499758733.png', 1),
(2, 4, '2017/07/11/time-of-war-1499759164.png', 1),
(3, 5, '2017/07/11/digital-world-1499759385.png', 1),
(4, 6, '2017/07/11/lingeager2-1499761746.png', 1),
(5, 7, '2017/07/11/goalkeeper-1499761758.png', 1),
(6, 8, '2017/07/11/clash-1499761768.png', 1),
(7, 9, '2017/07/11/mobile-1499761785.png', 1),
(8, 10, '2017/07/11/soccer-1499761795.png', 1),
(9, 11, '2017/07/11/gangstar-1499761808.png', 1),
(10, 12, '2017/07/11/subway-1499761841.png', 1),
(11, 13, '2017/07/11/fifa-1499761851.png', 1),
(12, 14, '2017/07/11/sims-1499761861.png', 1),
(13, 15, '2017/07/11/fate-1499761872.png', 1),
(14, 16, '2017/07/11/pokemon-1499761880.png', 1),
(15, 17, '2017/07/11/pool-1499761906.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `seo`
--

CREATE TABLE `seo` (
  `id` int(11) NOT NULL,
  `page_name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `meta_title` varchar(255) CHARACTER SET utf8 NOT NULL,
  `meta_description` varchar(255) CHARACTER SET utf8 NOT NULL,
  `meta_keyword` varchar(255) CHARACTER SET utf8 NOT NULL,
  `seo_title` varchar(255) CHARACTER SET utf8 NOT NULL,
  `seo_text` text CHARACTER SET utf8
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  `value` longtext NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name`, `value`, `created_at`, `updated_at`) VALUES
(1, 'base_url', 'http://nghien.biz', '2016-07-27 14:37:52', '2016-07-27 14:37:52'),
(2, 'site_title', 'Bao bì Hòa Hợp Phát', '2016-07-27 14:37:52', '2017-06-10 08:24:37'),
(3, 'site_description', 'Chuyên cung cấp các loại bao bì', '2016-07-27 14:37:52', '2017-06-10 08:24:37'),
(4, 'site_keywords', 'bao bì, hòa hợp phát, thùng carton 3 lớp', '2016-07-27 14:37:52', '2017-06-10 08:24:37'),
(5, 'admin_email', 'hoangnhonline@gmail.com', '2016-07-27 14:37:52', '2016-07-27 14:37:52'),
(105, 'site_name', 'Bao bì Hòa Hợp Phát', '2016-07-27 14:37:52', '2017-06-10 08:24:37'),
(113, 'google_analystic', '', '2016-07-27 14:37:52', '2017-06-10 08:24:37'),
(114, 'facebook_appid', '', '2016-07-27 14:37:52', '2017-06-10 08:24:37'),
(115, 'google_fanpage', '', '2016-07-27 14:37:52', '2017-06-10 08:24:37'),
(116, 'facebook_fanpage', '', '2016-07-27 14:37:52', '2017-06-10 08:24:37'),
(117, 'twitter_fanpage', '', '2016-07-27 14:37:52', '2017-06-10 08:24:37'),
(130, 'logo', '', '2016-07-27 14:37:52', '2017-06-10 08:24:37'),
(131, 'favicon', '', '2016-07-27 14:37:52', '2017-06-10 08:24:37'),
(141, 'banner', '', '2016-07-27 14:37:52', '2017-06-10 08:24:37'),
(142, 'custom_text', '', '2016-07-27 14:37:52', '2017-06-10 08:24:37'),
(145, 'cty_info', '<p><span style="color:#006699">C&Ocirc;NG TY TNHH SẢN XU&Acirc;́T - THƯƠNG MẠI HÒA HỢP PHÁT</span></p>\r\n\r\n<p><strong>Địa chỉ:</strong> Khu KDC Thu&acirc;̣n Giao, Kp. Bình Thu&acirc;̣n 2, Thu&acirc;̣n Giao, Thu&acirc;̣n An, Bình Dương</p>\r\n\r\n<p><strong>Đi&ecirc;n thoại:</strong> (0650) 3721230 - <strong>Fax:</strong>(0650) 3721231</p>\r\n\r\n<p><strong>Email:</strong> <a class="link" href="mailto:baobigiay.hoahopphatbd@gmail.com?subject=feedback"> baobigiay.hoahopphatbd@gmail.com</a> - <strong>Website:&nbsp;</strong><a class="link" href="#" title="">http://truongdeptrai.com</a></p>\r\n', '2017-06-30 00:00:00', '2017-06-10 08:24:37'),
(146, 'loai_hinh', 'Nhà Sản Xuất', '2017-06-30 00:00:00', '2017-06-30 00:00:00'),
(147, 'san_pham_dich_vu_chinh', 'Thùng carton 3 lớp, Thùng carton 5 lớp...', '2017-06-30 00:00:00', '2017-06-30 00:00:00'),
(148, 'nam_thanh_lap', '2008', '2017-06-15 00:00:00', '2017-06-15 00:00:00'),
(149, 'so_thanh_vien', 'Từ 51 - 100 người', '2017-06-14 00:00:00', '2017-06-14 00:00:00'),
(150, 'doanh_thu', 'Bí mật/ không public', '2017-06-30 00:00:00', '2017-06-30 00:00:00'),
(151, 'thi_truong_chinh', 'Toàn quốc', '2017-06-30 00:00:00', '2017-06-30 00:00:00'),
(152, 'chung_chi', '', '2017-06-30 00:00:00', '2017-06-30 00:00:00'),
(153, 'nang_luc', '', '2017-06-30 00:00:00', '2017-06-30 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

CREATE TABLE `tag` (
  `id` bigint(20) NOT NULL,
  `meta_id` bigint(20) DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `type` tinyint(1) NOT NULL COMMENT '1 product 2 tin tuc 3 tien ich',
  `name` varchar(255) NOT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `description` varchar(32) DEFAULT NULL,
  `district_id` int(11) DEFAULT NULL COMMENT 'danh cho tien ich',
  `created_user` tinyint(4) NOT NULL,
  `updated_user` tinyint(4) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `tag`
--

INSERT INTO `tag` (`id`, `meta_id`, `slug`, `type`, `name`, `alias`, `description`, `district_id`, `created_user`, `updated_user`, `created_at`, `updated_at`) VALUES
(1, NULL, 'hoang-test', 1, 'hoang test', NULL, NULL, NULL, 1, 1, '2017-07-11 13:45:33', '2017-07-11 13:45:33'),
(2, NULL, 'huy-hoang', 1, 'huy hoang', NULL, NULL, NULL, 1, 1, '2017-07-11 13:45:33', '2017-07-11 13:45:33'),
(3, NULL, 'hoang-hon-mau-tim', 1, 'hoang hon mau tim', NULL, NULL, NULL, 1, 1, '2017-07-11 13:54:02', '2017-07-11 13:54:02'),
(4, NULL, 'game-hay', 1, 'game hay', NULL, NULL, NULL, 1, 1, '2017-07-11 13:55:02', '2017-07-11 13:55:02'),
(5, NULL, 'game-hanh-dong-hay', 1, 'game hanh dong hay', NULL, NULL, NULL, 1, 1, '2017-07-11 13:55:02', '2017-07-11 13:55:02'),
(6, NULL, 'clash-of-clans', 1, 'Clash of Clans', NULL, NULL, NULL, 1, 1, '2017-07-11 14:05:28', '2017-07-11 14:05:28'),
(7, NULL, 'time-of-war-apk', 1, 'Time of War APK', NULL, NULL, NULL, 1, 1, '2017-07-11 14:45:23', '2017-07-11 14:45:23'),
(8, NULL, 'digital-world', 1, 'Digital World', NULL, NULL, NULL, 1, 1, '2017-07-11 14:49:22', '2017-07-11 14:49:22');

-- --------------------------------------------------------

--
-- Table structure for table `tag_objects`
--

CREATE TABLE `tag_objects` (
  `object_id` int(20) NOT NULL,
  `tag_id` int(20) NOT NULL,
  `type` tinyint(4) NOT NULL COMMENT '1 : product, 2 : tin tuc',
  `object_type` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1 : product, 2 :tin tuc'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tag_objects`
--

INSERT INTO `tag_objects` (`object_id`, `tag_id`, `type`, `object_type`) VALUES
(3, 6, 1, 1),
(4, 7, 1, 1),
(5, 8, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `text`
--

CREATE TABLE `text` (
  `id` int(11) NOT NULL,
  `text` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `text`
--

INSERT INTO `text` (`id`, `text`) VALUES
(1, '0968 11 1080'),
(2, '0938 211 114'),
(3, 'vietsth1.11@gmail.com'),
(4, 'vietsth1.11@gmail.com'),
(5, 'CÔNG TY TNHH XD SỬA CHỮA CÔNG TRÌNH STH'),
(6, '54/2/19 Bạch Đằng, Phường 2, Q.Tân Bình, TP.HCM'),
(7, '08.6250 9292'),
(8, '0312996932'),
(9, 'sthsg.vn@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `changed_password` tinyint(1) NOT NULL DEFAULT '0',
  `remember_token` varchar(255) NOT NULL,
  `created_user` int(11) NOT NULL,
  `updated_user` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `password`, `role`, `status`, `changed_password`, `remember_token`, `created_user`, `updated_user`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@game.com', '$2y$10$WGfOGl/72bsKqSAHGeZ7vubR3CXuNtVQ6AfoGM2a1r.q60OaRJXmS', 3, 1, 0, '', 1, 1, '2017-06-02 00:00:00', '2017-06-02 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `articles_cate`
--
ALTER TABLE `articles_cate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `block`
--
ALTER TABLE `block`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cate`
--
ALTER TABLE `cate`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`),
  ADD KEY `slug` (`slug`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type` (`type`),
  ADD KEY `full_name` (`full_name`),
  ADD KEY `email` (`email`),
  ADD KEY `phone` (`phone`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `custom_link`
--
ALTER TABLE `custom_link`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loai_sp`
--
ALTER TABLE `loai_sp`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`,`slug`),
  ADD KEY `slug` (`slug`);

--
-- Indexes for table `meta_data`
--
ALTER TABLE `meta_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `newsletter`
--
ALTER TABLE `newsletter`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_img`
--
ALTER TABLE `product_img`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `image_url` (`image_url`);

--
-- Indexes for table `seo`
--
ALTER TABLE `seo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `option_name` (`name`) USING BTREE;

--
-- Indexes for table `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tag_objects`
--
ALTER TABLE `tag_objects`
  ADD PRIMARY KEY (`object_id`,`tag_id`,`type`);

--
-- Indexes for table `text`
--
ALTER TABLE `text`
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
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `articles_cate`
--
ALTER TABLE `articles_cate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `banner`
--
ALTER TABLE `banner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `block`
--
ALTER TABLE `block`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cate`
--
ALTER TABLE `cate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `custom_link`
--
ALTER TABLE `custom_link`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `loai_sp`
--
ALTER TABLE `loai_sp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `meta_data`
--
ALTER TABLE `meta_data`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `newsletter`
--
ALTER TABLE `newsletter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `product_img`
--
ALTER TABLE `product_img`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `seo`
--
ALTER TABLE `seo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=154;
--
-- AUTO_INCREMENT for table `tag`
--
ALTER TABLE `tag`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `text`
--
ALTER TABLE `text`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
