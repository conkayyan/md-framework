<?php
/**
 * @description     Home
 * @author          conkayyan<conkay@foxmail.com>
 * @Date            2017/6/15
 */
namespace frontend\controllers;

use common\components\Mysql;
use common\controllers\Controller;

class HomeController extends Controller
{
    public function actionIndex()
    {
        $this->render('index', ['title'=>'md framework']);
    }
    public function actionTest(){
        return __FUNCTION__;
    }
    public function actionHello()
    {
        return $this->actionTest();
    }
    public function actionMysql()
    {
        $s  = Mysql::db();
        $a  = $s->where('id', 1)->orWhere('id',2)->get('test');
        var_dump($a);
        $s  = Mysql::db('slave1');
        $a  = $s->where('id', 1)->orWhere('id',2)->get('test');
        var_dump($a);
    }
    public function actionIp()
    {
        echo $this->request->ip();
    }
}