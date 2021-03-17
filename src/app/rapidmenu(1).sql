-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 24, 2020 at 02:07 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.3.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rapidmenu`
--

-- --------------------------------------------------------

--
-- Table structure for table `accesses`
--

CREATE TABLE `accesses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`roles`)),
  `accessible_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `accessible_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `action_events`
--

CREATE TABLE `action_events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `batch_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `actionable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `actionable_id` bigint(20) UNSIGNED NOT NULL,
  `target_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `target_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED DEFAULT NULL,
  `fields` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'running',
  `exception` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `original` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `changes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `action_events`
--

INSERT INTO `action_events` (`id`, `batch_id`, `user_id`, `name`, `actionable_type`, `actionable_id`, `target_type`, `target_id`, `model_type`, `model_id`, `fields`, `status`, `exception`, `created_at`, `updated_at`, `original`, `changes`) VALUES
(1, '922c3efd-8429-4f1b-8b35-5b53e90627c8', 1, 'Create', 'Silvanite\\Brandenburg\\Role', 1, 'Silvanite\\Brandenburg\\Role', 1, 'Silvanite\\Brandenburg\\Role', 1, '', 'finished', '', '2020-12-05 13:55:30', '2020-12-05 13:55:30', NULL, '{\"name\":\"Root\",\"slug\":\"root\",\"updated_at\":\"2020-12-05T16:55:30.000000Z\",\"created_at\":\"2020-12-05T16:55:30.000000Z\",\"id\":1,\"permissions\":[\"assignRoles\",\"canBeGivenAccess\",\"manageRoles\",\"manageUsers\",\"viewNova\",\"viewRoles\",\"viewUsers\"]}'),
(2, '922c5a67-7e3e-4089-9b54-ac9d23932a27', 1, 'Create', 'Silvanite\\Brandenburg\\Role', 2, 'Silvanite\\Brandenburg\\Role', 2, 'Silvanite\\Brandenburg\\Role', 2, '', 'finished', '', '2020-12-05 15:12:09', '2020-12-05 15:12:09', NULL, '{\"name\":\"Grand\",\"slug\":\"grand\",\"updated_at\":\"2020-12-05T18:12:09.000000Z\",\"created_at\":\"2020-12-05T18:12:09.000000Z\",\"id\":2,\"permissions\":[\"manageUsers\",\"viewNova\",\"viewUsers\"]}'),
(3, '922c5ab0-c725-4e31-93cc-e86d529c9519', 1, 'Create', 'Silvanite\\Brandenburg\\Role', 3, 'Silvanite\\Brandenburg\\Role', 3, 'Silvanite\\Brandenburg\\Role', 3, '', 'finished', '', '2020-12-05 15:12:57', '2020-12-05 15:12:57', NULL, '{\"name\":\"Restaurant\",\"slug\":\"restaurant\",\"updated_at\":\"2020-12-05T18:12:57.000000Z\",\"created_at\":\"2020-12-05T18:12:57.000000Z\",\"id\":3,\"permissions\":[\"manageUsers\",\"viewNova\",\"viewUsers\"]}'),
(4, '922c5bd1-37d6-484d-a3db-bd6e368ed412', 1, 'Attach', 'App\\User', 1, 'Silvanite\\Brandenburg\\Role', 1, 'Illuminate\\Database\\Eloquent\\Relations\\Pivot', NULL, '', 'finished', '', '2020-12-05 15:16:06', '2020-12-05 15:16:06', NULL, '{\"user_id\":\"1\",\"role_id\":\"1\"}'),
(5, '92343ef4-2d85-42c6-a748-d3d72579d98c', 1, 'Create', 'Silvanite\\Brandenburg\\Role', 4, 'Silvanite\\Brandenburg\\Role', 4, 'Silvanite\\Brandenburg\\Role', 4, '', 'finished', '', '2020-12-09 13:22:01', '2020-12-09 13:22:01', NULL, '{\"name\":\"Restaurant\",\"slug\":\"restaurant\",\"updated_at\":\"2020-12-09T16:22:01.000000Z\",\"created_at\":\"2020-12-09T16:22:01.000000Z\",\"id\":4,\"permissions\":[\"viewNova\"]}'),
(6, '9235bc87-3ac7-4e1f-a578-68c7d8def2b8', 1, 'Create', 'App\\User', 2, 'App\\User', 2, 'App\\User', 2, '', 'finished', '', '2020-12-10 07:08:59', '2020-12-10 07:08:59', NULL, '{\"name\":\"Hussam Reslan\",\"slug\":\"hussam-reslan\",\"email\":\"hussam@gmail.com\",\"level\":\"2\",\"user_id\":1,\"agent_id\":1,\"updated_at\":\"2020-12-10T10:08:58.000000Z\",\"created_at\":\"2020-12-10T10:08:58.000000Z\",\"id\":2}'),
(7, '9239feae-8bde-4c08-a3d5-868481cfc1fe', 1, 'Create', 'App\\User', 5, 'App\\User', 5, 'App\\User', 5, '', 'finished', '', '2020-12-12 09:57:16', '2020-12-12 09:57:16', NULL, '{\"name\":\"mazen fo\",\"slug\":\"mazen-fo\",\"email\":\"mazen@gmail.com\",\"level\":\"1\",\"user_id\":1,\"agent_id\":1,\"updated_at\":\"2020-12-12T12:57:16.000000Z\",\"created_at\":\"2020-12-12T12:57:16.000000Z\",\"id\":5}'),
(9, '923a0037-bbf6-4dbb-9751-dd28d6f9373b', 1, 'Update', 'App\\User', 1, 'App\\User', 1, 'App\\User', 1, '', 'finished', '', '2020-12-12 10:01:34', '2020-12-12 10:01:34', '{\"avatar\":null}', '{\"avatar\":\"users\\/xdevqBx9RsSABAZMckvKCCtHRqHfQQ3an4dd6Wml.jpeg\"}'),
(10, '923a00f4-0b6e-4f8d-a96b-822355db8f4e', 1, 'Update', 'App\\User', 5, 'App\\User', 5, 'App\\User', 5, '', 'finished', '', '2020-12-12 10:03:37', '2020-12-12 10:03:37', '{\"avatar\":null}', '{\"avatar\":\"users\\/SDUl2MlzfKChs0DfL3KKpxDifMsWOpDpDfl7T0oP.png\"}'),
(11, '923ffac2-c57e-4ae0-a5fb-99b27eabe20d', 1, 'Create', 'App\\Setting', 1, 'App\\Setting', 1, 'App\\Setting', 1, '', 'finished', '', '2020-12-15 09:21:16', '2020-12-15 09:21:16', NULL, '{\"key\":\"foo\",\"value\":\"10\",\"updated_at\":\"2020-12-15T12:21:16.000000Z\",\"created_at\":\"2020-12-15T12:21:16.000000Z\",\"id\":1}'),
(12, '923ffb10-5f04-4367-be73-82255b2d60be', 1, 'Attach', 'App\\Setting', 1, 'App\\Role', 2, 'Illuminate\\Database\\Eloquent\\Relations\\Pivot', NULL, '', 'finished', '', '2020-12-15 09:22:07', '2020-12-15 09:22:07', NULL, '{\"setting_id\":\"1\",\"role_id\":\"2\"}'),
(13, '92400df2-9ca7-4379-8c74-cc632970b8d2', 1, 'Create', 'App\\Setting', 2, 'App\\Setting', 2, 'App\\Setting', 2, '', 'finished', '', '2020-12-15 10:14:55', '2020-12-15 10:14:55', NULL, '{\"key\":\"moo\",\"value\":\"0\",\"updated_at\":\"2020-12-15T13:14:55.000000Z\",\"created_at\":\"2020-12-15T13:14:55.000000Z\",\"id\":2}'),
(14, '92400e05-6cf1-44cc-9930-242a836c2110', 1, 'Attach', 'App\\Setting', 2, 'App\\Role', 2, 'Illuminate\\Database\\Eloquent\\Relations\\Pivot', NULL, '', 'finished', '', '2020-12-15 10:15:07', '2020-12-15 10:15:07', NULL, '{\"setting_id\":\"2\",\"role_id\":\"2\"}'),
(15, '92400e16-2ed5-4d11-b0f1-ae1cc81865b8', 1, 'Attach', 'App\\Setting', 2, 'App\\Role', 4, 'Illuminate\\Database\\Eloquent\\Relations\\Pivot', NULL, '', 'finished', '', '2020-12-15 10:15:18', '2020-12-15 10:15:18', NULL, '{\"setting_id\":\"2\",\"role_id\":\"4\"}'),
(16, '92402c52-43a9-4159-b970-2771d88dbf06', 1, 'Attach', 'App\\Setting', 1, 'App\\Role', 2, 'Illuminate\\Database\\Eloquent\\Relations\\Pivot', NULL, '', 'finished', '', '2020-12-15 11:39:51', '2020-12-15 11:39:51', NULL, '{\"setting_id\":\"1\",\"role_id\":\"2\"}'),
(17, '92402c71-eb13-447f-b326-b59983eaa5c2', 1, 'Attach', 'App\\Setting', 2, 'App\\Role', 2, 'Illuminate\\Database\\Eloquent\\Relations\\Pivot', NULL, '', 'finished', '', '2020-12-15 11:40:12', '2020-12-15 11:40:12', NULL, '{\"setting_id\":\"2\",\"role_id\":\"2\"}'),
(23, '92403480-b13f-4a23-9df2-3da833968b8f', 5, 'Set Preference', 'App\\Setting', 2, 'App\\Setting', 2, 'App\\Setting', 2, 'a:1:{s:5:\"value\";s:1:\"1\";}', 'finished', '', '2020-12-15 12:02:44', '2020-12-15 12:02:44', NULL, NULL),
(24, '9240f83e-ee49-4f8e-a564-e207b7566b1f', 1, 'Create', 'App\\User', 6, 'App\\User', 6, 'App\\User', 6, '', 'finished', '', '2020-12-15 21:10:04', '2020-12-15 21:10:04', NULL, '{\"name\":\"Agent Demo\",\"slug\":\"agent-demo\",\"email\":\"agent@gmail.com\",\"level\":\"1\",\"user_id\":1,\"agent_id\":1,\"updated_at\":\"2020-12-16T00:10:04.000000Z\",\"created_at\":\"2020-12-16T00:10:04.000000Z\",\"id\":6,\"settings\":{\"foo\":\"10\",\"moo\":\"0\"}}'),
(25, '9240f873-9713-4078-b49f-381df77442b8', 1, 'Create', 'App\\User', 7, 'App\\User', 7, 'App\\User', 7, '', 'finished', '', '2020-12-15 21:10:38', '2020-12-15 21:10:38', NULL, '{\"name\":\"Rest Demo\",\"slug\":\"rest-demo\",\"email\":\"rest@gmail.com\",\"level\":\"2\",\"user_id\":1,\"agent_id\":1,\"updated_at\":\"2020-12-16T00:10:38.000000Z\",\"created_at\":\"2020-12-16T00:10:38.000000Z\",\"id\":7,\"settings\":{\"foo\":\"10\",\"moo\":\"0\"}}'),
(26, '9240fa16-db4e-42e1-91aa-97eeeda944f3', 1, 'Update', 'Silvanite\\Brandenburg\\Role', 3, 'Silvanite\\Brandenburg\\Role', 3, 'Silvanite\\Brandenburg\\Role', 3, '', 'finished', '', '2020-12-15 21:15:13', '2020-12-15 21:15:13', '[]', '[]'),
(27, '9240fd6f-3577-4a0e-bb6e-427ba397b2de', 6, 'Create', 'App\\User', 8, 'App\\User', 8, 'App\\User', 8, '', 'finished', '', '2020-12-15 21:24:34', '2020-12-15 21:24:34', NULL, '{\"name\":\"Rest One Demo\",\"slug\":\"rest-one-demo\",\"email\":\"rest1@gmail.com\",\"level\":\"2\",\"user_id\":6,\"agent_id\":1,\"updated_at\":\"2020-12-16T00:24:34.000000Z\",\"created_at\":\"2020-12-16T00:24:34.000000Z\",\"id\":8,\"settings\":{\"foo\":\"10\",\"moo\":\"0\"}}'),
(28, '9241ba7c-d24c-4845-864c-a5fef7c7a217', 1, 'Create', 'App\\User', 9, 'App\\User', 9, 'App\\User', 9, '', 'finished', '', '2020-12-16 06:13:12', '2020-12-16 06:13:12', NULL, '{\"name\":\"Agent Demo\",\"slug\":\"agent-demo\",\"email\":\"agent@gmail.com\",\"level\":\"1\",\"parent_id\":1,\"agent_id\":1,\"updated_at\":\"2020-12-16T09:13:12.000000Z\",\"created_at\":\"2020-12-16T09:13:12.000000Z\",\"id\":9,\"settings\":{\"foo\":\"10\",\"moo\":\"0\"}}'),
(29, '9241bae1-8016-48b4-8523-a4fe9bf90cd3', 1, 'Create', 'App\\User', 10, 'App\\User', 10, 'App\\User', 10, '', 'finished', '', '2020-12-16 06:14:18', '2020-12-16 06:14:18', NULL, '{\"name\":\"Rest Demo\",\"slug\":\"rest-demo\",\"email\":\"rest@gmail.com\",\"level\":\"2\",\"parent_id\":1,\"agent_id\":1,\"updated_at\":\"2020-12-16T09:14:18.000000Z\",\"created_at\":\"2020-12-16T09:14:18.000000Z\",\"id\":10,\"settings\":{\"foo\":\"10\",\"moo\":\"0\"}}'),
(30, '9241bc02-248e-4e0c-965d-4d9585855330', 9, 'Create', 'App\\User', 11, 'App\\User', 11, 'App\\User', 11, '', 'finished', '', '2020-12-16 06:17:27', '2020-12-16 06:17:27', NULL, '{\"name\":\"Rest One Demo\",\"slug\":\"rest-one-demo\",\"email\":\"rest1@gmail.com\",\"level\":\"2\",\"parent_id\":1,\"agent_id\":1,\"updated_at\":\"2020-12-16T09:17:27.000000Z\",\"created_at\":\"2020-12-16T09:17:27.000000Z\",\"id\":11,\"settings\":{\"foo\":\"10\",\"moo\":\"0\"}}'),
(31, '9241bd4e-c0f2-4d11-98bb-b6b4a3391429', 9, 'Create', 'App\\User', 12, 'App\\User', 12, 'App\\User', 12, '', 'finished', '', '2020-12-16 06:21:05', '2020-12-16 06:21:05', NULL, '{\"name\":\"Rest One Demo\",\"slug\":\"rest-one-demo\",\"email\":\"rest1@gmail.com\",\"level\":\"2\",\"parent_id\":9,\"agent_id\":1,\"updated_at\":\"2020-12-16T09:21:05.000000Z\",\"created_at\":\"2020-12-16T09:21:05.000000Z\",\"id\":12,\"settings\":{\"foo\":\"10\",\"moo\":\"0\"}}'),
(32, '9241bfab-4dcc-4124-b3ae-a2b75d019639', 1, 'Attach', 'App\\Setting', 2, 'App\\Role', 2, 'Illuminate\\Database\\Eloquent\\Relations\\Pivot', NULL, '', 'finished', '', '2020-12-16 06:27:42', '2020-12-16 06:27:42', NULL, '{\"setting_id\":\"2\",\"role_id\":\"2\"}'),
(33, '9241bfc5-171c-43f9-b133-99fde2d7aebc', 1, 'Attach', 'App\\Setting', 1, 'App\\Role', 2, 'Illuminate\\Database\\Eloquent\\Relations\\Pivot', NULL, '', 'finished', '', '2020-12-16 06:27:58', '2020-12-16 06:27:58', NULL, '{\"setting_id\":\"1\",\"role_id\":\"2\"}'),
(34, '9241bfd5-7b12-4655-ba60-2017705c62fb', 1, 'Attach', 'App\\Setting', 1, 'App\\Role', 3, 'Illuminate\\Database\\Eloquent\\Relations\\Pivot', NULL, '', 'finished', '', '2020-12-16 06:28:09', '2020-12-16 06:28:09', NULL, '{\"setting_id\":\"1\",\"role_id\":\"3\"}'),
(35, '9241c07b-9076-4f1e-90b7-0f9b1a3627d3', 9, 'Set Preference', 'App\\Setting', 2, 'App\\Setting', 2, 'App\\Setting', 2, 'a:1:{s:5:\"value\";s:1:\"3\";}', 'finished', '', '2020-12-16 06:29:58', '2020-12-16 06:29:58', NULL, NULL),
(36, '9241c08b-2558-40e1-accb-b60d2c13180e', 9, 'Set Preference', 'App\\Setting', 1, 'App\\Setting', 1, 'App\\Setting', 1, 'a:1:{s:5:\"value\";s:2:\"13\";}', 'finished', '', '2020-12-16 06:30:08', '2020-12-16 06:30:08', NULL, NULL),
(37, '9241c21b-1cbe-430d-85d6-561494388eb8', 12, 'Set Preference', 'App\\Setting', 1, 'App\\Setting', 1, 'App\\Setting', 1, 'a:1:{s:5:\"value\";s:2:\"15\";}', 'finished', '', '2020-12-16 06:34:30', '2020-12-16 06:34:30', NULL, NULL),
(38, '9241c4db-c6c7-45b1-816d-5fd281eb70ea', 9, 'Set Preference', 'App\\Setting', 2, 'App\\Setting', 2, 'App\\Setting', 2, 'a:1:{s:5:\"value\";s:1:\"3\";}', 'finished', '', '2020-12-16 06:42:12', '2020-12-16 06:42:12', NULL, NULL),
(39, '9241c4f4-1370-43fa-9d4e-80619f0962cb', 9, 'Set Preference', 'App\\Setting', 1, 'App\\Setting', 1, 'App\\Setting', 1, 'a:1:{s:5:\"value\";s:2:\"13\";}', 'finished', '', '2020-12-16 06:42:28', '2020-12-16 06:42:28', NULL, NULL),
(40, '9241c51f-0d87-42fc-8c4a-0f78fada61d0', 12, 'Set Preference', 'App\\Setting', 1, 'App\\Setting', 1, 'App\\Setting', 1, 'a:1:{s:5:\"value\";s:2:\"15\";}', 'finished', '', '2020-12-16 06:42:56', '2020-12-16 06:42:56', NULL, NULL),
(41, '9241c999-6e89-4909-bbe3-d5c25d643fca', 1, 'Update', 'Silvanite\\Brandenburg\\Role', 1, 'Silvanite\\Brandenburg\\Role', 1, 'Silvanite\\Brandenburg\\Role', 1, '', 'finished', '', '2020-12-16 06:55:28', '2020-12-16 06:55:28', '[]', '[]');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_01_01_000000_create_action_events_table', 1),
(4, '2019_05_10_000000_add_fields_to_action_events_table', 1),
(5, '2019_08_19_000000_create_failed_jobs_table', 1),
(6, '2017_05_28_115649_create_gates_table', 2),
(7, '2019_10_09_143453_create_accesses_table', 2),
(10, '2020_12_05_184408_add_users_fields', 3),
(11, '2020_12_15_091813_create_preferences_table', 4),
(12, '2020_12_15_092635_create_settings_table', 5),
(13, '2020_12_15_092905_create_role_setting_table', 6);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `preferences`
--

