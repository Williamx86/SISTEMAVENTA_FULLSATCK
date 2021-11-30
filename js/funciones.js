var identificador_elemento = 0;
var identificador_cantidad = 70162083;
var objeto_modificar = 0;

function editar_usuario(x, y, z, c, i) {
    var nombre = document.querySelector(".nombre_usuario_editar");
    var clave = document.querySelector(".clave_usuario_editar");
    var id = document.querySelector(".id_usuario_editar");

    nombre.value = x;
    clave.value = y;
    id.value = i;
}

function editar_bodega_lacteos(x, y, s, c, i) {
    var nombre = document.querySelector(".editar_bodega_lacteos_nombre");
    var sku = document.querySelector(".editar_bodega_lacteos_sku");
    var id = document.querySelector(".editar_bodega_lacteos_id");
    var stock = document.querySelector(".editar_bodega_lacteos_stock");
    var precio = document.querySelector(".editar_bodega_lacteos_precio");

    nombre.value = y;
    sku.value = x;
    id.value = i;
    stock.value = s;
    precio.value = c;
}

function editar_proveedor(x, y, s, i, o) {
    var nrc = document.querySelector("#editar_nrc");
    var nombre = document.querySelector("#editar_nombre");
    var contacto = document.querySelector("#editar_contacto");
    var numero = document.querySelector("#editar_numero");
    var id = document.querySelector("#editar_id");

    nrc.value = x;
    nombre.value = y;
    contacto.value = s;
    numero.value = i;
    id.value = o;
}

function editar_bodega_sala(x, y, s, i) {
    var nombre = document.querySelector(".nombre_producto_sala");
    var sku = document.querySelector(".sku_producto_sala");
    var id = document.querySelector(".id_producto_sala");
    var precio = document.querySelector(".precio_producto_sala");

    nombre.value = y;
    sku.value = x;
    id.value = i;
    precio.value = s;
}

function incrementar(x){
    var input = document.getElementById(x);
    var cantidad = document.getElementById(x).value;
    input.value = Number(cantidad) + 1;
}

function reducir(x){
    var input = document.getElementById(x);
    var cantidad = document.getElementById(x).value;
    input.value = Number(cantidad) - 1;
}

function agregar_producto(x, y, z) {

    identificador_elemento += 1;
    identificador_cantidad += 1;

    var tabla = document.querySelector(".agregar_productos_aqui");
    var cantidad_seleccionada = document.getElementById(z).value;

    let template = `

        <tr id="${identificador_elemento}">
            <td class="opciones_tabla">
                <button type="button" class="btn_eliminar_tabla" onclick="eliminar_producto(${identificador_elemento})">
                    <img src="img/basurero.svg">
                </button>
                <input class="${identificador_cantidad}" type="number" step="0.01" name="cantidad[]" value="${cantidad_seleccionada}" onclick="multiplicar('${identificador_cantidad}')" onkeydown="multiplicar('${identificador_cantidad}')" onkeyup="multiplicar('${identificador_cantidad}')">
            </td>
            <td>
                <p class="descripcion_producto">
                    <span>${x}</span>
                    <input type="hidden" name="producto[]" value="${x}">
                </p>
            </td>
            <td class="cantidad_producto_mod opciones_tabla">
                <button type="button" class="btn_editar_tabla" onclick="editar_precio_producto(${identificador_cantidad})" data-bs-toggle="modal" data-bs-target="#Modificarprecio">
                    <img src="img/lapiz.svg">
                </button>
                <input class="${identificador_cantidad}" type="number" step="0.01" name="precio[]" value="${y}" readonly onclick="multiplicar('${identificador_cantidad}')" onkeydown="multiplicar('${identificador_cantidad}')" onkeyup="multiplicar('${identificador_cantidad}')">
            </td>
            <td>
                <span class="${identificador_cantidad}">${y}</span>
                <input class="precios_sumar ${identificador_cantidad}" type="hidden" name="importe[]" value="${y}">
            </td>
        </tr>

    `;

    tabla.innerHTML += template;

    sumarproductos();
    multiplicar(identificador_cantidad);

}

function multiplicar (x){

    var importe = 0;

    var unidades = document.getElementsByClassName(x);

    importe += unidades[0].value * unidades[1].value;

    unidades[2].innerHTML = importe.toFixed(2);
    unidades[3].value = importe.toFixed(2);

    sumarproductos()
}

function sumarproductos() {
    var total = 0;

    var precios = document.getElementsByClassName("precios_sumar");

    for (var i = 0; i < precios.length; i++) {
        total += Number(precios[i].value);
    }

    document.getElementById("total_pintar").innerHTML = total.toFixed(2);
    document.getElementById("total_venta").value = total.toFixed(2);
}

