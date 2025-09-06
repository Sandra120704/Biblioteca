#TAREA 04 – Biblioteca
##Descripción de la tarea

 * Esta tarea consiste en construir la base de datos y vistas para la gestión de recursos de biblioteca, siguiendo los requerimientos del curso Seminario de Complementación Práctica III del SENATI.

Se solicitó:

* Crear 3 tablas básicas con datos iniciales (categorías,   subcategorías, editoriales)

* Crear la tabla principal RECURSOS, con relaciones a las tablas anteriores

* Construir vistas para listar y registrar recursos, usando funcionalidades de frontend modernas (async/await, Toast, SweetAlert)

* Validaciones de campos requeridos

* Presentación visual atractiva (Bootstrap / cards)

````
CREATE TABLE categoria(
    idcategoria INT AUTO_INCREMENT PRIMARY KEY,
    categoria   VARCHAR(50) NOT NULL UNIQUE
)ENGINE = INNODB;
````

````
CREATE TABLE subCategoria(
    idsubcategoria INT AUTO_INCREMENT PRIMARY KEY, 
    subcategoria   VARCHAR(50) NOT NULL,
    idcategoria    INT NOT NULL,
    CONSTRAINT fk_idcategoria FOREIGN KEY (idcategoria) REFERENCES categoria(idcategoria)
)ENGINE = INNODB;

````

````
CREATE TABLE editoriales(
    ideditorial INT AUTO_INCREMENT PRIMARY KEY, 
    editorial   VARCHAR(80) NOT NULL,
    nacionalidad VARCHAR(100) NOT NULL
)ENGINE = INNODB;

````

````

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

````
 **Funcionalidades implementadas**

 * Registrar recurso

 * Formulario en card

 * Campos obligatorios validados

 * Subcategorías cargadas dinámicamente según categoría (async/await)

 * Tipo DIGITAL habilita carga de PDF

 * Confirmación mediante SweetAlert2

 * Mensajes tipo Toast para información adicional

**Listar recursos**

 * Tabla con todos los recursos

 * Información completa usando JOIN con editorial, categoría y subcategoría

 * Visualización de portada en miniatura


**Autor**

 * Nombre: Sandra Geraldine De la Cruz Magallanes

 * Curso: Seminario de Complementación Práctica III 

 * Fecha: 2025