--
-- Table structure for table `todo`
--
--

CREATE TABLE `todo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text COLLATE utf8_unicode_ci NOT NULL,
  `priority` int(11) DEFAULT 0,
  `done` bit DEFAULT 0,
  `version` bigint DEFAULT 0,
   PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=421 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

