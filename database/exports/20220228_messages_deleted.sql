ALTER TABLE `messages` 
ADD `deleted` BOOLEAN NOT NULL AFTER `parent_message_id`; 