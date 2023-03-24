-- Create a music_videos table
CREATE TABLE `music_videos` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `title_ro` varchar(100) NOT NULL COMMENT 'Title in romaji',
    `director` int(11) DEFAULT NULL COMMENT 'Director''s name',
    `date` date DEFAULT NULL COMMENT 'Date of release',
    `url` text NOT NULL COMMENT 'Link to the video',
    `type` varchar(10) NOT NULL COMMENT 'Type of the video source: youtube or local',
    PRIMARY KEY (`id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- Create a personnel table
CREATE TABLE `personnel` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `ja` varchar(100) NOT NULL,
    `en` varchar(100) NOT NULL,
    `ru` varchar(100) DEFAULT NULL,
    `uk` varchar(100) DEFAULT NULL,
    `be` varchar(100) DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = 'Table for different people''s names in different languages';

-- Create a catalogue table
CREATE TABLE `catalogue` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `num` varchar(100) NOT NULL COMMENT 'Catalogue number',
  `info` longtext DEFAULT NULL COMMENT 'Info about the version',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Table for storing additional info of different versions of releases';

-- Create interviews table
CREATE TABLE `interviews` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cover` varchar(256) DEFAULT NULL COMMENT 'URL to an interview cover pic',
  `year` date DEFAULT NULL COMMENT 'Date of an interview',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Table to store basic info about interviews';

-- Create interviews_text table
CREATE TABLE `interviews_text` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `interview_id` int(11) NOT NULL COMMENT 'An ID of an entity from interviews table',
  `lang` varchar(2) NOT NULL COMMENT 'Locale of the current text',
  `title` varchar(256) NOT NULL COMMENT 'A title of the interview',
  `text` text NOT NULL COMMENT 'Text of an interview',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='A table to store texts of interviews in different languages';

-- Enhance the length of the cataogue column in releases table
ALTER TABLE `releases`
MODIFY COLUMN catalogue varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL NULL COMMENT 'Catalogue number';

-- Create a table for tabulatures's types
CREATE TABLE IF NOT EXISTS `tab_types` (
    `id` int NOT NULL AUTO_INCREMENT,
    `type` varchar(50) NOT NULL COMMENT 'Guitar Pro, MuseScore',
    PRIMARY KEY(`id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

INSERT INTO tab_types (id, type)
VALUES (default, 'Guitar Pro'),
    (default, 'MuseScore');

-- Create a table for tabulatures
CREATE TABLE IF NOT EXISTS `tabs` (
    `id` int NOT NULL AUTO_INCREMENT,
    `song_id` int NOT NULL COMMENT 'Id of a song based on songs table',
    `type` int NOT NULL COMMENT 'Id of a tab type based on tab_types table',
    `file` varchar(100) NOT NULL COMMENT 'Name of the file',
    PRIMARY KEY(`id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;