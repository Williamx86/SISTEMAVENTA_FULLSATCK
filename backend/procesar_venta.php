<?php
    // Desactivar toda las notificaciónes del PHP

    error_reporting(0);
    require 'conexion.php';
    session_start();
    date_default_timezone_set('America/El_Salvador');

    $total = $_POST['total'];
    $metodo = $_POST['metodo'];
    $cambio = $_POST['cambio'];
    $fecha = date('Y-m-d');
    $cliente = $_POST['cliente'];
    $hora = date('h:i:s a');

    if (empty($metodo) && $cliente == "Sala") { 
        header('Location: ../venta_sala.php?incorrecto=1');
    }

    if (empty($metodo) && $cliente == "Mayorista") { 
        header('Location: ../venta_mayorista.php?incorrecto=1');
    }


    $productos = $_POST['producto'];
    $cantidades = $_POST['cantidad'];
    $precios = $_POST['precio'];
    $importes = $_POST['importe'];

    if (empty($productos) && $cliente == "Sala") { 
        header('Location: ../venta_sala.php?incorrecto=1');
    }

    if (empty($productos) && $cliente == "Mayorista") { 
        header('Location: ../venta_mayorista.php?incorrecto=1');
    }

    $insertar_venta = "INSERT INTO ventas (total, metodo, cambio, fecha, cliente, hora) VALUES ('$total','$metodo','$cambio','$fecha','$cliente','$hora')";
    $query = mysqli_query($conexion,$insertar_venta);

    $consultar_ultimo_registro = "SELECT id FROM ventas ORDER BY ID DESC LIMIT 1";
    $ejecutar = mysqli_query($conexion,$consultar_ultimo_registro);

    while($mostrar = mysqli_fetch_array($ejecutar)){
        $id_ultima_venta = $mostrar['id'];
    }

    if (!empty($productos) && is_array($productos) ) { 
        for($i = 0; $i < count($productos); $i++){
            $insertar_producto = "INSERT INTO productos_venta (id_venta, producto, cantidad, precio, importe) VALUES ('$id_ultima_venta','$productos[$i]','$cantidades[$i]','$precios[$i]','$importes[$i]')";
            $query_producto = mysqli_query($conexion,$insertar_producto);

            //Codigo descontar productos
            $consultar_ultimo_stock = "SELECT stock FROM bodega_lacteos WHERE nombre = '$productos[$i]'";
            $ejecutar_conteo = mysqli_query($conexion,$consultar_ultimo_stock);
        
            while($mostrar_stock = mysqli_fetch_array($ejecutar_conteo)){
                $ultimo_stock = $mostrar_stock['stock'];
            }

            $nuevo_stock = $ultimo_stock - $cantidades[$i];

            $descontar_lacteos = "UPDATE bodega_lacteos SET stock='$nuevo_stock' WHERE nombre = '$productos[$i]'";
            $ejecutar_descuento = mysqli_query($conexion,$descontar_lacteos);

            //Codigo descontar productos abarrotes
            $consultar_ultimo_stock_abarrotes = "SELECT stock FROM bodega_abarrotes WHERE nombre = '$productos[$i]'";
            $ejecutar_conteo_abarrotes = mysqli_query($conexion,$consultar_ultimo_stock_abarrotes);
        
            while($mostrar_stock_abarrotes = mysqli_fetch_array($ejecutar_conteo_abarrotes)){
                $ultimo_stock_abarrotes = $mostrar_stock_abarrotes['stock'];
            }

            $nuevo_stock_abarrotes = $ultimo_stock_abarrotes - $cantidades[$i];

            $descontar_abarrotes = "UPDATE bodega_abarrotes SET stock='$nuevo_stock_abarrotes' WHERE nombre = '$productos[$i]'";
            $ejecutar_descuento_abarrotes = mysqli_query($conexion,$descontar_abarrotes);
        }
    }

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style_ticket.css">
    <title>Comprobante Venta</title>
  </head>
  <body>
    
    <div id="ticket" class="contendor_ticket">
        <div class="inicio_ticket">
            <h2>Tienda de abarrotes y lácteos</h5>
            <p>Ticket No.<?php echo $id_ultima_venta ?> </p>
            <p><?php echo date('d-m-Y') ?></p>
        </div>

        <div class="tabla_ticket">
            <table>
                <thead>
                    <tr>
                        <th>Unid.</th>
                        <th>Descripción</th>
                        <th>Precio de venta</th>
                        <th>Importe</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if (!empty($productos) && is_array($productos) ) { 
                            for($i = 0; $i < count($productos); $i++){
                                echo "<tr>";
                                    echo '<td>'.$cantidades[$i].'</td>';
                                    echo '<td>'.$productos[$i].'</td>';
                                    echo '<td>$'.$precios[$i].'</td>';
                                    echo '<td>$'.$importes[$i].'</td>';
                                echo "</tr>";
                            }
                        }
                    ?>
                </tbody>
            </table>
        </div>

        <div class="final_ticket">
            <h2>Total Neto: $<?php echo $total ?></h2>
            <p>Método de pago: <?php echo $metodo ?></p>
            <p>Cambio: <?php echo $cambio ?></p>
            <h1>¡Gracias por su compra!</h1>
        </div>

    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery.print/1.6.0/jQuery.print.min.js"
        integrity="sha512-i8ERcP8p05PTFQr/s0AZJEtUwLBl18SKlTOZTH0yK5jVU0qL8AIQYbbG5LU+68bdmEqJ6ltBRtCxnmybTbIYpw=="
        crossorigin="anonymous"></script>
    <script>
    $(document).ready(() => {
        $.print('#ticket');
    });
    </script>

  </body>
</html>