<?php

class PoetryController extends Controller {

    public function actionCategory($id) {
        $category = Phrasecategory::model()->getCategory($id);
        if (Yii::app()->request->isAjaxRequest) {
            if (!$category OR !$category->phrases) {
                echo '';
                Yii::app()->end();
            }
            $phrases = '';
            $i = 0;
            foreach ($category->phrases AS $phrase) {
                $phrase->content = Content::model()->getModuleContent('phrase', $phrase->id, Yii::app()->language);
                if (!$phrase->content) continue;
                $i++;
                $phrases .= '<li>'.CHtml::link($i, array('/poetry/get/'.$phrase->id)).'</li>';
            }
            echo $phrases;
            Yii::app()->end();
        }
        Yii::app()->controller->redirect(array('/'));
    }
    
    public function actionGet($id) {
        if (Yii::app()->request->isAjaxRequest) {
            $phrase = Phrase::model()->findByPk($id);
            if (!$phrase) {
                echo '';
                Yii::app()->end();
            }
            $phrase->content = Content::model()->getModuleContent('phrase', $phrase->id);
            echo CJSON::encode(array(
                'id' => $phrase->id,
                'language' => $phrase->content->language,
                'content' => $phrase->content->body
            ));
            Yii::app()->end();
        }
        Yii::app()->controller->redirect(array('/'));
    }

}