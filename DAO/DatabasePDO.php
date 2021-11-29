<?php
 
class DatabasePDO
{
  /**
   * Instance de la classe PDO
   *
   * @var PDOInstance
   * @access static
   */ 
  protected static  $PDOInstance = null;
 
   /**
   * Instance de la classe DatabasePDO
   *
   * @var DatabasePDO
   * @access private
   * @static
   */ 
  private static $instance = null;
 
  /**
   * Constante: nom d'utilisateur de la bdd
   *
   * @var string
   */
  const DATABASE_USER = 'root';
 
  /**
   * Constante: hôte de la bdd
   *
   * @var string
   */
  const DATABASE_HOST = 'localhost';
 
  /**
   * Constante: hôte de la bdd
   *
   * @var string
   */
  const DATABASE_PASS = '';
 
  /**
   * Constante: nom de la bdd
   *
   * @var string
   */
  const DATABASE_NAME = 'roddit';
 
  /**
   * Constructeur
   *
   * @param void
   * @return void
   * @see PDO::__construct()
   * @access private
   */
  protected function __construct()
  {}
 
   /**
    * Crée et retourne l'objet DatabasePDO
    *
    * @access public
    * @static
    * @param void
    * @return DatabasePDO $instance
    */
  public static function getInstance()
  {  
    if(empty(self::$instance))
    {
      	try{  
			self::$PDOInstance = new PDO('mysql:host=' . self::DATABASE_HOST . ';dbname=' . self::DATABASE_NAME . ';charset=utf8', self::DATABASE_USER, self::DATABASE_PASS);

			self::$PDOInstance->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		  	//echo 'PDO créé : Connection OK!';
		}catch(PDOException $e){
		   die('Erreur : ' . $e->getMessage());
		}
    }
    return self::$PDOInstance;
  }
}