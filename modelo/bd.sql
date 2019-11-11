
CREATE DATABASE sicau;

USE sicau;

CREATE TABLE cargo (
id int(11) AUTO_INCREMENT,
nombre varchar(25) NOT NULL,
estatus char(1) NOT NULL,
PRIMARY KEY (id)
)ENGINE=InnoDB;

CREATE TABLE tipo_solicitud (
id int(11) AUTO_INCREMENT,
nombre varchar(25) NOT NULL,
estatus char(1) NOT NULL,
PRIMARY KEY (id)
)ENGINE=InnoDB;

CREATE TABLE usuario (
id int(11) AUTO_INCREMENT,
cedula varchar(10) NOT NULL UNIQUE,
nombre varchar(50) NOT NULL,
apellido varchar(50) NOT NULL,
tipo varchar(3) NOT NULL,
nombre_usu varchar(25) NOT NULL,
contrasena char(32) NOT NULL,
estatus char(1) NOT NULL,
PRIMARY KEY (id)
)ENGINE=InnoDB;

CREATE TABLE area (
id int(11) AUTO_INCREMENT,
nombre varchar(25) NOT NULL,
estatus char(1) NOT NULL,
PRIMARY KEY (id)
)ENGINE=InnoDB;

CREATE TABLE subarea (
id int(11) AUTO_INCREMENT,
nombre varchar(25) NOT NULL,
estatus char(1) NOT NULL,
id_area int NOT NULL,
PRIMARY KEY (id),
FOREIGN KEY (id_area) REFERENCES area(id)
)ENGINE=InnoDB;

CREATE TABLE solicitante (
id int(11) AUTO_INCREMENT,
cedula varchar(10) NOT NULL UNIQUE,
nombre varchar(50) NOT NULL,
apellido varchar(50) NOT NULL,
sexo varchar(1) NOT NULL,
telefono varchar(12) NOT NULL,
estatus char(1) NOT NULL,
id_cargo int NOT NULL,
PRIMARY KEY (id),
FOREIGN KEY (id_cargo) REFERENCES cargo(id)
)ENGINE=InnoDB;

CREATE TABLE solicitante_correo (
id int(11) AUTO_INCREMENT,
correo varchar(75) NOT NULL,
id_sol int NOT NULL,
PRIMARY KEY (id),
FOREIGN KEY (id_sol) REFERENCES solicitante(id)
)ENGINE=InnoDB;

CREATE TABLE permiso (
id int(11) AUTO_INCREMENT,
motivo varchar(50) NOT NULL,
estatus char(1) NOT NULL,
fecha_inicial date NOT NULL,
fecha_final date NOT NULL,
/*id_sol int NOT NULL,*/
PRIMARY KEY (id)/*,
FOREIGN KEY (id_sol) REFERENCES solicitante(id)*/
)ENGINE=InnoDB;


CREATE TABLE actividad (
id int(11) AUTO_INCREMENT,
fecha date NOT NULL,
/*id_sol int NOT NULL,*/
id_usu int NOT NULL,
PRIMARY KEY (id),
/*FOREIGN KEY (id_sol) REFERENCES solicitante(id),*/
FOREIGN KEY (id_usu) REFERENCES usuario(id)
)ENGINE=InnoDB;

CREATE TABLE asistencia (
id int(11) AUTO_INCREMENT,
fecha date NOT NULL,
hora time NOT NULL,
accion varchar(7) NOT NULL,
estatus char NOT NULL
id_sol int NOT NULL,
PRIMARY KEY (id),
FOREIGN KEY (id_sol) REFERENCES solicitante(id)
)ENGINE=InnoDB;

CREATE TABLE dia_feriado (
id int(11) AUTO_INCREMENT,
motivo varchar(50) NOT NULL,
fecha_inicial date NOT NULL,
fecha_final date NOT NULL,
estatus char(1) NOT NULL,
PRIMARY KEY (id)
)ENGINE=InnoDB;

