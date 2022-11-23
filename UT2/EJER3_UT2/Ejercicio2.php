<?php

	$v = array();

    $v[1]=90;$v[30]=7;$v['e']=99;$v['hola']=43;

    foreach($v as $key => $value){
        echo $key." = ".$value."\n";
    }


?>