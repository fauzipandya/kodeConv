<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\desa;

/**
 * searchDesa represents the model behind the search form about `app\models\desa`.
 */
class searchDesa extends desa
{
    /**
     * @inheritdoc
     */
    public $PROV;
    public $kec_bps;
    public $kab_bps;
    public function rules()
    {
        return [
            [['PROV','desa_bps', 'kec_bps', 'kab_bps'], 'safe'],
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
        if($this->PROV !=null and ($this->kab_bps=="" |$this->kab_bps==null) & ($this->kec_bps==null| $this->kec_bps==""))
        {$query->select(['PROV', 
                        'kab_bps', 
                        'kode_bps'=>'substring(kode_bps,1,4)',
                        'kab_dagri',
                        'kode_dagri'=>'substring(kode_dagri,1,5)'])
                ->andFilterWhere(['=','substring(kode_bps,1,2)',$this->PROV])
                ->distinct();} 
        else if ($this->PROV !=null and ($this->kab_bps!="" &$this->kab_bps!=null) & ($this->kec_bps==null| $this->kec_bps==""))
        {            
            $query->select(['PROV', 
                        'kab_bps',
                        'kec_bps',
                        'kode_bps'=>'substring(kode_bps,1,7)',
                        'kab_dagri',
                        'kec_dagri',
                        'kode_dagri'=>'substring(kode_dagri,1,8)'])
                ->andFilterWhere(['=','substring(kode_bps,1,4)',$this->kab_bps])
                ->distinct();
        } else if($this->PROV !=null and ($this->kab_bps!="" &$this->kab_bps!=null) & ($this->kec_bps!=null& $this->kec_bps!="")){
            $query->select(['PROV', 
                        'kab_bps',
                        'kec_bps',
                        'desa_bps',
                        'kode_bps',
                        'kab_dagri',
                        'kec_dagri',
                        'desa_dagri',
                        'kode_dagri'])
                ->andFilterWhere(['=','substring(kode_bps,1,7)',$this->kec_bps])
                ->distinct();
        }
        return $dataProvider;
    }
}
