<?php
class CategoryController
{
  public function getGlobalController()
  {
    return new GlobalController();
  }

  public function getDatabaseConnection()
  {
    return new Database();
  }

  public function createNewCategory($data)
  {
    $database = CategoryController::getDatabaseConnection();

    switch ($data['type']) {
      case 1:
        $query = "CALL categoriesManager(null, '" . ucwords($data['name']) . "', 'Lente', 1)";
        break;
      case 2:
        $query = "CALL categoriesManager(null, '" . ucwords($data['name']) . "', 'Marca', 1)";
        break;
      case 3:
        $query = "CALL categoriesManager(null, '" . ucwords($data['name']) . "', 'Enfermedad', 1)";
        break;
      case 4:
        $query = "CALL categoriesManager(null, '" . ucwords($data['name']) . "', 'Proveedor', 1)";
        break;
    }
    $runQuery = $database->query($query);
    if ($runQuery)
      switch ($data['type']) {
        case 1:
          header('Location: dashboard.php?listarCategoriasProductos');
          break;
        case 2:
          header('Location: dashboard.php?listarMarcas');
          break;
        case 3:
          header('Location: dashboard.php?listarEnfermedades');
          break;
        case 4:
          header('Location: dashboard.php?listarProveedores');
          break;
      }
    else
      CategoryController::getGlobalController()->getAlerts('error', 'Ocurrió un error al guardar la categoría -> ' . $database->error);

    $database->close();
  }

  public function getAllCategoryInformation($type)
  {
    $database = CategoryController::getDatabaseConnection();
    switch ($type) {
      case 1:
        $category = 'Lente';
        break;
      case 2:
        $category = 'Marca';
        break;
      case 3:
        $category = 'Enfermedad';
        break;
      case 4:
        $category = 'Proveedor';
        break;
    }

    $query = "SELECT id_categoria, nombre, tipo FROM categorias WHERE tipo = '" . $category . "' ORDER BY nombre";
    $runQuery = $database->query($query);

    if ($runQuery->num_rows > 0) {
      while ($row = $runQuery->fetch_array()) {
        echo '
        <div class="col-lg-3 col-md-4 col-sm-2 mt-3">
          <div class="card shadow">
            <div class="card-body">
              <h5 class="card-title">' . $row['nombre'] . '</h5>
              <a href="../controller/DeleteData.php?categoryID=' . $row['id_categoria'] . '&categoryType=' . $row['tipo'] . '" class="card-link text-danger">Eliminar</a>
            </div>
          </div>
        </div>
        ';
      }
    } else {
      CategoryController::getGlobalController()->getAlerts('warning', 'No se encontraron categorías registradas en este apartado.');
    }


    $database->close();
  }

  public function getCategoryInformationByType($type)
  {
    $database = CategoryController::getDatabaseConnection();
    switch ($type) {
      case 1:
        $category = 'Lente';
        break;
      case 2:
        $category = 'Marca';
        break;
      case 3:
        $category = 'Enfermedad';
        break;
      case 4:
        $category = 'Proveedor';
        break;
    }

    $query = "SELECT id_categoria, nombre FROM categorias WHERE tipo = '" . $category . "' ORDER BY nombre";
    $runQuery = $database->query($query);
    $data = array();

    if ($runQuery->num_rows > 0) {
      while ($row = $runQuery->fetch_array()) {
        $data['id'] .= $row['id_categoria'] . ",";
        $data['nombre'] .= $row['nombre'] . ",";
      }
    }

    return $data;

    $database->close();
  }

  public function getSuppliers()
  {
    $database = CategoryController::getDatabaseConnection();
    $query = "SELECT id_categoria, nombre FROM categorias WHERE tipo = 'Proveedor'";
    $runQuery = $database->query($query);
    $data = array();

    if ($runQuery->num_rows > 0) {
      while ($row = $runQuery->fetch_array()) {
        $data['id'] .= $row['id_categoria'] . ",";
        $data['nombre'] .= $row['nombre'] . ",";
      }
    } else {
      CategoryController::getGlobalController()->getAlerts('warning', 'No se encontraron proveedores registrados en este apartado.');
    }

    return $data;

    $database->close();
  }

  public function createNewFrame($data)
  {
    if (move_uploaded_file($data['foto_tmp'], '../../src/catalog/' . $data['foto'])) {
      $database = CategoryController::getDatabaseConnection();
      $query = "CALL framesManager(" . $data['codigo'] . ", '" . $data['marca'] . "', '" . $data['modelo'] . "', '" . ucfirst($data['color']) . "', '" . $data['descripcion'] . "', " . $data['precio'] . ", " . $data['existencias'] . ", '" . $data['proveedor'] . "', '" . $data['foto'] . "', 1)";

      $runQuery = $database->query($query);
      if ($runQuery) {
        header('Location: ?listarArmazones');
      } else {
        CategoryController::getGlobalController()->getAlerts('error', 'Ocurrió un error al guardar los datos, intenta <a href="?crearArmazon">Recargar la página</a>, si el problema persiste escribe a <a href="mailto:contacto@arpan.com.mx">contacto@arpan.com.mx</a>');
      }

      $database->close();
    }else{
      echo "Ocurrió un error";
    }
  }
}
