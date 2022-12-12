<?php
  session_start();

  require 'conexion.php';

  if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('SELECT idUsuarios, Tipo, Nombres, Cedula, Contrasena FROM usuarios WHERE idUsuarios = :idUsuarios');
    $records->bindParam(':idUsuarios', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = null;

    if (count($results) > 0) {
      $user = $results;
    }
  }
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="img/pestana.png" />
  <title>STE</title>
  <meta name="description" content="Free Bootstrap Theme by BootstrapMade.com">
  <meta name="keywords" content="free website templates, free bootstrap themes, free template, free bootstrap, free website template">

  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans|Raleway|Candal">
  <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <!-- =======================================================
    Theme Name: Medilab
    Theme URL: https://bootstrapmade.com/medilab-free-medical-bootstrap-theme/
    Author: BootstrapMade.com
    Author URL: https://bootstrapmade.com
  ======================================================= -->
</head>

<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">
  <!--banner-->
  <section id="banner">
    <div class="bg-color-i">
      <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
          <div class="col-md-12">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
				      </button>
              <a class="navbar-brand" href="#"><img src="img/pestana.png" class="img-responsive" style=" margin-top: -16px;"></a>
            </div>
            <div class="collapse navbar-collapse navbar-right" id="myNavbar">
              <ul class="nav navbar-nav">
                <li class="bg-color active"><a href="#banner">Inicio</a></li>
                <li class="bg-color "><a href="iniciar.php">Iniciar Sesión</a></li>
              </ul>
            </div>
          </div>
        </div>
      </nav>
      <div class="container">
        <div class="row">
          <div class="banner-info">
            <div class="banner-logo text-center">
              <img src="img/logo.png" class="img-responsive">
            </div>
            <div class="banner-text text-center">
              <h1 class="white">CUIDADO DE LA SALUD EN SU ESCRITORIO!</h1>
              <p>Dispuestos y puestos a labor para su salud, disponiendo<br>del tiempo de los enfermeros para su atencion.</p>
            </div>
            <div class="overlay-detail text-center">
              <a href="#service"><i class="fa fa-angle-down"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--/ banner-->
  <!--service-->
  <section id="service" class="section-padding">
    <div class="container">
      <div class="row">
        <div class="col-md-4 col-sm-4">
          <h2 class="ser-title">NUESTROS</h2><br>
          <h2 class="ser-title">SERVICIOS</h2>
          <hr class="botm-line">
          <p>Estamos dispuestos a generar la ayuda que facilita la disponibilidad de turnos dentro de un hospital, creando un sistema de turnos que ayude a definir estos de una forma mas rápida y con el criterio de estos.</p>
        </div>
        <div class="col-md-4 col-sm-4">
          <div class="service-info">
            <div class="icon">
              <i class="fa fa-stethoscope"></i>
            </div>
            <div class="icon-info">
              <h4>Consultar información de los trabajadores</h4>
              <p>El sistema ofrecerá al usuario información general acerca de los turnos que tienen los trabajadores u otros datos de importancia.</p>
            </div>
          </div>
        </div>
        <div class="col-md-4 col-sm-4">
          <div class="service-info">
            <div class="icon">
              <i class="fa fa-user-md"></i>
            </div>
            <div class="icon-info">
              <h4>Soporte las 24 horas</h4>
              <p>Este funciona las 24 horas para que el enfermero pueda ver durante el dia el horario de su turno.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--/ service-->
  <!--testimonial-->
  <section id="testimonial" class="section-padding">
    <div class="container">
      <div class="row">
        <div class="col-md-4 col-sm-4">
          <h3>Información de contacto</h3>
          <div class="space"></div>
          <p><i class="fa fa-map-marker fa-fw pull-left fa-2x"></i>42b247 Cra. 52<br>Rionegro, Antioquia</p>
          <div class="space"></div>
          <p><i class="fa fa-envelope-o fa-fw pull-left fa-2x"></i>info@ste.com</p>
          <div class="space"></div>
          <p><i class="fa fa-phone fa-fw pull-left fa-2x"></i>+57 800 123 1234</p>
        </div>
        <br>
        <div class="col-md-8 col-sm-8" style="float: right;">
        <div id="overflow">
          <h2 class="ser-title">Vea lo que los</h2><br>
          <h2 class="ser-title">clientes dicen</h2>
          <hr class="botm-line">
          <?php
            $consulta = "SELECT * FROM comentarios ORDER BY id DESC";
            $ejecutar = $conn->query($consulta); 
            while($fila = $ejecutar->fetch(PDO::FETCH_ASSOC)) { 
          ?>
          <div class="testi-details">
            <!-- Paragraph -->
            <p><?php echo $fila['comentario'];?></p>
          </div>
          <div class="testi-info">
            <!-- User Name -->
            <h3><?php echo $fila['nombre'];?><span><?php echo $fila['apellido'];?></span></h3>
          </div><br>
          <?php 
          } 
          ?>
        </div>
        </div>
      </div>
    </div>
  </section>
  <!--/ testimonial-->
  <!--about-->
  <section id="cta-2" class="section-padding">
    <div class="container">
      <div class=" row">
        <div class="col-md-2"></div>
        <div class="text-right-md col-md-4 col-sm-4">
          <h2 class="section-title white lg-line">« Unas pocas palabras<br> sobre nosotros »</h2>
        </div>
        <div class="col-md-4 col-sm-5">
          STE sirve para ahorrar tiempo y dinero en la distribución de los turnos de los trabajadores de un hospital, e igualmente para que cada trabajador vea de forma sencilla los turnos que le fueron establecidos.
          <p class="text-right text-primary"><i>— Equipo de STE</i></p>
        </div>
        <div class="col-md-2"></div>
      </div>
    </div>
  </section>
  <!--about-->
  <!--footer-->
  <footer id="footer">
    <div class="top-footer">
      <div class="container">
        <div class="row">
          <div class="col-md-4 col-sm-4 marb20">
            <div class="ftr-tle">
              <h4 class="white no-padding">Sobre STE</h4>
            </div>
            <div class="info-sec">
              <p>STE sirve para que cada trabajador de un hospital vea de forma sencilla los turnos que le fueron establecidos.</p>
            </div>
          </div>
          <div class="col-md-4 col-sm-4 marb20">
            <div class="ftr-tle">
              <h4 class="white no-padding">Enlaces rápidos</h4>
            </div>
            <div class="info-sec">
              <ul class="quick-info">
                <li><a href="#banner"><i class="fa fa-circle"></i>Inicio</a></li>
                <li><a href="#service"><i class="fa fa-circle"></i>Servicios</a></li>
                <li><a href="#testimonial"><i class="fa fa-circle"></i>Testimonio</a></li>
              </ul>
            </div>
          </div>
          <div class="col-md-4 col-sm-4 marb20">
            <div class="ftr-tle">
              <h4 class="white no-padding">Síguenos</h4>
            </div>
            <div class="info-sec">
              <ul class="social-icon">
                <li class="bglight-blue"><i class="fa fa-facebook"></i></li>
                <li class="bgred"><i class="fa fa-google-plus"></i></li>
                <li class="bgdark-blue"><i class="fa fa-linkedin"></i></li>
                <li class="bglight-blue"><i class="fa fa-twitter"></i></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="footer-line">
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center">
            © Copyright . All Rights Reserved
            <div class="credits">
              <!--
                All the links in the footer should remain intact.
                You can delete the links only if you purchased the pro version.
                Licensing information: https://bootstrapmade.com/license/
                Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=Medilab
              -->
              Designed by <a href="https://bootstrapmade.com/">BootstrapMade.com</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <!--/ footer-->

  <script src="js/jquery.min.js"></script>
  <script src="js/jquery.easing.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/custom.js"></script>
  <script src="contactform/contactform.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="php/js/bootstrap.min.js"></script>

</body>
</html>