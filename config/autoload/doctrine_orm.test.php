<?php

return array(
    'doctrine' => array(
        'connection' => array(
            'orm_default' => array(
                'driverClass' => 'Doctrine\DBAL\Driver\PDOPgSql\Driver',
                'params' => array(
                    'host' => '127.0.0.1',
                    'port' => '5432',
                    'user' => 'postgres',
                    'password' => '',
                    'dbname' => 'ai_test',
                    'driverOptions' => array(),
                ),
            ),
        ),
    ),
);
