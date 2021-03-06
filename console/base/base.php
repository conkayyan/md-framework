<?php
/**
 * @description     Base
 * @author          conkayyan<conkay@foxmail.com>
 * @Date            2017/11/11
 */
defined('MD_DEBUG') or define('MD_DEBUG', true);

require(__DIR__ . '/../../vendor/autoload.php');
require(__DIR__ . '/../config/bootstrap.php');

$config = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../config/params.php')
);
(new common\components\Console($config))->run();