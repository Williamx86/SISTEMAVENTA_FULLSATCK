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
                            <h3>Accesos</h3>
                        </div>
                    </div>
                    <img class="raya_panel" src="img/raya_panel.svg">
                </div>
                <!--Codigo para titulos y selectores de fechas-->

                <div class="col-11 pt-4">
                    <div class="botones_principales_menus">
                        <a class="shadow" href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <img src="img/usuario_nuevo.svg">
                            <span>Crear usuario</span>
                        </a>
                    </div>
                </div>

                <div class="col-11 py-5">
                    <table id="dt" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>Acciones</th>
                                <th>Nombre</th>
                                <th>Tipo</th>
                                <th>Sucursal</th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php
                            $consulta = "SELECT * FROM usuarios";
                            $resultado =  mysqli_query($conexion,$consulta);

                            while($mostrar = mysqli_fetch_array($resultado)){
                        ?> 

                            <tr>
                                <td>
                                    <div class="acciones_botones">
                                        <a class="btn_accion_amarillo" onclick="editar_usuario('<?php echo $mostrar['nombre'] ?>','<?php echo $mostrar['clave'] ?>','<?php echo $mostrar['tipo'] ?>','<?php echo $mostrar['sucursal'] ?>',<?php echo $mostrar['id'] ?>)" href="#" data-bs-toggle="modal" data-bs-target="#Editarusuario">
                                            <img src="img/lapiz.svg">
                                        </a>
                                        <a class="btn_accion_rojo" href="backend/d_user.php?id=<?php echo $mostrar['id'] ?>">
                                            <img src="img/basurero.svg">
                                        </a>

                                    </div>
                                </td>
                                <td>
                                    <?php echo $mostrar['nombre'] ?>
                                </td>
                                <td>
                                    <?php echo $mostrar['tipo'] ?>
                                </td>
                                <td>
                                    <?php echo $mostrar['sucursal'] ?>
                                </td>
                            </tr>

                        <?php       
                            }
                        ?>

                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Acciones</th>
                                <th>Nombre</th>
                                <th>Tipo</th>
                                <th>Sucursal</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>

            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Accesos - Crear usuario</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row justify-content-around">
                            <div class="col-10">
                                <form action="backend/c_user.php" method="POST" class="formulario_general">

                                    <div class="accesos_usuario">
                                        <label>Nombre de usuario:</label>
                                        <input type="text" name="nombre">
                                    </div>

                                    <div class="accesos_usuario pt-3">
                                        <label>Contraseña:</label>
                                        <input type="password" name="clave">
                                    </div>

                                    <div class="accesos_usuario pt-3">
                                        <label>Tipo de usuario:</label>
                                        <select name="tipo">
                                            <option value="Cajero" selected>Cajero</option>
                                            <option value="Gerente">Gerente</option>
                                            <option value="Admin">Admin</option>
                                        </select>
                                    </div>

                                    <div class="accesos_usuario py-3">
                                        <label>Sucursal:</label>
                                        <select name="sucursal">
                                            <option value="La Rabida" selected>La Rabida</option>
                                            <option value="value2">-</option>
                                            <option value="value3">-</option>
                                        </select>
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

    <div class="modal fade" id="Editarusuario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Accesos - Editar usuario</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row justify-content-around">
                            <div class="col-10">
                                <form action="backend/u_user.php" method="POST" class="formulario_general">

                                    <div class="accesos_usuario">
                                        <label>Nombre de usuario:</label>
                                        <input class="nombre_usuario_editar" type="text" name="nombre_usuario">
                                        <input class="id_usuario_editar" type="hidden" name="id_usuario">
                                    </div>

                                    <div class="accesos_usuario pt-3">
                                        <label>Contraseña:</label>
                                        <input class="clave_usuario_editar" type="password" name="clave_usuario">
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