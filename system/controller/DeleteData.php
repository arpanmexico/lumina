<?php
include('../config/database.php');
$database = new Database();

if (isset($_GET['categoryID']) && isset($_GET['categoryType'])) {
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
            $frameQuery = "CALL framesManager(" . $_GET['idArmazon'] . ",null, null, null, null,null, null, null, null, 4)";
            break;
        case 'restore':
            $frameQuery = "CALL framesManager(" . $_GET['idArmazon'] . ",null, null, null, null,null, null, null, null, 5)";
            break;
    }
    $frameResult = $database->query($frameQuery);

    if ($frameResult)
        header('Location: ../view/dashboard.php?listarArmazones');

    echo $database->error;
}

$database->close();
