/*
Navicat PGSQL Data Transfer

Source Server         : Postgres
Source Server Version : 90304
Source Host           : localhost:5432
Source Database       : vans
Source Schema         : public

Target Server Type    : PGSQL
Target Server Version : 90304
File Encoding         : 65001

Date: 2014-09-18 22:34:09
*/


-- ----------------------------
-- Sequence structure for seq_destinos
-- ----------------------------
DROP SEQUENCE "public"."seq_destinos";
CREATE SEQUENCE "public"."seq_destinos"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 1
 CACHE 1;

-- ----------------------------
-- Sequence structure for seq_groups
-- ----------------------------
DROP SEQUENCE "public"."seq_groups";
CREATE SEQUENCE "public"."seq_groups"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 2
 CACHE 1;
SELECT setval('"public"."seq_groups"', 2, true);

-- ----------------------------
-- Sequence structure for seq_passageiros
-- ----------------------------
DROP SEQUENCE "public"."seq_passageiros";
CREATE SEQUENCE "public"."seq_passageiros"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 1
 CACHE 1;
SELECT setval('"public"."seq_passageiros"', 1, true);

-- ----------------------------
-- Sequence structure for seq_users
-- ----------------------------
DROP SEQUENCE "public"."seq_users";
CREATE SEQUENCE "public"."seq_users"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 2
 CACHE 1;
SELECT setval('"public"."seq_users"', 2, true);

