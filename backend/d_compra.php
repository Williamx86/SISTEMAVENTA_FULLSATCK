<?php
require 'conexion.php';
session_start();

$id = $_GET['id'];

$insertar = "DELETE FROM compras WHERE id = '$id'";
$query = mysqli_query($conexion,$insertar);
$insertar_dos = "DELETE FROM productos_compra WHERE id_compra = '$id'";
$query_dos = mysqli_query($conexion,$insertar_dos);
header('Location: ../reporte_compras.php?correcto=1');

?>