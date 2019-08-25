-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 25, 2019 at 08:25 AM
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
-- Table structure for table `account_info`
--

CREATE TABLE `account_info` (
  `account_id` bigint(20) NOT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `firstname` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `address2` text COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `region` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `zipcode` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `tel` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `updated_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `account_info`
--

INSERT INTO `account_info` (`account_id`, `avatar`, `firstname`, `lastname`, `address`, `address2`, `country`, `region`, `city`, `zipcode`, `phone`, `tel`, `updated_date`) VALUES
(1, '/upload/avatar/avatar-1.png', 'Vo', 'Khoa', 'C3', '', 'af', 'HCM', '', '', '', '', '0000-00-00 00:00:00');

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
(14, 'Tin kinh tế', 'tin-kinh-te', 0, '0000-00-00 00:00:00', '', 0, 0, 0, 0, 'english', 'blogs', 0),
(15, 'Bơm Hơi', 'bom-hoi', 0, '0000-00-00 00:00:00', '', 0, 0, 0, 0, 'english', 'products', 0),
(16, 'Tin khoa học', 'tin-khoa-hoc', 0, '0000-00-00 00:00:00', '', 0, 0, 0, 0, 'english', 'blogs', 0),
(17, 'Pháp luật', 'phap-luat', 0, '0000-00-00 00:00:00', '', 0, 0, 0, 0, 'english', 'blogs', 0),
(18, 'Xã hội', 'xa-hoi', 0, '0000-00-00 00:00:00', '', 0, 0, 0, 0, 'english', 'blogs', 0),
(19, 'Thời sự', 'thoi-su', 0, '0000-00-00 00:00:00', '', 0, 0, 0, 0, 'english', 'blogs', 0),
(20, 'Hướng dẫn sử dụng', 'huong-dan-su-dung', 0, '0000-00-00 00:00:00', '', 0, 0, 0, 0, 'english', 'docs', 0),
(21, 'Tài liệu phát triển', 'tai-lieu-phat-trien', 0, '0000-00-00 00:00:00', '', 0, 0, 0, 0, 'english', 'docs', 0),
(22, 'Hỗ trợ khách hàng', 'ho-tro-khach-hang', 0, '0000-00-00 00:00:00', '', 0, 0, 0, 0, 'english', 'docs', 0),
(23, 'Câu hỏi thường gặp', 'cau-hoi-thuong-gap', 0, '0000-00-00 00:00:00', '', 0, 0, 0, 0, 'english', 'docs', 0),
(24, 'Vấn đề khác', 'van-dje-khac', 0, '0000-00-00 00:00:00', '', 0, 0, 0, 0, 'english', 'docs', 0);

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
-- Table structure for table `email_list`
--

CREATE TABLE `email_list` (
  `email_id` bigint(20) NOT NULL,
  `email_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `tags` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `validate` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `gallery_id` bigint(20) NOT NULL,
  `gallery_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gallery_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tags` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`gallery_id`, `gallery_name`, `gallery_url`, `tags`, `created_date`) VALUES
(18, 'Ảnh thiên nhiên tháng 12', 'anh-thien-nhien-thang-12', 'parent', '2019-08-01 10:29:52'),
(19, 'Ảnh thiên nhiên tháng 13', 'anh-thien-nhien-thang-13', '', '2019-08-01 10:29:59'),
(20, 'Ảnh thiên nhiên tháng 9', 'anh-thien-nhien-thang-9-1', 'anhthiennhen', '2019-08-19 11:59:19');

-- --------------------------------------------------------

--
-- Table structure for table `gallery_image`
--

