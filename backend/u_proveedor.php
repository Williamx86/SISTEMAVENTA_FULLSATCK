<?php
    require 'conexion.php';
    session_start();

    $nrc = $_POST['nrc'];
    $nombre= $_POST['nombre'];
    $contacto = $_POST['contacto'];
    $numero = $_POST['numero'];
    $id = $_POST['id_editar'];

    $insertar = "UPDATE proveedor SET nrc='$nrc',nombre='$nombre',contacto='$contacto',numero='$numero' WHERE id = '$id'";
    $query = mysqli_query($conexion,$insertar);
    header('Location: ../reporte_proveedores.php?correcto=1');
?>