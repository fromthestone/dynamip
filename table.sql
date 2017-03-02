--
-- Table structure for table `dip_ip`
--

DROP TABLE IF EXISTS `dip_ip`;
CREATE TABLE IF NOT EXISTS `dip_ip` (
  `ip_id` int(11) NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(15) COLLATE utf8_bin DEFAULT NULL,
  `ip_datetime` datetime(6) DEFAULT NULL,
  `ip_hostname` varchar(60) COLLATE utf8_bin DEFAULT NULL,
  `ip_machinetag` varchar(25) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`ip_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC;