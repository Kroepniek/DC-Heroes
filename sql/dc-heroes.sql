-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Czas generowania: 05 Lut 2019, 22:08
-- Wersja serwera: 5.7.19
-- Wersja PHP: 7.1.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `dc-heroes`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `hero`
--

CREATE TABLE `hero` (
  `heroId` int(3) NOT NULL COMMENT 'the unique heroId used as a parameter in the URL and fetched by PHP using the $_GET superblobal variable',
  `heroName` varchar(50) NOT NULL COMMENT 'the name of the hero, just a string',
  `heroDescription` text NOT NULL COMMENT 'some information of the hero, just a string',
  `heroPower` text NOT NULL,
  `heroImage` varchar(50) NOT NULL COMMENT 'the image of the hero is strored as a string. The actual image is strored on the server. Use the string as the source of the HTML img-tag.',
  `teamId` int(3) NOT NULL COMMENT 'this is the teamId. Used as a referenc to the team table.'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `hero`
--

INSERT INTO `hero` (`heroId`, `heroName`, `heroDescription`, `heroPower`, `heroImage`, `teamId`) VALUES
(1, 'Aquaman', 'Aquaman, also known as Arthur Curry and Orin, is a superhero and the ruler of the seas. As the king of Atlantis and other undersea territories, he technically controls most of the planet.', 'His abilities include super-strength, durability, super-speed, staying underwater indefinitely, and telepathy, which he uses to communicate with sea-life.', 'aquaman.jpg', 1),
(2, 'Batman', 'Batman is the super-hero protector of Gotham City, a man dressed like a bat who fights against evil and strikes terror into the hearts of criminals everywhere.', 'Although Batman possesses no super-human powers, he is one of the world\'s smartest men and greatest fighters. His physical prowess and technical ingenuity make him an incredibly dangerous opponent.', 'batman.jpg', 1),
(3, 'The Flash', 'The Flash is the fastest man alive. He is the protector of Central City and Keystone City, fighting against evil using his super-speed and a dedicated sense of heroism.', 'His legacy, the Flash Family, spans throughout history tapping into the enigmatic Speed Force to gain their powers.', 'flash.jpg', 1),
(4, 'Superman', 'Superman, also known as the Man of Steel, is one of the most powerful superheroes in the DC Universe.', 'His abilities include incredible super-strength, super-speed, invulnerability, freezing breath, flight, and heat-vision. ', 'superman.jpg', 1),
(5, 'Wonder Woman', 'Wonder Woman is an Amazon warrior princess and one of the most powerful superheroes in the DC Universe. The daughter of Hippolyta, she was given power by the Gods to fight against evil in all its forms.', 'Wonder Woman fights crime and acts as a positive role model for women everywhere. Her equipment includes the Lasso of Truth, magic gauntlets, and an invisible jet.', 'wonderwoman.jpg', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `rating`
--

CREATE TABLE `rating` (
  `ratingId` int(3) NOT NULL COMMENT 'unique rating is, auto incremented',
  `heroId` int(3) NOT NULL COMMENT 'the heroId used as reference to the hero table, can''t be unique in thie table',
  `rating` int(3) NOT NULL COMMENT 'rating is defined as an integer from 0 (min) to 10 (max)',
  `ratingDate` int(5) NOT NULL COMMENT 'the date of this rating. Dates are presented as an integer (timestamp) and displayed as a human readable date and time string using the PHP strftime() function',
  `ratingReview` text NOT NULL COMMENT 'a textual review added by the user\\nthe form where the user can rate the hero by using stars (radio-buttons)'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `team`
--

CREATE TABLE `team` (
  `teamId` int(3) NOT NULL COMMENT 'unique teamId can be used as a parameter in the URL and fetched using the $_GET variable',
  `teamName` varchar(50) NOT NULL COMMENT 'team name, just an ordinary string',
  `teamDescription` text NOT NULL COMMENT 'team description, just a string',
  `teamImage` varchar(100) NOT NULL COMMENT 'team image, stored as a string and used with the source of the HTML-tag'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `team`
--

INSERT INTO `team` (`teamId`, `teamName`, `teamDescription`, `teamImage`) VALUES
(1, 'Justice League', 'Greater than the sum of their awe-inspiring parts, the Justice League handles threats too massive for any single hero. Made up of the World’s Greatest Super Heroes, their membership inflates and contracts around each new threat, but the core line-up is known as the Big Seven: Superman, the most powerful hero in the world; Batman, the apex of physical and mental human achievement; Wonder Woman, the Amazon’s princess and greatest warrior; Green Lantern, an intergalactic cop armed with his own power ring; the super-fast Flash; Aquaman, King of the Seven Seas; and Cyborg, a half-man/half-robot outfitted with the world’s most advanced technology.\r\n', 'justice-league.png'),
(2, 'Flash Family', 'The Flash Family is an informal group centered around the legacy of The Flash, a famous speedster and hero who protects Central City and Keystone City. Six persons have taken up the mantle of the Flash: Jay Garrick, Barry Allen, Wally West, Jesse Chambers, Bart Allen and the Chinese rival Avery Ho.', 'flash-family.png'),
(3, 'Batman & Robin', 'The team of Batman and Robin, also known as \"The Dynamic Duo\"; is one of DC Comics\' oldest crime-fighting partnerships. The debut of this team was ushered by the introduction of Robin, the Boy Wonder as the sidekick and crime fighting partner of Batman in Detective Comics #38. While there have been several iterations of the team through the history of DC, the mainstream versions of the team are often considered the most relevant.', 'batman-robin.png'),
(4, 'Teen Titans', 'Made up of familiar young heroes and superpowered youths such as Raven, Starfire, and Beast Boy, the Titans are first and foremost an extended family of friends. They help each other cope with the pressure of being the most powerful adolescents on the planet.', 'teen-titans.png'),
(5, 'Superman Family', 'In his inception, Superman was the only super-hero in existence. Although eventually more heroes showed up, some members of his supporting cast -usually Lois Lane- gained temporary powers and he first teamed up with the Batman Family in 1941, he was a loner hero for many years.', 'superman-family.png');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `hero`
--
ALTER TABLE `hero`
  ADD PRIMARY KEY (`heroId`);

--
-- Indeksy dla tabeli `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`ratingId`);

--
-- Indeksy dla tabeli `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`teamId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `hero`
--
ALTER TABLE `hero`
  MODIFY `heroId` int(3) NOT NULL AUTO_INCREMENT COMMENT 'the unique heroId used as a parameter in the URL and fetched by PHP using the $_GET superblobal variable', AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT dla tabeli `rating`
--
ALTER TABLE `rating`
  MODIFY `ratingId` int(3) NOT NULL AUTO_INCREMENT COMMENT 'unique rating is, auto incremented', AUTO_INCREMENT=267;

--
-- AUTO_INCREMENT dla tabeli `team`
--
ALTER TABLE `team`
  MODIFY `teamId` int(3) NOT NULL AUTO_INCREMENT COMMENT 'unique teamId can be used as a parameter in the URL and fetched using the $_GET variable', AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
