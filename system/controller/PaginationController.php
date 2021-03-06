<?php
header('Access-Control-Allow-Origin: *');
include('GlobalController.php');
$global = new GlobalController();
$items = 30;
$page = $_POST['page'];
$start = ($page - 1) * $items;
$first = 0;
$last = 0;
$database = new Database();

if (isset($_POST['type'])) {
    $type = $_POST['type'];

    switch ($type) {
        case 'cat': //Categorias
            $ext = $_POST['ext'];
            $category = "";
            switch ($ext) {
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
            $query = "SELECT id_categoria, nombre, tipo FROM categorias WHERE tipo = '" . $category . "' ORDER BY nombre LIMIT $start, $items";
            $query2 = "SELECT count(id_categoria) FROM categorias WHERE tipo = '" . $category . "'";
            pagination($query, $query2, $database, $page, $items, 'cat');
            break;
        case 'arm': // Armazones
            $query = "SELECT DISTINCT id_armazon, 
                (SELECT nombre FROM categorias WHERE armazones.id_marca = categorias.id_categoria) AS marca, 
                (SELECT nombre FROM categorias WHERE armazones.id_tipo = categorias.id_categoria )AS tipo, 
                modelo, color, descripcion, precio_compra, precio_publico, existencias,
                (SELECT nombre FROM categorias WHERE armazones.id_proveedor = categorias.id_categoria) AS
                proveedor, foto, ingresado, actualizado FROM categorias, armazones WHERE suspendido = 0 ORDER BY marca LIMIT $start, $items";
            $query2 = "SELECT count(id_armazon) FROM armazones WHERE suspendido = 0";
            pagination($query, $query2, $database, $page, $items, 'arm');
            break;
        case 'doc': //Doctores
            $query = "SELECT id_doctor, nombre, apellido, telefono, especialidad, estado, ingresado, actualizado FROM doctores WHERE suspendido = 0 LIMIT $start, $items";
            $query2 = "SELECT count(id_doctor) FROM doctores WHERE suspendido = 0";
            pagination($query, $query2, $database, $page, $items, 'doc');
            break;
        case 'pac': // Pacientes
            $query = "SELECT id_paciente, nombre, apellido_paterno, apellido_materno, nacimiento, correo, ocupacion, direccion, genero, telefono_primario, telefono_secundario, ingresado, actualizado FROM pacientes WHERE suspendido = 0 LIMIT $start, $items";
            $query2 = "SELECT count(id_paciente) FROM pacientes WHERE suspendido = 0";
            pagination($query, $query2, $database, $page, $items, 'pac');
            break;
        case 'ven': // Ventas
            $query = "SELECT id_venta, id_paciente, productos, nombre, apellidos, fecha, tipo_pago, modalidad_pago, tipo_descuento, descuento, anticipo, mensualidades, precio_mes, interes, total FROM ventas ORDER BY fecha DESC LIMIT $start, $items ";
            $query2 = "SELECT count(id_venta) FROM ventas";
            pagination($query, $query2, $database, $page, $items, 'ven');
            break;
        case 'out': // Salidas de dinero
            $start2 = ($page - 1) * 5;
            $query = "SELECT id_salida, monto, concepto, fecha FROM salidas ORDER BY fecha DESC LIMIT $start2, 4 ";
            $query2 = "SELECT count(id_salida) FROM salidas";
            pagination($query, $query2, $database, $page, 4, 'out');
            break;
        default:

            break;
    }
}

function pagination($query, $query2, $database, $page, $items, $card)
{
    $cont = 0;
    $global = $GLOBALS['global'];
    $runQuery = $database->query($query);
    $runQuery2 = $database->query($query2);
    $pages = $runQuery2->fetch_array();
    // Pages num
    $num_pages = ceil($pages[0] / $items);
    $first = ($page - 2) > 2 ? $page - 2 : 1;
    $last = ($page + 2) < $num_pages ? $page + 2 : $num_pages;
    if (mysqli_num_rows($runQuery) > 0) {
        if($card != 'out'){
            echo ' <h6 class="ml-3">Pág. ' . $page . ' de ' . $num_pages . '</h6>';
        }
       
        echo '<div class="row">'; //starting row
        while ($row = $runQuery->fetch_array()) {

            $data = "";

            switch ($card) {
                case 'cat':
                    $data = array(
                        'nombre' => $row['nombre'],
                        'id_categoria' => $row['id_categoria'],
                        'tipo' => $row['tipo'],

                    );
                    echo categoryCard($data);
                    break;
                case 'arm':
                    $data = array(
                        'id_armazon' => $row['id_armazon'],
                        'marca' => $row['marca'],
                        'tipo' => $row['tipo'],
                        'modelo' => $row['modelo'],
                        'color' => $row['color'],
                        'descripcion' => $row['descripcion'],
                        'precio_compra' => $row['precio_compra'],
                        'precio_publico' => $row['precio_publico'],
                        'existencias' => $row['existencias'],
                        'proveedor' => $row['proveedor'],
                        'ingresado' => $row['ingresado'],
                        'actualizado' => $row['actualizado'],
                        'foto' => $row['foto']
                    );
                    echo frameCard($data);
                    break;
                case 'doc':
                    $data = array(
                        'id' => $row['id_doctor'],
                        'nombre' => $row['nombre'],
                        'apellido' => $row['apellido'],
                        'telefono' => $row['telefono'],
                        'especialidad' => $row['especialidad'],
                        'estado' => $row['estado'],
                        'ingresado' => $row['ingresado'],
                        'actualizado' => $row['actualizado'],
                    );

                    echo docCard($data);
                    break;
                case 'pac':
                    $data = array(
                        'id' => $row['id_paciente'],
                        'nombre' => $row['nombre'],
                        'apellido_paterno' => $row['apellido_paterno'],
                        'apellido_materno' => $row['apellido_materno'],
                        'nacimiento' => $row['nacimiento'],
                        'correo' => $row['correo'],
                        'ocupacion' => $row['ocupacion'],
                        'direccion' => $row['direccion'],
                        'genero' => $row['genero'],
                        'telefono_primario' => $row['telefono_primario'],
                        'telefono_secundario' => $row['telefono_secundario'],
                        'ingresado' => $row['ingresado'],
                        'actualizado' => $row['actualizado']
                    );

                    echo patientCard($data);
                    break;
                case 'ven':
                    $data = array(
                        'id_venta' => $row['id_venta'],
                        'id_paciente' => $row['id_paciente'],
                        'nombre' => $row['nombre'],
                        'apellidos' => $row['apellidos'],
                        'fecha' => $row['fecha'],
                        'tipo_pago' => $row['tipo_pago'],
                        'modalidad_pago' => $row['modalidad_pago'],
                        'tipo_descuento' => $row['tipo_descuento'],
                        'descuento' => $row['descuento'],
                        'anticipo' => $row['anticipo'],
                        'mensualidades' => $row['mensualidades'],
                        'precio_mes' => $row['precio_mes'],
                        'interes' => $row['interes'],
                        'total' => $row['total'],
                        'productos' => $row['productos']
                    );
                    echo sellCard($data);
                    break;
                case 'out':
                    $data = array(
                        'id_salida' => $row['id_salida'],
                        'monto' => $row['monto'],
                        'concepto' => $row['concepto'],
                        'fecha' => $row['fecha']
                    );
                    echo moneyOutTable($data);
                    break;
                default:
                    break;
            }

            if (isset($page)) {
                if ($page >= 1) {
                    $back = $page - 1;
                    $next = $page + 1;
                }
            }
        }
        echo '</div>'; // end row

        // Print pagination controls
        echo '<div class="row mx-auto mt-5">
                <nav aria-label="Page navigation example" class="mx-auto">
                    <ul class="pagination justify-content-center">
                    
                        <li class="page-item';
        echo $page <= 1 ? ' disabled' : '';
        echo '">
                            <a class="page-link num-page mx-1 rounded-circle bg-light text-white font-weight-bold" href="#!" tabindex="-1"';
        if ($page > 1) {
            echo 'onClick="linkClick(' . $back . ');"';
        }
        echo ' ><i class="text-primary fas fa-arrow-left">
                            </i></a>
                        </li>
                            ';
        if ($first != 1) {
            echo '<li class="page-item 
                                    ';
            if ($page == $num) {
                echo 'active';
            }
            echo '">
                                        <a class="page-link num-page" onClick="linkClick(1);" href="#!">1</a>
                                </li><li class="page-item"><h4 class="mt-3"><i class="fas fa-ellipsis-h"></i></h4></li>';
        }
        for ($i = $first; $i <= $last; $i++) {
            $num = $i;
            echo '
                            <li class="page-item 
                                    ';
            if ($page == $num) {
                echo 'active';
            }
            echo '">
                                    <a class="page-link num-page" onClick="linkClick(' . $num . ');" href="#!">' . $num . '</a>
                        </li>
                                ';
        }

        if ($last != $num_pages) {
            echo '<li class="page-item mx-1"><h4 class="mt-3"><i class="fas fa-ellipsis-h"></i></h4></li><li class="page-item 
                                    ';
            if ($page == $num) {
                echo 'active';
            }
            echo '">
                                        <a class="page-link num-page" onClick="linkClick(' . $num_pages . ');" href="#!">' . $num_pages . '</a>
                            </li>';
        }

        echo '
                        <li class="page-item';
        echo $page >= $num_pages ? ' disabled' : '';
        echo '">
                                <a class="page-link mx-1 num-page bg-light rounded-circle text-white font-weight-bold"';
        if ($page >= 1) {
            echo 'onClick="linkClick(' . $next . ');"';
        }
        echo 'href="#!"><i class="text-primary fas fa-arrow-right">
                                
                                </i></a>
                        </li>
                    </ul>
                </nav>
            </div>';
    } else {
        switch ($card) {
            case 'cat':
                $global->getAlerts(
                    'warning',
                    'No se encontraron categorías registradas en este apartado.'

                );
                break;
            case 'arm':
                $global->getAlerts(
                    'warning',
                    'No se encontraron productos registrados, <br> <a class="font-weight-bolder" href="?crearArmazon">Aregar un nuevo producto</a>'
                );
                break;
            case 'doc':
                $global->getAlerts(
                    'warning',
                    'No existe ningún doctor registrado, <br> <a href="?crearDoctores">Registrar un nuevo doctor</a>'

                );
                break;
            case 'pac':
                $global->getAlerts(
                    'warning',
                    'Oops! Parece que no hay ningún paciente registrado, <br><a href="?crearPaciente">Registrar un nuevo paciente</a>'

                );
            case 'out':
                $global->getAlerts(
                    'warning',
                    'Oops! Parece que no hay ninguna salida de dinero</a>'

                );
                break;
        }
    }
}

function categoryCard($data)
{

    $nombre = $data['nombre'];
    $id = $data['id_categoria'];
    $tipo = $data['tipo'];


    $response = ' <div class="col-lg-3 col-md-4 col-sm-2 mt-3">
    <div class="card shadow">
      <div class="card-body">
        <h5 class="card-title">' . $nombre . '</h5>
        <a href="../controller/DeleteData.php?categoryID=' . $id . '&categoryType=' . $tipo . '" class="card-link text-danger">Eliminar</a>
      </div>
    </div>
  </div>';
    return $response;
}

function frameCard($data)
{
    $serialized_array = serialize($data);
    $url = urlencode($serialized_array);
    $stockMsg = "";
    if ($data['existencias'] >= 5) {
        $stockMsg = "<span class='text-success'>" . $data['existencias'] . " en existencia ";
    } else if ($data['existencias'] < 5 && $data['existencias'] > 3) {
        $stockMsg = "<span class='text-warning'>" . $data['existencias'] . " en existencia ";
    } else if ($data['existencias'] <= 2) {
        $stockMsg = "<span class='text-danger'>" . $data['existencias'] . " en existencia ";
    }
    $response = "
        <div class='col-lg-3 col-md-4 col-sm-12 mb-3'>
            <div class='card shadow h-100'>
                <a href='?detallesArmazon=" . $url . "'>
                  <img src='../../src/catalog/" . $data['foto'] . "' class='card-img-top'>
                </a>
                <div class='card-body'>
                    <h5 class='card-title'>ID: " . $data['id_armazon'] . "</h5>
                    <h5 class='font-weight-bolder'>$" . $data['precio_publico'] . ".00 - " . $stockMsg . "</span></h5>

                    <p>" . $data['marca'] . "</p>
                    
                </div>
                <div class='card-footer'>
                  <a href='?detallesArmazon=" . $url . "' class='card-link text-info'>Ver más información</a>
                </div>
            </div>
        </div>
    ";

    return $response;
}

function docCard($data)
{
    $serialized_array = serialize($data);
    $url = urlencode($serialized_array);

    if ($data['estado'] == 'Activo')
        $estado = "<small id='businessImgText1' class='text-success font-weight-bold'>Activo</small>";
    else
        $estado = "<small id='businessImgText1' class='text-danger font-weight-bold'>Inactivo</small>";

    $response = "
    <div class='col-lg-3 col-md-6 col-sm-12'>
        <div class='card  h-100 shadow-sm'>
            <div class='card-body'>
                <div class='row mb-2'>
                    <div class='col-12'>
                        <small><i class='far fa-clock'></i> " . $data['ingresado'] . "</small>
                    </div>
                </div>
                <div class='text-center'>
                    <div class='row'>
                        <div class='col-6 mx-auto'>
                            <a href='?detallesDoctor=" . $url . "'>
                                <img src='../../src/img/doctors.png' width='130' class='img-fluid'>
                            </a>
                        </div>
                        <div class='col-12'>
                            <h5>" . $data['nombre'] . " " . $data['apellido'] . "</h5>
                        </div>
                    </div>
                    <p class='text-muted'>" . $data['especialidad'] . "</p>
                    <hr>
                    <a type='button' href='../controller/DeleteData.php?idDoctor=" . $data['id'] . "&accionDoctor=suspend' class='text-danger'>Borrar Doctor</a>
                </div>
            </div>
        </div>
    </div>";

    return $response;
}

function patientCard($data)
{
    $serialized_array = serialize($data);
    $url = urlencode($serialized_array);

    $correo = $data['correo'] == '' ? 'Sin Correo Electrónico' : $data['correo'];
    $telefono_fijo = $data['telefono_primario'] == '0' ? 'Sin número fijo' : $data['telefono_primario'];
    $telefono_movil = $data['telefono_secundario'] == '0' ? 'Sin número móvil' : $data['telefono_secundario'];

    $response = "
    <div class='col-lg-3 col-md-6 col-sm-12'>
    <div class='card shadow-sm h-100'>
        <div class='card-body'>
            <div class='row mb-2'>
                <div class='col-12'>
                    <small><i class='far fa-clock'></i> " . $data['ingresado'] . "</small>
                </div>
            </div>
            <div class='text-center'>
                <div class='row'>
                    <div class='col-6 mx-auto'>
                        <a href='?detallesPaciente=" . $url . "'>
                            <img src='../../src/img/heart.png' width='130' class='img-fluid'>
                        </a>
                    </div>
                    <div class='col-12'>
                        <h5>" . $data['nombre'] . " " . $data['apellido_paterno'] . " " . $data['apellido_materno'] . "</h5>
                    </div>
                </div>
                <p class='text-muted'>" . $correo . "</p>
                <div class='row'>
                    <div class='col-md-6 text-right'>
                        <p class='text-muted'>" . $telefono_fijo . "</p>
                    </div>
                    <div class='col-md-6 text-left'>
                        <p class='text-muted'>" . $telefono_movil . "</p>
                    </div>
                </div>
                <hr>
                <a type='button' href='../controller/DeleteData.php?idPaciente=" . $data['id'] . "&accionPaciente=suspend' class='text-danger'>Borrar Paciente</a>
            </div>
        </div>
    </div>
    </div>
    ";
    return $response;
}

function sellCard($data)
{
    $date = explode(' ', $data['fecha']);
    $tipoPago = $data['tipo_pago'];
    $modalidadPago = $data['modalidad_pago'];
    $mensualidades = $data['mensualidades'];
    $precioMes = $data['precio_mes'];
    $tipo_descuento = $data['tipo_descuento'];
    $descuento = $data['descuento'];
    $anticipo = $data['anticipo'];
    $interes = $data['interes'];
    $productos = $data['productos'];
    $image = "";

    switch ($tipoPago) {
        case 'E':
            $tipoPago = 'En efectivo';
            $image = "dollar.svg";
            break;
        case 'T':
            $tipoPago = "Con tarjeta";
            $image = "credit_card.svg";
            break;
    }

    switch ($modalidadPago) {
        case 'C':
            $modalidadPago = 'Pago de contado';
            $mostrarPrecioMes = "d-none";
            $mostrarInteres = "d-none";
            $mostrarMensualidad = "d-none";
            break;
        case 'MSI':
            $modalidadPago = 'Pago a meses sin interes';
            $mostrarPrecioMes = "d-block";
            $mostrarInteres = "d-none";
            $mostrarMensualidad = "d-none";
            break;
        case 'MCI':
            $modalidadPago = 'Pago a meses con intereses';
            $mostrarPrecioMes = "d-block";
            $mostrarInteres = "d-block";
            $mostrarMensualidad = "d-none";
            break;
    }

    switch ($tipo_descuento){
        case 'NA':
            $tipo_descuento = "Sin descuento";
            break;
        case 'T':
            $tipo_descuento = "Total de venta";
            break;
        case 'P':
            $tipo_descuento = "Porcentaje: " .$data['total']/$descuento." %";
            break;
        case 'D':
            $tipo_descuento = "Descuento en dinero: $ ". $descuento;
            break;
    }

    $response = '
        <div class="col-lg-3 col-md-4 col-sm-2 mt-3">
            <div class="card shadow h-100" style="min-height: 255px;">
                <div class="card-header px-1">
                    <div class="row m-0">
                        <div class="col my-auto">
                            <p class="text-muted small my-auto font-weight-bold">' . $date[0] . '</p>
                        </div>
                        <div class="col text-right my-auto">
                            <p class="text-primary font-weight-bold my-auto">$' . floatval($data['total'] - $descuento) . '.00</p>
                        </div>
                        
                    </div>
                </div>
                <div class="card-body text-center">
                    <img src="../../src/img/' . $image . '" class="card-img mb-2" height="80px">
                    <h5 class="text-muted">' . $data['nombre'] . ' ' . $data['apellidos'] . '</h5>
                    <p class="text-success font-weight-bold small">' . $modalidadPago . ' ' . $tipoPago . '</p>
                    <a href="#!" class="alert-link text-primary small stretched-link" onClick="sellInfo(';
    $response .= "'" . $data['id_venta'] . "','" . ucwords($data['nombre']) . "','" . ucwords($data['apellidos']) . "','" . $data['fecha'] . "','" . $tipoPago . "','" . $modalidadPago . "', '" . $tipo_descuento . "', '" . $anticipo . "', '" . $mensualidades . "', '" . $precioMes . "','" . $interes . "'," . floatval($data['total']) . ",'" . $productos . "'," . floatval($descuento) ."";
    $response .= ');">Ver información completa</a>
                </div>
            </div>
        
        </div>
    ';

    return $response;
}

function moneyOutTable($data){
    $response = '

    <tr class="p-4" id="row' . $data['id_salida'] . '">
        <td class="">' . $data['fecha'] . '</td>
        <td class="">$ ' . $data['monto'] . ' MXN</td>
        <td class="">' . $data['concepto'] . '</td>
    <tr>   
    ';

    return $response;
}
