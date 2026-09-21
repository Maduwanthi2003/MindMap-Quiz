-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 21, 2026 at 11:20 AM
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
-- Database: `mindmapquiz`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `role` varchar(50) DEFAULT 'admin',
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `name`, `email`, `password_hash`, `role`, `created_at`) VALUES
(2, 'Maduwanthi', 'maduwanthidrp@gmail.com', '$2y$10$Kb1kypPNOm/C8h2/wMemROCO791zK4ojfQ2uI1HaJzTH02P2TvVQC', 'admin', '2026-07-18 16:35:38');

-- --------------------------------------------------------

--
-- Table structure for table `content`
--

CREATE TABLE `content` (
  `content_id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `format` varchar(20) DEFAULT NULL,
  `url` varchar(500) DEFAULT NULL,
  `vark_category` varchar(20) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedback_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `content_id` int(11) DEFAULT NULL,
  `result_id` int(11) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL CHECK (`rating` between 1 and 5),
  `comment` text DEFAULT NULL,
  `submitted_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`feedback_id`, `student_id`, `content_id`, `result_id`, `rating`, `comment`, `submitted_at`) VALUES
(1, 9, NULL, NULL, NULL, 'good', '2026-07-16 07:40:31'),
(2, 11, NULL, NULL, NULL, 'good learning flatform and creative webapplication', '2026-07-16 08:12:38'),
(3, 9, NULL, NULL, NULL, 'good', '2026-07-16 09:01:02');

-- --------------------------------------------------------

--
-- Table structure for table `lecturers`
--

