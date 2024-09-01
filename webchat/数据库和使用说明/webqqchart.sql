-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- 主机： localhost
-- 生成日期： 2020-07-01 12:34:02
-- 服务器版本： 5.7.26
-- PHP 版本： 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `webqqchart`
--

-- --------------------------------------------------------

--
-- 表的结构 `chat`
--

CREATE TABLE `chat` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `is_mine` tinyint(4) NOT NULL,
  `content` text NOT NULL,
  `systime` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `chat`
--

INSERT INTO `chat` (`id`, `userid`, `is_mine`, `content`, `systime`) VALUES
(1, 1, 0, 'aaaaa', 1483681826),
(2, 1, 0, 'xxxx', 1483681839),
(3, 2, 0, 'hi i am steve', 1483682319),
(4, 1, 0, 'hello i am bill', 1483689152),
(5, 1, 0, 'hello i am bill', 1483689154),
(6, 2, 0, 'hi this is Steve!', 1483690969),
(7, 1, 0, 'welcome Steve!', 1483691115),
(8, 1, 0, 'hello', 1483692970),
(9, 2, 0, 'welcome Bill!', 1483693043),
(10, 1, 0, 'thank you!', 1483693061),
(11, 2, 0, 'Today is 1/8', 1483879716),
(12, 2, 0, 'Today is 1/8', 1483879720),
(13, 2, 0, 'Today is 1/8', 1483879732),
(14, 2, 0, 'Today is 1/8', 1483879733),
(15, 2, 0, 'Today is 1/8', 1483879735),
(16, 2, 0, 'Today is 1/8', 1483879736),
(17, 2, 0, 'Today is 1/8', 1483879738),
(18, 2, 0, 'Today is 1/8', 1483879749),
(19, 2, 0, 'Today is 1/8', 1483879751),
(20, 2, 0, 'Today is 1/8', 1483879766),
(21, 2, 0, 'Today is 1/8', 1483879797),
(22, 1, 0, 'today is 1/9', 1483880200),
(23, 1, 0, 'today is 1/9', 1483880285),
(24, 1, 0, 'hi', 1483881736),
(25, 1, 0, '大家可以关注微信公众号，H5前端开发社区', 1483881752);

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `profile` varchar(100) NOT NULL,
  `nickname` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `profile`, `nickname`) VALUES
(1, 'bill001', '96e79218965eb72c92a549dd5a330112', 'https://s1.ax1x.com/2020/06/30/NI2WW9.jpg', 'bill'),
(2, 'steve001', '96e79218965eb72c92a549dd5a330112', 'https://s1.ax1x.com/2020/06/30/NI2WW9.jpg', 'steve'),
(3, 'admin001', '4eef1e1ea34879a2ae60c60815927ed9', 'upload/1593520712705490406.jpg', '张三'),
(4, 'a12345', 'af8f9dffa5d420fbc249141645b962ee', 'upload/profile.png', 'a12345');

--
-- 转储表的索引
--

--
-- 表的索引 `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- 使用表AUTO_INCREMENT `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
