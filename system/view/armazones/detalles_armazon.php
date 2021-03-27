<?php
include('../controller/CategoryController.php');
$categorias = new CategoryController();
?>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Armazones - Detalles de Producto</h1>
</div>
<div class="card shadow mb-4">
    <div class="card-body">
        <a href="?listarArmazones"><i class="fas fa-chevron-left"></i> Volver a la lista de productos</a>
        <?php
        $unserialized_array = $_GET['detallesArmazon'];
        $array = unserialize(urldecode($unserialized_array));

        $ids_armazones = explode(",", $categorias->getCategoryInformationByType(2)['id']);
        $nombres_armazones = explode(",", $categorias->getCategoryInformationByType(2)['nombre']);
        $ids_tipo = explode(",", $categorias->getCategoryInformationByType(1)['id']);
        $nombres_tipo = explode(",", $categorias->getCategoryInformationByType(1)['nombre']);

        $ids_proveedores = explode(",", $categorias->getSuppliers()['id']);
        $nombres_proveedores = explode(",", $categorias->getSuppliers()['nombre']);
        ?>

        <form action="" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-lg-5 col-sm-6 col-sm-12 align-self-center text-center">
                    <img src='../../src/catalog/<?php echo $array['foto']; ?>' class="img-fluid">
                    <p class="font-weight-bolder">
                        Fecha de Creación del Armazón:
                    </p>
                    <?php
                    echo $categorias->getGlobalController()->getFormattedDate($array['ingresado']);
                    ?>
                    <hr>
                    <p class="font-weight-bolder">
                        Última Fecha de Actualización del Armazón:
                    </p>
                    <?php
                    echo $categorias->getGlobalController()->getFormattedDate($array['actualizado']);
                    ?>
                </div>
                <div class=" col-lg-7 col-sm-6 col-sm-12">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="codigoBarras">Código de Barras <span class="text-danger">(No se puede cambiar)</span></label>
                                <input type="number" name="codigoBarras" class="form-control" id="codigoBarras" placeholder="Digita aquí el código de barras" value="<?php echo $array['id']; ?>" disabled>
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
                                <label for="tipoProducto">Tipo</label>
                                <select class="form-control" id="tipoProducto" name="tipoProducto">
                                    <option disabled selected>Selecciona el tipo de producto</option>
                                    <?php
                                    for ($i = 0; $i < count($ids_tipo); $i++) {
                                        if ($nombres_tipo[$i] == $array['tipo'])
                                            echo "<option value='" . $ids_tipo[$i] . "' selected>" . $nombres_tipo[$i] . "</option>";
                                        else
                                            echo "<option value='" . $ids_tipo[$i] . "'>" . $nombres_tipo[$i] . "</option>";
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
                        <div class="ml-auto mx-auto mt-3">
                            <a href="../controller/DeleteData.php?idArmazon=<?php echo $array['id']; ?>&accionArmazon=suspend" class="text-danger">Eliminar Armazón</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div class="container-fluid mt-4">
            <?php
            if (isset($_POST['actualizarArmazon'])) {
                $data = array(
                    'codigo' => $array['id'],
                    'marca' => $_POST['marcaArmazon'],
                    'modelo' => $_POST['modeloArmazon'],
                    'color' => strtolower($_POST['colorArmazon']),
                    'descripcion' => ucfirst($_POST['descripcionArmazon']),
                    'precio' => $_POST['precioArmazon'],
                    'existencias' => $_POST['existenciaArmazon'],
                    'proveedor' => $_POST['proveedorArmazon'],
                    'foto' => 'NA'
                );
                // 2 => UPDATE
                if ($categorias->manageFrames($data, 2)) {
                    //header("Refresh: 0");
                    echo "<div class='alert alert-success'>
                    Los datos han sido actualizados correctamente, por favor vuelve a la lista de armazones para que los cambios sean reflejados. <br>
                    <a href='?listarArmazones'>Volver a la lista de armazones</a>
                     </div>";
                } else {
                    echo "<div class='alert alert-danger'>
                    Ocurrió un error al guardar los datos, intenta <a href='?crearArmazon'>Recargar la página</a>, si el problema persiste escribe a <a href='mailto:contacto@arpan.com.mx'>contacto@arpan.com.mx</a>
                     </div>";
                }
            }
            ?>
        </div>
    </div>
</div>