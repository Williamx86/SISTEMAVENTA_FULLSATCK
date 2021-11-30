<?php
    require 'conexion.php';
    session_start();

    $nrc = $_POST['nrc'];
    $nombre = $_POST['nombre'];
    $contacto = $_POST['contacto'];
    $numero = $_POST['numero'];

    $insertar = "INSERT INTO proveedor (nrc, nombre, contacto, numero) VALUES ('$nrc','$nombre','$contacto','$numero')";
    $query = mysqli_query($conexion,$insertar);
    header('Location: ../reporte_proveedores.php?correcto=1');
?>