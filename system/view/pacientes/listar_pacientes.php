<?php
include('../controller/PatientController.php');
$pacientes = new PatientController();
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Pacientes - Listar Información</h1>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">ACCIONES <i class="fas fa-arrow-right ml-2 mr-2"></i>
            <a href="?crearPaciente" class="btn btn-info"><i class="fas fa-plus-circle"></i> Agregar Paciente</a>
            <a href="?pacientesSuspendidos" class="btn btn-warning"><i class="fas fa-trash-alt"></i> Recuperar Pacientes</a>
        </h6>
    </div>

    <div class="card-body">
        <div class="row">
            <?php
                $pacientes->getAllPatientsInformation();    
            ?>
        </div>
    </div>
</div>