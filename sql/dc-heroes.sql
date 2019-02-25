-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Czas generowania: 25 Lut 2019, 13:52
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
(5, 'Wonder Woman', 'Wonder Woman is an Amazon warrior princess and one of the most powerful superheroes in the DC Universe. The daughter of Hippolyta, she was given power by the Gods to fight against evil in all its forms.', 'Wonder Woman fights crime and acts as a positive role model for women everywhere. Her equipment includes the Lasso of Truth, magic gauntlets, and an invisible jet.', 'wonderwoman.jpg', 1),
(6, 'August Heart', 'August Heart is the detective partner of Barry Allen. August was the only witness to Barry\'s accident, that turned him into the Flash. While going after a criminal organization called the Black Hole, August was struck by lightning during a Speed Force storm in Central City.', 'August creates his own costume and becomes Barry\'s partner, also wishing to use his powers to solve his brother\'s murder. After defeating Black Hole, they witness another Speed Force storm strike more citizens, turning them into Speedsters.', 'august-heart.jpg', 2),
(7, 'Avery Ho', 'Avery Ho is the Flash of China and a member of the JLC. She received her powers from the Speed Force Storm of Central City.', 'After the Speed Force storm in Central City, Avery gained access to the Speed Force, a mysterious cosmic force that pushes time itself forward. Avery is capable of moving at incredible superhuman speeds. Avery\'s agility, balance, and bodily coordination are enhanced to superhuman levels. This allows her to easily maneuver while moving at superhuman speed.', 'avery-ho.jpg', 2),
(8, 'Bar Torr', 'Bar Torr was an inmate sent back in time with no apparent memories. In the early 21st Century, he used his super-speed as the hero Kid Flash, one of the members of the Teen Titans.', 'As a speedster, Bar possesses reflexes that are far greater than those of any human. Bar can heal at rates much faster than normal humans, presumably due to his speed increasing his metabolism. Bar generates electrical energy when running.', 'bar-torr.jpg', 2),
(9, 'Barry Allen', 'As a child, Barry Allen\'s life was uprooted forever by the death of his mother. The police arrested his father for the crime, but Barry had seen a strange man with inhuman powers in a yellow suit commit the deed.', 'After being hit by the dark matter lightning from the particle accelerator explosion and exposed to various chemicals, Barry\'s DNA was altered and his cells were supercharged with enormous amounts of electricity, augmenting his physiology, and granting him access to the extradimensional energy source called the Speed Force.', 'barry-allen.jpg', 2),
(10, 'Eobard Thawne', 'Professor Eobard \"Zoom\" Thawne, also known as Reverse-Flash, is the arch-nemesis of the Flash. He is a twisted sociopathic criminal, with a brilliant mind and super-speed, that was born in the 25th Century and travels through time to do battle with his most hated enemy. He has also been a member of the Secret Society of Super-Villains.', 'Originally a conduit of the positive Speed Force, Eobard used his power to create his own negative Speed Force. Eobard can tap into it as other speedsters can with the normal Speed Force. Through this, he has the ability to move at incredible speeds, as well as access other abilities the normal Speed Force does not grant.', 'eobard-thawne.jpg', 2),
(11, 'Bruce Wayne', 'Batman has been Gotham\'s protector for decades, CEO of Wayne Enterprises, Patriarch of the Bat Family and veteran member of the Justice League. is a superhero co-created by artist Bob Kane and writer Bill Finger and published by DC Comics.', 'He does not possess any superpowers; he makes use (to the best that he can) of intellect, detective skills, science and technology, wealth, physical prowess, and intimidation in his war on crime.', 'batman.jpg', 3),
(12, 'Cassandra Cain', 'A child prodigy; Cassandra Cain was conceived and trained from birth with the intention of creating the perfect bodyguard for Ra\'s al Ghul.', 'Cassandra also reappears in Robin, having done some business with Dodge, a wanna-be superhero with teleportation powers, who was injured and put into a coma when he interfered on one of Robin\'s cases. Having awoken, Dodge seeks revenge against Robin and is approached by Cassandra to steal a drug which gives humans metahuman strength for her, in exchange for money.', 'cassandra-cain.jpg', 3),
(13, 'Claire Clover', 'Claire Clover is a metahuman, operating in Gotham City. Undergoing experimental treatment with her older brother, Hank, that granted them superpowers, they operating as superheroes aliases of Gotham and Gotham Girl.', 'However, whilst using them, they would draw off their life span, meaning they could only live for two years with similar powers as the man of steel or an hour with the powers of a god. After undergoing the therapy, they began operating as superheroes under the aliases of \"Gotham\" and \"Gotham Girl\".', 'claire-clover.jpg', 3),
(14, 'Tim Drake', 'Tim Drake (also known as Tim Wayne) is a fictional comic book superhero from the DC Comics universe. As the third Robin in the Batman comics, he served as Batman\'s sidekick, and he is a superhero in his own right. He currently uses the superhero identity of Red Robin.', 'During one adventure where a pre-teen boy was given god-like powers, Robin, Superboy and Impulse joined forces to defeat him. The boys work so well together that they created their own team of heroes called Young Justice. Robin acted as the leader of the team (with Red Tornado acting as team mentor) until the Imperiex War.', 'tim-drake.jpg', 3),
(15, 'Barbara Gordon', 'Barbara \"Barb\" Gordon is a fictional character appearing in comic books published by DC Comics and in related media, created by Gardner Fox and Carmine Infantino. From 1967 to 1988, she was the superheroine Batgirl; from 1989 to November, 2011, she had been known as Oracle.', 'Oracle overpowers Brainiac and expels him from her body, the advanced virus delivered by him remains despite his absence. The virus steadily causes cybernetic attachments to sprout all over her body. Oracle develops cyberpathic powers that allow her to psychically interact with computer information systems.', 'barbara-gordon.jpg', 3),
(16, 'Starfire', 'Starfire is an alien super-hero with powers of flight and energy projection. Born a princess on the planet Tamaran, she escaped execution at the hands of her older sister Blackfire and traveled to Earth.', 'Meeting the Teen Titans, she became a charter member and stayed with the team for most of her career. Her culture\'s different standards of intimacy cause her to be extremely open and sexually liberated by human standards.', 'starfire.jpg', 4),
(17, 'Raven', 'A dark, moody character, Raven is the half-breed daughter of a human mother named Angela Roth (also known as Arella) and the demon overlord Emperor Trigon.', 'Raven, or Rachel Roth, has been a prominent member of the Teen Titans. Raven is a tele-empathetic, she can teleport, and send out her Soul-Self, which can fight physically, manifest as a force field, manipulate objects and others as with telekinesis, as well as act as Raven\'s eyes and ears away from her body.', 'raven.jpg', 4),
(18, 'Nightwing', 'Nightwing is a superhero legacy name associated with the planet Krypton and the Batman Family, usually working alongside a sidekick and partner named Flamebird.', 'Originally it was an alias used by a mysterious Kryptonian figure, and later adopted by Superman and Van-Zee in the bottle city of Kandor. Later the name was adopted by the human vigilante Dick Grayson, taking it after he had graduated from the position of Batman\'s sidekick Robin.', 'nightwing.jpg', 4),
(19, 'Robin', 'Robin is the position of Batman\'s sidekick and crimefighting partner, a teenage vigilante who patrols Gotham City armed with intensive martial arts abilities and a number of high-tech gadgets.', 'The original Robin was Dick Grayson, a young circus acrobat whose parents had been killed by mobsters. Bruce Wayne witnessed the murders and took him in as his legal ward to guide him through the tragedy and help him find direction. Grayson would eventually outgrow his position and take the name Nightwing for many years, before eventually becoming a replacement Batman himself. ', 'robin.jpg', 4),
(20, 'Beast boy', 'Beast Boy, also known as Garfield Logan and Changeling, is a superhero with the power to shape-shift into members of the animal kingdom. He is a regular member of the Doom Patrol and the Teen Titans.', 'His special abilities make him a fearsome and unpredictable opponent, although he has a very easy-going nature. Garfield received his powers when an untested serum was used to protect him from a virus transmitted through animal bite. ', 'beast-boy.jpg', 4),
(21, 'Superman', 'Superman is a superhero published by DC Comics since 1938. An alien named Kal-El from the destroyed planet Krypton. he was sent to Earth and raised as Clark Kent by human foster parents, Martha and Jonathan Kent.', 'Superman possesses the ability to fly under his own power, incredible strength and near invulnerability, as he can only be harmed by the element Kryptonite.', 'superman.jpg', 5),
(22, 'Lois Lane', 'Lois Lane is a reporter and Superman\'s Superman\'s chief romantic interest (and in the DC continuity his wife). She is also known as \"superwoman\". She is a journalist for the Metropolis newspaper, The Daily Planet.', 'Aspects of Lois\' personality have varied over the years (depending on the comic writers handling of the character and American social attitudes toward women at the time) but in most incarnations she has been depicted as a determined, strong-willed person.', 'lois-lane.jpg', 5),
(23, 'Supergirl', 'Supergirl is the superhero name of Kara Zor-El, cousin to Superman. She was created by writer Otto Binder and designed by artist Al Plastino in 1959, and she first appeared in Action Comics, in whose first issue Superman himself was introduced.', 'Supergirl possesses Kryptonian standard abilities. She is incredibly strong, fast and nigh invulnerable, and possesses the capability to fly.', 'supergirl.jpg', 5),
(24, 'Jonathan Samuel Kent', 'Jonathan Kent is the firstborn son of Kryptonian superhero Superman and news reporter Lois Lane.', 'Jon\'s able to absorb the light and radiation of stars & suns, mainly those of the yellow stellar spectrum.', 'jonathan-samuel-kent.jpg', 5),
(25, 'Catherine Grant', 'Catherine Grant, most commonly known as \"Cat\", is a reporter for the Daily Planet newspaper.', 'She is the gossip columnist, and is very fond of badmouthing Supergirl in her articles.', 'catherine-grant.jpg', 5);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `rating`
--

