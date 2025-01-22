-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 23, 2025 at 01:51 AM
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
-- Database: `jcridb`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblapplicants`
--

CREATE TABLE `tblapplicants` (
  `APPLICANTID` int(11) NOT NULL,
  `FNAME` varchar(90) NOT NULL,
  `LNAME` varchar(90) NOT NULL,
  `MNAME` varchar(90) NOT NULL,
  `ADDRESS` varchar(255) NOT NULL,
  `SEX` varchar(11) NOT NULL,
  `CIVILSTATUS` varchar(30) NOT NULL,
  `BIRTHDATE` date NOT NULL,
  `BIRTHPLACE` varchar(255) NOT NULL,
  `AGE` int(2) NOT NULL,
  `USERNAME` varchar(90) NOT NULL,
  `PASS` varchar(90) NOT NULL,
  `EMAILADDRESS` varchar(90) NOT NULL,
  `CONTACTNO` varchar(90) NOT NULL,
  `DEGREE` text NOT NULL,
  `APPLICANTPHOTO` varchar(255) NOT NULL,
  `NATIONALID` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblapplicants`
--

INSERT INTO `tblapplicants` (`APPLICANTID`, `FNAME`, `LNAME`, `MNAME`, `ADDRESS`, `SEX`, `CIVILSTATUS`, `BIRTHDATE`, `BIRTHPLACE`, `AGE`, `USERNAME`, `PASS`, `EMAILADDRESS`, `CONTACTNO`, `DEGREE`, `APPLICANTPHOTO`, `NATIONALID`) VALUES
(2018013, 'Kim', 'Domingo', 'Enoe', 'Kab City', 'Female', 'none', '1991-01-01', 'Kab Citys', 27, 'kim', 'a6312121e15caec74845b7ba5af23330d52d4ac0', 'kim@y.com', '5415456', 'BSAC', 'photos/RobloxScreenShot20180406_203758793.png', ''),
(2018014, 'Jake', 'Zyrus', 'Ilmba', 'Kab City', 'Female', 'none', '1993-01-16', 'Kab City', 25, 'jake', 'c8d99c2f7cd5f432c163abcd422672b9f77550bb', 'jake@y.com', '14655623123123', 'BSIT', '', ''),
(2018015, 'Janry', 'Tan', 'Lim', 'brgy 1 Kab City', 'Female', 'Single', '1992-01-30', 'Kab City', 26, 'janry', '1dd4efc811372cd1efe855981a8863d10ddde1ca', 'jan@gmail.com', '0234234', 'BSIT', '', ''),
(2025016, 'Neil Oliver', 'Regondola', 'Jerus', 'Dyan lang samin', 'Female', 'none', '2002-08-09', 'Sampaloc, Manila', 22, 'Neilneil', '32932454372d21c1e59aec1b1168b91fa0dea5a6', 'neiloliverxxx@gmail.com', '09478251234', 'College', 'photos/zoro1.jpg', ''),
(2025017, 'Ei', 'Raiden Shogun', '', '1232 fasdfdasfdasf dafafadfedafsdcvjhbZ', 'Female', 'none', '2000-02-29', 'adsfasdf', 24, 'yassan', 'd664747ea9f7f25cc9de3c6cafe1304061aab4b4', 'yass@gmail.com', '13212', 'BSBA', 'photos/__raiden_shogun_genshin_impact_drawn_by_cloba__sample-4f7b30a587f68b638c11dce882941d2e.jpg', ''),
(2025018, 'Ken', 'Takakura', '', 'Japan', 'Male', 'Single', '2002-07-18', 'Japan', 22, 'dandadan', 'da63375227b86e1db22b85b4eec58272a30944b9', 'Kentaka@emai.com', '12345425', 'BS Cult and Aliens', 'photos/image_2025-01-21_232350050.png', ''),
(2025023, 'Momo', 'Ayase', 'fadf', '34232', 'Female', 'Single', '1993-07-19', 'afdsf', 31, 'momo', '77add44f8f13cf5b3298a7833613aca42430386d', 'momo@email.com', '23423', 'avdf', 'photos/image_2025-01-21_235905627.png', ''),
(2025025, 'test', 'test', 'test', 'test', 'Male', 'Single', '1994-04-17', 'test', 30, 'test', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 'test@gmail.com', 'test', 'test', '', ''),
(2025026, 'test2', 'test2', 'test2', 'test2', 'Female', 'Married', '1995-05-16', 'test2', 29, 'test2', '109f4b3c50d7b0df729d299bc6f8e9ef9066971f', 'test2@gmail.com', 'test2', 'test2', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tblattachmentfile`
--

CREATE TABLE `tblattachmentfile` (
  `ID` int(11) NOT NULL,
  `FILEID` varchar(30) DEFAULT NULL,
  `JOBID` int(11) NOT NULL,
  `FILE_NAME` varchar(90) NOT NULL,
  `FILE_LOCATION` varchar(255) NOT NULL,
  `USERATTACHMENTID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblattachmentfile`
--

INSERT INTO `tblattachmentfile` (`ID`, `FILEID`, `JOBID`, `FILE_NAME`, `FILE_LOCATION`, `USERATTACHMENTID`) VALUES
(2, '2147483647', 2, 'Resume', 'photos/27052018124027PLATENO FE95483.docx', 2018013),
(3, '20256912529', 2, 'Resume', 'photos/13012025044201JERUS.docx', 2025016),
(4, '20256912530', 1, 'Resume', 'photos/140120250638511.docx', 2025016),
(5, '20256912531', 2, 'Resume', 'photos/140120250656461.docx', 2025016),
(6, '20256912532', 3, 'Resume', 'photos/14012025073839git.txt', 2025016),
(7, '20256912533', 8, 'Resume', 'photos/15012025073002neil1.docx', 2025016),
(8, '20256912535', 4, 'Resume', 'photos/21012025062505plate.pdf', 2025017),
(9, '20256912536', 4, 'Resume', 'photos/21012025062551ABSTRAK FSPL.pdf', 2025017),
(10, '20256912537', 5, 'Resume', 'photos/21012025063611dian plate sampl2.pdf', 2025017),
(11, '20256912538', 6, 'Resume', 'photos/21012025063641DFD.docx', 2025017),
(12, '20256912542', 7, '2025017_resume', 'photos/21012025071825DFD.docx', 2025017),
(13, '20256912543', 16, '2025018_resume', 'photos/21012025113534DFD.docx', 2025018),
(14, '20256912544', 4, '2025024_resume', 'photos/22012025120106DFD.docx', 2025024),
(15, '20256912545', 5, '2025025_resume', 'photos/22012025121028receipt.pdf', 2025025),
(16, '20256912546', 5, '2025026_resume', 'photos/22012025121239trippings.docx', 2025026);

-- --------------------------------------------------------

--
-- Table structure for table `tblautonumbers`
--

CREATE TABLE `tblautonumbers` (
  `AUTOID` int(11) NOT NULL,
  `AUTOSTART` varchar(30) NOT NULL,
  `AUTOEND` int(11) NOT NULL,
  `AUTOINC` int(11) NOT NULL,
  `AUTOKEY` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblautonumbers`
--

INSERT INTO `tblautonumbers` (`AUTOID`, `AUTOSTART`, `AUTOEND`, `AUTOINC`, `AUTOKEY`) VALUES
(1, '02983', 8, 1, 'userid'),
(2, '000', 79, 1, 'employeeid'),
(3, '0', 27, 1, 'APPLICANT'),
(4, '69125', 47, 1, 'FILEID');

-- --------------------------------------------------------

--
-- Table structure for table `tblcategory`
--

CREATE TABLE `tblcategory` (
  `CATEGORYID` int(11) NOT NULL,
  `CATEGORY` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblcategory`
--

INSERT INTO `tblcategory` (`CATEGORYID`, `CATEGORY`) VALUES
(10, 'Technology'),
(11, 'Managerial'),
(12, 'Engineer'),
(13, 'IT'),
(14, 'Civil Engineer'),
(15, 'HR'),
(23, 'Sales'),
(24, 'Banking'),
(25, 'Finance'),
(26, 'BPO'),
(27, 'Degital Marketing'),
(28, 'Shipping'),
(29, 'Services');

-- --------------------------------------------------------

--
-- Table structure for table `tblcompany`
--

CREATE TABLE `tblcompany` (
  `COMPANYID` int(11) NOT NULL,
  `COMPANYNAME` varchar(90) NOT NULL,
  `COMPANYADDRESS` varchar(90) NOT NULL,
  `COMPANYCONTACTNO` varchar(30) NOT NULL,
  `COMPANYSTATUS` varchar(90) NOT NULL,
  `COMPANYMISSION` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblcompany`
--

INSERT INTO `tblcompany` (`COMPANYID`, `COMPANYNAME`, `COMPANYADDRESS`, `COMPANYCONTACTNO`, `COMPANYSTATUS`, `COMPANYMISSION`) VALUES
(8, 'Accenture Philippines', 'Mandaluyong City', '+63 2 580 5888', '', ''),
(9, 'IBM Philippines', 'Taguig City', '+63 2 858 3000', '', ''),
(10, 'San Miguel Corporation', 'Mandaluyong City', '+63 2 8632 3000', '', ''),
(11, 'Ayala Corporation', 'Makati City', '+63 2 7908 3000', '', ''),
(12, 'Jollibee Foods Corporation', 'Pasig City', '+63 2 8706 2809', '', ''),
(13, 'Microsoft Philippines', 'Makati City', '+63 2 859 0500', '', ''),
(14, 'Oliver Spread', 'Quezon City, Metro Manila, Philippines', '0922nog2nog pag di 2munog Sira', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tblemployees`
--

CREATE TABLE `tblemployees` (
  `INCID` int(11) NOT NULL,
  `EMPLOYEEID` varchar(30) NOT NULL,
  `FNAME` varchar(50) NOT NULL,
  `LNAME` varchar(50) NOT NULL,
  `MNAME` varchar(50) NOT NULL,
  `ADDRESS` varchar(90) NOT NULL,
  `BIRTHDATE` date NOT NULL,
  `BIRTHPLACE` varchar(90) NOT NULL,
  `AGE` int(11) NOT NULL,
  `SEX` varchar(30) NOT NULL,
  `CIVILSTATUS` varchar(30) NOT NULL,
  `TELNO` varchar(40) NOT NULL,
  `EMP_EMAILADDRESS` varchar(90) NOT NULL,
  `CELLNO` varchar(30) NOT NULL,
  `POSITION` varchar(50) NOT NULL,
  `WORKSTATS` varchar(90) NOT NULL,
  `EMPPHOTO` varchar(255) NOT NULL,
  `EMPUSERNAME` varchar(90) NOT NULL,
  `EMPPASSWORD` varchar(125) NOT NULL,
  `DATEHIRED` date NOT NULL,
  `COMPANYID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblfeedback`
--

CREATE TABLE `tblfeedback` (
  `FEEDBACKID` int(11) NOT NULL,
  `APPLICANTID` int(11) NOT NULL,
  `REGISTRATIONID` int(11) NOT NULL,
  `FEEDBACK` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblfeedback`
--

INSERT INTO `tblfeedback` (`FEEDBACKID`, `APPLICANTID`, `REGISTRATIONID`, `FEEDBACK`) VALUES
(2, 2018015, 2, 'aasd'),
(3, 2025016, 3, 'AYAW KONGA'),
(4, 2025016, 4, 'ayaw ko sayo'),
(5, 2025016, 5, 'AYAW KO'),
(6, 2025016, 6, 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `tbljob`
--

CREATE TABLE `tbljob` (
  `JOBID` int(11) NOT NULL,
  `COMPANYID` int(11) NOT NULL,
  `CATEGORY` varchar(250) NOT NULL,
  `OCCUPATIONTITLE` varchar(90) NOT NULL,
  `REQ_NO_EMPLOYEES` int(11) NOT NULL,
  `SALARIES` double NOT NULL,
  `DURATION_EMPLOYEMENT` varchar(90) NOT NULL,
  `QUALIFICATION_WORKEXPERIENCE` text NOT NULL,
  `JOBDESCRIPTION` text NOT NULL,
  `PREFEREDSEX` varchar(30) NOT NULL,
  `SECTOR_VACANCY` text NOT NULL,
  `JOBSTATUS` varchar(90) NOT NULL,
  `PUBLISHERID` varchar(30) NOT NULL,
  `DATEPOSTED` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbljob`
--

INSERT INTO `tbljob` (`JOBID`, `COMPANYID`, `CATEGORY`, `OCCUPATIONTITLE`, `REQ_NO_EMPLOYEES`, `SALARIES`, `DURATION_EMPLOYEMENT`, `QUALIFICATION_WORKEXPERIENCE`, `JOBDESCRIPTION`, `PREFEREDSEX`, `SECTOR_VACANCY`, `JOBSTATUS`, `PUBLISHERID`, `DATEPOSTED`) VALUES
(4, 8, 'Technology', 'IT Support Specialist', 3, 80000, 'March 27', 'At least 1 year of experience in IT support.', 'Provide technical support for hardware, software, and network-related issues.', 'Male/Female', 'Yes', '', '029837', '2025-01-15 19:22:00'),
(5, 9, 'Technology', 'Cloud Consultant', 6, 100000, 'April 22', 'Experience in cloud platforms (IBM Cloud, AWS, Azure).', 'Design and implement cloud solutions for clients using IBM Cloud technologies', 'Male/Female', 'Yes', '', '029837', '2025-01-15 19:23:00'),
(6, 10, 'Sales', 'Key Account Manager', 10, 55000, 'September 7', 'At least 2 years of experience in key account management', 'Manage and grow relationships with major clients.', 'Male/Female', 'Yes', '', '029837', '2025-01-15 19:25:00'),
(7, 11, 'Managerial', 'Project Manager', 4, 65000, 'August 17', 'Proven experience in project management.', 'Lead and manage projects across various business units.', 'Male', 'Yes', '', '029837', '2025-01-15 19:26:00'),
(8, 12, 'Managerial', 'Restaurant Manager', 12, 30000, '', 'Experience in food and beverage or retail management', 'Oversee daily operations of the restaurant to ensure smooth service.', 'Male/Female', 'Yes', '', '029837', '2025-01-15 19:27:00'),
(9, 13, 'IT', 'Solutions Architect', 2, 90000, 'July 13', 'Extensive knowledge of Microsoft technologies.', 'Design and implement Microsoft-based solutions for enterprise clients', 'Male/Female', 'Yes', '', '029837', '2025-01-15 19:28:00'),
(16, 14, 'Services', 'Customer Service Representative', 0, 0, '', 'At least a high school diploma (College graduates are preferred). Excellent communication skills in English and Filipino. Strong problem-solving skills. Ability to work in a fast-paced environment. Previous customer service experience is an advantage but not required.', 'We are seeking a highly motivated and customer-oriented individual to join our growing team as a Customer Service Representative. The ideal candidate will provide excellent service to our clients, ensuring their inquiries and concerns are addressed promptly and professionally.', 'Male/Female', '', '', '029837', '2025-01-21 22:26:00'),
(17, 9, 'Civil Engineer', 'dasd', 0, 0, '', '', '', 'None', '', '', '00018', '2025-01-21 23:20:00'),
(18, 8, 'IT', 'TEST', 0, 0, '', '', '', 'None', '', '', '00018', '2025-01-23 00:46:00'),
(19, 11, 'Engineer', 'TESTS', 0, 0, '', '', '', 'None', '', '', '00018', '2025-01-23 00:49:00'),
(20, 10, 'HR', 'TEST PBLISHER', 0, 0, '', '', '', 'None', '', '', '00018', '2025-01-23 01:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbljobregistration`
--

CREATE TABLE `tbljobregistration` (
  `REGISTRATIONID` int(11) NOT NULL,
  `COMPANYID` int(11) NOT NULL,
  `JOBID` int(11) NOT NULL,
  `APPLICANTID` int(11) NOT NULL,
  `APPLICANT` varchar(90) NOT NULL,
  `REGISTRATIONDATE` date NOT NULL,
  `REMARKS` varchar(255) NOT NULL DEFAULT 'Pending',
  `FILEID` varchar(30) DEFAULT NULL,
  `PENDINGAPPLICATION` tinyint(1) NOT NULL DEFAULT 1,
  `HVIEW` tinyint(1) NOT NULL DEFAULT 1,
  `DATETIMEAPPROVED` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbljobregistration`
--

INSERT INTO `tbljobregistration` (`REGISTRATIONID`, `COMPANYID`, `JOBID`, `APPLICANTID`, `APPLICANT`, `REGISTRATIONDATE`, `REMARKS`, `FILEID`, `PENDINGAPPLICATION`, `HVIEW`, `DATETIMEAPPROVED`) VALUES
(7, 12, 8, 2025016, 'Neil Oliver Regondola', '2025-01-15', 'Pending', '20256912533', 1, 1, '2025-01-15 19:30:00'),
(8, 8, 4, 2025017, 'Ei Raiden Shogun', '2025-01-21', 'Pending', '20256912535', 1, 1, '2025-01-21 18:25:00'),
(9, 8, 4, 2025017, 'Ei Raiden Shogun', '2025-01-21', 'Pending', '20256912536', 1, 1, '2025-01-21 18:25:00'),
(10, 9, 5, 2025017, 'Ei Raiden Shogun', '2025-01-21', 'Pending', '20256912537', 1, 1, '2025-01-21 18:36:00'),
(11, 10, 6, 2025017, 'Ei Raiden Shogun', '2025-01-21', 'Pending', '20256912538', 1, 1, '2025-01-21 18:36:00'),
(12, 11, 7, 2025017, 'Ei Raiden Shogun', '2025-01-21', 'Pending', '20256912542', 1, 1, '2025-01-21 19:18:00'),
(13, 14, 16, 2025018, 'Ken Takakura', '2025-01-21', 'Pending', '20256912543', 1, 1, '2025-01-21 23:35:00'),
(15, 9, 5, 2025025, 'test test', '2025-01-22', 'Pending', '20256912545', 1, 1, '2025-01-22 00:10:00'),
(16, 9, 5, 2025026, 'test2 test2', '2025-01-22', 'Pending', '20256912546', 1, 1, '2025-01-22 00:12:00');

-- --------------------------------------------------------

--
-- Table structure for table `tblnotification`
--

CREATE TABLE `tblnotification` (
  `NOTIFICATIONID` int(11) NOT NULL,
  `APPLICANTID` int(11) NOT NULL,
  `JOBID` int(11) NOT NULL,
  `ISVIEWED` tinyint(1) NOT NULL,
  `DATECREATED` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblnotification`
--

INSERT INTO `tblnotification` (`NOTIFICATIONID`, `APPLICANTID`, `JOBID`, `ISVIEWED`, `DATECREATED`) VALUES
(1, 2018013, 4, 0, '2025-01-21 22:24:24'),
(2, 2018014, 4, 0, '2025-01-21 22:24:24'),
(3, 2018015, 4, 0, '2025-01-21 22:24:24'),
(4, 2025016, 4, 0, '2025-01-21 22:24:24'),
(5, 2025017, 4, 1, '2025-01-21 22:24:24'),
(8, 2018013, 5, 0, '2025-01-21 22:24:32'),
(9, 2018014, 5, 0, '2025-01-21 22:24:32'),
(10, 2018015, 5, 0, '2025-01-21 22:24:32'),
(11, 2025016, 5, 0, '2025-01-21 22:24:32'),
(12, 2025017, 5, 1, '2025-01-21 22:24:32'),
(15, 2018013, 6, 0, '2025-01-21 22:24:36'),
(16, 2018014, 6, 0, '2025-01-21 22:24:36'),
(17, 2018015, 6, 0, '2025-01-21 22:24:36'),
(18, 2025016, 6, 0, '2025-01-21 22:24:36'),
(19, 2025017, 6, 1, '2025-01-21 22:24:36'),
(22, 2018013, 7, 0, '2025-01-21 22:24:45'),
(23, 2018014, 7, 0, '2025-01-21 22:24:45'),
(24, 2018015, 7, 0, '2025-01-21 22:24:45'),
(25, 2025016, 7, 0, '2025-01-21 22:24:45'),
(26, 2025017, 7, 1, '2025-01-21 22:24:45'),
(29, 2018013, 8, 0, '2025-01-21 22:24:54'),
(30, 2018014, 8, 0, '2025-01-21 22:24:54'),
(31, 2018015, 8, 0, '2025-01-21 22:24:54'),
(32, 2025016, 8, 0, '2025-01-21 22:24:54'),
(33, 2025017, 8, 1, '2025-01-21 22:24:54'),
(36, 2018013, 9, 0, '2025-01-21 22:25:01'),
(37, 2018014, 9, 0, '2025-01-21 22:25:01'),
(38, 2018015, 9, 0, '2025-01-21 22:25:01'),
(39, 2025016, 9, 0, '2025-01-21 22:25:01'),
(40, 2025017, 9, 1, '2025-01-21 22:25:01'),
(43, 2018013, 16, 0, '2025-01-21 22:26:04'),
(44, 2018014, 16, 0, '2025-01-21 22:26:04'),
(45, 2018015, 16, 0, '2025-01-21 22:26:04'),
(46, 2025016, 16, 0, '2025-01-21 22:26:04'),
(47, 2025017, 16, 1, '2025-01-21 22:26:04'),
(50, 2018013, 17, 0, '2025-01-21 23:20:52'),
(51, 2018014, 17, 0, '2025-01-21 23:20:52'),
(52, 2018015, 17, 0, '2025-01-21 23:20:52'),
(53, 2025016, 17, 0, '2025-01-21 23:20:52'),
(54, 2025017, 17, 0, '2025-01-21 23:20:52'),
(55, 2025018, 17, 1, '2025-01-21 23:20:52'),
(56, 2018013, 18, 0, '2025-01-23 00:46:43'),
(57, 2018014, 18, 0, '2025-01-23 00:46:43'),
(58, 2018015, 18, 0, '2025-01-23 00:46:43'),
(59, 2025016, 18, 0, '2025-01-23 00:46:43'),
(60, 2025017, 18, 0, '2025-01-23 00:46:43'),
(61, 2025018, 18, 0, '2025-01-23 00:46:43'),
(62, 2025023, 18, 0, '2025-01-23 00:46:43'),
(63, 2025025, 18, 0, '2025-01-23 00:46:43'),
(64, 2025026, 18, 0, '2025-01-23 00:46:43'),
(71, 2018013, 19, 0, '2025-01-23 00:49:14'),
(72, 2018014, 19, 0, '2025-01-23 00:49:14'),
(73, 2018015, 19, 0, '2025-01-23 00:49:14'),
(74, 2025016, 19, 0, '2025-01-23 00:49:14'),
(75, 2025017, 19, 0, '2025-01-23 00:49:14'),
(76, 2025018, 19, 0, '2025-01-23 00:49:14'),
(77, 2025023, 19, 0, '2025-01-23 00:49:14'),
(78, 2025025, 19, 0, '2025-01-23 00:49:14'),
(79, 2025026, 19, 0, '2025-01-23 00:49:14'),
(86, 2018013, 20, 0, '2025-01-23 01:00:07'),
(87, 2018014, 20, 0, '2025-01-23 01:00:07'),
(88, 2018015, 20, 0, '2025-01-23 01:00:07'),
(89, 2025016, 20, 0, '2025-01-23 01:00:07'),
(90, 2025017, 20, 0, '2025-01-23 01:00:07'),
(91, 2025018, 20, 0, '2025-01-23 01:00:07'),
(92, 2025023, 20, 0, '2025-01-23 01:00:07'),
(93, 2025025, 20, 0, '2025-01-23 01:00:07'),
(94, 2025026, 20, 0, '2025-01-23 01:00:07');

-- --------------------------------------------------------

--
-- Table structure for table `tblusers`
--

CREATE TABLE `tblusers` (
  `USERID` varchar(30) NOT NULL,
  `FULLNAME` varchar(40) NOT NULL,
  `USERNAME` varchar(90) NOT NULL,
  `PASS` varchar(90) NOT NULL,
  `ROLE` varchar(30) NOT NULL,
  `PICLOCATION` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblusers`
--

INSERT INTO `tblusers` (`USERID`, `FULLNAME`, `USERNAME`, `PASS`, `ROLE`, `PICLOCATION`) VALUES
('00018', 'HireVantage', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Administrator', 'photos/zoro1.jpg'),
('029837', 'Neil', 'Neil', '32932454372d21c1e59aec1b1168b91fa0dea5a6', 'Staff', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblapplicants`
--
ALTER TABLE `tblapplicants`
  ADD PRIMARY KEY (`APPLICANTID`);

--
-- Indexes for table `tblattachmentfile`
--
ALTER TABLE `tblattachmentfile`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblautonumbers`
--
ALTER TABLE `tblautonumbers`
  ADD PRIMARY KEY (`AUTOID`);

--
-- Indexes for table `tblcategory`
--
ALTER TABLE `tblcategory`
  ADD PRIMARY KEY (`CATEGORYID`);

--
-- Indexes for table `tblcompany`
--
ALTER TABLE `tblcompany`
  ADD PRIMARY KEY (`COMPANYID`);

--
-- Indexes for table `tblemployees`
--
ALTER TABLE `tblemployees`
  ADD PRIMARY KEY (`INCID`),
  ADD UNIQUE KEY `EMPLOYEEID` (`EMPLOYEEID`);

--
-- Indexes for table `tblfeedback`
--
ALTER TABLE `tblfeedback`
  ADD PRIMARY KEY (`FEEDBACKID`);

--
-- Indexes for table `tbljob`
--
ALTER TABLE `tbljob`
  ADD PRIMARY KEY (`JOBID`);

--
-- Indexes for table `tbljobregistration`
--
ALTER TABLE `tbljobregistration`
  ADD PRIMARY KEY (`REGISTRATIONID`);

--
-- Indexes for table `tblnotification`
--
ALTER TABLE `tblnotification`
  ADD PRIMARY KEY (`NOTIFICATIONID`);

--
-- Indexes for table `tblusers`
--
ALTER TABLE `tblusers`
  ADD PRIMARY KEY (`USERID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblapplicants`
--
ALTER TABLE `tblapplicants`
  MODIFY `APPLICANTID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2025027;

--
-- AUTO_INCREMENT for table `tblattachmentfile`
--
ALTER TABLE `tblattachmentfile`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tblautonumbers`
--
ALTER TABLE `tblautonumbers`
  MODIFY `AUTOID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tblcategory`
--
ALTER TABLE `tblcategory`
  MODIFY `CATEGORYID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `tblcompany`
--
ALTER TABLE `tblcompany`
  MODIFY `COMPANYID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tblemployees`
--
ALTER TABLE `tblemployees`
  MODIFY `INCID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `tblfeedback`
--
ALTER TABLE `tblfeedback`
  MODIFY `FEEDBACKID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbljob`
--
ALTER TABLE `tbljob`
  MODIFY `JOBID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tbljobregistration`
--
ALTER TABLE `tbljobregistration`
  MODIFY `REGISTRATIONID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tblnotification`
--
ALTER TABLE `tblnotification`
  MODIFY `NOTIFICATIONID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
