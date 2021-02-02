<!DOCTYPE html>
<html lang="es">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>Inicio de Sesión</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
  <!-- Custom styles for this template-->
  <link href="../src/css/sb-admin-2.css" rel="stylesheet">
  <link rel="stylesheet" href="../src/css/admin.css">

</head>

<body class="bg-gradient-primary">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-xl-10 col-lg-12 col-md-9">
        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
              <div class="col-lg-6">

                <br><br><br>

                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">¡Bienvenido!</h1>
                  </div>

                  <form class="user" action="" method="POST">
                    <div class="form-group">
                      <input name="userName" type="email" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Escribe tu nombre de usuario">
                    </div>
                    <div class="form-group">
                      <input name="userPassword" type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Escribe tu contraseña">
                    </div>
                    <button type="submit" name="loginBtutton" class="btn btn-primary btn-user btn-block">
                      Iniciar Sesión</button>
                  </form>

                  <hr>
                  <div class="text-center">
                    <a class="small" href="#!">¿Olvidaste tu acceso?</a>
                  </div>

                  <br><br><br>

                  <?php
                  include('controller/UserController.php');
                  $user = new UserController();

                  if (isset($_POST['loginButton'])) {
                    $userName = $_POST['userName'];
                    $userPassword = $_POST['userPassword'];
                    $data = array(
                      'user' => $userName,
                      'password' => $userPassword
                    );

                    $user->userLogin($data);
                  }
                  ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Bootstrap core JavaScript-->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
  <script src="../src/js/sb-admin-2.js"></script>

</body>

</html>