<?php

/**
 * @property string $id
 * @property string $region_id
 * @property integer $active
 * @property string $title
 * @property string $latin
 * @property Region $region
 * @property OrderDetail[] $orderDetails
 */
class District extends CActiveRecord {

    public static function model($className=__CLASS__) {
        return parent::model($className);
    }
    
    public function tableName() {
        return 'districts';
    }

    public function rules() {
        return array(
            array('region_id', 'required'),
            array('active', 'numerical', 'integerOnly' => true),
            array('id, region_id', 'length', 'max' => 11),
            array('title, latin', 'length', 'max' => 250),
            array('id, region_id, active, title, latin', 'safe', 'on' => 'search'),
        );
    }
    
    public function relations() {
        return array(
            'region' => array(self::BELONGS_TO, 'Region', 'region_id'),
            'orderDetails' => array(self::HAS_MANY, 'OrderDetail', 'district_id'),
        );
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'region_id' => 'Region',
            'active' => 'Active',
            'title' => 'Title',
            'latin' => 'Latin',
        );
    }

}