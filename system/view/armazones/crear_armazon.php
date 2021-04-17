<?php
include('../controller/CategoryController.php');
$categorias = new CategoryController();

$codigo_barras = $categorias->IDCodeGenerator();
?>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Productos - Agregar Producto</h1>
</div>
<p class="text-muted">Bienvenido al módulo de productos, acá puede realizar operaciones como agregar nuevos proveedores y productos, <br> ver la lista de produtcos, actualizar datos y eliminar productos y/o categorias del sistema.</p>

<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Agregar un nuevo producto</h6>
    </div>

    <div class="card-body">
        <?php
        $ids_armazones = explode(",", $categorias->getCategoryInformationByType(2)['id']);
        $nombres_armazones = explode(",", $categorias->getCategoryInformationByType(2)['nombre']);
        $ids_tipos = explode(",", $categorias->getCategoryInformationByType(1)['id']);
        $nombres_tipos = explode(",", $categorias->getCategoryInformationByType(1)['nombre']);

        $ids_proveedores = explode(",", $categorias->getSuppliers()['id']);
        $nombres_proveedores = explode(",", $categorias->getSuppliers()['nombre']);
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="form-group">
                        <label for="codigoBarras">Código de Barras</label>
                        <input type="number" name="codigoBarras" class="form-control" id="codigoBarras" placeholder="Digita aquí el código de barras del producto" value="<?php echo $codigo_barras; ?>" readonly>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="form-group">
                        <label for="marcaArmazon">Marca <span class="text-danger">*</span></label>
                        <select class="form-control" id="marcaArmazon" name="marcaArmazon">
                            <option disabled selected>Selecciona la marca del producto</option>
                            <?php
                            for ($i = 0; $i < count($ids_armazones); $i++) {
                                echo "<option value='" . $ids_armazones[$i] . "'>" . $nombres_armazones[$i] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="tipoProducto">Tipo <span class="text-danger">*</span></label>
                        <select class="form-control" id="tipoProducto" name="tipoProducto">
                            <option disabled selected>Selecciona el tipo de producto</option>
                            <?php
                            for ($i = 0; $i < count($ids_tipos); $i++) {
                                echo "<option value='" . $ids_tipos[$i] . "'>" . $nombres_tipos[$i] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="modeloArmazon">Modelo <span class="text-danger">*</span></label>
                        <input type="text" name="modeloArmazon" class="form-control" id="modeloArmazon" placeholder="Escribe aquí el módelo del producto">
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="colorArmazon">Color <span class="text-danger">*</span></label>
                        <input type="text" name="colorArmazon" class="form-control" id="colorArmazon" placeholder="Escribe aquí el/los colores del producto">
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="form-group">
                        <label for="descripcionArmazon">Descripción <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="descripcionArmazon" name="descripcionArmazon" rows="3" placeholder="Escribe en esta zona todo lo que puedas del producto, ésta será la misma descripción que se mostrará en la tienda en línea..."></textarea>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="form-group">
                        <label for="precioCompraArmazon">Precio de compra <span class="text-danger">*</span></label>
                        <input type="number" name="precioCompraArmazon" class="form-control" id="precioCompraArmazon" placeholder="Escribe el precio de compra">
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="form-group">
                        <label for="precioPublicoArmazon">Precio al público <span class="text-danger">*</span></label>
                        <input type="number" name="precioPublicoArmazon" class="form-control" id="precioPublicoArmazon" placeholder="Escribe el precio al público">
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="form-group">
                        <label for="existenciaArmazon">Existencias <span class="text-danger">*</span></label>
                        <input type="number" name="existenciaArmazon" class="form-control" id="existenciaArmazon" placeholder="Digita el número de existencias">
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="form-group">
                        <label for="proveedorArmazon">Proveedor <span class="text-danger">*</span></label>
                        <select class="form-control" id="proveedorArmazon" name="proveedorArmazon">
                            <option disabled selected>Selecciona el proveedor</option>
                            <?php
                            for ($i = 0; $i < count($ids_proveedores); $i++) {
                                echo "<option value='" . $ids_proveedores[$i] . "'>" . $nombres_proveedores[$i] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="form-group">
                        <label for="fotoArmazon">Sube una foto del producto</label>
                        <input type="file" name="fotoArmazon" class="form-control-file" id="fotoArmazon">
                    </div>
                </div>
            </div>
            <button type="submit" name="guardarArmazon" class="btn btn-info btn-block mt-3">Guardar Producto e Imprimir Etiqueta</button>
        </form>
        <?php
        if (isset($_POST['guardarArmazon'])) {
            $data = array(
                'codigo' => $_POST['codigoBarras'],
                'marca' => $_POST['marcaArmazon'],
                'tipo' => $_POST['tipoProducto'],
                'modelo' => $_POST['modeloArmazon'],
                'color' => strtolower($_POST['colorArmazon']),
                'descripcion' => ucfirst($_POST['descripcionArmazon']),
                'precio_compra' => $_POST['precioCompraArmazon'],
                'precio_publico' => $_POST['precioPublicoArmazon'],
                'existencias' => $_POST['existenciaArmazon'],
                'proveedor' => $_POST['proveedorArmazon'],
                'foto' => $_FILES['fotoArmazon']['name'],
                'foto_tmp' => $_FILES['fotoArmazon']['tmp_name']
            );

            //require_once($_SERVER['DOCUMENT_ROOT'] . "/lumina/src/libs/impimirEtiqueta/src/Codadry/JY/Epl/ImprimirEPL.php");
            //require_once($_SERVER['DOCUMENT_ROOT'] . "/lumina/src/libs/impimirEtiqueta/src/Codadry/JY/Epl/ExisteImpresoraWindows.php");

            require_once($_SERVER['DOCUMENT_ROOT'] . "/src/libs/impimirEtiqueta/src/Codadry/JY/Epl/ImprimirEPL.php");
            require_once($_SERVER['DOCUMENT_ROOT'] . "/src/libs/impimirEtiqueta/src/Codadry/JY/Epl/ExisteImpresoraWindows.php");


            //Instanciamos de la clase ExisteImpresoraWindows.php para comprobar si existe la impresora
            $exiteImpresora = new ExisteImpresoraWindows();
            //Instanciamos de la clase ImprimirEpl.php para imprimir
            $epl = new ImprimirEpl();
            //Escribimos el nombre de la impresora tal cual este compartida.
            $impresora = 'Xprinter XP-450B';
            //$impresora = 'PDFCreator';


            if ($exiteImpresora->verificarImpresora($impresora, true)) {

                //Escribimos el contenido de la etiqueta a imprimir


                $codigo = $data["codigo"];
                $tipo = $data["tipo"];
                $marca = $data["marca"];
                $modelo = $data["modelo"];
                $color = $data["color"];
                $existencia = $data["existencia"];
                $precio = $data["precio_publico"];

                $texto1 = "'$codigo'";
                $texto2 = "'$tipo $modelo $color'";
                $texto3 = "$'$precio'";
                $texto4 = "LUMINA. Centro Integral Ocular";

                $etiqueta = $epl->escribirTexto($texto2, 170, 10, 1, false, 0, 3, 3);
                $etiqueta .= $epl->escribirTexto($texto3, 350, 95, 1, false, 0, 2, 2);
                $etiqueta .= $epl->pintarLinea(5, 75, 765, 10, 1, 0);


                //Ejemplo de código de barras
                $etiqueta .= $epl->pintarCodigoBarra($texto1, 190, 210, 120, 1, true, 0, 2, 6);


                $epl->imprimir($epl->construirEtiqueta($etiqueta, $existencia), $impresora, false, true);
            } else {
                echo "<h1>No existe Impresora</h1>";
            }

            // 1 => INSERT
            if ($categorias->manageFrames($data, 1)) {
                header('Location: ?listarArmazones');
            } else {
                CategoryController::getGlobalController()->getAlerts('error', 'Ocurrió un error al guardar los datos, intenta <a href="?crearArmazon">Recargar la página</a>, si el problema persiste escribe a <a href="mailto:contacto@arpan.com.mx">contacto@arpan.com.mx</a>');
            }
        }
        ?>
    </div>
</div>