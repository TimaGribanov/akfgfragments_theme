--add Indonesian
ALTER TABLE `songs` ADD COLUMN `title_id` varchar(100);
ALTER TABLE `releases` ADD COLUMN `title_id` varchar(100);
ALTER TABLE `types` ADD COLUMN `type_id` varchar(20);