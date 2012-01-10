<?php

/**
 * @property string $id
 * @property string $module
 * @property integer $module_id
 * @property string $mimetype
 * @property string $image
 * @property string $alt
 * @property string $created
 */
class Attachment extends CActiveRecord {

    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'attachments';
    }

    public function rules() {
        return array(
            array('module, module_id', 'required'),
            array('module_id', 'numerical', 'integerOnly' => true),
            array('module', 'length', 'max' => 20),
            array('mimetype', 'length', 'max' => 30),
            array('image, alt', 'length', 'max' => 200),
            array('id, module, module_id, mimetype, image, alt, created', 'safe', 'on' => 'search'),
        );
    }

    public function getAttachment($module, $moduleId) {
        return $this->findByAttributes(array(
            'module' => $module,
            'module_id' => $moduleId,
        ));
    }

    public function getAttachments($module, $moduleId) {
        if (is_array($module)) {
            $conditions = array();
            foreach ($module AS $mod)
                $conditions[] = " module = '{$mod}' "; 
            $condition = implode('OR', $conditions);
            return $this->findAllBySql(
                "SELECT * FROM attachments WHERE ({$condition}) AND module_id = :module_id", array(
                ':module_id' => $moduleId,
            ));
        }
        if (is_string($module)) {
            return $this->findAllByAttributes(array(
                'module' => $module,
                'module_id' => $moduleId,
            ));
        }
    }
    
    public function saveAttachments($files, $module, $moduleId, $slug) {
        if ( ! is_array($files))
            return false;
        $errors = array();
        foreach ($files AS $file) {
            $fileInfo = explode('|', $file);
            
            // '+responseJSON.filename+'|'+responseJSON.image+'|'+responseJSON.mimetype+'|'+responseJSON.path+'
            $fileName = $fileInfo[0];
            $mimeType = strtolower($fileInfo[2]);
            $tmpFile = realpath($fileInfo[3]);
            
            $extension = explode('.', $fileInfo[1]);
            $extension = end($extension);
            
            $this->isNewRecord = true;
            $this->id = null;
            $this->module = $module;
            $this->module_id = $moduleId;
            $this->mimetype = $mimeType;
            $this->alt = $fileName;
            $this->save();
            
            switch ($module) {
                case 'page': $directory = 'pages'; break;
                case 'article': $directory = 'articles'; break;
                case 'gallery': $directory = 'gallery'; break;
                case 'block': $directory = 'blocks'; break;
                default: $directory = 'images';
            }

            $image = $slug.'-'.$moduleId.'-'.$this->id.'.'.$extension;
            $newFile = Yii::app()->basePath.DIRECTORY_SEPARATOR.'..'.Yii::app()->params[$directory].$image;
            if (copy($tmpFile, $newFile)) {
                unlink($tmpFile);
            }
            $this->image = $image;
            if ( ! $this->save()) {
                $errors[] = $this->getErrors();
            }
        }
        if (count($errors) > 0)
            return $errors;
        return true;
    }
    
    public function saveImage($file, $module) {
        $fileInfo = explode('|', $file);

        $fileName = $fileInfo[0];
        $tmpFile = realpath($fileInfo[3]);
            
        $extension = explode('.', $fileInfo[1]);
        $extension = end($extension);
        
        switch ($module) {
            case 'page':        $directory = 'pages';       break;
            case 'category':    $directory = 'categories';  break;
            case 'background':  $directory = 'backgrounds'; break;
            default:            $directory = 'images';
        }
            
        $image = $fileName.'.'.$extension;
        $newFile = Yii::app()->basePath.DIRECTORY_SEPARATOR.'..'.Yii::app()->params[$directory].$image;
        if (copy($tmpFile, $newFile)) {
            unlink($tmpFile);
        }
        return $image;
    }

}