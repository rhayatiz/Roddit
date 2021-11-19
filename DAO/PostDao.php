<?php
// include(ROOT_FOLDER.'/Models/.php');

/**
 * ProduitDao : mise en place CRUD pour users
 */
class ProduitDao
{
	static $pdo=null;

	function __construct(){
        ProduitDao::$pdo = DatabasePDO::getInstance();
	}

	function list(){//1 - Lire Données
        $sql='SELECT * FROM posts';
        $stm = self::$pdo->query($sql);
        $posts = $stm->fetchAll(PDO::FETCH_CLASS); //FETCH_BOTH - FETCH_CLASS - FETCH_ASSOC
        return $posts;
	}

	function get($id){
        $sql = 'SELECT * FROM posts WHERE id = ?';
        $stm = self::$pdo->prepare($sql);
        $stm->execute([$id]);
        return $stm->fetch(PDO::FETCH_ASSOC); 
    }

	function create($libelle,$description,$stock,$img, $prix, $categorie){
	}

	function delete($id){
        $sql = 'DELETE FROM posts WHERE id = ?';
        $stm = self::$pdo->prepare($sql);
        $stm->execute([$id]);
        if($stm->rowCount()>0){
            return 'Enregistrement supprimé!';
        }
	}

}