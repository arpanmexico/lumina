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
    CREATE PROCEDURE saveLandingComments(IN _id_comentario int(5), IN _user_name char(255), IN _user_email varchar(255), IN _subject char(200), IN _message text, IN _action int)
    BEGIN
        SET @current_time_mx = CONVERT_TZ(current_timestamp,'GMT','America/Mexico_City');

        IF _action = 1 THEN # INSERT DATA
            INSERT INTO comentarios(nombre, correo, asunto, mensaje, ingresado, respondido) VALUES (_user_name, _user_email, _subject, _message, @current_time_mx, @current_time_mx);
        ELSEIF _action = 2 THEN # UPDATE DATA
            UPDATE comentarios SET respondido = @current_time_mx WHERE id_comentario = _id_comentario;
        END IF;
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
    CREATE PROCEDURE framesManager(IN _id_frame bigint(20), IN _id_brand varchar(20), IN _id_tipo varchar(20), IN _model varchar(20),
        IN _color text, IN _description text, IN _price float, IN _stock int(5), IN _id_supplier varchar(20),
        IN _picture text, IN _action int(1))
    BEGIN
        SET @current_time_mx = CONVERT_TZ(current_timestamp,'GMT','America/Mexico_City');
        SET @_color = CONCAT(UCASE(LOWER(LEFT(_color, 1))), SUBSTRING(LOWER(_color), 2));
        SET @_description = CONCAT(UCASE(LOWER(LEFT(_description, 1))), SUBSTRING(LOWER(_description), 2));

        IF _action = 1 THEN # INSERT DATA
            INSERT INTO armazones(id_armazon, id_marca, id_tipo, modelo, color, descripcion, precio_publico, existencias,
                id_proveedor, foto, suspendido, ingresado, actualizado) VALUES (_id_frame, _id_brand, _id_tipo, _model, @_color, @_description, _price, _stock, _id_supplier, _picture, 0, @current_time_mx, @current_time_mx);
        ELSEIF _action = 2 THEN # UPDATE DATA
            UPDATE armazones SET id_marca = _id_brand, id_tipo = _id_tipo, modelo = _model, color = _color,
                descripcion = _description, precio_publico = _price, existencias = _stock, id_proveedor = _id_supplier, actualizado = @current_time_mx WHERE id_armazon = _id_frame;
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

/*  -----   PROCEDIMIENTO PARA ADMINISTRAR DOCTORES -----   */
DROP PROCEDURE IF EXISTS doctorsManager;
DELIMITER ;
    CREATE PROCEDURE doctorsManager(IN _id_doctor bigint(20), IN _nombre char(200), IN _apellido char(200), IN _telefono bigint(15), IN _especialidad text, IN _estado enum('Activo', 'Inactivo'), IN _accion int(1))
    BEGIN
        SET @current_time_mx = CONVERT_TZ(current_timestamp,'GMT','America/Mexico_City');

        IF _accion = 1 THEN # INSERT DATA
            INSERT INTO doctores(id_doctor, nombre, apellido, telefono, especialidad, estado, suspendido, ingresado, actualizado) VALUES (_id_doctor, _nombre, _apellido, _telefono, _especialidad, _estado, 0, @current_time_mx, @current_time_mx);

        ELSEIF _accion = 2 THEN # UPDATE DATA
            UPDATE doctores SET nombre = _nombre, apellido = _apellido, telefono = _telefono, especialidad = _especialidad, estado = _estado, actualizado = @current_time_mx WHERE id_doctor = _id_doctor;

        ELSEIF _accion = 3 THEN # SUSPEND DATA
            UPDATE doctores SET suspendido = 1 WHERE id_doctor = _id_doctor;

        ELSEIF _accion = 4 THEN # RESTORE DATA
            UPDATE doctores SET suspendido = 0 WHERE id_doctor = _id_doctor;

        ELSE
            SELECT 'No seleccionaste una accion' AS message;
        END IF;
    END ;
DELIMITER ;

