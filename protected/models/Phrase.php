<?php

/**
 * @property string $id
 * @property string $category_id
 * @property integer $active
 * @property integer $sort
 * @property string $slug
 * @property string $created
 * @property ProductNode[] $productNodes
 * @property Category $category
 */
class Phrase extends CActiveRecord {

    public $content;
    
    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'phrases';
    }

    public function rules() {
        return array(
            array('category_id', 'required'),
            array('active, sort, deleted', 'numerical', 'integerOnly' => true),
            array('slug', 'length', 'max' => 250),
            array('id, active, sort, slug, deleted, created', 'safe', 'on' => 'search'),
        );
    }

    public function relations() {
        return array(
            'categories' => array(self::BELONGS_TO, 'Phrasecategory', 'category_id'),
        );
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'category_id' => 'Category',
            'active' => 'Active',
            'sort' => 'Sort',
            'slug' => 'Slug',
            'deleted' => 'Deleted',
            'created' => 'Created',
        );
    }

    public function scopes() {
        return array(
            'notDeleted' => array(
                'condition' => 'deleted = 0'
            ),
            'orderById' => array(
                'order' => 'id ASC',
            ),
            'orderBySort' => array(
                'order' => 'sort ASC',
            ),
            'active' => array(
                'condition' => 'active = 1'
            ),
        );
    }

}