<?php
require 'conexion.php';
session_start();

$id = $_GET['id'];

$insertar = "DELETE FROM bodega_abarrotes WHERE id = '$id'";
$query = mysqli_query($conexion,$insertar);
header('Location: ../bodegas_abarrotes.php?correcto=1');

?>

