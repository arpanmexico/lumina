<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Doctores</h1>
</div>
<p class="text-muted">Bienvenido al módulo de doctores acá puedes realizar operaciones como agregar nuevos doctores, <br> ver el listado de doctores, actualizar datos de doctores y eliminar un doctor del sistema.</p>

<div class="card shadow mb-4">
  <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
    <h6 class="m-0 font-weight-bold text-primary">Agregar un nuevo doctor al sistema</h6>
  </div>

  <div class="card-body">
    <form action="" method="post">
      <section class="row">
        <div class="col-lg-6 col-md-6 col-sm-12">
          <div class="form-group">
            <label for="codigoDoctor">Código del Doctor</label>
            <input type="number" name="codigoDoctor" class="form-control" id="codigoDoctor" placeholder="Escribe aquí el código del doctor">
          </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">
          <div class="form-group">
            <label for="estadoDoctor">Estado</label>
            <select class="form-control" id="estadoDoctor" name="estadoDoctor">
              <option disabled selected>Selecciona el estado del doctor</option>
              <option value="1">Activo</option>
              <option value="0">Inactivo</option>
            </select>
          </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 mt-3">
          <div class="form-group">
            <label for="nombreDoctor">Nombre Doctor</label>
            <input type="text" name="nombreDoctor" class="form-control" id="nombreDoctor" placeholder="Escribe aquí el código del doctor">
          </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 mt-3">
          <div class="form-group">
            <label for="apellidoDoctor">Apellido del Doctor</label>
            <input type="text" name="apellidoDoctor" class="form-control" id="apellidoDoctor" placeholder="Escribe aquí el código del doctor">
          </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 mt-3">
          <div class="form-group">
            <label for="telefonoDoctor">Número de Teléfono</label>
            <input type="number" name="telefonoDoctor" class="form-control" id="telefonoDoctor" placeholder="Escribe aquí el código del doctor">
          </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 mt-3">
          <div class="form-group">
            <label for="especialidadDoctor">Especialidad Doctor</label>
            <input type="text" name="especialidadDoctor" class="form-control" id="especialidadDoctor" placeholder="Escribe aquí el código del doctor">
          </div>
        </div>

        <button type="submit" class="btn btn-info btn-block mt-3">Guardar doctor</button>
      </section>
    </form>
  </div>
</div>