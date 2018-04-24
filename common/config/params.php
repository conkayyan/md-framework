<?php
/**
 * @description     params
 * @author          conkayyan<conkay@foxmail.com>
 * @Date            2017/9/11
 */
return [
    'mysql' => [
        'master'    => [
            'host'      => '127.0.0.1',
            'username'  => 'root',
            'password'  => 'root',
            'db'        => 'md',
            'port'      => '3306',
            'prefix'    => 'md_',
            'charset'   => 'utf8'
        ],
        'slave'     => [
            'slave1'    => [
                'host'      => '127.0.0.1',
                'username'  => 'root',
                'password'  => 'root',
                'db'        => 'md',
                'port'      => '3306',
                'prefix'    => 'md_',
                'charset'   => 'utf8'
            ],
            'slave2'    => [
                'host'      => '127.0.0.1',
                'username'  => 'root',
                'password'  => 'root',
                'db'        => 'md',
                'port'      => '3306',
                'prefix'    => 'md_',
                'charset'   => 'utf8'
            ],
        ]
    ],
    'timezone'  => 'Asia/Shanghai',
    'params'    => []
];