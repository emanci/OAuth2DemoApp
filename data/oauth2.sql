-- MySQL dump 10.13  Distrib 5.7.12, for osx10.9 (x86_64)
--
-- Host: localhost    Database: oauth2_app
-- ------------------------------------------------------
-- Server version	5.7.13

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
-- Table structure for table `oauth_access_tokens`
--

DROP TABLE IF EXISTS `oauth_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth_access_tokens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` varchar(255) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `access_token` varchar(512) NOT NULL,
  `scope` varchar(45) DEFAULT NULL,
  `expires` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_access_tokens`
--

LOCK TABLES `oauth_access_tokens` WRITE;
/*!40000 ALTER TABLE `oauth_access_tokens` DISABLE KEYS */;
INSERT INTO `oauth_access_tokens` VALUES (1,'demoapp',NULL,'1f9401fa842ba731571a81f4bcb58e60306d314c',NULL,'2016-12-07 22:02:04'),(2,'demoapp',NULL,'310cf34fb444a95482b7bab0cd2afa10f1d7f6ff',NULL,'2016-12-07 22:03:28'),(3,'demoapp',NULL,'36f92674715828432d654885e75872a4eb7e2981',NULL,'2016-12-07 22:07:13'),(4,'demoapp',NULL,'8a0f874f59dfd421ec5b39484c3e175b8694319e',NULL,'2016-12-07 22:15:49'),(5,'demoapp',NULL,'17c46c28b12ab5c87861ef3852bd221b08a3e927',NULL,'2016-12-07 22:16:58'),(6,'demoapp',NULL,'51802e50592ef1a9e0e29d72d49a868361de8988',NULL,'2016-12-07 22:32:01'),(7,'demoapp',NULL,'56878cf98a600cb0440f6dd78d79f59f26ac4594',NULL,'2016-12-07 22:33:38'),(8,'demoapp',NULL,'3c7b46b544987ce8f071d4bf23138cc25effbfc3',NULL,'2016-12-07 22:35:06'),(9,'demoapp',NULL,'f4bc32896793e41454d490037d33ff1d81ea418a',NULL,'2016-12-07 22:35:39'),(10,'demoapp',NULL,'15f5d18bd1fd63f3e0d4a6b42201485123d893fc',NULL,'2016-12-07 22:41:24'),(11,'demoapp',NULL,'bb4885c69c36e35c9e046ae3f82179dc6cf2ae16',NULL,'2016-12-07 22:41:50'),(12,'demoapp',NULL,'0f73892580d0541e0551021dcf1ed0a3ab3ea860',NULL,'2016-12-07 22:43:30'),(13,'demoapp',NULL,'b8d1b4f5cdaed2f2380174790940d494af3c4ce1',NULL,'2016-12-07 22:45:11'),(14,'demoapp',NULL,'1453a62416896307f9db341541514a4011b36506',NULL,'2016-12-07 22:47:56'),(15,'demoapp',NULL,'4185e5726eed7b78073649d4dace7ac241d9032b',NULL,'2016-12-07 22:48:25'),(16,'demoapp',NULL,'cccd50cc8769ad313e0423fc7fd08511bcfa9e5a',NULL,'2016-12-07 22:48:43'),(17,'demoapp',NULL,'610a5b17e57bcd7fb199e4824f9c93a8e94e3a28',NULL,'2016-12-07 22:49:19'),(18,'demoapp',NULL,'b87858c952a143fbddf38a5ef3e33909d6aa3e53',NULL,'2016-12-07 22:53:06'),(19,'demoapp',NULL,'3b137b85d0400ea25a554a795495de09e94dcfb8',NULL,'2016-12-07 22:58:31'),(20,'demoapp',NULL,'fbff424589ca02a636773df3a7d438fdf9bdcf3d',NULL,'2016-12-07 22:59:01'),(21,'demoapp',NULL,'576256b879cd12917cf0b088d07f0b8b6e34cd97',NULL,'2016-12-07 23:28:27'),(22,'demoapp',NULL,'d7741eef11fe4064332906a04521753d3b5965a7',NULL,'2016-12-07 23:29:24'),(23,'demoapp',NULL,'57b176a1cc9ae5d14336a2d26196d502edee1777',NULL,'2016-12-07 23:32:39'),(24,'demoapp',NULL,'1a66b06eeb0a7906c988ef113eb0c02245170f8c',NULL,'2016-12-07 23:33:59'),(25,'demoapp',NULL,'54047992d3017f821b7f9e3fd9d282bd83b5b94a',NULL,'2016-12-07 23:37:15'),(26,'demoapp',NULL,'a41caf7d81641cc8aa71937b93bccd93e6657a08',NULL,'2016-12-07 23:38:03'),(27,'demoapp',NULL,'22957946e8f0001b22e212d6da3c438771c3ba82',NULL,'2016-12-07 23:40:44'),(28,'demoapp',NULL,'25ac97b204ba8e5ed7556c890df4c1f3641aa1b2',NULL,'2016-12-07 23:41:19'),(29,'demoapp',NULL,'76b357ba7b8b0f5b4558b2e400fbb84493ddf87b',NULL,'2016-12-07 23:41:54'),(30,'demoapp',NULL,'11e5a9c11d2dae1dd68b91cd5ea8f211ed1ed78a',NULL,'2016-12-07 23:45:23'),(31,'demoapp',NULL,'c92d92d011aac56c15729d4cf971b66190a3dd40',NULL,'2016-12-07 23:47:27'),(32,'demoapp',NULL,'154536b43e63d3705b9320684a360e05f0055756',NULL,'2016-12-07 23:48:21'),(33,'demoapp',NULL,'89ead95ce83027288218650bcfb08c3cd3a6527f',NULL,'2016-12-07 23:49:15'),(34,'demoapp',NULL,'1a9136b977a6a7e0563b6ec67a23c743cb567cd7',NULL,'2016-12-07 23:49:56'),(35,'demoapp',NULL,'0f0536a58f5db24df926c324953d895e98fb1c76',NULL,'2016-12-07 23:50:23'),(36,'demoapp',NULL,'720d818cc85f98325f42a65844073e95cfda97e6',NULL,'2016-12-07 23:53:59'),(37,'demoapp',NULL,'e020361d6f3bdfaae59f2af74f3aca2d4c7f7f9a',NULL,'2016-12-07 23:55:58'),(38,'demoapp',NULL,'0a4f2e948d8b30795cff94ab053b737ee5e476b4',NULL,'2016-12-07 23:56:20'),(39,'demoapp',NULL,'69da7f8bd0b847552d761f5ffafda4af91a3b234',NULL,'2016-12-07 23:57:04'),(40,'demoapp',NULL,'df189f1335f29451b1bd55ee43d8447397101a19',NULL,'2016-12-07 23:59:08'),(41,'demoapp',NULL,'655b7f2ca9d81c6749f334a963841eb794c9cef6',NULL,'2016-12-08 00:00:02'),(42,'demoapp',NULL,'964592ae1f67c1436623aa0c71bad706836521d8',NULL,'2016-12-08 00:30:28'),(43,'demoapp',NULL,'948ce3b572b475b3e8e517c762143d45eae20a4c',NULL,'2016-12-08 00:31:28'),(44,'demoapp',NULL,'640baaefb5d5d162b285594909847cb0ec6cb1f2',NULL,'2016-12-08 00:31:50'),(45,'demoapp',NULL,'40a5dc13c9fe5f26eb43f48287589c8477b0f60a',NULL,'2016-12-08 00:34:45'),(46,'demoapp',NULL,'76e7d8488b3678c0b414fbfbe8190d4df4c8e3bb',NULL,'2016-12-08 22:58:30'),(47,'demoapp',NULL,'48685951b22a62591062a98c5cc111e3828971dd',NULL,'2016-12-08 22:58:51'),(48,'demoapp',NULL,'96f5d08bef7604497a768839a2018e5042e3e923',NULL,'2016-12-08 23:03:37'),(49,'demoapp',NULL,'cd6af7e92754f8fa5dda6e8aaf508f52a1897201',NULL,'2016-12-08 23:30:24'),(50,'demoapp',NULL,'df3111fc5c4505a32c68f9f089f1940f98edf460',NULL,'2016-12-09 00:08:54');
/*!40000 ALTER TABLE `oauth_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_authorization_codes`
--

DROP TABLE IF EXISTS `oauth_authorization_codes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth_authorization_codes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `authorization_code` varchar(128) NOT NULL,
  `client_id` varchar(255) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `redirect_uri` varchar(128) NOT NULL,
  `id_token` varchar(1000) DEFAULT NULL,
  `scope` varchar(45) DEFAULT NULL,
  `expires` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_authorization_codes`
--

LOCK TABLES `oauth_authorization_codes` WRITE;
/*!40000 ALTER TABLE `oauth_authorization_codes` DISABLE KEYS */;
INSERT INTO `oauth_authorization_codes` VALUES (9,'3a8093f176234f12af98eaa56bd31d817df9fdb7','demoapp',NULL,'http://local.oauth2.com/oauth2/client/receive_authcode',NULL,NULL,'2016-12-07 22:14:49'),(10,'1eb1d0438774fe0cea26a6c7680188ceb12df2ed','demoapp',NULL,'http://local.oauth2.com/oauth2/client/receive_authcode',NULL,NULL,'2016-12-07 22:16:15'),(11,'3ce682650a2e5adcbc686e7d08cb6992c83641a0','demoapp',NULL,'http://local.oauth2.com/oauth2/client/receive_authcode',NULL,NULL,'2016-12-07 22:16:49'),(12,'71c430898f9db1232a834a400feef0930ca1c5ee','demoapp',NULL,'http://local.oauth2.com/oauth2/client/receive_authcode',NULL,NULL,'2016-12-07 22:20:27'),(13,'341c69af150403da1365d03e998c9bd2985b2ac7','demoapp',NULL,'http://local.oauth2.com/oauth2/client/receive_authcode',NULL,NULL,'2016-12-07 22:21:25'),(14,'01a8692030f425511da264add336bad4025fa906','demoapp',NULL,'http://local.oauth2.com/oauth2/client/receive_authcode',NULL,NULL,'2016-12-07 22:21:31'),(15,'d5a81f52dfa775ef5ca636d224081d84e414a8a7','demoapp',NULL,'http://local.oauth2.com/oauth2/client/receive_authcode',NULL,NULL,'2016-12-07 22:25:01'),(16,'36c28429ea705ecc7bad4c22c55f6b244987c2dd','demoapp',NULL,'http://local.oauth2.com/oauth2/client/receive_authcode',NULL,NULL,'2016-12-07 22:25:14'),(17,'329e8614626299b445afc77b795d37d27fcf8f4b','demoapp',NULL,'http://local.oauth2.com/oauth2/client/receive_authcode',NULL,NULL,'2016-12-07 22:26:57'),(18,'386720ada5edf7f8295a3700f8574b846a6c80c8','demoapp',NULL,'http://local.oauth2.com/oauth2/client/receive_authcode',NULL,NULL,'2016-12-07 22:27:23'),(19,'11b9cd5e712cd72c193dcf4266c108d4ae894ec7','demoapp',NULL,'http://local.oauth2.com/oauth2/client/receive_authcode',NULL,NULL,'2016-12-07 22:28:44'),(41,'ff89c30e76a947e31b041385f33d3b2ccae7d0b4','demoapp',NULL,'http://local.oauth2.com/oauth2/client/receive_authcode',NULL,NULL,'2016-12-07 23:01:43'),(42,'bf5940d8caf4a2a7e000eff959f9fc5708881ebc','demoapp',NULL,'http://local.oauth2.com/oauth2/client/receive_authcode',NULL,NULL,'2016-12-07 23:19:11'),(48,'312990cb552fffe836ac8a9500ae6a573fdfee82','demoapp2',NULL,'http://local.oauth2.com/oauth2/client/receive_authcode?show_refresh_token=1',NULL,NULL,'2016-12-08 23:10:34'),(49,'e3ce4e160d734fee6fe713dde3c82dd54766d127','demoapp2',NULL,'http://local.oauth2.com/oauth2/client/receive_authcode?show_refresh_token=1',NULL,NULL,'2016-12-08 23:16:08'),(50,'a6d055d9c885726cf33b11db40995c0675fec2d0','demoapp2',NULL,'http://local.oauth2.com/oauth2/client/receive_authcode?show_refresh_token=1',NULL,NULL,'2016-12-08 23:16:31');
/*!40000 ALTER TABLE `oauth_authorization_codes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_clients`
--

DROP TABLE IF EXISTS `oauth_clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth_clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` varchar(255) NOT NULL,
  `client_secret` varchar(255) NOT NULL,
  `redirect_uri` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_clients`
