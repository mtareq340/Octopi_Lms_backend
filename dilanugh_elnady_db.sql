-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 11, 2024 at 07:49 PM
-- Server version: 10.6.18-MariaDB-cll-lve
-- PHP Version: 8.1.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dilanugh_elnady_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `academic_courses`
--

CREATE TABLE `academic_courses` (
  `id` int(11) NOT NULL,
  `name` varchar(191) NOT NULL,
  `code` varchar(100) NOT NULL,
  `credit_hour` int(11) NOT NULL,
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `academic_courses`
--

INSERT INTO `academic_courses` (`id`, `name`, `code`, `credit_hour`, `updated_at`, `created_at`) VALUES
(1, 'مبادئ القانون', 'SUB-M1', 3, '2024-08-11 12:15:39', '2024-08-11 12:15:39'),
(2, 'المحاسبة المالية', 'SUB-M2', 3, '2024-08-11 12:16:05', '2024-08-11 12:16:05'),
(3, 'تكنولوجيا المعلومات', 'SUB-M3', 3, '2024-08-11 19:08:53', '2024-08-11 12:16:27');

-- --------------------------------------------------------

--
-- Table structure for table `academic_student_register_courses`
--

CREATE TABLE `academic_student_register_courses` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `level_id` int(11) NOT NULL,
  `division_id` int(11) NOT NULL,
  `academic_year_id` int(11) NOT NULL,
  `academic_term_id` int(11) NOT NULL,
  `mid_degree` float DEFAULT NULL,
  `work_year_degree` float DEFAULT NULL,
  `amly_degree` float DEFAULT NULL,
  `final_degree` float DEFAULT NULL,
  `total_degree` float DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `academic_terms`
--

CREATE TABLE `academic_terms` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `academic_year_id` int(11) NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `active` int(11) NOT NULL DEFAULT 0,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `academic_terms`
--

INSERT INTO `academic_terms` (`id`, `name`, `academic_year_id`, `start_date`, `end_date`, `active`, `updated_at`, `created_at`) VALUES
(1, 'الفصل الدراسي الاول', 1, '2023-06-02', '2023-06-02', 1, '2023-06-02 15:08:34', '2023-06-02 15:08:34');

-- --------------------------------------------------------

--
-- Table structure for table `academic_years`
--

CREATE TABLE `academic_years` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `start_date` date NOT NULL DEFAULT current_timestamp(),
  `end_date` date DEFAULT NULL,
  `active` int(11) NOT NULL DEFAULT 0,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `academic_years`
--

INSERT INTO `academic_years` (`id`, `name`, `start_date`, `end_date`, `active`, `updated_at`, `created_at`) VALUES
(1, '2022/2023', '2023-06-02', '2023-06-02', 1, '2023-06-02 15:08:34', '2023-06-02 15:08:34');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `updated_at`, `created_at`) VALUES
(1, 'student', '2023-06-02 15:08:33', '2023-06-02 15:08:33'),
(2, 'doctor', '2023-06-02 15:08:33', '2023-06-02 15:08:33'),
(3, 'employee', '2023-06-02 15:08:33', '2023-06-02 15:08:33');

-- --------------------------------------------------------

--
-- Table structure for table `divisions`
--

CREATE TABLE `divisions` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `divisions`
--

INSERT INTO `divisions` (`id`, `name`, `updated_at`, `created_at`) VALUES
(1, 'أولي عام', '2023-08-01 05:30:31', '2023-08-01 05:30:31'),
(2, 'تانيه عام', '2023-08-01 05:30:46', '2023-08-01 05:30:46'),
(3, 'تالته عام', '2023-08-01 05:30:55', '2023-08-01 05:30:55');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `user_id`, `name`, `phone`, `updated_at`, `created_at`) VALUES
(1, 1, 'admin', '01274939232', '2023-08-12 18:26:49', '2023-08-12 18:26:49');

-- --------------------------------------------------------

--
-- Table structure for table `levels`
--

CREATE TABLE `levels` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `levels`
--

