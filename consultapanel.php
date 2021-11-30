<?php
    require 'backend/conexion.php';

    date_default_timezone_set('America/El_Salvador');

    if($_GET['fecha'] == "hoy"){
        $fechaactual = date('Y-m-d');
    }elseif($_GET['fecha'] == "ayer"){
        $fechaactual = date("Y-m-d", strtotime('-1 day', time()));
    }

    $select = mysqli_query($conexion,"SELECT total FROM ventas WHERE metodo = 'Bitcoin' AND fecha = '$fechaactual' OR metodo = 'Débito' AND fecha = '$fechaactual' OR metodo = 'Crédito' AND fecha = '$fechaactual' OR metodo = 'Efectivo' AND fecha = '$fechaactual'");
    while ($dat = mysqli_fetch_assoc($select)) {
        $arra[] = $dat; 
    }
    echo json_encode($arra); 

?>