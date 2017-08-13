-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- ホスト: 127.0.0.1
-- 生成日時: 2017 年 8 月 13 日 01:25
-- サーバのバージョン: 5.5.54-0ubuntu0.14.04.1
-- PHP のバージョン: 5.5.9-1ubuntu4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- データベース: `c9`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `gs_an_table`
--

CREATE TABLE IF NOT EXISTS `gs_an_table` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `naiyou` text COLLATE utf8_unicode_ci,
  `indate` datetime NOT NULL,
  `img` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- テーブルのデータのダンプ `gs_an_table`
--

INSERT INTO `gs_an_table` (`id`, `name`, `email`, `naiyou`, `indate`, `img`) VALUES
(2, '戸田', 'test2@test.jp', 'TEST2', '2017-06-03 15:35:40', NULL),
(4, 'yoshihiro', 'test4@test.jp', 'TEST4', '2017-06-03 15:38:07', NULL),
(5, 'よしひろ', 'test5@test.jp', 'TEST1', '2017-06-03 15:38:34', NULL),
(7, 'test2', 'test@test.jp', 'test', '2017-06-03 16:49:16', NULL),
(8, 'test', 'test@test.jp', '1', '2017-06-10 14:47:58', NULL),
(9, 'test001', 'test@test.jp', '<p>This is my textarea to be replaced with CKEditor.</p>\r\n\r\n<p><span style="color:#2ecc71"><em><strong>test001</strong></em></span></p>\r\n\r\n<p>&nbsp;</p>\r\n', '2017-06-24 16:32:21', NULL);

-- --------------------------------------------------------

--
-- テーブルの構造 `gs_bm_table`
--

CREATE TABLE IF NOT EXISTS `gs_bm_table` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `bookname` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `bookurl` text COLLATE utf8_unicode_ci NOT NULL,
  `comment` text COLLATE utf8_unicode_ci,
  `date` datetime NOT NULL,
  `img` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `userid` int(64) NOT NULL,
  `manthday` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=27 ;

--
-- テーブルのデータのダンプ `gs_bm_table`
--

INSERT INTO `gs_bm_table` (`id`, `bookname`, `bookurl`, `comment`, `date`, `img`, `userid`, `manthday`) VALUES
(4, '戸田本', 'テスト.jp', 'コメント', '2017-06-03 17:23:09', './upload/0000000.jpg', 0, '2017-07-03'),
(10, '次郎の作品', 'テスト.jp', 'コメント', '2017-06-10 18:17:50', './upload/33395b46.jpg', 0, '2017-07-16'),
(11, '作品１１１１', 'テスト.jp', 'コメント', '2017-06-17 16:50:28', './upload/a267a556e21d4222872c89f788677d6f--amazing-eyes-beautiful-eyes.jpg', 0, '2017-07-04'),
(12, 'art３３３', 'テスト.jp', 'コメント', '2017-06-17 23:59:56', './upload/images (1).jpeg', 0, '2017-07-10'),
(14, 'aaapple', 'テスト.jp', 'コメント', '2017-06-24 18:10:24', './upload/middle_1335251680.jpg', 0, '2017-07-03'),
(15, 'aaa', 'テスト.jp', 'コメント', '2017-07-01 18:14:04', './upload/logo.jpeg', 0, '2017-07-02'),
(16, 'aaa', 'テスト.jp', 'コメント', '2017-07-01 18:17:11', './upload/logo.jpeg', 0, '2017-07-11'),
(17, 'aaavvv', 'テスト.jp', 'コメント', '2017-07-15 18:10:42', './upload/da60e08f-s.jpg', 0, '2017-07-02'),
(18, 'aaa,l,l,l', 'テスト.jp', 'コメント', '2017-07-15 18:11:02', './upload/a267a556e21d4222872c89f788677d6f--amazing-eyes-beautiful-eyes.jpg', 0, '2017-07-18'),
(19, 'aaa', 'テスト.jp', 'コメント', '2017-07-15 18:15:49', './upload/BwJW-tECIAAbqqT.jpg', 1, '2017-06-05'),
(20, 'aaaccc', 'テスト.jp', 'コメントですよ〜', '2017-07-15 18:16:32', './upload/middle_1335251680.jpg', 3, '2017-07-02'),
(21, 'aaabbb', 'テスト.jp', 'コメント', '2017-07-18 01:37:43', './upload/33395b46.jpg', 3, '2017-07-24'),
(23, 'vvv', 'テスト.jp', 'コメント', '2017-07-19 02:54:56', './upload/ダウンロード.png', 3, '0000-00-00'),
(24, 'aaa', 'テスト.jp', 'コメント', '2017-07-25 14:23:16', './upload/images (2).jpeg', 4, '0000-00-00'),
(26, '宿題', '宿題.jp', '作品コメント宿題', '2017-07-29 09:30:16', './upload/shiroutoeshi05.jpg', 3, '0000-00-00');

