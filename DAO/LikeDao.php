<?php
include(ROOT_FOLDER.'/models/Like.php');

class LikeDao
{
    static $pdo=null;

    function __construct(){
        LikeDao::$pdo = DatabasePDO::getInstance();
    }

    function listByUser($userId){//1 - Lire Données
        $sql='SELECT * FROM `like` WHERE idUser = ? ORDER BY dateLike DESC';
        $stm = self::$pdo->prepare($sql);
        $stm->execute([$userId]);
        return $stm->fetchAll(PDO::FETCH_CLASS, 'Like');
    }

    function actionLikePost($idPost, $idUser, $statut)
    {
        $sql='SELECT * FROM `like` WHERE idPost = ? and idUser = ?';
        $stm = self::$pdo->prepare($sql);
        $stm->execute([$idPost, $idUser]);
        $dataFromBdd =  $stm->fetchAll(PDO::FETCH_CLASS, 'Like');

        $msg = [];

        if($dataFromBdd == null)
        {

            $dateTime = new DateTime('NOW');
            $dateTime = $dateTime->format('Y-m-d H:i:s');
            $sqlAdd = 'INSERT INTO `like` (idUser, idPost, statut, dateLike) VALUES (?,?,?,?)';
            $stmAdd = self::$pdo->prepare($sqlAdd);
            $stmAdd->execute([$idUser, $idPost, 1, $dateTime]);

            $msg = array(
                'data' => false,
            );
        }
        else
        {
            if($statut == 0 && $dataFromBdd[0]->statut == 0 || $statut == 1 && $dataFromBdd[0]->statut == 1)
            {
                $sqlRemove = 'DELETE FROM `like` where idUser = ? and idPost = ?';
                $stmRemove = self::$pdo->prepare($sqlRemove);
                $stmRemove->execute([$idUser, $idPost]);
            }
            else
            {
                $sqlRemove = 'UPDATE `like` SET statut = ? where idUser = ? and idPost = ?';
                $stmRemove = self::$pdo->prepare($sqlRemove);
                $stmRemove->execute([$statut, $idUser, $idPost]);
            }

            $msg = array(
                'data' => true,
            );
        }

        return $msg;
    }
}