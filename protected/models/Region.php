<?php

/**
 * @property string $id
 * @property string $country_id
 * @property integer $active
 * @property string $title
 * @property string $latin
 * @property District[] $districts
 * @property OrderDetail[] $orderDetails
 * @property Country $country
 */
class Region extends CActiveRecord {

    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'regions';
    }

    public function rules() {
        return array(
            array('country_id', 'required'),
            array('active', 'numerical', 'integerOnly' => true),
            array('id, country_id', 'length', 'max' => 11),
            array('title, latin', 'length', 'max' => 250),
            array('id, country_id, active, title, latin', 'safe', 'on' => 'search'),
        );
    }

    public function relations() {
        return array(
            'districts' => array(self::HAS_MANY, 'District', 'region_id'),
            'orderDetails' => array(self::HAS_MANY, 'OrderDetail', 'region_id'),
            'country' => array(self::BELONGS_TO, 'Country', 'country_id'),
        );
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'country_id' => 'Country',
            'active' => 'Active',
            'title' => 'Title',
            'latin' => 'Latin',
        );
    }

}