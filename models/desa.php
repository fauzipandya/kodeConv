<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "desa_BPS_dagri".
 *
 * @property string $desa_bps
 * @property string $kec_bps
 * @property string $kab_bps
 * @property string $kode_bps
 * @property string $desa_dagri
 * @property string $kec_dagri
 * @property string $kab_dagri
 * @property string $kode_dagri
 * @property string $PROV
 */
class desa extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $pilih=['Kabupaten','Kecamatan','Desa','Kode'];
    public static function tableName()
    {
        return 'desa_BPS_dagri';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['desa_bps', 'kec_bps', 'kab_bps', 'kode_bps', 'desa_dagri', 'kec_dagri', 'kab_dagri', 'PROV'], 'string'],
            [['kode_bps'], 'required'],
            [['kode_dagri'], 'string', 'max' => 13],
            ['pilih', 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'desa_bps' => 'Desa BPS',
            'kec_bps' => 'Kec BPS',
            'kab_bps' => 'Kab BPS',
            'kode_bps' => 'Kode BPS',
            'desa_dagri' => 'Desa Kemendagri',
            'kec_dagri' => 'Kec Kemendagri',
            'kab_dagri' => 'Kab Kemendagri',
            'kode_dagri' => 'Kode Kemendagri',
            'PROV' => 'Provinsi',
            'pilih'=> 'Pilihan',
        ];
    }
}
