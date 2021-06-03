CREATE DATABASE asesorias;

USE asesorias;

CREATE TABLE estudiantes(
	id INT(255) AUTO_INCREMENT NOT NULL,
	cedula INT(255) NOT NULL,
	nombre VARCHAR(100) NOT NULL,
	apellidos VARCHAR(255),
	email VARCHAR(255) NOT NULL,
	pass VARCHAR(255) NOT NULL,
	CONSTRAINT pk_usuarios PRIMARY KEY(id),
	CONSTRAINT uq_cedula UNIQUE(cedula),
	CONSTRAINT uq_email UNIQUE(email)
)ENGINE=InnoDb;

CREATE TABLE docentes(
	id INT(255) AUTO_INCREMENT NOT NULL,
	cedula INT(255) NOT NULL,
	nombre VARCHAR(100) NOT NULL,
	apellidos VARCHAR(255),
	email VARCHAR(255) NOT NULL,
	pass VARCHAR(255) NOT NULL,
	estado VARCHAR(255) NOT NULL,
	CONSTRAINT pk_docentes PRIMARY KEY(id),
	CONSTRAINT uq_cedula UNIQUE(cedula),
	CONSTRAINT uq_email UNIQUE(email)
)ENGINE=InnoDb;

CREATE TABLE asignaturas(
	id INT(255) AUTO_INCREMENT NOT NULL,
	iddocente INT NOT NULL,
	asignatura VARCHAR(255) NOT NULL,
	CONSTRAINT pk_asignaturas PRIMARY KEY(id),
	CONSTRAINT fk_asignaturas_docente FOREIGN KEY(iddocente) REFERENCES docentes(id)
)ENGINE=InnoDb;

CREATE TABLE asesorias(
	id INT(255) AUTO_INCREMENT NOT NULL,
	iddocente INT(255) NOT NULL,
	idasignatura INT(255) NOT NULL,
	title VARCHAR(255) NOT NULL,
	descripcion TEXT,
	start DATETIME NOT NULL,
	end DATETIME NOT NULL,
	color VARCHAR(255) NOT NULL,
	colorText VARCHAR(255) NOT NULL,
	estado VARCHAR(255) NOT NULL,
	modalidad VARCHAR(255) NOT NULL,
	comentario VARCHAR(255),
	fecha DATETIME NOT NULL,
	CONSTRAINT pk_asesorias PRIMARY KEY(id),
	CONSTRAINT fk_asesorias_docente FOREIGN KEY(iddocente) REFERENCES docentes(id),
	CONSTRAINT fk_asesorias_asignatura FOREIGN KEY(idasignatura) REFERENCES asignaturas(id)
)ENGINE=InnoDb;

CREATE TABLE estudiantes_asesorias(
	id INT(255) AUTO_INCREMENT NOT NULL,
	idestudiante INT(255) NOT NULL,
	idasesoria INT(255) NOT NULL,
	CONSTRAINT pk_usuarios_asesorias PRIMARY KEY(id),
	CONSTRAINT fk_usuarios_asesorias_estudiante FOREIGN KEY(idestudiante) REFERENCES estudiantes(id), 
	CONSTRAINT fk_usuarios_asesorias_asesorias FOREIGN KEY(idasesoria) REFERENCES asesorias(id) 
)ENGINE=InnoDb;

CREATE TABLE repositorios(
	id INT(255) AUTO_INCREMENT NOT NULL,
	idasesoria INT(255) NOT NULL,
	link TEXT NOT NULL,
	notas TEXT,
	idCreador INT NOT NULL,
	fecha DATETIME,
	CONSTRAINT pk_repositorios PRIMARY KEY(id),
	CONSTRAINT fk_repositorios_asesoria FOREIGN KEY(idasesoria) REFERENCES asesorias(id)
)ENGINE=InnoDb;