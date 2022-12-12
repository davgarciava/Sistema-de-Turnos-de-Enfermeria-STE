<?php
	session_start();
	require '../conexion.php';

	if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('DELETE FROM usuarios WHERE idUsuarios = :id');
    $records->bindParam(":id", $_GET['id']);
	$records->execute();
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="../css/bootstrap.css" rel="stylesheet">
	<script language="javascript">
		function linkar(link) {location.href=link;}
	</script>
</head>
	<body>
	<center>
			<div class="row">
				<?php if($records) { 
					header('location: leer.php');?>
				<?php } else { ?>
				<h2>Error al Eliminar</h2>
				<?php } ?>		
			</div>	
	</center>
		
	</body>
</html>
<?php
}else{
  header('location: error.html');
}
?>
