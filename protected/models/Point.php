<?php

/**
 * @property string $id
 * @property string $country_id
 * @property string $region_id
 * @property string $district_id
 * @property integer $active
 * @property string $title
 * @property string $latin
 * @property District $district
 * @property Country $country
 * @property Region $region
 */
class Point extends CActiveRecord {
    
    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'points';
    }
    
    public function rules() {
        return array(
            array('active', 'numerical', 'integerOnly' => true),
            array('id', 'length', 'max' => 10),
            array('country_id, region_id, district_id', 'length', 'max' => 11),
            array('title, latin', 'length', 'max' => 250),
            array('id, country_id, region_id, district_id, active, title, latin', 'safe', 'on' => 'search'),
        );
    }

    public function relations() {
        return array(
            'district' => array(self::BELONGS_TO, 'District', 'district_id'),
            'country' => array(self::BELONGS_TO, 'Countrie', 'country_id'),
            'region' => array(self::BELONGS_TO, 'Region', 'region_id'),
        );
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'country_id' => 'Country',
            'region_id' => 'Region',
            'district_id' => 'District',
            'active' => 'Active',
            'title' => 'Title',
            'latin' => 'Latin',
        );
    }

}