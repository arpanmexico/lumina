<?php
include('../config/database.php');
if (isset($_POST['data'])) {

    $database = new Database();

    $query = "CALL saveLandingComments('" . ucwords($_POST['data']['user_name']) . "',
    '" . $_POST['data']['user_email'] . "','" . ucfirst($_POST['data']['subject']) . "',
    '" . ucfirst($_POST['data']['message']) . "')";
    $runQuery = $database->query($query);

    if ($runQuery)
        print_r(getJSONMessage(200, 'OK', 'Los datos se guardaron correctamente, nos pondremos en contacto contigo lo más pronto posible.'));
    else {
        print_r(getJSONMessage(400, 'Bad Request', 'Ocurrió un error al guardar los datos, verifica o intenta de nuevo.'));
        print_r($database->error);
    }

    $database->close();
} else {
    print_r(getJSONMessage(40, 'Bad Request', 'Ocurrió un error al recibir los datos, el objeto no está definido.'));
}


function getJSONMessage($status, $title, $body)
{
    $result = array(
        'response' => array(
            'status' => $status,
            'title' => $title,
            'body' => $body
        )
    );

    return json_encode($result, JSON_UNESCAPED_UNICODE);
}
