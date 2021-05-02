# import_export_csv_test
Programa simple para importar y exportar un archivo csv

El programa está construido en PHP 7.4.9 con BBDD MySQL.

Primero debe crearse la base de datos, para el ejemplo la prueba se usó la BBDD pruebacsv, pero igualmente esta se puede modificar en el archivo db_connect.

Debe crearse las tablas correspondientes:

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



El sistema tiene una vista index.php, en donde se puede seleccionar el archivo csv, un botón para importarlo a la BBDD y uno para convertir los datos de la BBDD nuevamente en un archivo csv.

El formato del archivo csv a importar es el siguiente:
id|"nombre_completo"|"cod_entidad"|"cod_tramo"|"estado"|"fecha"|"causales"

Mientras que el archivo a exportar es el siguiente:
"id"|"nombre"|"apellido_paterno"|"apellido_materno"|"cod_entidad"|"cod_tramo"|"estado"|"fecha"|"causales"

Igualmente, se dejará un archivo .txt en donde se especifican los requerimientos que se solicitaban para este caso junto con el archivo csv con el que se hizo la prueba.


