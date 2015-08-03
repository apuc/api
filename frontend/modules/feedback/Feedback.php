<?php

namespace frontend\modules\feedback;

class Feedback extends \yii\base\Module
{
    public $controllerNamespace = 'frontend\modules\feedback\controllers';

    public function init()
    {
        parent::init();

        $this->setLayoutPath('@frontend/views/layouts');
        // custom initialization code goes here
    }
}
