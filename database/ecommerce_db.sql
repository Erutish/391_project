-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 20, 2024 at 06:00 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`, `image`) VALUES
('BOp2p132JA3ZDkACGCK6', 'erutish', 'era@gmail.com', '10c8d7f53ea33ec3f8b0414821965989150e4b5d', '66223150e3b2a.JPG');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` varchar(20) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `product_id` varchar(20) NOT NULL,
  `price` int(50) NOT NULL,
  `qty` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` varchar(20) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `message` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` varchar(20) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `seller_id` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `number` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `address` varchar(200) NOT NULL,
  `address_type` varchar(10) NOT NULL,
  `method` varchar(50) NOT NULL,
  `product_id` varchar(20) NOT NULL,
  `price` int(10) NOT NULL,
  `qty` int(2) NOT NULL,
  `dates` date NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'in progress',
  `payment_status` varchar(100) NOT NULL DEFAULT 'pending',
  `transaction_type` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `seller_id`, `name`, `number`, `email`, `address`, `address_type`, `method`, `product_id`, `price`, `qty`, `dates`, `status`, `payment_status`, `transaction_type`) VALUES
('662238cade406', 'ANKi7VAq9F7X1LKSFX8k', 'kw5htRlY0XEqdTpjFY0w', 'Sam Winchester', 2147483647, 'sam@gmail.com', 'swap', 'home', 'only swap', 'ibqk04HiSyOLDNzaJ2rp', 79, 1, '2024-04-19', 'cancled', 'pending', 'swap'),
('6623ddb280fac', 'J3QWh3ntpCoRBL8VqSyZ', '0cwWmldAU8yi8YT8gbBt', 'Hermoine', 2147483647, 'hermoine@gmail.com', 'grefindor house,hogwarts,diagonaly,london,345678', 'office', 'cash on delivery', 'nd54GQkSSVDM9GoJuItY', 56, 1, '2024-04-20', 'in progress', 'pending', 'buy');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` varchar(20) NOT NULL,
  `seller_id` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(10) NOT NULL,
  `stock` int(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `product_details` varchar(1000) NOT NULL,
  `status` varchar(100) NOT NULL,
  `admin_sts` varchar(100) NOT NULL DEFAULT 'pending',
  `swap` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `seller_id`, `name`, `price`, `stock`, `image`, `product_details`, `status`, `admin_sts`, `swap`) VALUES
('3zUKbAL1AWNnkPSYD0DV', 'pITTTvvQ1GLfG8oMVPKF', 'headphone', 100, 10, 'head8.jpg', 'AnTuTu: 568674 (v8)\r\nGeekBench: 4067 (v5.1)\r\nGFXBench: 58fps (ES 3.1 onscreen)\r\nDisplay	Contrast ratio: Infinite (nominal)\r\nCamera	Photo / Video\r\nLoudspeaker	-24.4 LUFS (Very good)', 'inactive', 'pending', 'enable'),
('5UATtysmvJ3PsivsGNU8', 'pITTTvvQ1GLfG8oMVPKF', 'gpu345', 400, 20, 'gpu4.jpg', ' value=&#34;12 MP, f/1.6, 26mm (wide), 1.4µm, dual pixel PDAF, OIS\r\n12 MP, f/2.4, 13mm, 120˚ (ultrawide), 1/3.6&#34;\r\nFeatures	Dual-LED dual-tone flash, HDR (photo/panorama)\r\nVideo	4K@24/30/60fps, 1080p@30/60/120/240fps, HDR, Dolby Vision HDR (up to 30fps), stereo sound rec.&#34;', 'active', 'pending', 'disable'),
('6v9QTb3aoZd1hL8l4u18', 'kw5htRlY0XEqdTpjFY0w', 'SAMSUNG Galaxy A54 5G A Series Cell Phone,', 349, 40, 'phone8.jpg', ' value=&#34; value=&#34; value=&#34;PRO SHOTS WITH EASE: Brilliant sunrises, awesome selfies — capture incredible content with Galaxy A54 5G; Snap clear images with Single Take** and OIS, and even take shots in low light with Nightography\r\nCHARGE UP AND CHARGE ON: Always be ready for an impromptu photo op or newly released video with a powerful battery that has your back; With a long-lasting, Super Fast Charging*** 5,000mAh battery, Galaxy A54 5G keeps you up and running\r\nPOWERFUL 5G PERFORMANCE: Do what you love most — play games, watch movies or post photos — at the speed of life with Galaxy A54 5G; Our best of Galaxy A Series powers your day with an impressive processor and virtually lag-free 5G****&#34;&#34;&#34;', 'inactive', 'pending', 'disable'),
('GnaqJHxfMfZOKwtmIdAX', 'pITTTvvQ1GLfG8oMVPKF', 'iphone12', 300, 30, 'phone4.jpg', '146.7 x 71.5 x 7.4 mm (5.78 x 2.81 x 0.29 in)\r\nWeight	164 g (5.78 oz)\r\nBuild	Glass front (Corning-made glass), glass back (Corning-made glass), aluminum frame\r\nSIM	Nano-SIM and eSIM or Dual SIM (Nano-SIM, dual stand-by) - for China\r\n 	IP68 dust/water resistant (up to 6m for 30 min)\r\nApple Pay (Visa, MasterCard, AMEX certified)', 'active', 'pending', 'disable'),
('htWbk32iuhLe4gi7WNmu', 'pITTTvvQ1GLfG8oMVPKF', 'camera', 200, 20, 'camera2.jpg', ' value=&#34;12 MP, f/1.6, 26mm (wide), 1.4µm, dual pixel PDAF, OIS\r\n12 MP, f/2.4, 13mm, 120˚ (ultrawide), 1/3.6&#34;\r\nFeatures	Dual-LED dual-tone flash, HDR (photo/panorama)\r\nVideo	4K@24/30/60fps, 1080p@30/60/120/240fps, HDR, Dolby Vision HDR (up to 30fps), stereo sound rec.&#34;', 'active', 'pending', 'disable'),
('ibqk04HiSyOLDNzaJ2rp', 'kw5htRlY0XEqdTpjFY0w', 'Logitech G PRO Mechanical Gaming Keyboard', 79, 11, 'keyboard1.jpg', ' value=&#34; value=&#34; value=&#34; value=&#34; value=&#34; value=&#34; value=&#34; value=&#34; value=&#34; value=&#34;Built with and for esports athletes for competition-level performance, speed and precision.\r\nDurable GX Blue Click switches deliver an audible and tactile click for a solid, secure keypress.\r\nUltra-portable compact ten keyless design frees up table space for mouse movement. It’s easy to pack up and transport to tournaments.\r\nUse LIGHTSYNC to highlight keys and program static lighting patterns to onboard memory for tournament systems that don’t allow G HUB installations.\r\nDetachable Micro USB cables feature a three-pronged design for an easy, secure connection and safe transport in your travel bag.&#34;&#34;&#34;&#34;&#34;&#34;&#34;&#34;&#34;&#34;', 'active', 'pending', 'enable'),
('M0IG3CzmPG6TTYN64ZQ0', 'kw5htRlY0XEqdTpjFY0w', 'Amazfit Band 7 Fitness & Activity Tracker,', 44, 20, 'watch2.jpg', ' value=&#34; value=&#34;【Large HD AMOLED Display】 Amazfit band 7 fitness tracker features a large 1.47” always-on display to fit more important information and reduce the scrolling. The viewable area of Band 7&#39;s large HD AMOLED display is 112% bigger than band 5, while the body remains slim and light.\r\n【18-day Battery Life】 Say goodbye to daily recharge. When fully charged, the 232 mAh battery of the fitness tracker watch can last up to 18 days with a typical usage, and up to 28 days with a battery saver mode.&#34;&#34;', 'active', 'pending', 'enable'),
('nd54GQkSSVDM9GoJuItY', '0cwWmldAU8yi8YT8gbBt', 'keyboard345', 56, 1, 'keyboard2.jpg', 'henten', 'active', 'pending', 'enable'),
('Q2M0ZTa0j1cEaxNFNofL', '0cwWmldAU8yi8YT8gbBt', 'headphone2', 23, 4, 'head10.jpg', 'Logitech H111 STEREO Headset(One port)\r\n\r\nNoise-canceling microphone\r\nAdjustable headband\r\nFlexible, rotating boom\r\nFull stereo sound\r\nVersatile design\r\nColor-coded 3.5 mm plugs\r\n2 Years Warranty', 'active', 'pending', 'enable'),
('T52pPgglrfZq7ymK0om2', 'pITTTvvQ1GLfG8oMVPKF', 'laptop', 400, 30, 'laptop4.jpg', 'Li-Ion 2815 mAh, non-removable (10.78 Wh)\r\nCharging	Wired, PD2.0, 50% in 30 min (advertised)\r\n15W wireless (MagSafe)\r\n15W wireless (Qi2) - requires iOS 17.4 updat', 'active', 'pending', 'enable'),
('vfXWQ7oM6TsxLLtvnjuE', 'kw5htRlY0XEqdTpjFY0w', 'Razer BlackShark V2 X Gaming Headset: 7.1', 20, 20, 'head.3.jpg', ' value=&#34; value=&#34; value=&#34; value=&#34;ADVANCED PASSIVE NOISE CANCELLATION - Sturdy closed earcups fully cover ears to prevent noise from leaking into the headset, with its cushions providing a closer seal for more sound isolation\r\n7.1 SURROUND SOUND FOR POSITIONAL AUDIO - Outfitted with custom-tuned 50 mm drivers, capable of software-enabled surround sound. *Only available on Windows 10 64-bit\r\nTRIFORCE TITANIUM 50MM HIGH-END SOUND DRIVERS - With titanium-coated diaphragms for added clarity, our new, cutting-edge proprietary design divides the driver into 3 parts for the individual tuning of highs, mids, and lo&#34;&#34;&#34;&#34;', 'active', 'pending', 'disable');

-- --------------------------------------------------------

--
-- Table structure for table `sellers`
--

CREATE TABLE `sellers` (
  `id` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `image` varchar(100) NOT NULL,
  `status` varchar(30) NOT NULL DEFAULT 'pending',
  `number` int(11) NOT NULL,
  `shop_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sellers`
--

INSERT INTO `sellers` (`id`, `name`, `email`, `password`, `image`, `status`, `number`, `shop_name`) VALUES
('0cwWmldAU8yi8YT8gbBt', 'Sam Winchester', 'sam@gmail.com', 'f16bed56189e249fe4ca8ed10a1ecae60e8ceac0', '661fff8eba901.jpg', 'accepted', 2147483647, 'demon'),
('kw5htRlY0XEqdTpjFY0w', 'Dean', 'dean@gmail.com', 'ba6f564cd70a52d664c374158c4dbcf519ddf158', '66101d65c07d0.jpg', 'accepted', 1726427543, 'winchester_club'),
('pITTTvvQ1GLfG8oMVPKF', 'misha', 'misha@gmai.lcom', '7fc7f9e73856bd42a257ce7aac54fc3687f7ad60', '6623de5de1f2a.jpeg', 'accepted', 2147483647, 'Angle'),
('PKbpLpv5Pxkgh5PMXGGz', 'jensen', 'jensen@gmail.com', '7606aafc3dc70103661e769a00c135447a83b4af', '662233a6430ed.png', 'pending', 2147483647, 'impala68');

-- --------------------------------------------------------

--
-- Table structure for table `swap`
--

CREATE TABLE `swap` (
  `id` varchar(20) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `seller_id` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `number` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `user_product_id` varchar(20) NOT NULL,
  `product_id` varchar(20) NOT NULL,
  `price` int(10) NOT NULL,
  `qty` int(2) NOT NULL,
  `dates` date NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'in progress',
  `payment_status` varchar(100) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `swap`
--

INSERT INTO `swap` (`id`, `user_id`, `seller_id`, `name`, `number`, `email`, `user_product_id`, `product_id`, `price`, `qty`, `dates`, `status`, `payment_status`) VALUES
('66216f49b7138', 'ANKi7VAq9F7X1LKSFX8k', 'kw5htRlY0XEqdTpjFY0w', 'Amazfit Band 7 Fitness & Activity Tracker,', 2147483647, 'sam@gmail.com', 'nd54GQkSSVDM9GoJuItY', 'M0IG3CzmPG6TTYN64ZQ0', 44, 1, '2024-04-18', 'in progress', 'pending'),
('662238cade406', 'ANKi7VAq9F7X1LKSFX8k', 'kw5htRlY0XEqdTpjFY0w', 'Logitech G PRO Mechanical Gaming Keyboard', 2147483647, 'sam@gmail.com', 'nd54GQkSSVDM9GoJuItY', 'ibqk04HiSyOLDNzaJ2rp', 79, 1, '2024-04-19', 'in progress', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `image` varchar(100) NOT NULL,
  `number` int(11) NOT NULL,
  `status` varchar(30) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `image`, `number`, `status`) VALUES
('ANKi7VAq9F7X1LKSFX8k', 'Sam Winchester', 'sam@gmail.com', 'f16bed56189e249fe4ca8ed10a1ecae60e8ceac0', '661667ce8351f.jpg', 2147483647, 'pending'),
('J3QWh3ntpCoRBL8VqSyZ', 'Hermoine', 'hermoine@gmail.com', 'a441dfb634d1995aec3fc4654395303bd5a2518c', '6623da8e4edee.jpeg', 2147483647, 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` varchar(20) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `product_id` varchar(20) NOT NULL,
  `price` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `user_id`, `product_id`, `price`) VALUES
('7xX6gHiFY0yGfJmTyjgG', 'J3QWh3ntpCoRBL8VqSyZ', 'ibqk04HiSyOLDNzaJ2rp', 79),
('LYO0lp1EDXt2cvLczQyU', 'J3QWh3ntpCoRBL8VqSyZ', 'nd54GQkSSVDM9GoJuItY', 56),
('TTXkzsCMpEUIpfX7AlrQ', 'ANKi7VAq9F7X1LKSFX8k', 'M0IG3CzmPG6TTYN64ZQ0', 44);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `sellers`
--
ALTER TABLE `sellers`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `swap`
--
ALTER TABLE `swap`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD UNIQUE KEY `id` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