INSERT INTO `levels` (`id`, `name`, `updated_at`, `created_at`) VALUES
(1, 'المستوي الأول', '2023-06-02 15:08:33', '2023-06-02 15:08:33'),
(2, 'المستوي الثاني', '2023-06-02 15:08:33', '2023-06-02 15:08:33'),
(3, 'المستوي الثالث', '2023-06-02 15:08:33', '2023-06-02 15:08:33'),
(4, 'المستوي الرابع ', '2023-06-02 15:08:33', '2023-06-02 15:08:33'),
(5, 'الخريجين', '2023-06-02 15:08:33', '2023-06-02 15:08:33');

-- --------------------------------------------------------

--
-- Table structure for table `main_settings`
--

CREATE TABLE `main_settings` (
  `id` int(11) NOT NULL,
  `academic_year_id` int(11) NOT NULL,
  `academic_term_id` int(11) NOT NULL,
  `notes` varchar(250) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `display_name` varchar(100) DEFAULT NULL,
  `model_id` int(11) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `display_name`, `model_id`, `updated_at`, `created_at`) VALUES
(1, 'QualityList', NULL, NULL, '2023-06-02 15:08:33', '2023-06-02 15:08:33'),
(2, 'FacultyMembers', NULL, NULL, '2023-06-02 15:08:33', '2023-06-02 15:08:33'),
(3, 'Academic', NULL, NULL, '2023-06-02 15:08:33', '2023-06-02 15:08:33'),
(20, 'add_courses', NULL, 3, '2023-06-02 15:08:33', '2023-06-02 15:08:33'),
(21, 'delete_courses', NULL, 3, '2023-06-02 15:08:33', '2023-06-02 15:08:33'),
(22, 'update_courses', NULL, 3, '2023-06-02 15:08:33', '2023-06-02 15:08:33'),
(23, 'print_courses', NULL, 3, '2023-06-02 15:08:33', '2023-06-02 15:08:33'),
(29, 'show_students', NULL, 1, '2023-06-02 15:08:33', '2023-06-02 15:08:33'),
(30, 'add_students', NULL, 1, '2023-06-02 15:08:33', '2023-06-02 15:08:33'),
(31, 'delete_students', NULL, 1, '2023-06-02 15:08:33', '2023-06-02 15:08:33'),
(32, 'update_students', NULL, 1, '2023-06-02 15:08:33', '2023-06-02 15:08:33'),
(33, 'print_students', NULL, 1, '2023-06-02 15:08:33', '2023-06-02 15:08:33'),
(34, 'add_student', NULL, 1, '2023-06-02 15:08:33', '2023-06-02 15:08:33'),
(35, 'show_student', NULL, 1, '2023-06-02 15:08:33', '2023-06-02 15:08:33'),
(36, 'delete_student', NULL, 1, '2023-06-02 15:08:33', '2023-06-02 15:08:33'),
(37, 'update_student', NULL, 1, '2023-06-02 15:08:33', '2023-06-02 15:08:33'),
(38, 'print_student', NULL, 1, '2023-06-02 15:08:33', '2023-06-02 15:08:33'),
(39, 'Student', NULL, NULL, '2023-06-02 15:08:33', '2023-06-02 15:08:33'),
(64, 'print_studentsRegisterCourses', NULL, 2, '2023-06-02 15:08:33', '2023-06-02 15:08:33'),
(65, 'update_studentsRegisterCourses', NULL, 2, '2023-06-02 15:08:33', '2023-06-02 15:08:33'),
(66, 'delete_studentsRegisterCourses', NULL, 2, '2023-06-02 15:08:33', '2023-06-02 15:08:33'),
(67, 'add_studentsRegisterCourses', NULL, 2, '2023-06-02 15:08:33', '2023-06-02 15:08:33'),
(68, 'show_studentsRegisterCourses', NULL, 2, '2023-06-02 15:08:33', '2023-06-02 15:08:33'),
(72, 'print_facultyMemberStudents', NULL, 2, '2023-06-02 15:08:33', '2023-06-02 15:08:33'),
(75, 'show_studentCourses', NULL, 1, '2023-06-02 15:08:33', '2023-06-02 15:08:33'),
(76, 'print_studentCourses', NULL, 1, '2023-06-02 15:08:33', '2023-06-02 15:08:33'),
(88, 'student_affairs', NULL, NULL, '2023-06-02 15:08:33', '2023-06-02 15:08:33'),
(91, 'Employee', NULL, NULL, '2023-06-02 15:08:33', '2023-06-02 15:08:33'),
(99, 'ProfileSetting', NULL, NULL, '2023-06-02 15:08:33', '2023-06-02 15:08:33'),
(101, 'MainSetting', NULL, NULL, '2023-06-02 15:08:33', '2023-06-02 15:08:33'),
(109, 'show_removeStudentsRegisterCourses', NULL, 7, '2023-06-02 15:08:33', '2023-06-02 15:08:33'),
(121, 'show_studentsResults', NULL, 8, '2023-06-02 15:08:33', '2023-06-02 15:08:33'),
(122, 'print_studentsResults', NULL, 8, '2023-06-02 15:08:33', '2023-06-02 15:08:33'),
(123, 'update_studentsResults', NULL, 8, '2023-06-02 15:08:33', '2023-06-02 15:08:33'),
(124, 'add_studentsResults', NULL, 8, '2023-06-02 15:08:33', '2023-06-02 15:08:33'),
(125, 'Result', NULL, NULL, '2023-06-02 15:08:33', '2023-06-02 15:08:33'),
(135, 'export_students', NULL, 1, '2023-06-02 15:08:33', '2023-06-02 15:08:33'),
(136, 'active_students', NULL, 1, '2023-06-02 15:08:33', '2023-06-02 15:08:33'),
(137, 'export_studentsResults', NULL, 1, '2023-06-02 15:08:33', '2023-06-02 15:08:33'),
(144, 'print_studentResults', NULL, 1, '2023-06-02 15:08:33', '2023-06-02 15:08:33'),
(145, 'show_studentResults', NULL, 1, '2023-06-02 15:08:33', '2023-06-02 15:08:33'),
(207, 'show_courses', NULL, 3, '2023-06-02 15:08:33', '2023-06-02 15:08:33');

