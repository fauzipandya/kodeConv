<?php

namespace app\models;

use Yii;
use app\models\desa;
use yii\base\Model;
use yii\data\SqlDataProvider;
class searchRekap extends Model
{
    /**
     * @inheritdoc
     */
    public $PROV;
    public $kab_bps;
    
    public function rules()
    {
        return [
            [[  'PROV', 'kab_bps'], 'safe'],
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


       if(($this->PROV ==null ||$this->PROV=='') &&
          ($this->kab_bps ==null ||$this->kab_bps=='')){
        $sqlCount='SELECT COUNT(DISTINCT SUBSTRING(KODE_BPS,1,2)) FROM "desa_BPS_dagri" ';
        $sql='SELECT A.KODE_PROV, "PROV", KAB_BPS, KEC_BPS, DESA_BPS, KAB_DAGRI, KEC_DAGRI, DESA_DAGRI, KAB_MATCH,'.
                ' KEC_MATCH,DESA_MATCH FROM '.
                    ' (SELECT SUBSTRING(kode,1,2) KODE_PROV, COUNT(DISTINCT SUBSTRING(kode,1,4))AS KAB_BPS,'.
                    '  COUNT(DISTINCT SUBSTRING(kode,1,7)) AS KEC_BPS, COUNT(kode) AS DESA_BPS FROM HIRARKI_BPS WHERE kode IS NOT NULL'.
                    '  GROUP BY KODE_PROV ORDER BY KODE_PROV ) A JOIN'.        
                    ' (SELECT "PROV", SUBSTRING(KODE_BPS,1,2) KODE_PROV, SUBSTRING(KODE_DAGRI,1,2) KODE_DAGRI_PROV,'.
                    'COUNT(DISTINCT SUBSTRING(KODE_BPS,1,4)) AS KAB_MATCH, COUNT(DISTINCT SUBSTRING(KODE_BPS,1,7)) AS KEC_MATCH,'.
                    'COUNT(KODE_BPS) AS DESA_MATCH FROM "desa_BPS_dagri" GROUP BY "PROV", KODE_PROV,KODE_DAGRI_PROV ORDER BY KODE_PROV) B ON A.KODE_PROV=B.KODE_PROV JOIN'.
                    '(SELECT SUBSTRING(KODE,1,2) KODE_DAGRI_PROV, COUNT(DISTINCT SUBSTRING(KODE,1,5)) KAB_DAGRI, COUNT(DISTINCT SUBSTRING(KODE,1,8)) KEC_DAGRI,'.
                    ' COUNT(KODE) DESA_DAGRI FROM HIRARKI_KEMENDAGRI GROUP BY KODE_DAGRI_PROV ORDER BY KODE_DAGRI_PROV) C ON B.KODE_DAGRI_PROV=C.KODE_DAGRI_PROV';
       }
       else if(($this->PROV!=null||$this->PROV!='') && 
               ($this->kab_bps==''||$this->kab_bps==null)){
        $sqlCount='SELECT COUNT(DISTINCT SUBSTRING(KODE_BPS,1,4)) FROM "desa_BPS_dagri" WHERE '
                . 'SUBSTRING(KODE_BPS,1,2)=\''.$this->PROV.'\'';
        $sql= 'SELECT A.KODE_KAB, KAB_BPS, KEC_BPS,DESA_BPS,KEC_DAGRI,DESA_DAGRI,KEC_MATCH,DESA_MATCH '.
              ' FROM'.
              '(SELECT SUBSTRING(kode,1,4) KODE_KAB,COUNT(DISTINCT SUBSTRING(kode,1,7)) AS KEC_BPS, COUNT(kode) AS DESA_BPS'.
              ' FROM HIRARKI_BPS'.' GROUP BY KODE_KAB ORDER BY KODE_KAB ) A JOIN'.     
              ' (SELECT KAB_BPS,SUBSTRING(KODE_BPS,1,4) KODE_KAB,SUBSTRING(KODE_DAGRI,1,5) KODE_DAGRI_KAB,'.
              'COUNT(DISTINCT SUBSTRING(KODE_BPS,1,7)) AS KEC_MATCH,COUNT(KODE_BPS) AS DESA_MATCH'.
              ' FROM "desa_BPS_dagri" WHERE SUBSTRING(KODE_BPS,1,2)=\''.$this->PROV.'\''.
              ' GROUP BY KAB_BPS, KODE_KAB,KODE_DAGRI_KAB ORDER BY KODE_KAB) B ON A.KODE_KAB=B.KODE_KAB'.
              ' JOIN'.
              ' (SELECT SUBSTRING(KODE,1,5) KODE_DAGRI_KAB, COUNT(DISTINCT SUBSTRING(KODE,1,8)) KEC_DAGRI,'. 
              ' COUNT(KODE) DESA_DAGRI FROM HIRARKI_KEMENDAGRI GROUP BY KODE_DAGRI_KAB ORDER BY KODE_DAGRI_KAB)'.
               ' C ON B.KODE_DAGRI_KAB=C.KODE_DAGRI_KAB';
        }
        
       else if(($this->PROV!=null||$this->PROV!='') && 
               ($this->kab_bps!=''||$this->kab_bps!=null)){
        $sqlCount='SELECT COUNT(DISTINCT SUBSTRING(KODE_BPS,1,7)) FROM "desa_BPS_dagri" WHERE '
                . 'SUBSTRING(KODE_BPS,1,4)=\''.$this->kab_bps.'\'';
        $sql= 'SELECT A.KODE_KEC, KEC_BPS, DESA_BPS,DESA_DAGRI,DESA_MATCH '.
              ' FROM'.
              '(SELECT SUBSTRING(kode,1,7) KODE_KEC, COUNT(kode) AS DESA_BPS'.
              ' FROM HIRARKI_BPS'.' GROUP BY KODE_KEC ORDER BY KODE_KEC ) A JOIN'.     
              ' (SELECT KEC_BPS,SUBSTRING(KODE_BPS,1,7) KODE_KEC,SUBSTRING(KODE_DAGRI,1,8) KODE_DAGRI_KEC,'.
              ' COUNT(KODE_BPS) AS DESA_MATCH'.
              ' FROM "desa_BPS_dagri" WHERE SUBSTRING(KODE_BPS,1,4)=\''.$this->kab_bps.'\''.
              ' GROUP BY KEC_BPS, KODE_KEC,KODE_DAGRI_KEC ORDER BY KODE_KEC) B ON A.KODE_KEC=B.KODE_KEC'.
              ' JOIN'.
              ' (SELECT SUBSTRING(KODE,1,8) KODE_DAGRI_KEC,'. 
              ' COUNT(KODE) DESA_DAGRI FROM HIRARKI_KEMENDAGRI GROUP BY KODE_DAGRI_KEC ORDER BY KODE_DAGRI_KEC)'.
               ' C ON B.KODE_DAGRI_KEC=C.KODE_DAGRI_KEC';
        }
         $count= Yii::$app->db->createCommand(''
                . $sqlCount)->queryScalar();
        $dataProvider= new SqlDataProvider([
            'sql'=>$sql,
            'totalCount'=>$count,
            'pagination' => [
                'pageSize' => 10,
                ],
        
        ]);
        return $dataProvider;
       
    }
}
