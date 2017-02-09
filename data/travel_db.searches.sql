CREATE TABLE `searches` (
  `CountryCode` char(2) NOT NULL,
  `Searches` int(11) NOT NULL DEFAULT '0',
  `Order` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`CountryCode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;