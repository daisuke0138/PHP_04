-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2024-07-18 15:20:01
-- サーバのバージョン： 10.4.32-MariaDB
-- PHP のバージョン: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `menberlist_database01`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `file_table`
--

CREATE TABLE `file_table` (
  `user_id` int(11) NOT NULL,
  `file_id` int(11) NOT NULL,
  `file_pass` varchar(128) NOT NULL,
  `file_value` varchar(128) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- テーブルのデータのダンプ `file_table`
--

INSERT INTO `file_table` (`user_id`, `file_id`, `file_pass`, `file_value`, `created_at`) VALUES
(19, 1, 'data/file/file_100001_1.pdf', '上期', '2024-07-18 20:52:05'),
(19, 2, 'data/file/file_100001_2.pdf', '下期', '2024-07-18 21:31:41'),
(20, 3, 'data/file/file_100002_3.pdf', '上期', '2024-07-18 21:33:20');

-- --------------------------------------------------------

--
-- テーブルの構造 `menber_list`
--

CREATE TABLE `menber_list` (
  `id` int(6) NOT NULL,
  `pass` varchar(128) NOT NULL,
  `No` int(6) NOT NULL,
  `name` char(20) NOT NULL,
  `department` char(20) NOT NULL,
  `class` char(20) NOT NULL,
  `skill` text NOT NULL,
  `hobby` text NOT NULL,
  `photo` varchar(128) NOT NULL,
  `hire date` date NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- テーブルのデータのダンプ `menber_list`
--

INSERT INTO `menber_list` (`id`, `pass`, `No`, `name`, `department`, `class`, `skill`, `hobby`, `photo`, `hire date`, `updated_at`, `deleted_at`) VALUES
(19, '$2y$10$opQacFAP.ysg01xo9kajoO0cgrsqmUt5kp99Tn5ZqRnzq/3MtV2Xq', 100001, '荒巻大輔', 'DEV15', '機構', '1234', '登山行きたい！', 'data/img/img_100001.png', '0000-00-00', '2024-07-13 14:13:12', NULL),
(20, '$2y$10$zs0.jS3i65XdOVqTU6jB/u3MPG6bto4g77bpMTu.qbUF5.UW/0HAm', 100002, 'やまださん', 'DEV15', '機構', 'いろいろ', '登山行きたい！', 'data/img/img_100002.png', '0000-00-00', '2024-07-13 02:25:14', NULL),
(21, '$2y$10$b0s.ibHEu1l/0qw8r0T87OG7E690fXlRK./.eUV0930gLL5Kv6JNG', 100004, 'たかはちさん', 'DEV15', '機構', 'いろいろ', '川あぞび', 'data/img/img_100004.png', '0000-00-00', '2024-07-13 02:24:20', NULL);

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `menber_list`
--
ALTER TABLE `menber_list`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `menber_list`
--
ALTER TABLE `menber_list`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