CREATE TABLE solicitud (
id int(11) AUTO_INCREMENT,
fecha date NOT NULL,
motivo varchar(100) NOT NULL,
estatus char(1) NOT NULL,
id_sol int NOT NULL,
id_usu int NOT NULL,
id_tipo int NOT NULL,
id_subarea int NOT NULL,
PRIMARY KEY (id),
FOREIGN KEY (id_sol) REFERENCES solicitante(id),
FOREIGN KEY (id_usu) REFERENCES usuario(id),
FOREIGN KEY (id_tipo) REFERENCES tipo_solicitud(id),
FOREIGN KEY (id_subarea) REFERENCES subarea(id)
)ENGINE=InnoDB;

CREATE TABLE solicitud_comentario (
id int(11) AUTO_INCREMENT,
comentario varchar(200) NOT NULL,
id_solicitud int NOT NULL,
PRIMARY KEY (id),
FOREIGN KEY (id_solicitud) REFERENCES solicitud(id)
)ENGINE=InnoDB;

CREATE TABLE servicio (
id int(11) AUTO_INCREMENT,
fecha date NOT NULL,
estatus char(1) NOT NULL,
id_solicitud int NOT NULL,
PRIMARY KEY (id),
FOREIGN KEY (id_solicitud) REFERENCES solicitud(id)
)ENGINE=InnoDB;

/*CREATE TABLE soli_serv (
id int(11) AUTO_INCREMENT,
id_sol int NOT NULL,
id_serv int NOT NULL,
PRIMARY KEY (id),
FOREIGN KEY (id_sol) REFERENCES solicitante(id),
FOREIGN KEY (id_serv) REFERENCES servicio(id)
)ENGINE=InnoDB;*/

CREATE TABLE sol_act (
id int(11) AUTO_INCREMENT,
id_sol int NOT NULL,
id_act int NOT NULL,
PRIMARY KEY (id),
FOREIGN KEY (id_sol) REFERENCES solicitante(id),
FOREIGN KEY (id_act) REFERENCES actividad(id)
)ENGINE=InnoDB;

/*
CREATE TABLE asis_diaferiado (
id int(11) AUTO_INCREMENT,
id_asis int NOT NULL,
id_dia_feriado int NOT NULL,
PRIMARY KEY (id),
FOREIGN KEY (id_asis) REFERENCES asistencia(id),
FOREIGN KEY (id_dia_feriado) REFERENCES dia_feriado(id)
)ENGINE=InnoDB;*/

CREATE TABLE sol_per (
id int(11) AUTO_INCREMENT,
id_sol int NOT NULL,
id_per int NOT NULL,
PRIMARY KEY (id),
FOREIGN KEY (id_sol) REFERENCES solicitante(id),
FOREIGN KEY (id_per) REFERENCES permiso(id)
)ENGINE=InnoDB;


INSERT INTO `usuario`(`id`, `cedula`, `nombre`, `apellido`, `tipo`, `nombre_usu`, `contrasena`, `estatus`) 
VALUES ('1','12345678','super','usuario','adm','admin','123','a');

INSERT INTO `cargo` (`id`, `nombre`, `estatus`) VALUES ('1', 'Obrero', 'a');
INSERT INTO `cargo` (`id`, `nombre`, `estatus`) VALUES (NULL, 'Estudiante', 'a');
INSERT INTO `cargo` (`id`, `nombre`, `estatus`) VALUES (NULL, 'Administrativo', 'a');

INSERT INTO `solicitante` (`id`, `cedula`, `nombre`, `apellido`, `sexo`, `telefono`, `estatus`, `id_cargo`) 
VALUES (NULL, '27529516', 'Jesus', 'Gonzalez', 'm', '0412-1527833', 'a', '1');
INSERT INTO `solicitante` (`id`, `cedula`, `nombre`, `apellido`, `sexo`, `telefono`, `estatus`, `id_cargo`) 
VALUES (NULL, '27166703', 'Heleana', 'Hammad', 'f', '0414-5224172', 'a', '1');
INSERT INTO `solicitante` (`id`, `cedula`, `nombre`, `apellido`, `sexo`, `telefono`, `estatus`, `id_cargo`) 
VALUES (NULL, '27321765', 'Eliezer', 'Sanchez', 'm', '0426-3418993', 'a', '1');

