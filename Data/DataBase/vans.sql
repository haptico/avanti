CREATE TABLE "user" (
"id" varchar(10) NOT NULL,
"email" varchar(100),
"pass" varchar(250),
"created" date,
PRIMARY KEY ("id") 
);

CREATE TABLE "passageiro" (
"id" int8 NOT NULL,
"id_user" int8,
"id_trageto" int8,
"nome" varchar(100),
"telefone" varchar(20),
PRIMARY KEY ("id") 
);

CREATE TABLE "trageto" (
"id" int8 NOT NULL,
"inicion" varchar(100),
"fin" varchar(100),
PRIMARY KEY ("id") 
);

CREATE TABLE "van" (
"id" int8 NOT NULL,
"id_trageto" int8,
"qtd_lugar" int8,
PRIMARY KEY ("id") 
);

CREATE TABLE "motorista" (
"id" int8 NOT NULL,
"id_user" int8,
"nome" varchar(100),
"telefone" varchar(20),
PRIMARY KEY ("id") 
);

CREATE TABLE "passageiro_van" (
"id_passageiro" int8,
"id_van" int8,
"data" date
);

CREATE TABLE "motorista_van" (
"id_motorista" int8,
"id_van" int8,
"data" date
);

