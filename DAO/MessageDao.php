<?php
include(ROOT_FOLDER.'/models/Message.php');

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
}
