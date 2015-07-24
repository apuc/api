<?php
/**
 * Created by PhpStorm.
 * User: Кирилл
 * Date: 24.07.2015
 * Time: 11:01
 */

namespace common\classes;
use yii\helpers\Url;


class Additional {
    public static function  genActivateLink($model)
    {
        return "<a href='" . Url::base(true) . "/login/reg/activate/?key=" . $model->salt . "&id=" . $model->id . "'>Активировать</a>";
    }
} 