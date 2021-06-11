DROP DATABASE IF EXISTS lumina;
CREATE DATABASE lumina  CHARACTER SET UTF8 COLLATE utf8_general_ci;
USE lumina;

/*   -----   TABLA PARA COMENTARIOS DE LA PÁGINA PRINCIPAL   -----   */
DROP TABLE IF EXISTS comentarios;
CREATE TABLE comentarios(
    id_comentario int(5) PRIMARY KEY AUTO_INCREMENT,
    nombre char(255) NOT NULL,
    correo varchar(255) NOT NULL,
    asunto char(200) NOT NULL,
    mensaje text NOT NULL,
    ingresado timestamp NOT NULL,
    respondido timestamp NOT NULL
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
    id_categoria varchar(20) UNIQUE PRIMARY KEY NOT NULL, #El id se define desde un procedimiento
    nombre char(200) UNIQUE NOT NULL,
    tipo enum('Lente','Marca','Enfermedad', 'Proveedor') NOT NULL
);

/*   -----  TABLA PARA ADMINISTRAR LOS ARMAZONES   -----   */
DROP TABLE IF EXISTS armazones;
CREATE TABLE armazones(
    id_armazon bigint(20) PRIMARY KEY NOT NULL, # Codigo de barra
    id_marca varchar(20) NOT NULL, # Llave foranea
    id_tipo varchar(20) NOT NULL,  # es el mismo que id de marca pero será para los productos variossin ser foraneo parano hacer conflicto
    modelo varchar(200) NOT NULL,
    color text NOT NULL,
    descripcion text NOT NULL,
    precio float NOT NULL,
    existencias int(5) NOT NULL,
    id_proveedor varchar(20) NOT NULL, # Llave foranea
    foto text NULL,
    suspendido bool NOT NULL,

    ingresado timestamp NOT NULL,
    actualizado timestamp NOT NULL,

    FOREIGN KEY (id_marca) REFERENCES categorias(id_categoria) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (id_proveedor) REFERENCES categorias(id_categoria) ON DELETE CASCADE ON UPDATE CASCADE
);

/*   -----  TABLA PARA ADMINISTRAR LOS DOCTORES   -----   */
DROP TABLE IF EXISTS doctores;
CREATE TABLE doctores(
    id_doctor bigint(20) PRIMARY KEY NOT NULL, # Codigo de barra
    nombre char(200) NOT NULL,
    apellido char(200) NOT NULL,
    telefono bigint(15) NOT NULL,
    especialidad text NOT NULL,
    estado enum('Activo', 'Inactivo') NOT NULL,
    suspendido bool NOT NULL,

    ingresado timestamp NOT NULL,
    actualizado timestamp NOT NULL
);

/*   -----  TABLA PARA ADMINISTRAR LOS PACIENTES   -----   */
DROP TABLE IF EXISTS pacientes;
CREATE TABLE pacientes(
    id_paciente varchar(20) PRIMARY KEY NOT NULL, # Codigo Autogenerado
    nombre char(200) NOT NULL,
    apellido_paterno char(200) NOT NULL,
    apellido_materno char(200) NOT NULL,
    nacimiento varchar(12) NOT NULL,
    correo varchar(255) NOT NULL,
    ocupacion char(200) NOT NULL,
    direccion varchar(255) NOT NULL,
    genero enum('M','F') NOT NULL,
    telefono_primario bigint(10) UNIQUE NOT NULL,
    telefono_secundario bigint(10) UNIQUE NOT NULL,
    suspendido bool NOT NULL,

    ingresado timestamp NOT NULL,
    actualizado timestamp NOT NULL
);

