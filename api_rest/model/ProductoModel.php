<?php
require_once PROJECT_ROOT_PATH . "/model/Database.php";

class ProductoModel extends Database {
    
    public function getProductos(){

        return $this->select("SELECT * FROM productos", ["i"]);

    }



}