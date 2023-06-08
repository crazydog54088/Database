- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- 主機： localhost:3306
-- 產生時間： 2023 年 06 月 10 日 23:50
-- 伺服器版本： 5.7.38-cll-lve
-- PHP 版本： 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";



--
-- 資料庫： `toolwebsiteszoo_send`
--

-- --------------------------------------------------------

--
-- 資料表結構 `pd_log`
--

CREATE TABLE `pd_log` (
  `id` int(11) NOT NULL,
  `type` text NOT NULL COMMENT '商品類型',
  `manufacturer` text NOT NULL COMMENT '品牌',
  `phone` text NOT NULL COMMENT '收件人電話',
  `stock_id` int(11) NOT NULL COMMENT '庫存',
  `price` int(11) NOT NULL COMMENT '金額'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 資料表結構 `pg_log`
--

CREATE TABLE `pg_log` (
  `pg_id` int(11) NOT NULL,
  `state` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '包裹狀態',
  `cost` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '運費',
  `note` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '備註 ',
  `sander` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '寄件人',
  `sander_id` int(11) NOT NULL COMMENT '寄件人id',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新時間'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 資料表結構 `store`
--

CREATE TABLE `store` (
  `id` int(11) NOT NULL,
  `name` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '店名',
  `address` text NOT NULL COMMENT '地址',
  `in stock` int(11) NOT NULL COMMENT '庫存',
  `note` text NOT NULL COMMENT '註記'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- 資料表結構 `record`
--

CREATE TABLE `record` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL COMMENT '店名',
  `revenue` int(11) NOT NULL COMMENT '營收'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 資料表結構 `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` text CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `email` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `register_time` datetime NOT NULL,
  `last_login` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `pd_log`
--
ALTER TABLE `pd_log`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `pg_log`
--
ALTER TABLE `pg_log`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `store`
--
ALTER TABLE `store`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `record`
--
ALTER TABLE `record`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `pd_log`
--
ALTER TABLE `pd_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `pg_log`
--
ALTER TABLE `pg_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `store`
--
ALTER TABLE `store`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `record`
--
ALTER TABLE `record`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
