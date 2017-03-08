<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\icons\Icon;

Icon::map($this,Icon::FA);

/* @var $this yii\web\View */
/* @var $model app\models\searchLevenshtein */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>
       
<div class="desa-search">

    <?php $form = ActiveForm::begin([
                    'action' => ['levenshtein'],
                    'method' => 'get',
                    'options' => ['class' => 'form-inline'],

    ]); ?>
    <?= $form->field($model,'pilih')->dropDownList(['1' => 'Kabupaten', '2' => 'Kecamatan',
                                                    '3'=>'Desa'],
                                                   ['prompt'=>'Pilihan',                
                                                    'style'=>'display:inline-block; font-size:18px; height:33px'])->label('');?>
    <?= $form->field($model, 'kataKunci')->textInput(['placeholder'=>'Kata Pencarian...'],[
                        'style'=>'display:inline-block; font-size:18px; height:33px'

    ])->label(''); ?>
    <div class="form-group" style="height:43px">
             
            
    <?=Html::submitButton(Icon::show('search'),
                ['class'=>'btn-primary btn',
                    ])?>
            </div>
    
    <?php ActiveForm::end(); ?>

</div>
