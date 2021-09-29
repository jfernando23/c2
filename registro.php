<?php
    session_start(); 
    include_once "libs/crud.php";
    require "limpiar.php";
    

    if (isset($_SESSION['usuarios']) == FALSE){
        $_SESSION['usuarios'] = [];
    }

    if (isset($_POST['btnRegistrar'])){
        if (isset($_FILES['archivo'] ['tmp_name'])) {
            foreach ($_FILES['archivo'] ['tmp_name']as $key => $value) {
    
                if ($_FILES['archivo'] ['name'] [$key]){
            
                    $filename = $_FILES['archivo'] ['name'] [$key];
                    $temporal = $_FILES['archivo'] ['tmp_name'] [$key];
            
                    $directorio = "archivos/";
            
                    if (!file_exists($directorio)) {
                        mkdir($directorio, 0777);
                    }
            
                    $dir = opendir($directorio);
                    $ruta = $directorio.'/'.$filename;
                    closedir($dir);
                } 
            }
        }else{
            echo "<script>alert('No se pudo cargar archivo');
            window.location='registro.php';
            </script>";
        }
        
        $Nombre1 = LimpiarCadena($_POST ['txtNombre']);
        $Apellido1 = LimpiarCadena($_POST ['txtApellidos']);
        $Correo1 = LimpiarCadena($_POST ['txtCorreo']);
        $Direccion1 = LimpiarCadena($_POST ['txtDir']);
        $Hijos1 = LimpiarCadena($_POST ['txtNumHij']);
        $Ecivil1 = LimpiarCadena($_POST ['txtEstCivil']);
        $Foto1 = $filename;
        $Usuario1 = LimpiarCadena($_POST ['txtUsuario']);
        $Contrasena1 = hash("sha512",LimpiarCadena($_POST ['txtClave']));
        crearusu($Nombre1,$Apellido1,$Correo1,$Direccion1,$Hijos1,$Ecivil1,$Foto1,$Usuario1,$Contrasena1);
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


<div id="Registro">
        <h3 class="text-center text-white pt-5">Register form</h3>
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form id="login-form" class="form" action="" method="post" enctype="multipart/form-data">
                            <h3 class="text-center text-info">Registro</h3>
                            <div class="form-group">
                                <label for="username" class="text-info">Nombres:</label><br>
                                <input name="txtNombre" id="txtNombre" type="text" pattern="[A-Za-z9-0]" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-info">Apellidos:</label><br>
                                <input name="txtApellidos" id="txtApellidos" type="text" pattern="[A-Za-z9-0]"class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-info">Correo:</label><br>
                                <input name="txtCorreo" id="txtCorreo" type="text" pattern="[A-Za-z9-0]"class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-info">Dirección:</label><br>
                                <input name="txtDir" id="txtDir" type="text" pattern="[A-Za-z9-0]"class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-info">Numero de Hijos:</label><br>
                                <input name="txtNumHij" id="txtNumHij" type="text" pattern="[A-Za-z9-0]"class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-info">Estado Civil:</label><br>
                                <input name="txtEstCivil" id="txtEstCivil" type="text" pattern="[A-Za-z9-0]"class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-info">Usuario:</label><br>
                                <input name="txtUsuario" id="txtUsuario" type="text" pattern="[A-Za-z9-0]"class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-info">Contraseña:</label><br>
                                <input name="txtClave" id="txtClave" type="password" pattern="[A-Za-z9-0]"class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-info">Foto de Pérfil:</label><br>
                                <input type="file" name="archivo[]" id="archivo[]" multiple=""class="btn btn-info btn-md">
                                <br>
                                <br>
                            </div>
                            <div class="form-group" >
                                <input type="submit" name="btnRegistrar" value="Registrar" class="btn btn-info btn-md">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</html>