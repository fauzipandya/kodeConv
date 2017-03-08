<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\grid\GridView;
use kartik\export\ExportMenu;
use app\models\desa;
use yii\widgets\Pjax;
use yii\bootstrap\ActiveForm;
use yii\widgets\Breadcrumbs;
/* @var $this yii\web\View */
/* @var $searchModel app\models\searchDesa */
/* @var $dataProvider yii\data\ActiveDataProvider */

use kartik\icons\Icon;
Icon::map($this,Icon::FA);
$this->title = 'Pencarian';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="desa-indexL">
    
     <?php
    echo $this->render('navi');?>
    <h2>Pencarian Kode Wilayah Kerja Statistik</h2>
 
 <?php Pjax::begin()?> 
     <?php
    echo Breadcrumbs::widget([
      'homeLink' => [ 
                      'label' => Yii::t('yii', 'Beranda'),
                      'url' => Yii::$app->homeUrl,
                 ],
     'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
     'encodeLabels' => false
   ]);?>
     <?= $this->render('indexL',['model'=>$searchModel]);?>   
     <br>
 <div class="row" style="margin-left: 0px; margin-bottom:15px;">
    <?php
    echo $this->render('ketBPS');
    echo $this->render('keKemendagri');
    ?>
        </div>
      
   <?php
   
      if($searchModel->pilih==1)
        {
        $gridColumn=[['class' => 'kartik\grid\SerialColumn'],
            ['header'=>'',
             'label'=>'Provinsi',
             'attribute'=> 'PROV'],
            
            ['attribute'=>'kab_bps',
             'label'=>'Kabupaten'],
            ['attribute'=>'kode_bps',
             'label'=>'Kode'],
            ['attribute'=>'kab_dagri',
             'label'=>'Kabupaten'],
            ['attribute'=>'kode_dagri',
             'label'=>'Kode'],];
        echo ExportMenu::widget([
            'target'=>'_self',
            'dataProvider'=>$dataProvider,
            'filename'=>'export_pencarian_kab',
            //'batchSize'=>10,
            'showColumnSelector'=>false,
            'showConfirmAlert'=>false,
            'exportConfig'=>[
                'HTML'=>false,
                'PDF'=>false,
            ],
            'columns' => $gridColumn,
            'dropdownOptions'=>['label'=>'Export All','class'=>"btn btn-default"]
        ])."<hr>\n".GridView::widget([
        'dataProvider' => $dataProvider,
        //'showPageSummary'=>true,
        'pjax'=>true,'summary'=>"Menunjukan wilayah ke: {begin}-{end} dari {totalCount} wilayah",
        'emptyText'=>'Oops, tidak ada wilayah yang tidak match.',    
        
        'responsive'=>true,
        'condensed'=>false,
        'floatHeader'=>true,
            //   'floatHeaderOptions'=>['scrollingTop'=>$scrollingTop],
        'hover'=>true,
         'panel'=>['type'=>'primary','heading'=>'Kabupaten BPS-Kemendagri'],
         'beforeHeader'=>[
             [
                 'columns'=>[
                     ['content'=>'No','options'=>['colspan'=>1,'class'=>'kv-sticky-column']],
                     ['content'=>'','options'=>['colspan'=>1,'class'=>'kv-sticky-column']],
                     ['content'=>'BPS','options'=>['colspan'=>2,'class'=>'kv-sticky-column BPS']],
                     ['content'=>'Kemendagri','options'=>['colspan'=>2,'class'=>'kv-sticky-column Kemendagri']],
                     
                 ],
             ]
         ],
          
        //'filterModel' => $searchModel,
        'columns' => $gridColumn,
        'toolbar'=>[],
    ]); 
        } else if($searchModel->pilih==2){
        $gridColumn=[['class' => 'kartik\grid\SerialColumn'],
            ['header'=>'',
             'label'=>'',
             'attribute'=> 'PROV'],
            
            ['attribute'=>'kab_bps',
             'label'=>'Kabupaten'],
            ['attribute'=>'kec_bps',
             'label'=>'Kecamatan'],
            ['attribute'=>'kode_bps',
             'label'=>'Kode'],
            ['attribute'=>'kab_dagri',
             'label'=>'Kabupaten'],
            ['attribute'=>'kec_dagri',
             'label'=>'Kecamatan'],
            ['attribute'=>'kode_dagri',
             'label'=>'Kode'],];
        echo ExportMenu::widget([
            'target'=>'_self',
            'dataProvider'=>$dataProvider,
            'filename'=>'export_pencarian_kec',
            //'batchSize'=>10,
            'showColumnSelector'=>false,
            'showConfirmAlert'=>false,
            'exportConfig'=>[
                'HTML'=>false,
                'PDF'=>false,
            ],
            'columns' => $gridColumn,
            'dropdownOptions'=>['label'=>'Export All','class'=>"btn btn-default"]
        ])."<hr>\n".GridView::widget([
        'dataProvider' => $dataProvider,
        //'showPageSummary'=>true,
        'pjax'=>true,
        'responsive'=>true,'summary'=>"Menunjukan wilayah ke: {begin}-{end} dari {totalCount} wilayah",
        'emptyText'=>'Oops, tidak ada wilayah yang tidak match.',    
        
        'condensed'=>false,
        'floatHeader'=>true,
            //   'floatHeaderOptions'=>['scrollingTop'=>$scrollingTop],
        'hover'=>true,
         'panel'=>['type'=>'primary','heading'=>'Kecamatan BPS-Kemendagri'],
         'beforeHeader'=>[
             [
                 'columns'=>[
                     ['content'=>'No','options'=>['colspan'=>1,'class'=>'kv-sticky-column']],
                     ['content'=>'Provinsi','options'=>['colspan'=>1,'class'=>'kv-sticky-column']],
                     ['content'=>'BPS','options'=>['colspan'=>3,'class'=>'kv-sticky-column BPS']],
                     ['content'=>'Kemendagri','options'=>['colspan'=>3,'class'=>'kv-sticky-column Kemendagri']],
                     
                 ],
             ]
         ],
          
        //'filterModel' => $searchModel,
        'columns' => $gridColumn,
        'toolbar'=>[],
    ]); 
        }
        else if($searchModel->pilih==3)  {
         $gridColumn=[['class' => 'kartik\grid\SerialColumn'],
            ['header'=>'',
             'label'=>'',
             'attribute'=> 'PROV'],
            
            ['attribute'=>'kab_bps',
             'label'=>'Kabupaten'],
            ['attribute'=>'kec_bps',
             'label'=>'Kecamatan'],
             ['attribute'=>'desa_bps',
             'label'=>'Desa'],
            ['attribute'=>'kode_bps',
             'label'=>'Kode'],
            ['attribute'=>'kab_dagri',
             'label'=>'Kabupaten'],
            ['attribute'=>'kec_dagri',
             'label'=>'Kecamatan'],
            ['attribute'=>'desa_dagri',
             'label'=>'Desa'],
            ['attribute'=>'kode_dagri',
             'label'=>'Kode'],];
        echo ExportMenu::widget([
            'target'=>'_self',
            'dataProvider'=>$dataProvider,
            'filename'=>'export_pencarian_desa',
            //'batchSize'=>10,
            'showColumnSelector'=>false,
            'showConfirmAlert'=>false,
            'exportConfig'=>[
                'HTML'=>false,
                'PDF'=>false,
            ],
            'columns' => $gridColumn,
            'dropdownOptions'=>['label'=>'Export All','class'=>"btn btn-default"]
        ])."<hr>\n".GridView::widget([
        'dataProvider' => $dataProvider,
        //'showPageSummary'=>true,
        'pjax'=>true,'summary'=>"Menunjukan wilayah ke: {begin}-{end} dari {totalCount} wilayah",
        'emptyText'=>'Oops, tidak ada wilayah yang tidak match.',    
        
        'responsive'=>true,
        'condensed'=>false,
        'floatHeader'=>true,
            //   'floatHeaderOptions'=>['scrollingTop'=>$scrollingTop],
        'hover'=>true,
         'panel'=>['type'=>'primary','heading'=>'Kecamatan BPS-Kemendagri'],
         'beforeHeader'=>[
             [
                 'columns'=>[
                     ['content'=>'No','options'=>['colspan'=>1,'class'=>'kv-sticky-column']],
                     ['content'=>'Provinsi','options'=>['colspan'=>1,'class'=>'kv-sticky-column']],
                     ['content'=>'BPS','options'=>['colspan'=>4,'class'=>'kv-sticky-column BPS']],
                     ['content'=>'Kemendagri','options'=>['colspan'=>4,'class'=>'kv-sticky-column Kemendagri']],
                     
                 ],
             ]
         ],
          
        //'filterModel' => $searchModel,
        'columns' => $gridColumn,
        'toolbar'=>[],
    ]);     
        }
      ?> 
     <?php Pjax::end()?>
</div>