CREATE TABLE `gallery_image` (
  `image_id` bigint(20) NOT NULL,
  `image_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image_sorts` int(10) NOT NULL,
  `gallery_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `gallery_image`
--

INSERT INTO `gallery_image` (`image_id`, `image_name`, `image_url`, `image_hash`, `image_sorts`, `gallery_id`) VALUES
(12, 'ethereum.jpg', '/upload/image/gallery/19/ethereum.jpg', '757755199bfb6932476b281167fcb2aa485a69cf', 1, 19),
(13, 'adsensebannersizes.png', '/upload/image/gallery/18/adsensebannersizes.png', '94689d8556246fb60f85eba1171068a1e1feed06', 1, 18),
(14, 'Cloud-Hosting-Vs-VPS-Hosting-Banner-1.jpg', '/upload/image/gallery/20/Cloud-Hosting-Vs-VPS-Hosting-Banner-1.jpg', '680373845e006e7adfb4b37e0c68815316dc0542', 1, 20),
(15, 'crm1-2.jpg', '/upload/image/gallery/19/crm1-2.jpg', '4fc2e8827ec300357acb698387be1337ab217902', 1, 19),
(16, 'ethereum1.jpg', '/upload/image/gallery/19/ethereum1.jpg', 'd63e8d17ebc64dd3e16ccb4443d86c503e6d20a1', 3, 19),
(17, 'ethereum.png', '/upload/image/gallery/19/ethereum.png', 'f21cd861cd4e938b211053afde9524ef42dd4eab', 3, 19),
(18, 'jimdo_web.jpg', '/upload/image/gallery/19/jimdo_web.jpg', 'be34b4eb5eed6ff40ec452db6ad0319bb8d972a3', 5, 19),
(19, 'jQuery-Fileuploader-Beautiful-and-powerful-jQuery-and-PHP-file-upload-plugin-Innostudio-de.png', '/upload/image/gallery/19/jQuery-Fileuploader-Beautiful-and-powerful-jQuery-and-PHP-file-upload-plugin-Innostudio-de.png', 'aecdd0b3fceb160c413c0c76bc662d307cf6ff08', 6, 19),
(20, 'ks3Jzrd854dhMEgxxMdXUi-650-80.jpg', '/upload/image/gallery/19/ks3Jzrd854dhMEgxxMdXUi-650-80.jpg', '6aacd39fd5c5151b971289ff526564831160b109', 7, 19),
(21, 'docker-hub-ubuntu-image.png', '/upload/image/gallery/18/docker-hub-ubuntu-image.png', '942ff7cf29a8f5292e99b9b1ae419425358a05c5', 2, 18),
(22, 'githook.png', '/upload/image/gallery/18/githook.png', '3b81f1f1baebb90b6817e60b8e311d0720d92115', 3, 18),
(23, 'vps.png', '/upload/image/gallery/18/vps.png', 'eb2445a96c8453ecc5a821d0c20372c50691f9ae', 4, 18),
(32, 'best-wbsite-builder-cheap-vps-banner.jpg', '/upload/image/gallery/18/best-wbsite-builder-cheap-vps-banner.jpg', '8b53bb3013c4e73980bc494319ce2eb1a5b0db67', 2, 18),
(33, 'Cloud-Hosting-Vs-VPS-Hosting-Banner-1.jpg', '/upload/image/gallery/18/Cloud-Hosting-Vs-VPS-Hosting-Banner-1.jpg', '0a6722e35d82433b61296bfbf21acecc1348fc6a', 3, 18),
(34, 'install_XAMPP.png', '/upload/image/gallery/18/install_XAMPP.png', 'e26c83d79d6e364c34facbe8b2a24bfbb84b0331', 6, 18);

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
(1);

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
(3, 0, 'Con heo page', '', '', '_bank', 'con-heo-page', '', 'fas fa-address-book', '', '', 'english', '0', 0),
(4, 0, 'Contact Page', '', '', '0', 'contact-page', '', '', '', '', 'english', '', 0);

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
(1, 'Text Layout', '', '', '', '{components=html5}type=round&color=red&content=<h1>Con bo</h1>{/components}\r\n\r\n<section class=\"services\">\r\n   <div class=\"container\">\r\n      <div class=\"row d-flex\">\r\n      <div class=\"col-lg-4 col-sm-12 flex-box hidden-xs\">\r\n          <div class=\"border\">[plugin name=\"posts/catalog\"]limit=5&order=desc[/plugin]</div>\r\n      </div>\r\n        \r\n      <div class=\"col-lg-8 col-sm-12\">\r\n        <div class=\"row flex-box-card\">\r\n              <div class=\"col-lg-6 col-sm-12 mb-3 text-center\">\r\n                <div class=\"card card-body\">\r\n                  <div class=\"text-center\"><i class=\"fa fa-home fa-3x border p-3 rounded\"></i></div>\r\n                  <h3>Cung cấp đồng hồ lưu lượng </h3>\r\n                  <p>Chuyên cung cấp các sản phẩm đồng hồ lưu lượng trên toàn quốc</p>\r\n                </div>\r\n              </div>\r\n              <div class=\"col-lg-6 col-sm-12 mb-3 text-center\">\r\n                  <div class=\"card card-body\">\r\n                      <div class=\"text-center\"><i class=\"fa fa-home fa-3x border p-3 rounded\"></i></div>\r\n                      <h3>Cung cấp đồng hồ nước</h3>\r\n                      <p>Chuyên cung cấp các sản phẩm đồng hồ nước trên toàn quốc</p>\r\n                  </div>\r\n              </div>\r\n\r\n              <div class=\"col-lg-6 col-sm-12 text-center\">\r\n                <div class=\"card card-body\">\r\n                    <div class=\"text-center\"><i class=\"fa fa-home fa-3x border p-3 rounded\"></i></div>\r\n                    <h3>Cung cấp van công nghiệp</h3>\r\n                    <p>Chuyên cung cấp các sản phẩm van công nghiệp  trên toàn quốc</p>\r\n                </div>\r\n              </div>\r\n\r\n              <div class=\"col-lg-6 col-sm-12 text-center\">\r\n                <div class=\"card card-body\">\r\n                    <div class=\"text-center\"><i class=\"fa fa-home fa-3x border p-3 rounded\"></i></div>\r\n                    <h3>Cung cấp máy bơm</h3>\r\n                    <p>Chuyên cung cấp các sản phẩm máy bơm công nghiệp trên toàn quốc</p>\r\n                </div>\r\n              </div>\r\n        </div>\r\n        </div>\r\n        \r\n        </div>\r\n </div>\r\n</section>\r\n<section>\r\n   <div class=\"container\" data-animated=\"true\" data-sequence=\"150\">\r\n      {components=posts}limit=5&theme=masonry&animated=bounceIn{/components}\r\n    </div>\r\n</section>\r\n<section>\r\n   <div class=\"container\" data-animated=\"true\" data-sequence=\"200\">\r\n      <h3>Sản phẩm chủ lực</h3>\r\n      {components=posts}limit=5&animated=fadeIn{/components}\r\n </div>\r\n</section>\r\n\r\n\r\n\r\n<section>\r\n   <div class=\"container\">\r\n     <h1 class=\"text-center\">Đối tác</h1>\r\n     [components name=\"gallery\" class=\"col-lg-3 mb-3\" type=\"slide\"]limit=12&tags=doitac[/components]\r\n      \r\n  </div>\r\n</section>\r\n', 'home', 'english'),
(2, 'Contact Page', '', '', '', '', 'contact_page', 'english');

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
  `post_description` text COLLATE utf8_unicode_ci NOT NULL,
  `post_tag` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL,
  `language` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `channel` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(1) NOT NULL,
  `views` bigint(20) NOT NULL,
  `account_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post_title`, `post_image`, `post_url`, `post_content`, `post_description`, `post_tag`, `created_date`, `updated_date`, `language`, `channel`, `status`, `views`, `account_id`) VALUES
(1, 'Test noi dung', '[\"\\/upload\\/image\\/5d411c95baceb.png\",\"\\/upload\\/image\\/5d48e8b9154f1.png\",\"\\/upload\\/image\\/5d48e8b916cdf.png\"]', 'test-noi-dung', '<p>Ông Juan de Dios Velazquez, 77 tuổi, lấy thân chắn đạn cho vợ khi tay súng bất ngờ tấn công siêu thị Walmart ở Texas hôm 3/8.<img alt=\"Con gái&nbsp;của một người&nbsp;người mua hàng trong Walmart&nbsp;khóc khi tìm mẹ cô sau khi xả súng xảy ra.&nbsp;Ảnh: AP.\" data-natural-width=\"500\" src=\"blob:http://localhost/37993bae-2be4-224a-bae7-f01d4008ea45\" data-pwidth=\"500\" class=\" \"></p><p>Con gái của một người mua hàng trong siêu thị Walmart khóc khi tìm mẹ sau vụ xả súng. Ảnh: <em>AP.</em></p><p>Juan de Dios và vợ là Estela Nicolasa, 55 tuổi, mới chuyển từ Mexico đến Mỹ sinh sống được 6 tháng. Như mọi ngày, hai ông bà có mặt tại siêu thị Walmart ở thành phố El Paso, bang Texas chiều 3/8 để mua sắm một vài đồ dùng thì <a href=\"https://vnexpress.net/the-gioi/xa-sung-tai-sieu-thi-o-my-it-nhat-20-nguoi-thiet-mang-3962445.html\" rel=\"dofollow\">vụ xả súng</a> bất ngờ xảy ra, làm 20 người thiệt mạng và 26 người bị thương.</p><p>Ngay khi tiếng súng rộ lên, Juan de Dios nhao về phía trước để che chắn cho vợ. \"Chú tôi bị bắn ở cự ly gần, viên đạn xuyên qua người chú và trúng vào dì tôi\", cô cháu gái Norma Ramos nói.</p><p>Juan de Dios đang được điều trị tại một trung tâm y tế ở El Paso và phải trải qua nhiều cuộc phẫu thuật vì bị đạn xuyên qua người. Bà Estala cũng được phẫu thuật và đã ổn định. Trung tâm y tế hiện chưa cung cấp thêm thông tin về hai nạn nhân.</p><p>Nghi phạm Patrick Crusius, 21 tuổi, đã bị cảnh sát bắt. Hình ảnh từ máy quay an ninh cho thấy y mang theo một khẩu AK và đeo chụp bảo vệ tai khi tấn công vào siêu thị hôm 3/8, trước khi đầu hàng cảnh sát.</p>', '', 'home', '0000-00-00 00:00:00', '2019-08-17 07:25:28', 'english', 'blogs', 0, 0, 1),
(2, 'Test noi dung 123', '/upload/image/5d411ceec35cc.png', 'test-noi-dung-123', '<p>Nhập nội dung bài viết</p><p><img src=\"blob:http://localhost/9c01047b-61e9-074a-8131-ce9cdfc26055\" style=\"width: 100%;\" class=\"fr-fic fr-dib\"></p>', '', '', '0000-00-00 00:00:00', '2019-08-06 05:50:24', 'english', 'blogs', 0, 0, 0),
(3, 'Bai viet 17', '/upload/image/5d4164beea4fd.png', 'bai-viet-17', '<p>Nhập nội dung b&agrave;i viết</p>', '', '', '0000-00-00 00:00:00', '2019-08-20 05:49:21', 'english', 'blogs', 0, 0, 0),
(4, 'Bai viet 123', '/upload/image/5d481af7727f0.png', 'bai-viet-123', '<p>Nhập nội dung b&agrave;i viết</p>', '', '', '0000-00-00 00:00:00', '2019-08-20 04:19:59', 'english', 'blogs', 0, 0, 0),
(5, 'Con bo', '/upload/image/5d538f9a305bb.png', 'con-bo', '<p>Nhập nội dung bài viết</p>', '', '', '2019-08-14 06:32:59', '2019-08-14 06:35:38', 'english', 'blogs', 0, 0, 0),
(6, 'Test san pham 1', '/upload/image/5d55bf91a6d99.png', 'test-san-pham-1', '<p>Nhập nội dung bài viết</p><p>Con bo</p>', '', '', '2019-08-15 10:24:49', '0000-00-00 00:00:00', 'english', 'products', 0, 0, 1),
(7, 'Cài đặt & ứng dụng', '', 'cai-djat-ung-dung', '<article>Quyết định cảnh c&aacute;o &ocirc;ng Mu&ocirc;n được Thủ tướng ban h&agrave;nh ng&agrave;y 21/8. &Ocirc;ng Mu&ocirc;n đ&atilde; bị Ủy ban Kiểm tra Trung ương kỷ luật v&agrave;o th&aacute;ng trước.<br>Theo Ủy ban Kiểm tra Trung ương, &ocirc;ng Phạm Viết Mu&ocirc;n vi phạm khuyết điểm trong việc tham mưu cho l&atilde;nh đạo Ch&iacute;nh phủ về chủ trương thực hiện cổ phần h&oacute;a, tho&aacute;i vốn nh&agrave; nước tại một số doanh nghiệp thuộc Bộ Giao th&ocirc;ng Vận tải.<br><table align=\"center\" border=\"0\" cellpadding=\"3\" cellspacing=\"0\"><tbody><tr><td><img data-fr-image-pasted=\"true\" alt=\"Ông Phạm Viết Muôn. Ảnh: PV.&nbsp;\" data-natural-h=\"298\" data-natural-width=\"500\" src=\"https://i-vnexpress.vnecdn.net/2019/08/22/3a-pptc-9001-1566474497.jpg\" data-width=\"500\" data-pwidth=\"500\" class=\" \"></td></tr><tr><td>&Ocirc;ng Phạm Viết Mu&ocirc;n. Ảnh: <em>PV.&nbsp;</em><br></td></tr></tbody></table>Vi phạm của Ban c&aacute;n sự Đảng Bộ Giao th&ocirc;ng Vận tải v&agrave; một số l&atilde;nh đạo li&ecirc;n quan, trong đ&oacute; c&oacute; &ocirc;ng Phạm Viết Mu&ocirc;n &quot;đ&atilde; g&acirc;y thất tho&aacute;t lớn tiền v&agrave; t&agrave;i sản của Nh&agrave; nước, ảnh hưởng xấu đến uy t&iacute;n của tổ chức đảng v&agrave; ng&agrave;nh giao th&ocirc;ng vận tải, g&acirc;y bức x&uacute;c trong x&atilde; hội&quot;, th&ocirc;ng b&aacute;o của Ủy ban Kiểm tra Trung ương hồi th&aacute;ng 4 n&ecirc;u.<br>&Ocirc;ng Phạm Viết Mu&ocirc;n năm nay 64 tuổi, tr&igrave;nh độ tiến sĩ kinh tế, nhiều năm giữ vị tr&iacute; Ph&oacute; chủ nhiệm Văn ph&ograve;ng Ch&iacute;nh phủ v&agrave; nghỉ hưu từ th&aacute;ng 1/2015.</article>', 'Nhập nội dung b&agrave;i viết', '', '2019-08-22 03:42:41', '2019-08-22 04:31:04', 'english', 'docs', 0, 0, 1),
(8, 'Điều chỉnh giao diện', '', 'djieu-chinh-giao-dien', '<p>Nhập nội dung b&agrave;i viết</p>', 'Nhập nội dung b&agrave;i viết', '', '2019-08-22 04:28:03', '2019-08-22 04:28:03', 'english', 'docs', 0, 0, 1);

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
(26, 2, 3, '0000-00-00 00:00:00'),
(27, 2, 7, '0000-00-00 00:00:00'),
(28, 6, 15, '0000-00-00 00:00:00'),
(29, 1, 1, '0000-00-00 00:00:00'),
(30, 1, 3, '0000-00-00 00:00:00'),
(31, 3, 16, '0000-00-00 00:00:00'),
(34, 8, 20, '0000-00-00 00:00:00'),
(35, 7, 20, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `report_id` bigint(20) NOT NULL,
  `hash` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `report_key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `report_value` text COLLATE utf8_unicode_ci NOT NULL,
  `report_count` bigint(20) NOT NULL,
  `report_create` datetime NOT NULL,
  `report_update` datetime NOT NULL,
  `store` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `language` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`report_id`, `hash`, `report_key`, `report_value`, `report_count`, `report_create`, `report_update`, `store`, `language`) VALUES
