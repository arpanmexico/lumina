<div class="d-sm-flex align-items-center justify-content-between mb-3">
  <h1 class="h3 mb-0 text-gray-800">Salidas de dinero</h1>
</div>
<p class="text-muted">Bienvenido. Aquí podrás agregar y consultar salidas de dinero.</p>
<div id="result" class="mx-auto card mb-3 shadow rounded"></div>

<div class="row">
    <div class="col-12 col-md-6 col-xl-4 mx-auto">
        <div class="card h-100">
            <div class="card-header">
                <h6 class="m-0 col-9 font-weight-bold text-primary">Agregar salida de dinero</h6>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="input-monto">Monto de la salida <span class="text-danger small">* Obligatorio</span> </label>
                    <input type="number" class="form-control" name="monto" id="input-monto" min=1 placeholder="Ingrese el monto de la salida" required>
                </div>
                <div class="form-group">
                    <label for="input-monto">Concepto de la salida <span class="text-danger small">* Obligatorio</span> </label>
                    <textarea type="number" class="form-control" name="monto" id="input-concepto" rows=3 placeholder="Ingrese el concepto de la salida" required></textarea>
                </div>
                <button class="btn btn-block btn-info" id="moneyOutBtn">Guardar cambios</button>
            </div>

        </div>
    </div>
    <div class="col-12 col-md-6 col-xl-8 mx-auto">
        <div class="card shadow-sm">
            <div class="card-header">
                <h6 class="m-0 col-9 font-weight-bold text-primary">Salidas de dinero registradas</h6>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover">
                    <thead class="bg-info text-white font-weight-bold">
                        <th class="text-center" scope="col">Fecha de salida</th>
                        <th class="text-center" scope="col">Cantidad</th>
                        <th class="text-center" scope="col">Concepto</th>
                    </thead>
                    <tbody id="data" class="text-center">
                    </tbody>     
                </table>
            </div>
        </div>
    </div>
</div>