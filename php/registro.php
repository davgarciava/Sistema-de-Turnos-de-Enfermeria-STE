<?php
  session_start();  /*Esta para Seguridad*/

  require '../conexion.php';
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="../img/pestana.png" />
  <title>Registrar usuarios</title>
  <meta name="description" content="Free Bootstrap Theme by BootstrapMade.com">
  <meta name="keywords" content="free website templates, free bootstrap themes, free template, free bootstrap, free website template">

  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans|Raleway|Candal">
  <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="../css/style.css">
  <link rel="stylesheet" type="text/css" href="../css/registro.css">
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
              <a class="navbar-brand" href="#"><img src="../img/pestana.png" class="img-responsive" style="margin-top: -16px;"></a>
            </div>
            <div class="collapse navbar-collapse navbar-right" id="myNavbar">
              <ul class="nav navbar-nav">
                <li class="bg-color "><a href="../admin.php">Inicio</a></li>
                <li class="bg-color active"><a href="registro.php">Registrar Usuarios</a></li>
                <li class="bg-color "><a href="leer.php">Lista de usuarios</a></li>
                <li class="bg-color "><a href="turnos.php">Turnos</a></li>
                <li class="bg-color "><a href="../chat.php">Chat</a></li>
                <li class="bg-color "><a href="../cerrar.php">Cerrar Sesión</a></li>
              </ul>
            </div>
          </div>
        </div>
      </nav>
    </div>
  </section>
  <!--/ banner-->
  <?php
  if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('SELECT idUsuarios, Tipo FROM usuarios WHERE idUsuarios = :idUsuarios');
    $records->bindParam(':idUsuarios', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);
  if ($results['Tipo']=="Usuario") {
      header('Location: ../usuario.php');
    }
    
  if (!empty($_POST['Tipo']) && !empty($_POST['Nombres']) && !empty($_POST['Apellidos']) && !empty($_POST['Cedula']) && !empty($_POST['Contrasena'])) {
    $sql = "INSERT INTO usuarios (Tipo, Nombres, Apellidos, Cedula, Correo, Telefono, Contrasena) VALUES (:Tipo, :Nombres, :Apellidos, :Cedula, :Correo, :Telefono, :Contrasena)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':Tipo', $_POST['Tipo']);
    $stmt->bindParam(':Nombres', $_POST['Nombres']);
    $stmt->bindParam(':Apellidos', $_POST['Apellidos']);
    $stmt->bindParam(':Cedula', $_POST['Cedula']);
    $stmt->bindParam(':Correo', $_POST['Correo']);
    $stmt->bindParam(':Telefono', $_POST['Telefono']);
    $password = password_hash($_POST['Contrasena'], PASSWORD_BCRYPT);
    $stmt->bindParam(':Contrasena', $password);

    if ($stmt->execute()) {
      echo '<div class="alert alert-success fade in" style="text-align:center;">
              <strong>Usuario creado correctamente!</strong>
            </div>';
    } else {
      echo '<div class="alert alert-danger fade in" style="text-align:center;">
              <strong>No se ha podido crear la cuenta!</strong>
            </div>';
    }
  }
  ?>
  <!--registro-->
  <section id="cta-1" class="container-fluid">
    <div class="col-md-1"></div>
      <div class="col-md-10">
        <div id="registration-form">
          <div class='fieldset'>
            <legend>REGISTRAR USUARIOS</legend>
            <form action="registro.php" method="POST">
                <div class='row'>
                  <div class='reg'>
                    <table class='table table-responsive reg'>
                    <tr>
                    <td colspan="2"><label><b>Tipo de usuario:</b></label></td>
                    </tr>
                    <tr>
                    <td><input name='Tipo' type="radio" value="Administrador" required>Administrador</td>
                    <td><input name='Tipo' type="radio" value="Usuario" required>Usuario</td>
                    </tr>
                    </table>
                  </div>
                </div>
              <div class='row'>
                <input name='Nombres' type="text" placeholder="Nombre(s)" id='firstname' required data-error-message="Nombre(s) es un requisito">
              </div>
              <div class='row'>
                <input name='Apellidos' type="text" placeholder="Apellido(s)" required data-error-message="Apellido(s) es un requisito">
              </div>
              <div class='row'>
                <input name='Cedula' type="text" placeholder="Cédula" required data-error-message="La cédula es un requisito" onKeypress="return chequeo(event)">
              </div>
              <div class='row'>
                <input name='Correo' type="email" placeholder="Correo Electrónico (Opcional)">
              </div>
              <div class='row'>
                <input name='Telefono' type="tel" placeholder="Teléfono (Opcional)" onKeypress="return chequeo(event)">
              </div>
              <div class='row'>
                <input name='Contrasena' type="password" placeholder="Contraseña" required data-error-message="La contraseña es un requisito">
              </div><br><br>
              <input type="submit" value="Registrar">
            </form>
          </div>
        </div>
      </div>
    <div class="col-md-1"></div>
  </section>
  <!--registro-->
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
                <li><a href="../admin.php"><i class="fa fa-circle"></i>Inicio</a></li>
                <li><a href="leer.php"><i class="fa fa-circle"></i>Usuarios</a></li>
                <li><a href="turnos.php"><i class="fa fa-circle"></i>Turnos</a></li>
                <li><a href="../chat.php"><i class="fa fa-circle"></i>Chat</a></li>
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

  <script src="../js/jquery.min.js"></script>
  <script src="../js/jquery.easing.min.js"></script>
  <script src="../js/custom.js"></script>
  <script src="../contactform/contactform.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>


</body>

</html>
<?php
}else{
  echo "Acceso denegado, inicia sesión!";
}
?>