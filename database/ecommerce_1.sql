-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 06, 2021 at 02:51 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(3) NOT NULL,
  `admin_img` text NOT NULL,
  `admin_name` varchar(255) NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `admin_password` varchar(255) NOT NULL,
  `login_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `admin_img`, `admin_name`, `admin_email`, `admin_password`, `login_date`) VALUES
(23, 'images.jpg', 'Ali obeidat', 'Aliobeidat03@gmail.com', 'asdasd123', '2021-12-05'),
(24, 'user1.png.png', 'reem bani ali', 'reem@gmail.com', 'Reem@123', '2021-12-06');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(3) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_img` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `category_img`) VALUES
(12, 'Coats and Jackets', 'ja1.png'),
(13, 'Jeans', 'j1.png'),
(14, 'T-Shirt', 'tshirt5.png'),
(15, 'Shoes', '5.png'),
(16, 'Pants', 'pants4.png'),
(17, 'Accessories', '1.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(3) NOT NULL,
  `user_id` int(3) NOT NULL,
  `prodcut_id` int(3) NOT NULL,
  `comment_content` text NOT NULL,
  `comment_date` date NOT NULL,
  `comment_status` varchar(255) NOT NULL DEFAULT 'draft'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(3) NOT NULL,
  `user_id` int(3) NOT NULL,
  `order_status` varchar(255) NOT NULL,
  `order_total_amount` int(11) NOT NULL,
  `order_date` date NOT NULL,
  `product_quantity` int(3) NOT NULL,
  `city_name` varchar(255) NOT NULL,
  `street_name` varchar(255) NOT NULL,
  `phone_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `order_status`, `order_total_amount`, `order_date`, `product_quantity`, `city_name`, `street_name`, `phone_number`) VALUES
(3, 5, 'Canceled', 100, '2021-12-01', 10, 'irbid', ' asdasd ', 799161600),
(4, 6, 'Order Placed', 100, '2021-12-05', 1, 'اربد', 'al rafeed', 799161600);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(3) NOT NULL,
  `product_name` varchar(1000) NOT NULL,
  `product_description` text NOT NULL,
  `product_m_img` text NOT NULL,
  `product_sub1_img` text NOT NULL,
  `product_sub2_img` text NOT NULL,
  `product_sub3_img` text NOT NULL,
  `product_price` varchar(255) NOT NULL,
  `product_price_on_sale` int(11) NOT NULL,
  `sale_status` varchar(255) NOT NULL,
  `product_featured` varchar(255) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_tags` varchar(255) NOT NULL,
  `product_sizes` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_description`, `product_m_img`, `product_sub1_img`, `product_sub2_img`, `product_sub3_img`, `product_price`, `product_price_on_sale`, `sale_status`, `product_featured`, `product_quantity`, `category_id`, `product_tags`, `product_sizes`) VALUES
(14, 'Rokka & Rolla', 'Rokka&Rolla Men\'s Light Puffer Vest Jacket-Packable Sleeveless Warm Winter Coat', 'ja1.png', 'ja1_sub1.png', 'ja1_sub2.png', 'ja1_sub3.png', '49.99', 35, 'on', 'on', 15, 12, 'Rokka,Rolla,jacket,Jacket,Jackets,Coat,coat,coats', 'S,M,L'),
(21, 'Alpine Swiss', 'Alpine Swiss Luke Wool Mens Tailored 37 Walker Jacket Top Coat Car Coat\r\n', 'ja2.png', 'ja2_sub1.png', 'ja2_sub2.png', 'ja2_sub3.png', ' 165.00', 159, 'on', 'On', 15, 12, 'Alpine, Swiss,Men, Jacket,Coat, coat, jacket,jackets', 'S,M'),
(22, 'Landing Leathers ', ' Landing Leathers Men WWII Suede Leather Bomber Jacket (Regular and Tall)', 'ja3.png', 'ja3_sub1.png', 'ja3_sub2.png', 'ja3_sub3.png', '249.99', 210, 'on', 'On', 12, 12, 'jacket,Jacket,Jackets,Coat,coat,coats', 'S,L,M'),
(23, ' Wrangler', 'Wrangler Mens Regular Fit Jeans', 'j1.png', 'j1_sub1.png', 'j1_sub2.png', 'j1_sub3.png', '16.95', 13, 'on', 'On', 11, 13, 'jeans,Jeans', '30,32,34'),
(24, 'Hollywood Jeans', 'Hollywood Mens Active Flex Slim Straight Jeans, Waist Sizes 30- 38, Mens Jeans Slim Straight Fit', 'j2.png', 'j2_sub1.png', 'j2_sub2.png', 'j2_sub3.png', '10.00', 9, 'on', 'Off', 6, 13, 'Hollywood,Jeans,jeans', '30,32,34,36,38'),
(25, 'Wrangler Jeans', 'Wrangler Mens Regular Fit Jeans with Comfort Flex Waistband\r\n', 'j3.png', 'j3_sub1.png', 'j3_sub2.png', '', '20.88', 18, 'on', 'On', 7, 13, 'jeans,Jeans,Wrangler Jeans', '30,32,34,36'),
(26, 'Ring of Fire Jeans', 'RING OF FIRE Mens Thrill Slim Fit Moto Stretch Jeans', 'j4.png', 'j4_sub1.png', 'j4_sub2.png', 'j4_sub3.png', '19.97', 17, 'on', 'Off', 6, 13, 'Ring of Fire,Jeans ,jeans', '28,30,34,36'),
(27, 'The Mandalorian tshirt', 'Star Wars Baby Yoda Mens & Big Mens Grogu Pumpkin Halloween Graphic Tee,  Halloween Shirts', 't-shirt_1_sub3.png', 't-shirt_2_sub2.png', 't-shirt-1.png', 't-shirt-1sub1.png', '12.98', 9, 'on', 'On', 17, 14, 'Tshirt, tshirt,tshirts,Tshirts', 'S,M,L,xl'),
(28, 'Champion Tshirt', 'Champion Mens Script Logo Classic Graphic Long Sleeve TShirt', 't-shirt-2.png', 'tshirt2_sub1.png', 'tshirt2_sub2.png', '', '30.00', 24, 'on', 'On', 17, 14, 'Tshirt, tshirt,tshirts,Tshirts', 'S,M,L'),
(29, 'Hanes Tshirt', 'Hanes  New MmF Essential T Long Sleeve TShirt', 'tshirt4_sub1.png', 'tshirt4.png', 'tshirt4_sub2.png', 'tshirt4_sub3.png', '19.91', 13, 'on', 'On', 17, 14, 'Tshirt, tshirt,tshirts,Tshirts', 'S,L'),
(30, 'IZOD Tshirt', ' IZOD Mens Long Sleeve Graphic Tee', 'tshirt5.png', 'tshirt5_sub2.png', 'tshirt5_sub1.png', 'tshirt5_sub3.png', '35.00', 27, 'on', 'On', 17, 14, 'Tshirt, tshirt,tshirts,Tshirts', 'S,M,L,xl'),
(31, 'AND1 Shoes', 'And1 Mens Maverick Laceup Basketball Shoe\r\n', 'shoes1.png', 'shoes1_sub-.png', 'shoes1_sub1.png', 'shoes1_sub2.png', '35.00', 30, 'on', 'On', 11, 15, 'shoes,Shoes,SHOES,AND1,and1 ', '38,39,40,41,42,43,44'),
(32, 'Ozark Trail shoes', 'Ozark Trail Mens Troy Laceup Hiking and Hunting Boots', 'shoes2.png', 'shoes2_sub1.png', 'shoes2_sub2.png', 'shoes2_sub3.png', '55.00', 26, 'on', 'On', 36, 15, 'shoes,Shoes,SHOES,Ozark Trail', '40,41,42,43'),
(33, 'Wolverine shoes', 'Wolverine Mens DuraShocks SR 6 Work Boots', 'shoes3.png', 'shoes3_sub1.png', 'shoes3_sub2.png', 'shoes3_sub3.png', '150.00', 135, 'on', 'On', 6, 15, 'shoes,Shoes,SHOES,boots  ', '39,40,41,42,43,44'),
(34, 'Lugz shoes', 'Lugz Mens Avalanche Strap Duck Boots Ankle', '4.png', '4_sub1.png', '4_sub2.png', '4_sub3.png', '35.95', 26, 'on', 'On', 25, 15, 'shoes,Shoes,SHOES,boots  ', '38,39,40,41,42'),
(35, 'Lugz shoes', 'Lugz Mens Zrocs Sneakers Shoes Casual', '5.png', '5_sub1.png', '5_sub2.png', '5_sub3.png', '19.95', 15, 'on', 'On', 15, 15, 'shoes,Shoes,SHOES,boots  ', '38,39,40,,43'),
(36, 'Champion pants', 'Champion Mens Powerblend Graphic Joggers', 'pants1.png', 'pants1_sub1.png', 'pants1_sub3.png', 'pants3_sub2.png', '45.55', 35, 'on', 'Off', 12, 16, 'pants,cahmpions,PANTS,Pants', 'S,M,L'),
(37, 'Ben Hogan pant', 'Ben Hogan Mens Active Flex Flat Front Golf Pants', 'pants2.png', 'pants2_sub1.png', 'pants2.png', 'pants2_sub1.png', '19.96', 17, 'on', 'On', 17, 16, 'pants,Ben Hogan,PANTS,Pants', 'S,M,L,xl'),
(38, 'U.S. Polo Assn Pants', 'US Polo Assn Mens Slim Straight Stretch Twill 5 Pocket Pants', 'pants3.png', 'pants3_sub1.png', 'pants3_sub2.png', 'pants3_sub3.png', '50.00', 35, 'on', 'On', 11, 16, 'pants,U.S. Polo Assn.,PANTS,Pants,Polo', 'S,M'),
(39, 'Wrangler Pant', 'Wrangler Mens Relaxed Fit Cargo Pant with Stretch\r\n', 'pants4.png', 'pants4_sub1.png', 'pants4_sub2.png', 'pants4_sub3.png', '35.95', 20, 'on', 'On', 35, 16, 'pants,Wrangler,PANTS,Pants', 'S,M,L,xl'),
(40, 'Leather Bi Fold Wallet ', 'Western Fashion Accessories Mens Leather Bi Fold Wallet with Lace Detail', '1.jpeg', '1_sub1.jpeg', '1_sub2.jpeg', '1.jpeg', '50.00', 35, 'on', 'On', 6, 17, 'wallet,Accessories,accessories,Leather Bi Fold Wallet ,Leather Wallet ', '----'),
(41, 'Leather Bi Fold Wallet ', 'Western Fashion Accessories Mens Leather Bi Fold Wallet with Lace Detail', '2.jpeg', '2sub1.jpeg', '2sub2.jpeg', '2sub3.jpeg', '49.99', 35, 'on', 'Off', 17, 17, 'wallet,Accessories,accessories,Leather Wallet ', '----'),
(42, 'Reef & Reel Classic Tshirt', 'Reef and Reel Classic Wave Mens Long Sleeve Performance Shirt', '3sub1.png', '3.jpeg', '3sub1.png', '3.jpeg', '29.99', 27, 'on', 'Off', 12, 14, 'Tshirt, tshirt,tshirts,Tshirts', 'S,M,L,xl'),
(43, 'Dickies Mens Belt ', 'Genuine Dickies Mens Reversible Stretch Belt With Big and Tall Sizes', 'belt.jpeg', 'beltsub1.jpeg', 'beltsub2.jpeg', 'beltsub3.jpeg', '49.99', 34, 'on', 'Off', 7, 17, 'Accessories,accessories,Dickies,Mens,Belt,Dickies Mens Belt', '----'),
(44, 'Foster Grant Mens Sunglasses', 'Foster Grant Mens Deep Dish Way Sunglasses', 'sunglass.jpeg', 'sunglass_sub1.jpeg', 'sunglass_sub2.jpeg', 'sunglass.jpeg', '19.99', 12, 'on', 'Off', 3, 17, 'Accessories,accessories,Sunglasses ,sunglasses,Foster Grant Mens Sunglasses,Mens Sunglasses', '----');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(3) NOT NULL,
  `user_img` text NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `login_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_img`, `user_name`, `user_email`, `user_password`, `login_date`) VALUES
(4, 'Screenshot (13).png', 'Ali obeidat', 'Ali@gmail.com', 'asdasd123', '2021-12-01'),
(5, 'Screenshot 2021-11-24 115557.jpg', 'reem bani ', 'reem@gmail.com', 'aseq', '2021-11-02'),
(6, 'IMG-61ad34248b7aa-119988967_1021874854913083_1067678444140277952_n.jpg', 'ali hussein obeidat', 'ali.hus.obeidat@gmail.com', 'Alihobeidat@98', '2021-12-05');

-- --------------------------------------------------------

--
-- Table structure for table `users_cart`
--

CREATE TABLE `users_cart` (
  `user_cart_id` int(3) NOT NULL,
  `user_id` int(3) NOT NULL,
  `product_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `sub_total` double NOT NULL,
  `size_cart` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `admin_email` (`admin_email`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_id` (`user_id`),
  ADD KEY `products_id` (`prodcut_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_email` (`user_email`);

--
-- Indexes for table `users_cart`
--
ALTER TABLE `users_cart`
  ADD PRIMARY KEY (`user_cart_id`),
  ADD KEY `user_cart_id` (`user_id`),
  ADD KEY `product_cart_id` (`product_id`),
  ADD KEY `order_cart_id` (`order_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users_cart`
--
ALTER TABLE `users_cart`
  MODIFY `user_cart_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `products_id` FOREIGN KEY (`prodcut_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `users_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `category_id` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`) ON UPDATE NO ACTION;

--
-- Constraints for table `users_cart`
--
ALTER TABLE `users_cart`
  ADD CONSTRAINT `order_cart_id` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_cart_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_cart_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
