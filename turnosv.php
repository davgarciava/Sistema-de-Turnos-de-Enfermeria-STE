<?php
session_start();  /*Esta para Seguridad*/
require 'conexion.php';
 
if (isset($_SESSION['user_id'])) { /*Esta para Seguridad*/
$sql = "SELECT id, title, start, end, color FROM events ";
 
$req = $conn->prepare($sql);
$req->execute();
 
$events = $req->fetchAll();
 
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="img/pestana.png" />
  <title>Turnos</title>
  <meta name="description" content="Free Bootstrap Theme by BootstrapMade.com">
  <meta name="keywords" content="free website templates, free bootstrap themes, free template, free bootstrap, free website template">

  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans|Raleway|Candal">
  <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <!-- FullCalendar -->
  <link href='php/css/fullcalendar.css' rel='stylesheet' />
 
 
    <!-- Custom CSS -->
 
  <!-- =======================================================
    Theme Name: Medilab
    Theme URL: https://bootstrapmade.com/medilab-free-medical-bootstrap-theme/
    Author: BootstrapMade.com
    Author URL: https://bootstrapmade.com
  ======================================================= -->
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
              <a class="navbar-brand" href="#"><img src="img/pestana.png" class="img-responsive" style="margin-top: -16px;"></a>
            </div>
            <div class="collapse navbar-collapse navbar-right" id="myNavbar">
              <ul class="nav navbar-nav">
                <li class="bg-color "><a href="admin.php">Inicio</a></li>
                <li class="bg-color active"><a href="turnos.php">Turnos</a></li>
                <li class="bg-color "><a href="chat.php">Chat</a></li>
                <li class="bg-color "><a href="cerrar.php">Cerrar Sesión</a></li>
              </ul>
            </div>
          </div>
        </div>
      </nav>
    </div>
  </section>
  <body>
 
    <!-- Navigation -->

    <!-- Page Content -->
    <div class="container">
 
        <div class="row">
            <div class="col-lg-12 text-center">
                <h1>Calendario STE</h1>
                <p class="lead">¡Si necesitas cambiar un turno habla con un Administrador!</p>
                <div id="calendar" class="col-centered">
                </div>
            </div>
      
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
 
    <!-- jQuery Version 1.11.1 -->
    <script src="php/js/jquery.js"></script>
    <script src="js/jquery.easing.min.js"></script> 
    <!-- Bootstrap Core JavaScript -->
    <script src="php/js/bootstrap.min.js"></script>
    <script src="js/custom.js"></script>
  <!-- FullCalendar -->
  <script src='php/js/moment.min.js'></script>
  <script src='php/js/fullcalendar/fullcalendar.min.js'></script>
  <script src='php/js/fullcalendar/fullcalendar.js'></script>
  <script src='php/js/fullcalendar/locale/es.js'></script>
  
  
  <script>
 
  $(document).ready(function() {
 
    var date = new Date();
       var yyyy = date.getFullYear().toString();
       var mm = (date.getMonth()+1).toString().length == 1 ? "0"+(date.getMonth()+1).toString() : (date.getMonth()+1).toString();
       var dd  = (date.getDate()).toString().length == 1 ? "0"+(date.getDate()).toString() : (date.getDate()).toString();
    
    $('#calendar').fullCalendar({
      header: {
         language: 'es',
        left: 'prev,next today',
        center: 'title',
        right: 'month,basicWeek,basicDay',
 
      },
      defaultDate: yyyy+"-"+mm+"-"+dd,
      editable: true,
      eventLimit: true, // allow "more" link when too many events
      selectable: true,
      selectHelper: true,
      select: function(start, end) {
        
        $('#ModalAdd #start').val(moment(start).format('YYYY-MM-DD HH:mm:ss'));
        $('#ModalAdd #end').val(moment(end).format('YYYY-MM-DD HH:mm:ss'));
        $('#ModalAdd').modal('show');
      },
      eventRender: function(event, element) {
        element.bind('dblclick', function() {
          $('#ModalEdit #id').val(event.id);
          $('#ModalEdit #title').val(event.title);
          $('#ModalEdit #color').val(event.color);
          $('#ModalEdit').modal('show');
        });
      },
      eventDrop: function(event, delta, revertFunc) { // si changement de position
 
        edit(event);
 
      },
      eventResize: function(event,dayDelta,minuteDelta,revertFunc) { // si changement de longueur
 
        edit(event);
 
      },
      events: [
      <?php foreach($events as $event): 
      
        $start = explode(" ", $event['start']);
        $end = explode(" ", $event['end']);
        if($start[1] == '00:00:00'){
          $start = $start[0];
        }else{
          $start = $event['start'];
        }
        if($end[1] == '00:00:00'){
          $end = $end[0];
        }else{
          $end = $event['end'];
        }
      ?>
        {
          id: '<?php echo $event['id']; ?>',
          title: '<?php echo $event['title']; ?>',
          start: '<?php echo $start; ?>',
          end: '<?php echo $end; ?>',
          color: '<?php echo $event['color']; ?>',
        },
      <?php endforeach; ?>
      ]
    });
    
    function edit(event){
      start = event.start.format('YYYY-MM-DD HH:mm:ss');
      if(event.end){
        end = event.end.format('YYYY-MM-DD HH:mm:ss');
      }else{
        end = start;
      }
      
      id =  event.id;
      
      Event = [];
      Event[0] = id;
      Event[1] = start;
      Event[2] = end;
      
      $.ajax({
       url: 'editEventDate.php',
       type: "POST",
       data: {Event:Event},
       success: function(rep) {
          if(rep == 'OK'){
            alert('Evento se ha guardado correctamente');
          }else{
            alert('No se pudo guardar. Inténtalo de nuevo.'); 
          }
        }
      });
    }
    
  });
 
</script>
<br><br>
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
                <li><a href="usuario.php"><i class="fa fa-circle"></i>Inicio</a></li>
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
 
</body>
 </html>
<?php
}else{
  echo "Acceso denegado, inicia sesión!";
}
?>