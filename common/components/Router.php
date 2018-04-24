<?php
/**
 * @description     router
 * @author          conkayyan<conkay@foxmail.com>
 * @Date            2017/9/11
 */
namespace common\components;

use Klein\Klein;
use Klein\DataCollection\RouteCollection;
use Klein\AbstractRouteFactory;
use Klein\RouteFactory;
use SplStack;
use SplQueue;

/**
 * Class Router
 * @package common\components
 */
class Router extends Klein
{
    /**
     * Constructor
     *
     * Create a new Klein instance with optionally injected dependencies
     * This DI allows for easy testing, object mocking, or class extension
     *
     * @param View $service              Service provider object responsible for utilitarian behaviors
     * @param mixed $app                            An object passed to each route callback, defaults to an App instance
     * @param RouteCollection $routes               Collection object responsible for containing all route instances
     * @param AbstractRouteFactory $route_factory   A factory class responsible for creating Route instances
     */
    public function __construct(
        View $service = null,
        $app = null,
        RouteCollection $routes = null,
        AbstractRouteFactory $route_factory = null
    ) {
        // Instanciate and fall back to defaults
        $this->service       = $service       ?: new View();
        $this->app           = $app           ?: new App();
        $this->routes        = $routes        ?: new RouteCollection();
        $this->route_factory = $route_factory ?: new RouteFactory();

        $this->error_callbacks = new SplStack();
        $this->http_error_callbacks = new SplStack();
        $this->after_filter_callbacks = new SplQueue();
    }
}