<?php
    require 'conexion.php';
    session_start();
    date_default_timezone_set('America/El_Salvador');

    $numero = $_POST['numero'];
    $proveedor = $_POST['proveedor'];
    $total = $_POST['total'];
    $tipo_pago = $_POST['tipo_pago'];
    $fecha = date('Y-m-d');
    $hora = date('h:i:s a');
    
    $productos = $_POST['producto'];
    $cantidades = $_POST['cantidad'];
    $precios = $_POST['precio'];

    $insertar = "INSERT INTO compras (numero, proveedor, total, tipo_pago, fecha, hora) VALUES ('$numero','$proveedor','$total','$tipo_pago','$fecha','$hora')";
    $query = mysqli_query($conexion,$insertar);

    $consultar_ultimo_registro = "SELECT id FROM compras ORDER BY ID DESC LIMIT 1";
    $ejecutar = mysqli_query($conexion,$consultar_ultimo_registro);

    while($mostrar = mysqli_fetch_array($ejecutar)){
        $id_ultima_venta = $mostrar['id'];
    }

    if (!empty($productos) && is_array($productos) ) { 
        for($i = 0; $i < count($productos); $i++){
            $insertar_producto = "INSERT INTO productos_compra (id_compra, nombre, cantidad) VALUES ('$id_ultima_venta','$productos[$i]','$cantidades[$i]')";
            $query_producto = mysqli_query($conexion,$insertar_producto);

            //Codigo descontar productos
            $consultar_ultimo_stock = "SELECT stock FROM bodega_lacteos WHERE nombre = '$productos[$i]'";
            $ejecutar_conteo = mysqli_query($conexion,$consultar_ultimo_stock);
        
            while($mostrar_stock = mysqli_fetch_array($ejecutar_conteo)){
                $ultimo_stock = $mostrar_stock['stock'];
            }

            $nuevo_stock = $ultimo_stock + $cantidades[$i];

            $descontar_lacteos = "UPDATE bodega_lacteos SET stock='$nuevo_stock' WHERE nombre = '$productos[$i]'";
            $ejecutar_descuento = mysqli_query($conexion,$descontar_lacteos);

            //Codigo descontar productos abarrotes
            $consultar_ultimo_stock_abarrotes = "SELECT stock FROM bodega_abarrotes WHERE nombre = '$productos[$i]'";
            $ejecutar_conteo_abarrotes = mysqli_query($conexion,$consultar_ultimo_stock_abarrotes);
        
            while($mostrar_stock_abarrotes = mysqli_fetch_array($ejecutar_conteo_abarrotes)){
                $ultimo_stock_abarrotes = $mostrar_stock_abarrotes['stock'];
            }

            $nuevo_stock_abarrotes = $ultimo_stock_abarrotes + $cantidades[$i];

            $descontar_abarrotes = "UPDATE bodega_abarrotes SET stock='$nuevo_stock_abarrotes' WHERE nombre = '$productos[$i]'";
            $ejecutar_descuento_abarrotes = mysqli_query($conexion,$descontar_abarrotes);

            $actualizar_precio_lacteos = "UPDATE bodega_lacteos SET precio_compra='$precios[$i]' WHERE nombre = '$productos[$i]'";
            $ejecutar_descuento = mysqli_query($conexion,$actualizar_precio_lacteos);

            $actualizar_precio_abarrotes = "UPDATE bodega_abarrotes SET precio_compra='$precios[$i]' WHERE nombre = '$productos[$i]'";
            $ejecutar_descuento = mysqli_query($conexion,$actualizar_precio_abarrotes);

        }
    }

    header('Location: ../compras.php?correcto=1');

?>