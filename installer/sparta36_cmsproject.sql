-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 25, 2019 at 04:46 PM
-- Server version: 10.2.26-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sparta36_cmsproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(3) NOT NULL,
  `cat_name` varchar(128) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_name`) VALUES
(22, 'Food'),
(14, 'Arma'),
(15, 'PHP'),
(18, 'Javascript'),
(19, 'HTML'),
(20, 'Linux'),
(21, '\'Authorship\'');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(3) NOT NULL,
  `comment_post_id` int(3) NOT NULL,
  `comment_date` datetime NOT NULL,
  `comment_author` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `comment_email` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `comment_content` tinytext CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `comment_status` varchar(32) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_post_id`, `comment_date`, `comment_author`, `comment_email`, `comment_content`, `comment_status`) VALUES
(1, 2, '2019-08-24 00:00:00', 'Anonymous', 'guy@someplace.com', 'Ayylmao it\'s a test comment', 'approved'),
(2, 2, '2025-08-19 00:00:00', 'fesaf', 'asdf', 'adsfadsf', 'pending'),
(3, 2, '2025-08-19 00:00:00', 'ftgh', 'sdsdfsdhtws', 'ssfthsthj', 'pending'),
(4, 2, '2025-08-19 07:28:00', 'Some Dude', 'email@email.com', 'get rekt', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(3) NOT NULL,
  `post_cat_id` int(3) NOT NULL,
  `post_title` varchar(64) NOT NULL,
  `post_author` varchar(64) NOT NULL,
  `post_date` datetime(6) NOT NULL,
  `post_image` varchar(256) NOT NULL,
  `post_content` mediumtext NOT NULL,
  `post_comment_count` int(3) NOT NULL,
  `post_tags` varchar(256) NOT NULL,
  `post_status` varchar(32) NOT NULL,
  `post_comment_status` varchar(16) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post_cat_id`, `post_title`, `post_author`, `post_date`, `post_image`, `post_content`, `post_comment_count`, `post_tags`, `post_status`, `post_comment_status`) VALUES
(2, 14, 'Arma 3 is neat', 'SpartanD39', '2024-08-19 08:30:00.000000', 'board-361516__340.jpg', '&lt;p&gt;Lorem ipsum dolor sit amet&lt;/p&gt;', 0, 'arma, games', 'public', 'enabled'),
(3, 15, 'PHP Functions', 'Bob', '2024-08-19 09:45:00.000000', 'elephant-logo-php.jpg', '&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit. In lacinia placerat ex eget suscipit. Quisque auctor tortor auctor lorem hendrerit, vel consequat mi vestibulum. Vestibulum quis vulputate lectus. Duis vitae facilisis elit. Donec lacus dolor, viverra eu purus at, dignissim eleifend eros. Cras vehicula malesuada nunc, sed consectetur tortor egestas eleifend. Morbi at viverra purus, eget congue ipsum. Vivamus in finibus felis, eu laoreet est. Morbi sit amet tellus dignissim, aliquet risus quis, aliquam odio. Fusce varius, massa in tristique cursus, nibh massa malesuada urna, vitae blandit ante velit ac sapien. Praesent fermentum purus sit amet turpis dictum consequat. Morbi eget tristique lacus, sit amet maximus ante. Ut magna ligula, pretium sit amet pharetra ut, sagittis id mi. Quisque mollis sapien sed orci pharetra, ac pulvinar nulla viverra.&lt;/p&gt;', 0, 'php, code, functions, tutorial, tips', 'public', 'disabled'),
(4, 15, 'Javascript Magic', 'Sally', '2024-08-19 11:17:00.000000', 'itsmagic.jpg', '&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit. In lacinia placerat ex eget suscipit. Quisque auctor tortor auctor lorem hendrerit, vel consequat mi vestibulum. Vestibulum quis vulputate lectus. Duis vitae facilisis elit. Donec lacus dolor, viverra eu purus at, dignissim eleifend eros. Cras vehicula malesuada nunc, sed consectetur tortor egestas eleifend. Morbi at viverra purus, eget congue ipsum. Vivamus in finibus felis, eu laoreet est. Morbi sit amet tellus dignissim, aliquet risus quis, aliquam odio. Fusce varius, massa in tristique cursus, nibh massa malesuada urna, vitae blandit ante velit ac sapien. Praesent fermentum purus sit amet turpis dictum consequat. Morbi eget tristique lacus, sit amet maximus ante. Ut magna ligula, pretium sit amet pharetra ut, sagittis id mi. Quisque mollis sapien sed orci pharetra, ac pulvinar nulla viverra.&lt;/p&gt;', 0, 'javascript, js, web dev, tricks, tips', 'public', 'enabled');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
