-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 24, 2017 at 07:11 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shopping_cart`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers_accounts`
--

CREATE TABLE `customers_accounts` (
  `customer_id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `phone_number` varchar(50) NOT NULL,
  `email_address` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `date_inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers_accounts`
--

INSERT INTO `customers_accounts` (`customer_id`, `first_name`, `last_name`, `phone_number`, `email_address`, `password`, `date_inserted`) VALUES
(1, 'admin', 'admin', 'admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', '2017-07-26 14:08:47'),
(23, 'Mohamed', 'Abulgasem', '081 7140814', 'algiriany93@gmail.com', 'e9eca1059527905356e6bb6f2b3fe106', '2017-07-26 18:46:25'),
(39, 'Will', 'Smith', '+1 40 449 77 65', 'will.smith@gmail.co.us', '647e62e95b6aa8352c2805b23c0f3dd6', '2017-08-07 14:43:22'),
(40, 'Adel', 'Alarabi', '078 576 43 12', 'alarabi@gmail.com', '69deb156b8e968840e5fe5657eba9387', '2017-08-10 12:21:14'),
(41, 'James', 'Mark', '+27 81 714098', 'james@gmail.com', '9ba36afc4e560bf811caefc0c7fddddf', '2017-08-24 08:38:45'),
(42, 'Owen', 'Crowie', '0678776524', 'owen@gmail.com', 'cc6780ddb60fb26c4d5655760f0dca24', '2017-09-01 21:57:59');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `item_id` int(11) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `price` float NOT NULL,
  `quantity` int(11) NOT NULL,
  `item_description` varchar(500) DEFAULT NULL,
  `image_link` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`item_id`, `item_name`, `category`, `price`, `quantity`, `item_description`, `image_link`) VALUES
(1, 'FIREWIRE DOMINATOR TIMBERTEK HYBRID SURFBOARD', 'Surf Boards', 7999.99, 20, 'Quite possibly the most adaptable, responsive board within Firewire\'s quiver, The Dominator TimberTek Hybrid Surfboard is more than a carve-capable design, it\'s built on and for the premise of enhanced speed and performance.', 'style/FirewireDominatorTimberTekHybrid.jpg'),
(2, 'MARES REEF 3MM', 'Wet Suits', 999.99, 30, 'Mares Reef 3mm Wetsuit, a traditional design of wetsuit from Mares superb for warm water diving and general watersports activities. 3mm neoprene construction, superb new design elements and improved cut all ensure the popularity of the Mares Reef Wetsuit.', 'style/mares-reef-3mm.jpg'),
(3, 'SLATER SCI-FI LFT SURFBOARD - FCS II - 5\'11"', 'Surf Boards', 8499.99, 10, 'The Sci-Fi is a mash up of classic curves and modern rocker served with a Futuristic twist of fluid dynamic principles likely found in the design archives of Bruce Wayne.', 'style/lscf-511.jpg'),
(4, 'FIREWIRE VANGUARD FST HIGH PERFORMANCE SURFBOARD', 'Surf Boards', 5999.99, 30, 'Forget the look of the Firewire Vanguard FST High Performance Surfboard and enjoy the feeling of riding one.', 'style/fvg-dbldiamond-b-1.jpg'),
(5, 'FIREWIRE BAKED POTATO TIMBERTEK HYBRID SURFBOARD', 'Surf Boards', 3999.99, 8, 'The Firewire Baked Potato TT Diamond Tail Surfboard is a great surfboard for all surfers.', 'style/tbp-diamond-b-1.jpg'),
(6, 'FIREWIRE NANO FST PERFORMANCE HYBRID SURFBOARD', 'Surf Boards', 2499.99, 30, 'The Firewire Nano FST Performance Hybrid Surfboard is a fun, fast and loose board that can hold well in overhead waves.', 'style/fna-square-b-1.jpg'),
(7, 'FIREWIRE DOMINATOR LFT HYBRID SURFBOARD', 'Surf Boards', 6999.99, 6, 'Quite possibly the most adaptable, responsive board within Firewire\'s quiver, The Dominator LFT Hybrid Surfboard is more than a carve-capable design, it\'s built on and for the premise of enhanced speed and performance.', 'style/ldm-round-b-1.485.jpg'),
(8, 'VOODOO 4/3 SLANT ZIP FULLSUIT', 'Wet Suits', 3199.99, 7, 'Magnaflex high performance stretch material & hermoplush fiber in chest and back. It has S-flex seam taping that provides a better seal, warmth and durability, Unfinished collar, wrist, & ankle cuffs and Fluidseal liquid tape that stretches which allows complete flexibility with zero water penetration.', 'style/voodoo-blue.jpg'),
(9, 'SIROKO 2MM S/A SPRINGSUIT\n', 'Wet Suits', 899.99, 30, 'Magnaflex high-performance stretch material, interior smooth skin neck for added comfort & a flatlock seam construction\r\nBlunt cut collar and it features an interior key pocket with a short zip entry.', 'style/SIROKO_SA_SPRING_BLU_F.jpg'),
(10, 'SIRKO 3/2 SLANT ZIP FULLSUIT\r\n', 'Wet Suits', 2099.99, 9, 'Magnaflex highest performance stretch material, fairskin chest and back & thermoplush interior, it has a glued & blind stitch, spot tape used at seam intersections for added durability and seam strength.', 'style/F16_SIROKO_SLANTZIP_FULLSUIT_BLU_F.jpg'),
(11, 'RED CELL 5/4/3 HOODED FULLSUIT', 'Wet Suits', 5999.99, 15, 'The internal Evoflex Taped Seam Technology combines the best of both worlds. With an exceptionally low coefficient of friction and an extraordinary degree of elongation, our Evoflex Tape re-defines what a sealed seam should be.', 'style/REDCELL_HOODEDFULLSUIT.jpg'),
(12, 'HERITAGE 2MM LONG JOHN BACK ZIP\r\n', 'Wet Suits', 949.99, 30, '2mm Finemesh on chest & back panels, 2mm Nylon on torso and legs, Magnaflex underarm panels. it has a Flatlock stitching & Short zip back entry with velcro lock and Superflex kneepads.', 'style/HERITAGE_BACKZIP_LONGJOHN_BLK.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `orderlines`
--

CREATE TABLE `orderlines` (
  `orderline` int(11) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `price` decimal(11,0) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_amount` decimal(11,0) NOT NULL,
  `order_num` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_num` int(11) NOT NULL,
  `total_amount` decimal(11,0) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `customer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers_accounts`
--
ALTER TABLE `customers_accounts`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `orderlines`
--
ALTER TABLE `orderlines`
  ADD PRIMARY KEY (`orderline`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_num`),
  ADD KEY `customer_id` (`customer_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers_accounts`
--
ALTER TABLE `customers_accounts`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `orderlines`
--
ALTER TABLE `orderlines`
  MODIFY `orderline` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_num` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers_accounts` (`customer_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
