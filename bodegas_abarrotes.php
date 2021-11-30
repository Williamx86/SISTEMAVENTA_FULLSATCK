<?php  
    require 'backend/conexion.php';
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
                            <h3>Bodega - Abarrotes</h3>
                        </div>
                    </div>
                    <img class="raya_panel" src="img/raya_panel.svg">
                </div>
                <!--Codigo para titulos y selectores de fechas-->

                <div class="col-11 pt-4">
                    <div class="botones_principales_menus">
                        <a class="shadow" href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <img src="img/simbolo_mas.svg">
                            <span>Agregar producto</span>
                        </a>
                    </div>
                </div>

                <div class="col-11 py-5">
                    <table id="dt" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>Acciones</th>
                                <th>SKU</th>
                                <th>Producto</th>
                                <th>Stock</th>
                                <th>Precio por unidad</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php
                            $consulta = "SELECT * FROM bodega_abarrotes order by id desc";
                            $resultado =  mysqli_query($conexion,$consulta);

                            while($mostrar = mysqli_fetch_array($resultado)){
                        ?> 

                            <tr>
                                <td>
                                    <div class="acciones_botones">
                                        <a class="btn_accion_amarillo" onclick="editar_bodega_lacteos('<?php echo $mostrar['sku'] ?>','<?php echo $mostrar['nombre'] ?>',<?php echo $mostrar['stock'] ?>,<?php echo $mostrar['precio_compra'] ?>,<?php echo $mostrar['id'] ?>)" href="#" data-bs-toggle="modal" data-bs-target="#Editarproducto">
                                            <img src="img/lapiz.svg">
                                        </a>
                                        <a class="btn_accion_rojo" href="backend/d_bodega_abarrotes.php?id=<?php echo $mostrar['id'] ?>">
                                            <img src="img/basurero.svg">
                                        </a>
                                    </div>
                                </td>
                                <td>
                                    <?php echo $mostrar['sku'] ?>
                                </td>
                                <td>
                                    <?php echo $mostrar['nombre'] ?>
                                </td>
                                <td>
                                    <?php echo $mostrar['stock'] ?>
                                </td>
                                <td>$<?php echo $mostrar['precio_compra'] ?></td>
                                <td>$<?php echo $mostrar['precio_compra']*$mostrar['stock'] ?></td>
                            </tr>

                        <?php       
                            }
                        ?>

                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Acciones</th>
                                <th>SKU</th>
                                <th>Producto</th>
                                <th>Stock</th>
                                <th>Precio por unidad</th>
                                <th>Total</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>

            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Bodega - Abarrotes - Agregar producto</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row justify-content-around">
                            <div class="col-11">
                                <form action="backend/c_bodega_abarrotes.php" method="POST" class="formulario_general">
                                    <div class="entrada pt-5">
                                        <div>
                                            <label class="mb-2">SKU:</label>
                                            <input class="input_modificado input_modificado_sm" type="text" name="sku">
                                        </div>

                                        <div>
                                            <label class="mb-2">Producto:</label>
                                            <input class="input_modificado input_modificado_xl" type="text" name="nombre">
                                        </div>
                                    </div>

                                    <div class="entrada_mod pt-5 pb-5">
                                        <!-- <div>
                                            <label class="mb-2">Tipo de cliente:</label>
                                            <select class="input_modificado input_modificado_sm" name="select">
                                                <option value="value1" selected>Value 1</option>
                                                <option value="value2">Value 2</option>
                                                <option value="value3">Value 3</option>
                                            </select>
                                        </div> -->

                                        <div>
                                            <label class="mb-2">Stock:</label>
                                            <input class="input_modificado" type="number" name="stock" step="0.01">
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

    <div class="modal fade" id="Editarproducto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Bodega - Abarrotes - Editar producto</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row justify-content-around">
                            <div class="col-11">
                                <form action="backend/u_bodega_abarrotes.php" method="POST" class="formulario_general">
                                    <div class="entrada pt-5">
                                        <div>
                                            <label class="mb-2">SKU:</label>
                                            <input class="input_modificado input_modificado_sm editar_bodega_lacteos_sku" type="text" name="sku_editar">
                                            <input class="editar_bodega_lacteos_id" type="hidden" name="id_editar">
                                        </div>

                                        <div>
                                            <label class="mb-2">Producto:</label>
                                            <input class="input_modificado input_modificado_xl editar_bodega_lacteos_nombre" type="text" name="nombre_editar">
                                        </div>
                                    </div>

                                    <div class="entrada_mod pt-5 pb-5">
                                        <!-- <div>
                                            <label class="mb-2">Tipo de cliente:</label>
                                            <select class="input_modificado input_modificado_sm" name="select">
                                                <option value="value1" selected>Value 1</option>
                                                <option value="value2">Value 2</option>
                                                <option value="value3">Value 3</option>
                                            </select>
                                        </div> -->

                                        <div>
                                            <label class="mb-2">Stock:</label>
                                            <input class="input_modificado editar_bodega_lacteos_stock" type="number" name="stock_editar">
                                        </div>

                                        <div>
                                            <label class="mb-2">Precio por unidad:</label>
                                            <input class="input_modificado editar_bodega_lacteos_precio" type="number" step="0.01" name="precio_compra">
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
    <script src="js/funciones.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function () {
            $('#dt').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'excel', 'pdf'
                ],
                pageLength: 7,
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