-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 11, 2020 at 12:17 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mydb`
--

-- --------------------------------------------------------

--
-- Table structure for table `CALL`
--

CREATE TABLE `CALL` (
  `Call_ID` int(11) NOT NULL,
  `Complaint_ID` int(11) DEFAULT NULL,
  `Employee_ID` int(11) DEFAULT NULL,
  `Call_Time` time NOT NULL,
  `Call_Date` date NOT NULL,
  `Operator_ID` int(11) NOT NULL,
  `Call_Reason` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `CALL`
--

INSERT INTO `CALL` (`Call_ID`, `Complaint_ID`, `Employee_ID`, `Call_Time`, `Call_Date`, `Operator_ID`, `Call_Reason`) VALUES
(12, 12345, 1234, '14:08:25', '2020-01-01', 7890, 'Initial complaint report'),
(13, 26542, 4567, '10:29:38', '2020-01-10', 7890, 'Initial complaint report'),
(14, 67589, 2345, '11:11:52', '2020-02-05', 7890, 'Initial complaint report'),
(15, 56342, 9874, '13:15:23', '2020-02-21', 8901, 'Initial complaint report'),
(16, 98765, 3456, '15:19:01', '2020-03-03', 8901, 'Initial complaint report'),
(17, 92340, 3456, '09:18:32', '2020-03-18', 4321, 'Initial complaint report'),
(18, 85670, 5678, '10:26:48', '2020-03-20', 8901, 'Initial complaint report'),
(19, 53860, 5432, '00:00:00', '2020-04-05', 4321, 'Initial complaint report'),
(20, 12938, 5432, '11:27:55', '2020-04-06', 7890, 'Initial complaint report'),
(21, 53860, 5432, '13:12:48', '2020-04-05', 4321, 'Problem status check'),
(22, 12938, 5432, '16:09:34', '2020-04-06', 7890, 'Problem status check');

-- --------------------------------------------------------

--
-- Table structure for table `COMPLAINT`
--

CREATE TABLE `COMPLAINT` (
  `Complaint_ID` int(11) NOT NULL,
  `Complaint_Type` varchar(45) NOT NULL,
  `Date_Logged` date NOT NULL,
  `Hardware_Serial` varchar(6) NOT NULL,
  `Specialist_Required` tinyint(4) NOT NULL,
  `Status` tinyint(4) NOT NULL,
  `Completion_Date` date DEFAULT NULL,
  `Comments` varchar(10000) DEFAULT NULL,
  `Hours_Taken` decimal(10,0) DEFAULT NULL,
  `Specialist_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `COMPLAINT`
--

INSERT INTO `COMPLAINT` (`Complaint_ID`, `Complaint_Type`, `Date_Logged`, `Hardware_Serial`, `Specialist_Required`, `Status`, `Completion_Date`, `Comments`, `Hours_Taken`, `Specialist_ID`) VALUES
(12345, 'Hardware Error', '2020-01-01', 'HW1122', 1, 1, '2020-01-01', 'Replaced fuse', '1', 1112),
(12938, 'Hardware error', '2020-04-06', 'HW4325', 1, 0, '0000-00-00', 'Constantly crashing', '0', 1116),
(26542, 'Hardware Error', '2020-01-10', 'HW1129', 0, 1, '2020-01-10', 'User error identified', '1', NULL),
(53860, 'Hardware Error', '2020-04-05', 'HW9248', 1, 0, '0000-00-00', 'Printer malfunctioning', '0', 1115),
(56342, 'Software Error', '2020-02-21', 'HW1122', 1, 1, '2020-02-21', 'OS crashing, updated', '2', 1112),
(67589, 'Hardware Error', '2020-02-05', 'HW9248', 1, 1, '2020-02-05', 'Paper jam', '2', 1116),
(85670, 'Hardware Error', '2020-03-20', 'HW1123', 0, 1, '2020-03-20', 'Not plugged in', '1', NULL),
(92340, 'Software Error', '2020-03-18', 'HW9248', 1, 1, '2020-03-18', 'manual reconfig needed', '2', 1114),
(98765, 'Software Error', '2020-03-03', 'HW7766', 1, 1, '2020-03-04', 'OS reinstalled', '4', 1113);

