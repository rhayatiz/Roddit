<?php
include(ROOT_FOLDER.'/models/Post.php');

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
                $sql='SELECT * FROM posts ORDER BY id DESC';
                $stm = self::$pdo->query($sql);
                $posts = $stm->fetchAll(PDO::FETCH_CLASS, 'Post'); //FETCH_BOTH - FETCH_CLASS - FETCH_ASSOC

                //TODO, add put next logic postRepository instead of DAO
                foreach ($posts as $post) {
                        //remplacer les retour à la ligne \n par des <br>
                        $array = explode("\n", $post->body);
                        $post->body = implode("<br>", $array);
                        //Ajouter le nom de l'utilisateur au post
                        $post->created_by = (new UserDao)->get($post->created_by)->username;
                        //Ajouter les commentaire du post
                        $post->remarks = (new RemarkDao)->list($post->id);
                }


                return $posts;
        }

        function get($id){
                $sql = 'SELECT * FROM posts WHERE id = ?';
                $stm = self::$pdo->prepare($sql);
                $stm->execute([$id]);
                $post = $stm->fetchAll(PDO::FETCH_CLASS, 'Post')[0]; 
                $post->remarks = (new RemarkDao)->list($post->id);
                return $post;
        }


        function delete($id){
                $sql = 'DELETE FROM posts WHERE id = ?';
                $stm = self::$pdo->prepare($sql);
                $stm->execute([$id]);
                if($stm->rowCount()>0){
                return 'Enregistrement supprimé!';
                }
        }
}