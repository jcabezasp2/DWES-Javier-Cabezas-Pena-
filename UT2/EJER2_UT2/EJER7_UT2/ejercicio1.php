<link rel="stylesheet" href="estilo6.css">

<?php 
include 'funciones.php';

if(!isset($_POST['enviar']) && !isset($_POST['anadir']))
{
?>



<form action="<?php	$_SERVER['PHP_SELF']?>" method="post">
  <fieldset>
    <h1>RECETAS DE COCINA</h1>
    <label for="cantidad">Indique numero de ingredientes</label>
    <input type="number" name="cantidad" id="cantidad" required>
    <input type="submit" name="enviar" value="enviar">
</fieldset>
</form>

<?php 
}elseif(isset($_POST['enviar']) && !isset($_POST['anadir'])){
?>
<form action="<?php	$_SERVER['PHP_SELF']?>" method="post">
  <fieldset>
    <h1>RECETAS DE COCINA</h1>
    <p>Escriba el nombre de la receta</p>
    <label for="name">Nombre receta</label>
    <input type="text" name="name" id="name">
    <p>Escriba los ingredientes de la receta y la cantidad de cada uno:</p>

    <?php 
       $repeticiones = $_POST['cantidad'];

       for($i = 0; $i < $repeticiones; $i++){

            echo ' <p>
            <label for="ingrediente">Ingrediente:</label>
            <input type="text" name="ingrediente[]">
            <label for="cantidad">Cantidad:</label>
            <input type="number" name="cantidad[]" id="cantidad">
            <span>unidades - gramos - ml</span>
            </p>';
       }

    ?>

    <label for="receta">Realizacion:</label>
    <textarea name="receta"  cols="30" rows="10"></textarea>
   
    <input type="submit" name="anadir" value="Anadir">
</fieldset>
</form>



<?php 
}else{

   // var_dump($_POST);
?>
<body>
<p>Receta incorporada</p>
<p>Receta de<strong> <?php echo $_POST['name'] ?></strong></p>
<?php for($x = 0; $x <count( $_POST['ingrediente']); $x++){ ?>
<ul>
    <li><?php echo $_POST['ingrediente'][$x].": ".$_POST['cantidad'][$x]." unidades/gr/ml" ?></li>
</ul>
<?php } ?>
<p><strong>Realizacion:</strong></p>
</body>
<?php 

echo $_POST['receta'];
}
?>

