SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- Database එක පවතී නම් එය මකා අලුතින් සකස් කිරීම
DROP DATABASE IF EXISTS `library_management_system`;
CREATE DATABASE `library_management_system`;
USE `library_management_system`;

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- --------------------------------------------------------
-- Table structure for table `bookcategory`
-- --------------------------------------------------------

CREATE TABLE `bookcategory` (
  `category_id` varchar(5) NOT NULL,
  `category_Name` varchar(100) NOT NULL,
  `date_modified` varchar(100) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `bookcategory` (`category_id`, `category_Name`, `date_modified`) VALUES
('C001', 'Sci-fi', '2014-08-12 11:14:54am'),
('C002', 'Adventure', '2014-08-13 11:14:54am');

-- --------------------------------------------------------
-- Table structure for table `book`
-- --------------------------------------------------------

CREATE TABLE `book` (
  `book_id` varchar(5) NOT NULL,
  `book_name` varchar(100) NOT NULL,
  `category_id` varchar(5) NOT NULL,
  PRIMARY KEY (`book_id`),
  KEY `fk_cat_id` (`category_id`),
  CONSTRAINT `fk_cat_id` FOREIGN KEY (`category_id`) REFERENCES `bookcategory` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `book` (`book_id`, `book_name`, `category_id`) VALUES
('B001', 'Harry Potter 1', 'C001');

-- --------------------------------------------------------
-- Table structure for table `member`
-- --------------------------------------------------------

CREATE TABLE `member` (
  `member_id` varchar(5) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `birthday` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  PRIMARY KEY (`member_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `member` (`member_id`, `first_name`, `last_name`, `birthday`, `email`) VALUES
('M001', 'Shan', 'Jayasekar', '12/02/2000', 'shan@gmail.com');

-- --------------------------------------------------------
-- Table structure for table `bookborrower`
-- --------------------------------------------------------

CREATE TABLE `bookborrower` (
  `borrow_id` varchar(5) NOT NULL,
  `book_id` varchar(5) NOT NULL,
  `member_id` varchar(5) NOT NULL,
  `borrow_status` varchar(100) NOT NULL,
  `borrower_date_modified` varchar(100) NOT NULL,
  PRIMARY KEY (`borrow_id`,`book_id`,`member_id`),
  KEY `fk_book_id` (`book_id`),
  KEY `fk_member_id` (`member_id`),
  CONSTRAINT `fk_book_id` FOREIGN KEY (`book_id`) REFERENCES `book` (`book_id`) ON UPDATE CASCADE,
  CONSTRAINT `fk_member_id` FOREIGN KEY (`member_id`) REFERENCES `member` (`member_id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `bookborrower` (`borrow_id`, `book_id`, `member_id`, `borrow_status`, `borrower_date_modified`) VALUES
('BR001', 'B001', 'M001', 'borrowed', '2014-08-10 11:14:54am');

-- --------------------------------------------------------
-- Table structure for table `fine`
-- --------------------------------------------------------

CREATE TABLE `fine` (
  `fine_id` varchar(5) NOT NULL,
  `book_id` varchar(5) NOT NULL,
  `member_id` varchar(5) NOT NULL,
  `fine_amount` varchar(100) NOT NULL,
  `fine_date_modified` varchar(100) NOT NULL,
  PRIMARY KEY (`fine_id`),
  KEY `fk_book_id_fine` (`book_id`),
  CONSTRAINT `fk_book_id_fine` FOREIGN KEY (`book_id`) REFERENCES `book` (`book_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `fine` (`fine_id`, `book_id`, `member_id`, `fine_amount`, `fine_date_modified`) VALUES
('F001', 'B001', 'M001', '200', '2014-08-18 11:14:54am');

-- --------------------------------------------------------
-- Table structure for table `user`
-- --------------------------------------------------------

CREATE TABLE `user` (
  `user_id` varchar(5) NOT NULL,
  `email` varchar(100) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `user` (`user_id`, `email`, `first_name`, `last_name`, `username`, `password`) VALUES
('U001', 'kamal@gmail.com', 'Kamal', 'Perera', 'k_perera', 'admin123');

COMMIT;