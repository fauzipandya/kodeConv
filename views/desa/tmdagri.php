<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\Breadcrumbs;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Rekap Kemendagri: tidak match';
$this->params['breadcrumbs'][] = $this->title;
?>

<div>
    
     <?php
    echo $this->render('navi');?>
    <h2>Rekap Kode Wilayah Kemendagri yang tidak match</h2>
 
 <?php Pjax::begin()?> 
     <?php
    echo Breadcrumbs::widget([
      'homeLink' => [ 
                      'label' => Yii::t('yii', 'Beranda'),
                      'url' => Yii::$app->homeUrl,
                 ],
     'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
     'encodeLabels' => false
   ]); 
    echo $this->render('dropdowntmdagri',['model'=>$searchModel]);
    ?>

    <div class="row" style="margin-left: 0px; margin-bottom:15px;">
        <?php
    echo $this->render('keKemendagri');
    ?>
        </div>
   <?php
    $gridColumn=[['class' => 'yii\grid\SerialColumn'],
            ['attribute'=>'kabupaten',
             'label'=>'Kabupaten'],
            ['attribute'=>'kecamatan',
             'label'=>'Kecamatan'],
            ['attribute'=>'desa',
             'label'=>'Desa'],
            ['attribute'=>'kode',
             'label'=>'Kode']];
        echo GridView::widget([
        'dataProvider' => $dataProvider,
        //'showPageSummary'=>true,
        'pjax'=>true,
        'responsive'=>true,
        'summary'=>"Menunjukan wilayah ke: {begin}-{end} dari {totalCount} wilayah",
        'emptyText'=>'Oops, tidak ada wilayah yang tidak match.',    

        'condensed'=>false,
        'floatHeader'=>true,
            //   'floatHeaderOptions'=>['scrollingTop'=>$scrollingTop],
        'hover'=>true,
         'panel'=>['type'=>'primary','heading'=>'Rekap Wilayah Kemendagri yang Tidak Match'],
         
         'columns' => $gridColumn,
        'toolbar'=>[],
    ]);
    ?>
    <?php Pjax::end()?>
</div>

