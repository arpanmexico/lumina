<?php
include('../controller/CategoryController.php');
$categorias = new CategoryController();
?>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Armazones - Agregar Armazón</h1>
</div>
<p class="text-muted">Bienvenido al módulo de armazones, acá puede realizar operaciones como agregar nuevos proveedores, <br> ver la lista de armazones, actualizar datos y eliminar una categoría del sistema.</p>

<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Agregar un nuevo armazón</h6>
    </div>
    <div class="card-body">
        <form action="" method="post">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="form-group">
                        <label for="codigoBarras">Código de Barras del Armazon</label>
                        <input type="number" name="codigoBarras" class="form-control" id="codigoBarras" placeholder="Digita aquí el código de barras">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">

                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    
                </div>
            </div>

            <button type="submit" name="guardarProveedor" class="btn btn-info btn-block mt-3">Guardar Proveedor</button>
        </form>
    </div>
</div>