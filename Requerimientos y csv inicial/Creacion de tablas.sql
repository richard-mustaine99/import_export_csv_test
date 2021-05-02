CREATE TABLE IF NOT EXISTS `beneficiarios` (
`id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'primary key',
`ben_id` int(11) NOT NULL,
`ben_nombre` varchar(255) NOT NULL,
`ben_apellidop` varchar(255) NOT NULL,
`ben_apellidom` varchar(255) NOT NULL,
`ben_cod_entidad` varchar(100) NOT NULL,
`ben_cod_tramo` varchar(100) NOT NULL,
`ben_estado` varchar(100) NOT NULL,
`ben_fecha` date NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `causales` (
`caus_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'primary key',
`beneficiario_id` int(11) NOT NULL,
`causales` varchar(255) NOT NULL,
PRIMARY KEY (`caus_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;