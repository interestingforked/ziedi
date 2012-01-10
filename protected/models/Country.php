<?php

/**
 * @property string $id
 * @property integer $active
 * @property string $title
 * @property string $latin
 * @property OrderDetail[] $orderDetails
 * @property Region[] $regions
 */
class Country extends CActiveRecord {

    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'countries';
    }

    public function rules() {
        return array(
            array('active', 'numerical', 'integerOnly' => true),
            array('id', 'length', 'max' => 11),
            array('title, latin', 'length', 'max' => 250),
            array('id, active, title, latin', 'safe', 'on' => 'search'),
        );
    }

    public function relations() {
        return array(
            'orderDetails' => array(self::HAS_MANY, 'OrderDetail', 'country_id'),
            'regions' => array(self::HAS_MANY, 'Region', 'country_id'),
        );
    }
    
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'active' => 'Active',
            'title' => 'Title',
            'latin' => 'Latin',
        );
    }
    
    public function getActive() {
        return $this->findAllByAttributes(array(
            'active' => 1
        ));
    }
    
    public function getCountryName($countryId, $latin = false) {
        $country = $this->findbyPk($countryId);
        if ( ! $country)
            return false;
        return ($latin) ? $country->latin : $country->title;
    }

}