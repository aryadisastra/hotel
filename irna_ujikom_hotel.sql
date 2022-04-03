/*
MySQL Backup
Database: irna_ujikom_hotel
Backup Time: 2022-03-30 18:23:14
*/

SET FOREIGN_KEY_CHECKS=0;
DROP TABLE IF EXISTS `irna_ujikom_hotel`.`irna_fasilitas`;
DROP TABLE IF EXISTS `irna_ujikom_hotel`.`irna_kamar`;
DROP TABLE IF EXISTS `irna_ujikom_hotel`.`irna_reservasi`;
DROP TABLE IF EXISTS `irna_ujikom_hotel`.`irna_role`;
DROP TABLE IF EXISTS `irna_ujikom_hotel`.`irna_tamu`;
DROP TABLE IF EXISTS `irna_ujikom_hotel`.`irna_tipe`;
DROP TABLE IF EXISTS `irna_ujikom_hotel`.`irna_user`;
DROP TABLE IF EXISTS `irna_ujikom_hotel`.`migrations`;
DROP TABLE IF EXISTS `irna_ujikom_hotel`.`personal_access_tokens`;
CREATE TABLE `irna_fasilitas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `irna_nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `irna_status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE `irna_kamar` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `irna_nomor` int(11) NOT NULL,
  `irna_lantai` int(11) NOT NULL,
  `irna_tipe` int(11) NOT NULL,
  `irna_maximal` int(11) NOT NULL,
  `irna_harga` int(11) NOT NULL,
  `irna_status` int(11) NOT NULL,
  `irna_fasilitas` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `irna_foto` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `irna_kamar_irna_nomor_unique` (`irna_nomor`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE `irna_reservasi` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `irna_kode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `irna_id_tamu` int(11) NOT NULL,
  `irna_checkin` datetime NOT NULL,
  `irna_checkout` datetime NOT NULL,
  `irna_pesan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `irna_total` int(11) NOT NULL,
  `irna_no_kamar` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `irna_status` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `irna_reservasi_irna_kode_unique` (`irna_kode`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE `irna_role` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `irna_nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `irna_status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE `irna_tamu` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `irna_no_identitas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `irna_nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `irna_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `irna_username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `irna_password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `irna_telpon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `irna_tamu_irna_no_identitas_unique` (`irna_no_identitas`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE `irna_tipe` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `irna_nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `irna_tipe_irna_nama_unique` (`irna_nama`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE `irna_user` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `irna_nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `irna_username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `irna_role` int(11) NOT NULL,
  `irna_password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `irna_status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `irna_user_irna_username_unique` (`irna_username`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
BEGIN;
LOCK TABLES `irna_ujikom_hotel`.`irna_fasilitas` WRITE;
DELETE FROM `irna_ujikom_hotel`.`irna_fasilitas`;
INSERT INTO `irna_ujikom_hotel`.`irna_fasilitas` (`id`,`irna_nama`,`irna_status`,`created_at`,`updated_at`) VALUES (1, 'AC', 1, '2022-03-18 07:54:03', '2022-03-18 07:54:03'),(2, 'TV', 1, '2022-03-18 07:54:03', '2022-03-18 07:54:03'),(3, 'Water Heater', 1, '2022-03-18 07:54:03', '2022-03-18 07:54:03'),(4, 'Wifi', 1, '2022-03-18 07:54:03', '2022-03-18 07:54:03');
UNLOCK TABLES;
COMMIT;
BEGIN;
LOCK TABLES `irna_ujikom_hotel`.`irna_kamar` WRITE;
DELETE FROM `irna_ujikom_hotel`.`irna_kamar`;
INSERT INTO `irna_ujikom_hotel`.`irna_kamar` (`id`,`irna_nomor`,`irna_lantai`,`irna_tipe`,`irna_maximal`,`irna_harga`,`irna_status`,`irna_fasilitas`,`irna_foto`,`created_at`,`updated_at`) VALUES (4, 1, 1, 1, 12, 9000000, 2, '1234', NULL, '2022-03-27 17:21:33', '2022-03-27 17:23:00');
UNLOCK TABLES;
COMMIT;
BEGIN;
LOCK TABLES `irna_ujikom_hotel`.`irna_reservasi` WRITE;
DELETE FROM `irna_ujikom_hotel`.`irna_reservasi`;
INSERT INTO `irna_ujikom_hotel`.`irna_reservasi` (`id`,`irna_kode`,`irna_id_tamu`,`irna_checkin`,`irna_checkout`,`irna_pesan`,`irna_total`,`irna_no_kamar`,`created_at`,`updated_at`,`irna_status`) VALUES (60, 'tqTVpVm7FM', 2, '2022-03-27 17:22:00', '2022-04-10 17:21:00', 'test', 125993750, 1, '2022-03-27 17:22:09', '2022-03-30 18:15:24', 3);
UNLOCK TABLES;
COMMIT;
BEGIN;
LOCK TABLES `irna_ujikom_hotel`.`irna_role` WRITE;
DELETE FROM `irna_ujikom_hotel`.`irna_role`;
INSERT INTO `irna_ujikom_hotel`.`irna_role` (`id`,`irna_nama`,`irna_status`,`created_at`,`updated_at`) VALUES (1, 'Admin', 1, NULL, NULL),(2, 'resepsionis', 1, '2022-03-23 11:54:49', '2022-03-23 11:54:49');
UNLOCK TABLES;
COMMIT;
BEGIN;
LOCK TABLES `irna_ujikom_hotel`.`irna_tamu` WRITE;
DELETE FROM `irna_ujikom_hotel`.`irna_tamu`;
INSERT INTO `irna_ujikom_hotel`.`irna_tamu` (`id`,`irna_no_identitas`,`irna_nama`,`irna_email`,`irna_username`,`irna_password`,`irna_telpon`,`created_at`,`updated_at`) VALUES (2, '3217030909020006', 'arya', 'aryadisastra63@gmail.com', 'arya', '7048b71268c27d87e46498201fb31b0d', '089697457066', '2022-03-27 07:54:27', '2022-03-27 07:54:27'),(7, '2', '2', '2', '2', 'b3063f8c0b04435ed2b10a4d9cf1efa5', '2', '2022-03-27 14:58:46', '2022-03-27 14:59:22');
UNLOCK TABLES;
COMMIT;
BEGIN;
LOCK TABLES `irna_ujikom_hotel`.`irna_tipe` WRITE;
DELETE FROM `irna_ujikom_hotel`.`irna_tipe`;
INSERT INTO `irna_ujikom_hotel`.`irna_tipe` (`id`,`irna_nama`,`status`,`created_at`,`updated_at`) VALUES (1, 'Luxury', 1, '2022-03-18 07:52:43', '2022-03-18 07:52:43');
UNLOCK TABLES;
COMMIT;
BEGIN;
LOCK TABLES `irna_ujikom_hotel`.`irna_user` WRITE;
DELETE FROM `irna_ujikom_hotel`.`irna_user`;
INSERT INTO `irna_ujikom_hotel`.`irna_user` (`id`,`irna_nama`,`irna_username`,`irna_role`,`irna_password`,`irna_status`,`created_at`,`updated_at`) VALUES (1, 'Admin', 'admin', 1, '66b65567cedbc743bda3417fb813b9ba', 1, '2022-03-18 07:47:21', '2022-03-18 07:47:21'),(2, 'resepsionis', 'resepsionis', 2, 'e7e475ba9753fb95ac58f07439d17df9', 1, '2022-03-23 11:55:23', '2022-03-23 11:55:23');
UNLOCK TABLES;
COMMIT;
BEGIN;
LOCK TABLES `irna_ujikom_hotel`.`migrations` WRITE;
DELETE FROM `irna_ujikom_hotel`.`migrations`;
INSERT INTO `irna_ujikom_hotel`.`migrations` (`id`,`migration`,`batch`) VALUES (1, '2019_12_14_000001_create_personal_access_tokens_table', 1),(2, '2022_03_15_174618_create_irna_user', 1),(3, '2022_03_15_174851_create_irna_role', 1),(4, '2022_03_15_220628_create_irna_fasilitas', 1),(5, '2022_03_15_224011_create_irna_tipe', 1),(6, '2022_03_15_231837_create_irna_kamar', 1),(7, '2022_03_26_201444_create_irna_tamu', 2),(10, '2022_03_27_124440_create_irna_reservasi', 3),(11, '2022_03_30_165642_add_column_irna_status_to_irna_reservasi', 4);
UNLOCK TABLES;
COMMIT;
BEGIN;
LOCK TABLES `irna_ujikom_hotel`.`personal_access_tokens` WRITE;
DELETE FROM `irna_ujikom_hotel`.`personal_access_tokens`;
UNLOCK TABLES;
COMMIT;