-- --------------------------------------------------------

--
-- テーブルの構造 `gs_cms_table`
--

CREATE TABLE IF NOT EXISTS `gs_cms_table` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `title` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `article` text COLLATE utf8_unicode_ci NOT NULL,
  `indate` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- テーブルのデータのダンプ `gs_cms_table`
--

INSERT INTO `gs_cms_table` (`id`, `title`, `article`, `indate`) VALUES
(1, 'test1', 'test123', '2017-06-24 00:00:00'),
(2, 'test2', 'test2test2test2test2', '2017-06-25 00:00:00'),
(3, 'test3', 'test3test3test3test3test3', '2017-06-26 00:00:00'),
(4, 'test4', 'test4test4test4test4test4', '2017-06-27 06:00:00'),
(5, 'test5', 'test５test4test4test4test4', '2017-06-27 12:00:00'),
(6, 'test6', 'テスト６', '2017-06-28 00:00:00');

-- --------------------------------------------------------

--
-- テーブルの構造 `gs_user_table`
--

CREATE TABLE IF NOT EXISTS `gs_user_table` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `lid` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `lpw` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `kanri_flg` int(1) NOT NULL,
  `life_flg` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- テーブルのデータのダンプ `gs_user_table`
--

INSERT INTO `gs_user_table` (`id`, `name`, `lid`, `lpw`, `date`, `kanri_flg`, `life_flg`) VALUES
(1, 'test111', 'test', 'test', '2017-06-10 19:08:03', 0, 0),
(3, 'toda', 'toda', 'toda', '2017-06-17 16:45:00', 0, 0),
(4, '管理人', 'kanri', 'kanri', '0000-00-00 00:00:00', 1, 0),
(5, '一般', 'test2', 'test2', '2017-07-01 18:15:48', 0, 0);

-- --------------------------------------------------------

--
-- テーブルの構造 `kashimauser_table`
--

CREATE TABLE IF NOT EXISTS `kashimauser_table` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `studentname` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `campus` text COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `lpw` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `kanri_flg` int(1) NOT NULL,
  `life_flg` int(1) NOT NULL,
  `date` datetime NOT NULL,
  `nickname` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `userimg` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=12 ;

--
-- テーブルのデータのダンプ `kashimauser_table`
--

INSERT INTO `kashimauser_table` (`id`, `studentname`, `campus`, `email`, `lpw`, `kanri_flg`, `life_flg`, `date`, `nickname`, `userimg`) VALUES
(1, '管理人', '本校', 'kanri@kanri.jp', 'kanri', 1, 0, '2017-06-10 19:08:03', '管理人', NULL),
(3, 'テスト', 'テスト校', 'test@test.jp', 'test', 0, 0, '2017-06-17 16:45:00', 'テストだよ', NULL),
(6, '山田　太郎', '原宿校', 'tarou@tarou.jp', 'tarou', 0, 0, '2017-07-30 05:47:41', 'たろー', NULL),
(7, '戸田　佳宏', '池袋校', 'toda@toda.jp', 'toda', 0, 0, '2017-07-30 13:06:09', 'とだろー', './ownerupload/BwJW-tECIAAbqqT.jpg'),
(8, '山田　花子', '東京キャンパス', 'hanako2@test.jp', 'yamada', 0, 0, '2017-08-05 03:16:37', 'hana222', NULL),
(11, 'トダヨシヒロ', '豊島区', 'info@itjoho.com', 'test', 0, 0, '2017-08-05 17:01:42', NULL, NULL);

-- --------------------------------------------------------

--
-- テーブルの構造 `kashimaworkboard`
--

CREATE TABLE IF NOT EXISTS `kashimaworkboard` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `boardcomment` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `commentnickname` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `workid` int(64) NOT NULL,
  `userid` int(12) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- テーブルのデータのダンプ `kashimaworkboard`
--

INSERT INTO `kashimaworkboard` (`id`, `boardcomment`, `commentnickname`, `date`, `workid`, `userid`) VALUES
(1, 'tesuto', 'とだろー', '2017-08-07 15:54:36', 4, 4),
(2, 'コメントテスト２', 'とだろー', '2017-08-07 15:59:30', 4, 7),
(3, 'iikanji', 'とだろー', '2017-08-07 16:24:23', 4, 7),
(4, '掲示板', 'とだろー', '2017-08-07 16:31:15', 4, 7),
(5, '掲示板３３３', 'とだろー', '2017-08-07 16:31:50', 4, 7),
(6, 'いいね機能搭載', 'とだろー', '2017-08-13 00:38:29', 12, 7);

-- --------------------------------------------------------

--
-- テーブルの構造 `kashimawork_table`
--

