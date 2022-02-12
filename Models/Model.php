<?php
namespace Models;

class Model {
    
    private $data = [];

    public function __construct($data){
        $this->data = $data;
    }

    public function __get( $key )
    {
        if (array_key_exists($key, $this->data)) {
            return $this->data[$key];
        }
        return null;
    }

    public function __set( $key, $value )
    {
        $this->data[$key] = $value;
    }

    public function getData(){
        return $this->data;
    }

}

?>