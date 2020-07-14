-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Июл 12 2020 г., 12:29
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
-- Структура таблицы `goods`
--

CREATE TABLE `goods` (
  `id` int NOT NULL,
  `name` varchar(50) NOT NULL COMMENT 'Название товара',
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT 'Описание товара',
  `img` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT 'Путь к картинке',
  `price` int NOT NULL COMMENT 'Цена',
  `comments` text CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT 'Комментарий',
  `article` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT 'Артикул'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `goods`
--

INSERT INTO `goods` (`id`, `name`, `description`, `img`, `price`, `comments`, `article`) VALUES
(1, 'Iphone', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores aspernatur, consequuntur dolor eaque eligendi harum repudiandae totam! Aut eveniet facilis libero, maiores molestiae possimus reiciendis saepe sint voluptatem! Aliquid consequuntur eligendi nobis obcaecati voluptates. Ad aliquid, consequatur culpa doloremque eaque et inventore modi molestias pariatur quas quisquam soluta ullam vel!', 'iphone.jpg', 2000, '', 'iphone11'),
(2, 'HTC', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores aspernatur, consequuntur dolor eaque eligendi harum repudiandae totam! Aut eveniet facilis libero, maiores molestiae possimus reiciendis saepe sint voluptatem! Aliquid consequuntur eligendi nobis obcaecati voluptates. Ad aliquid, consequatur culpa doloremque eaque et inventore modi molestias pariatur quas quisquam soluta ullam vel!', 'htc.jpg', 1000, '', 'htc1'),
(3, 'Samsung', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores aspernatur, consequuntur dolor eaque eligendi harum repudiandae totam! Aut eveniet facilis libero, maiores molestiae possimus reiciendis saepe sint voluptatem! Aliquid consequuntur eligendi nobis obcaecati voluptates. Ad aliquid, consequatur culpa doloremque eaque et inventore modi molestias pariatur quas quisquam soluta ullam vel!', 'samsung.jpg', 1500, '', 'Samsung1'),
(11, 'MY PHONE CHANGE', 'Super phone CHANGE', NULL, 122, NULL, NULL),
(15, 'СОВСЕМ НОВЫЙ ТЕЛ ИЗМЕНЕН', 'НОВОЕ ОПИСАНИЕ ИЗМЕНЕН', NULL, 123213212, NULL, NULL),
(16, 'LAST', 'LAST', NULL, 32, NULL, NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `goods`
--
ALTER TABLE `goods`
  ADD PRIMARY KEY (`id`),
  ADD KEY `article` (`article`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `goods`
--
ALTER TABLE `goods`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
