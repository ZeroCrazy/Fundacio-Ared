/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : ared

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2023-03-09 10:39:47
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for admins
-- ----------------------------
DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `rank` varchar(255) DEFAULT NULL,
  `so` varchar(255) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `last_online` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- ----------------------------
-- Records of admins
-- ----------------------------
INSERT INTO `admins` VALUES ('1', 'admin', 'admin', '3', 'Windows 10', null, null);

-- ----------------------------
-- Table structure for alquiler
-- ----------------------------
DROP TABLE IF EXISTS `alquiler`;
CREATE TABLE `alquiler` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `room` varchar(255) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `hora_entrada` varchar(255) DEFAULT NULL,
  `hora_salida` varchar(255) DEFAULT NULL,
  `dia_entrada` varchar(255) DEFAULT NULL,
  `mes_entrada` varchar(255) DEFAULT NULL,
  `ano_entrada` varchar(255) DEFAULT NULL,
  `dia_salida` varchar(255) DEFAULT NULL,
  `mes_salida` varchar(255) DEFAULT NULL,
  `ano_salida` varchar(255) DEFAULT NULL,
  `cliente_id` varchar(11) DEFAULT NULL,
  `num_personas` varchar(255) DEFAULT NULL,
  `num_habitaciones` varchar(255) DEFAULT NULL,
  `desayuno` enum('1','0') DEFAULT '0',
  `cena` enum('1','0') DEFAULT '0',
  `payment` enum('transferencia','efectivo') DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL,
  `price_cena` varchar(255) DEFAULT NULL,
  `price_persona` varchar(255) DEFAULT NULL,
  `price_desayuno` varchar(255) DEFAULT NULL,
  `total_a_pagar` varchar(255) DEFAULT NULL,
  `timestamp_entrada` datetime DEFAULT NULL,
  `timestamp_salida` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- ----------------------------
-- Records of alquiler
-- ----------------------------
INSERT INTO `alquiler` VALUES ('0', '0', 'black', 'ilimitado', 'ilimitado', '1', '1', '1', '1', '1', '1', '', null, null, '0', '0', null, null, null, null, null, null, null, null);
INSERT INTO `alquiler` VALUES ('3', '6', 'green', null, null, '9', '4', '2018', '18', '4', '2018', '11', '1', null, '1', '1', 'transferencia', '1523275544', '0', '15', '0', '', null, null);
INSERT INTO `alquiler` VALUES ('4', '6', 'green', null, null, '20', '4', '2018', '23', '4', '2018', '14', '1', null, '1', '1', 'transferencia', '1523275990', '0', '15', '0', '', null, null);
INSERT INTO `alquiler` VALUES ('5', '6', 'green', null, null, '1', '5', '2018', '5', '5', '2018', '15', '2', null, '1', '1', 'efectivo', '1523279134', '0', '15', '0', '', null, null);
INSERT INTO `alquiler` VALUES ('6', '7', 'green', null, null, '4', '5', '2018', '9', '5', '2018', '11', '2', null, '1', '0', 'efectivo', '1523279220', '0', '15', '0', '', null, null);

