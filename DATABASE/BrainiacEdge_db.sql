-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 14, 2024 at 05:16 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `udemy_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE `cart_items` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `user_to_id` int(11) NOT NULL,
  `user_of_id` int(11) NOT NULL,
  `course_title` varchar(250) NOT NULL DEFAULT current_timestamp(),
  `course_price` varchar(250) NOT NULL,
  `user_name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart_items`
--

INSERT INTO `cart_items` (`id`, `course_id`, `user_to_id`, `user_of_id`, `course_title`, `course_price`, `user_name`) VALUES
(4, 20, 15, 17, 'Programming Fundamentals', 'Free ($0)', 'asdjfja asfasd'),
(5, 20, 15, 19, 'Programming Fundamentals', 'Free ($0)', 'asdjfja asfasd');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category` varchar(30) NOT NULL,
  `disabled` tinyint(1) NOT NULL DEFAULT 0,
  `slug` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category`, `disabled`, `slug`) VALUES
(1, 'Development', 0, 'development'),
(2, 'Business', 0, 'business'),
(3, 'Finance & Accounting', 0, 'finance-accounting'),
(4, 'IT & Software', 0, 'it-software'),
(5, 'Office Productivity', 0, 'office-productivity'),
(6, 'Personal Development', 0, 'personal-development'),
(7, 'Design', 0, 'design'),
(8, 'Marketing', 0, 'marketing'),
(9, 'Lifestyle', 0, 'lifestyle'),
(10, 'Photography & Video', 0, 'photography-video'),
(11, 'Health & Fitness', 0, 'health-fitness'),
(12, 'Music', 0, 'music'),
(13, 'Teaching & Academics', 0, 'teaching-academics'),
(14, 'I don\'t know yet', 0, 'i-dont-know-yet'),
(16, 'another category', 0, 'another-category'),
(17, 'cool category', 0, 'cool-category'),
(18, 'new cate', 0, 'new-cate'),
(19, 'Test Category', 0, 'test-category');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `to_id` int(11) NOT NULL,
  `from_id` int(11) NOT NULL,
  `message` text DEFAULT NULL,
  `read_status` int(11) NOT NULL,
  `timestamp` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `to_id`, `from_id`, `message`, `read_status`, `timestamp`) VALUES
(10, 20, 15, 17, 'This is new comment form user std', 0, '2024-04-07'),
(11, 20, 15, 17, 'Tesing Comment 2', 0, '2024-04-07'),
(12, 20, 15, 16, 'This is new comment from instructor', 0, '2024-04-07'),
(26, 20, 15, 16, 'test comment 3', 0, '2024-04-07'),
(27, 20, 15, 16, 'test comment 3', 0, '2024-04-07'),
(28, 20, 15, 16, 'test comment 3', 0, '2024-04-07'),
(29, 20, 15, 16, 'test comment 3', 0, '2024-04-07'),
(30, 20, 15, 16, 'test comment 3', 0, '2024-04-07'),
(31, 20, 15, 16, 'thhsbb', 0, '2024-04-07'),
(32, 3, 1, 17, 'Hi there, This course is free of cost??', 0, '2024-04-09'),
(33, 20, 15, 17, 'comment', 0, '2024-04-11');

-- --------------------------------------------------------

--
-- Table structure for table `comments_reply`
--

CREATE TABLE `comments_reply` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL,
  `to_id` int(11) NOT NULL,
  `from_id` int(11) NOT NULL,
  `reply_message` text DEFAULT NULL,
  `read_status` int(11) NOT NULL,
  `timestamp` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments_reply`
--

INSERT INTO `comments_reply` (`id`, `post_id`, `comment_id`, `to_id`, `from_id`, `reply_message`, `read_status`, `timestamp`) VALUES
(1, 20, 31, 15, 16, 'nEW REPLY', 0, '2024-04-07'),
(2, 20, 30, 15, 17, 'Hello sir', 0, '2024-04-07'),
(3, 20, 31, 15, 17, 'this is new test', 0, '2024-04-07'),
(4, 20, 10, 15, 17, 'last test reply', 0, '2024-04-07'),
(5, 20, 33, 15, 17, 'reply', 0, '2024-04-11');

-- --------------------------------------------------------

--
-- Table structure for table `competitions`
--

