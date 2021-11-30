<?php
    require 'backend/conexion.php';

    $password = $_GET['pass'];

    $selecionar = mysqli_query($conexion,"SELECT * FROM usuarios WHERE clave = '$password'");
    while ($datos = mysqli_fetch_assoc($selecionar)) {
        $arra[] = $datos; 
    }
    echo json_encode($arra); 
?>