/*  -----   PROCEDIMIENTO PARA ADMINISTRAR PACIENTES -----   */
DROP PROCEDURE IF EXISTS patientsManager;
DELIMITER ;
    CREATE PROCEDURE patientsManager(IN _id_paciente varchar(20), IN _nombre char(200), IN _apellido_paterno char(200), IN _apellido_materno char(200), IN _nacimiento varchar(12), IN _correo varchar(255), IN _ocupacion char(200), IN _direccion varchar(255), IN _genero enum('M','F'), IN _telefono_primario bigint(10), IN _telefono_secundario bigint(10), IN _accion int(1))
    BEGIN
        SET @current_time_mx = CONVERT_TZ(current_timestamp,'GMT','America/Mexico_City');

        SET @patient_key = CONCAT(UPPER(SUBSTR(_nombre, 1, 2)), UPPER(SUBSTR(_apellido_paterno, 1, 2)), UPPER(SUBSTR(_apellido_materno, 1, 2)), FLOOR(RAND() * (100 - 5 + 1) + 5), SECOND(CURRENT_TIME));

        IF _accion = 1 THEN # INSERT DATA
            INSERT INTO pacientes(id_paciente, nombre, apellido_paterno, apellido_materno, nacimiento, correo, ocupacion, direccion, genero, telefono_primario, telefono_secundario, suspendido, ingresado, actualizado) VALUES (@patient_key, _nombre, _apellido_paterno, _apellido_materno, _nacimiento, _correo, _ocupacion, _direccion, _genero, _telefono_primario, _telefono_secundario, 0, @current_time_mx, @current_time_mx);

        ELSEIF _accion = 2 THEN # UPDATE DATA
            UPDATE pacientes SET nombre = _nombre, apellido_paterno = _apellido_paterno, apellido_materno = _apellido_materno, nacimiento = _nacimiento, ocupacion = _ocupacion, correo = _correo, direccion = _direccion, genero = _genero, telefono_primario = _telefono_primario, telefono_secundario = _telefono_secundario, actualizado = @current_time_mx WHERe id_paciente = _id_paciente;

        ELSEIF _accion = 3 THEN # SUSPEND DATA
            UPDATE pacientes SET suspendido = 1 WHERE id_paciente = _id_paciente;

        ELSEIF _accion = 4 THEN # RESTORE DATA
            UPDATE pacientes SET suspendido = 0 WHERE id_paciente = _id_paciente;
        END IF;
    END ;
DELIMITER ;

/*  -----   PROCEDIMIENTO PARA ADMINISTRAR HISTORIALES -----   */
DROP PROCEDURE IF EXISTS clinicalHistory;
DELIMITER ;
    CREATE PROCEDURE clinicalHistory(IN _id_historial varchar(20), IN _id_paciente varchar(20), IN _antecedentes_pat_generales text, IN _antecedentes_pat_oculares text, IN _motivo_consulta text, IN _ultimo_examen text, IN _odAVLejosSRX float, IN _odCVLejos float,
    IN _odAVCercaSRX float, IN _odAVLejosRX float, IN _odAVCercaRX float, IN _ioAVLejosSRX float, IN _ioCVLejos float, IN _ioAVCercaSRX float, IN _ioAVLejosRX float, IN _ioAVCercaRX float, IN _rxodEsfera float, IN _rxodCilindro float, IN _rxodEje float, IN _rxodAdd float,
    IN _rxodDip float, IN _rxioEsfera float, IN _rxioCilindro float, IN _rxioEje float,
    IN _rxioAdd float, IN _rxioDip float, IN _observaciones text, IN _tipo_vision float,
    IN _tipo_lente float, IN _folio varchar(50), IN _validacion_medico bool, IN _validacion_paciente bool, IN _accion int)
    BEGIN

        SET @history_key =  CONCAT(_id_paciente, CONCAT(FLOOR(RAND() * (100 - 5 + 1) + 5), SECOND(CURRENT_TIME)));
        SET @current_time_mx = CONVERT_TZ(current_timestamp,'GMT','America/Mexico_City');

        IF _accion = 1 THEN # INSERT DATA
            INSERT INTO historiales(id_historial, id_paciente, antecedentes_pat_generales, antecedentes_pat_oculares, motivo_consulta, ultimo_examen, odAVLejosSRX, odCVLejos, odAVCercaSRX, odAVLejosRX, odAVCercaRX, ioAVLejosSRX, ioCVLejos, ioAVCercaSRX, ioAVLejosRX, ioAVCercaRX, rxodEsfera, rxodCilindro, rxodEje, rxodAdd, rxodDip, rxioEsfera, rxioCilindro, rxioEje, rxioAdd, rxioDip, observaciones, tipo_vision, tipo_lente, folio, validacion_medico, validacion_paciente, ingresado, actualizado) VALUES (@history_key, _id_paciente, _antecedentes_pat_generales, _antecedentes_pat_oculares, _motivo_consulta, _ultimo_examen, _odAVLejosSRX, _odCVLejos, _odAVCercaSRX, _odAVLejosRX, _odAVCercaRX, _ioAVLejosSRX, _ioCVLejos, _ioAVCercaSRX, _ioAVLejosRX, _ioAVCercaRX, _rxodEsfera, _rxodCilindro, _rxodEje, _rxodAdd, _rxodDip, _rxioEsfera, _rxioCilindro, _rxioEje, _rxioAdd, _rxioDip, _observaciones, _tipo_vision, _tipo_lente, _folio, _validacion_medico, _validacion_paciente, @current_time_mx, @current_time_mx);
        END IF;
    END ;
