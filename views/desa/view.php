<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\desa */

$this->title = $model->kode_bps;
$this->params['breadcrumbs'][] = ['label' => 'Desas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="desa-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <!--p>
        <!?= Html::a('Update', ['update', 'id' => $model->kode_bps], ['class' => 'btn btn-primary']) ?>
        <!?= Html::a('Delete', ['delete', 'id' => $model->kode_bps], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p-->

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'desa_bps:ntext',
            'kec_bps:ntext',
            'kab_bps:ntext',
            'PROV',
            'kode_bps',
            'desa_dagri:ntext',
            'kec_dagri:ntext',
            'kab_dagri:ntext',
            'kode_dagri',
        ],
    ]) ?>

</div>
