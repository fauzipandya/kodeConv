<?php

namespace app\models;

use Yii;
use app\models\desa;
use yii\base\Model;
use yii\data\SqlDataProvider;
class searchTMDagri extends Model
{
    /**
     * @inheritdoc
     */
    public $PROV;
    public $kab_dagri;
    public $kec_dagri;
    
    public function rules()
    {
        return [
            [[  'PROV', 'kab_dagri','kec_dagri'], 'safe'],
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
       ($this->kab_dagri == null | $this->kab_dagri=='') &
       ($this->kec_dagri==null | $this->kec_dagri==''))
        {
        $sqlCount='SELECT COUNT(*) FROM HIRARKI_KEMENDAGRI'. 
                     ' WHERE KODE NOT IN(SELECT KODE_dAGRI FROM "desa_BPS_dagri")';
        $sqlBPS='SELECT KABUPATEN, KECAMATAN,'.
                'DESA, KODE FROM HIRARKI_KEMENDAGRI WHERE KODE NOT IN(SELECT KODE_DAGRI FROM "desa_BPS_dagri")'
                . ' ORDER BY KODE';       
        } else if($this->PROV != null & 
       ($this->kab_dagri == null| $this->kab_dagri=='') &
       ($this->kec_dagri==null | $this->kec_dagri==''))
        {
        $sqlCount='SELECT COUNT(*) FROM HIRARKI_KEMENDAGRI'. 
                     ' WHERE KODE NOT IN(SELECT KODE_DAGRI FROM "desa_BPS_dagri") AND '
                    . 'SUBSTRING(KODE,1,2)=\''.$this->PROV.'\'';
        $sqlBPS='SELECT KABUPATEN, KECAMATAN,'.
                'DESA, KODE FROM HIRARKI_KEMENDAGRI WHERE KODE NOT IN(SELECT KODE_DAGRI FROM "desa_BPS_dagri")AND '
                    . 'SUBSTRING(KODE,1,2)=\''.$this->PROV.'\''
                . ' ORDER BY KODE';       
        } else if($this->PROV != null & 
       ($this->kab_dagri != null| $this->kab_dagri!='') &
       ($this->kec_dagri==null | $this->kec_dagri==''))
        {
        $sqlCount='SELECT COUNT(*) FROM HIRARKI_KEMENDAGRI'. 
                     ' WHERE KODE NOT IN(SELECT KODE_DAGRI FROM "desa_BPS_dagri") AND '
                    . 'SUBSTRING(KODE,1,5)=\''.$this->kab_dagri.'\'';
        $sqlBPS='SELECT KABUPATEN, KECAMATAN,'.
                'DESA, KODE FROM HIRARKI_KEMENDAGRI WHERE KODE NOT IN(SELECT KODE_DAGRI FROM "desa_BPS_dagri")AND '
                    . 'SUBSTRING(KODE,1,5)=\''.$this->kab_dagri.'\''
                . ' ORDER BY KODE';       
        }else if($this->PROV != null & 
       ($this->kab_dagri != null| $this->kab_dagri!='') &
       ($this->kec_dagri!=null | $this->kec_dagri!=''))
        {
        $sqlCount='SELECT COUNT(*) FROM HIRARKI_KEMENDAGRI'. 
                     ' WHERE KODE NOT IN(SELECT KODE_DAGRI FROM "desa_BPS_dagri") AND '
                    . 'SUBSTRING(KODE,1,8)=\''.$this->kec_dagri.'\'';
        $sqlBPS='SELECT KABUPATEN, KECAMATAN,'.
                'DESA, KODE FROM HIRARKI_KEMENDAGRI WHERE KODE NOT IN(SELECT KODE_DAGRI FROM "desa_BPS_dagri")AND '
                    . 'SUBSTRING(KODE,1,8)=\''.$this->kec_dagri.'\''
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
