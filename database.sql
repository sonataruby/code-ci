-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 16, 2019 at 03:42 AM
-- Server version: 5.6.35
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `phpproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `account_id` bigint(20) NOT NULL,
  `network_id` bigint(20) NOT NULL,
  `account_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `account_password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `account_type` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(1) NOT NULL,
  `is_banned` int(1) NOT NULL,
  `banned_reson` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`account_id`, `network_id`, `account_email`, `account_password`, `account_type`, `status`, `is_banned`, `banned_reson`, `created_date`) VALUES
(1, 0, 'thietkewebvip@gmail.com', 'a131b831377a7ecb892750b1c2d118aaeca47647', 'enterprise', 1, 0, '', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `apps`
--

CREATE TABLE `apps` (
  `app_id` int(10) NOT NULL,
  `app_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `app_path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `app_support` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `app_version` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `app_author` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `app_update_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `channel` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `catalog`
--

INSERT INTO `catalog` (`catalog_id`, `catalog_name`, `catalog_url`, `catalog_parent`, `created_date`, `catalog_content`, `catalog_sort`, `show_menu`, `show_header`, `show_dashboard`, `language`, `channel`, `status`) VALUES
(1, 'Category', 'category', 0, '0000-00-00 00:00:00', '', 1, 0, 0, 0, 'english', '', 0),
(2, 'Con voi', 'con-voi', 0, '0000-00-00 00:00:00', '', 2, 0, 1, 1, 'english', '', 0),
(3, 'Con heo', 'con-heo', 0, '0000-00-00 00:00:00', '', 3, 0, 0, 0, 'english', '', 0),
(5, 'Con bo', 'con-bo', 0, '0000-00-00 00:00:00', '', 3, 0, 1, 1, 'english', '', 0),
(6, 'Catalog Name', 'catalog-name', 3, '0000-00-00 00:00:00', '', 1, 0, 0, 0, 'english', '', 0),
(7, 'Catalog Name', 'catalog-name', 0, '0000-00-00 00:00:00', '', 4, 0, 0, 0, 'english', '', 0),
(8, 'Catalog Name', 'catalog-name', 5, '0000-00-00 00:00:00', '', 1, 0, 0, 0, 'english', '', 0),
(14, 'con bo 23', 'con-bo-23', 0, '0000-00-00 00:00:00', '', 0, 0, 0, 0, 'english', 'blogs', 0),
(15, 'Bơm Hơi', 'bom-hoi', 0, '0000-00-00 00:00:00', '', 0, 0, 0, 0, 'english', 'products', 0);

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
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `menu_id` int(10) NOT NULL,
  `parent_id` int(10) NOT NULL,
  `menu_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `menu_icon` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `menu_link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `menu_sort` int(10) NOT NULL,
  `language` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`menu_id`, `parent_id`, `menu_name`, `menu_icon`, `menu_link`, `menu_sort`, `language`) VALUES
(1, 0, 'Trang chủ', 'fas fa-home', 'home', 1, 'english'),
(2, 0, 'Về chúng tôi', '', 'page_2,catalog_2', 2, 'english'),
(3, 0, 'Liên hệ', '', 'page_2', 3, 'english'),
(4, 0, 'Menu 2', '', 'page_1,page_2,catalog_1', 4, 'english'),
(5, 3, 'Menu Name', '', '#', 1, 'english');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `version` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`version`) VALUES
(0);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `page_id` int(10) NOT NULL,
  `parent_id` int(10) NOT NULL,
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
  `show_menu` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`page_id`, `parent_id`, `page_name`, `page_description`, `page_keyword`, `page_layout`, `page_url`, `page_content`, `page_icoin`, `page_image`, `page_tag`, `language`, `show_menu`, `status`) VALUES
