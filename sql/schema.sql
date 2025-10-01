-- Schema for Doodle Poultry (formerly epms_db)

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- Database: `doodle_db`
CREATE DATABASE IF NOT EXISTS `doodle_db` DEFAULT CHARACTER SET utf8mb4;
USE `doodle_db`;

-- --------------------------------------------------------
-- Table structure for table `BirdsMortality`
CREATE TABLE IF NOT EXISTS `BirdsMortality` (
  `BirdsMortality_ID` int(11) NOT NULL,
  `Date` date NOT NULL,
  `Deaths` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- Table structure for table `BirdsPurchase`
CREATE TABLE IF NOT EXISTS `BirdsPurchase` (
  `BirdsPurchase_ID` int(11) NOT NULL,
  `Date` date NOT NULL,
  `NumberOfBirds` int(11) NOT NULL,
  `Price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- Table structure for table `Employee`
CREATE TABLE IF NOT EXISTS `Employee` (
  `Employee_ID` int(11) NOT NULL,
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `Phone` varchar(10) NOT NULL,
  `Job` varchar(50) NOT NULL,
  `Salary` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- Table structure for table `FeedConsumption`
CREATE TABLE IF NOT EXISTS `FeedConsumption` (
  `FeedConsumption_ID` int(11) NOT NULL,
  `ConsDate` date NOT NULL,
  `Quantity` float NOT NULL,
  `Price` float NOT NULL,
  `Employee` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- Table structure for table `FeedPurchase`
CREATE TABLE IF NOT EXISTS `FeedPurchase` (
  `FeedPurchase_ID` int(11) NOT NULL,
  `Date` date NOT NULL,
  `Quantity` float NOT NULL,
  `Price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- Table structure for table `Production`
CREATE TABLE IF NOT EXISTS `Production` (
  `Production_ID` int(11) NOT NULL,
  `Date` date NOT NULL,
  `NumberOfEggs` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- Table structure for table `Sales`
CREATE TABLE IF NOT EXISTS `Sales` (
  `Sales_ID` int(11) NOT NULL,
  `Date` date NOT NULL,
  `NumberOfEggs` int(11) NOT NULL,
  `Revenue` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- Table structure for table `User`
CREATE TABLE IF NOT EXISTS `User` (
  `User_ID` int(11) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Seed only the admin account
INSERT INTO `User` (`User_ID`, `Username`, `Password`) VALUES
(1, 'admin', 'password')
ON DUPLICATE KEY UPDATE `Username` = VALUES(`Username`), `Password` = VALUES(`Password`);

-- Indexes
ALTER TABLE `BirdsMortality` ADD PRIMARY KEY (`BirdsMortality_ID`);
ALTER TABLE `BirdsPurchase` ADD PRIMARY KEY (`BirdsPurchase_ID`);
ALTER TABLE `Employee` ADD PRIMARY KEY (`Employee_ID`);
ALTER TABLE `FeedConsumption` ADD PRIMARY KEY (`FeedConsumption_ID`), ADD KEY `Employee` (`Employee`);
ALTER TABLE `FeedPurchase` ADD PRIMARY KEY (`FeedPurchase_ID`);
ALTER TABLE `Production` ADD PRIMARY KEY (`Production_ID`);
ALTER TABLE `Sales` ADD PRIMARY KEY (`Sales_ID`);
ALTER TABLE `User` ADD PRIMARY KEY (`User_ID`);

-- Auto_increment
ALTER TABLE `BirdsMortality` MODIFY `BirdsMortality_ID` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `BirdsPurchase` MODIFY `BirdsPurchase_ID` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `Employee` MODIFY `Employee_ID` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `FeedConsumption` MODIFY `FeedConsumption_ID` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `FeedPurchase` MODIFY `FeedPurchase_ID` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `Production` MODIFY `Production_ID` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `Sales` MODIFY `Sales_ID` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `User` MODIFY `User_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

-- Foreign keys
ALTER TABLE `FeedConsumption`
  ADD CONSTRAINT `FeedConsumption_ibfk_1` FOREIGN KEY (`Employee`) REFERENCES `Employee` (`Employee_ID`);

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
