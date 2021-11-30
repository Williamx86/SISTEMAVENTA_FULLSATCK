<?php  
    require 'backend/conexion.php';
    session_start();
    $usuario = $_SESSION['username'];
    date_default_timezone_set('America/El_Salvador');
?>

<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style_panel.css">
    <link rel="stylesheet" href="css/style_extras.css">
    <link rel="stylesheet" type="text/css"
    href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.22/b-1.6.5/b-colvis-1.6.5/b-flash-1.6.5/b-html5-1.6.5/b-print-1.6.5/datatables.min.css" />
    <title>Sistema de ventas</title>

</head>

<body>

    <div class="menu_header">
        <div>
            <select class="custom-select" name="select">
                <option value="value1" selected>La Rábida</option>
                <option value="value2">-</option>
                <option value="value3">-</option>
            </select>
        </div>
        <div class="menu_salir">
            <span><?php echo $usuario ?></span>
            <a class="btn_salir" href="salir.php"><img src="img/salir_rojo.svg" alt=""></a>
        </div>
    </div>

    <?php
        $consulta_user = "SELECT * FROM usuarios WHERE nombre = '$usuario' ";
        $resultado_user =  mysqli_query($conexion,$consulta_user);

        while($mostrar = mysqli_fetch_array($resultado_user)){
            $tipo = $mostrar['tipo'];
        }

        if($tipo == "Master"){
            echo '
                <div class="menu_panel">
                <div class="menu_botones">
                    <a href="panel.php">
                        <img src="img/home.svg">
                        <span>Inicio</span>
                    </a>
                    <a href="agregar_venta.php">
                        <img src="img/ventas.svg">
                        <span>Ventas</span>
                    </a>
                    <a href="compras.php">
                        <img src="img/compras.svg">
                        <span>Compras</span>
                    </a>
                    <a href="precios.php">
                        <img src="img/precios.svg">
                        <span>Precios</span>
                    </a>
                    <a href="reportes.php">
                        <img src="img/reportes.svg">
                        <span>Reportes</span>
                    </a>
                    <a href="bodegas.php">
                        <img src="img/bodegas.svg">
                        <span>Bodegas</span>
                    </a>
                    <a href="accesos.php">
                        <img src="img/accesos.svg">
                        <span>Accesos</span>
                    </a>
                </div>
                <div class="menu_salir_panel">
                    <button id="salir"><img src="img/salir_azul.svg"></button>
                </div>
            </div>
            ';
        }elseif($tipo == "Cajero"){
            echo '
                <div class="menu_panel">
                <div class="menu_botones">
                    <a href="panel.php">
                        <img src="img/home.svg">
                        <span>Inicio</span>
                    </a>
                    <a href="agregar_venta.php">
                        <img src="img/ventas.svg">
                        <span>Ventas</span>
                    </a>
                </div>
                <div class="menu_salir_panel">
                    <button id="salir"><img src="img/salir_azul.svg"></button>
                </div>
            </div>
            ';
        }elseif($tipo == "Gerente"){
            echo '
                <div class="menu_panel">
                <div class="menu_botones">
                    <a href="panel.php">
                        <img src="img/home.svg">
                        <span>Inicio</span>
                    </a>
                    <a href="agregar_venta.php">
                        <img src="img/ventas.svg">
                        <span>Ventas</span>
                    </a>
                    <a href="compras.php">
                        <img src="img/compras.svg">
                        <span>Compras</span>
                    </a>
                    <a href="bodegas.php">
                        <img src="img/bodegas.svg">
                        <span>Bodegas</span>
                    </a>
                </div>
                <div class="menu_salir_panel">
                    <button id="salir"><img src="img/salir_azul.svg"></button>
                </div>
            </div>
            ';
        }elseif($tipo == "Admin"){
            echo '
                <div class="menu_panel">
                <div class="menu_botones">
                    <a href="panel.php">
                        <img src="img/home.svg">
                        <span>Inicio</span>
                    </a>
                    <a href="agregar_venta.php">
                        <img src="img/ventas.svg">
                        <span>Ventas</span>
                    </a>
                    <a href="compras.php">
                        <img src="img/compras.svg">
                        <span>Compras</span>
                    </a>
                    <a href="precios.php">
                        <img src="img/precios.svg">
                        <span>Precios</span>
                    </a>
                    <a href="reportes.php">
                        <img src="img/reportes.svg">
                        <span>Reportes</span>
                    </a>
                    <a href="bodegas.php">
                        <img src="img/bodegas.svg">
                        <span>Bodegas</span>
                    </a>
                </div>
                <div class="menu_salir_panel">
                    <button id="salir"><img src="img/salir_azul.svg"></button>
                </div>
            </div>
            ';
        }
    ?>

    <!--Codigo para titulos y selectores de fechas-->
    <div class="panel_contenido">
        <div class="container">
            <div class="row justify-content-around">
                <div class="col-11 pt-5">
                    <div class="panel_inicio">
                        <div class="texto_inicio">
                            <h3>Resumén Ventas</h3>
                        </div>
                        <div class="selectores_inicio">
                            <a href="panel.php">Hoy</a>
                            <a href="panel_ayer.php" class="selectores_inicio_activo">Ayer</a>
                            <a href="panel_all.php">Últimos 30 días</a>
                        </div>
                    </div>
                    <img class="raya_panel" src="img/raya_panel.svg">
                </div>
                <!--Codigo para titulos y selectores de fechas-->

                <div class="col-12 col-md-5 pt-4">
                    <canvas id="myChart"></canvas>
                </div>

                <?php
                    $fecha = date("Y-m-d", strtotime('-1 day', time()));
                    $fecha_string = strval($fecha);

                    $consulta_dos = "SELECT SUM(total) AS total_ventas FROM ventas WHERE metodo = 'Bitcoin' AND fecha = '$fecha' OR metodo = 'Débito' AND fecha = '$fecha'  OR metodo = 'Crédito' AND fecha = '$fecha'  OR metodo = 'Efectivo' AND fecha = '$fecha' ";
                    $resultado =  mysqli_query($conexion,$consulta_dos);

                    while($mostrar = mysqli_fetch_array($resultado)){
                        $total_ventas = $mostrar['total_ventas'];
                    }
                ?>

                <?php
                    $ventas = array();
                    $consulta_media = "SELECT * FROM ventas WHERE metodo = 'Bitcoin' AND fecha = '$fecha' OR metodo = 'Débito' AND fecha = '$fecha'  OR metodo = 'Crédito' AND fecha = '$fecha'  OR metodo = 'Efectivo' AND fecha = '$fecha'";
                    $resultado_media =  mysqli_query($conexion,$consulta_media);

                    while($mostrar = mysqli_fetch_array($resultado_media)){
                ?> 

                <?php array_push($ventas,$mostrar['id']) ?>

                <?php       
                    }
                ?>

                <div class="col-12 col-md-5 pt-4">
                    <div class="btn_datos">
                        <div class="datos_promedio shadow mb-4">
                            <img src="img/ventas.svg">
                            <div>
                                <h4>Venta total</h4>
                                <span>$ <?php if(!empty($total_ventas)){echo $total_ventas;}else{echo "0.00";} ?></span>
                            </div>
                        </div>
                        <div class="datos_promedio shadow">
                            <img src="img/ticket.svg">
                            <div>
                                <h4>Ticket promedio</h4>
                                <span>$ <?php if(!empty($total_ventas)){echo round($total_ventas / count($ventas), 2);}else{echo "0.00";} ?></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-11 pt-5">
                    <div class="botones_principales">
                        <div class="contenedor_botones">
                            <a href="agregar_venta.php">
                                <img src="img/ventas.svg">
                            </a>
