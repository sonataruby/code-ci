-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 01, 2019 at 02:17 PM
-- Server version: 5.6.35
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `phpproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `catalog`
--

CREATE TABLE `catalog` (
  `catalog_id` int(10) NOT NULL,
  `catalog_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `catalog_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `catalog_parent` int(10) NOT NULL,
  `created_date` datetime NOT NULL,
  `catalog_content` text COLLATE utf8_unicode_ci NOT NULL,
  `catalog_sort` int(10) NOT NULL,
  `show_menu` int(1) NOT NULL,
  `show_header` int(1) NOT NULL,
  `show_dashboard` int(1) NOT NULL,
  `language` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `catalog`
--

INSERT INTO `catalog` (`catalog_id`, `catalog_name`, `catalog_url`, `catalog_parent`, `created_date`, `catalog_content`, `catalog_sort`, `show_menu`, `show_header`, `show_dashboard`, `language`, `status`) VALUES
(1, 'Category', 'category', 0, '0000-00-00 00:00:00', '', 1, 0, 0, 0, 'english', 0),
(2, 'Con voi', 'con-voi', 3, '0000-00-00 00:00:00', '', 1, 0, 1, 1, 'english', 0),
(3, 'Con heo', 'con-heo', 1, '0000-00-00 00:00:00', '', 1, 0, 0, 0, 'english', 0),
(5, 'Con bo', 'con-bo', 0, '0000-00-00 00:00:00', '', 2, 0, 1, 1, 'english', 0),
(6, 'Catalog Name', 'catalog-name', 3, '0000-00-00 00:00:00', '', 0, 0, 0, 0, 'english', 0),
(7, 'Catalog Name', 'catalog-name', 5, '0000-00-00 00:00:00', '', 0, 0, 0, 0, 'english', 0),
(8, 'Catalog Name', 'catalog-name', 5, '0000-00-00 00:00:00', '', 0, 0, 0, 0, 'english', 0);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` bigint(20) NOT NULL,
  `post_id` bigint(20) NOT NULL,
  `customer_id` bigint(20) NOT NULL,
  `comment_text` text COLLATE utf8_unicode_ci NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `gallery_id` bigint(20) NOT NULL,
  `gallery_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gallery_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`gallery_id`, `gallery_name`, `gallery_url`, `created_date`) VALUES
(15, 'Ảnh thiên nhiên tháng 9', 'anh-thien-nhien-thang-9', '2019-08-01 10:23:42'),
(16, 'Ảnh thiên nhiên tháng 10', 'anh-thien-nhien-thang-10', '2019-08-01 10:29:39'),
(17, 'Ảnh thiên nhiên tháng 11', 'anh-thien-nhien-thang-11', '2019-08-01 10:29:45'),
(18, 'Ảnh thiên nhiên tháng 12', 'anh-thien-nhien-thang-12', '2019-08-01 10:29:52'),
(19, 'Ảnh thiên nhiên tháng 13', 'anh-thien-nhien-thang-13', '2019-08-01 10:29:59');

-- --------------------------------------------------------

--
-- Table structure for table `gallery_image`
--

CREATE TABLE `gallery_image` (
  `image_id` bigint(20) NOT NULL,
  `image_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gallery_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `page_id` int(10) NOT NULL,
  `page_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `page_description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `page_keyword` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `page_layout` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `page_url` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `page_content` longtext COLLATE utf8_unicode_ci,
  `page_icoin` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `page_image` text COLLATE utf8_unicode_ci NOT NULL,
  `page_tag` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `language` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `show_menu` int(1) NOT NULL,
  `show_header` int(1) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`page_id`, `page_name`, `page_description`, `page_keyword`, `page_layout`, `page_url`, `page_content`, `page_icoin`, `page_image`, `page_tag`, `language`, `show_menu`, `show_header`, `status`) VALUES
