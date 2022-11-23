<?php 
//session_destroy();

session_start();
var_dump($_SESSION);
if(!isset($_SESSION)){

    $_SESSION['superior'] = rand(1, 7);
    $_SESSION['centro'] = rand(1, 7);
    $_SESSION['inferior'] = rand(1, 7);
}

if($_POST['superior'] == "derecha"){
    $_SESSION['superior']--;
    if($_SESSION['superior'] == 1){
        $_SESSION['superior'] = 7;
    }
}

if($_POST['superior'] == "izquierda"){
    $_SESSION['superior']++;
    if($_SESSION['superior'] == 7){
        $_SESSION['superior'] = 1;
    }
}

if($_POST['centro'] == "derecha"){
    $_SESSION['centro']--;
    if($_SESSION['centro'] == 1){
        $_SESSION['centro'] = 7;
    }

}

if($_POST['centro'] == "izquierda"){
    $_SESSION['centro']++;
    if($_SESSION['centro'] == 7){
        $_SESSION['centro'] = 1;
    }
}

if($_POST['inferior'] == "derecha"){
    $_SESSION['inferior']--;
    if($_SESSION['inferior'] == 1){
        $_SESSION['inferior'] = 7;
    }
}

if($_POST['inferior'] == "izquierda"){
    $_SESSION['inferior']++;
    if($_SESSION['inferior'] == 7){
        $_SESSION['inferior'] = 1;
    }
}
?>


<form action="<?php	$_SERVER['PHP_SELF']?>" method="post" style="width:80%;margin:auto">

<div>
    <p>
    <button type="submit" name="superior" value="derecha" style="font-size:3em">&#x1F448;</button>
    <img src="retratos/retratos-<?php echo $_SESSION['superior']?>-3.jpg">
    <button type="submit" name="superior" value="izquierda" style="font-size:3em">&#x1F449;</button>
    </p>
    <p>
    <button type="submit" name="centro" value="derecha" style="font-size:3em">&#x1F448;</button>
    <img src="retratos/retratos-<?php echo $_SESSION['centro']?>-2.jpg">
    <button type="submit" name="centro" value="izquierda" style="font-size:3em">&#x1F449;</button>
    </p>
    <p>
    <button type="submit" name="inferior" value="derecha" style="font-size:3em">&#x1F448;</button>
    <img src="retratos/retratos-<?php echo $_SESSION['inferior']?>-1.jpg">
    <button type="submit" name="inferior" value="izquierda" style="font-size:3em">&#x1F449;</button>
    </p>
</div>
</form>