(1, 0, 'Khoa 2', NULL, NULL, NULL, 'khoa-2', '<p>fdsa</p><p data-f-id=\"pbf\" style=\"text-align: center; font-size: 14px; margin-top: 30px; opacity: 0.65; font-family: sans-serif;\">Powered by <a href=\"https://www.froala.com/wysiwyg-editor?pb=1\" title=\"Froala Editor\">Froala Editor</a></p>', NULL, '', NULL, 'english', '0', 0),
(2, 0, 'Page 3', '', '', 'text_layout', 'page-3', '<section><h2>What makes the FastCloud Awesome</h2><p>Performance that exceeds your expectations and features you are about to fall in love with</p><img data-fr-image-pasted=\"true\" src=\"https://media.fastcomet.com/storage/upload/images/static/mpfeatures/website.svg\" alt=\"FastComet Free Domain\" class=\"fr-fic fr-dii\"><h3>Free Domain Forever</h3><p>Register or transfer an existing domain for free. We will renew it for you free of charge forever.</p><img data-fr-image-pasted=\"true\" src=\"https://media.fastcomet.com/storage/upload/images/static/mpfeatures/rocket.svg\" alt=\"FastComet SSD Only-Cloud\" class=\"fr-fic fr-dii\"><h3>SSD-Only Cloud</h3><p>Up to 300% faster access to your files and databases compared to non-SSD hosting providers!</p><img data-fr-image-pasted=\"true\" src=\"https://media.fastcomet.com/storage/upload/images/static/mpfeatures/cloud-server.svg\" alt=\"FastComet Free Cloudflare CDN\" class=\"fr-fic fr-dii\"><h3>Free Cloudflare CDN</h3><p>Distribute your content around the world, so it’s closer to your visitors (speeding up your site).</p><img data-fr-image-pasted=\"true\" src=\"https://media.fastcomet.com/storage/upload/images/static/mpfeatures/server.svg\" alt=\"FastComet Powerd By cPanel\" class=\"fr-fic fr-dii\"><h3>Powered by cPanel</h3><p>The most popular and powerful web hosting control panel for easy point-and-click management of your hosting account.</p><img data-fr-image-pasted=\"true\" src=\"https://media.fastcomet.com/storage/upload/images/static/mpfeatures/backup.svg\" alt=\"FastComet Daily and Weekly Backups\" class=\"fr-fic fr-dii\"><h3>Daily and Weekly Backups</h3><p>Free daily and weekly backups of your data to keep you safe. When others charge for this, we don’t!</p><img data-fr-image-pasted=\"true\" src=\"https://media.fastcomet.com/storage/upload/images/static/mpfeatures/support.svg\" alt=\"FastComet Free 24/7 Priority Support\" class=\"fr-fic fr-dii\"><h3>Free 24/7 Priority Support</h3><p>Because there is no great hosting without great technical support that cares about your website.</p><img data-fr-image-pasted=\"true\" src=\"https://media.fastcomet.com/storage/upload/images/static/mpfeatures/price.svg\" alt=\"FastComet Fixed Prices No Surprises\" class=\"fr-fic fr-dii\"><h3>Fixed Prices, No Surprises</h3><p>Same price no matter where you are from, your local currency or where you host your website.</p><img data-fr-image-pasted=\"true\" src=\"https://media.fastcomet.com/storage/upload/images/static/mpfeatures/money-back.svg\" alt=\"FastComet Money Back Guarantee\" class=\"fr-fic fr-dii\"><h3>100% Satisfaction or Money Back Guarantee</h3><p>45 days money-back guarantee for Cloud Shared Hosting and 7 days for VPS/DS Servers.</p></section>', 'fas fa-heart', '/upload/image/5d3fc5ab431c7.png', '', 'english', '0', 0),
(3, 0, 'Con heo page', '', '', '_bank', 'con-heo-page', '', 'fas fa-address-book', '', '', 'english', '0', 0);

-- --------------------------------------------------------

--
-- Table structure for table `pages_layout`
--

