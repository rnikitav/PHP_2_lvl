-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Июл 15 2020 г., 20:14
-- Версия сервера: 8.0.20
-- Версия PHP: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `lesson6`
--

-- --------------------------------------------------------

--
-- Структура таблицы `comments`
--

CREATE TABLE `comments` (
  `id` int NOT NULL,
  `article` varchar(50) NOT NULL,
  `comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `comments`
--

INSERT INTO `comments` (`id`, `article`, `comment`) VALUES
(4, 'iphone11', '1 commit'),
(5, 'htc1', '1 commit'),
(6, 'htc1', '2 commit'),
(7, 'Samsung1', '1 commit'),
(8, 'htc1', 'lorem10'),
(9, 'htc1', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse eum optio veritatis? Distinctio eveniet libero magni quae quam qui? Doloremque earum laborum vel. Atque autem doloremque, earum fugit inventore, ipsam libero minus molestias officiis ratione repellendus sit soluta unde veniam!'),
(11, 'iphone11', '2 commit'),
(12, 'Samsung1', '2 commit'),
(13, 'Samsung1', 'ds'),
(14, 'Samsung1', '4 commit'),
(15, 'iphone11', '3 commit'),
(16, 'iphone11', '4 commit'),
(19, 'Samsung1', '5 commit'),
(20, 'Samsung1', '6 commit'),
(21, 'Samsung1', '7 commit'),
(22, 'iphone11', '5 commit'),
(23, 'htc1', '4 commit'),
(24, 'nokia3310', '1 commit'),
(25, 'article', '1 commit'),
(26, 'new ', '1 commit');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `article` (`article`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
