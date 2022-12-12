<?php
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=id6105996_ste;charset=utf8', 'sena-ste', '73QP#4N@3ru&Xc1J&gDt');
} catch(PDOException $e)
{
        die('Error : '.$e->getMessage());
}