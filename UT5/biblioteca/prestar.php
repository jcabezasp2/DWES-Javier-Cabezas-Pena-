<link rel="stylesheet" href="css/estilos.css">
<?php
    include 'conexion.php';
    $stmt = $conexion -> query("SELECT nombre, cod_socio FROM socios");
    echo '<h1>Insertar prestamo</h1>';
    if(!isset($_POST['accion'])){
?>


<form action="<?php	$_SERVER['PHP_SELF']?>" method="post">

  <fieldset>
    <!--ELEGIR SOCIO-->

    <p>
        <label for="socio">Elegir socio:</label>
        <select name="socio" id="socioElegido">
        <option selected disabled>Escoge un socio</option>
<?php

        while($fila = $stmt->fetch(PDO::FETCH_OBJ)){
        echo '<option value='.$fila->cod_socio.'>'.$fila->nombre.'</option>';
        }
?>
        </select>
    </p>
    <p>
    <button type="submit" name="accion" value="mostrar">Elegir</button>
    </p>

</fieldset>
</form>
    <!--ELEGIR LIBRO-->

<?php
}elseif($_POST['accion'] == 'mostrar'){

    $fecha = date('Y-m-d');
    $cod_socio = $_POST["socio"];
    $sql = "SELECT titulo, cod_libro FROM libros WHERE unidades > 0 AND cod_libro NOT IN (SELECT cod_libro FROM prestamo WHERE fecha_prestamo = :fecha AND cod_socio = :cod_socio)";
    $consulta = $conexion->prepare($sql);
    $consulta->execute([':fecha'=> $fecha , ':cod_socio' => $cod_socio]);
?>
    <form action="<?php	$_SERVER['PHP_SELF']?>" method="post">    
        <fieldset>
        <input type="hidden" name="socioElegido" value=<?php echo $_POST["socio"]?>>
        <p>
        <label for="Libro">Elegir libro:</label>
        <select name="libro" id="libroElegido" required>
        <option disabled>Escoge un libro</option>
<?php

        while($fila = $consulta->fetch(PDO::FETCH_OBJ)){
        echo '<option value='.$fila->cod_libro.'>'.$fila->titulo.'</option>';
        }
?>
        </select>
    </p>
    <p>
    <button type="submit" name="accion" value="prestar">Prestar</button>
    </p>

</fieldset>
</form>

<?php
}elseif($_POST['accion'] == 'prestar'){
    $codLibro = $_POST['libro'];
    $codSocio = $_POST['socioElegido'];
    $devuelto = 'N';
    $fechaPrestamo = date('Y-m-d');
    $fechaDevolucion = date('Y-m-d', strtotime('+15 day', strtotime($fechaPrestamo)));
    try {
        $sql = "INSERT INTO prestamo (cod_libro, cod_socio, devuelto, fecha_devolucion, fecha_prestamo) VALUES (:cod_libro, :cod_socio, :devuelto, :fecha_devolucion, :fecha_prestamo); UPDATE libros SET unidades =  unidades - 1  WHERE cod_libro = :cod";
        $consulta = $conexion->prepare($sql); 
        $consulta->execute([':cod_libro' => $codLibro, ':cod_socio' => $codSocio, ':devuelto' => $devuelto, ':fecha_devolucion' => $fechaDevolucion, ':fecha_prestamo' => $fechaPrestamo, ':cod' => $codLibro]);
    } catch (PDOException $e) {
        echo "ERROR:" . $e->getMessage();
    }
?>
    <script>
    console.log(<?php echo  "'AAAA'" ?>);
    window.location.assign("index.html");
    </script>
    <?php    
}
?>
<p>
<a href="index.html">Volver a inicio</a>
</p>