CREATE TABLE IF NOT EXISTS `kashimawork_table` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `workname` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `comment` text COLLATE utf8_unicode_ci,
  `date` datetime NOT NULL,
  `img` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `userid` int(64) NOT NULL,
  `manthday` date NOT NULL,
  `workowner` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `studentname` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ownercampus` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=34 ;

--
-- テーブルのデータのダンプ `kashimawork_table`
--

INSERT INTO `kashimawork_table` (`id`, `workname`, `comment`, `date`, `img`, `userid`, `manthday`, `workowner`, `studentname`, `ownercampus`) VALUES
(4, '戸田本', 'コメント', '2017-06-03 17:23:09', './upload/0000000.jpg', 6, '2017-07-03', 'たろー', '', ''),
(10, '次郎の作品', 'コメント', '2017-06-10 18:17:50', './upload/33395b46.jpg', 6, '2017-07-16', 'たろー', '', ''),
(11, '作品１１１１', 'コメント', '2017-06-17 16:50:28', './upload/a267a556e21d4222872c89f788677d6f--amazing-eyes-beautiful-eyes.jpg', 6, '2017-07-04', 'たろー', '', ''),
(12, 'art３３３', 'コメント', '2017-06-17 23:59:56', './upload/images (1).jpeg', 6, '2017-07-10', 'たろー', '', ''),
(14, 'aaapple', 'コメント', '2017-06-24 18:10:24', './upload/BwJW-tECIAAbqqT.jpg', 7, '2017-07-03', 'とだろー', '', ''),
(15, 'aaa', 'コメント', '2017-07-01 18:14:04', './upload/logo.jpeg', 6, '2017-07-02', 'たろー', '', ''),
(16, 'aaa', 'コメント', '2017-07-01 18:17:11', './upload/logo.jpeg', 7, '2017-07-11', 'とだろー', '', ''),
(17, 'aaavvv', 'コメント', '2017-07-15 18:10:42', './upload/da60e08f-s.jpg', 6, '2017-07-02', 'たろー', '', ''),
(18, 'aaa,l,l,l', 'コメント', '2017-07-15 18:11:02', './upload/a267a556e21d4222872c89f788677d6f--amazing-eyes-beautiful-eyes.jpg', 6, '2017-07-18', NULL, '', ''),
(19, 'aaa', 'コメント', '2017-07-15 18:15:49', './upload/BwJW-tECIAAbqqT.jpg', 1, '2017-06-05', NULL, '', ''),
(20, 'aaaccc', 'コメントですよ〜', '2017-07-15 18:16:32', './upload/middle_1335251680.jpg', 3, '2017-07-02', NULL, '', ''),
(21, 'aaabbb', 'コメント', '2017-07-18 01:37:43', './upload/33395b46.jpg', 3, '2017-07-24', NULL, '', ''),
(23, 'vvv', 'コメント', '2017-07-19 02:54:56', './upload/ダウンロード.png', 3, '0000-00-00', NULL, '', ''),
(24, 'aaa', 'コメント', '2017-07-25 14:23:16', './upload/images (2).jpeg', 4, '0000-00-00', NULL, '', ''),
(26, '宿題', '作品コメント宿題', '2017-07-29 09:30:16', './upload/shiroutoeshi05.jpg', 3, '0000-00-00', NULL, '', ''),
(27, '戸田の作品', '作品コメント！！！', '2017-07-30 16:51:59', './upload/33395b46.jpg', 7, '0000-00-00', 'とだろー', '', ''),
(28, 'とだろー作品５５', '作品コメントですよ', '2017-07-31 00:04:29', './upload/images (2).jpeg', 7, '0000-00-00', 'とだろー', 'とだろー', ''),
(29, 'とだろー作品VER2', '作品コメント', '2017-07-31 00:07:18', './upload/da60e08f-s.jpg', 7, '0000-00-00', 'とだろー', NULL, ''),
(30, '再挑戦', '作品コメントトライ', '2017-07-31 00:12:31', './upload/0000000.jpg', 7, '0000-00-00', 'とだろー', NULL, ''),
(33, 'todarow作品', '作品コメントya', '2017-08-07 17:27:55', './upload/images (1).jpeg', 7, '2017-08-07', 'とだろー', '戸田　佳宏', '池袋校');

-- --------------------------------------------------------

--
-- テーブルの構造 `likes`
--

CREATE TABLE IF NOT EXISTS `likes` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `article_id` bigint(20) NOT NULL DEFAULT '0',
  `user_id` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ix01_likes` (`user_id`,`article_id`),
  KEY `ix02_likes` (`user_id`),
  KEY `ix03_likes` (`article_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- テーブルの構造 `user_table`
--

CREATE TABLE IF NOT EXISTS `user_table` (
  `id` int(64) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `lid` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `lpw` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `kanri_flg` int(1) NOT NULL,
  `life_flg` int(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- テーブルの構造 `work_table`
--

CREATE TABLE IF NOT EXISTS `work_table` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `arttitle` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `discription` text COLLATE utf8_unicode_ci,
  `date` date NOT NULL,
  `img` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `userid` int(64) NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