--

LOCK TABLES `oauth_clients` WRITE;
/*!40000 ALTER TABLE `oauth_clients` DISABLE KEYS */;
INSERT INTO `oauth_clients` VALUES (1,'demoapp','demopass','http://local.oauth2.com/oauth2/client/receive_authcode'),(2,'demoapp2','demopass2','http://local.oauth2.com/oauth2/client/receive_authcode?show_refresh_token=1');
/*!40000 ALTER TABLE `oauth_clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_public_keys`
--

DROP TABLE IF EXISTS `oauth_public_keys`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth_public_keys` (
  `id` int(11) NOT NULL,
  `client_id` varchar(255) NOT NULL,
  `public_key` varchar(255) NOT NULL,
  `private_key` varchar(255) NOT NULL,
  `encryption_algorithm` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_public_keys`
--

LOCK TABLES `oauth_public_keys` WRITE;
/*!40000 ALTER TABLE `oauth_public_keys` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_public_keys` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_refresh_tokens`
--

DROP TABLE IF EXISTS `oauth_refresh_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth_refresh_tokens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `refresh_token` varchar(512) NOT NULL,
  `client_id` varchar(255) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `scope` varchar(45) DEFAULT NULL,
  `expires` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_refresh_tokens`
--

LOCK TABLES `oauth_refresh_tokens` WRITE;
/*!40000 ALTER TABLE `oauth_refresh_tokens` DISABLE KEYS */;
INSERT INTO `oauth_refresh_tokens` VALUES (1,'59a09cfad381dda8bb48851bcb3da319308a5f88','demoapp',NULL,NULL,'2016-12-21 21:02:04'),(2,'da166229ab8afbbeef5cfcbb6c1933bd4274bd09','demoapp',NULL,NULL,'2016-12-21 21:03:28'),(3,'10bff45ede9e3b16bf1d7cc9cd60e4a7a65951f4','demoapp',NULL,NULL,'2016-12-21 21:07:13'),(4,'b468d3a6d39d90b561562ca7d477415fd6e8a053','demoapp',NULL,NULL,'2016-12-21 21:15:49'),(5,'466fb489948a0f87161f82400695ff58ab0e8ad5','demoapp',NULL,NULL,'2016-12-21 21:16:58'),(6,'3fbd98791a25d94a6cf1ff28473aa0b5b7868228','demoapp',NULL,NULL,'2016-12-21 21:32:01'),(7,'8cd446f510916e18f1e64dfc38c3909f6ed150ee','demoapp',NULL,NULL,'2016-12-21 21:33:38'),(8,'1415e04edfa5a7aa2e59bd6103b3f00d8749bc2f','demoapp',NULL,NULL,'2016-12-21 21:35:06'),(9,'a73f8bd2a65c4a88514ec1f6dbb95c63234586a4','demoapp',NULL,NULL,'2016-12-21 21:35:39'),(10,'2fe31e0faf468e3f791b015d0a5b7c7127e928f1','demoapp',NULL,NULL,'2016-12-21 21:41:24'),(11,'7e2d460cb70b612d453c6617e0c3ea9099f703db','demoapp',NULL,NULL,'2016-12-21 21:41:50'),(12,'269dbd643d49dd04030230519001e8b9fe1d78d3','demoapp',NULL,NULL,'2016-12-21 21:43:30'),(13,'fab7c6a6ff792ccf6ddccb16f50e57bb1dd7832e','demoapp',NULL,NULL,'2016-12-21 21:45:11'),(14,'49b09a4e49ee702046fdb1e93b59144f1af97c8d','demoapp',NULL,NULL,'2016-12-21 21:47:56'),(15,'00e8be4652015e6683fd2971a9eff8c1b6114e13','demoapp',NULL,NULL,'2016-12-21 21:48:25'),(16,'7565af001122c6d2384626c01b6a0fd81709bf92','demoapp',NULL,NULL,'2016-12-21 21:48:43'),(17,'af4e32b0a5c20d6c383d248b55c9682f7998691b','demoapp',NULL,NULL,'2016-12-21 21:49:19'),(18,'ad84d981d6001a8e0e3d9718d39f10a7b39e8efa','demoapp',NULL,NULL,'2016-12-21 21:53:06'),(19,'cb95a6b2d367d8e9b2b299aad2af0bb03e85c325','demoapp',NULL,NULL,'2016-12-21 21:58:31'),(20,'2b290782cbd3fbdcc2fab80ce725584fd2cea0ee','demoapp',NULL,NULL,'2016-12-21 21:59:01'),(21,'e0cc662f7d034d39826092f5a05ba7381293b002','demoapp',NULL,NULL,'2016-12-21 22:28:27'),(22,'69e9c771af5c3ed01d7515df89cf867250fae901','demoapp',NULL,NULL,'2016-12-21 22:29:24'),(23,'d849222aedc0c10d2b54c49a86181028c07c6066','demoapp',NULL,NULL,'2016-12-21 22:32:39'),(24,'b84e38eea191f2e0afc343b1d5d0e3e5949fe547','demoapp',NULL,NULL,'2016-12-21 22:33:59'),(25,'d24cc71f6a2878004f571bd36d34e65ab67def33','demoapp',NULL,NULL,'2016-12-21 22:37:15'),(26,'521418928aaae13b6efc5a75f3c5036d494d7eac','demoapp',NULL,NULL,'2016-12-21 22:38:03'),(27,'5690694fb04e4dc9dd7af1256196bb3aeca70394','demoapp',NULL,NULL,'2016-12-21 22:40:44'),(28,'09c14d9ea07e243c10030af3557e77ed10c71f56','demoapp',NULL,NULL,'2016-12-21 22:41:19'),(29,'5d090b63ecfecab78951c18beac3f8a26a3f4e71','demoapp',NULL,NULL,'2016-12-21 22:41:54'),(30,'f8277fa00a97ccf6a23ab39e6e0a5d069fe1ae75','demoapp',NULL,NULL,'2016-12-21 22:45:23'),(31,'b6ca83b108e950b410025801f312611dbc71c042','demoapp',NULL,NULL,'2016-12-21 22:47:27'),(32,'2ec7728a33f6e8b33f3631641078e0c3c0426c34','demoapp',NULL,NULL,'2016-12-21 22:48:21'),(33,'f441780159d8b3f39e9e9c5990094bf4dd8b0452','demoapp',NULL,NULL,'2016-12-21 22:49:15'),(34,'e602c239232691768cdf22ce950631fa23d53964','demoapp',NULL,NULL,'2016-12-21 22:49:56'),(35,'68868871d1e40ef0e4f789d6c7ce65039a90070c','demoapp',NULL,NULL,'2016-12-21 22:50:23'),(36,'ac587df889517813396dba3bd04406b13a51c011','demoapp',NULL,NULL,'2016-12-21 22:53:59'),(37,'d5983e5869175a05e962152b3e3db0af688e17cf','demoapp',NULL,NULL,'2016-12-21 22:55:58'),(38,'b1c39d53956ca5ef482b7e74768a6664a9bd8568','demoapp',NULL,NULL,'2016-12-21 22:56:20'),(39,'ae1f688960fff73ab39662bf3e9f70a56daaf1ca','demoapp',NULL,NULL,'2016-12-21 22:57:04'),(40,'c8727fffab731af6dd0342b6278a13bee8bf3f9b','demoapp',NULL,NULL,'2016-12-21 22:59:08'),(41,'d28c6a0ed7086cfd5c1e9cfd1d7270835871eca9','demoapp',NULL,NULL,'2016-12-21 23:00:02'),(42,'e612b8bbd735ff86ff74116442a715764fc2eabf','demoapp',NULL,NULL,'2016-12-21 23:30:28'),(43,'7bf2713cf8fb267f5d8d530156220b4a6d90b01d','demoapp',NULL,NULL,'2016-12-21 23:31:28'),(44,'4c3b8fcf0bad81f22b5998be15955d5b5402f72b','demoapp',NULL,NULL,'2016-12-21 23:31:50'),(45,'fe1adb1edc6203ee15fb6496ba6428f3d3a116e0','demoapp',NULL,NULL,'2016-12-21 23:34:45'),(46,'4b771c0d68cdaf2745b6cfc272928f03b1fbddfb','demoapp',NULL,NULL,'2016-12-22 21:58:30'),(47,'68dc7542e6761688a7b7690bd6310766319e2c13','demoapp',NULL,NULL,'2016-12-22 21:58:51'),(48,'c997a08e08cbb411d60dba4e72cba666b469a632','demoapp',NULL,NULL,'2016-12-22 22:03:37'),(49,'cd461e27f54916a085cb72d10be2944ace51916b','demoapp',NULL,NULL,'2016-12-22 22:30:24'),(50,'9f6f53e7c57084c19605f263fa5955921c5a1f7a','demoapp',NULL,NULL,'2016-12-22 23:08:54');
/*!40000 ALTER TABLE `oauth_refresh_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_scopes`
--

DROP TABLE IF EXISTS `oauth_scopes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth_scopes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `scope` varchar(45) DEFAULT NULL,
  `is_default` blob NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_scopes`
--

LOCK TABLES `oauth_scopes` WRITE;
/*!40000 ALTER TABLE `oauth_scopes` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_scopes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_users`
--

DROP TABLE IF EXISTS `oauth_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `first_name` varchar(128) NOT NULL,
  `last_name` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_users`
--

LOCK TABLES `oauth_users` WRITE;
/*!40000 ALTER TABLE `oauth_users` DISABLE KEYS */;
INSERT INTO `oauth_users` VALUES (1,'emanci','12345qwert','phil','pu');
/*!40000 ALTER TABLE `oauth_users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-12-14 20:20:04
