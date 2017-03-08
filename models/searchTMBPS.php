<?php

namespace app\models;

use Yii;
use app\models\desa;
use yii\base\Model;
use yii\data\SqlDataProvider;
class searchTMBPS extends Model
{
    /**
     * @inheritdoc
     */
    public $PROV;
    public $kab_bps;
    public $kec_bps;
    public $sqlBPS;
    public $sqlCount;
    
    public function rules()
    {
        return [
            [[  'PROV', 'kab_bps','kec_bps'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }
    
    public function search($params)
    {
        $this->load($params);
//        if (!$this->validate()) {
//            // uncomment the following line if you do not want to return any records when validation fails
//            // $query->where('0=1');
//            return $dataProvider;
//        }
      if(($this->PROV == null | $this->PROV=='')& 
       ($this->kab_bps == null | $this->kab_bps=='') &
       ($this->kec_bps==null | $this->kec_bps==''))
        {
        $sqlCount='SELECT COUNT(*) FROM HIRARKI_BPS'. 
                     ' WHERE KODE NOT IN(SELECT KODE_BPS FROM "desa_BPS_dagri")';
        $sqlBPS='SELECT KABUPATEN, KECAMATAN,'.
                'DESA, KODE FROM HIRARKI_BPS WHERE KODE NOT IN(SELECT KODE_BPS FROM "desa_BPS_dagri")'
                . ' ORDER BY KODE';       
        } else if($this->PROV != null & 
       ($this->kab_bps == null| $this->kab_bps=='') &
       ($this->kec_bps==null | $this->kec_bps==''))
        {
        $sqlCount='SELECT COUNT(*) FROM HIRARKI_BPS'. 
                     ' WHERE KODE NOT IN(SELECT KODE_BPS FROM "desa_BPS_dagri") AND '
                    . 'SUBSTRING(KODE,1,2)=\''.$this->PROV.'\'';
        $sqlBPS='SELECT KABUPATEN, KECAMATAN,'.
                'DESA, KODE FROM HIRARKI_BPS WHERE KODE NOT IN(SELECT KODE_BPS FROM "desa_BPS_dagri")AND '
                    . 'SUBSTRING(KODE,1,2)=\''.$this->PROV.'\''
                . ' ORDER BY KODE';       
        } else if($this->PROV != null & 
       ($this->kab_bps != null| $this->kab_bps!='') &
       ($this->kec_bps==null | $this->kec_bps==''))
        {
        $sqlCount='SELECT COUNT(*) FROM HIRARKI_BPS'. 
                     ' WHERE KODE NOT IN(SELECT KODE_BPS FROM "desa_BPS_dagri") AND '
                    . 'SUBSTRING(KODE,1,4)=\''.$this->kab_bps.'\'';
        $sqlBPS='SELECT KABUPATEN, KECAMATAN,'.
                'DESA, KODE FROM HIRARKI_BPS WHERE KODE NOT IN(SELECT KODE_BPS FROM "desa_BPS_dagri")AND '
                    . 'SUBSTRING(KODE,1,4)=\''.$this->kab_bps.'\''
                . ' ORDER BY KODE';       
        }else if($this->PROV != null & 
       ($this->kab_bps != null| $this->kab_bps!='') &
       ($this->kec_bps!=null | $this->kec_bps!=''))
        {
        $sqlCount='SELECT COUNT(*) FROM HIRARKI_BPS'. 
                     ' WHERE KODE NOT IN(SELECT KODE_BPS FROM "desa_BPS_dagri") AND '
                    . 'SUBSTRING(KODE,1,7)=\''.$this->kec_bps.'\'';
        $sqlBPS='SELECT KABUPATEN, KECAMATAN,'.
                'DESA, KODE FROM HIRARKI_BPS WHERE KODE NOT IN(SELECT KODE_BPS FROM "desa_BPS_dagri")AND '
                    . 'SUBSTRING(KODE,1,7)=\''.$this->kec_bps.'\''
                . ' ORDER BY KODE';       
        }
         $count= Yii::$app->db->createCommand(''
                . $sqlCount)->queryScalar();
        $dataProvider= new SqlDataProvider([
            'sql'=>$sqlBPS,
            'totalCount'=>$count,
            'pagination' => [
                'pageSize' => 10,
                ],
        
        ]);
        return $dataProvider;
       
    }
}
