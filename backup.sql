-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           5.7.22 - MySQL Community Server (GPL)
-- OS do Servidor:               Linux
-- HeidiSQL Versão:              12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para projeto
CREATE DATABASE IF NOT EXISTS `projeto` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `projeto`;

-- Copiando estrutura para tabela projeto.comment_products
CREATE TABLE IF NOT EXISTS `comment_products` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `product_id` bigint(20) unsigned NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `comment_products_user_id_foreign` (`user_id`),
  KEY `comment_products_product_id_foreign` (`product_id`),
  CONSTRAINT `comment_products_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `comment_products_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela projeto.comment_products: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela projeto.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela projeto.failed_jobs: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela projeto.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela projeto.migrations: ~6 rows (aproximadamente)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(5, '2022_11_25_011506_create_products_table', 1),
	(6, '2022_11_25_011536_create_comment_products_table', 1);

-- Copiando estrutura para tabela projeto.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela projeto.password_resets: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela projeto.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela projeto.personal_access_tokens: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela projeto.products
CREATE TABLE IF NOT EXISTS `products` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity_inventory` int(11) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `type` enum('eletronicos','livros','jogos','acessorios','brinquedos','games','roupas','perfumaria') COLLATE utf8mb4_unicode_ci NOT NULL,
  `quality` enum('novo','semi_novo','bom','medio') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'bom',
  `price` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `products_name_unique` (`name`),
  KEY `products_user_id_foreign` (`user_id`),
  CONSTRAINT `products_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela projeto.products: ~8 rows (aproximadamente)
INSERT INTO `products` (`id`, `user_id`, `name`, `image`, `quantity_inventory`, `description`, `type`, `quality`, `price`, `created_at`, `updated_at`) VALUES
	(1, 1, 'teste', 'products/I6vlnUiDEWtxQOfL0W5l2MSAc8PXjPVrLnSDjL4q.png', 1, 'ljbkjbkjb', 'livros', 'novo', 1.00, '2022-11-29 20:52:18', '2022-11-29 20:52:18'),
	(2, 1, 'çkhjlçk', 'products/VAmc3aLYmssz5YZuXou6rp6iv3ffhhCCD0ice8Aq.png', 5, 'sdasdasd', 'roupas', 'novo', 5.00, '2022-11-29 20:54:32', '2022-11-29 20:54:32'),
	(3, 2, 'Pablo Wolff', 'https://source.unsplash.com/random', 9, 'In velit rerum ullam quas atque quidem at voluptatem voluptate magni sed tenetur eum in est explicabo fuga autem quibusdam id magni ullam sed dignissimos fugit voluptatem laborum quisquam itaque repudiandae odit alias veniam explicabo corporis qui velit et dolor eius qui sunt id.', 'games', 'bom', 18.00, '2022-11-29 21:01:42', '2022-11-29 21:01:42'),
	(4, 3, 'Clara Marks', 'https://source.unsplash.com/random', 7, 'Nihil debitis neque neque esse dolorum ex sed ipsum consequatur fugiat quam voluptatem quia sed libero magnam voluptate non architecto voluptatem qui harum omnis voluptas amet quisquam non deserunt doloribus ab a eos commodi velit laborum ut similique voluptatem repellat et quas molestiae sint voluptatum consequatur optio qui est voluptas corrupti ut voluptatem est nihil ea animi vitae ut minima animi voluptas.', 'livros', 'bom', 8.00, '2022-11-29 21:01:42', '2022-11-29 21:01:42'),
	(5, 4, 'Dr. Velva Dare', 'https://source.unsplash.com/random', 24, 'Labore repellendus facilis aut molestiae autem eligendi autem harum culpa aspernatur consectetur quibusdam architecto accusamus modi voluptates quo deleniti enim at porro dolorem aut facere qui quia rem enim perferendis odit veritatis sed eaque consequatur blanditiis qui quas maxime aut numquam et ad sapiente repudiandae nobis mollitia et sit porro at enim soluta provident enim alias odio corrupti blanditiis deleniti veritatis omnis quos id recusandae non.', 'brinquedos', 'bom', 10.00, '2022-11-29 21:01:42', '2022-11-29 21:01:42'),
	(6, 5, 'Vergie Gutkowski', 'https://source.unsplash.com/random', 4, 'Sunt sint expedita dicta perferendis accusantium ab sed quibusdam laborum incidunt aliquam ratione architecto labore ut non nesciunt placeat ea consequatur aut quae cum aut eum eum optio aperiam qui ab omnis recusandae nam et odit rerum facilis libero sed ducimus.', 'acessorios', 'bom', 5.00, '2022-11-29 21:01:42', '2022-11-29 21:01:42'),
	(7, 6, 'Prof. Kallie Rippin DVM', 'https://source.unsplash.com/random', 14, 'Itaque nihil inventore aliquam qui cupiditate ipsa dolores ea facilis illo sed cum dolore velit et rem molestias doloribus alias illo porro vel maiores voluptatem maiores laboriosam facere facilis ea voluptas veritatis ullam assumenda sed ipsam amet enim libero ex quia.', 'perfumaria', 'bom', 7.00, '2022-11-29 21:01:42', '2022-11-29 21:01:42'),
	(8, 8, 'sdasd', 'products/XOOBKYMK5vwhAdxcphksHX6g6LOPMEUxZEsAR3R9.jpg', 1, 'ddsfsdfsd', 'jogos', 'novo', 1.00, '2022-12-02 22:29:41', '2022-12-02 22:29:41');

-- Copiando estrutura para tabela projeto.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela projeto.users: ~8 rows (aproximadamente)
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'rafael', 'rafaelb89@gmail.com', NULL, '$2y$10$Heol.Vy5USuOVSCDzuGuPO5daTj3H9nf/S6.6bwuVG.hmpP/lC3m2', NULL, '2022-11-29 20:48:10', '2022-11-29 20:48:10'),
	(2, 'Prof. Godfrey Williamson PhD', 'dach.jacklyn@example.org', '2022-11-29 21:01:41', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'UB9FoO6k0r', '2022-11-29 21:01:42', '2022-11-29 21:01:42'),
	(3, 'Alfreda Waelchi', 'mcglynn.thad@example.net', '2022-11-29 21:01:42', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'jZ0xg8rqZj', '2022-11-29 21:01:42', '2022-11-29 21:01:42'),
	(4, 'Antonetta Ankunding', 'llabadie@example.net', '2022-11-29 21:01:42', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '0pnp4mhySI', '2022-11-29 21:01:42', '2022-11-29 21:01:42'),
	(5, 'Prof. Vicente Gerlach', 'carroll.ross@example.net', '2022-11-29 21:01:42', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'vGq1JXSoOK', '2022-11-29 21:01:42', '2022-11-29 21:01:42'),
	(6, 'Oleta Marvin', 'kyla57@example.com', '2022-11-29 21:01:42', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'nyXMKWA3em', '2022-11-29 21:01:42', '2022-11-29 21:01:42'),
	(7, 'Teste', 'teste@gmail.com', NULL, '$2y$10$bvxoH7uj23mZlIUwelDRy.v0dtNHsGF2sgG1PKbO48xU7FCXgtWJa', NULL, '2022-12-02 00:48:37', '2022-12-02 00:48:37'),
	(8, 'Teste', 'rafaelb89.rb@gmail.com', NULL, '$2y$10$kEqgQO8pHIHLE6630rlW2OKzkwdqzNPIwLsliR2jSaoOTvFRtRg4i', NULL, '2022-12-02 17:13:26', '2022-12-02 17:13:26');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
