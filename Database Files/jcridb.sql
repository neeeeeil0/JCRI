-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 04, 2025 at 05:49 AM
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
-- Table structure for table `tblacceptedapplicants`
--

CREATE TABLE `tblacceptedapplicants` (
  `ACCEPTEDID` int(11) NOT NULL,
  `REGISTRATIONID` int(11) NOT NULL,
  `APPLICANTID` int(11) NOT NULL,
  `EMPLOYEEID` varchar(50) DEFAULT NULL,
  `DEPLOYEDCOMPANYID` int(11) NOT NULL,
  `JOBTITLE` varchar(500) NOT NULL,
  `HIREDDATE` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblacceptedapplicants`
--

INSERT INTO `tblacceptedapplicants` (`ACCEPTEDID`, `REGISTRATIONID`, `APPLICANTID`, `EMPLOYEEID`, `DEPLOYEDCOMPANYID`, `JOBTITLE`, `HIREDDATE`) VALUES
(10, 21, 2025027, NULL, 12, 'Restaurant Manager', '2025-02-04 03:56:17'),
(13, 19, 2025028, NULL, 13, 'Solutions Architect', '2025-02-04 05:20:40');

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
(2025027, 'Neil Oliver ', 'Regondola', 'Jerus', '116 Santol QC', 'Female', 'none', '2002-08-09', 'Sampaloc Manila', 22, 'neilneil', '32932454372d21c1e59aec1b1168b91fa0dea5a6', 'neiloliverxxx@gmail.com', '09478251234', 'Bachelor of Science in Information Systems', 'photos/aboutneil.jpg', ''),
(2025028, 'Momo', 'Ayase', '', 'Kamigoe City', 'Female', 'Single', '2003-01-07', 'Kamigoe City', 22, 'momoayase', '116e977a8f6c83414b5e9ed0e323f9bbe680cabd', 'momoayase@email.com', '09431123432', 'Bachelor of Arts and History', 'photos/image_2025-01-21_235905627.png', '');

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
(20, '20256912550', 5, '2025027_resume', 'photos/03022025042136Resume.pdf', 2025027),
(21, '20256912551', 8, '2025027_resume', 'photos/03022025042604Resume.pdf', 2025027);

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
(1, '202500', 10, 1, 'userid'),
(2, '000', 79, 1, 'employeeid'),
(3, '0', 29, 1, 'APPLICANT'),
(4, '69125', 52, 1, 'FILEID');

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
(13, 'Microsoft Philippines', 'Makati City', '+63 2 859 0500', '', '');

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
  `FEEDBACK` text NOT NULL,
  `SENDERID` varchar(50) NOT NULL,
  `VIEW` int(11) NOT NULL,
  `DATETIMESAVED` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblfeedback`
--

INSERT INTO `tblfeedback` (`FEEDBACKID`, `APPLICANTID`, `REGISTRATIONID`, `FEEDBACK`, `SENDERID`, `VIEW`, `DATETIMESAVED`) VALUES
(26, 2025028, 18, 'Testing Feedback for Review', '00018', 0, '2025-02-03 03:33:54'),
(27, 2025028, 18, 'Testing Feedback for Review.', '00018', 0, '2025-02-03 03:37:43'),
(28, 2025028, 18, 'Testing Feedback for Review', '00018', 0, '2025-02-03 03:52:48'),
(29, 2025028, 19, 'Applicant for review', '029837', 0, '2025-02-03 04:19:06'),
(30, 2025028, 19, 'Applicant for review\r\nTesting with using new line\r\nin \r\nfeedback', '029837', 0, '2025-02-03 04:51:50'),
(31, 2025027, 21, 'Your application now is for Review', '029837', 0, '2025-02-03 23:28:17'),
(32, 2025027, 21, 'Congrats you are now accepted in this job.', '00018', 1, '2025-02-04 02:27:50'),
(33, 2025027, 21, 'Congrats you are now accepted in this job. test', '00018', 1, '2025-02-04 04:46:26'),
(39, 2025028, 19, 'Applicant for review\r\nTesting with using new line\r\nin \r\nfeedback', '00018', 1, '2025-02-04 12:06:54');

-- --------------------------------------------------------

--
-- Table structure for table `tblinbox`
--

CREATE TABLE `tblinbox` (
  `INBOXID` int(11) NOT NULL,
  `FULLNAME` varchar(50) NOT NULL,
  `EMAIL` varchar(50) NOT NULL,
  `MESSAGE` varchar(500) NOT NULL,
  `VIEW` int(11) NOT NULL,
  `DATETIME` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbljob`
--

CREATE TABLE `tbljob` (
  `JOBID` int(11) NOT NULL,
  `COMPANYID` int(11) NOT NULL,
  `CATEGORY` varchar(250) NOT NULL,
  `OCCUPATIONTITLE` varchar(90) NOT NULL,
  `SALARIES` double NOT NULL,
  `JOBSETTING` varchar(30) NOT NULL,
  `QUALIFICATION_WORKEXPERIENCE` text NOT NULL,
  `JOBDESCRIPTION` text NOT NULL,
  `PREFEREDSEX` varchar(30) NOT NULL,
  `JOBSTATUS` varchar(90) NOT NULL,
  `PUBLISHERID` varchar(30) NOT NULL,
  `DATEPOSTED` datetime NOT NULL,
  `DATEUPDATED` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbljob`
--

INSERT INTO `tbljob` (`JOBID`, `COMPANYID`, `CATEGORY`, `OCCUPATIONTITLE`, `SALARIES`, `JOBSETTING`, `QUALIFICATION_WORKEXPERIENCE`, `JOBDESCRIPTION`, `PREFEREDSEX`, `JOBSTATUS`, `PUBLISHERID`, `DATEPOSTED`, `DATEUPDATED`) VALUES
(4, 8, 'Technology', 'IT Support Specialist', 80000, 'On-Site', 'At least 1 year of experience in IT support.', 'Provide technical support for hardware, software, and network-related issues.', 'Male/Female', 'Open', '029837', '2025-01-15 19:22:00', '2025-01-27 05:23:34'),
(5, 9, 'Technology', 'Cloud Consultant', 100000, 'On-Site', 'Experience in cloud platforms (IBM Cloud, AWS, Azure).', 'Design and implement cloud solutions for clients using IBM Cloud technologies', 'Male/Female', 'Open', '029837', '2025-01-15 19:23:00', '2025-01-27 05:24:03'),
(6, 10, 'Sales', 'Key Account Manager', 55000, 'Hybrid', 'At least 2 years of experience in key account management', 'Manage and grow relationships with major clients.', 'Male/Female', 'Open', '029837', '2025-01-15 19:25:00', '2025-01-27 05:23:28'),
(7, 11, 'Managerial', 'Project Manager', 65000, 'Hybrid', 'Proven experience in project management.', 'Lead and manage projects across various business units.', 'Male', 'Open', '029837', '2025-01-15 19:26:00', '2025-01-27 05:23:17'),
(8, 12, 'Managerial', 'Restaurant Manager', 30000, 'On-Site', 'Experience in food and beverage or retail management', 'Oversee daily operations of the restaurant to ensure smooth service.', 'Male/Female', 'Open', '029837', '2025-01-15 19:27:00', '2025-01-27 05:24:11'),
(9, 13, 'IT', 'Solutions Architect', 90000, '', 'Extensive knowledge of Microsoft technologies.', 'Design and implement Microsoft-based solutions for enterprise clients', 'Male/Female', 'Open', '029837', '2025-01-15 19:28:00', '2025-01-29 03:16:14'),
(16, 11, 'Services', 'Customer Service Representative', 0, '', 'At least a high school diploma (College graduates are preferred). Excellent communication skills in English and Filipino. Strong problem-solving skills. Ability to work in a fast-paced environment. Previous customer service experience is an advantage but not required.', 'We are seeking a highly motivated and customer-oriented individual to join our growing team as a Customer Service Representative. The ideal candidate will provide excellent service to our clients, ensuring their inquiries and concerns are addressed promptly and professionally.', 'Male/Female', 'Closed', '029837', '2025-01-21 22:26:00', '2025-02-04 05:49:10'),
(34, 12, 'Managerial', 'Manager', 0, '', '', '', 'Male', 'Closed', '029837', '2025-01-26 20:52:00', '2025-02-03 16:24:50');

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
  `STATUS` varchar(30) NOT NULL,
  `REMARKS` varchar(255) NOT NULL DEFAULT 'Pending',
  `MODIFIEDBY` varchar(30) DEFAULT NULL,
  `FILEID` varchar(30) DEFAULT NULL,
  `PENDINGAPPLICATION` tinyint(1) NOT NULL DEFAULT 1,
  `HVIEW` tinyint(1) NOT NULL DEFAULT 1,
  `DATETIMEAPPROVED` datetime NOT NULL,
  `DATETIMEUPDATED` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbljobregistration`
--

INSERT INTO `tbljobregistration` (`REGISTRATIONID`, `COMPANYID`, `JOBID`, `APPLICANTID`, `APPLICANT`, `REGISTRATIONDATE`, `STATUS`, `REMARKS`, `MODIFIEDBY`, `FILEID`, `PENDINGAPPLICATION`, `HVIEW`, `DATETIMEAPPROVED`, `DATETIMEUPDATED`) VALUES
(18, 12, 8, 2025028, 'Momo Ayase', '2025-01-29', 'Rejected', 'For Review', '00018', '20256912548', 0, 0, '2025-01-29 02:08:00', '2025-02-04 12:20:40'),
(19, 13, 9, 2025028, 'Momo Ayase', '2025-02-02', 'Accepted', 'Applicant for review\r\nTesting with using new line\r\nin \r\nfeedback', '00018', '20256912549', 0, 0, '2025-02-02 21:04:00', '2025-02-04 12:20:40'),
(20, 9, 5, 2025027, 'Neil Oliver  Regondola', '2025-02-03', 'Rejected', '', '00018', '20256912550', 0, 0, '2025-02-03 16:21:00', '2025-02-04 10:55:28'),
(21, 12, 8, 2025027, 'Neil Oliver  Regondola', '2025-02-03', 'Accepted', 'Congratsdwa', '00018', '20256912551', 0, 0, '2025-02-03 16:26:00', '2025-02-04 10:56:17');

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
(170, 2025027, 5, 1, '2025-01-27 03:00:10'),
(171, 2025027, 34, 0, '2025-01-27 03:52:00'),
(172, 2025027, 9, 0, '2025-01-27 03:52:12'),
(173, 2025027, 7, 0, '2025-01-27 05:22:19'),
(174, 2025027, 7, 0, '2025-01-27 05:22:30'),
(175, 2025027, 7, 0, '2025-01-27 05:23:17'),
(176, 2025027, 6, 0, '2025-01-27 05:23:28'),
(177, 2025027, 4, 0, '2025-01-27 05:23:34'),
(178, 2025027, 5, 1, '2025-01-27 05:24:03'),
(179, 2025027, 8, 0, '2025-01-27 05:24:11'),
(180, 2025027, 9, 0, '2025-01-29 03:16:14'),
(181, 2025028, 9, 1, '2025-01-29 03:16:14');

-- --------------------------------------------------------

--
-- Table structure for table `tblusers`
--

CREATE TABLE `tblusers` (
  `USERID` varchar(30) NOT NULL,
  `FULLNAME` varchar(40) NOT NULL,
  `USERNAME` varchar(90) NOT NULL,
  `PASS` varchar(90) NOT NULL,
  `CONTACT` varchar(30) NOT NULL,
  `EMAIL` varchar(50) NOT NULL,
  `ROLE` varchar(30) NOT NULL,
  `DELETEABLE` int(11) NOT NULL,
  `PICLOCATION` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblusers`
--

INSERT INTO `tblusers` (`USERID`, `FULLNAME`, `USERNAME`, `PASS`, `CONTACT`, `EMAIL`, `ROLE`, `DELETEABLE`, `PICLOCATION`) VALUES
('00018', 'HireVantage', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', '', '0', 'Administrator', 0, 'photos/zoro1.jpg'),
('029837', 'Neil Oliver', 'Neil', '32932454372d21c1e59aec1b1168b91fa0dea5a6', '', '0', 'Staff', 1, 'photos/pic2.jpg'),
('029838', 'admin2', 'admin2', '315f166c5aca63a157f7d41007675cb44a948b33', '', '0', 'Administrator', 1, ''),
('202500', 'test', 'test', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 'test', 'test', 'Staff', 1, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblacceptedapplicants`
--
ALTER TABLE `tblacceptedapplicants`
  ADD PRIMARY KEY (`ACCEPTEDID`);

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
-- Indexes for table `tblinbox`
--
ALTER TABLE `tblinbox`
  ADD PRIMARY KEY (`INBOXID`);

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
-- AUTO_INCREMENT for table `tblacceptedapplicants`
--
ALTER TABLE `tblacceptedapplicants`
  MODIFY `ACCEPTEDID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tblapplicants`
--
ALTER TABLE `tblapplicants`
  MODIFY `APPLICANTID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2025029;

--
-- AUTO_INCREMENT for table `tblattachmentfile`
--
ALTER TABLE `tblattachmentfile`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

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
  MODIFY `FEEDBACKID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `tblinbox`
--
ALTER TABLE `tblinbox`
  MODIFY `INBOXID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbljob`
--
ALTER TABLE `tbljob`
  MODIFY `JOBID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `tbljobregistration`
--
ALTER TABLE `tbljobregistration`
  MODIFY `REGISTRATIONID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tblnotification`
--
ALTER TABLE `tblnotification`
  MODIFY `NOTIFICATIONID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=183;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
