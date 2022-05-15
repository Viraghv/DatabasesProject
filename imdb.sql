-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2021. Nov 23. 00:42
-- Kiszolgáló verziója: 10.4.21-MariaDB
-- PHP verzió: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `imdb`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `film`
--

CREATE TABLE `film` (
  `id` int(1) NOT NULL,
  `cim` varchar(60) NOT NULL,
  `rendezo` varchar(100) DEFAULT NULL,
  `megjelenes_eve` int(4) DEFAULT NULL,
  `studio_nev` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `film`
--

INSERT INTO `film` (`id`, `cim`, `rendezo`, `megjelenes_eve`, `studio_nev`) VALUES
(11, 'A remény rabjai', 'Frank Darabont', 1994, 'Castle Rock Entertainment'),
(12, ' A keresztapa', 'Francis Ford Coppola', 1972, 'Paramount Pictures'),
(13, 'A keresztapa II', 'Francis Ford Coppola', 1974, 'Paramount Pictures'),
(14, 'A sötét lovag', 'Christopher Nolan', 2008, 'Warner Bros. Pictures'),
(15, 'Tizenkét dühös ember', 'Sidney Lumet', 1957, 'Orion-Nova Productions'),
(16, 'Schindler listája', 'Steven Spielberg', 1993, 'Universal Pictures'),
(17, 'A Gyűrűk Ura: A király visszatér', 'Peter Jackson', 2003, 'New Line Cinema'),
(18, 'Ponyvaregény', 'Quentin Tarantino', 1994, 'Miramax Films'),
(19, 'A Jó, a Rossz és a Csúf', 'Sergio Leone', 1966, 'Arturo González Producciones Cinematográficas'),
(20, 'A Gyűrűk Ura: A gyűrű szövetsége', 'Peter Jackson', 2001, 'New Line Cinema'),
(21, ' Harcosok klubja', 'David Fincher', 1999, '20th Century Fox'),
(23, 'Forrest Gump', 'Robert Zemeckis', 1994, 'Paramount Pictures'),
(41, 'Eredet', 'Christopher Nolan', 2010, 'Warner Bros. Pictures'),
(42, 'A Gyűrűk Ura: A két torony', 'Peter Jackson', 2002, 'New Line Cinema'),
(43, 'Mátrix', 'Lana és Lilly Wachowski', 1999, 'Village Roadshow Pictures'),
(44, 'Nagymenők', 'Martin Scorsese', 1990, 'Warner Bros. Pictures'),
(45, 'Száll a kakukk fészkére', 'Milos Forman', 1975, 'Fantasy Films'),
(46, 'A hét szamuráj', 'Akira Kurosawa', 1954, 'Toho'),
(47, 'Hetedik', 'David Fincher', 1995, 'New Line Cinema'),
(48, 'A bárányok hallgatnak', 'Jonathan Demme', 1991, 'Orion Pictures');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `filmstudio`
--

CREATE TABLE `filmstudio` (
  `nev` varchar(50) NOT NULL,
  `tulajdonos` varchar(100) DEFAULT NULL,
  `alapitas_eve` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `filmstudio`
--

INSERT INTO `filmstudio` (`nev`, `tulajdonos`, `alapitas_eve`) VALUES
('20th Century Fox', 'The Walt Disney Company', 1935),
('Arturo González Producciones Cinematográficas', NULL, 1940),
('Castle Rock Entertainment', 'Warner Media Group', 1987),
('Fantasy Films', '', 0),
('Miramax Films', 'beIN Media Group', 1979),
('New Line Cinema', 'Warner Media Group', 1967),
('Orion Pictures', '', 1978),
('Orion-Nova Productions', 'Metro-Goldwyn-Mayer', 1978),
('Paramount Pictures', 'Viacom', 1912),
('Toho', '	Hankyu Hanshin Toho Group', 1932),
('Universal Pictures', 'Comcast', 1912),
('Village Roadshow Pictures', 'Village Roadshow', 1986),
('Warner Bros. Pictures', 'Warner Media Group', 1923);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `mufaj`
--

CREATE TABLE `mufaj` (
  `id` int(1) NOT NULL,
  `mufajnev` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `mufaj`
--

INSERT INTO `mufaj` (`id`, `mufajnev`) VALUES
(1, 'dráma'),
(2, 'akció'),
(3, 'krimi'),
(4, 'történelmi'),
(5, 'életrajzi'),
(6, 'kaland'),
(7, 'western'),
(13, 'romantikus'),
(14, 'horror'),
(15, 'sci-fi'),
(16, 'rejtély'),
(17, 'thriller');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `mufaja`
--

CREATE TABLE `mufaja` (
  `film_id` int(11) NOT NULL,
  `mufaj_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `mufaja`
--

INSERT INTO `mufaja` (`film_id`, `mufaj_id`) VALUES
(11, 1),
(12, 1),
(12, 3),
(13, 1),
(13, 3),
(14, 1),
(14, 2),
(14, 3),
(15, 1),
(15, 3),
(16, 1),
(16, 4),
(16, 5),
(17, 1),
(17, 2),
(17, 6),
(18, 1),
(18, 3),
(19, 7),
(20, 1),
(20, 2),
(20, 6),
(21, 1),
(23, 1),
(23, 13),
(41, 2),
(41, 6),
(41, 15),
(42, 1),
(42, 2),
(42, 6),
(43, 2),
(43, 15),
(44, 1),
(44, 3),
(44, 5),
(45, 1),
(46, 1),
(46, 2),
(46, 6),
(47, 1),
(47, 3),
(47, 16),
(48, 1),
(48, 3),
(48, 17);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `szerepel`
--

CREATE TABLE `szerepel` (
  `szinesz_id` int(11) NOT NULL,
  `film_id` int(11) NOT NULL,
  `szerep` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `szerepel`
--

INSERT INTO `szerepel` (`szinesz_id`, `film_id`, `szerep`) VALUES
(1, 11, 'Ellis Boyd \'Red\' Redding'),
(1, 47, 'Somerset'),
(2, 11, 'Andy Dufresne'),
(3, 11, 'Warden Norton'),
(4, 12, 'Don Vito Corleone'),
(5, 12, 'Michael'),
(5, 13, 'Michael'),
(6, 12, 'Sonny'),
(7, 13, 'Vito Corleone'),
(7, 44, 'James Conway'),
(8, 12, 'Tom Hagen'),
(8, 13, 'Tom Hagen'),
(9, 14, 'Bruce Wayne'),
(10, 14, 'Joker'),
(11, 14, 'Harvey Dent'),
(12, 15, 'Esküdt 8'),
(13, 15, 'Esküdt 3'),
(14, 15, 'Esküdt 1'),
(15, 16, 'Oskar Schindler'),
(16, 16, 'Amon Goeth'),
(17, 16, 'Itzhak Stern'),
(18, 17, 'Frodo'),
(18, 20, 'Frodo'),
(18, 42, 'Frodo'),
(19, 17, 'Aragorn'),
(19, 20, 'Aragorn'),
(19, 42, 'Aragorn'),
(20, 17, 'Gandalf'),
(20, 20, 'Gandalf'),
(20, 42, 'Gandalf'),
(21, 18, 'Vincent Vega'),
(22, 18, 'Mia Wallace'),
(23, 18, 'Jules Winnfield'),
(24, 19, 'Blondie'),
(25, 19, 'Tuco'),
(26, 19, 'Sentenza'),
(27, 17, 'Legolas'),
(27, 20, 'Legolas'),
(27, 42, 'Legolas'),
(28, 21, 'Tyler Durden'),
(28, 47, 'Mills'),
(29, 21, 'Narrátor'),
(30, 21, 'Robert \'Bob\' Paulsen'),
(35, 23, 'Forrest Gump'),
(36, 23, 'Jenny Curran'),
(37, 23, 'Dan Taylor hadnagy'),
(38, 41, 'Cobb'),
(39, 41, 'Arthur'),
(40, 41, 'Ariadne'),
(41, 43, 'Neo'),
(42, 43, 'Morpheus'),
(43, 43, 'Trinity'),
(44, 44, 'Henry Hill'),
(45, 44, 'Tommy DeVito'),
(46, 45, 'R.P. McMurphy'),
(47, 45, 'Ratched nővér'),
(48, 45, 'Ellis'),
(49, 46, 'Kikuchiyo'),
(50, 46, 'Kambei Shimada'),
(51, 46, 'Shino'),
(52, 47, 'John Doe'),
(53, 48, 'Clarice Starling'),
(54, 48, 'Dr. Hannibal Lecter'),
(55, 48, 'Ardelia Mapp');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `szinesz`
--

CREATE TABLE `szinesz` (
  `id` int(1) NOT NULL,
  `nev` varchar(100) NOT NULL,
  `szuletesi_datum` date DEFAULT NULL,
  `szarmazas` varchar(30) DEFAULT NULL,
  `nem` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `szinesz`
--

INSERT INTO `szinesz` (`id`, `nev`, `szuletesi_datum`, `szarmazas`, `nem`) VALUES
(1, 'Morgan Freeman', '1937-06-01', 'USA', 1),
(2, 'Tim Robbins', '1958-10-16', 'USA', 1),
(3, 'Bob Gunton', '1945-11-15', 'USA', 1),
(4, 'Marlon Brando', '1924-04-03', 'USA', 1),
(5, 'Al Pacino', '1940-04-25', 'USA', 1),
(6, 'James Caan', '1940-03-26', 'USA', 1),
(7, 'Robert De Niro', '1943-08-17', 'USA', 1),
(8, 'Robert Duvall', '1931-01-05', 'USA', 1),
(9, 'Christian Bale', '1974-01-30', 'Wales, UK', 1),
(10, 'Heath Ledger', '1979-04-04', 'USA', 1),
(11, 'Aaron Eckhart', '1968-03-12', 'USA', 1),
(12, 'Henry Fonda', '1905-05-16', 'USA', 1),
(13, 'Lee J. Cobb', '1911-12-08', 'USA', 1),
(14, 'Martin Balsam', '1919-11-04', 'USA', 1),
(15, 'Liam Neeson', '1952-06-07', 'Írország, UK', 1),
(16, 'Ralph Fiennes', '1962-12-22', 'Anglia, UK', 1),
(17, 'Ben Kingsley', '1943-12-31', 'Anglia, UK', 1),
(18, 'Elijah Wood', '1981-01-28', 'USA', 1),
(19, 'Viggo Mortensen', '1958-10-20', 'USA', 1),
(20, 'Ian McKellen', '1939-05-25', 'Anglia, UK', 1),
(21, 'John Travolta', '1954-02-18', 'USA', 1),
(22, 'Uma Thurman', '1970-04-29', 'USA', 0),
(23, 'Samuel L. Jackson', '1948-12-21', 'USA', 1),
(24, 'Clint Eastwood', '1930-05-31', 'USA', 1),
(25, 'Eli Wallach', '1915-12-07', 'USA', 1),
(26, 'Lee Van Cleef', '1925-01-09', 'USA', 1),
(27, 'Orlando Bloom', '1977-01-13', 'Anglia, UK', 1),
(28, 'Brad Pitt', '1963-12-18', 'USA', 1),
(29, 'Edward Norton', '1969-08-18', 'USA', 1),
(30, 'Meat Loaf', '1947-09-27', 'USA', 1),
(35, 'Tom Hanks', '1956-07-09', 'USA', 1),
(36, 'Robin Wright', '1966-04-08', 'USA', 0),
(37, 'Gary Sinise', '1955-03-17', 'USA', 1),
(38, 'Leonardo DiCaprio', '1974-11-11', 'USA', 1),
(39, 'Joseph Gordon-Levitt', '1981-02-17', 'USA', 1),
(40, 'Elliot Page', '1987-02-21', 'Kanada', 0),
(41, 'Keanu Reeves', '1964-09-02', 'Lebanon', 1),
(42, 'Laurence Fishburne', '1961-07-30', 'USA', 1),
(43, 'Carrie-Anne Moss', '1967-08-21', 'Kanada', 0),
(44, 'Ray Liotta', '1954-12-18', 'USA', 1),
(45, 'Joe Pesci', '1943-02-09', 'USA', 1),
(46, 'Jack Nicholson', '1937-04-22', 'USA', 1),
(47, 'Louise Fletcher', '1934-07-22', 'USA', 0),
(48, 'Michael Berryman', '1948-09-04', 'USA', 1),
(49, 'Toshirou Mifune', '1920-04-01', 'Kína', 1),
(50, 'Takashi Shimura', '1905-03-12', 'Japán', 1),
(51, 'Keiko Tsushima', '1926-02-07', 'Japán', 0),
(52, 'Kevin Spacey', '1959-07-26', 'USA', 1),
(53, 'Jodie Foster', '1962-11-19', 'USA', 0),
(54, 'Anthony Hopkins', '1937-12-31', 'Wales, UK', 1),
(55, 'Kasi Lemmons', '1961-02-24', 'USA', 0);

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `film`
--
ALTER TABLE `film`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cim` (`cim`,`rendezo`),
  ADD KEY `studio_nev` (`studio_nev`);

--
-- A tábla indexei `filmstudio`
--
ALTER TABLE `filmstudio`
  ADD PRIMARY KEY (`nev`);

--
-- A tábla indexei `mufaj`
--
ALTER TABLE `mufaj`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `mufaja`
--
ALTER TABLE `mufaja`
  ADD PRIMARY KEY (`film_id`,`mufaj_id`),
  ADD KEY `mufaj_id` (`mufaj_id`);

--
-- A tábla indexei `szerepel`
--
ALTER TABLE `szerepel`
  ADD PRIMARY KEY (`szinesz_id`,`film_id`),
  ADD KEY `film_id` (`film_id`);

--
-- A tábla indexei `szinesz`
--
ALTER TABLE `szinesz`
  ADD PRIMARY KEY (`id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `film`
--
ALTER TABLE `film`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT a táblához `mufaj`
--
ALTER TABLE `mufaj`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT a táblához `szinesz`
--
ALTER TABLE `szinesz`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `film`
--
ALTER TABLE `film`
  ADD CONSTRAINT `film_ibfk_1` FOREIGN KEY (`studio_nev`) REFERENCES `filmstudio` (`nev`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Megkötések a táblához `mufaja`
--
ALTER TABLE `mufaja`
  ADD CONSTRAINT `mufaja_ibfk_1` FOREIGN KEY (`film_id`) REFERENCES `film` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mufaja_ibfk_2` FOREIGN KEY (`mufaj_id`) REFERENCES `mufaj` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Megkötések a táblához `szerepel`
--
ALTER TABLE `szerepel`
  ADD CONSTRAINT `szerepel_ibfk_1` FOREIGN KEY (`szinesz_id`) REFERENCES `szinesz` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `szerepel_ibfk_2` FOREIGN KEY (`film_id`) REFERENCES `film` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
