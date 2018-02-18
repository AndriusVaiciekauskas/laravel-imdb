-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.20-0ubuntu0.16.04.1 - (Ubuntu)
-- Server OS:                    Linux
-- HeidiSQL Version:             9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for laravel-imdb
CREATE DATABASE IF NOT EXISTS `laravel-imdb` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */;
USE `laravel-imdb`;

-- Dumping structure for table laravel-imdb.actors
CREATE TABLE IF NOT EXISTS `actors` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthday` date NOT NULL,
  `deathday` date DEFAULT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `actors_user_id_foreign` (`user_id`),
  CONSTRAINT `actors_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravel-imdb.actors: ~4 rows (approximately)
/*!40000 ALTER TABLE `actors` DISABLE KEYS */;
INSERT INTO `actors` (`id`, `name`, `birthday`, `deathday`, `user_id`, `created_at`, `updated_at`) VALUES
	(1, 'Leonardo DiCaprio', '1974-11-11', NULL, 1, '2018-02-15 08:04:57', '2018-02-15 08:04:57'),
	(4, 'Matt Damon', '1970-10-08', NULL, 1, '2018-02-15 09:06:15', '2018-02-15 09:06:15'),
	(5, 'Jessica Chastain', '1977-03-24', NULL, 1, '2018-02-15 09:59:52', '2018-02-15 09:59:52'),
	(6, 'Idris Elba', '1972-09-06', NULL, 1, '2018-02-15 10:03:45', '2018-02-15 10:03:45');
/*!40000 ALTER TABLE `actors` ENABLE KEYS */;

