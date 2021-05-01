<?php
  include('../controller/CategoryController.php');
  $categorias = new CategoryController();
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Mis ventas</h1>
</div>
<p class="text-muted">Bienvenido al módulo de consultas y ventas de productos, acá puede realizar operaciones como agregar <br> nuevas consultas o nuevas ventas de productos.</p>

<div class="card shadow mb-4">
  <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
    <h6 class="m-0 font-weight-bold text-primary">ACCIONES <i class="fas fa-arrow-right ml-2 mr-2"></i>
      <a class="btn btn-info" href="?crearVentas"><i class="fas fa-plus-circle"></i> Crear Nueva Venta</a>
    </h6>
  </div>
  <div class="card-body">
    <h6 id="search-title" class="text-muted"></h6>
    <section id="search" class="mb-5"></section>
    <div id="data" class="">
    </div>
  </div>
</div>

<div class="modal fade" id="sellInfo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font-weight-bolder" id="sellInfoTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h6 class="text-muted">Fecha de venta: <span class="text-muted font-weight-bolder" id="sellInfoDate"></span></h6>
        <div class="row">
          <div class="form-group col-12 col-md-6 my-3">
            <label for="sellInfoName"> Nombre del paciente</label>
            <input type="text" id="sellInfoName" readonly class="form-control">
          </div>
          <div class="form-group col-12 col-md-6 my-3">
            <label for="sellInfoLastName"> Apellidos del paciente</label>
            <input type="text" id="sellInfoLastName" readonly class="form-control">
          </div>
        </div>
        <div class="row">
          <div class="form-group col-12 col-md-6 my-3">
            <label for="sellInfoPay"> Tipo de pago</label>
            <input type="text" id="sellInfoPay" readonly class="form-control">
          </div>
          <div class="form-group col-12 col-md-6 my-3">
            <label for="sellInfoModality"> Modalidad de pago</label>
            <input type="text" id="sellInfoModality" readonly class="form-control">
          </div>
        </div>

        <div class="row">
          <div class="form-group col-12 col-md-6 my-3">
            <label for="sellDiscount"> Porcentaje de Descuento</label>
            <input type="text" id="sellDiscount" readonly class="form-control">
          </div>
          <div class="form-group col-12 col-md-6 my-3">
            <label for="sellAdvance"> Pago Inicial (Anticipo)</label>
            <input type="text" id="sellAdvance" readonly class="form-control">
          </div>
        </div>

        <div class="row">
          <div class="form-group col-12 col-md-4 my-3">
            <label for="sellInfoMonthly"> Mensualidades</label>
            <input type="text" id="sellInfoMonthly" readonly class="form-control">
          </div>
          <div class="form-group col-12 col-md-4 my-3">
            <label for="sellInfoPrice"> Abono por mes</label>
            <input type="text" id="sellInfoPrice" readonly class="form-control">
          </div>
          <div class="form-group col-12 col-md-4 my-3">
            <label for="sellInfoInterest"> Interés</label>
            <input type="text" id="sellInfoInterest" readonly class="form-control">
          </div>
        </div>

        <div class="row mt-4">
          <h6 class="text-muted col-12 text-center font-weight-bold">Total de la venta: <span class="h4 text-primary font-weight-bolder" id="sellInfoTotal"></span></h6>
        </div>

        <div class="" id="productsTable"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>