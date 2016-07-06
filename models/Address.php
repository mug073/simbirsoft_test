<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "address".
 *
 * @property integer $id
 * @property string $country
 * @property string $city
 * @property string $street
 * @property integer $house
 * @property string $zipcode
 * @property integer $created_at
 * @property integer $updated_at
 */
class Address extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'address';
    }
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }






    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['house'], 'integer'],
            [['country', 'city', 'street', 'zipcode'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'country' => 'Country',
            'city' => 'City',
            'street' => 'Street',
            'house' => 'House',
            'zipcode' => 'Zipcode',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @inheritdoc
     * @return AddressQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AddressQuery(get_called_class());
    }
}
