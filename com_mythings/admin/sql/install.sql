#
# Tabelle `#__mythings`
# Kapitel 15
# Neue Spalten fuer ACL und Kategorien
#

DROP TABLE IF EXISTS `#__mythings`;
CREATE TABLE IF NOT EXISTS `#__mythings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `owner_id` smallint(11) DEFAULT NULL,
  `category_id` smallint(11) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `description` text,
  `state` varchar(50) DEFAULT NULL,
  `value` varchar(12) DEFAULT NULL,
  `weight` varchar(12) DEFAULT NULL,
  `lent_by_id` smallint(11) DEFAULT NULL,
  `lent_from` datetime DEFAULT '0000-00-00 00:00:00',
  `lent_to` datetime DEFAULT '0000-00-00 00:00:00',
  `img` text,
  `hits` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

DELETE FROM `#__categories` WHERE `extension`= "com_mythings";
INSERT INTO `#__categories` (`id`, `asset_id`, `parent_id`, `lft`, `rgt`, `level`, `path`, `extension`, `title`, `alias`, `note`, `description`, `published`, `checked_out`, `checked_out_time`, `access`, `params`, `metadesc`, `metakey`, `metadata`, `created_user_id`, `created_time`, `modified_user_id`, `modified_time`, `hits`, `language`) 
VALUES (0,'0', '1', '0', '0', '1', 'uncategorised', 'com_mythings', 'Uncategorised', 'uncategorised', '', '', '1', '0', '0000-00-00 00:00:00', '1', '{"target":"","image":""}', '', '', '{"page_title":"","author":"","robots":""}', '42', '2012-07-08 12:29:00', '0', '0000-00-00 00:00:00', '0', '*')
