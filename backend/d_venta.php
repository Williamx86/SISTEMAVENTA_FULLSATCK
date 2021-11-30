<?php
require 'conexion.php';
session_start();

$id = $_GET['id'];

$insertar = "DELETE FROM ventas WHERE id = '$id'";
$query = mysqli_query($conexion,$insertar);
$insertar_dos = "DELETE FROM productos_venta WHERE id_venta = '$id'";
$query_dos = mysqli_query($conexion,$insertar_dos);
header('Location: ../reporte_ventas.php?correcto=1');

?>