-- ----------------------------
-- Table structure for clientes
-- ----------------------------
DROP TABLE IF EXISTS `clientes`;
CREATE TABLE `clientes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `apellidos` varchar(255) DEFAULT NULL,
  `domicilio_via` enum('Glorieta','Calle','Avenida') DEFAULT NULL,
  `domicilio_direccion` varchar(255) DEFAULT NULL,
  `domicilio_numbloque` varchar(255) DEFAULT NULL,
  `domicilio_escalera` varchar(255) DEFAULT NULL,
  `domicilio_puerta` varchar(255) DEFAULT NULL,
  `domicilio_pais` varchar(255) DEFAULT NULL,
  `domicilio_provincia` varchar(255) DEFAULT NULL,
  `domicilio_ciudad` varchar(255) DEFAULT NULL,
  `domicilio_cp` varchar(255) DEFAULT NULL,
  `telf_fijo` varchar(255) DEFAULT NULL,
  `telf_movil` varchar(255) DEFAULT NULL,
  `dni` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `added_client` varchar(255) DEFAULT NULL,
  `procedencia` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- ----------------------------
-- Records of clientes
-- ----------------------------
INSERT INTO `clientes` VALUES ('14', 'test', 'test', '', '', '', '', '', '', '', '', '', '', '', 'test', '', 'admin', null);
INSERT INTO `clientes` VALUES ('15', 'Elisabeth', 'Lopez', 'Calle', 'c/Zamora 103', '105', '', '', 'España', 'Barcelona', 'Barcelona', '08019', '654619598', '', '79282467', 'elopez@fundacioared.org', 'eli', null);

-- ----------------------------
-- Table structure for clientes_historial
-- ----------------------------
DROP TABLE IF EXISTS `clientes_historial`;
CREATE TABLE `clientes_historial` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cliente_id` int(11) DEFAULT NULL,
  `entrada` varchar(255) DEFAULT NULL,
  `salida` varchar(255) DEFAULT NULL,
  `num_personas` varchar(255) DEFAULT NULL,
  `num_habitaciones` varchar(255) DEFAULT NULL,
  `desayuno` int(11) DEFAULT NULL,
  `cena` varchar(255) DEFAULT NULL,
  `payment` varchar(255) DEFAULT NULL,
  `status_payment` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- ----------------------------
-- Records of clientes_historial
-- ----------------------------

-- ----------------------------
-- Table structure for cms_settings
-- ----------------------------
DROP TABLE IF EXISTS `cms_settings`;
CREATE TABLE `cms_settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `precio_rooms` varchar(255) DEFAULT NULL,
  `precio_cena` varchar(255) DEFAULT NULL,
  `precio_desayuno` int(11) DEFAULT NULL,
  `site` varchar(255) DEFAULT NULL,
  `sitename` varchar(255) DEFAULT NULL,
  `reformas` enum('1','0') DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- ----------------------------
-- Records of cms_settings
-- ----------------------------
INSERT INTO `cms_settings` VALUES ('1', '15', '0', '0', 'http://127.0.0.1', 'La llavor', '0');

-- ----------------------------
-- Table structure for historial
-- ----------------------------
DROP TABLE IF EXISTS `historial`;
CREATE TABLE `historial` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `page` varchar(255) DEFAULT NULL,
  `action` varchar(255) DEFAULT NULL,
  `edit_1` varchar(255) DEFAULT NULL,
  `edit_2` varchar(255) DEFAULT NULL,
  `edit_3` varchar(255) DEFAULT NULL,
  `edit_4` varchar(255) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- ----------------------------
-- Records of historial
-- ----------------------------
INSERT INTO `historial` VALUES ('1', '1', 'Habitaciones', 'Ha creado un nuevo cliente', null, null, null, null, '1523275469');
INSERT INTO `historial` VALUES ('2', '1', 'Habitaciones', 'Ha añadido un alquiler (Hab: 6-green)', null, null, null, null, '1523275544');
INSERT INTO `historial` VALUES ('3', '1', 'Habitaciones', 'Ha creado un nuevo cliente', null, null, null, null, '1523275825');
INSERT INTO `historial` VALUES ('4', '1', 'Clientes', 'Ha eliminado a un cliente (pep pepe)', null, null, null, null, '1523275844');
INSERT INTO `historial` VALUES ('5', '1', 'Habitaciones', 'Ha creado un nuevo cliente', null, null, null, null, '1523275914');
INSERT INTO `historial` VALUES ('6', '1', 'Clientes', 'Ha eliminado a un cliente (6 6)', null, null, null, null, '1523275922');
INSERT INTO `historial` VALUES ('7', '1', 'Habitaciones', 'Ha creado un nuevo cliente', null, null, null, null, '1523275946');
INSERT INTO `historial` VALUES ('8', '1', 'Habitaciones', 'Ha añadido un alquiler (Hab: 6-green)', null, null, null, null, '1523275990');
INSERT INTO `historial` VALUES ('9', '2', 'Habitaciones', 'Ha creado un nuevo cliente', null, null, null, null, '1523279064');
INSERT INTO `historial` VALUES ('10', '2', 'Habitaciones', 'Ha añadido un alquiler (Hab: 6-green)', null, null, null, null, '1523279134');
INSERT INTO `historial` VALUES ('11', '2', 'Habitaciones', 'Ha añadido un alquiler (Hab: 7-green)', null, null, null, null, '1523279220');
INSERT INTO `historial` VALUES ('12', '1', 'Usuarios', 'Ha creado un nuevo administrador', null, null, null, null, '1525990076');

-- ----------------------------
-- Table structure for pago_cuenta
-- ----------------------------
DROP TABLE IF EXISTS `pago_cuenta`;
CREATE TABLE `pago_cuenta` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cliente_id` int(11) DEFAULT NULL,
  `cantidad` varchar(255) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL,
  `room` varchar(255) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- ----------------------------
