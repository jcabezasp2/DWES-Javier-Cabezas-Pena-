export function manejarMenu() {
    const menu = document.querySelector('#menu');
    if (localStorage.getItem('usuario') != null) {
        if (JSON.parse(localStorage.getItem('usuario'))._idCliente.trim() == '9999A') {
            menu.innerHTML = '<ul class="admin"><li><a href="./alta.html">Alta</a></li><li><a href="./crear.html">Crear cuenta</a></li><li><a href="./consultar.html">Listar cuentas</a></li><li><a href="./eliminar.html">Eliminar una cuenta</a></li><li><a id="desconectar" href="">Desconectarse</a></li></ul>';
        }
        else {
            menu.innerHTML = '<ul class="cliente"><li><a href="./alta.html">Alta</a></li><li><a href="./movimientos.html">Consultar movimientos</a></li><li><a href="./anadirMovimiento.html">Añadir movimiento</a></li><li><a id="desconectar" href="">Desconectarse</a></li></ul> */';
        }
    }
    else {
        menu.innerHTML = '<ul class="no-conectado"><li><a href="login.html">Conectarse</a></li><li><a href="./alta.html">Alta</a></li></ul>';
    }
}
/* <ul class="no-conectado">
<li><a href="login.html">Conectarse</a></li>
<li><a href="./alta.html">Alta</a></li>
</ul>
<ul class="admin">
<li><a href="./alta.html">Alta</a></li>
<li><a href="./crearCuenta.html">Crear cuenta</a></li>
<li><a href="">Listar cuentas</a></li>
<li><a href="">Eliminar una cuenta</a></li>
<li><a href="">Desconectarse</a></li>
</ul>
<ul class="cliente">
<li><a href="./alta.html">Alta</a></li>
<li><a href="">Consultar movimientos</a></li>
<li><a href="">Añadir movimiento</a></li>
<li><a href="">Desconectarse</a></li>
</ul> */ 
