-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 21, 2016 at 12:59 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_owncms`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE IF NOT EXISTS `articles` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `sub_title` varchar(255) NOT NULL,
  `summary` text NOT NULL,
  `html_summary` text NOT NULL,
  `details` text NOT NULL,
  `html_details` text NOT NULL,
  `publication_status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_at` datetime NOT NULL,
  `deleled_at` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `user_id`, `title`, `sub_title`, `summary`, `html_summary`, `details`, `html_details`, `publication_status`, `created_at`, `modified_at`, `deleled_at`) VALUES
(1, 4, 'Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem.', 'Cras ultricies ligula sed magna dictum porta.', 'Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Nulla porttitor accumsan tincidunt. Nulla porttitor accumsan tincidunt. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque in ipsum id orci porta dapibus. Vivamus suscipit tortor eget felis porttitor volutpat. Proin eget tortor risus. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula.\r\n\r\n&nbsp;\r\n', '&lt;h3&gt;&lt;span style=&quot;font-size:20px&quot;&gt;Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Nulla porttitor accumsan tincidunt. Nulla porttitor accumsan tincidunt. Lorem ip&lt;/span&gt;sum dolor sit amet, consectetur adipiscing elit. Pellentesque in ipsum id orci porta dapibus. Vivamus suscipit tortor eget felis porttitor&lt;span class=&quot;marker&quot;&gt; volutpat. Proin eget tortor risus. Praese&lt;/span&gt;nt sapien massa, convallis a pellentesque nec, egestas non nisi. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula.&lt;/h3&gt;\r\n\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n', 'Nulla porttitor accumsan tincidunt. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec rutrum congue leo eget malesuada. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Sed porttitor lectus nibh. Curabitur aliquet quam id dui posuere blandit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque in ipsum id orci porta dapibus. Nulla porttitor accumsan tincidunt. Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem.\r\n', '&lt;p&gt;&lt;strong&gt;Nulla porttitor accumsan tincidunt. Lorem ipsum dolor sit amet, co&lt;/strong&gt;nsectetur adipiscing&lt;em&gt; elit. Donec rutrum congue leo eget malesuada&lt;/em&gt;. Praesent &lt;span class=&quot;marker&quot;&gt;sapien massa, convallis a pellentesque nec, egestas non ni&lt;/span&gt;si. Sed porttitor lectus nibh. C&lt;span style=&quot;font-size:20px&quot;&gt;urabitur aliquet quam id dui posuere blan&lt;/span&gt;dit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque in ipsum id orci porta dapibus. Nulla porttitor accumsan tincidunt. Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem.&lt;/p&gt;\r\n', 1, '2016-04-20 11:59:33', '0000-00-00 00:00:00', NULL),
(2, 4, 'Curabitur aliquet quam id dui posuere blandit edit sss', 'Donec sollicitudin molestie malesuada editeesss', 'Edit sss Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus. Donec rutrum congue leo eget malesuada. Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Sed porttitor lectus nibh. Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Vivamus suscipit tortor eget felis porttitor volutpat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Nulla quis lorem ut libero malesuada feugiat.\r\n', '&lt;h1&gt;&lt;span class=&quot;marker&quot;&gt;Edit sss Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus.&lt;/span&gt; Donec&lt;span style=&quot;font-size:20px&quot;&gt; rutrum congue leo eget malesuada. Vestibulum ac diam sit&lt;/span&gt; amet quam vehicula elementum sed sit amet dui. Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Sed porttitor lectus nibh. Curabitur arcu erat, &lt;em&gt;accumsan id imperdiet et, porttitor at sem. Vivamus suscipit&lt;/em&gt; tortor eget felis porttitor volutpat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Nulla quis lorem ut libero malesuada feugiat.&lt;/h1&gt;\r\n', 'Edit sss Curabitur aliquet quam id dui posuere blandit. Donec sollicitudin molestie malesuada. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed porttitor lectus nibh. Vivamus suscipit tortor eget felis porttitor volutpat. Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Pellentesque in ipsum id orci porta dapibus. Donec sollicitudin molestie malesuada. Pellentesque in ipsum id orci porta dapibus. Quisque velit nisi, pretium ut lacinia in, elementum id enim.\r\n', '&lt;h2&gt;&lt;strong&gt;&lt;span class=&quot;marker&quot;&gt;Edit sss&lt;/span&gt; Curabitur aliquet quam id dui posuere blandit. Donec sollicitudin molestie males&lt;/strong&gt;uada. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed porttitor lectus nibh. Vivamus suscipit tortor eget felis porttitor volutpat. Curabitur arcu erat, &lt;span style=&quot;font-size:20px&quot;&gt;accumsan id imperdiet et, porttitor at sem&lt;/span&gt;. Pellentesque in ipsum id orci porta dapibus. &lt;span class=&quot;marker&quot;&gt;Donec sollicitudin molesti&lt;/span&gt;e malesuada. Pellentesque in ipsum id orci porta dapibus. Quisque velit nisi, pretium ut lacinia in, elementum id enim.&lt;/h2&gt;\r\n', 1, '2016-04-20 12:07:13', '0000-00-00 00:00:00', NULL),
(3, 4, 'eeeeeCurabitur aliquet quam id dui posuere blandit edit', 'eeeeeDonec sollicitudin molestie malesuada edit', 'eeeeeVivamus magna justo, lacinia eget consectetur sed, convallis at tellus. Donec Edit rutrum congue leo eget malesuada. Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Sed porttitor lectus nibh. Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Vivamus suscipit tortor eget felis porttitor volutpat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Nulla quis lorem ut libero malesuada feugiat.\r\n', '&lt;p&gt;&lt;span class=&quot;marker&quot;&gt;eeeeeVivamus magna justo, lacinia eget consectetur sed, convallis at tellus.&lt;/span&gt; Donec&lt;span style=&quot;font-size:20px&quot;&gt; &lt;/span&gt;&lt;strong&gt;&lt;span class=&quot;marker&quot;&gt;Edit&lt;/span&gt; &lt;/strong&gt;&lt;span style=&quot;font-size:20px&quot;&gt;rutrum congue leo eget malesuada. Vestibulum ac diam sit&lt;/span&gt; amet quam vehicula elementum sed sit amet dui. Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Sed porttitor lectus nibh. Curabitur arcu erat, &lt;em&gt;accumsan id imperdiet et, porttitor at sem. Vivamus suscipit&lt;/em&gt; tortor eget felis porttitor volutpat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Nulla quis lorem ut libero malesuada feugiat.&lt;/p&gt;\r\n', 'eeeeeEdit Curabitur aliquet quam id dui posuere blandit. Donec sollicitudin molestie malesuada. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed porttitor lectus nibh. Vivamus suscipit tortor eget felis porttitor volutpat. Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Pellentesque in ipsum id orci porta dapibus. Donec sollicitudin molestie malesuada. Pellentesque in ipsum id orci porta dapibus. Quisque velit nisi, pretium ut lacinia in, elementum id enim.\r\n', '&lt;h2&gt;&lt;strong&gt;&lt;span class=&quot;marker&quot;&gt;eeeeeEdit&lt;/span&gt; Curabitur aliquet quam id dui posuere blandit. Donec sollicitudin molestie males&lt;/strong&gt;uada. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed porttitor lectus nibh. Vivamus suscipit tortor eget felis porttitor volutpat. Curabitur arcu erat, &lt;span style=&quot;font-size:20px&quot;&gt;accumsan id imperdiet et, porttitor at sem&lt;/span&gt;. Pellentesque in ipsum id orci porta dapibus. &lt;span class=&quot;marker&quot;&gt;Donec sollicitudin molesti&lt;/span&gt;e malesuada. Pellentesque in ipsum id orci porta dapibus. Quisque velit nisi, pretium ut lacinia in, elementum id enim.&lt;/h2&gt;\r\n', 0, '2016-04-20 19:34:32', '0000-00-00 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `articles_categories_mapping`
--

CREATE TABLE IF NOT EXISTS `articles_categories_mapping` (
`id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `category_id` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `articles_categories_mapping`
--