CREATE TABLE `pages_layout` (
  `layout_id` int(10) NOT NULL,
  `layout_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `layout_image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `layout_description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `layout_keyword` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `layout_content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `layout_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `language` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `pages_layout`
--

INSERT INTO `pages_layout` (`layout_id`, `layout_name`, `layout_image`, `layout_description`, `layout_keyword`, `layout_content`, `layout_url`, `language`) VALUES
(1, 'Text Layout', '', '', '', '\r\n<section class=\"animated bounceIn\" data-id=\"1\" data-animated=\"true\">\r\n  <div class=\"container\">\r\n    <div class=\"row d-flex\">\r\n      \r\n      <div class=\"col-lg-3 hidden-xs flex-box\"><div class=\"border\">[plugin name=\"posts/catalog\"]limit=5&order=desc[/plugin]</div></div>\r\n      <div class=\"col-lg-9 col-sm-12\">[plugin name=home/slider][\r\n{\"content\" : \"<h3>Con bo</h3>\", \"url\" : \"\", \"image\" : \"//wowslider.com/sliders/demo-77/data1/images/road220058.jpg\"},\r\n{\"content\" : \"\", \"url\" : \"\", \"image\" : \"//wowslider.com/sliders/demo-77/data1/images/road220058.jpg\"},\r\n{\"content\" : \"\", \"url\" : \"\", \"image\" : \"//wowslider.com/sliders/demo-77/data1/images/road220058.jpg\"}\r\n][/plugin]</div>\r\n    </div>\r\n  </div>\r\n</section>\r\n<section>\r\n   <div class=\"container\">\r\n      <div class=\"row\">\r\n        <div class=\"col\">\r\n         [plugin name=\"home/video\"]https://www.youtube.com/watch?v=rG9LMCL-HN0[/plugin]\r\n        </div>\r\n        <div class=\"col\">\r\n         [plugin name=\"home/video\"]https://www.youtube.com/watch?v=YbxLFA-BG0o[/plugin]\r\n        </div>\r\n      </div>\r\n  </div>\r\n</section>\r\n<section>\r\n   <div class=\"container\">\r\n      [plugin name=\"posts/posts\"]theme=oncepick&limit=7&order=desc[/plugin]\r\n  </div>\r\n</section>\r\n\r\n<section>\r\n   <div class=\"container\">\r\n      [plugin name=\"posts/posts\"]limit=5&order=desc[/plugin]\r\n </div>\r\n</section>\r\n\r\n<section>\r\n   <div class=\"container\">\r\n      [plugin name=\"posts/posts\"]limit=5&order=desc[/plugin]\r\n </div>\r\n</section>', 'home', 'english');

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
  `updated_date` datetime NOT NULL,
  `language` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `channel` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(1) NOT NULL,
  `views` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post_title`, `post_image`, `post_url`, `post_content`, `post_tag`, `created_date`, `updated_date`, `language`, `channel`, `status`, `views`) VALUES
