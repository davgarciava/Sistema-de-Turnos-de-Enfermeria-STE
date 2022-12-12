<?php
  session_start();

  require 'conexion.php';

  if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('SELECT idUsuarios, Tipo, Nombres, Apellidos, Cedula FROM usuarios WHERE idUsuarios = :idUsuarios');
    $records->bindParam(':idUsuarios', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

  if ($results['Tipo']=="Usuario") {
      header('Location: usuario.php');
    }
    $user = null;

    if (count($results) > 0) {
      $user = $results;
    }
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="img/pestana.png" type="image/png">
  <title>Sistema de turnos</title>
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
  <section id="banner" class="banner">
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
              <a class="navbar-brand" href="#"><img src="img/pestana.png" style="margin-top: -16px;"></a>
            </div>
            <div class="collapse navbar-collapse navbar-right" id="myNavbar">
              <ul class="nav navbar-nav">
                <li class="bg-color active"><a href="#banner">Inicio</a></li>
                <li class="bg-color "><a href="php/registro.php">Registrar usuarios</a></li>
                <li class="bg-color "><a href="php/leer.php">Lista de usuarios</a></li>
                <li class="bg-color "><a href="php/turnos.php">Turnos</a></li>
                <li class="bg-color "><a href="chat.php">Chat</a></li>
                <li class="bg-color "><a href="cerrar.php">Cerrar Sesión</a></li>
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
              <?php if(!empty($user)): ?>
              <p class="btn btn-appoint" style="color: yellow"><b> Bienvenid@ <?= $user['Nombres']; ?></b></p>
            </div>
            <?php
            else: header('location: index.php');
            endif;
            ?>
            <div class="overlay-detail text-center">
              <a href="#contact"><i class="fa fa-angle-down"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--/ banner-->
  <!--contact-->
  <section id="contact" class="section-padding">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h2 class="ser-title">Comenta!</h2>
          <hr class="botm-line">
        </div>
        <div class="col-md-4 col-sm-4">
          <h3>Información de contacto</h3>
          <div class="space"></div>
          <p><i class="fa fa-map-marker fa-fw pull-left fa-2x"></i>42b247 Cra. 52<br>Rionegro, Antioquia</p>
          <div class="space"></div>
          <p><i class="fa fa-envelope-o fa-fw pull-left fa-2x"></i>info@ste.com</p>
          <div class="space"></div>
          <p><i class="fa fa-phone fa-fw pull-left fa-2x"></i>+57 800 123 1234</p>
        </div>
        <div class="col-md-8 col-sm-8 marb20">
          <div class="contact-info">
            <h3 class="cnt-ttl">Has cualquier comentario, sugerencia o queja</h3>
            <div class="space"></div>
            <form action="admin.php" method="POST">
              <div class="form-group">
                <label>Nombre(s):</label>
                <input required type="text" name="nombre" class="form-control br-radius-zero" disabled value="<?php echo $results['Nombres']; ?>"><br>
                <label>Apellidos:</label>
                <input required type="text" name="apellido" class="form-control br-radius-zero" disabled value="<?php echo $results['Apellidos']; ?>">
              </div>
              <div class="form-group">
                <textarea required name="comentario" class="form-control br-radius-zero" placeholder="Comentario"></textarea>
              </div>

              <div class="form-action">
                <input type="submit" name="enviar" class="btn btn-form" value="Enviar comentario">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--/ contact-->
  <?php
  if (isset($_POST['enviar'])) {

      $nombre = $user['Nombres'];
      $apellido = $user['Apellidos'];
      $comentario = $_POST['comentario'];

    $sql = "INSERT INTO comentarios (nombre, apellido, comentario) VALUES ('$nombre', '$apellido', '$comentario')";
    $ejecutar = $conn->query($sql);

    if ($ejecutar) {
      echo '<div class="alert alert-success fade in" style="text-align:center;">
              <strong>Comentario enviado correctamente!</strong>
            </div>';
    } else {
      echo '<div class="alert alert-danger fade in" style="text-align:center;">
              <strong>No se ha podido enviar el comentario!</strong>
            </div>';
    }
  }
  ?>  
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
                <li><a href="php/registro.php"><i class="fa fa-circle"></i>Registrar</a></li>
                <li><a href="php/leer.php"><i class="fa fa-circle"></i>Usuarios</a></li>
                <li><a href="php/turnos.php"><i class="fa fa-circle"></i>Turnos</a></li>
                <li><a href="chat.php"><i class="fa fa-circle"></i>Chat</a></li>
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
  <script src="js/custom.js"></script>
  <script src="contactform/contactform.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="php/js/bootstrap.min.js"></script>

</body>
</html>
<?php
}else{
  echo "Acceso denegado, inicia sesión!";
}
?>