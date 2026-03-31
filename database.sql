CREATE DATABASE IF NOT EXISTS db_klinik;
USE db_klinik;

CREATE TABLE `pasien` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `umur` int(3) NOT NULL,
  `diagnosa` text NOT NULL,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
);