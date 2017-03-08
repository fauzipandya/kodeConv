<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\desa */

$this->title = 'Update Desa: ' . $model->kode_bps;
$this->params['breadcrumbs'][] = ['label' => 'Desas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->kode_bps, 'url' => ['view', 'id' => $model->kode_bps]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="desa-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
