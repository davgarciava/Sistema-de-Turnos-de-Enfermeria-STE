<?php
  session_start();
  if (isset($_SESSION['user_id'])) {
    header('Location: admin.php');
  }
  require 'conexion.php';
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="img/pestana.png" />
  <title>Iniciar Sesión</title>
  <meta name="description" content="Free Bootstrap Theme by BootstrapMade.com">
  <meta name="keywords" content="free website templates, free bootstrap themes, free template, free bootstrap, free website template">

  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans|Raleway|Candal">
  <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="css/iniciar.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <!-- =======================================================
    Theme Name: Medilab
    Theme URL: https://bootstrapmade.com/medilab-free-medical-bootstrap-theme/
    Author: BootstrapMade.com
    Author URL: https://bootstrapmade.com
  ======================================================= -->
  <SCRIPT LANGUAGE="JavaScript">

  function chequeo(evt) {

      evt = (evt) ? evt : window.event

      var charCode = (evt.which) ? evt.which : evt.keyCode

      if (charCode > 31 && (charCode < 48 || charCode > 57)) {

          status = "Este campo acepta números únicamente."

          return false

      }

      status = ""

      return true

  }

  </SCRIPT>
</head>

<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">
  <!--banner-->
  <section>
    <div class="bg-color-r">
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
                <li class="bg-color "><a href="index.php">Inicio</a></li>
                <li class="bg-color active"><a href="iniciar.php">Iniciar Sesión</a></li>
              </ul>
            </div>
          </div>
        </div>
      </nav>
    </div>
  </section>
  <!--/ banner-->
  <!--iniciar sesión-->
  <?php
    if (!empty($_POST['Cedula']) && !empty($_POST['Contrasena'])) {
      $records = $conn->prepare('SELECT idUsuarios, Cedula, Contrasena FROM usuarios WHERE Cedula = :Cedula');
      $records->bindParam(':Cedula', $_POST['Cedula']);
      $records->execute();
      $results = $records->fetch(PDO::FETCH_ASSOC);

      $message = '';

      if (($results['Cedula']==$_POST['Cedula']) && (count($results) > 0 && password_verify($_POST['Contrasena'], $results['Contrasena']))) {
        $_SESSION['user_id'] = $results['idUsuarios'];
        header("Location: admin.php");
      } else {
        echo '<div class="alert alert-danger fade in" style="text-align:center;">
                <strong>Usuario o contraseña incorectos!</strong>
              </div>';
      }
    }
  ?>
    <form action="iniciar.php" method="POST">
      <h1>Iniciar Sesión</h1>
      <div class="inset">
      <p>
        <label>Número de cédula</label>
        <input name="Cedula" type="text" required onKeypress="return chequeo(event)">
      </p>
      <p>
        <label>Contraseña</label>
        <input name="Contrasena" type="password" required>
      </p>
      </div>
      <p class="p-container">
        <span>¿Olvidaste tu contraseña?<br>Informa a un administrador<br><br></span>
        <input type="submit" value="Entrar" href="inicio.php">
      </p>
    </form>
  <!--/ iniciar sesión-->
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
                <li><a href="admin.php"><i class="fa fa-circle"></i>Inicio</a></li>
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