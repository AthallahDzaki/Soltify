-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 16, 2024 at 04:35 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `soltify`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_coins`
--

CREATE TABLE `tb_coins` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `stands` varchar(255) NOT NULL,
  `api_endpoint` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_coins`
--

INSERT INTO `tb_coins` (`id`, `name`, `stands`, `api_endpoint`, `image`) VALUES
(1, 'Bitcoin', 'BTC', 'btc', 'uploads/67418df49fd8c0.60121593.png'),
(2, 'Ethereum', 'ETH', 'eth', 'uploads/67418e63f35255.01258380.png');

-- --------------------------------------------------------

--
-- Table structure for table `tb_transactions`
--

CREATE TABLE `tb_transactions` (
  `id` int(11) NOT NULL COMMENT 'SQL Id For Transaction',
  `txid` varchar(255) NOT NULL,
  `owner` int(11) NOT NULL,
  `wallet_address` varchar(255) NOT NULL,
  `dest_wallet_address` varchar(255) NOT NULL,
  `crypto` int(11) NOT NULL,
  `status` set('Success','Pending','Failed') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_transactions`
--

INSERT INTO `tb_transactions` (`id`, `txid`, `owner`, `wallet_address`, `dest_wallet_address`, `crypto`, `status`) VALUES
(1, 'BVxN75QUZxyqmH0yO74XY8ydWn40Q', 1, 'BTCGthqeEz5AV1QWcvbgfXCF1Cwhu', 'BTCZWHDUVDJRSIWSY2VQSFTKIYXNH', 1, 'Pending'),
(2, 'LxQcisfJ86gQLk6kcexaBJVWSAelbR', 1, 'LTC5HZI2Z8K6NI6AM24WOQSUH49EXK', 'LTCVBUYGGA4RG2O6LUDE96T8RJ19LA', 2, 'Success');

-- --------------------------------------------------------

--
-- Table structure for table `tb_users`
--

CREATE TABLE `tb_users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_users`
--

INSERT INTO `tb_users` (`id`, `username`, `email`, `password`, `role`) VALUES
(1, 'admin', 'admin123@admin.com', '$argon2id$v=19$m=65536,t=4,p=1$UGtJcEZlZG5BUVBWeEtFZA$/D1T4Fenjjba6+rkRDNMzim+dwg5ggz/jJ8Eo3TVejw', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_wallets`
--

CREATE TABLE `tb_wallets` (
  `id` int(11) NOT NULL,
  `wallet_owner` int(11) NOT NULL,
  `wallet_address` varchar(255) NOT NULL,
  `wallet_balance` double NOT NULL,
  `wallet_coin_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_wallets`
--

INSERT INTO `tb_wallets` (`id`, `wallet_owner`, `wallet_address`, `wallet_balance`, `wallet_coin_id`) VALUES
(2, 1, 'bc1q7wcefjjpwcmh4eqa0twa8taq2lr0hy6awztw06', 0, 1),
(3, 1, '1FixUH58ToJkiCT6tnfMoSwAzP2w1c7uoK', 0, 1),
(8, 1, '0x76c9C1542cF2AA01a031b3c06e06f4241560Af5A', 0, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_coins`
--
ALTER TABLE `tb_coins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_transactions`
--
ALTER TABLE `tb_transactions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `txid` (`txid`),
  ADD KEY `crypto_id` (`crypto`);

--
-- Indexes for table `tb_users`
--
ALTER TABLE `tb_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `tb_wallets`
--
ALTER TABLE `tb_wallets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `owner_id` (`wallet_owner`),
  ADD KEY `coin_id` (`wallet_coin_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_coins`
--
ALTER TABLE `tb_coins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_transactions`
--
ALTER TABLE `tb_transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'SQL Id For Transaction', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_users`
--
ALTER TABLE `tb_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_wallets`
--
ALTER TABLE `tb_wallets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_transactions`
--
ALTER TABLE `tb_transactions`
  ADD CONSTRAINT `crypto_id` FOREIGN KEY (`crypto`) REFERENCES `tb_coins` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tb_wallets`
--
ALTER TABLE `tb_wallets`
  ADD CONSTRAINT `coin_id` FOREIGN KEY (`wallet_coin_id`) REFERENCES `tb_coins` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `owner_id` FOREIGN KEY (`wallet_owner`) REFERENCES `tb_users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
