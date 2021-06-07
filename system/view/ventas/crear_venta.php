<?php

include('../controller/SellController.php');
$ventas = new SellController();

$uniqid = $ventas->UniqueIDGenerator();

?>
<div class="d-sm-flex align-items-center justify-content-between mb-3">
  <h1 class="h3 mb-0 text-gray-800">Ventas</h1>
</div>
<p class="text-muted">Bienvenido al módulo de consultas y ventas de productos, acá puede realizar operaciones como agregar <br> nuevas consultas o nuevas ventas de productos.</p>
<div id="sellMsg" class="mx-auto card mb-3 shadow rounded">

</div>
<div class="card shadow mb-4">
  <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
    <h6 class="m-0 col-9 font-weight-bold text-primary">Agregar una nueva venta</h6>
    <div class="col-lg-1 col-md-4 col-sm-12 align-self-center">
      <h5 class="font-weight-bolder">
        Total:
      </h5>
    </div>
    <div class="col-lg-2">
      <h4 id="totalIndicator" class="font-weight-bolder text-success">$0.00MXN</h4>
    </div>
  </div>

  <div class="card-body scroll">
    <section class="text-center">
      <h5 class="font-weight-bold">¿La venta es para un paciente?</h5>
      <button id="noEsPaciente" class="btn btn-danger text-uppercase col-2">No</button>
      <button id="esPaciente" class="btn btn-success text-uppercase ml-3 col-2">Si</button>
    </section>

    <section id="panelVentas">
      <div class="align-self-center" id="panelPaciente">
        <span id="infoPaciente">Busque el paciente a facturar</span>
        <div class="row">
          <div class="input-group my-auto col-lg-4">
            <input class="form-control py-2 border-right-0 border" type="search" id="search-input-pac">
            <span class="input-group-append">
              <label for="search-input-pac" class="input-group-text text-info bg-transparent"><i class="fa fa-search"></i></label>
            </span>
          </div>
          <h6 id="search-msg-pac" class="text-success small my-auto font-weight-bold">Presiona ENTER para realizar la busqueda.</h6>
        </div>
      </div>
      <h6 id="search-title" class="mt-3 text-muted"></h6>
      <section id="search" class="mb-5"></section>
      <div class="mt-5" id="productsPanel">
        <h5 class="text-muted font-weight-bold">Agregar productos a venta</h5>

        <?php
        $ventas->getTypes();
        ?>
      </div>
      <div class="mt-5" id="selectedProductsPanel">
      </div>


      <form action="" method='POST'>
        <div class="mt-5">
          <div class="row my-4" id="patientBasic">
            <div class="col-lg-4 col-md-6 col-sm-12 align-self-center">
              <label for="txtUID">Folio de Venta <span class="font-weight-bolder text-danger"> * </span></label>
              <input type="text" class="form-control" id="txtUID" name="uniqueid" value="<?php echo $uniqid; ?>" readonly>
            </div>

            <div class="col-lg-4 col-md-6 col-sm-12 align-self-center">
              <input type="text" id="txtID" class="d-none">
              <label for="txtName">Nombre <span class="font-weight-bolder text-danger"> * </span></label>
              <input type="text" class="form-control" id="txtName" name="nombre">
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 align-self-center">
              <label for="txtLastName">Apellidos <span class="font-weight-bolder text-danger"> * </span></label>
              <input type="text" class="form-control" id="txtLastName" name="apellidos">
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 align-self-center mt-3">
              <label for="txtDate" class="font-weight-bolder">Fecha de venta <span class="font-weight-bolder text-danger"> * </span></label>
              <input type="date" id="txtDate" name="fecha" class="form-control" value="<?php echo date('Y-m-d'); ?>" readonly>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 align-self-center mt-3">
              <label for="txtPhoneNumber" class="font-weight-bolder">Teléfono de Contacto <span class="font-weight-bolder text-danger"> * </span></label>
              <input type="tel" id="txtPhoneNumber" name="telefono_secundario" class="form-control">
            </div>
          </div>
        </div>

        <div class="mt-3" id="moneyPanel">
          <span class="font-weight-bolder">Costo y deposito</span>

          <div class="row mt-3">
            <div class="col-lg-6 col-md-6 col-sm-12">
              <div class="form-group">
                <input type="text" name="txtTotal" id="txtTotal" class="d-none">
                <label for="tipoPago">Tipo de pago <span class="font-weight-bolder text-danger"> * </span></label>
                <select class="form-control" id="tipoPago" name="tipoPago">
                  <option disabled selected>Selecciona un tipo de pago</option>
                  <option value="E">Efectivo</option>
                  <option value="T">Tarjeta</option>
                </select>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
              <div class="form-group">
                <label for="modalidadPago">Modalidad de pago <span class="font-weight-bolder text-danger"> * </span></label>
                <select class="form-control" id="modalidadPago" name="modalidadPago">
                  <option disabled selected>Selecciona una modalidad de pago</option>
                  <option value="C">Contado</option>
                  <option value="MSI">Meses sin intereses</option>
                  <option value="MCI">Meses con intereses</option>
                </select>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
              <div class="form-group">
                <label for="descuento">Porcentaje de Descuento <small>(Opcional)</small></label>
                <input type="number" class="form-control" id="descuento" placeholder="Introduce el número de descuento">
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
              <div class="form-group">
                <label for="anticipo">Anticipo de compra <small>(Opcional)</small></label>
                <input type="number" class="form-control" id="anticipo" placeholder="Introduce la cantidad a dejar a cuenta">
              </div>
            </div>
          </div> <!-- ./row -->

          <div class="row">
            <!-- Opciones de Meses con y sin Intereses -->
            <div class="col-lg-4 col-md-4 col-sm-12">
              <div class="form-group" id="mensualidad">
                <label for="mensualidad">¿A cuántas mensualidades está diferido?</label>
                <input type="number" name="mensualidad" class="form-control" placeholder="Mensualidades" min=1 id="txtMensualidad">
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
              <div class="form-group" id="precioMes">
                <label for="precioMes">¿De cuánto es la mensualidad?</label>
                <input type="number" name="precioMes" class="form-control" placeholder="Costo mensual" min=1 id="txtPrecioMes">
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
              <div class="form-group" id="interes">
                <label for="interes">¿Cuánto es el porcentaje de interés?</label>
                <input type="number" name="interes" class="form-control" placeholder="Porcentaje por pago con intereses" min=1 id="txtInteres">
              </div>
            </div>
          </div> <!-- ./row -->
        </div>
        <a href="#" class="btn btn-info btn-block mt-3" id="saveSell">Guardar venta e imprimir</a>
      </form>
    </section>
  </div>
</div>

<div id="iframeHolder"></div>

<script>
  const $btnPrint = document.querySelector("#saveSell");
  $btnPrint.addEventListener("click", () => {
    window.frames["printf"].focus();
    window.frames["printf"].print();
    //window.print();
  });
</script>