-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 30, 2019 at 10:38 AM
-- Server version: 5.7.26
-- PHP Version: 7.2.20

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
-- Table structure for table `design_blocks`
--

CREATE TABLE `design_blocks` (
  `block_id` int(10) NOT NULL,
  `block_name` varchar(255) NOT NULL,
  `block_content` longtext NOT NULL,
  `block_keyword` varchar(255) NOT NULL,
  `block_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `design_blocks`
--

INSERT INTO `design_blocks` (`block_id`, `block_name`, `block_content`, `block_keyword`, `block_image`) VALUES
(1, 'Team Groups', '<div class=\"container-fluid\">\r\n<div class=\"row\">\r\n<div class=\"col-6 col-sm-12\"><img src=\"http://develop.com/upload/blocks/5d66725d36f51.jpeg\"></div>\r\n<div class=\"col-6 col-sm-12\">Right</div>\r\n</div>\r\n</div>', 'tearmgroup', '/upload/blocks/5d66725d36f51.jpeg'),
(2, 'Meet Our Team', '<section class=\"team-2\">\r\n      <div class=\"container\">\r\n        <div class=\"row text-center justify-content-center\">\r\n          <div class=\"col-8\">\r\n            <h1>Meet Our Team</h1>\r\n          </div>\r\n        </div>\r\n    \r\n        <div class=\"row-50\"></div>\r\n    \r\n        <div class=\"row text-center justify-content-center\">\r\n          <div class=\"col-sm-3 m-sm-auto\">\r\n            <img alt=\"image\" class=\"img-fluid rounded-circle\" src=\"./imgs/people/4.jpg\">\r\n    \r\n            <h2>Sara Doe</h2>\r\n            <p>Founder</p>\r\n          </div>\r\n    \r\n          <div class=\"col-sm-3 m-sm-auto\">\r\n            <img alt=\"image\" class=\"img-fluid rounded-circle\" src=\"./imgs/people/5.jpg\">\r\n    \r\n            <h2>Sara Doe</h2>\r\n            <p>Founder</p>\r\n          </div>\r\n    \r\n          <div class=\"col-sm-3 m-sm-auto\">\r\n            <img alt=\"image\" class=\"img-fluid rounded-circle\" src=\"./imgs/people/7.jpg\">\r\n    \r\n            <h2>Sara Doe</h2>\r\n    \r\n            <p>Founder</p>\r\n          </div>\r\n        </div>\r\n      </div>\r\n    </section>', 'MeetOurTeam', '/upload/blocks/5d667ac4f1c33.jpeg');

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
  `language` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `store` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `language` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `store` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `pages_layout`
--

INSERT INTO `pages_layout` (`layout_id`, `layout_name`, `layout_image`, `layout_description`, `layout_keyword`, `layout_content`, `layout_url`, `language`, `store`) VALUES
(1, 'Home', '', '', '', '<section>\n<div class=\"container\">\n\n  \n  <h1 class=\"my-4\">Page Heading\n    <small>Secondary Text</small>\n  </h1>\n\n  <div class=\"card-group\">\n    <div class=\"card\">\n      <img json-image=\"\" src=\"...\" class=\"card-img-top\" alt=\"...\">\n      <div class=\"card-body\">\n        <h5 class=\"card-title\" json-name=\"\"><a json-url=\"\" href=\"/{channel}/{url}.html\">Card title</a></h5>\n        <p class=\"card-text\" json-description=\"\">This card has supporting text below as a natural lead-in to additional content.</p>\n        <p class=\"card-text\"><small class=\"text-muted\">Last updated 3 mins ago</small></p>\n      </div>\n    </div>\n\n    <div class=\"card\">\n      <img json-image=\"\" src=\"...\" class=\"card-img-top\" alt=\"...\">\n      <div class=\"card-body\">\n        <h5 class=\"card-title\" json-name=\"\"><a json-url=\"\" href=\"/{channel}/{url}.html\">Card title</a></h5>\n        <p class=\"card-text\" json-description=\"\">This card has supporting text below as a natural lead-in to additional content.</p>\n        <p class=\"card-text\"><small class=\"text-muted\">Last updated 3 mins ago</small></p>\n      </div>\n    </div>\n\n\n    <div class=\"card\">\n      <img json-image=\"\" src=\"...\" class=\"card-img-top\" alt=\"...\">\n      <div class=\"card-body\">\n        <h5 class=\"card-title\" json-name=\"\"><a json-url=\"\" href=\"/{channel}/{url}.html\">Card title</a></h5>\n        <p class=\"card-text\" json-description=\"\">This card has supporting text below as a natural lead-in to additional content.</p>\n        <p class=\"card-text\"><small class=\"text-muted\">Last updated 3 mins ago</small></p>\n      </div>\n    </div>\n\n    <div class=\"card\">\n      <img json-image=\"\" src=\"...\" class=\"card-img-top\" alt=\"...\">\n      <div class=\"card-body\">\n        <h5 class=\"card-title\" json-name=\"\"><a json-url=\"\" href=\"/{channel}/{url}.html\">Card title</a></h5>\n        <p class=\"card-text\" json-description=\"\">This card has supporting text below as a natural lead-in to additional content.</p>\n        <p class=\"card-text\"><small class=\"text-muted\">Last updated 3 mins ago</small></p>\n      </div>\n    </div>\n  </div>\n\n  <div class=\"card-group\">\n    <div class=\"card\">\n      <img json-image=\"\" src=\"...\" class=\"card-img-top\" alt=\"...\">\n      <div class=\"card-body\">\n        <h5 class=\"card-title\" json-name=\"\"><a json-url=\"\" href=\"/{channel}/{url}.html\">Card title</a></h5>\n        <p class=\"card-text\" json-description=\"\">This card has supporting text below as a natural lead-in to additional content.</p>\n        <p class=\"card-text\"><small class=\"text-muted\">Last updated 3 mins ago</small></p>\n      </div>\n    </div>\n\n    <div class=\"card\">\n      <img json-image=\"\" src=\"...\" class=\"card-img-top\" alt=\"...\">\n      <div class=\"card-body\">\n        <h5 class=\"card-title\" json-name=\"\"><a json-url=\"\" href=\"/{channel}/{url}.html\">Card title</a></h5>\n        <p class=\"card-text\" json-description=\"\">This card has supporting text below as a natural lead-in to additional content.</p>\n        <p class=\"card-text\"><small class=\"text-muted\">Last updated 3 mins ago</small></p>\n      </div>\n    </div>\n\n\n    <div class=\"card\">\n      <img json-image=\"\" src=\"...\" class=\"card-img-top\" alt=\"...\">\n      <div class=\"card-body\">\n        <h5 class=\"card-title\" json-name=\"\"><a json-url=\"\" href=\"/{channel}/{url}.html\">Card title</a></h5>\n        <p class=\"card-text\" json-description=\"\">This card has supporting text below as a natural lead-in to additional content.</p>\n        <p class=\"card-text\"><small class=\"text-muted\">Last updated 3 mins ago</small></p>\n      </div>\n    </div>\n\n    <div class=\"card\">\n      <img json-image=\"\" src=\"...\" class=\"card-img-top\" alt=\"...\">\n      <div class=\"card-body\">\n        <h5 class=\"card-title\" json-name=\"\"><a json-url=\"\" href=\"/{channel}/{url}.html\">Card title</a></h5>\n        <p class=\"card-text\" json-description=\"\">This card has supporting text below as a natural lead-in to additional content.</p>\n        <p class=\"card-text\"><small class=\"text-muted\">Last updated 3 mins ago</small></p>\n      </div>\n    </div>\n  </div>\n\n</div>\n</section>    \n  \n  \n  \n\n  \n  \n\n  <section class=\"team-2 bg-secondary\">\n      <div class=\"container\">\n        <div class=\"row text-center justify-content-center\">\n          <div class=\"col-8\">\n            <h1>Meet Our Team</h1>\n          </div>\n        </div>\n    \n        <div class=\"row-50\"></div>\n    \n        <div class=\"row text-center justify-content-center\">\n          <div class=\"col-sm-3 m-sm-auto\">\n            <img alt=\"image\" class=\"img-fluid rounded-circle\" src=\"./imgs/people/4.jpg\">\n    \n            <h2>Sara Doe</h2>\n            <p>Founder</p>\n          </div>\n    \n          <div class=\"col-sm-3 m-sm-auto\">\n            <img alt=\"image\" class=\"img-fluid rounded-circle\" src=\"./imgs/people/5.jpg\">\n    \n            <h2>Sara Doe</h2>\n            <p>Founder</p>\n          </div>\n    \n          <div class=\"col-sm-3 m-sm-auto\">\n            <img alt=\"image\" class=\"img-fluid rounded-circle\" src=\"./imgs/people/7.jpg\">\n    \n            <h2>Sara Doe</h2>\n    \n            <p>Founder</p>\n          </div>\n        </div>\n      </div>\n    </section>', 'home', 'english', 1),
(2, 'Home', '', '', '', '<section class=\"team-2 bg-light\">\n      <div class=\"container\">\n        <div class=\"row align-items-center\">\n          <div class=\"col-4\">\n            <h1>Shopping Card</h1>\n            <h3>Sales Off 50%</h3>\n            <a class=\"btn btn-primary btn-lg\" href=\"#\">Shop Now</a>\n          </div>\n          <div class=\"col-8 justify-content-end\">\n            <img src=\"http://www.vvveb.com/electro-html/img/ipad.png\" class=\"w-100\">\n          </div>\n        </div>\n    \n     </div>\n    </section>    \n  \n  \n  \n\n  \n  \n\n      \n  \n  \n  \n\n  \n  \n\n      \n  \n  \n  \n\n  \n  \n\n  <section class=\"team-2\" style=\"padding-top: 40px; padding-bottom: 40px;\">\n<div class=\"container\">\n<div class=\"row d-flex\">\n<div class=\"col-lg-4 col-sm-12 flex-box\">\n<div class=\"bg-light\">&nbsp;</div>\n</div>\n<div class=\"col-lg-8 col-sm-12\">\n<ul id=\"myTab\" class=\"nav nav-tabs tab-primary\" role=\"tablist\">\n<li class=\"nav-item\"><a id=\"home-tab\" class=\"nav-link active\" role=\"tab\" href=\"#home\" data-toggle=\"tab\" aria-controls=\"home\" aria-selected=\"true\">Chú ý nhất</a></li>\n<li class=\"nav-item\"><a id=\"profile-tab\" class=\"nav-link\" role=\"tab\" href=\"#profile\" data-toggle=\"tab\" aria-controls=\"profile\" aria-selected=\"false\">Bán chạy nhất</a></li>\n<li class=\"nav-item\"><a id=\"contact-tab\" class=\"nav-link\" role=\"tab\" href=\"#contact\" data-toggle=\"tab\" aria-controls=\"contact\" aria-selected=\"false\">Đang khuyến mại</a></li><li class=\"nav-item\"><a id=\"contact-tab\" class=\"nav-link\" role=\"tab\" href=\"#contact\" data-toggle=\"tab\" aria-controls=\"contact\" aria-selected=\"false\">Hàng mới nhập</a></li>\n</ul>\n<div id=\"myTabContent\" class=\"tab-content\">\n<div id=\"home\" class=\"tab-pane fade show active\" role=\"tabpanel\" aria-labelledby=\"home-tab\">\n<ul class=\"row\">\n<li class=\"col-lg-3 col-sm-12\">Item 1</li>\n<li class=\"col-lg-3  col-sm-12\">Item 2</li>\n<li class=\"col-lg-3  col-sm-12\">Item 3</li>\n<li class=\"col-lg-3  col-sm-12\">Item 4</li>\n</ul>\n</div>\n</div>\n</div>\n</div>\n</div>\n</section>', 'home', 'english', 2);

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
(1, 'Text noi dung', '', 'text-noi-dung', '<p>Nhập nội dung b&agrave;i viết</p>\r\n<p>Hai con bo</p>', '', '', '2019-08-29 02:58:18', '2019-08-29 03:09:49', 'english', 'blogs', 0, 0, 1);

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
(1, 'b48af28979910507a72300805b16b39786c09205', '', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'develop.com', 'english');

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

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `config_id` int(10) NOT NULL,
  `config_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `config_value` text COLLATE utf8_unicode_ci NOT NULL,
  `language` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `store` int(10) NOT NULL,
  `created_date` datetime NOT NULL,
  `autoload` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`config_id`, `config_name`, `config_value`, `language`, `store`, `created_date`, `autoload`) VALUES
