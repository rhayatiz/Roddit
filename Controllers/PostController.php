<?php
require_once(ROOT_FOLDER.'controllers/Controller.php');
require_once(ROOT_FOLDER.'DAO/UserDao.php');
require_once(ROOT_FOLDER.'DAO/PostDao.php');

class PostController extends Controller{

    public function show($id){
        $post = (new PostDao)->get($id);
        $this->render('post', compact('post'));
    }

    public function createPost($titre,$text)
    {
        (new PostDao())->create($titre,$text);
        header('Location: index.php');
    }
}