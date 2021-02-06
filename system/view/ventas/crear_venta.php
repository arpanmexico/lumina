<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Ventas</h1>
</div>
<p class="text-muted">Bienvenido al módulo de consultas y ventas de productos, acá puede realizar operaciones como agregar <br> nuevas consultas o nuevas ventas de productos.</p>

<div class="card shadow mb-4">
  <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
    <h6 class="m-0 font-weight-bold text-primary">Agregar una nueva venta</h6>
  </div>

  <div class="card-body">
    <section class="text-center">
      <h5 class="font-weight-bold">¿La venta es para un paciente?</h5>
      <button id="esPaciente" class="btn btn-danger text-uppercase">No</button>
      <button id="noEsPaciente" class="btn btn-success text-uppercase ml-3">Si</button>
    </section>

    <section id="panelVentas">
      <div class="align-self-center">
        <span id="infoPaciente">Seleccione el paciente a facturar</span>
        <button class="btn btn-info">Buscar paciente</button>
      </div>

      <div class="mt-5">
        <h5>Agregar productos a venta</h5>

        <i>Insertar tabla aquí</i>
      </div>


      <div class="mt-5">
        <span class="font-weight-bolder">Fecha de venta</span>
        <div class="row">
          <div class="col-lg-3 col-md-3 col-sm-12 align-self-center">
            <div class="form-group">
              <label for="diaVenta">Día</label>
              <select class="form-control" id="diaVenta" name="diaVenta">
                <option disabled selected>Selecciona el día</option>
                <?php
                for ($i = 1; $i < 32; $i++) {
                  echo "<option value='" . $i . "'>" . $i . "</option>";
                }
                ?>
              </select>
            </div>
          </div>
          <div class="col-lg-3 col-md-3 col-sm-12 align-self-center">
            <div class="form-group">
              <label for="mesVenta">Mes</label>
              <select class="form-control" id="mesVenta" name="mesVenta">
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
          <div class="col-lg-3 col-md-3 col-sm-12 align-self-center">
            <div class="form-group">
              <label for="anoVenta">Año</label>
              <select class="form-control" id="anoVenta" name="anoVenta">
                <option disabled selected>Selecciona el año</option>
                <?php
                for ($i = date("Y"); $i >= 2017; $i--) {
                  echo "<option value='" . $i . "'>" . $i . "</option>";
                }
                ?>
              </select>
            </div>
          </div>
          <div class="col-lg-3 col-md-3 col-sm-12 align-self-center mt-3">
            <button class="btn btn-info btn-block">Seleccionar hoy</button>
          </div>
        </div>
      </div>

      <div class="mt-3">
        <span class="font-weight-bolder">Costo y deposito</span>

        <div class="row mt-3">
          <div class="col-lg-2 col-md-4 col-sm-12 align-self-center">
            <h5>
              <span class="font-weight-bolder">Total:</span>
              $130.00
            </h5>
          </div>
          <div class="col-lg-5 col-md-4 col-sm-12">
            <div class="form-group">
              <label for="tipoPago">Tipo de pago</label>
              <select class="form-control" id="tipoPago" name="tipoPago">
                <option disabled selected>Selecciona un tipo de pago</option>
                <option value="E">Efectivo</option>
                <option value="T">Tarjeta</option>
              </select>
            </div>
          </div>
          <div class="col-lg-5 col-md-4 col-sm-12">
            <div class="form-group">
              <label for="modalidadPago">Modalidad de pago</label>
              <select class="form-control" id="modalidadPago" name="modalidadPago">
                <option disabled selected>Selecciona una modalidad de pago</option>
                <option value="C">Contado</option>
                <option value="MSI">Meses sin intereses</option>
                <option value="MCI">Meses con intereses</option>
              </select>
            </div>
          </div>
        </div> <!-- ./row -->

        <div class="row">
          <!-- Opciones de Meses con y sin Intereses -->
          <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="form-group">
              <label for="mensualidad">¿A cuántas mensualidades está diferido?</label>
              <input type="number" name="mensualidad" class="form-control" id="mensualidad" placeholder="Mensualidades">
            </div>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="form-group">
              <label for="precioMes">¿De cuánto es la mensualidad?</label>
              <input type="number" name="precioMes" class="form-control" id="precioMes" placeholder="Costo mensual">
            </div>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="form-group">
              <label for="interes">¿Cuánto es el porcentaje de interés?</label>
              <input type="number" name="interes" class="form-control" id="interes" placeholder="Porcentaje por pago con intereses">
            </div>
          </div>
        </div> <!-- ./row -->
      </div>
      <button class="btn btn-info btn-block mt-3" type="submit">Guardar venta e imprimir</button>
    </section>
  </div>
</div>