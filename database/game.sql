-- phpMyAdmin SQL Dump
-- version 4.6.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 10, 2017 at 04:45 PM
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
(14, 'Dating', '', '', '', 1, 1, '2017-07-10 15:35:29', '2017-07-10 15:35:29');

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
  `req_android` tinyint(4) DEFAULT NULL,
  `url_ios` varchar(255) DEFAULT NULL,
  `req_ios` tinyint(4) DEFAULT NULL,
  `url_wp` varchar(255) DEFAULT NULL,
  `req_wp` tinyint(4) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `is_hot` tinyint(1) NOT NULL DEFAULT '0',
  `display_order` int(11) NOT NULL DEFAULT '1' COMMENT 'danh cho bds hot',
  `meta_id` bigint(20) NOT NULL,
  `created_user` int(11) DEFAULT NULL,
  `updated_user` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `product_img`
--
ALTER TABLE `product_img`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT;
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
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
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
