<?php
include('system/config/database.php');
include('system/controller/BranchController.php');
$sucursal = new BranchController();

?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
  <link rel="stylesheet" href="src/css/normalize.css">
  <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
  <link rel="stylesheet" href="src/css/index.css">
  <link rel="stylesheet" href="src/libs/fullcalendar/lib/main.min.css">
  <link rel="stylesheet" href="src/libs/clockpicker/src/clockpicker.css">
  
  <!-- Favicon -->
  <link rel="apple-touch-icon" sizes="180x180" href="src/favicon/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="src/favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="src/favicon/favicon-16x16.png">
  <link rel="manifest" href="src/favicon/site.webmanifest">
  <title>Óptica Lumina</title>
</head>

<body>


  <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
      <a class="navbar-brand" href="#">
        <img src="src/img/lumina-logo.png" class="img-fluid" width="100" alt="">
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link title mr-3" href="#about" id="quienes_somos_link">Quienes somos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link title mr-3" href="#services" id="servicios_link">Servicios</a>
          </li>
          <li class="nav-item">
            <a class="nav-link title mr-3" href="#!" id="tienda_link">Tienda en línea</a>
          </li>
          <li class="nav-item">
            <a class="nav-link title mr-3" href="#booking" id="cita_link">Agenda tu cita</a>
          </li>
          <li class="nav-item">
            <a class="nav-link title" href="#contact" id="contacto_link">Contáctanos</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>


  <header class="masthead" id="top">
    <div class="container align-items-center">
      <div class="row">
        <div class="col-md-7 align-self-center">
          <p class="subtitle dark-color">Centro Integral Ocular Lumina</p>
          <h1 class="display-4 title p-0 m-0">La mejor tecnología al servicio de tus ojos </h1>
          <p class="mt-4">Si necesitas aseoría personalizada, agendar una cita o solución de dudas escribe tu correo
            electrónico y nos pondremos en contacto contigo.</p>
          <div class="row">
            <div class="col-md-10">
              <div class="input-group">
                <input name="correo" id="correoRegistro" style="border-radius: 15px 0px 0px 15px;" type="email" class="form-control shadow" placeholder="Escribe tu correo electrónico">
                <div class="input-group-prepend">
                  <span class="input-group-text text-uppercase shadow" style="border-radius: 0px 15px 15px 0px;">
                    <a href="#!" class="text-white" id="contactButton">Contáctame</a>
                  </span>
                </div>
              </div>

              <!-- Error message -->
              <div id="errorMessage" class="alert alert-danger mt-3" role="alert">
                El correo no es correcto, escríbelo de nuevo con la forma <b>correo@dominio.com</b> o
                <b>correo@dominio.com.mx</b>
              </div>
              <div id="successMessage" class="alert alert-success mt-3" role="alert">
                <b>¡Gracias!</b>
                Tu petición fue enviada correctamente, nos pondremos en contacto contigo lo más pronto posible.
              </div>

            </div>
            <div class="col-md-2"></div>
          </div>
          <div class="row mt-5">
            <div class="col-md-3 text-center">
              <h2 class="subtitle">240</h2>
              <p>Lorem ipsum dolor sit amet</p>
            </div>
            <div class="col-md-3 text-center">
              <h2 class="subtitle">120</h2>
              <p>Lorem ipsum dolor sit amet</p>
            </div>
            <div class="col-md-3 text-center">
              <h2 class="subtitle">345+</h2>
              <p>Lorem ipsum dolor sit amet</p>
            </div>
            <div class="col-md-3"></div>
          </div>
        </div>
        <div class="col-md-5"></div>
      </div>
    </div>
  </header>


  <div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-5" data-aos="fade-right">
      <h1 class="title" id="about">¿Quiénes somos?</h1>
      <p>Somos una empresa dedicada a prevenir y cuidar de la salud visual de las personas dentro de la región oriente de Michoacán y sus alrededores. <br>
        Puesto que contamos con especialista en oftalmología y optometrista, los cuales buscan prevenir problemas oculares con distintitos tratamientos los cuales ayudaran a mejorar tu bienestar visual</p>

      <h3 class="subtitle mt-5">Puedes encontrarnos en</h3>
      <p><i class="fas fa-location-arrow light-color"></i> Vidal Solis #10, Colonia Centro, CP. 61100, Ciudad Hidalgo
        Michoacán</p>
      <p><i class="fas fa-clock light-color"></i> 10:00 - 20:00</p>
      <p><i class="fas fa-phone light-color"></i> +52 786 154 6908</p>
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5894.682841663783!2d-100.55614753116616!3d19.688548638274863!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d2cb151daf6bad%3A0x5370d65e70009aa5!2sLumina!5e0!3m2!1sen!2sus!4v1609747274105!5m2!1sen!2sus" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
    </div>
    <div class="col-md-6 mt-5 py-5 align-self-center">
      <img src="src/img/business.png" class="img-fluid" alt="">
    </div>
  </div>

  <section class="container-fluid">
    <h1 class="title text-center" id="services">Servicios y Procedimientos</h1>

    <div class="row">
      <div class="col-md-6">
        <img src="src/img/pexels-ksenia-chernaya-5752309.jpg" class="img-fluid" alt="">
      </div>
      <div class="col-md-6 text-center align-self-center">
        <h3 class="subtitle text-uppercase">Oftalmología</h3>
        <div class="row text-muted">
          <div class="col-md-4">
            <h4>Cataratas</h4>
          </div>
          <div class="col-md-4">
            <h4>Glaucoma</h4>
          </div>
          <div class="col-md-4">
            <h4>Conjuntivitis</h4>
          </div>
          <div class="col-md-12 mt-5">
            <h4>Cirugía refractiva</h4>
          </div>
          <div class="col-md-12 mt-5">
            <h4>Lentes intraoculares para miopía alta</h4>
          </div>
          <div class="col-md-12 mt-5">
            <h4>Tratamiento láser pafa retinopatía diabética</h4>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6 text-center align-self-center">
        <h3 class="subtitle text-uppercase">Optometría</h3>
        <div class="row text-muted">
          <div class="col-md-12">
            <h4>Corrección de miopía, hipermetropía, astigmatismo y ambliopía
            </h4>
          </div>
          <div class="col-md-6 mt-5">
            <h4>Lentes de contacto</h4>
          </div>
          <div class="col-md-6 mt-5">
            <h4>Lentes graduados</h4>
          </div>
          <div class="col-md-6 mt-5">
            <h4>Prótesis Oculares</h4>
          </div>
          <div class="col-md-6 mt-5">
            <h4>Queratócono</h4>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <img src="src/img/pexels-daniel-frank-305565.jpg" class="img-fluid" alt="">
      </div>
    </div>
  </section>

  <h1 class="title text-center mt-5">Armazones</h1>
  <section id="cta" class="cta">
    <div class="container">
      <div class="text-center text-white subtitle" data-aos="zoom-in">
        <h1 class="display-4 text-uppercase">Luce tu mejor estilo</h1>
        <h4>con nuestra gran variedad de armazones</h4>
      </div>
    </div>
  </section>
  <section class="container">
    <div class="text-center">
      <h3 class="subtitle mt-3">Y con marcas como</h3>
      <div class="row" data-aos="flip-up">
        <div class="col-md-4 align-self-center">
          <img src="src/img/Ocuerna-levis%402x_.svg" alt="" class="img-fluid">
        </div>
        <div class="col-md-4 align-self-center">
          <img src="src/img/logo.jpeg" alt="" class="img-fluid">
        </div>
        <div class="col-md-4 align-self-center">
          <img src="src/img/Ocuerna-reebook%402x_2.svg" alt="" class="img-fluid">
        </div>
      </div>

    </div>
  </section>

  <section class="container">
    <div class="row">
      <div class="col-md-6 mt-3" data-aos="fade-right">
        Óptica Lumina es una empresa de nuevo ingreso en el mercado, puesto que lleva alrededor de 2 años de labor dentro de la región de Ciudad Hidalgo Michoacán. <br> <br>

        Esta surge de la idea de unos jóvenes emprendedores los cuales quisieron aprovechar de su talento, puesto que uno de ellos es <b>Doctor y Cirujano Oftálmico</b> y su socio es <b>Especialista en Manejo de Materiales para la Elaboración de Lentes Oftálmicos</b>, por ello decidieron abrir una óptica, la cual ya cuenta con una amplia gama de servicios y lentes. <br> <br>

        Los servicios que se brindan son desde tratamientos alérgicos en el ojo, hasta cirugías o cuales las cuales abarcan y cubren el 99.99% de problemas relacionados a la visón. <br>
        En la gama de productos se enfocan principalmente en la venta de lentes oftálmicos, lentes solares y lentes de contacto, hasta reparaciones menores de armazones puesto que tiente una gran ventaja competitiva en la región buscan expandirse a largo plazo e incrementar sus ventas a corto y mediano plazo, para poder cubrir toda esta zona. <br></br>

        Óptica Lumina es una empresa de nuevo comienzo posicionada en la región oriente de Michoacán, su prestigio se debe a la excelente calidad de atención en los diversos servicios que ofrece para combatir en los problemas visuales, la mayor parte de reconocimiento y posicionamiento es debido al <b>Doctor Rodrigo González Solís Cirujano Oftálmico</b> puesto que brinda una atención de calidad ante la sociedad Ciudadalguence ayudando a la mejora y solucionar la variedad de los problemas visuales que habitan en ellos.
      </div>
      <div class="col-md-6" data-aos="fade-left">
        <img src="src/img/shooting.png" alt="" class="img-fluid">
      </div>
    </div>
    <a href="#!" class="mt-5 btn btn-lg btn-primary btn-block light-color-bg">Visita nuestra tienda en línea</a>
  </section>

  <section class="container mb-5">
    <h1 class="title text-center" id="booking">Agenda tu cita</h1>
    <p class="quote">
      Agenda tu consulta con Óptica Lumina y con médicos certificados. <br>
      Estamos listos para atenderte de manera ágil y segura.
    </p>


    <div class="row" data-aos="fade-left">
      <div class="col-md-10 mx-auto">
        <div class="card shadow p-2">
          <div id="calendar" class="m-2"></div>
        </div>
      </div>

      <div class="col-2 mx-auto mt-5">

        <div class="col">
          <p class="small text-muted font-weight-bold">Da click en el día en que quieres agendar tu cita.</p>
        </div>
        <div class="col">
          <p class="small text-muted font-weight-bold">Cinta del estilo <span class="fc-daygrid-event fc-daygrid-dot-event fc-event my-auto" style="width: 10vh" ;></span> indica que el horario no está disponible.</p>

        </div>
      </div>

    </div>

    <!-- Insertar aquí el calendario para visualizar fechas/horas reservadas y disponibles -->
  </section>

  <section class="container mb-5">
    <h1 class="title text-center" id="contact">Contáctanos</h1>
    <p class="quote">
      Resolvemos tus dudas y te orientamos en tus futuras consultas y procedimientos oftalmicos, déjanos un mensaje y nos pondremos en contacto contigo lo más rápido posible.
    </p>
    <div class="row">
      <div class="col-md-6" data-aos="fade-right">
        <div class="card shadow p-2">
          <div class="card-body">
            <div class="features">
              <i class="fas fa-location-arrow light-color"></i>
              <h5>Ubicación</h5>
              <p class="text-muted">
                <?php echo $sucursal->getBranchInformation()['direccion']; ?>
              </p>
            </div>
            <div class="row">
              <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="features">
                  <i class="fas fa-phone light-color"></i>
                  <h5>Teléfono <br> Primario</h5>
                  <p class="test-muted">
                    +52 <?php echo $sucursal->getBranchInformation()['telefono_primario']; ?>
                  </p>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="features">
                  <i class="fas fa-phone light-color"></i>
                  <h5>Teléfono <br> Secundario</h5>
                  <p class="text-muted">
                    +52 <?php echo $sucursal->getBranchInformation()['telefono_secundario']; ?>
                  </p>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="features">
                  <i class="fas fa-envelope light-color"></i>
                  <h5>Correo Electrónico</h5>
                  <p class="text-muted">
                    <?php echo $sucursal->getBranchInformation()['correo']; ?>
                  </p>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="features mb-3">
                  <i class="fas fa-user-injured light-color"></i>
                  <h5>Costo de Revisión</h5>
                  <p class="text-muted">
                    $<?php echo $sucursal->getBranchInformation()['costo_consulta']; ?>.00
                  </p>
                </div>
              </div>
            </div>
            <br>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5894.682841663783!2d-100.55614753116616!3d19.688548638274863!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d2cb151daf6bad%3A0x5370d65e70009aa5!2sLumina!5e0!3m2!1sen!2sus!4v1609747274105!5m2!1sen!2sus" width="100%" height="250" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
          </div>
        </div>
      </div>
      <div class="col-md-6" data-aos="fade-left">
        <div class="card shadow p-3">
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="inputName">Nombre</label>
                  <input type="text" class="form-control contact-form-input" name="nombre" id="inputName" placeholder="Escribe aquí tu nombre">
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label for="inputEmail">Correo Electrónico</label>
                  <input type="email" class="form-control contact-form-input" name="correo" id="inputEmail" placeholder="Escribe aquí tu correo">
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label for="inputSubject">Asunto</label>
                  <input type="text" class="form-control contact-form-input" name="asunto" id="inputSubject" placeholder="¿Cuál es el asunto a tratar?">
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label for="inputMessage">Mensaje</label>
                  <textarea class="form-control contact-form-input" id="inputMessage" rows="4" placeholder="Escribe aquí tu mensaje..."></textarea>
                </div>
              </div>
              <div class="col-md-12">
                <button id="sendCommentButton" class="btn btn-primary btn-block light-color-bg">Enviar
                  comentario</button>
              </div>
            </div>
            <!-- Info Message -->
            <div id="contactInfoMessage" class="alert alert-info mt-3" role="alert">
              Estamos enviando tus datos, por favor espera...
            </div>

            <!-- Error message -->
            <div id="contactErrorMessage" class="alert alert-danger mt-3" role="alert">
              <!--  ...  -->
            </div>
            <div id="contactSuccessMessage" class="alert alert-success mt-3" role="alert">
              <!-- ... -->
            </div>
            <br>
          </div>
        </div>
      </div>
    </div>
  </section>

  <footer class="footer mt-auto py-3">
    <div class="container">
      <span class="text-muted">Sitio diseñado por:
        <a class="text-dark subtitle" href="https://arpan.com.mx" target="_blank">
          <img src="src/img/logo.svg" class="img-fluid" width="20" alt="">
          ARPAN México</a>
      </span>
    </div>
  </footer>


  <!-- Modal para agendar cita -->
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


          <div class="form-group row">

            <div class="col">
              <label for="txtDescription">Detalles</span></label>
              <textarea id="txtDescription" rows="3" class="form-control"></textarea>
            </div>
            <div class="col">
              <label for="txtPhone">Teléfono (10 digitos)<span class="text-danger font-weight-bold"> *</label>
              <input type="number" name="" id="txtPhone" class="form-control">
              <span class="text-danger font-weight-bold small" id="phoneValidation">Tiene que ser un teléfono con 10 dígitos, sin espacios ni guiones.</span>
            </div>

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
        </div>
      </div>
    </div>
  </div>


  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script src="src/js/index.js"></script>
  <script src="src/libs/fullcalendar/lib/main.js"></script>
  <script src="src/libs/fullcalendar/lib/locales-all.min.js"></script>
  <script src="src/libs/clockpicker/src/clockpicker.js"></script>
  <script src="src/js/landingCalendar.js"></script>
</body>

</html>