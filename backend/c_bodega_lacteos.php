<?php
    require 'conexion.php';
    session_start();

    $nombre = $_POST['nombre'];
    $sku = $_POST['sku'];
    $stock = $_POST['stock'];

    $insertar = "INSERT INTO bodega_lacteos (nombre, sku, stock) VALUES ('$nombre','$sku','$stock')";
    $query = mysqli_query($conexion,$insertar);
    header('Location: ../bodegas_lacteos.php?correcto=1');
?>