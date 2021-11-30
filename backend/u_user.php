<?php
    require 'conexion.php';
    session_start();

    $nombre = $_POST['nombre_usuario'];
    $clave = $_POST['clave_usuario'];
    $id = $_POST['id_usuario'];

    $insertar = "UPDATE usuarios SET nombre='$nombre',clave='$clave' WHERE id = '$id'";
    $query = mysqli_query($conexion,$insertar);
    header('Location: ../accesos.php?correcto=1');
?>