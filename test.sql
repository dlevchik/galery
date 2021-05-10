-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 10 2021 г., 23:47
-- Версия сервера: 8.0.19
-- Версия PHP: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `test`
--

-- --------------------------------------------------------

--
-- Структура таблицы `img`
--

CREATE TABLE `img` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `title` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `description` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `path` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `img`
--

INSERT INTO `img` (`id`, `user_id`, `title`, `description`, `time`, `path`) VALUES
(26, 1, 'title', 'description', '2021-02-04 22:51:50', 'img/020.jpg'),
(27, 1, 'title', 'description', '2021-02-04 22:51:50', 'img/15840043093270.png'),
(28, 1, 'title', 'description', '2021-02-04 22:51:50', 'img/15865106627900.jpg'),
(29, 1, 'title', 'description', '2021-02-04 22:51:50', 'img/15865108539180.jpg'),
(30, 1, 'title', 'description', '2021-02-04 22:51:50', 'img/15894558179810.jpg'),
(31, 1, 'title', 'description', '2021-02-04 22:51:50', 'img/72055179_p0.jpg'),
(32, 1, 'title', 'description', '2021-02-04 22:51:50', 'img/Screenshot_5.png'),
(33, 1, 'title', 'description', '2021-02-04 22:51:50', 'img/photo_2019-08-06_19-54-26.jpg'),
(34, 1, 'title', 'description', '2021-02-04 22:51:50', 'img/photo_2019-09-07_07-51-52.jpg'),
(35, 1, 'title', 'description', '2021-02-04 22:51:50', 'img/photo_2019-09-28_19-04-16 (2).jpg'),
(36, 1, 'title', 'description', '2021-02-04 22:51:50', 'img/photo_2019-09-28_19-04-16.jpg'),
(37, 1, 'title', 'description', '2021-02-04 22:51:50', 'img/photo_2019-12-16_19-44-38.jpg'),
(38, 1, 'title', 'description', '2021-02-04 22:51:50', 'img/photo_2019-12-16_19-44-43.jpg'),
(39, 1, 'title', 'description', '2021-02-04 22:51:50', 'img/photo_2019-12-16_19-44-47.jpg'),
(40, 1, 'title', 'description', '2021-02-04 22:51:50', 'img/photo_2019-12-16_19-44-51.jpg'),
(41, 1, 'title', 'description', '2021-02-04 22:51:50', 'img/photo_2019-12-16_19-44-55.jpg'),
(42, 1, 'title', 'description', '2021-02-04 22:51:50', 'img/photo_2019-12-16_20-54-16.jpg'),
(43, 1, 'title', 'description', '2021-02-04 22:51:50', 'img/photo_2019-12-19_14-26-10.jpg'),
(44, 1, 'title', 'description', '2021-02-04 22:51:50', 'img/photo_2020-02-04_23-47-36.jpg'),
(45, 1, 'title', 'description', '2021-02-04 22:51:50', 'img/photo_2020-03-11_10-12-40.jpg'),
(46, 1, 'title', 'description', '2021-02-04 22:51:50', 'img/photo_2020-04-17_23-09-13.jpg'),
(47, 1, 'title', 'description', '2021-02-04 22:51:50', 'img/photo_2020-04-17_23-09-33.jpg'),
(48, 1, 'title', 'description', '2021-02-04 22:51:50', 'img/photo_2020-07-06_17-12-40.jpg'),
(49, 1, 'title', 'description', '2021-02-04 22:51:50', 'img/unnamed (2).jpg'),
(52, 1, 'tirhelp', '', '2021-02-21 22:16:57', 'img/b37e4bd1e04592a219169c1d8b165a84.jpg'),
(63, 1, 'aesthetic', '', '2021-02-25 09:01:03', 'img/6bbcce97da94a0465d050e69b3ea9741.jpg'),
(65, 1, 'another flowers', '', '2021-02-25 09:10:38', 'img/e3c745c65af502c981d625a7717ba638.jpg'),
(66, 1, 'arm', '', '2021-02-25 09:13:00', 'img/f822ca34e8eaa691488525bc3ce24ba8.jpg'),
(67, 1, 'piano', '', '2021-02-25 09:15:52', 'img/c9f34bfd4fc0d90d336d54cf098e6f19.jpg'),
(71, 3, 'hands', 'cute', '2021-03-06 22:13:52', 'img/1150897c45a783768682d8580cac65be.jpg'),
(72, 3, 'dream store', 'all of us have a dream', '2021-03-08 23:20:56', 'img/d54f14d3c832db4d959a411f1ced54c1.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `status`
--

CREATE TABLE `status` (
  `id` int NOT NULL,
  `name` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `status`
--

INSERT INTO `status` (`id`, `name`) VALUES
(1, 'user'),
(2, 'admin');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `status_id` tinyint NOT NULL DEFAULT '1',
  `username` varchar(32) NOT NULL,
  `password` varchar(256) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `email` varchar(320) NOT NULL,
  `email-validated` tinyint(1) NOT NULL DEFAULT '0',
  `registration-time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `profile-pic` varchar(64) NOT NULL DEFAULT 'profile-pics/default-picture.jpg',
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `status_id`, `username`, `password`, `email`, `email-validated`, `registration-time`, `profile-pic`, `description`) VALUES
(1, 2, 'admin', '$2y$10$qBSiIp.c9xBYMS1/LUzipOaKV39iZC6sxGkqG9qyRUVNDcWXTHeDi', 'kanalqwesta@gmail.com', 0, '2021-02-22 21:37:51', 'profile-pics/admin.jpg', 'BEHOLD! The site administranor himself\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Proin efficitur mollis metus, ut feugiat ex pharetra vitae. Pellentesque congue nulla ut vestibulum dictum. Donec laoreet gravida ultrices. Aenean dictum eros nisl, ac interdum tellus laoreet in. Sed commodo eleifend leo eu semper. Vestibulum turpis elit, molestie id enim quis, faucibus eleifend mi. In interdum malesuada erat, a aliquam velit pellentesque sit amet.\r\n\r\nPraesent eleifend sem tortor, sit amet sollicitudin tellus facilisis ac. Pellentesque nulla velit, blandit in orci et, blandit tincidunt odio. Morbi elementum tortor vel est laoreet scelerisque. Praesent mattis id elit id hendrerit. Proin ex purus, lobortis ac.'),
(3, 1, 'dlevchik', '$2y$10$3yAbsawEL3Y.i33BarR7dOdlbLeibQWOzXCPhC3Vqhzx3.VPyXDia', 'fuck@you', 0, '2021-02-22 21:56:52', 'profile-pics/5921278f7db0b25fc000ca51435dce0f.jpg', 'Hi! My name is Dmytro and i\'m 17.5 years old');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `img`
--
ALTER TABLE `img`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `img`
--
ALTER TABLE `img`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT для таблицы `status`
--
ALTER TABLE `status`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
