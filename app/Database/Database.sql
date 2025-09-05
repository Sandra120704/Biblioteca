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
    ideditorial INT AUTO_INCREMENT PRIMARY KEY, 
    editorial   VARCHAR(80) NOT NULL,
    nacionalidad VARCHAR(100) NOT NULL
)ENGINE = INNODB;


CREATE TABLE recursos (
    idrecurso INT AUTO_INCREMENT PRIMARY KEY,
    idsubcategoria INT NOT NULL,
    ideditorial INT NOT NULL,
    tipo ENUM('FISICO','DIGITAL') NOT NULL,
    titulo VARCHAR(200) NOT NULL,
    apublicacion YEAR NOT NULL,
    isbn VARCHAR(20) NOT NULL UNIQUE,
    numpaginas INT NOT NULL,
    rutaportada VARCHAR(200) NOT NULL,
    rutarecurso VARCHAR(200) NULL,
    estado ENUM('BUENO','REGULAR','MALO') NOT NULL,
    creado TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    modificado TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_subcategoria FOREIGN KEY (idsubcategoria) REFERENCES subCategoria(idsubcategoria),
    CONSTRAINT fk_editorial FOREIGN KEY (ideditorial) REFERENCES editoriales(ideditorial)
) ENGINE=InnoDB;



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

DELETE FROM editoriales;

INSERT INTO editoriales (editorial, nacionalidad) VALUES
    ('Santillana', 'Perú'),
    ('Planeta', 'España'),
    ('Norma', 'Colombia'),
    ('McGraw-Hill', 'Estados Unidos'),
    ('Pearson', 'Reino Unido'),
    ('Siglo XXI Editores', 'México');
CREATE VIEW vw_recursos AS
SELECT 
    r.idrecurso,
    r.titulo,
    r.tipo,
    r.apublicacion,
    r.isbn,
    r.numpaginas,
    r.estado,
    r.creado,
    e.editorial,
    e.nacionalidad,
    c.categoria,
    s.subcategoria
FROM recursos r
INNER JOIN editoriales e ON r.ideditorial = e.ideditorial
INNER JOIN subcategoria s ON r.idsubcategoria = s.idsubcategoria
INNER JOIN categoria c ON s.idcategoria = c.idcategoria;

