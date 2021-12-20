<?php
require_once(ROOT_FOLDER.'controllers/Controller.php');
require_once(ROOT_FOLDER.'DAO/LikeDao.php');

class LikeController extends Controller
{
    public function actionLikePost($idUser, $idPost, $statut)
    {
//        var_dump((new LikeDao())->actionLikePost($idPost, $idUser, $statut));
//        die();
        return (new LikeDao())->actionLikePost($idPost, $idUser, $statut);
    }

    public function getAllLikedPostByUser($idUser)
    {
        return (new LikeDao())->listByUser($idUser);
    }
}