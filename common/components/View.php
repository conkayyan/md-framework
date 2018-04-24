<?php
/**
 * @description     View
 * @author          conkayyan<conkay@foxmail.com>
 * @Date            2017/10/26
 */
namespace common\components;

use \Klein\ServiceProvider;

class View extends ServiceProvider
{


    /**
     * Renders a view + optional layout
     *
     * @param string $view  The view to render
     * @param array $data   The data to render in the view
     * @return void
     */
    public function render($view, array $data = array())
    {
        parent::render(APP_VIEW_PATH . '/' . ucfirst($view) . '.php', $data);
    }
}