<?php

/**
 * @property string $id
 * @property string $key
 * @property string $value
 * @property string $created
 */
class Setting extends CActiveRecord {

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'settings';
    }

    public function rules() {
        return array(
            array('key, value', 'required'),
            array('key', 'length', 'max' => 50),
            array('id, key, value, created', 'safe', 'on' => 'search'),
        );
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'key' => 'Key',
            'value' => 'Value',
            'created' => 'Created',
        );
    }
	
	public function defaultScope() {
		return array(
			'order' => 'sort asc',
		);
	}

    public function getValue($key, $default = null) {
        $setting = $this->findByKey($key);
        return ($setting) ? $setting->value : $default;
    }
    
    public function findByKey($key) {
        return $this->findByAttributes(array(
            'key' => $key
        ));
    }

}