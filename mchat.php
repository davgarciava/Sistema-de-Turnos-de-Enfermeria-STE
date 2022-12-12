<?php
	include "conexion.php";
	///consultamos a la base
	$consulta = "SELECT * FROM chat ORDER BY id DESC";
	$ejecutar = $conn->query($consulta); 
	while($fila = $ejecutar->fetch(PDO::FETCH_ASSOC)) : 
?>
	<div id="datos-chat">
        <span style="color: #FFBF00;">[<?php echo $fila['tipo'];?>]</span>
		<span style="color: #1C62C4;"><?php echo $fila['nombre']; ?></span>
		<span style="color: #1C62C4;"><?php echo $fila['apellido']; ?>:</span>
		<span style="color: #848484;"><?php echo $fila['mensaje']; ?></span>
		<span style="float: right;"><?php echo formatearFecha($fila['fecha']); ?></span>
	</div>
	
	<?php endwhile; ?>
