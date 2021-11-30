var btn_cerrar = document.querySelector("#salir");
var panel = document.querySelector(".menu_panel");
var botones_panel = document.querySelector(".menu_botones");
var contenido = document.querySelector(".panel_contenido");

btn_cerrar.addEventListener("click", cerrarmenu);

function cerrarmenu() {
    panel.classList.toggle("cerrado");
    botones_panel.classList.toggle("reducido");
    contenido.classList.toggle("ampliado");
}

if(screen.width<800){
    cerrarmenu();
}


