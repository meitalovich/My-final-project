-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: יוני 07, 2023 בזמן 04:47 PM
-- גרסת שרת: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `book_store`
--

-- --------------------------------------------------------

--
-- מבנה טבלה עבור טבלה `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_price` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `product_image` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `qty` int(10) NOT NULL,
  `total_price` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `product_code` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- מבנה טבלה עבור טבלה `category`
--

CREATE TABLE `category` (
  `cat_id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- הוצאת מידע עבור טבלה `category`
--

INSERT INTO `category` (`cat_id`, `name`) VALUES
(1, 'Children\'s Books'),
(2, 'Science Fiction'),
(3, 'Adventure'),
(4, 'Classic Literature'),
(5, 'Fantasy'),
(6, 'Romance'),
(7, 'History'),
(8, 'Horror');

-- --------------------------------------------------------

--
-- מבנה טבלה עבור טבלה `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `name1` varchar(100) NOT NULL,
  `email` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `phone` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `address1` varchar(255) NOT NULL,
  `products` varchar(255) NOT NULL,
  `amount_paid` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- הוצאת מידע עבור טבלה `orders`
--

INSERT INTO `orders` (`id`, `name1`, `email`, `phone`, `address1`, `products`, `amount_paid`) VALUES
(65, 'reem', 'reemix.ib@gmail.com', '0509232702', '50  Agarwal Udyognagar, Sativli Rd, Waliv Village, Vasai (east)', 'Heidi, The Adventures of Tom Sawyer ', '49.9'),
(66, 'reem', 'reemix.ib@gmail.com', '0509232702', '50 ,, Agarwal Udyognagar, Sativli Rd, Waliv Village, Vasai (east)', 'Black Beauty', '19.9');

-- --------------------------------------------------------

--
-- מבנה טבלה עבור טבלה `products`
--

CREATE TABLE `products` (
  `productid` int(4) NOT NULL,
  `title` varchar(70) NOT NULL,
  `quanity` int(4) NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `price_old` decimal(8,2) NOT NULL,
  `book_image` varchar(255) NOT NULL,
  `author` varchar(255) DEFAULT NULL,
  `new_old` bit(1) NOT NULL DEFAULT b'0',
  `cat_id` int(11) DEFAULT NULL,
  `product_code` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `year_pub` int(4) NOT NULL,
  `status1` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- הוצאת מידע עבור טבלה `products`
--

INSERT INTO `products` (`productid`, `title`, `quanity`, `price`, `price_old`, `book_image`, `author`, `new_old`, `cat_id`, `product_code`, `year_pub`, `status1`) VALUES
(2, 'Heidi', 5, 40.50, 20.00, 'Heidi.jpeg', ' Johana Spyri', b'0', 1, '1001', 1881, b'1'),
(3, 'Dracula', 2, 32.90, 15.00, 'Dracula.jpeg', 'Bram Stoker', b'0', 8, '1004', 1967, b'1'),
(5, 'A Soldier\'s Sketches Under Fire', 10, 90.00, 15.00, 'soldier.jpg', 'Harold Harvey', b'0', 7, '1002', 1916, b'1'),
(8, 'Admiral Jellicoe\r\n', 2, 70.90, 20.00, 'Admiral.jpeg', 'Arthur Applin', b'0', 7, '1005', 1915, b'1'),
(9, 'Anna Karenina', 2, 50.90, 15.00, 'Anna Karenina.jpeg', 'Leo Tolstoy', b'1', 6, '1006', 1877, b'1'),
(11, 'Black Beauty', 12, 19.90, 0.00, 'Black Beauty.jpeg', ' Anna Sewell', b'1', 1, '1007', 2021, b'1'),
(12, 'Bullets & Billets', 15, 40.50, 10.00, 'Bullets & Billets.jpeg', 'Bruce Bairnsfather', b'0', 8, '1008', 1916, b'1'),
(13, 'THE COUNT OF MONTE CRISTO\r\n', 10, 45.00, 20.00, 'THE COUNT.jpeg', 'ALEXANDRE DUMAS', b'0', 3, '1009', 2020, b'1'),
(14, 'Emma', 5, 80.90, 30.00, 'Emma.jpeg', ' Jane Austen', b'1', 6, '1011', 1815, b'1'),
(15, 'A Short History of the World ', 7, 40.90, 20.00, 'Short History .jpeg\r\n', 'H. G. Wells.', b'1', 7, '1010', 2021, b'1'),
(16, 'IN THE DAYS OF THE COMET', 11, 90.90, 30.00, 'The Comet.jpeg', 'H. G. WELLS', b'1', 2, '1012', 2019, b'1'),
(17, 'THE INNOCENCE OF FATHER BROWN', 20, 52.90, 13.50, 'THE INNOCENCE.jpeg', 'G. K. CHESTERTON', b'0', 5, '1013', 1911, b'1'),
(18, 'THE INVISIBLE MAN', 13, 60.90, 25.90, 'THE INVISIBLE MAN.jpeg', 'H. G. WELLS', b'0', 2, '1014', 1879, b'1'),
(19, 'Jane Eyre', 13, 29.90, 0.00, 'Jane Eyre.jpeg', 'Charlotte Bronte', b'0', 6, '1015', 1847, b'1'),
(30, 'The Adventures of Tom Sawyer ', 13, 89.90, 15.50, 'The Adventures.jpeg', 'Mark Twain', b'0', 1, '1016', 1876, b'1'),
(31, 'Treasure Island', 13, 31.90, 0.00, 'Treasure Island.jpeg', 'Robert Louis Stevenson', b'0', 3, '1020', 1883, b'1'),
(32, 'Tarzan of the Apes', 13, 31.90, 13.50, 'tarazan.jpeg', 'Edgar Rice Burroughs', b'0', 3, '1021', 1912, b'1'),
(33, 'THE SECRET GARDEN', 13, 40.90, 15.00, 'THE SECRET GARDEN.jpeg', 'FRANCES HODGSON BURNETT', b'0', 4, '1022', 1911, b'1'),
(34, 'The Buried Temple\r\n', 13, 50.90, 23.00, 'The Buried Temple.jpeg', 'Maurice Maeterlinck', b'0', 4, '1023', 1902, b'1'),
(35, 'The Inner Beauty\r\n\r\n', 13, 70.90, 23.00, 'Inner.jpeg', 'Maurice Maeterlinck', b'0', 4, '1025', 1910, b'1'),
(39, 'The Life of the Bee\r\n', 13, 80.90, 25.90, 'The Life of the Bee.jpeg', 'Maurice Maeterlinck', b'0', 2, '1026', 1901, b'1'),
(40, 'The Story of Doctor Dolittle\r\n', 13, 40.00, 15.50, 'The Story of Doctor Dolittle.jpeg', 'Hugh Lofting', b'0', 5, '1030', 1920, b'1');

-- --------------------------------------------------------

--
-- מבנה טבלה עבור טבלה `reviews`
--

CREATE TABLE `reviews` (
  `review_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `review_text` text DEFAULT NULL,
  `review_date` timestamp NULL DEFAULT current_timestamp(),
  `rating_star` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- הוצאת מידע עבור טבלה `reviews`
--

INSERT INTO `reviews` (`review_id`, `product_id`, `user_id`, `review_text`, `review_date`, `rating_star`) VALUES
(89, 3, 7, 'ספר משעמם ', '2023-05-26 21:04:05', 1),
(90, 2, 7, 'Heartwarming and enchanting adventure!', '2023-06-05 21:06:41', 4),
(91, 11, 7, 'Emotional journey of resilience.', '2023-06-05 21:07:25', 5),
(92, 30, 7, 'Classic tale of boyhood mischief.', '2023-06-05 21:07:44', 4),
(93, 2, 11, 'A timeless classic for all ages.', '2023-06-05 21:09:17', 5),
(97, 11, 11, 'Beautifully written horse tale', '2023-06-05 21:10:17', 4),
(98, 30, 11, 'Entertaining and full of adventure', '2023-06-05 21:10:32', 5),
(100, 2, 18, 'Boring and uninspiring storyline.', '2023-06-05 21:11:42', 2),
(101, 11, 18, 'Touches your heart deeply.', '2023-06-05 21:11:58', 5),
(102, 30, 18, 'Mark Twain\'s timeless masterpiece.', '2023-06-05 21:12:12', 5),
(103, 2, 19, 'A must-read for nature lovers.', '2023-06-05 21:12:54', 5),
(104, 11, 19, 'Endearing and thought-provoking.', '2023-06-05 21:13:13', 5),
(105, 30, 19, 'Whimsical and nostalgic storytelling.', '2023-06-05 21:14:36', 3);

-- --------------------------------------------------------

--
-- מבנה טבלה עבור טבלה `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- הוצאת מידע עבור טבלה `users`
--

INSERT INTO `users` (`id`, `user_name`, `password`, `name`, `mail`) VALUES
(7, 'reem', '123', 'reem', ''),
(11, 'מיטל', '123', 'מיטל מנדלוביץ', ''),
(18, 'mickey1', '123', 'mickey', 'reemix.ib@gmail.com'),
(19, 'iyad', 'iyad', 'iyad', 'iyad@gmail.com');

--
-- Indexes for dumped tables
--

--
-- אינדקסים לטבלה `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- אינדקסים לטבלה `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cat_id`);

--
-- אינדקסים לטבלה `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- אינדקסים לטבלה `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`productid`),
  ADD KEY `product_code` (`product_code`);

--
-- אינדקסים לטבלה `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- אינדקסים לטבלה `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=232;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `productid` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- הגבלות לטבלאות שהוצאו
--

--
-- הגבלות לטבלה `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`productid`),
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
