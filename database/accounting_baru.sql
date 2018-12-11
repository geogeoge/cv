-- MySQL dump 10.13  Distrib 5.5.61, for debian-linux-gnu (i686)
--
-- Host: localhost    Database: accounting_baru
-- ------------------------------------------------------
-- Server version	5.5.61-0ubuntu0.14.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `account`
--

DROP TABLE IF EXISTS `account`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `account` (
  `id_account` int(7) NOT NULL AUTO_INCREMENT,
  `nama_account` varchar(50) NOT NULL,
  `id_jenis_account` varchar(50) NOT NULL,
  `english` varchar(100) NOT NULL,
  PRIMARY KEY (`id_account`),
  KEY `jenis_account` (`id_jenis_account`),
  KEY `jenis_account_2` (`id_jenis_account`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `account`
--

LOCK TABLES `account` WRITE;
/*!40000 ALTER TABLE `account` DISABLE KEYS */;
INSERT INTO `account` VALUES (1,'Kas','1','Cash and Cash Equivalents'),(2,'Bank','1','Bank'),(3,'Piutang Dagang','1','Account Receivable'),(4,'Biaya Dibayar Dimuka','1','Prepaid Expense'),(5,'Ppn Masukan','1','Income Ppn'),(6,'Persediaan','1','Stock'),(7,'Piutang Karyawan','1','Employee Receivables'),(8,'Tanah','2','Land'),(9,'Gedung','2','Building'),(10,'Akumulasi Depresiasi Gedung','2','Accumulated Depreciation of Building'),(11,'Mesin-mesin','2','Machines'),(12,'Akumulasi Depresiasi Mesin-mesin','2','Accumulated Depreciation of Machines'),(13,'Inventaris','2','Inventory'),(14,'Akumulasi Depresiasi Inventaris','2','Accumulated Depreciation of Inventory'),(15,'Kendaraan','2','Vehicles'),(16,'Akumulasi Depresiasi Kendaraan','2','Accumulated Depreciation of Vehicles'),(17,'Hutang Biaya','3','Expense Payable'),(18,'Hutang Biaya Bandwith','3','Bandwith Expense Payable'),(19,'Hutang Gaji','3','Salary Payable'),(20,'Hutang Connectsi','3','Connectsi Payable'),(21,'Hutang Dagang','3','Sales Payable'),(22,'Hutang Ppn','3','Ppn Payable'),(23,'Pendapatan Dimuka','8','Other Payable'),(24,'Hutang Internal','3','Intern Payable'),(25,'Hutang Hardware','3','Hardware Payable'),(26,'Hutang Biaya Bunga','3','Interest Rate Payable'),(27,'Hutang Fee','3','Fee Payable'),(28,'Hutang Office','3','Office Payable'),(29,'Hutang Bank','4','Bank Payable'),(30,'Modal','5','Capital'),(31,'Laba (Rugi) Tahun Berjalan','8','Net Income'),(32,'Registrasi','6','Register'),(33,'Pendapatan Dial Up','6','Dial Up Revenues'),(34,'Pendapatan Internet','6','Internet Revenues'),(35,'Pendapatan Web & Domain','6','Web & Domain Revenues'),(36,'Pendapatan Lain-lain','6','Others Revenues'),(37,'Pendapatan Hardware','6','Hardware Revenues'),(38,'Pendapatan Bank','7','Bank Revenues'),(39,'Biaya Bank','8','Bank Charges'),(40,'Biaya Bandwith','8','Bandwith Cost'),(41,'Biaya Lain-lain','8','Others Cost'),(42,'Biaya Overhead','8','Overhead Cost'),(43,'Potongan Penjualan','8','Sales Discounts'),(44,'Biaya Bunga Hutang','3','Interest Rate of Debt'),(45,'Biaya Web & Domain','8','Web & Domain Cost'),(46,'PPh ps 23','8','PPh ps 23'),(47,'PPN','8','PPN'),(48,'Biaya Hak Penggunaan & USO','8','Usage Rights & USO Charges'),(49,'Biaya Penyusutan Gedung','8','Depreciation Cost Building'),(50,'Biaya Maintenance','8','Maintenance Cost'),(51,'Biaya Penyusutan Mesin-mesin','8','Depreciation Cost of Machines'),(52,'Biaya Penyusutan Inventaris','8','Depreciation Cost of Inventory'),(53,'Biaya Penyusutan Sewa BTS','8','Depreciation Cost of BTS Rent'),(54,'Biaya Operasional Kantor','8','Office Operational Cost'),(55,'Biaya Rumah Tangga Kantor','8','Household Office Cost'),(56,'Fee Marketing','8',''),(57,'Biaya Sewa','8',''),(58,'Biaya Penjualan','8',''),(59,'Cadangan THR','8',''),(60,'Biaya Utilities','8','Utilities Cost'),(61,'Biaya Telepon','8','Telephone Cost'),(62,'Salary','8','Salary'),(63,'Biaya Office Supplies','8','Office Supplies Cost'),(64,'Biaya Travel','8','Travel Cost'),(65,'Biaya Marketing','8','Marketing Cost'),(66,'Biaya Asuransi','8','Insurance Cost');
/*!40000 ALTER TABLE `account` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `data_temp`
--

DROP TABLE IF EXISTS `data_temp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `data_temp` (
  `id_temp` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` date NOT NULL,
  `keterangan` text NOT NULL,
  `nominal` int(11) NOT NULL,
  `id_account` varchar(225) NOT NULL,
  `in_out` enum('i','o') NOT NULL,
  `status` enum('belum','sudah') NOT NULL,
  `ekstra` varchar(225) NOT NULL,
  PRIMARY KEY (`id_temp`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data_temp`
--

LOCK TABLES `data_temp` WRITE;
/*!40000 ALTER TABLE `data_temp` DISABLE KEYS */;
INSERT INTO `data_temp` VALUES (2,'2018-09-15','Bensin mobil box',50000,'1','o','belum',''),(3,'2018-09-15','Bensin PKL',20000,'1','o','belum',''),(5,'2018-09-15','Beli Galon',10000,'1','o','belum',''),(6,'2018-09-14','Beli Galon Dua',10000,'1','o','belum',''),(7,'2018-09-16','Pendapatan Internet',200000,'1','i','belum','');
/*!40000 ALTER TABLE `data_temp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `data_transaksi`
--

DROP TABLE IF EXISTS `data_transaksi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `data_transaksi` (
  `id_transaksi` int(11) NOT NULL AUTO_INCREMENT,
  `no_transaksi` varchar(225) NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` text NOT NULL,
  `nominal` int(11) NOT NULL,
  `id_account` text NOT NULL,
  `DK` enum('D','K') NOT NULL,
  `id_temp` varchar(225) NOT NULL,
  `ekstra` text NOT NULL,
  PRIMARY KEY (`id_transaksi`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data_transaksi`
--

LOCK TABLES `data_transaksi` WRITE;
/*!40000 ALTER TABLE `data_transaksi` DISABLE KEYS */;
INSERT INTO `data_transaksi` VALUES (1,'20180910.01','2018-09-10','Pembayaran akses internet',200000,'1','D','',''),(2,'20180910.01','2018-09-10','Pembayaran akses internet',1000000,'34','K','',''),(3,'20180910.01','2018-09-10','Pembayaran akses internet',800000,'2','D','',''),(4,'20180910.02','2018-09-10','Bayar Listrik',100000,'55','D','',''),(5,'20180910.02','2018-09-10','Bayar Listrik',100000,'1','K','',''),(16,'20180912.00','2018-09-12','Setor Modal',50000000,'1','D','',''),(17,'20180912.00','2018-09-12','Setor Modal',50000000,'30','K','',''),(20,'20180912.01','2018-09-12','Beli Air Grid',10000000,'11','D','',''),(21,'20180912.01','2018-09-12','Beli Air Grid',10000000,'1','K','',''),(22,'20180912.02','2018-09-12','Gaji karyawan',2000000,'62','D','',''),(23,'20180912.02','2018-09-12','Gaji karyawan',2000000,'19','K','',''),(24,'20180912.03','2018-09-12','Penjualan Batre Laptop (lx-00012312312)',250000,'1','D','',''),(25,'20180912.03','2018-09-12','Penjualan Batre Laptop (lx-00012312312)',250000,'37','K','',''),(26,'20180912.04','2018-09-12','Bayar Air',2000000,'55','D','',''),(27,'20180912.04','2018-09-12','Bayar Air',2000000,'2','K','',''),(32,'20180913.00','2018-09-13','Transaksi Percobaan',1000000,'41','D','',''),(33,'20180913.00','2018-09-13','Transaksi Percobaan',1000000,'1','K','',''),(38,'20180913.01','2018-09-13','Beli Galon',10000,'64','D','',''),(39,'20180913.01','2018-09-13','Beli Galon',10000,'1','K','',''),(40,'20180913.02','2018-09-13','Bensin mobil box',50000,'4','D','',''),(41,'20180913.02','2018-09-13','Bensin mobil box',50000,'1','K','',''),(54,'20180915.00','2018-09-15','Bayar AIR',100000,'55','D','',''),(55,'20180915.00','2018-09-15','Bayar AIR',100000,'1','K','','');
/*!40000 ALTER TABLE `data_transaksi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jenis_account`
--

DROP TABLE IF EXISTS `jenis_account`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jenis_account` (
  `id_jenis_account` int(3) NOT NULL AUTO_INCREMENT,
  `jenis_account` varchar(50) NOT NULL,
  `id_master_jenis_account` varchar(225) NOT NULL,
  PRIMARY KEY (`id_jenis_account`),
  KEY `jenis_account` (`jenis_account`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jenis_account`
--

LOCK TABLES `jenis_account` WRITE;
/*!40000 ALTER TABLE `jenis_account` DISABLE KEYS */;
INSERT INTO `jenis_account` VALUES (1,'ASET LANCAR','1'),(2,'ASET TETAP','1'),(3,'KEWAJIBAN LANCAR','2'),(4,'KEWAJIBAN JANGKA PANJANG','2'),(5,'EKUITAS','3'),(6,'PENDAPATAN USAHA','4'),(7,'PENDAPATAN LAIN LAIN','4'),(8,'BIAYA','5');
/*!40000 ALTER TABLE `jenis_account` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `master_jenis_account`
--

DROP TABLE IF EXISTS `master_jenis_account`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `master_jenis_account` (
  `id_master_jenis_account` int(11) NOT NULL AUTO_INCREMENT,
  `master_jenis_account` varchar(225) NOT NULL,
  PRIMARY KEY (`id_master_jenis_account`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `master_jenis_account`
--

LOCK TABLES `master_jenis_account` WRITE;
/*!40000 ALTER TABLE `master_jenis_account` DISABLE KEYS */;
INSERT INTO `master_jenis_account` VALUES (1,'ASSET'),(2,'KEWAJIBAN'),(3,'EKUITAS'),(4,'PENDAPATAN'),(5,'BIAYA');
/*!40000 ALTER TABLE `master_jenis_account` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `master_login`
--

DROP TABLE IF EXISTS `master_login`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `master_login` (
  `id_user` varchar(11) NOT NULL,
  `nama_user` varchar(30) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `level` enum('ADMINISTRASI','ACCOUNTING','BILLING','MARKETING','LABELING_ADMIN','LABELING_TEKNISI','ACCOUNTING_ADMIN','ACCOUNTING_KASIR','TOKO','CHRISTELLA','ADMIN_MARKETING','TEKNISI','PENJADWALAN') NOT NULL,
  `ekstra` varchar(150) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `master_login`
--

LOCK TABLES `master_login` WRITE;
/*!40000 ALTER TABLE `master_login` DISABLE KEYS */;
INSERT INTO `master_login` VALUES ('1','Accounting','accounting','accounting','ACCOUNTING',''),('2','Administrasi','admin','admin','ACCOUNTING_ADMIN','');
/*!40000 ALTER TABLE `master_login` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-09-17  9:35:09
