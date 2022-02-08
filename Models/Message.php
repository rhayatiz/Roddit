<?php

require_once('Model.php');

if (!interface_exists('JsonSerializable')) {
    interface JsonSerializable {
       public function jsonSerialize();
    }
}

class Message extends Model implements JsonSerializable {

    public function __construct(){}


    /* On retourne Message dans l'api en tant que JSON
    / Pour transformer un objet php en json, il faut qu'il implemente JsonSerializable
    / On définit dans cette fonction les propriétés qu'on veut "sérializer"
    */
    public function jsonSerialize() {
        return Array(
           'id' => $this->id,
           'subject' => $this->subject,
           'body'   => $this->body,
           'created_at'   => $this->created_at,
           'sender'   => $this->sender,
           'is_read'   => $this->is_read,
        //    'obj'    => $this->obj->jsonSerialize(), // example for other objects
        //    'time'   => $this->time
        );
    }
}