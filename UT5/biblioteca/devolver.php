<link rel="stylesheet" href="css/estilos.css">

<?php
include 'conexion.php';
if(!isset($_POST['accion'])){
?>


<h1>Devolver libro</h1>
    <form action="<?php	$_SERVER['PHP_SELF']?>" method="post">
      
    <?php
    
    try {
        $sql = "SELECT * FROM prestamo INNER JOIN libros ON prestamo.cod_libro = libros.cod_libro INNER JOIN socios ON prestamo.cod_socio = socios.cod_socio WHERE devuelto = 'N' ORDER BY fecha_prestamo";
        $consulta = $conexion->prepare($sql);
        $consulta->execute([]);
       
        $resultado = $consulta->fetchAll();
       
        }
    
    
     catch (PDOException $e) {
        echo "ERROR:" . $e->getMessage();
    }

?>
<table id="formulario">
    <tr>
        <th class="titulo">Titulo</th>
        <th class="codigo">Codigo</th>
        <th class="socio">Nº Socio</th>
        <th class="nombre">Nombre socio</th>
        <th class="fecha_prestamo">Fecha prestamo</th>
        <th class="autor">Autor</th>
        <th class="check">Check</th>
    </tr>
    
<?php

if($consulta != null){
    foreach($resultado as $fila){
        //var_dump( $fila);
            echo '
            <tr>
            <td class="titulo">'.$fila['TITULO'].'</td>
            <td class="titulo">'.$fila['COD_LIBRO'].'</td>
            <td class="socio">'.$fila['COD_SOCIO'].'</td>
            <td class="nombre">'.$fila['NOMBRE'].'</td>
            <td class="fecha_prestamo">'.strftime("%d/%m/%G", strtotime($fila['FECHA_PRESTAMO'])).'</td>
            <td class="autor">'.$fila['AUTOR'].'</td>
            <td><input type="checkbox"  name="ids[]" value='.$fila['COD_LIBRO'].'/'.$fila['COD_SOCIO'].'/'.$fila['FECHA_PRESTAMO'].'/></td>
            </tr>
            ';
        
        }
}else{
    echo "La busqueda no devolvio ningun resultado";
}

?>
</table>
  <button type="submit" name="accion" value="devolver">Devolver</button>

  </form>

<?php
}elseif(isset($_POST['accion'])){
    //var_dump($_POST);
    foreach($_POST['ids'] as $valor){
        $fechaDevolucion = date('Y-m-d');
        $devuelto = 'S';
        $codLibro = substr($valor, 0, 6);
        $codSocio = substr($valor, 7, 3);
        $fechaPrestamo = substr($valor, 11, -1);
    try {
        $sql = "UPDATE prestamo SET fecha_devolucion = :fechaDevolucion, devuelto = :devuelto WHERE cod_libro = :codLibro AND cod_socio = :codSocio AND fecha_prestamo = :fechaPrestamo";
        $consulta = $conexion->prepare($sql);
        $consulta->execute([':fechaDevolucion' => $fechaDevolucion, ':devuelto' => $devuelto, ':codLibro' => $codLibro, ':codSocio' => $codSocio, ':fechaPrestamo' => $fechaPrestamo]);   
        }
    
    
     catch (PDOException $e) {
        echo "ERROR:" . $e->getMessage();
    }

}
?>
<script>
window.location.assign("index.html");
</script>
<?php
}
?>


<p>
    <a href="index.html">Volver a inicio</a>
</p>

