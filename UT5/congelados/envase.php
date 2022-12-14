<?php
session_start();
include 'conexion.php';

if(!isset($_SESSION['idCliente'])){
    echo "<P>Acceso SOLO para usuarios registrados</P>\n";
    echo "<P>[ <A HREF='login.php' TARGET='_top'>Loguearse</A> ]</P>\n";
}else{
   echo "<p>Usuario ".$_SESSION['idCliente']."</p>";
   echo "<p>Hora de conexion ".$_SESSION['horaConexion']."</p>"
?>
    <form action="<?php	$_SERVER['PHP_SELF']?>" method="post">
    <label for="envase">Envase: </label>
        <select name="envase" id="envase" required>
<?php

    $sql = "SELECT * FROM envases";
    $consulta = $conexion->prepare($sql);
    $consulta->execute([]);
    foreach($consulta as $fila){
        echo '<option value="'.$fila['numero_env'].'"'.(isset($_POST['envase'])? ($_POST['envase'] == $fila['envase'] ? " selected": "" ) : "").'>'.$fila['etiqueta_env'].'</option>';
    }
?>
        </select>

        <p>
            <button type="submit" name="seleccionar">Seleccionar envase</button>
        </p>

    </form>
<?php
    if(isset($_POST['seleccionar'])){
        echo "Creando el fichero envase.txt";
        $fichero = fopen('envase.txt','w');
        $env = $_POST['envase'];
        try{
            $sql = "SELECT * FROM productos WHERE num_envase_prod = :num_envase_prod";
            $consulta = $conexion->prepare($sql);
            $consulta->execute([':num_envase_prod'=>$env]);
        } catch (Exception $e) {
             echo "Fallo: " . $e->getMessage();
        }
        foreach($consulta as $fila){
            fwrite($fichero, $fila); 
        }
        fclose($fichero);
    }

}