-- Records of pago_cuenta
-- ----------------------------

-- ----------------------------
-- Table structure for ranks
-- ----------------------------
DROP TABLE IF EXISTS `ranks`;
CREATE TABLE `ranks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- ----------------------------
-- Records of ranks
-- ----------------------------
INSERT INTO `ranks` VALUES ('1', 'Usuario');
INSERT INTO `ranks` VALUES ('2', 'Moderador');
INSERT INTO `ranks` VALUES ('3', 'Administrador');

-- ----------------------------
-- Table structure for rooms
-- ----------------------------
DROP TABLE IF EXISTS `rooms`;
CREATE TABLE `rooms` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `status` enum('2','1','0') DEFAULT '0',
  `info` varchar(999) DEFAULT NULL,
  `category` enum('orange','yellow','blue','green') DEFAULT NULL,
  `style` varchar(255) DEFAULT NULL,
  `show` enum('1','0') DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- ----------------------------
-- Records of rooms
-- ----------------------------
INSERT INTO `rooms` VALUES ('1', '6', '0', '', 'green', 'margin-top: 203px;margin-left: 312px;position: absolute;', '1');
INSERT INTO `rooms` VALUES ('2', '7', '0', '', 'green', 'margin-top: 202px;margin-left: 412px;position: absolute;', '1');
INSERT INTO `rooms` VALUES ('3', '8', '0', '', 'green', 'margin-top: 201px;margin-left: 588px;position: absolute;', '0');
INSERT INTO `rooms` VALUES ('4', '16', '0', '', 'yellow', 'margin-top: 230px;margin-left: 766px;position: absolute;', '0');
INSERT INTO `rooms` VALUES ('5', '15', '0', '', 'yellow', 'margin-top: 230px;margin-left: 877px;position: absolute;', '0');
INSERT INTO `rooms` VALUES ('6', '14', '0', '', 'yellow', 'margin-top: 228px;margin-left: 954px;position: absolute;', '0');
INSERT INTO `rooms` VALUES ('7', '13', '0', '', 'yellow', 'margin-top: 228px;margin-left: 1067px;position: absolute;', '0');
INSERT INTO `rooms` VALUES ('8', '12', '0', '', 'yellow', 'margin-top: 228px;margin-left: 1138px;position: absolute;', '0');
INSERT INTO `rooms` VALUES ('9', '11', '0', '', 'yellow', 'margin-top: 226px;margin-left: 1249px;position: absolute;', '0');
INSERT INTO `rooms` VALUES ('10', '10', '0', '', 'yellow', 'margin-top: 226px;margin-left: 1315px;position: absolute;', '0');
INSERT INTO `rooms` VALUES ('11', '9', '0', '', 'yellow', 'margin-top: 226px;margin-left: 1428px;position: absolute;', '0');
INSERT INTO `rooms` VALUES ('12', '5', '0', '', 'green', 'position: absolute;margin-top: 373px;margin-left: 312px;', '1');
INSERT INTO `rooms` VALUES ('13', '4', '0', '', 'green', 'position: absolute;margin-top: 372px;margin-left: 505px;', '1');
INSERT INTO `rooms` VALUES ('14', '5', '0', '', 'yellow', 'position: absolute;margin-top: 344px;margin-left: 1041px;', '0');
INSERT INTO `rooms` VALUES ('15', '6', '0', '', 'yellow', 'position: absolute;margin-top: 343px;margin-left: 1138px;', '0');
INSERT INTO `rooms` VALUES ('16', '7', '0', '', 'yellow', 'position: absolute;margin-top: 343px;margin-left: 1329px;', '0');
INSERT INTO `rooms` VALUES ('17', '8', '0', '', 'yellow', 'position: absolute;margin-top: 343px;margin-left: 1429px;', '0');
INSERT INTO `rooms` VALUES ('18', '14', '0', '', 'orange', 'position: absolute;margin-top: 714px;margin-left: 42px;', '1');
INSERT INTO `rooms` VALUES ('19', '15', '0', '', 'orange', 'position: absolute;margin-top: 713px;margin-left: 187px;', '1');
INSERT INTO `rooms` VALUES ('20', '16', '0', '', 'orange', 'position: absolute;margin-top: 713px;margin-left: 275px;', '1');
INSERT INTO `rooms` VALUES ('21', '17', '0', '', 'orange', 'position: absolute;margin-top: 712px;margin-left: 415px;', '1');
INSERT INTO `rooms` VALUES ('22', '24', '0', '', 'orange', 'position: absolute;margin-top: 708px;margin-left: 783px;', '1');
INSERT INTO `rooms` VALUES ('23', '25', '0', '', 'orange', 'position: absolute;margin-top: 708px;margin-left: 958px;', '1');
INSERT INTO `rooms` VALUES ('24', '12', '0', '', 'orange', 'position: absolute;margin-top: 889px;margin-left: 42px;', '1');
INSERT INTO `rooms` VALUES ('25', '13', '0', '', 'orange', 'position: absolute;margin-top: 889px;margin-left: 187px;', '1');
INSERT INTO `rooms` VALUES ('26', '18', '0', '', 'orange', 'position: absolute;margin-top: 889px;margin-left: 276px;', '1');
INSERT INTO `rooms` VALUES ('27', '19', '0', '', 'blue', 'position: absolute;margin-top: 886px;margin-left: 417px;', '1');
INSERT INTO `rooms` VALUES ('28', '20', '0', '', 'blue', 'position: absolute;margin-top: 886px;margin-left: 509px;', '1');
INSERT INTO `rooms` VALUES ('29', '21', '0', '', 'orange', 'position: absolute;margin-top: 886px;margin-left: 609px;', '0');
INSERT INTO `rooms` VALUES ('30', '22', '0', '', 'orange', 'position: absolute;margin-top: 886px;margin-left: 691px;', '0');
INSERT INTO `rooms` VALUES ('31', '23', '0', '', 'orange', 'position: absolute;margin-top: 879px;margin-left: 828px;', '0');
INSERT INTO `rooms` VALUES ('32', '26', '0', '', 'orange', 'position: absolute;margin-top: 882px;margin-left: 971px;', '0');

-- ----------------------------
-- Table structure for tiempo_meses
-- ----------------------------
DROP TABLE IF EXISTS `tiempo_meses`;
CREATE TABLE `tiempo_meses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- ----------------------------
-- Records of tiempo_meses
-- ----------------------------
INSERT INTO `tiempo_meses` VALUES ('1', 'Enero');
INSERT INTO `tiempo_meses` VALUES ('2', 'Febrero');
INSERT INTO `tiempo_meses` VALUES ('3', 'Marzo');
INSERT INTO `tiempo_meses` VALUES ('4', 'Abril');
INSERT INTO `tiempo_meses` VALUES ('5', 'Mayo');
INSERT INTO `tiempo_meses` VALUES ('6', 'Junio');
INSERT INTO `tiempo_meses` VALUES ('7', 'Julio');
INSERT INTO `tiempo_meses` VALUES ('8', 'Agosto');
INSERT INTO `tiempo_meses` VALUES ('9', 'Septiembre');
INSERT INTO `tiempo_meses` VALUES ('10', 'Octubre');
INSERT INTO `tiempo_meses` VALUES ('11', 'Noviembre');
INSERT INTO `tiempo_meses` VALUES ('12', 'Diciembre');
