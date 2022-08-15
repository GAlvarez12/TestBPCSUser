-- Database: controlbpcs

-- DROP DATABASE IF EXISTS controlbpcs;

CREATE DATABASE controlbpcs
    WITH
    OWNER = postgres
    ENCODING = 'UTF8'
    LC_COLLATE = 'Spanish_Mexico.1252'
    LC_CTYPE = 'Spanish_Mexico.1252'
    TABLESPACE = pg_default
    CONNECTION LIMIT = -1;
	
	
CREATE TABLE tMenu(
	idMenu integer NOT NULL AUTO_INCREMENT,
	nombre varchar(255) NOT NULL,
	codigo varchar (50) NOT NULL,
	PRIMARY KEY (idMenu)
);
	
CREATE TABLE tPrograma(
    idPrograma integer NOT NULL AUTO_INCREMENT,
	idMenu integer NOT NULL,
    nombre varchar(255) NOT NULL,
    codigo varchar(50) NOT NULL,
    PRIMARY KEY (idPrograma),
	FOREIGN KEY (idMenu) REFERENCES tMenu(idMenu)
); 

CREATE TABLE tUsuario(
	idUsuario integer NOT NULL AUTO_INCREMENT,
	nombre varchar(250) NOT NULL,
	PRIMARY KEY (idUsuario)
);

CREATE TABLE tPermisos(
	idPermiso integer NOT NULL AUTO_INCREMENT,
	idUsuario integer NOT NULL,
	idPrograma integer NOT NULL,
	PRIMARY KEY(idPermiso),
	FOREIGN KEY (idUsuario) REFERENCES tUsuario(idUsuario),
	FOREIGN KEY (idPrograma) REFERENCES tPrograma(idPrograma)

);