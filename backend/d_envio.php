<?php
require 'conexion.php';
session_start();

$id = $_GET['id'];

$insertar = "DELETE FROM envio_info WHERE id = '$id'";
$query = mysqli_query($conexion,$insertar);
$insertar_dos = "DELETE FROM envios_productos WHERE id = '$id'";
$query_dos = mysqli_query($conexion,$insertar_dos);
header('Location: ../reporte_ventas.php?correcto=1');

?>