CREATE TABLE `lecturers` (
  `lecturer_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `profile_photo` varchar(255) DEFAULT NULL,
  `password_hash` varchar(255) NOT NULL,
  `role` varchar(50) DEFAULT 'lecturer',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lecturers`
--

INSERT INTO `lecturers` (`lecturer_id`, `name`, `email`, `profile_photo`, `password_hash`, `role`, `created_at`, `updated_at`) VALUES
(11, 'Pavarindu Sahansith', 'pavarindusahansith@gmail.com', '1784547974_574401392_841699581574858_1243588691047475002_n.jpg', '$2y$10$CV1v3NYKYjeTfLWlx8hk6uxooBYTPrcBp4Xo9Tl497V.QJ3kmxbVS', 'lecturer', '2026-07-15 14:42:22', '2026-07-20 06:16:17'),
(12, 'Shantha Bandara', 'shanthabandara@gmail.com', NULL, '$2y$10$WOlqCySjwd.qU3/3iGMS5.RceFXUyKXUsfVrnuXWxDBoRPQcXYCu2', 'lecturer', '2026-07-15 14:49:09', NULL),
(13, 'Ada Lovelace', 'lecturer-6a57a18fdf0ce@example.com', NULL, '$2y$04$DruCcUf7bhj2oonRiRu6detKT8f0jdelfCLRIPu.Spm0yyMQx.uem', 'lecturer', '2026-07-15 15:04:50', NULL),
(14, 'Grace Hopper', 'lecturer-login-6a57a194be8e7@example.com', NULL, '$2y$04$Q2Yb/v2iI/bYYrYBsq.4cOLXBk3NgyzbUMcyHzISExJEChytqFRum', 'lecturer', '2026-07-15 15:04:52', NULL),
(15, 'Ada Lovelace', 'lecturer-6a57a46e495ca@example.com', NULL, '$2y$04$DuKDl/Z5c15zM/3P/X6naeALoUc5cAcNgDMHfDSdHO2EGAkPWxln6', 'lecturer', '2026-07-15 15:17:02', NULL),
(16, 'Grace Hopper', 'lecturer-login-6a57a46e5d552@example.com', NULL, '$2y$04$9l.kGtIGwAAcb.PjrOrlq.h4liiqdAtQ1RxuymdOjL6Y05oSOTdcq', 'lecturer', '2026-07-15 15:17:02', NULL),
(17, 'Ada Lovelace', 'lecturer-6a57a568e709b@example.com', NULL, '$2y$04$mBJJfDTdUZU6xroKWjqwq.uVvSASO8.PfYg.aOyJSM1Cegi8J5ALm', 'lecturer', '2026-07-15 15:21:12', NULL),
(18, 'Grace Hopper', 'lecturer-login-6a57a56906c8b@example.com', NULL, '$2y$04$sFc1VTNI0ilpk.A271X9j.OApFD55beCbqTmW8evwJK99WQPO.lSO', 'lecturer', '2026-07-15 15:21:13', NULL),
(19, 'Ravindra Prasad', 'ravi@gmail.com', NULL, '$2y$10$EJpw.cCA/ZmOdk6V4296S.NMr.CTSvHc.vK/z7ORrsb4aXvhRr.P6', 'lecturer', '2026-07-18 18:01:33', NULL),
(20, 'Ada Lovelace', 'lecturer-6a5da8e7e5938@example.com', NULL, '$2y$04$v3gya7gTyrywtbKvn4dvD.CrCp2j8n4V2vQsbUsCf/pql6awPv6iS', 'lecturer', '2026-07-20 04:49:45', NULL),
(21, 'Grace Hopper', 'lecturer-login-6a5da8ecadb48@example.com', NULL, '$2y$04$DQA8MXpCnWuRJTf8ei0O5OVPqUdk716duXYrFJUoj0W54Cwt1oiiC', 'lecturer', '2026-07-20 04:49:48', NULL),
(22, 'Ada Lovelace', 'lecturer-6a5da98d0c29e@example.com', NULL, '$2y$04$bhgfpfvLmcoReJsw6Unvs.t1iUvCLXX6YWYmboBh6QOTCVgjj640S', 'lecturer', '2026-07-20 04:52:29', NULL),
(23, 'Grace Hopper', 'lecturer-login-6a5da98d3fb21@example.com', NULL, '$2y$04$LiduY1BCoYocSGK/zf93mO3z5Pd1.p2WTKbkPPJEboPfNyGX8GGhK', 'lecturer', '2026-07-20 04:52:29', NULL),
(24, 'Ravindra Prasad', 'ravindra@gmail.com', NULL, '$2y$10$N8XG/z6AFP5Dou99PT1jNe0ZaS9.ub5RSJr1m9cL994F5NHVOFXF2', 'lecturer', '2026-07-20 04:56:54', NULL),
(25, 'Ada Lovelace', 'lecturer-6a5dab44d0546@example.com', NULL, '$2y$04$sbMSPlUiQrVsjcmR7YOcHehqGXl/4oCeQHIAn2V5i1RZUZAzDNg/S', 'lecturer', '2026-07-20 04:59:48', NULL),
(26, 'Grace Hopper', 'lecturer-login-6a5dab451813c@example.com', NULL, '$2y$04$ar/U.kSy6UMDtEVgQleHruOGcPDpK1kP3UO/q0ZwVi05zxc8u0Qla', 'lecturer', '2026-07-20 04:59:49', NULL),
(27, 'Test Lecturer', 'lecturer-6a5dabb1c2907@example.com', NULL, '$2y$04$pZNMFs69826jlJPD5UtNEe7yZb061ZwLEyls8slRENcLAJ8pJLEFu', 'lecturer', '2026-07-20 05:01:37', NULL),
(28, 'Sample Lecturer', 'lecturer-login-6a5dabb20520b@example.com', NULL, '$2y$04$9v6HDmijulRmWPgAkx7IVeviyvHwfbfZt93VSAY9VqHZeuUScUkWu', 'lecturer', '2026-07-20 05:01:38', NULL),
(29, 'Test Lecturer', 'lecturer-6a5db407ef24b@example.com', NULL, '$2y$04$p//yZbzxRBSlm8wr15o70OrA/AwLMzhBCAZ/7q3d93LZ8zKIrZMRq', 'lecturer', '2026-07-20 05:37:16', NULL),
(30, 'Test Lecturer', 'lecturer-login-6a5db40f7edde@example.com', NULL, '$2y$04$C36E9UlHO47i8/qXwAA0RugBKhT3XMLsRfQqihsGic9nQfLcXY9YC', 'lecturer', '2026-07-20 05:37:19', NULL),
(31, 'Test Lecturer', 'lecturer-6a5db45d4fd17@example.com', NULL, '$2y$04$tagHCpo.SEabFVJDa7c8He3mgF3Bx5dsYTdE9PDMjAZoJv5HNOUky', 'lecturer', '2026-07-20 05:38:37', NULL),
(32, 'Test Lecturer', 'lecturer-login-6a5db45d80611@example.com', NULL, '$2y$04$u53n/grvH8mwXmmqeuSi7eP8BJ.DdzUfRq6bYNeq8dd0Amn2DTAbO', 'lecturer', '2026-07-20 05:38:37', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lectures`
--

CREATE TABLE `lectures` (
  `lecture_id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `description` text DEFAULT NULL,
  `vark_category` varchar(20) DEFAULT NULL,
  `format` varchar(50) DEFAULT NULL,
  `url` varchar(500) DEFAULT NULL,
  `lecturer_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lectures`
--

INSERT INTO `lectures` (`lecture_id`, `title`, `description`, `vark_category`, `format`, `url`, `lecturer_id`, `created_at`) VALUES
(1, 'Software Development', 'everyone must come', 'Reading/Writing', 'PDF', NULL, 11, '2026-07-16 07:44:24');

-- --------------------------------------------------------

--
-- Table structure for table `lecture_assignments`
--

CREATE TABLE `lecture_assignments` (
  `assignment_id` int(11) NOT NULL,
  `lecture_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `assigned_at` datetime DEFAULT current_timestamp(),
  `share_link` varchar(500) DEFAULT NULL,
  `status` varchar(20) DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lecture_assignments`
--

INSERT INTO `lecture_assignments` (`assignment_id`, `lecture_id`, `student_id`, `assigned_at`, `share_link`, `status`) VALUES
(1, 1, 2, '2026-07-16 07:44:47', 'mindmapquiz.lk/lectures/v/745', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2026_07_15_000000_add_profile_photo_to_students_table', 1),
(2, '2014_10_12_000000_create_users_table', 2),
(3, '2014_10_12_100000_create_password_resets_table', 2),
(4, '2019_08_19_000000_create_failed_jobs_table', 2),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 2),
(6, '2026_07_15_140619_create_lecturers_table', 3),
(7, '2026_07_16_000000_add_profile_photo_to_lecturers_table', 4),
(8, '2026_07_16_000001_add_updated_at_to_lecturers_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `progress_reports`
--

CREATE TABLE `progress_reports` (
  `report_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `trend_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`trend_data`)),
  `activity_log` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`activity_log`)),
  `generated_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `question_id` int(11) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `scenario_text` text NOT NULL,
  `option_a` varchar(255) NOT NULL,
  `option_b` varchar(255) NOT NULL,
  `option_c` varchar(255) NOT NULL,
  `option_d` varchar(255) NOT NULL,
  `vark_mapping` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quizzes`
--

CREATE TABLE `quizzes` (
  `quiz_id` int(11) NOT NULL,
  `total_questions` int(11) NOT NULL DEFAULT 10,
  `status` varchar(20) DEFAULT 'active',
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quizzes`
--

INSERT INTO `quizzes` (`quiz_id`, `total_questions`, `status`, `created_at`) VALUES
(1, 10, 'active', '2026-07-15 07:36:29');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_answers`
--

CREATE TABLE `quiz_answers` (
  `answer_id` int(11) NOT NULL,
  `attempt_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `selected_option` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quiz_attempts`
--

CREATE TABLE `quiz_attempts` (
  `attempt_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `started_at` datetime DEFAULT current_timestamp(),
  `completed_at` datetime DEFAULT NULL,
  `status` varchar(20) DEFAULT 'in_progress'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quiz_attempts`
--

INSERT INTO `quiz_attempts` (`attempt_id`, `student_id`, `quiz_id`, `started_at`, `completed_at`, `status`) VALUES
(1, 5, 1, '2026-07-15 07:36:30', '2026-07-15 07:36:30', 'completed'),
(2, 5, 1, '2026-07-15 07:38:17', '2026-07-15 07:38:17', 'completed'),
(3, 5, 1, '2026-07-15 07:39:36', '2026-07-15 07:39:36', 'completed'),
(4, 6, 1, '2026-07-15 07:53:59', '2026-07-15 07:53:59', 'completed'),
(5, 9, 1, '2026-07-16 07:39:22', '2026-07-16 07:39:22', 'completed'),
(6, 11, 1, '2026-07-16 08:10:27', '2026-07-16 08:10:27', 'completed'),
(7, 9, 1, '2026-07-16 08:59:56', '2026-07-16 08:59:56', 'completed'),
(8, 23, 1, '2026-07-20 07:00:12', '2026-07-20 07:00:12', 'completed'),
(9, 9, 1, '2026-07-21 10:31:14', '2026-07-21 10:31:14', 'completed');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_results`
--

CREATE TABLE `quiz_results` (
  `result_id` int(11) NOT NULL,
  `attempt_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `calculated_at` datetime DEFAULT current_timestamp(),
  `dominant_style` varchar(20) DEFAULT NULL,
  `secondary_style` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quiz_results`
--

INSERT INTO `quiz_results` (`result_id`, `attempt_id`, `student_id`, `calculated_at`, `dominant_style`, `secondary_style`) VALUES
(1, 1, 5, '2026-07-15 07:36:30', 'Kinesthetic', 'Visual'),
(2, 2, 5, '2026-07-15 07:38:17', 'Kinesthetic', 'Visual'),
(3, 3, 5, '2026-07-15 07:39:36', 'Kinesthetic', 'Visual'),
(4, 4, 6, '2026-07-15 07:53:59', 'Visual', 'Auditory'),
(5, 5, 9, '2026-07-16 07:39:22', 'Visual', 'Reading/Writing'),
(6, 6, 11, '2026-07-16 08:10:27', 'Visual', 'Auditory'),
(7, 7, 9, '2026-07-16 08:59:56', 'Auditory', 'Reading/Writing'),
(8, 8, 23, '2026-07-20 07:00:12', 'Auditory', 'Visual'),
(9, 9, 9, '2026-07-21 10:31:14', 'Auditory', 'Reading/Writing');

-- --------------------------------------------------------

--
-- Table structure for table `recommendations`
--

CREATE TABLE `recommendations` (
  `rec_id` int(11) NOT NULL,
  `result_id` int(11) NOT NULL,
  `learner_type` varchar(20) DEFAULT NULL,
  `study_techniques` text DEFAULT NULL,
  `content_format` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recommendations`
--

INSERT INTO `recommendations` (`rec_id`, `result_id`, `learner_type`, `study_techniques`, `content_format`) VALUES
(1, 1, 'Kinesthetic', 'Use hands-on practice, lab sessions and real-world examples.', 'Kinesthetic'),
(2, 2, 'Kinesthetic', 'Use hands-on practice, lab sessions and real-world examples.', 'Kinesthetic'),
(3, 3, 'Kinesthetic', 'Use hands-on practice, lab sessions and real-world examples.', 'Kinesthetic'),
(4, 4, 'Visual', 'Use mind maps, diagrams, colour-coded notes and videos.', 'Visual'),
(5, 5, 'Visual', 'Use mind maps, diagrams, colour-coded notes and videos.', 'Visual'),
(6, 6, 'Visual', 'Use mind maps, diagrams, colour-coded notes and videos.', 'Visual'),
(7, 7, 'Auditory', 'Join study groups, record lectures and discuss concepts aloud.', 'Auditory'),
(8, 8, 'Auditory', 'Join study groups, record lectures and discuss concepts aloud.', 'Auditory'),
(9, 9, 'Auditory', 'Join study groups, record lectures and discuss concepts aloud.', 'Auditory');

-- --------------------------------------------------------

--
-- Table structure for table `rec_content`
--

CREATE TABLE `rec_content` (
  `id` int(11) NOT NULL,
  `rec_id` int(11) NOT NULL,
  `content_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `profile_photo` varchar(255) DEFAULT NULL,
  `index_number` varchar(50) DEFAULT NULL,
  `password_hash` varchar(255) NOT NULL,
  `session_token` varchar(255) DEFAULT NULL,
  `role` varchar(20) DEFAULT 'student',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `full_name`, `email`, `profile_photo`, `index_number`, `password_hash`, `session_token`, `role`, `created_at`, `updated_at`) VALUES
(2, 'Randi Pradeepika', 'maduwanthidharmsirige@gmail.com', NULL, NULL, '$2y$10$MM5UxXYHoL3P6Fy4FNKI0OXVMH4O/3tWTum/3OY/vG3Y040jHBTei', NULL, 'student', '2026-07-12 05:28:07', '2026-07-12 05:28:07'),
(3, 'Venura sankalpa', 'venurasankalpa5053@gmail.com', NULL, NULL, '$2y$10$UYw36QP5sjsLiedybNaR9.bjawhknloGbDULxcVDc6Uy1A9jyc6V.', NULL, 'student', '2026-07-13 05:51:07', '2026-07-13 05:51:07'),
(4, 'nimal kumara', 'nimal@gmail.com', NULL, NULL, '$2y$10$YLzkruNbVaWI3Yp2QU3Iy.XMGwYHYO16P85lC57A3oWHgljGtlUbK', NULL, 'student', '2026-07-13 05:55:58', '2026-07-13 05:55:58'),
(5, 'Dasuni Dilhara', 'dasunidilhara@gmail.com', NULL, NULL, '$2y$10$O5.pHxwViUrDsetIwPaf5.QjDhBXSMqhgwNj.GRaV2TPVEJjO3htO', NULL, 'student', '2026-07-15 07:18:08', '2026-07-15 07:18:08'),
(6, 'Thamali Lakshika', 'thamalilakshika@gmail.com', '1784103537_550600302_749511711406346_5431864895355910033_n.jpg', NULL, '$2y$10$LTK6cZx1pMZXnlrtOi3/kOcBpHSfjNVuzBZiRYS0lPtQFyiR2XUre', NULL, 'student', '2026-07-15 07:53:30', '2026-07-15 08:18:57'),
(9, 'D.R.P Maduwanthi', 'maduwanthidrpm@gmail.com', '1784188997_Gemini_Generated_Image_j95h25j95h25j95h.png', 'ANU/IT/2324/F/013', '$2y$10$ifQAqkd4fB6IJLfhBNbW/OQQmncOgCdWufqeaqWKA2pWo.KPQ3AlC', NULL, 'student', '2026-07-16 06:30:40', '2026-07-16 08:03:17'),
(11, 'kasun rathnayaka', 'kasun@gmail.com', NULL, 'ANU/IT/2324/F/065', '$2y$10$qK5baCEp/42uuNH0hWTBxub/8ofrsOt51mc2CX5yRTZ4vcW8dc/KS', NULL, 'student', '2026-07-16 08:09:03', '2026-07-16 08:09:03'),
(12, 'John Doe', 'student-6a5da8ec93e22@example.com', NULL, 'ST12345', '$2y$04$KrkWc8Jb0XEkVPC5wrOSzuxqiXjiiKY./aNlgWLos6vCQ5dRHQ4qy', NULL, 'student', '2026-07-20 04:49:48', '2026-07-20 04:49:48'),
(13, 'Raveesha Heshani', 'raveeshaheshani@gmail.com', NULL, 'ANU/IT/2324/F/017', '$2y$10$y6W5sy7GGDp5sOzmppRf0e6bNUlAaiRqPMWt2N9CgIeGd92T.andq', NULL, 'student', '2026-07-20 04:51:10', '2026-07-20 04:51:10'),
(14, 'John Doe', 'student-6a5da98d32092@example.com', NULL, 'ST12345', '$2y$04$xSEtaR0GLHRXB1RmcipzTuTS.m79kIJ5UrhHs9RvDrbKLihWFYHES', NULL, 'student', '2026-07-20 04:52:29', '2026-07-20 04:52:29'),
(15, 'Gihan Chamika', 'gihan123@gmail.com', NULL, 'ANU/IT/2324/F/019', '$2y$10$kFgpI9OY9taTxmJTlPMzCu1pstT6C/dttf.vbyDrG.CCeJ30k8742', NULL, 'student', '2026-07-20 04:55:15', '2026-07-20 04:55:15'),
(16, 'Sample User', 'student-6a5dab4500bea@example.com', NULL, 'ST12345', '$2y$04$MRTCtTgrCmFs.GskPpWzaO98e0a2H0j5K5YJtiSohP6Bmz3jcImXG', NULL, 'student', '2026-07-20 04:59:49', '2026-07-20 04:59:49'),
(17, 'Sample User', 'student-6a5dabb1e66e5@example.com', NULL, 'ST12345', '$2y$04$Q37VP7PdUa1icUzDf3ZAquGpxuwBwyk82fMXfLvBKBI.DIaxLs5B2', NULL, 'student', '2026-07-20 05:01:37', '2026-07-20 05:01:37'),
(18, 'Imasha Kavishvari', 'imasha@gmail.com', NULL, 'ANU/IT/2324/F/089', '$2y$10$wksTGiaJFhZppWx7bkCV9OcwNftgLNYHktc5gyE8dJ4pdgJvsZOmq', NULL, 'student', '2026-07-20 05:35:33', '2026-07-20 05:35:33'),
(19, 'Sample User', 'student-6a5db40f64ca9@example.com', NULL, 'ST12345', '$2y$04$KMuab/wCT8KoVSVmmoaX7OAr8ajINO43X/qkQW0AnAqr2rc5OBvJ6', NULL, 'student', '2026-07-20 05:37:19', '2026-07-20 05:37:19'),
(20, 'Test Student', 'student-6a5db45d71e35@example.com', NULL, 'ST12345', '$2y$04$Clxfx0zkXPCp5Bro.MjV5umF4d6D9cskk7Rb3.cPR6Ug26gz3LYLm', NULL, 'student', '2026-07-20 05:38:37', '2026-07-20 05:38:37'),
(21, 'Maleesha Nadiranga', 'malesha@gmail.com', NULL, 'ANU/IT/2324/F/090', '$2y$10$5GbwkZ51x8ZlwKd6zMnDwes/cyQ4eFRo4snSpDHuMAT2OBJxpua0m', NULL, 'student', '2026-07-20 05:41:09', '2026-07-20 05:41:09'),
(22, 'nimal kumara', 'nimal12@gmail.com', NULL, 'ANU/IT/2324/F/054', '$2y$10$.gQj8Rli.LHvf0rHL14qB.zfS/3Mn5rYg/F0fhfoN4Z6JQ3.6vAsa', NULL, 'student', '2026-07-20 06:37:44', '2026-07-20 06:37:44'),
(23, 'Gihan Nimantha', 'gihan@gimail.com', NULL, 'ANU/IT/2324/F/013', '$2y$10$Qmzh3fMoUHZVy8qX/hD2/e.APM4dpfX3jZGfbS5Duy4hYsE7OYj/6', NULL, 'student', '2026-07-20 06:41:23', '2026-07-20 06:41:23'),
(24, 'Nimshan Dulantha', 'nimsandd@gmail.com', NULL, '003', '$2y$10$BU7S.hZbo/QeJEz9UsPZguV1MliZW7TiwT82wLSHZSKHhxgzF7vtm', NULL, 'student', '2026-07-21 08:18:22', '2026-07-21 08:18:22');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_profiles`
--

CREATE TABLE `user_profiles` (
  `profile_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vark_scores`
--

CREATE TABLE `vark_scores` (
  `score_id` int(11) NOT NULL,
  `result_id` int(11) NOT NULL,
  `visual_pct` float DEFAULT 0,
  `auditory_pct` float DEFAULT 0,
  `read_write_pct` float DEFAULT 0,
  `kinesthetic_pct` float DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vark_scores`
--

INSERT INTO `vark_scores` (`score_id`, `result_id`, `visual_pct`, `auditory_pct`, `read_write_pct`, `kinesthetic_pct`) VALUES
(1, 1, 0, 0, 0, 100),
(2, 2, 0, 0, 0, 110),
(3, 3, 0, 0, 0, 120),
(4, 4, 60, 20, 10, 10),
(5, 5, 30, 20, 30, 20),
(6, 6, 40, 30, 30, 0),
(7, 7, 0, 50, 30, 20),
(8, 8, 20, 80, 0, 0),
(9, 9, 10, 60, 30, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `content`
--
ALTER TABLE `content`
  ADD PRIMARY KEY (`content_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedback_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `content_id` (`content_id`),
  ADD KEY `result_id` (`result_id`);

--
-- Indexes for table `lecturers`
--
ALTER TABLE `lecturers`
  ADD PRIMARY KEY (`lecturer_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `lectures`
--
ALTER TABLE `lectures`
  ADD PRIMARY KEY (`lecture_id`),
  ADD KEY `lecturer_id` (`lecturer_id`);

--
-- Indexes for table `lecture_assignments`
--
ALTER TABLE `lecture_assignments`
  ADD PRIMARY KEY (`assignment_id`),
  ADD KEY `lecture_id` (`lecture_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `progress_reports`
--
ALTER TABLE `progress_reports`
  ADD PRIMARY KEY (`report_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`question_id`),
  ADD KEY `quiz_id` (`quiz_id`);

--
-- Indexes for table `quizzes`
--
ALTER TABLE `quizzes`
  ADD PRIMARY KEY (`quiz_id`);

--
-- Indexes for table `quiz_answers`
--
ALTER TABLE `quiz_answers`
  ADD PRIMARY KEY (`answer_id`),
  ADD KEY `attempt_id` (`attempt_id`),
  ADD KEY `question_id` (`question_id`);

--
-- Indexes for table `quiz_attempts`
--
ALTER TABLE `quiz_attempts`
  ADD PRIMARY KEY (`attempt_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `quiz_id` (`quiz_id`);

--
-- Indexes for table `quiz_results`
--
ALTER TABLE `quiz_results`
  ADD PRIMARY KEY (`result_id`),
  ADD KEY `attempt_id` (`attempt_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `recommendations`
--
ALTER TABLE `recommendations`
  ADD PRIMARY KEY (`rec_id`),
  ADD KEY `result_id` (`result_id`);

--
-- Indexes for table `rec_content`
--
ALTER TABLE `rec_content`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rec_id` (`rec_id`),
  ADD KEY `content_id` (`content_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_profiles`
--
ALTER TABLE `user_profiles`
  ADD PRIMARY KEY (`profile_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `vark_scores`
--
ALTER TABLE `vark_scores`
  ADD PRIMARY KEY (`score_id`),
  ADD KEY `result_id` (`result_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `content`
--
ALTER TABLE `content`
  MODIFY `content_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `lecturers`
--
ALTER TABLE `lecturers`
  MODIFY `lecturer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `lectures`
--
ALTER TABLE `lectures`
  MODIFY `lecture_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `lecture_assignments`
--
ALTER TABLE `lecture_assignments`
  MODIFY `assignment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `progress_reports`
--
ALTER TABLE `progress_reports`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quizzes`
--
ALTER TABLE `quizzes`
  MODIFY `quiz_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `quiz_answers`
--
ALTER TABLE `quiz_answers`
  MODIFY `answer_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quiz_attempts`
--
ALTER TABLE `quiz_attempts`
  MODIFY `attempt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `quiz_results`
--
ALTER TABLE `quiz_results`
  MODIFY `result_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `recommendations`
--
ALTER TABLE `recommendations`
  MODIFY `rec_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `rec_content`
--
ALTER TABLE `rec_content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_profiles`
--
ALTER TABLE `user_profiles`
  MODIFY `profile_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vark_scores`
--
ALTER TABLE `vark_scores`
  MODIFY `score_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `feedback_ibfk_2` FOREIGN KEY (`content_id`) REFERENCES `content` (`content_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `feedback_ibfk_3` FOREIGN KEY (`result_id`) REFERENCES `quiz_results` (`result_id`) ON DELETE SET NULL;

--
-- Constraints for table `lectures`
--
ALTER TABLE `lectures`
  ADD CONSTRAINT `lectures_ibfk_1` FOREIGN KEY (`lecturer_id`) REFERENCES `lecturers` (`lecturer_id`) ON DELETE SET NULL;

--
-- Constraints for table `lecture_assignments`
--
ALTER TABLE `lecture_assignments`
  ADD CONSTRAINT `lecture_assignments_ibfk_1` FOREIGN KEY (`lecture_id`) REFERENCES `lectures` (`lecture_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `lecture_assignments_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`) ON DELETE CASCADE;

--
-- Constraints for table `progress_reports`
--
ALTER TABLE `progress_reports`
  ADD CONSTRAINT `progress_reports_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`) ON DELETE CASCADE;

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`quiz_id`) ON DELETE CASCADE;

--
-- Constraints for table `quiz_answers`
--
ALTER TABLE `quiz_answers`
  ADD CONSTRAINT `quiz_answers_ibfk_1` FOREIGN KEY (`attempt_id`) REFERENCES `quiz_attempts` (`attempt_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `quiz_answers_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `questions` (`question_id`) ON DELETE CASCADE;

--
-- Constraints for table `quiz_attempts`
--
ALTER TABLE `quiz_attempts`
  ADD CONSTRAINT `quiz_attempts_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `quiz_attempts_ibfk_2` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`quiz_id`) ON DELETE CASCADE;

--
-- Constraints for table `quiz_results`
--
ALTER TABLE `quiz_results`
  ADD CONSTRAINT `quiz_results_ibfk_1` FOREIGN KEY (`attempt_id`) REFERENCES `quiz_attempts` (`attempt_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `quiz_results_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`) ON DELETE CASCADE;

--
-- Constraints for table `recommendations`
--
ALTER TABLE `recommendations`
  ADD CONSTRAINT `recommendations_ibfk_1` FOREIGN KEY (`result_id`) REFERENCES `quiz_results` (`result_id`) ON DELETE CASCADE;

--
-- Constraints for table `rec_content`
--
ALTER TABLE `rec_content`
  ADD CONSTRAINT `rec_content_ibfk_1` FOREIGN KEY (`rec_id`) REFERENCES `recommendations` (`rec_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `rec_content_ibfk_2` FOREIGN KEY (`content_id`) REFERENCES `content` (`content_id`) ON DELETE CASCADE;

--
-- Constraints for table `user_profiles`
--
ALTER TABLE `user_profiles`
  ADD CONSTRAINT `user_profiles_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`) ON DELETE CASCADE;

--
-- Constraints for table `vark_scores`
--
ALTER TABLE `vark_scores`
  ADD CONSTRAINT `vark_scores_ibfk_1` FOREIGN KEY (`result_id`) REFERENCES `quiz_results` (`result_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
