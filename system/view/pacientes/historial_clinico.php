<?php
/* 
        1 => Para crear un historial clínico
        2 => Para ver la información detallada de un historial seleccionado
    */

include('../controller/DoctorController.php');
$doctores = new DoctorController();

$date = getdate(date("U"));

if (isset($_GET['crearHistorial']) && isset($_GET['accionHistorial'])) {
    if (intval($_GET['accionHistorial']) == 1) {
?>
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Historia Clínica - Agregar Información</h1>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Agregar una nueva Historia al paciente</h6>
            </div>

            <div class="card-body">
                <form action="" method="POST">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                            <div class="form-group">
                                <label for="antecedentesPatGeneral">Antecedentes Patológicos Generales</label>
                                <textarea class="form-control" id="antecedentesPatGeneral" name="antecedentesPatGeneral" rows="3" placeholder="Escribe en esta zona..."></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                            <div class="form-group">
                                <label for="antecedentesPatOcular">Antecedentes Patológicos Oculates</label>
                                <textarea class="form-control" id="antecedentesPatOcular" name="antecedentesPatOcular" rows="3" placeholder="Escribe en esta zona..."></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                            <div class="form-group">
                                <label for="motivoConsulta">Motivo de Consulta</label>
                                <textarea class="form-control" id="motivoConsulta" name="motivoConsulta" rows="2" placeholder="Escribe en esta zona..."></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                            <div class="form-group">
                                <label for="ultimoExamen">¿Cuando se realizó su último Examen Visual?</label>
                                <textarea class="form-control" id="ultimoExamen" name="ultimoExamen" rows="2" placeholder="Escribe en esta zona..."></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                            <table class="table text-center">
                                <thead>
                                    <tr>
                                        <th scope="col"></th>
                                        <th scope="col">AV Lejos S/RX</th>
                                        <th scope="col">CV Lejos</th>
                                        <th scope="col">AV Cerca S/RX</th>
                                        <th scope="col">AV Lejos RX</th>
                                        <th scope="col">AV Cerca RX</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">OD</th>
                                        <td>
                                            <input type="text" name="odAvLejosSRx" class="form-control" placeholder="Valor">
                                        </td>
                                        <td>
                                            <input type="text" name="odCvLejos" class="form-control" placeholder="Valor">
                                        </td>
                                        <td>
                                            <input type="text" name="odAvCercaSRx" class="form-control" placeholder="Valor">
                                        </td>
                                        <td>
                                            <input type="text" name="odAvLejosRx" class="form-control" placeholder="Valor">
                                        </td>
                                        <td>
                                            <input type="text" name="odAvCercaRx" class="form-control" placeholder="Valor">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">IO</th>
                                        <td>
                                            <input type="text" name="ioAvLejosSRx" class="form-control" placeholder="Valor">
                                        </td>
                                        <td>
                                            <input type="text" name="ioCvLejos" class="form-control" placeholder="Valor">
                                        </td>
                                        <td>
                                            <input type="text" name="ioAvCercaSRx" class="form-control" placeholder="Valor">
                                        </td>
                                        <td>
                                            <input type="text" name="ioAvLejosRx" class="form-control" placeholder="Valor">
                                        </td>
                                        <td>
                                            <input type="text" name="ioAvCercaRx" class="form-control" placeholder="Valor">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                            <table class="table text-center">
                                <thead>
                                    <tr>
                                        <th scope="col">RX</th>
                                        <th scope="col">Esfera</th>
                                        <th scope="col">Cilindro</th>
                                        <th scope="col">Eje</th>
                                        <th scope="col">ADD</th>
                                        <th scope="col">DIP</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">OD</th>
                                        <td>
                                            <input type="text" name="odEsfera" class="form-control" placeholder="Valor">
                                        </td>
                                        <td>
                                            <input type="text" name="odCilindro" class="form-control" placeholder="Valor">
                                        </td>
                                        <td>
                                            <input type="text" name="odEje" class="form-control" placeholder="Valor">
                                        </td>
                                        <td>
                                            <input type="text" name="odAdd" class="form-control" placeholder="Valor">
                                        </td>
                                        <td>
                                            <input type="text" name="odDip" class="form-control" placeholder="Valor">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">IO</th>
                                        <td>
                                            <input type="text" name="ioEsfera" class="form-control" placeholder="Valor">
                                        </td>
                                        <td>
                                            <input type="text" name="ioCilindro" class="form-control" placeholder="Valor">
                                        </td>
                                        <td>
                                            <input type="text" name="ioEje" class="form-control" placeholder="Valor">
                                        </td>
                                        <td>
                                            <input type="text" name="ioAdd" class="form-control" placeholder="Valor">
                                        </td>
                                        <td>
                                            <input type="text" name="ioDip" class="form-control" placeholder="Valor">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                            <div class="form-group">
                                <label for="obervaciones">Observaciones del Paciente</label>
                                <textarea class="form-control" id="obervaciones" name="obervaciones" rows="5" placeholder="Escribe en esta zona..."></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="tipoVision">Tipo de Visión</label>
                                        <input type="text" name="tipoVision" class="form-control" id="tipoVision" placeholder="Valor">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="folioPaciente">Folio de la revisión</label>
                                        <input type="text" name="folioPaciente" class="form-control" id="folioPaciente" placeholder="Este campo se llena solo" value="<?php echo uniqid(); ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="tipoLente">Tipo de Lente</label>
                                        <input type="text" name="tipoLente" class="form-control" id="tipoLente" placeholder="Valor">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 align-self-center">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="confirmacionMedico" name="confirmacionMedico" value="1">
                                        <label class="form-check-label" for="confirmacionMedico">El médico confirma que los datos son correctos</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="confirmacionPaciente" name="confirmacionPaciente" value="1">
                                        <label class="form-check-label" for="confirmacionPaciente">El paciente confirma que los datos son correctos</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" name="guardarHistoria" class="btn btn-info btn-block mt-3">Guardar Historia Clínica del Paciente</button>
                    </div>
                </form>
                <div class="container mt-4">
                    <?php
                    if (isset($_POST['guardarHistoria'])) {
                        $data = array(
                            'id_paciente' => $_GET['crearHistorial'],
                            'antecedentes_pat_generales' => $_POST['antecedentesPatGeneral'],
                            'antecedentes_pat_oculares' => $_POST['antecedentesPatOcular'],
                            'motivo_consulta' => $_POST['motivoConsulta'],
                            'ultimo_examen' => $_POST['ultimoExamen'],

                            'odAVLejosSRX' => $_POST['odAvLejosSRx'],
                            'odCVLejos' => $_POST['odCvLejos'],
                            'odAVCercaSRX' => $_POST['odAvCercaSRx'],
                            'odAVLejosRX' => $_POST['odAvLejosRx'],
                            'odAVCercaRX' => $_POST['odAvCercaRx'],

                            'ioAVLejosSRX' => $_POST['ioAvLejosSRx'],
                            'ioCVLejos' => $_POST['ioCvLejos'],
                            'ioAVCercaSRX' => $_POST['ioAvCercaSRx'],
                            'ioAVLejosRX' => $_POST['ioAvLejosRx'],
                            'ioAVCercaRX' => $_POST['ioAvCercaRx'],

                            'rxodEsfera' => $_POST['odEsfera'],
                            'rxodCilindro' => $_POST['odCilindro'],
                            'rxodEje' => $_POST['odEje'],
                            'rxodAdd' => $_POST['odAdd'],
                            'rxodDip' => $_POST['odDip'],

                            'rxioEsfera' => $_POST['ioEsfera'],
                            'rxioCilindro' => $_POST['ioCilindro'],
                            'rxioEje' => $_POST['ioEje'],
                            'rxioAdd' => $_POST['ioAdd'],
                            'rxioDip' => $_POST['ioDip'],

                            'observaciones' => $_POST['obervaciones'],
                            'tipo_vision' => $_POST['tipoVision'],
                            'tipo_lente' => $_POST['tipoLente'],
                            'folio' => $_POST['folioPaciente'],

                            'validacion_medico' => $_POST['confirmacionMedico'],
                            'valicacion_paciente' => $_POST['confirmacionPaciente']
                        );

                        $doctores->createNewHistory($data);
                    }
                    ?>
                </div>
            </div>
        </div>
        <?php
    } else if (intval($_GET['accionHistorial']) == 2) {
        if (isset($_GET['datosHistorial'])) {
            $unserialized_array = $_GET['datosHistorial'];
            $array = unserialize(urldecode($unserialized_array));
        ?>

            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Historia Clínica - Ver Información</h1>
            </div>

            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">
                    <a href="javascript:history.back(1);"><i class="fas fa-chevron-left"></i> Volver a la información del paciente</a>
                    </h6>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                            <h5 class="font-weight-bold">Antecedentes Patológicos Generales</h5>
                            <p class="text-muted"><?php echo $array['antecedentes_pat_generales']; ?></p>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                            <h5 class="font-weight-bold">Antecedentes Patológicos Oculares</h5>
                            <p class="text-muted"><?php echo $array['antecedentes_pat_oculares']; ?></p>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                            <h5 class="font-weight-bold">Motivo de Consulta</h5>
                            <p class="text-muted"><?php echo $array['motivo_consulta']; ?></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 col-md-6-col-sm-12">
                            <table class="table text-center">
                                <thead>
                                    <tr>
                                        <th scope="col"></th>
                                        <th scope="col">AV Lejos S/RX</th>
                                        <th scope="col">CV Lejos</th>
                                        <th scope="col">AV Cerca S/RX</th>
                                        <th scope="col">AV Lejos RX</th>
                                        <th scope="col">AV Cerca RX</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">OD</th>
                                        <td>
                                            <?php echo $array['odAVLejosSRX']; ?>
                                        </td>
                                        <td>
                                            <?php echo $array['odCVLejos']; ?>
                                        </td>
                                        <td>
                                            <?php echo $array['odAVCercaSRX']; ?>
                                        </td>
                                        <td>
                                            <?php echo $array['odAVLejosRX']; ?>
                                        </td>
                                        <td>
                                            <?php echo $array['odAVCercaRX']; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">IO</th>
                                        <td>
                                            <?php echo $array['ioAVLejosSRX']; ?>
                                        </td>
                                        <td>
                                            <?php echo $array['ioCVLejos']; ?>
                                        </td>
                                        <td>
                                            <?php echo $array['ioAVCercaSRX']; ?>
                                        </td>
                                        <td>
                                            <?php echo $array['ioAVLejosRX']; ?>
                                        </td>
                                        <td>
                                            <?php echo $array['ioAVCercaRX']; ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-lg-6 col-md-6-col-sm-12">
                            <table class="table text-center">
                                <thead>
                                    <tr>
                                        <th scope="col">RX</th>
                                        <th scope="col">Esfera</th>
                                        <th scope="col">Cilindro</th>
                                        <th scope="col">Eje</th>
                                        <th scope="col">ADD</th>
                                        <th scope="col">DIP</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">OD</th>
                                        <td>
                                            <?php echo $array['rxodEsfera']; ?>
                                        </td>
                                        <td>
                                            <?php echo $array['rxodCilindro']; ?>
                                        </td>
                                        <td>
                                            <?php echo $array['rxodEje']; ?>
                                        </td>
                                        <td>
                                            <?php echo $array['rxodAdd']; ?>
                                        </td>
                                        <td>
                                            <?php echo $array['rxodDip']; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">IO</th>
                                        <td>
                                            <?php echo $array['rxioEsfera']; ?>
                                        </td>
                                        <td>
                                            <?php echo $array['rxioCilindro']; ?>
                                        </td>
                                        <td>
                                            <?php echo $array['rxioEje']; ?>
                                        </td>
                                        <td>
                                            <?php echo $array['rxioAdd']; ?>
                                        </td>
                                        <td>
                                            <?php echo $array['rxioDip']; ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                            <h5 class="font-weight-bold">Observaciones</h5>
                            <p class="text-muted"><?php echo $array['observaciones']; ?></p>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <h5 class="font-weight-bold">Última Consulta</h5>
                                    <p class="text-muted"><?php echo $array['ultimo_examen']; ?></p>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <h5 class="font-weight-bold">Tipo de Visión</h5>
                                    <p class="text-muted"><?php echo $array['tipo_vision']; ?></p>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <h5 class="font-weight-bold">Tipo de Lente</h5>
                                    <p class="text-muted"><?php echo $array['tipo_lente']; ?></p>
                                </div>

                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <h5 class="font-weight-bold">Confirmación Médico</h5>
                                    <p class="text-muted"><?php echo intval($array['validacion_medico']) == 1 ? "<i class='fas fa-check-circle text-success'></i> Confirmado"  : "<i class='fas fa-times-circle text-danger'></i> Sin Confirmar" ?></p>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <h5 class="font-weight-bold">Confirmación Paciente</h5>
                                    <p class="text-muted"><?php echo intval($array['valicacion_paciente']) == 1 ? "<i class='fas fa-check-circle text-success'></i> Confirmado"  : "<i class='fas fa-times-circle text-danger'></i> Sin Confirmar" ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<?php
        } else {
            echo "Los datos del usuario son requeridos";
        }
    }
}
?>