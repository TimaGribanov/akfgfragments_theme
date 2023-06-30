-- `AKFGFRAGMENTS-DATA`.catalogue definition
CREATE TABLE `catalogue` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `num` varchar(100) NOT NULL COMMENT 'Catalogue number',
  `info` longtext DEFAULT NULL COMMENT 'Info about the version',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Table for storing additional info of different versions of releases';

-- `AKFGFRAGMENTS-DATA`.interviews definition
CREATE TABLE `interviews` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cover` varchar(256) DEFAULT NULL COMMENT 'URL to an interview cover pic',
  `date` date DEFAULT NULL COMMENT 'Date of an interview',
  `slug` varchar(100) NOT NULL COMMENT 'A slug for an interview',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Table to store basic info about interviews';

-- `AKFGFRAGMENTS-DATA`.interviews_text definition
CREATE TABLE `interviews_text` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `interview_id` int(11) NOT NULL COMMENT 'An ID of an entity from interviews table',
  `lang` varchar(2) NOT NULL COMMENT 'Locale of the current text',
  `title` varchar(256) NOT NULL COMMENT 'A title of the interview',
  `text` text NOT NULL COMMENT 'Text of an interview',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='A table to store texts of interviews in different languages';

-- `AKFGFRAGMENTS-DATA`.music_videos definition
CREATE TABLE `music_videos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title_ro` varchar(100) NOT NULL COMMENT 'Title in romaji',
  `director` int(11) DEFAULT NULL COMMENT 'Director''s name',
  `date` date DEFAULT NULL COMMENT 'Date of release',
  `url` text NOT NULL COMMENT 'Link to the video',
  `type` varchar(10) NOT NULL COMMENT 'Type of the video source: youtube or local',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- `AKFGFRAGMENTS-DATA`.personnel definition
CREATE TABLE `personnel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ja` varchar(100) NOT NULL,
  `en` varchar(100) NOT NULL,
  `ru` varchar(100) DEFAULT NULL,
  `uk` varchar(100) DEFAULT NULL,
  `be` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Table for different people''s names in different languages';

INSERT INTO `AKFGFRAGMENTS-DATA`.personnel (ja,en,ru,uk,be) VALUES
	 ('後藤 正文','Masafumi Gotoh','Масафуми Гото','Масафумі Ґото','Масафумі Ґото'),
	 ('喜多 建介','Kensuke Kita','Кэнскэ Кита','Кенске Кіта','Кэнскэ Кіта'),
	 ('山田 貴洋','Takahiro Yamada','Такахиро Ямада','Такахіро Ямада','Такахіро Ямада'),
	 ('伊地知 潔','Kiyoshi Ijichi','Киёси Идзити','Кійосі Ідзіті','Кіёсі Ідзіці'),
	 ('宮野敏一','Toshikazu Miyano','Тосикадзу Мияно','Тосікадзу Міяно','Тосікадзу Міяно'),
	 ('竹内スグル','Suguru Takeuchi','Сугуру Такэути','Суґуру Такеуті','Суґуру Такэуці');

-- `AKFGFRAGMENTS-DATA`.tab_types definition
CREATE TABLE `tab_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(50) NOT NULL COMMENT 'Guitar Pro, MuseScore',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `AKFGFRAGMENTS-DATA`.tab_types (`type`) VALUES
	 ('Guitar Pro'),
	 ('MuseScore');

-- `AKFGFRAGMENTS-DATA`.tabs definition
CREATE TABLE `tabs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `song_id` int(11) NOT NULL COMMENT 'Id of a song based on songs table',
  `type` int(11) NOT NULL COMMENT 'Id of a tab type based on tab_types table',
  `file` varchar(100) NOT NULL COMMENT 'Name of the file',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- change data type for catalogue column of `AKFGFRAGMENTS-DATA`.releases
ALTER TABLE `releases` MODIFY catalogue varchar(100);

-- add new columns to `AKFGFRAGMENTS-DATA`.types
ALTER TABLE `types` ADD COLUMN `type_de` varchar(20);
ALTER TABLE `types` ADD COLUMN `type_es` varchar(20);
ALTER TABLE `types` ADD COLUMN `type_fr` varchar(20);
ALTER TABLE `types` ADD COLUMN `type_ru` varchar(20);
ALTER TABLE `types` ADD COLUMN `type_uk` varchar(20);
ALTER TABLE `types` ADD COLUMN `type_be` varchar(20);
ALTER TABLE `types` ADD COLUMN `type_fi` varchar(20);
ALTER TABLE `types` ADD COLUMN `type_pt` varchar(20);
ALTER TABLE `types` ADD COLUMN `type_ja` varchar(20);

-- add data to new columns of `AKFGFRAGMENTS-DATA`.types
UPDATE `AKFGFRAGMENTS-DATA`.types
SET type_de='album', type_es=NULL, type_fr=NULL, type_ru='альбом', type_uk='альбом', type_be='альбом', type_fi=NULL, type_pt=NULL, type_ja='альбом'
WHERE id=1;

UPDATE `AKFGFRAGMENTS-DATA`.types
SET type_de='single', type_es=NULL, type_fr=NULL, type_ru='сингл', type_uk='сінгл', type_be='сінгл', type_fi=NULL, type_pt=NULL, type_ja='シングル'
WHERE id=2;

UPDATE `AKFGFRAGMENTS-DATA`.types
SET type_de='mini-album', type_es=NULL, type_fr=NULL, type_ru='мини-альбом', type_uk='міні-альбом', type_be='міні-альбом', type_fi=NULL, type_pt=NULL, type_ja='ミニアルバム'
WHERE id=3;

UPDATE `AKFGFRAGMENTS-DATA`.types
SET type_de='kompilation', type_es=NULL, type_fr=NULL, type_ru='сборник', type_uk='збірка', type_be='зборнік', type_fi=NULL, type_pt=NULL, type_ja='コンピレーション'
WHERE id=4;

UPDATE `AKFGFRAGMENTS-DATA`.types
SET type_de='indie', type_es=NULL, type_fr=NULL, type_ru='инди', type_uk='інді', type_be='індзі', type_fi=NULL, type_pt=NULL, type_ja='インディー'
WHERE id=5;

UPDATE `AKFGFRAGMENTS-DATA`.types
SET type_de='videoalbum', type_es=NULL, type_fr=NULL, type_ru='видео', type_uk='відео', type_be='відэа', type_fi=NULL, type_pt=NULL, type_ja='ビデオ'
WHERE id=6;

UPDATE `AKFGFRAGMENTS-DATA`.types
SET type_de='andere', type_es=NULL, type_fr=NULL, type_ru='другое', type_uk='інше', type_be='іншае', type_fi=NULL, type_pt=NULL, type_ja='その他'
WHERE id=7;