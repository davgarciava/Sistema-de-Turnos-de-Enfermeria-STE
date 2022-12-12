<?php
	session_start();
	require 'conexion.php';

    $records = $conn->prepare('DELETE FROM chat');
	$records->execute(); 
    header('location: chat.php');
?>