DELIMITER ;


/*   -----  PROCEDIMIENTO PARA ADMINISTRAR LA SECCIÓN << VENTAS >>   -----   */
DROP PROCEDURE IF EXISTS sellsManager;
DELIMITER ;
    CREATE PROCEDURE sellsManager(IN _id_paciente varchar(20), IN _productos TEXT, IN _nombre varchar(200), IN _apellidos varchar(200), IN _fecha DATETIME, IN _tipo_pago enum('E', 'T'), IN _modalidad_pago enum('C', 'MSI', 'MCI'), IN _tipo_descuento enum('NA', 'T', 'P', 'D'),IN _descuento FLOAT(10) , IN _anticipo FLOAT, IN _mensualidaes INT(10), IN _precio_mes FLOAT(15), IN _interes FLOAT(10), IN _total FLOAT(10), IN _cantidad TEXT, IN _action INT(1))
    BEGIN
        SET @current_time_mx = CONVERT_TZ(current_timestamp,'GMT','America/Mexico_City');

        IF _action = 1 THEN # INSERT DATA
            INSERT INTO ventas(id_paciente, productos, nombre, apellidos, fecha, tipo_pago, modalidad_pago, tipo_descuento, descuento, anticipo, mensualidades, precio_mes, interes, total, creado,actualizado) VALUES (_id_paciente, _productos, _nombre, _apellidos, _fecha, _tipo_pago, _modalidad_pago, _tipo_descuento, _descuento, _anticipo, _mensualidaes, _precio_mes, _interes, _total, @current_time_mx, @current_time_mx);
        END IF;
    END;
DELIMITER ;

/*   -----  PROCEDIMIENTO PARA ACTUALIZAR EL STOCK << VENTAS >>   -----   */
DROP PROCEDURE IF EXISTS updateStock;
DELIMITER ;
    CREATE PROCEDURE updateStock(IN _producto bigint(20), IN _cantidad INT(5))
    BEGIN
        UPDATE armazones SET existencias = armazones.existencias - _cantidad WHERE id_armazon = _producto;
    END;
DELIMITER ;

DROP PROCEDURE IF EXISTS getSoldByMonthByYear;
DELIMITER ;
CREATE PROCEDURE getSoldByMonthByYear(IN _year varchar(20))
BEGIN
   SELECT (SELECT  SUM(total)
        FROM ventas
        WHERE (month(fecha) = 01) AND year(fecha) = _year) AS `enero`,
       (SELECT  SUM(total)
        FROM ventas
        WHERE (month(fecha) = 02) AND year(fecha) = _year) AS `febrero`,
       (SELECT  SUM(total)
        FROM ventas
        WHERE (month(fecha) = 03) AND year(fecha) = _year) AS `marzo`,
       (SELECT  SUM(total)
        FROM ventas
        WHERE (month(fecha) = 04) AND year(fecha) = _year) AS `abril`,
       (SELECT  SUM(total)
        FROM ventas
        WHERE (month(fecha) = 05) AND year(fecha) = _year) AS `mayo`,
       (SELECT  SUM(total)
        FROM ventas
        WHERE (month(fecha) = 06) AND year(fecha) = _year) AS `junio`,
       (SELECT  SUM(total)
        FROM ventas
        WHERE (month(fecha) = 07) AND year(fecha) = _year) AS `julio`,
       (SELECT  SUM(total)
        FROM ventas
        WHERE (month(fecha) = 08) AND year(fecha) = _year) AS `agosto`,
       (SELECT  SUM(total)
        FROM ventas
        WHERE (month(fecha) = 09) AND year(fecha) = _year) AS `septiembre`,
       (SELECT  SUM(total)
        FROM ventas
        WHERE (month(fecha) = 10) AND year(fecha) = _year) AS `octubre`,
       (SELECT  SUM(total)
        FROM ventas
        WHERE (month(fecha) = 11) AND year(fecha) = _year) AS `noviembre`,
       (SELECT  SUM(total)
        FROM ventas
        WHERE (month(fecha) = 12) AND year(fecha) = _year) AS `diciembre`;
