-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Дек 22 2024 г., 19:28
-- Версия сервера: 10.4.32-MariaDB
-- Версия PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `salon`
--

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `user_id` int(100) NOT NULL,
  `login` varchar(200) NOT NULL,
  `password` int(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `telephone` int(100) NOT NULL,
  `age` int(100) NOT NULL,
  `pol` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`user_id`, `login`, `password`, `username`, `status`, `telephone`, `age`, `pol`) VALUES
(28, '2', 2, '', 'admin', 2, 2, '2'),
(29, '1', 1, '', 'chel', 0, 0, ''),
(30, '3', 3, '', 'chel', 0, 0, ''),
(31, '8', 8, '', 'chel', 0, 0, ''),
(32, '888', 7888, '', 'chel', 888, 888, '88'),
(33, '6767', 6767, '', 'chel', 0, 0, ''),
(34, 'jkjk', 0, '', 'chel', 89, 3, 'ytne'),
(35, '56', 56, '', 'chel', 0, 0, ''),
(36, '44', 44, '', 'chel', 0, 0, ''),
(37, '34', 34, '', 'chel', 0, 0, ''),
(38, '222', 222, '', 'chel', 0, 0, ''),
(39, '5', 5, '', 'chel', 0, 0, '');

-- --------------------------------------------------------

--
-- Структура таблицы `uslugi`
--

CREATE TABLE `uslugi` (
  `id_uslugi` int(255) NOT NULL,
  `foto` varchar(200) NOT NULL,
  `price` int(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `opisanie` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `uslugi`
--

INSERT INTO `uslugi` (`id_uslugi`, `foto`, `price`, `name`, `opisanie`) VALUES
(17, 'SHYSpau3e5o.jpg', 35, 'крутая прическа', 'ааа аааааа ааааа аааааааа ааааааааааааааааааааааааааааааааааааааа ааааааааааааааааааааа ааа ааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааааа ааааааааааааааааааааааа'),
(22, '9Itf9CDPunM.jpg', 0, 'убийство', 'роророро'),
(23, '2b0r7GygoT4.jpg', 3, 'прикольчики', 'описание описание описание описание описание описание описание описание описание описание описание описание описание описание описание описание описание описание описание описание описание описание описание описание описание описание описание описание описание описание описание описание описание описание описание описание описание описание описание описание описание описание описание описание описание описание описание описание описание описание описание описание описание описание описание описание описание описание описание описание описание описание описание описание описание описание описание описание описание описание описание описание описание описание описание описание описание описание описание описание описание описание описание описание описание описание описание описание описание описание описание описание описание описание описание описание описание описание описание описание описание описание описание описание описание описание описание описание описание описание описание о'),
(24, 'morDjprpbaQ.jpg', 6, 'я', '6'),
(27, 'o0BLd0uZkX0.jpg', 1, '1', '1'),
(28, 'ilco3N3stUg.jpg', 1, '1', '2'),
(29, '4X0RJIaX0RY.jpg', 6, '4', '5'),
(30, 'ilco3N3stUg.jpg', 8, 'в', '7'),
(31, 'o0BLd0uZkX0.jpg', 6, '2', '5'),
(32, 'o0BLd0uZkX0.jpg', 22, '22', '22');

-- --------------------------------------------------------

--
-- Структура таблицы `zakaz`
--

CREATE TABLE `zakaz` (
  `zakaz_id` int(200) NOT NULL,
  `name` varchar(100) NOT NULL,
  `data` date NOT NULL,
  `vremia` time NOT NULL,
  `username` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Индексы таблицы `uslugi`
--
ALTER TABLE `uslugi`
  ADD PRIMARY KEY (`id_uslugi`);

--
-- Индексы таблицы `zakaz`
--
ALTER TABLE `zakaz`
  ADD PRIMARY KEY (`zakaz_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT для таблицы `uslugi`
--
ALTER TABLE `uslugi`
  MODIFY `id_uslugi` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT для таблицы `zakaz`
--
ALTER TABLE `zakaz`
  MODIFY `zakaz_id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
