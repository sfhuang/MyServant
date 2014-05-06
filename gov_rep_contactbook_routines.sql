CREATE DATABASE  IF NOT EXISTS `gov_rep_contactbook` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `gov_rep_contactbook`;
-- MySQL dump 10.13  Distrib 5.5.16, for Win32 (x86)
--
-- Host: www.uisltsc.com.tw    Database: gov_rep_contactbook
-- ------------------------------------------------------
-- Server version	5.0.41-community-nt

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
-- Not dumping tablespaces as no INFORMATION_SCHEMA.FILES table on this server
--

--
-- Temporary table structure for view `village_legislator2`
--

DROP TABLE IF EXISTS `village_legislator2`;
/*!50001 DROP VIEW IF EXISTS `village_legislator2`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `village_legislator2` (
  `legislator_election_district_id` int(11),
  `legislator_election_district_name` varchar(45),
  `village_id` int(11),
  `legislator_name` varchar(45),
  `legislator_id` int(11),
  `party_id` smallint(6)
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `village_legislator`
--

DROP TABLE IF EXISTS `village_legislator`;
/*!50001 DROP VIEW IF EXISTS `village_legislator`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `village_legislator` (
  `legislator_election_district_id` int(11),
  `legislator_election_district_name` varchar(45),
  `village_id` int(11),
  `legislator_name` varchar(45),
  `party_id` smallint(6)
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `village_legislator3`
--

DROP TABLE IF EXISTS `village_legislator3`;
/*!50001 DROP VIEW IF EXISTS `village_legislator3`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `village_legislator3` (
  `legislator_election_district_id` int(11),
  `legislator_election_district_name` varchar(45),
  `village_id` int(11),
  `legislator_name` varchar(45),
  `legislator_id` int(11),
  `party_id` smallint(6),
  `underattack` tinyint(1)
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Final view structure for view `village_legislator2`
--

/*!50001 DROP TABLE IF EXISTS `village_legislator2`*/;
/*!50001 DROP VIEW IF EXISTS `village_legislator2`*/;
/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `village_legislator2` AS select `lel`.`legislator_election_district_id` AS `legislator_election_district_id`,`lel`.`legislator_election_district_name` AS `legislator_election_district_name`,`vl`.`village_id` AS `village_id`,`ll`.`legislator_name` AS `legislator_name`,`ll`.`legislator_id` AS `legislator_id`,`ll`.`party_id` AS `party_id` from ((`legislator_list` `LL` join `village_list` `VL`) join `legislator_election_district_list` `LEL`) where ((`ll`.`legislator_election_district_id` = `vl`.`legislator_election_district_id`) and (`ll`.`legislator_election_district_id` = `lel`.`legislator_election_district_id`)) */;

--
-- Final view structure for view `village_legislator`
--

/*!50001 DROP TABLE IF EXISTS `village_legislator`*/;
/*!50001 DROP VIEW IF EXISTS `village_legislator`*/;
/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `village_legislator` AS select `lel`.`legislator_election_district_id` AS `legislator_election_district_id`,`lel`.`legislator_election_district_name` AS `legislator_election_district_name`,`vl`.`village_id` AS `village_id`,`ll`.`legislator_name` AS `legislator_name`,`ll`.`party_id` AS `party_id` from ((`legislator_list` `LL` join `village_list` `VL`) join `legislator_election_district_list` `LEL`) where ((`ll`.`legislator_election_district_id` = `vl`.`legislator_election_district_id`) and (`ll`.`legislator_election_district_id` = `lel`.`legislator_election_district_id`)) */;

--
-- Final view structure for view `village_legislator3`
--

/*!50001 DROP TABLE IF EXISTS `village_legislator3`*/;
/*!50001 DROP VIEW IF EXISTS `village_legislator3`*/;
/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `village_legislator3` AS select `lel`.`legislator_election_district_id` AS `legislator_election_district_id`,`lel`.`legislator_election_district_name` AS `legislator_election_district_name`,`vl`.`village_id` AS `village_id`,`ll`.`legislator_name` AS `legislator_name`,`ll`.`legislator_id` AS `legislator_id`,`ll`.`party_id` AS `party_id`,`ll`.`underattack` AS `underattack` from ((`legislator_list` `LL` join `village_list` `VL`) join `legislator_election_district_list` `LEL`) where ((`ll`.`legislator_election_district_id` = `vl`.`legislator_election_district_id`) and (`ll`.`legislator_election_district_id` = `lel`.`legislator_election_district_id`)) */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-05-06 23:03:50
