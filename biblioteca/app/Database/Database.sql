CREATE DATABASE biblioteca;
USE biblioteca;

CREATE TABLE libros(
	id 			INT AUTO_INCREMENT PRIMARY KEY,
	nombre 		VARCHAR(200) 	NOT NULL,
	imagen		VARCHAR(200)	NOT NULL
)ENGINE = INNODB;

INSERT INTO libros (nombre, imagen) VALUES
	('Conociendo el Perú', 'libro1.jpg'),
	('Matemáticas avanzadas', 'libro2.jpg');

CREATE TABLE personas (
	idpersona		INT AUTO_INCREMENT PRIMARY KEY,
    dni				CHAR(8) NOT NULL,
    apellidos 		VARCHAR(40) NOT NULL,
    nombres			VARCHAR(40) NOT NULL,
    telefono		CHAR(9) 	NULL,
    iddistrito		INT 		NOT NULL,
    direccion		VARCHAR(100) NULL,
    CONSTRAINT uk_dni UNIQUE (dni),
    CONSTRAINT fk_iddistrito FOREIGN KEY (iddistrito) REFERENCES distritos (iddistrito)
)ENGINE = INNODB;

/* Tabla categoria */
CREATE TABLE categoria(
    idcategoria INT AUTO_INCREMENT PRIMARY KEY,
    categoria   VARCHAR(50) NOT NULL UNIQUE
)ENGINE = INNODB;

/* Tabla subcategoria */
CREATE TABLE subCategoria(
    idsubcategoria INT AUTO_INCREMENT PRIMARY KEY, 
    subcategoria   VARCHAR(50) NOT NULL UNIQUE,
    idcategoria    INT NOT NULL
)ENGINE = INNODB;

/* Tabla editoriales */
CREATE TABLE editoriales(
    ideditoriales INT AUTO_INCREMENT PRIMARY KEY, 
    editorial     VARCHAR(80) NOT NULL UNIQUE,
    nacionalidad  VARCHAR(100) NOT NULL
)ENGINE = INNODB;

INSERT INTO categoria (categoria) VALUES
    ('Matematicas'),
    ('Comunicacion'),
    ('Computacion');

INSERT INTO subCategoria (subcategoria,idcategoria) VALUES
    ('Matematicas'),
    ('Comunicacion'),
    ('Computacion');