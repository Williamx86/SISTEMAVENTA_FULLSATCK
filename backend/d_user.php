<?php
require 'conexion.php';
session_start();

$id = $_GET['id'];

$insertar = "DELETE FROM usuarios WHERE id = '$id'";
$query = mysqli_query($conexion,$insertar);
header('Location: ../accesos.php?correcto=1');

?>

