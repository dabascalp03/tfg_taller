CREATE DATABASE  IF NOT EXISTS `todomotor` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `todomotor`;
-- MySQL dump 10.13  Distrib 8.0.36, for Win64 (x86_64)
--
-- Host: localhost    Database: todomotor
-- ------------------------------------------------------
-- Server version	8.0.36

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
-- Table structure for table `blog_posts`
--

DROP TABLE IF EXISTS `blog_posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `blog_posts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `author_name` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `image_path` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog_posts`
--

LOCK TABLES `blog_posts` WRITE;
/*!40000 ALTER TABLE `blog_posts` DISABLE KEYS */;
INSERT INTO `blog_posts` VALUES (1,'Nueva marca de aceite asociada a TodoMotor','A partir del día 30/03/2025 utilizaremos Castrol por el mismo precio en nuestros cambios de aceite.\r\nNo se lo pierdan, un saludo desde su taller de confianza!','David Abascal - Jefe de Taller','2025-03-27 14:14:02','2025-03-27 14:19:08',NULL),(2,'Nuevo proyecto en camino','Desde TodoMotor queremos anunciarles que estén atentos al apartado de noticias de nuestra web porque dentro de poco daremos códigos de descuento para las revisiones que realicen en nuestro taller.\r\nUn saludo!','Alejandro Abascal - Mecánico','2025-03-27 14:17:18','2025-03-27 14:17:18',NULL),(8,'Cómo Saber si Tus Frenos Necesitan un Cambio Urgente','1. Ruidos Extraños al Frenar\r\n¿Escuchas un chillido o rechinido cuando pisas el freno? Este sonido es causado generalmente por el desgaste de las pastillas. Si el ruido evoluciona a un chirrido metálico, es posible que las pastillas hayan alcanzado su límite y estén dañando los discos.\r\n\r\n2. Vibraciones en el Pedal de Freno\r\nSi sientes que el pedal vibra o tiembla al frenar, puede ser una señal de discos deformados. Esto afecta la eficiencia del frenado y debe corregirse de inmediato.\r\n\r\n3. Pedal de Freno Más Suave o Más Duro de lo Normal\r\nSi notas que el pedal está muy suave y se hunde demasiado o, al contrario, se siente inusualmente duro, es una señal de problemas en el sistema hidráulico o en el servofreno.','David Abascal - Jefe de Taller','2025-04-11 07:20:53','2025-04-11 07:20:53','blog_images/xIeB1Xe3UtfojPAOTq0wAQd3ZoafJoNITCB9Qlke.gif'),(9,'Los Modelos de Coches Más Memorables del Cine','1. DeLorean DMC-12 – “Volver al Futuro”\r\nEste coche no solo es un vehículo; es una máquina del tiempo. El DeLorean DMC-12, con sus puertas estilo \"ala de gaviota\" y su diseño futurista, se convirtió en un ícono gracias a las aventuras de Marty McFly y Doc Brown.\r\n\r\n2. Ford Mustang GT 390 – “Bullitt”\r\nEl Ford Mustang conducido por Steve McQueen en Bullitt redefinió las persecuciones en coche en el cine. Su estilo deportivo y su rugido característico en las calles de San Francisco lo convirtieron en un símbolo de acción y adrenalina.\r\n\r\n3. Aston Martin DB5 – “James Bond”\r\nEste clásico británico ha acompañado a James Bond en múltiples películas, comenzando con Goldfinger. Con gadgets como asientos eyectables y ametralladoras ocultas, el DB5 representa el glamour y la intriga del espía más famoso del cine.\r\n\r\n4. Chevrolet Camaro – “Transformers”\r\nEl Camaro amarillo conocido como Bumblebee saltó a la fama gracias a la saga Transformers. Su personalidad y transformación en un robot amistoso lo hacen inolvidable tanto para los fans de los coches como de la ciencia ficción.\r\n\r\n5. Dodge Charger R/T – “Fast & Furious”\r\nDominic Toretto no sería el mismo sin su Dodge Charger, que aparece en múltiples entregas de la franquicia Fast & Furious. Su combinación de fuerza bruta y velocidad lo convierten en un emblema de la familia y la acción desenfrenada.\r\n\r\n6. Mini Cooper – “The Italian Job”\r\nPequeño pero poderoso, el Mini Cooper demostró ser el coche perfecto para persecuciones en espacios reducidos en The Italian Job. Su maniobrabilidad y carisma hicieron de él un protagonista inesperado.','Alejandro Abascal - Mecánico','2025-04-11 07:24:52','2025-04-11 07:24:52','blog_images/4sdDDDDxB8sywewGEytJslgzsmM13sJ6gGaugkLS.gif'),(10,'¿Qué Significan las Luces de Advertencia en el Tablero de tu Coche?','El tablero de tu coche es como un traductor de lo que sucede bajo el capó. Las luces de advertencia no están ahí para decorar, sino para alertarte de posibles problemas o recordarte tareas importantes de mantenimiento. ¿Qué significa cada una? Aquí te lo explicamos.\r\n\r\n1. Luz de Motor (Check Engine)\r\n¿Qué indica? Problemas en el sistema de motor o emisiones.\r\n\r\nQué hacer: Puede ser desde algo menor como un sensor defectuoso hasta un fallo más grave. Lleva tu coche al taller para un diagnóstico adecuado.\r\n\r\n2. Luz de Presión de Aceite\r\n¿Qué indica? La presión del aceite es demasiado baja.\r\n\r\nQué hacer: Detén el coche de inmediato y revisa el nivel de aceite. Si está bajo, rellénalo; si persiste, llama a un profesional.\r\n\r\n3. Luz de Temperatura del Motor\r\n¿Qué indica? El motor se está sobrecalentando.\r\n\r\nQué hacer: Apaga el motor y deja que se enfríe. Verifica el nivel de refrigerante, pero nunca lo abras mientras está caliente.\r\n\r\n4. Luz de Batería\r\n¿Qué indica? Problemas en el sistema eléctrico, como una batería descargada o alternador defectuoso.\r\n\r\nQué hacer: Asegúrate de que los cables de la batería estén bien conectados. Si la luz permanece encendida, consulta a un mecánico.\r\n\r\n5. Luz de Frenos\r\n¿Qué indica? Problemas en el sistema de frenos o bajo nivel de líquido de frenos.\r\n\r\nQué hacer: Detén el coche de manera segura y revisa el líquido de frenos. Si está normal, busca asesoramiento mecánico lo antes posible.\r\n\r\n6. Luz de Presión de Neumáticos (TPMS)\r\n¿Qué indica? Alguno de los neumáticos tiene presión baja.\r\n\r\nQué hacer: Verifica la presión de todos los neumáticos y ajústala según las recomendaciones del fabricante.\r\n\r\n7. Luz de Airbag\r\n¿Qué indica? Problemas en el sistema de airbags.\r\n\r\nQué hacer: Lleva tu coche al taller, ya que un fallo en el sistema podría impedir que los airbags funcionen en caso de accidente.\r\n\r\n8. Luz de Combustible\r\n¿Qué indica? Bajo nivel de combustible.\r\n\r\nQué hacer: Es bastante simple: encuentra una gasolinera antes de quedarte varado en la carretera.\r\n\r\n9. Luz de Control de Tracción\r\n¿Qué indica? El control de tracción está desactivado o hay un problema en el sistema.\r\n\r\nQué hacer: Si no lo apagaste manualmente, consulta a un taller para una revisión.','David Abascal - Jefe de Taller','2025-04-11 07:31:02','2025-04-11 07:31:02',NULL),(11,'10 Consejos para Preparar tu Coche Antes de un Viaje Largo','Los viajes largos son emocionantes, pero para que todo salga bien, debes asegurarte de que tu coche esté en perfectas condiciones. Aquí te dejamos 10 consejos indispensables para evitar problemas en carretera y disfrutar de tu aventura al máximo.\r\n\r\n1. Verifica el Nivel de Aceite\r\nEl aceite del motor es fundamental para su correcto funcionamiento. Antes de salir, revisa su nivel y asegúrate de que esté dentro del rango adecuado. Si está cerca de necesitar un cambio, hazlo antes de tu viaje.\r\n\r\n2. Revisa el Sistema de Frenos\r\nLos frenos son esenciales para tu seguridad. Escucha si hacen algún ruido extraño y verifica el nivel de líquido de frenos. Si tienes dudas sobre su estado, consulta a un mecánico.\r\n\r\n3. Revisa la Presión y el Estado de los Neumáticos\r\nUnos neumáticos en buen estado y con la presión correcta son fundamentales para la estabilidad y el consumo de combustible. No olvides comprobar la rueda de repuesto por si la necesitas.\r\n\r\n4. Comprueba el Nivel de Refrigerante\r\nEl sistema de refrigeración evita que el motor se sobrecaliente. Asegúrate de que el nivel de refrigerante sea el correcto y que no haya fugas.\r\n\r\n5. Inspecciona las Luces\r\nRevisa que todas las luces funcionen correctamente: faros, intermitentes, luces de freno y las luces de emergencia. Esto garantiza visibilidad y comunicación con otros conductores.\r\n\r\n6. Examina la Batería\r\nUna batería descargada podría arruinar tu viaje antes de empezar. Revisa que los terminales estén limpios y conectados correctamente, y asegúrate de que la batería esté cargada.\r\n\r\n7. Llena el Depósito de Combustible\r\nEsto puede parecer obvio, pero asegurarte de empezar con el depósito lleno es fundamental. Investiga las estaciones de servicio en la ruta para evitar quedarte sin combustible en zonas alejadas.\r\n\r\n8. Revisa los Documentos del Vehículo\r\nAsegúrate de llevar todos los papeles necesarios: licencia de conducir, seguro, tarjeta de circulación, y comprobante de pago de peajes, si aplica.\r\n\r\n9. Empaca un Kit de Emergencia\r\nIncluye herramientas básicas, triángulos de emergencia, un botiquín, linterna y cables de arranque. Esto te permitirá estar preparado para imprevistos.\r\n\r\n10. Programa una Inspección en el Taller\r\nAntes de emprender tu viaje, es recomendable realizar una revisión general en un taller confiable. Los mecánicos pueden detectar posibles problemas que tú podrías pasar por alto.','Alejandro Abascal - Mecánico','2025-04-11 07:34:37','2025-04-11 07:34:37','blog_images/gavkWHqfTLmimIaMXU1TbphVZ1QWSttOomYkKFEz.jpg');
/*!40000 ALTER TABLE `blog_posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `citas`
--

