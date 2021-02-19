USE lumina;

/*   -----   PROCEDIMIENTO PARA INICIAR SESIÓN   -----   */
DROP PROCEDURE IF EXISTS userLogin;
DELIMITER $$
    CREATE PROCEDURE userLogin(IN _user_id bigint(10), IN _user_pass varchar(255))
    BEGIN
        SELECT id_usuario FROM usuarios WHERE id_usuario = _user_id AND acceso = _user_pass;
    END;
DELIMITER $$

/*   -----   PROCEDIMIENTO PARA GUARDAR COMENTARIOS DEL LANDING PAGE   -----   */
DROP PROCEDURE IF EXISTS saveLandingComments;
DELIMITER $$
    CREATE PROCEDURE saveLandingComments(IN _user_name char(255), IN _user_email varchar(255),
        IN _subject char(200), IN _message text)
    BEGIN
        INSERT INTO comentarios(nombre, correo, asunto, mensaje) VALUES (_user_name, _user_email, _subject, _message);
    END ;
DELIMITER $$

/*   -----  PROCEDIMIENTO PARA ADMINISTRAR LA SECCIÓN << SUCURSAL >>   -----   */
DROP PROCEDURE IF EXISTS branchManager;
DELIMITER $$
    CREATE PROCEDURE branchManager(IN _id_branch bigint(10), IN _name char(150), IN _address varchar(255),
        IN _primary_phone bigint(10), IN _secondary_phone bigint(10), IN _email varchar(255),
        IN _medical_check_price float, IN _action int(1))
    BEGIN
        IF _action = 1 THEN # INSERT DATA
            INSERT INTO sucursal(nombre, direccion, telefono_primario, telefono_secundario, correo, costo_consulta)
                VALUES (_name, _address, _primary_phone, _secondary_phone, _email, _medical_check_price);

        ELSEIF _action = 2 THEN # UPDATE DATA
            UPDATE sucursal SET nombre = _name, direccion = _address, telefono_primario = _primary_phone,
                                telefono_secundario = _secondary_phone, correo = _email,
                                costo_consulta = _medical_check_price WHERE id_sucursal = _id_branch;

        ELSEIF _action = 3 THEN # DELETE DATA
            DELETE FROM sucursal WHERE id_sucursal = _id_branch;
        ELSE
            SELECT 'No seleccionaste una accion' AS message;
        END IF ;
    END ;
DELIMITER $$

/*   -----  PROCEDIMIENTO PARA ADMINISTRAR LA SECCIÓN << CATEGORÍAS >>   -----   */
DROP PROCEDURE IF EXISTS categoriesManager;
DELIMITER ;
    CREATE PROCEDURE categoriesManager(IN _id_category varchar(20), IN _name char(200),
        IN _type enum('Lente','Marca','Enfermedad'), IN _action int(1))
    BEGIN
        SET @category_key = CONCAT('LUM',UPPER(SUBSTR(_name, 1, 3)), second(CURRENT_TIME));

        IF _action = 1 THEN # INSERT DATA
            INSERT INTO categorias(id_categoria, nombre, tipo) VALUES (@category_key, _name, _type);
        ELSEIF _action = 2 THEN # UPDATE DATA
            UPDATE categorias SET nombre = _name, tipo = _type WHERE id_categoria = _id_category;
        ELSEIF _action = 3 THEN # DELETE DATA
            DELETE FROM categorias WHERE id_categoria = _id_category;
        ELSE
            SELECT 'No seleccionaste una accion' AS message;
        END IF ;
    END ;
DELIMITER ;