<?php
    require 'conexion.php';
    session_start();
    date_default_timezone_set('America/El_Salvador');

    $total = $_POST['total'];
    $fecha = date('Y-m-d');
    $hora = date('h:i:s a');

    $insertar = "INSERT INTO remesas (total, fecha, hora) VALUES ('$total','$fecha','$hora')";
    $query = mysqli_query($conexion,$insertar);

    header('Location: ../agregar_venta.php?correcto=1');

?>