-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Июл 12 2020 г., 12:28
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
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `login` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `is_admin` int DEFAULT '0' COMMENT 'Права'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `name`, `password`, `is_admin`) VALUES
(1, 'admin', 'admin', '15e05166b2bed965d4585058dbc75a8a', 1),
(30, 'asd', 'asd', '970b0290072e9dffa6c8e7a1cb30f9d7', 0),
(31, '123', '123', '15e05166b2bed965d4585058dbc75a8a', 0),
(42, '7771', '7771', '8c22f5a3f6bb907555ae706a507fa39e', 0),
(47, 'loginCHANGE!', 'nameCHANGE!', 'password!', 0),
(49, 'СОВСЕМ НОВЫЙ ЮЗЕР лог изм!', 'СОВСЕМ НОВЫЙ ЮЗЕР имя изм!', 'СОВСЕМ НОВЫЙ ПАСС! пас изм', 0),
(53, 'NEW', 'DELETE FROM `users` WHERE `users`.`id` = 42', 'NEW', 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
