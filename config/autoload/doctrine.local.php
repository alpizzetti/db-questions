<?php

return array(
    'doctrine' => array(
        'connection' => array(
            'orm_default' => array(
                'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
                'params' => array(
                    'host' => 'pizzetti.net',
                    'port' => '3306',
                    'dbname' => 'pizzet31_pi',
                    'user' => 'pizzet31_pi',
                    'password' => 'jONshHuJV8YW',
                    'driverOptions' => array(
                        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"
                    )
                )
            )
        )
    ),
);