-- --------------------------------------------------------

--
-- Table structure for table `permission_groups`
--

CREATE TABLE `permission_groups` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `display_name` varchar(191) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `permission_groups`
--

INSERT INTO `permission_groups` (`id`, `name`, `display_name`, `updated_at`, `created_at`) VALUES
(1, 'شئون الطلاب', NULL, '2023-06-02 15:08:33', '2023-06-02 15:08:33'),
(2, 'الأرشاد الأكاديمي', NULL, '2023-06-02 15:08:33', '2023-06-02 15:08:33'),
(3, 'الويب سايت', NULL, '2023-06-02 15:08:33', '2023-06-02 15:08:33'),
(4, 'اعضاء هيئة التدريس', NULL, '2023-06-02 15:08:33', '2023-06-02 15:08:33'),
(5, 'الموظفين', NULL, '2023-06-02 15:08:33', '2023-06-02 15:08:33'),
(6, 'إعدادات النظام', NULL, '2023-06-02 15:08:33', '2023-06-02 15:08:33'),
(7, 'النتائج', NULL, '2023-06-02 15:08:33', '2023-06-02 15:08:33'),
(8, 'اللوائح', 'Regulations', '2023-06-02 15:08:33', '2023-06-02 15:08:33'),
(9, 'نظام الإمتحانات', 'Exam', '2023-06-02 15:08:33', '2023-06-02 15:08:33');

-- --------------------------------------------------------

--
-- Table structure for table `permission_models`
--

CREATE TABLE `permission_models` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `display_name` varchar(191) NOT NULL,
  `group_id` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `permission_models`
--

