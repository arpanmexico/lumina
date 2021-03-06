<?php
include('../config/database.php');
$database = new Database();

if (isset($_GET['cerrarSesion'])) {
    session_start();
    session_destroy();
    header('Location: ../index.php');
} else if (isset($_GET['categoryID']) && isset($_GET['categoryType'])) {
    $queryCategoryID = "CALL categoriesManager('" . $_GET['categoryID'] . "', null, null, 3)";
    $deleteCategory = $database->query($queryCategoryID);

    if ($deleteCategory)
        switch ($_GET['categoryType']) {
            case 'Lente':
                header('Location: ../view/dashboard.php?listarCategoriasProductos');
                break;
            case 'Marca':
                header('Location: ../view/dashboard.php?listarMarcas');
                break;
            case 'Enfermedad':
                header('Location: ../view/dashboard.php?listarEnfermedades');
                break;
            case 'Proveedor':
                header('Location: ../view/dashboard.php?listarProveedores');
                break;
        }
    else
        echo $database->error;
} else if (isset($_GET['idArmazon']) && isset($_GET['accionArmazon'])) {

    switch ($_GET['accionArmazon']) {
        case 'suspend':
            $frameQuery = "CALL framesManager(" . $_GET['idArmazon'] . ",null, null, null, null,null, null, null, null, null, 4)";
            break;
        case 'restore':
            $frameQuery = "CALL framesManager(" . $_GET['idArmazon'] . ",null, null, null, null,null, null, null, null, null, 5)";
            break;
    }
    $frameResult = $database->query($frameQuery);

    if ($frameResult)
        header('Location: ../view/dashboard.php?listarArmazones');

    echo $database->error;
} else if (isset($_GET['idDoctor']) && isset($_GET['accionDoctor'])) {

    switch ($_GET['accionDoctor']) {
        case 'suspend':
            $doctorQuery = "CALL doctorsManager(" . $_GET['idDoctor'] . ", null, null, null, null, null, 3)";
            break;
        case 'restore':
            $doctorQuery = "CALL doctorsManager(" . $_GET['idDoctor'] . ", null, null, null, null, null, 4)";
            break;
    }
    $doctorResult = $database->query($doctorQuery);

    if ($doctorResult) {
        header('Location: ../view/dashboard.php?listarDoctores');
    }
} else if (isset($_GET['idPaciente']) && isset($_GET['accionPaciente'])) {
    switch ($_GET['accionPaciente']) {
        case 'suspend':
            $patientQuery = "CALL patientsManager('" . $_GET['idPaciente'] . "', null, null, null, null, null, null, null, null, null, null, 3)";
            break;
        case 'restore':
            $patientQuery = "CALL patientsManager('" . $_GET['idPaciente'] . "', null, null, null, null, null, null, null, null, null, null, 4)";
            break;
    }
    $patientResult = $database->query($patientQuery);

    if ($patientResult) {
        header('Location: ../view/dashboard.php?listarPacientes');
    }
}

$database->close();