DROP TABLE IF EXISTS `citas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `citas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `usuario_id` int NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `servicio` varchar(255) NOT NULL,
  `creado_en` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `usuario_id` (`usuario_id`),
  CONSTRAINT `citas_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `citas`
--

LOCK TABLES `citas` WRITE;
/*!40000 ALTER TABLE `citas` DISABLE KEYS */;
INSERT INTO `citas` VALUES (18,7,'2025-05-28','08:30:00','Consulta','2025-05-26 08:59:04'),(22,7,'2025-05-29','10:30:00','Consulta','2025-05-27 09:03:07');
/*!40000 ALTER TABLE `citas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coches`
--

DROP TABLE IF EXISTS `coches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `coches` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_usuario` int NOT NULL,
  `marca` varchar(50) NOT NULL,
  `modelo` varchar(50) NOT NULL,
  `anio` int NOT NULL,
  `matricula` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `matricula` (`matricula`),
  KEY `id_usuario` (`id_usuario`),
  CONSTRAINT `coches_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coches`
--

LOCK TABLES `coches` WRITE;
/*!40000 ALTER TABLE `coches` DISABLE KEYS */;
INSERT INTO `coches` VALUES (1,4,'Toyota','Celica',2005,'8345DEF'),(2,4,'Audi','RS3',2015,'7589JPF'),(4,7,'Mini','Cooper S',2019,'6327JPS'),(5,7,'Toyota','Corolla',2018,'ABC123'),(6,7,'Honda','Civic',2020,'DEF456'),(7,10,'Ford','Focus',2017,'GHI789'),(8,10,'Chevrolet','Malibu',2019,'JKL012'),(9,11,'Nissan','Altima',2021,'MNO345'),(10,11,'Mazda','CX-5',2022,'PQR678'),(11,12,'Volkswagen','Golf',2016,'STU901'),(12,12,'Hyundai','Elantra',2024,'VWX234'),(14,11,'Fiat','Punto',2005,'7238TFG'),(15,7,'Mini','Cooper D',2005,'6273JPG'),(16,10,'Peugeot','207',2007,'8392GFX'),(17,4,'Suzuki','Swift Sport',2023,'8392MJS'),(18,10,'Peugeot','3008',2021,'8273JOS'),(21,10,'Volkswagen','Golf GTI',2023,'6372 MNL'),(22,11,'Volkswagen','Golf R',2023,'9372 MDD'),(23,21,'Audi','A4',2003,'alksfjkla'),(24,12,'Renault','Clio',2022,'6732JLK'),(25,7,'Mercedes','Vito',1995,'8645 GHS'),(26,7,'Volkswagen','Polo',2009,'9302 HJS'),(28,21,'Nissan','Silvia',2002,'7382 DFG'),(29,11,'Seat','Ibiza',2002,'8938FGS'),(30,7,'Ejemplo','Video',2000,'6837TGS');
/*!40000 ALTER TABLE `coches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `diagnosticos`
--

