<?php
    require 'conexion.php';
    session_start();

    $nombre = $_POST['nombre'];
    $sku = $_POST['sku'];
    $precio = $_POST['precio'];
    $id = $_POST['id'];

    $insertar = "UPDATE bodega_abarrotes SET nombre='$nombre',sku='$sku',precio_sala='$precio' WHERE id = '$id'";
    $query = mysqli_query($conexion,$insertar);
    header('Location: ../sala_abarrotes.php?correcto=1');
?>