<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\email\models\db\EmailMsg */

$this->title = 'Создать шаблон письма';
$this->params['breadcrumbs'][] = ['label' => 'Email Msgs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="email-msg-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
