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
        IN _type enum('Lente','Marca','Enfermedad', 'Proveedor'), IN _action int(1))
    BEGIN
        SET @category_key = CONCAT('LUM',UPPER(SUBSTR(_type, 1, 3)),
                CONCAT(FLOOR(RAND() * (100 - 5 + 1) + 5), SECOND(CURRENT_TIME)));

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


/*   -----  PROCEDIMIENTO PARA ADMINISTRAR LA SECCIÓN << ARMAZONES >>   -----   */
DROP PROCEDURE IF EXISTS framesManager;
DELIMITER ;
    CREATE PROCEDURE framesManager(IN _id_frame bigint(20), IN _id_brand varchar(20), IN _model varchar(20),
        IN _color char(20), IN _description text, IN _price float, IN _stock int(5), IN _id_supplier varchar(20),
        IN _picture text, IN _action int(1))
    BEGIN
        SET @current_time_mx = CONVERT_TZ(current_timestamp,'GMT','America/Mexico_City');
        SET @_color = CONCAT(UCASE(LOWER(LEFT(_color, 1))), SUBSTRING(LOWER(_color), 2));
        SET @_description = CONCAT(UCASE(LOWER(LEFT(_description, 1))), SUBSTRING(LOWER(_description), 2));

        IF _action = 1 THEN # INSERT DATA
            INSERT INTO armazones(id_armazon, id_marca, modelo, color, descripcion, precio, existencias,
                id_proveedor, foto, suspendido, ingresado, actualizado) VALUES (_id_frame, _id_brand, _model, @_color, @_description, _price, _stock, _id_supplier, _picture, 0, @current_time_mx, @current_time_mx);
        ELSEIF _action = 2 THEN # UPDATE DATA
            UPDATE armazones SET id_marca = _id_brand, modelo = _model, color = _color,
                descripcion = _description, precio = _price, existencias = _stock, id_proveedor = _id_supplier, actualizado = @current_time_mx WHERE id_armazon = _id_frame;
        ELSEIF _action = 3 THEN # UPDATE STOCK
            UPDATE armazones SET existencias = _stock WHERE id_armazon = _id_frame;
        ELSEIF _action = 4 THEN # DELETE DATA
            UPDATE armazones SET suspendido = 1 WHERE id_armazon = _id_frame;
        ELSEIF _action = 5 THEN # RESTORE DATA
            UPDATE armazones SET suspendido = 0 WHERE id_armazon = _id_frame;
        ELSE
            SELECT 'No seleccionaste una accion' AS message;
        END IF;
    END;
DELIMITER ;