CREATE TABLE `preferences` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `agent_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `preferences`
--

INSERT INTO `preferences` (`id`, `key`, `value`, `user_id`, `agent_id`, `created_at`, `updated_at`) VALUES
(6, 'moo', '3', 9, 1, '2020-12-16 06:42:12', '2020-12-16 06:42:12'),
(7, 'foo', '13', 9, 1, '2020-12-16 06:42:28', '2020-12-16 06:42:28'),
(8, 'foo', '15', 12, 9, '2020-12-16 06:42:56', '2020-12-16 06:42:56');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `slug`, `name`, `created_at`, `updated_at`) VALUES
(1, 'root', 'Root', '2020-12-05 13:55:30', '2020-12-05 13:55:30'),
(2, 'agent', 'Agent', '2020-12-05 15:12:09', '2020-12-05 15:12:09'),
(3, 'restaurant', 'Restaurant', '2020-12-05 15:12:57', '2020-12-05 15:12:57');

-- --------------------------------------------------------

--
-- Table structure for table `role_permission`
--

CREATE TABLE `role_permission` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `permission_slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_permission`
--

INSERT INTO `role_permission` (`role_id`, `permission_slug`, `created_at`, `updated_at`) VALUES
(1, 'assignRoles', '2020-12-16 06:55:28', '2020-12-16 06:55:28'),
(1, 'canBeGivenAccess', '2020-12-16 06:55:28', '2020-12-16 06:55:28'),
(1, 'manageRoles', '2020-12-16 06:55:28', '2020-12-16 06:55:28'),
(1, 'manageSetting', '2020-12-16 06:55:28', '2020-12-16 06:55:28'),
(1, 'manageUsers', '2020-12-16 06:55:28', '2020-12-16 06:55:28'),
(1, 'viewNova', '2020-12-16 06:55:28', '2020-12-16 06:55:28'),
(1, 'viewRoles', '2020-12-16 06:55:28', '2020-12-16 06:55:28'),
(1, 'viewSetting', '2020-12-16 06:55:28', '2020-12-16 06:55:28'),
(1, 'viewUsers', '2020-12-16 06:55:28', '2020-12-16 06:55:28'),
(2, 'manageUsers', '2020-12-05 15:12:09', '2020-12-05 15:12:09'),
(2, 'viewNova', '2020-12-05 15:12:09', '2020-12-05 15:12:09'),
(2, 'viewUsers', '2020-12-05 15:12:09', '2020-12-05 15:12:09'),
(3, 'viewNova', '2020-12-15 21:15:13', '2020-12-15 21:15:13'),
(3, 'viewUsers', '2020-12-15 21:15:13', '2020-12-15 21:15:13');

-- --------------------------------------------------------

--
-- Table structure for table `role_setting`
--

CREATE TABLE `role_setting` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `setting_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_setting`
--

INSERT INTO `role_setting` (`id`, `role_id`, `setting_id`, `created_at`, `updated_at`) VALUES
(6, 2, 2, NULL, NULL),
(7, 2, 1, NULL, NULL),
(8, 3, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`role_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, NULL),
(2, 9, NULL, NULL),
(3, 10, NULL, NULL),
(3, 11, NULL, NULL),
(3, 12, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'foo', '10', '2020-12-15 09:21:16', '2020-12-15 09:21:16'),
(2, 'moo', '0', '2020-12-15 10:14:55', '2020-12-15 10:14:55');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration_date` date DEFAULT NULL,
  `agent_id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` bigint(20) UNSIGNED NOT NULL,
  `level` int(11) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `avatar`, `slug`, `name`, `email`, `email_verified_at`, `password`, `expiration_date`, `agent_id`, `parent_id`, `level`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'users/xdevqBx9RsSABAZMckvKCCtHRqHfQQ3an4dd6Wml.jpeg', 'murad-alwan', 'Murad Alwan', 'free1soft@gmail.com', NULL, '$2y$10$K68xTCBFyPCZtOF55MOoAeJO2IbZrQBFevKGRIS3aI35G1skeaRMi', NULL, 1, 1, 0, NULL, NULL, '2020-12-12 10:01:34'),
(9, NULL, 'agent-demo', 'Agent Demo', 'agent@gmail.com', NULL, '$2y$10$GTwYtUuTQQtRfQPdZ14Rg.i3Zjgr9mAP8PXYBpwOvfeSt2Bima60W', NULL, 1, 1, 1, NULL, '2020-12-16 06:13:12', '2020-12-16 06:13:12'),
(10, NULL, 'rest-demo', 'Rest Demo', 'rest@gmail.com', NULL, '$2y$10$D5OKDRP02AbfUkVPomTvi.M.pu1vBD3HxyTsEfcI/WrK0EPZVTbZm', NULL, 1, 1, 2, NULL, '2020-12-16 06:14:18', '2020-12-16 06:14:18'),
(12, NULL, 'rest-one-demo', 'Rest One Demo', 'rest1@gmail.com', NULL, '$2y$10$Z6cJIFXhPBKf6YBJ8lXQw.rGfCHVq.nzXmtr.YVrCERMbpaDpZmFK', NULL, 1, 9, 2, NULL, '2020-12-16 06:21:05', '2020-12-16 06:21:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accesses`
--
ALTER TABLE `accesses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `accesses_accessible_type_accessible_id_index` (`accessible_type`,`accessible_id`);

--
-- Indexes for table `action_events`
--
ALTER TABLE `action_events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `action_events_actionable_type_actionable_id_index` (`actionable_type`,`actionable_id`),
  ADD KEY `action_events_batch_id_model_type_model_id_index` (`batch_id`,`model_type`,`model_id`),
  ADD KEY `action_events_user_id_index` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `preferences`
--
ALTER TABLE `preferences`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_permission`
--
ALTER TABLE `role_permission`
  ADD PRIMARY KEY (`role_id`,`permission_slug`);

--
-- Indexes for table `role_setting`
--
ALTER TABLE `role_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`role_id`,`user_id`),
  ADD KEY `role_user_user_id_foreign` (`user_id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_slug_unique` (`slug`),
  ADD KEY `users_parent_index` (`parent_id`),
  ADD KEY `users_agent_index` (`agent_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accesses`
--
ALTER TABLE `accesses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `action_events`
--
ALTER TABLE `action_events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `preferences`
--
ALTER TABLE `preferences`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `role_setting`
--
ALTER TABLE `role_setting`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `role_permission`
--
ALTER TABLE `role_permission`
  ADD CONSTRAINT `role_permission_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
