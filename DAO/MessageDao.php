<?php
namespace DAO;

use DateTime;
use Models\Message;
use PDO;
/**
 * MessageDao : CRUD
 */
class MessageDao
{
        static $pdo=null;

        function __construct(){
                MessageDao::$pdo = DatabasePDO::getInstance();
        }

        function getUnreadMessagesCount($userId){
            $sql = 'SELECT * FROM messages WHERE recipient_id = ? and is_read = 0';
            $stm = self::$pdo->prepare($sql);
            $stm->execute([$userId]);
            return $stm->rowCount();
        }

        function getUnreadMessages($userId){
                $sql = 'SELECT * FROM messages WHERE recipient_id = ? and is_read = 0';
                $stm = self::$pdo->prepare($sql);
                $stm->execute([$userId]);
                $unreadMessages = $stm->fetchAll(PDO::FETCH_CLASS, Message::class); //FETCH_BOTH - FETCH_CLASS - FETCH_ASSOC
                foreach ($unreadMessages as $k=>$message) {
                        //Ajouter le nom de l'utilisateur au message
                        $message->sender = (new UserDao)->get($message->sender_id)->username;
                }
                return $unreadMessages;

        }

        function getUserMessages($userId){
                $sql = "SELECT *
                        FROM   messages
                        WHERE  recipient_id = ?
                        AND parent_message_id IS NULL
                        AND id NOT IN (SELECT parent_message_id
                                        FROM   messages
                                        WHERE  parent_message_id IS NOT NULL
                                                AND recipient_id = ?)
                        UNION
                        SELECT *
                        FROM   messages m
                        WHERE  recipient_id = ?
                        AND parent_message_id IS NOT NULL
                        AND m.created_at = (SELECT Max(created_at)
                                                FROM   messages m1
                                                WHERE  m1.parent_message_id = m.parent_message_id
                                                        AND m1.recipient_id = m.recipient_id)
                        GROUP  BY parent_message_id ";
                $stm = self::$pdo->prepare($sql);
                $stm->execute([$userId, $userId, $userId]);
                $unreadMessages = $stm->fetchAll(PDO::FETCH_CLASS, Message::class); //FETCH_BOTH - FETCH_CLASS - FETCH_ASSOC
                foreach ($unreadMessages as $k=>$message) {
                        //Ajouter le nom de l'utilisateur au message
                        $message->sender = (new UserDao)->get($message->sender_id)->username;
                        if($message->subject == "" && $message->parent_message_id != NULL){
                                $parentSubject = (new MessageDao)->get($message->parent_message_id)->subject;
                                $message->subject =  $parentSubject;
                        }
                }
                return $unreadMessages;

        }

        function get($id){
                $sql = 'SELECT * FROM messages WHERE id = ?';
                $stm = self::$pdo->prepare($sql);
                $stm->execute([$id]);
                if($stm->rowCount()>0){
                        //Ajouter le nom de l'utilisateur au message
                        $message = $stm->fetchAll(PDO::FETCH_CLASS, Message::class)[0]; 
                        $message->sender = (new UserDao)->get($message->sender_id)->username;
                        if($message->subject == "" && $message->parent_message_id != NULL){
                                $parentSubject = (new MessageDao)->get($message->parent_message_id)->subject;
                                $message->subject =  $parentSubject;
                        }
                        return $message;
                }
                return null;
        }

        function getAllConversationMessages($message){
                $sql = "SELECT * 
                        FROM messages 
                        WHERE id = ?
                        OR parent_message_id = ?
                        ORDER BY created_at";
                $stm = self::$pdo->prepare($sql);
                $stm->execute([$message->parent_message_id, $message->parent_message_id]);
                $res = [];
                $conversationMessages = $stm->fetchAll(PDO::FETCH_CLASS, Message::class); //FETCH_BOTH - FETCH_CLASS - FETCH_ASSOC
                foreach ($conversationMessages as $conversationMessage) {
                        $res[] = $conversationMessage;
                }
                return $res;
        }

        function read($id){
                $sql = 'UPDATE messages SET is_read = 1 where id = ?';
                $stm = self::$pdo->prepare($sql);
                $stm->execute([$id]);
        }

        function createResponse($senderId, $recipientId, $body, $parentId){
                $dateTime = new DateTime('NOW');
                $created_at = $dateTime->format('Y-m-d H:i:s');
                $sql = 'INSERT INTO `messages` (body, sender_id, recipient_id, created_at, parent_message_id) VALUES (?,?,?,?,?)';
                $stm = self::$pdo->prepare($sql);
                $res = $stm->execute([$body, $senderId, $recipientId, $created_at, $parentId]);
                return $res;
        }

        function createMessage($senderId, $recipientId, $subject, $body){
                $dateTime = new DateTime('NOW');
                $created_at = $dateTime->format('Y-m-d H:i:s');
                $sql = 'INSERT INTO `messages` (body, sender_id, recipient_id, created_at, subject) VALUES (?,?,?,?,?)';
                $stm = self::$pdo->prepare($sql);
                $res = $stm->execute([$body, $senderId, $recipientId, $created_at, $subject]);
                return $res;
        }
}
