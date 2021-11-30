<?php
require 'conexion.php';
session_start();

$id = $_GET['id'];

$insertar = "DELETE FROM remesas WHERE id = '$id'";
$query = mysqli_query($conexion,$insertar);
header('Location: ../reporte_remesas.php?correcto=1');

?>