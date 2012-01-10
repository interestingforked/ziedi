<?php

/**
 * @property string $id
 * @property string $module
 * @property integer $module_id
 * @property string $language
 * @property string $title
 * @property string $body
 * @property string $created
 */
class Content extends CActiveRecord {

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'contents';
    }

    public function rules() {
        return array(
            array('module, module_id, language', 'required'),
            array('module_id', 'numerical', 'integerOnly' => true),
            array('module', 'length', 'max' => 20),
            array('language', 'length', 'max' => 2),
            array('title, meta_title, background', 'length', 'max' => 250),
            array('body, additional, meta_description, meta_keywords', 'safe'),
            array('id, module, module_id, language, title, body, additional, meta_title, meta_description, meta_keywords, background, created', 'safe', 'on' => 'search'),
        );
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'module' => 'Module',
            'module_id' => 'Module',
            'language' => 'Language',
            'title' => 'Title',
            'body' => 'Body',
            'additional' => 'Additional',
            'meta_title' => 'Meta Title',
            'meta_description' => 'Meta Description',
            'meta_keywords' => 'Meta Keywords',
            'background' => 'Background',
            'created' => 'Created',
        );
    }

    public function getModuleContent($module, $moduleId, $language = null) {
        if (!$language) {
            $language = Yii::app()->language;
            if (!$language)
                $language = Yii::app()->params['defaultLanguage'];
        }
        $content = $this->findByAttributes(array(
            'module' => $module,
            'module_id' => $moduleId,
            'language' => $language,
        ));
        if (!$content) {
            $content = $this->findByAttributes(array(
                'module' => $module,
                'module_id' => $moduleId,
                'language' => Yii::app()->params['defaultLanguage'],
            ));
        }
        return $content;
    }

}