INSERT INTO `permission_models` (`id`, `name`, `display_name`, `group_id`, `updated_at`, `created_at`) VALUES
(1, 'الطلاب', 'students', 1, '2023-06-02 15:08:33', '2023-06-02 15:08:33'),
(2, 'أعضاء هيئة التدريس', 'doctors', 4, '2023-06-02 15:08:33', '2023-06-02 15:08:33'),
(3, 'المواد الدراسية', 'courses', 1, '2023-06-02 15:08:33', '2023-06-02 15:08:33'),
(4, 'الأخبار', 'courses', 3, '2023-06-02 15:08:33', '2023-06-02 15:08:33'),
(5, 'الصفحات', 'pages', 3, '2023-06-02 15:08:33', '2023-06-02 15:08:33'),
(6, 'الموظفين', 'pages', 5, '2023-06-02 15:08:33', '2023-06-02 15:08:33'),
(7, 'إعدادات النظام', 'MainSetting', 6, '2023-06-02 15:08:33', '2023-06-02 15:08:33'),
(8, 'النتائج', 'Result', 7, '2023-06-02 15:08:33', '2023-06-02 15:08:33'),
(9, 'اللوائح', 'Regulations', 8, '2023-06-02 15:08:33', '2023-06-02 15:08:33'),
(10, 'نظام الإمتحانات', 'Exam', 9, '2023-06-02 15:08:33', '2023-06-02 15:08:33');

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`, `updated_at`, `created_at`) VALUES
(1, 1, 1, '2023-06-02 15:08:33', '2023-06-02 15:08:33'),
(2, 2, 1, '2023-06-02 15:08:33', '2023-06-02 15:08:33'),
(3, 3, 1, '2023-06-02 15:08:33', '2023-06-02 15:08:33'),
(4, 4, 1, '2023-06-02 15:08:33', '2023-06-02 15:08:33'),
(5, 5, 1, '2023-06-02 15:08:33', '2023-06-02 15:08:33'),
(6, 6, 1, '2023-06-02 15:08:34', '2023-06-02 15:08:34'),
(7, 7, 1, '2023-06-02 15:08:34', '2023-06-02 15:08:34'),
(8, 8, 1, '2023-06-02 15:08:34', '2023-06-02 15:08:34'),
(9, 9, 1, '2023-06-02 15:08:34', '2023-06-02 15:08:34'),
(10, 10, 1, '2023-06-02 15:08:34', '2023-06-02 15:08:34'),
(11, 11, 1, '2023-06-02 15:08:34', '2023-06-02 15:08:34'),
(12, 12, 1, '2023-06-02 15:08:34', '2023-06-02 15:08:34'),
(13, 13, 1, '2023-06-02 15:08:34', '2023-06-02 15:08:34'),
(14, 14, 1, '2023-06-02 15:08:34', '2023-06-02 15:08:34'),
(15, 15, 1, '2023-06-02 15:08:34', '2023-06-02 15:08:34'),
(16, 16, 1, '2023-06-02 15:08:34', '2023-06-02 15:08:34'),
(17, 17, 1, '2023-06-02 15:08:34', '2023-06-02 15:08:34'),
(18, 18, 1, '2023-06-02 15:08:34', '2023-06-02 15:08:34'),
(19, 19, 1, '2023-06-02 15:08:34', '2023-06-02 15:08:34'),
(20, 20, 1, '2023-06-02 15:08:34', '2023-06-02 15:08:34'),
(21, 21, 1, '2023-06-02 15:08:34', '2023-06-02 15:08:34'),
(22, 22, 1, '2023-06-02 15:08:34', '2023-06-02 15:08:34'),
(23, 23, 1, '2023-06-02 15:08:34', '2023-06-02 15:08:34'),
(24, 24, 1, '2023-06-02 15:08:34', '2023-06-02 15:08:34'),
(25, 25, 1, '2023-06-02 15:08:34', '2023-06-02 15:08:34'),
(26, 26, 1, '2023-06-02 15:08:34', '2023-06-02 15:08:34'),
(27, 27, 1, '2023-06-02 15:08:34', '2023-06-02 15:08:34'),
(28, 28, 1, '2023-06-02 15:08:34', '2023-06-02 15:08:34'),
(29, 29, 1, '2023-06-02 15:08:34', '2023-06-02 15:08:34'),
(30, 30, 1, '2023-06-02 15:08:34', '2023-06-02 15:08:34'),
(31, 31, 1, '2023-06-02 15:08:34', '2023-06-02 15:08:34'),
(32, 32, 1, '2023-06-02 15:08:34', '2023-06-02 15:08:34'),
(33, 33, 1, '2023-06-02 15:08:34', '2023-06-02 15:08:34'),
(34, 39, 1, '2023-06-02 15:08:34', '2023-06-02 15:08:34'),
(65, 64, 1, '2023-06-02 15:08:34', '2023-06-02 15:08:34'),
(66, 65, 1, '2023-06-02 15:08:34', '2023-06-02 15:08:34'),
(67, 66, 1, '2023-06-02 15:08:34', '2023-06-02 15:08:34'),
(68, 67, 1, '2023-06-02 15:08:34', '2023-06-02 15:08:34'),
(69, 68, 1, '2023-06-02 15:08:34', '2023-06-02 15:08:34'),
(88, 87, 1, '2023-06-02 15:08:34', '2023-06-02 15:08:34'),
(89, 88, 1, '2023-06-02 15:08:34', '2023-06-02 15:08:34'),
(90, 89, 1, '2023-06-02 15:08:34', '2023-06-02 15:08:34'),
(91, 90, 1, '2023-06-02 15:08:34', '2023-06-02 15:08:34'),
(92, 91, 1, '2023-06-02 15:08:34', '2023-06-02 15:08:34'),
(93, 92, 1, '2023-06-02 15:08:34', '2023-06-02 15:08:34'),
(98, 97, 1, '2023-06-02 15:08:34', '2023-06-02 15:08:34'),
(99, 98, 1, '2023-06-02 15:08:34', '2023-06-02 15:08:34'),
(108, 99, 1, '2023-06-02 15:08:34', '2023-06-02 15:08:34'),
(110, 101, 1, '2023-06-02 15:08:34', '2023-06-02 15:08:34'),
(111, 102, 1, '2023-06-02 15:08:34', '2023-06-02 15:08:34'),
(112, 103, 1, '2023-06-02 15:08:34', '2023-06-02 15:08:34'),
(116, 104, 1, '2023-06-02 15:08:34', '2023-06-02 15:08:34'),
(117, 105, 1, '2023-06-02 15:08:34', '2023-06-02 15:08:34'),
(118, 106, 1, '2023-06-02 15:08:34', '2023-06-02 15:08:34'),
(119, 107, 1, '2023-06-02 15:08:34', '2023-06-02 15:08:34'),
(120, 108, 1, '2023-06-02 15:08:34', '2023-06-02 15:08:34'),
(122, 109, 1, '2023-06-02 15:08:34', '2023-06-02 15:08:34'),
(123, 110, 1, '2023-06-02 15:08:34', '2023-06-02 15:08:34'),
(136, 121, 1, '2023-06-02 15:08:34', '2023-06-02 15:08:34'),
(137, 122, 1, '2023-06-02 15:08:34', '2023-06-02 15:08:34'),
(138, 123, 1, '2023-06-02 15:08:34', '2023-06-02 15:08:34'),
(139, 124, 1, '2023-06-02 15:08:34', '2023-06-02 15:08:34'),
(141, 125, 1, '2023-06-02 15:08:34', '2023-06-02 15:08:34'),
(142, 126, 1, '2023-06-02 15:08:34', '2023-06-02 15:08:34'),
(143, 127, 1, '2023-06-02 15:08:34', '2023-06-02 15:08:34'),
(144, 128, 1, '2023-06-02 15:08:34', '2023-06-02 15:08:34'),
(145, 129, 1, '2023-06-02 15:08:34', '2023-06-02 15:08:34'),
(147, 130, 1, '2023-06-02 15:08:34', '2023-06-02 15:08:34'),
(148, 131, 1, '2023-06-02 15:08:34', '2023-06-02 15:08:34'),
(149, 132, 1, '2023-06-02 15:08:34', '2023-06-02 15:08:34'),
(150, 133, 1, '2023-06-02 15:08:34', '2023-06-02 15:08:34'),
(151, 134, 1, '2023-06-02 15:08:34', '2023-06-02 15:08:34'),
(152, 135, 1, '2023-06-02 15:08:34', '2023-06-02 15:08:34'),
(153, 136, 1, '2023-06-02 15:08:34', '2023-06-02 15:08:34'),
(154, 137, 1, '2023-06-02 15:08:34', '2023-06-02 15:08:34'),
(155, 138, 1, '2023-06-02 15:08:34', '2023-06-02 15:08:34'),
(178, 158, 1, '2023-06-02 15:08:34', '2023-06-02 15:08:34'),
(179, 159, 1, '2023-06-02 15:08:34', '2023-06-02 15:08:34'),
(180, 160, 1, '2023-06-02 15:08:34', '2023-06-02 15:08:34'),
(208, 161, 1, '2023-06-02 15:08:33', '2023-06-02 15:08:33'),
(209, 162, 1, '2023-06-02 15:08:33', '2023-06-02 15:08:33'),
(210, 163, 1, '2023-06-02 15:08:33', '2023-06-02 15:08:33'),
(211, 164, 1, '2023-06-02 15:08:33', '2023-06-02 15:08:33'),
(212, 165, 1, '2023-06-02 15:08:33', '2023-06-02 15:08:33'),
(221, 168, 1, '2023-06-02 15:08:33', '2023-06-02 15:08:33'),
(222, 169, 1, '2023-06-02 15:08:33', '2023-06-02 15:08:33'),
(223, 170, 1, '2023-06-02 15:08:33', '2023-06-02 15:08:33'),
(224, 171, 1, '2023-06-02 15:08:33', '2023-06-02 15:08:33'),
(225, 172, 1, '2023-06-02 15:08:33', '2023-06-02 15:08:33'),
(226, 173, 1, '2023-06-02 15:08:33', '2023-06-02 15:08:33'),
(227, 174, 1, '2023-06-02 15:08:33', '2023-06-02 15:08:33'),
(228, 175, 1, '2023-06-02 15:08:33', '2023-06-02 15:08:33'),
(229, 176, 1, '2023-06-02 15:08:33', '2023-06-02 15:08:33'),
(230, 177, 1, '2023-06-02 15:08:33', '2023-06-02 15:08:33'),
(231, 178, 1, '2023-06-02 15:08:33', '2023-06-02 15:08:33'),
(232, 179, 1, '2023-06-02 15:08:33', '2023-06-02 15:08:33'),
(233, 180, 1, '2023-06-02 15:08:33', '2023-06-02 15:08:33'),
(235, 181, 1, '2023-06-02 15:08:33', '2023-06-02 15:08:33'),
(236, 182, 1, '2023-06-02 15:08:33', '2023-06-02 15:08:33'),
(237, 183, 1, '2023-06-02 15:08:33', '2023-06-02 15:08:33'),
(238, 184, 1, '2023-06-02 15:08:33', '2023-06-02 15:08:33'),
(239, 185, 1, '2023-06-02 15:08:33', '2023-06-02 15:08:33'),
(241, 186, 1, '2023-06-02 15:08:33', '2023-06-02 15:08:33'),
(242, 187, 1, '2023-06-02 15:08:33', '2023-06-02 15:08:33'),
(243, 188, 1, '2023-06-02 15:08:33', '2023-06-02 15:08:33'),
(244, 189, 1, '2023-06-02 15:08:33', '2023-06-02 15:08:33'),
(245, 190, 1, '2023-06-02 15:08:33', '2023-06-02 15:08:33'),
(247, 191, 1, '2023-06-02 15:08:33', '2023-06-02 15:08:33'),
(248, 192, 1, '2023-06-02 15:08:33', '2023-06-02 15:08:33'),
(249, 193, 1, '2023-06-02 15:08:33', '2023-06-02 15:08:33'),
(250, 194, 1, '2023-06-02 15:08:33', '2023-06-02 15:08:33'),
(251, 195, 1, '2023-06-02 15:08:33', '2023-06-02 15:08:33'),
(253, 196, 1, '2023-06-02 15:08:33', '2023-06-02 15:08:33'),
(254, 197, 1, '2023-06-02 15:08:33', '2023-06-02 15:08:33'),
(255, 198, 1, '2023-06-02 15:08:33', '2023-06-02 15:08:33'),
(256, 199, 1, '2023-06-02 15:08:33', '2023-06-02 15:08:33'),
(257, 200, 1, '2023-06-02 15:08:33', '2023-06-02 15:08:33'),
(259, 201, 1, '2023-06-02 15:08:33', '2023-06-02 15:08:33'),
(260, 202, 1, '2023-06-02 15:08:33', '2023-06-02 15:08:33'),
(261, 203, 1, '2023-06-02 15:08:33', '2023-06-02 15:08:33'),
(262, 204, 1, '2023-06-02 15:08:33', '2023-06-02 15:08:33'),
(263, 205, 1, '2023-06-02 15:08:33', '2023-06-02 15:08:33'),
(267, 207, 1, '2023-06-02 15:08:33', '2023-06-02 15:08:33');

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
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `display_name` varchar(191) NOT NULL,
  `description` varchar(191) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `updated_at`, `created_at`) VALUES
(1, 'مسـئـول', 'Super Admin', 'Super Admin', '2023-06-02 15:08:33', '2023-06-02 15:08:33'),
(2, 'عضو هيئة تدريس', 'Doctor', 'Doctor', '2023-06-02 15:08:33', '2023-06-02 15:08:33'),
(3, 'طـالـب', 'Student', 'Student', '2023-06-02 15:08:33', '2023-06-02 15:08:33');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` char(100) NOT NULL,
  `code` char(100) NOT NULL DEFAULT '1',
  `division_id` int(11) NOT NULL DEFAULT 1,
  `level_id` int(11) NOT NULL DEFAULT 1,
  `national_id` char(100) NOT NULL DEFAULT '1',
  `phone` char(30) DEFAULT NULL,
  `email` char(100) DEFAULT NULL,
  `birthdate` date NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `terms`
