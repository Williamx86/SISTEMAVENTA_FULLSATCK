<?php

    require 'conexion.php';
    session_start();

    $usuario = $_POST['usuario'];
    $clave = $_POST['clave'];

    $query = "SELECT COUNT(*) AS contar FROM usuarios WHERE nombre = '$usuario' and clave = '$clave'";
    $consulta = mysqli_query($conexion,$query);
    $array = mysqli_fetch_array($consulta);

    if($array['contar']>0){
        $_SESSION['username'] = $usuario;
        header("location: ../opciones.php");
    }else{
        header("location: ../login_process.php?incorrecto=1");
    }

?>