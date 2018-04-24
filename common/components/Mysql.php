<?php
/**
 * @description     Mysql
 * @author          conkayyan<conkay@foxmail.com>
 * @Date            2017/11/26
 */
namespace common\components;

use common\components\mysqli\Db;

class Mysql
{
    /**
     * @var mysqli\Connect $instance
     */
    static protected $instance;
    /**
     * @var mysqli\Connect $masterInstance
     */
    static protected $masterInstance;
    /**
     * @var mysqli\Connect $slaveInstance1
     */
    static protected $slaveInstance1;

    /**
     * @param string $db
     * @return mysqli\Connect
     */
    static public function db($db = 'master')
    {
        (new Db())->setInstance($db);
        self::$instance = clone Db::$instance;
        return self::$instance;
    }

    /**
     * @return mysqli\Connect
     */
    static public function masterDb()
    {
        (new Db())->setInstance('master');
        self::$masterInstance = clone Db::$instance;
        return self::$masterInstance;
    }

    /**
     * @return mysqli\Connect
     */
    static public function slaveDb1()
    {
        (new Db())->setInstance('slave1');
        self::$slaveInstance1 = clone Db::$instance;
        return self::$slaveInstance1;
    }
}