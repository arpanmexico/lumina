/*   -----
     CREAR VISTA PARA CONTAR LOS INGRESOS  <<POR MES>>
-----    */

DROP VIEW IF EXISTS getSoldByMonth;
CREATE VIEW getSoldByMonth AS
SELECT (SELECT  SUM(total)
        FROM ventas
        WHERE (month(fecha) = 01)) AS `enero`,
       (SELECT  SUM(total)
        FROM ventas
        WHERE (month(fecha) = 02)) AS `febrero`,
       (SELECT  SUM(total)
        FROM ventas
        WHERE (month(fecha) = 03)) AS `marzo`,
       (SELECT  SUM(total)
        FROM ventas
        WHERE (month(fecha) = 04)) AS `abril`,
       (SELECT  SUM(total)
        FROM ventas
        WHERE (month(fecha) = 05)) AS `mayo`,
       (SELECT  SUM(total)
        FROM ventas
        WHERE (month(fecha) = 06)) AS `junio`,
       (SELECT  SUM(total)
        FROM ventas
        WHERE (month(fecha) = 07)) AS `julio`,
       (SELECT  SUM(total)
        FROM ventas
        WHERE (month(fecha) = 08)) AS `agosto`,
       (SELECT  SUM(total)
        FROM ventas
        WHERE (month(fecha) = 09)) AS `septiembre`,
       (SELECT  SUM(total)
        FROM ventas
        WHERE (month(fecha) = 10)) AS `octubre`,
       (SELECT  SUM(total)
        FROM ventas
        WHERE (month(fecha) = 11)) AS `noviembre`,
       (SELECT  SUM(total)
        FROM ventas
        WHERE (month(fecha) = 12)) AS `diciembre`;
/*   -----
     CREAR VISTA PARA CONTAR LAS SECCIONES VISITADAS
-----    */

DROP VIEW IF EXISTS getViewsBySection;
CREATE VIEW getViewsBySection AS
SELECT (SELECT  COUNT(id_estadistica)
        FROM estadisticas
        WHERE (accion = 'visita' AND seccion = 'index')) AS `inicio`,
       (SELECT  COUNT(id_estadistica)
        FROM estadisticas
        WHERE (accion = 'visita' AND seccion = 'quienes_somos')) AS `quienes somos`,
        (SELECT  COUNT(id_estadistica)
        FROM estadisticas
        WHERE (accion = 'visita' AND seccion = 'servicios')) AS `servicios`,
        (SELECT  COUNT(id_estadistica)
        FROM estadisticas
        WHERE (accion = 'visita' AND seccion = 'tienda')) AS `tienda`,
        (SELECT  COUNT(id_estadistica)
        FROM estadisticas
        WHERE (accion = 'visita' AND seccion = 'agenda')) AS `calendario`,
        (SELECT  COUNT(id_estadistica)
        FROM estadisticas
        WHERE (accion = 'visita' AND seccion = 'contacto')) AS `contacto`;
/*   -----
     CREAR VISTA PARA CONTAR LAS CLICKS POR SECCION
-----    */

DROP VIEW IF EXISTS getClicksBySection;
CREATE VIEW getClicksBySection AS
SELECT (SELECT  COUNT(id_estadistica)
        FROM estadisticas
        WHERE (accion = 'click' AND seccion = 'index')) AS `inicio`,
       (SELECT  COUNT(id_estadistica)
        FROM estadisticas
        WHERE (accion = 'click' AND seccion = 'quienes_somos')) AS `quienes somos`,
        (SELECT  COUNT(id_estadistica)
        FROM estadisticas
        WHERE (accion = 'click' AND seccion = 'servicios')) AS `servicios`,
        (SELECT  COUNT(id_estadistica)
        FROM estadisticas
        WHERE (accion = 'click' AND seccion = 'tienda')) AS `tienda`,
        (SELECT  COUNT(id_estadistica)
        FROM estadisticas
        WHERE (accion = 'click' AND seccion = 'agenda')) AS `calendario`,
        (SELECT  COUNT(id_estadistica)
        FROM estadisticas
        WHERE (accion = 'click' AND seccion = 'contacto')) AS `contacto`;
/*   -----
     CREAR VISTA PARA CONTAR LAS CITAS POR HORA
-----    */

DROP VIEW IF EXISTS getQuotesByHour;
CREATE VIEW getQuotesByHour AS
SELECT count(id_estadistica) citas, hour(creado) AS hora
FROM estadisticas WHERE accion = 'cita'
GROUP BY hora ORDER BY citas DESC LIMIT 5;
/*   -----
     CREAR VISTA PARA CONTAR LOS CONTACTOS POR HORA
-----    */

DROP VIEW IF EXISTS getContactByHour;
CREATE VIEW getContactByHour AS
SELECT count(id_estadistica) correos, hour(creado) AS hora
FROM estadisticas WHERE accion = 'correo'
GROUP BY hora ORDER BY correos DESC LIMIT 5;
/*   -----
     CREAR VISTA PARA CONTAR LOS COMENTARIOS POR HORA
-----    */

DROP VIEW IF EXISTS getCommentsByHour;
CREATE VIEW getCommentsByHour AS
SELECT count(id_estadistica) comentarios, hour(creado) AS hora
FROM estadisticas WHERE accion = 'comentario'
GROUP BY hora ORDER BY comentarios DESC LIMIT 5;


        