(1, 'module', '{\"products\":true}', 'english', 2, '0000-00-00 00:00:00', 0),
(2, 'template', 'shopping', 'english', 2, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

CREATE TABLE `stores` (
  `store_id` int(10) NOT NULL,
  `store_domain` varchar(255) NOT NULL,
  `is_root` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stores`
--

INSERT INTO `stores` (`store_id`, `store_domain`, `is_root`) VALUES
(1, 'develop.com', 1),
(2, 'shopping.com', 0);

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
  `language` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `store` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
-- Indexes for table `design_blocks`
--
ALTER TABLE `design_blocks`
  ADD PRIMARY KEY (`block_id`);

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
-- Indexes for table `stores`
--
ALTER TABLE `stores`
  ADD PRIMARY KEY (`store_id`);

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
-- AUTO_INCREMENT for table `catalog`
--
ALTER TABLE `catalog`
  MODIFY `catalog_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `design_blocks`
--
ALTER TABLE `design_blocks`
  MODIFY `block_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `email_list`
--
ALTER TABLE `email_list`
  MODIFY `email_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `gallery_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gallery_image`
--
ALTER TABLE `gallery_image`
  MODIFY `image_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `menu_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `page_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pages_layout`
--
ALTER TABLE `pages_layout`
  MODIFY `layout_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `posts_incatalog`
--
ALTER TABLE `posts_incatalog`
  MODIFY `incat_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `report_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `reports_robots`
--
ALTER TABLE `reports_robots`
  MODIFY `bot_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reports_views`
--
ALTER TABLE `reports_views`
  MODIFY `view_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `config_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `stores`
--
ALTER TABLE `stores`
  MODIFY `store_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `widgets`
--
ALTER TABLE `widgets`
  MODIFY `winget_id` int(10) NOT NULL AUTO_INCREMENT;
