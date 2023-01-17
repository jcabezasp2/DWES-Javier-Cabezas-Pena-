import { manejarVisor } from "./visorConexion.js";
import { manejarMenu } from "./menu.js";
export function iniciar() {
    manejarVisor();
    manejarMenu();
    if (localStorage.getItem('usuario') != null) {
        document.querySelector('#desconectar').addEventListener('click', function () {
            localStorage.clear();
            if (window.XMLHttpRequest) {
                var ajax = new XMLHttpRequest();
            }
            // La respuesta aparecerá en una alerta
            ajax.onreadystatechange = function () {
                if (ajax.readyState == 4) {
                    if (ajax.status == 200) {
                        console.log(ajax.responseText);
                        manejarVisor();
                        manejarMenu();
                    }
                }
            };
            ajax.open("POST", "./php/logout.php", true);
            ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            ajax.send();
        });
    }
}
