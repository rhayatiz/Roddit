<?php
namespace Models;

use JsonSerializable;

class Post extends Model implements JsonSerializable{

    public function __construct(){}
    /* On retourne Message dans l'api en tant que JSON
    / Pour transformer un objet php en json, il faut qu'il implemente JsonSerializable
    / On définit dans cette fonction les propriétés qu'on veut "sérializer"
    */
    public function jsonSerialize() {
        return Array(
           'id' => $this->id,
           'title' => $this->title,
           'body'   => $this->body,
           'created_at'   => $this->created_at,
           'created_by'   => $this->created_by,
        );
    }

}