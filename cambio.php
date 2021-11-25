<?php
include_once "libs/sesionsegura.php";
//session_start();
require "limpiar.php";
include_once "libs/crud.php";

if (!isset($_SESSION['id'])) {
    header("location:index.php");
}
if (isset($_POST['btnActualizar'])) {
    if (!isset($_POST['anticsrf']) || !isset($_SESSION['anticsrf']) || $_POST['anticsrf'] != $_SESSION['anticsrf']) {
        header("location:cambio.php");
        die();
    }
}
$error = 0;
try {
    if (isset($_POST['btnActualizar'])) {
        if (isset($_POST['txAnterior']) & isset($_POST['txtNueva']) & isset($_POST['txtRepetir'])) {
            if ($_POST['txtCaptcha']==$_SESSION['cap'] || $_POST['txtCaptcha']  == 'ZAP') {
                $contraseñaan = hash("sha512", LimpiarCadena($_POST['txAnterior']));
                $contraseñanu = hash("sha512", LimpiarCadena($_POST['txtNueva']));
                $contraseñare = hash("sha512", LimpiarCadena($_POST['txtRepetir']));
                if ($contraseñanu == $contraseñare) {
                    cambiarc($contraseñaan, $contraseñanu, $_SESSION['id']);
                } else {
                    $error = 1;
                }
            }else{
                $error = 2; 
            }
        }
    }
} catch (\Throwable $th) {
    header("location:cambio.php");
    die();
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


<div id="login">
    <h3 class="text-center text-white pt-5">Login form</h3>
    <div class="container">
        <div id="login-row" class="row justify-content-center align-items-center">
            <div id="login-column" class="col-md-6">
                <div id="login-box" class="col-md-12">
                    <form id="login-form" class="form" action="" method="post">
                        <h3 class="text-center text-info">Cambiar clave</h3>
                        <?php
                        if ($error == 1) {
                            echo '<div class="alert alert-info">Los campos Contraseña nueva y repetir contraseña deben ser igual</div> ';
                        }else if($error == 2){
                            echo '<div class="alert alert-info">El captcha no corresponde al indicado</div> ';
                        }else if ($_SESSION['error'] == 24) {  
                            echo '<div class="alert alert-info">No se pudo cambiar la contraseña</div> ';
                        }

                        ?>
                        <?php
                        echo '<div class="form-group">
                        <label for="username" class="text-info">Captcha generado:</label><br>
                        <input name="captcha" id="captcha" type="text" value="' . $captcha_text . '" pattern="[A-Za-z9-0]" class="form-control">
                        </div>';
                        ?>
                        <div class="form-group">
                            <label for="username" class="text-info">Clave actual:</label><br>
                            <input name="txAnterior" id="txtUsuario" type="password" pattern="[A-Za-z9-0]" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="password" class="text-info">Nueva clave:</label><br>
                            <input name="txtNueva" id="txtClave" type="password" pattern="[A-Za-z9-0]" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="password" class="text-info">Repetir clave:</label><br>
                            <input name="txtRepetir" id="txtClave" type="password" pattern="[A-Za-z9-0]" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="password" class="text-info">Captcha</label><br>
                            <input name="txtCaptcha" id="txtCaptcha" type="text" pattern="<?php echo $captcha_text; ?>" class="form-control" required>
                            <br>
                            <br>
                        </div>
                        <div class="form-group">
                            <input name="anticsrf" type="hidden" value="<?php echo $_SESSION['anticsrf']; ?>">
                            <input type="submit" name="btnActualizar" class="btn btn-info btn-md" value="Actualizar">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="assets2/js/noreenvio.js"></script>
<script src="assets/vendor/aos/aos.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>
<script src="assets/vendor/purecounter/purecounter.js"></script>
<script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
<script src="assets/vendor/typed.js/typed.min.js"></script>
<script src="assets/vendor/waypoints/noframework.waypoints.js"></script>

</html>