<?php
include_once "libs/sesionsegura.php";
//session_start();
$img = $_SESSION['foto'];
include_once "libs/crud.php";
require "limpiar.php";
if (!isset($_SESSION['id'])) {
  header("location:index.php");
}
if (isset($_POST['btnActualizar'])) {
  if (isset($_FILES['archivo']['tmp_name'])) {
        $fileTmpPath = $_FILES['archivo']['tmp_name'];
        $fileName = $_FILES['archivo']['name'];
        $fileSize = $_FILES['archivo']['size'];
        $fileType = $_FILES['archivo']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        $newFileName = md5(time() . $fileName) . '.' . $fileExtension;

        $allowedfileExtensions = array('jpg', 'gif', 'png', 'jpeg','pdf','docx','xlsx','pptx');
        if (in_array($fileExtension, $allowedfileExtensions)) {

            // directory in which the uploaded file will be moved
            $directorio = 'archivos/';
            if (!file_exists($directorio)) {
                mkdir($directorio, 0777);
            }

            $dir = opendir($directorio);
            $ruta = $directorio . '/' . $newFileName;

            if (move_uploaded_file($fileTmpPath, $ruta)) {
                //echo "El archivo $filename se ha almacenado correctamente";
            } else {
                //echo "Ha ocurrido un error";
            }
            closedir($dir);
        }else{
            "<script>alert('El archivo no corresponde a el formato permitido');
            window.location='registro.php';
            </script>";
        }
  } else {
    echo "<script>alert('No se pudo cargar archivo');
          window.location='registro.php';
          </script>";
  }


  if (isset($_SESSION['nombre'])) {

    $Nombre1 = LimpiarCadena($_POST['txtNombre']);
    $Apellido1 = LimpiarCadena($_POST['txtApellidos']);
    $Correo1 = LimpiarCadena($_POST['txtCorreo']);
    $Direccion1 = LimpiarCadena($_POST['txtDir']);
    $Hijos1 = LimpiarCadena($_POST['txtNumHij']);
    $Estado1 = LimpiarCadena($_POST['txtEstCivil']);
    $Foto1 = $newFileName;
    cambiard($Nombre1, $Apellido1, $Correo1, $Direccion1, $Hijos1, $Estado1, $Foto1);
  } else {
    header('location: principal.php');
    exit();
  }
}
if (isset($_POST['btnEnviar'])) {
  if (isset($_FILES['archivo']['tmp_name'])) {
        $fileTmpPath = $_FILES['archivo']['tmp_name'];
        $fileName = $_FILES['archivo']['name'];
        $fileSize = $_FILES['archivo']['size'];
        $fileType = $_FILES['archivo']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        $newFileName = md5(time() . $fileName) . '.' . $fileExtension;

        $allowedfileExtensions = array('jpg', 'gif', 'png', 'jpeg','pdf','docx','xlsx','pptx');
        if (in_array($fileExtension, $allowedfileExtensions)) {

            // directory in which the uploaded file will be moved
            $directorio = 'archivos/';
            if (!file_exists($directorio)) {
                mkdir($directorio, 0777);
            }

            $dir = opendir($directorio);
            $ruta = $directorio . '/' . $newFileName;

            if (move_uploaded_file($fileTmpPath, $ruta)) {
                //echo "El archivo $filename se ha almacenado correctamente";
            } else {
                //echo "Ha ocurrido un error";
            }
            closedir($dir);
        }else{
            "<script>alert('El archivo no corresponde a el formato permitido');
            window.location='registro.php';
            </script>";
        }
  } else {
    echo "<script>alert('No se pudo cargar archivo');
          window.location='registro.php';
          </script>";
  }


  if (isset($_SESSION['nombre'])) {

    $ido = $_SESSION['id'];
    $iddes = (int)LimpiarCadena($_POST['cmbDestino']);
    $mensaje = LimpiarCadena($_POST['txtMensaje']);

    $Foto1 = $newFileName;
    enviarmensaje($ido, $iddes, $mensaje, $Foto1);
  } else {
    header('location: principal.php');
    exit();
  }
}
if (isset($_POST['btnCrear'])) {
  if (isset($_POST['chkPublico'])) {
    $idt = LimpiarCadena($_POST['txtMensaje']);
    $idu = $_SESSION['id'];
    tuit($idu, $idt, 'Sí');
  } else {
    $idt = LimpiarCadena($_POST['txtMensaje']);
    $idu = $_SESSION['id'];
    tuit($idu, $idt, 'No');
  }
}
if (isset($_POST['btnBorrar_1'])) {
  $idt = $_POST['btnBorrar_1'];
  $idu = $_SESSION['id'];
  eliminar($idt, $idu);
}
if (isset($_POST['btnPublicar_1'])) {
  $idt = $_POST['btnPublicar_1'];
  $idu = $_SESSION['id'];
  publicar($idt, $idu);
}
if (isset($_POST['btnDespublicar_1'])) {
  $idt = $_POST['btnDespublicar_1'];
  $idu = $_SESSION['id'];
  despublicar($idt, $idu);
}
$resultado = mostrar();
$resultado2 = mostrarid($_SESSION['id']);
$usu = mostrarusu();
$mensa = mostrarmensajes($_SESSION['id']);
$mensajem = mostrarmensajesen($_SESSION['id']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Mensajes</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: iPortfolio - v3.5.0
  * Template URL: https://bootstrapmade.com/iportfolio-bootstrap-portfolio-websites-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Mobile nav toggle button ======= -->
  <i class="bi bi-list mobile-nav-toggle d-xl-none"></i>

  <!-- ======= Header ======= -->
  <header id="header">
    <div class="d-flex flex-column">

      <div class="profile">
        <?php echo "<img src='archivos/$img'" . '</div><br>'; ?>
        <h1 class="text-light"><a href="index.html"><?php echo $_SESSION['nombre'] . " " . $_SESSION['apellidos']; ?></a></h1>
      </div>

      <nav id="navbar" class="nav-menu navbar">
        <ul>
          <li><a name="lnkHome" id="lnkHome" href="#hero" class="nav-link scrollto active"><i class="bx bx-home"></i> <span>Home</span></a></li>
          <li><a name="lnkArticulos" id="lnkArticulos" href="#about" class="nav-link scrollto"><i class="bx bx-file-blank"></i> <span>Artículos</span></a></li>
          <li><a name="lnkMensajes" id="lnkMensajes" href="#resume" class="nav-link scrollto"><i class="bx bx-envelope"></i> <span>Ver Mensajes</span></a></li>
          <li><a name="lnkPerfil" id="lnkPerfil" href="#contact" class="nav-link scrollto"><i class="bx bx-user"></i> <span>Mi Pérfil</span></a></li>
          <li><a name="lnkSalir" id="lnkSalir" href="cerrar.php" class="nav-link scrollto"><i class="bi bi-power"></i> <span>Salir</span></a></li>
        </ul>
      </nav><!-- .nav-menu -->
    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex flex-column justify-content-center align-items-center">
    <div class="hero-container" data-aos="fade-in">
      <h1> </h1>
      <p> Hola de nuevo <span class="typed" data-typed-items=" <?php echo $_SESSION['nombre'] . " " . $_SESSION['apellidos']; ?>"></span></p>
    </div>
  </section>
  <!--End Hero -->
  <main id="main">
    <!-- ======= Artículos Section ======= -->
    <section id="about" class="about">
      <div class="section-title">
        <h2>Artículos</h2>
      </div>
      <div class="mx-auto"></div>
      <div class="clearfix"></div>
      <div class="content-wrapper">
        <div class="container-fluid">
          <div class="card">
            <div class="card-body">
              <ul class="nav nav-tabs nav-tabs-primary top-icon nav-justified">
                <li class="nav-item">
                  <a href="javascript:void();" name="lnkArticulos" data-target="#tarticulos" data-toggle="pill" class="nav-link active"><i class="zmdi zmdi-male-female"></i> <span class="hidden-xs">Todos los artículos</span></a>
                </li>
                <li class="nav-item">
                  <a href="javascript:void();" name="lnkMisArticulos" data-target="#misarticulos" data-toggle="pill" class="nav-link"><i class="zmdi zmdi-account-calendar"></i> <span class="hidden-xs">Mis artículo</span></a>
                </li>
                <li class="nav-item">
                  <a href="javascript:void();" name="lnkCrearArticulos" data-target="#creararticulo" data-toggle="pill" class="nav-link"><i class="zmdi zmdi-mood-bad"></i> <span class="hidden-xs">Crear artículo</span></a>
                </li>
              </ul>
              <div class="center">
                <div class="tab-content p-3">
                  <div class="tab-pane active" id="tarticulos">
                    <div class="row">
                      <div class="col-md-12">
                        <h5 class="mt-2 mb-3"><span class="fa fa-clock-o ion-clock float-right"></span></h5>
                        <div class="table-responsive">
                          <table class="table table-hover table-striped">
                            <tbody>
                              <?php while ($fila = $resultado->fetch_assoc()) { ?>
                                <tr>
                                  <td>
                                    <div class="media">
                                      <?php $FOTO = $fila['FOTO']; ?>
                                      <div class="profile">
                                        <h1 name="lblAutor_1" class="text-light"><a class="font-weight-bold"><?php echo $fila['NOMBRE'] . " " . $fila['APELLIDO']; ?></a></h1>
                                        <?php echo "<img name='imgFotoAutor_1' width='100' height='100' src='archivos/$FOTO'" . '</div><br>'; ?>
                                      </div>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="media">
                                      <div class="media-body">
                                        <h6 name="lblTexto_1" class="mt-3 user-title"><?php echo $fila['TUIT']; ?></h6>
                                      </div>
                                      <div class="media-body">
                                        <h6 name="lblFecha_1" class="mt-3 user-title"><?php echo $fila['FECHA']; ?></h6>
                                      </div>
                                    </div>
                                  </td>
                                </tr>
                              <?php } ?>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane" id="misarticulos">
                    <div class="row">
                      <div class="col-md-12">
                        <h5 class="mt-2 mb-3"><span class="fa fa-clock-o ion-clock float-right"></span></h5>
                        <div class="table-responsive">
                          <table class="table table-hover table-striped">
                            <tbody>
                              <?php $resultado2 = mostrarid($_SESSION['id']);
                              while ($fila2 = $resultado2->fetch_assoc()) { ?>
                                <tr>
                                  <td>
                                    <div class="media">
                                      <?php $FOTO = $fila2['FOTO']; ?>
                                      <div class="profile">
                                        <h1 name="lblAutor_1" class="text-light"><a class="font-weight-bold">Artículo:</a></h1>
                                        <h1 name="lblAutor_1"><a class="lead">Es público: <?php echo $fila2['PUBLICO']; ?> </a></h1>
                                      </div>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="media">
                                      <div class="media-body">
                                        <h6 name="lblTexto_1" class="mt-3 user-title"><?php echo $fila2['TUIT']; ?></h6>
                                      </div>
                                      <div class="media-body">
                                        <h6 name="lblFecha_1" class="mt-3 user-title"><?php echo $fila2['FECHA']; ?></h6>
                                      </div>
                                    </div>
                                <tr>
                                  <td colspan="3" style="text-align:center;">
                                    <form class="form" action="<?php $_SERVER["PHP_SELF"]; ?>" method="post">
                                      <div class="form-group">
                                        <button type="submit" name="btnPublicar_1" value="<?php echo $fila2['ID_TUIT']; ?>" class="btn btn-outline-primary">Publicar</button>
                                        <button type="submit" name="btnDespublicar_1" value="<?php echo $fila2['ID_TUIT']; ?>" class="btn btn-outline-primary">Despublicar</button>
                                        <button type="submit" name="btnBorrar_1" value="<?php echo $fila2['ID_TUIT']; ?>" class="btn btn-outline-primary">Borrar</button>
                                      </div>
                                    </form>
                                  </td>
                                </tr>
                                </td>

                                </tr>
                              <?php } ?>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane" id="creararticulo">
                    <div class="row">
                      <div class="col-md-12">
                        <h5 class="mt-2 mb-3"><span class="fa fa-clock-o ion-clock float-right"></span></h5>
                        <form class="form" action="<?php $_SERVER["PHP_SELF"]; ?>" method="post">

                          <h3 class="text-center text-info">Crear Artículo</h3>
                          <div class="form-group">
                            <label for="username" class="text-info">Artículo</label><br>
                            <input name="txtMensaje" id="txtMensaje" type="text" value="" pattern="[A-Za-z9-0]" class="form-control">
                          </div>
                          <div class="form-check">
                            <label class="form-check-label">
                              Es púlico
                            </label>
                            <input name="chkPublico" class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                          </div>
                          <div class="form-group">
                            <br>
                            <input type="submit" name="btnCrear" value="Crear" class="btn btn-info btn-md">
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  <div class="overlay toggle-menu"></div>
                </div>
              </div>
              <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
              <footer class="footer">
                <div class="container">
                  <div class="text-center">
                  </div>
                </div>
              </footer>
            </div>
          </div>
        </div>
      </div>
    </section><!-- End Artículo Section -->
    <!-- ======= Message Section ======= -->
    <section id="resume" class="resume">
      <div class="container">

        <div class="section-title">
          <h2>Mensajes</h2>
        </div>
        <div class="mx-auto"></div>
        <div class="clearfix"></div>
        <div class="content-wrapper">
          <div class="container-fluid">
            <div class="card">
              <div class="card-body">
                <ul class="nav nav-tabs nav-tabs-primary top-icon nav-justified">
                  <li class="nav-item">
                    <a href="javascript:void();" name="lnkArticulos" data-target="#Mensajer" data-toggle="pill" class="nav-link active"><i class="zmdi zmdi-male-female"></i> <span class="hidden-xs">Mensajes recibidos</span></a>
                  </li>
                  <li class="nav-item">
                    <a href="javascript:void();" name="lnkMisArticulos" data-target="#Mensajese" data-toggle="pill" class="nav-link"><i class="zmdi zmdi-account-calendar"></i> <span class="hidden-xs">Mensajes enviados</span></a>
                  </li>
                  <li class="nav-item">
                    <a href="javascript:void();" name="lnkCrearArticulos" data-target="#Crearm" data-toggle="pill" class="nav-link"><i class="zmdi zmdi-mood-bad"></i> <span class="hidden-xs">Crear mensaje</span></a>
                  </li>
                </ul>
                <div class="center">
                  <div class="tab-content p-3">
                    <div class="tab-pane active" id="Mensajer">
                      <div class="row">
                        <div class="col-md-12">
                          <h5 class="mt-2 mb-3"><span class="fa fa-clock-o ion-clock float-right"></span></h5>
                          <div class="table-responsive">
                            <table class="table table-hover table-striped">
                              <tbody>
                                <?php while ($filaM = $mensa->fetch_assoc()) { ?>
                                  <tr>
                                    <td>
                                      <div class="media">
                                        <?php $FOTOA = $filaM['FOTO'];
                                              $FOTOB =$filaM['ARCHIVO'];
                                        ?>
                                        <div class="profile">
                                          <h1 name="lblAutor_1" class="text-light"><a class="font-weight-bold"><?php echo $filaM['ORIGEN']; ?></a></h1>
                                          <?php echo "<img name='imgFotoAutor_1' width='100' height='100' src='archivos/$FOTOA'" . '</div><br>'; ?>
                                        </div>
                                      </div>
                                    </td>
                                    <td>
                                      <div class="media">
                                        <div class="media-body">
                                          <h6 name="lblTexto_1" class="mt-3 user-title"><?php echo $filaM['MENSAJE']; ?></h6>
                                        </div>
                                        <div class="media-body">
                                          <h6 name="lblFecha_1" class="mt-3 user-title"><?php echo $filaM['FECHA']; ?></h6>
                                        </div>
                                      </div>
                                  <tr>
                                    <td colspan="3" style="text-align:center;">
                                      <?php echo "<a href='archivos/$FOTOB' download>$FOTOB</a>"; ?>
                                    </td>
                                  </tr>
                                  </td>
                                  </tr>
                                <?php } ?>
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane" id="Mensajese">
                      <div class="row">
                        <div class="col-md-12">
                          <h5 class="mt-2 mb-3"><span class="fa fa-clock-o ion-clock float-right"></span></h5>
                          <div class="table-responsive">
                            <table class="table table-hover table-striped">
                              <tbody>
                                <?php while ($filamio = $mensajem->fetch_assoc()) { ?>
                                  <tr>
                                    <td>
                                      <div class="media">
                                        <?php $FOTO3 = $filamio['FOTO']; 
                                              $FOTO3B = $filamio['ARCHIVO']
                                        ?>
                                        <div class="profile">
                                          <h1 name="lblAutor_1" class="text-light"><a class="font-weight-bold"><?php echo $filamio['DESTINO']; ?></a></h1>
                                          <?php echo "<img name='imgFotoAutor_1' width='100' height='100' src='archivos/$FOTO3'" . '</div><br>'; ?>
                                        </div>
                                      </div>
                                    </td>
                                    <td>
                                      <div class="media">
                                        <div class="media-body">
                                          <h6 name="lblTexto_1" class="mt-3 user-title"><?php echo $filamio['MENSAJE']; ?></h6>
                                        </div>
                                        <div class="media-body">
                                          <h6 name="lblFecha_1" class="mt-3 user-title"><?php echo $filamio['FECHA']; ?></h6>
                                        </div>
                                      </div>
                                  <tr>
                                    <td colspan="3" style="text-align:center;">
                                      <?php echo "<a href='archivos/$FOTO3B' download>$FOTO3B</a>"; ?>
                                    </td>
                                  </tr>
                                  </td>
                                  </tr>
                                <?php } ?>
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane" id="Crearm">
                      <div class="row">
                        <div class="col-md-12">
                          <h5 class="mt-2 mb-3"><span class="fa fa-clock-o ion-clock float-right"></span></h5>
                          <label for="username" class="text-info">Destinatario</label><br>
                          <form class="form" enctype="multipart/form-data" action="<?php $_SERVER["PHP_SELF"]; ?>" method="post">

                            <select name="cmbDestino" class="form-select" aria-label="Default select example">
                              <option selected>Elegir destinatario</option>
                              <?php
                              while ($fila3 = $usu->fetch_assoc()) {
                                echo "<option value='" . $fila3['ID_USUARIO'] . "'>" . $fila3['NOMBRE'] . " " . $fila3['APELLIDO'] . "</option>";
                              }
                              ?>
                            </select>
                            <div class="form-group">
                              <label for="username" class="text-info">Mensaje</label><br>
                              <input name="txtMensaje" id="txtMensaje" type="text" value="" pattern="[A-Za-z9-0]" class="form-control"><br>
                              <input type="file" name="archivo" id="archivo[]" multiple="" class="btn btn-info btn-md">
                            </div>
                            <div class="form-group">
                              <br>
                              <input type="submit" name="btnEnviar" value="Enviar" class="btn btn-info btn-md">
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                    <div class="overlay toggle-menu"></div>
                  </div>
                </div>
                <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
                <footer class="footer">
                  <div class="container">
                    <div class="text-center">
                    </div>
                  </div>
                </footer>
              </div>
            </div>
          </div>
        </div>
    </section><!-- End message Section -->

    <!-- ======= Contact Section ======= -->

    <section id="contact" class="contact">
      <div class="container">

        <div class="section-title">
          <h2>Mi Pérfil</h2>
        </div>
        <div class="mx-auto" style="width: 500px;">
          <div class="card" style="width: 30rem;">
            <img class="card-img-top" src="<?php echo "archivos/$img"; ?>" alt="Card image cap">
            <div class="card-body">
              <form class="form" action="" method="post" enctype="multipart/form-data">
                <h3 class="text-center text-info">Mis Datos</h3>
                <div class="form-group">
                  <label for="username" class="text-info">Nombres:</label><br>
                  <input name="txtNombre" id="txtNombre" type="text" value="<?php echo $_SESSION['nombre']; ?>" pattern="[A-Za-z9-0]" class="form-control">
                </div>
                <div class="form-group">
                  <label for="password" class="text-info">Apellidos:</label><br>
                  <input name="txtApellidos" id="txtApellidos" type="text" value="<?php echo $_SESSION['apellidos']; ?>" pattern="[A-Za-z9-0]" class="form-control">
                </div>
                <div class="form-group">
                  <label for="password" class="text-info">Correo:</label><br>
                  <input name="txtCorreo" id="txtCorreo" type="text" value="<?php echo $_SESSION['correo']; ?>" pattern="[A-Za-z9-0]" class="form-control">
                </div>
                <div class="form-group">
                  <label for="password" class="text-info">Dirección:</label><br>
                  <input name="txtDir" id="txtDir" type="text" value="<?php echo $_SESSION['direccion']; ?>" pattern="[A-Za-z9-0]" class="form-control">
                </div>
                <div class="form-group">
                  <label for="password" class="text-info">Numero de Hijos:</label><br>
                  <input name="txtNumHij" id="txtNumHij" type="text" value="<?php echo $_SESSION['hijos']; ?>" pattern="[A-Za-z9-0]" class="form-control">
                </div>
                <div class="form-group">
                  <label for="password" class="text-info">Estado Civil:</label><br>
                  <input name="txtEstCivil" id="txtEstCivil" type="text" value="<?php echo $_SESSION['estado']; ?>" pattern="[A-Za-z9-0]" class="form-control">
                </div>
                <div class="form-group">
                  <label for="password" class="text-info">Foto de Pérfil:</label><br>
                  <input type="file" value="<?php echo $_SESSION['foto']; ?>" name="archivo" id="archivo[]" multiple="" class="btn btn-info btn-md">
                  <br>
                  <br>
                </div>
                <div class="form-group">
                  <input type="submit" name="btnActualizar" value="Actualizar" class="btn btn-info btn-md">
                  <input type="submit" name="btnCambio" value="Cambiar Clave" class="btn btn-info btn-md">
                </div>
              </form>
            </div>
          </div>
        </div>

      </div>

    </section><!-- End Contact Section -->

  </main><!-- End #main -->


  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/purecounter/purecounter.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/typed.js/typed.min.js"></script>
  <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>

  <!-- Template Main JS File -->
  <script src="assets2/js/noreenvio.js"></script>
  <script src="assets/js/main.js"></script>
  <script src="assets2/js/jquery.min.js"></script>
  <script src="assets2/js/popper.min.js"></script>
  <script src="assets2/js/bootstrap.min.js"></script>
  <script src="assets2/plugins/simplebar/js/simplebar.js"></script>
  <script src="assets2/js/sidebar-menu.js"></script>
  <script src="assets2/js/app-script.js"></script>
</body>

</html>