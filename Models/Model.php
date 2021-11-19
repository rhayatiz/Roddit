<?php

class Model {
    
    protected $values = array();

    function __construct($values){
        $this->$values = $values;
    }

    public function __get( $key )
    {
        if (array_key_exists($key, $this->values)) {
            return $this->values[$key];
        }
        return null;
    }

    public function __set( $key, $value )
    {
        if (array_key_exists($key, $this->values)) {
            $this->values[$key] = $value;
        }
    }

}

?>