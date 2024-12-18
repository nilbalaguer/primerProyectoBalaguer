CREATE DATABASE  IF NOT EXISTS `batabase` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `batabase`;
-- MySQL dump 10.13  Distrib 8.0.38, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: batabase
-- ------------------------------------------------------
-- Server version	9.0.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `clientes`
--

DROP TABLE IF EXISTS `clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `clientes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `usuario` varchar(20) NOT NULL,
  `contrasenya` varchar(100) NOT NULL,
  `administrador` int DEFAULT NULL,
  `codigopostal` int DEFAULT NULL,
  `telefono` int DEFAULT NULL,
  `localidad` varchar(45) DEFAULT NULL,
  `calle` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes`
--

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` VALUES (4,'Núria Vilardell Timoneda','nuria','$2y$10$2rWOKhXSk75rjpMZ9nuVNORuPJv1H16zPxM7/nOsskNQLFjTwc9gK',NULL,25005,654432876,'Lleida','Carrer major Nº1'),(5,'Nil Balaguer Fernandez','nil','$2y$10$Cei4ASDEsySIVHXn56.B6uWED3wwQT1uasD3z19THX7p6/5UsraMS',NULL,8620,765432987,'Sant Vicenç dels Horts','Casa Nº1'),(14,'admin','admin','$2y$10$8MWToSCzxv0vOOlhATwWcOSiiwS5hWjSL9e4hewV0vu1qdFeQ6O0e',1,0,0,'','');
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `descuentos`
--

DROP TABLE IF EXISTS `descuentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `descuentos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `codigo` int DEFAULT NULL,
  `porcentaje` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `descuentos`
--

