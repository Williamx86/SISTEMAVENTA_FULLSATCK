<?php
    require 'conexion.php';
    session_start();
    date_default_timezone_set('America/El_Salvador');

    $id = $_GET['id'];

    $consultar = "SELECT * FROM caja WHERE id = '$id'";
    $query = mysqli_query($conexion,$consultar);

    while($mostrar = mysqli_fetch_array($query)){
        $b_cien = $mostrar['b_cien'];
        $b_cincuenta = $mostrar['b_cincuenta'];
        $b_veinte = $mostrar['b_veinte'];
        $b_diez = $mostrar['b_diez'];
        $b_cinco = $mostrar['b_cinco'];
        $b_uno = $mostrar['b_uno'];
        $m_cora = $mostrar['m_cora'];
        $m_diez = $mostrar['m_diez'];
        $m_cinco = $mostrar['m_cinco'];
        $m_uno = $mostrar['m_uno'];
        $total_registrado = $mostrar['total_registrado'];
        $efectivo = $mostrar['efectivo'];
        $tarjeta = $mostrar['tarjeta'];
        $bitcoin = $mostrar['bitcoin'];
        $remesa = $mostrar['remesa'];
        $compra = $mostrar['compra'];
        $total_final = $mostrar['total_final'];
        $fecha = $mostrar['fecha'];
        $cajero = $mostrar['cajero'];
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
            <p><?php echo date('d-m-Y') ?></p>
        </div>

        <div class="tabla_ticket">
            <table>
                <thead>
                    <tr>
                        <th>Den.</th>
                        <th>Un.</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>100</td>
                        <td><?php echo $b_cien ?></td>
                        <td><?php echo 100 * $b_cien ?></td>
                    </tr>
                    <tr>
                        <td>50</td>
                        <td><?php echo $b_cincuenta ?></td>
                        <td><?php echo 50 * $b_cincuenta ?></td>
                    </tr>
                    <tr>
                        <td>20</td>
                        <td><?php echo $b_veinte ?></td>
                        <td><?php echo 20 * $b_veinte ?></td>
                    </tr>
                    <tr>
                        <td>10</td>
                        <td><?php echo $b_diez ?></td>
                        <td><?php echo 10 * $b_diez ?></td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td><?php echo $b_cinco ?></td>
                        <td><?php echo 5 * $b_cinco ?></td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td><?php echo $b_uno ?></td>
                        <td><?php echo $b_uno ?></td>
                    </tr>
                    <tr>
                        <td>0.25</td>
                        <td><?php echo $m_cora ?></td>
                        <td><?php echo 0.25 * $m_cora ?></td>
                    </tr>
                    <tr>
                        <td>0.10</td>
                        <td><?php echo $m_diez ?></td>
                        <td><?php echo 0.10 * $m_diez ?></td>
                    </tr>
                    <tr>
                        <td>0.05</td>
                        <td><?php echo $m_cinco ?></td>
                        <td><?php echo 0.05 * $m_cinco ?></td>
                    </tr>
                    <tr>
                        <td>0.01</td>
                        <td><?php echo $m_uno?></td>
                        <td><?php echo 0.01 * $m_uno?></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="final_ticket">
            <hr>
            <p>Total caja: <?php echo $total_final ?></p>
            <p>Efectivo: <?php echo $efectivo ?></p>
            <p>Tarjeta: <?php echo $tarjeta ?></p>
            <p>Bitcoin: <?php echo $bitcoin ?></p>
            <p>Remesa: <?php echo $remesa ?></p>
            <p>Compra: <?php echo $compra ?></p>
            <hr>
            <h2>Total: $<?php echo $total_registrado ?></h2>
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