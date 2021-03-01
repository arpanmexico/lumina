<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Pacientes</h1>
</div>
<p class="text-muted">Bienvenido al módulo de pacientes, acá puede realizar operaciones como agregar nuevos pacientes, <br> ver la lista de pacientes, actualizar datos de un paciente y eliminar un paciente del sistema.</p>

<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Información general</h6>
    </div>

    <div class="card-body">
        <form action="" method="post">
            <section class="row">
                <div class="col-lg-4 col-md-4 col-sm-12 mt-3">
                    <div class="form-group">
                        <label for="nombrePaciente">Nombre del Paciente</label>
                        <input type="text" name="nombrePaciente" class="form-control" id="nombrePaciente" placeholder="Escribe aquí el nombre del paciente">
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 mt-3">
                    <div class="form-group">
                        <label for="apellidoPaternoPaciente">Apellido Paterno del Paciente</label>
                        <input type="text" name="apellidoPaternoPaciente" class="form-control" id="apellidoPaternoPaciente" placeholder="Escribe aquí el apellido">
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 mt-3">
                    <div class="form-group">
                        <label for="apellidoMaternoPaciente">Apellido Materno del Paciente</label>
                        <input type="text" name="apellidoMaternoPaciente" class="form-control" id="apellidoMaternoPaciente" placeholder="Escribe aquí el apellido">
                    </div>
                </div>
            </section>

            <section class="row mt-3">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <span class="font-weight-bolder">Fecha de Nacimiento</span>
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <div class="form-group">
                                <label for="diaNacimientoPaciente">Día</label>
                                <select class="form-control" id="diaNacimientoPaciente" name="diaNacimientoPaciente">
                                    <option disabled selected>Selecciona el día</option>
                                    <?php
                                    for ($i = 1; $i < 32; $i++) {
                                        echo "<option value='" . $i . "'>" . $i . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <div class="form-group">
                                <label for="mesNacimientoPaciente">Mes</label>
                                <select class="form-control" id="mesNacimientoPaciente" name="mesNacimientoPaciente">
                                    <option disabled selected>Selecciona el día</option>
                                    <?php
                                    $months = array(
                                        '1' => 'Enero', '2' => 'Febrero', '3' => 'Marzo',
                                        '4' => 'Abril', '5' => 'Mayo', '6' => 'Junio',
                                        '7' => 'Julio', '8' => 'Agosto', '9' => 'Septiembre',
                                        '10' => 'Octubre', '11' => 'Noviembre', '12' => 'Diciembre'
                                    );

                                    foreach ($months as $key => $value) {
                                        echo "<option value='" . $key . "'>" . $value . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <div class="form-group">
                                <label for="anoNacimientoPaciente">Año</label>
                                <select class="form-control" id="anoNacimientoPaciente" name="anoNacimientoPaciente">
                                    <option disabled selected>Selecciona el año</option>
                                    <?php
                                    for ($i = date("Y"); $i >= 1930; $i--) {
                                        echo "<option value='" . $i . "'>" . $i . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 mt-4">
                    <div class="form-group">
                        <label for="correoPaciente">Correo Electrónico del Paciente</label>
                        <input type="email" name="correoPaciente" class="form-control" id="correoPaciente" placeholder="Escribe aquí el correo electrónico">
                    </div>
                </div>
            </section>

            <section class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 mt-4">
                    <div class="form-group">
                        <label for="direccionPaciente">Dirección de Residencia</label>
                        <input type="email" name="direccionPaciente" class="form-control" id="direccionPaciente" placeholder="Escribe aquí la dirección de residencia">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 mt-4">
                    <div class="form-group">
                        <label for="generoPaciente">Genero</label>
                        <select class="form-control" id="generoPaciente">
                            <option disabled selected>Selecciona el genero del paciente</option>
                            <option value="M">Masculino</option>
                            <option value="F">Femenino</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 mt-4">
                    <div class="form-group">
                        <label for="telefonoFijoPaciente">Número de Teléfono Fijo (Casa)</label>
                        <input type="number" name="telefonoFijoPaciente" class="form-control" id="telefonoFijoPaciente" placeholder="Escribe aquí el teléfono">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 mt-4">
                    <div class="form-group">
                        <label for="telefonoMovilPaciente">Número de Teléfono Celular (Móvil)</label>
                        <input type="number" name="telefonoMovilPaciente" class="form-control" id="telefonoMovilPaciente" placeholder="Escribe aquí el teléfono">
                    </div>
                </div>
            </section>
            <button type="submit" class="btn btn-info btn-block">Agregar Paciente</button>
        </form>
    </div>
</div>