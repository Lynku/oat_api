<?php

use handlers\CsvHandler as CsvHandler;
use handlers\JsonHandler as JsonHandler;
use handlers\MySQLHandler as MySQLHandler;

class HandlerFactory{

    public static function getHandler($type = null, $dataStorage = null) {
        $dataHandler = NULL;
        switch ($type) {
            case "csv":
                $dataHandler = new CsvHandler($dataStorage);
            break;
            case "mysql":
                $dataHandler = new MySQLHandler($dataStorage);
            break;
            default:
                $dataHandler = new JsonHandler($dataStorage);
            break;        
        }  
        return $dataHandler;
     }
}