INSERT INTO `articles_categories_mapping` (`id`, `article_id`, `category_id`, `created_at`, `modified_at`, `deleted_at`) VALUES
(1, 1, '1,3,4', '2016-04-20 11:59:34', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 2, '1,5', '2016-04-20 12:07:13', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 3, '2,4,5', '2016-04-20 19:34:32', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `articles_images_mapping`
--

CREATE TABLE IF NOT EXISTS `articles_images_mapping` (
`id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `image_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `articles_images_mapping`
--

INSERT INTO `articles_images_mapping` (`id`, `article_id`, `image_id`, `created_at`, `modified_at`, `deleted_at`) VALUES
(1, 1, 1, '2016-04-20 11:59:34', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 2, 2, '2016-04-20 12:07:13', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 3, 3, '2016-04-20 19:34:32', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `articles_menu_mapping`
--

CREATE TABLE IF NOT EXISTS `articles_menu_mapping` (
`id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `articles_menu_mapping`
--

INSERT INTO `articles_menu_mapping` (`id`, `article_id`, `menu_id`, `created_at`, `modified_at`, `deleted_at`) VALUES
(1, 1, 5, '2016-04-20 11:59:34', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 2, 4, '2016-04-20 12:07:13', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 3, 4, '2016-04-20 19:34:32', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
`id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `parent_id` int(3) NOT NULL,
  `publication_status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `title`, `parent_id`, `publication_status`, `created_at`, `modified_at`, `deleted_at`) VALUES
(1, 'News', 0, 0, '2016-04-20 15:39:40', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'National', 0, 1, '2016-04-20 15:39:40', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'International', 0, 1, '2016-04-20 15:39:40', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'Sports', 0, 1, '2016-04-20 15:39:40', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'Entertainment', 0, 1, '2016-04-20 15:39:40', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'Cricket', 4, 1, '2016-04-20 15:39:40', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 'Football', 4, 0, '2016-04-20 15:39:40', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 'Travelling', 5, 0, '2016-04-20 15:39:40', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE IF NOT EXISTS `images` (
`id` int(11) NOT NULL,
  `image_name` varchar(250) NOT NULL,
  `extention` varchar(100) NOT NULL,
  `size` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `image_name`, `extention`, `size`, `created_at`, `modified_at`, `deleted_at`) VALUES
(1, '1461131973megamind.jpg', 'jpg', '25294', '2016-04-20 11:59:34', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, '14611324331017186_261013754039523_1524436942_n.jpg', 'jpg', '69641', '2016-04-20 12:07:13', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, '146118134212745796_982515458509721_3386842757098237506_n.jpg', 'jpg', '118399', '2016-04-20 19:34:32', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE IF NOT EXISTS `menus` (
`id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `parent_id` tinyint(1) NOT NULL DEFAULT '0',
  `url` varchar(255) NOT NULL,
  `menu_des` text NOT NULL,
  `publication_status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `title`, `parent_id`, `url`, `menu_des`, `publication_status`, `created_at`, `modified_at`, `deleted_at`) VALUES
(1, 'National', 0, 'national', '', 1, '2016-04-20 17:34:38', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'International', 0, 'international', '', 1, '2016-04-20 17:34:38', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Educational', 0, 'educational', '', 1, '2016-04-20 17:34:38', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'Sports', 0, 'sports', '', 1, '2016-04-20 17:34:38', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'Cricket', 4, 'cricket', '', 1, '2016-04-20 17:34:38', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'New Menu', 3, 'new_menu', '<p>fdfdsfdsfdsfdsfdsfsd</p>\r\n', 1, '2016-04-21 16:52:32', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 'New Menu2', 1, 'new_menu2', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaa\r\n', 1, '2016-04-21 16:55:08', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 'New Menu23', 5, 'new_menu3', 'dddddddddddddddddddddd\r\n', 0, '2016-04-21 16:56:52', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE IF NOT EXISTS `profiles` (
`id` int(5) NOT NULL,
  `user_id` int(3) NOT NULL,
  `user_group_id` int(2) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `firstname` varchar(150) NOT NULL,
  `lastname` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `mobile_no` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `country` varchar(50) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `is_admin` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id`, `user_id`, `user_group_id`, `is_active`, `firstname`, `lastname`, `email`, `gender`, `mobile_no`, `address`, `country`, `image`, `created_at`, `updated_at`, `deleted_at`, `is_admin`) VALUES
(1, 1, 0, 0, 'Polash', 'Ahmed', 'polash@gmail.com', 'male', '01924554545', 'addres here', 'Bangladesh', '1460889584ba22.png', '2016-04-20 13:50:07', '0000-00-00 00:00:00', NULL, 0),
(2, 2, 0, 0, 'Prodip', 'Roy', 'prodip@gmail.com', 'male', '0192565656', 'address here........', 'Bangladesh', '1460890731ba.png', '2016-04-20 13:50:07', '0000-00-00 00:00:00', NULL, 0),
(3, 3, 0, 1, 'Anich', 'Ahmed', 'anich@gmail.com', 'male', '01984545454', 'address here.......', 'Bangladesh', '146086140512705289_178164552555390_8321004466644460500_n.jpg', '2016-04-20 13:54:20', '0000-00-00 00:00:00', NULL, 0),
(4, 4, 0, 1, 'Abeer', 'Ahmed', 'abeer@gmail.com', 'male', '015212121212', 'address here......', 'Bangladesh', '1460809727megamind.jpg', '2016-04-20 13:54:20', '0000-00-00 00:00:00', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(4) NOT NULL,
  `user_group_id` int(3) NOT NULL,
  `unique_id` varchar(100) NOT NULL,
  `username` varchar(150) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(100) NOT NULL,
  `is_admin` tinyint(4) NOT NULL DEFAULT '0',
  `is_active` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_group_id`, `unique_id`, `username`, `email`, `password`, `is_admin`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 0, '570ec0db50517', 'polash', 'prodip@gmail.com', '123456', 0, 0, '2016-04-14 03:57:47', '0000-00-00 00:00:00', NULL),
(2, 0, '570ec16c69d77', 'prodip', 'prodiproy@gmail.com', '123', 0, 0, '2016-04-14 04:00:12', '0000-00-00 00:00:00', NULL),
(3, 0, '570ec1c2d8c1e', 'anich', 'anich@gmail.com', '1234', 0, 1, '2016-04-14 04:01:38', '0000-00-00 00:00:00', NULL),
(4, 0, '570ec32e9faae', 'abeer', 'abeer@gmail.com', '12345678', 1, 1, '2016-04-14 04:07:42', '0000-00-00 00:00:00', NULL),
(5, 0, '571062d40341f', 'polash', 'prodip@gmail.com', '123456', 0, 1, '2016-04-15 09:41:08', '0000-00-00 00:00:00', NULL),
(6, 0, '57159ca3c9c74', 'pro', 'prodip@gmail.com', '1', 0, 0, '2016-04-19 08:49:07', '0000-00-00 00:00:00', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `articles_categories_mapping`
--
ALTER TABLE `articles_categories_mapping`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `articles_images_mapping`
--
ALTER TABLE `articles_images_mapping`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `articles_menu_mapping`
--
ALTER TABLE `articles_menu_mapping`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
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
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `articles_categories_mapping`
--
ALTER TABLE `articles_categories_mapping`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `articles_images_mapping`
--
ALTER TABLE `articles_images_mapping`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `articles_menu_mapping`
--
ALTER TABLE `articles_menu_mapping`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
MODIFY `id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
