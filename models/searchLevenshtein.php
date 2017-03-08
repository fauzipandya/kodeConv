<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\desa;

/**
 * searchLevenshtein represents the model behind the search form about `app\models\desa`.
 */
class searchLevenshtein extends desa
{
    /**
     * @inheritdoc
     */
    public $kataKunci='';
    public $kec_bps='';
    public $kab_bps='';
    public $pilih;
    public $kode_bps='';
    public function rules()
    {
        return [
            [['pilih','kataKunci'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = desa::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination'=>[
                'pagesize'=>10,
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        if($this->pilih=='1')
        {$query->select(['distinct "PROV"'
            . ',kab_bps, '
            . 'substring(kode_bps,1,4) as kode_bps,'
            . 'kab_dagri,'
            . 'substring(kode_dagri,1,5) as kode_dagri,'
            . 'levenshtein(kab_bps,\''.$this->kataKunci.'\') AS LEVE'])->orderBy('leve')->limit(100) ;
        }else if($this->pilih=='2'){
        $query->select(['distinct "PROV"'
            . ',kab_bps, '
            . 'kec_bps,'
            . 'substring(kode_bps,1,7) as kode_bps,'
            . 'kab_dagri,'
            . 'kec_dagri,'
            . 'substring(kode_dagri,1,8) as kode_dagri,'
            . 'levenshtein(kec_bps,\''.$this->kataKunci.'\') AS LEVE'])->orderBy('leve')->limit(100) ;
        }else{
        $query->select(['distinct "PROV"'
            . ',kab_bps, '
            . 'kec_bps,'
            . 'desa_bps,'
            . 'substring(kode_bps,1,7) as kode_bps,'
            . 'kab_dagri,'
            . 'kec_dagri,'
            . 'desa_dagri,'
            . 'substring(kode_dagri,1,8) as kode_dagri,'
            . 'levenshtein(desa_bps,\''.$this->kataKunci.'\') AS leve'])->orderBy('leve')->limit(100) ;
        } 
        return $dataProvider;
    }
}
