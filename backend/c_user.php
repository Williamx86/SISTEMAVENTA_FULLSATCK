<?php
    require 'conexion.php';
    session_start();

    $nombre = $_POST['nombre'];
    $clave = $_POST['clave'];
    $tipo = $_POST['tipo'];
    $sucursal = $_POST['sucursal'];

    $insertar = "INSERT INTO usuarios (nombre, clave, tipo, sucursal) VALUES ('$nombre','$clave','$tipo','$sucursal')";
    $query = mysqli_query($conexion,$insertar);
    header('Location: ../accesos.php?correcto=1');
?>