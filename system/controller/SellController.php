<?php
class SellController
{

  public function getGlobalController()
  {
    return new GlobalController();
  }


  public function UniqueIDGenerator()
  {
    $database = new Database();

    do {
      $uniqid = uniqid();

      $invoice_id_query = "SELECT COUNT(id_venta) AS venta FROM ventas WHERE id_venta = '" . $uniqid . "'";
      $runInvoiceQuery = $database->query($invoice_id_query);

      if ($runInvoiceQuery->num_rows == 0) {
        continue;
      } else {
        return $uniqid;
        break;
      }
    } while ($runInvoiceQuery->num_rows == 0);
  }

  public function sellManage($type, $data)
  {
    //include($_SERVER['DOCUMENT_ROOT'] . "/lumina/system/config/database.php");
    include($_SERVER['DOCUMENT_ROOT'] . "/system/config/database.php");
    $response = 'true';
    $database = new Database();



    $query = "call sellsManager('" . $data['id_venta'] . "', '" . $data['id_paciente'] . "', '" . $data['productos'] . "', '" . $data['nombre'] . "', 
            '" . $data['apellidos'] . "', '" . $data['fecha'] . "', '" . $data['tipo_pago'] . "', '" . $data['modalidad_pago'] . "', " . $data['descuento'] . ",
            " . $data['anticipo'] . ", " . $data['mensualidades'] . ", " . $data['precio_mes'] . ", " . $data['interes'] . ", " . $data['total'] . ", 1)";

    $runQuery = $database->query($query);

    if ($runQuery) {
      $producto = explode(',', $data['productos']);
      $cantidad = explode(',', $data['cantidad']);

      foreach ($producto as $key => $value) {
        if ($value != "") {
          $updateQuery = "call updateStock('" . $producto[$key] . "'," . $cantidad[$key] . ")";
          $runUpdate = $database->query($updateQuery);
        }
      }
    } else {
      $response = mysqli_error($database);
    }

    echo $response;
  }

  public function getTypes()
  {
    $database = new Database();
    $query = "SELECT id_categoria, nombre FROM categorias WHERE tipo = 'Lente'";
    $runQuery = $database->query($query);
    $response = "";

    if ($runQuery->num_rows > 0) {
      while ($row = $runQuery->fetch_array()) {
        $response .= '<button type="button" id="btn' . $row['id_categoria'] . '"class="btn btn-success mr-2" data-toggle="modal" data-target="#modal' . $row['id_categoria'] . '">Agregar ' . ucfirst($row['nombre']) . '</button>';
        $response .= '
        <div class="modal fade" id="modal' . $row['id_categoria'] . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg pt-0">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title font-weight-bold" id="exampleModalLabel">Agregar ' . ucfirst($row['nombre']) . ' </h5>
                <p class="my-auto small font-weight-bold ml-5 text-muted">De click en la fila correspondiete para seleccionar el producto deseado</p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span></button>
              </div>
              <div class="modal-body p-0">
              
                ' . SellController::getProductsByType($row['id_categoria']) . '
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onClick="cancelProducts();" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal" onClick="saveProducts();">Guardar productos</button>
              </div>
            </div>
          </div>
        </div>';
      }

      echo $response;
    } else {
      echo '<div class="alert alert-warning col-12 animated fadeIn">
                No se ha encontrado ningún tipo de producto.
            </div>';
    }
  }

  public function getProductsByType($type)
  {
    $database = new Database();
    $query = "SELECT id_armazon, modelo, (SELECT nombre FROM categorias WHERE armazones.id_marca = categorias.id_categoria) AS marca, precio_publico, existencias, (SELECT nombre FROM categorias WHERE armazones.id_tipo = categorias.id_categoria) AS tipo FROM armazones WHERE id_tipo = '" . $type . "' AND suspendido = 0 AND existencias != 0 ORDER BY marca";
    $runQuery = $database->query($query);
    $response = '';

    if ($runQuery->num_rows > 0) {
      $response .= '
      <table class="table table-hover m-0">
        <thead class="bg-info text-white font-weight-bold">
          <th class="" scope="col">Modelo</th>
          <th class="" scope="col">Marca</th>
          <th class="" scope="col">Precio</th>
          <th class="text-center" scope="col">Existencias</th>
        </thead>
        <tbody> 
        ';
      while ($row = $runQuery->fetch_array()) {
        $response .= '
          <tr class="p-4 product-row" id="row' . $row['id_armazon'] . '" onClick="selectProduct(';
        $response .= "'" . $row['id_armazon'] . "', '" . $row['modelo'] . "', '" . $row['marca'] . "', " . $row['precio_publico'] . ", " . $row['existencias'] . ", '" . $row['tipo'] . "',1";
        $response .= ')">
            <td class="">' . $row['modelo'] . '</td>
            <td class="">' . $row['marca'] . '</td>
            <td class=""> $' . $row['precio_publico'] . '.00 MXN</td>
            <th scope="row" class="text-center">' . $row['existencias'] . '</th>
          <tr>    
        ';
      }
      $response .= '
        <tbody>
      </table>';
    } else {
      $response .= '<div class="alert alert-warning col-12 animated fadeIn">
                No se ha encontrado ningún producto.
            </div>';
    }

    return $response;
  }

  public function showSoldProducts($products)
  {
    //include($_SERVER['DOCUMENT_ROOT'] . "/lumina/system/config/database.php");
    include($_SERVER['DOCUMENT_ROOT'] . "/system/config/database.php");
    $database = new Database();

    $formatedProd = explode(",", $products);
    array_pop($formatedProd);
    $newProd = "";
    foreach ($formatedProd as $value) {
      if ($value == end($formatedProd)) {
        $newProd .= $value;
      } else {
        $newProd .= $value . ",";
      }
    }
    $query = "SELECT id_armazon, modelo, (SELECT nombre FROM categorias WHERE armazones.id_marca = categorias.id_categoria) AS marca, precio_publico, (SELECT nombre FROM categorias WHERE armazones.id_tipo = categorias.id_categoria) AS tipo FROM armazones WHERE id_armazon IN (" . $newProd . ") ORDER BY marca";

    $runQuery = $database->query($query);
    $response = "";
    if ($runQuery->num_rows > 0) {
      $response .= '
      <h5 class="text-primary mt-4 font-weight-bolder">Productos vendidos</h5>
      <table class="table table-hover m-0">
        <thead class="bg-info text-white font-weight-bold">
          <th class="" scope="col">Tipo</th>
          <th class="" scope="col">Código</th>
          <th class="" scope="col">Modelo</th>
          <th class="" scope="col">Marca</th>
          <th class="" scope="col">Precio</th>
        </thead>
        <tbody> 
        ';
      while ($row = $runQuery->fetch_array()) {
        $response .= '
          <tr class="p-4 product-row" id="row' . $row['id_armazon'] . '">
            <td class="">' . $row['tipo'] . '</td>
            <td class="">' . $row['id_armazon'] . '</td>
            <td class="">' . $row['modelo'] . '</td>
            <td class="">' . $row['marca'] . '</td>
            <td class=""> $ ' . $row['precio_publico'] . ' MXN</td>
          <tr>    
        ';
      }
      $response .= '
        <tbody>
      </table>';
    } else {
      $response .= '<div class="alert alert-warning col-12 animated fadeIn">
                No se ha encontrado ningún producto.
            </div>';
    }

    echo $response;
  }
}

if (isset($_POST['action'])) {
  $sell = new SellController();
  $sell->sellManage(1, $_POST['venta']);
}

if (isset($_POST['products'])) {
  $sell = new SellController();
  $sell->showSoldProducts($_POST['products']);
}
