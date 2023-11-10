-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 06 Nov 2023 pada 14.56
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id21530219_db_learningschool`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `assign_class_teacher`
--

CREATE TABLE `assign_class_teacher` (
  `id` int(11) NOT NULL,
  `class_id` int(11) DEFAULT NULL,
  `teacher_id` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0: active, 1: inactive',
  `is_delete` tinyint(4) DEFAULT 0 COMMENT '0: active, 1: inactive',
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `assign_class_teacher`
--

INSERT INTO `assign_class_teacher` (`id`, `class_id`, `teacher_id`, `status`, `is_delete`, `created_by`, `created_at`, `updated_at`) VALUES
(10, 1, 5, 0, 0, 4, '2023-09-28 05:03:43', '2023-09-28 05:03:43'),
(11, 4, 21, 0, 0, 4, '2023-09-28 06:00:31', '2023-09-28 06:00:31'),
(12, 4, 5, 1, 0, 4, '2023-09-28 06:00:31', '2023-09-28 06:00:47'),
(13, 3, 21, 0, 0, 4, '2023-09-29 06:19:35', '2023-09-29 06:19:35');

-- --------------------------------------------------------

--
-- Struktur dari tabel `chat`
--

CREATE TABLE `chat` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) DEFAULT NULL,
  `receiver_id` int(11) DEFAULT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0:not read, 1:read',
  `created_date` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `chat`
--

INSERT INTO `chat` (`id`, `sender_id`, `receiver_id`, `message`, `file`, `status`, `created_date`, `created_at`, `updated_at`) VALUES
(22, 21, 4, 'haa\r\nhah', NULL, 1, 1698748194, '2023-10-31 10:29:54', '2023-10-31 12:05:04'),
(23, 21, 4, '?sand', NULL, 1, 1698748210, '2023-10-31 10:30:10', '2023-10-31 12:05:04'),
(24, 21, 4, 'apa yal\r\n😍', NULL, 1, 1698748374, '2023-10-31 10:32:54', '2023-10-31 12:05:04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `class`
--

CREATE TABLE `class` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `amount` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0: active, 1: inactive',
  `is_delete` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0: not, 1:yes',
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `class`
--

INSERT INTO `class` (`id`, `name`, `amount`, `status`, `is_delete`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'ABCDE', 11, 0, 0, 4, '2023-09-22 05:54:22', '2023-10-16 13:19:59'),
(2, 'SDFG', 0, 1, 1, 4, '2023-09-22 06:03:00', '2023-09-22 06:20:42'),
(3, 'X TJKT 2', 5000, 0, 0, 4, '2023-09-23 08:33:58', '2023-09-23 08:33:58'),
(4, 'X TJKT 3', 20, 0, 0, 4, '2023-09-23 08:34:12', '2023-10-16 13:19:52');

-- --------------------------------------------------------

--
-- Struktur dari tabel `class_subject`
--

CREATE TABLE `class_subject` (
  `id` int(11) NOT NULL,
  `class_id` int(11) DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `is_delete` tinyint(4) NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `class_subject`
--

INSERT INTO `class_subject` (`id`, `class_id`, `subject_id`, `created_by`, `is_delete`, `status`, `created_at`, `updated_at`) VALUES
(7, 0, 3, 4, 0, 0, '2023-09-22 09:48:58', '2023-09-22 09:48:58'),
(8, 0, 4, 4, 0, 0, '2023-09-22 09:48:58', '2023-09-22 09:48:58'),
(14, 1, 3, 4, 0, 0, '2023-09-22 10:21:25', '2023-09-22 10:21:25'),
(15, 1, 1, 4, 0, 1, '2023-09-22 10:21:25', '2023-09-22 10:33:23'),
(16, 3, 3, 4, 0, 0, '2023-09-27 10:33:38', '2023-09-27 10:33:38'),
(17, 3, 1, 4, 0, 0, '2023-09-27 10:33:38', '2023-09-27 10:33:38'),
(18, 3, 4, 4, 0, 0, '2023-09-30 10:25:05', '2023-09-30 10:25:05'),
(19, 4, 4, 4, 0, 0, '2023-10-13 12:58:07', '2023-10-13 12:58:07');

-- --------------------------------------------------------

--
-- Struktur dari tabel `class_subject_timetable`
--

CREATE TABLE `class_subject_timetable` (
  `id` int(11) NOT NULL,
  `class_id` int(11) DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `week_id` int(11) DEFAULT NULL,
  `start_time` varchar(25) DEFAULT NULL,
  `end_time` varchar(25) DEFAULT NULL,
  `room_number` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `class_subject_timetable`
--

INSERT INTO `class_subject_timetable` (`id`, `class_id`, `subject_id`, `week_id`, `start_time`, `end_time`, `room_number`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 1, '12:02', '01:12', '23', '2023-09-29 04:43:05', '2023-09-29 04:43:05'),
(5, 3, 3, 1, '13:22', '22:32', '1', '2023-09-29 06:15:10', '2023-09-29 06:15:10'),
(6, 3, 3, 2, '12:02', '12:02', '2', '2023-09-29 06:15:10', '2023-09-29 06:15:10'),
(7, 3, 3, 5, '12:22', '03:21', '12', '2023-09-29 06:15:10', '2023-09-29 06:15:10'),
(8, 3, 1, 6, '02:02', '03:02', '4', '2023-09-29 06:15:24', '2023-09-29 06:15:24');

-- --------------------------------------------------------

--
-- Struktur dari tabel `exam`
--

CREATE TABLE `exam` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `note` varchar(2000) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `is_delete` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `exam`
--

INSERT INTO `exam` (`id`, `name`, `note`, `created_by`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 'Exam 11', 'Note 11', 4, 1, '2023-09-29 11:53:46', '2023-10-07 04:08:01'),
(2, 'test 3', 'ets 3', 4, 1, '2023-09-29 12:21:06', '2023-09-29 12:21:08'),
(3, 'ee 2', 'ee2', 4, 1, '2023-09-29 12:24:45', '2023-10-07 04:07:23'),
(4, 'test 3', 'sasas', 4, 0, '2023-10-07 04:20:46', '2023-10-07 04:20:46'),
(5, 'test5', 'dsdsd', 4, 0, '2023-10-07 04:20:54', '2023-10-07 04:20:54');

-- --------------------------------------------------------

--
-- Struktur dari tabel `exam_schedule`
--

CREATE TABLE `exam_schedule` (
  `id` int(11) NOT NULL,
  `exam_id` int(11) DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `exam_date` date DEFAULT NULL,
  `start_time` varchar(25) DEFAULT NULL,
  `end_time` varchar(25) DEFAULT NULL,
  `room_number` varchar(25) DEFAULT NULL,
  `full_marks` varchar(25) DEFAULT NULL,
  `passing_mark` varchar(25) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `exam_schedule`
--

INSERT INTO `exam_schedule` (`id`, `exam_id`, `class_id`, `subject_id`, `exam_date`, `start_time`, `end_time`, `room_number`, `full_marks`, `passing_mark`, `created_by`, `created_at`, `updated_at`) VALUES
(5, 3, 3, 4, '2023-09-06', '11:11', '11:22', '1', '100', '60', 4, '2023-10-04 07:23:49', '2023-10-04 07:23:49'),
(6, 3, 3, 1, '2023-09-05', '01:02', '12:01', '1', '100', '50', 4, '2023-10-04 07:23:49', '2023-10-04 07:23:49'),
(7, 4, 3, 4, '2023-10-04', '11:11', '03:33', '12', '100', '70', 4, '2023-10-07 04:22:19', '2023-10-07 04:22:19'),
(8, 4, 3, 1, '2023-10-11', '22:02', '03:03', '8', '100', '89', 4, '2023-10-07 04:22:19', '2023-10-07 04:22:19');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
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
-- Struktur dari tabel `homework`
--

CREATE TABLE `homework` (
  `id` int(11) NOT NULL,
  `class_id` int(11) DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `homework_date` date DEFAULT NULL,
  `submission_date` date DEFAULT NULL,
  `document_file` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `is_delete` tinyint(4) DEFAULT 0,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `homework`
--

INSERT INTO `homework` (`id`, `class_id`, `subject_id`, `homework_date`, `submission_date`, `document_file`, `description`, `is_delete`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 3, 1, '2023-10-06', '2023-10-14', '20231013084206gcw700qxjtmsscfmxx6q.png', '<p>hi</p><p><b>fewrewrrerrew\r\n                    </b></p>', 0, 4, '2023-10-13 08:42:06', '2023-10-13 13:19:06'),
(2, 3, 4, '2023-10-12', '2023-10-14', '20231013125011mpggrzlzzpe0pfxv7eug.png', 'ok eok <b>ojdswd</b> <i>sfsfsfs</i><br>', 0, 21, '2023-10-13 12:50:11', '2023-10-13 12:50:11');

-- --------------------------------------------------------

--
-- Struktur dari tabel `homework_submit`
--

CREATE TABLE `homework_submit` (
  `id` int(11) NOT NULL,
  `homework_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `document_file` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `homework_submit`
