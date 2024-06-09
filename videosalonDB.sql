-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 09 2024 г., 15:14
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
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `poster` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `producer` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `rentprice` int(255) NOT NULL,
  `buyprice` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `films`
--

INSERT INTO `films` (`id`, `title`, `poster`, `producer`, `description`, `rentprice`, `buyprice`) VALUES
(1, 'Криминальное чтиво', 'Pulp_Fiction.jpg', 'Квентин тарантино', 'тут описание', 100, 600),
(2, 'Сербский фильм', '576x.webp', 'я снял', 'семейное кино', 200, 1000),
(3, 'Драйв', '615ot6U8mgL._AC_UF1000,1000_QL80_.jpg', 'Николас Виндинг Рефн', 'поехали', 100, 400),
(4, 'бойцовский клуб', 'Fight_club.jpg', ' Дэвид Финчер', 'сигма момент', 90, 500),
(5, 'побег из шоушенка', '25308.jpg', 'Фрэнк Дарабонт', 'валим', 60, 460);

-- --------------------------------------------------------

--
-- Структура таблицы `film_buy`
--

CREATE TABLE `film_buy` (
  `id` int(8) NOT NULL,
  `client` int(8) NOT NULL,
  `product` int(8) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `film_buy`
--

INSERT INTO `film_buy` (`id`, `client`, `product`, `price`) VALUES
(1, 11, 1, 600),
(2, 2, 1, 600);

-- --------------------------------------------------------

--
-- Структура таблицы `film_rent`
--

CREATE TABLE `film_rent` (
  `id` int(8) NOT NULL,
  `client` int(8) NOT NULL,
  `product` int(8) NOT NULL,
  `term` int(8) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `film_rent`
--

INSERT INTO `film_rent` (`id`, `client`, `product`, `term`, `price`) VALUES
(1, 2, 1, 4, 400),
(2, 11, 1, 4, 400),
(3, 2, 2, 4, 800);

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
(11, 'Виталий', 'Иванов', 'Vitalya@gmail.com', 'Bb7381456', 'user'),
(12, 'Иван', 'Иванов', 'ivanov@gmail.com', '1234', 'user'),
(13, 'Константин', 'Константин', 'hgfghfg@dfgdf', '123', 'user');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `films`
--
ALTER TABLE `films`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `film_buy`
--
ALTER TABLE `film_buy`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client->buy` (`client`),
  ADD KEY `product->bue` (`product`);

--
-- Индексы таблицы `film_rent`
--
ALTER TABLE `film_rent`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client->rent` (`client`),
  ADD KEY `product->rent` (`product`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `film_buy`
--
ALTER TABLE `film_buy`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `film_rent`
--
ALTER TABLE `film_rent`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `film_buy`
--
ALTER TABLE `film_buy`
  ADD CONSTRAINT `film_buy_ibfk_1` FOREIGN KEY (`client`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `film_buy_ibfk_2` FOREIGN KEY (`product`) REFERENCES `films` (`id`);

--
-- Ограничения внешнего ключа таблицы `film_rent`
--
ALTER TABLE `film_rent`
  ADD CONSTRAINT `film_rent_ibfk_1` FOREIGN KEY (`client`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `film_rent_ibfk_2` FOREIGN KEY (`product`) REFERENCES `films` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
