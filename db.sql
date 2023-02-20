-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2023-02-20 07:29:01
-- 伺服器版本： 10.4.27-MariaDB
-- PHP 版本： 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `test`
--

-- --------------------------------------------------------

--
-- 資料表結構 `account_info`
--

CREATE TABLE `account_info` (
  `帳號` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `姓名` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `性別` varchar(2) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `生日` date NOT NULL,
  `信箱` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `備註` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- 傾印資料表的資料 `account_info`
--

INSERT INTO `account_info` (`帳號`, `姓名`, `性別`, `生日`, `信箱`, `備註`) VALUES
('user10', 'user10', '1', '2023-02-20', 'user10@gmail.com', '123'),
('user11', 'user1', '1', '2023-02-20', 'user1@gmail.com', 'user'),
('user12', 'user1', '1', '2023-02-20', 'user1@gmail.com', 'user'),
('user13', 'user1', '1', '2023-02-20', 'user1@gmail.com', 'user'),
('user14', 'user1', '1', '2023-02-20', 'user1@gmail.com', 'user'),
('user15', 'user1', '1', '2023-02-20', 'user1@gmail.com', 'user'),
('user16', 'user1', '1', '2023-02-20', 'user1@gmail.com', 'user'),
('user17', 'user1', '1', '2023-02-20', 'user1@gmail.com', 'user'),
('user18', 'user1', '1', '2023-02-20', 'user1@gmail.com', 'user'),
('user19', 'user1', '1', '2023-02-20', 'user1@gmail.com', 'user'),
('user2', 'user2', '1', '2023-02-20', 'user2@gmail.com', 'user'),
('user20', 'user1', '1', '2023-02-20', 'user1@gmail.com', 'user'),
('user3', 'user1', '1', '2023-02-20', 'user1@gmail.com', 'user'),
('user4', 'user1', '1', '2023-02-20', 'user1@gmail.com', 'user'),
('user5', 'user1', '1', '2023-02-20', 'user1@gmail.com', 'user'),
('user6', 'user1', '1', '2023-02-20', 'user1@gmail.com', 'user'),
('user7', 'user1', '1', '2023-02-20', 'user1@gmail.com', 'user'),
('user8', 'user1', '1', '2023-02-20', 'user1@gmail.com', 'user'),
('user9', 'user1', '1', '2023-02-20', 'user1@gmail.com', 'user');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `account_info`
--
ALTER TABLE `account_info`
  ADD PRIMARY KEY (`帳號`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
