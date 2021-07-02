# Host: localhost  (Version 5.5.5-10.4.14-MariaDB)
# Date: 2021-07-02 20:35:34
# Generator: MySQL-Front 6.1  (Build 1.26)


#
# Structure for table "alternatif"
#

DROP TABLE IF EXISTS `alternatif`;
CREATE TABLE `alternatif` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` char(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=624 DEFAULT CHARSET=latin1;

#
# Data for table "alternatif"
#

INSERT INTO `alternatif` VALUES (609,'Adinda Salsabilah Korah'),(610,'Aliyanti Rukmini'),(611,'Althof Mikail Abdussalam'),(612,'Anggoro Anaturi'),(613,'Banny Adam'),(614,'Chantika Arya Putri'),(615,'Daud Omar Ghazali'),(616,'Desya Rahmawati'),(617,'Dyah Ayu Yasmine'),(618,'Erika Ade Safitri'),(619,'Farah Fatimah Zahra'),(620,'Firdha Resti Maulana'),(621,'Fitria Rahma'),(622,'Intan Fatika Sari'),(623,'Ivan Kolev');

#
# Structure for table "atribut"
#

DROP TABLE IF EXISTS `atribut`;
CREATE TABLE `atribut` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` char(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

#
# Data for table "atribut"
#

INSERT INTO `atribut` VALUES (1,'Benefit'),(2,'Cost');

#
# Structure for table "hasil_saw"
#

DROP TABLE IF EXISTS `hasil_saw`;
CREATE TABLE `hasil_saw` (
  `id_hasilsaw` int(11) NOT NULL AUTO_INCREMENT,
  `id_alternatif` char(30) DEFAULT NULL,
  `nilai_saw` decimal(5,4) DEFAULT NULL,
  PRIMARY KEY (`id_hasilsaw`)
) ENGINE=InnoDB AUTO_INCREMENT=441 DEFAULT CHARSET=utf8mb4;

#
# Data for table "hasil_saw"
#

INSERT INTO `hasil_saw` VALUES (426,'609',0.8481),(427,'610',0.6100),(428,'611',0.6585),(429,'612',0.6907),(430,'613',0.8279),(431,'614',0.9103),(432,'615',0.6533),(433,'616',0.8190),(434,'617',0.8234),(435,'618',0.8067),(436,'619',0.7988),(437,'620',0.9633),(438,'621',0.7605),(439,'622',0.7875),(440,'623',0.8510);

#
# Structure for table "item_siswa"
#

DROP TABLE IF EXISTS `item_siswa`;
CREATE TABLE `item_siswa` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `item_data` char(20) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

#
# Data for table "item_siswa"
#

INSERT INTO `item_siswa` VALUES (1,'Jenis Kelamin'),(2,'Tanggal Lahir'),(3,'Alamat'),(4,'Tahun Masuk');

#
# Structure for table "keputusan"
#

DROP TABLE IF EXISTS `keputusan`;
CREATE TABLE `keputusan` (
  `Id_keputusan` int(11) NOT NULL AUTO_INCREMENT,
  `id_alternatif` char(11) DEFAULT NULL,
  `nilaisaw` decimal(5,4) DEFAULT NULL,
  `jurusan` char(3) DEFAULT NULL,
  `tahun_ajaran` char(11) DEFAULT NULL,
  `periode` date DEFAULT NULL,
  PRIMARY KEY (`Id_keputusan`)
) ENGINE=InnoDB AUTO_INCREMENT=107 DEFAULT CHARSET=utf8mb4;

#
# Data for table "keputusan"
#

INSERT INTO `keputusan` VALUES (106,'609',0.8481,'IPS','2020/2021','2021-07-02');

#
# Structure for table "kriteria"
#

DROP TABLE IF EXISTS `kriteria`;
CREATE TABLE `kriteria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` char(50) DEFAULT NULL,
  `atribut` int(11) DEFAULT NULL,
  `bobot` decimal(5,4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `kriteria_ibfk_1` (`atribut`),
  CONSTRAINT `kriteria_ibfk_1` FOREIGN KEY (`atribut`) REFERENCES `atribut` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

#
# Data for table "kriteria"
#

INSERT INTO `kriteria` VALUES (26,'Nilai Matematika',1,0.2536),(27,'Hasil Psikotes',1,0.4789),(28,'Nilai IPA',1,0.1615),(29,'Nilai IPS',1,0.1059);

#
# Structure for table "bobot_kriteria"
#

DROP TABLE IF EXISTS `bobot_kriteria`;
CREATE TABLE `bobot_kriteria` (
  `kriteria_1` int(11) NOT NULL,
  `kriteria_2` int(11) NOT NULL,
  `bobot` char(5) NOT NULL,
  KEY `kriteria_1` (`kriteria_1`),
  KEY `kriteria_2` (`kriteria_2`),
  CONSTRAINT `bobot_kriteria_ibfk_1` FOREIGN KEY (`kriteria_1`) REFERENCES `kriteria` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `bobot_kriteria_ibfk_2` FOREIGN KEY (`kriteria_2`) REFERENCES `kriteria` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "bobot_kriteria"
#

INSERT INTO `bobot_kriteria` VALUES (26,27,'1/3'),(26,28,'2/1'),(26,29,'3/1'),(27,28,'3/1'),(27,29,'3/1'),(28,29,'2/1');

#
# Structure for table "level"
#

DROP TABLE IF EXISTS `level`;
CREATE TABLE `level` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `keterangan` char(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

#
# Data for table "level"
#

INSERT INTO `level` VALUES (0,'Admin'),(1,'Petugas'),(2,'Pakar/Ahli');

#
# Structure for table "nilai_alternatif"
#

DROP TABLE IF EXISTS `nilai_alternatif`;
CREATE TABLE `nilai_alternatif` (
  `alternatif` int(11) DEFAULT NULL,
  `kriteria` int(11) DEFAULT NULL,
  `nilai` double DEFAULT NULL,
  KEY `alternatif` (`alternatif`),
  KEY `kriteria` (`kriteria`),
  CONSTRAINT `nilai_alternatif_ibfk_1` FOREIGN KEY (`alternatif`) REFERENCES `alternatif` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `nilai_alternatif_ibfk_2` FOREIGN KEY (`kriteria`) REFERENCES `kriteria` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "nilai_alternatif"
#

INSERT INTO `nilai_alternatif` VALUES (609,26,55),(609,27,114),(609,28,70),(609,29,96),(610,26,63),(610,27,80),(610,28,20),(610,29,64),(611,26,30),(611,27,112),(611,28,30),(611,29,76),(612,26,70),(612,27,98),(612,28,20),(612,29,56),(613,26,45),(613,27,126),(613,28,60),(613,29,84),(614,26,80),(614,27,128),(614,28,40),(614,29,88),(615,26,40),(615,27,106),(615,28,25),(615,29,72),(616,26,60),(616,27,118),(616,28,60),(616,29,60),(617,26,45),(617,27,126),(617,28,60),(617,29,80),(618,26,45),(618,27,118),(618,28,60),(618,29,92),(619,26,60),(619,27,102),(619,28,60),(619,29,96),(620,26,75),(620,27,126),(620,28,80),(620,29,84),(621,26,45),(621,27,108),(621,28,60),(621,29,84),(622,26,45),(622,27,126),(622,28,40),(622,29,84),(623,26,50),(623,27,125),(623,28,60),(623,29,94);

#
# Structure for table "pengguna"
#

DROP TABLE IF EXISTS `pengguna`;
CREATE TABLE `pengguna` (
  `username` char(50) NOT NULL,
  `password` char(64) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `nama` char(50) DEFAULT NULL,
  PRIMARY KEY (`username`),
  KEY `level` (`level`),
  CONSTRAINT `pengguna_ibfk_1` FOREIGN KEY (`level`) REFERENCES `level` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "pengguna"
#

INSERT INTO `pengguna` VALUES ('admin','8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918',0,'BK'),('Kepala Sekolah','d57183f49aed60e62ec1efb532c27873e77aaa834445b01217862d8da3aea6c7',2,'Kepala Sekolah');

#
# Structure for table "masuk"
#

DROP TABLE IF EXISTS `masuk`;
CREATE TABLE `masuk` (
  `id` char(36) NOT NULL,
  `pengguna` char(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `masuk_ibfk_1` (`pengguna`),
  CONSTRAINT `masuk_ibfk_1` FOREIGN KEY (`pengguna`) REFERENCES `pengguna` (`username`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "masuk"
#

INSERT INTO `masuk` VALUES ('5be2e633-cb3d-11eb-89bd-40e7c62d8d3e','admin'),('7f102889-d639-11eb-b7a2-0c04efa66f39','admin'),('b7c4bc0d-0d8c-11ea-aaea-7a1b192e9b80','admin');

#
# Structure for table "siswa"
#

DROP TABLE IF EXISTS `siswa`;
CREATE TABLE `siswa` (
  `Id_siswa` int(11) NOT NULL AUTO_INCREMENT,
  `id_alternatif` int(11) DEFAULT NULL,
  `namasiswa` char(30) DEFAULT NULL,
  `jenkel` enum('L','P') DEFAULT NULL,
  `asal_sekolah` char(50) DEFAULT NULL,
  `masuk` year(4) DEFAULT NULL,
  PRIMARY KEY (`Id_siswa`),
  KEY `ambil_alternatif` (`id_alternatif`),
  CONSTRAINT `ambil` FOREIGN KEY (`id_alternatif`) REFERENCES `alternatif` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4;

#
# Data for table "siswa"
#

INSERT INTO `siswa` VALUES (4,NULL,'Adinda Salsabilah Korah','P','SMPN 6 TANGSEL',2017),(5,NULL,'Aliyanti Rukmini','P','SMP FALAHTEHA',2017),(6,NULL,'Althof Mikail Abdussalam','L','SMPN 18 TANGSEL',2017),(7,NULL,'Anggoro Anaturi','L','SMP PARIGI',2017),(8,NULL,'Banny Adam','P','SMPN 6 TANGSEL',2017),(9,NULL,'Chantika Arya Putri','L','SMPN 9 TANGSEL',2017),(10,NULL,'Daud Omar Ghazali','L','SMPN 17 TANGSEL',2017),(11,NULL,'Desya Rahmawati','P','SMPN 6 TANGSEL',2017),(12,NULL,'Dyah Ayu Yasmine','P','SMPN 19 TANGSEL',2017),(13,NULL,'Erika Ade Safitri','P','SMP PARAMARTA CIPUTAT',2017),(14,NULL,'Farah Fatimah Zahra','P','SMPN 6 TANGSEL',2017),(15,NULL,'Firdha Resti Maulana','P','SMP ISLAM AL SYUKRO',2017),(16,NULL,'Intan Fatika Sari','P','SMPN 11 TANGSEL',2017),(17,NULL,'Fitria Rahma','P','SMP PARIGI',2017),(19,NULL,'Ivan Kolev','L','SMPN 6 TANGSEL',2017);

#
# Structure for table "tanggapan"
#

DROP TABLE IF EXISTS `tanggapan`;
CREATE TABLE `tanggapan` (
  `id` char(36) NOT NULL,
  `tanggapan` text DEFAULT NULL,
  `akurasi` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "tanggapan"
#

