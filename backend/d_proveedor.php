<?php
require 'conexion.php';
session_start();

$id = $_GET['id'];

$insertar = "DELETE FROM proveedor WHERE id = '$id'";
$query = mysqli_query($conexion,$insertar);
header('Location: ../reporte_proveedores.php?correcto=1');

?>

