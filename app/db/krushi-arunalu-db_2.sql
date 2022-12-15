-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 15, 2022 at 01:29 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `krushi-arunalu-db`
--

-- --------------------------------------------------------

--
-- Table structure for table `crop`
--

CREATE TABLE `crop` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `cultivatable_districts` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `required_soil_condition` varchar(255) DEFAULT NULL,
  `required_rainfall` varchar(255) DEFAULT NULL,
  `required_humidity` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `crop`
--

INSERT INTO `crop` (`id`, `category_id`, `cultivatable_districts`, `name`, `description`, `required_soil_condition`, `required_rainfall`, `required_humidity`) VALUES
(1, 1, NULL, 'Crop 1', NULL, NULL, NULL, NULL),
(2, 1, NULL, 'Crop 2', NULL, NULL, NULL, NULL),
(3, 2, NULL, 'Crop 3', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `crop_category`
--

CREATE TABLE `crop_category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `crop_category`
--

INSERT INTO `crop_category` (`id`, `name`) VALUES
(1, 'Crop category 1'),
(2, 'Crop category 2'),
(3, 'Crop category 3'),
(4, 'Crop category 4');

-- --------------------------------------------------------

--
-- Table structure for table `cultivation`
--

CREATE TABLE `cultivation` (
  `id` int(11) NOT NULL,
  `crop_id` int(11) NOT NULL,
  `land_id` int(11) NOT NULL,
  `cultivated_date` date NOT NULL,
  `cultivated_quantity` float NOT NULL,
  `status` varchar(255) NOT NULL,
  `expected_harvest_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cultivation`
--

INSERT INTO `cultivation` (`id`, `crop_id`, `land_id`, `cultivated_date`, `cultivated_quantity`, `status`, `expected_harvest_date`) VALUES
(1, 1, 1, '2022-12-05', 100, '', '2023-01-04'),
(2, 1, 1, '2022-12-08', 50, '', '2023-01-05');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `nic` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `nic`) VALUES
(7, '199984312394');

-- --------------------------------------------------------

--
-- Table structure for table `district`
--

CREATE TABLE `district` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `district`
--

INSERT INTO `district` (`id`, `name`) VALUES
(1, 'Colombo'),
(2, 'Gampaha'),
(3, 'Kalutara'),
(4, 'Kandy'),
(5, 'Matale'),
(6, 'Nuwara Eliya'),
(7, 'Galle'),
(8, 'Matara'),
(9, 'Hambantota'),
(10, 'Jaffna'),
(11, 'Kilinochchi'),
(12, 'Mannar'),
(13, 'Vavuniya'),
(14, 'Mullaitivu'),
(15, 'Batticaloa'),
(16, 'Ampara'),
(17, 'Trincomalee'),
(18, 'Kurunegala'),
(19, 'Puttalam'),
(20, 'Anuradhapura'),
(21, 'Polonnaruwa'),
(22, 'Badulla'),
(23, 'Moneragala'),
(24, 'Ratnapura'),
(25, 'Kegalle');

-- --------------------------------------------------------

--
-- Table structure for table `land`
--

CREATE TABLE `land` (
  `id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `area_in_hectares` float NOT NULL,
  `address` varchar(255) NOT NULL,
  `district` int(11) NOT NULL,
  `soil_condition` varchar(255) NOT NULL,
  `rainfall` varchar(255) NOT NULL,
  `humidity` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `land`
--

INSERT INTO `land` (`id`, `owner_id`, `name`, `area_in_hectares`, `address`, `district`, `soil_condition`, `rainfall`, `humidity`) VALUES
(1, 5, 'Land 1', 100, '123, New street, Colombo', 1, 'Normal', 'Low', 'Medium');

-- --------------------------------------------------------

--
-- Table structure for table `manufacturer`
--

CREATE TABLE `manufacturer` (
  `id` int(11) NOT NULL,
  `br_number` varchar(12) NOT NULL,
  `cover_image_url` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `manufacturer`
--

INSERT INTO `manufacturer` (`id`, `br_number`, `cover_image_url`, `description`) VALUES
(6, 'BR1', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `producer`
--

CREATE TABLE `producer` (
  `id` int(11) NOT NULL,
  `nic_number` varchar(12) NOT NULL,
  `district` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `producer`
--

INSERT INTO `producer` (`id`, `nic_number`, `district`) VALUES
(5, '200014701797', 1),
(7, '199984312394', 7);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `weight` double DEFAULT NULL,
  `unit` varchar(20) NOT NULL,
  `unit_selling_price` decimal(10,2) NOT NULL,
  `stock_quantity` double NOT NULL,
  `manufacturer_id` int(11) NOT NULL,
  `category_id` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `image_url`, `description`, `weight`, `unit`, `unit_selling_price`, `stock_quantity`, `manufacturer_id`, `category_id`) VALUES
(1, 'Cinnamon Oil', 'cinnamon.jpg', 'Cinnamon Oil sold by Rumindu', NULL, 'Bottles', '100.00', 5, 6, 7),
(3, 'Fadna Ranawara Tea', 'fadna.jpg', 'Fadna Ranawara Tea made by Surani', NULL, 'packets', '400.00', 15, 6, 1),
(5, 'Hair Care Cool', 'hair_care_cool.jpg', 'Hair Care Cool made by Vinuri', NULL, 'Bottles', '900.00', 25, 6, 1),
(6, 'Sumudu Toothpaste', 'sumudu.jpg', 'Sumudu Toothpaste made by Sandul', NULL, 'packets', '200.00', 5, 6, 1),
(8, 'Baraka Virgin Coconut Oil', 'coconut_oil.jpg', 'Baraka Virgin Coconut Oil made by Vinuri', NULL, 'Bottles', '1500.00', 24, 6, 2),
(10, 'Coir Stitched Blanket', 'blanket.jpg', 'Coir Stitched Blanket made by Rumindu', NULL, 'pieces', '1200.00', 12, 6, 4),
(12, 'Coco Pot', 'coco_pot.jpg', 'Coco pot made by Surani', NULL, 'pieces', '850.00', 10, 6, 2),
(14, 'Coco Hanging Bowl', 'hanging-bowl.jpg', 'Coco Hanging Bowl made by Vinuri', NULL, 'pieces', '550.00', 13, 6, 4);

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE `product_category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`id`, `name`) VALUES
(1, 'Ayurvedic and Herbal products'),
(2, 'Coconut and Coconut based Products'),
(3, 'Ayurvedic and Herbal products'),
(4, 'Coconut and Coconut based Products'),
(5, 'Coconut and coconut based products'),
(6, 'Coconut and coconut based products'),
(7, 'Spices, Essential Oils and oleoresins'),
(8, 'Spices, Essential Oils and oleoresins');

-- --------------------------------------------------------

--
-- Table structure for table `registered_user`
--

CREATE TABLE `registered_user` (
  `id` int(11) NOT NULL,
  `role` varchar(30) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `last_login` timestamp NULL DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `contact_no` varchar(30) NOT NULL,
  `hashed_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `registered_user`
--

INSERT INTO `registered_user` (`id`, `role`, `name`, `address`, `last_login`, `image_url`, `email`, `contact_no`, `hashed_password`) VALUES
(5, 'Producer', 'Sandul Renuja', '123, Main street, Colombo', NULL, NULL, 'sandulrenuja@gmail.com', '+94775415464', '$2y$10$uJHo6UTfQjJfvjngh4x8auGV8gDwMtBOVLdr7nWb/BwYts0vx41Ey'),
(6, 'Manufacturer', 'Test Manufacturer 1', 'Test address', NULL, NULL, 'testmanufacturer1@gmail.com', '12345', '$2y$10$/iy4dudBDd.a8J942y0xV.OGyMxmloK6cKKQ2rfQ5F/5RKn/IRAde'),
(7, 'Customer', 'Vinuri Gamage', 'Halpathdeniya watta, Pitadeniya, thalgampola', NULL, NULL, 'gamagevinuri99@gmail.com', '0764023716', '$2y$10$1oBK.T5vcrxMeGE0C7AyqOOdSgGLBY99tGlZU1IHg3.Z/9BiT.lv.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `crop`
--
ALTER TABLE `crop`
  ADD PRIMARY KEY (`id`),
  ADD KEY `crop_category_id` (`category_id`);

--
-- Indexes for table `crop_category`
--
ALTER TABLE `crop_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cultivation`
--
ALTER TABLE `cultivation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `district`
--
ALTER TABLE `district`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `land`
--
ALTER TABLE `land`
  ADD PRIMARY KEY (`id`),
  ADD KEY `land_district_id` (`district`),
  ADD KEY `land_producer_id` (`owner_id`);

--
-- Indexes for table `manufacturer`
--
ALTER TABLE `manufacturer`
  ADD KEY `manufacturer_user_id` (`id`);

--
-- Indexes for table `producer`
--
ALTER TABLE `producer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `producer_district_id` (`district`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_manufacturer_id` (`manufacturer_id`),
  ADD KEY `product_category_id` (`category_id`);

--
-- Indexes for table `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registered_user`
--
ALTER TABLE `registered_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `crop`
--
ALTER TABLE `crop`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `crop_category`
--
ALTER TABLE `crop_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cultivation`
--
ALTER TABLE `cultivation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `district`
--
ALTER TABLE `district`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `land`
--
ALTER TABLE `land`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `product_category`
--
ALTER TABLE `product_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `registered_user`
--
ALTER TABLE `registered_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `crop`
--
ALTER TABLE `crop`
  ADD CONSTRAINT `crop_category_id` FOREIGN KEY (`category_id`) REFERENCES `crop_category` (`id`);

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_user_id` FOREIGN KEY (`id`) REFERENCES `registered_user` (`id`);

--
-- Constraints for table `land`
--
ALTER TABLE `land`
  ADD CONSTRAINT `land_district_id` FOREIGN KEY (`district`) REFERENCES `district` (`id`),
  ADD CONSTRAINT `land_producer_id` FOREIGN KEY (`owner_id`) REFERENCES `producer` (`id`);

--
-- Constraints for table `manufacturer`
--
ALTER TABLE `manufacturer`
  ADD CONSTRAINT `manufacturer_user_id` FOREIGN KEY (`id`) REFERENCES `registered_user` (`id`);

--
-- Constraints for table `producer`
--
ALTER TABLE `producer`
  ADD CONSTRAINT `producer_district_id` FOREIGN KEY (`district`) REFERENCES `district` (`id`),
  ADD CONSTRAINT `producer_user_id` FOREIGN KEY (`id`) REFERENCES `registered_user` (`id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_category_id` FOREIGN KEY (`category_id`) REFERENCES `product_category` (`id`),
  ADD CONSTRAINT `product_manufacturer_id` FOREIGN KEY (`manufacturer_id`) REFERENCES `manufacturer` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
