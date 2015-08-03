<?php

namespace frontend\modules\mainpage;

class Mainpage extends \yii\base\Module
{
    public $controllerNamespace = 'frontend\modules\mainpage\controllers';

    public function init()
    {
        parent::init();
        $this->setLayoutPath('@frontend/views/layouts');
        // custom initialization code goes here
    }
}
