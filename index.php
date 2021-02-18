<?php
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
  <title>Óptica Lumina</title>
</head>

<body>


  <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
      <a class="navbar-brand" href="#">
        <img src="https://storage.googleapis.com/optica-lumina/landing/logo.png" class="img-fluid" width="100" alt="">
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link title mr-3" href="#about">Quienes somos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link title mr-3" href="#services">Servicios</a>
          </li>
          <li class="nav-item">
            <a class="nav-link title mr-3" href="#!">Tienda en línea</a>
          </li>
          <li class="nav-item">
            <a class="nav-link title" href="#contact">Contáctanos</a>
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
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloribus facilis animi tempora nulla alias ea fugit
        officiis voluptatibus sequi quidem fuga necessitatibus, neque commodi adipisci, reprehenderit eos quaerat
        deleniti similique.</p>
      <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aut cum quibusdam nobis sed ullam explicabo
        cupiditate officiis totam, suscipit animi sapiente eveniet dignissimos accusantium fugit sequi quidem! Animi, et
        praesentium.</p>

      <h3 class="subtitle mt-5">Puedes encontrarnos en</h3>
      <p><i class="fas fa-location-arrow light-color"></i> Vidal Solis #10, Colonia Centro, CP. 61100, Ciudad Hidalgo
        Michoacán</p>
      <p><i class="fas fa-clock light-color"></i> 10:00 - 20:00</p>
      <p><i class="fas fa-phone light-color"></i> +52 786 154 6908</p>
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5894.682841663783!2d-100.55614753116616!3d19.688548638274863!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d2cb151daf6bad%3A0x5370d65e70009aa5!2sLumina!5e0!3m2!1sen!2sus!4v1609747274105!5m2!1sen!2sus" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
    </div>
    <div class="col-md-6 mt-5 py-5 align-self-center">
      <img src="https://storage.googleapis.com/optica-lumina/landing/business.png" class="img-fluid" alt="">
    </div>
  </div>

  <section class="container-fluid">
    <h1 class="title text-center" id="services">Servicios y Procedimientos</h1>

    <div class="row">
      <div class="col-md-6">
        <img src="https://storage.googleapis.com/optica-lumina/landing/pexels-ksenia-chernaya-5752309.jpg" class="img-fluid" alt="">
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
        <img src="https://storage.googleapis.com/optica-lumina/landing/pexels-daniel-frank-305565.jpg" class="img-fluid" alt="">
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
          <img src="https://storage.googleapis.com/optica-lumina/landing/Ocuerna-levis%402x_.svg" alt="" class="img-fluid">
        </div>
        <div class="col-md-4 align-self-center">
          <img src="https://storage.googleapis.com/optica-lumina/landing/logo.jpeg" alt="" class="img-fluid">
        </div>
        <div class="col-md-4 align-self-center">
          <img src="https://storage.googleapis.com/optica-lumina/landing/Ocuerna-reebook%402x_2.svg" alt="" class="img-fluid">
        </div>
      </div>

    </div>
  </section>

  <section class="container">
    <div class="row">
      <div class="col-md-6 mt-3" data-aos="fade-right">
        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Cumque cupiditate veniam optio quisquam explicabo
        illum in ipsa quis totam iusto eum, earum neque quibusdam voluptatibus aperiam autem ea dolorum numquam. <br>
        <br>
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae sit eligendi voluptate natus reprehenderit
        eius. Ea consequuntur dicta, veniam necessitatibus consectetur optio voluptates, sit error eaque, soluta nemo
        rem. Vero! <br> <br>
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nihil ad id perspiciatis ullam. Sapiente molestias,
        necessitatibus, asperiores excepturi animi reiciendis distinctio ipsum est assumenda dolore quam ut sequi
        debitis nulla. <br> <br>
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolor doloremque hic numquam temporibus sed
        praesentium, labore reiciendis sapiente perferendis error eius? Ducimus deleniti porro ea quasi? Ipsa est labore
        autem!
      </div>
      <div class="col-md-6" data-aos="fade-left">
        <img src="https://storage.googleapis.com/optica-lumina/landing/shooting.png" alt="" class="img-fluid">
      </div>
    </div>
    <a href="#!" class="mt-5 btn btn-lg btn-primary btn-block light-color-bg">Visita nuestra tienda en línea</a>
  </section>

  <section class="container mb-5">
    <h1 class="title text-center" id="contact">Contáctanos</h1>
    <p class="quote">
      Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur
      velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis
      commodi quidem hic quas
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
          <img src="https://storage.googleapis.com/arpan/landing/logo.svg" class="img-fluid" width="20" alt="">
          ARPAN México</a>
      </span>
    </div>
  </footer>


  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script src="src/js/index.js"></script>
</body>

</html>