<?php

class Database{

    protected $connection = null;

    public function __construct(){
        try{
            $this->connection = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE_NAME);

            if(mysqli_connect_errno()){
                throw new Exception("Could not connect to database");
            }
        }catch(Exception ){
            throw new Exception($e->getMessage())
        }
    }

    public function select($query = "", $params = []){
        try{
            $stmt = $this->executeStatement($query, $params);
        $result =$stmt->get_result()->fetch_all(MYSQL_ASSOC);
        $stmt->close();

        return $result;
        }catch{
            throw new Exception( $e->getMessage());
        }

        return false;
    }

    private function executeStatement($query = "", $params = []){
        try{
            $stmt = $this->connection->prepare($query);

            if($stmt === false){
                throw new Exception("Unable to do prepared statement.". $query);
            }

            if($params){
                $stmt->bind_param($param[0], $param[1]);
            }

            $stmt->execute();

            return $stmt;

        } catch{
            throw new Exception($e->getMessage());
        }  
    }



}


