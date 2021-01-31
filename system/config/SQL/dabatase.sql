DROP DATABASE IF EXISTS lumina;
CREATE DATABASE lumina  CHARACTER SET UTF8 COLLATE utf8_general_ci;

/*   -----   TABLA PARA COMENTARIOS DE LA PÁGINA PRINCIPAL   -----   */
CREATE TABLE comments(
    id_comment int(5) PRIMARY KEY AUTO_INCREMENT,
    user_name char(255) NOT NULL,
    user_email varchar(255) NOT NULL,
    subject char(200) NOT NULL,
    message text NOT NULL
);

/*   -----  TABLA PARA ALMACENAR ADMINISTRADORES   -----   */
CREATE TABLE users(
    id_user varchar(255) PRIMARY KEY,
    user_name char(255) UNIQUE NOT NULL,
    user_pass varchar(255) UNIQUE NOT NULL
);