<span>Agregar 
venta</span>
                        </div>
                        <div class="contenedor_botones">
                            <a href="compras.php">
                                <img src="img/compras.svg">
                            </a>
<span>Agregar 
compra</span>
                        </div>
                        <div class="contenedor_botones">
                            <a href="reportes.php">
                                <img src="img/reportes.svg">
                            </a>
<span>Descargar 
reporte</span>
                        </div>
                        <div class="contenedor_botones">
                            <a href="bodegas.php">
                                <img src="img/bodegas.svg">
                            </a>
<span>Ver
bodega</span>
                        </div>
                    </div>
                </div>

                <div class="col-11 py-5">
                    <table id="dt" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>Acciones</th>
                                <th>Correlativo</th>
                                <th>Cliente</th>
                                <th>Metodo</th>
                                <th>Fecha</th>
                                <th>Hora</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php
                            $consulta = "SELECT * FROM ventas WHERE metodo = 'Bitcoin' AND fecha = '$fecha' OR metodo = 'Débito' AND fecha = '$fecha'  OR metodo = 'Crédito' AND fecha = '$fecha'  OR metodo = 'Efectivo' AND fecha = '$fecha' order by id desc";
                            $resultado =  mysqli_query($conexion,$consulta);

                            while($mostrar = mysqli_fetch_array($resultado)){
                        ?> 

                            <tr>
                                <td>
                                    <div class="acciones_botones">
                                        <a class="btn_accion_azul" href="backend/ticket_venta.php?id=<?php echo $mostrar['id'] ?>">
                                            <img src="img/papel_cortado.svg">
                                        </a> 
                                    </div>
                                </td>
                                <td>
                                    <?php echo $mostrar['id'] ?>
                                </td>
                                <td>
                                    <?php echo $mostrar['cliente'] ?>
                                </td>
                                <td>
                                    <?php echo $mostrar['metodo'] ?>
                                </td>
                                <td>
                                    <?php echo $mostrar['fecha'] ?>
                                </td>
                                <td>
                                    <?php echo $mostrar['hora'] ?>
                                </td>
                                <td>
                                    <?php echo $mostrar['total'] ?>
                                </td>
                            </tr>

                        <?php       
                            }
                        ?>

                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.0/chart.min.js"
        integrity="sha512-GMGzUEevhWh8Tc/njS0bDpwgxdCJLQBWG3Z2Ct+JGOpVnEmjvNx6ts4v6A2XJf1HOrtOsfhv3hBKpK9kE5z8AQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript"
    src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.22/b-1.6.5/b-colvis-1.6.5/b-flash-1.6.5/b-html5-1.6.5/b-print-1.6.5/datatables.min.js">
    </script> 
    <script src="js/app.js"></script>
    <script>

        var url = 'consultapanel.php?fecha=ayer';
        fetch(url)
            .then(res => res.json())
            .then(datos => {
                var urlcorr = 'consultacorr.php?fecha=ayer';
                fetch(urlcorr)
                    .then(resp => resp.json())
                    .then(corr => {

                        //Aqui definimos el array de nombres o labels
                        var uno = [];
                        for (let valor of corr) {
                            uno.push(valor.hora);
                        }

                        //Aqui definimos el array de datos
                        var dos = [];
                        for (let valores of datos) {
                            dos.push(valores.total);
                        }

                        const ctx = document.getElementById('myChart');
                        const myChart = new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: uno,
                                datasets: [{
                                    label: 'Precio de la venta [$]',
                                    data: dos,
                                    backgroundColor: [
                                        'rgba(44, 127, 194, 1)'
                                    ],
                                    borderColor: [
                                        'rgba(44, 127, 194, 1)'
                                    ],
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            }
                        }) //Aqui termina el grafico
                    })
            })
    </script>
    <script>
        $(document).ready(function() {
            $('#dt').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'excel', 'pdf'
                ],
                pageLength: 4,
                language: {
                    "decimal": "",
                    "emptyTable": "No hay información",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                    "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                    "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "Mostrar _MENU_ Entradas",
                    "loadingRecords": "Cargando...",
                    "processing": "Procesando...",
                    "search": "Buscar:",
                    "zeroRecords": "Sin resultados encontrados",
                    "paginate": {
                        "first": "Primero",
                        "last": "Ultimo",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                },
            });
        });
    </script>

</body>

</html>