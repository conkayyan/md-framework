<?php
/**
 * @description     Console
 * @author          conkayyan<conkay@foxmail.com>
 * @Date            2017/11/11
 */
namespace common\components;

use common\components\mysqli\Db;

/**
 * Class Application
 * @package common\components
 */
class Console
{
    /**
     * @var array $config
     */
    protected $config = [];

    /**
     * Application constructor.
     * @param array $config
     */
    public function __construct($config = [])
    {
        $this->config   = $config;
        if(function_exists('date_default_timezone_set'))date_default_timezone_set($this->config['timezone']);

        // define Md
        Md::$params     = $this->config['params'];
        Md::$app        = $this->config['app'];
        Md::$app_path   = APP_PATH;
        Md::$timezone   = $this->config['timezone'];

        // loading mysql configure
        (new Db($this->config['mysql']))->init();
    }

    /**
     * @return array
     */
    public function run()
    {

    }
}