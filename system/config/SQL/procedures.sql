/*   -----   PROCEDIMIENTO PARA INICIAR SESIÓN   -----   */
DROP PROCEDURE IF EXISTS userLogin;
DELIMITER $$
    CREATE PROCEDURE userLogin(IN _user_name varchar(255), IN _user_pass varchar(255))
    BEGIN
        SELECT DISTINCT id_user FROM users WHERE user_name = _user_name AND user_pass = _user_pass;
    END;
DELIMITER $$