(1, 'Khoa 2', NULL, NULL, NULL, 'khoa-2', '<p>fdsa</p><p data-f-id=\"pbf\" style=\"text-align: center; font-size: 14px; margin-top: 30px; opacity: 0.65; font-family: sans-serif;\">Powered by <a href=\"https://www.froala.com/wysiwyg-editor?pb=1\" title=\"Froala Editor\">Froala Editor</a></p>', NULL, '', NULL, 'english', 0, 0, 0),
(2, 'Page 3', '', '', '_bank', 'page-3', '<section><h2>What makes the FastCloud Awesome</h2><p>Performance that exceeds your expectations and features you are about to fall in love with</p><img data-fr-image-pasted=\"true\" src=\"https://media.fastcomet.com/storage/upload/images/static/mpfeatures/website.svg\" alt=\"FastComet Free Domain\" class=\"fr-fic fr-dii\"><h3>Free Domain Forever</h3><p>Register or transfer an existing domain for free. We will renew it for you free of charge forever.</p><img data-fr-image-pasted=\"true\" src=\"https://media.fastcomet.com/storage/upload/images/static/mpfeatures/rocket.svg\" alt=\"FastComet SSD Only-Cloud\" class=\"fr-fic fr-dii\"><h3>SSD-Only Cloud</h3><p>Up to 300% faster access to your files and databases compared to non-SSD hosting providers!</p><img data-fr-image-pasted=\"true\" src=\"https://media.fastcomet.com/storage/upload/images/static/mpfeatures/cloud-server.svg\" alt=\"FastComet Free Cloudflare CDN\" class=\"fr-fic fr-dii\"><h3>Free Cloudflare CDN</h3><p>Distribute your content around the world, so it’s closer to your visitors (speeding up your site).</p><img data-fr-image-pasted=\"true\" src=\"https://media.fastcomet.com/storage/upload/images/static/mpfeatures/server.svg\" alt=\"FastComet Powerd By cPanel\" class=\"fr-fic fr-dii\"><h3>Powered by cPanel</h3><p>The most popular and powerful web hosting control panel for easy point-and-click management of your hosting account.</p><img data-fr-image-pasted=\"true\" src=\"https://media.fastcomet.com/storage/upload/images/static/mpfeatures/backup.svg\" alt=\"FastComet Daily and Weekly Backups\" class=\"fr-fic fr-dii\"><h3>Daily and Weekly Backups</h3><p>Free daily and weekly backups of your data to keep you safe. When others charge for this, we don’t!</p><img data-fr-image-pasted=\"true\" src=\"https://media.fastcomet.com/storage/upload/images/static/mpfeatures/support.svg\" alt=\"FastComet Free 24/7 Priority Support\" class=\"fr-fic fr-dii\"><h3>Free 24/7 Priority Support</h3><p>Because there is no great hosting without great technical support that cares about your website.</p><img data-fr-image-pasted=\"true\" src=\"https://media.fastcomet.com/storage/upload/images/static/mpfeatures/price.svg\" alt=\"FastComet Fixed Prices No Surprises\" class=\"fr-fic fr-dii\"><h3>Fixed Prices, No Surprises</h3><p>Same price no matter where you are from, your local currency or where you host your website.</p><img data-fr-image-pasted=\"true\" src=\"https://media.fastcomet.com/storage/upload/images/static/mpfeatures/money-back.svg\" alt=\"FastComet Money Back Guarantee\" class=\"fr-fic fr-dii\"><h3>100% Satisfaction or Money Back Guarantee</h3><p>45 days money-back guarantee for Cloud Shared Hosting and 7 days for VPS/DS Servers.</p></section>', 'fas fa-heart', '/upload/image/5d3fc5ab431c7.png', '', 'english', 0, 0, 0),
(3, 'Con heo page', '', '', '_bank', 'con-heo-page', '', 'fas fa-address-book', '', '', 'english', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` bigint(20) NOT NULL,
  `post_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `post_image` text COLLATE utf8_unicode_ci NOT NULL,
  `post_url` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `post_content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `post_tag` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` datetime NOT NULL,
  `language` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(1) NOT NULL,
  `views` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post_title`, `post_image`, `post_url`, `post_content`, `post_tag`, `created_date`, `language`, `status`, `views`) VALUES
(1, 'Test noi dung', '/upload/image/5d411c95baceb.png', 'test-noi-dung', '<p>Nhập nội dung bài viết</p>', '', '0000-00-00 00:00:00', 'english', 0, 0),
(2, 'Test noi dung 123', '/upload/image/5d411ceec35cc.png', 'test-noi-dung-123', '<p>Nhập nội dung bài viết</p><p><img src=\"blob:http://localhost/9c01047b-61e9-074a-8131-ce9cdfc26055\" style=\"width: 100%;\" class=\"fr-fic fr-dib\"></p>', '', '0000-00-00 00:00:00', 'english', 0, 0),
(3, 'Bai viet 17', '/upload/image/5d4164beea4fd.png', 'bai-viet-17', '<p>Nhập nội dung bài viết</p>', '', '0000-00-00 00:00:00', 'english', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `posts_incatalog`
--

CREATE TABLE `posts_incatalog` (
  `incat_id` bigint(20) NOT NULL,
  `post_id` bigint(20) NOT NULL,
  `catalog_id` int(10) NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `posts_incatalog`
--

INSERT INTO `posts_incatalog` (`incat_id`, `post_id`, `catalog_id`, `created_date`) VALUES
(7, 1, 1, '0000-00-00 00:00:00'),
(8, 1, 3, '0000-00-00 00:00:00'),
(13, 2, 3, '0000-00-00 00:00:00'),
(14, 2, 7, '0000-00-00 00:00:00'),
(15, 3, 7, '0000-00-00 00:00:00'),
(16, 3, 8, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `config_id` int(10) NOT NULL,
  `config_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `config_value` text COLLATE utf8_unicode_ci NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `catalog`
--
ALTER TABLE `catalog`
  ADD PRIMARY KEY (`catalog_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`gallery_id`);

--
-- Indexes for table `gallery_image`
--
ALTER TABLE `gallery_image`
  ADD PRIMARY KEY (`image_id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`page_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `posts_incatalog`
--
ALTER TABLE `posts_incatalog`
  ADD PRIMARY KEY (`incat_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`config_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `catalog`
--
ALTER TABLE `catalog`
  MODIFY `catalog_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `gallery_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `gallery_image`
--
ALTER TABLE `gallery_image`
  MODIFY `image_id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `page_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `posts_incatalog`
--
ALTER TABLE `posts_incatalog`
  MODIFY `incat_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `config_id` int(10) NOT NULL AUTO_INCREMENT;