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

DROP TABLE subCategoria;
/* Tabla subcategoria */
CREATE TABLE subCategoria(
    idsubcategoria INT AUTO_INCREMENT PRIMARY KEY, 
    subcategoria   VARCHAR(50) NOT NULL,
    idcategoria    INT NOT NULL,
    CONSTRAINT fk_idcategoria FOREIGN KEY (idcategoria) REFERENCES categoria(idcategoria)
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
    ('Razonamiento Lógico',1),
    ('Matematica',1),
    ('Trigonometría',1),
    ('La geometria',1),
    ('Dimensiones',1),
    ('Topologia',1),
    ('Fisica Matematica',1),
    ('Aritmetica',1),
    ('Razonamiento Verbal',2),
    ('Composicion',2),
    ('Redaccion',2),
    ('tipografia',2),
    ('Linguistica',2),
    ('Analisis de Textos',2),
    ('Oratoria',2),
    ('Produccion de textos',2),
    ('Desarrollo Web',3),
    ('Desarrollo de Video Juegos',3),
    ('Inteligencia Artificial',3),
    ('Administracion de base De Datos',3),
    ('Desarrollo de Aplicaciones',3),
    ('Diseño Grafico',3);



INSERT INTO editoriales (editorial, nacionalidad) VALUES
    ('Planeta', 'España'),
    ('Santillana', 'Perú'),
    ('Norma', 'Colombia');
