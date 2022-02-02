<?php
include(ROOT_FOLDER.'/models/Like.php');

class LikeDao
{
    static $pdo=null;

    function __construct(){
        LikeDao::$pdo = DatabasePDO::getInstance();
    }

    function listByUser($userId){
        $sql='SELECT * FROM `like` INNER JOIN posts p on `like`.idPost = p.id where idUser = ? ORDER BY dateLike DESC';
        $stm = self::$pdo->prepare($sql);
        $stm->execute([$userId]);
        return $stm->fetchAll(PDO::FETCH_CLASS, 'Like');
    }


    // statut
    // 0 = a supprimer
    // 1 = dislike
    // 2 = like
    function actionLikePost($idPost, $idUser, $statut)
    {
        $sql='SELECT * FROM `like` WHERE idPost = ? and idUser = ?';
        $stm = self::$pdo->prepare($sql);
        $stm->execute([$idPost, $idUser]);
        $dataFromBdd =  $stm->fetchAll(PDO::FETCH_CLASS, 'Like');

        if($dataFromBdd == null)
        {
            // Si like
            if($statut == '2')
            {
                $dateTime = new DateTime('NOW');
                $dateTime = $dateTime->format('Y-m-d H:i:s');
                $sqlAdd = 'INSERT INTO `like` (idUser, idPost, statut, dateLike) VALUES (?,?,?,?)';
                $stmAdd = self::$pdo->prepare($sqlAdd);
                $stmAdd->execute([$idUser, $idPost, 2, $dateTime]);

                $data = '2';
            }
            // Si dislike
            else
            {
                $dateTime = new DateTime('NOW');
                $dateTime = $dateTime->format('Y-m-d H:i:s');
                $sqlAdd = 'INSERT INTO `like` (idUser, idPost, statut, dateLike) VALUES (?,?,?,?)';
                $stmAdd = self::$pdo->prepare($sqlAdd);
                $stmAdd->execute([$idUser, $idPost, 1, $dateTime]);

                $data = '1';
            }
        }
        else
        {
            // pour supprimer si le btn est deja actif
            if($statut == 1 && $dataFromBdd[0]->statut == 1 || $statut == 2 && $dataFromBdd[0]->statut == 2)
            {
                $sqlRemove = 'DELETE FROM `like` where idUser = ? and idPost = ?';
                $stmRemove = self::$pdo->prepare($sqlRemove);
                $stmRemove->execute([$idUser, $idPost]);

                $data = '0';
            }
            // Sinon mettre a j
            else
            {
                $sqlRemove = 'UPDATE `like` SET statut = ? where idUser = ? and idPost = ?';
                $stmRemove = self::$pdo->prepare($sqlRemove);
                $stmRemove->execute([$statut, $idUser, $idPost]);

                $data = $statut;
            }
        }

        // Récupérer les info pour le retour
        $sql='SELECT *, (SELECT COUNT(*) FROM `like` WHERE `like`.idPost = idPost and `like`.statut = 2) as nbLike, (SELECT COUNT(*) FROM `like` WHERE `like`.idPost = idPost and `like`.statut = 1) as nbDislike FROM `like` WHERE idPost = ?';
        $stm = self::$pdo->prepare($sql);
        $stm->execute([$idPost]);
        $dataFromBdd =  $stm->fetchAll(PDO::FETCH_CLASS, 'Like');

        return array(
            'data' => $data,
            'nbLike' => $dataFromBdd[0]->nbLike,
            'nbDislike' => $dataFromBdd[0]->nbDislike,
        );
    }
}