(1, 'Test noi dung', '[\"\\/upload\\/image\\/5d411c95baceb.png\",\"\\/upload\\/image\\/5d48e8b9154f1.png\",\"\\/upload\\/image\\/5d48e8b916cdf.png\"]', 'test-noi-dung', '<p>Ông Juan de Dios Velazquez, 77 tuổi, lấy thân chắn đạn cho vợ khi tay súng bất ngờ tấn công siêu thị Walmart ở Texas hôm 3/8.<img alt=\"Con gái&nbsp;của một người&nbsp;người mua hàng trong Walmart&nbsp;khóc khi tìm mẹ cô sau khi xả súng xảy ra.&nbsp;Ảnh: AP.\" data-natural-width=\"500\" src=\"blob:http://localhost/37993bae-2be4-224a-bae7-f01d4008ea45\" data-pwidth=\"500\" class=\"fr-fic fr-dii\"></p><p>Con gái của một người mua hàng trong siêu thị Walmart khóc khi tìm mẹ sau vụ xả súng. Ảnh: <em>AP.</em></p><p><br></p><p>Juan de Dios và vợ là Estela Nicolasa, 55 tuổi, mới chuyển từ Mexico đến Mỹ sinh sống được 6 tháng. Như mọi ngày, hai ông bà có mặt tại siêu thị Walmart ở thành phố El Paso, bang Texas chiều 3/8 để mua sắm một vài đồ dùng thì <a href=\"https://vnexpress.net/the-gioi/xa-sung-tai-sieu-thi-o-my-it-nhat-20-nguoi-thiet-mang-3962445.html\" rel=\"dofollow\">vụ xả súng</a> bất ngờ xảy ra, làm 20 người thiệt mạng và 26 người bị thương.</p><p>Ngay khi tiếng súng rộ lên, Juan de Dios nhao về phía trước để che chắn cho vợ. \"Chú tôi bị bắn ở cự ly gần, viên đạn xuyên qua người chú và trúng vào dì tôi\", cô cháu gái Norma Ramos nói.</p><p>Juan de Dios đang được điều trị tại một trung tâm y tế ở El Paso và phải trải qua nhiều cuộc phẫu thuật vì bị đạn xuyên qua người. Bà Estala cũng được phẫu thuật và đã ổn định. Trung tâm y tế hiện chưa cung cấp thêm thông tin về hai nạn nhân.</p><p>Nghi phạm Patrick Crusius, 21 tuổi, đã bị cảnh sát bắt. Hình ảnh từ máy quay an ninh cho thấy y mang theo một khẩu AK và đeo chụp bảo vệ tai khi tấn công vào siêu thị hôm 3/8, trước khi đầu hàng cảnh sát.</p>', '', '0000-00-00 00:00:00', '2019-08-06 04:40:57', 'english', '', 0, 0),
(2, 'Test noi dung 123', '/upload/image/5d411ceec35cc.png', 'test-noi-dung-123', '<p>Nhập nội dung bài viết</p><p><img src=\"blob:http://localhost/9c01047b-61e9-074a-8131-ce9cdfc26055\" style=\"width: 100%;\" class=\"fr-fic fr-dib\"></p>', '', '0000-00-00 00:00:00', '2019-08-06 05:50:24', 'english', '', 0, 0),
(3, 'Bai viet 17', '/upload/image/5d4164beea4fd.png', 'bai-viet-17', '<p>Nhập nội dung bài viết</p>', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'english', '', 0, 0),
(4, 'Bai viet 123', '/upload/image/5d481af7727f0.png', 'bai-viet-123', '<p>Nhập nội dung bài viết</p>', '', '0000-00-00 00:00:00', '2019-08-05 02:08:46', 'english', '', 0, 0),
(5, 'Con bo', '/upload/image/5d538f9a305bb.png', 'con-bo', '<p>Nhập nội dung bài viết</p>', '', '2019-08-14 06:32:59', '2019-08-14 06:35:38', 'english', 'blogs', 0, 0),
(6, 'Test san pham 1', '/upload/image/5d55bf91a6d99.png', 'test-san-pham-1', '<p>Nhập nội dung bài viết</p><p>Con bo</p>', '', '2019-08-15 10:24:49', '0000-00-00 00:00:00', 'english', 'products', 0, 0);

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
(17, 3, 2, '0000-00-00 00:00:00'),
(18, 3, 7, '0000-00-00 00:00:00'),
(19, 4, 5, '0000-00-00 00:00:00'),
(24, 1, 1, '0000-00-00 00:00:00'),
(25, 1, 3, '0000-00-00 00:00:00'),
(26, 2, 3, '0000-00-00 00:00:00'),
(27, 2, 7, '0000-00-00 00:00:00'),
(28, 6, 15, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` bigint(20) NOT NULL,
  `product_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `product_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `product_content` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `config_id` int(10) NOT NULL,
  `config_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `config_value` text COLLATE utf8_unicode_ci NOT NULL,
  `language` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `store` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`config_id`, `config_name`, `config_value`, `language`, `store`, `created_date`) VALUES
