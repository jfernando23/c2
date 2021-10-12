<?php
session_start();
$img = $_SESSION['foto'];
include_once "libs/crud.php";
require "limpiar.php";
if (isset($_POST['btnActualizar'])) {
  if (isset($_FILES['archivo']['tmp_name'])) {
    foreach ($_FILES['archivo']['tmp_name'] as $key => $value) {

      if ($_FILES['archivo']['name'][$key]) {

        $filename = $_FILES['archivo']['name'][$key];
        $temporal = $_FILES['archivo']['tmp_name'][$key];

        $directorio = "archivos/";

        if (!file_exists($directorio)) {
          mkdir($directorio, 0777);
        }

        $dir = opendir($directorio);
        $ruta = $directorio . '/' . $filename;

        if (move_uploaded_file($temporal, $ruta)) {
          //echo "El archivo $filename se ha almacenado correctamente";
        } else {
          //echo "Ha ocurrido un error";
        }
        closedir($dir);
      }
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
    $Foto1 = $filename;
    cambiard($Nombre1, $Apellido1, $Correo1, $Direccion1, $Hijos1, $Estado1, $Foto1);
  } else {
    header('location: principal.php');
    exit();
  }
}
$resultado = mostrar();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>iPortfolio Bootstrap Template - Index</title>
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
          <li><a name="lnkArticulos" id="lnkArticulos" href="#about" class="nav-link scrollto"><i class="bx bx-user"></i> <span>Artículos</span></a></li>
          <li><a name="lnkMensajes" id="lnkMensajes" href="#resume" class="nav-link scrollto"><i class="bx bx-file-blank"></i> <span>Ver Mensajes</span></a></li>
          <li><a name="lnkPerfil" id="lnkPerfil" href="#contact" class="nav-link scrollto"><i class="bx bx-envelope"></i> <span>Mi Pérfil</span></a></li>
        </ul>
      </nav><!-- .nav-menu -->
    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex flex-column justify-content-center align-items-center">
    <div class="hero-container" data-aos="fade-in">
      <h1><?php echo $_SESSION['nombre'] . " " . $_SESSION['apellidos']; ?></h1>
      <p>Yo estoy <span class="typed" data-typed-items=<?php echo $_SESSION['estado']; ?>></span></p>
    </div>
  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= About Section ======= -->
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
                  <a href="javascript:void();" name="lnkArticulos" data-target="#profile" data-toggle="pill" class="nav-link active"><i class="zmdi zmdi-male-female"></i> <span class="hidden-xs">Todos los artículos</span></a>
                </li>
                <li class="nav-item">
                  <a href="javascript:void();" name="lnkMisArticulos" data-target="#messages" data-toggle="pill" class="nav-link"><i class="zmdi zmdi-account-calendar"></i> <span class="hidden-xs">Mi artículo</span></a>
                </li>
                <li class="nav-item">
                  <a href="javascript:void();" name="lnkCrearArticulos" data-target="#edit" data-toggle="pill" class="nav-link"><i class="zmdi zmdi-mood-bad"></i> <span class="hidden-xs">Crear artículo</span></a>
                </li>
              </ul>
              <div class="center">
                <div class="tab-content p-3">
                  <div class="tab-pane active" id="profile">
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
                                        <h1 class="text-light"><a name="lblAutor_1" ><?php echo $fila['NOMBRE']; ?></a></h1>
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
                                <?php } ?>
                                </tr>

                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane" id="messages">
                    <div class="row">
                      <div class="col-md-12">
                        <h5 class="mt-2 mb-3"><span class="fa fa-clock-o ion-clock float-right"></span></h5>
                        <div class="table-responsive">
                          <table class="table table-hover table-striped">
                            <tbody>
                              <tr>
                                <td>
                                  <div class="media">
                                    <div class="avatar"><img class="align-self-start mr-3" width="60" height="60" src="assets/images/img/o1.png" alt="user avatar"></div>
                                    <div class="media-body">
                                      <h6 class="mt-3 user-title">Organízate, tener al día los materiales de estudio y llevar una agenda ayuda bastante a tener más organizados tus horarios y entregas.</h6>
                                    </div>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>
                                  <div class="media">
                                    <div class="avatar"><img class="align-self-start mr-3" width="60" height="60" src="assets/images/img/o2.png" alt="user avatar"></div>
                                    <div class="media-body">
                                      <h6 class="mt-3 user-title">Clasificar las materias de acuerdo con el nivel de dificultad también de acuerdo con fechas pautadas para entregas y pruebas.</h6>
                                    </div>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>
                                  <div class="media">
                                    <div class="avatar"><img class="align-self-start mr-3" width="60" height="60" src="assets/images/img/o3.png" alt="user avatar"></div>
                                    <div class="media-body">
                                      <h6 class="mt-3 user-title">Estudia gradualmente para llegar más preparado a una prueba.</h6>
                                    </div>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>
                                  <div class="media">
                                    <div class="avatar"><img class="align-self-start mr-3" width="60" height="60" src="assets/images/img/o4.png" alt="user avatar"></div>
                                    <div class="media-body">
                                      <h6 class="mt-3 user-title">Prueba con distintos métodos de estudio.</h6>
                                    </div>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>
                                  <div class="media">
                                    <div class="avatar"><img class="align-self-start mr-3" width="60" height="60" src="assets/images/img/o5.png" alt="user avatar"></div>
                                    <div class="media-body">
                                      <h6 class="mt-3 user-title">Elimina las distracciones: Internet, celular, televisión, radio.</h6>
                                    </div>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>
                                  <div class="media">
                                    <div class="avatar"><img class="align-self-start mr-3" width="60" height="60" src="assets/images/img/06.png" alt="user avatar"></div>
                                    <div class="media-body">
                                      <h6 class="mt-3 user-title">Tener un calendario permite hacerse una idea de cuánto tiempo queda antes de enfrentarse a una prueba o entrega de un trabajo.</h6>
                                    </div>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>
                                  <div class="media">
                                    <div class="avatar"><img class="align-self-start mr-3" width="60" height="60" src="assets/images/img/o7.png" alt="user avatar"></div>
                                    <div class="media-body">
                                      <h6 class="mt-3 user-title">Crear una rutina de estudio, es muy importante establecer una rutina de estudio, preferiblemente diaria. Cada uno tiene su propio ritmo, <br>hay personas más productivas por la mañana mientras que otras lo son hacia la tarde o noche.</h6>
                                    </div>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>
                                  <div class="media">
                                    <div class="avatar"><img class="align-self-start mr-3" width="60" height="60" src="assets/images/img/o8.png" alt="user avatar"></div>
                                    <div class="media-body">
                                      <h6 class="mt-3 user-title">Priorizar objetivos y evitar la multitarea, hay tareas que deben ser cumplidas antes que otras, y por ello se les debe dar mayor prioridad.</h6>
                                    </div>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>
                                  <div class="media">
                                    <div class="avatar"><img class="align-self-start mr-3" width="60" height="60" src="assets/images/img/o9.png" alt="user avatar"></div>
                                    <div class="media-body">
                                      <h6 class="mt-3 user-title">Planificar pausas activas, estudiar está bien, pero hacerlo de forma constante lleva al inevitable agotamiento. Todo el mundo necesita <br>
                                        descansar divirtiéndose.</h6>
                                    </div>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>
                                  <div class="media">
                                    <div class="avatar"><img class="align-self-start mr-3" width="60" height="60" src="assets/images/img/o10.png" alt="user avatar"></div>
                                    <div class="media-body">
                                      <h6 class="mt-3 user-title">La actitud con la que se afronta el estudio es algo fundamental si se quiere tener éxito.</h6>
                                    </div>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>
                                  <div class="media">
                                    <div class="avatar"><img class="align-self-start mr-3" width="60" height="60" src="assets/images/img/o11.png" alt="user avatar"></div>
                                    <div class="media-body">
                                      <h6 class="mt-3 user-title">La motivación a la hora de estudiar y la fuerza de voluntad son aspectos que influyen en nuestra forma de aprender.</h6>
                                    </div>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>
                                  <div class="media">
                                    <div class="avatar"><img class="align-self-start mr-3" width="60" height="60" src="assets/images/img/06.png" alt="user avatar"></div>
                                    <div class="media-body">
                                      <h6 class="mt-3 user-title">Planificar con antelación, solo se tendrá éxito si se está bien preparado, y es por ello tan importante planificar con antelación la sesión de estudio.</h6>
                                    </div>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>
                                  <div class="media">
                                    <div class="avatar"><img class="align-self-start mr-3" width="60" height="60" src="assets/images/img/o12.png" alt="user avatar"></div>
                                    <div class="media-body">
                                      <h6 class="mt-3 user-title">Ir de materias más complejas a las más simples, lo mejor que se puede hacer es dejar lo difícil para el inicio del día.</h6>
                                    </div>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>
                                  <div class="media">
                                    <div class="avatar"><img class="align-self-start mr-3" width="60" height="60" src="assets/images/img/o13.png" alt="user avatar"></div>
                                    <div class="media-body">
                                      <h6 class="mt-3 user-title">Asegurarse de tener el móvil en silencio o, mejor, apagado, para evitar interrupciones.</h6>
                                    </div>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>
                                  <div class="media">
                                    <div class="avatar"><img class="align-self-start mr-3" width="60" height="60" src="assets/images/img/o14.png" alt="user avatar"></div>
                                    <div class="media-body">
                                      <h6 class="mt-3 user-title">Que los ratos de estudio no superen los 30 minutos, mostramos más facilidad para asimilar información que nos llega en ráfagas cortas y repetidas.</h6>
                                    </div>
                                  </div>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane" id="edit">
                    <div class="row">
                      <div class="col-md-12">
                        <h5 class="mt-2 mb-3"><span class="fa fa-clock-o ion-clock float-right"></span></h5>
                        <div class="table-responsive">
                          <table class="table table-hover table-striped">
                            <tbody>
                              <tr>
                                <td>
                                  <div class="media">
                                    <div class="avatar"><img class="align-self-start mr-3" width="60" height="60" src="assets/images/img/m.png" alt="user avatar"></div>
                                    <div class="media-body">
                                      <h6 class="mt-3 user-title">Puedes ser feliz allí donde estés - Joel Osteen</h6>
                                    </div>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>
                                  <div class="media">
                                    <div class="avatar"><img class="align-self-start mr-3" width="60" height="60" src="assets/images/img/m.png" alt="user avatar"></div>
                                    <div class="media-body">
                                      <h6 class="mt-3 user-title">Tus acciones positivas combinadas con los pensamientos positivos generan éxitos - Shiv Khera </h6>
                                    </div>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>
                                  <div class="media">
                                    <div class="avatar"><img class="align-self-start mr-3" width="60" height="60" src="assets/images/img/m.png" alt="user avatar"></div>
                                    <div class="media-body">
                                      <h6 class="mt-3 user-title">Tus acciones positivas combinadas con los pensamientos positivos generan éxitos - Shiv Khera </h6>
                                    </div>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>
                                  <div class="media">
                                    <div class="avatar"><img class="align-self-start mr-3" width="60" height="60" src="assets/images/img/m.png" alt="user avatar"></div>
                                    <div class="media-body">
                                      <h6 class="mt-3 user-title">Si puedes soñarlo, puedes hacerlo - Walt Disney</h6>
                                    </div>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>
                                  <div class="media">
                                    <div class="avatar"><img class="align-self-start mr-3" width="60" height="60" src="assets/images/img/m.png" alt="user avatar"></div>
                                    <div class="media-body">
                                      <h6 class="mt-3 user-title">El secreto para salir adelante es comenzar - Mark Twain</h6>
                                    </div>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>
                                  <div class="media">
                                    <div class="avatar"><img class="align-self-start mr-3" width="60" height="60" src="assets/images/img/m.png" alt="user avatar"></div>
                                    <div class="media-body">
                                      <h6 class="mt-3 user-title">El conocimiento es poder - Francis Bacon</h6>
                                    </div>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>
                                  <div class="media">
                                    <div class="avatar"><img class="align-self-start mr-3" width="60" height="60" src="assets/images/img/m.png" alt="user avatar"></div>
                                    <div class="media-body">
                                      <h6 class="mt-3 user-title">El 80% del éxito se basa simplemente en insistir - Woody Allen</h6>
                                    </div>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>
                                  <div class="media">
                                    <div class="avatar"><img class="align-self-start mr-3" width="60" height="60" src="assets/images/img/m.png" alt="user avatar"></div>
                                    <div class="media-body">
                                      <h6 class="mt-3 user-title">Si tienes un sueño y crees en él, corres el riesgo de que se convierta en realidad - Walt Disney</h6>
                                    </div>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>
                                  <div class="media">
                                    <div class="avatar"><img class="align-self-start mr-3" width="60" height="60" src="assets/images/img/m.png" alt="user avatar"></div>
                                    <div class="media-body">
                                      <h6 class="mt-3 user-title">Hoy eres un lector y mañana serás un líder - Margaret Fuller</h6>
                                    </div>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>
                                  <div class="media">
                                    <div class="avatar"><img class="align-self-start mr-3" width="60" height="60" src="assets/images/img/m.png" alt="user avatar"></div>
                                    <div class="media-body">
                                      <h6 class="mt-3 user-title">Los dos guerreros más poderosos son la paciencia y el tiempo - León Tolstói</h6>
                                    </div>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>
                                  <div class="media">
                                    <div class="avatar"><img class="align-self-start mr-3" width="60" height="60" src="assets/images/img/m.png" alt="user avatar"></div>
                                    <div class="media-body">
                                      <h6 class="mt-3 user-title">Apunta a la luna. Si fallas, podrías dar a una estrella - William Clement Stone</h6>
                                    </div>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>
                                  <div class="media">
                                    <div class="avatar"><img class="align-self-start mr-3" width="60" height="60" src="assets/images/img/m.png" alt="user avatar"></div>
                                    <div class="media-body">
                                      <h6 class="mt-3 user-title">La forma más rápida de cambiar es convivir con personas que ya son como quieres ser - Reid Hoffman</h6>
                                    </div>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>
                                  <div class="media">
                                    <div class="avatar"><img class="align-self-start mr-3" width="60" height="60" src="assets/images/img/m.png" alt="user avatar"></div>
                                    <div class="media-body">
                                      <h6 class="mt-3 user-title">Vive la vida que amas. Ama la vida que vives - Bob Marley</h6>
                                    </div>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>
                                  <div class="media">
                                    <div class="avatar"><img class="align-self-start mr-3" width="60" height="60" src="assets/images/img/m.png" alt="user avatar"></div>
                                    <div class="media-body">
                                      <h6 class="mt-3 user-title">El éxito no es la clave de la felicidad. La felicidad es la clave del éxito - Albert Schweitzer</h6>
                                    </div>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>
                                  <div class="media">
                                    <div class="avatar"><img class="align-self-start mr-3" width="60" height="60" src="assets/images/img/m.png" alt="user avatar"></div>
                                    <div class="media-body">
                                      <h6 class="mt-3 user-title">La grandeza nace de pequeños comienzos - Sir Francis Drake</h6>
                                    </div>
                                  </div>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane" id="Prueba">

                    <div class="container-fluid">
                      <div class="row">
                        <div class="col-md-4">
                          <div class="card">
                            <div class="card-body">
                              <div class="table-responsive">
                                <table class="table">
                                  <thead>
                                    <tr>
                                      <center>
                                        <div>
                                          <img width="300" height="300" src="assets/images/diez.jpg" alt="Imagen centrada" />
                                        </div>
                                      </center>
                                    </tr>
                                    <tr>
                                      <p></p>
                                    </tr>
                                    </tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="card">
                            <div class="card-body">
                              <div class="table-responsive">
                                <table class="table">
                                  <thead>
                                    <tr>
                                      <center>
                                        <div>
                                          <img width="300" height="300" src="assets/images/dos.jpg" alt="Imagen centrada" />
                                        </div>
                                      </center>
                                    </tr>
                                    <tr>
                                      <p></p>
                                    </tr>
                                    </tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="card">
                            <div class="card-body">
                              <div class="table-responsive">
                                <table class="table">
                                  <thead>
                                    <tr>
                                      <center>
                                        <div>
                                          <img width="300" height="300" src="assets/images/tres.jpg" alt="Imagen centrada" />
                                        </div>
                                      </center>
                                    </tr>
                                    <tr>
                                      <p></p>
                                    </tr>
                                    </tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="card">
                            <div class="card-body">
                              <div class="table-responsive">
                                <table class="table">
                                  <thead>
                                    <tr>
                                      <center>
                                        <div>
                                          <img width="300" height="300" src="assets/images/cuatro.jpg" alt="Imagen centrada" />
                                        </div>
                                      </center>
                                    </tr>
                                    <tr>
                                      <p></p>
                                    </tr>
                                    </tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="card">
                            <div class="card-body">
                              <div class="table-responsive">
                                <table class="table">
                                  <thead>
                                    <tr>
                                      <center>
                                        <div>
                                          <img width="300" height="300" src="assets/images/cinco.jpg" alt="Imagen centrada" />
                                        </div>
                                      </center>
                                    </tr>
                                    <tr>
                                      <p></p>
                                    </tr>
                                    </tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="card">
                            <div class="card-body">
                              <div class="table-responsive">
                                <table class="table">
                                  <thead>
                                    <tr>
                                      <center>
                                        <div>
                                          <img width="300" height="300" src="assets/images/seis.jpg" alt="Imagen centrada" />
                                        </div>
                                      </center>
                                    </tr>
                                    <tr>
                                      <p></p>
                                    </tr>
                                    </tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="overlay toggle-menu"></div>
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
    </section><!-- End About Section -->

    <!-- ======= Facts Section ======= -->
    <section id="facts" class="facts">
      <div class="container">

        <div class="section-title">
          <h2>Facts</h2>
          <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
        </div>

        <div class="row no-gutters">

          <div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch" data-aos="fade-up">
            <div class="count-box">
              <i class="bi bi-emoji-smile"></i>
              <span data-purecounter-start="0" data-purecounter-end="232" data-purecounter-duration="1" class="purecounter"></span>
              <p><strong>Happy Clients</strong> consequuntur quae</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch" data-aos="fade-up" data-aos-delay="100">
            <div class="count-box">
              <i class="bi bi-journal-richtext"></i>
              <span data-purecounter-start="0" data-purecounter-end="521" data-purecounter-duration="1" class="purecounter"></span>
              <p><strong>Projects</strong> adipisci atque cum quia aut</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch" data-aos="fade-up" data-aos-delay="200">
            <div class="count-box">
              <i class="bi bi-headset"></i>
              <span data-purecounter-start="0" data-purecounter-end="1453" data-purecounter-duration="1" class="purecounter"></span>
              <p><strong>Hours Of Support</strong> aut commodi quaerat</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch" data-aos="fade-up" data-aos-delay="300">
            <div class="count-box">
              <i class="bi bi-people"></i>
              <span data-purecounter-start="0" data-purecounter-end="32" data-purecounter-duration="1" class="purecounter"></span>
              <p><strong>Hard Workers</strong> rerum asperiores dolor</p>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Facts Section -->

    <!-- ======= Skills Section ======= -->
    <section id="skills" class="skills section-bg">
      <div class="container">

        <div class="section-title">
          <h2>Skills</h2>
          <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
        </div>

        <div class="row skills-content">

          <div class="col-lg-6" data-aos="fade-up">

            <div class="progress">
              <span class="skill">HTML <i class="val">100%</i></span>
              <div class="progress-bar-wrap">
                <div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>

            <div class="progress">
              <span class="skill">CSS <i class="val">90%</i></span>
              <div class="progress-bar-wrap">
                <div class="progress-bar" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>

            <div class="progress">
              <span class="skill">JavaScript <i class="val">75%</i></span>
              <div class="progress-bar-wrap">
                <div class="progress-bar" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>

          </div>

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">

            <div class="progress">
              <span class="skill">PHP <i class="val">80%</i></span>
              <div class="progress-bar-wrap">
                <div class="progress-bar" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>

            <div class="progress">
              <span class="skill">WordPress/CMS <i class="val">90%</i></span>
              <div class="progress-bar-wrap">
                <div class="progress-bar" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>

            <div class="progress">
              <span class="skill">Photoshop <i class="val">55%</i></span>
              <div class="progress-bar-wrap">
                <div class="progress-bar" role="progressbar" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>

          </div>

        </div>

      </div>
    </section><!-- End Skills Section -->

    <!-- ======= Resume Section ======= -->
    <section id="resume" class="resume">
      <div class="container">

        <div class="section-title">
          <h2>Resume</h2>
          <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
        </div>

        <div class="row">
          <div class="col-lg-6" data-aos="fade-up">
            <h3 class="resume-title">Sumary</h3>
            <div class="resume-item pb-0">
              <h4>Alex Smith</h4>
              <p><em>Innovative and deadline-driven Graphic Designer with 3+ years of experience designing and developing user-centered digital/print marketing material from initial concept to final, polished deliverable.</em></p>
              <ul>
                <li>Portland par 127,Orlando, FL</li>
                <li>(123) 456-7891</li>
                <li>alice.barkley@example.com</li>
              </ul>
            </div>

            <h3 class="resume-title">Education</h3>
            <div class="resume-item">
              <h4>Master of Fine Arts &amp; Graphic Design</h4>
              <h5>2015 - 2016</h5>
              <p><em>Rochester Institute of Technology, Rochester, NY</em></p>
              <p>Qui deserunt veniam. Et sed aliquam labore tempore sed quisquam iusto autem sit. Ea vero voluptatum qui ut dignissimos deleniti nerada porti sand markend</p>
            </div>
            <div class="resume-item">
              <h4>Bachelor of Fine Arts &amp; Graphic Design</h4>
              <h5>2010 - 2014</h5>
              <p><em>Rochester Institute of Technology, Rochester, NY</em></p>
              <p>Quia nobis sequi est occaecati aut. Repudiandae et iusto quae reiciendis et quis Eius vel ratione eius unde vitae rerum voluptates asperiores voluptatem Earum molestiae consequatur neque etlon sader mart dila</p>
            </div>
          </div>
          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
            <h3 class="resume-title">Professional Experience</h3>
            <div class="resume-item">
              <h4>Senior graphic design specialist</h4>
              <h5>2019 - Present</h5>
              <p><em>Experion, New York, NY </em></p>
              <ul>
                <li>Lead in the design, development, and implementation of the graphic, layout, and production communication materials</li>
                <li>Delegate tasks to the 7 members of the design team and provide counsel on all aspects of the project. </li>
                <li>Supervise the assessment of all graphic materials in order to ensure quality and accuracy of the design</li>
                <li>Oversee the efficient use of production project budgets ranging from $2,000 - $25,000</li>
              </ul>
            </div>
            <div class="resume-item">
              <h4>Graphic design specialist</h4>
              <h5>2017 - 2018</h5>
              <p><em>Stepping Stone Advertising, New York, NY</em></p>
              <ul>
                <li>Developed numerous marketing programs (logos, brochures,infographics, presentations, and advertisements).</li>
                <li>Managed up to 5 projects or tasks at a given time while under pressure</li>
                <li>Recommended and consulted with clients on the most appropriate graphic design</li>
                <li>Created 4+ design presentations and proposals a month for clients and account managers</li>
              </ul>
            </div>
          </div>
        </div>

      </div>
    </section><!-- End Resume Section -->

    <!-- ======= Testimonials Section ======= -->
    <section id="testimonials" class="testimonials section-bg">
      <div class="container">

        <div class="section-title">
          <h2>Testimonials</h2>
          <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
        </div>

        <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
          <div class="swiper-wrapper">

            <div class="swiper-slide">
              <div class="testimonial-item" data-aos="fade-up">
                <p>
                  <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                  Proin iaculis purus consequat sem cure digni ssim donec porttitora entum suscipit rhoncus. Accusantium quam, ultricies eget id, aliquam eget nibh et. Maecen aliquam, risus at semper.
                  <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                </p>
                <img src="assets/img/testimonials/testimonials-1.jpg" class="testimonial-img" alt="">
                <h3>Saul Goodman</h3>
                <h4>Ceo &amp; Founder</h4>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-item" data-aos="fade-up" data-aos-delay="100">
                <p>
                  <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                  Export tempor illum tamen malis malis eram quae irure esse labore quem cillum quid cillum eram malis quorum velit fore eram velit sunt aliqua noster fugiat irure amet legam anim culpa.
                  <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                </p>
                <img src="assets/img/testimonials/testimonials-2.jpg" class="testimonial-img" alt="">
                <h3>Sara Wilsson</h3>
                <h4>Designer</h4>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-item" data-aos="fade-up" data-aos-delay="200">
                <p>
                  <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                  Enim nisi quem export duis labore cillum quae magna enim sint quorum nulla quem veniam duis minim tempor labore quem eram duis noster aute amet eram fore quis sint minim.
                  <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                </p>
                <img src="assets/img/testimonials/testimonials-3.jpg" class="testimonial-img" alt="">
                <h3>Jena Karlis</h3>
                <h4>Store Owner</h4>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-item" data-aos="fade-up" data-aos-delay="300">
                <p>
                  <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                  Fugiat enim eram quae cillum dolore dolor amet nulla culpa multos export minim fugiat minim velit minim dolor enim duis veniam ipsum anim magna sunt elit fore quem dolore labore illum veniam.
                  <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                </p>
                <img src="assets/img/testimonials/testimonials-4.jpg" class="testimonial-img" alt="">
                <h3>Matt Brandon</h3>
                <h4>Freelancer</h4>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-item" data-aos="fade-up" data-aos-delay="400">
                <p>
                  <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                  Quis quorum aliqua sint quem legam fore sunt eram irure aliqua veniam tempor noster veniam enim culpa labore duis sunt culpa nulla illum cillum fugiat legam esse veniam culpa fore nisi cillum quid.
                  <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                </p>
                <img src="assets/img/testimonials/testimonials-5.jpg" class="testimonial-img" alt="">
                <h3>John Larson</h3>
                <h4>Entrepreneur</h4>
              </div>
            </div><!-- End testimonial item -->

          </div>
          <div class="swiper-pagination"></div>
        </div>

      </div>
    </section><!-- End Testimonials Section -->

    <!-- ======= Contact Section ======= -->

    <section id="contact" class="contact">
      <div class="container">

        <div class="section-title">
          <h2>Mi Pérfil</h2>
        </div>

        <div class="row" data-aos="fade-in">
          <div class="col-lg-7 mt-5 mt-lg-0 d-flex align-items-stretch">

            <form class="form" action="" method="post" enctype="multipart/form-data">

              <h3 class="text-center text-info">Mis Datos</h3>
              <div class="form-group">
                <label for="username" class="text-info">Nombres:</label><br>
                <input name="txtNombre" id="txtNombre" type="text" value=<?php echo $_SESSION['nombre']; ?> pattern="[A-Za-z9-0]" class="form-control">
              </div>
              <div class="form-group">
                <label for="password" class="text-info">Apellidos:</label><br>
                <input name="txtApellidos" id="txtApellidos" type="text" value=<?php echo $_SESSION['apellidos']; ?> pattern="[A-Za-z9-0]" class="form-control">
              </div>
              <div class="form-group">
                <label for="password" class="text-info">Correo:</label><br>
                <input name="txtCorreo" id="txtCorreo" type="text" value=<?php echo $_SESSION['correo']; ?> pattern="[A-Za-z9-0]" class="form-control">
              </div>
              <div class="form-group">
                <label for="password" class="text-info">Dirección:</label><br>
                <input name="txtDir" id="txtDir" type="text" value=<?php echo $_SESSION['direccion']; ?> pattern="[A-Za-z9-0]" class="form-control">
              </div>
              <div class="form-group">
                <label for="password" class="text-info">Numero de Hijos:</label><br>
                <input name="txtNumHij" id="txtNumHij" type="text" value=<?php echo $_SESSION['hijos']; ?> pattern="[A-Za-z9-0]" class="form-control">
              </div>
              <div class="form-group">
                <label for="password" class="text-info">Estado Civil:</label><br>
                <input name="txtEstCivil" id="txtEstCivil" type="text" value=<?php echo $_SESSION['estado']; ?> pattern="[A-Za-z9-0]" class="form-control">
              </div>
              <div class="form-group">
                <label for="password" class="text-info">Foto de Pérfil:</label><br>
                <input type="file" value=<?php echo $_SESSION['foto']; ?> name="archivo[]" id="archivo[]" multiple="" class="btn btn-info btn-md">
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
    </section><!-- End Contact Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>iPortfolio</span></strong>
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/iportfolio-bootstrap-portfolio-websites-template/ -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>
  </footer><!-- End  Footer -->

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
  <script src="assets2/js/main.js"></script>
  <script src="assets2/js/jquery.min.js"></script>
  <script src="assets2/js/popper.min.js"></script>
  <script src="assets2/js/bootstrap.min.js"></script>
  <script src="assets2/plugins/simplebar/js/simplebar.js"></script>
  <script src="assets2/js/sidebar-menu.js"></script>
  <script src="assets2/js/app-script.js"></script>
</body>

</html>