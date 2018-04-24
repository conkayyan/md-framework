<?php
/**
 * @description     Md
 * @author          conkayyan<conkay@foxmail.com>
 * @Date            2017/11/11
 */
namespace common\components;

class Md
{
    static public $params   = [];
    static public $app      = null;
    static public $app_path = null;
    static public $timezone = null;
    /**
     * @var \common\controllers\Controller $controller
     */
    static public $controller = null;

    static public function logger($text)
    {
        $max_size = 1000000;
        $log_filename = APP_PATH . sprintf("/logs/debug-%s.log", date('Y-m-d'));
        if(file_exists($log_filename) && (abs(filesize($log_filename)) > $max_size)){
            unlink($log_filename);
        }
        file_put_contents($log_filename, date('Y-m-d H:i:s')." ".$text."\r\n", FILE_APPEND);
    }
}