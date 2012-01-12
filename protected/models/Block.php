<?php

/**
 * @property string $id
 * @property integer $active
 * @property integer $position
 * @property integer $sort
 * @property string $created
 */
class Block extends CActiveRecord {
    
    public $content;

    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'blocks';
    }

    public function rules() {
        return array(
            array('active, position, sort', 'numerical', 'integerOnly' => true),
            array('created', 'safe'),
            array('id, active, position, sort, created', 'safe', 'on' => 'search'),
        );
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'active' => 'Active',
            'position' => 'Position',
            'sort' => 'Sort',
            'created' => 'Created',
        );
    }
    
    public function defaultScope() {
        return array(
            'order' => 'sort ASC',
        );
    }

    public function scopes() {
        return array(
            'active' => array(
                'condition' => 'active = 1'
            ),
        );
    }
    
    public function getBlock($position) {
        $block = $this->findByAttributes(array('position' => $position));
        if (!$block) {
            return false;
        }
        $content = Content::model()->getModuleContent('block', $block->id);
        return $content->body;
    }

}