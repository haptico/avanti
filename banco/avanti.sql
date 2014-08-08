/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 50516
Source Host           : localhost:3306
Source Database       : avanti

Target Server Type    : MYSQL
Target Server Version : 50516
File Encoding         : 65001

Date: 2014-08-08 10:27:24
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `acesso`
-- ----------------------------
DROP TABLE IF EXISTS `acesso`;
CREATE TABLE `acesso` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `arquivo` varchar(100) NOT NULL,
  `nome` varchar(150) DEFAULT NULL,
  `visivel` enum('S','N') DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of acesso
-- ----------------------------

-- ----------------------------
-- Table structure for `avulso`
-- ----------------------------
DROP TABLE IF EXISTS `avulso`;
CREATE TABLE `avulso` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `id_trajeto` int(11) NOT NULL,
  `id_ponto` int(11) NOT NULL,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `valor` float NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_avulso_usuario` (`id_usuario`) USING BTREE,
  KEY `fk_avulso_trajeto` (`id_trajeto`) USING BTREE,
  KEY `fk_avulso_ponto` (`id_ponto`) USING BTREE,
  CONSTRAINT `fk_avulso_ponto` FOREIGN KEY (`id_ponto`) REFERENCES `ponto` (`id`),
  CONSTRAINT `fk_avulso_trajeto` FOREIGN KEY (`id_trajeto`) REFERENCES `trajeto` (`id`),
  CONSTRAINT `fk_avulso_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of avulso
-- ----------------------------

-- ----------------------------
-- Table structure for `bairro`
-- ----------------------------
DROP TABLE IF EXISTS `bairro`;
CREATE TABLE `bairro` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(256) NOT NULL,
  `id_cidade` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_bairro_cidade` (`id_cidade`),
  CONSTRAINT `fk_bairro_cidade` FOREIGN KEY (`id_cidade`) REFERENCES `cidade` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bairro
-- ----------------------------

-- ----------------------------
-- Table structure for `cidade`
-- ----------------------------
DROP TABLE IF EXISTS `cidade`;
CREATE TABLE `cidade` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(256) NOT NULL,
  `id_uf` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_cidade_uf` (`id_uf`),
  CONSTRAINT `fk_cidade_uf` FOREIGN KEY (`id_uf`) REFERENCES `uf` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cidade
-- ----------------------------

-- ----------------------------
-- Table structure for `mensalista`
-- ----------------------------
DROP TABLE IF EXISTS `mensalista`;
CREATE TABLE `mensalista` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `id_trajeto` int(11) NOT NULL,
  `id_ponto` int(11) NOT NULL,
  `data_inicio` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `data_fim` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_mensalista_usuario` (`id_usuario`),
  KEY `fk_mensalista_trajeto` (`id_trajeto`),
  KEY `fk_mensalista_ponto` (`id_ponto`),
  CONSTRAINT `fk_mensalista_ponto` FOREIGN KEY (`id_ponto`) REFERENCES `ponto` (`id`),
  CONSTRAINT `fk_mensalista_trajeto` FOREIGN KEY (`id_trajeto`) REFERENCES `trajeto` (`id`),
  CONSTRAINT `fk_mensalista_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mensalista
-- ----------------------------

-- ----------------------------
-- Table structure for `ponto`
-- ----------------------------
DROP TABLE IF EXISTS `ponto`;
CREATE TABLE `ponto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(64) NOT NULL,
  `descricao` varchar(4000) NOT NULL,
  `id_bairro` int(11) NOT NULL,
  `ativo` enum('N','S') NOT NULL DEFAULT 'S',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_trajeto` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_ponto_trajeto` (`id_trajeto`),
  KEY `fk_ponto_bairro` (`id_bairro`),
  CONSTRAINT `fk_ponto_bairro` FOREIGN KEY (`id_bairro`) REFERENCES `bairro` (`id`),
  CONSTRAINT `fk_ponto_trajeto` FOREIGN KEY (`id_trajeto`) REFERENCES `trajeto` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ponto
-- ----------------------------

-- ----------------------------
-- Table structure for `tipo_usuario`
-- ----------------------------
DROP TABLE IF EXISTS `tipo_usuario`;
CREATE TABLE `tipo_usuario` (
  `id` int(11) NOT NULL,
  `nome` varchar(32) NOT NULL,
  `ativo` enum('N','S') NOT NULL DEFAULT 'S',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tipo_usuario
-- ----------------------------
INSERT INTO `tipo_usuario` VALUES ('1', 'Motorista', 'S', '2014-07-17 16:15:39');
INSERT INTO `tipo_usuario` VALUES ('2', 'Passageiro', 'S', '2014-07-17 16:15:44');

-- ----------------------------
-- Table structure for `tipo_veiculo`
-- ----------------------------
DROP TABLE IF EXISTS `tipo_veiculo`;
CREATE TABLE `tipo_veiculo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(64) NOT NULL,
  `ativo` enum('N','S') NOT NULL DEFAULT 'S',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tipo_veiculo
