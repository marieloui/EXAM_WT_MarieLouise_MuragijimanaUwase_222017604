-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2024 at 09:31 AM
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
-- Database: `onlinetherapyplatform`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `therapist_id` int(11) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `appointment_time` time DEFAULT NULL,
  `appointment_notes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`therapist_id`, `client_id`, `appointment_time`, `appointment_notes`) VALUES
(1, 1, '10:00:00', 'check up'),
(1, 1, '10:00:00', 'check up'),
(1, 1, '10:00:00', 'check up'),
(1, 1, '10:00:00', 'check up');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `client_id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telephone` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`client_id`, `full_name`, `email`, `telephone`) VALUES
(1, 'gigi', 'gig@gmail.com', 9888),
(3, 'yoo', 'yo@gmail.com', 5666),
(5, 'ali', 'ali@gmail.com', 4555),
(7, 'alia', 'alia@gmail.com', 455566),
(9, 'hosea', 'ho@gmail.com', 3444);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `therapist_id` int(11) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `message_content` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`therapist_id`, `client_id`, `message_content`) VALUES
(1, 1, 'trauma healing is what to be considered please!'),
(1, 1, 'trauma considaration please@'),
(2, 3, 'depression check up');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `client_id` int(11) DEFAULT NULL,
  `therapist_id` int(11) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `payment_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`client_id`, `therapist_id`, `amount`, `payment_date`) VALUES
(1, 1, 30000.00, '2024-04-13');

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `username` text NOT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`id`, `firstname`, `lastname`, `username`, `telephone`, `password`, `email`) VALUES
(1, 'marie', 'loise', '', '0788877', '$2y$10$Z.ChTKHQsbLDh.rMLcMsb.rnkF23HEGdkmeZXF4f1kp/9rBzrHnTS', ''),
(10, 'mama', 'loui', 'malou', '08926', '$2y$10$CUF7x1h.MY/cvCAo60yMKuIU4FOUqaEQhMyNk51YyuBaeWThL4qHm', 'ko@gmail.com'),
(11, 'kok', 'kate', '', '0789999', '$2y$10$G/GuBZ2MVuluQwmGA8Xc5.EcM.qZzt.gkUUPcqMAkyENW3fYJlAT6', 'mo@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `therapist_id` int(11) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `review_text` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`therapist_id`, `client_id`, `rating`, `review_text`) VALUES
(1, 1, 0, 'bad therapist');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `therapist_id` int(11) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `session_notes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`therapist_id`, `client_id`, `start_time`, `end_time`, `session_notes`) VALUES
(1, 1, NULL, '08:45:00', '09:46'),
(1, 1, '08:45:00', '09:46:00', NULL),
(1, 1, '08:45:00', '09:46:00', 'healing');

-- --------------------------------------------------------

--
-- Table structure for table `therapists`
--

CREATE TABLE `therapists` (
  `therapist_id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `specialization` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `therapists`
--

INSERT INTO `therapists` (`therapist_id`, `full_name`, `email`, `specialization`) VALUES
(1, 'perre', 'per@gmail.com', 'general'),
(2, 'noa', 'noa@gmail.com', 'emergency');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD KEY `fk_therapist_appointment` (`therapist_id`),
  ADD KEY `fk_client_appointment` (`client_id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`client_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD KEY `fk_therapists` (`therapist_id`),
  ADD KEY `fk_clients` (`client_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD KEY `fk_client_payment` (`client_id`),
  ADD KEY `fk_therapist_payment` (`therapist_id`);

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD KEY `fk_therapist_review` (`therapist_id`),
  ADD KEY `fk_client_review` (`client_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD KEY `fk_therapist` (`therapist_id`),
  ADD KEY `fk_client` (`client_id`);

--
-- Indexes for table `therapists`
--
ALTER TABLE `therapists`
  ADD PRIMARY KEY (`therapist_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `therapists`
--
ALTER TABLE `therapists`
  MODIFY `therapist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `fk_client_appointment` FOREIGN KEY (`client_id`) REFERENCES `clients` (`client_id`),
  ADD CONSTRAINT `fk_therapist_appointment` FOREIGN KEY (`therapist_id`) REFERENCES `therapists` (`therapist_id`);

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `fk_clients` FOREIGN KEY (`client_id`) REFERENCES `clients` (`client_id`),
  ADD CONSTRAINT `fk_therapists` FOREIGN KEY (`therapist_id`) REFERENCES `therapists` (`therapist_id`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `fk_client_payment` FOREIGN KEY (`client_id`) REFERENCES `clients` (`client_id`),
  ADD CONSTRAINT `fk_therapist_payment` FOREIGN KEY (`therapist_id`) REFERENCES `therapists` (`therapist_id`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `fk_client_review` FOREIGN KEY (`client_id`) REFERENCES `clients` (`client_id`),
  ADD CONSTRAINT `fk_therapist_review` FOREIGN KEY (`therapist_id`) REFERENCES `therapists` (`therapist_id`);

--
-- Constraints for table `sessions`
--
ALTER TABLE `sessions`
  ADD CONSTRAINT `fk_client` FOREIGN KEY (`client_id`) REFERENCES `clients` (`client_id`),
  ADD CONSTRAINT `fk_therapist` FOREIGN KEY (`therapist_id`) REFERENCES `therapists` (`therapist_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
