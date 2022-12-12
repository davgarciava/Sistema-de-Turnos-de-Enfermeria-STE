<?php
  session_start();

  require 'conexion.php';

  if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('SELECT idUsuarios, Tipo, Nombres, Apellidos, Cedula, Contrasena FROM usuarios WHERE idUsuarios = :idUsuarios');
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
  <title>Chat</title>
  <meta name="description" content="Free Bootstrap Theme by BootstrapMade.com">
  <meta name="keywords" content="free website templates, free bootstrap themes, free template, free bootstrap, free website template">

  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans|Raleway|Candal">
  <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" type="text/css" href="css/registro.css">
  <link rel="stylesheet" type="text/css" href="css/chat.css" />
  <script type="text/javascript">
    function ajax(){
      var req = new XMLHttpRequest();

      req.onreadystatechange = function(){
        if (req.readyState == 4 && req.status == 200) {
          document.getElementById('chat').innerHTML = req.responseText;
        }
      }

      req.open('GET', 'mchat.php', true);
      req.send();
    }

    //linea que hace que se refresque la pagina cada segundo
    setInterval(function(){ajax();}, 1000);
  </script>
  <!-- =======================================================
    Theme Name: Medilab
    Theme URL: https://bootstrapmade.com/medilab-free-medical-bootstrap-theme/
    Author: BootstrapMade.com
    Author URL: https://bootstrapmade.com
  ======================================================= -->
</head>

<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60" onload="ajax();">
  <!--banner-->
  <?php if($results['Tipo']=="Usuario"){ 
  ?>
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
                <li class="bg-color "><a href="usuario.php">Inicio</a></li>
                <li class="bg-color "><a href="turnosv.php">Turnos</a></li>
                <li class="bg-color active"><a href="chat.php">Chat</a></li>
                <li class="bg-color "><a href="cerrar.php">Cerrar Sesión</a></li>
              </ul>
          </div>
        </div>
      </nav>
    </div>
  </section>
  <?php
  }else{
  ?>
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
              <a class="navbar-brand" href="#"><img src="img/pestana.png" class="img-responsive" style="height: 70px; margin-top: -16px;"></a>
            </div>
            <div class="collapse navbar-collapse navbar-right" id="myNavbar">
              <ul class="nav navbar-nav">
                <li class="bg-color "><a href="admin.php">Inicio</a></li>
                <li class="bg-color "><a href="php/registro.php">Registrar usuarios</a></li>
                <li class="bg-color "><a href="php/leer.php">Lista de usuarios</a></li>
                <li class="bg-color "><a href="php/turnos.php">Turnos</a></li>
                <li class="bg-color active"><a href="chat.php">Chat</a></li>
                <li class="bg-color "><a href="cerrar.php">Cerrar Sesión</a></li>
              </ul>
          </div>
        </div>
      </nav>
    </div>
  </section><br>
  <?php
  }
  ?>
  <!--/ banner-->
  <!--chat-->
  <section><br>
  <div id="contenedor">
    <div id="caja-chat">
      <div><p id="chat"></p></div>
    </div>

    <form method="POST" action="chat.php">
      <textarea name="mensaje" placeholder="Ingresa tu mensaje"></textarea>
      <b><input class="colorss" type="submit" name="enviar" value="Enviar"></b>
      <?php
      if($results['Tipo']=="Administrador"){
      ?>

      <b><input class="colors" type="submit" formaction="vchat.php" onclick="return confirm('¿Estas seguro que deseas vaciar el chat?');" name="eliminar" value="Vaciar Chat"></b>
      <?php
      }
      ?>
    </form>

    <?php
      if (isset($_POST['enviar'])) {
        
        $tipo = $user['Tipo'];
        $nombre = $user['Nombres'];
        $apellido = $user['Apellidos'];
        $mensaje = $_POST['mensaje'];


        $consulta = "INSERT INTO chat (tipo, nombre, apellido, mensaje) VALUES ('$tipo', '$nombre', '$apellido', '$mensaje')";

        $ejecutar = $conn->query($consulta);

        if ($ejecutar) {
          echo "<embed loop='false' src='beep.mp3' hidden='true' autoplay='true'>";
        }
      }

    ?>
  </div>
  </section><br>
  <!--chat-->
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
            <?php if($results['Tipo']=="Usuario"){ 
            ?>
            <div class="info-sec">
              <ul class="quick-info">
                <li><a href="usuario.php"><i class="fa fa-circle"></i>Inicio</a></li>
                <li><a href="turnosv.php"><i class="fa fa-circle"></i>Turnos</a></li>
              </ul>
            </div>
            <?php
            }else{
            ?>
            <div class="info-sec">
              <ul class="quick-info">
                <li><a href="admin.php"><i class="fa fa-circle"></i>Inicio</a></li>
                <li><a href="php/registro.php"><i class="fa fa-circle"></i>Registrar</a></li>
                <li><a href="php/leer.php"><i class="fa fa-circle"></i>Usuarios</a></li>
                <li><a href="php/turnos.php"><i class="fa fa-circle"></i>Turnos</a></li>
              </ul>
            </div>
            <?php
            }
            ?>
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
<!-- 
http://www.elwebmaster.com/articulos/crea-tu-propia-aplicacion-de-chat-con-php-y-jquery
http://www.render2web.com/como-crear-un-chat-con-html5-css3-php-mysql-y-ajax/
-->
</html>
<?php
if(empty($user)):header('location: index.php');
endif;
?>