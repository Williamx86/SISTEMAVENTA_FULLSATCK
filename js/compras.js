var identificador_elemento = 0;
var identificador_cantidad = 70162083;

function agregar_producto(x, y, z, w) {
    identificador_elemento += 1;
    identificador_cantidad += 1;

    var tabla = document.getElementById("agregar_productos_compra_aqui");
    var cantidad_seleccionada = document.getElementById(z).value;
    var precio_seleccionado = document.getElementById(w).value;

    let template = `

    <tr id="${identificador_elemento}">
        <td>
            <button type="button" class="btn_eliminar_tabla" onclick="eliminar(${identificador_elemento})">
                <img src="img/basurero.svg">
            </button>
        </td>
        <td>
            ${y}
        </td>
        <td>
            ${x}
            <input type="hidden" name="producto[]" value="${x}">
        </td>
        <td class="cantidad_producto_mod">
            <input class="${identificador_cantidad}" type="number" step="0.01" name="cantidad[]" value="${cantidad_seleccionada}" onclick="multiplicar('${identificador_cantidad}')" onkeydown="multiplicar('${identificador_cantidad}')" onkeyup="multiplicar('${identificador_cantidad}')">
        </td>
        <td class="cantidad_producto_mod">
            <input class="${identificador_cantidad}" type="number" step="0.01" name="precio[]" value="${precio_seleccionado}" onclick="multiplicar('${identificador_cantidad}')" onkeydown="multiplicar('${identificador_cantidad}')" onkeyup="multiplicar('${identificador_cantidad}')">
        </td>
        <td class="cantidad_producto_mod">
            <span class="${identificador_cantidad}"></span>
            <input class="precios_sumar ${identificador_cantidad}" type="hidden" name="importe[]">
        </td>
    </tr>

    `;

    tabla.innerHTML += template;

    sumarproductos();
    multiplicar(identificador_cantidad);
}

function agregar_producto_sucursal(x, y, z) {
    identificador_elemento += 1;
    identificador_cantidad += 1;

    var tabla = document.getElementById("agregar_productos_compra_aqui");
    var cantidad_seleccionada = document.getElementById(z).value;

    let template = `

    <tr id="${identificador_elemento}">
        <td>
            <button type="button" class="btn_eliminar_tabla" onclick="eliminar(${identificador_elemento})">
                <img src="img/basurero.svg">
            </button>
        </td>
        <td>
            ${y}
        </td>
        <td>
            ${x}
            <input type="hidden" name="producto[]" value="${x}">
        </td>
        <td class="cantidad_producto_mod">
            <input class="${identificador_cantidad}" type="number" step="0.01" name="cantidad[]" value="${cantidad_seleccionada}" onclick="multiplicar('${identificador_cantidad}')" onkeydown="multiplicar('${identificador_cantidad}')" onkeyup="multiplicar('${identificador_cantidad}')">
        </td>
    </tr>

    `;

    tabla.innerHTML += template;
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

function agregar_producto_entrada(x, y, z) {
    identificador_elemento += 1;
    identificador_cantidad += 1;

    var tabla = document.getElementById("agregar_productos_compra_aqui");
    var cantidad_seleccionada = document.getElementById(z).value;

    let template = `

    <tr id="${identificador_elemento}">
        <td>
            <button type="button" class="btn_eliminar_tabla" onclick="eliminar(${identificador_elemento})">
                <img src="img/basurero.svg">
            </button>
        </td>
        <td>
            ${y}
        </td>
        <td>
            ${x}
            <input type="hidden" name="producto[]" value="${x}">
        </td>
        <td class="cantidad_producto_mod">
            <input class="${identificador_cantidad}" type="number" step="0.01" name="cantidad[]" value="${cantidad_seleccionada}">
        </td>
    </tr>

    `;

    tabla.innerHTML += template;
}

function multiplicar(x) {

    var importe = 0;

    var unidades = document.getElementsByClassName(x);

    importe += unidades[0].value * unidades[1].value;

    unidades[2].innerHTML = importe.toFixed(2);
    unidades[3].value = importe.toFixed(2);

    sumarproductos();
}

function sumarproductos() {
    var total = 0;

    var precios = document.getElementsByClassName("precios_sumar");

    for (var i = 0; i < precios.length; i++) {
        total += Number(precios[i].value);
    }

    document.getElementById("total_pintar").value = total.toFixed(2);
}

function eliminar(x) {
    var tabla = document.getElementById("agregar_productos_compra_aqui");
    var quitar = document.getElementById(x);
    tabla.removeChild(quitar);
}

function desmarcar(){
    document.getElementById("inlineCheckbox2").checked = false;
}