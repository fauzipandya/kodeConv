<?php

use yii\helpers\Html;

use kartik\grid\GridView;
use kartik\export\ExportMenu;
use app\models\desa;
use yii\widgets\Pjax;
use yii\widgets\Breadcrumbs;
/* @var $this yii\web\View */
/* @var $searchModel app\models\searchDesa */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Kode Wilayah BPS-Kemendagri';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="desa-index">

    
     <?php
    echo $this->render('navi');?>
    <h2>Rekap Kode Wilayah</h2>
 
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
    <?= $this->render('indexDesa',['model'=>$searchModel]);
    ?> 
    
    <div class="row" style="margin-left: 0px; margin-bottom:15px;">
    <?php
    echo $this->render('ketBPS');
    echo $this->render('keKemendagri');
    ?>
        </div>
    <?php
    if($searchModel->PROV !=null 
             and ($searchModel->kab_bps=="" |$searchModel->kab_bps==null) 
            & ($searchModel->kec_bps==null| $searchModel->kec_bps==""))
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
            'filename'=>'hasil_perbandingan_kab',
            //'batchSize'=>10,
            'showColumnSelector'=>false,
            'showConfirmAlert'=>false,
            'exportConfig'=>[
                'HTML'=>false,
                'PDF'=>false,
            ],
            'columns' => $gridColumn,
            'dropdownOptions'=>['label'=>'Export All','class'=>"btn btn-default"]
        ])."\n".GridView::widget([
        'dataProvider' => $dataProvider,
        //'showPageSummary'=>true,
        'pjax'=>true,
        'summary'=>"Menunjukan wilayah ke: {begin}-{end} dari {totalCount} wilayah",
        'emptyText'=>'Oops, tidak ada wilayah yang tidak match.',    
   
        'responsive'=>true,
        'condensed'=>false,
        'floatHeader'=>true,
            //   'floatHeaderOptions'=>['scrollingTop'=>$scrollingTop],
        'hover'=>true,
         'panel'=>['type'=>'primary','heading'=>'Daftar Kabupaten BPS-Kemendagri'],
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
        
    } else if($searchModel->PROV !=null 
             and ($searchModel->kab_bps!="" &$searchModel->kab_bps!=null) 
            & ($searchModel->kec_bps==null| $searchModel->kec_bps=="")){
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
            'filename'=>'hasil_perbandingan_kec',
            //'batchSize'=>10,
            'showColumnSelector'=>false,
            'showConfirmAlert'=>false,
            'exportConfig'=>[
                'HTML'=>false,
                'PDF'=>false,
            ],
            'columns' => $gridColumn,
            'dropdownOptions'=>['label'=>'Export All','class'=>"btn btn-default"]
        ])."\n".GridView::widget([
        'dataProvider' => $dataProvider,
        //'showPageSummary'=>true,
        'pjax'=>true,
        'responsive'=>true,
        'condensed'=>false,
        'floatHeader'=>true,
        'summary'=>"Menunjukan wilayah ke: {begin}-{end} dari {totalCount} wilayah",
        'emptyText'=>'Oops, tidak ada wilayah yang tidak match.',    
 
            //   'floatHeaderOptions'=>['scrollingTop'=>$scrollingTop],
        'hover'=>true,
         'panel'=>['type'=>'primary','heading'=>'Daftar Kecamatan BPS-Kemendagri'],
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
    }else if($searchModel->PROV !=null 
             and ($searchModel->kab_bps!="" &$searchModel->kab_bps!=null) 
            & ($searchModel->kec_bps!=null& $searchModel->kec_bps!="")){
        
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
            'filename'=>'hasil_perbandingan_desa',
            //'batchSize'=>10,
            'showColumnSelector'=>false,
            'showConfirmAlert'=>false,
            'exportConfig'=>[
                'HTML'=>false,
                'PDF'=>false,
            ],
            'columns' => $gridColumn,
            'dropdownOptions'=>['label'=>'Export All','class'=>"btn btn-default"]
        ])."\n".GridView::widget([
        'dataProvider' => $dataProvider,
        //'showPageSummary'=>true,
        'pjax'=>true,
        'summary'=>"Menunjukan wilayah ke: {begin}-{end} dari {totalCount} wilayah",
        'emptyText'=>'Oops, tidak ada wilayah yang tidak match.',    
 
        'responsive'=>true,
        'condensed'=>false,
        'floatHeader'=>true,
            //   'floatHeaderOptions'=>['scrollingTop'=>$scrollingTop],
        'hover'=>true,
         'panel'=>['type'=>'primary','heading'=>'Daftar Desa BPS-Kemendagri'],
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
    <?php Pjax::end() ?>    
</div>
