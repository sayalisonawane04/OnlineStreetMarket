-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 07, 2025 at 07:37 AM
-- Server version: 8.0.36
-- PHP Version: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `citystreetmart`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `email`) VALUES
(1, 'vishaltaskar', 'Vishal123@', 'vishaltaskar1602@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'FoodDrinks'),
(2, 'CraftsHandmade'),
(3, 'ClothingAccessories'),
(4, 'ArtDecor'),
(5, 'Vegetables');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `title`, `message`, `created_at`) VALUES
(1, 1, 'Welcome to City Street Marts', 'Thank you for signing up! We hope you enjoy shopping with us.', '2024-12-06 16:05:56');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` int NOT NULL AUTO_INCREMENT,
  `order_date` datetime NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `user_id` int NOT NULL,
  `order_status` varchar(50) NOT NULL,
  `shipped_by` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `product_id` int NOT NULL,
  PRIMARY KEY (`order_id`),
  KEY `product_id` (`product_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_date`, `total_amount`, `user_id`, `order_status`, `shipped_by`, `product_id`) VALUES
(1, '2024-12-10 04:51:26', 499.99, 1, 'Pending', NULL, 9),
(2, '2024-12-10 05:02:35', 10.00, 1, 'Pending', 'Our Delivery Partner', 22),
(3, '2024-12-13 06:17:27', 30.00, 1, 'Pending', 'Our Delivery Partner', 26);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
CREATE TABLE IF NOT EXISTS `payment` (
  `payment_id` int NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `payment_date` datetime NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `payment_status` varchar(50) NOT NULL,
  PRIMARY KEY (`payment_id`),
  KEY `order_id` (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `order_id`, `payment_date`, `amount`, `payment_method`, `payment_status`) VALUES
(1, 1, '2024-12-10 04:51:26', 499.99, 'Pay on Delivery', 'Pending'),
(2, 2, '2024-12-10 05:02:35', 10.00, 'Pay on Delivery', 'Pending'),
(3, 3, '2024-12-13 06:17:27', 30.00, 'Pay on Delivery', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int NOT NULL,
  `description` text,
  `image_url` varchar(255) DEFAULT NULL,
  `vendor_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `vendor_id` (`vendor_id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `category`, `price`, `quantity`, `description`, `image_url`, `vendor_id`, `created_at`) VALUES
(6, 'Apple Juice', 'FoodDrinks', 59.99, 100, 'Freshly squeezed apple juice in a 1L bottle.', 'img/products/apple_juice.jpg', 2, '2024-12-05 07:06:29'),
(7, 'Handmade Pottery Vase', 'CraftsHandmade', 399.99, 50, 'A beautiful, handmade pottery vase.', 'img/products/pottery_vase.jpg', 3, '2024-12-05 07:06:29'),
(8, 'Cotton T-shirt', 'ClothingAccessories', 200.00, 100, '0', 'img/products/cotton_tshirt.jpg', 1, '2024-12-05 07:06:29'),
(9, 'Abstract Wall Art', 'ArtDecor', 499.99, 30, 'A stunning piece of abstract wall art.', 'img/products/wall_art.jpg', 4, '2024-12-05 07:06:29'),
(11, 'Organic Carrots', 'Vegetables', 20.99, 150, 'Fresh, organic carrots grown locally.', 'img/products/carrots.jpg', 5, '2024-12-05 07:32:11'),
(12, 'Leather Jacket', 'ClothingAccessories', 120.00, 50, 'Stylish leather jacket for all seasons.', 'img/products/leather-jacket.jpg', 1, '2024-12-05 10:02:13'),
(13, 'Summer Hat', 'ClothingAccessories', 15.99, 100, 'Trendy summer hat to keep you cool.', 'img/products/summer-hat.jpg', 1, '2024-12-05 10:02:13'),
(14, 'Wool Scarf', 'ClothingAccessories', 25.50, 80, 'Cozy wool scarf for cold weather.', 'img/products/wool-scarf.jpg', 1, '2024-12-05 10:02:13'),
(15, 'Sunglasses', 'ClothingAccessories', 45.00, 120, 'Fashionable sunglasses to complete your look.', 'img/products/sunglasses.jpg', 1, '2024-12-05 10:02:13'),
(16, 'Denim Jeans', 'ClothingAccessories', 39.99, 60, 'Comfortable and stylish denim jeans.', 'img/products/denim-jeans.jpg', 1, '2024-12-05 10:02:13'),
(17, 'Casual T-shirt', 'ClothingAccessories', 18.99, 150, 'Soft cotton t-shirt for everyday wear.', 'img/products/casual-tshirt.jpg', 1, '2024-12-05 10:02:13'),
(18, 'Wristwatch', 'ClothingAccessories', 75.00, 40, 'Elegant wristwatch for formal occasions.', 'img/products/wristwatch.jpg', 1, '2024-12-05 10:02:13'),
(19, 'Sneakers', 'ClothingAccessories', 65.00, 70, 'Comfortable sneakers for everyday use.', 'img/products/sneakers.jpg', 1, '2024-12-05 10:02:13'),
(20, 'Beaded Necklace', 'ClothingAccessories', 30.00, 50, 'Handmade beaded necklace for a chic look.', 'img/products/beaded-necklace.jpg', 1, '2024-12-05 10:02:13'),
(21, 'Organic Coffee', 'FoodDrinks', 15.00, 150, 'Premium organic coffee beans from the best farms.', 'img/products/organic-coffee.jpg', 2, '2024-12-05 10:21:04'),
(22, 'Green Tea', 'FoodDrinks', 10.00, 200, 'Refreshing green tea with antioxidant properties.', 'img/products/green-tea.jpg', 2, '2024-12-05 10:21:04'),
(23, 'Fresh Juice', 'FoodDrinks', 5.50, 300, '100% natural and fresh fruit juice.', 'img/products/fresh-juice.jpg', 2, '2024-12-05 10:21:04'),
(24, 'Lemonade', 'FoodDrinks', 4.00, 250, 'Homemade lemonade with a tangy twist.', 'img/products/lemonade.jpg', 2, '2024-12-05 10:21:04'),
(25, 'Herbal Tea', 'FoodDrinks', 8.00, 100, 'Soothing herbal tea made from natural ingredients.', 'img/products/herbal-tea.jpg', 2, '2024-12-05 10:21:04'),
(26, 'Handmade Ceramic Vase', 'CraftsHandmade', 30.00, 50, 'Beautifully handcrafted ceramic vase for home decor.', 'img/products/ceramic-vase.jpg', 3, '2024-12-05 10:26:21'),
(27, 'Wooden Jewelry Box', 'CraftsHandmade', 25.00, 70, 'Elegant wooden jewelry box with intricate carvings.', 'img/products/wooden-jewelry-box.jpg', 3, '2024-12-05 10:26:21'),
(28, 'Macramé Wall Hanging', 'CraftsHandmade', 40.00, 60, 'Bohemian-style macramé wall hanging for a stylish touch.', 'img/products/macrame-wall-hanging.jpg', 3, '2024-12-05 10:26:21');

-- --------------------------------------------------------

--
-- Table structure for table `usercart`
--

DROP TABLE IF EXISTS `usercart`;
CREATE TABLE IF NOT EXISTS `usercart` (
  `cart_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL DEFAULT '1',
  `total_price` decimal(10,2) NOT NULL,
  `date_added` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`cart_id`),
  KEY `user_id` (`user_id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `usercart`
--

INSERT INTO `usercart` (`cart_id`, `user_id`, `product_id`, `quantity`, `total_price`, `date_added`) VALUES
(1, 1, 8, 1, 259.00, '2024-12-05 12:24:23'),
(4, 2, 18, 1, 75.00, '2024-12-06 06:08:24'),
(7, 1, 7, 1, 399.00, '2024-12-13 06:15:19'),
(8, 1, 15, 1, 45.00, '2025-02-12 09:59:26');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `phone`, `username`, `password`, `address`, `created_at`, `updated_at`) VALUES
(1, 'vishal mohan taskar', 'vishaltaskar1602@gmail.com', '8975591487', 'vishaltaskar1602', 'Vishal123@', 'Nashik', '2024-12-01 10:42:48', '2024-12-01 10:42:48'),
(2, 'Siddhesh Ambekar', 'abc@gmail.com', '7894561239', 'sid4525', 'Siddhesh@1', 'nashik', '2024-12-06 06:07:10', '2024-12-06 06:07:10'),
(3, 'Siddhesh Ambekar', 'sid343@email.com', '9865328956', 'sid ambekar', 'Siddhesh@1', 'Nashik', '2024-12-13 04:56:53', '2024-12-13 04:56:53'),
(4, 'vishal', 'vishal@gmail.com', '8975591487', 'vishaltaskar123', 'Vishal123@', 'manmad\r\n', '2025-05-02 13:46:36', '2025-05-02 13:46:36');

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

DROP TABLE IF EXISTS `vendor`;
CREATE TABLE IF NOT EXISTS `vendor` (
  `id` int NOT NULL AUTO_INCREMENT,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `store_name` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` text,
  `category` varchar(100) DEFAULT NULL,
  `business_description` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `image_url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`id`, `full_name`, `email`, `phone`, `store_name`, `username`, `password`, `address`, `category`, `business_description`, `created_at`, `updated_at`, `image_url`) VALUES
(1, 'Vishal Mohan Taskar', 'vishaltaskar1602@gmail.com', '8975591487', 'Nashikkar Clothes', 'vishaltaskar1602', 'Vishal123@', 'Manmad', 'Clothing & Accessories', 'BEST QUALITY CLOTHES AND ACCESSORIES AVAILABLE IN LOW PRICES', '2024-12-01 09:41:51', '2024-12-05 09:28:40', 'img/vendors/vendor5.jpg'),
(2, 'Amit Kumar', 'amit.kumar@example.com', '9876543210', 'Kumar Spices', 'amitkumar', 'Amit123@', '123, MG Road, Delhi', 'Food & Drinks', 'A variety of authentic spices from India.', '2024-12-05 08:20:08', '2024-12-05 08:20:08', 'img/vendors/vendor2.jpg'),
(3, 'Priya Sharma', 'priya.sharma@example.com', '9876543211', 'Sharma Handicrafts', 'priyasharma', 'Priya456#', '45, C P Lane, Kolkata', 'Crafts & Handmade', 'Handmade traditional crafts and decor items.', '2024-12-05 08:20:08', '2024-12-05 08:20:08', 'img/vendors/vendor3.jpg'),
(4, 'Rajesh Patel', 'rajesh.patel@example.com', '9876543212', 'Patel Textiles', 'rajeshpatel', 'Rajesh789$', '22, Bazar Road, Ahmedabad', 'Clothing & Accessories', 'Premium quality cotton fabrics and ethnic wear.', '2024-12-05 08:20:08', '2024-12-05 08:20:08', 'img/vendors/vendor4.jpg'),
(5, 'Bajirav Reddy', 'bajirav.reddy@example.com', '9876543213', 'Reddy Vegetables', 'bajiravreddy', 'Bajirav123@', '10, Green Market, Hyderabad', 'Vegetables', 'Fresh vegetables directly sourced from local farmers.', '2024-12-05 08:20:08', '2024-12-05 09:30:19', 'img/vendors/vendor1.jpg'),
(6, 'samruddhi patil', 'samruddhipatil16@gmail.com', '8975591487', 'samruddhis street food', 'samruddhipatil', 'Samruddhi123@', '', 'Food & Drinks', 'best quality food available here', '2024-12-10 13:58:00', '2024-12-10 14:00:28', NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`id`) REFERENCES `users` (`id`);

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`vendor_id`) REFERENCES `vendor` (`id`);

--
-- Constraints for table `usercart`
--
ALTER TABLE `usercart`
  ADD CONSTRAINT `usercart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `usercart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
