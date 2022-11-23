<link rel="stylesheet" href="estilos_ejercicio4.css">
<?php 

session_start();

if(isset($_POST)){

    if($_POST['accion'] == "reiniciar"){
        $_POST = array();
        session_destroy();
        setcookie(session_name(), "", time() -3600, "/");
    }else{
        $numero = $_POST['carta'];

    if($_SESSION['primero']){
        $_SESSION['primero'] = false;
        $_SESSION['anterior'] = $numero;
        $_SESSION['estados'][$numero] = $_SESSION['parejas'][$numero];
        

    }else{
        if($_SESSION['parejas'][$numero] == $_SESSION['parejas'][$_SESSION['anterior']]){
            $_SESSION['estados'][$numero] = $_SESSION['parejas'][$numero];
        }else{
            $_SESSION['estados'][$_SESSION['anterior']] = "&#128083";
            
        }

        $_SESSION['jugadas']++;
        $_SESSION['primero'] = true;
    }
    }
    
    
    
}

if(!isset($_SESSION) ||  $_SESSION['numParejas'] == null){

    $_SESSION['numParejas'] = rand(2, 6);
    $_SESSION['primero'] = true;
    $_SESSION['jugadas'] = 0;
    function generarPareja(){
        $aleatorio = rand(14, 27);
    
        return "&#1278".$aleatorio.";"; 
    }
    
    $_SESSION['parejas'] = array();
    $_SESSION['estados'] = array();
    $oculto = "&#128083";
    for($i = 0; $i < $_SESSION['numParejas']; $i++){

        do{
            $valor = generarPareja();
        }while(in_array($valor, $_SESSION['parejas']));
        
        array_push($_SESSION['parejas'], $valor);
        array_push($_SESSION['parejas'], $valor);
        array_push($_SESSION['estados'], $oculto);
        array_push($_SESSION['estados'], $oculto);

    }
    
    shuffle($_SESSION['parejas']);
}






?>

<div id="container">
<h1>Memory</h1>
<form action="<?php	$_SERVER['PHP_SELF']?>" method="post">
<p>
<button type="submit" name="accion" value="reiniciar">Nueva partida</button>
</p>
<?php	

for($i = 0; $i < count($_SESSION['parejas']); $i++){
    echo '
    <button class="carta" type="submit" id="carta'.$i.'" name="carta" value='.$i.'>
    '.$_SESSION['estados'][$i].'
    </button>
    ';
}

?>



</form>
<?php	

echo '<p>Jugadas realizadas: '.$_SESSION['jugadas'].'</p>';

?>
</div>

