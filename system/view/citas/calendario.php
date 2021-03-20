<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Calendario de citas</h1>
</div>
<p class="text-muted">Bienvenido al módulo de ciats, acá puede realizar operaciones como agendar nuevas citas, <br> ver las próximas citas y así como editar y/o eliminar una cita agendada.</p>

<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Calendario</h6>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <div id="calendar"></div>
            </div>
        </div>
        
    </div>

    <div class="modal fade" id="eventModal" tabindex="-1" data-backdrop="static" aria-labelledby="eventModal" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold" id="eventTitle"></h5>
                    <button type="button" class="close none-btn" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
                </div>
                <div class="modal-body">
                   <div class="form-group row">
                    <input type="text" id="eventId" class="d-none">
                        <div class="col">
                            <label for="txtName">Nombre del paciente <span class="text-danger font-weight-bold"> *</span></label>
                            <input type="text" id="txtName" class="form-control">
                        </div>
                        <div class="col">
                            <label for="txtLastName">Apellidos del paciente <span class="text-danger font-weight-bold"> *</span></label>
                            <input type="text" id="txtLastName" class="form-control">
                        </div>
                   </div>
                   

                    <div class="form-group">
                        <label for="txtDescription">Detalles</label>
                        <textarea id="txtDescription" rows="3" class="form-control"></textarea>
                    </div>

                    <div class="form-group row">
                            <div class="col-12 col-sm-12 col-md-4">
                                <label for="txtDate">Fecha <span class="text-danger font-weight-bold"> *</span></label>
                                <div class="input-group">
                                    <input type="date" id="txtDate" class="form-control">
                                    <span class="input-group-append">
                                        <label for="txtDate" class="input-group-text bg-transparent"><i class="fa fa-calendar"></i></label>
                                    </span>
                                </div>
                                
                            </div>
                            <div class="col-12 col-sm-12 col-md-4 clockpicker">
                                <label for="txtTime">Hora <span class="text-danger font-weight-bold"> *</span></label>
                                <div class="input-group">
                                    <input type="text" id="txtTime" class="form-control">
                                    <span class="input-group-append">
                                        <label for="txtTime" class="input-group-text bg-transparent"><i class="fa fa-clock"></i></label>
                                    </span>
                                </div>
                                
                                
                            </div>

                            <div class="col-12 col-sm-12 col-md-4" id="colorContent">
                                <label for="txtColor">Color <span class="text-danger font-weight-bold"> *</span></label>
                                <input id="txtColor" type="color" class="form-control">
                            </div>
                    </div>

                    <div class="alert alert-warning" role="alert" id="emptyField">
                        Por favor, llene los campos obigatorios marcados con un <span class="text-danger font-weight-bold"> * </span>
                    </div>
                    <div class="alert alert-warning" role="alert" id="wrongDate">
                        Lo sentimos, esta fecha no es accesible, elija una fecha a partir del día de hoy.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" id="btnAdd" class="btn btn-success">Agregar</button>
                    <button type="button" id="btnUpdate" class="btn btn-primary">Actualizar</button>
                    <button type="button" id="btnDelete" class="btn btn-danger">Eliminar</button>
                </div>
            </div>
        </div>
    </div>
</div>

