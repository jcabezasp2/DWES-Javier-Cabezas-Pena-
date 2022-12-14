<?php

$file = file_get_contents('grabar.json');

$data = json_decode($file, JSON_OBJECT_AS_ARRAY);

echo $file;