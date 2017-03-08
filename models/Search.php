<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\models;
use app\models\Elastic;
use yii\base\Model;
use yii\elasticsearch\ActiveDataProvider;
use yii\elasticsearch\Query;
use yii\elasticsearch\QueryBuilder;

class Search extends Elastic{
    public  function Searches($value)
    {
        $searchs =$value['search'];
        $query= new Query();
        $db= Elastic::getDb();
        $queryBuilder= new QueryBuilder($db);
        $match = ['match' => ['desa_bps' =>$searchs]];
        $query->query =$match;
        $build = $queryBuilder->build($query);
        $re = $query->search($db,$build);
        $dataProvider = new ActiveDataProvider([
                    'query' => $query,
                    'pagination'=>['pageSize'=>5],
                ]);
        return $dataProvider;
    }
}