LOCK TABLES `descuentos` WRITE;
/*!40000 ALTER TABLE `descuentos` DISABLE KEYS */;
INSERT INTO `descuentos` VALUES (1,87532,15);
/*!40000 ALTER TABLE `descuentos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `historial`
--

DROP TABLE IF EXISTS `historial`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `historial` (
  `id` int NOT NULL AUTO_INCREMENT,
  `accion` varchar(45) NOT NULL,
  `id_usuario` int NOT NULL,
  `fecha` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_usuario_idx` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=117 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `historial`
--

LOCK TABLES `historial` WRITE;
/*!40000 ALTER TABLE `historial` DISABLE KEYS */;
INSERT INTO `historial` VALUES (5,'StartSession',4,'2024-12-02 18:58:51'),(6,'FinalitzarCompra',4,'2024-12-02 19:01:20'),(7,'CloseSession',4,'2024-12-02 19:01:26'),(8,'StartSession',4,'2024-12-02 20:10:26'),(9,'StartSession',4,'2024-12-03 15:47:00'),(10,'CloseSession',4,'2024-12-03 19:14:18'),(11,'StartSession',4,'2024-12-04 17:15:49'),(12,'CloseSession',4,'2024-12-04 17:18:26'),(13,'StartSession',6,'2024-12-04 17:18:49'),(14,'CloseSession',6,'2024-12-04 17:31:50'),(15,'StartSession',4,'2024-12-04 17:43:17'),(16,'FinalitzarCompra',4,'2024-12-04 17:43:42'),(17,'FinalitzarCompra',4,'2024-12-04 18:44:08'),(18,'FinalitzarCompra',4,'2024-12-04 19:03:53'),(19,'CloseSession',4,'2024-12-04 20:24:52'),(20,'StartSession',4,'2024-12-09 15:19:06'),(21,'FinalitzarCompra',4,'2024-12-09 15:43:59'),(22,'FinalitzarCompra',4,'2024-12-09 15:46:43'),(23,'FinalitzarCompra',4,'2024-12-09 15:52:42'),(24,'CloseSession',4,'2024-12-09 19:01:01'),(25,'StartSession',5,'2024-12-09 19:01:05'),(26,'FinalitzarCompra',5,'2024-12-09 19:01:33'),(27,'FinalitzarCompra',5,'2024-12-09 19:05:10'),(28,'FinalitzarCompra',5,'2024-12-09 19:17:36'),(29,'FinalitzarCompra',5,'2024-12-09 19:57:07'),(30,'StartSession',5,'2024-12-10 16:16:29'),(31,'CloseSession',5,'2024-12-10 16:17:54'),(32,'CreateUser:',0,'2024-12-10 16:38:56'),(33,'CreateUser:',0,'2024-12-10 16:40:46'),(34,'CreateUser:',0,'2024-12-10 16:42:33'),(35,'CreateUser:',0,'2024-12-10 16:43:43'),(36,'CreateUser:',0,'2024-12-10 16:44:29'),(37,'StartSession',4,'2024-12-10 16:44:54'),(38,'CreateUser:admin',0,'2024-12-10 17:13:00'),(39,'StartSession',14,'2024-12-10 17:31:29'),(40,'CloseSession',14,'2024-12-10 17:33:02'),(41,'StartSession',5,'2024-12-10 17:33:07'),(42,'StartSession',14,'2024-12-10 17:33:41'),(43,'CloseSession',14,'2024-12-10 17:36:20'),(44,'CreateUser:admin',0,'2024-12-10 17:36:58'),(45,'StartSession',14,'2024-12-10 17:37:05'),(46,'CloseSession',14,'2024-12-10 17:37:43'),(47,'StartSession',15,'2024-12-10 17:37:49'),(48,'CloseSession',15,'2024-12-10 17:38:02'),(49,'CreateUser:raul',0,'2024-12-10 17:46:16'),(50,'StartSession',16,'2024-12-10 17:46:31'),(51,'StartSession',14,'2024-12-10 17:50:49'),(52,'CloseSession',14,'2024-12-10 17:56:02'),(53,'StartSession',16,'2024-12-10 17:56:13'),(54,'CloseSession',16,'2024-12-10 17:57:27'),(55,'StartSession',5,'2024-12-10 17:57:51'),(56,'CloseSession',5,'2024-12-10 17:57:58'),(57,'StartSession',4,'2024-12-10 17:58:04'),(58,'CloseSession',4,'2024-12-10 18:53:06'),(59,'StartSession',14,'2024-12-10 18:53:15'),(60,'CloseSession',14,'2024-12-10 18:58:39'),(61,'StartSession',14,'2024-12-10 19:00:20'),(62,'StartSession',4,'2024-12-11 16:16:13'),(63,'StartSession',14,'2024-12-11 16:17:33'),(64,'StartSession',4,'2024-12-11 16:20:51'),(65,'StartSession',14,'2024-12-11 19:11:33'),(66,'FinalitzarCompra',14,'2024-12-11 19:17:32'),(67,'StartSession',5,'2024-12-11 19:32:28'),(68,'StartSession',14,'2024-12-11 19:39:10'),(69,'CloseSession',14,'2024-12-11 19:41:38'),(70,'StartSession',4,'2024-12-12 16:16:17'),(71,'CloseSession',4,'2024-12-12 16:35:12'),(72,'StartSession',4,'2024-12-12 16:35:19'),(73,'StartSession',5,'2024-12-12 16:36:17'),(74,'CreateUser:raul',0,'2024-12-12 16:55:30'),(75,'CreateUser:raul',0,'2024-12-12 16:59:42'),(76,'StartSession',17,'2024-12-12 16:59:48'),(77,'StartSession',17,'2024-12-12 17:14:00'),(78,'CloseSession',17,'2024-12-12 17:14:06'),(79,'StartSession',14,'2024-12-12 17:14:18'),(80,'CloseSession',14,'2024-12-12 17:16:31'),(81,'StartSession',4,'2024-12-12 17:16:41'),(82,'CloseSession',4,'2024-12-12 18:35:51'),(83,'StartSession',5,'2024-12-12 18:36:11'),(84,'StartSession',14,'2024-12-13 18:34:58'),(85,'CloseSession',14,'2024-12-13 18:47:38'),(86,'StartSession',5,'2024-12-13 18:47:43'),(87,'FinalitzarCompra',5,'2024-12-13 18:52:59'),(88,'CloseSession',5,'2024-12-13 19:33:43'),(89,'StartSession',14,'2024-12-13 19:33:57'),(90,'StartSession',18,'2024-12-13 19:37:19'),(91,'FinalitzarCompra',18,'2024-12-13 19:38:06'),(92,'StartSession',14,'2024-12-13 19:38:21'),(93,'CloseSession',14,'2024-12-13 19:43:19'),(94,'StartSession',5,'2024-12-13 19:43:34'),(95,'StartSession',4,'2024-12-16 17:18:37'),(96,'StartSession',14,'2024-12-16 17:31:26'),(97,'StartSession',5,'2024-12-16 17:57:02'),(98,'StartSession',4,'2024-12-17 15:29:03'),(99,'StartSession',14,'2024-12-17 15:29:37'),(100,'CloseSession',14,'2024-12-17 16:23:00'),(101,'StartSession',5,'2024-12-17 16:23:09'),(102,'StartSession',14,'2024-12-17 17:05:34'),(103,'StartSession',4,'2024-12-17 19:05:32'),(104,'FinalitzarCompra',4,'2024-12-17 19:05:52'),(105,'StartSession',14,'2024-12-18 16:38:04'),(106,'CloseSession',14,'2024-12-18 17:14:30'),(107,'StartSession',4,'2024-12-18 17:14:55'),(108,'FinalitzarCompra',4,'2024-12-18 17:15:33'),(109,'CloseSession',4,'2024-12-18 17:28:20'),(110,'StartSession',5,'2024-12-18 17:28:24'),(111,'StartSession',14,'2024-12-18 17:29:07'),(112,'CloseSession',14,'2024-12-18 17:29:32'),(113,'CreateUser:Basura_Humana',0,'2024-12-18 17:30:50'),(114,'StartSession',20,'2024-12-18 17:31:07'),(115,'StartSession',14,'2024-12-18 17:31:43'),(116,'StartSession',4,'2024-12-18 17:40:38');
/*!40000 ALTER TABLE `historial` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pedidos`
--

DROP TABLE IF EXISTS `pedidos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pedidos` (
  `id_cliente` int DEFAULT NULL,
  `id_pedido` int NOT NULL AUTO_INCREMENT,
  `id_descuento` int DEFAULT NULL,
  `localidad` varchar(32) DEFAULT NULL,
  `codigopostal` int DEFAULT NULL,
  `calle` varchar(32) DEFAULT NULL,
  `nombre` varchar(32) DEFAULT NULL,
  `telefono` int DEFAULT NULL,
  `precio` decimal(5,2) DEFAULT NULL,
  PRIMARY KEY (`id_pedido`),
  KEY `id_cliente_idx` (`id_cliente`),
  CONSTRAINT `id_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pedidos`
--

LOCK TABLES `pedidos` WRITE;
/*!40000 ALTER TABLE `pedidos` DISABLE KEYS */;
INSERT INTO `pedidos` VALUES (5,64,87532,'Sant Vicenç dels Horts',8620,'Casa Nº1','Nil Balaguer Fernandez',765432987,23.10),(4,67,0,'Lleida',25005,'Carrer major Nº1','Núria Vilardell Timoneda',654432876,50.60),(4,68,87532,'Lleida',25005,'Carrer major Nº1','Núria Vilardell Timoneda',654432876,27.50);
/*!40000 ALTER TABLE `pedidos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `productos`
--

DROP TABLE IF EXISTS `productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `productos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text,
  `precio` decimal(10,2) DEFAULT NULL,
  `imagen` varchar(100) NOT NULL,
  `categoria` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productos`
--

LOCK TABLES `productos` WRITE;
/*!40000 ALTER TABLE `productos` DISABLE KEYS */;
INSERT INTO `productos` VALUES (20,'Extreme Craft Double','Doble de carne con cheddar, sabor extremo',10.00,'extremecraftdouble','hamburgesa,vedella,bbq'),(21,'Amanida Craft','Una fresca amanida',11.00,'amanida','grass,basura'),(22,'Cubell de Nuggets x24','24 Nuggets deliciosos de pollastre arrebosat',12.00,'cubellnuggets','complements,pollo'),(23,'Quart de Craft','La classica i simple Quart de Craft, Conte lactosa i gluten',9.00,'quartdecraft','hamburgesa,vedella'),(24,'Bigcraft','guapa nuria, Conte gluten',10.00,'bigcraft','hamburgesa,vedella'),(25,'Patates Fregides','Les clasiques patates fregides',5.00,'patatas','complements'),(26,'Pollo Mayo Craft','La Clasica i deliciosa hamburgesa de pollastre, Conte gluten',7.00,'pollomayocraft','hamburgesa,pollo'),(32,'Quart de Craft Double','Conte lactosa i gluten',10.00,'cuartdecraftdoble','vedella'),(38,'Craft Crispy Double','Conte lactosa i gluten',10.00,'craftcrispydouble','pollo,hamburgesa'),(39,'Craft Crispy BBQ ','Conte lactosa i gluten',12.00,'CraftCrispy_BBQ_Bacon_Doble','hamburgesa,pollo,bbq'),(40,'Intense Chedar Craft','Conte lactosa i gluten',12.00,'CraftIntenseChedar','hamburgesa,vedella'),(41,'Craft Wrap Pollo','Conte gluten',9.00,'craftwrappollo','pollo,hamburgesa'),(42,'Craft Fries Deluxe','Patates amb Formatge i Bacon per sobre, Conte lactosa',7.00,'top-fries-deluxe','complements'),(44,'Gazpacho','Un refrescant Gazpacho',7.00,'gazpacho','complements,begudes'),(45,'Craft Flurry KitKat','Un delicios gelat de KitKat, Conte gluten i lactosa',5.00,'craftflurrykitkat','postres'),(47,'Craft Flurry Lotus','Un delicios gelat de galetes lotus, Conte gluten i lactosa',5.00,'McFlurry_Lotus','postres'),(48,'Sundae Choco','Gelat de xocolata, Ideal per als amants del caco, Conte lactosa',5.00,'sundaechoco','postres'),(49,'Sundae Caramel','Gelat de Carmel, Ideal per als amants del sucre. Conte  lactosa',5.00,'sundaecaramelo','postres'),(50,'CocaCola','La Famosa Beguda de CocaCola Company',3.00,'cocacola','begudes'),(51,'Fanta','La Famosa Beguda de taronja',3.00,'fanta','begudes'),(54,'Aigua 50cl','La Clasica i aburrida ampolla d\'aigua',4.00,'aigua','begudes');
/*!40000 ALTER TABLE `productos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `productos_pedidos`
--

DROP TABLE IF EXISTS `productos_pedidos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `productos_pedidos` (
  `id_pedido` int DEFAULT NULL,
  `id_producto` int DEFAULT NULL,
  KEY `id_pedido_idx` (`id_pedido`),
  KEY `id_producto_idx` (`id_producto`),
  CONSTRAINT `id_pedido` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`id_pedido`),
  CONSTRAINT `id_producto` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productos_pedidos`
--

LOCK TABLES `productos_pedidos` WRITE;
/*!40000 ALTER TABLE `productos_pedidos` DISABLE KEYS */;
INSERT INTO `productos_pedidos` VALUES (64,23),(64,22),(67,32),(67,45),(67,42),(67,22),(67,51),(67,41),(68,45),(68,38),(68,42),(68,51);
/*!40000 ALTER TABLE `productos_pedidos` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-12-18 19:44:46
