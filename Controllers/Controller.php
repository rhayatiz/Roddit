<?php
namespace Controllers;

use helpers\Auth;

class Controller
{
    protected $viewPath = './views/';
    protected $user = null;

    public function __construct()
    {
        $this->user = Auth::user();
    }

    /**
     * $view = chemin ou nom de la vue à charger (sans extension .html)
     *          si la vue est dans un sous dossier (ex: $viewpath/dashboard/mavue.html)
     *          on remplace les / par des points .
     *          $view devient dashboard.mavue
     *          render('dashboard.mavue');
     * $data = tableau qui contient le nom des variables à envoyer à la vue, ces variables
     *          seront accessible dans cette vue
     */

    public function render($view, $data = []){
        // DEBUGGING
        // echo "opening ".$this->viewPath . str_replace('.', '/', $view). '.php';
        // die();
        $data['Auth'] = $this->user;
        ob_start();
        extract($data);
        require($this->viewPath . str_replace('.', '/', $view). '.php');
    }

}