<?php
    require 'backend/conexion.php';

    date_default_timezone_set('America/El_Salvador');

    $select = mysqli_query($conexion,"SELECT total FROM ventas WHERE fecha BETWEEN DATE_SUB(NOW(), INTERVAL 30 DAY) AND NOW()");
    while ($dat = mysqli_fetch_assoc($select)) {
        $arra[] = $dat; 
    }
    echo json_encode($arra); 

?>