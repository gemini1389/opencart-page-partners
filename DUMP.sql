SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `oc_partners`
-- ----------------------------
DROP TABLE IF EXISTS `oc_partners`;
CREATE TABLE `oc_partners` (
  `partner_id` int(11) NOT NULL AUTO_INCREMENT,
  `sort_order` int(3) DEFAULT '0',
  `status` tinyint(1) DEFAULT '0',
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`partner_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `oc_partners_descriptions`
-- ----------------------------
DROP TABLE IF EXISTS `oc_partners_descriptions`;
CREATE TABLE `oc_partners_descriptions` (
  `partner_id` int(11) unsigned NOT NULL,
  `language_id` int(11) unsigned NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`partner_id`,`language_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
