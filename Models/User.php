<?php
namespace Models;

use JsonSerializable;

class User extends Model implements JsonSerializable{

    public function __construct(){}
    /* On retourne Message dans l'api en tant que JSON
    / Pour transformer un objet php en json, il faut qu'il implemente JsonSerializable
    / On définit dans cette fonction les propriétés qu'on veut "sérializer"
    */
    public function jsonSerialize() {
        return Array(
           'id' => $this->id,
           'nom' => $this->nom,
           'prenom'   => $this->prenom,
           'dateNaissance'   => $this->dateNaissance,
           'password'   => $this->password,
           'role'   => $this->role,
           'email'   => $this->email,
        );
    }

}