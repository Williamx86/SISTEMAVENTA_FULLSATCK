<?php  
    require 'backend/conexion.php';
    session_start();
    $usuario = $_SESSION['username'];
?>

<?php
    $id = $_GET['id'];
    $consulta = "SELECT * FROM compras WHERE id = '$id'";
    $resultado =  mysqli_query($conexion,$consulta);

    while($mostrar = mysqli_fetch_array($resultado)){
        $numero = $mostrar['numero'];
        $total = $mostrar['total'];
    }
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
                            <h3>información compra</h3>
                        </div>
                    </div>
                    <img class="raya_panel" src="img/raya_panel.svg">
                </div>

                <!--Codigo para titulos y selectores de fechas-->

                <div class="col-11 pt-4">

                        <div class="formulario_compras pb-4">
                            <div class="entradas-formulario_compra">
                                <label>Número de comprobante:</label>
                                <input type="text" name="numero" value="<?php echo $numero ?>" readonly>
                            </div>
                        </div>

                        <div class="py-5">
                            <table class="tabla_compras">
                                <thead>
                                    <tr>
                                        <th>Producto</th>
                                        <th>Unidad</th>
                                    </tr>
                                </thead>

                                <tbody id="agregar_productos_compra_aqui">

                                <?php
                                    $consulta_dos = "SELECT * FROM productos_compra WHERE id_compra = '$id' ";
                                    $resultado_dos =  mysqli_query($conexion,$consulta_dos);

                                    while($mostrar_dos = mysqli_fetch_array($resultado_dos)){
                                ?> 

                                    <tr>
                                        <td><?php echo $mostrar_dos['nombre'] ?></td>
                                        <td><?php echo $mostrar_dos['cantidad'] ?></td>
                                    </tr>

                                <?php       
                                    }
                                ?>

                                </tbody>

                            </table>
                        </div>

                        <div class="formulario_compras py-3">
                            <div class="entradas-formulario_compra">
                                <label>Valor en dólares ($) :</label>
                                <input id="total_pintar" type="number" name="total" step="0.01" value="<?php echo $total ?>" readonly>
                            </div>
                        </div>

                        <div class="botones_principales_menus modificado_rojo pt-3 pb-5">
                            <a class="shadow" href="reporte_compras.php">
                                <img src="img/salir_rojo.svg">
                                <span>Regresar</span>
                            </a>
                        </div>

                </div>

            </div>
        </div>
    </div>

        <!-- Modal Lacteos -->
        <div class="modal fade" id="Lacteos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Productos</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row justify-content-around">
                            <div class="col-11 pt-3 pb-4">
                                <table id="dt" class="display" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Acciones</th>
                                            <th>SKU</th>
                                            <th>Producto</th>
                                            <th>Unidad</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php
                                        $consulta = "SELECT * FROM bodega_lacteos";
                                        $resultado =  mysqli_query($conexion,$consulta);
                                        $identificador_unidad = 343;
                                        $identificador_precio = 716;

                                        while($mostrar = mysqli_fetch_array($resultado)){
                                    ?> 

                                        <?php $identificador_unidad+=1 ?>
                                        <?php $identificador_precio+=1 ?>
                                        <tr>
                                            <td>
                                                <div class="acciones_botones">
                                                    <a class="btn_accion_azul" onclick="agregar_producto_sucursal('<?php echo $mostrar['nombre'] ?>','<?php echo $mostrar['sku'] ?>',<?php echo $identificador_unidad ?>)" href="#">
                                                        <img src="img/btn_mas.svg">
                                                    </a>
                                                </div>
                                            </td>
                                            <td>
                                                <?php echo $mostrar['sku'] ?>
                                            </td>
                                            <td>
                                                <?php echo $mostrar['nombre'] ?>
                                            </td>
                                            <td class="cantidad_producto_mod">
                                                <button class="btne_agregar" type="button" onclick="incrementar('<?php echo $identificador_unidad ?>')">
                                                    <div class="contenedor_bte">
                                                        <img src="img/add.png">
                                                    </div>
                                                </button>

                                                <input id="<?php echo $identificador_unidad ?>" type="number" step="0.01" value="1">

                                                <button class="btne_quitar" type="button" onclick="reducir('<?php echo $identificador_unidad ?>')">
                                                    <div class="contenedor_bte">
                                                        <img src="img/subs.png">
                                                    </div>
                                                </button>
                                            </td>
                                        </tr>

                                    <?php       
                                        }
                                    ?>

                                    <?php
                                        $consulta_abarrotes = "SELECT * FROM bodega_abarrotes";
                                        $resultado_abarrotes =  mysqli_query($conexion,$consulta_abarrotes);

                                        while($mostrar = mysqli_fetch_array($resultado_abarrotes)){
                                    ?> 

                                        <?php $identificador_unidad+=1 ?>
                                        <?php $identificador_precio+=1 ?>

                                        <tr>
                                            <td>
                                                <div class="acciones_botones">
                                                    <a class="btn_accion_azul" onclick="agregar_producto_sucursal('<?php echo $mostrar['nombre'] ?>','<?php echo $mostrar['sku'] ?>',<?php echo $identificador_unidad ?>)" href="#">
                                                        <img src="img/btn_mas.svg">
                                                    </a>
                                                </div>
                                            </td>
                                            <td>
                                                <?php echo $mostrar['sku'] ?>
                                            </td>
                                            <td>
                                                <?php echo $mostrar['nombre'] ?>
                                            </td>
                                            <td class="cantidad_producto_mod">
                                                <button class="btne_agregar" type="button" onclick="incrementar('<?php echo $identificador_unidad ?>')">
                                                    <div class="contenedor_bte">
                                                        <img src="img/add.png">
                                                    </div>
                                                </button>

                                                <input id="<?php echo $identificador_unidad ?>" type="number" step="0.01" value="1">

                                                <button class="btne_quitar" type="button" onclick="reducir('<?php echo $identificador_unidad ?>')">
                                                    <div class="contenedor_bte">
                                                        <img src="img/subs.png">
                                                    </div>
                                                </button>
                                            </td>
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
                                            <th>Unidad</th>
                                        </tr>
                                    </tfoot>
                                </table>
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

    <script>
        $(document).ready(function () {
            $('#dt').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'excel',
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