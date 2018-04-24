<?php
/**
 * @description     Controller
 * @author          conkayyan<conkay@foxmail.com>
 * @Date            2017/6/18
 */
namespace common\controllers;

use common\components\Md;

class Controller
{

    /**
     * @var $request \Klein\Request
     */
    protected $request;

    /**
     * @var $response \Klein\Response
     */
    protected $response;

    /**
     * @var $service \common\components\View
     */
    protected $service;

    /**
     * @var $app \common\components\App
     */
    protected $app;

    /**
     * @var $validator \Klein\Validator
     */
    protected $validator;

    /**
     * @var $controller string
     */
    protected $controller;

    /**
     * @var $action string
     */
    protected $action;

    /**
     * @var $path string
     */
    protected $path;

    /**
     * @param $func_name
     * @param $arguments
     * @return mixed
     */
    public function __call($func_name, $arguments)
    {
        $func_name  = 'action' . ucfirst($func_name);
        if(count($arguments)==7){
            list($this->request, $this->response, $this->service, $this->app, $this->validator, $this->controller, $this->action) = $arguments;
        } elseif(count($arguments)==5){
            list($this->request, $this->response, $this->service, $this->app, $this->validator) = $arguments;
            $this->action   = $func_name;
            $controller     = get_called_class();
            $controller     = explode('\\', $controller);
            $controller     = end($controller);
            $this->controller   = strtolower(str_ireplace('Controller', '', $controller));
        }
        Md::$controller = $this;
        return $this->$func_name();
    }

    /**
     * @param int $code
     * @param string $message
     * @return string
     */
    public function actionEmpty($code = 404, $message = 'Page Not Found'){
        header(sprintf('%s %s %s', $_SERVER['SERVER_PROTOCOL'], $code, $message));
        return sprintf("<h1 style='width: 60%%; margin: 5%% auto;'>:( %s<br>%s<code style='font-weight: normal;'></code></h1>", $code, $message);
    }

    /**
     * Renders a view + optional layout
     *
     * @param string $view  The view to render
     * @param array $data   The data to render in the view
     * @return void
     */
    protected function render($view = '', array $data = [])
    {
        $view   = strpos($view, '/') === false ? $this->controller . '/' . $view : $view;
        $this->service->render($view, $data);
    }

    /**
     * @return string
     */
    public function getControllerName()
    {
        return $this->controller;
    }

    /**
     * @return string
     */
    public function getActionName()
    {
        return $this->action;
    }
}