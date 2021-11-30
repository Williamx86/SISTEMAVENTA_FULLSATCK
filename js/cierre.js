function calcular_total_r(){
    let cien = document.getElementById("b_cien").value * 100;
    let cincuenta = document.getElementById("b_cincuenta").value * 50;
    let veinte = document.getElementById("b_veinte").value * 20;
    let diez = document.getElementById("b_diez").value * 10;
    let cinco = document.getElementById("b_cinco").value * 5;
    let uno = document.getElementById("b_uno").value * 1;
    let cora = document.getElementById("m_cora").value * 0.25;
    let m_diez = document.getElementById("m_diez").value * 0.10;
    let m_cinco = document.getElementById("m_cinco").value * 0.05;
    let m_uno = document.getElementById("m_uno").value * 0.01;


    let total_registrado = document.getElementById("total_registrado");
    let suma_de_total_registrado = 0;
    suma_de_total_registrado = cien + cincuenta + veinte + diez + cinco + uno + cora + m_diez + m_cinco + m_uno;

    total_registrado.value = suma_de_total_registrado.toFixed(2);
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
                var precio_modificar = document.getElementById("caja_inicial");
                precio_modificar.removeAttribute("readonly", false);
            }
        }
    }
}