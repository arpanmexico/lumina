<?php
    include('../controller/PatientController.php');
    $pacientes = new PatientController();
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Pacientes - Pacientes Suspendidos</h1>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">
            <a href="?listarPacientes"><i class="fas fa-chevron-left"></i> Volver a la lista de pacientes</a>
        </h6>
    </div>
    <div class="card-body">
        <div class="row">
            <?php
                $pacientes->getSuspendedPatientsInformacion();
            ?>
        </div>
    </div>
</div>