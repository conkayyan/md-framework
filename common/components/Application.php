<?php
/**
 * @description     application
 * @author          conkayyan<conkay@foxmail.com>
 * @Date            2017/6/16
 */
namespace common\components;

use common\components\mysqli\Db;

/**
 * Class Application
 * @package common\components
 */
class Application
{
    /**
     * @var array $config
     */
    protected $config = [];

    /**
     * @var array $notFound
     */
    protected $notFound = [];

    /**
     * Application constructor.
     * @param array $config
     * @throws \Exception
     */
    public function __construct($config = [])
    {
        $this->config   = $config;
        if(function_exists('date_default_timezone_set'))date_default_timezone_set($this->config['timezone']);

        defined('APP_VIEW_PATH') or define('APP_VIEW_PATH', realpath(APP_PATH . '/../' . str_replace('\\', '/', $this->config['view'])));

        $this->notFound = explode('@', $this->config['notFound']);

        // define Md
        Md::$params     = $this->config['params'];
        Md::$app        = $this->config['app'];
        Md::$app_path   = APP_PATH;
        Md::$timezone   = $this->config['timezone'];

        // loading mysql configure
        (new Db($this->config['mysql']))->init();
    }

    /**
     * Application run
     */
    public function run()
    {
        $router = new Router();

        if (isset($this->config['url']) && is_array($this->config['url'])) {
            foreach ($this->config['url'] as $route) {
                if (count($route) == 3) {
                    $router->respond($route[0], $route[1], function ($request, $response, $service, $app, $validator) use ($route){
                        $callback = explode('@', $route[2]);
                        return (new $callback[0]())->{$callback[1]}($request, $response, $service, $app, $validator);
                    });
                } else {
                    $router->respond($route[0], $route[1], $this->handler());
                }
            }
        }

        // Using exact code behaviors via switch/case
        $router->onHttpError(function ($code, $router) {
            /* @var  $router Router */
            switch ($code) {
                case 404:
                    $router->response()->body(
                        (new $this->notFound[0]())->{'action' . ucfirst($this->notFound[1])}()
                    );
                    break;
                case 405:
                    $router->response()->body(
                        (new $this->notFound[0]())->{'action' . ucfirst($this->notFound[1])}($code, 'You can\'t do that!')
                    );
                    break;
                default:
                    $router->response()->body(
                        'Oh no, a bad error happened that caused a '. $code
                    );
            }
        });

        // Using range behaviors via if/else
        $router->onHttpError(function ($code, $router) {
            /* @var  $router Router */
            if ($code >= 400 && $code < 500) {
                $router->response()->body(
                    'Oh no, a bad error happened that caused a '. $code
                );
            } elseif ($code >= 500 && $code <= 599) {
                error_log('uhhh, something bad happened');
            }
        });

        $router->dispatch();
    }

    /**
     * @return \Closure
     */
    public function handler()
    {
        return function ($request, $response, $service, $app, $validator){
            $controller = $request->controller ? $request->controller : 'home';
            $class = $this->config['controller']. '\\' . ucfirst($controller) . 'Controller';
            $baseMethod = $request->action ? $request->action : 'index';
            $method = 'action' . ucfirst($baseMethod);
            if (class_exists($class) && method_exists($class, $method) && is_callable($class, $method)) {
                return (new $class())->$baseMethod($request, $response, $service, $app, $validator, $controller, $baseMethod);
            } else {
                return (new $this->notFound[0]())->{'action' . ucfirst($this->notFound[1])}();
            }
        };
    }
}