<?php
namespace Controllers;

use DAO\PostDao;

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