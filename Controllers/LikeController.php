<?php
namespace Controllers;

use DAO\LikeDao;

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
        $data = (new LikeDao())->listByUser($idUser);

        $dataArray = [];
        foreach ($data as $d)
        {
            $temp = array(
                'idUser' => $d->idUser,
                'idPost' => $d->idPost,
                'statut' => $d->statut,
                'dateLike' => $d->dateLike,
                'nbLike' =>$d->nbLike,
                'nbDislike' =>$d->nbDislike,
            );

            array_push($dataArray, $temp);
        }
        return $dataArray;
    }
}