(1, 'site_name', 'Sonataruby CRM', 'english', 'localhost', '0000-00-00 00:00:00'),
(2, 'site_description', 'Demo Script', 'english', 'localhost', '0000-00-00 00:00:00'),
(3, 'site_keyword', 'Demo Script', 'english', 'localhost', '0000-00-00 00:00:00'),
(4, 'icon', '/upload/image/favicon.png', 'english', 'localhost', '0000-00-00 00:00:00'),
(5, 'logo', '/upload/image/logo.png', 'english', 'localhost', '0000-00-00 00:00:00'),
(6, 'banner', '/upload/image/banner.png', 'english', 'localhost', '0000-00-00 00:00:00'),
(7, 'firstname', 'Khoa', 'english', 'localhost', '0000-00-00 00:00:00'),
(8, 'lastname', 'Vo', 'english', 'localhost', '0000-00-00 00:00:00'),
(9, 'address', '123', 'english', 'localhost', '0000-00-00 00:00:00'),
(10, 'address2', '', 'english', 'localhost', '0000-00-00 00:00:00'),
(11, 'country', 'bh', 'english', 'localhost', '0000-00-00 00:00:00'),
(12, 'city', 'HCM', 'english', 'localhost', '0000-00-00 00:00:00'),
(13, 'zipcode', '', 'english', 'localhost', '0000-00-00 00:00:00'),
(14, 'plugins', '{\"home\\/slider\":\"Slider\",\"home\\/video\":\"Video\",\"pages\\/pages\":\"Pages\",\"posts\\/catalog\":\"Catalog\",\"posts\\/posts\":\"Posts\"}', 'english', 'localhost', '0000-00-00 00:00:00'),
(15, 'site_navbar', 'Sonataruby CRM', 'english', 'localhost', '0000-00-00 00:00:00'),
(16, 'navbar_icon', '/upload/image/navbar.png', 'english', 'localhost', '0000-00-00 00:00:00'),
(27, 'header', '{\"sticky_header\":\"\",\"header_color\":\"bg-info\",\"header_style\":\"navbar-dark\",\"height\":\"70\",\"scrolmenu\":\"data-scrolmenu\",\"scrolmenu_class\":\"animated bounceDown\",\"shadown\":\"bg-shadown\"}', 'english', 'localhost', '0000-00-00 00:00:00'),
(29, 'channel', '{\"blogs\":{\"name\":\"Blogs\",\"url\":\"blogs\",\"layout\":\"blogs\"},\"products\":{\"name\":\"Products\",\"url\":\"products\",\"layout\":\"default\"}}', 'english', 'localhost', '0000-00-00 00:00:00'),
(30, 'hotline', '0903908078', 'english', 'localhost', '0000-00-00 00:00:00'),
(31, 'site_email', 'thietkewebvip@gmail.com', 'english', 'localhost', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`account_id`),
  ADD KEY `network_id` (`network_id`);

--
-- Indexes for table `apps`
--
ALTER TABLE `apps`
  ADD PRIMARY KEY (`app_id`);

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
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`menu_id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`page_id`);

--
-- Indexes for table `pages_layout`
--
ALTER TABLE `pages_layout`
  ADD PRIMARY KEY (`layout_id`);

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
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`config_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `account_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `apps`
--
ALTER TABLE `apps`
  MODIFY `app_id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `catalog`
--
ALTER TABLE `catalog`
  MODIFY `catalog_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
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
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `menu_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `page_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `pages_layout`
--
ALTER TABLE `pages_layout`
  MODIFY `layout_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `posts_incatalog`
--
ALTER TABLE `posts_incatalog`
  MODIFY `incat_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `config_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;