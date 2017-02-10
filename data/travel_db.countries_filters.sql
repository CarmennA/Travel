CREATE TABLE `countries_filters` (
  `CountryCode` char(2) NOT NULL,
  `FilterId` int(11) NOT NULL,
  PRIMARY KEY (`CountryCode`,`FilterId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;