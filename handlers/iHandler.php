<?php 
namespace handlers;

interface iHandler{
    public function get();
    public function getById($id);
    public function search($name);
}