-- --------------------------------------------------------

--
-- Table structure for table `EMPLOYEE`
--

CREATE TABLE `EMPLOYEE` (
  `Employee_ID` int(11) NOT NULL,
  `First_Name` varchar(45) NOT NULL,
  `Last_Name` varchar(45) NOT NULL,
  `Job_ID` int(11) DEFAULT NULL,
  `Department` varchar(45) DEFAULT NULL,
  `User_Password` varbinary(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `EMPLOYEE`
--

INSERT INTO `EMPLOYEE` (`Employee_ID`, `First_Name`, `Last_Name`, `Job_ID`, `Department`, `User_Password`) VALUES
(1234, 'Abigail', 'Archer', 123, 'Accounting', NULL),
(2233, 'Aron', 'Piper', 999, 'Management', 0xf7a3b7ea4f048d7ef31121c86e3c66df),
(2345, 'Ben', 'Brown', 123, 'Accounting', NULL),
(2468, 'Oscar', 'Owens', 876, 'Research and Development', 0x511c101273e06fde743859694d9c613a),
(3123, 'James', 'Joy', 876, 'Research and Development', 0x7ec72c5d0ffd7e04228864b05dcf9df7),
(3456, 'Carrie', 'Carter', 321, 'Human Resources', NULL),
(4321, 'Naomi', 'Nelson', 543, 'Help Desk', 0x2d9ec655ef38c632ef82b30c85cd99d1),
(4567, 'David', 'Drake', 321, 'Human Resources', NULL),
(5227, 'Pablo', 'Mateos García', 999, 'Management', 0x79e02b80b57c0a2cdb768a0b18192cc1),
(5432, 'Matthew', 'Mason', 345, 'Data Entry', NULL),
(5678, 'Emma', 'Ealing', 345, 'Data Entry', NULL),
(6789, 'Frank', 'Frances', 345, 'Data Entry', NULL),
(7890, 'Gemma', 'Green', 543, 'Help Desk', 0x845eaf3b47e8c9b336a17b1466720949),
(8765, 'Luke', 'Leslie', 321, 'Human Resources', NULL),
(8901, 'Harry', 'Hughes', 543, 'Help Desk', 0x8d802b47c3b23fb40d5ca508453359ae),
(9012, 'Ivy', 'Irving', 876, 'Research and Development', 0xbfc0cfdd37efcb39be3a36091aba035a),
(9874, 'Kylie', 'Kane', 123, 'Accounting', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `HARDWARE`
--

CREATE TABLE `HARDWARE` (
  `Hardware_Serial` varchar(6) NOT NULL,
  `Hardware_Type` varchar(45) NOT NULL,
  `Hardware_Brand` varchar(45) DEFAULT NULL,
  `Software_ID` varchar(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `HARDWARE`
--

INSERT INTO `HARDWARE` (`Hardware_Serial`, `Hardware_Type`, `Hardware_Brand`, `Software_ID`) VALUES
('HW1122', 'Laptop', 'Lenovo Thinkpad', 'ID1111'),
('HW1123', 'Desktop PC', 'Apple iMac', 'ID9999'),
('HW1129', 'Desktop PC', 'Dell Inspiron', 'ID2222'),
('HW1323', 'Laptop', 'Lenovo Thinkpad', 'ID1111'),
('HW4325', 'Desktop PC', 'Dell Inspiron', 'ID2222'),
('HW7766', 'Laptop', 'Acer Aspire', 'ID8888'),
('HW8472', 'Printer', 'HP Deskjet 2630', NULL),
('HW9248', 'Printer', 'HP Deskjet 2630', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `SOFTWARE`
--

CREATE TABLE `SOFTWARE` (
  `Software_ID` varchar(6) NOT NULL,
  `Software_Name` varchar(45) NOT NULL,
  `Issue_Dat` date DEFAULT NULL,
  `License_Status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `SOFTWARE`
--

INSERT INTO `SOFTWARE` (`Software_ID`, `Software_Name`, `Issue_Dat`, `License_Status`) VALUES
('ID1111', 'Windows 10', '2019-05-01', 1),
('ID2222', 'Windows 7', '2011-06-20', 1),
('ID8888', 'Ubuntu 19.10', '2020-01-01', 1),
('ID9999', 'macOS Catalina', '2019-10-30', 1);

-- --------------------------------------------------------

--
-- Table structure for table `SPECIALIST`
--

CREATE TABLE `SPECIALIST` (
  `Specialist_ID` int(11) NOT NULL,
  `First_Name` varchar(45) NOT NULL,
  `Last_Name` varchar(45) NOT NULL,
  `Field` varchar(45) NOT NULL,
  `User_Password` varbinary(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `SPECIALIST`
--

INSERT INTO `SPECIALIST` (`Specialist_ID`, `First_Name`, `Last_Name`, `Field`, `User_Password`) VALUES
(1112, 'Percy', 'Phillips', 'Software', 0xd5a7b69d2e21e52356a23912e8bf0610),
(1113, 'Robin', 'Richards', 'Software', 0x6efa9650b60ca54277d1a343fb74ee53),
(1114, 'Stacey', 'Stevens', 'Software', 0x9bcfccc922d05ac60dbfcd065b48f3bf),
(1115, 'Tina', 'Trevor', 'Hardware', 0xc37ecb45aab18eac90077c3282f02d79),
(1116, 'Vince', 'Vickers', 'Hardware', 0xc6cb44216362a594a69342151c9cde20),
(1117, 'Adam', 'August', 'Hardware', 0xd0c033bee68576e3cade0ad32d2ad673);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `CALL`
--
ALTER TABLE `CALL`
  ADD PRIMARY KEY (`Call_ID`),
  ADD KEY `Complaint_ID_idx` (`Complaint_ID`),
  ADD KEY `Employee_ID_idx` (`Employee_ID`),
  ADD KEY `Operator_ID_idx` (`Operator_ID`);

--
-- Indexes for table `COMPLAINT`
--
ALTER TABLE `COMPLAINT`
  ADD PRIMARY KEY (`Complaint_ID`),
  ADD KEY `Hardware_Serial_idx` (`Hardware_Serial`),
  ADD KEY `Specialist_ID_idx` (`Specialist_ID`);

--
-- Indexes for table `EMPLOYEE`
--
ALTER TABLE `EMPLOYEE`
  ADD PRIMARY KEY (`Employee_ID`);

--
-- Indexes for table `HARDWARE`
--
ALTER TABLE `HARDWARE`
  ADD PRIMARY KEY (`Hardware_Serial`),
  ADD KEY `Software_ID_idx` (`Software_ID`);

--
-- Indexes for table `SOFTWARE`
--
ALTER TABLE `SOFTWARE`
  ADD PRIMARY KEY (`Software_ID`);

--
-- Indexes for table `SPECIALIST`
--
ALTER TABLE `SPECIALIST`
  ADD PRIMARY KEY (`Specialist_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `CALL`
--
ALTER TABLE `CALL`
  MODIFY `Call_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `COMPLAINT`
--
ALTER TABLE `COMPLAINT`
  MODIFY `Complaint_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98766;

--
-- AUTO_INCREMENT for table `EMPLOYEE`
--
ALTER TABLE `EMPLOYEE`
  MODIFY `Employee_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9875;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `CALL`
--
ALTER TABLE `CALL`
  ADD CONSTRAINT `Complaint_ID` FOREIGN KEY (`Complaint_ID`) REFERENCES `COMPLAINT` (`Complaint_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `Employee_ID` FOREIGN KEY (`Employee_ID`) REFERENCES `EMPLOYEE` (`Employee_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `Operator_ID` FOREIGN KEY (`Operator_ID`) REFERENCES `EMPLOYEE` (`Employee_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `COMPLAINT`
--
ALTER TABLE `COMPLAINT`
  ADD CONSTRAINT `Hardware_Serial` FOREIGN KEY (`Hardware_Serial`) REFERENCES `HARDWARE` (`Hardware_Serial`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `Specialist_ID` FOREIGN KEY (`Specialist_ID`) REFERENCES `SPECIALIST` (`Specialist_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `HARDWARE`
--
ALTER TABLE `HARDWARE`
  ADD CONSTRAINT `Software_ID` FOREIGN KEY (`Software_ID`) REFERENCES `SOFTWARE` (`Software_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
