<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "hirarki_kemendagri".
 *
 * @property string $kode
 * @property string $desa
 * @property string $kecamatan
 * @property string $kabupaten
 */
class HirarkiKemendagri extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hirarki_kemendagri';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['desa', 'kecamatan', 'kabupaten'], 'string'],
            [['kode'], 'string', 'max' => 13],
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
