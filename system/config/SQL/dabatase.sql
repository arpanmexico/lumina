DROP DATABASE IF EXISTS lumina;
CREATE DATABASE lumina  CHARACTER SET UTF8 COLLATE utf8_general_ci;
USE lumina;

/*   -----   TABLA PARA COMENTARIOS DE LA PÁGINA PRINCIPAL   -----   */
DROP TABLE IF EXISTS comentarios;
CREATE TABLE comentarios(
    id_commentario int(5) PRIMARY KEY AUTO_INCREMENT,
    nombre char(255) NOT NULL,
    correo varchar(255) NOT NULL,
    asunto char(200) NOT NULL,
    mensaje text NOT NULL
);

/*   -----  TABLA PARA ALMACENAR ADMINISTRADORES   -----   */
DROP TABLE IF EXISTS usuarios;
CREATE TABLE usuarios(
    id_usuario bigint(20) UNIQUE PRIMARY KEY,
    nombre char(255) UNIQUE NOT NULL,
    acceso varchar(255) UNIQUE NOT NULL
);
INSERT INTO usuarios VALUES('1806141918','Abraham Ayala Padilla',
                         '2e61971a2c1d98b2a46466b0970b4d7d874a325fda7bf0e552863b1e60c9e2db');

/*   -----  TABLA PARA ADMINISTRAR LA SUCURSAL -----   */
DROP TABLE IF EXISTS sucursal;
CREATE TABLE sucursal(
    id_sucursal bigint(20) PRIMARY KEY AUTO_INCREMENT,
    nombre char(150) NOT NULL,
    direccion varchar(255) NOT NULL,
    telefono_primario bigint(10) UNIQUE NOT NULL,
    telefono_secundario bigint(10) UNIQUE NOT NULL,
    correo varchar(255) UNIQUE NOT NULL,
    costo_consulta float NOT NULL
);

/*   -----  TABLA PARA ADMINISTRAR LOS TIPOS DE LENTES, ENFERMEDADES, MARCAS -----   */
DROP TABLE IF EXISTS categorias;
CREATE TABLE categorias(
    id_categoria varchar(20) PRIMARY KEY NOT NULL, #El id se define desde un procedimiento
    nombre char(200) UNIQUE NOT NULL,
    tipo enum('Lente','Marca','Enfermedad') NOT NULL
);

/*   -----  TABLA PARA    -----   */