DROP TABLE IF EXISTS `diagnosticos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `diagnosticos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `usuario_id` int NOT NULL,
  `coche_id` int NOT NULL,
  `archivo` varchar(255) NOT NULL,
  `tipo_archivo` enum('imagen','video') NOT NULL,
  `estado` enum('pendiente','en revisión','completado') DEFAULT 'pendiente',
  `diagnostico` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `usuario_id` (`usuario_id`),
  KEY `coche_id` (`coche_id`),
  CONSTRAINT `diagnosticos_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
  CONSTRAINT `diagnosticos_ibfk_2` FOREIGN KEY (`coche_id`) REFERENCES `coches` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `diagnosticos`
--

LOCK TABLES `diagnosticos` WRITE;
/*!40000 ALTER TABLE `diagnosticos` DISABLE KEYS */;
/*!40000 ALTER TABLE `diagnosticos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `facturas`
--

DROP TABLE IF EXISTS `facturas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `facturas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_coche` int NOT NULL,
  `id_reparacion` int NOT NULL,
  `monto` decimal(10,2) NOT NULL,
  `fecha` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_coche` (`id_coche`),
  KEY `id_reparacion` (`id_reparacion`),
  CONSTRAINT `facturas_ibfk_1` FOREIGN KEY (`id_coche`) REFERENCES `coches` (`id`) ON DELETE CASCADE,
  CONSTRAINT `facturas_ibfk_2` FOREIGN KEY (`id_reparacion`) REFERENCES `reparaciones` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=135 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `facturas`
--

