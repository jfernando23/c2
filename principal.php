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
if (isset($_POST['btnCrear'])) {
  if(isset($_POST['chkPublico'])){
    $idt = LimpiarCadena($_POST['txtMensaje']);
    $idu = $_SESSION['id'];
    tuit($idu, $idt,'Sí');
  }else{
    $idt = LimpiarCadena($_POST['txtMensaje']);
    $idu = $_SESSION['id'];
    tuit($idu, $idt,'No');
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
                  <a href="javascript:void();" name="lnkMisArticulos" data-target="#messages" data-toggle="pill" class="nav-link"><i class="zmdi zmdi-account-calendar"></i> <span class="hidden-xs">Mis artículo</span></a>
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
                                        <h1 name="lblAutor_1" class="text-light"><a class="font-weight-bold"><?php echo $fila['NOMBRE']; ?></a></h1>
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
                  <div class="tab-pane" id="messages">
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
                  <div class="tab-pane" id="edit">
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
                              <label class="form-check-label" >
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