--

CREATE TABLE `terms` (
  `id` int(11) NOT NULL,
  `name` char(100) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `terms`
--

INSERT INTO `terms` (`id`, `name`, `updated_at`, `created_at`) VALUES
(1, 'ترم اول', '2023-06-10 17:42:21', '2023-06-10 17:42:21');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` char(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(100) NOT NULL,
  `api_token` varchar(500) DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `password`, `api_token`, `category_id`, `role_id`, `active`, `updated_at`, `created_at`) VALUES
(1, 'admin', 'admin@admin.com', 'admin@admin.com', '$2y$10$vynmuEGPxZG7F62ct1Nv0ubzoaIUBRe.2l4B/CROqaBsi4HFoNMWW', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczovL2xtcy5kaWxhcmFzdG9yZS5uZXQvQmFja0VuZC9hcGkvYXV0aC9sb2dpbiIsImlhdCI6MTcyMzQxOTY4MiwiZXhwIjoxNzIzNDIzMjgyLCJuYmYiOjE3MjM0MTk2ODIsImp0aSI6IkpXTHU4THZwdXJGS0NROW0iLCJzdWIiOiIxIiwicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.J6MyPhj90iApp1RHZ-Mz9SR628V8KceqTTwCa7Gszek', 3, 1, 1, '2024-08-12 06:41:22', '2023-05-10 20:52:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academic_courses`
--
ALTER TABLE `academic_courses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `academic_student_register_courses`
--
ALTER TABLE `academic_student_register_courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `academic_student_register_courses_ibfk_1` (`academic_term_id`),
  ADD KEY `academic_year_id` (`academic_year_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `division_id` (`division_id`),
  ADD KEY `level_id` (`level_id`);

--
-- Indexes for table `academic_terms`
--
ALTER TABLE `academic_terms`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `terms_academic_years` (`academic_year_id`);

--
-- Indexes for table `academic_years`
--
ALTER TABLE `academic_years`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `divisions`
--
ALTER TABLE `divisions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`),
  ADD KEY `employees_users` (`user_id`);

--
-- Indexes for table `levels`
--
ALTER TABLE `levels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `main_settings`
--
ALTER TABLE `main_settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `academic_term_id` (`academic_term_id`),
  ADD KEY `academic_year_id` (`academic_year_id`);

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
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `permissions_models` (`model_id`);

--
-- Indexes for table `permission_groups`
--
ALTER TABLE `permission_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `permission_models`
--
ALTER TABLE `permission_models`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `models_groups` (`group_id`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permissions` (`permission_id`),
  ADD KEY `roles` (`role_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `code` (`code`),
  ADD UNIQUE KEY `national_id` (`national_id`),
  ADD UNIQUE KEY `user_id` (`user_id`),
  ADD KEY `students_users` (`user_id`),
  ADD KEY `level_id` (`level_id`),
  ADD KEY `division_id` (`division_id`);

--
-- Indexes for table `terms`
--
ALTER TABLE `terms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `users_categories` (`category_id`),
  ADD KEY `users_roles` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `academic_courses`
--
ALTER TABLE `academic_courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `academic_student_register_courses`
--
ALTER TABLE `academic_student_register_courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `academic_terms`
--
ALTER TABLE `academic_terms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `academic_years`
--
ALTER TABLE `academic_years`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `divisions`
--
ALTER TABLE `divisions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `levels`
--
ALTER TABLE `levels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `main_settings`
--
ALTER TABLE `main_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=208;

--
-- AUTO_INCREMENT for table `permission_groups`
--
ALTER TABLE `permission_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `permission_models`
--
ALTER TABLE `permission_models`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `permission_role`
--
ALTER TABLE `permission_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=268;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `terms`
--
ALTER TABLE `terms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `academic_student_register_courses`
--
ALTER TABLE `academic_student_register_courses`
  ADD CONSTRAINT `academic_student_register_courses_ibfk_1` FOREIGN KEY (`academic_term_id`) REFERENCES `academic_terms` (`id`),
  ADD CONSTRAINT `academic_student_register_courses_ibfk_2` FOREIGN KEY (`academic_year_id`) REFERENCES `academic_years` (`id`),
  ADD CONSTRAINT `academic_student_register_courses_ibfk_5` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`),
  ADD CONSTRAINT `academic_student_register_courses_ibfk_6` FOREIGN KEY (`course_id`) REFERENCES `academic_courses` (`id`),
  ADD CONSTRAINT `academic_student_register_courses_ibfk_7` FOREIGN KEY (`division_id`) REFERENCES `divisions` (`id`),
  ADD CONSTRAINT `academic_student_register_courses_ibfk_8` FOREIGN KEY (`level_id`) REFERENCES `levels` (`id`);

--
-- Constraints for table `academic_terms`
--
ALTER TABLE `academic_terms`
  ADD CONSTRAINT `terms_academic_years` FOREIGN KEY (`academic_year_id`) REFERENCES `academic_years` (`id`);

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `main_settings`
--
ALTER TABLE `main_settings`
  ADD CONSTRAINT `main_settings_ibfk_1` FOREIGN KEY (`academic_term_id`) REFERENCES `academic_terms` (`id`),
  ADD CONSTRAINT `main_settings_ibfk_2` FOREIGN KEY (`academic_year_id`) REFERENCES `academic_years` (`id`);

--
-- Constraints for table `permissions`
--
ALTER TABLE `permissions`
  ADD CONSTRAINT `permissions_models` FOREIGN KEY (`model_id`) REFERENCES `permission_models` (`id`);

--
-- Constraints for table `permission_models`
--
ALTER TABLE `permission_models`
  ADD CONSTRAINT `models_groups` FOREIGN KEY (`group_id`) REFERENCES `permission_groups` (`id`);

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permissions` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`),
  ADD CONSTRAINT `roles` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_17` FOREIGN KEY (`level_id`) REFERENCES `levels` (`id`),
  ADD CONSTRAINT `students_ibfk_18` FOREIGN KEY (`division_id`) REFERENCES `divisions` (`id`),
  ADD CONSTRAINT `students_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_categories` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `users_roles` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
