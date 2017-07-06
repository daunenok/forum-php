-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июл 06 2017 г., 18:48
-- Версия сервера: 5.7.16
-- Версия PHP: 7.0.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `daunenok`
--

-- --------------------------------------------------------

--
-- Структура таблицы `forum_categories`
--

CREATE TABLE `forum_categories` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `forum_categories`
--

INSERT INTO `forum_categories` (`id`, `title`) VALUES
(1, 'Computers'),
(2, 'Art'),
(3, 'Media'),
(8, 'Animals');

-- --------------------------------------------------------

--
-- Структура таблицы `forum_messages`
--

CREATE TABLE `forum_messages` (
  `id` int(11) NOT NULL,
  `theme_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `forum_messages`
--

INSERT INTO `forum_messages` (`id`, `theme_id`, `name`, `content`, `created`) VALUES
(1, 1, 'Jane', 'Vivamus eu urna placerat, mollis ante eu, dapibus elit. Vestibulum pellentesque porta condimentum. Suspendisse est purus, tristique at venenatis in, finibus vel nibh. Duis viverra varius enim, eget laoreet dui dictum ac. Phasellus vitae nibh justo. Donec sit amet diam quis est vehicula efficitur ut id massa. ', '2017-06-28 21:30:28'),
(2, 1, 'John', 'Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Mauris placerat ex dolor, ac dictum augue luctus non. Duis vitae ex justo. Pellentesque ac mi interdum, cursus ex facilisis, rutrum tellus. Nulla sed augue enim. Mauris magna metus, laoreet eget velit eu, finibus bibendum arcu. Nulla ornare rutrum nisl, ac finibus dui aliquet eu. Mauris quis rutrum ipsum, eu interdum eros.', '2017-06-28 21:30:28'),
(3, 1, 'Jane', 'Proin dapibus mauris nec libero condimentum ullamcorper. Curabitur id lorem vel tortor pulvinar mollis molestie et mi. Fusce vitae euismod augue. Cras dignissim velit urna, a commodo tortor tincidunt vitae. Aliquam eu suscipit est. Nam ac tincidunt ex. Morbi sed scelerisque nulla. Quisque blandit nulla quam. Etiam ultrices eu nunc sit amet imperdiet. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.', '2017-06-29 20:40:48'),
(5, 1, 'Anna', 'Grid systems are used for creating page layouts through a series of rows and columns that house your content. Here\'s how the Bootstrap grid system works', '2017-06-29 21:03:55'),
(6, 6, 'Jane', 'Mauris luctus vestibulum egestas. Duis et sapien et nibh faucibus congue. Mauris vel nunc non arcu luctus tempus non vehicula augue. Proin vitae leo at felis blandit molestie. Aenean porttitor porttitor ipsum, laoreet tempus risus volutpat iaculis. Aenean id neque porta, fringilla orci eget, mattis nisi. Mauris consequat congue porta', '2017-07-01 00:06:37'),
(7, 7, 'root', 'Morbi a pellentesque metus, ut semper dolor. Mauris libero odio, malesuada vitae cursus nec, iaculis eu mi. Etiam ornare dolor in lorem dictum, quis fringilla massa placerat. Phasellus gravida nunc diam, suscipit tincidunt velit dapibus nec. Integer felis lectus, mattis quis scelerisque quis, imperdiet ut mauris. ', '2017-07-01 00:08:19'),
(8, 3, 'John', 'Cras porttitor facilisis dolor a ornare. Vivamus at magna elit. Etiam faucibus ligula sem, ac porta elit pulvinar non. Vestibulum tincidunt sapien metus, ac imperdiet risus accumsan eu. Curabitur bibendum fermentum ullamcorper. Phasellus lorem enim, laoreet luctus fermentum non, blandit at turpis. Morbi vehicula', '2017-07-04 21:04:20'),
(9, 8, 'John', 'Cras porttitor facilisis dolor a ornare. Vivamus at magna elit. Etiam faucibus ligula sem, ac porta elit pulvinar non. Vestibulum tincidunt sapien metus, ac imperdiet risus accumsan eu. Curabitur bibendum fermentum ullamcorper. Phasellus lorem enim, laoreet luctus fermentum non, blandit at turpis. Morbi vehicula', '2017-07-04 21:05:25'),
(10, 6, 'Anna', 'Cras porttitor facilisis dolor a ornare. Vivamus at magna elit. Etiam faucibus ligula sem, ac porta elit pulvinar non. Vestibulum tincidunt sapien metus, ac imperdiet risus accumsan eu. Curabitur bibendum fermentum ullamcorper. Phasellus lorem enim, laoreet luctus fermentum non, blandit at turpis. Morbi vehicula', '2017-07-04 21:09:21'),
(11, 6, 'John', 'Nunc a lobortis', '2017-07-06 19:48:51'),
(12, 3, 'Perry', 'Duis id imperdiet ipsum, ac consequat dui. Mauris ut est finibus, viverra est sit amet, lobortis massa. Fusce accumsan justo a varius tristique. Aenean pretium sodales dignissim. Aliquam sollicitudin ex magna, in pretium massa ullamcorper vel. Fusce elementum ipsum sem, eget suscipit arcu cursus vel. Vivamus pharetra, leo vitae dignissim accumsan, libero massa pretium ante, a iaculis ligula arcu id enim.', '2017-07-06 19:51:52');

-- --------------------------------------------------------

--
-- Структура таблицы `forum_themes`
--

CREATE TABLE `forum_themes` (
  `id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `author` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `forum_themes`
--

INSERT INTO `forum_themes` (`id`, `cat_id`, `title`, `content`, `created`, `author`) VALUES
(1, 1, 'Hardware', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus id nibh eu felis aliquam maximus. Vestibulum urna nulla, fermentum et elit in, hendrerit gravida arcu. Nunc maximus fermentum faucibus. Nunc consectetur hendrerit nisi vitae congue. Nulla facilisi. Praesent at ante eget nisi ultrices sollicitudin. Duis porta ligula mauris, id sagittis tortor feugiat quis. In ac libero id purus porttitor tempor. Duis id bibendum odio, vitae gravida ligula. In hac habitasse', '2017-06-28 20:57:21', 'John'),
(2, 1, 'Software', 'Aenean accumsan nibh eget tincidunt finibus. Morbi quam dui, fermentum a velit quis, sagittis ornare sapien. Morbi sagittis ut velit ut maximus. Sed ut velit sit amet leo sagittis pellentesque non non mi. Vestibulum libero ligula, malesuada et aliquam eu, efficitur ut velit. Cras posuere odio sit amet lorem pharetra ullamcorper. Suspendisse potenti. Vivamus vel lacus mollis, interdum enim id, vulputate magna. Proin eu lacinia turpis. Vestibulum nibh augue, tempus et erat sit amet, porttitor auctor tellus. Fusce aliquet risus nec magna maximus porttitor. Aliquam in tristique nisl. Proin faucibus vestibulum velit ornare venenatis. Vestibulum lacinia feugiat pharetra. Nunc at accumsan nisi, ac pharetra est. In blandit non dui eu imperdiet.', '2017-06-28 20:57:21', 'John'),
(3, 2, 'Etiam ultrices', 'Aliquam eu enim at ligula tincidunt commodo sed vel nibh. Sed rhoncus dui ornare feugiat feugiat. Phasellus ex risus, egestas interdum ipsum vitae, posuere fermentum tellus. Praesent sit amet felis justo. Etiam ultrices ornare dui vel semper. Proin eleifend risus in eros tempus, et tempus lorem lobortis. Nam quis arcu massa. Nunc at augue ullamcorper, tincidunt erat ac, scelerisque nibh. Quisque nec eleifend purus, at accumsan metus. Integer finibus justo non mattis scelerisque. Cras quis purus sem. Praesent at orci ac purus luctus auctor.', '2017-06-28 21:10:09', 'John'),
(6, 1, 'New models', 'Your favorite models of PC. Share with us!', '2017-06-30 23:56:14', 'John'),
(7, 2, 'Sculpture', 'Mauris luctus vestibulum egestas. Duis et sapien et nibh faucibus congue. Mauris vel nunc non arcu luctus tempus non vehicula augue. Proin vitae leo at felis blandit molestie. Aenean porttitor porttitor ipsum, laoreet tempus risus volutpat iaculis. Aenean id neque porta, fringilla orci eget, mattis nisi. Mauris consequat congue porta', '2017-07-01 00:07:49', 'Jane'),
(8, 3, 'Forums', ' Vivamus at magna elit. Etiam faucibus ligula sem, ac porta elit pulvinar non. Vestibulum tincidunt sapien metus, ac imperdiet risus accumsan eu. Curabitur bibendum fermentum ullamcorper. Phasellus lorem enim, laoreet luctus fermentum non, blandit at turpis. Morbi vehicula', '2017-07-04 21:05:16', 'John'),
(9, 8, 'Cats', 'Duis id imperdiet ipsum, ac consequat dui. Mauris ut est finibus, viverra est sit amet, lobortis massa. Fusce accumsan justo a varius tristique. Aenean pretium sodales dignissim. Aliquam sollicitudin ex magna, in pretium massa ullamcorper vel. Fusce', '2017-07-06 19:49:16', 'John');

-- --------------------------------------------------------

--
-- Структура таблицы `forum_users`
--

CREATE TABLE `forum_users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `access` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `forum_users`
--

INSERT INTO `forum_users` (`id`, `name`, `pass`, `access`) VALUES
(1, 'John', '123456', 1),
(2, 'Jane', 'qwerty', 1),
(3, 'root', 'secret', 2),
(4, 'Anna', 'Anna', 1),
(5, 'Perry', 'Perry', 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `forum_categories`
--
ALTER TABLE `forum_categories`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `forum_messages`
--
ALTER TABLE `forum_messages`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `forum_themes`
--
ALTER TABLE `forum_themes`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `forum_users`
--
ALTER TABLE `forum_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `forum_categories`
--
ALTER TABLE `forum_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT для таблицы `forum_messages`
--
ALTER TABLE `forum_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT для таблицы `forum_themes`
--
ALTER TABLE `forum_themes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT для таблицы `forum_users`
--
ALTER TABLE `forum_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
