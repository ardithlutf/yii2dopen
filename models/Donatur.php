<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

/**
 * This is the model class for table "donatur".
 *
 * @property int $id
 * @property string $nama
 * @property string $username
 * @property string $password
 * @property string $tgl_lahir
 * @property string $alamat
 * @property string $hp
 * @property string $email
 * @property string $foto
 *
 * @property Donasi $donasi
 * @property Admin[] $ids
 * @property Jenis[] $ids0
 */
class Donatur extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $imageFile;
    public static function tableName()
    {
        return 'donatur';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama', 'username', 'password', 'tgl_lahir', 'alamat', 'hp', 'email'], 'required'],
            [['tgl_lahir'], 'safe'],
            [['alamat'], 'string'],
            [['nama', 'username', 'foto'], 'string', 'max' => 45],
            [['password', 'email'], 'string', 'max' => 30],
            [['hp'], 'string', 'max' => 15],
            [['imageFile'], 'file',
                'extensions' => 'jpg,jpeg,png,gif',
                'maxSize' => '10000000', //max 1 GB
                'skipOnEmpty' => false,
            ],
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            $this->imageFile->saveAs('uploads/' . $this->imageFile->baseName . '.' . $this->imageFile->extension);
            return true;
        } else {
            return false;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama' => 'Nama',
            'username' => 'Username',
            'password' => 'Password',
            'tgl_lahir' => 'Tgl Lahir',
            'alamat' => 'Alamat',
            'hp' => 'Hp',
            'email' => 'Email',
            'foto' => 'Foto',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDonasi()
    {
        return $this->hasOne(Donasi::className(), ['id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIds()
    {
        return $this->hasMany(Admin::className(), ['id' => 'id'])->viaTable('donasi', ['id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIds0()
    {
        return $this->hasMany(Jenis::className(), ['id' => 'id'])->viaTable('donasi', ['id' => 'id']);
    }
}