CREATE TABLE `rating` (
  `ratingId` int(3) NOT NULL COMMENT 'unique rating is, auto incremented',
  `heroId` int(3) NOT NULL COMMENT 'the heroId used as reference to the hero table, can''t be unique in thie table',
  `rating` int(3) NOT NULL COMMENT 'rating is defined as an integer from 0 (min) to 10 (max)',
  `ratingDate` datetime(5) NOT NULL COMMENT 'the date of this rating. Dates are presented as an integer (timestamp) and displayed as a human readable date and time string using the PHP strftime() function',
  `ratingReview` text NOT NULL COMMENT 'a textual review added by the user\\nthe form where the user can rate the hero by using stars (radio-buttons)'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `rating`
--

INSERT INTO `rating` (`ratingId`, `heroId`, `rating`, `ratingDate`, `ratingReview`) VALUES
(1, 1, 6, '2019-02-22 12:17:21.00000', 'Zajebisty koleszka.'),
(2, 1, 6, '2019-02-25 08:48:19.00000', 'gfhj'),
(3, 1, 1, '2019-02-25 08:48:36.00000', '25252'),
(4, 1, 4, '2019-02-25 10:10:27.00000', 'dsadsad'),
(5, 1, 10, '2019-02-25 13:34:07.00000', 'Kocham cie kurwa'),
(6, 1, 1, '2019-02-25 13:47:29.00000', 'Kuraz'),
(7, 3, 10, '2019-02-25 13:47:43.00000', 'Dobry koleka');

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
(1, 'Justice League', 'Greater than the sum of their awe-inspiring parts, the Justice League handles threats too massive for any single hero.', 'justice-league.png'),
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
  MODIFY `heroId` int(3) NOT NULL AUTO_INCREMENT COMMENT 'the unique heroId used as a parameter in the URL and fetched by PHP using the $_GET superblobal variable', AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT dla tabeli `rating`
--
ALTER TABLE `rating`
  MODIFY `ratingId` int(3) NOT NULL AUTO_INCREMENT COMMENT 'unique rating is, auto incremented', AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT dla tabeli `team`
--
ALTER TABLE `team`
  MODIFY `teamId` int(3) NOT NULL AUTO_INCREMENT COMMENT 'unique teamId can be used as a parameter in the URL and fetched using the $_GET variable', AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
