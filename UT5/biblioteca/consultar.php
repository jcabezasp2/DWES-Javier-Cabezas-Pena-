<?php
include 'conexion.php';
try {
        $sql = "SELECT * FROM prestamo INNER JOIN libros ON prestamo.cod_libro = libros.cod_libro INNER JOIN socios ON prestamo.cod_socio = socios.cod_socio ORDER BY fecha_prestamo";
        $consulta = $conexion->prepare($sql);
        $consulta->execute([]);
       
        $resultado = $consulta->fetchAll();
       
        }
    
    
     catch (PDOException $e) {
        echo "ERROR:" . $e->getMessage();
    }



?>
<link rel="stylesheet" href="css/estilos.css">
<h1>Consulta de libros</h1>
<table>
    <tr>
        <th class="titulo">Titulo</th>
        <th class="codigo">Codigo</th>
        <th class="socio">Nº Socio</th>
        <th class="nombre">Nombre socio</th>
        <th class="devuelto">Devuelto</th>
        <th class="fecha_prestamo">Fecha prestamo</th>
        <th class="fecha_devolucion">Fecha devolucion</th>
        <th class="autor">Autor</th>
    </tr>
    
<?php

if($consulta != null){
    foreach($resultado as $fila){
            echo '
            <tr>
            <td class="titulo">'.$fila['TITULO'].'</td>
            <td class="titulo">'.$fila['COD_LIBRO'].'</td>
            <td class="socio">'.$fila['COD_SOCIO'].'</td>
            <td class="nombre">'.$fila['NOMBRE'].'</td>
            <td class="devuelto">'.$fila['DEVUELTO'].'</td>
            <td class="fecha_prestamo">'.strftime("%d/%m/%G", strtotime($fila['FECHA_PRESTAMO'])).'</td>
            <td class="fecha_devuelto">'.strftime("%d/%m/%G", strtotime($fila['FECHA_DEVOLUCION'])).'</td>
            <td class="autor">'.$fila['AUTOR'].'</td>
            </tr>
            ';
        
        }
}else{
    echo "La busqueda no devolvio ningun resultado";
}


?>
    
</table>

<a href="index.html">Volver a inicio</a>