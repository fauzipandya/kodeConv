<?php

use yii\helpers\Html;
use app\models\desa;
use kartik\depdrop\DepDrop;
use yii\widgets\Pjax;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
use kartik\icons\Icon;

Icon::map($this,Icon::FA);

?>
       
<div class="desa-search">
    <?php Pjax::begin()?>
    <?php $form = ActiveForm::begin([
                    'action' => ['rekap'],
                    'method' => 'get',
                    'options' => ['class' => 'form-inline'],

    ]); ?>
    <?php 
        $items= ArrayHelper::map(desa::find()
                    ->select(['substring(kode_bps,1,2)||\' \'||"PROV" as name','substring(kode_bps,1,2) as id'])
                    ->distinct()->asArray()->all(), 'id', 'name');
    ?>
    <?=$form->field($model,'PROV')->dropDownList($items,
            ['prompt'=>'PROVINSI',
             'id'=>'prov-id',
                'style'=>'display:inline-block; font-size:18px; height:33px'
                   ])
            ->label('')?>
    
    <?= $form->field($model,'kab_bps')->widget(DepDrop::classname(),[
            'options'=>['id'=>'kab-id',
                'prompt'=>'KABUPATEN/KOTA',
                'style'=>'display:inline-block; font-size:18px; height:33px'
                ],
            'pluginOptions'=>[
                'depends'=>['prov-id'],
                'placeholder'=> 'KABUPATEN/KOTA...',
                'url'=>Url::to(['/desa/kab'])
            ]
    ] )->label('')?>
  
    <div class="form-group" >
             
            
    <?=Html::submitButton(Icon::show('search'),
                ['class'=>'btn-primary btn',
                    ])?>
            </div>
    
    <?php ActiveForm::end(); ?>
    <?php Pjax::end();?>
</div>
