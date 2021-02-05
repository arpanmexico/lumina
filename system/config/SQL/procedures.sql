/*   -----   PROCEDIMIENTO PARA INICIAR SESIÓN   -----   */
USE lumina;
DROP PROCEDURE IF EXISTS userLogin;
DELIMITER $$
    CREATE PROCEDURE userLogin(IN _user_id bigint(10), IN _user_pass varchar(255))
    BEGIN
        SELECT id_user FROM users WHERE id_user = _user_id AND user_pass = _user_pass;
    END;
DELIMITER $$