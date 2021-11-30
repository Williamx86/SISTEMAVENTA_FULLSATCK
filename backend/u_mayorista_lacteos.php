<?php
    require 'conexion.php';
    session_start();

    $nombre = $_POST['nombre'];
    $sku = $_POST['sku'];
    $precio = $_POST['precio'];
    $id = $_POST['id'];

    $insertar = "UPDATE bodega_lacteos SET nombre='$nombre',sku='$sku',precio_mayorista='$precio' WHERE id = '$id'";
    $query = mysqli_query($conexion,$insertar);
    header('Location: ../mayorista_lacteos.php?correcto=1');
?>