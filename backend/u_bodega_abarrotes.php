<?php
    require 'conexion.php';
    session_start();

    $nombre = $_POST['nombre_editar'];
    $sku = $_POST['sku_editar'];
    $stock = $_POST['stock_editar'];
    $id = $_POST['id_editar'];
    $precio = $_POST['precio_compra'];

    $insertar = "UPDATE bodega_abarrotes SET nombre='$nombre',sku='$sku',stock='$stock',precio_compra='$precio' WHERE id = '$id'";
    $query = mysqli_query($conexion,$insertar);
    header('Location: ../bodegas_abarrotes.php?correcto=1');
?>