CREATE TABLE `competitions` (
  `id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `slug` varchar(256) NOT NULL,
  `description` text NOT NULL,
  `image` text NOT NULL,
  `start_date` datetime NOT NULL DEFAULT current_timestamp(),
  `end_date` datetime NOT NULL,
  `google_form_link` text NOT NULL,
  `tags` text DEFAULT NULL,
  `address` text NOT NULL,
  `views` int(11) NOT NULL,
  `disabled` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `competitions`
--

INSERT INTO `competitions` (`id`, `title`, `slug`, `description`, `image`, `start_date`, `end_date`, `google_form_link`, `tags`, `address`, `views`, `disabled`) VALUES
(2, 'New test competions', 'new-test-competions', '							New test competions						', 'uploads/competitions/1713062632desertSafa', '2024-04-13 00:00:00', '2024-04-30 00:00:00', 'https://www.abc.com', 'abc, sdb, business', 'ABC, City, near XYZ, Country', 0, 0),
(3, 'New test competions2', 'new-test-competions2', '							New test competions 2						', 'uploads/competitions/1713062566dubai_fram', '2024-04-18 00:00:00', '2024-04-25 00:00:00', 'https://www.abc.com', 'abc,adknc,', 'Skardu Gilgit Baltistan', 0, 0),
(4, 'new Tests', 'new-tests', '							test descriptions						', 'uploads/competitions/1713062285miracle.pn', '2024-04-13 00:00:00', '2024-04-30 00:00:00', 'https://www.abc.com', 'Entertainment, Arts, Business', 'ABC, City, near XYZ, Country', 0, 0),
(5, 'Funding Hamari: Stages and Timelines', 'funding-hamari-stages-and-timelines', '							All that you need to know about Shark Tank 2.0 : Pitch Aapki - Funding Hamari\r\nAfter the resounding success of Shark Tank 1, which took the entire Delhi University campus by storm last year, we are thrilled to announce the return of Shark Tank 2.0: Pitch Aapki! Funding Hamari Powered by Project Nivesh!\r\n\r\nGet ready to dive back into the world of entrepreneurship with the Shark Tank competition, organized by E-Cell, Motilal Nehru College, as part of Egnite 5.0: The Annual Fest of E-Cell, MLNC.\r\n\r\nIf you\'ve always had a passion for innovation and the drive to turn your ideas into reality, then this is the perfect platform for you. Just like the hit TV show, Shark Tank, you will have the opportunity to pitch your ideas to a panel of experienced judges or sharks. With the chance to secure funding and mentorship, this event could be the launchpad for your future success. So, get ready to take the plunge and join the excitement of the Shark Tank competition!\r\n\r\nFormat of the Event:\r\n\r\nDuring the event, startups and entrepreneurs will have a total of 10 minutes to pitch their startup or company, including time for a question-and-answer session.\r\nFollowing the pitches, the evaluation and negotiation phase will commence.\r\nIf investors express interest, deals will be negotiated directly between the startup/company and the panel of sharks.\r\nPlease note that E-Cell bears no responsibility for the outcomes of any deals made during the event.\r\nEligibility Criteria:\r\n\r\nThe eligibility of the participants is not restricted in any way. However, certain conditions must be met by the participants:\r\nThey are the legal owners or co-founders of the business or startup they are pitching.\r\nAdditionally, the business must either be generating revenue or have a clear plan for revenue generation.\r\nPitching Format (Suggested):\r\n\r\nThe problem, the need for the business, and the startup introduction.\r\nUnique selling proposition.\r\nBusiness model and revenue generation plan.\r\nMarket analysis and target audience.\r\nCurrent status and plans.\r\nFinancial projections and funding needs.\r\nReturn on investment for the sharks.\r\nThe presentation can be in English or Hindi and can include visual aids such as slides or a video. Additionally, please be ready with a sample/product/service demo if shortlisted for offline presentation. \r\nSo what are you waiting for? Pull up your socks and get ready!						', 'uploads/competitions/1713062264asd.png', '2024-04-13 00:00:00', '2024-04-30 00:00:00', 'https://www.abc.com', 'Case Study, Business Plan, Art, ', 'Motilal Nehru College (MNC), University of Delhi (DU), Delhi', 7, 0),
(6, 'Test new expired	Competition', 'test-new-expired-competition', 'Test description new expired			', 'uploads/competitions/1713078629users_icon', '2024-04-14 00:00:00', '2024-04-13 00:00:00', 'https://www.abc.com', 'ss, ssf, ew,we', 'te', 25, 0);

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `slug` varchar(256) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `sub_category_id` int(11) DEFAULT NULL,
  `level_id` int(11) DEFAULT NULL,
  `language_id` int(11) DEFAULT NULL,
  `price_id` int(11) DEFAULT NULL,
  `promo_link` varchar(1024) DEFAULT NULL,
  `course_image` varchar(1024) DEFAULT NULL,
  `course_image_tmp` varchar(1024) NOT NULL,
  `course_promo_video` varchar(1024) DEFAULT NULL,
  `primary_subject` varchar(100) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `tags` varchar(2048) DEFAULT NULL,
  `congratulations_message` varchar(2048) DEFAULT NULL,
  `welcome_message` varchar(2048) DEFAULT NULL,
  `approved` tinyint(1) NOT NULL DEFAULT 0,
  `published` tinyint(1) NOT NULL DEFAULT 0,
  `subtitle` varchar(100) DEFAULT NULL,
  `currency_id` int(11) DEFAULT NULL,
  `csrf_code` varchar(32) NOT NULL,
  `views` int(11) NOT NULL DEFAULT 0,
  `trending` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `title`, `slug`, `description`, `user_id`, `category_id`, `sub_category_id`, `level_id`, `language_id`, `price_id`, `promo_link`, `course_image`, `course_image_tmp`, `course_promo_video`, `primary_subject`, `date`, `tags`, `congratulations_message`, `welcome_message`, `approved`, `published`, `subtitle`, `currency_id`, `csrf_code`, `views`, `trending`) VALUES
(1, 'my test course', 'my-test-course', '\r\nWhat is Lorem Ipsum?\r\n\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n', 1, 4, 0, 2, 21, 1, NULL, 'uploads/courses/1657026221call-center-customer-service-job-animation-vector-design_40876-2656.jpg', '', NULL, 'a test subject', '2022-06-13 10:10:20', NULL, NULL, NULL, 1, 1, 'another good course', 1, '421ef711bc62e73af34ad07445d1f641', 41, 1),
(2, 'photography for beginnerse', 'photography-for-beginnerse', 'a description of this course', 1, 10, 0, 1, 21, 1, NULL, 'uploads/courses/1657026261istockphoto-950614324-612x612.jpg', '', NULL, 'Photography', '2022-06-15 21:10:56', NULL, 'congratulatory message', 'a welcome message', 1, 1, 'a subtitle', 1, '3489777883bdcfd04f2cf91b32295871', 13, 1),
(3, 'Node js essentials', 'node-js-essentials', '\r\nWhat is Lorem Ipsum?\r\n\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n', 1, 4, 0, 1, 21, 1, NULL, 'uploads/courses/1657023201b612344115214be72736121878dc90a7.jpg', '', NULL, 'programming', '2022-07-05 14:13:00', NULL, NULL, NULL, 1, 1, 'an intro to node js', 1, '2a1f0b1a3f4a6f544906e5b78d46d6db', 31, 1),
(20, 'Programming Fundamentals', 'programming-fundamentals', 'Introduction to Web development Introduction to Web developmentIntroduction to Web developmentIntroduction to Web developmentIntroduction to Web developmentIntroduction to Web developmentIntroduction to Web development', 15, 17, 0, 4, 101, 1, NULL, 'uploads/courses/1712265908IMG20231208095430.jpg', '', 'uploads/courses/17122659199cef3ca2e30a4b7faf9715367a10219a.mp4', 'PHP Programing', '2024-04-04 23:15:38', 'Educational, programing, Php, web development', 'Congratulation to all, you have successfully complete this course', 'Wellcom to all', 1, 1, 'Master PHP by building 100 projects in 100 days. Learn data science, automation, build websites, gam', 1, '73876ff87bd4e9f52386e2c1313ed5f4', 127, 4),
(23, 'instructor Test Course', 'instructor-test-course', 'instructor Test Course', 16, 7, 0, 3, 103, 1, NULL, 'uploads/courses/1712797157mercedes-1.png', '', NULL, 'instructor Test Course', '2024-04-11 02:58:32', 'instructor Test Course', 'Conguratulations', 'Wellcome', 1, 1, 'instructor Test Course', 1, '9f42f8a2c10d81eaeef8f0e06d108f64', 27, 2),
(24, 'N Instruct Test Course', 'n-instruct-test-course', 'N Instruct Test Course', 20, 18, NULL, NULL, 21, 3, NULL, 'uploads/courses/1712859504dubai_frame_service2.png', '', 'uploads/courses/1712859119Tours & Travel _ Dashboard and 1 more page - Profile 1 - Microsoft​ Edge 2024-03-01 19-48-09.mp4', 'N Instruct Test Course', '2024-04-11 19:50:01', 'N Instruct Test Course', 'asd', 'z', 1, 1, 'N Instruct Test Course', 3, 'd21e8650fcfb73b533852e49ad1f2421', 41, 1);

-- --------------------------------------------------------

--
-- Table structure for table `courses_lectures`
--

CREATE TABLE `courses_lectures` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `uid` bigint(20) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(2048) NOT NULL,
  `file` varchar(1024) NOT NULL,
  `disabled` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `courses_lectures`
--

INSERT INTO `courses_lectures` (`id`, `course_id`, `uid`, `title`, `description`, `file`, `disabled`) VALUES
(1, 0, 1664537224851, 'lec 4 text', 'lec 4 desc text', 'uploads/courses/1682929377pal patrol2 friendship day.mp4', 0),
(2, 0, 1664537224851, 'lex 1', 'lec 1 desc', 'uploads/courses/1682848577pal patrol.mp4', 0),
(3, 0, 1664537207986, 'lec 3', 'lec 3 desc', 'uploads/courses/1682933771MESHASI COMACK_ 3D ANIMATION PORTIFOLIO.mp4', 0),
(4, 0, 1664537224851, 'lec 4', 'lec 4 desc', '', 1),
(5, 0, 1664537207986, 'lec 5', 'lec 5 desc', 'uploads/courses/1682934694MESHASI COMACK_ 3D ANIMATION PORTIFOLIO.mp4', 0),
(6, 0, 1664537207986, 'new lectures', 'another desc', '', 0),
(7, 0, 1712109831792, 'test again Ltitle', 'test again Ldesc', 'uploads/courses/17121100589cef3ca2e30a4b7faf9715367a10219a.mp4', 0),
(8, 0, 1712120172222, 'test again Ltitle1', 'test again Ldesc1', 'uploads/courses/17121201729cef3ca2e30a4b7faf9715367a10219a.mp4', 0),
(9, 0, 1712249934381, 'df', 'df', 'uploads/courses/17122499349cef3ca2e30a4b7faf9715367a10219a.mp4', 0),
(10, 0, 1712249934381, 'dfa', 'gg', 'uploads/courses/1712249960Ertugrul Ghazi _ Trailer _ Season 2(240P)_1.mp4', 0),
(11, 20, 1712265828500, 'lecture 1', 'lecture 1 covers basic concept about PHP', 'uploads/courses/17122658289cef3ca2e30a4b7faf9715367a10219a.mp4', 0),
(12, 20, 1712265828500, 'Lecture 2', 'lecture 2 covers OOp concepts', 'uploads/courses/1712265828Ertugrul Ghazi _ Trailer _ Season 2(240P)_1.mp4', 0),
(13, 0, 1712371624567, 'topic 1', 'topic 1 desc', 'uploads/courses/1712372096b52367034bb089a91796d3259aee5d01.mp4', 0),
(14, 0, 1712371624567, 'l1 topic 2', 'l1 decs 2', '', 0),
(15, 0, 1712373837839, 'l2 topic1', 'le topic1 des', '', 0),
(16, 0, 1712746225384, 'lectorss', 'ss', 'uploads/courses/17127462255221229443396975611_play.mp4_logo_US.mp4', 0),
(17, 0, 1712746225384, 'lec2', 'ww', 'uploads/courses/171274622517895aa66ab61ba45fe7c4297c3701d8.mp4', 0),
(18, 0, 1712746225384, 'cl2', 'lcc', 'uploads/courses/1712746225facebook_1614400925525.mp4', 0),
(19, 0, 1712797251271, 'instructor Test Course', 'instructor Test Course', 'uploads/courses/1712797251Web capture_28-2-2024_15222_[__1].jpeg', 0),
(20, 0, 1712858045715, 'N Instruct Test Course', 'N Instruct Test Course', 'uploads/courses/1712858045Tours & Travel _ Dashboard and 1 more page - Profile 1 - Microsoft​ Edge 2024-03-01 19-48-09.mp4', 0);

-- --------------------------------------------------------

--
-- Table structure for table `courses_meta`
--

CREATE TABLE `courses_meta` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `data_type` varchar(100) NOT NULL,
  `value` varchar(1024) NOT NULL,
  `disabled` tinyint(1) NOT NULL DEFAULT 0,
  `tab` varchar(50) NOT NULL,
  `uid` bigint(20) NOT NULL,
  `description` varchar(1024) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `courses_meta`
--

INSERT INTO `courses_meta` (`id`, `course_id`, `data_type`, `value`, `disabled`, `tab`, `uid`, `description`) VALUES
(1, 5, 'students-learn', 'chapter 1', 0, 'intended-learners', 16637654892625, NULL),
(2, 5, 'students-learn', 'some title', 0, 'intended-learners', 16637654893100, NULL),
(3, 5, 'prerequisites', 'third item', 0, 'intended-learners', 16637654896491, NULL),
(4, 5, 'whose-course', 'more items', 0, 'intended-learners', 16637654899242, NULL),
(5, 5, 'whose-course', 'fourth item', 0, 'intended-learners', 16637654892567, NULL),
(6, 5, 'whose-course', 'another item', 0, 'intended-learners', 16637654899041, NULL),
(7, 5, 'whose-course', 'another item', 0, 'intended-learners', 16637654899320, NULL),
(12, 5, 'curriculum', 'section 01', 0, 'curriculum', 1664537224851, 'description'),
(13, 5, 'curriculum', 'section02', 0, 'curriculum', 1664537207986, 'description02'),
(14, 5, 'lecture', 'lecture 1', 1, 'curriculum', 1668082387244, 'lecture 1 descript'),
(15, 5, 'lecture', 'lecture 2', 1, 'curriculum', 1668082387419, 'lect 2 desc'),
(17, 7, 'students-learn', 'testing', 0, 'intended-learners', 1710996808842, NULL),
(18, 7, 'students-learn', 'tets', 0, 'intended-learners', 1710996808209, NULL),
(19, 7, 'students-learn', 'ss', 0, 'intended-learners', 1710996808236, NULL),
(20, 7, 'students-learn', 'aa', 0, 'intended-learners', 1710996808471, NULL),
(21, 7, 'prerequisites', 'a', 0, 'intended-learners', 1710996808807, NULL),
(22, 9, 'students-learn', 'Introduction to the course sd', 0, 'intended-learners', 0, NULL),
(23, 9, 'students-learn', 'tets', 0, 'intended-learners', 0, NULL),
(24, 9, 'students-learn', 'ss', 0, 'intended-learners', 0, NULL),
(25, 9, 'students-learn', 'aa', 0, 'intended-learners', 0, NULL),
(26, 9, 'students-learn', 'asd', 0, 'intended-learners', 0, NULL),
(27, 9, 'prerequisites', 'No programming experences', 0, 'intended-learners', 0, NULL),
(28, 9, 'whose-course', 'Beginner of PHPs', 0, 'intended-learners', 0, NULL),
(29, 10, 'students-learn', 'testing jnn', 0, 'intended-learners', 0, NULL),
(30, 10, 'students-learn', 'tets', 0, 'intended-learners', 0, NULL),
(31, 10, 'students-learn', 'ss', 0, 'intended-learners', 0, NULL),
(32, 10, 'students-learn', 'aa', 0, 'intended-learners', 0, NULL),
(33, 10, 'prerequisites', 'a', 0, 'intended-learners', 0, NULL),
(34, 10, 'whose-course', 'Beginner of PHP', 0, 'intended-learners', 0, NULL),
(35, 11, 'students-learn', 'bb', 0, 'intended-learners', 1712018932815, NULL),
(36, 11, 'students-learn', 'tets', 0, 'intended-learners', 1712018932649, NULL),
(37, 11, 'students-learn', 'Course Details2', 0, 'intended-learners', 1712018932451, NULL),
(38, 11, 'students-learn', 'aa', 0, 'intended-learners', 1712018932398, NULL),
(39, 11, 'prerequisites', 'a', 0, 'intended-learners', 1712018932855, NULL),
(40, 11, 'whose-course', 'Beginner of PHP', 0, 'intended-learners', 1712018932694, NULL),
(41, 9, 'curriculum', 'nn', 0, 'curriculum', 1712104961669, 'nnnjj'),
(42, 13, 'curriculum', 'test Title', 0, 'curriculum', 1712109176588, 'test descriptipns '),
(43, 13, 'students-learn', 'testing', 0, 'intended-learners', 1712109612157, NULL),
(44, 13, 'prerequisites', 'tess', 0, 'intended-learners', 1712109612560, NULL),
(45, 13, 'whose-course', 'akds', 0, 'intended-learners', 1712109612383, NULL),
(46, 14, 'students-learn', 'test again1', 0, 'intended-learners', 1712109747368, NULL),
(47, 14, 'students-learn', 'test again2', 0, 'intended-learners', 1712109747532, NULL),
(48, 14, 'students-learn', 'test again3', 0, 'intended-learners', 1712109747731, NULL),
(49, 14, 'students-learn', 'test again4', 0, 'intended-learners', 1712109747101, NULL),
(50, 14, 'prerequisites', ' requirements ', 0, 'intended-learners', 1712109747270, NULL),
(51, 14, 'whose-course', 's this course for', 0, 'intended-learners', 1712109747763, NULL),
(52, 14, 'curriculum', 'test again  lectures, course sections, assignmentddx', 0, 'curriculum', 1712109831792, ' lectures, course sections, assignment description'),
(53, 14, 'whose-course', 's this course for', 1, 'intended-learners', 1712118463587, NULL),
(54, 14, 'whose-course', 'sssss', 1, 'intended-learners', 1712118488608, NULL),
(55, 16, 'students-learn', 'Introduction to the course sd', 0, 'intended-learners', 1712249268130, NULL),
(56, 16, 'students-learn', 'Course Details1', 0, 'intended-learners', 1712249268988, NULL),
(57, 16, 'students-learn', 'Course Details2', 0, 'intended-learners', 1712249268809, NULL),
(58, 16, 'students-learn', 'Course Details3', 0, 'intended-learners', 1712249268192, NULL),
(59, 16, 'prerequisites', 'No programming experences', 0, 'intended-learners', 1712249268352, NULL),
(60, 16, 'whose-course', 'Beginner of PHP', 0, 'intended-learners', 1712249268613, NULL),
(61, 17, 'students-learn', 'aa', 0, 'intended-learners', 1712249898133, NULL),
(62, 17, 'students-learn', 'vv', 0, 'intended-learners', 1712249898471, NULL),
(63, 17, 'students-learn', 'cc', 0, 'intended-learners', 1712249898363, NULL),
(64, 17, 'students-learn', 'vvc', 0, 'intended-learners', 1712249898162, NULL),
(65, 17, 'prerequisites', 'assss', 0, 'intended-learners', 1712249898628, NULL),
(66, 17, 'whose-course', 'ddd', 0, 'intended-learners', 1712249898413, NULL),
(67, 17, 'curriculum', 'tt', 0, 'curriculum', 1712249934381, 'ddd'),
(68, 18, 'students-learn', 'w', 0, 'intended-learners', 1712250463312, NULL),
(69, 18, 'students-learn', 'e', 0, 'intended-learners', 1712250463407, NULL),
(70, 18, 'students-learn', 'q', 0, 'intended-learners', 1712250463837, NULL),
(71, 18, 'students-learn', 'qwe', 0, 'intended-learners', 1712250463232, NULL),
(72, 18, 'prerequisites', 'rr', 0, 'intended-learners', 1712250463543, NULL),
(73, 18, 'whose-course', 'rq', 0, 'intended-learners', 1712250463168, NULL),
(74, 19, 'students-learn', 'aaa', 0, 'intended-learners', 1712251218591, NULL),
(75, 19, 'students-learn', 'bbb', 0, 'intended-learners', 1712251218244, NULL),
(76, 19, 'students-learn', 'ccc', 0, 'intended-learners', 1712251218945, NULL),
(77, 19, 'students-learn', 'ddd', 0, 'intended-learners', 1712251218923, NULL),
(78, 19, 'prerequisites', 'asa', 0, 'intended-learners', 1712251218263, NULL),
(79, 19, 'whose-course', 'akkk', 0, 'intended-learners', 1712251218136, NULL),
(80, 20, 'students-learn', 'Basic Concept', 0, 'intended-learners', 1712265454615, NULL),
(81, 20, 'students-learn', 'Advance Programming', 0, 'intended-learners', 1712265454411, NULL),
(82, 20, 'students-learn', 'OOP & framework concept', 0, 'intended-learners', 1712265454548, NULL),
(83, 20, 'students-learn', 'Able to make your own Framework', 0, 'intended-learners', 1712265454452, NULL),
(84, 20, 'prerequisites', 'No programming experences', 0, 'intended-learners', 1712265454422, NULL),
(85, 20, 'whose-course', 'Php web developers', 0, 'intended-learners', 1712265454390, NULL),
(86, 20, 'curriculum', 'Introduction to Web development', 0, 'curriculum', 1712265828500, 'In this course i will teach you basic to advance web development'),
(87, 1, 'curriculum', 'Lecture 1', 0, 'curriculum', 1712371624567, 'lecture 1 desc'),
(88, 1, 'curriculum', 'lec 2', 0, 'curriculum', 1712373837839, 'lec 2 desc'),
(89, 1, 'students-learn', 'Basic Concept', 0, 'intended-learners', 1712374859974, NULL),
(90, 1, 'students-learn', 'OOp', 0, 'intended-learners', 1712374859256, NULL),
(91, 1, 'students-learn', 'Advance Programming', 0, 'intended-learners', 1712374859924, NULL),
(92, 1, 'students-learn', 'Advance aaaaaa', 0, 'intended-learners', 1712374859822, NULL),
(93, 1, 'prerequisites', 'No programming experences', 0, 'intended-learners', 1712374859500, NULL),
(94, 1, 'whose-course', 'web developers', 0, 'intended-learners', 1712374859724, NULL),
(95, 20, 'curriculum', 'lecture 3', 0, 'curriculum', 1712746225384, 'lecture 3 description'),
(96, 23, 'students-learn', 'instructor Test Course', 0, 'intended-learners', 1712797196365, NULL),
(97, 23, 'students-learn', 'instructor Test Course', 0, 'intended-learners', 1712797196131, NULL),
(98, 23, 'students-learn', 'instructor Test Course', 0, 'intended-learners', 1712797196532, NULL),
(99, 23, 'students-learn', 'instructor Test Course', 0, 'intended-learners', 1712797196981, NULL),
(100, 23, 'prerequisites', 'instructor Test Course', 0, 'intended-learners', 1712797196479, NULL),
(101, 23, 'whose-course', 'instructor Test Course', 0, 'intended-learners', 1712797196412, NULL),
(102, 23, 'curriculum', 'instructor Test Course', 0, 'curriculum', 1712797251271, 'instructor Test Course'),
(103, 24, 'students-learn', 'N Instruct Test Course', 0, 'intended-learners', 1712857933763, NULL),
(104, 24, 'students-learn', 'N Instruct Test Course', 0, 'intended-learners', 1712857933601, NULL),
(105, 24, 'students-learn', 'N Instruct Test Course', 0, 'intended-learners', 1712857933101, NULL),
(106, 24, 'students-learn', 'N Instruct Test Course', 0, 'intended-learners', 1712857933158, NULL),
(107, 24, 'prerequisites', 'N Instruct Test Course', 0, 'intended-learners', 1712857933834, NULL),
(108, 24, 'whose-course', 'N Instruct Test Course', 0, 'intended-learners', 1712857933498, NULL),
(109, 24, 'curriculum', 'N Instruct Test Course', 0, 'curriculum', 1712858045715, 'N Instruct Test Course');

-- --------------------------------------------------------

--
-- Table structure for table `course_enrollments`
--

CREATE TABLE `course_enrollments` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `instructor_id` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course_enrollments`
--

INSERT INTO `course_enrollments` (`id`, `course_id`, `user_id`, `instructor_id`, `status`) VALUES
(3, 20, 17, 15, 0),
(8, 23, 17, 16, 0),
(10, 23, 3, 16, 0),
(11, 24, 3, 20, 0),
(12, 3, 3, 1, 0),
(13, 20, 3, 15, 0),
(14, 20, 23, 15, 0),
(15, 1, 23, 1, 0),
(16, 20, 23, 15, 0),
(17, 24, 23, 20, 0);

-- --------------------------------------------------------

--
-- Table structure for table `course_levels`
--

CREATE TABLE `course_levels` (
  `id` int(11) NOT NULL,
  `level` varchar(30) NOT NULL,
  `disabled` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course_levels`
--

INSERT INTO `course_levels` (`id`, `level`, `disabled`) VALUES
(1, 'Beginner Level', 0),
(2, 'Intermediate Level', 0),
(3, 'Expert Level', 0),
(4, 'All Levels', 0);

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` int(11) NOT NULL,
  `currency` varchar(20) NOT NULL,
  `symbol` varchar(4) NOT NULL,
  `disabled` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `currency`, `symbol`, `disabled`) VALUES
(1, 'US Dollar', '$', 0);

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` int(11) NOT NULL,
  `symbol` varchar(10) NOT NULL,
  `language` varchar(30) NOT NULL,
  `disabled` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `symbol`, `language`, `disabled`) VALUES
(1, 'af_ZA', 'Afrikaans', 0),
(2, 'sq_AL', 'Shqip', 0),
(3, 'ar_AR', 'العربية', 0),
(4, 'hy_AM', 'Հայերեն', 0),
(5, 'ay_BO', 'Aymar aru', 0),
(6, 'az_AZ', 'Azərbaycan dili', 0),
(7, 'eu_ES', 'Euskara', 0),
(8, 'bn_IN', 'Bangla', 0),
(9, 'bs_BA', 'Bosanski', 0),
(10, 'bg_BG', 'Български', 0),
(11, 'my_MM', 'မြန်မာဘာသာ', 0),
(12, 'ca_ES', 'Català', 0),
(13, 'ck_US', 'Cherokee', 0),
(14, 'hr_HR', 'Hrvatski', 0),
(15, 'cs_CZ', 'Čeština', 0),
(16, 'da_DK', 'Dansk', 0),
(17, 'nl_NL', 'Nederlands', 0),
(18, 'nl_BE', 'Nederlands (België)', 0),
(19, 'en_IN', 'English (India)', 0),
(20, 'en_GB', 'English (UK)', 0),
(21, 'en_US', 'English (US)', 0),
(22, 'et_EE', 'Eesti', 0),
(23, 'fo_FO', 'Føroyskt', 0),
(24, 'tl_PH', 'Filipino', 0),
(25, 'fi_FI', 'Suomi', 0),
(26, 'fr_CA', 'Français (Canada)', 0),
(27, 'fr_FR', 'Français (France)', 0),
(28, 'fy_NL', 'Frysk', 0),
(29, 'gl_ES', 'Galego', 0),
(30, 'ka_GE', 'ქართული', 0),
(31, 'de_DE', 'Deutsch', 0),
(32, 'el_GR', 'Ελληνικά', 0),
(33, 'gn_PY', 'Avañe\'ẽ', 0),
(34, 'gu_IN', 'ગુજરાતી', 0),
(35, 'ht_HT', 'Ayisyen', 0),
(36, 'he_IL', '‏עברית‏', 0),
(37, 'hi_IN', 'हिन्दी', 0),
(38, 'hu_HU', 'Magyar', 0),
(39, 'is_IS', 'Íslenska', 0),
(40, 'id_ID', 'Bahasa Indonesia', 0),
(41, 'ga_IE', 'Gaeilge', 0),
(42, 'it_IT', 'Italiano', 0),
(43, 'ja_JP', '日本語', 0),
(44, 'jv_ID', 'Basa Jawa', 0),
(45, 'kn_IN', 'Kannaḍa', 0),
(46, 'kk_KZ', 'Қазақша', 0),
(47, 'km_KH', 'Khmer', 0),
(48, 'ko_KR', '한국어', 0),
(49, 'ku_TR', 'Kurdî', 0),
(50, 'lv_LV', 'Latviešu', 0),
(51, 'li_NL', 'Lèmbörgs', 0),
(52, 'lt_LT', 'Lietuvių', 0),
(53, 'mk_MK', 'Македонски', 0),
(54, 'mg_MG', 'Malagasy', 0),
(55, 'ms_MY', 'Bahasa Melayu', 0),
(56, 'ml_IN', 'Malayāḷam', 0),
(57, 'mt_MT', 'Malti', 0),
(58, 'mr_IN', 'मराठी', 0),
(59, 'mn_MN', 'Монгол', 0),
(60, 'ne_NP', 'नेपाली', 0),
(61, 'se_NO', 'Davvisámegiella', 0),
(62, 'nb_NO', 'Norsk (bokmål)', 0),
(63, 'nn_NO', 'Norsk (nynorsk)', 0),
(64, 'ps_AF', 'پښتو', 0),
(65, 'fa_IR', 'فارسی', 0),
(66, 'pl_PL', 'Polski', 0),
(67, 'pt_BR', 'Português (Brasil)', 0),
(68, 'pt_PT', 'Português (Portugal)', 0),
(69, 'pa_IN', 'ਪੰਜਾਬੀ', 0),
(70, 'qu_PE', 'Qhichwa', 0),
(71, 'ro_RO', 'Română', 0),
(72, 'rm_CH', 'Rumantsch', 0),
(73, 'ru_RU', 'Русский', 0),
(74, 'sa_IN', 'संस्कृतम्', 0),
(75, 'sr_RS', 'Српски', 0),
(76, 'zh_CN', '中文(简体)', 0),
(77, 'sk_SK', 'Slovenčina', 0),
(78, 'sl_SI', 'Slovenščina', 0),
(79, 'so_SO', 'Soomaaliga', 0),
(80, 'es_LA', 'Español', 0),
(81, 'es_CL', 'Español (Chile)', 0),
(82, 'es_CO', 'Español (Colombia)', 0),
(83, 'es_MX', 'Español (México)', 0),
(84, 'es_ES', 'Español (España)', 0),
(85, 'es_VE', 'Español (Venezuela)', 0),
(86, 'sw_KE', 'Kiswahili', 0),
(87, 'sv_SE', 'Svenska', 0),
(88, 'sy_SY', 'Leššānā Suryāyā', 0),
(89, 'tg_TJ', 'тоҷикӣ, تاجیکی‎, tojikī', 0),
(90, 'ta_IN', 'தமிழ்', 0),
(91, 'tt_RU', 'татарча / Tatarça / تاتارچا', 0),
(92, 'te_IN', 'Telugu', 0),
(93, 'th_TH', 'ภาษาไทย', 0),
(94, 'zh_HK', '中文(香港)', 0),
(95, 'zh_TW', '中文 (繁體)', 0),
(96, 'tr_TR', 'Türkçe', 0),
(97, 'uk_UA', 'Українська', 0),
(98, 'ur_PK', 'اردو', 0),
(99, 'uz_UZ', 'O\'zbek', 0),
(100, 'vi_VN', 'Tiếng Việt', 0),
(101, 'cy_GB', 'Cymraeg', 0),
(102, 'xh_ZA', 'isiXhosa', 0),
(103, 'yi_DE', 'ייִדיש', 0),
(104, 'zu_ZA', 'isiZulu', 0);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `message_to` int(11) NOT NULL,
  `message_from` int(11) NOT NULL,
  `message` text NOT NULL,
  `date_time` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `message_to`, `message_from`, `message`, `date_time`) VALUES
(1, 16, 17, 'Hello', '2024-04-11'),
(2, 17, 16, 'hi', '2024-04-11'),
(3, 17, 16, 'heloo', '2024-04-11'),
(4, 17, 16, 'heloo', '2024-04-11');

-- --------------------------------------------------------

--
-- Table structure for table `permissions_map`
--

CREATE TABLE `permissions_map` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `permission` varchar(100) NOT NULL,
  `disabled` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `permissions_map`
--

INSERT INTO `permissions_map` (`id`, `role_id`, `permission`, `disabled`) VALUES
(1, 2, 'delete_categories', 1),
(2, 2, 'edit_permissions', 1),
(3, 1, 'add_categories', 1),
(4, 1, 'view_permissions', 1),
(5, 1, 'delete_permissions', 1),
(6, 1, 'edit_categories', 1),
(7, 1, 'delete_categories', 1),
(8, 1, 'add_permissions', 1),
(9, 1, 'edit_permissions', 1),
(10, 3, 'add_categories', 1),
(11, 3, 'delete_categories', 1),
(12, 3, 'view_permissions', 1),
(13, 3, 'edit_permissions', 1),
(14, 3, 'delete_permissions', 1),
(15, 1, 'view_roles', 1),
(16, 1, 'add_roles', 1),
(17, 1, 'edit_roles', 1),
(18, 1, 'delete_roles', 1),
(19, 1, 'view_categories', 1),
(20, 5, 'view_categories', 1),
(21, 5, 'view_dashboard', 1),
(22, 5, 'view_courses', 0),
(23, 5, 'add_courses', 0),
(24, 1, 'view_courses', 0),
(25, 1, 'add_courses', 0),
(26, 1, 'edit_courses', 0),
(27, 1, 'delete_courses', 0),
(28, 5, 'edit_courses', 0),
(29, 5, 'view_enrolled_courses', 0),
(30, 5, 'view_watch_history', 0),
(31, 5, 'delete_enrolled_courses', 0),
(32, 5, 'delete_watch_history', 0),
(33, 5, 'view_cart_items', 0),
(34, 4, 'view_sales', 0),
(35, 4, 'edit_sales', 0),
(36, 4, 'delete_sales', 0),
(37, 4, 'view_courses', 0),
(38, 4, 'add_courses', 0),
(39, 4, 'edit_courses', 0),
(40, 4, 'delete_courses', 0),
(41, 4, 'view_enrolled_courses', 0),
(42, 4, 'add_enrolled_courses', 0),
(43, 4, 'edit_enrolled_courses', 0),
(44, 4, 'delete_enrolled_courses', 0),
(45, 4, 'view_watch_history', 0),
(46, 4, 'delete_watch_history', 0),
(47, 4, 'view_cart_items', 0),
(48, 4, 'delete_cart_items', 0),
(49, 5, 'view_admin_area', 0);

-- --------------------------------------------------------

--
-- Table structure for table `prices`
--

CREATE TABLE `prices` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `disabled` tinyint(1) NOT NULL DEFAULT 0,
  `symbol` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `prices`
--

INSERT INTO `prices` (`id`, `name`, `price`, `disabled`, `symbol`) VALUES
(1, 'Free', '0', 0, 'RM'),
(3, 'RM', '123', 0, 'RM');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `role` varchar(30) NOT NULL,
  `disabled` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role`, `disabled`) VALUES