-- Dumping structure for table laravel-imdb.actor_movie
CREATE TABLE IF NOT EXISTS `actor_movie` (
  `actor_id` int(10) unsigned NOT NULL,
  `movie_id` int(10) unsigned NOT NULL,
  KEY `actor_movie_actor_id_foreign` (`actor_id`),
  KEY `actor_movie_movie_id_foreign` (`movie_id`),
  CONSTRAINT `actor_movie_actor_id_foreign` FOREIGN KEY (`actor_id`) REFERENCES `actors` (`id`),
  CONSTRAINT `actor_movie_movie_id_foreign` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravel-imdb.actor_movie: ~8 rows (approximately)
/*!40000 ALTER TABLE `actor_movie` DISABLE KEYS */;
INSERT INTO `actor_movie` (`actor_id`, `movie_id`) VALUES
	(1, 2),
	(1, 3),
	(1, 4),
	(4, 3),
	(4, 5),
	(4, 6),
	(4, 1),
	(5, 5),
	(5, 7),
	(6, 7);
/*!40000 ALTER TABLE `actor_movie` ENABLE KEYS */;

-- Dumping structure for table laravel-imdb.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravel-imdb.categories: ~5 rows (approximately)
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` (`id`, `name`, `description`, `user_id`, `created_at`, `updated_at`) VALUES
	(1, 'Drama', 'This is drama movies category', 1, '2018-02-14 16:32:15', '2018-02-14 16:32:15'),
	(2, 'Action', 'This is action movies category', 1, '2018-02-14 16:32:41', '2018-02-14 16:32:41'),
	(3, 'Animation', 'This is animation movies category', 1, '2018-02-14 16:33:17', '2018-02-14 16:33:17'),
	(4, 'Sci-fi', 'Science fiction movies category', 1, '2018-02-15 08:26:41', '2018-02-15 08:26:41'),
	(5, 'Crime', 'Crime movies category', 1, '2018-02-15 08:27:05', '2018-02-15 08:27:05');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;

-- Dumping structure for table laravel-imdb.images
CREATE TABLE IF NOT EXISTS `images` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `filename` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `imagable_id` int(10) unsigned NOT NULL,
  `imagable_type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `images_user_id_foreign` (`user_id`),
  CONSTRAINT `images_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravel-imdb.images: ~18 rows (approximately)
/*!40000 ALTER TABLE `images` DISABLE KEYS */;
INSERT INTO `images` (`id`, `filename`, `imagable_id`, `imagable_type`, `user_id`, `created_at`, `updated_at`) VALUES
	(6, '1518806726.jpg', 1, 'App\\Actor', 1, '2018-02-16 18:45:26', '2018-02-16 18:45:26'),
	(7, '1518808657.jpg', 4, 'App\\Actor', 1, '2018-02-16 19:17:37', '2018-02-16 19:17:37'),
	(8, '2018_02_16_19_29_40.jpg', 5, 'App\\Actor', 1, '2018-02-16 19:29:40', '2018-02-16 19:29:40'),
	(9, '2018_02_16_19_33_03.elba.jpg', 6, 'App\\Actor', 1, '2018-02-16 19:33:03', '2018-02-16 19:33:03'),
	(10, '2018_02_16_19_39_11finding_nemo.jpg', 1, 'App\\Movie', 1, '2018-02-16 19:39:11', '2018-02-16 19:39:11'),
	(11, '2018_02_17_22_03_03moneyball.jpg', 8, 'App\\Movie', 1, '2018-02-17 22:03:03', '2018-02-17 22:03:03'),
	(12, '2018_02_18_06_48_12departed2.jpg', 3, 'App\\Movie', 1, '2018-02-18 06:48:12', '2018-02-18 06:48:12'),
	(13, '2018_02_18_06_48_25departed3.jpg', 3, 'App\\Movie', 1, '2018-02-18 06:48:25', '2018-02-18 06:48:25'),
	(14, '2018_02_18_07_01_51departed.jpg', 3, 'App\\Movie', 1, '2018-02-18 07:01:51', '2018-02-18 07:01:51'),
	(15, '2018_02_18_07_07_58departed.jpg', 1, 'App\\Actor', 1, '2018-02-18 07:07:58', '2018-02-18 07:07:58'),
	(16, '2018_02_18_07_08_08departed2.jpg', 1, 'App\\Actor', 1, '2018-02-18 07:08:08', '2018-02-18 07:08:08'),
	(17, '2018_02_18_07_08_14departed3.jpg', 1, 'App\\Actor', 1, '2018-02-18 07:08:14', '2018-02-18 07:08:14'),
	(18, '2018_02_18_10_56_41inception.jpg', 2, 'App\\Movie', 1, '2018-02-18 10:56:41', '2018-02-18 10:56:41'),
	(19, '2018_02_18_10_56_54martian.jpg', 5, 'App\\Movie', 1, '2018-02-18 10:56:54', '2018-02-18 10:56:54'),
	(20, '2018_02_18_10_57_09bourne_.jpg', 6, 'App\\Movie', 1, '2018-02-18 10:57:09', '2018-02-18 10:57:09'),
	(21, '2018_02_18_10_57_19aviator.jpg', 4, 'App\\Movie', 1, '2018-02-18 10:57:19', '2018-02-18 10:57:19'),
	(22, '2018_02_18_10_57_31mollysgame_.jpg', 7, 'App\\Movie', 1, '2018-02-18 10:57:31', '2018-02-18 10:57:31'),
	(23, '2018_02_18_16_20_34moneyball2.jpg', 8, 'App\\Movie', 1, '2018-02-18 16:20:34', '2018-02-18 16:20:34');
/*!40000 ALTER TABLE `images` ENABLE KEYS */;

-- Dumping structure for table laravel-imdb.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravel-imdb.migrations: ~6 rows (approximately)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2018_02_14_093856_create_categories_table', 1),
	(4, '2018_02_14_121135_create_movies_table', 1),
	(5, '2018_02_14_184408_create_actors_table', 2),
	(6, '2018_02_14_195806_create_actor_movie_table', 2),
	(7, '2018_02_15_173455_create_images_table', 3);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping structure for table laravel-imdb.movies
CREATE TABLE IF NOT EXISTS `movies` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `year` year(4) NOT NULL,
  `rating` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `movies_category_id_foreign` (`category_id`),
  KEY `movies_user_id_foreign` (`user_id`),
  CONSTRAINT `movies_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  CONSTRAINT `movies_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravel-imdb.movies: ~6 rows (approximately)
/*!40000 ALTER TABLE `movies` DISABLE KEYS */;
INSERT INTO `movies` (`id`, `name`, `description`, `category_id`, `user_id`, `year`, `rating`, `created_at`, `updated_at`) VALUES
	(1, 'Finding Nemo', 'After his son is captured in the Great Barrier Reef and taken to Sydney, a timid clownfish sets out on a journey to bring him home.', 3, 1, '2003', 7, '2018-02-14 16:33:52', '2018-02-15 08:13:54'),
	(2, 'Inception', 'A thief, who steals corporate secrets through the use of dream-sharing technology, is given the inverse task of planting an idea into the mind of a CEO.', 4, 1, '2010', 9, '2018-02-14 18:40:23', '2018-02-15 08:27:29'),
	(3, 'Departed', 'An undercover cop and a mole in the police attempt to identify each other while infiltrating an Irish gang in South Boston.', 5, 1, '2006', 9, '2018-02-15 08:12:33', '2018-02-15 08:27:37'),
	(4, 'The Aviator', 'A biopic depicting the early years of legendary Director and aviator Howard Hughes\' career from the late 1920s to the mid 1940s.', 1, 1, '2004', 8, '2018-02-15 08:13:19', '2018-02-15 08:13:19'),
	(5, 'Martian', 'An astronaut becomes stranded on Mars after his team assume him dead, and must rely on his ingenuity to find a way to signal to Earth that he is alive.', 4, 1, '2015', 8, '2018-02-15 09:04:45', '2018-02-15 09:04:45'),
	(6, 'Jason Bourne', 'The CIA\'s most dangerous former operative is drawn out of hiding to uncover more explosive truths about his past.', 2, 1, '2016', 6, '2018-02-15 09:13:50', '2018-02-15 09:13:50'),
	(7, 'Molly\'s Game', 'The true story of Molly Bloom, an Olympic-class skier who ran the world\'s most exclusive high-stakes poker game and became an FBI target.', 1, 1, '2017', 8, '2018-02-15 10:04:30', '2018-02-15 10:04:30'),
	(8, 'Moneyball', 'Oakland A\'s general manager Billy Beane\'s successful attempt to assemble a baseball team on a lean budget by employing computer-generated analysis to acquire new players.', 1, 1, '2011', 8, '2018-02-17 22:02:45', '2018-02-17 22:02:45');
/*!40000 ALTER TABLE `movies` ENABLE KEYS */;

-- Dumping structure for table laravel-imdb.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravel-imdb.password_resets: ~0 rows (approximately)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Dumping structure for table laravel-imdb.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'User',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravel-imdb.users: ~0 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Andrius', 'a.vaiciekauskas@gmail.com', '$2y$10$lgRBlbnZNpFjIAWOSc3G2eF2xQvKKejvhz9e7cKYIrfxWQ6PV3pum', 'User', 'HwYdciQbsF7gJ9sorTk7HCM7KKHcOsSNPaEOH6XLyjsRIrsjUoRRuKNjm42P', '2018-02-14 16:28:05', '2018-02-14 16:28:05');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
