<?php
/**
 * 后台首页控制器.
 * User: King
 * Date: 2016/12/7
 * Time: 19:22
 */

namespace backend\controllers;


class IndexController extends BaseController
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}