-- ----------------------------
-- Table structure for destinos
-- ----------------------------
DROP TABLE IF EXISTS "public"."destinos";
CREATE TABLE "public"."destinos" (
"id" int8 DEFAULT nextval('seq_destinos'::regclass) NOT NULL,
"id_passageiro" int8 NOT NULL,
"endereco" varchar(200) COLLATE "default",
"numero" int4,
"bairro" varchar(50) COLLATE "default",
"cidade" varchar(100) COLLATE "default",
"estado" varchar(100) COLLATE "default"
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Records of destinos
-- ----------------------------

-- ----------------------------
-- Table structure for fixos
-- ----------------------------
DROP TABLE IF EXISTS "public"."fixos";
CREATE TABLE "public"."fixos" (
"id_passageiros" int8 NOT NULL,
"id_veiculos" int8 NOT NULL,
"ativo" char(1) COLLATE "default",
"created" date,
"sentido" varchar(20) COLLATE "default",
"agendado" char(1) COLLATE "default",
"status" varchar(255) COLLATE "default"
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Records of fixos
-- ----------------------------

-- ----------------------------
-- Table structure for groups
-- ----------------------------
DROP TABLE IF EXISTS "public"."groups";
CREATE TABLE "public"."groups" (
"id" int8 DEFAULT nextval('seq_groups'::regclass) NOT NULL,
"name" varchar(200) COLLATE "default",
"created" date
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Records of groups
-- ----------------------------
INSERT INTO "public"."groups" VALUES ('1', 'Administrador', '2014-06-23');
INSERT INTO "public"."groups" VALUES ('2', 'Passageiros', '2014-06-23');

-- ----------------------------
-- Table structure for motoristas
-- ----------------------------
DROP TABLE IF EXISTS "public"."motoristas";
CREATE TABLE "public"."motoristas" (
"id" int8 NOT NULL,
"id_user" int8 NOT NULL,
"cnh" int8 NOT NULL,
"cpf" int8 NOT NULL,
"endereco" varchar(200) COLLATE "default",
"numero" int4,
"bairro" varchar(50) COLLATE "default",
"cidade" varchar(100) COLLATE "default",
"estado" varchar(100) COLLATE "default"
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Records of motoristas
-- ----------------------------

-- ----------------------------
-- Table structure for passageiros
-- ----------------------------
DROP TABLE IF EXISTS "public"."passageiros";
CREATE TABLE "public"."passageiros" (
"id" int8 DEFAULT nextval('seq_passageiros'::regclass) NOT NULL,
"id_user" int8 NOT NULL,
"cpf" int8 NOT NULL,
"endereco" varchar(200) COLLATE "default",
"numero" int4,
"bairro" varchar(50) COLLATE "default",
"cidade" varchar(100) COLLATE "default",
"estado" char(2) COLLATE "default"
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Records of passageiros
-- ----------------------------
INSERT INTO "public"."passageiros" VALUES ('1', '2', '10678728763', 'Rua da Mantiqueiras ', '77', 'Centro', 'Rio de Janeiro', 'RJ');

-- ----------------------------
-- Table structure for tragetos
-- ----------------------------
DROP TABLE IF EXISTS "public"."tragetos";
CREATE TABLE "public"."tragetos" (
"id" int8 NOT NULL,
"id_veiculo" int8 NOT NULL,
"status" char(10) COLLATE "default",
"endereco" varchar(200) COLLATE "default",
"numero" int4,
"bairro" varchar(50) COLLATE "default",
"cidade" varchar(100) COLLATE "default",
"estado" varchar(100) COLLATE "default"
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Records of tragetos
-- ----------------------------

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS "public"."users";
CREATE TABLE "public"."users" (
"id" int8 DEFAULT nextval('seq_users'::regclass) NOT NULL,
"id_group" int8 NOT NULL,
"nome" varchar(200) COLLATE "default",
"email" varchar(200) COLLATE "default" NOT NULL,
"pass" varchar(250) COLLATE "default" NOT NULL,
"lastlogin" date,
"created" date
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO "public"."users" VALUES ('1', '1', 'Luis', 'luisclaudioramos@gmail.com', 'silva369', '2014-06-23', '2014-06-23');
INSERT INTO "public"."users" VALUES ('2', '2', 'Passageiro', 'passageiros@vans.com', 'silva369', '2014-06-23', '2014-06-23');

-- ----------------------------
-- Table structure for veiculos
-- ----------------------------
DROP TABLE IF EXISTS "public"."veiculos";
CREATE TABLE "public"."veiculos" (
"id" int8 NOT NULL,
"id_motorista" int8 NOT NULL,
"lugares" int2,
"vagas" int2
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Records of veiculos
-- ----------------------------

-- ----------------------------
-- Alter Sequences Owned By 
-- ----------------------------

-- ----------------------------
-- Uniques structure for table destinos
-- ----------------------------
ALTER TABLE "public"."destinos" ADD UNIQUE ("id_passageiro");

-- ----------------------------
-- Primary Key structure for table destinos
-- ----------------------------
ALTER TABLE "public"."destinos" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Uniques structure for table fixos
-- ----------------------------
ALTER TABLE "public"."fixos" ADD UNIQUE ("id_veiculos");

-- ----------------------------
-- Primary Key structure for table fixos
-- ----------------------------
ALTER TABLE "public"."fixos" ADD PRIMARY KEY ("id_passageiros");

-- ----------------------------
-- Primary Key structure for table groups
-- ----------------------------
ALTER TABLE "public"."groups" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Uniques structure for table motoristas
-- ----------------------------
ALTER TABLE "public"."motoristas" ADD UNIQUE ("id_user");
ALTER TABLE "public"."motoristas" ADD UNIQUE ("cnh");
ALTER TABLE "public"."motoristas" ADD UNIQUE ("cpf");

-- ----------------------------
-- Primary Key structure for table motoristas
-- ----------------------------
ALTER TABLE "public"."motoristas" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Uniques structure for table passageiros
-- ----------------------------
ALTER TABLE "public"."passageiros" ADD UNIQUE ("id_user");
ALTER TABLE "public"."passageiros" ADD UNIQUE ("cpf");

-- ----------------------------
-- Primary Key structure for table passageiros
-- ----------------------------
ALTER TABLE "public"."passageiros" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Uniques structure for table tragetos
-- ----------------------------
ALTER TABLE "public"."tragetos" ADD UNIQUE ("id_veiculo");

-- ----------------------------
-- Primary Key structure for table tragetos
-- ----------------------------
ALTER TABLE "public"."tragetos" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Uniques structure for table users
-- ----------------------------
ALTER TABLE "public"."users" ADD UNIQUE ("id_group");
ALTER TABLE "public"."users" ADD UNIQUE ("email");

-- ----------------------------
-- Primary Key structure for table users
-- ----------------------------
ALTER TABLE "public"."users" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Uniques structure for table veiculos
-- ----------------------------
ALTER TABLE "public"."veiculos" ADD UNIQUE ("id_motorista");

-- ----------------------------
-- Primary Key structure for table veiculos
-- ----------------------------
ALTER TABLE "public"."veiculos" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Foreign Key structure for table "public"."motoristas"
-- ----------------------------
ALTER TABLE "public"."motoristas" ADD FOREIGN KEY ("id") REFERENCES "public"."veiculos" ("id_motorista") ON DELETE NO ACTION ON UPDATE NO ACTION;

-- ----------------------------
-- Foreign Key structure for table "public"."passageiros"
-- ----------------------------
ALTER TABLE "public"."passageiros" ADD FOREIGN KEY ("id_user") REFERENCES "public"."users" ("id") ON DELETE NO ACTION ON UPDATE NO ACTION;

-- ----------------------------
-- Foreign Key structure for table "public"."users"
-- ----------------------------
ALTER TABLE "public"."users" ADD FOREIGN KEY ("id_group") REFERENCES "public"."groups" ("id") ON DELETE NO ACTION ON UPDATE NO ACTION;

-- ----------------------------
-- Foreign Key structure for table "public"."veiculos"
-- ----------------------------
ALTER TABLE "public"."veiculos" ADD FOREIGN KEY ("id") REFERENCES "public"."fixos" ("id_veiculos") ON DELETE NO ACTION ON UPDATE NO ACTION;
ALTER TABLE "public"."veiculos" ADD FOREIGN KEY ("id") REFERENCES "public"."tragetos" ("id_veiculo") ON DELETE NO ACTION ON UPDATE NO ACTION;
