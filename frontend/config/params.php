<?php
/**
 * @description     params
 * @author          conkayyan<conkay@foxmail.com>
 * @Date            2017/6/17
 */
return [
    'app'   => 'frontend',
    'url'   => [
        ['GET', '/', 'frontend\controllers\HomeController@index'],
        [['POST', 'GET'], '/[:controller].[csv|json|html]'],
        [['POST', 'GET'], '/[:controller]/[:action].[csv|json|html]']
    ],
    'controller'    => 'frontend\controllers',
    'view'          => 'frontend\view',
    'notFound'      => 'common\controllers\Controller@empty',
];