-- Create a music_videos table
CREATE TABLE `music_videos` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `title_ro` varchar(100) NOT NULL COMMENT 'Title in romaji',
    `director` int(11) DEFAULT NULL COMMENT 'Director''s name',
    `date` date DEFAULT NULL COMMENT 'Date of release',
    `url` text NOT NULL COMMENT 'Link to the video',
    `type` varchar(10) NOT NULL COMMENT 'Type of the video source: youtue or local',
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

-- Enhance the length of the cataogue column in releases table
ALTER TABLE `releases`
MODIFY COLUMN catalogue varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL NULL COMMENT 'Catalogue number';