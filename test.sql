-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主机： 127.0.0.1
-- 生成日期： 2024-08-10 13:18:07
-- 服务器版本： 10.4.32-MariaDB
-- PHP 版本： 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `test`
--

-- --------------------------------------------------------

--
-- 表的结构 `admin`
--

CREATE TABLE `admin` (
  `account` varchar(25) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 转存表中的数据 `admin`
--

INSERT INTO `admin` (`account`, `password`) VALUES
('22187933', '3218902347');

-- --------------------------------------------------------

--
-- 表的结构 `chat`
--

CREATE TABLE `chat` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `to_userid` int(11) NOT NULL,
  `is_mine` tinyint(4) NOT NULL,
  `content` text NOT NULL,
  `systime` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- 转存表中的数据 `chat`
--

INSERT INTO `chat` (`id`, `userid`, `to_userid`, `is_mine`, `content`, `systime`) VALUES
(1, 1, 2, 0, 'aaaaa', 1483681826),
(2, 1, 2, 0, 'xxxx', 1483681839),
(3, 2, 1, 0, 'hi i am steve', 1483682319),
(4, 1, 2, 0, 'hello i am bill', 1483689152),
(5, 1, 2, 0, 'hello i am bill', 1483689154),
(6, 2, 1, 0, 'hi this is Steve!', 1483690969),
(7, 1, 3, 0, 'welcome Steve!', 1483691115),
(8, 1, 3, 0, 'hello', 1483692970),
(9, 2, 3, 0, 'welcome Bill!', 1483693043),
(36, 2, 1, 0, '真是的？', 1723288109),
(35, 1, 2, 0, '真是这样吗', 1723288087),
(34, 2, 1, 0, '如此而已', 1723288056),
(33, 2, 1, 0, '蜜蜂', 1723288037),
(32, 1, 2, 0, '落后的钢铁侠', 1723287952),
(31, 1, 2, 0, '呵呵呵呵呵', 1723285716),
(30, 1, 2, 0, '你你你你', 1723285705),
(27, 1, 2, 0, 'nasdffa', 1723260568),
(28, 1, 2, 0, 'sdfasdfsf', 1723260659),
(26, 1, 2, 0, '你好啊', 1723112789),
(29, 1, 2, 0, '你真的收到我的照片了吗', 1723260711);

-- --------------------------------------------------------

--
-- 表的结构 `favorites`
--

CREATE TABLE `favorites` (
  `username` varchar(15) NOT NULL,
  `pub_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 转存表中的数据 `favorites`
--

INSERT INTO `favorites` (`username`, `pub_id`) VALUES
('evil', 10),
('ff', 9);

-- --------------------------------------------------------

--
-- 表的结构 `notifications`
--

CREATE TABLE `notifications` (
  `id` int(8) NOT NULL,
  `username` varchar(15) NOT NULL,
  `message` varchar(255) NOT NULL,
  `pub_id` int(10) UNSIGNED NOT NULL,
  `isread` tinyint(1) NOT NULL DEFAULT 0,
  `time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 转存表中的数据 `notifications`
--

INSERT INTO `notifications` (`id`, `username`, `message`, `pub_id`, `isread`, `time`) VALUES
(11, 'jsdkfse', '您的帖子“紧急！丢失课程笔记本，请求帮助！”收到了新的回复，点击查看', 7, 0, '2024-08-05 07:11:01'),
(12, 'evil', '您的帖子“丢失耳机，愿意支付悬赏！”收到了新的回复，点击查看', 5, 0, '2024-08-05 07:11:27'),
(13, 'evil', '您的帖子“丢失耳机，愿意支付悬赏！”收到了新的回复，点击查看', 5, 0, '2024-08-05 07:37:58'),
(14, 'evil', '您的帖子“丢失耳机，愿意支付悬赏！”收到了新的回复，点击查看', 5, 0, '2024-08-05 07:47:27');

-- --------------------------------------------------------

--
-- 表的结构 `publish`
--

CREATE TABLE `publish` (
  `pub_id` int(10) UNSIGNED NOT NULL COMMENT '主键ID',
  `pub_title` varchar(50) NOT NULL COMMENT '发帖标题',
  `pub_content` text NOT NULL COMMENT '发帖内容',
  `pub_owner` varchar(20) NOT NULL COMMENT '发帖者',
  `pub_time` int(10) UNSIGNED NOT NULL COMMENT '发帖时间',
  `pub_hits` int(10) UNSIGNED NOT NULL COMMENT '浏览次数',
  `section` varchar(20) NOT NULL DEFAULT '类别',
  `is_top` int(1) NOT NULL DEFAULT 0,
  `pub_image` varchar(255) DEFAULT NULL COMMENT '图像',
  `status` enum('生效中','已完结') NOT NULL DEFAULT '生效中' COMMENT '状态',
  `changed` int(1) NOT NULL DEFAULT 0 COMMENT '被修改'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 转存表中的数据 `publish`
--

INSERT INTO `publish` (`pub_id`, `pub_title`, `pub_content`, `pub_owner`, `pub_time`, `pub_hits`, `section`, `is_top`, `pub_image`, `status`, `changed`) VALUES
(3, '急寻丢失钱包一只，有重谢！', '大家好！我在昨天下午在校园食堂丢失了一个蓝色钱包，里面有我的身份证、银行卡和一些重要的证件。如果有人捡到，请联系我，我会给予重谢！', 'ff', 1692517247, 52, '失物招领', 0, '../upload/staff/10842508427_2746655.jpg', '生效中', 1),
(4, '拾到校园卡一张，失主请速与我联系！', '大家好！我在校园操场捡到一张校园卡，卡上有失主的照片和姓名。如果你是失主或者认识失主，请尽快与我联系，我会将卡归还给你。', 'ff', 1692536928, 21, '寻物启事', 0, '', '已完结', 1),
(5, '丢失耳机，愿意支付悬赏！', '大家好！我在昨天下午在校园图书馆丢失了一副白色无线耳机，耳机盒上有我的名字。我愿意支付悬赏给找到耳机的好心人，请尽快与我联系。', 'evil', 1692537039, 14, '失物招领', 0, NULL, '生效中', 0),
(6, '拾到钥匙一串，失主请凭描述取回！', '大家好！我在校园操场捡到一串钥匙，上面有几把不同样式的钥匙。如果你是失主，请向我描述一下上面的钥匙样式，以便确认身份并取回钥匙。', 'evil', 1692537069, 7, '寻物启事', 0, NULL, '已完结', 0),
(7, '紧急！丢失课程笔记本，请求帮助！', '大家好！我在昨天可能是在教学楼丢失了一本红色课程笔记本，里面有我所有学期的笔记。如果有人找到，请与我联系，这些笔记对我的学习非常重要。', 'jsdkfse', 1692537163, 15, '寻物启事', 0, NULL, '生效中', 0),
(8, '拾到钱包一只，请失主尽快认领！', '大家好！我在校园操场捡到一只黑色钱包，里面有一些现金和银行卡。失主请尽快联系我，提供一些证明以确认身份，我将尽快归还。', 'jsdkfse', 1692537187, 26, '失物招领', 0, NULL, '生效中', 0),
(9, '校园安全提示：如何防止丢失物品？', '大家好！如果你不慎丢失了物品，通过失物招领系统发布寻物启事是一种有效的方式。首先，请确保提供准确的失物信息，包括物品的类型、颜色、丢失地点等，这有助于他人更容易识别。在帖子标题中简要描述丢失物品，使人一目了然。随后，在帖子内容中详细叙述物品丢失的背景和情况，并提供可用的联系方式。为了增加识别难度，不妨上传失物的照片或者突出的特征照片。发布帖子后，请定期回来查看回复，以便能够及时与可能找到物品的人取得联系。通过这个流程，希望你能够尽早找回丢失的物品！', 'jsdkfse', 1692537325, 22, '其它', 0, NULL, '已完结', 1),
(10, '如何发布寻物启事？', '确保提供准确的失物信息，如物品类型、颜色、丢失地点等。\r\n在帖子标题中简要描述丢失物品，让人一目了然。\r\n在帖子内容中详细说明丢失的情况，提供联系方式。\r\n上传失物照片或标志性特征照片，有助于别人识别。\r\n帖子发布后，定期查看回复和私信，以便与好心人取得联系。\r\n希望这些解释能够帮助大家更好地使用失物招领系统，快速找回丢失物品。', 'jsdkfse', 1692537402, 11, '其它', 0, NULL, '已完结', 0);

-- --------------------------------------------------------

--
-- 表的结构 `reply`
--

CREATE TABLE `reply` (
  `rep_id` int(10) UNSIGNED NOT NULL COMMENT '主键ID',
  `rep_pub_id` int(10) UNSIGNED NOT NULL COMMENT '外键,指向回帖人的ID',
  `rep_user` varchar(20) NOT NULL COMMENT '回复者',
  `rep_content` text NOT NULL COMMENT '回复内容',
  `rep_time` int(10) UNSIGNED NOT NULL COMMENT '回复的时间戳',
  `changed` int(1) NOT NULL DEFAULT 0 COMMENT '被修改'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 转存表中的数据 `reply`
--

INSERT INTO `reply` (`rep_id`, `rep_pub_id`, `rep_user`, `rep_content`, `rep_time`, `changed`) VALUES
(1, 1, 'ff', 'dfd', 1691905534, 0),
(5, 10, 'ff', '非常感谢分享这个流程！我之前不太清楚如何使用失物招领系统，现在有了详细的步骤，感觉更有信心能找回丢失的物品了。', 1692573208, 0),
(7, 8, 'evil', 'asdf', 1722779577, 0),
(9, 8, 'evil', 'kjapsdif', 1722780271, 0),
(11, 3, 'evil', 'aoijaopfhj', 1722780666, 0),
(15, 3, 'evil', '阿斯顿发', 1722781177, 0),
(16, 3, 'evil', '阿斯顿阿斯弗', 1722781317, 0),
(17, 3, 'evil', '哈哈哈哈', 1722781354, 0),
(19, 7, 'evil', '阿斯顿发', 1722841861, 0),
(20, 5, 'evil', '汉化', 1722841887, 0),
(22, 5, 'evil', '呃呃呃', 1722844047, 0);

-- --------------------------------------------------------

--
-- 表的结构 `touserid`
--

CREATE TABLE `touserid` (
  `id` int(11) NOT NULL,
  `to_userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 转存表中的数据 `touserid`
--

INSERT INTO `touserid` (`id`, `to_userid`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `to_userid_tmp` int(11) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(25) NOT NULL,
  `nickname` varchar(25) NOT NULL,
  `avatar` varchar(255) NOT NULL DEFAULT '../static/assets/images/touxiang1.png',
  `banned` int(1) NOT NULL,
  `contact` varchar(30) DEFAULT NULL,
  `signature` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`id`, `to_userid_tmp`, `username`, `password`, `nickname`, `avatar`, `banned`, `contact`, `signature`) VALUES
(1, 2, 'evil', 'kk', '豁达的蜜蜂', '../upload/avatar/bf019523f34c7dadf472008c46ad9c56.jpg', 0, 'asd', '得到'),
(2, 1, 'ff', 'aa', '落后的钢铁侠', '../upload/avatar/c6b8be3131bc3e983cc5b76befdca822.jpg', 0, '18967789173', '1\r\n'),
(3, 0, 'jsdkfse', '333', '优雅的唇彩', '../upload/avatar/b86d085944198e811302e014bddf0ec8.jpg', 0, 'a', '22');

--
-- 转储表的索引
--

--
-- 表的索引 `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`account`);

--
-- 表的索引 `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`username`);

--
-- 表的索引 `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `publish`
--
ALTER TABLE `publish`
  ADD PRIMARY KEY (`pub_id`);

--
-- 表的索引 `reply`
--
ALTER TABLE `reply`
  ADD PRIMARY KEY (`rep_id`);

--
-- 表的索引 `touserid`
--
ALTER TABLE `touserid`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- 使用表AUTO_INCREMENT `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- 使用表AUTO_INCREMENT `publish`
--
ALTER TABLE `publish`
  MODIFY `pub_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID', AUTO_INCREMENT=16;

--
-- 使用表AUTO_INCREMENT `reply`
--
ALTER TABLE `reply`
  MODIFY `rep_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID', AUTO_INCREMENT=23;

--
-- 使用表AUTO_INCREMENT `touserid`
--
ALTER TABLE `touserid`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用表AUTO_INCREMENT `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
