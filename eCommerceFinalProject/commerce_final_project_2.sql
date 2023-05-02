-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 02 mai 2023 à 00:16
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `commerce_final_project`
--
CREATE DATABASE IF NOT EXISTS `commerce_final_project` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `commerce_final_project`;

-- --------------------------------------------------------

--
-- Structure de la table `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(128) NOT NULL,
  `password` varchar(64) NOT NULL,
  `date created` datetime NOT NULL DEFAULT current_timestamp(),
  `email` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELATIONS POUR LA TABLE `customer`:
--

--
-- Déchargement des données de la table `customer`
--

INSERT INTO `customer` (`id`, `username`, `password`, `date created`, `email`) VALUES
(1, 'admin', '123', '2023-04-18 16:54:13', ''),
(12, 'ying', '202cb962ac59075b964b07152d234b70', '2023-04-29 21:23:54', 'ying@gmail.com'),
(13, 'celine', '202cb962ac59075b964b07152d234b70', '2023-04-29 22:40:25', 'celine@gmail.com'),
(14, '22', '202cb962ac59075b964b07152d234b70', '2023-05-01 21:57:28', '22@gmail.com');

-- --------------------------------------------------------

--
-- Structure de la table `order`
--

DROP TABLE IF EXISTS `order`;
CREATE TABLE IF NOT EXISTS `order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` tinyint(1) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `shopping_cart_id` int(11) NOT NULL,
  `billing_address` varchar(255) NOT NULL,
  `shipping_address` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_placed` datetime NOT NULL DEFAULT current_timestamp(),
  `date_shipped` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELATIONS POUR LA TABLE `order`:
--

--
-- Déchargement des données de la table `order`
--

INSERT INTO `order` (`id`, `status`, `customer_id`, `shopping_cart_id`, `billing_address`, `shipping_address`, `date_created`, `date_placed`, `date_shipped`) VALUES
(1, 0, 12345, 5, 'apple avenue', 'apple avenue', '2023-04-30 01:27:37', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 0, 13, 9, 'high avenue', 'high avenue', '2023-04-30 20:44:08', '2023-04-30 20:44:08', '0000-00-00 00:00:00'),
(6, 0, 13, 10, 'whole street', 'whole street', '2023-04-30 23:04:52', '2023-04-30 23:04:52', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `display_name` varchar(128) NOT NULL,
  `description` longtext NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `unit_price` decimal(10,0) NOT NULL,
  `available_quantity` int(11) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELATIONS POUR LA TABLE `product`:
--

--
-- Déchargement des données de la table `product`
--

INSERT INTO `product` (`id`, `display_name`, `description`, `image_url`, `unit_price`, `available_quantity`, `date_created`) VALUES
(1, 'Four Leaf Clover Bracelet', 'Rose gold plated bracelet with two four leaf clovers surrounded with crystals and mother of pearl plated as the clover.', 'https://www.helloice.com/media/catalog/product/cache/877042223109cc2bc0869ffe42af0ed8/6/2/626656c3423dbjpg_1.jpg', '15', 10, '2023-04-29 14:58:05'),
(2, 'Rain Drop Bow Necklace', 'Silver plated chain with crystalized bow and rain drop.', 'https://m.media-amazon.com/images/I/61R7xXXduBL._AC_SX425_.jpg', '10', 5, '2023-04-29 14:58:05'),
(5, 'Sweet Fresh Pearl Bracelet', 'Simple sweet bracelet with crystal and pink pearls.', 'https://cdn.shopify.com/s/files/1/0255/4757/1246/products/O1CN01o2Rvq71NBEuCePr3x__2737331531_700x700.gif?v=1591498796', '10', 12, '2023-04-29 15:04:46'),
(6, 'Lover Hearts Necklace', 'Silver plated entangled hearts necklace.', 'https://laz-img-sg.alicdn.com/p/af18d0b913e5957606bee9b68dc3c98d.png', '10', 8, '2023-04-29 15:04:46');

-- --------------------------------------------------------

--
-- Structure de la table `shopping cart`
--

DROP TABLE IF EXISTS `shopping cart`;
CREATE TABLE IF NOT EXISTS `shopping cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` text NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELATIONS POUR LA TABLE `shopping cart`:
--

--
-- Déchargement des données de la table `shopping cart`
--

INSERT INTO `shopping cart` (`id`, `status`, `quantity`) VALUES
(1, 'completed', 0),
(9, 'completed', 6),
(10, 'completed', 2);

-- --------------------------------------------------------

--
-- Structure de la table `shoppingcartproduct`
--

DROP TABLE IF EXISTS `shoppingcartproduct`;
CREATE TABLE IF NOT EXISTS `shoppingcartproduct` (
  `shopping_cart_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`shopping_cart_id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELATIONS POUR LA TABLE `shoppingcartproduct`:
--

--
-- Déchargement des données de la table `shoppingcartproduct`
--

INSERT INTO `shoppingcartproduct` (`shopping_cart_id`, `product_id`, `quantity`) VALUES
(1, 1, 2),
(2, 1, 2),
(9, 1, 2),
(10, 2, 3),
(11, 5, 2),
(12, 6, 1),
(13, 1, 2),
(14, 2, 3),
(15, 5, 2),
(16, 6, 1),
(17, 1, 2),
(18, 2, 3),
(19, 5, 2),
(20, 6, 1),
(21, 1, 2),
(22, 5, 1),
(23, 1, 1),
(24, 2, 3),
(25, 1, 2),
(26, 1, 4),
(27, 6, 2),
(28, 5, 1),
(29, 6, 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
