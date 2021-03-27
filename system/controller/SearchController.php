<?php

include( 'GlobalController.php' );
$global = new GlobalController();
$database = new Database();
if(isset($_POST["text"])){
    $search = $_POST['text'];
    $query = "";
    if(comprobarBusqueda($search)){ 
        $database = new Database();
        $query = "";
        if(isset($_POST['type'])){
            $type = $_POST['type'];
            switch ($type){
                case 'cat': //Categorias
                    $ext = $_POST['ext'];
                    $category = "";
                    switch($ext){
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
                    $query = "SELECT id_categoria, nombre, tipo FROM categorias WHERE tipo = '" . $category . "' and nombre LIKE '".$search."%' OR tipo = '" . $category . "' and id_categoria LIKE '".$search."%' ORDER BY nombre";
                    break;
                case 'arm': // Armazones
                    $query = "SELECT DISTINCT id_armazon, 
                        (SELECT nombre FROM categorias WHERE armazones.id_marca = categorias.id_categoria) AS marca,
                        (SELECT nombre FROM categorias WHERE armazones.id_tipo = categorias.id_categoria )AS tipo,  
                        modelo, color, descripcion, precio, existencias,
                        (SELECT nombre FROM categorias WHERE armazones.id_proveedor = categorias.id_categoria) AS
                        proveedor, foto, ingresado, actualizado FROM categorias, armazones WHERE suspendido = 0 AND (SELECT nombre FROM categorias WHERE armazones.id_marca = categorias.id_categoria) LIKE '".$search."%' OR suspendido = 0 AND id_armazon LIKE '".$search."%' ORDER BY marca";  
                    break;
                case 'doc': //Doctores
                    $query = "SELECT id_doctor, nombre, apellido, telefono, especialidad, estado, ingresado, actualizado FROM doctores WHERE suspendido = 0 AND nombre LIKE '".$search."%' OR suspendido = 0 AND id_doctor LIKE '".$search."%'";
                    break;
                case 'pac': // Pacientes
                    $query = "SELECT id_paciente, nombre, apellido_paterno, apellido_materno, nacimiento, correo, ocupacion, direccion, genero, telefono_primario, telefono_secundario, ingresado, actualizado FROM pacientes WHERE suspendido = 0 AND nombre LIKE '".$search."%' OR suspendido = 0 AND id_paciente LIKE '".$search."%'";
                    break;           
                case 'ven': // Pacientes en ventas
                    $ext = $_POST['ext'];
                    switch($ext){
                        case 1:
                            $query = "SELECT id_venta, id_paciente, productos, nombre, apellidos, fecha, tipo_pago, modalidad_pago, mensualidades, precio_mes, interes, total FROM ventas WHERE fecha LIKE '%".$search."%' OR id_venta LIKE '".$search."%' OR id_paciente LIKE '".$search."%' OR nombre LIKE '".$search."%' ORDER BY fecha";
                            $type = 'vent';
                            break;
                        default:
                            $query = "SELECT id_paciente, nombre, apellido_paterno, apellido_materno, nacimiento, correo, ocupacion, direccion, genero, telefono_primario, telefono_secundario, ingresado, actualizado FROM pacientes WHERE suspendido = 0 AND nombre LIKE '".$search."%' OR suspendido = 0 AND id_paciente LIKE '".$search."%'";
                            $type = "ven";
                            break;    
                    }
                    break;        
                default: 
                    break;    
            }
            search($query, $database, $type); 
        }
        
    }    
    
        
}

function comprobarBusqueda($dato){
     if (preg_match_all("/^[a-zA-Z0-9_]/", $dato)) {
      //echo "El nombre de usuario $dato es correcto<br>";
      return true;
   } else {
       echo '<div class="col-12 alert alert-warning animated fadeIn">La búsqueda con "'.$dato.'" no es válida. Vuelva a intentarlo únicamente con letras o números</div>';
      return false;
   }
}

function search($query, $database, $view){
    $execQuery = $database->query($query);

    if(mysqli_num_rows($execQuery) > 0){
        echo '<div class="row ml-0 animated fadeIn">
                    <h6 class="small text-muted">Registros encontrados: '.mysqli_num_rows($execQuery).'</h6>
                </div>
                <div class="row animated fadeIn">
                ';      
        while($row = $execQuery->fetch_array()){
            switch($view){
                case "cat":
                    $data = array(
                        'nombre' => $row['nombre'],
                        'id_categoria' => $row['id_categoria'],
                        'tipo' => $row['tipo'],
                    );
        
                    echo categoryCard($data);
                    break;
                case "arm":
                    $data = array(
                        'id_armazon' => $row['id_armazon'],
                        'marca' => $row['marca'],
                        'tipo' => $row['tipo'],
                        'modelo' => $row['modelo'],
                        'color' => $row['color'],
                        'descripcion' => $row['descripcion'],
                        'precio' => $row['precio'],
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
                        'id' => $row['id_paciente'],
                        'nombre' => $row['nombre'],
                        'ingresado' => $row['ingresado'],  
                        'correo' => $row['correo'],  
                        'apellido_paterno' => $row['apellido_paterno'],
                        'apellido_materno' => $row['apellido_materno'],
                    );
                    
                    echo sellPatientCard($data);
                    break;
                case 'vent':
                    $data = array(
                        'id_venta' => $row['id_venta'],
                        'id_paciente' => $row['id_paciente'],
                        'nombre' => $row['nombre'],
                        'apellidos' => $row['apellidos'],
                        'fecha' => $row['fecha'],
                        'tipo_pago' => $row['tipo_pago'],
                        'modalidad_pago' => $row['modalidad_pago'],
                        'mensualidades' => $row['mensualidades'],
                        'precio_mes' => $row['precio_mes'],
                        'interes' => $row['interes'],
                        'total' => $row['total'],
                    );  
                    echo sellCard($data);
                    break;            
            }
        }
    }else{
        echo '
            <div class="alert alert-warning col-12 animated fadeIn">
                No se ha encontrado ningún registro.
            </div>
            ';
    }
    
}

function categoryCard($data){
    
    $nombre = $data['nombre'];
    $id = $data['id_categoria'];
    $tipo = $data['tipo'];
    

    $response = ' <div class="col-lg-3 col-md-4 col-sm-2 mt-3">
    <div class="card shadow">
      <div class="card-body">
        <h5 class="card-title">' . $nombre . '</h5>
        <a href="../controller/DeleteData.php?categoryID=' . $id . '&categoryType=' . $tipo. '" class="card-link text-danger">Eliminar</a>
      </div>
    </div>
  </div>';
    return $response;
}

function frameCard($data){
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
            <div class='card shadow'>
                <a href='?detallesArmazon=" . $url . "'>
                  <img src='../../src/catalog/" . $data['foto'] . "' class='card-img-top'>
                </a>
                <div class='card-body'>
                    <h5 class='card-title'>ID: " . $data['id_armazon'] . "</h5>
                    <h5 class='font-weight-bolder'>$" . $data['precio'] . " - " . $stockMsg . "</span></h5>

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

function docCard($data){
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

function patientCard($data){
    $serialized_array = serialize($data);
    $url = urlencode($serialized_array);            
    $response = "
    <div class='col-lg-3 col-md-6 col-sm-12'>
    <div class='card shadow-sm'>
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
                <p class='text-muted'>" . $data['correo'] . "</p>
                <div class='row'>
                    <div class='col-md-6 text-right'>
                        <p class='text-muted'>" . $data['telefono_primario'] . "</p>
                    </div>
                    <div class='col-md-6 text-left'>
                        <p class='text-muted'>" . $data['telefono_secundario'] . "</p>
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

function sellPatientCard($data){
    $response = "
    <div class='col-lg-3 col-md-6 col-sm-12'>
    <div class='card shadow-sm border-info text-info'>
        <div class='card-body'>
            <div class='row mb-2'>
                <div class='col-12'>
                    <small><i class='far fa-clock'></i> " . $data['ingresado'] . "</small>
                </div>
            </div>
            <div class='text-center'>
                <div class='row'>
                    <div class='col-12'>
                        <h5 class='font-weight-bold'>" . $data['nombre'] . " " . $data['apellido_paterno'] . " " . $data['apellido_materno'] . "</h5>
                    </div>
                </div>
                <p class='text-muted'>" . $data['correo'] . "</p>
                <a class='text-muted text-decoration-none small stretched-link' onClick= 'selectPatient("; $response .= '"'.$data['id'].'","'.$data['nombre'].'","'.$data['apellido_paterno'].' '.$data['apellido_materno'].'"'; $response.=")'>Click para seleccionar este paciente</a>
            </div>
        </div>
    </div>
    </div>
    ";

    return $response;
}

function sellCard($data){
    $date = explode(' ', $data['fecha']);
    $tipoPago = $data['tipo_pago'];
    $modalidadPago = $data['modalidad_pago'];
    $mensualidades = $data['mensualidades'];
    $precioMes = $data['precio_mes'];
    $interes = $data['interes'];
    $image = "";

    switch($tipoPago){
        case 'E':
            $tipoPago = 'En efectivo';
            $image = "dollar.svg";
            break;
        case 'T':
            $tipoPago = "Con tarjeta" ;
            $image = "credit_card.svg";
            break;   
    }

    switch($modalidadPago){
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

    $response = '
        <div class="col-lg-3 col-md-4 col-sm-2 mt-3">
            <div class="card shadow" style="min-height: 255px;">
                <div class="card-header px-1">
                    <div class="row m-0">
                        <div class="col my-auto">
                            <p class="text-muted small my-auto font-weight-bold">'.$date[0].'</p>
                        </div>
                        <div class="col text-right my-auto">
                            <p class="text-primary font-weight-bold my-auto">$ '.floatval($data['total']).'</p>
                        </div>
                        
                    </div>
                </div>
                <div class="card-body text-center">
                    <img src="../../src/img/'.$image.'" class="card-img mb-2" height="80px">
                    <p class="text-success font-weight-bold small">'.$modalidadPago.' '.$tipoPago.'</p>
                    <a href="#!" class="alert-link text-primary small stretched-link" onClick="sellInfo('; $response .= "'".$data['id_venta']."','".ucwords($data['nombre'])."','".ucwords($data['apellidos'])."','".$data['fecha']."','".$tipoPago."','".$modalidadPago."','".$mensualidades."','".$precioMes."','".$interes."',".floatval($data['total']).""; $response .= ');">Ver información completa</a>
                </div>
            </div>
        
        </div>
    ';

    return $response;
}