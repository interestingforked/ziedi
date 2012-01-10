<?php

/**
 * @property string $id
 * @property string $group
 * @property string $key
 * @property string $value
 * @property integer $active
 * @property string $created
 */
class Classifier extends CActiveRecord {

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'classifier';
    }

    public function rules() {
        return array(
            array('group, key, value', 'required'),
            array('active', 'numerical', 'integerOnly' => true),
            array('group, key', 'length', 'max' => 20),
            array('value', 'length', 'max' => 250),
            array('id, group, key, value, active, created', 'safe', 'on' => 'search'),
        );
    }
    
    public function scopes() {
        return array(
            'ordered' => array(
                'order' => 'value ASC',
            ),
        );
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'group' => 'Group',
            'key' => 'Key',
            'value' => 'Value',
            'active' => 'Active',
            'created' => 'Created',
        );
    }

    public function getValue($group, $key, $default = '') {
        $classiefier = $this->findByAttributes(array(
            'group' => $group,
            'key' => $key
        ));
        return ($classiefier) ? $classiefier->value : $default;
    }

    public function getGroup($group) {
        return $this->ordered()->findAllByAttributes(array('group' => $group,));
    }

}