(1, 'user', 0),
(2, 'admin', 0),
(3, 'manager', 0),
(4, 'instructor', 0),
(5, 'student', 0);

-- --------------------------------------------------------

--
-- Table structure for table `slider_images`
--

CREATE TABLE `slider_images` (
  `id` int(11) NOT NULL,
  `image` varchar(2048) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `disabled` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `slider_images`
--

INSERT INTO `slider_images` (`id`, `image`, `title`, `description`, `disabled`) VALUES
(1, 'uploads/images/1658218995pexels-photo-3756774.jpeg', 'What is Lorem Ipsum?', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has su', 0),
(2, 'uploads/images/1658219311pexels-photo-3757004.jpeg', 'Why do we use it?', 'packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (in', 0),
(3, 'uploads/images/1658219956amifaku.jpg', 'Where does it come from?', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one ', 0),
(4, 'uploads/images/1658220321Rihanna.-Photo-W-Magazine.jpg', 'Where can I get some?', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, yo', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(11) NOT NULL DEFAULT 1,
  `date` date DEFAULT NULL,
  `image` varchar(1024) NOT NULL,
  `about` varchar(2048) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `job` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `address` varchar(1024) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `twitter_link` varchar(1024) DEFAULT NULL,
  `facebook_link` varchar(1024) DEFAULT NULL,
  `instagram_link` varchar(1024) DEFAULT NULL,
  `linkedin_link` varchar(1024) DEFAULT NULL,
  `status` varchar(256) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `firstname`, `lastname`, `password`, `role`, `date`, `image`, `about`, `company`, `job`, `country`, `address`, `phone`, `twitter_link`, `facebook_link`, `instagram_link`, `linkedin_link`, `status`) VALUES
(1, 'email@email.com', 'Mary', 'Jane', '$2y$10$Pe46vRnUHD1CnxjH74lvnOFfB7yKgxNThQstvP/ICep9ZTbpQvwAq', 2, '2022-07-06', 'uploads/images/1657061746791a047636136702e25ba1096b11cfe7.jpg', 'What is Lorem Ipsum?\r\n\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n', '', '', '', '', '0977568985', '', '', '', '', 'pending'),
(2, 'mary@email.com', 'Mary', 'Phiri', '$2y$10$ZdIB05xb93kZKMo.Zpe6huRSKUSDBG0FrdAfNE01V/oFlREFcg14O', 1, '2022-08-01', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'pending'),
(3, 'admin@example.com', 'Muhammad', 'Ali', '$2y$10$jzONuMQAA6yxsWZETVGT0OaDi.hhrWeJmH6cmsDroikjEZYmlxdzy', 2, '2024-04-04', 'uploads/images/1712259486weed-user-accunt.png', 'testing', 'MA Digital Marketing Agency', 'testing', 'Pakistan', 'Rawalpindi', '0775689811', 'https://www.twitter.com', 'https://www.twitter.com', 'https://www.twitter.com', 'https://www.twitter.com', 'approved'),
(15, 'devali12@gmail.com', 'asdjfja', 'asfasd', '$2y$10$MaCex81M6glffRS8nSESrOCOaIok0qZKRlsaq59jC2rfbpjNaCdvK', 1, '2024-04-04', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'approved'),
(16, 'Instructorali@gmail.com', 'Instructor', 'Ali', '$2y$10$8S9b7OoDmZTZCe6e5ZBYpeWB4koJFmS7vCn22MbD/cgKrMBCFhWAK', 4, '2024-04-06', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'pending'),
(17, 'custom@gmail.com', 'user', 'custom', '$2y$10$4FQHwyWhF.iwZeoskHziwOwO78aheZbZ8w5x51SjESFudU.kxBKOW', 5, '2024-04-06', 'uploads/images/1712851830mercedes-1.png', 'j', 'kk', 'jj', 'Pakistan', 'kk', '0123123123', '', '', '', '', 'pending'),
(18, 'Inst@gmail.com', 'New', 'Inst', '$2y$10$oLDCnFLYup1Xq5UHUjvmwecIh/0oelgcRZHUMQ5.6FXLnQsOsr4FC', 4, '2024-04-11', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'pending'),
(19, 'newtest@gmail.com', 'New', 'test', '$2y$10$rUSzMqt1fREpkygW0HM3suindlbwoQDNuLDSlddJ242bcvht.45ku', 5, '2024-04-11', 'uploads/images/1712854775dubai_frame_service2.png', '', '', '', '', '', '', '', '', '', '', 'pending'),
(20, 'newinst@gmail.com', 'New', 'Instructor', '$2y$10$Vt6bUH.MgHqFshs4SYCiUuHS2G6vjRAqDbrx30UJDF7n1Ymfnl9Aa', 4, '2024-04-11', '', 'test', 'tt', '', '', '', '', '', '', '', '', 'pending'),
(21, 'student@gmail.com', 'u', 'Student', '$2y$10$Qa/vm1pmnLaZeWfvTy9e0umVS4KkVcm8AKoSYk18cJU74a/sst4Hi', 5, '2024-04-12', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'pending'),
(22, 'instructor@gmail.com', 'u', 'Instructor', '$2y$10$4OPbIqwjMoGM6yEgmX4L1ugP1OP1/mLe2KEVfEZpWastTJvqKJjfa', 4, '2024-04-12', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'pending'),
(23, 'sanaulla@gmail.com', 'Sana', 'ulla', '$2y$10$EjWHT4Jzxc5ZKthW7QVhxuanj/gX9nFpI.BJRSEP4xhYLaSAdvEf2', 5, '2024-04-14', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'pending'),
(24, 'newus@mail.com', 'new', 'user', '$2y$10$NGg8re3pW8engw8AQElXU.eW6i/h3PCxxBuPW3u9/chq6be6l5Npq', 5, '2024-04-14', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `watch_history`
--

CREATE TABLE `watch_history` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `instructor_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `lecture_id` int(11) NOT NULL,
  `progress` int(11) NOT NULL,
  `isCompleted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `watch_history`
--

INSERT INTO `watch_history` (`id`, `user_id`, `instructor_id`, `course_id`, `lecture_id`, `progress`, `isCompleted`) VALUES
(1, 17, 20, 20, 11, 7, 0),
(2, 17, 20, 20, 12, 71, 0),
(3, 17, 15, 20, 11, 30, 0),
(5, 17, 15, 20, 12, 38, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `disabled` (`disabled`),
  ADD KEY `category` (`category`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments_reply`
--
ALTER TABLE `comments_reply`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `competitions`
--
ALTER TABLE `competitions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `title` (`title`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `sub_category_id` (`sub_category_id`),
  ADD KEY `level_id` (`level_id`),
  ADD KEY `language_id` (`language_id`),
  ADD KEY `price_id` (`price_id`),
  ADD KEY `primary_subject` (`primary_subject`),
  ADD KEY `date` (`date`),
  ADD KEY `approved` (`approved`),
  ADD KEY `published` (`published`),
  ADD KEY `views` (`views`),
  ADD KEY `trending` (`trending`);

--
-- Indexes for table `courses_lectures`
--
ALTER TABLE `courses_lectures`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `disabled` (`disabled`);

--
-- Indexes for table `courses_meta`
--
ALTER TABLE `courses_meta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `disabled` (`disabled`),
  ADD KEY `data_type` (`data_type`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `tab` (`tab`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `course_enrollments`
--
ALTER TABLE `course_enrollments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_levels`
--
ALTER TABLE `course_levels`
  ADD PRIMARY KEY (`id`),
  ADD KEY `disabled` (`disabled`);

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `disabled` (`disabled`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `disabled` (`disabled`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions_map`
--
ALTER TABLE `permissions_map`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`),
  ADD KEY `permission` (`permission`),
  ADD KEY `disabled` (`disabled`);

--
-- Indexes for table `prices`
--
ALTER TABLE `prices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `price` (`price`),
  ADD KEY `disabled` (`disabled`),
  ADD KEY `name` (`name`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `disabled` (`disabled`);

--
-- Indexes for table `slider_images`
--
ALTER TABLE `slider_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`),
  ADD KEY `firstname` (`firstname`),
  ADD KEY `lastname` (`lastname`),
  ADD KEY `date` (`date`);

--
-- Indexes for table `watch_history`
--
ALTER TABLE `watch_history`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `comments_reply`
--
ALTER TABLE `comments_reply`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `competitions`
--
ALTER TABLE `competitions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `courses_lectures`
--
ALTER TABLE `courses_lectures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `courses_meta`
--
ALTER TABLE `courses_meta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT for table `course_enrollments`
--
ALTER TABLE `course_enrollments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `course_levels`
--
ALTER TABLE `course_levels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `permissions_map`
--
ALTER TABLE `permissions_map`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `prices`
--
ALTER TABLE `prices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `slider_images`
--
ALTER TABLE `slider_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `watch_history`
--
ALTER TABLE `watch_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
