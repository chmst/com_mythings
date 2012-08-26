#
# Anpassung der Tabelle #__mythings 
# Buch "Joomla! 2.5 - Erweiterungen programmieren" aus dem Franzis-Verlag
#
# Aktualisieren der Tabellenstruktur fuer Kapitel '15'
# Neue Spalten hinzufügen
#
###################################################################

ALTER TABLE `#__mythings`
ADD `img`     TEXT,
ADD `hits`    INT(11),
ADD `lent_to` DATETIME DEFAULT '0000-00-00 00:00:00' AFTER `lent`;

#
# Spaltennamen ändern
# "user" und "category" zu  Zahlwerten ändern, um dort user_id bzw. category_id zu speichern
#

ALTER TABLE `#__mythings`
CHANGE `category` `category_id`  SMALLINT(11),
CHANGE `owner`    `owner_id`     SMALLINT(11),
CHANGE `lent_by`  `lent_by_id`   SMALLINT(11),
CHANGE `lent`     `lent_from`    DATETIME;

#
# Eine Kategorie "uncategorized" für com_mythings 
# löschen falls vorhanden und neu aufnehmen
#

DELETE FROM `#__categories` WHERE `extension`= "com_mythings";
INSERT INTO `#__categories`(`asset_id`, `parent_id`, `lft`, `rgt`, `level`, `path`, `extension`, `title`, `alias`, `note`, `description`, `published`, `checked_out`, `checked_out_time`, `access`, `params`, `metadesc`, `metakey`, `metadata`, `created_user_id`, `created_time`, `modified_user_id`, `modified_time`, `hits`, `language`) 
VALUES ('0', '1', '0', '0', '1', 'uncategorised', 'com_mythings', 'Uncategorised', 'uncategorised', '', '', '1', '0', '0000-00-00 00:00:00', '1', '{"target":"","image":""}', '', '', '{"page_title":"","author":"","robots":""}', '42', '2012-07-08 12:29:00', '0', '0000-00-00 00:00:00', '0', '*');

#
# Die id der Kategorie "uncategorised" als category_id in vorhandene 
# Sätze der Tabelle `#__mythings `aufnehmen
#
UPDATE `#__mythings` SET `category_id` = (SELECT `id` from `#__categories` WHERE `extension` = "com_mythings");

