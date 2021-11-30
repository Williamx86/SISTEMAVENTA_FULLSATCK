<?php
    require 'conexion.php';
    session_start();
    date_default_timezone_set('America/El_Salvador');

    $id = $_GET['id'];

    $consultar = "SELECT * FROM remesas WHERE id = '$id'";
    $query = mysqli_query($conexion,$consultar);

    while($mostrar = mysqli_fetch_array($query)){
        $fecha = $mostrar['fecha'];
        $total = $mostrar['total'];
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
    <title>Cierre</title>
  </head>
  <body>
    
    <div id="ticket" class="contendor_ticket">
        <div class="inicio_ticket">
            <h2>Tienda de abarrotes y lácteos</h5>
            <p>Sucursal - La Rábida</p>
            <p><?php echo $fecha ?></p>
        </div>

        <div class="tabla_ticket">
            <table>
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Remesa</td>
                        <td><?php echo $total ?></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="final_ticket">
            <h2>Total: $<?php echo $total ?></h2>
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