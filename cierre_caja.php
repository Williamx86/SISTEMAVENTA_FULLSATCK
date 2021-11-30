<?php  
    require 'backend/conexion.php';
    date_default_timezone_set('America/El_Salvador');
    session_start();
    $usuario = $_SESSION['username'];
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
    <link rel="stylesheet" href="css/style_ventas.css">
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
                            <h3>Cierre de caja</h3>
                        </div>
                    </div>
                    <img class="raya_panel" src="img/raya_panel.svg">
                </div>
                <!--Codigo para titulos y selectores de fechas-->

                <div class="col-11 pt-4">
                    <form action="backend/procesar_caja.php" method="POST">
                        <div class="formulario_caja">
                            <div>
                                <h5>Billetes</h5>
                                <div class="campos_caja">
                                    <div class="pt-2">
                                        <label>$ 100</label>
                                        <input class="input_datos_caja" id="b_cien" type="number" name="b_cien" onclick="calcular_total_r()" onkeyup="calcular_total_r()" onkeydown="calcular_total_r()">
                                    </div>
                                    <div class="pt-2">
                                        <label>$ 50</label>
                                        <input class="input_datos_caja" id="b_cincuenta" type="number" name="b_cincuenta" onclick="calcular_total_r()" onkeyup="calcular_total_r()" onkeydown="calcular_total_r()">
                                    </div>
                                    <div class="pt-2">
                                        <label>$ 20</label>
                                        <input class="input_datos_caja" id="b_veinte" type="number" name="b_veinte" onclick="calcular_total_r()" onkeyup="calcular_total_r()" onkeydown="calcular_total_r()">
                                    </div>
                                    <div class="pt-2">
                                        <label>$ 10</label>
                                        <input class="input_datos_caja" id="b_diez" type="number" name="b_diez" onclick="calcular_total_r()" onkeyup="calcular_total_r()" onkeydown="calcular_total_r()">
                                    </div>
                                    <div class="pt-2">
                                        <label>$ 5</label>
                                        <input class="input_datos_caja" id="b_cinco" type="number" name="b_cinco" onclick="calcular_total_r()" onkeyup="calcular_total_r()" onkeydown="calcular_total_r()">
                                    </div>
                                    <div class="pt-2">
                                        <label>$ 1</label>
                                        <input class="input_datos_caja" id="b_uno" type="number" name="b_uno" onclick="calcular_total_r()" onkeyup="calcular_total_r()" onkeydown="calcular_total_r()">
                                    </div>
                                </div>
                            </div>

                            <div>
                                <h5>Monedas</h5>
                                <div class="campos_caja">
                                    <div class="pt-2">
                                        <label>$ 0.25</label>
                                        <input class="input_datos_caja" id="m_cora" type="number" name="m_cora" onclick="calcular_total_r()" onkeyup="calcular_total_r()" onkeydown="calcular_total_r()">
                                    </div>
                                    <div class="pt-2">
                                        <label>$ 0.10</label>
                                        <input class="input_datos_caja" id="m_diez" type="number" name="m_diez" onclick="calcular_total_r()" onkeyup="calcular_total_r()" onkeydown="calcular_total_r()">
                                    </div>
                                    <div class="pt-2">
                                        <label>$ 0.05</label>
                                        <input class="input_datos_caja" id="m_cinco" type="number" name="m_cinco" onclick="calcular_total_r()" onkeyup="calcular_total_r()" onkeydown="calcular_total_r()">
                                    </div>
                                    <div class="pt-2">
                                        <label>$ 0.01</label>
                                        <input class="input_datos_caja" id="m_uno" type="number" name="m_uno" onclick="calcular_total_r()" onkeyup="calcular_total_r()" onkeydown="calcular_total_r()">
                                    </div>
                                    <div class="pt-5 total_final_caja">
                                        <h5>Total caja</h5>
                                        <input class="input_datos_caja_tres" id="total_registrado" type="number" name="total_registrado" step="0.01" readonly>
                                    </div>
                                </div>
                            </div>

                            <?php
                                $fecha = date('Y-m-d');
                                $fecha_string = strval($fecha);

                                $consulta = "SELECT SUM(total) AS total_ventas FROM ventas WHERE fecha = '$fecha_string' AND metodo = 'Efectivo' ";
                                $resultado =  mysqli_query($conexion,$consulta);

                                while($mostrar = mysqli_fetch_array($resultado)){
                                    $total_ventas = $mostrar['total_ventas'];
                                }

                                $consulta_debito = "SELECT SUM(total) AS total_ventas FROM ventas WHERE fecha = '$fecha_string' AND metodo = 'Débito' ";
                                $resultado_debito =  mysqli_query($conexion,$consulta_debito);

                                while($mostrar = mysqli_fetch_array($resultado_debito)){
                                    $total_ventas_debito = $mostrar['total_ventas'];
                                }

                                $consulta_credito = "SELECT SUM(total) AS total_ventas FROM ventas WHERE fecha = '$fecha_string' AND metodo = 'Crédito' ";
                                $resultado_credito =  mysqli_query($conexion,$consulta_credito);

                                while($mostrar = mysqli_fetch_array($resultado_credito)){
                                    $total_ventas_credito = $mostrar['total_ventas'];
                                }

                                $consulta_bitcoin = "SELECT SUM(total) AS total_ventas FROM ventas WHERE fecha = '$fecha_string' AND metodo = 'Bitcoin' ";
                                $resultado_bitcoin =  mysqli_query($conexion,$consulta_bitcoin);

                                while($mostrar = mysqli_fetch_array($resultado_bitcoin)){
                                    $total_ventas_bitcoin = $mostrar['total_ventas'];
                                }

                                $consulta_remesa = "SELECT SUM(total) AS total_ventas FROM remesas WHERE fecha = '$fecha_string'";
                                $resultado_remesa =  mysqli_query($conexion,$consulta_remesa);

                                while($mostrar = mysqli_fetch_array($resultado_remesa)){
                                    $total_ventas_remesas = $mostrar['total_ventas'];
                                }

                                $consulta_compra = "SELECT SUM(total) AS total_ventas FROM compras WHERE fecha = '$fecha_string' AND tipo_pago = 'caja'";
                                $resultado_compra =  mysqli_query($conexion,$consulta_compra);

                                while($mostrar = mysqli_fetch_array($resultado_compra)){
                                    $total_ventas_compra = $mostrar['total_ventas'];
                                }

                            ?>

                            <div>
                                <h5>Cierre</h5>
                                <div class="campos_caja">
                                    <div class="pt-2">
                                        <label>Efectivo</label>
                                        <input class="input_datos_caja_dos" type="number" name="efectivo" value="<?php echo $total_ventas ?>" step="0.01" readonly>
                                    </div>
                                    <div class="pt-3">
                                        <label>Tarjeta</label>
                                        <input class="input_datos_caja_dos" type="number" name="tarjeta" value="<?php echo $total_ventas_credito + $total_ventas_debito ?>" step="0.01" readonly>
                                    </div>
                                    <div class="pt-3">
                                        <label>Bitcoin</label>
                                        <input class="input_datos_caja_dos" type="number" name="bitcoin" value="<?php echo $total_ventas_bitcoin ?>" step="0.01" readonly>
                                    </div>
                                    <div class="pt-3">
                                        <label>Remesa</label>
                                        <input class="input_datos_caja_dos" type="number" name="remesa" value="<?php echo $total_ventas_remesas ?>" step="0.01" readonly>
                                    </div>
                                    <div class="pt-3">
                                        <label>Compras</label>
                                        <input class="input_datos_caja_dos" type="number" name="compra" value="<?php echo $total_ventas_compra ?>" step="0.01" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="cajero" value="<?php echo $usuario ?>">

                        <div class="opciones_cierre_caja">
                            <div class="opciones_cierre_caja_input">
                                <h5>Caja inicial</h5>
                                <a class="btn_accion_amarillo_mod" href="#" data-bs-toggle="modal" data-bs-target="#Modificaja">
                                    <img src="img/lapiz.svg">
                                </a>
                                <input type="number" id="caja_inicial" value="0" readonly>
                            </div>

                            <div class="opciones_cierre_caja_input">
                                <h5>Caja final</h5>
                                <input type="number" value="<?php $total_cierre_final = $total_ventas - $total_ventas_remesas - $total_ventas_compra; if ($total_cierre_final < 0) {echo 0;} else {echo $total_cierre_final;}?>" name="total_final" step="0.01" readonly>
                            </div>

                            <button type="submit" class="shadow">
                                <img src="img/calculadora.svg">
                                <span>Realizar cierre</span>
                            </button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- Modal Modificar Precio -->
    <div class="modal fade" id="Modificaja" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Modificar caja</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">

                        <div id="pedir_password" class="row justify-content-around">
                            <div class="col-10">
                                <form action="#" class="formulario_general">
                                    <div class="agregar_dinero py-4">
                                        <h5>Contraseña</h5>
                                        <input id="password_usuario_admin" type="password">
                                    </div>

                                    <div class="botones_formulario pt-4 pb-4">
                                        <a class="shadow" href="#" data-bs-dismiss="modal">
                                            <img src="img/cancelar.svg" alt="">
                                            <span>Cancelar</span>
                                        </a>
                                        <button type="button" class="shadow" onclick="solicitud()" data-bs-dismiss="modal">
                                            <img src="img/aplicar.svg" alt="">
                                            <span>Aplicar</span>
                                        </button>
                                    </div>

                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
    <script src="js/cierre.js"></script>

</body>

</html>