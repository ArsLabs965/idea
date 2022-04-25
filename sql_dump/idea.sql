-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Апр 25 2022 г., 20:40
-- Версия сервера: 10.3.22-MariaDB
-- Версия PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `idea`
--

-- --------------------------------------------------------

--
-- Структура таблицы `accaunts`
--

CREATE TABLE `accaunts` (
  `id` int(20) NOT NULL,
  `login` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `likes`
--

CREATE TABLE `likes` (
  `id` int(20) NOT NULL,
  `post` int(20) NOT NULL,
  `login` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `posts`
--

CREATE TABLE `posts` (
  `id` int(20) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `info` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `img` mediumblob DEFAULT NULL,
  `likes` int(20) NOT NULL DEFAULT 0,
  `views` int(20) NOT NULL DEFAULT 0,
  `login` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `tags`
--

CREATE TABLE `tags` (
  `id` int(20) NOT NULL,
  `post` int(20) NOT NULL,
  `tag` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `usertag`
--

CREATE TABLE `usertag` (
  `id` int(20) NOT NULL,
  `login` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tag` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `colvo` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `views`
--

CREATE TABLE `views` (
  `id` int(20) NOT NULL,
  `post` int(20) NOT NULL,
  `login` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `accaunts`
--
ALTER TABLE `accaunts`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `usertag`
--
ALTER TABLE `usertag`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `views`
--
ALTER TABLE `views`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `accaunts`
--
ALTER TABLE `accaunts`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `usertag`
--
ALTER TABLE `usertag`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `views`
--
ALTER TABLE `views`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
