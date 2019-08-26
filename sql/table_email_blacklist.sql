/**
 * Author:  David Jacob <jacob@dev-man.de>
 * Created: 23.08.2019
 */

--
-- Tabellenstruktur für Tabelle `email_blacklist`
--

CREATE TABLE IF NOT EXISTS `email_blacklist` (
  `blacklist_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `blacklist_domain_name` varchar(100) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_modified` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`blacklist_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;