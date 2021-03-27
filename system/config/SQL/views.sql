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