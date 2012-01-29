<?php

/**
 * @property string $id
 * @property string $parent_id
 * @property integer $active
 * @property integer $sort
 * @property string $slug
 * @property string $created
 */
class Phrasecategory extends CActiveRecord {

    public $content;

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'phrase_categories';
    }

    public function rules() {
        return array(
            array('slug', 'required'),
            array('active, sort, ', 'numerical', 'integerOnly' => true),
            array('parent_id', 'length', 'max' => 11),
            array('slug', 'length', 'max' => 250),
            array('created', 'safe'),
            array('id, parent_id, active, sort, slug, created', 'safe', 'on' => 'search'),
        );
    }

    public function relations() {
        return array(
            'getparent' => array(self::BELONGS_TO, 'Phrasecategory', 'parent_id'),
            'childs' => array(self::HAS_MANY, 'Phrasecategory', 'parent_id', 'order' => 'sort ASC'),
            'phrases' => array(self::HAS_MANY, 'Phrase', 'category_id', 'order' => 'sort ASC'),
        );
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'parent_id' => 'Parent',
            'active' => 'Active',
            'sort' => 'Sort',
            'slug' => 'Slug',
            'created' => 'Created',
        );
    }
	
	public function scopes() {
        return array(
            'active' => array(
                'condition' => 'active = 1'
            ),
            'notDeleted' => array(
                'condition' => 'deleted = 0'
            ),
        );
    }

    public function getAllCategories() {
        return $this->notDeleted()->findAll("id > 1");
    }

    public function getCategory($id) {
        $category = $this->notDeleted()->findByPk($id);
        if (!$category) {
            return false;
        }
        $category->content = Content::model()->getModuleContent('phrasecategory', $category->id);
        return $category;
    }

    public function getListed($id = '', $visibleAll = false) {
        $subitems = array();
        if ($this->childs)
            foreach ($this->childs as $child) {
                if ($child->active != 1 OR $child->deleted == 1)
                    continue;
                $subitems[] = $child->getListed($id, $visibleAll);
            }
        $categoryContent = Content::model()->getModuleContent('phrasecategory', $this->id);
        $active = (preg_match("/" . str_replace("/", "\/", $this->slug) . "/", $id) > 0);
        $returnarray = array(
            'label' => (isset($categoryContent->title)) ? $categoryContent->title : '',
            'url' => ($this->childs) ? '#' : array('/poetry/category/' . $this->id),
            'active' => (($this->parent_id == 1) ? 
                preg_match('/'.$this->slug.'\/[a-zA-Z0-9\-]+/', $id) : ($this->slug == $id OR preg_match('/'.str_replace("/", "\/", $this->slug).'\/[a-zA-Z0-9\-]+-[0-9]+/', $id)))
        );
        if ($subitems != array())
            $returnarray = array_merge($returnarray, array('items' => $subitems));
        return $returnarray;
    }

    public function getTableRows($level = 0) {
        $subitems = array();
        $returnRows = array();
        if ($this->id != 1) {
            $level = $level + 1;
        }
        if ($this->childs)
            foreach ($this->childs as $child) {
				if ($child->deleted == 1)
                    continue;
                $subitems[] = $child->getTableRows($level);
            }
        if ($this->id != 1) {
            $content = Content::model()->getModuleContent('phrasecategory', $this->id);
            $returnRows = array(
                'level' => $level,
                'controller' => 'phrasecategory',
                'id' => $this->id,
                'slug' => $this->slug,
                'linkTitle' => $content->title,
                'active' => $this->active,
                'created' => $this->created,
            );
        }

        if ($subitems != '')
            $returnRows = array_merge($returnRows, array('items' => $subitems));
        return $returnRows;
    }

    public function getOptionList($parent = '') {
        $subitems = array();
        $categoryContent = Content::model()->getModuleContent('category', $this->id);
        $title = (isset($categoryContent->title)) ? $categoryContent->title : '';
        if ($this->childs)
            foreach ($this->childs as $child) {
				if ($child->deleted == 1)
                    continue;
                $subitems[] = $child->getOptionList($title);
            }
        if ($this->id > 1) {
            $returnArray[$this->id . ' '] = ($parent ? $parent . ' > ' : '') . $categoryContent->title;
        } else {
            $returnArray = array();
        }
        if ($subitems != array())
            foreach ($subitems AS $subitem) {
                $returnArray = array_merge($returnArray, $subitem);
            }
        return $returnArray;
    }

}