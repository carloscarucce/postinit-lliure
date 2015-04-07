CREATE TABLE IF NOT EXISTS `ll_postinit` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `author` varchar(150) NOT NULL,
  `post` text NOT NULL,
  `date` datetime NOT NULL,
  `imagem` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;