function agregar_metodo(x){
    document.getElementById("metodo_pago_pantalla").value = x;
    document.getElementById("metodo_pago").value = x;
    document.getElementById("cambio").value = 0;
    document.getElementById("cambio_pantalla").innerHTML = 0;
}

function agregar_efectivo(){

    document.getElementById("metodo_pago_pantalla").value = 'Efectivo';
    document.getElementById("metodo_pago").value = 'Efectivo';

    var recibido = document.getElementById("dinero_recibido").value;
    var cambio = 0;
    var total_venta_final = document.getElementById("total_venta").value;

    cambio += recibido - total_venta_final;

    document.getElementById("dinero_cambio").value = cambio.toFixed(2);
    document.getElementById("cambio").value = cambio.toFixed(2);
    document.getElementById("cambio_pantalla").innerHTML = cambio.toFixed(2);
}

function eliminar_metodo(){
    document.getElementById("metodo_pago_pantalla").value = '';
    document.getElementById("metodo_pago").value = '';

    document.getElementById("cambio").value = 0;
    document.getElementById("cambio_pantalla").innerHTML = 0;
}

function descuento() {
    var password = document.getElementById("password_usuario").value;
    let enlace = 'consulta.php?pass=' + password;

    fetch(enlace)
        .then(res => res.json())
        .then(data => analizar(data));

    function analizar(data) {
        for (let objeto of data) {
            if (objeto.clave === password) {
                document.getElementById("pedir_password").classList.toggle("no_disponible");
                document.getElementById("mostrar_descuentos").classList.toggle("no_disponible");
            }
        }
    }
}

function editar_precio_producto(x){
    objeto_modificar = x;
}

function solicitud() {
    var password_admin = document.getElementById("password_usuario_admin").value;
    let enlace = 'consulta.php?pass=' + password_admin;

    fetch(enlace)
        .then(res => res.json())
        .then(data => analizar(data));

    function analizar(data) {
        for (let objeto of data) {
            if (objeto.clave === password_admin) {
                var precio_modificar = document.getElementsByClassName(objeto_modificar);
                precio_modificar[1].removeAttribute("readonly", false);
            }
        }
    }
}

function descuento_porcentaje(){
    var porcentaje = document.getElementById("porcentaje").value;
    var total_venta_final = document.getElementById("total_venta").value;
    var total_nuevo = 0;

    total_nuevo += total_venta_final - (porcentaje * total_venta_final / 100);

    document.getElementById("total_pintar").innerHTML = total_nuevo.toFixed(2);
    document.getElementById("total_venta").value = total_nuevo.toFixed(2);
}

function descuento_efectivo(){
    var cantidad_efectivo = document.getElementById("descuento_efe").value;
    var total_venta_final = document.getElementById("total_venta").value;
    var total_nuevo = 0;

    total_nuevo += total_venta_final - cantidad_efectivo;

    document.getElementById("total_pintar").innerHTML = total_nuevo.toFixed(2);
    document.getElementById("total_venta").value = total_nuevo.toFixed(2);
}

function cambiar_total(){
    var nuevo_total = document.getElementById("nuevo_total").value;

    document.getElementById("total_pintar").innerHTML = nuevo_total;
    document.getElementById("total_venta").value = nuevo_total;
}

function eliminar_producto(x){
    var tabla = document.querySelector(".agregar_productos_aqui");       
    var quitar = document.getElementById(x);
    tabla.removeChild(quitar);
    sumarproductos()
}

function agregar_producto_envio(x, y) {

    identificador_elemento += 1;
    identificador_cantidad += 1;

    var tabla = document.querySelector(".agregar_productos_aqui");

    let template = `

        <tr id="${identificador_elemento}">
            <td class="opciones_tabla">
                <button type="button" class="btn_eliminar_tabla" onclick="eliminar_producto(${identificador_elemento})">
                    <img src="img/basurero.svg">
                </button>
                <input class="${identificador_cantidad}" type="number" name="cantidad[]" value="1" onclick="multiplicar('${identificador_cantidad}')" onkeydown="multiplicar('${identificador_cantidad}')" onkeyup="multiplicar('${identificador_cantidad}')">
            </td>
            <td class="text-center">
                <p class="descripcion_producto grande_desc">
                    <span>${x}</span>
                    <input type="hidden" name="producto[]" value="${x}">
                </p>
            </td>
        </tr>

    `;

    tabla.innerHTML += template;

}