<?php

$server = 'localhost';
$username = 'root';/*id6105996_ste*/
$password = ''/*73QP#4N@3ru&Xc1J&gDt*/;
$database = 'ste'/*id6105996_ste*/;

try {
  $conn = new PDO("mysql:host=$server;dbname=$database;charset=utf8", $username, $password);
} catch (PDOException $e) {
  die('Connection Failed: ' . $e->getMessage());
}


function formatearFecha($fecha){
	return date('M / d / g:i a', strtotime($fecha));
}
?>