INSERT INTO `solicitante_correo` (`id`, `id_sol`, `correo`) VALUES (NULL, '1', 'jegt18@gmail.com');
INSERT INTO `solicitante_correo` (`id`, `id_sol`, `correo`) VALUES (NULL, '2', 'heleanakh01@gmail.com');
INSERT INTO `solicitante_correo` (`id`, `id_sol`, `correo`) VALUES (NULL, '3', 'eliezersanchez@gmail.com');

INSERT INTO `area` (`id`, `nombre`, `estatus`) VALUES (NULL, 'Aula', 'a');
INSERT INTO `area` (`id`, `nombre`, `estatus`) VALUES (NULL, 'Area Verde', 'a');
INSERT INTO `area` (`id`, `nombre`, `estatus`) VALUES (NULL, 'Pasillo', 'a');
INSERT INTO `area` (`id`, `nombre`, `estatus`) VALUES (NULL, 'Departamento', 'a');

INSERT INTO `subarea` (`id`, `id_area`, `nombre`, `estatus`) VALUES (NULL, '1', 'E-08', 'a');
INSERT INTO `subarea` (`id`, `id_area`, `nombre`, `estatus`) VALUES (NULL, '1', 'A-03', 'a');
INSERT INTO `subarea` (`id`, `id_area`, `nombre`, `estatus`) VALUES (NULL, '1', 'E-05', 'a');
INSERT INTO `subarea` (`id`, `id_area`, `nombre`, `estatus`) VALUES (NULL, '2', 'A', 'a');
INSERT INTO `subarea` (`id`, `id_area`, `nombre`, `estatus`) VALUES (NULL, '3', 'Principal', 'a');
INSERT INTO `subarea` (`id`, `id_area`, `nombre`, `estatus`) VALUES (NULL, '4', 'InformÃ¡tica', 'a');

INSERT INTO `dia_feriado` (`id`, `motivo`, `fecha_inicial`, `fecha_final`, `estatus`) VALUES (NULL, 'Muerte de Simon Bolivar', '2018-12-17', '2018-12-17', 'a');
INSERT INTO `dia_feriado` (`id`, `motivo`, `fecha_inicial`, `fecha_final`, `estatus`) VALUES (NULL, 'Nacimiento de Simon Bolivar', '2018-07-24', '2018-07-24', 'a');
INSERT INTO `dia_feriado` (`id`, `motivo`, `fecha_inicial`, `fecha_final`, `estatus`) VALUES (NULL, 'Dia de la Independencia', '2018-04-19', '2018-04-19', 'a');
INSERT INTO `dia_feriado` (`id`, `motivo`, `fecha_inicial`, `fecha_final`, `estatus`) VALUES (NULL, 'CumpleaÃ±os de Jesus', '2018-03-18', '2018-03-18', 'a');

INSERT INTO `permiso` (`id`, `motivo`, `fecha_inicial`, `fecha_final`, `estatus`) VALUES (NULL, 'Viaje', '2018-04-10', '2018-04-12', 'a');
INSERT INTO `permiso` (`id`, `motivo`, `fecha_inicial`, `fecha_final`, `estatus`) VALUES (NULL, 'Reposo por fiebre', '2018-03-18', '2018-03-25', 'a');

INSERT INTO `sol_per` (`id`, `id_sol`, `id_per`) VALUES (NULL, '1', '1');
INSERT INTO `sol_per` (`id`, `id_sol`, `id_per`) VALUES (NULL, '2', '2');

INSERT INTO `tipo_solicitud` (`id`, `nombre`, `estatus`) VALUES (NULL, 'PlomerÃ­a', 'a');
INSERT INTO `tipo_solicitud` (`id`, `nombre`, `estatus`) VALUES (NULL, 'Electricidad', 'a');
INSERT INTO `tipo_solicitud` (`id`, `nombre`, `estatus`) VALUES (NULL, 'Ambiente', 'a');














