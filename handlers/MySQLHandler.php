<?php

namespace  handlers;

class MySQLHandler implements iHandler{

    private $sql;

    public function __construct($connection){
        $this->sql = $connection;
    }

    public function get(){
        $stmt = $this->sql->prepare("SELECT * FROM `test`");
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_ASSOC); 
        return $stmt->fetchAll();
    }

    public function getById($id = 1){
        $stmt = $this->sql->prepare("SELECT * FROM `test` where ud='$id'");
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_ASSOC); 
        return $stmt->fetchAll();

    }

    public function search($name = ''){
        $stmt = $this->sql->prepare("SELECT * FROM `test` where lastname LIKE '%$name%' OR firstname LIKE '%$name%'");
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_ASSOC); 
        return $stmt->fetchAll();
    }
}