<?php 
use handlers\iHandler as iHandler;
class Request{

    private $dataHandler = null;

    function __construct(iHandler $dataHandler){
	   header("Access-Control-Allow-Origin: *");
        header('Content-type: application/json');
        $this->dataHandler = $dataHandler;
     }

    public function ActionUser($params){
        $data = null;
        if(!empty($params['id'])){
            $data = $this->dataHandler->getById($params['id']);
        }
        echo json_encode( $data);
    }

    public function ActionUsers($params = array()){
        //check if limit & offset are requested
        $limit = (!empty($params['limit'])) ? (int) $params['limit']: NULL ;
        $offset = (!empty($params['offset'])) ? (int) $params['offset']: 0 ;
        //search or get all data
        if(!empty($params['name'])){
            $data = $this->dataHandler->search($params['name']);
        }else{
            $data = $this->dataHandler->get();
        }
         $data = array_slice( $data , $offset , $limit);
       
        echo json_encode( $data );
    }
}