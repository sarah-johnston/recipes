-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 22, 2016 at 10:48 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 7.0.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `recipes`
--

-- --------------------------------------------------------

--
-- Table structure for table `collections`
--

CREATE TABLE `collections` (
  `collection_id` int(11) NOT NULL,
  `collection_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `collections`
--

INSERT INTO `collections` (`collection_id`, `collection_name`) VALUES
(1, 'Aberystwyth chocolate cake'),
(21, 'Fun Timez');

-- --------------------------------------------------------

--
-- Table structure for table `ingredients`
--

CREATE TABLE `ingredients` (
  `recipe_ingredient_id` int(11) NOT NULL,
  `recipe_ingredient` tinytext NOT NULL,
  `recipe_ingredient_plural` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ingredients`
--

INSERT INTO `ingredients` (`recipe_ingredient_id`, `recipe_ingredient`, `recipe_ingredient_plural`) VALUES
(1, 'self-raising flour', ''),
(2, 'caster sugar', ''),
(3, 'margarine', ''),
(4, 'egg', 'eggs'),
(5, 'cocoa', ''),
(6, 'icing sugar', ''),
(7, 'butter', ''),
(8, 'water', ''),
(9, 'boiling water', ''),
(15, 'pancake mix', ''),
(17, 'smarties', 'smarti'),
(18, 'cocaine', 'cocaines'),
(19, 'ice water', ''),
(20, 'salad', 'salads'),
(21, 'octopus', 'octopuses'),
(22, 'tomato', 'tomatoes'),
(23, 'carrot', 'carrots'),
(26, 'onion', 'onions'),
(43, 'guy', 'guys');

-- --------------------------------------------------------

--
-- Table structure for table `recipes`
--

CREATE TABLE `recipes` (
  `recipe_id` int(11) NOT NULL,
  `recipe_name` tinytext NOT NULL,
  `recipe_method` mediumtext NOT NULL,
  `recipe_serves_id` int(11) NOT NULL,
  `recipe_time_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `recipes`
--

INSERT INTO `recipes` (`recipe_id`, `recipe_name`, `recipe_method`, `recipe_serves_id`, `recipe_time_id`) VALUES
(2, 'Aberystwyth chocolate icing', '1. Melt butter, water + sugar together over a low heat.\r\n2. Pour melted butter mixture onto cocoa and icing sugar, and mix well.\r\n3. Leave to cool completely.', 0, 0),
(3, 'Aberystwyth chocolate cake', '1. Preheat the oven to 190c or gas mark 5. Grease and line two cake tins.\r\n2. Put the butter and sugar into a bowl and mix until light and creamy.\r\n3. Beat in the eggs with a little of the flour.\r\n4. Sieve in the remaining flour, and fold into the mixture.\r\n5. Mix the cocoa and boiling water, and stir into the cake mixture.\r\n6. Put even amounts of the mixture into the tins. Bake for about 25 minutes.', 0, 0),
(6, 'Pancakes', 'Mix it, make it, pour it, flip it.', 0, 0),
(7, 'Boiled Egg', 'Add ingredients, wait 5 minutes, separate ingredients. Serve egg.', 0, 0),
(8, 'Napalm', 'Add naphthenic acid\r\nAdd palmitic acid\r\nAdd petrol\r\nBurn people.', 0, 0),
(17, 'Guy stop these recipies', 'OD and stop adding new recipies.', 0, 0),
(23, 'Party', 'Mix and enjoy', 0, 0),
(24, 'Octopus salad', 'Give the octopus a nice salad.\r\nEat both.', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `recipe_collections`
--

CREATE TABLE `recipe_collections` (
  `collection_id` int(11) NOT NULL,
  `recipe_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `recipe_collections`
--

INSERT INTO `recipe_collections` (`collection_id`, `recipe_id`) VALUES
(1, 2),
(1, 3),
(21, 6),
(21, 7),
(21, 24);

-- --------------------------------------------------------

--
-- Table structure for table `recipe_ingredients`
--

CREATE TABLE `recipe_ingredients` (
  `recipe_id` int(11) NOT NULL,
  `recipe_ingredient_id` int(11) NOT NULL,
  `recipe_ingredient_amount` float DEFAULT NULL,
  `unit_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `recipe_ingredients`
--

INSERT INTO `recipe_ingredients` (`recipe_id`, `recipe_ingredient_id`, `recipe_ingredient_amount`, `unit_id`) VALUES
(28, 1, 0, 0),
(29, 1, 0, 0),
(30, 1, 0, 0),
(2, 2, 2, 2),
(3, 2, 6, 2),
(3, 3, 6, 2),
(7, 4, 1, 13),
(7, 9, 1, 14),
(8, 9, 1, 14),
(6, 15, 1000, 1),
(23, 17, 3, 0),
(17, 18, 0, 1),
(23, 18, 1, 15),
(24, 20, 1, 0),
(24, 21, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `recipe_serves`
--

CREATE TABLE `recipe_serves` (
  `recipe_serves_id` int(11) NOT NULL,
  `recipe_serves` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `recipe_time`
--

CREATE TABLE `recipe_time` (
  `recipe_time_id` int(11) NOT NULL,
  `recipe_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `unit_id` int(11) NOT NULL,
  `unit_name` tinytext NOT NULL,
  `unit_type_id` int(11) NOT NULL,
  `unit_to_si_amount` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`unit_id`, `unit_name`, `unit_type_id`, `unit_to_si_amount`) VALUES
(1, 'g', 2, 0.001),
(2, 'oz', 2, 0.0283495),
(3, 'tbsp', 1, 0.0177582),
(4, 'tsp', 1, 0.00591939),
(5, 'heaped tbsp', 1, 0),
(7, 'heaped tsp', 1, NULL),
(13, 'quantity', 0, 0),
(14, 'litre', 0, 1),
(15, 'bucket', 0, 1),
(17, 'pint', 0, 0),
(31, 'cup', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `unit_types`
--

CREATE TABLE `unit_types` (
  `unit_type_id` int(11) NOT NULL,
  `unit_type` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `unit_types`
--

INSERT INTO `unit_types` (`unit_type_id`, `unit_type`) VALUES
(1, 'volume'),
(2, 'mass');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `collections`
--
ALTER TABLE `collections`
  ADD PRIMARY KEY (`collection_id`);

--
-- Indexes for table `ingredients`
--
ALTER TABLE `ingredients`
  ADD PRIMARY KEY (`recipe_ingredient_id`);

--
-- Indexes for table `recipes`
--
ALTER TABLE `recipes`
  ADD PRIMARY KEY (`recipe_id`);

--
-- Indexes for table `recipe_collections`
--
ALTER TABLE `recipe_collections`
  ADD PRIMARY KEY (`collection_id`,`recipe_id`);

--
-- Indexes for table `recipe_ingredients`
--
ALTER TABLE `recipe_ingredients`
  ADD PRIMARY KEY (`recipe_ingredient_id`,`recipe_id`);

--
-- Indexes for table `recipe_serves`
--
ALTER TABLE `recipe_serves`
  ADD PRIMARY KEY (`recipe_serves_id`);

--
-- Indexes for table `recipe_time`
--
ALTER TABLE `recipe_time`
  ADD PRIMARY KEY (`recipe_time_id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`unit_id`);

--
-- Indexes for table `unit_types`
--
ALTER TABLE `unit_types`
  ADD PRIMARY KEY (`unit_type_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `collections`
--
ALTER TABLE `collections`
  MODIFY `collection_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `ingredients`
--
ALTER TABLE `ingredients`
  MODIFY `recipe_ingredient_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT for table `recipes`
--
ALTER TABLE `recipes`
  MODIFY `recipe_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `recipe_serves`
--
ALTER TABLE `recipe_serves`
  MODIFY `recipe_serves_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `recipe_time`
--
ALTER TABLE `recipe_time`
  MODIFY `recipe_time_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `unit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `unit_types`
--
ALTER TABLE `unit_types`
  MODIFY `unit_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
