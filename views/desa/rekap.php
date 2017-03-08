<?php

use yii\helpers\Html;

use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\Breadcrumbs;

use kartik\export\ExportMenu;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Rekap Jumlah Wilayah';
$this->params['breadcrumbs'][] = $this->title;
?>

<div>
 <?php Pjax::begin()?> 
  <?php
    echo $this->render('navi');?>
    <h2>Rekap Jumlah Wilayah</h2>
 <?php    
 echo Breadcrumbs::widget([
      'homeLink' => [ 
                      'label' => Yii::t('yii', 'Beranda'),
                      'url' => Yii::$app->homeUrl,
                 ],
     'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
     'encodeLabels' => false
   ]); 
    
     echo $this->render('dropdownrekap',['model'=>$searchModel]);
    ?>
     <div class="row" style="margin-left: 0px; margin-bottom:15px;">
    <?php
    echo $this->render('ketBPS');
    echo $this->render('keKemendagri');
    ?>
        </div>
          <?php
         
    if($searchModel->PROV == null&& 
                    ($searchModel->kab_bps==''||$searchModel->kab_bps==null)){
        $gridColumn=[['class' => 'yii\grid\SerialColumn'],
            ['attribute'=>'PROV',
             'label'=>''],
            ['attribute'=>'kab_bps',
             'label'=>'Kabupaten'],
            ['attribute'=>'kec_bps',
             'label'=>'Kecamatan'],
            ['attribute'=>'desa_bps',
             'label'=>'Desa'],
            ['attribute'=>'kab_dagri',
             'label'=>'Kabupaten'],
            ['attribute'=>'kec_dagri',
             'label'=>'Kecamatan'],
            ['attribute'=>'desa_dagri',
             'label'=>'Desa'],
            ['attribute'=>'kab_match',
             'label'=>'Kabupaten'],
            ['attribute'=>'kec_match',
             'label'=>'Kecamatan'],
            ['attribute'=>'desa_match',
             'label'=>'Desa'],];
        echo ExportMenu::widget([
            'target'=>'_self',
            'dataProvider'=>$dataProvider,
            'filename'=>'rekap',
            //'batchSize'=>10,
            'showColumnSelector'=>false,
            'showConfirmAlert'=>false,
            'exportConfig'=>[
                'HTML'=>false,
                'PDF'=>false,
            ],
            'columns' => $gridColumn,
            'dropdownOptions'=>['label'=>'Export All','class'=>"btn btn-default"]
        ]);
        
       echo "<hr>\n";
        echo GridView::widget([
        'dataProvider' => $dataProvider,
        //'showPageSummary'=>true,
        'pjax'=>true,'summary'=>"Menunjukan wilayah ke: {begin}-{end} dari {totalCount} wilayah",
        'emptyText'=>'Oops, tidak ada wilayah yang tidak match.',    
        
        'responsive'=>true,
        'condensed'=>false,
        'floatHeader'=>true,
            //   'floatHeaderOptions'=>['scrollingTop'=>$scrollingTop],
        'hover'=>true,
         'panel'=>['type'=>'primary','heading'=>'Rekap Jumlah Wilayah BPS-Kemendagri'],
         'beforeHeader'=>[
             [
                 'columns'=>[
                     ['content'=>'No','options'=>['colspan'=>1,'class'=>'kv-sticky-column']],
                     ['content'=>'Provinsi','options'=>['colspan'=>1,'class'=>'kv-sticky-column']],
                     ['content'=>'BPS','options'=>['colspan'=>3,'class'=>'kv-sticky-column BPS']],
                     ['content'=>'Kemendagri','options'=>['colspan'=>3,'class'=>'kv-sticky-column Kemendagri']],
                     ['content'=>'Match','options'=>['colspan'=>3,'class'=>'kv-sticky-column Match']],
                 ],
             ]
         ],
         'columns' => $gridColumn,
        'toolbar'=>[],
    ]);  } else if(($searchModel->PROV!=null) && 
                    ($searchModel->kab_bps==''||$searchModel->kab_bps==null)){
       
    $gridColumn=[['class' => 'yii\grid\SerialColumn'],
            ['attribute'=>'kab_bps',
             'label'=>''],
            ['attribute'=>'kec_bps',
             'label'=>'Kecamatan'],
            ['attribute'=>'desa_bps',
             'label'=>'Desa'],
            ['attribute'=>'kec_dagri',
             'label'=>'Kecamatan'],
            ['attribute'=>'desa_dagri',
             'label'=>'Desa'],
            ['attribute'=>'kec_match',
             'label'=>'Kecamatan'],
            ['attribute'=>'desa_match',
             'label'=>'Desa'],];
    echo ExportMenu::widget([
            'target'=>'_self',
            'dataProvider'=>$dataProvider,
            'filename'=>'rekap',
            //'batchSize'=>10,
            'showColumnSelector'=>false,
            'showConfirmAlert'=>false,
            'exportConfig'=>[
                'HTML'=>false,
                'PDF'=>false,
            ],
            'columns' => $gridColumn,
            'dropdownOptions'=>['label'=>'Export All','class'=>"btn btn-default"]
        ]);
    
       echo "<hr>\n";
        echo GridView::widget([
        'dataProvider' => $dataProvider,
        //'showPageSummary'=>true,
        'pjax'=>true,'summary'=>"Menunjukan wilayah ke: {begin}-{end} dari {totalCount} wilayah",
        'emptyText'=>'Oops, tidak ada wilayah yang tidak match.',    
        
        'responsive'=>true,
        'condensed'=>false,
        'floatHeader'=>true,
            //   'floatHeaderOptions'=>['scrollingTop'=>$scrollingTop],
        'hover'=>true,
         'panel'=>['type'=>'primary','heading'=>'Rekap Jumlah Wilayah BPS-Kemendagri '],
         'beforeHeader'=>[
             [
                 'columns'=>[
                     ['content'=>'No','options'=>['colspan'=>1,'class'=>'kv-sticky-column']],
                     ['content'=>'Kabupaten','options'=>['colspan'=>1,'class'=>'kv-sticky-column']],
                     ['content'=>'BPS','options'=>['colspan'=>2,'class'=>'kv-sticky-column BPS']],
                     ['content'=>'Kemendagri','options'=>['colspan'=>2,'class'=>'kv-sticky-column Kemendagri']],
                     ['content'=>'Match','options'=>['colspan'=>2,'class'=>'kv-sticky-column Match']],
                 ],
             ]
         ],
          
        //'filterModel' => $searchModel,
        'columns' => $gridColumn,
        'toolbar'=>[],
    ]);  } else if(($searchModel->PROV!=null) && 
                    ($searchModel->kab_bps!=''||$searchModel->kab_bps!=null)){
       
    $gridColumn=[['class' => 'yii\grid\SerialColumn'],
            ['attribute'=>'kec_bps',
             'label'=>''],
            ['attribute'=>'desa_bps',
             'label'=>'Desa'],
            ['attribute'=>'desa_dagri',
             'label'=>'Desa'],
            ['attribute'=>'desa_match',
             'label'=>'Desa'],];
    echo ExportMenu::widget([
            'target'=>'_self',
            'dataProvider'=>$dataProvider,
            'filename'=>'rekap',
            //'batchSize'=>10,
            'showColumnSelector'=>false,
            'showConfirmAlert'=>false,
            'exportConfig'=>[
                'HTML'=>false,
                'PDF'=>false,
            ],
            'columns' => $gridColumn,
            'dropdownOptions'=>['label'=>'Export All','class'=>"btn btn-default"]
        ]);
       echo "<hr>\n";
        echo GridView::widget([
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
         'panel'=>['type'=>'primary','heading'=>'Rekap Jumlah Wilayah BPS-Kemendagri '],
         'beforeHeader'=>[
             [
                 'columns'=>[
                     ['content'=>'No','options'=>['colspan'=>1,'class'=>'kv-sticky-column']],
                     ['content'=>'Kecamatan','options'=>['colspan'=>1,'class'=>'kv-sticky-column']],
                     ['content'=>'BPS','options'=>['colspan'=>1,'class'=>'kv-sticky-column BPS']],
                     ['content'=>'Kemendagri','options'=>['colspan'=>1,'class'=>'kv-sticky-column Kemendagri']],
                     ['content'=>'Match','options'=>['colspan'=>1,'class'=>'kv-sticky-column Match']],
                 ],
             ]
         ],
          
        //'filterModel' => $searchModel,
        'columns' => $gridColumn,
        'toolbar'=>[],
    ]);  }
    ?>
    <?php Pjax::end()?>
</div>