LOCK TABLES `facturas` WRITE;
/*!40000 ALTER TABLE `facturas` DISABLE KEYS */;
INSERT INTO `facturas` VALUES (1,4,27,450.00,'2025-03-02 23:00:00'),(2,2,2,25.00,'2025-03-02 23:00:00'),(19,4,27,150.00,'2024-02-15 23:00:00'),(20,5,28,300.50,'2024-03-01 23:00:00'),(21,6,29,120.75,'2024-02-20 23:00:00'),(22,7,30,200.00,'2024-03-05 23:00:00'),(23,8,31,180.50,'2024-03-08 23:00:00'),(24,9,32,230.00,'2024-03-10 23:00:00'),(25,10,33,99.99,'2024-03-12 23:00:00'),(26,11,34,400.00,'2024-03-15 23:00:00'),(88,1,51,320.00,'2025-04-09 22:00:00'),(89,2,52,450.00,'2025-04-11 22:00:00'),(90,4,53,200.00,'2025-04-14 22:00:00'),(91,5,54,150.00,'2025-04-16 22:00:00'),(92,6,55,500.00,'2025-04-19 22:00:00'),(93,7,56,100.00,'2025-04-21 22:00:00'),(94,8,57,300.00,'2025-04-24 22:00:00'),(95,9,58,250.00,'2025-04-26 22:00:00'),(96,10,59,180.00,'2025-04-29 22:00:00'),(97,11,60,120.00,'2025-05-01 22:00:00'),(98,1,61,50.00,'2025-05-03 22:00:00'),(99,2,62,80.00,'2025-05-05 22:00:00'),(100,4,63,60.00,'2025-05-07 22:00:00'),(101,5,64,350.00,'2025-05-09 22:00:00'),(102,6,65,220.00,'2025-05-11 22:00:00'),(103,7,66,400.00,'2025-05-13 22:00:00'),(104,8,67,90.00,'2025-05-15 22:00:00'),(105,9,68,270.00,'2025-05-17 22:00:00'),(106,10,69,130.00,'2025-05-19 22:00:00'),(107,11,70,600.00,'2025-05-21 22:00:00'),(108,1,51,320.00,'2025-04-09 22:00:00'),(109,2,52,450.00,'2025-04-11 22:00:00'),(110,4,53,200.00,'2025-04-14 22:00:00'),(111,5,54,150.00,'2025-04-16 22:00:00'),(112,6,55,500.00,'2025-04-19 22:00:00'),(113,7,56,100.00,'2025-04-21 22:00:00'),(114,8,57,300.00,'2025-04-24 22:00:00'),(115,9,58,250.00,'2025-04-26 22:00:00'),(116,10,59,180.00,'2025-04-29 22:00:00'),(117,11,60,120.00,'2025-05-01 22:00:00'),(118,1,61,50.00,'2025-05-03 22:00:00'),(119,2,62,80.00,'2025-05-05 22:00:00'),(120,4,63,60.00,'2025-05-07 22:00:00'),(121,5,64,350.00,'2025-05-09 22:00:00'),(122,6,65,220.00,'2025-05-11 22:00:00'),(123,7,66,400.00,'2025-05-13 22:00:00'),(124,8,67,90.00,'2025-05-15 22:00:00'),(125,9,68,270.00,'2025-05-17 22:00:00'),(126,10,69,130.00,'2025-05-19 22:00:00'),(127,11,70,600.00,'2025-05-21 22:00:00'),(129,4,63,250.00,'2025-03-18 16:49:30');
/*!40000 ALTER TABLE `facturas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `likes`
--

DROP TABLE IF EXISTS `likes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `likes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `restauracion_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `restauracion_id` (`restauracion_id`),
  CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
  CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`restauracion_id`) REFERENCES `restauraciones` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `likes`
--

LOCK TABLES `likes` WRITE;
/*!40000 ALTER TABLE `likes` DISABLE KEYS */;
INSERT INTO `likes` VALUES (34,11,5,'2025-04-28 11:56:23','2025-04-28 11:56:23'),(35,11,13,'2025-05-06 06:15:03','2025-05-06 06:15:03'),(36,11,8,'2025-05-06 06:15:06','2025-05-06 06:15:06'),(37,11,7,'2025-05-06 06:15:11','2025-05-06 06:15:11'),(44,10,5,'2025-05-15 05:21:59','2025-05-15 05:21:59'),(45,10,7,'2025-05-15 05:22:01','2025-05-15 05:22:01'),(47,10,6,'2025-05-15 05:26:20','2025-05-15 05:26:20'),(51,10,13,'2025-05-15 06:06:58','2025-05-15 06:06:58'),(53,7,8,'2025-05-26 05:54:36','2025-05-26 05:54:36'),(55,7,5,'2025-05-26 06:22:00','2025-05-26 06:22:00'),(57,7,9,'2025-05-26 06:35:52','2025-05-26 06:35:52'),(64,7,13,'2025-05-27 06:47:42','2025-05-27 06:47:42');
/*!40000 ALTER TABLE `likes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `matriculas`
--

DROP TABLE IF EXISTS `matriculas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `matriculas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_usuario` int NOT NULL,
  `tipo_matricula` varchar(50) NOT NULL,
  `numero_matricula` varchar(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `numero_matricula` (`numero_matricula`),
  KEY `id_usuario` (`id_usuario`),
  CONSTRAINT `matriculas_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `matriculas`
--

LOCK TABLES `matriculas` WRITE;
/*!40000 ALTER TABLE `matriculas` DISABLE KEYS */;
INSERT INTO `matriculas` VALUES (4,10,'hibrida','0928 JUS','2025-03-25 14:12:25','2025-03-25 14:12:25'),(6,7,'hibrida','5241 ABC','2025-04-14 05:09:29','2025-04-14 05:09:29'),(7,7,'hibrida','7262 GHS','2025-04-14 05:10:39','2025-04-14 05:10:39'),(8,7,'hibrida','3825 DFG','2025-04-14 14:29:46','2025-04-14 14:29:46'),(9,7,'alfa_romeo','3585 DFG','2025-04-14 14:52:45','2025-04-14 14:52:45'),(10,26,'estandar','7382 HJK','2025-05-05 06:19:05','2025-05-05 06:19:05'),(12,10,'hibrida','0593 HJI','2025-05-15 07:20:16','2025-05-15 07:20:16'),(13,7,'estandar','6372 TYD','2025-05-26 06:45:12','2025-05-26 06:45:12'),(14,7,'hibrida','3425 DFG','2025-05-27 06:44:38','2025-05-27 06:44:38'),(15,7,'estandar','0504 DBS','2025-05-27 07:09:18','2025-05-27 07:09:18');
/*!40000 ALTER TABLE `matriculas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mensajes`
--

DROP TABLE IF EXISTS `mensajes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mensajes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `emisor_id` int NOT NULL,
  `receptor_id` int NOT NULL,
  `mensaje` text NOT NULL,
  `fecha` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `leido` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `emisor_id` (`emisor_id`),
  KEY `receptor_id` (`receptor_id`),
  CONSTRAINT `mensajes_ibfk_1` FOREIGN KEY (`emisor_id`) REFERENCES `usuarios` (`id`),
  CONSTRAINT `mensajes_ibfk_2` FOREIGN KEY (`receptor_id`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mensajes`
--

LOCK TABLES `mensajes` WRITE;
/*!40000 ALTER TABLE `mensajes` DISABLE KEYS */;
INSERT INTO `mensajes` VALUES (12,7,16,'Buenas','2025-05-06 07:39:37','2025-05-06 05:46:50','2025-05-06 05:39:37',1),(13,10,16,'Hola buenas','2025-05-06 07:49:42','2025-05-15 07:24:45','2025-05-06 05:49:42',1),(14,11,16,'Buenos dias','2025-05-06 07:50:11','2025-05-06 05:50:44','2025-05-06 05:50:11',1),(15,16,7,'Hola muy buenas','2025-05-06 07:55:33','2025-05-07 04:55:22','2025-05-06 05:55:33',1),(17,16,11,'Buenas','2025-05-06 08:01:28','2025-05-06 06:10:18','2025-05-06 06:01:28',1),(18,11,16,'Tengo un problema','2025-05-06 08:10:36','2025-05-06 06:11:52','2025-05-06 06:10:36',1),(19,16,11,'Cuénteme','2025-05-06 08:12:11','2025-05-06 06:13:21','2025-05-06 06:12:11',1),(20,11,16,'Mi coche hace un ruido raro al arrancar','2025-05-06 08:13:39','2025-05-06 06:13:39','2025-05-06 06:13:39',0),(21,16,4,'Buenas','2025-05-06 14:17:53','2025-05-06 12:20:43','2025-05-06 12:17:53',1),(22,16,4,'Buenas','2025-05-06 14:18:16','2025-05-06 12:20:43','2025-05-06 12:18:16',1),(23,4,16,'Buenas','2025-05-06 14:21:18','2025-05-06 12:54:50','2025-05-06 12:21:18',1),(24,16,4,'Buenas','2025-05-06 14:54:55','2025-05-06 12:56:13','2025-05-06 12:54:55',1),(25,4,16,'hola','2025-05-06 14:56:19','2025-05-06 12:56:49','2025-05-06 12:56:19',1),(26,16,4,'buenas','2025-05-06 14:57:01','2025-05-06 12:57:01','2025-05-06 12:57:01',0),(27,12,18,'Buenas, mi clio esta haciendo un ruido raro al arrancar','2025-05-07 06:40:51','2025-05-07 04:41:40','2025-05-07 04:40:51',1),(28,18,12,'Hola buenas, ven con él al taller cuando puedas','2025-05-07 06:42:15','2025-05-07 04:42:15','2025-05-07 04:42:15',0),(29,16,7,'Prueba bandeja de entrada','2025-05-07 06:51:19','2025-05-07 04:55:22','2025-05-07 04:51:19',1),(30,7,16,'Prueba','2025-05-07 07:00:50','2025-05-07 05:01:29','2025-05-07 05:00:50',1),(31,16,7,'Prueba','2025-05-07 07:01:35','2025-05-13 04:43:46','2025-05-07 05:01:35',1),(32,7,16,'Ejemplo Video','2025-05-13 06:43:55','2025-05-13 04:48:00','2025-05-13 04:43:55',1),(33,16,7,'ejemplo video','2025-05-13 06:48:07','2025-05-13 04:48:07','2025-05-13 04:48:07',0),(34,10,16,'Hola','2025-05-15 07:26:53','2025-05-15 07:24:45','2025-05-15 05:26:53',1),(35,16,10,'Hola','2025-05-15 09:24:51','2025-05-15 07:24:51','2025-05-15 07:24:51',0),(36,7,18,'hola','2025-05-27 09:11:04','2025-05-27 07:11:04','2025-05-27 07:11:04',0);
/*!40000 ALTER TABLE `mensajes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2025_03_03_194243_add_timestamps_to_usuarios',2),(5,'2025_03_04_111944_create_services_table',3),(6,'2025_03_11_191746_create_restauraciones_table',4);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ofertas`
--

DROP TABLE IF EXISTS `ofertas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ofertas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `imagen` varchar(255) NOT NULL,
  `fecha_expedicion` date NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ofertas`
--

LOCK TABLES `ofertas` WRITE;
/*!40000 ALTER TABLE `ofertas` DISABLE KEYS */;
INSERT INTO `ofertas` VALUES (1,'Cambio de aceite + revisión general GRATIS','Cambio de aceite desde 110 € y llévate una revisión completa sin costo adicional.','ofertas/gTRGvZndDHG1rGFEsJlqlNEF2OYtRIk1NAovI9Iw.jpg','2025-05-28','2025-04-23 07:19:25'),(3,'Revisión de frenos GRATIS en Semana Santa','Viaja seguro: revisamos tus frenos gratis antes de salir a carretera.','ofertas/relvjPfzT5NyykdayhAWIJDQi7wHtq9qM3jxVN8R.jpg','2025-04-18','2025-04-23 07:36:33'),(4,'Servicio de aire acondicionado a precio especial','Carga de gas y limpieza de A/C por 150 €. ¡No sufras calor!','ofertas/2yVjRtiX4EASEfmyhFivqnISEAx7iq6DUainGpil.jpg','2025-07-31','2025-04-23 07:39:43'),(5,'Tarjeta de cliente premium','Acumula 5 años y a partir del 6to todo con 5% de descuento.','ofertas/YGh7XWqAMzxUzn1F4JFS88OCXNpN2PgKGMtnJSbA.png','2050-01-01','2025-04-23 08:00:47'),(7,'Rasca y gana con cada servicio','Cada vez que vengas, participa para ganar desde descuentos hasta un servicio gratuito.','ofertas/M0PbRgHvVwl2kxEiViis5S6NWoEbrr6FpQ5utPKX.png','2050-01-01','2025-04-23 09:04:39'),(8,'10% de descuento en tu primera visita','¡Bienvenido! Queremos que nos conozcas. 10% de descuento en tu primer servicio.','ofertas/6ZzMiCNYyj5nBMlGesacVgLloy2yKWgl18Q2V3gg.jpg','2050-01-01','2025-04-23 09:46:11');
/*!40000 ALTER TABLE `ofertas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reparaciones`
--

DROP TABLE IF EXISTS `reparaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reparaciones` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_coche` int NOT NULL,
  `id_mecanico` int DEFAULT NULL,
  `descripcion` text NOT NULL,
  `fecha` date NOT NULL,
  `estado` enum('pendiente','en proceso','finalizado') NOT NULL DEFAULT 'pendiente',
  PRIMARY KEY (`id`),
  KEY `id_coche` (`id_coche`),
  KEY `id_mecanico` (`id_mecanico`),
  CONSTRAINT `reparaciones_ibfk_1` FOREIGN KEY (`id_coche`) REFERENCES `coches` (`id`) ON DELETE CASCADE,
  CONSTRAINT `reparaciones_ibfk_2` FOREIGN KEY (`id_mecanico`) REFERENCES `usuarios` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reparaciones`
--

LOCK TABLES `reparaciones` WRITE;
/*!40000 ALTER TABLE `reparaciones` DISABLE KEYS */;
INSERT INTO `reparaciones` VALUES (1,1,4,'Alineación','2025-03-03','finalizado'),(2,2,4,'Cambio de Aceite','2025-03-03','finalizado'),(27,4,10,'Cambio de aceite y filtros','2024-02-15','finalizado'),(28,5,10,'Sustitución de frenos','2024-03-01','pendiente'),(29,6,10,'Alineación y balanceo','2024-02-20','finalizado'),(30,7,10,'Revisión general y cambio de bujías','2024-03-05','en proceso'),(31,8,10,'Cambio de batería','2024-03-08','finalizado'),(32,9,10,'Revisión del sistema de suspensión','2024-03-10','pendiente'),(33,10,10,'Diagnóstico de motor','2024-03-12','en proceso'),(34,11,10,'Cambio de correa de distribución','2024-03-15','finalizado'),(51,1,4,'Revisión del sistema de escape','2025-04-10','en proceso'),(52,2,4,'Cambio de frenos y pastillas','2025-04-12','pendiente'),(53,4,10,'Sustitución de la correa de distribución','2025-04-15','finalizado'),(54,5,10,'Revisión del sistema eléctrico','2025-04-17','en proceso'),(55,6,10,'Cambio de amortiguadores','2025-04-20','pendiente'),(56,7,10,'Limpieza de inyectores','2025-04-22','finalizado'),(57,8,10,'Revisión de la transmisión','2025-04-25','en proceso'),(58,9,10,'Cambio del sistema de refrigeración','2025-04-27','pendiente'),(59,10,10,'Reemplazo de la batería','2025-04-30','finalizado'),(60,11,10,'Revisión de la dirección asistida','2025-05-02','en proceso'),(61,1,4,'Cambio de filtros de aire','2025-05-04','pendiente'),(62,2,4,'Revisión del sistema de frenos','2025-05-06','en proceso'),(63,4,10,'Reemplazo de bujías','2025-05-08','finalizado'),(64,5,10,'Revisión del sistema de escape','2025-05-10','pendiente'),(65,6,10,'Cambio de correas auxiliares','2025-05-12','en proceso'),(66,7,10,'Revisión de la caja de cambios','2025-05-14','finalizado'),(67,8,10,'Limpieza del sistema de admisión','2025-05-16','pendiente'),(68,9,10,'Reemplazo de la bomba de agua','2025-05-18','en proceso'),(69,10,10,'Revisión del sistema de aire acondicionado','2025-05-20','finalizado'),(70,11,10,'Reemplazo del embrague','2025-05-22','pendiente'),(75,22,16,'cambio correa distribucion','2025-07-26','en proceso'),(77,28,18,'Purga completa del sistema para renovar el líquido de frenos.','2025-04-15','finalizado');
/*!40000 ALTER TABLE `reparaciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `restauraciones`
--

DROP TABLE IF EXISTS `restauraciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `restauraciones` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_cliente` int NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `imagen_antes` varchar(255) NOT NULL,
  `imagen_despues` varchar(255) NOT NULL,
  `estado` varchar(50) NOT NULL DEFAULT 'pendiente',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_restauraciones_usuarios` (`id_cliente`),
  CONSTRAINT `fk_restauraciones_usuarios` FOREIGN KEY (`id_cliente`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `restauraciones`
--

LOCK TABLES `restauraciones` WRITE;
/*!40000 ALTER TABLE `restauraciones` DISABLE KEYS */;
INSERT INTO `restauraciones` VALUES (2,7,'Golf r32','Rescaté esta joyita de su estado de abandono.','imagenes/antes/AiXZnYLg9XYAa2bNnXpvZWoAf8zvhnxPeqphkzGi.jpg','imagenes/despues/r4n7c5lmmG8ynQTWddz9OAkP7NxP8oGUGGOrhr1B.jpg','rechazado','2025-03-28 07:17:25','2025-04-11 06:34:07'),(4,4,'Fiat Punto','Rescaté el coche','imagenes/antes/nEO3htkoKfUaI6qAgBjaw27nROxaffmKj2gEuF3m.jpg','imagenes/despues/kmTHlpPJcAoOgpdXHJOPOcDhnf3D0NYjkoAhj9Df.jpg','rechazado','2025-03-28 07:39:38','2025-03-28 07:58:19'),(5,12,'BMW M3 E92','Un bmw que sorprendió a todos','imagenes/antes/1743151729_antes_bmw_m3_antes.png','imagenes/despues/1743151729_despues_bmw_m3_despues.png','aceptado','2025-03-28 07:48:49','2025-03-28 07:49:16'),(6,4,'Volkswagen Golf MK4','Tras encontrar este Golf en un garaje abandonado, le aplicamos un restyling completo.','imagenes/antes/1743152454_antes_golf_antes.png','imagenes/despues/1743152454_despues_golf_despues.png','aceptado','2025-03-28 08:00:54','2025-03-28 08:11:23'),(7,4,'MV Agusta F4','Encontré esta moto en una subasta y no me pude resistir a comprarla.','imagenes/antes/1743152563_antes_mv_agusta_antes.jpg','imagenes/despues/1743152563_despues_mv_agusta_despues.png','aceptado','2025-03-28 08:02:43','2025-03-28 08:11:32'),(8,4,'BMW E30','Un día en el campo acabó con un hallazgo increíble, tras mucho trabajo este BMW quedó como nuevo.','imagenes/antes/1743153034_antes_bmw_antes.png','imagenes/despues/1743153034_despues_bmw_despues.png','aceptado','2025-03-28 08:10:34','2025-03-28 08:11:39'),(9,4,'Renault 5 Turbo','Encontré este R5 en un garaje abandonado y decidí rescatarlo junto con unos amigos.','imagenes/antes/1744360817_antes_r5turboAntes.png','imagenes/despues/1744360817_despues_r5turboDespues.png','aceptado','2025-04-11 06:40:17','2025-04-11 06:40:44'),(13,26,'Abarth 595','Os muestro mi Abarth 595!','imagenes/antes/1746433061_antes_abarth.png','imagenes/despues/1746433061_despues_abarth2.png','aceptado','2025-05-05 06:17:41','2025-05-05 06:19:59'),(14,10,'Prueba','prueba','imagenes/antes/1747301500_antes_20250505_1009_Abarth 595 en Paisaje_remix_01jtfqtjc0evmtgzrn5a5msh51.png','imagenes/despues/1747301500_despues_A dark urban landscape with real cars, emphasizing mechanics and automotive themes, suitable for a PC wallpaper..png','rechazado','2025-05-15 07:31:40','2025-05-15 07:32:14'),(15,7,'ejemplo','Ejemplo','imagenes/antes/1748247830_antes_2.jpg','imagenes/despues/1748247830_despues_3.jpg','pendiente','2025-05-26 06:23:50','2025-05-26 06:23:50'),(16,7,'Ejemplo1','Ejemplo','imagenes/antes/1748248244_antes_8.jpg','imagenes/despues/1748248244_despues_9.jpg','pendiente','2025-05-26 06:30:44','2025-05-26 06:30:44'),(17,7,'ejemplo','prueba','imagenes/antes/1748248313_antes_20250429_1606_Peugeot 207 Restaurado_simple_compose_01jt0xwb82eeesk0g81y4d21hh.png','imagenes/despues/1748248313_despues_20250505_1007_Abarth 595 en Taller_remix_01jtfqpfktfvc823czaj4kc6yn.png','pendiente','2025-05-26 06:31:53','2025-05-26 06:31:53'),(18,7,'pruebass','kjndjkdankaj','imagenes/antes/1748248872_antes_20250502_1152_Lancia Delta Impecable_simple_compose_01jt86j0zhevxbq36jp5y5h6bz.png','imagenes/despues/1748248872_despues_r5turboDespues.png','pendiente','2025-05-26 06:41:12','2025-05-26 06:41:12'),(19,7,'pruebaaaas','pruebaaas','imagenes/antes/1748335831_antes_20250520_1955_Logo Invertido Naranja_remix_01jvqdb5w1e3gvfret4vdbnckt (1).png','imagenes/despues/1748335831_despues_20250520_1955_Logo Invertido Naranja_remix_01jvqdb5w1e3gvfret4vdbnckt.png','pendiente','2025-05-27 06:50:31','2025-05-27 06:50:31');
/*!40000 ALTER TABLE `restauraciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'admin'),(3,'cliente'),(2,'mecanico');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('Ncq7wrypCq40IgE38KTInoZFM2i6SHvrDW4FOtdo',NULL,'127.0.0.1','Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Mobile Safari/537.36 Edg/136.0.0.0','YToyOntzOjY6Il90b2tlbiI7czo0MDoiaXprc3F5Z2VmaGZhOExER3UwTUVIVlp3emRIa1NJbHluMDNIWFo2eiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319fQ==',1748337116),('u9W6Q23wwpz8LhwARXQnaCWBljPCNg6LOGOy6ZDb',7,'127.0.0.1','Mozilla/5.0 (iPhone; CPU iPhone OS 16_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.6 Mobile/15E148 Safari/604.1 Edg/136.0.0.0','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiRzJESThPVVNYZk9yN1VYQ2plWmpDYWNZcTJTSTZ4ZTk2bGV5MzY2RSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDQ6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC91c3VhcmlvL2NoYXQvbm8tbGVpZG9zIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Nzt9',1748339662);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `solicitud_vehiculos`
--

DROP TABLE IF EXISTS `solicitud_vehiculos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `solicitud_vehiculos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `marca` varchar(50) NOT NULL,
  `modelo` varchar(50) NOT NULL,
  `anio` int NOT NULL,
  `placa` varchar(10) NOT NULL,
  `estado` enum('pendiente','aprobado','rechazado') NOT NULL DEFAULT 'pendiente',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `placa` (`placa`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `solicitud_vehiculos_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `solicitud_vehiculos`
--

LOCK TABLES `solicitud_vehiculos` WRITE;
/*!40000 ALTER TABLE `solicitud_vehiculos` DISABLE KEYS */;
INSERT INTO `solicitud_vehiculos` VALUES (3,11,'Ferrari','458 Italia',2017,'6372JPP','rechazado','2025-03-25 07:37:38','2025-03-25 07:40:10'),(5,10,'Volkswagen','Passat',2015,'6372GTD','rechazado','2025-03-25 07:41:07','2025-03-25 07:42:42'),(11,7,'Renault','Megane',2007,'6822GTD','rechazado','2025-04-14 05:14:35','2025-04-24 05:48:25'),(14,26,'Seat','León',2017,'6371GHS','pendiente','2025-05-05 06:02:16','2025-05-05 06:02:16'),(16,10,'Renault','5 Turbo',1986,'S 5622','pendiente','2025-05-15 07:23:21','2025-05-15 07:23:21'),(17,7,'Renault','Megane RS',2022,'9393MMD','pendiente','2025-05-26 06:52:25','2025-05-26 06:52:25'),(18,7,'Renault','5 Turbo',1986,'S 5664','pendiente','2025-05-26 06:58:48','2025-05-26 06:58:48');
/*!40000 ALTER TABLE `solicitud_vehiculos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `id_rol` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `username` (`username`),
  KEY `id_rol` (`id_rol`),
  CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id`) ON DELETE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (4,'david','abascaldavid3@gmail.com','david','$2y$12$W2osLWONMXyZnav9IX0fneRpoINeEbzG6oYeCwZa30gNUQyXqvrPy',3,'2025-03-03 18:44:11','2025-04-28 07:22:57'),(5,'admin','admin@example.com','usuario','$2y$12$9IWktob56btdmYU.vaJOB.LJ3hB3Q6CzukixNk3AUovJ2HCHCmo0W',1,'2025-03-03 20:52:19','2025-03-03 20:52:19'),(7,'jorge','jorge@gmail.com','jorge','$2y$12$UyT5tMomQrhyUe55oIyCp.5tCJvZFT3uvE/Q9OzpKxIJhrzhBHaMe',3,'2025-03-07 09:59:47','2025-04-28 12:46:39'),(10,'ricardo','ricardo@gmail.com','ricardo','$2y$12$Mjy5JW2mXebBEfHnem2ML.RXUtsDbr5tz.C5g0esp3eyKpfTBK.qS',3,'2025-03-07 10:33:56','2025-03-11 17:33:55'),(11,'iker','iker@gmail.com','iker','$2y$12$q5uCR4n8sjdXoTpaDinJ1.ZSA6m2lEhVoD7s8aJKLBQFo4rJ3JyyC',3,'2025-03-07 16:03:42','2025-03-25 14:06:01'),(12,'marcos','marcos@gmail.com','marcos','$2y$12$KuPf8n7VHd7Fpv1Vx3z/ZO3brXLo.0.XypEqsnngRsSGp6boyVx0G',3,'2025-03-07 16:04:06','2025-03-11 17:34:25'),(16,'Alejandro Abascal','alexabascal@gmail.com','mecanico','$2y$12$QlulDnIkxWFjUBUzGaVtSeQJ1qYupPuNazBYhFFv1HIQB2cW0MEHG',2,'2025-03-20 13:52:03','2025-03-25 08:46:04'),(18,'David Abascal','todomotorsaron@gmail.com','JefeMecanico','$2y$12$07HFYcGOu775fMytczeFRuFj4qnHKO2Hr//d3KLgJx77mUQkoSEjy',2,'2025-03-25 08:44:50','2025-03-25 08:45:01'),(21,'Alejandro','alejandro@gmail.com','Alejandro','$2y$12$g8exKu/4k7oUq.HrG1oheu8AMya.3TFY//ybaIQXq5WosRW7CsRra',3,'2025-04-11 14:31:16','2025-04-11 14:31:16'),(26,'Jose Luis Gómez Pérez','joselgp@gmail.com','joselgp','$2y$12$Z36.9D8kQ7cyFVlkGcQoP.LljWoFnVuhB/mb4rx4MQ9j11ddlWmT2',3,'2025-05-05 06:01:33','2025-05-05 06:01:33'),(27,'ejemplo2','ejemplo2@gmail.com','ejemplo2','$2y$12$7hm0wUz.UeD4xANVIO5spepXUa4Ior/xQSAcL.Zce7.685zh2xJbm',3,'2025-05-27 06:24:16','2025-05-27 06:24:16');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-05-27 12:02:50
