DROP DATABASE IF EXISTS lumina;
CREATE DATABASE lumina  CHARACTER SET UTF8 COLLATE utf8_general_ci;

/*   -----   TABLA PARA COMENTARIOS DE LA PÁGINA PRINCIPAL   -----   */
DROP TABLE IF EXISTS comments;
CREATE TABLE comments(
    id_comment int(5) PRIMARY KEY AUTO_INCREMENT,
    user_name char(255) NOT NULL,
    user_email varchar(255) NOT NULL,
    subject char(200) NOT NULL,
    message text NOT NULL
);

/*   -----  TABLA PARA ALMACENAR ADMINISTRADORES   -----   */
DROP TABLE IF EXISTS users;
CREATE TABLE users(
    id_user bigint(10) UNIQUE PRIMARY KEY,
    user_name char(255) UNIQUE NOT NULL,
    user_pass varchar(255) UNIQUE NOT NULL
);
INSERT INTO users VALUES('1806141918','Abraham Ayala Padilla',
                         '2e61971a2c1d98b2a46466b0970b4d7d874a325fda7bf0e552863b1e60c9e2db');