(2, 'ecb7d0d47a6303b9e12b446b78ae0e19aa02ce0f', '', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'localhost', 'english'),
(3, 'b48af28979910507a72300805b16b39786c09205', '', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'localhost', 'english');

-- --------------------------------------------------------

--
-- Table structure for table `reports_robots`
--

CREATE TABLE `reports_robots` (
  `bot_id` int(10) NOT NULL,
  `bot_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `firstconnect` datetime NOT NULL,
  `reconnect` datetime NOT NULL,
  `count_connect` bigint(20) NOT NULL,
  `store` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `language` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reports_views`
--

CREATE TABLE `reports_views` (
  `view_id` bigint(20) NOT NULL,
  `view_hash` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `view_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `view_count` bigint(20) NOT NULL,
  `view_created` datetime NOT NULL,
  `view_update` datetime NOT NULL,
  `form_ip` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `hash_connect` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_bot` int(1) NOT NULL,
  `platform` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `browser` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_mobile` int(1) NOT NULL,
  `store` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `language` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `region` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `continent` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `reports_views`
--

INSERT INTO `reports_views` (`view_id`, `view_hash`, `view_url`, `view_count`, `view_created`, `view_update`, `form_ip`, `hash_connect`, `is_bot`, `platform`, `browser`, `is_mobile`, `store`, `language`, `city`, `region`, `country`, `continent`) VALUES
(1, 'f6c97a7f64063cfee7c2dc2157847204d4dbf093', '', 50, '2019-08-23 01:32:30', '2019-08-23 08:31:57', '::1', 'ecb7d0d47a6303b9e12b446b78ae0e19aa02ce0f', 0, 'Mac OS X', 'Firefox', 0, '', '', '', '', '', ''),
(2, '4784802269cbb42a9599e9f972e157c9cb38448f', '', 3, '2019-08-23 01:32:54', '2019-08-23 07:37:42', '::1', 'ecb7d0d47a6303b9e12b446b78ae0e19aa02ce0f', 0, 'Mac OS X', 'Firefox', 0, '', '', '', '', '', ''),
(3, '7aa6ecf7dc0323c7e5461adcf6ef3ba4bf79d223', '', 8, '2019-08-23 01:32:54', '2019-08-23 07:37:42', '::1', 'ecb7d0d47a6303b9e12b446b78ae0e19aa02ce0f', 0, 'Mac OS X', 'Firefox', 0, '', '', '', '', '', ''),
(4, '173e7300327e574b62977ac77a9148373f63c359', 'http://localhost/catalog/xa-hoi.html', 2, '2019-08-23 01:34:26', '2019-08-23 01:34:26', '::1', 'ecb7d0d47a6303b9e12b446b78ae0e19aa02ce0f', 0, 'Mac OS X', 'Firefox', 0, '', '', '', '', '', ''),
(5, '7cf5ad3eeb2a482fddba13d2fabe64235bb8b2e5', 'http://localhost/blogs/post/test-noi-dung-123.html', 3, '2019-08-23 01:39:35', '2019-08-23 03:35:37', '::1', 'ecb7d0d47a6303b9e12b446b78ae0e19aa02ce0f', 0, 'Mac OS X', 'Firefox', 0, 'localhost', 'english', '', '', '', ''),
(6, '16ad8a62fe4d4023fb35cca0d9841db5f1a3b8a6', 'http://localhost/home/enterprise', 2, '2019-08-23 03:27:23', '2019-08-23 03:40:43', '::1', 'ecb7d0d47a6303b9e12b446b78ae0e19aa02ce0f', 0, 'Mac OS X', 'Firefox', 0, 'localhost', 'english', '', '', '', '');

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
  `created_date` datetime NOT NULL,
  `autoload` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`config_id`, `config_name`, `config_value`, `language`, `store`, `created_date`, `autoload`) VALUES
(1, 'site_name', 'Sonataruby CRM', 'english', 'localhost', '0000-00-00 00:00:00', 0),
(2, 'site_description', 'Demo Script', 'english', 'localhost', '0000-00-00 00:00:00', 0),
(3, 'site_keyword', 'Demo Script', 'english', 'localhost', '0000-00-00 00:00:00', 0),
(4, 'icon', '/upload/image/favicon.png', 'english', 'localhost', '0000-00-00 00:00:00', 0),
(5, 'logo', '/upload/image/logo.png', 'english', 'localhost', '0000-00-00 00:00:00', 0),
(6, 'banner', '/upload/image/banner.png', 'english', 'localhost', '0000-00-00 00:00:00', 0),
(7, 'firstname', 'Khoa', 'english', 'localhost', '0000-00-00 00:00:00', 0),
(8, 'lastname', 'Vo', 'english', 'localhost', '0000-00-00 00:00:00', 0),
(9, 'address', '123', 'english', 'localhost', '0000-00-00 00:00:00', 0),
(10, 'address2', '', 'english', 'localhost', '0000-00-00 00:00:00', 0),
(11, 'country', 'bh', 'english', 'localhost', '0000-00-00 00:00:00', 0),
(12, 'city', 'HCM', 'english', 'localhost', '0000-00-00 00:00:00', 0),
(13, 'zipcode', '', 'english', 'localhost', '0000-00-00 00:00:00', 0),
(14, 'plugins', '{\"home\\/slider\":\"Slider\",\"posts\\/posts\":\"Posts\",\"posts\\/postsincatalog\":\"Postsincatalog\",\"home\\/video\":\"Video\",\"posts\\/catalog\":\"Catalog\",\"pages\\/pages\":\"Pages\"}', 'english', 'localhost', '0000-00-00 00:00:00', 0),
(15, 'site_navbar', 'Sonataruby CRM', 'english', 'localhost', '0000-00-00 00:00:00', 0),
(16, 'navbar_icon', '/upload/image/navbar.png', 'english', 'localhost', '0000-00-00 00:00:00', 0),
(27, 'header', '{\"sticky_header\":\"\",\"header_color\":\"bg-none\",\"header_style\":\"navbar-light\",\"height\":\"70\",\"scrolmenu\":\"data-scrolmenu\",\"scrolmenu_class\":\"fadeInUp bg-white\",\"shadown\":\"bg-shadown\",\"header_theme\":\"header\",\"footer_theme\":\"footer\"}', 'english', 'localhost', '0000-00-00 00:00:00', 0),
(29, 'channel', '{\"blogs\":{\"name\":\"Blogs\",\"url\":\"blogs\",\"layout\":\"blogs\"},\"products\":{\"name\":\"Products\",\"url\":\"products\",\"layout\":\"default\",\"image_size\":\"650x420\"},\"docs\":{\"name\":\"T\\u00e0i Li\\u1ec7u\",\"url\":\"docs\",\"layout\":\"default\",\"image_size\":\"\",\"options\":\"\"}}', 'english', 'localhost', '0000-00-00 00:00:00', 0),
(30, 'hotline', '0903908078', 'english', 'localhost', '0000-00-00 00:00:00', 0),
(31, 'site_email', 'thietkewebvip@gmail.com', 'english', 'localhost', '0000-00-00 00:00:00', 0),
(32, 'redirect', '{\"anhkhoa.html\":\"conbo.html\"}', 'english', 'localhost', '0000-00-00 00:00:00', 0),
(33, 'template', 'webdesign', 'english', 'localhost', '0000-00-00 00:00:00', 0),
(34, 'maintain', '0', 'english', 'localhost', '0000-00-00 00:00:00', 0),
(35, 'maintain_content', 'Chung toi dang offline', 'english', 'localhost', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `widgets`
--

CREATE TABLE `widgets` (
  `winget_id` int(10) NOT NULL,
  `winget_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `winget_icon` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `winget_content` text COLLATE utf8_unicode_ci NOT NULL,
  `winget_content_as` int(1) NOT NULL,
  `winget_display` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `winget_sort` int(10) NOT NULL,
  `language` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `widgets`
--

INSERT INTO `widgets` (`winget_id`, `winget_name`, `winget_icon`, `winget_content`, `winget_content_as`, `winget_display`, `winget_sort`, `language`) VALUES
(1, 'Sales', 'fab fa-rocketchat', '<p class=\"support\">Sales 1: 0986.979.585<br>Sales 2: 0939.749.038<br>Sales 3: 0972. 420.023<br>Sales 4: 0908.141.615<br>Sales 5: 0938.717.545<br>Kỹ thuật: 0938.456.993</p>', 0, 'rightslide,header', 3, 'english'),
(2, 'Category', 'far fa-address-book', '{components=catalog}type=products&amp;icon=fa fa-plus-circle{/components}', 0, 'rightslide', 1, 'english'),
(3, 'Đăng nhập', 'fas fa-unlock', '[components name=users]login[/components]', 0, 'rightslide', 2, 'english');

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
-- Indexes for table `account_info`
--
ALTER TABLE `account_info`
  ADD PRIMARY KEY (`account_id`);

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
-- Indexes for table `email_list`
--
ALTER TABLE `email_list`
  ADD PRIMARY KEY (`email_id`);

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
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`report_id`);

--
-- Indexes for table `reports_robots`
--
ALTER TABLE `reports_robots`
  ADD PRIMARY KEY (`bot_id`);

--
-- Indexes for table `reports_views`
--
ALTER TABLE `reports_views`
  ADD PRIMARY KEY (`view_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`config_id`);

--
-- Indexes for table `widgets`
--
ALTER TABLE `widgets`
  ADD PRIMARY KEY (`winget_id`);

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
  MODIFY `catalog_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `email_list`
--
ALTER TABLE `email_list`
  MODIFY `email_id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `gallery_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `gallery_image`
--
ALTER TABLE `gallery_image`
  MODIFY `image_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `menu_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `page_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `pages_layout`
--
ALTER TABLE `pages_layout`
  MODIFY `layout_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `posts_incatalog`
--
ALTER TABLE `posts_incatalog`
  MODIFY `incat_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `report_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `reports_robots`
--
ALTER TABLE `reports_robots`
  MODIFY `bot_id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `reports_views`
--
ALTER TABLE `reports_views`
  MODIFY `view_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `config_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `widgets`
--
ALTER TABLE `widgets`
  MODIFY `winget_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;