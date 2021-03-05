<?php
/* 
        1 => Para crear un historial clínico
        2 => Para ver la información detallada de un historial seleccionado
    */
if (isset($_GET['accionHistorial']) == 1) {
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
                                    <label for="folioPaciente">Folio de la revisión</label>
                                    <input type="text" name="folioPaciente" class="form-control" id="folioPaciente" placeholder="Folio del la revisión">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="tipoVision">Tipo de Visión</label>
                                    <input type="text" name="tipoVision" class="form-control" id="tipoVision" placeholder="Folio del la revisión">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="tipoLente">Tipo de Lente</label>
                                    <input type="text" name="tipoLente" class="form-control" id="tipoLente" placeholder="Folio del la revisión">
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
        </div>
    </div>

<?php
} else if (isset($_GET['accionHistorial']) == 2) {
?>



<?php
}
?>