-- ----------------------------

-- ----------------------------
-- Table structure for `trajeto`
-- ----------------------------
DROP TABLE IF EXISTS `trajeto`;
CREATE TABLE `trajeto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(4000) DEFAULT NULL,
  `id_van` int(11) NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_fim` time NOT NULL,
  `id_bairro_origem` int(11) NOT NULL,
  `id_bairro_destino` int(11) NOT NULL,
  `preco_mensalista` float NOT NULL,
  `preco_avulso` float NOT NULL,
  `ativo` enum('N','S') NOT NULL DEFAULT 'S',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_trajeto_van` (`id_van`),
  KEY `fk_trajeto_bairro_origem` (`id_bairro_origem`),
  KEY `fk_trajeto_bairro_destino` (`id_bairro_destino`),
  CONSTRAINT `fk_trajeto_bairro_destino` FOREIGN KEY (`id_bairro_destino`) REFERENCES `bairro` (`id`),
  CONSTRAINT `fk_trajeto_bairro_origem` FOREIGN KEY (`id_bairro_origem`) REFERENCES `bairro` (`id`),
  CONSTRAINT `fk_trajeto_van` FOREIGN KEY (`id_van`) REFERENCES `veiculo` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of trajeto
-- ----------------------------

-- ----------------------------
-- Table structure for `uf`
-- ----------------------------
DROP TABLE IF EXISTS `uf`;
CREATE TABLE `uf` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` char(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of uf
-- ----------------------------

-- ----------------------------
-- Table structure for `usuario`
-- ----------------------------
DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(128) NOT NULL,
  `nome` varchar(128) NOT NULL,
  `sobrenome` varchar(128) NOT NULL,
  `senha` varchar(32) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `telefone` varchar(32) NOT NULL,
  `celular` varchar(32) NOT NULL,
  `id_tipo_usuario` int(11) NOT NULL,
  `ativo` enum('N','S') NOT NULL DEFAULT 'S',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_email` (`email`) USING BTREE,
  UNIQUE KEY `uk_cpf` (`cpf`) USING BTREE,
  KEY `fk_usuario_tipo_usuario` (`id_tipo_usuario`),
  CONSTRAINT `fk_usuario_tipo_usuario` FOREIGN KEY (`id_tipo_usuario`) REFERENCES `tipo_usuario` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of usuario
-- ----------------------------
INSERT INTO `usuario` VALUES ('2', 'a@a.com', 'a', 'aaa', '0cc175b9c0f1b6a831c399e269772661', '123', '213', '123', '1', 'S', '2014-07-25 17:06:57');

-- ----------------------------
-- Table structure for `veiculo`
-- ----------------------------
DROP TABLE IF EXISTS `veiculo`;
CREATE TABLE `veiculo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(4000) DEFAULT NULL,
  `placa` varchar(8) NOT NULL,
  `vagas` int(11) NOT NULL,
  `id_tipo_veiculo` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `ativo` enum('N','S') NOT NULL DEFAULT 'S',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_veiculo_usuario` (`id_usuario`),
  KEY `fk_veiculo_tipo_veiculo` (`id_tipo_veiculo`),
  CONSTRAINT `fk_veiculo_tipo_veiculo` FOREIGN KEY (`id_tipo_veiculo`) REFERENCES `tipo_veiculo` (`id`),
  CONSTRAINT `fk_veiculo_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of veiculo
-- ----------------------------
