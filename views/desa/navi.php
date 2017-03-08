<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use kartik\icons\Icon;

Icon::map($this,Icon::FA);
?>
 <?php
    NavBar::begin([
        'brandLabel' =>'Kode Wilkerstat',
        //'brandOptions'=>['wdith']
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-right'],
    'items' => [
        ['label' => Icon::show('search').' Pencarian',
         'url' => ['/desa/levenshtein']],
        [
           'label' => Icon::show('book').' Rekap',
           'items' => [
               ['label' => 'Rekap Jumlah', 'url' => ['/desa/rekap']], 
               ['label' => 'Daftar Match', 'url' => ['/desa/index']], 
               ['label' => 'BPS: Tidak Match', 'url' => ['/desa/tmbps']],
               ['label' => 'Kemendagri: Tidak Match', 'url' => ['/desa/tmdagri']],
            ],
        ],
    ],
      'encodeLabels' => false
   
]);
    NavBar::end();
    ?>
