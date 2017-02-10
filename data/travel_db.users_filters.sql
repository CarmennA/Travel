CREATE TABLE `users_filters` (
  `UserId` int(11) NOT NULL,
  `FilterId` int(11) NOT NULL,
  PRIMARY KEY (`UserId`,`FilterId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;