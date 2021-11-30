<?php
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

    <!--Codigo para titulos y selectores de fechas-->
    <div class="panel_contenido">
        <div class="container">
            <div class="row justify-content-around">
                <div class="col-11 pt-5">
                    <div class="panel_inicio">
                        <div class="texto_inicio">
                            <h3>Agregar compra</h3>
                        </div>
                    </div>
                    <img class="raya_panel" src="img/raya_panel.svg">
                </div>
                <!--Codigo para titulos y selectores de fechas-->

                <div class="col-11 pt-4">
                    <div class="botones_principales_menus">
                        <a class="shadow" href="#" data-bs-toggle="modal" data-bs-target="#Proveedor">
                            <img src="img/simbolo_mas.svg">
                            <span>Agregar proveedor</span>
                        </a>
                    </div>
                </div>

                <div class="col-11 pt-5">
                    <div class="botones_grandes_menu">
                        <a href="agregar_compra_proveedor.php">
                            <img src="img/compras.svg">
                            <span>Compra proveedor</span>
                        </a>

                        <a href="agregar_compra_sucursal.php">
                            <img src="img/compras.svg">
                            <span>Compra a sucursal</span>
                        </a>

                        <a class="btn_relleno" href="#">
                            <img src="img/sucursal.svg">
                            <span>Entrada de sucursal</span>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>

        <!-- Modal Agregar Proveedor-->
        <div class="modal fade" id="Proveedor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLabel">Agregar proveedor</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="row justify-content-around">
                                <div class="col-11">
                                    <form action="backend/c_proveedor.php" method="POST" class="formulario_general">
                                        <div class="entrada pt-5">
                                            <div>
                                                <div class="info_desplegable">
                                                    <img src="img/info.svg" tabindex="0" data-bs-toggle="popover" data-bs-placement="left" data-bs-trigger="hover focus" data-bs-content="Es el número de registro del contribuyente. Si no existe, colocar el valor  “0”." data-bs-original-title="NRC" aria-label="NRC">
                                                    <label class="mb-2">NRC:</label>
                                                </div>
                                                <input class="input_modificado input_modificado_sm" type="text" name="nrc">
                                            </div>
    
                                            <div>
                                                <label class="mb-2">Nombre de la empresa:</label>
                                                <input class="input_modificado input_modificado_xl" type="text" name="nombre">
                                            </div>
                                        </div>
    
                                        <div class="entrada_mod pt-5 pb-5">
                                            <div>
                                                <label class="mb-2">Contacto de la empresa:</label>
                                                <input class="input_modificado input_modificado_sm" type="text" name="contacto">
                                            </div>
    
                                            <div>
                                                <label class="mb-2">Número de contacto:</label>
                                                <input class="input_modificado" type="text" name="numero">
                                            </div>
                                        </div>
    
                                        <div class="botones_formulario pt-4 pb-4">
                                            <a class="shadow" href="#" data-bs-dismiss="modal">
                                                <img src="img/cancelar.svg" alt="">
                                                <span>Cancelar</span>
                                            </a>
                                            <button type="submit" class="shadow">
                                                <img src="img/guardar.svg" alt="">
                                                <span>Guardar</span>
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
        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
        var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl)
        })
    </script>

    <?php
        $correcto = $_GET['correcto'];
        if($correcto){
            echo '<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
            Swal.fire(
                "Acción realizada",
                "Correctamente",
                "success"
            )
            </script>';
        }
    ?>

</body>

</html>