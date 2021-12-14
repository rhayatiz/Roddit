<?php
require_once(ROOT_FOLDER.'controllers/Controller.php');
require_once(ROOT_FOLDER.'DAO/LikeDao.php');

class LikeController extends Controller
{
    public function actionLikePost($idUser, $idPost, $statut)
    {
        return (new LikeDao())->actionLikePost($idPost, $idUser, $statut);
    }
}