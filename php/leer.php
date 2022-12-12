<?php
  session_start(); /*Esta para Seguridad*/

  require '../conexion.php';

  if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('SELECT idUsuarios, Tipo FROM usuarios WHERE idUsuarios = :idUsuarios');
    $records->bindParam(':idUsuarios', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);
  if ($results['Tipo']=="Usuario") {
      header('Location: ../usuario.php');
    }else{
    $records = $conn->prepare('SELECT idUsuarios, Tipo, Nombres, Apellidos, Cedula, Correo, Telefono, Contrasena FROM usuarios');
    $records->execute();
    }
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="../img/pestana.png" />
  <title>Lista de usuarios</title>
  <meta name="description" content="Free Bootstrap Theme by BootstrapMade.com">
  <meta name="keywords" content="free website templates, free bootstrap themes, free template, free bootstrap, free website template">

  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans|Raleway|Candal">
  <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="../css/style.css">
  <!-- =======================================================
    Theme Name: Medilab
    Theme URL: https://bootstrapmade.com/medilab-free-medical-bootstrap-theme/
    Author: BootstrapMade.com
    Author URL: https://bootstrapmade.com
  ======================================================= -->
  <link href="vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">
  <!-- DataTables Responsive CSS -->
  <link href="vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">
  <!--<link rel="stylesheet" type="text/css" href="../css/modal.css">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <script src="../js/jquery.min.js"></script>-->
  <script src="js/bootstrap.min.js"></script>     
  <script language="javascript">
  function linkar(link) {location.href=link;}
  function abrir(url) { 
      open(url,'','left=100,width=1150,height=620,status=no,directories=no,menubar=no,toolbar=no,scrollbars=no,location=no,resizable=no,titlebar=no'); 
      } 
  </script>
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
                <li class="bg-color "><a href="registro.php">Registrar Usuarios</a></li>
                <li class="bg-color active"><a href="leer.php">Lista de usuarios</a></li>
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
  <!--lista-->
<section><br>
  <h2 style="color: #364351;padding: 5px 10px;text-align: center;">Listado de Usuarios</h2><br>  
          <!--<input name="button" class="btn go" type="button" onclick="window.close();" value="Cerrar" />--> 
  <div id="page-wrapper"> 
  <!-- /.row -->
    <div class="container-fluid">
      <div class="col-lg-12">
        <div class="panel panel-default">
        <!-- /.panel-heading -->
          <div class="panel-body">
            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
            <!--<table id="customers">-->
              <thead>
                <tr>
                  <th style="text-align: center;">Nombres</th>
                  <th style="text-align: center;">Apellidos</th>
                  <th style="text-align: center;">Tipo</th>
                  <th style="text-align: center;">Cedula</th>
                  <th style="text-align: center;">Correo</th>
                  <th style="text-align: center;">Telefono</th>
                  <th style="text-align: center;">Actualizar</th>
                  <th style="text-align: center;">Eliminar</th>
                </tr>
              </thead>
              <?php while($results = $records->fetch(PDO::FETCH_ASSOC)) { 
              ?>
            <tr class="gradeA">
              <td><?php echo $results['Nombres']; ?></td>
              <td><?php echo $results['Apellidos']; ?></td>
              <td><?php echo $results['Tipo']; ?></td>
              <td><?php echo $results['Cedula']; ?></td>
              <td><?php echo $results['Correo']; ?></td>
              <td><?php echo $results['Telefono']; ?></td>

              <td style="text-align: center;"><a href='update.php?id=<?php echo $results['idUsuarios'];?>'><span><img src="../img/update.png" style="width: 35px; height: 35px;">Actualizar</span></a></td>
              <td style="text-align: center;"><a href='drop.php?id=<?php echo $results['idUsuarios']; ?>' onclick="return confirm('¿Estas seguro que deseas eliminar a  <?php echo $results['Nombres']; ?> <?php echo $results['Apellidos']; ?>?');"><span><img src="../img/delete.png" style="width: 35px; height: 35px;">Eliminar</span></a></td>
              </tr>
              <?php 
              } 
              ?>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
  <!--lista-->
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
                <li><a href="registro.php"><i class="fa fa-circle"></i>Registrar</a></li>
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
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

  <!-- jQuery -->
    <script src="vendor/jquery/jquery.js"></script>
    <!-- DataTables JavaScript -->
    <script src="vendor/datatables/js/jquery.dataTables.js"></script>
    <script src="vendor/datatables-plugins/dataTables.bootstrap.js"></script>
    <script src="vendor/datatables-responsive/dataTables.responsive.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });
    </script>

</body>
</html>
<?php
}else{
  echo "Acceso denegado, inicia sesión!";
}
?>