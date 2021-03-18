<?php
include('../controller/DoctorController.php');
$doctores = new DoctorController();
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Doctores - Listar Información</h1>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">ACCIONES <i class="fas fa-arrow-right ml-2 mr-2"></i>
        <a href="?crearDoctores" class="btn btn-info"><i class="fas fa-plus-circle"></i> Agregar Doctor</a>
        <a href="?doctoresSuspendidos" class="btn btn-warning"><i class="fas fa-trash-alt"></i> Recuperar Doctores</a>
        </h6>
    </div>

    <div class="card-body">
        <div id="data" class="">
            <?php
                //$doctores->getAllDoctorsInformation();
            ?>
        </div>
    </div>
</div>