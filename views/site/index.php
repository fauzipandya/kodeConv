<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use app\assets\homeAsset;
use yii\bootstrap\ButtonDropdown;
homeAsset::register($this);
$this->title = 'Kode Wilkerstat';
$this->params['breadcrumbs'][] = $this->title;
use kartik\icons\Icon;
Icon::map($this,Icon::FA);
?>
<div class="site-index" height="100%">
    
    <div class="jumbotron">
        <div class="row" style='vertical-align: top;'>
            <img src="<?=Yii::$app->request->baseUrl?>/img/logo.png" width="32%"/>
        </div>
        <div class="row">
            <div class="col-lg-6" style="padding-left: 0;text-align:right">
               <div class="btn-group">
                <?php
                    echo Html::a(Icon::show('search').'Pencarian',['/desa/levenshtein'],
                        ['class'=>'btn btn-primary btn-large btn-block','style'=>'font-size:18px']);
                ?>
                </div>
            </div>
            <div class="col-lg-6" width="156px" style="text-align: left">
                <?php
                    echo ButtonDropdown::widget ( [ 
                                    'label' => Icon::show('book').'Rekap',
                                    'encodeLabel'=>false,
                                    'options' => [ 
                                        'class' => 'btn-lg btn-primary btn-block',
                                        'style' => 'display:inline-block; font-size:18px;' 
                                                ],
                                    'dropdown' => [ 
                                        'items' => [ 
                                            [ 
                                                'label' => 'Rekap Jumlah Wilayah',
                                                'url' => 'desa\rekap' 
                                            ],
                                            [ 
                                                'label' => 'Rekap Wilayah',
                                                'url' => 'desa\index' 
                                            ],   
                                            [ 
                                                'label' => 'Rekap Wilayah yang tidak Match (BPS)',
                                                'url' => 'desa\tmbps' 
                                            ],   
                                            [ 
                                                'label' => 'Rekap Wilayah yang tidak Match (Dagri)',
                                                'url' => 'desa\tmdagri' 
                                            ],
                                        ] 
                                    ] 
                                ] );
                ?>
            </div>
                <!--div style="height:20%"><h1>asdasdas</h1></div-->
        </div>
    </div>      
</div >   
    
    <!--    <div class="body-content">
    
            <div class="row">
                <div class="col-lg-4">
                    <h2>Heading</h2>
    
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                        dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                        ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                        fugiat nulla pariatur.</p>
    
                    <p><a class="btn btn-default" href="http://www.yiiframework.com/doc/">Yii Documentation &raquo;</a></p>
                </div>
                <div class="col-lg-4">
                    <h2>Heading</h2>
    
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                        dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                        ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                        fugiat nulla pariatur.</p>
    
                    <p><a class="btn btn-default" href="http://www.yiiframework.com/forum/">Yii Forum &raquo;</a></p>
                </div>
                <div class="col-lg-4">
                    <h2>Heading</h2>
    
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                        dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                        ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                        fugiat nulla pariatur.</p>
    
                    <p><a class="btn btn-default" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p>
                </div>
            </div>
    
        </div>-->
