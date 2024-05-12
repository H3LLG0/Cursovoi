-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 12 2024 г., 16:01
-- Версия сервера: 5.7.39
-- Версия PHP: 8.0.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `videosalonDB`
--

-- --------------------------------------------------------

--
-- Структура таблицы `films`
--

CREATE TABLE `films` (
  `id` int(8) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `producer` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `year` varchar(4) COLLATE utf8mb4_unicode_ci NOT NULL,
  `duration` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `films`
--

INSERT INTO `films` (`id`, `title`, `description`, `type`, `producer`, `year`, `duration`, `picture`) VALUES
(2, 'Сербский фильм', 'семейное кино', 'драмма', 'не я снял', '2011', '1:43:00', 'SerbianFilm.webp'),
(3, 'Зелёный Слоник', 'фильм ахуенный', 'говно', 'я снял', '1999', '1:26:00', 'UvpviHSOgwg.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `massage`
--

CREATE TABLE `massage` (
  `id_msg` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `massage` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `massage`
--

INSERT INTO `massage` (`id_msg`, `user`, `massage`, `title`, `status`) VALUES
(8, 2, 'тест', 'тест', 'read'),
(9, 2, 'dfg', 'gdfg', 'read'),
(10, 2, 'fghfdghfdg', 'dfgdfg', 'read'),
(11, 2, 'sdfsdfsdf', 'tot ntcn', 'read');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(8) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `surname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `email`, `password`, `role`) VALUES
(2, 'Константин', 'Савельев', 'hgtcpvshc@gmail.com', '1234', 'admin'),
(10, 'Андрей', 'Егоров', 'Egorov@gmail.com', '1234567890', 'admin'),
(11, 'Виталий', 'Иванов', 'Vitalya@gmail.com', 'Bb7381456', 'user');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `films`
--
ALTER TABLE `films`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_film` (`title`);

--
-- Индексы таблицы `massage`
--
ALTER TABLE `massage`
  ADD PRIMARY KEY (`id_msg`),
  ADD KEY `user` (`user`) USING BTREE;

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `films`
--
ALTER TABLE `films`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `massage`
--
ALTER TABLE `massage`
  MODIFY `id_msg` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `massage`
--
ALTER TABLE `massage`
  ADD CONSTRAINT `massage_ibfk_1` FOREIGN KEY (`user`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
