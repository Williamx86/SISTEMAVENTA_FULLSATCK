<?php
require 'conexion.php';
session_start();

$id = $_GET['id'];

$insertar = "DELETE FROM bodega_lacteos WHERE id = '$id'";
$query = mysqli_query($conexion,$insertar);
header('Location: ../bodegas_lacteos.php?correcto=1');

?>

