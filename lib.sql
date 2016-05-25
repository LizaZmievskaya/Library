-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Май 25 2016 г., 15:37
-- Версия сервера: 5.6.17
-- Версия PHP: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `lib`
--

-- --------------------------------------------------------

--
-- Структура таблицы `authors`
--

CREATE TABLE IF NOT EXISTS `authors` (
  `author_id` int(11) NOT NULL AUTO_INCREMENT,
  `auth_name` varchar(50) NOT NULL,
  PRIMARY KEY (`author_id`),
  UNIQUE KEY `auth_name` (`auth_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Дамп данных таблицы `authors`
--

INSERT INTO `authors` (`author_id`, `auth_name`) VALUES
(8, 'Бронте Э.'),
(3, 'Булгаков М.А.'),
(10, 'Гербиш Н.'),
(4, 'Достоевский Ф.М.'),
(12, 'Коэльо П.'),
(6, 'Леви М.'),
(11, 'Митчелл М.'),
(7, 'Набоков В.В,'),
(2, 'Ремарк Э.М.'),
(9, 'Спаркс Н.'),
(1, 'Шевченко Т.Г.'),
(5, 'Экзюпери А.С.');

-- --------------------------------------------------------

--
-- Структура таблицы `books`
--

CREATE TABLE IF NOT EXISTS `books` (
  `book_id` int(11) NOT NULL AUTO_INCREMENT,
  `book_name` varchar(50) NOT NULL,
  `year` int(4) NOT NULL,
  `pages_num` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `publisher_id` int(11) NOT NULL,
  `lang_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `genre_id` int(11) NOT NULL,
  PRIMARY KEY (`book_id`),
  KEY `publisher_id` (`publisher_id`),
  KEY `lang_id` (`lang_id`),
  KEY `author_id` (`author_id`),
  KEY `genre_id` (`genre_id`),
  KEY `genre_id_2` (`genre_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Дамп данных таблицы `books`
--

INSERT INTO `books` (`book_id`, `book_name`, `year`, `pages_num`, `price`, `publisher_id`, `lang_id`, `author_id`, `genre_id`) VALUES
(1, 'Маленький принц', 2010, 120, '80.00', 7, 4, 5, 4),
(2, 'Маленький принц', 2012, 100, '90.00', 3, 2, 5, 4),
(3, 'Где ты?', 2011, 368, '50.00', 7, 1, 6, 1),
(4, 'Уйти, чтобы вернуться', 2011, 400, '52.00', 7, 1, 6, 1),
(5, 'Похититель теней', 2011, 350, '60.00', 7, 1, 6, 1),
(6, 'Спасение', 2009, 434, '70.00', 6, 7, 9, 1),
(7, 'Мастер и Маргарита', 2010, 287, '34.00', 2, 1, 3, 4),
(8, 'Лолита', 2010, 250, '35.00', 2, 1, 7, 1),
(9, 'Теплі історії до кави', 2013, 180, '38.00', 1, 2, 10, 5),
(10, 'Идиот', 2010, 450, '40.00', 4, 1, 4, 1),
(11, 'Вероника решает умереть', 2009, 109, '37.00', 7, 1, 12, 1),
(12, 'Теплі історії до шоколаду', 2013, 167, '38.00', 1, 2, 10, 5),
(13, 'Теплі історії про кохання', 2014, 134, '42.00', 1, 2, 10, 5),
(14, 'Унесенные ветром', 2008, 489, '124.00', 4, 1, 11, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `countries`
--

CREATE TABLE IF NOT EXISTS `countries` (
  `country_id` int(11) NOT NULL AUTO_INCREMENT,
  `country` varchar(30) NOT NULL,
  PRIMARY KEY (`country_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Дамп данных таблицы `countries`
--

INSERT INTO `countries` (`country_id`, `country`) VALUES
(1, 'Франция'),
(2, 'Великобритания'),
(3, 'Россия'),
(4, 'Украина'),
(6, 'США'),
(13, 'Австрия'),
(14, 'Германия'),
(15, 'Бразилия');

-- --------------------------------------------------------

--
-- Структура таблицы `genres`
--

CREATE TABLE IF NOT EXISTS `genres` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `genre` varchar(60) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `genre` (`genre`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Дамп данных таблицы `genres`
--

INSERT INTO `genres` (`id`, `genre`) VALUES
(2, 'Детектив'),
(3, 'Новелла'),
(5, 'Рассказы'),
(1, 'Роман'),
(4, 'Фантастика');

-- --------------------------------------------------------

--
-- Структура таблицы `languages`
--

CREATE TABLE IF NOT EXISTS `languages` (
  `lang_id` int(11) NOT NULL AUTO_INCREMENT,
  `language` varchar(30) NOT NULL,
  PRIMARY KEY (`lang_id`),
  UNIQUE KEY `language` (`language`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Дамп данных таблицы `languages`
--

INSERT INTO `languages` (`lang_id`, `language`) VALUES
(7, 'Английский'),
(3, 'Белорусский'),
(15, 'Иврит'),
(8, 'Испанский'),
(10, 'Итальянский'),
(11, 'Китайский'),
(6, 'Немецкий'),
(4, 'Польский'),
(13, 'Португальский'),
(12, 'Румынский'),
(1, 'Русский'),
(2, 'Украинский'),
(9, 'Французский'),
(5, 'Чешский'),
(14, 'Японский');

-- --------------------------------------------------------

--
-- Структура таблицы `output`
--

CREATE TABLE IF NOT EXISTS `output` (
  `output_id` int(11) NOT NULL AUTO_INCREMENT,
  `output_date` date NOT NULL,
  `return_date` date NOT NULL,
  `book_id` int(11) NOT NULL,
  `reader_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  PRIMARY KEY (`output_id`),
  KEY `book_id` (`book_id`),
  KEY `reader_id` (`reader_id`),
  KEY `author_id` (`author_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Дамп данных таблицы `output`
--

INSERT INTO `output` (`output_id`, `output_date`, `return_date`, `book_id`, `reader_id`, `author_id`) VALUES
(1, '2016-04-05', '2016-04-12', 1, 2, 5),
(2, '2016-04-18', '2016-04-20', 7, 7, 3),
(5, '2016-05-04', '0000-00-00', 10, 4, 4),
(6, '2016-05-06', '0000-00-00', 14, 3, 11),
(9, '2016-05-02', '2016-05-04', 7, 5, 3),
(10, '2016-04-10', '2016-04-20', 10, 9, 4),
(11, '2016-05-01', '2016-05-05', 7, 2, 3),
(12, '2016-04-05', '2016-04-15', 14, 10, 11),
(13, '2016-05-11', '2016-05-12', 8, 3, 7),
(14, '2016-05-24', '0000-00-00', 5, 6, 6),
(16, '2016-05-23', '0000-00-00', 9, 9, 10);

-- --------------------------------------------------------

--
-- Структура таблицы `publishers`
--

CREATE TABLE IF NOT EXISTS `publishers` (
  `publisher_id` int(11) NOT NULL AUTO_INCREMENT,
  `publish_name` varchar(30) NOT NULL,
  `city` varchar(30) NOT NULL,
  `phone_num` varchar(20) NOT NULL,
  `e_mail` varchar(40) NOT NULL,
  `web_site` varchar(40) NOT NULL,
  PRIMARY KEY (`publisher_id`),
  UNIQUE KEY `e_mail` (`e_mail`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Дамп данных таблицы `publishers`
--

INSERT INTO `publishers` (`publisher_id`, `publish_name`, `city`, `phone_num`, `e_mail`, `web_site`) VALUES
(1, 'Ранок', 'Харьков', '8(057)-701-11-22', 'office@ranok.com.ua', 'www.ranok.com.ua'),
(2, 'Эксмо', 'Москва', '7(495)-411-68-86', 'info@eksmo.ru', 'http://eksmo.ru/'),
(3, 'Арий', 'Киев', '8(044)-537-29-20', 'info@ariy.com.ua', 'http://ariy.com.ua/'),
(4, 'АСТ', 'Москва', '7(499)-951-60-00', 'pr.ast@yandex.ru', 'http://www.ast.ru/'),
(5, 'Просвита', 'Киев', '8(044)-454-88-41', 'vc-prosvita@ukr.net', 'http://vcprosvita.com.ua'),
(6, 'Hachette Book Group', 'Нью-Йорк', '1(800)-759-01-90', 'hachette.books@hbgusa.com', 'http://www.hachettebookgroup.com/'),
(7, 'Иностранка', 'Москва', '7(495)-933-76-00', 'sales@atticus-group.ru', 'http://inostrankabooks.ru/'),
(8, 'уцу', 'уцу', 'уц', 'у', 'у');

-- --------------------------------------------------------

--
-- Структура таблицы `readers`
--

CREATE TABLE IF NOT EXISTS `readers` (
  `reader_id` int(11) NOT NULL AUTO_INCREMENT,
  `second_name` varchar(40) NOT NULL,
  `first_name` varchar(40) NOT NULL,
  `adress` varchar(50) NOT NULL,
  `passport` varchar(30) NOT NULL,
  `phone_num` varchar(20) NOT NULL,
  PRIMARY KEY (`reader_id`),
  UNIQUE KEY `passport` (`passport`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Дамп данных таблицы `readers`
--

INSERT INTO `readers` (`reader_id`, `second_name`, `first_name`, `adress`, `passport`, `phone_num`) VALUES
(1, 'Иванов', 'Иван', 'ул. Ленина 16, 27', 'СЮ 789 234', '8(097)-234-12-45'),
(2, 'Петров', 'Константин', 'ул. Пушкинская 23, 58', 'МТ 123 789', '8(078)-567-45-65'),
(3, 'Козлов', 'Иван', 'ул. Комсомольская 23, 102', 'АП 432 654', '8(043)-243-54-34'),
(4, 'Дунаенко', 'Александр', 'пр. Победы 50, 342', 'АП 654 435', '8(098)-432-54-32'),
(5, 'Шевченко', 'Евгений', 'ул. Пушкинская 54, 45', 'МТ 346 765', '8(043)-253-42-36'),
(6, 'Тарасенко', 'Валерия', 'пл. Конституции 32, 25', 'КП 876 546', '8(076)-569-84-78'),
(7, 'Шредер', 'Алина', 'ул. Кирова 42, 234', 'СЮ 547 658', '8(058)-435-78-96'),
(8, 'Киров', 'Владислав', 'ул. Чернышевского 24, 84', 'СЮ 126 542', '8(057)-436-46-54'),
(9, 'Петрова', 'Ольга', 'пер. Армянский 1/3, 432', 'МТ 436 463', '8(046)-345-46-56'),
(10, 'Зайцева', 'Юлия', 'пр. Московский 38, 203', 'АП 257 656', '8(032)-546-54-75'),
(15, 'Змиевская', 'Елизавета', 'ул. Целиноградская 40, 316', 'СЮ 234 234', '8(097)-508-52-80');

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_ibfk_4` FOREIGN KEY (`genre_id`) REFERENCES `genres` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `books_ibfk_1` FOREIGN KEY (`publisher_id`) REFERENCES `publishers` (`publisher_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `books_ibfk_2` FOREIGN KEY (`lang_id`) REFERENCES `languages` (`lang_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `books_ibfk_3` FOREIGN KEY (`author_id`) REFERENCES `authors` (`author_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `output`
--
ALTER TABLE `output`
  ADD CONSTRAINT `output_ibfk_3` FOREIGN KEY (`author_id`) REFERENCES `authors` (`author_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `output_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `output_ibfk_2` FOREIGN KEY (`reader_id`) REFERENCES `readers` (`reader_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
