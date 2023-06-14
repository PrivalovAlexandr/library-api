-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 14 2023 г., 22:43
-- Версия сервера: 8.0.30
-- Версия PHP: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `library`
--

-- --------------------------------------------------------

--
-- Структура таблицы `Books`
--

CREATE TABLE `Books` (
  `id` int NOT NULL,
  `title` varchar(168) DEFAULT NULL,
  `author` varchar(168) DEFAULT NULL,
  `description` varchar(168) DEFAULT NULL,
  `price` int DEFAULT NULL,
  `in_stock` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `Books`
--

INSERT INTO `Books` (`id`, `title`, `author`, `description`, `price`, `in_stock`) VALUES
(1, 'Война и мир', 'Лев Толстой', 'Классический роман', 500, 10),
(2, '1984', 'Джордж Оруэлл', 'Антиутопия', 450, 0),
(3, 'Убить пересмешника', 'Харпер Ли', 'Американский классик', 400, 5),
(4, 'Хоббит', 'Дж. Р. Р. Толкиен', 'Приключенческий роман', 350, 3),
(5, 'Великий Гэтсби', 'Ф. Скотт Фицджеральд', 'Американская классика', 500, 7),
(6, 'Мастер и Маргарита', 'Михаил Булгаков', 'Советский классик', 600, 12),
(7, '1984', 'Джордж Оруэлл', 'Антиутопия', 450, 1),
(8, 'Маленький принц', 'Антуан де Сент-Экзюпери', 'Философский роман', 300, 5),
(9, 'О дивный новый мир', 'Олдос Хаксли', 'Антиутопия', 550, 6),
(10, 'Три товарища', 'Эрих Мария Ремарк', 'Роман', 500, 10),
(12, 'test book', 'actually me', 'none desc', 1515, 1),
(13, 'test book', 'actually me', 'none desc', 1515, 1),
(14, 'test book', 'actually me', 'none desc', 1515, 1),
(15, 'test book', 'actually me', 'none desc', 1515, 1),
(16, 'test book', 'actually me', 'none desc', 1515, 1),
(17, 'test book', 'actually me', 'none desc', 1515, 1),
(18, 'test book', 'actually me', 'none desc', 1515, 1),
(19, 'test book', 'actually me', 'none desc', 1515, 1),
(20, 'test book', 'actually me', 'none desc', 1515, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `Customers`
--

CREATE TABLE `Customers` (
  `id` int NOT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(50) NOT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `bearerToken` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `Customers`
--

INSERT INTO `Customers` (`id`, `first_name`, `last_name`, `email`, `password`, `phone`, `bearerToken`) VALUES
(1, 'Иван', 'Петров', 'ivan.petrov@example.com', 'test_user123', '+79001234567', NULL),
(2, 'Сергей', 'Сидоров', 'sergey.sidorov@example.com', 'test_user123', '+79007654321', NULL),
(3, 'Екатерина', 'Иванова', 'ekaterina.ivanova@example.com', 'test_user123', '+79004567891', NULL),
(4, 'Анна', 'Смирнова', 'anna.smirnova@example.com', 'test_user123', '+79009876543', NULL),
(5, 'Алексей', 'Миронов', 'aleksey.mironov@example.com', 'test_user123', '+79001234987', NULL),
(6, 'Мария', 'Васильева', 'maria.vasileva@example.com', 'test_user123', '+79005678432', NULL),
(7, 'Василий', 'Пупкин', 'vasiliy.pupkin@example.com', 'test_user123', '+79008765912', NULL),
(8, 'Ольга', 'Макарова', 'olga.makarova@example.com', 'test_user123', '+79004321789', NULL),
(9, 'Дмитрий', 'Носов', 'dmitriy.nosov@example.com', 'test_user123', '+79006789123', NULL),
(10, 'Татьяна', 'Белова', 'tatiana.belova@example.com', 'test_user123', '+79007891234', NULL),
(11, 'Виктор', 'Баринов', 'admin', 'admin', '+79002024060', 'ADqCfKZ3E7kinkikGncqbmfqG1bd3TAKY8HZyW');

-- --------------------------------------------------------

--
-- Структура таблицы `Orders`
--

CREATE TABLE `Orders` (
  `id` int NOT NULL,
  `customer_id` int NOT NULL,
  `book_id` int NOT NULL,
  `quantity` int NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `Orders`
--

INSERT INTO `Orders` (`id`, `customer_id`, `book_id`, `quantity`, `status`) VALUES
(1, 1, 1, 2, 'processing'),
(2, 1, 2, 1, 'processing'),
(3, 2, 1, 1, 'completed'),
(4, 3, 5, 3, 'cancelled'),
(5, 4, 6, 1, 'processing'),
(6, 5, 7, 2, 'completed'),
(7, 6, 8, 1, 'cancelled'),
(8, 7, 9, 1, 'processing'),
(9, 8, 10, 3, 'completed'),
(10, 9, 2, 1, 'processing'),
(12, 11, 1, 54, 'processing'),
(13, 11, 1, 5400, 'processing'),
(14, 11, 1, 5400, 'processing'),
(15, 11, 10, 5400, 'processing'),
(16, 11, 10, 5400, 'processing');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `Books`
--
ALTER TABLE `Books`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `Customers`
--
ALTER TABLE `Customers`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `Orders`
--
ALTER TABLE `Orders`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `Books`
--
ALTER TABLE `Books`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT для таблицы `Customers`
--
ALTER TABLE `Customers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `Orders`
--
ALTER TABLE `Orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
