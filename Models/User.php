<?php

require('Model.php');

class User {
    protected $nom;
    private $prenom;
    private $username;
    private $email;
    private $password;
    private $dateNaissance;
    private $role;

    function __construct($nom, $username ,$prenom, $email, $dateNaissance, $password, $role)
    {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->username = $username;
        $this->email = $email;
        $this->dateNaissance = $dateNaissance;
        $this->password = $password;
        $this->role = $role;
    }

    public function getUsername(){
        return $this->username;
    }

    public function getNom(){
        return $this->nom;
    }

    function setNom($nom){
        $this->nom = $nom;
    }

    function getRole(){
        return $this->role;
    }

    function setRole($role){
        $this->role = $role;
    }

    function getPrenom(){
        return $this->prenom;
    }

    function setPrenom($prenom){
        $this->prenom = $prenom;
    }

    function getEmail(){
        return $this->email;
    }

    function setEmail($email){
        $this->email = $email;
    }

    function getDateNaissance(){
        return $this->dateNaissance;
    }

    function setDateNaissance($dateNaissance){
        $this->dateNaissance = $dateNaissance;
    }

    function getPassword(){
        return $this->password;
    }

    function setPassword($password){
        $this->password = $password;
    }
}