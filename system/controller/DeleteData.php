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
        }
    else
        echo $database->error;
}

$database->close();
