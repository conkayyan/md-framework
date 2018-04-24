<?php
/**
 * @description     Db
 * @author          conkayyan<conkay@foxmail.com>
 * @Date            2017/9/11
 */
namespace common\components\mysqli;

/**
 * Class Db
 * @package common\components\mysqli
 * @property bool $masterHandler
 * @property bool $slaveHandler
 */
class Db
{
    /**
     * @var array $config
     */
    static private $config = [];

    /**
     * @var $instance Connect
     */
    static public $instance;

    /**
     * @var array $data
     */
    private $data   = [];

    /**
     * MysqliDb constructor.
     * @param array $config
     */
    public function __construct($config = [])
    {
        if(self::$config) return;
        self::$config   = $config;
    }

    public function __get($name)
    {
        if(isset($this->data[$name]))return true;
        return false;
    }

    public function __set($name, $value = true)
    {
        $this->data[$name]  = $value;
        return true;
    }

    public function init()
    {
        if(!isset(self::$config['master']))throw new \Exception('Undefined master database configuration');
    }

    private function setMasterDb()
    {
        $this->masterHandler    = true;
        self::$instance = new Connect(self::$config['master']);
        self::$instance->autoReconnect  = false;
    }
    private function setSlaveDb($db)
    {
        $db_handler = $db . 'Handler';
        if($this->$db_handler) return;
        $this->data[$db . 'Handler']    = true;
        if(!isset(self::$config['slave'][$db])) throw new \Exception(sprintf('Undefined %s database configuration', $db));
        self::$instance->addConnection($db, self::$config['slave'][$db]);
    }

    public function setInstance($db = 'master')
    {
        $db_handler = $db . 'Handler';
        !$this->masterHandler && $this->setMasterDb();
        $db != 'master' && !$this->$db_handler && $this->setSlaveDb($db);
    }
}