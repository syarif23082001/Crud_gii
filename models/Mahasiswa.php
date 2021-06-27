<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "mahasiswa".
 *
 * @property int $id
 * @property string $nim
 * @property string $nama
 * @property string $jekel
 * @property int $id_fakultas
 * @property int $id_prodi
 * @property string $email
 * @property string $alamat
 * @property string $tgl_lahir
 *
 * @property Prodi $prodi
 * @property Fakultas $fakultas
 */
class Mahasiswa extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mahasiswa';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nim', 'nama', 'jekel', 'id_fakultas', 'id_prodi', 'email', 'alamat', 'tgl_lahir'], 'required'],
            [['id_fakultas', 'id_prodi'], 'integer'],
            [['tgl_lahir'], 'safe'],
            [['nim'], 'string', 'max' => 15],
            [['nama', 'email'], 'string', 'max' => 50],
            [['jekel'], 'string', 'max' => 2],
            [['alamat'], 'string', 'max' => 100],
            [['id_fakultas'], 'exist', 'skipOnError' => true, 'targetClass' => Fakultas::className(), 'targetAttribute' => ['id_fakultas' => 'id_fakultas']],
            [['id_prodi'], 'exist', 'skipOnError' => true, 'targetClass' => Prodi::className(), 'targetAttribute' => ['id_prodi' => 'id_prodi']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nim' => 'Nim',
            'nama' => 'Nama',
            'jekel' => 'Jekel',
            'id_fakultas' => 'Id Fakultas',
            'id_prodi' => 'Id Prodi',
            'email' => 'Email',
            'alamat' => 'Alamat',
            'tgl_lahir' => 'Tgl Lahir',
        ];
    }

    /**
     * Gets query for [[Prodi]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFakultas()
    {
        return $this->hasOne(Fakultas::className(), ['id_fakultas' => 'id_fakultas']);
    }
    
    public function getProdi()
    {
        return $this->hasOne(Prodi::className(), ['id_prodi' => 'id_prodi']);
    }

}
