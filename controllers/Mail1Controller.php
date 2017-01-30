<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
class Mail1Controller extends Controller
{

    public function actionIndex()
    {

        return $this->render('index');
    }

    public function actionTest()
    {

        return $this->render('/site/test');
    }

}