/*   -----  TABLA PARA ADMINISTRAR LOS HISTORIALES   -----   */
DROP TABLE IF EXISTS historiales;
CREATE TABLE historiales(
    id_historial varchar(20) PRIMARY KEY NOT NULL, # Codigo Autogenerado
    id_paciente varchar(20) NOT NULL,
    antecedentes_pat_generales text,
    antecedentes_pat_oculares text,
    motivo_consulta text,
    ultimo_examen text,
    odAVLejosSRX float,
    odCVLejos float,
    odAVCercaSRX float,
    odAVLejosRX float,
    odAVCercaRX float,
    ioAVLejosSRX float,
    ioCVLejos float,
    ioAVCercaSRX float,
    ioAVLejosRX float,
    ioAVCercaRX float,
    rxodEsfera float,
    rxodCilindro float,
    rxodEje float,
    rxodAdd float,
    rxodDip float,
    rxioEsfera float,
    rxioCilindro float,
    rxioEje float,
    rxioAdd float,
    rxioDip float,
    observaciones text,
    tipo_vision float,
    tipo_lente float,
    folio varchar(50) NOT NULL,

    validacion_medico bool NOT NULL,
    validacion_paciente bool NOT NULL,

    ingresado timestamp NOT NULL,
    actualizado timestamp NOT NULL,

    FOREIGN KEY (id_paciente) REFERENCES pacientes(id_paciente) ON DELETE CASCADE ON UPDATE CASCADE
);

/*   -----   TABLA PARA ADMINITRAR LA AGENDA DE CITAS   -----   */
DROP TABLE IF EXISTS citas;
CREATE TABLE citas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL, 
    apellidos VARCHAR(100) NOT NULL,
    telefono bigint(10) NOT NULL,
    descripcion TEXT,
    title VARCHAR(160),
    date DATETIME NOT NULL,  
    color VARCHAR(15) DEFAULT '#673AB7' 
);

/* ---- TABLA PARA ADMINISTRAR LAS VENTAS -----   */
DROP TABLE IF EXISTS ventas;
CREATE TABLE ventas(
    id_venta INT AUTO_INCREMENT PRIMARY KEY,
    id_paciente VARCHAR(20),
    productos TEXT, #ID de los productos vendidos
    nombre VARCHAR(200) NOT NULL, 
    apellidos VARCHAR(200) NOT NULL,
    fecha DATETIME NOT NULL,
    tipo_pago enum('E', 'T') NOT NULL, 
    modalidad_pago enum('C', 'MSI', 'MCI') NOT NULL,
    tipo_descuento enum('NA', 'T', 'P', 'D') DEFAULT 'NA',
    descuento FLOAT(10) DEFAULT 0.0,
    anticipo FLOAT(10) DEFAULT 0.0,
    mensualidades INT(10) DEFAULT 0,
    precio_mes FLOAT(15) DEFAULT 0.0,
    interes FLOAT(10) DEFAULT 0.0,
    total FLOAT(10) NOT NULL,
    creado TIMESTAMP NOT NULL,
    actualizado TIMESTAMP
);

/* ---- TABLA PARA LAS ESTADISTICAS DEL LANDING PAGE -----   */
DROP TABLE IF EXISTS estadisticas;
CREATE TABLE estadisticas(
    id_estadistica INT AUTO_INCREMENT PRIMARY KEY,
    accion enum('click', 'visita', 'comentario', 'cita', 'correo'), 
    seccion enum('index', 'quienes_somos', 'servicios', 'tienda', 'agenda', 'contacto'),
    creado TIMESTAMP NOT NULL,
    actualizado TIMESTAMP
);

/*  ------  TABLA PARA EL CENTRO DE ALERTAS  -----   */
CREATE TABLE alertas(
    id_alerta int(5) PRIMARY KEY AUTO_INCREMENT,
    mensaje text NOT NULL,
    seccion enum('Categorias','Productos','Doctores','Pacientes','Ventas','Citas') NOT NULL,
    tipo enum('Informacion','Advertencia','Alerta') NOT NULL,
    fecha timestamp NOT NULL
);
/*  ------  TABLA PARA LOS MENSAJES DEL TICKET  -----   */
CREATE TABLE ticket(
    id_ticket int(5) PRIMARY KEY AUTO_INCREMENT,
    mensaje text NOT NULL,
    estatus bool NOT NULL,
    fecha timestamp NOT NULL
);
/*  ------  TABLA PARA LAS SALIDAS DE DINERO  -----   */
CREATE TABLE salidas(
    id_salida int(5) PRIMARY KEY AUTO_INCREMENT,
    monto DOUBLE,
    concepto text NOT NULL,
    fecha timestamp NOT NULL
);