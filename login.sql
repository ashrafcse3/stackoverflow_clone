-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 12, 2019 at 05:16 AM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `login`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `id` int(15) NOT NULL,
  `user_id` int(15) NOT NULL,
  `post_id` int(15) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`id`, `user_id`, `post_id`, `description`) VALUES
(1, 27, 4, 'I just made a performance test between storing in Array, and Nested Object as well as Object with string keys. The result is surprising to me. The fastest is Object with string keys.'),
(2, 29, 4, 'where the bigMap (containing the 3d structure) contains Map values for each y and z slice, and each of those has Map keys corresponding to each z slice, and each z-slice Map has values containing the information at each coordinate.\r\n\r\nBut while this is a possibility, your idea of an object or Map indexed by comma-joined coordinates is perfectly fine and probably more understandable at a glance IMO.\r\n\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(15) NOT NULL,
  `cat_title` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `cat_title`) VALUES
(1, 'Web Developing'),
(2, 'Artificial Intelligence'),
(3, 'Language Learning'),
(4, 'Travel');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(15) NOT NULL,
  `user_id` int(15) NOT NULL,
  `source` varchar(15) NOT NULL,
  `source_id` int(15) NOT NULL,
  `description` varchar(255) NOT NULL,
  `time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `source`, `source_id`, `description`, `time`) VALUES
(1, 27, 'post', 2, 'Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been.', 0),
(2, 31, 'post', 4, 'scrambled it to make a type specimen book. It has survived not only five centuries, b', 0),
(3, 32, 'post', 4, 'maining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and m', 0),
(4, 33, 'answer', 1, 'JavaScript ES6 introduced Map implemented with hash table. Since hash table look up time is on average O(1), for random accessed data, Map seems to be a good choice for data storage.', 0),
(5, 34, 'answer', 2, ' I want to use a hash table because there may be \"holes\" in the maps and tiles may be created randomly in the middle of nowhere.', 0),
(11, 28, 'post', 4, 'hello', 1549940006),
(12, 28, 'post', 4, 'You answer is not hundred percent accurate', 1549941443),
(13, 28, 'post', 4, 'This post on 9.54', 1549943654),
(14, 28, 'post', 4, 'This post on 10.09', 1549944594),
(15, 28, 'post', 4, 'This post on 10.09 new', 1549944602),
(17, 28, 'post', 4, 'Just insert the data to the database through ajax', 1549944725),
(18, 28, 'post', 4, 'Insert the data on 10.14', 1549944901);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(15) NOT NULL,
  `user_id` int(15) NOT NULL,
  `cat_id` int(15) NOT NULL,
  `title` varchar(30) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `cat_id`, `title`, `description`) VALUES
(1, 27, 1, 'Why do we use it?', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.'),
(2, 31, 2, 'Where can I get some?', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.'),
(3, 32, 3, 'Where does it come from?', 'orem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with deskt'),
(4, 28, 4, 'What is Lorem Ipsam?', 'orem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with deskt');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(15) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(256) NOT NULL,
  `hash` varchar(100) NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `hash`, `active`) VALUES
(27, 'Ashraful Alam', 'ashrafcse3@gmail.com', '$2y$10$1ISqmivYUVJnZl5Q6YLfc.B.H701tb7CkKLDD8ws5/tkyhKjNap1e', 'aba54c23d97bf1321a4275e21d615112', 1),
(28, 'AA', 'noid@gmail.com', '$2y$10$hLqKkXiQJ3njMELubj48D.SiED4SrzjI/yHXackPPJijTMCRAeSP2', 'bd2319431f3e50192180e12334eb52da', 1),
(29, 'Tufayel Alam', 'saleh@gmail.com', '$2y$10$c/TC.rPEwOJSdCZJUC.LlOeO8jMRdv/rxoMwfvLD3sbpyv92uYZ8a', '654a15a7b10edf676cbd37e00815ae89', 1),
(30, 'AA', 'user@user.com', '$2y$10$GwXTYBnkcDMl4JN6SuyVpOUYQ4AJvyhR0VY/maGBgXHC5EPAKJeIO', '2b0fd97cf4bbb9a800b9004e5961bb0d', 0),
(31, 'Adnan', 'adnan@gmail.com', '$2y$10$z57eCijYtBp5qXGHtseV7uIN0r.dbcDZdu9APTR/QAP6kjZqmQyjW', '373eb24e9055ded5b02698f7c7f7d4b8', 1),
(32, 'nazmul', 'Nazmul@gmail.com', '$2y$10$yQJMw2JYgSt2aZnyWPcx8.Kp9Ta/HTc6hoOp/BR8FLswHDQM8tA.e', '8969a7f7fe8b1fbc83fe4252322bd640', 1),
(33, 'Shuvo', 'shuvo@gmail.com', '$2y$10$Pxr4ca2QU0xT8aXWBz07Hu6vFzjhEsSonjkTXWV4NpZ.fr6in0bU.', '7125a4273f9840b9cebb0a440265fe77', 0),
(34, 'jamal', 'jamal@gmail.com', '$2y$10$hHe9wJsWJn7j7HIEVenJEOflhFaoD4mTQ/8pqN3HUL.7VIEKTiIOy', '35c1124dd508ead6eb8c4aee9a7f5d71', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
