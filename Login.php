<?php
    session_start();
    require "limpiar.php";
    include_once "libs/crud.php";
    
    if (isset($_SESSION['usuarios']) == FALSE) {
        $_SESSION['usuarios'] = [];
    }
    if (isset($_POST['btnIngresar'])) {
        $usuario = LimpiarCadena($_POST['txtUsuario']);
        $contrasena = hash("sha512",LimpiarCadena($_POST['txtClave']));
        login($usuario,$contrasena);
    }
?>
<html>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
<link href="assets/css/style.css" rel="stylesheet">


<div id="login">
        <h3 class="text-center text-white pt-5">Login form</h3>
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form id="login-form" class="form" action="" method="post">
                            <h3 class="text-center text-info">Inicio de sesión</h3>
                            <div class="form-group">
                                <label for="username" class="text-info">Usuario:</label><br>
                                <input name="txtUsuario" id="txtUsuario" type="text" pattern="[A-Za-z9-0]" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-info">Contraseña:</label><br>
                                <input name="txtClave" id="txtClave" type="password" pattern="[A-Za-z9-0]"class="form-control">
                                <br>
                            </div>
                            <div class="form-group" >
                                <input type="submit" name="btnIngresar" value="Ingresar"class="btn btn-info btn-md">
                                <input type="submit" name="submit" class="btn btn-info btn-md" value="Registrar">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</html>