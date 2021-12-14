<?php
require_once(ROOT_FOLDER.'controllers/Controller.php');
require_once(ROOT_FOLDER.'DAO/UserDao.php');
require_once(ROOT_FOLDER.'DAO/PostDao.php');

class PostController extends Controller{

    public function show($id){
        $post = (new PostDao)->get($id);
        $this->render('post', compact('post'));
    }

}