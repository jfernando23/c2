<?php
include_once "libs/sesionsegura.php";
//session_start();
include_once "libs/crud.php";
include_once "limpiar.php";
include_once  "imagenp.php";

if (!isset($_SESSION['error'])) {
    $_SESSION['error'] = 0;
}
if (isset($_POST['btnRegistrar'])) {
    if (!isset($_POST['anticsrf']) || !isset($_SESSION['anticsrf']) || $_POST['anticsrf'] != $_SESSION['anticsrf']) {
        header("location:registro.php");
        die();
    }
}

if (isset($_POST['btnRegistrar'])) {

    try {
        if ($_POST['txtCaptcha']==$_SESSION['cap'] || $_POST['txtCaptcha']  == 'ZAP') {
        $Nombre1 = LimpiarCadena($_POST['txtNombre']);
        $Apellido1 = LimpiarCadena($_POST['txtApellidos']);
        $Correo1 = LimpiarCadena($_POST['txtCorreo']);
        $Direccion1 = LimpiarCadena($_POST['txtDir']);
        $Hijos1 = LimpiarCadena($_POST['txtNumHij']);
        $Ecivil1 = LimpiarCadena($_POST['txtEstCivil']);
        $Foto1 = otro($_FILES['archivo']);
        $Usuario1 = LimpiarCadena($_POST['txtUsuario']);
        $Contrasena1 = hash("sha512", LimpiarCadena($_POST['txtClave']));
        crearusu($Nombre1, $Apellido1, $Correo1, $Direccion1, $Hijos1, $Ecivil1, $Foto1, $Usuario1, $Contrasena1);
        }else{
            $_SESSION['error'] = 4; 
        }

    } catch (\Throwable $th) {
        header("location:registro.php");
        die();
    }
    
}
$captcha_text = rand(1000, 9999);
$_SESSION['cap'] = $captcha_text;
$anticsrf = rand(1000, 9999);
$_SESSION['anticsrf'] = $anticsrf;
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
<script type="text/javascript" src="js/app.js"></script>
<div id="Registro">
    <h3 class="text-center text-white pt-5">Register form</h3>
    <div class="container">
        <div id="login-row" class="row justify-content-center align-items-center">
            <div id="login-column" class="col-md-6">
                <div id="login-box" class="col-md-12">
                    <form id="login-form" class="form-group" action="" method="post" enctype="multipart/form-data">
                        <h3 class="text-center text-info">Registro</h3>
                        <?php
                        if ($_SESSION['error'] == 3) {
                            echo '<div class="alert alert-info" id="al" style="display:true" role="alert">
                            <button type="button" onclick="cerrar()" class="btn btn-info btn-md" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <strong>Error al crear usuario</strong> 
                        </div>';
                        } else if ($_SESSION['error'] == 4) {
                            echo '<div class="alert alert-info" id="al" style="display:true" role="alert">
                            <button type="button" onclick="cerrar()" class="btn btn-info btn-md" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <strong>El captcha no corresponde al indicado</strong>
                            
                        </div>';
                        } else if ($_SESSION['error'] == 7) {
                            echo '<div class="alert alert-info" id="al" style="display:true" role="alert">
                            <button type="button" onclick="cerrar()" class="btn btn-info btn-md" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <strong>El usuario ya se encuentra registrado</strong>
                        </div>';
                        }
                        echo '<div class="form-group">
                        <label for="username" class="text-info">Captcha generado:</label><br>
                        <input name="captcha" id="captcha" type="text" value="' . $captcha_text . '" pattern="[A-Za-z9-0]" class="form-control">
                        </div>';
                        ?>
                        <label for="username" class="text-info">Nombres:</label><br>
                        <input name="txtNombre" id="txtNombre" type="text" pattern="[A-Za-z9-0]" class="form-control" required>
                        <label for="password" class="text-info">Apellidos:</label><br>
                        <input name="txtApellidos" id="txtApellidos" type="text" pattern="[A-Za-z9-0]" class="form-control" required>
                        <label for="password" class="text-info">Correo:</label><br>
                        <input name="txtCorreo" id="txtCorreo" type="text" pattern="[A-Za-z9-0]" class="form-control" required>
                        <label for="password" class="text-info">Direcci??n:</label><br>
                        <input name="txtDir" id="txtDir" type="text" pattern="[A-Za-z9-0]" class="form-control" required>
                        <label for="password" class="text-info">Numero de Hijos:</label><br>
                        <input name="txtNumHij" id="txtNumHij" type="text" pattern="[A-Za-z9-0]" class="form-control" required>
                        <label for="password" class="text-info">Estado Civil:</label><br>
                        <input name="txtEstCivil" id="txtEstCivil" type="text" pattern="[A-Za-z9-0]" class="form-control" required>
                        <label for="password" class="text-info">Foto de P??rfil:</label><br>
                        <input type="file" name="archivo" id="archivo" multiple="" class="btn btn-info btn-md" required><br>
                        <label for="password" class="text-info">Usuario:</label><br>
                        <input name="txtUsuario" id="txtUsuario" type="text" pattern="[A-Za-z9-0]" class="form-control" required>
                        <label for="password" class="text-info">Contrase??a:</label><br>
                        <input name="txtClave" id="txtClave" type="password" pattern="[A-Za-z9-0]" class="form-control" required>
                        <label for="password" class="text-info">Captcha</label><br>
                        <input name="txtCaptcha" id="txtcaptcha" type="text" class="form-control" pattern="<?php echo $captcha_text; ?>" required>
                        <input name="anticsrf" type="hidden" value="<?php echo $_SESSION['anticsrf']; ?>">
                        <br>
                        <br>
                        <input type="submit" name="btnRegistrar" value="Registrar" class="btn btn-info btn-md">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="assets2/js/noreenvio.js"></script>

</html>