--

INSERT INTO `homework_submit` (`id`, `homework_id`, `student_id`, `description`, `document_file`, `created_at`, `updated_at`) VALUES
(2, 1, 7, 'vxvxv', '20231014040745x1co8ieikg09nacnhtvc.png', '2023-10-14 04:07:45', '2023-10-14 04:07:45'),
(4, 2, 7, 'qwqqe', '20231106015303lvv6axuupqd4tukjqi63.xls', '2023-11-06 13:53:03', '2023-11-06 13:53:03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `marks_grade`
--

CREATE TABLE `marks_grade` (
  `id` int(11) NOT NULL,
  `name` varchar(25) DEFAULT NULL,
  `percent_from` int(11) NOT NULL DEFAULT 0,
  `percent_to` int(11) NOT NULL DEFAULT 0,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `marks_grade`
--

INSERT INTO `marks_grade` (`id`, `name`, `percent_from`, `percent_to`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'B', 80, 89, 4, '2023-10-07 03:53:51', '2023-10-07 04:11:35'),
(2, 'A', 90, 100, 4, '2023-10-07 03:54:08', '2023-10-07 04:10:46'),
(4, 'C', 70, 79, 4, '2023-10-07 04:11:03', '2023-10-07 04:11:27'),
(5, 'D', 60, 69, 4, '2023-10-07 04:11:18', '2023-10-07 04:11:18');

-- --------------------------------------------------------

--
-- Struktur dari tabel `marks_register`
--

CREATE TABLE `marks_register` (
  `id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `exam_id` int(11) DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `class_work` int(11) NOT NULL DEFAULT 0,
  `home_work` int(11) NOT NULL DEFAULT 0,
  `test_work` int(11) NOT NULL DEFAULT 0,
  `exam` int(11) NOT NULL DEFAULT 0,
  `full_marks` int(11) NOT NULL DEFAULT 0,
  `passing_mark` int(11) DEFAULT 0,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `marks_register`
--

INSERT INTO `marks_register` (`id`, `student_id`, `exam_id`, `class_id`, `subject_id`, `class_work`, `home_work`, `test_work`, `exam`, `full_marks`, `passing_mark`, `created_by`, `created_at`, `updated_at`) VALUES
(18, 15, 3, 3, 1, 0, 0, 40, 40, 100, 50, 21, '2023-10-04 08:57:27', '2023-10-07 04:37:54'),
(19, 7, 3, 3, 4, 22, 22, 22, 22, 100, 60, 21, '2023-10-04 08:57:44', '2023-10-04 08:57:44'),
(20, 15, 3, 3, 4, 10, 20, 10, 30, 100, 60, 4, '2023-10-04 11:04:51', '2023-10-04 11:04:51'),
(21, 7, 3, 3, 1, 60, 6, 7, 4, 100, 50, 4, '2023-10-04 11:22:49', '2023-10-04 11:22:49'),
(22, 15, 4, 3, 4, 30, 30, 20, 10, 100, 70, 4, '2023-10-07 04:22:40', '2023-10-07 04:22:40'),
(23, 15, 4, 3, 1, 50, 6, 20, 3, 100, 89, 4, '2023-10-07 04:23:01', '2023-10-07 04:23:01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `notice_board`
--

CREATE TABLE `notice_board` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `notice_date` date DEFAULT NULL,
  `publish_date` date DEFAULT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `notice_board`
--

INSERT INTO `notice_board` (`id`, `title`, `notice_date`, `publish_date`, `message`, `created_by`, `created_at`, `updated_at`) VALUES
(3, 'Work in Home', '2023-10-12', '2023-10-09', '<p>lorem</p><p>aeaewaaaaaaaaaaaease<br></p>', 4, '2023-10-10 08:53:58', '2023-10-10 08:53:58'),
(4, 'Pas Tie', '2023-10-22', '2023-10-09', 'But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; was born and I will give you a complete account of the system, and expound the actual teachings<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; of the great explorer of p[p[the truth, the master-builder of human happiness. No one rejects,<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain,<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; but because occasionally circumstances occur in which toil and pain can procure him some great<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise,<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; except to obtain some advantage from it? But who has any right to find fault with a man who<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; chooses to enjoy a pleasure that has no annoying', 4, '2023-10-10 09:03:46', '2023-10-10 09:03:46');

-- --------------------------------------------------------

--
-- Struktur dari tabel `notice_board_message`
--

CREATE TABLE `notice_board_message` (
  `id` int(11) NOT NULL,
  `notice_board_id` int(11) DEFAULT NULL,
  `message_to` int(11) DEFAULT NULL COMMENT 'user type',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `notice_board_message`
--

INSERT INTO `notice_board_message` (`id`, `notice_board_id`, `message_to`, `created_at`, `updated_at`) VALUES
(1, 3, 1, '2023-10-10 08:53:58', '2023-10-10 08:53:58'),
(2, 3, 4, '2023-10-10 08:53:58', '2023-10-10 08:53:58'),
(8, 4, 3, '2023-10-10 09:38:18', '2023-10-10 09:38:18'),
(9, 4, 2, '2023-10-10 09:38:18', '2023-10-10 09:38:18');

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `setting`
--

CREATE TABLE `setting` (
  `id` int(11) NOT NULL,
  `school_name` varchar(255) DEFAULT NULL,
  `exam_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `paypal_email` varchar(255) DEFAULT NULL,
  `stripe_key` varchar(500) DEFAULT NULL,
  `stripe_secret` varchar(500) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `favicon_icon` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `setting`
--

INSERT INTO `setting` (`id`, `school_name`, `exam_description`, `paypal_email`, `stripe_key`, `stripe_secret`, `logo`, `favicon_icon`, `created_at`, `updated_at`) VALUES
(1, 'SMKN 2 DEMAK <br> SEKOLAH PUSAT KEUNGGULAN', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sequi ratione, eum expedita dolores officiis eaque architecto voluptas porro. Corrupti accusantium laudantium ex facilis ipsam molestias similique culpa incidunt quo delectus quia tempora quaerat voluptatibus consequatur voluptates labore perferendis aut a, sed quibusdam. Quos eaque accusantium expedita quas nam debitis cupiditate.', 'test@test.com', 'pk_test_51O2oOBFSxsUJHoUClW3B8fSrT5O5h7FHSLkksaUZ31UOpKKKgngfMLyj0Cpe3sBtQDS5O43OI8fxg8a1ZGOc3uoN00WTOanPfr', 'sk_test_51O2oOBFSxsUJHoUCnOt3APlqG8Xtwfve2op4VIdJsW4FFxFemaXW6EQM8161oJZDAWbQWUwfi2H12jr3B6TqfRCf007xFkfCnD', '20231020112246aiil7q9xhy5xtauilkjr.png', '20231106014828kvszqin4nbue239wgvay.png', NULL, '2023-11-06 13:48:28');

-- --------------------------------------------------------

--
-- Struktur dari tabel `student_add_fees`
--

CREATE TABLE `student_add_fees` (
  `id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `total_amount` int(11) DEFAULT 0,
  `paid_amount` int(11) DEFAULT 0,
  `remaining_amount` int(11) DEFAULT 0,
  `payment_type` varchar(255) DEFAULT NULL,
  `remark` text DEFAULT NULL,
  `is_payment` tinyint(4) NOT NULL DEFAULT 0,
  `stripe_session_id` varchar(255) DEFAULT NULL,
  `payment_data` text DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `student_add_fees`
--

INSERT INTO `student_add_fees` (`id`, `student_id`, `class_id`, `total_amount`, `paid_amount`, `remaining_amount`, `payment_type`, `remark`, `is_payment`, `stripe_session_id`, `payment_data`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 15, 3, 0, 200, 0, 'Cash', 'bayar', 0, NULL, NULL, 4, '2023-10-17 06:00:18', '2023-10-17 06:00:18'),
(2, 15, 3, 4800, 140, 4660, 'Cash', 'bayar cicilan', 0, '0', NULL, 4, '2023-10-17 06:07:00', '2023-10-17 06:07:00'),
(3, 7, 3, 5000, 200, 4800, 'Cash', '2', 0, '0', NULL, 4, '2023-10-17 10:19:43', '2023-10-17 10:19:43'),
(4, 7, 3, 5000, 20, 4980, 'Paypal', 'hahaha', 0, '0', NULL, 7, '2023-10-18 08:30:50', '2023-10-18 08:30:50'),
(5, 7, 3, 5000, 20, 4980, 'Paypal', 'hahaha', 0, '0', NULL, 7, '2023-10-18 08:31:20', '2023-10-18 08:31:20'),
(6, 7, 3, 5000, 20, 4980, 'Paypal', 'hahaha', 0, '0', NULL, 7, '2023-10-18 08:31:45', '2023-10-18 08:31:45'),
(7, 7, 3, 5000, 20, 4980, 'Paypal', 'dadada', 0, '0', NULL, 7, '2023-10-18 08:44:17', '2023-10-18 08:44:17'),
(8, 7, 3, 5000, 20, 4980, 'Paypal', 'dadada', 0, '0', NULL, 7, '2023-10-18 08:44:31', '2023-10-18 08:44:31'),
(9, 7, 3, 5000, 20, 4980, 'Paypal', 'dadada', 0, '0', NULL, 7, '2023-10-18 08:45:52', '2023-10-18 08:45:52'),
(10, 7, 3, 5000, 20, 4980, 'Paypal', 'dadada', 0, '0', NULL, 7, '2023-10-18 08:46:14', '2023-10-18 08:46:14'),
(11, 7, 3, 5000, 20, 4980, 'Paypal', 'dadada', 0, '0', NULL, 7, '2023-10-18 08:46:54', '2023-10-18 08:46:54'),
(12, 7, 3, 5000, 20, 4980, 'Paypal', 'dadada', 0, '0', NULL, 7, '2023-10-18 08:57:15', '2023-10-18 08:57:15'),
(13, 7, 3, 5000, 20, 4980, 'Paypal', 'dadada', 0, '0', NULL, 7, '2023-10-18 09:09:39', '2023-10-18 09:09:39'),
(14, 7, 3, 5000, 221, 4779, 'Paypal', NULL, 0, '0', NULL, 7, '2023-10-18 09:14:20', '2023-10-18 09:14:20'),
(15, 7, 3, 5000, 22, 4978, 'Paypal', '212', 0, '0', NULL, 7, '2023-10-18 09:19:39', '2023-10-18 09:19:39'),
(16, 7, 3, 5000, 21, 4979, 'Paypal', 'sdd', 0, '0', NULL, 7, '2023-10-18 09:24:00', '2023-10-18 09:24:00'),
(17, 7, 3, 5000, 211, 4789, 'Paypal', 'sas', 0, '0', NULL, 7, '2023-10-18 09:36:40', '2023-10-18 09:36:40'),
(18, 7, 3, 5000, 22, 4978, 'Paypal', 's', 0, '0', NULL, 7, '2023-10-18 09:37:00', '2023-10-18 09:37:00'),
(19, 7, 3, 5000, 22, 4978, 'Paypal', 's', 0, '0', NULL, 7, '2023-10-18 09:38:42', '2023-10-18 09:38:42'),
(20, 7, 3, 5000, 22, 4978, 'Paypal', 'weq', 0, '0', NULL, 7, '2023-10-18 09:40:52', '2023-10-18 09:40:52'),
(21, 7, 3, 5000, 22, 4978, 'Paypal', 'eqwe', 0, '0', NULL, 7, '2023-10-18 09:41:08', '2023-10-18 09:41:08'),
(22, 7, 3, 5000, 12, 4988, 'Paypal', 'dadada', 0, '0', NULL, 7, '2023-10-18 09:43:54', '2023-10-18 09:43:54'),
(23, 7, 3, 5000, 212, 4788, 'Paypal', 'sa', 0, '0', NULL, 7, '2023-10-18 09:47:55', '2023-10-18 09:47:55'),
(24, 7, 3, 5000, 212, 4788, 'Paypal', 'sa', 0, '0', NULL, 7, '2023-10-18 09:50:38', '2023-10-18 09:50:38'),
(25, 7, 3, 5000, 1212, 3788, NULL, NULL, 0, NULL, NULL, 7, '2023-10-18 09:56:16', '2023-10-18 09:56:16'),
(26, 7, 3, 5000, 1212, 3788, 'Paypal', NULL, 0, '0', NULL, 7, '2023-10-18 09:56:23', '2023-10-18 09:56:23'),
(27, 7, 3, 5000, 12, 4988, 'Paypal', NULL, 0, '0', NULL, 7, '2023-10-18 09:57:28', '2023-10-18 09:57:28'),
(28, 7, 3, 5000, 29, 4971, 'Paypal', NULL, 0, '0', NULL, 7, '2023-10-18 09:59:48', '2023-10-18 09:59:48'),
(29, 7, 3, 5000, 22, 4978, 'Paypal', NULL, 0, '0', NULL, 7, '2023-10-18 10:01:11', '2023-10-18 10:01:11'),
(30, 7, 3, 5000, 21, 4979, 'Stripe', NULL, 0, NULL, NULL, 7, '2023-10-19 04:56:00', '2023-10-19 04:56:00'),
(31, 7, 3, 5000, 21, 4979, 'Stripe', NULL, 0, NULL, NULL, 7, '2023-10-19 04:56:40', '2023-10-19 04:56:40'),
(32, 7, 3, 5000, 21, 4979, 'Stripe', NULL, 0, NULL, NULL, 7, '2023-10-19 05:00:54', '2023-10-19 05:00:54'),
(33, 7, 3, 5000, 21, 4979, 'Stripe', NULL, 0, NULL, NULL, 7, '2023-10-19 05:07:31', '2023-10-19 05:07:31'),
(34, 7, 3, 5000, 21, 4979, 'Stripe', NULL, 0, NULL, NULL, 7, '2023-10-19 05:09:39', '2023-10-19 05:09:39'),
(35, 7, 3, 5000, 21, 4979, 'Stripe', NULL, 0, NULL, NULL, 7, '2023-10-19 05:11:29', '2023-10-19 05:11:29'),
(36, 7, 3, 5000, 215, 4785, 'Stripe', NULL, 0, NULL, NULL, 7, '2023-10-19 05:11:39', '2023-10-19 05:11:39'),
(37, 7, 3, 5000, 215, 4785, 'Stripe', NULL, 0, NULL, NULL, 7, '2023-10-19 05:18:11', '2023-10-19 05:18:11'),
(38, 7, 3, 5000, 6, 4994, 'Stripe', 'rre', 0, NULL, NULL, 7, '2023-10-19 05:23:04', '2023-10-19 05:23:04'),
(39, 7, 3, 5000, 6, 4994, 'Stripe', 'rre', 0, NULL, NULL, 7, '2023-10-19 05:23:25', '2023-10-19 05:23:25'),
(40, 7, 3, 5000, 6, 4994, 'Stripe', 'rre', 0, NULL, NULL, 7, '2023-10-19 05:23:59', '2023-10-19 05:23:59'),
(41, 7, 3, 5000, 6, 4994, 'Stripe', 'rre', 0, NULL, NULL, 7, '2023-10-19 05:25:24', '2023-10-19 05:25:24'),
(42, 7, 3, 5000, 6, 4994, 'Stripe', 'rre', 0, NULL, NULL, 7, '2023-10-19 05:31:18', '2023-10-19 05:31:18'),
(43, 7, 3, 5000, 6, 4994, 'Stripe', 'rre', 0, NULL, NULL, 7, '2023-10-19 05:32:04', '2023-10-19 05:32:04'),
(44, 7, 3, 5000, 65, 4935, 'Stripe', 'rre', 0, NULL, NULL, 7, '2023-10-19 05:32:34', '2023-10-19 05:32:34'),
(45, 7, 3, 5000, 65, 4935, 'Stripe', 'rre', 0, NULL, NULL, 7, '2023-10-19 05:34:02', '2023-10-19 05:34:02'),
(46, 7, 3, 5000, 652, 4348, 'Stripe', 'rre', 0, NULL, NULL, 7, '2023-10-19 05:38:54', '2023-10-19 05:38:54'),
(47, 7, 3, 5000, 652, 4348, 'Stripe', 'rre', 0, NULL, NULL, 7, '2023-10-19 05:39:09', '2023-10-19 05:39:09'),
(48, 7, 3, 5000, 652, 4348, 'Stripe', 'rre', 0, NULL, NULL, 7, '2023-10-19 05:42:41', '2023-10-19 05:42:41'),
(49, 7, 3, 5000, 100, 4900, 'Stripe', 'rre', 0, NULL, NULL, 7, '2023-10-19 05:54:17', '2023-10-19 05:54:17'),
(50, 7, 3, 5000, 10, 4990, 'Stripe', 'rre', 0, 'cs_test_a1LAHtP6xHq7TbS6EE9Q1tnWxmHuqHlJN6q79t7KvCeR2fd9yMzgjEbCvN', NULL, 7, '2023-10-19 05:55:21', '2023-10-19 05:55:22'),
(51, 7, 3, 5000, 10, 4990, 'Stripe', 'rre', 0, NULL, NULL, 7, '2023-10-19 05:57:48', '2023-10-19 05:57:48'),
(52, 7, 3, 5000, 3, 4997, 'Stripe', 'rre3', 0, 'cs_test_a1mzULPvjwbyyVhSWz2fcFYhczOA2ir1U5rp0md9mOwB3aJvUOOKXRNwrW', NULL, 7, '2023-10-19 06:03:06', '2023-10-19 06:03:07'),
(53, 7, 3, 5000, 3, 4997, 'Stripe', 'rre3', 0, NULL, NULL, 7, '2023-10-19 06:03:54', '2023-10-19 06:03:54'),
(54, 7, 3, 5000, 3, 4997, 'Stripe', 'rre3', 0, NULL, NULL, 7, '2023-10-19 06:04:13', '2023-10-19 06:04:13'),
(55, 7, 3, 5000, 22, 4978, 'Stripe', 'q', 0, 'cs_test_a1rSaDZNLUVsHv9le08iPrxD0UaJ9DKJaT1sFqshqzJfRF3OdQ6WVeTckQ', NULL, 7, '2023-10-19 06:06:10', '2023-10-19 06:06:11'),
(56, 7, 3, 5000, 90, 4910, 'Stripe', 'bayar', 0, 'cs_test_a12qXkAqHqaFz8dFgwIFRSzwfCbiGhR3f7OcDzpweOZ6j8uaObcRtHXbGq', NULL, 7, '2023-10-18 06:07:34', '2023-10-18 00:00:00'),
(57, 7, 3, 5000, 44, 4956, 'Stripe', 'werewr', 0, 'cs_test_a1Ff9JchKXU2kRjZiDfyektXaV77WW4bzLxIyDzrfLJOHLk1fQkol5BClT', NULL, 7, '2023-10-19 06:11:10', '2023-10-19 06:11:13'),
(58, 7, 3, 5000, 20, 4980, 'Stripe', 'dada', 0, 'cs_test_a1f4URek2KQEnNPMwdmLQoaaEvrAoV1GDx2W9Y2wist6T04IvVmGvYZkBZ', NULL, 7, '2023-10-19 06:52:32', '2023-10-19 06:52:48'),
(59, 7, 3, 5000, 212, 4788, 'Stripe', NULL, 0, 'cs_test_a1E3APqNqbWrO4vdtUlSX7Jgg61G4pJOjRJaeSrzvTK60RR8K0qOdzDJrP', NULL, 7, '2023-10-19 06:53:46', '2023-10-19 06:53:48'),
(60, 7, 3, 5000, 23, 4977, 'Stripe', 'ok', 0, 'cs_test_a1hqz6GGw7qFyuZBlNPdawpVGbtIg6hU4uH39Jkx87yRuerFxu6eIHLiog', NULL, 7, '2023-10-19 06:58:43', '2023-10-19 06:58:44'),
(61, 7, 3, 5000, 21, 4979, 'Stripe', 'ol', 1, 'cs_test_a1oIEXfyaO6VUmTp2IL9btv3qA0EUqzqTccpq1WscYXKIH7WTdpaqsLFLN', '{\"id\":\"cs_test_a1oIEXfyaO6VUmTp2IL9btv3qA0EUqzqTccpq1WscYXKIH7WTdpaqsLFLN\",\"object\":\"checkout.session\",\"after_expiration\":null,\"allow_promotion_codes\":null,\"amount_subtotal\":2100,\"amount_total\":2100,\"automatic_tax\":{\"enabled\":false,\"status\":null},\"billing_address_collection\":null,\"cancel_url\":\"http:\\/\\/localhost:8000\\/student\\/stripe\\/payment-error\",\"client_reference_id\":null,\"client_secret\":null,\"consent\":null,\"consent_collection\":null,\"created\":1697698824,\"currency\":\"usd\",\"currency_conversion\":null,\"custom_fields\":[],\"custom_text\":{\"shipping_address\":null,\"submit\":null,\"terms_of_service_acceptance\":null},\"customer\":null,\"customer_creation\":\"if_required\",\"customer_details\":{\"address\":{\"city\":null,\"country\":\"ID\",\"line1\":null,\"line2\":null,\"postal_code\":null,\"state\":null},\"email\":\"student@gmail.com\",\"name\":\"dada\",\"phone\":null,\"tax_exempt\":\"none\",\"tax_ids\":[]},\"customer_email\":\"student@gmail.com\",\"expires_at\":1697785224,\"invoice\":null,\"invoice_creation\":{\"enabled\":false,\"invoice_data\":{\"account_tax_ids\":null,\"custom_fields\":null,\"description\":null,\"footer\":null,\"metadata\":[],\"rendering_options\":null}},\"livemode\":false,\"locale\":null,\"metadata\":[],\"mode\":\"payment\",\"payment_intent\":\"pi_3O2qDiFSxsUJHoUC0krCzT7O\",\"payment_link\":null,\"payment_method_collection\":\"if_required\",\"payment_method_configuration_details\":null,\"payment_method_options\":[],\"payment_method_types\":[\"card\"],\"payment_status\":\"paid\",\"phone_number_collection\":{\"enabled\":false},\"recovered_from\":null,\"setup_intent\":null,\"shipping_address_collection\":null,\"shipping_cost\":null,\"shipping_details\":null,\"shipping_options\":[],\"status\":\"complete\",\"submit_type\":null,\"subscription\":null,\"success_url\":\"http:\\/\\/localhost:8000\\/student\\/stripe\\/payment-success\",\"total_details\":{\"amount_discount\":0,\"amount_shipping\":0,\"amount_tax\":0},\"ui_mode\":\"hosted\",\"url\":null}', 7, '2023-10-18 00:00:00', '2023-10-18 00:00:00'),
(62, 7, 3, 4979, 33, 4946, 'Paypal', NULL, 0, NULL, NULL, 17, '2023-10-19 07:19:14', '2023-10-19 07:19:14'),
(63, 7, 3, 4979, 33, 4946, 'Stripe', NULL, 0, 'cs_test_a1BJJYxJ7oJ6ozK17RkpR9ATuMZCCyRfQpCwoNM6Gtll0LsLId2g7NCnXM', NULL, 17, '2023-10-19 07:19:29', '2023-10-19 07:19:31'),
(64, 7, 3, 4979, 22, 4957, 'Stripe', 'ss', 1, 'cs_test_a19nNk9PppTn6NrEkQvveQXx8ss9S2BLjFBWghOkwLjEGq96OjqfIEdiFW', '{\"id\":\"cs_test_a19nNk9PppTn6NrEkQvveQXx8ss9S2BLjFBWghOkwLjEGq96OjqfIEdiFW\",\"object\":\"checkout.session\",\"after_expiration\":null,\"allow_promotion_codes\":null,\"amount_subtotal\":2200,\"amount_total\":2200,\"automatic_tax\":{\"enabled\":false,\"status\":null},\"billing_address_collection\":null,\"cancel_url\":\"http:\\/\\/localhost:8000\\/parent\\/stripe\\/payment-error\\/7\",\"client_reference_id\":null,\"client_secret\":null,\"consent\":null,\"consent_collection\":null,\"created\":1697702522,\"currency\":\"usd\",\"currency_conversion\":null,\"custom_fields\":[],\"custom_text\":{\"shipping_address\":null,\"submit\":null,\"terms_of_service_acceptance\":null},\"customer\":null,\"customer_creation\":\"if_required\",\"customer_details\":{\"address\":{\"city\":null,\"country\":\"ID\",\"line1\":null,\"line2\":null,\"postal_code\":null,\"state\":null},\"email\":\"ibua@gmail.com\",\"name\":\"fafa\",\"phone\":null,\"tax_exempt\":\"none\",\"tax_ids\":[]},\"customer_email\":\"ibua@gmail.com\",\"expires_at\":1697788922,\"invoice\":null,\"invoice_creation\":{\"enabled\":false,\"invoice_data\":{\"account_tax_ids\":null,\"custom_fields\":null,\"description\":null,\"footer\":null,\"metadata\":[],\"rendering_options\":null}},\"livemode\":false,\"locale\":null,\"metadata\":[],\"mode\":\"payment\",\"payment_intent\":\"pi_3O2rBTFSxsUJHoUC0Bto3nrw\",\"payment_link\":null,\"payment_method_collection\":\"if_required\",\"payment_method_configuration_details\":null,\"payment_method_options\":[],\"payment_method_types\":[\"card\"],\"payment_status\":\"paid\",\"phone_number_collection\":{\"enabled\":false},\"recovered_from\":null,\"setup_intent\":null,\"shipping_address_collection\":null,\"shipping_cost\":null,\"shipping_details\":null,\"shipping_options\":[],\"status\":\"complete\",\"submit_type\":null,\"subscription\":null,\"success_url\":\"http:\\/\\/localhost:8000\\/parent\\/stripe\\/payment-success\\/7\",\"total_details\":{\"amount_discount\":0,\"amount_shipping\":0,\"amount_tax\":0},\"ui_mode\":\"hosted\",\"url\":null}', 17, '2023-10-19 08:02:00', '2023-10-19 08:02:25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `student_attendance`
--

CREATE TABLE `student_attendance` (
  `id` int(11) NOT NULL,
  `class_id` int(11) DEFAULT NULL,
  `attendance_date` date DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `attendance_type` int(11) DEFAULT NULL COMMENT '1=Present, 2=Late, 3=Absent, 4=Half Day',
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `student_attendance`
--

INSERT INTO `student_attendance` (`id`, `class_id`, `attendance_date`, `student_id`, `attendance_type`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 3, '2023-10-06', 15, 2, 4, '2023-10-07 07:47:52', '2023-10-07 10:43:10'),
(2, 3, '2023-10-06', 7, 1, 4, '2023-10-07 07:47:56', '2023-10-07 12:50:45'),
(3, 3, '2023-10-05', 15, 1, 4, '2023-10-07 08:04:54', '2023-10-07 08:04:54'),
(4, 3, '2023-10-05', 7, 2, 4, '2023-10-07 08:04:56', '2023-10-07 08:04:56');

-- --------------------------------------------------------

--
-- Struktur dari tabel `subject`
--

CREATE TABLE `subject` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0: active, 1: inactive',
  `is_delete` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0: not, 1: yes',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `subject`
--

INSERT INTO `subject` (`id`, `name`, `type`, `created_by`, `status`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 'Elementarya', 'Practical', 4, 0, 0, '2023-09-22 07:00:30', '2023-09-22 07:11:12'),
(2, 'SarAxeo', 'Practical', 4, 0, 1, '2023-09-22 07:03:54', '2023-09-22 07:11:22'),
(3, 'Art', 'Practical', 4, 0, 0, '2023-09-22 08:10:08', '2023-09-22 08:10:08'),
(4, 'Desgin', 'Practical', 4, 0, 0, '2023-09-22 08:26:10', '2023-09-22 08:26:10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `admission_number` varchar(50) DEFAULT NULL,
  `roll_number` varchar(50) DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `gender` varchar(50) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `caste` varchar(50) DEFAULT NULL,
  `religion` varchar(50) DEFAULT NULL,
  `mobile_number` varchar(15) DEFAULT NULL,
  `admission_date` date DEFAULT NULL,
  `profile_pic` varchar(100) DEFAULT NULL,
  `blood_group` varchar(10) DEFAULT NULL,
  `height` varchar(10) DEFAULT NULL,
  `weight` varchar(10) DEFAULT NULL,
  `occupation` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `marital_status` varchar(50) DEFAULT NULL,
  `permanent_address` varchar(255) DEFAULT NULL,
  `qualification` varchar(255) DEFAULT NULL,
  `work_experience` varchar(255) DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL,
  `user_type` tinyint(4) NOT NULL DEFAULT 3 COMMENT '1: admin, 2: teacher, 3: student, 4: parent',
  `is_delete` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0: not deleted, 1: deleted',
  `status` tinyint(4) DEFAULT 0 COMMENT '0: active, 1:inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `parent_id`, `name`, `last_name`, `email`, `email_verified_at`, `password`, `remember_token`, `admission_number`, `roll_number`, `class_id`, `gender`, `date_of_birth`, `caste`, `religion`, `mobile_number`, `admission_date`, `profile_pic`, `blood_group`, `height`, `weight`, `occupation`, `address`, `marital_status`, `permanent_address`, `qualification`, `work_experience`, `note`, `user_type`, `is_delete`, `status`, `created_at`, `updated_at`) VALUES
(4, NULL, 'Adminn', NULL, 'admin@gmail.com', NULL, '$2y$10$itPipz47T.8HyZ20TsVvHuwDXGTCOdkKELxFosAngUSCushHuzaOC', 'pFRuhyIjRPpb6MQLaPkD7Y4DZXYdPMhBvFudf0BHtQyjJ3dA5UJowcldFc8a', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, '2023-09-19 08:30:58', '2023-11-06 06:52:16'),
(5, NULL, 'Teacher', 'ade', 'teacher@gmail.com', NULL, '$2y$10$8YbFUgp66Y3k3yyYcgIIB.kD5O7cSjvTqavLfzk0aQHOg4RSe1mWm', NULL, NULL, NULL, NULL, 'Female', '2023-09-12', NULL, NULL, '54355345345345', NULL, '20230927074252jvrnd39efzfctwncnqin.jpg', NULL, NULL, NULL, NULL, 'test', 'test', 'test', 'test', 'test', 'test', 2, 0, 0, '2023-09-19 08:30:58', '2023-09-27 00:42:53'),
(6, NULL, 'Parent', 'parent', 'parent@gmail.com', NULL, '$2y$10$PhauYOJi0PqHfQ7BjFQGCu4qOiaZ7HYmRCvTUBW9gf2/4sj8Ghn6C', NULL, NULL, NULL, NULL, 'Male', NULL, NULL, NULL, '332213121', NULL, NULL, NULL, NULL, NULL, 'dewe', 'demak', NULL, NULL, NULL, NULL, NULL, 4, 0, 0, '2023-09-19 08:30:58', '2023-09-27 02:05:03'),
(7, 17, 'Students', 'alex', 'student@gmail.com', NULL, '$2y$10$PhauYOJi0PqHfQ7BjFQGCu4qOiaZ7HYmRCvTUBW9gf2/4sj8Ghn6C', NULL, NULL, NULL, 3, 'Male', '2023-09-14', 'ser', '', '3344223232', NULL, '20230927083349sdouimmenzxsm6aa4hyp.png', 'ewr', 'wer', 'wer', NULL, '', '', '', '', '', NULL, 3, 0, 0, '2023-09-19 08:30:58', '2023-11-06 06:54:18'),
(9, NULL, 'Admin', NULL, 'adminn@gmail.com', NULL, '$2y$10$U5FKKda2l3c9G77apLK80ut1uGM0wuFKQWwvJXewCCJPz.dc90CZu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 0, 0, '2023-09-20 06:21:47', '2023-09-20 06:21:47'),
(10, NULL, 'alex', NULL, 'alex@gmail.com', NULL, '$2y$10$A64tUFWgpx0HKkQRfEbjZ.wAM6iV/UxupHZif0FIypXrx4ngwt2fi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, '2023-09-21 20:29:51', '2023-09-21 23:20:36'),
(11, NULL, 'Rame', NULL, 'rame@gmail.com', NULL, '$2y$10$7z3JCp6lECiT.iNLwSCNN.SzeGPyw0msf5zbtwY0NEr1WH/a2b1uS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, '2023-09-21 20:37:22', '2023-09-21 20:37:22'),
(12, NULL, 'as', NULL, 'rr@gmail.com', NULL, '$2y$10$5wUJYh0uLI4MWbTslerF1O2fWFx/ou7zgbyXsRaCevgrZQ/U9.Rp.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '20231020103601vqdyufxdfaswinxgs2ze.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, '2023-09-22 21:49:10', '2023-10-20 15:36:01'),
(13, NULL, 'sdf', 'fsf', 'ad@gmail.com', NULL, '$2y$10$qD1ZaQmjgSNNH4wHdc/mPuNGq8Qa6fKyLPQKIaEMU/0rDYHTavt0C', NULL, 'dsfds', 'fsfds', 1, '', '2023-09-08', 'sdff', 'dfsdf', 'sfsf', '2023-09-21', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 1, 0, '2023-09-22 22:06:19', '2023-09-23 01:24:09'),
(14, NULL, 'qw', 'wq', 'as@gmail.com', NULL, '$2y$10$6ecsOIZJWjlYfsImE6nsreUfTLnorMmbzkjLqYapDAnOtBGn5plKS', NULL, '21', '12', 1, '', '2023-09-20', 'wq', 'qw', '12', '2023-09-16', 'j.png', '12', '10', '10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 0, 0, '2023-09-22 22:08:17', '2023-09-22 22:08:17'),
(15, NULL, 'alex', 'ase', 'sqw@gmail.com', NULL, '$2y$10$Kh6hJdKD3cjzhvAJtS7mFuMWJARh0RpEuf3hov5v7oOcdi1fgiKeG', NULL, '221', '122', 3, '', '2023-09-06', 'wwq', 'wqqw', '111', '2023-09-08', '20230923052049yilqe6enjajo8ayal9nh.png', 'ww', '12', '21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 0, 0, '2023-09-22 22:20:50', '2023-10-04 05:28:39'),
(16, 17, 'qg', 'wqwg', 'ghg@nao', NULL, '$2y$10$vGVHfhDJofwzfnKRwLt1qu.xeTNnUTS5U3bm4cOht5GO9Shv1cvtG', NULL, 'qwg', 'qwqg', 1, 'Female', '2023-08-31', 'qwg', 'qwg', '21655543', '2023-09-02', '20230927074106dyyto4lrfmcplnyof8dq.png', 'qwg', '26', '16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 0, 0, '2023-09-22 22:23:15', '2023-09-27 00:41:06'),
(17, NULL, 'sasq', 'adq', 'ibua@gmail.com', NULL, '$2y$10$aLcmCEMiLKA7ZItHRlzY8Os0lrXUoYZtNTbdOu0GVFoSjXSyqdvPO', NULL, NULL, NULL, NULL, 'Male', NULL, NULL, NULL, '123112129', NULL, '202309230922304apef3yzzsdtjshptf5j.jpg', NULL, NULL, NULL, 'sadasdq', 'asdasdfsafsdfasq', NULL, NULL, NULL, NULL, NULL, 4, 0, 0, '2023-09-23 02:14:26', '2023-11-01 03:58:24'),
(18, NULL, 'alex', 'we', 'ale@gmails', NULL, '$2y$10$sU.NAZKbl8GfkyBwqTaKEONl9PLvL4AuMBghZ8GYoGUZSZqBqjZJW', NULL, NULL, NULL, NULL, 'Female', NULL, NULL, NULL, '342421414124', NULL, '202309230923413hr4vaylxh8z2vhe3kyt.png', NULL, NULL, NULL, 'dsfdsf', 'dsfdsfdsfsdf', NULL, NULL, NULL, NULL, NULL, 4, 1, 0, '2023-09-23 02:23:41', '2023-09-23 02:23:45'),
(19, NULL, 'guru', 'baik', 'gurubaik@gmail.com', NULL, '$2y$10$Bc7mE3dfPg3ZcSyJnOWy.ufI5kO6soNV/dSTsg9/NlJ0lWAxcSGam', NULL, NULL, NULL, NULL, 'Female', '2023-09-12', NULL, NULL, '0718893213', NULL, '20230927071931oevueiuwilpnhxtovwl1.jpg', NULL, NULL, NULL, NULL, '', 'test', '', '', '', '', 2, 1, 0, '2023-09-27 00:19:31', '2023-09-27 00:28:43'),
(20, NULL, 'alex', 'adsd', 'guruku@gmail.com', NULL, '$2y$10$yBZ6gfmhF9bcPh0uFTEdGOGYotgqX08gn97hkQuoGji3jWUa3Wx6a', NULL, NULL, NULL, NULL, 'Male', '2023-09-05', NULL, NULL, '2421234234', NULL, NULL, NULL, NULL, NULL, NULL, 'test', 'test', 'test', 'test', 'test', 'test', 2, 1, 0, '2023-09-27 00:26:41', '2023-09-27 00:28:46'),
(21, NULL, 'guru', 'baik', 'gurutok@gmail.com', NULL, '$2y$10$mHhFfgdYtqvTet2/qNHi4evqzXhVosNWracjbwoTqaSvsa4U71n8C', NULL, NULL, NULL, NULL, 'Male', '2023-09-19', NULL, NULL, '43423433123', '2023-09-23', '202309270741168drqear5xm9irl3icdwh.png', NULL, NULL, NULL, NULL, 'test', 'text', 'test', 'test', 'test', 'test', 2, 0, 0, '2023-09-27 00:30:27', '2023-10-31 03:42:34');

-- --------------------------------------------------------

--
-- Struktur dari tabel `week`
--

CREATE TABLE `week` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `fullcalendar_day` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `week`
--

INSERT INTO `week` (`id`, `name`, `fullcalendar_day`, `created_at`, `updated_at`) VALUES
(1, 'Monday', 1, NULL, NULL),
(2, 'Tuesday', 2, NULL, NULL),
(3, 'Wednesday', 3, NULL, NULL),
(4, 'Thursday', 4, NULL, NULL),
(5, 'Friday', 5, NULL, NULL),
(6, 'Saturday', 6, NULL, NULL),
(7, 'Sunday', 0, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `assign_class_teacher`
--
ALTER TABLE `assign_class_teacher`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `class_subject`
--
ALTER TABLE `class_subject`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `class_subject_timetable`
--
ALTER TABLE `class_subject_timetable`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `exam`
--
ALTER TABLE `exam`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `exam_schedule`
--
ALTER TABLE `exam_schedule`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `homework`
--
ALTER TABLE `homework`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `homework_submit`
--
ALTER TABLE `homework_submit`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `marks_grade`
--
ALTER TABLE `marks_grade`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `marks_register`
--
ALTER TABLE `marks_register`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `notice_board`
--
ALTER TABLE `notice_board`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `notice_board_message`
--
ALTER TABLE `notice_board_message`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `student_add_fees`
--
ALTER TABLE `student_add_fees`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `student_attendance`
--
ALTER TABLE `student_attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indeks untuk tabel `week`
--
ALTER TABLE `week`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `assign_class_teacher`
--
ALTER TABLE `assign_class_teacher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `class`
--
ALTER TABLE `class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `class_subject`
--
ALTER TABLE `class_subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `class_subject_timetable`
--
ALTER TABLE `class_subject_timetable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `exam`
--
ALTER TABLE `exam`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `exam_schedule`
--
ALTER TABLE `exam_schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `homework`
--
ALTER TABLE `homework`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `homework_submit`
--
ALTER TABLE `homework_submit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `marks_grade`
--
ALTER TABLE `marks_grade`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `marks_register`
--
ALTER TABLE `marks_register`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `notice_board`
--
ALTER TABLE `notice_board`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `notice_board_message`
--
ALTER TABLE `notice_board_message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `student_add_fees`
--
ALTER TABLE `student_add_fees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT untuk tabel `student_attendance`
--
ALTER TABLE `student_attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `subject`
--
ALTER TABLE `subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `week`
--
ALTER TABLE `week`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
