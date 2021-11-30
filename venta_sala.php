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
    <link rel="stylesheet" href="css/style_ventas.css">
    <link rel="stylesheet" href="css/style_extras.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.22/b-1.6.5/b-colvis-1.6.5/b-flash-1.6.5/b-html5-1.6.5/b-print-1.6.5/datatables.min.css" />
    <title>Ventas</title>
</head>

<body>

    <div class="ticket_venta">
        <div class="informacion_ticket">
            <h3>Tienda de abarrotes y lácteos</h3>
            <h4>Sucursal - La Rábida</h4>
            <!-- <p>Ticket No. -</p> -->
            <p>Vendedor: <?php echo $usuario ?></p>
        </div>
        <div class="cuerpo_ticket">

            <form id="productosform" action="backend/procesar_venta.php" method="POST">
                <table>
                    <thead>
                        <tr>
                            <th>Unid.</th>
                            <th>Descripción</th>
                            <th>Precio de unidad</th>
                            <th>Importe</th>
                        </tr>
                    </thead>
                    <tbody class="agregar_productos_aqui">

                    </tbody>
                    <div>
                        <input id="total_venta" type="hidden" name="total">
                        <input id="metodo_pago" type="hidden" name="metodo">
                        <input id="cambio" type="hidden" name="cambio" value="0">
                        <input type="hidden" name="cliente" value="Sala">
                    </div>
                </table>
            </form>
        </div>
        <div class="final_ticket">
            <h3>Total Neto: $ <span id="total_pintar"></span></h3>
            <div class="metodo_ticket">
                <p>Método de pago:</p>
                <input readonly id="metodo_pago_pantalla" type="text">
                <button type="button" onclick="eliminar_metodo()">
                    <img src="img/basurero.svg">
                </button>
            </div>
            <p>Cambio: $ <span id="cambio_pantalla"></span> </p>
            <p class="agradecimiento">¡Gracias por su compra!</p>
        </div>
    </div>
    <div class="opciones_venta">
        <div class="botonera_superior">
            <div class="unidos">
                <a class="botones_vender shadow alejado" href="#" data-bs-toggle="modal" data-bs-target="#Lacteos">
                    <img src="img/queso_azul.svg">
                    <span>Lacteos</span>
                </a>

                <a class="botones_vender shadow" href="#" data-bs-toggle="modal" data-bs-target="#Abarrotes">
                    <img src="img/tomate_azul.svg">
                    <span>Abarrotes</span>
                </a>
            </div>
            <div>
                <a class="botones_vender shadow" href="#" data-bs-toggle="modal" data-bs-target="#Descuentos">
                    <img src="img/descuento-amarillo.svg">
                    <span class="black_desc">Descuentos</span>
                </a>
            </div>
        </div>

        <div class="botonera_inferior">
            <a class="botones_vender shadow alejado" href="#" data-bs-toggle="modal" data-bs-target="#Tarjeta">
                <img src="img/tarjeta.svg">
                <span>Tarjeta</span>
            </a>

            <a class="botones_vender shadow" href="#" data-bs-toggle="modal" data-bs-target="#Efectivo">
                <img src="img/dinero_azul.svg">
                <span>Efectivo</span>
            </a>
        </div>

        <div class="opcion_imprimir">
            <button type="submit" form="productosform" class="shadow">
                <img src="img/impresora.svg">
                <span>Realizar venta</span>
            </button>
        </div>
    </div>

    <!-- Modal Lacteos -->
    <div class="modal fade" id="Lacteos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Lacteos</h4>
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
                                            <th>Precio de unidad</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php
                                        $consulta = "SELECT * FROM bodega_lacteos";
                                        $resultado =  mysqli_query($conexion,$consulta);
                                        $identificador_unidad = 343;

                                        while($mostrar = mysqli_fetch_array($resultado)){
                                    ?> 

                                        <?php $identificador_unidad+=1 ?>

                                        <tr>
                                            <td>
                                                <div class="acciones_botones">
                                                    <a class="btn_accion_azul btn_modificado" onclick="agregar_producto('<?php echo $mostrar['nombre'] ?>',<?php echo $mostrar['precio_sala'] ?>,<?php echo $identificador_unidad ?>)" href="#">
                                                        <img src="img/btn_mas.svg">
                                                        <div class="texto_agregar">
                                                            <span>Agregar</span>
                                                        </div>
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
                                                <button class="btne_quitar" type="button" onclick="reducir('<?php echo $identificador_unidad ?>')">
                                                    <div class="contenedor_bte">
                                                        <img src="img/subs.png">
                                                    </div>
                                                </button>

                                                <input id="<?php echo $identificador_unidad ?>" type="number" step="0.01" value="1">

                                                <button class="btne_agregar" type="button" onclick="incrementar('<?php echo $identificador_unidad ?>')">
                                                    <div class="contenedor_bte">
                                                        <img src="img/add.png">
                                                    </div>
                                                </button>
                                            </td>
                                            <td>
                                                <?php echo $mostrar['precio_sala'] ?>
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
                                            <th>Precio de unidad</th>
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

    <!-- Modal Abarrotes -->
    <div class="modal fade" id="Abarrotes" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Abarrotes</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row justify-content-around">
                            <div class="col-11 pt-3 pb-4">
                                <table id="dt_dos" class="display" style="width:100%">
                                <thead>
                                        <tr>
                                            <th>Acciones</th>
                                            <th>SKU</th>
                                            <th>Producto</th>
                                            <th>Unidad</th>
                                            <th>Precio de unidad</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php
                                        $consulta = "SELECT * FROM bodega_abarrotes";
                                        $resultado =  mysqli_query($conexion,$consulta);
                                        $identificador_unidad = 843;

                                        while($mostrar = mysqli_fetch_array($resultado)){
                                    ?> 

                                        <?php $identificador_unidad+=1 ?>

                                        <tr>
                                            <td>
                                                <div class="acciones_botones">
                                                    <a class="btn_accion_azul btn_modificado" onclick="agregar_producto('<?php echo $mostrar['nombre'] ?>',<?php echo $mostrar['precio_sala'] ?>,<?php echo $identificador_unidad ?>)" href="#">
                                                        <img src="img/btn_mas.svg">
                                                        <div class="texto_agregar">
                                                            <span>Agregar</span>
                                                        </div>
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
                                                <button class="btne_quitar" type="button" onclick="reducir('<?php echo $identificador_unidad ?>')">
                                                    <div class="contenedor_bte">
                                                        <img src="img/subs.png">
                                                    </div>
                                                </button>

                                                <input id="<?php echo $identificador_unidad ?>" type="number" step="0.01" value="1">

                                                <button class="btne_agregar" type="button" onclick="incrementar('<?php echo $identificador_unidad ?>')">
                                                    <div class="contenedor_bte">
                                                        <img src="img/add.png">
                                                    </div>
                                                </button>
                                            </td>
                                            <td>
                                                <?php echo $mostrar['precio_sala'] ?>
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
                                            <th>Precio de unidad</th>
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

    <!-- Modal Descuentos -->
    <div class="modal fade" id="Descuentos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Descuento</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">

                        <div id="pedir_password" class="row justify-content-around">
                            <div class="col-10">
                                <form action="#" class="formulario_general">
                                    <div class="agregar_dinero py-4">
                                        <h5>Contraseña</h5>
                                        <input id="password_usuario" type="password">
                                    </div>

                                    <div class="botones_formulario pt-4 pb-4">
                                        <a class="shadow" href="#" data-bs-dismiss="modal">
                                            <img src="img/cancelar.svg" alt="">
                                            <span>Cancelar</span>
                                        </a>
                                        <button type="button" class="shadow" onclick="descuento()">
                                            <img src="img/aplicar.svg" alt="">
                                            <span>Aplicar</span>
                                        </button>
                                    </div>

                                </form>
                            </div>
                        </div>

                        <div id="mostrar_descuentos" class="row justify-content-around no_disponible">
                            <div class="col-10 pt-4 pb-4">
                                <div>
                                    <h5>Descuento en porcentaje (%)</h5>
                                    <div class="tipo_de-descuento">
                                        <input id="porcentaje" type="number" step="0.01">
                                        <a href="#" onclick="descuento_porcentaje()" data-bs-dismiss="modal">
                                            <img src="img/aplicar.svg" alt="">
                                            <span>Aplicar</span>
                                        </a>
                                    </div>
                                    <small>*No ingresar símbolos</small>
                                </div>

                                <div class="pt-5">
                                    <h5>Descuento en efectivo ($)</h5>
                                    <div class="tipo_de-descuento">
                                        <input id="descuento_efe" type="number" step="0.01">
                                        <a href="#" onclick="descuento_efectivo()" data-bs-dismiss="modal">
                                            <img src="img/aplicar.svg" alt="">
                                            <span>Aplicar</span>
                                        </a>
                                    </div>
                                    <small>*No ingresar símbolos</small>
                                </div>

                                <div class="pt-5">
                                    <h5>Cambiar total de la venta</h5>
                                    <div class="tipo_de-descuento">
                                        <input id="nuevo_total" type="number" step="0.01" placeholder="Ingrese el nuevo total">
                                        <a href="#" onclick="cambiar_total()" data-bs-dismiss="modal">
                                            <img src="img/aplicar.svg" alt="">
                                            <span>Aplicar</span>
                                        </a>
                                    </div>
                                    <small>*No ingresar símbolos</small>
                                </div>

                                <div class="pt-4 pb-3 total_neto_final_d">
                                    <a class="shadow" href="#" data-bs-dismiss="modal">
                                        <img src="img/cancelar.svg" alt="">
                                        <span>Cancelar</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <!-- Modal Modificar Precio -->
        <div class="modal fade" id="Modificarprecio" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Modificar Precio</h4>
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

    <!-- Modal Tarjeta -->
    <div class="modal fade" id="Tarjeta" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Tarjeta de crédito o débito</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row justify-content-around">
                            <div class="col-11 pt-4 pb-4 metodos_de_pago_cont">
                                <div class="metodos_de_pago">
                                    <h5>Crédito</h5>
                                    <a onclick="agregar_metodo('Crédito')" href="#" data-bs-dismiss="modal" aria-label="Close">
                                        <img src="img/btn_mas.svg">
                                        <span>Agregar</span>
                                    </a>
                                </div>
                                <div class="metodos_de_pago">
                                    <h5>Débito</h5>
                                    <a onclick="agregar_metodo('Débito')" href="#" data-bs-dismiss="modal" aria-label="Close">
                                        <img src="img/btn_mas.svg">
                                        <span>Agregar</span>
                                    </a>
                                </div>
                                <div class="metodos_de_pago">
                                    <h5>Bitcoin</h5>
                                    <a onclick="agregar_metodo('Bitcoin')" href="#" data-bs-dismiss="modal" aria-label="Close">
                                        <img src="img/btn_mas.svg">
                                        <span>Agregar</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Efectivo -->
    <div class="modal fade" id="Efectivo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Pago con efectivo</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row justify-content-around">
                            <div class="col-10">
                                <form action="#" class="formulario_general">
                                    <div class="agregar_dinero py-4">
                                        <h5>Recibido</h5>
                                        <input id="dinero_recibido" type="number" onclick="agregar_efectivo()" onkeydown="agregar_efectivo()" onkeyup="agregar_efectivo()">
                                    </div>

                                    <div class="agregar_dinero pb-3">
                                        <h5>Cambio</h5>
                                        <input id="dinero_cambio" type="number" readonly>
                                    </div>

                                    <div class="botones_formulario pt-4 pb-4">
                                        <a class="shadow" href="#" data-bs-dismiss="modal">
                                            <img src="img/cancelar.svg" alt="">
                                            <span>Cancelar</span>
                                        </a>
                                        <button type="button" class="shadow" data-bs-dismiss="modal">
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
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript"
        src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.22/b-1.6.5/b-colvis-1.6.5/b-flash-1.6.5/b-html5-1.6.5/b-print-1.6.5/datatables.min.js">
    </script>
    <script src="js/funciones.js"></script>
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
    <script>
        $(document).ready(function () {
            $('#dt_dos').DataTable({
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
        if(!empty($_GET['incorrecto'])){
            echo '<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
            Swal.fire(
                "Venta incorrecta",
                "Por favor ingresa todos los datos",
                "error"
            )
            </script>';
        }
    ?>

</body>

</html>