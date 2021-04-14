<?php
if (isset($_GET['notificaciones'])) {
  if ($_GET['notificaciones'] == "alertas") {
?>

    alertas

  <?php

  } else if ($_GET['notificaciones'] == "mensajeria") {

  ?>

    <div class="row">
      <?php
      foreach ($usuario->getMessageCenter('all') as $key => $value) {
      ?>
        <div class="col-lg-4 col-md-2 col-sm-12 mb-3">
          <div class="card shadow-sm h-100">
            <div class="card-body">
              <div class="row mb-2">
                <div class="col-12">
                  <small><i class="far fa-clock"></i> <?php echo $value['ingresado']; ?></small>
                </div>
              </div>
              <div class="text-center">
                <div class="row">
                  <div class="col-6 mx-auto mt-1">
                    <a href="#!">
                      <img src="../../src/img/message.png" width="100" class="img-fluid">
                    </a>
                  </div>
                  <div class="col-12 mt-3">
                    <h5><?php echo $value['nombre']; ?></h5>
                  </div>
                </div>
                <p class="text-muted"><?php echo $value['correo']; ?></p>
                <hr>
                <a type="button" href="#!" class="text-info" data-toggle="modal" data-target="<?php echo "#modal" . $value['id']; ?>">Ver y contestar Mensaje</a>
              </div>
            </div>
          </div>
        </div>

        <div class="modal fade" id="<?php echo "modal" . $value['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Responder a <?php echo $value['nombre']; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <b>Mensaje:</b>
                <p class="text-muted"><?php echo $value['mensaje']; ?></p>
                <b>Respuesta: </b>
                <div class="form-group">
                  <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Escribe aquí tu respuesta..."></textarea>
                  <small>Esta respuesta será enviada por Correo Electrónico a la dirección que la persona registró.</small>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary">Enviar respuesta</button>
              </div>
            </div>
          </div>
        </div>
      <?php
      }
      ?>
    </div>

<?php
  }
} else {
  echo "No tienes acceso a esta zona";
}
?>