<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "hirarki_bps".
 *
 * @property string $kode
 * @property string $desa
 * @property string $kecamatan
 * @property string $kabupaten
 */
class HirarkiBps extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hirarki_bps';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['desa', 'kecamatan', 'kabupaten'], 'string'],
            [['kode'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'kode' => 'Kode',
            'desa' => 'Desa',
            'kecamatan' => 'Kecamatan',
            'kabupaten' => 'Kabupaten',
        ];
    }
}
