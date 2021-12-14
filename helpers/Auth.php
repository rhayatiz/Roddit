<?php 
class Auth {
    protected static $user = null;
    /**
     * récupère l'utilisateur connecté, si user est défini dans la session
     *
     * @return User | null 
     */
    public static function user(){
        //TODO session['user'] doit contenir l'id de l'utilisateur
        //si défini, on doit appeler userDAO et récupérer l'user à partir de son id depuis la bdd
        if(isset($_SESSION['userId'])){
            if(empty(self::$user)){
                return (new UserDao())->get($_SESSION['userId']);
            }else{
                return self::$user;
            }
        }
        return null;
    }
}
?>