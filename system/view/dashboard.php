<?php
ob_start();
session_start();
include('../controller/UserController.php');
$usuario = new UserController();

if (!isset($_SESSION['userID'])) {
  header('Location: ../');
  exit();
} else {
?>
  <!DOCTYPE html>
  <html lang="es">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
    <link href="../../src/css/sb-admin-2.css" rel="stylesheet">
    <link rel="stylesheet" href="../../src/css/admin.css">
    <link rel="stylesheet" href="../../src/libs/fullcalendar/lib/main.min.css">
    <link rel="stylesheet" href="../../src/libs/clockpicker/src/clockpicker.css">
    
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="../../src/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../../src/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../../src/favicon/favicon-16x16.png">
    <link rel="manifest" href="../../src/favicon/site.webmanifest">
    <title>Panel de Control - Lumina</title>
  </head>

  <body>
    <div id="wrapper">
      <!-- Sidebar -->
      <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#!">
          <div class="sidebar-brand-icon">
            <i class="fas fa-glasses"></i>
          </div>
          <div class="sidebar-brand-text mx-3 text-uppercase">Lumina</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Análisis de Datos -->
        <li class="nav-item">
          <a class="nav-link" href="dashboard.php?analisis">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Panel Principal</span></a>
        </li>

        <!-- Sucursal -->
        <li class="nav-item">
          <a class="nav-link" href="dashboard.php?sucursal">
            <i class="fas fa-store-alt"></i>
            <span>Sucursal</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Categorías -->
        <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            <i class="fas fa-bars"></i>
            <span>Categorías</span>
          </a>
          <div id="collapseOne" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <a class="collapse-item" href="dashboard.php?listarCategoriasProductos">Ver tipos de producto</a>
              <a class="collapse-item" href="dashboard.php?listarMarcas">Ver Marcas</a>
              <a class="collapse-item" href="dashboard.php?listarEnfermedades">Ver Enfermedades</a>
            </div>
          </div>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">
        <!-- Productos y catálogo -->
        <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
            <i class="fas fa-glasses"></i>
            <span>Productos</span>
          </a>
          <div id="collapseFour" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <a class="collapse-item" href="dashboard.php?listarProveedores">Proveedores</a>
              <a class="collapse-item" href="dashboard.php?crearArmazon">Nuevo producto</a>
              <a class="collapse-item" href="dashboard.php?listarArmazones">Catalogo de productos</a>
            </div>
          </div>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">
        <!-- Doctores -->
        <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-user-md"></i>
            <span>Doctores</span>
          </a>
          <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <a class="collapse-item" href="dashboard.php?crearDoctores">Agregar nuevo doctor</a>
              <a class="collapse-item" href="dashboard.php?listarDoctores">Todos los doctores</a>
            </div>
          </div>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">
        <!-- Pacientes -->
        <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
            <i class="fas fa-user-injured"></i>
            <span>Pacientes</span>
          </a>
          <div id="collapseThree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <a class="collapse-item" href="dashboard.php?crearPaciente">Agregar nuevo paciente</a>
              <a class="collapse-item" href="dashboard.php?listarPacientes">Todos los pacientes</a>
            </div>
          </div>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">
        <!-- Ventas y Consultas -->
        <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">
            <i class="fas fa-fax"></i>
            <span>Ventas y Consultas</span>
          </a>
          <div id="collapseFive" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <a class="collapse-item" href="dashboard.php?crearVentas">Nueva venta</a>
              <a class="collapse-item" href="dashboard.php?listarVentas">Ver todo</a>
            </div>
          </div>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">
        <!-- Agenda de citas -->
        <li class="nav-item">
          <a class="nav-link" href="dashboard.php?calendario">
            <i class="fas fa-calendar-alt"></i>
            <span>Agenda de citas</span>
          </a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">
        <!-- Salidas de dinero -->
        <li class="nav-item">
          <a class="nav-link" href="dashboard.php?crearSalida">
            <i class="fas fa-comment-dollar"></i>
            <span>Salidas de dinero</span>
          </a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">
        <!-- Ticket -->
        <li class="nav-item">
          <a class="nav-link" href="dashboard.php?miTicket">
            <i class="fas fa-ticket-alt"></i>
            <span>Modificar ticket</span>
          </a>
        </li>
        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler -->
        <div class="text-center d-none d-md-inline">
          <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

      </ul>
      <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
          <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
              <i class="fa fa-bars"></i>
            </button>
            <div class="input-group my-auto col-lg-4" id="search-content">
              <input class="form-control py-2 border-right-0 border" type="search" id="search-input">
              <span class="input-group-append">
                <label for="search-input" class="input-group-text text-info bg-transparent"><i class="fa fa-search"></i></label>
              </span>
            </div>
            <h6 id="search-msg" class="text-success small my-auto font-weight-bold">Presiona ENTER para realizar la busqueda.</h6>
            <ul class="navbar-nav ml-auto">

              <!-- ALERTS -->
              <li class="nav-item dropdown no-arrow mx-1">
                <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-bell fa-fw"></i>
                  <span class="badge badge-danger badge-counter"><?php echo $usuario->getAlertCenterCounter(); ?></span> <!-- Counter - Alerts -->
                </a>
                <!-- Dropdown - Alerts -->
                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                  <h6 class="dropdown-header">
                    Centro de Alertas
                  </h6>
                  <?php
                  foreach ($usuario->getAlertCenter('all') as $key => $value) {
                  ?>
                    <a class="dropdown-item d-flex align-items-center" href="#">
                      <div class="mr-3">
                        <?php
                        switch ($value['tipo']) {
                          case 'Informacion':
                            echo '
                                <div class="icon-circle bg-info">
                                  <i class="fas fa-info text-white"></i>
                                </div>
                              ';
                            break;
                          case 'Advertencia':
                            echo '
                                <div class="icon-circle bg-warning">
                                  <i class="fas fa-exclamation-triangle text-white"></i>
                                </div>
                              ';
                            break;
                          case 'Alerta':
                            echo '
                                <div class="icon-circle bg-danger">
                                  <i class="fas fa-exclamation text-white"></i>
                                </div>
                              ';
                            break;
                        }

                        ?>
                      </div>
                      <div>
                        <div class="small text-gray-500"><?php echo $value['fecha']; ?></div>
                        <?php echo $value['mensaje']; ?>
                      </div>
                    </a>
                  <?php } ?>

                  <a class="dropdown-item text-center small text-gray-500" href="dashboard.php?notificaciones=alertas">Mostrar todas las alertas</a>
                </div>
              </li>

              <!-- Nav Item - Messages -->
              <li class="nav-item dropdown no-arrow mx-1">
                <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-envelope fa-fw"></i>
                  <span class="badge badge-danger badge-counter"><?php echo $usuario->getMessageCenterCounter(); ?></span> <!-- Counter - Messages -->
                </a>
                <!-- Dropdown - Messages -->
                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                  <h6 class="dropdown-header">
                    Centro de Mensajes
                  </h6>
                  <?php
                  foreach ($usuario->getMessageCenter('all') as $key => $value) {
                  ?>
                    <a class="dropdown-item d-flex align-items-center" href="dashboard.php?notificaciones=mensajeria">
                      <div class="dropdown-list-image mr-3">
                        <img class="rounded-circle" src="https://source.unsplash.com/xv7-GlvBLFw/60x60" alt="">
                        <div class="status-indicator bg-success"></div>
                      </div>
                      <div>
                        <div class="text-truncate"><?php echo $value['mensaje']; ?></div>
                        <div class="small text-gray-500"><?php echo $usuario->getGlobalController()->getFormattedDate($value['ingresado']); ?></div>
                      </div>
                    </a>

                  <?php } ?>


                  <a class="dropdown-item text-center small text-gray-500" href="dashboard.php?notificaciones=mensajeria">Ver todos los mensajes</a>
                </div>
              </li>

              <div class="topbar-divider d-none d-sm-block"></div>

              <!-- Nav Item - User Information -->
              <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                    <?php echo $usuario->getUserName($_SESSION['userID']); ?>
                  </span>
                  <img class="img-profile rounded-circle" src="https://source.unsplash.com/OjnmCKmzr3A/60x60">
                </a>
                <!-- Dropdown - User Information -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                  <a class="dropdown-item" href="#">
                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                    Configuración
                  </a>
                  <a class="dropdown-item" href="#">
                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                    Registro de Actividad
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="../controller/DeleteData.php?cerrarSesion">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Cerrar Sesión
                  </a>
                </div>
              </li>

            </ul>

          </nav>
          <!-- End of Topbar -->



          <!--    <<<<< CONTENIDO >>>>>   -->
          <div class="container-fluid">

            <?php
            if (isset($_GET['analisis'])) {
              include('analisis.php');
            } else if (isset($_GET['sucursal'])) {
              include('sucursal.php');
            } else if (isset($_GET['listarCategoriasProductos'])) {
              include('categorias/listar_categorias.php');
            } else if (isset($_GET['listarEnfermedades'])) {
              include('categorias/listar_enfermedades.php');
            } else if (isset($_GET['listarProveedores'])) {
              include('armazones/listar_proveedores.php');
            } else if (isset($_GET['listarArmazones'])) {
              include('armazones/listar_armazones.php');
            } else if (isset($_GET['crearArmazon'])) {
              include('armazones/crear_armazon.php');
            } else if (isset($_GET['listarDoctores'])) {
              include('doctores/listar_doctores.php');
            } else if (isset($_GET['listarMarcas'])) {
              include('categorias/listar_marcas.php');
            } else if (isset($_GET['crearDoctores'])) {
              include('doctores/agregar_doctor.php');
            } else if (isset($_GET['crearPaciente'])) {
              include('pacientes/agregar_pacientes.php');
            } else if (isset($_GET['listarPacientes'])) {
              include('pacientes/listar_pacientes.php');
            } else if (isset($_GET['detallesPaciente'])) {
              include('pacientes/detalles_paciente.php');
            } else if (isset($_GET['pacientesSuspendidos'])) {
              include('pacientes/pacientes_suspendidos.php');
            } else if (isset($_GET['crearHistorial']) && isset($_GET['accionHistorial'])) {
              include('pacientes/historial_clinico.php');
            } else if (isset($_GET['crearVentas'])) {
              include('ventas/crear_venta.php');
            } else if (isset($_GET['listarVentas'])) {
              include('ventas/listar_ventas.php');
            } else if (isset($_GET['detallesArmazon'])) {
              include('armazones/detalles_armazon.php');
            } else if (isset($_GET['armazonesSuspendidos'])) {
              include('armazones/armazones_suspendidos.php');
            } else if (isset($_GET['detallesDoctor'])) {
              include('doctores/detalles_doctor.php');
            } else if (isset($_GET['doctoresSuspendidos'])) {
              include('doctores/doctores_suspendidos.php');
            } else if (isset($_GET['calendario'])) {
              include('citas/calendario.php');
            } else if (isset($_GET['crearSalida'])) {
              include('salidas/crear_salida.php');
            } else if (isset($_GET['miTicket'])) {
              include('ticket/modificar_ticket.php');
            } else if (isset($_GET['notificaciones'])) {
              include('notificaciones.php');
            } else {
              include('analisis.php');
            }
            ?>

          </div>
          <!-- /.container-fluid -->
        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
          <div class="container my-auto">
            <div class="copyright text-center my-auto">
              <span>Copyright &copy; Óptica Lumina 2021</span>
            </div>
          </div>
        </footer>
        <!-- End of Footer -->

      </div>
      <!-- End of Content Wrapper -->

    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <script src="../../src/js/bootstrap-notify.js"></script>
    <script src="../../src/js/alerts.js"></script>
    <script src="../../src/js/sb-admin-2.js"></script>
    <script src="../../src/js/sells.js"></script>
    <script src="../../src/js/utilities.js"></script>
    <script src="../../src/libs/fullcalendar/lib/main.js"></script>
    <script src="../../src/libs/fullcalendar/lib/locales-all.min.js"></script>
    <script src="../../src/libs/clockpicker/src/clockpicker.js"></script>
    <script src="../../src/js/calendar.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.7.0"></script>
    <script src="../../src/js/admin.js"></script>
    <script src="../../src/js/ticket.js"></script>
    <script src="../../src/js/moneyout.js"></script>
  </body>

  </html>
<?php
}
?>