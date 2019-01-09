<?php

namespace handlers;


class JsonHandler implements iHandler{

    private $data = array();

    public function __construct($file){
        $fileContent = file_get_contents($file);
        $this->data = json_decode($fileContent, true); 
    }

    public function get(){
        return $this->data;
    }

    public function getById($id = 1){
        return $this->data[intval($id)+1];
    }

    public function search($name = ''){
        $outputArray = array();
        foreach ($this->data as $row) {
            if ($row['lastname'] === $name) {
                $outputArray[] = $row;
            }
            if ($row['firstname'] === $name) {
                $outputArray[] = $row;
            }
        }
        return $outputArray;
    }
}