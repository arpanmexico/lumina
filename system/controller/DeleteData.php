<?php
include('../config/database.php');
$database = new Database();

if (isset($_GET['categoryID'])) {
    $queryCategoryID = "CALL categoriesManager('" . $_GET['categoryID'] . "', null, null, 3)";
    $deleteCategory = $database->query($queryCategoryID);

    if ($deleteCategory)
        header('Location: ../view/dashboard.php?listarCategoriasProductos');
    else
        echo $database->error;
}

$database->close();
