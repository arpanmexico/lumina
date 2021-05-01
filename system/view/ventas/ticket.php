<?php
date_default_timezone_set('America/Mexico_City');
include('../../controller/CategoryController.php');
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../../src/css/ticket.css">
    <title>Recibo de Compra</title>
</head>

<body>
    <!-- 
        <script>
        window.addEventListener('load', function(){
            window.print();
        });
    </script>
    -->

    <div class="ticket">
        <img src="../../../src/img/lumina-ticket-logo.png" alt="Logo">
        <hr>

        <?php

        if (isset($_GET['datosTicket'])) {
            $json = json_decode($_GET['datosTicket'], JSON_UNESCAPED_UNICODE);
        ?>
            <div class="left-text">
                Vidal Solis #10, Ciudad Hidalgo Centro, CP. 61100 <br>
                <?php echo date('Y-m-d h:i:s'); ?>
                <hr>

                FOLIO: <?php echo $json['id_venta']; ?>
                <br>

                PACIENTE: <?php echo $json['nombre'] . " " . $json['apellidos']; ?> <br>
                TEL: <?php echo $json['telefono']; ?>

                <?php
                    $productos = explode(',', $json['productos']);
                    $precios = explode(',', $json['price']);
                    $marcas = explode(',', $json['brands']);
                    $cantidades = explode(',', $json['cantidad']);
                    $modelos = explode(',', $json['models']);
                    $tipos = explode(',', $json['type']);
                ?>
            </div>
            <hr>
            <div class="left-text">
                Le atendió Maricruz López Martínez
            </div>
            <table>
                <thead>
                    <tr>
                        <th class="quantity">C</th>
                        <th class="description">DESC</th>
                        <th class="price">$</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        for ($i = 0; $i < count($productos) - 1; $i++) { 
                    ?>   
                        <tr>
                            <td class="quantity"><?php echo $cantidades[$i]; ?></td>
                            <td class="description"><?php echo $modelos[$i] . " - " . $marcas[$i] . " - " . $tipos[$i]; ?></td>
                            <td class="price">$<?php echo $precios[$i] . ".00"; ?></td>
                        </tr> 
                    <?php
                        }
                    ?>        

                    <tr>
                        <td class="quantity"></td>
                        <td class="description"><b>TOTAL</b></td>
                        <td class="price">$<?php echo $json['total'] . ".00"; ?></td>
                    </tr>            
                </tbody>
            </table>

            <br>

            <div class="centered">
                PAGO: $<?php echo $json['anticipo'] == '' ? "NA" : $json['anticipo'] . ".00"; ?> <br>
                MESES: <?php echo $json['mensualidades'] == '' ? "NA" : $json['mensualidades']; ?> <br>
                DESCUENTO: <?php echo $json['descuento'] == '' ? "NA" : $json['descuento'] . "%"; ?> <br>
                FORMA PAGO: <?php  
                    switch($json['tipo_pago']){
                        case 'E':
                            echo "Efectivo";
                            break;
                        case 'T':
                            echo "Tarjeta";
                            break;
                    }
                ?>
                <br>
                TIPO VENTA:  <?php 
                    switch($json['modalidad_pago']){
                        case 'C':
                            echo "CONTADO";
                            break;
                        case 'MSI':
                            echo "MSI";
                            break;
                        case 'MCI':
                            echo "MCI";
                            break;
                    } 
                ?>
            </div>
            <p class="centered">
                ¡Gracias por su preferencia!
                luminaoptica.com.mx
            </p>


        <?php
        } else {
            echo " <br>
                <p class='centered'>Error de impresión de datos, no hay información para el ticket.</p>";
        }
        ?>
    </div>
</body>

</html>