<?php
require 'conexion.php';
session_start();

$id = $_GET['id'];

$insertar = "DELETE FROM caja WHERE id = '$id'";
$query = mysqli_query($conexion,$insertar);
header('Location: ../reporte_cierres.php?correcto=1');

?>

