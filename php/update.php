<?php
session_start();  /*Esta para Seguridad*/
  require '../conexion.php';

  if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('SELECT idUsuarios, Tipo FROM usuarios WHERE idUsuarios = :idUsuarios');
    $records->bindParam(':idUsuarios', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);
  if ($results['Tipo']=="Usuario") {
      header('Location: ../usuario.php');
    }

  //Actualizar datos
  if(isset($_POST['Nombres'])){
    $id=$_POST['idUsuarios'];
    $tipo=$_POST['Tipo'];
    $nombres=$_POST['Nombres'];
    $apellidos=$_POST['Apellidos'];
    $nusuarioA=$_POST['nusuarioA'];
    $nusuarioN=$_POST['nusuarioN'];
    $correo=$_POST['Correo'];
    $telefono=$_POST['Telefono'];
    $claveN1 = $_POST['claveN1'];
    $claveN2 = $_POST['claveN2'];
    
    if($nusuarioA!=$nusuarioN){
      $records1=$conn->prepare("SELECT * FROM usuarios WHERE Cedula=:Cedula");
      $records1->bindParam(":Cedula",$nusuarioN);
      $records1->execute();
      if($records1->rowCount()>=1){
        echo '<div class="alert alert-danger fade in" style="text-align:center;">
                <strong>Error: Esa cédula ya está registrada!</strong>
              </div>';
        exit();
      }else{
        $nusuarioF=$nusuarioN;
      }
    }else{
      $nusuarioF=$nusuarioA;
    }

    if($claveN1!="" && $claveN2!=""){
      if($claveN1!=$claveN2){
        echo '<div class="alert alert-danger fade in" style="text-align:center;">
                <strong>Error: Las claves no coinciden!</strong>
              </div>';
        exit();
      }else{
        $records2=$conn->prepare("UPDATE usuarios SET Tipo=:Tipo,Nombres=:Nombres,Apellidos=:Apellidos,Correo=:Correo,Telefono=:Telefono,Contrasena=:claveN2,Cedula=:Cedula WHERE idUsuarios=:idUsuarios");
        $records2->bindParam(":Tipo",$tipo);
        $records2->bindParam(":Nombres",$nombres);
        $records2->bindParam(":Apellidos",$apellidos);
        $records2->bindParam(":Cedula",$nusuarioF);
        $records2->bindParam(":Correo",$correo);
        $records2->bindParam(":Telefono",$telefono);
        $claveN2 = password_hash($_POST['claveN2'], PASSWORD_BCRYPT);
        $records2->bindParam(":claveN2",$claveN2);
        $records2->bindParam(":idUsuarios",$id);
      }
    }else{
      $records2=$conn->prepare("UPDATE usuarios SET Tipo=:Tipo,Nombres=:Nombres,Apellidos=:Apellidos,Cedula=:Cedula,Correo=:Correo,Telefono=:Telefono WHERE idUsuarios=:idUsuarios");
      $records2->bindParam(":Tipo",$tipo);
      $records2->bindParam(":Nombres",$nombres);
      $records2->bindParam(":Apellidos",$apellidos);
      $records2->bindParam(":Cedula",$nusuarioF);
      $records2->bindParam(":Correo",$correo);
      $records2->bindParam(":Telefono",$telefono);
      $records2->bindParam(":idUsuarios",$id);   
    }

    if($records2->execute()){
      echo '<div class="alert alert-success fade in" style="text-align:center;">
              <strong>Datos actualizados correctamente!</strong>
            </div>';
    }else{
      echo '<div class="alert alert-danger fade in" style="text-align:center;">
                <strong>Error: No se pudo actualizar los datos!</strong>
            </div>';
    }
  }

  //Recuperar datos
  if(isset($_GET['id'])){
    $id=$_GET['id'];
    $records = $conn->prepare("SELECT * FROM usuarios WHERE idUsuarios=:idUsuarios");
    $records->bindParam(":idUsuarios",$id);

    $records->execute();
    if($records->rowCount()>=1){
      $results = $records->fetch(PDO::FETCH_ASSOC);
  ?>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="stylesheet" type="text/css" href="../css/registro.css">
    <script language="javascript">
    function linkar(link) {location.href=link;}
    </script>
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
    
  <!--registro-->
  <section id="cta-1" class="section-padding">
    <div id="registration-form">
      <div class='fieldset'>
        <legend>ACTUALIZAR USUARIO</legend>
        <form action="" method="POST">
          <div class='reg'>
      		<input name="idUsuarios" type="hidden" value="<?php echo $results['idUsuarios']; ?>" required="">
            <table class='reg'>
            <tr>
            <td colspan="2"><label><b>Tipo de usuario:</b></label></td>
            </tr>
            <?php if($results['Tipo']=="Usuario"){?>
            <tr>
            <td><input name='Tipo' type="radio" value="Administrador" required>Administrador</td>
            <td><input name='Tipo' type="radio" value="Usuario" required checked>Usuario</td>
            </tr>
        	<?php
        	}else{
        	?>
            <tr>
            <td><input name='Tipo' type="radio" value="Administrador" required checked>Administrador</td>
            <td><input name='Tipo' type="radio" value="Usuario" required>Usuario</td>
            </tr>
            <?php
       		}
       		?>
            </table>
          </div>
          <div class='row'>
            <input name="Nombres" type="text" placeholder="Nombre(s)" value="<?php echo $results['Nombres']; ?>" required="">
          </div>
          <div class='row'>
            <input name="Apellidos" type="text" placeholder="Apellido(s)" value="<?php echo $results['Apellidos']; ?>" required="">
          </div>
          	<input name="nusuarioA" type="hidden" value="<?php echo $results['Cedula']; ?>" required="">
          <div class='row'>
            <input name="nusuarioN" type="text" placeholder="Cédula" value="<?php echo $results['Cedula']; ?>" required="" onKeypress="return chequeo(event)">
          </div>
          <div class='row'>
            <input name='Correo' type="email" placeholder="Correo Electrónico (Opcional)" value="<?php echo $results['Correo']; ?>">
          </div>
          <div class='row'>
            <input name='Telefono' type="tel" placeholder="Teléfono (Opcional)" value="<?php echo $results['Telefono']; ?>" onKeypress="return chequeo(event)">
          </div>
          <div class='row'>
          	<br>
          	<p style="text-align: center;"><b>Para actualizar, por favor ingrese la nueva contraseña y repitala</p>
            <input name="claveN1" type="password" placeholder="Nueva contraseña">
      		<input name="claveN2" type="password" placeholder="Repita la nueva contraseña">
          </div><br><br>
            <button type="submit" value="Actualizar">Actualizar</button>
      		<input type="button" onclick="linkar('leer.php')" value="Regresar">
        </form>
      </div>
    </div>
  </section>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

  <!--registro-->  
<?php
    }else{
      echo "Ocurrio un error";
    }
  }else{
    echo "Error no se pudo procesar la peticion";
  }
?>
<?php
}else{
  echo "Acceso denegado, inicia sesión!";
}
?>