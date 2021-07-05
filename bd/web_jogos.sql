-- MySQL dump 10.13  Distrib 5.7.34, for Linux (x86_64)
--
-- Host: localhost    Database: web_jogos
-- ------------------------------------------------------
-- Server version	5.7.34-0ubuntu0.18.04.1

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
-- Dumping data for table `categoria`
--

LOCK TABLES `categoria` WRITE;
/*!40000 ALTER TABLE `categoria` DISABLE KEYS */;
INSERT INTO `categoria` VALUES (1,'PS4'),(2,'PS5'),(3,'Luta'),(4,'Corrida'),(5,'Esporte'),(6,'RPG');
/*!40000 ALTER TABLE `categoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `contato`
--

LOCK TABLES `contato` WRITE;
/*!40000 ALTER TABLE `contato` DISABLE KEYS */;
INSERT INTO `contato` VALUES (1,'Rômulo Ferreira Mesquita','romulo.mesquita@unincor.edu.br','erwre'),(2,'Teste','r.ofc@hotmail.com','tetetetetet\r\n');
/*!40000 ALTER TABLE `contato` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `jogo`
--

LOCK TABLES `jogo` WRITE;
/*!40000 ALTER TABLE `jogo` DISABLE KEYS */;
INSERT INTO `jogo` VALUES (20,'GTA 5','Jogo de ação e aventura, mundo aberto',_binary 'paginas/uploads/52aab8b588bb1b5ad94f5f72c58b6dd5jpeg'),(21,'Need For Speed','Jogo de corridas clandestinas.',_binary 'paginas/uploads/4e48d2d8ba99464f2f6b1b58a8b8d071jpeg'),(22,'FIFA 21','Jogo de futebol',_binary 'paginas/uploads/e98c591090394a35411fb802c1f71d6a.jpg');
/*!40000 ALTER TABLE `jogo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `jogo_categoria`
--

LOCK TABLES `jogo_categoria` WRITE;
/*!40000 ALTER TABLE `jogo_categoria` DISABLE KEYS */;
INSERT INTO `jogo_categoria` VALUES (20,1),(21,1),(20,2),(21,4),(22,5);
/*!40000 ALTER TABLE `jogo_categoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'web_jogos'
--

--
-- Dumping routines for database 'web_jogos'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-07-05 18:48:50