END;
DELIMITER ;

/*   -----  PROCEDIMIENTO PARA REGISTRAR LAS ESTADISTICAS   -----   */
DROP PROCEDURE IF EXISTS manageStats;
DELIMITER ;
    CREATE PROCEDURE manageStats(IN _accion enum('click', 'visita', 'comentario', 'cita', 'correo'), IN _seccion enum('index', 'quienes_somos', 'servicios', 'tienda', 'agenda', 'contacto'), IN _action INT(1))
    BEGIN
        SET @current_time_mx = CONVERT_TZ(current_timestamp,'GMT','America/Mexico_City');

        IF _action = 1 THEN # INSERT DATA
            INSERT INTO estadisticas(accion, seccion, creado) VALUES (_accion, _seccion, @current_time_mx);
        END IF;
    END;
DELIMITER ;

/*   -----  PROCEDIMIENTO PARA ADMINISTRAR EL CENTRO DE ALERTAS   -----   */
DROP PROCEDURE IF EXISTS manageAlertCenter;
DELIMITER ;
    CREATE PROCEDURE manageAlertCenter(IN _id_alerta int(5), IN _mensaje text, IN _seccion enum('Categorias','Productos','Doctores', 'Pacientes','Ventas','Citas'), IN _tipo enum('Informacion','Advertencia','Alerta'), IN _accion int(1))
    BEGIN
        SET @current_time_mx = CONVERT_TZ(current_timestamp,'GMT','America/Mexico_City');

        IF _accion = 1 THEN # INSERT DATA
            INSERT INTO alertas(mensaje, seccion, tipo, fecha) VALUES (_mensaje, _seccion, _tipo, @current_time_mx);
        END IF;
    END;
DELIMITER ;
/*   -----  PROCEDIMIENTO PARA ADMINISTRAR EL TICKET   -----   */
DROP PROCEDURE IF EXISTS manageTicket;
DELIMITER ;
    CREATE PROCEDURE manageTicket(IN _id_ticket int(5), IN _mensaje text, IN _accion int(1))
    BEGIN
        SET @current_time_mx = CONVERT_TZ(current_timestamp,'GMT','America/Mexico_City');

        IF _accion = 1 THEN # INSERT DATA
            UPDATE ticket set estatus = 0 WHERE id_ticket != -id_ticket;
            INSERT INTO ticket(mensaje, estatus, fecha) VALUES (_mensaje, 1, @current_time_mx);
        ELSEIF _accion = 2 THEN # UPDATE DATA
            UPDATE ticket SET mensaje = _mensaje WHERE id_ticket = _id_ticket;
        END IF;
    END;
DELIMITER ;

/*   -----  PROCEDIMIENTO PARA ADMINISTRAR LAS SALIDAS DE DINERO   -----   */
DROP PROCEDURE IF EXISTS manageMoneyOut;
DELIMITER ;
    CREATE PROCEDURE manageMoneyOut(IN _id_salida int(5), IN _monto DOUBLE, IN _concepto text, IN _accion int(1))
    BEGIN
        SET @current_time_mx = CONVERT_TZ(current_timestamp,'GMT','America/Mexico_City');

        IF _accion = 1 THEN # INSERT DATA
            INSERT INTO salidas(monto,concepto, fecha) VALUES (_monto,_concepto, @current_time_mx);
        END IF;
    END;
DELIMITER ;