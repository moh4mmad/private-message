-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 15, 2019 at 06:40 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `secretmsg`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- --------------------------------------------------------

--
-- Table structure for table `admin_password_resets`
--

CREATE TABLE `admin_password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- --------------------------------------------------------

--
-- Table structure for table `allowed_ip`
--

CREATE TABLE `allowed_ip` (
  `id` int(11) NOT NULL,
  `messageid` int(11) NOT NULL,
  `ip` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attachments`
--

CREATE TABLE `attachments` (
  `id` int(11) NOT NULL,
  `secret` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `messageid` int(11) NOT NULL,
  `filename` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- --------------------------------------------------------

--
-- Table structure for table `blocked_ip`
--

CREATE TABLE `blocked_ip` (
  `id` int(11) NOT NULL,
  `ip` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reason` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mail`
--

CREATE TABLE `mail` (
  `id` int(1) NOT NULL DEFAULT '1',
  `driver` varchar(160) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `host` varchar(260) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `port` varchar(260) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `from_address` varchar(160) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `from_name` varchar(260) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `encryption` varchar(260) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(260) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(160) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mail`
--

INSERT INTO `mail` (`id`, `driver`, `host`, `port`, `from_address`, `from_name`, `encryption`, `username`, `password`, `created_at`, `updated_at`) VALUES
(1, 'smtp', 'smtp.gmail.com', '587', 'test@mail.com', 'app', 'tls', 'test@gmail.com', '1234', NULL, '2019-02-14 07:38:29');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `secret` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `by` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `use_password` int(1) NOT NULL DEFAULT '1',
  `password` varchar(160) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attachment` int(11) NOT NULL DEFAULT '0',
  `viewcount` int(11) NOT NULL DEFAULT '0',
  `maxview` int(11) NOT NULL DEFAULT '0',
  `ip_restriction` int(1) NOT NULL DEFAULT '0',
  `destroy_in` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(1) NOT NULL DEFAULT '1',
  `about` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `faq` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `privacy` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `support` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `about`, `faq`, `privacy`, `support`, `created_at`, `updated_at`) VALUES
(1, '<h1><u style=\"\">About</u></h1>\r\n  <p>The blockquote element is used to present content from another source:<br></p><blockquote><span style=\"font-family: &quot;Courier New&quot;;\"><b>For 50 years, WWF has been protecting the future of nature. The world\'s leading conservation organization, WWF works in 100 countries and is supported by 1.2 million members in the United States and close to 5 million globally.</b></span></blockquote><p></p>', '<h1><u>Frequency asked questions</u></h1>\r\n  <p>The blockquote element is used to present content from another source:</p>\r\n  <blockquote class=\"blockquote\">\r\n    <p>For 50 years, WWF has been protecting the future of nature. The world\'s leading conservation organization, WWF works in 100 countries and is supported by 1.2 million members in the United States and close to 5 million globally.</p>\r\n\r\n  \r\n  </blockquote>', '<h1><u>Privacy</u></h1>\r\n  <p>The blockquote element is used to present content from another source:</p>\r\n  <blockquote class=\"blockquote\">\r\n    <p>For 50 years, WWF has been protecting the future of nature. The world\'s leading conservation organization, WWF works in 100 countries and is supported by 1.2 million members in the United States and close to 5 million globally.</p>\r\n\r\n  \r\n  </blockquote>', '<h1><u>Support</u></h1>\r\n  <p>The blockquote element is used to present content from another source:</p>\r\n  <blockquote class=\"blockquote\">\r\n    <p>For 50 years, WWF has been protecting the future of nature. The world\'s leading conservation organization, WWF works in 100 countries and is supported by 1.2 million members in the United States and close to 5 million globally.</p>\r\n\r\n  \r\n  </blockquote>', NULL, '2019-02-14 08:38:45');

-- --------------------------------------------------------

--
-- Table structure for table `social`
--

CREATE TABLE `social` (
  `id` int(11) NOT NULL,
  `icon` varchar(260) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(260) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `social`
--

INSERT INTO `social` (`id`, `icon`, `url`, `created_at`, `updated_at`) VALUES
(1, 'fab fa-facebook', 'https://fb.com', NULL, '2019-02-09 12:36:07'),
(2, 'fab fa-twitter', 'fab fa-twitter', NULL, '2019-02-09 08:07:40'),
(3, 'fab fa-instagram', 'fab fa-instagram', NULL, '2019-02-09 08:06:26'),
(4, 'fab fa-google', 'http://goo.gl', '2019-02-09 12:41:02', '2019-02-09 12:46:45');

-- --------------------------------------------------------

--
-- Table structure for table `system`
--

CREATE TABLE `system` (
  `id` int(1) NOT NULL DEFAULT '1',
  `title` varchar(160) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(260) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keywords` varchar(260) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `header_title` varchar(160) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `header_description` varchar(260) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `header_icon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'fas fa-mask',
  `header_bg` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#333333;',
  `footer` varchar(260) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `allowed_file` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `max_size` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secure_folder` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `GOOGLE_RECAPTCHA_KEY` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bg_color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#ECECEC;',
  `bg_image` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `GOOGLE_RECAPTCHA_SECRET` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `system`
--

INSERT INTO `system` (`id`, `title`, `description`, `keywords`, `header_title`, `header_description`, `header_icon`, `header_bg`, `footer`, `allowed_file`, `max_size`, `secure_folder`, `GOOGLE_RECAPTCHA_KEY`, `bg_color`, `bg_image`, `GOOGLE_RECAPTCHA_SECRET`, `created_at`, `updated_at`) VALUES
(1, 'Secret Message!', 'Keep sensitive info out of your email and chat logs', 'HTML,CSS,XML,JavaScript', 'Secret Message!', 'Keep sensitive info out of your email and chat logs', 'fas fa-mask', '#000000', '© 2019 Secret Message . All Rights Reserved', 'jpeg,png,jpg,gif,html,zip,php,txt', '512', 'yuygyukygkjyjyykuyg', '6LdqL1', '#eeeeee', 'data:image/tmp;base64,iVBORw0KGgoAAAANSUhEUgAAAC4AAAAXCAAAAABRpyKOAAAB5klEQVR4AU3SSZrEJgwFYO5/UjSiyVlHgq582QCt+i3jp16aKXTSldjSaLPnIQSNUMCTZQBexXDrtFojYnylm6M99Ko4GqeLp5Ka4mgEXa3FRKv3k+1x+nhrkt6ZY172NGosBcoK4qvVpgdHlQJWlcCW7PNP1zqEUakArWXqRiC9IlUZHUaJtKezcsVBsQjVCCHG59mnrKTzgvZPx4kVqXPMSCFNe36T54HNcXnG0wqyJOZRuaHEVwJkaS83tpuv/6eRFl4PEtF9vILbV9qo33eMnmDVz2IYTzie2MLbZxXBqdH89IwL44vlNN5nMi5IN58Tjmw/Da0jg9GyVhdR6ksEG0mzkvwvIeK5iY0XXzbeIgZefyLGPV0HKGdQeCp486L5gRVbW0u999GfTt1Sn6FQl532ArIwuppQq4LwRD6dkc6oxhr36k6LYKS8sMm/T7b+9OGTLggUE5Vk+XLe7DGAzJVt9p+GlxTdTMkzaqVP/ygFrnLCdj9NrNzeLV2oC862rFfgE/N41fn7iNFImX5nfG9QjkCLLPzdn0kjzxzwRGs89QXS7UetiaQ5et2/0+58W2/Lr7XO+eZ3NUIvC/ep6+35coIJ4v0Pjp5pZmuuf3KRRnj+9cc7dlSXp3H09vj8RaD/Anbs2k1HGtFlAAAAAElFTkSuQmCC', '6LdqL1kUAA', NULL, '2019-03-08 19:44:27');

-- --------------------------------------------------------

--
-- Table structure for table `template`
--

CREATE TABLE `template` (
  `id` int(1) NOT NULL DEFAULT '1',
  `subject` varchar(260) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `template`
--

INSERT INTO `template` (`id`, `subject`, `body`, `created_at`, `updated_at`) VALUES
(1, 'New secret message!', '<meta name=\"viewport\" content=\"width=device-width\">\n    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">\n    \n  \n    <table role=\"presentation\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"body\" style=\"border-collapse: separate;mso-table-lspace: 0;mso-table-rspace: 0;width: 100%;background-color: #f6f6f6\">\n      <tbody><tr>\n        <td style=\"font-family: sans-serif;font-size: 14px;vertical-align: top\">&nbsp;</td>\n        <td class=\"container\" style=\"font-family: sans-serif;font-size: 14px;vertical-align: top;display: block;margin: 0 auto !important;max-width: 580px;padding: 10px;width: 580px\">\n          <div class=\"content\" style=\"box-sizing: border-box;display: block;margin: 0 auto;max-width: 580px;padding: 10px\">\n\n            <!-- START CENTERED WHITE CONTAINER -->\n            \n            <table role=\"presentation\" class=\"main\" style=\"border-collapse: separate;mso-table-lspace: 0;mso-table-rspace: 0;width: 100%;background: #fff;border-radius: 3px\">\n\n              <!-- START MAIN CONTENT AREA -->\n              <tbody><tr>\n                <td class=\"wrapper\" style=\"font-family: sans-serif;font-size: 14px;vertical-align: top;box-sizing: border-box;padding: 20px\">\n                  <table role=\"presentation\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: separate;mso-table-lspace: 0;mso-table-rspace: 0;width: 100%\">\n                    <tbody><tr>\n                      <td style=\"font-family: sans-serif;font-size: 14px;vertical-align: top\">\n                        <p style=\"font-family: sans-serif;font-size: 14px;font-weight: normal;margin: 0;margin-bottom: 15px\">Hi there,</p>\n                        <p style=\"font-family: sans-serif;font-size: 14px;font-weight: normal;margin: 0;margin-bottom: 15px\">You have recived a new secret message from {{ip}}&nbsp;</p><p style=\"font-family: sans-serif;font-size: 14px;font-weight: normal;margin: 0;margin-bottom: 15px\">The message will be destruct in {{destruct_time}}</p>\n						<p style=\"font-family: sans-serif;font-size: 14px;font-weight: normal;margin: 0;margin-bottom: 15px\">To access into the message use this link <a href=\"{{url}}\" target=\"_blank\" style=\"color: #3498db;text-decoration: underline\">{{url}}</a></p>\n                        <table role=\"presentation\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"btn btn-primary\" style=\"border-collapse: separate;mso-table-lspace: 0;mso-table-rspace: 0;width: 100%;box-sizing: border-box\">\n                          <tbody>\n                            <tr>\n                              <td align=\"left\" style=\"font-family: sans-serif;font-size: 14px;vertical-align: top;padding-bottom: 15px\">\n                                <table role=\"presentation\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: separate;mso-table-lspace: 0;mso-table-rspace: 0;width: auto\">\n                                  <tbody>\n                                    <tr>\n                                      <td style=\"font-family: sans-serif;font-size: 14px;vertical-align: top;background-color: #3498db;border-radius: 5px;text-align: center\"> <a href=\"{{url}}\" target=\"_blank\" style=\"color: #fff;text-decoration: none;background-color: #3498db;border: solid 1px #3498db;border-radius: 5px;box-sizing: border-box;cursor: pointer;display: inline-block;font-size: 14px;font-weight: bold;margin: 0;padding: 12px 25px;text-transform: capitalize;border-color: #3498db\">Or click here</a> </td>\n                                    </tr>\n                                  </tbody>\n                                </table>\n                              </td>\n                            </tr>\n                          </tbody>\n                        </table>\n						\n                      </td>\n                    </tr>\n                  </tbody></table>\n                </td>\n              </tr>\n\n            <!-- END MAIN CONTENT AREA -->\n            </tbody></table>\n\n            <!-- START FOOTER -->\n            <div class=\"footer\" style=\"clear: both;margin-top: 10px;text-align: center;width: 100%\">\n              <table role=\"presentation\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: separate;mso-table-lspace: 0;mso-table-rspace: 0;width: 100%\">\n                <tbody><tr>\n                  <td class=\"content-block\" style=\"font-family: sans-serif;font-size: 12px;vertical-align: top;padding-bottom: 10px;padding-top: 10px;color: #999;text-align: center\">\n                    <br> Report <a href=\"\" style=\"color: #999;font-size: 12px;text-align: center;text-decoration: underline\">spam</a>.\n                  </td>\n                </tr>\n              </tbody></table>\n            </div>\n            <!-- END FOOTER -->\n\n          <!-- END CENTERED WHITE CONTAINER -->\n          </div>\n        </td>\n        <td style=\"font-family: sans-serif;font-size: 14px;vertical-align: top\">&nbsp;</td>\n      </tr>\n    </tbody></table>', NULL, '2019-02-20 11:33:43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_password_resets`
--
ALTER TABLE `admin_password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `allowed_ip`
--
ALTER TABLE `allowed_ip`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attachments`
--
ALTER TABLE `attachments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `secret` (`secret`);

--
-- Indexes for table `blocked_ip`
--
ALTER TABLE `blocked_ip`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `secret` (`secret`);

--
-- Indexes for table `social`
--
ALTER TABLE `social`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `allowed_ip`
--
ALTER TABLE `allowed_ip`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `attachments`
--
ALTER TABLE `attachments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `blocked_ip`
--
ALTER TABLE `blocked_ip`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `social`
--
ALTER TABLE `social`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
