<?php
include('../controller/CategoryController.php');
$categorias = new CategoryController();
?>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Armazones - Detalles de Producto</h1>
</div>
<p class="text-muted">Bienvenido al módulo de armazones, acá puede realizar operaciones como agregar nuevos proveedores, <br> ver la lista de armazones, actualizar datos y eliminar una categoría del sistema.</p>

<div class="card shadow mb-4">
    <div class="card-body">
        <a href="?listarArmazones"><i class="fas fa-chevron-left"></i> Volver a la lista de productos</a>
        <?php
        $unserialized_array = $_GET['detallesArmazon'];
        $array = unserialize(urldecode($unserialized_array));

        $ids_armazones = explode(",", $categorias->getCategoryInformationByType(2)['id']);
        $nombres_armazones = explode(",", $categorias->getCategoryInformationByType(2)['nombre']);

        $ids_proveedores = explode(",", $categorias->getSuppliers()['id']);
        $nombres_proveedores = explode(",", $categorias->getSuppliers()['nombre']);
        ?>

        <form action="" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-lg-5 col-sm-6 col-sm-12 align-self-center">
                    <img src='../../src/catalog/<?php echo $array['foto']; ?>' class="img-fluid">
                </div>
                <div class=" col-lg-7 col-sm-6 col-sm-12">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="codigoBarras">Código de Barras del Armazon</label>
                                <input type="number" name="codigoBarras" class="form-control" id="codigoBarras" placeholder="Digita aquí el código de barras" value="<?php echo $array['id']; ?>">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="marcaArmazon">Marca</label>
                                <select class="form-control" id="marcaArmazon" name="marcaArmazon">
                                    <option disabled selected>Selecciona la marca del armazon</option>
                                    <?php
                                    for ($i = 0; $i < count($ids_armazones); $i++) {
                                        if ($nombres_armazones[$i] == $array['marca'])
                                            echo "<option value='" . $ids_armazones[$i] . "' selected>" . $nombres_armazones[$i] . "</option>";
                                        else
                                            echo "<option value='" . $ids_armazones[$i] . "'>" . $nombres_armazones[$i] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="modeloArmazon">Módelo del Armazon</label>
                                <input type="text" name="modeloArmazon" class="form-control" id="modeloArmazon" placeholder="Escribe aquí el módelo del armazon" value="<?php echo $array['modelo']; ?>">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="colorArmazon">Color del Armazon</label>
                                <input type="text" name="colorArmazon" class="form-control" id="colorArmazon" placeholder="Escribe aquí el/los colores del armazon" value="<?php echo $array['color']; ?>">
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="descripcionArmazon">Descripción del Armazon</label>
                                <textarea class="form-control" id="descripcionArmazon" name="descripcionArmazon" rows="3" placeholder="Escribe en esra zona todo lo que puedas del armazon, ésta será la misma descripción que se mostrará en la tienda en línea..."><?php echo $array['descripcion']; ?></textarea>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="precioArmazon">Precio al público</label>
                                <input type="number" name="precioArmazon" class="form-control" id="precioArmazon" placeholder="Escribe el precio al público" value="<?php echo $array['precio']; ?>">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="existenciaArmazon">Existencias</label>
                                <input type="number" name="existenciaArmazon" class="form-control" id="existenciaArmazon" placeholder="Digita el número de existencias" value="<?php echo $array['existencias']; ?>">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="proveedorArmazon">Proveedor</label>
                                <select class="form-control" id="proveedorArmazon" name="proveedorArmazon">
                                    <option disabled selected>Selecciona el proveedor</option>
                                    <?php
                                    for ($i = 0; $i < count($ids_proveedores); $i++) {
                                        if ($nombres_proveedores[$i] == $array['proveedor'])
                                            echo "<option value='" . $ids_proveedores[$i] . "' selected>" . $nombres_proveedores[$i] . "</option>";
                                        else
                                            echo "<option value='" . $ids_proveedores[$i] . "'>" . $nombres_proveedores[$i] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <button type="submit" name="actualizarArmazon" class="btn btn-info btn-block">Actualizar Datos</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>