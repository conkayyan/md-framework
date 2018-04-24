<?php
/**
 * @description     Connect
 * @author          conkayyan<conkay@foxmail.com>
 * @Date            2017/9/11
 */
namespace common\components\mysqli;

/**
 * Class Connect
 * @package common\components\mysqli
 */
class Connect extends \MysqliDb
{
    /**
     * Connect constructor.
     * @param null $host
     * @param null $username
     * @param null $password
     * @param null $db
     * @param null $port
     * @param string $charset
     * @param null $socket
     */
    public function __construct($host = null, $username = null, $password = null, $db = null, $port = null, $charset = 'utf8', $socket = null)
    {
        parent::__construct($host, $username, $password, $db, $port, $charset, $socket);
    }
}