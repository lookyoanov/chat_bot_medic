-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 30 2022 г., 22:57
-- Версия сервера: 8.0.19
-- Версия PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `clinica_bot`
--

-- --------------------------------------------------------

--
-- Структура таблицы `admin`
--

CREATE TABLE `admin` (
  `id_admin` int NOT NULL,
  `login_admin` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password_admin` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `admin`
--

INSERT INTO `admin` (`id_admin`, `login_admin`, `password_admin`) VALUES
(1, 'admin', 'Qwerty123');

-- --------------------------------------------------------

--
-- Структура таблицы `bot_info`
--

CREATE TABLE `bot_info` (
  `id_botinfo` int NOT NULL,
  `question` text COLLATE utf8mb4_general_ci NOT NULL,
  `special` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `other` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `bot_info`
--

INSERT INTO `bot_info` (`id_botinfo`, `question`, `special`, `other`) VALUES
(1, 'Запись к врачу', '', 'запись к врачу,запись,записаться,записаться к врачу'),
(2, 'Терапевт', 'doctor', 'Терапевт,лечащий врач,терапевту,лечащему врачу'),
(3, 'Невролог', 'doctor', 'Невролог,специалист по невролгии,врач невролог,невролог врач,неврологу,врачу неврологу'),
(4, 'Адрес', NULL, 'Где находитесь?,как добраться?,как проехать?,адрес клиники,адрес'),
(5, 'Контакты', NULL, 'Номер телефона клиники,ваш номер телефона,контакты,телефон'),
(6, 'Команды бота', NULL, 'Помощь,хелп,help,команды бота,команды,как это работает'),
(7, 'Прайс-лист', NULL, 'Прайс-лист,цена за услуги,платные услуги, прайс лист'),
(8, 'График работы', NULL, 'график работы клиники, часы работы, когда работает клиника'),
(9, 'Терапевт', 'symptoms', 'Боль в горле,насморк,кашель,температура,головная боль'),
(10, 'Невролог', 'symptoms', 'Головная боль,головокружение,тремор,ухудшение сна,быстрая утомляемость,боли в спине,обмороки');

-- --------------------------------------------------------

--
-- Структура таблицы `doctor_appointment`
--

CREATE TABLE `doctor_appointment` (
  `id_appoint` int NOT NULL,
  `id_doc` int NOT NULL,
  `speciality_doc` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_user` int DEFAULT NULL,
  `date_appoint` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `time_appoint` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `mark_appoint` tinyint(1) NOT NULL,
  `id_event` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `doctor_appointment`
--

INSERT INTO `doctor_appointment` (`id_appoint`, `id_doc`, `speciality_doc`, `id_user`, `date_appoint`, `time_appoint`, `mark_appoint`, `id_event`) VALUES
(1, 1, 'Терапевт', NULL, '10.05.2022', '9:00', 0, NULL),
(2, 1, 'Терапевт', NULL, '10.05.2022', '9:15', 0, NULL),
(3, 1, 'Терапевт', NULL, '10.05.2022', '9:30', 0, NULL),
(4, 1, 'Терапевт', 8, '10.05.2022', '9:45', 1, 8),
(5, 1, 'Терапевт', 2, '10.05.2022', '10:00', 1, 3),
(6, 2, 'Невролог', NULL, '10.05.2022', '9:00', 0, NULL),
(7, 2, 'Невролог', NULL, '11.05.2022', '9:30', 0, NULL),
(8, 2, 'Невролог', 7, '11.05.2022', '10:00', 1, 9),
(9, 2, 'Невролог', NULL, '11.05.2022', '10:30', 0, NULL),
(10, 2, 'Невролог', NULL, '11.05.2022', '11:00', 0, NULL),
(11, 3, 'Терапевт', NULL, '10.05.2022', '10:00', 0, NULL),
(12, 3, 'Терапевт', NULL, '10.05.2022', '10:15', 0, NULL),
(13, 3, 'Терапевт', NULL, '10.05.2022', '10:30', 0, NULL),
(14, 3, 'Терапевт', NULL, '10.05.2022', '10:45', 0, NULL),
(15, 3, 'Терапевт', NULL, '10.05.2022', '11:00', 0, NULL),
(16, 1, 'Терапевт', NULL, '11.05.2022', '12:00', 0, NULL),
(17, 1, 'Терапевт', NULL, '11.05.2022', '12:15', 0, NULL),
(18, 1, 'Терапевт', 2, '11.05.2022', '12:30', 1, 10),
(19, 1, 'Терапевт', NULL, '11.05.2022', '12:45', 0, NULL),
(20, 1, 'Терапевт', NULL, '11.05.2022', '13:00', 0, NULL),
(21, 1, 'Терапевт', NULL, '11.05.2022', '13:15', 0, NULL),
(22, 1, 'Терапевт', NULL, '11.05.2022', '13:30', 0, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `doctor_pull`
--

CREATE TABLE `doctor_pull` (
  `id_doc` int NOT NULL,
  `firstname_doc` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `lastname_doc` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `patronymic_doc` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `speciality_doc` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `doctor_pull`
--

INSERT INTO `doctor_pull` (`id_doc`, `firstname_doc`, `lastname_doc`, `patronymic_doc`, `speciality_doc`) VALUES
(1, 'Васильева', 'Василиса', 'Васильевна', 'Терапевт'),
(2, 'Королёв', 'Алексей', 'Владимирович', 'Невролог'),
(3, 'Давыдов', 'Богдан', 'Фаязович', 'Терапевт');

-- --------------------------------------------------------

--
-- Структура таблицы `event_ring`
--

CREATE TABLE `event_ring` (
  `id_event` int NOT NULL,
  `date_event` date NOT NULL,
  `phone` text COLLATE utf8mb4_general_ci NOT NULL,
  `close_event` tinyint(1) NOT NULL,
  `id_admin` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `event_ring`
--

INSERT INTO `event_ring` (`id_event`, `date_event`, `phone`, `close_event`, `id_admin`) VALUES
(1, '2022-03-09', '89032413092', 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `event_user`
--

CREATE TABLE `event_user` (
  `id_event` int NOT NULL,
  `date_event` date NOT NULL,
  `id_user` int NOT NULL,
  `event` text COLLATE utf8mb4_general_ci NOT NULL,
  `close_event` tinyint(1) NOT NULL,
  `id_admin` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `event_user`
--

INSERT INTO `event_user` (`id_event`, `date_event`, `id_user`, `event`, `close_event`, `id_admin`) VALUES
(2, '2008-04-20', 6, 'Регистрация нового пользователя', 0, NULL),
(3, '2022-04-18', 2, 'Запись пользователя к врачу', 0, NULL),
(6, '2022-04-19', 7, 'Регистрация нового пользователя', 0, NULL),
(7, '2022-05-04', 8, 'Регистрация нового пользователя', 0, NULL),
(8, '2022-05-04', 8, 'Запись пользователя к врачу', 0, NULL),
(9, '2022-05-05', 7, 'Запись пользователя к врачу', 0, NULL),
(10, '2022-05-05', 2, 'Запись пользователя к врачу', 0, NULL),
(11, '2022-05-09', 9, 'Регистрация нового пользователя', 0, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `price`
--

CREATE TABLE `price` (
  `id_price` int NOT NULL,
  `spec_price` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `pricing` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `teg_price` varchar(50) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `price`
--

INSERT INTO `price` (`id_price`, `spec_price`, `pricing`, `teg_price`) VALUES
(1, 'Терапия', '5000', 'Диспансеризация'),
(2, 'Хирургия', '1200', 'Рентген'),
(3, 'Терапия', '1700', 'Тест на COVID-19');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id_user` int NOT NULL,
  `login_user` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password_user` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `firstname` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `lastname` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `patronymic` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `phone_user` varchar(16) COLLATE utf8mb4_general_ci NOT NULL,
  `birthday` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `verification` tinyint(1) NOT NULL,
  `date_reg_user` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id_user`, `login_user`, `password_user`, `firstname`, `lastname`, `patronymic`, `phone_user`, `birthday`, `verification`, `date_reg_user`) VALUES
(2, '8888888888888888', '$2y$10$RrJ64JUgKh7rqQrCSnumVuH9gQ1TuwGkOtOY0eRsuGh8nG/yTOkUa', 'Владимир', 'Седов', 'Николаевич', '89032413092', '1999-02-24', 1, '2022-03-09'),
(3, '7777777777777777', '$2y$10$Lq1AKvWGAd8GseSJ6LRlEuRMXNU1RICFcCQ.0pleWjJVuWHnHejTW', 'Тест', 'Тест', 'Тест', '89032413092', '1996-07-08', 1, '2007-04-20'),
(6, '1111111111111111', '$2y$10$LpqE5KEJEj59w0wEhNW.luSNvPv.gUBgZ9l2RJCEpVQNur4TnbT06', 'тестт', 'тестт', 'тестт', '89032413092', '2000-11-09', 1, '2008-04-20'),
(7, '1234567890123456', '$2y$10$sN6UyOfbx252Kg/D4m9Xe.y9k8sF1fpeINPngmXRLuiq0RKDtYnM.', 'Алексей', 'Лукьянов', 'Сергеевич', '89055556525', '2000-07-28', 1, '2022-04-19'),
(8, '1234567890123457', '$2y$10$wuPkasYNdfPQlRNgzo5zaemICcCVTr9hOpHc2yHp2CYBayP23I/fq', 'Тест', 'Тестов', 'Тестович', '89993332255', '2001-06-06', 0, '2022-05-04'),
(9, '1236547894563213', '$2y$10$3q9VCE69o9fmahAZAHyAOeKlVdEpSQbcv25YFc6Kea71eFn7h952G', 'Максим', 'Козлов', 'Евгеньевич', '8(965)999-45-62', '1992-11-05', 0, '2022-05-09');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Индексы таблицы `bot_info`
--
ALTER TABLE `bot_info`
  ADD PRIMARY KEY (`id_botinfo`);

--
-- Индексы таблицы `doctor_appointment`
--
ALTER TABLE `doctor_appointment`
  ADD PRIMARY KEY (`id_appoint`),
  ADD KEY `id_doc` (`id_doc`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `speciality_doc` (`speciality_doc`),
  ADD KEY `id_event` (`id_event`);

--
-- Индексы таблицы `doctor_pull`
--
ALTER TABLE `doctor_pull`
  ADD PRIMARY KEY (`id_doc`),
  ADD KEY `speciality_doc` (`speciality_doc`);

--
-- Индексы таблицы `event_ring`
--
ALTER TABLE `event_ring`
  ADD PRIMARY KEY (`id_event`),
  ADD KEY `id_admin` (`id_admin`);

--
-- Индексы таблицы `event_user`
--
ALTER TABLE `event_user`
  ADD PRIMARY KEY (`id_event`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_admin` (`id_admin`);

--
-- Индексы таблицы `price`
--
ALTER TABLE `price`
  ADD PRIMARY KEY (`id_price`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `bot_info`
--
ALTER TABLE `bot_info`
  MODIFY `id_botinfo` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `doctor_appointment`
--
ALTER TABLE `doctor_appointment`
  MODIFY `id_appoint` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT для таблицы `doctor_pull`
--
ALTER TABLE `doctor_pull`
  MODIFY `id_doc` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `event_ring`
--
ALTER TABLE `event_ring`
  MODIFY `id_event` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `event_user`
--
ALTER TABLE `event_user`
  MODIFY `id_event` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `price`
--
ALTER TABLE `price`
  MODIFY `id_price` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `doctor_appointment`
--
ALTER TABLE `doctor_appointment`
  ADD CONSTRAINT `doctor_appointment_ibfk_2` FOREIGN KEY (`id_doc`) REFERENCES `doctor_pull` (`id_doc`),
  ADD CONSTRAINT `doctor_appointment_ibfk_3` FOREIGN KEY (`speciality_doc`) REFERENCES `doctor_pull` (`speciality_doc`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `doctor_appointment_ibfk_4` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `doctor_appointment_ibfk_5` FOREIGN KEY (`id_event`) REFERENCES `event_user` (`id_event`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `event_ring`
--
ALTER TABLE `event_ring`
  ADD CONSTRAINT `event_ring_ibfk_1` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id_admin`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `event_user`
--
ALTER TABLE `event_user`
  ADD CONSTRAINT `event_user_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `event_user_ibfk_2` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id_admin`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
