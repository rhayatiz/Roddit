<?php
include(ROOT_FOLDER . '/models/Remark.php');

/**
 * RemarkDao : CRUD
 */
class RemarkDao
{
    static $pdo = null;

    function __construct()
    {
        RemarkDao::$pdo = DatabasePDO::getInstance();
    }

    function list($postID)
    { //1 - Lire Données
        $sql = 'SELECT * FROM remark WHERE post = ? ORDER BY id DESC';
        $stm = self::$pdo->prepare($sql);
        $stm->execute([$postID]);
        $remarks = $stm->fetchAll(PDO::FETCH_CLASS, 'Remark'); //FETCH_BOTH - FETCH_CLASS - FETCH_ASSOC
        foreach ($remarks as $remark) {
            $date = new DateTime($remark->date);
            $remark->date = $date->format('d-m-Y H:i:s');
            //Ajouter le nom de l'utilisateur au remark
            $remark->user = (new UserDao)->get($remark->user);
    }
        return $remarks;
    }

    function get($id)
    {
        $sql = 'SELECT * FROM remark WHERE id = ?';
        $stm = self::$pdo->prepare($sql);
        $stm->execute([$id]);
        return $stm->fetchAll(PDO::FETCH_CLASS, 'Remark')[0];
    }


    function delete($id)
    {
        $sql = 'DELETE FROM remark WHERE id = ?';
        $stm = self::$pdo->prepare($sql);
        $stm->execute([$id]);
        if ($stm->rowCount() > 0) {
            return 'Enregistrement supprimé!';
        }
    }

    function create($user, $remark, $date)
    {
        $sql = 'INSERT INTO `remark`(`user`, `remark`, `date`) VALUES (?,?,?)';
        $stm = self::$pdo->prepare($sql);
        
        $args = array(
            $user->getId(),
            $remark,
            $date);
        $stm->execute($args);
        
        if($stm->rowCount()>0){
            return self::$pdo->lastInsertId();
        }
    }
}
