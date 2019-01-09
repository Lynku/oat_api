<?php

namespace  handlers;

class CsvHandler implements iHandler{
    private $data = array();

    public function __construct($file){
 
        $csvFile = array_map('str_getcsv', file($file));
        array_walk($csvFile, function(&$row) use ($csvFile) {
            $row = array_combine($csvFile[0], $row);
        });
        array_shift($csvFile);
        $this->data = $csvFile; 
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