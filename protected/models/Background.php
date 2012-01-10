<?php

/**
 * @property string $id
 * @property string $section
 * @property string $background
 * @property string $created
 */
class Background extends CActiveRecord {

    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'backgrounds';
    }

    public function rules() {
        return array(
            array('created', 'safe'),
            array('id, section, background, created', 'safe', 'on' => 'search'),
        );
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'section' => 'Section',
            'background' => 'Background',
            'created' => 'Created',
        );
    }
    
    public function findBySection($section) {
        return $this->findByAttributes(array('section' => $section));
    }

}