<?php
namespace DAO;

use Models\Post as Post;
use DAO\DatabasePDO;
use PDO;

/**
 * PostDao : CRUD
 */
class PostDao
{
        static $pdo=null;

        function __construct(){
                PostDao::$pdo = DatabasePDO::getInstance();
        }

        function list(){//1 - Lire Données
                $sql='SELECT
                            *, 
                        (SELECT COUNT(*) 
                            FROM `like` 
                            WHERE idPost = posts.id 
                              and `like`.statut = 2) as nbLike, 
                        (SELECT COUNT(*) 
                            FROM `like` 
                            WHERE idPost = posts.id 
                                and `like`.statut = 1) as nbDislike
                        FROM
                             posts
                        ORDER BY
                                 id
                        DESC';
                $stm = self::$pdo->query($sql);
                $posts = $stm->fetchAll(PDO::FETCH_CLASS, Post::class); //FETCH_BOTH - FETCH_CLASS - FETCH_ASSOC

                //TODO, add put next logic postRepository instead of DAO
                foreach ($posts as $post) {
                        //remplacer les retour à la ligne \n par des <br>
                        $array = explode("\n", $post->body);
                        $post->body = implode("<br>", $array);
                        //Ajouter le nom de l'utilisateur au post
                        $post->created_by = (new UserDao)->get($post->created_by)->username;
                }


                return $posts;
        }

        function listByUser($userId){
                //1 - Lire Données
                $sql='SELECT * FROM posts WHERE created_by = ? ORDER BY id DESC';
                $stm = self::$pdo->prepare($sql);
                $stm->execute([$userId]);
                $posts = $stm->fetchAll(PDO::FETCH_CLASS, Post::class); //FETCH_BOTH - FETCH_CLASS - FETCH_ASSOC

                //TODO, add put next logic postRepository instead of DAO
                foreach ($posts as $post) {
                        //remplacer les retour à la ligne \n par des <br>
                        $array = explode("\n", $post->body);
                        $post->body = implode("<br>", $array);
                        //Ajouter le nom de l'utilisateur au post
                        $post->created_by = (new UserDao)->get($post->created_by)->username;
                }


                return $posts;
        }

        function listLikedPostsByUser($userId){
                //1 - Lire Données
                $sql='SELECT * FROM posts WHERE posts.id IN (select idPost from `like` where statut = 2 and idUser = ?)
                ORDER BY id DESC';
                $stm = self::$pdo->prepare($sql);
                $stm->execute([$userId]);
                $posts = $stm->fetchAll(PDO::FETCH_CLASS, Post::class); //FETCH_BOTH - FETCH_CLASS - FETCH_ASSOC

                //TODO, add put next logic postRepository instead of DAO
                foreach ($posts as $post) {
                        //remplacer les retour à la ligne \n par des <br>
                        $array = explode("\n", $post->body);
                        $post->body = implode("<br>", $array);
                        //Ajouter le nom de l'utilisateur au post
                        $post->created_by = (new UserDao)->get($post->created_by)->username;
                }


                return $posts;
        }

        function get($id){
                $sql = 'SELECT * FROM posts WHERE id = ?';
                $stm = self::$pdo->prepare($sql);
                $stm->execute([$id]);
                if($stm->rowCount()>0){
                        return $stm->fetchAll(PDO::FETCH_CLASS, Post::class)[0]; 
                }
        }


        function delete($id){
                $sql = 'DELETE FROM posts WHERE id = ?';
                $stm = self::$pdo->prepare($sql);
                $stm->execute([$id]);
                if($stm->rowCount()>0){
                        return 'Enregistrement supprimé!';
                }
        }

        function create($titre,$text)
        {
                $sql = 'INSERT INTO posts(title,body,created_at,created_by) VALUE(?,?,?,?)';
                $stm = self::$pdo->prepare($sql);
                $args = array($titre,$text,date("Y-m-d"),$_SESSION['userId']);
                $stm->execute($args);
                
                if($stm->rowCount()>0){
                return self::$pdo->lastInsertId();
                }
        }
}