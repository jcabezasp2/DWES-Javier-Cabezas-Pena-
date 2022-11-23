
<?php
	echo 'El script que se está ejecutando es:  '.$_SERVER['PHP_SELF'].'<BR>';
    echo 'la dirección IP del servidor es:  '.$_SERVER['SERVER_ADDR'].'<BR>';
    echo 'El nombre del servidor web:  '.$_SERVER['SERVER_NAME'].'<BR>';
    echo 'Directorio raiz es:  '.$_SERVER['DOCUMENT_ROOT'].'<BR>';
    echo 'IP desde la que el usuario ve la página:  '.$_SERVER['REMOTE_ADDR'].'<BR>';
    echo 'Método para acceder a la página:  '.$_SERVER['REQUEST_METHOD'].'<BR>';

?>
