<?php 
    include('../controller/TicketController.php');
    $ticket = new TicketController();

?>
<!-- No tuve elección, y aqui les pregunto ¿Qué hubieran hecho ustedes? -->
<style>

    .ticket{
        font-size: 14px !important;
        font-family: "Monaco";
        letter-spacing: 0.2px; 
        line-height: 20px;
    }
    td, th, tr,
    table {
        border-top: 1px solid black;
        border-collapse: collapse;
    }

    td.description,
    th.description {
        width: 85px;
        max-width: 85px;
        text-align: left !important;
    }

    td.quantity,
    th.quantity {
        width: 30px;
        max-width: 30px;
        word-break: break-all;
        text-align: center !important;
    }

    td.price,
    th.price {
        width: 90px;
        max-width: 90px;
        word-break: break-all;
        
    }

    .centered {
        text-align: center;
        align-content: center;
    }

    .left-text{
        text-align: left;
        align-content: left;
    }

    .ticket {
        width: 170px;
        max-width: 170px;
    }

    img {
        max-width: inherit;
        width: inherit;
    }
</style> 

<div class="d-sm-flex align-items-center justify-content-between mb-3">
  <h1 class="h3 mb-0 text-gray-800">Mi ticket</h1>
</div>
<p class="text-muted">Bienvenido. Aquí podrás modificar tu ticket de venta.</p>
<div id="result" class="mx-auto card mb-3 shadow rounded">

</div>

<div class="row">
    <div class="card mb-4 mx-auto col-12 col-md-4">
        <div class="card-header bg-transparent py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 col-12 font-weight-bold text-primary">Vista previa <span class="small ml-3 text-muted">El mensaje aparecerá en la zona remarcada</span></h6>
        </div>
        <div class="card-body text-center">
            <div class="ticket mx-auto">
                <img src="../../src/img/lumina-ticket-logo.png" alt="Logo">
                <hr>                
                    <div class="left-text">
                        Vidal Solis #10, Ciudad Hidalgo Centro, CP. 61100 <br>
                        <?php echo date('Y-m-d h:i:s'); ?>
                        <hr>

                        FOLIO: 3453454
                        <br>

                        PACIENTE: Nombre del paciente <br>
                        TEL: XXX XXX XXXX

                        Productos
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
                            
                            <tr>
                                <td class="quantity"></td>
                                <td class="description"></td>
                                <td class="price">$</td>
                            </tr> 
                                 

                            <tr>
                                <td class="quantity"></td>
                                <td class="description"><b>TOTAL</b></td>
                                <td class="price">$ 50</td>
                            </tr>            
                        </tbody>
                    </table>

                    <br>

                    <div class="centered">
                        PAGO: <br>
                        MESES: <br>
                        DESCUENTO:  <br>
                        FORMA PAGO:
                        <br>
                        TIPO VENTA:  
                    </div>
                    <div class="shadow border rounded border-primary">
                        <p class="centered m-3" id="prev-ticket-msg">
                            <?php $ticket->getMessages(); ?>
                        </p>
                    </div>


               
            </div>
        </div>
    </div>

    <div class="mx-auto col-12 col-md-7">
        <div class="card shadow h-auto">
            <div class="card-header bg-transparent py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 col-9 font-weight-bold text-primary">Modificar mensaje</h6>
            </div>
            <div class="card-body h-auto">
                <div class="form-group">
                    <label for="ticketMsg">Escribe aqui el mensaje o leyenda que deseas que aparezca al final del ticket</label>
                    <textarea name="ticketMsg" id="ticketMsg" cols="30" rows="5" class="form-control"></textarea>
                </div>

                <button class="btn btn-info btn-block my-2" id="ticketMsgBtn">Guardar cambios</button>
            </div>
        </div>
    </div>

</div>
