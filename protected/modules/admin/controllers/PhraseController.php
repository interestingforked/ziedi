<?php

class PhraseController extends AdminController {

    public function actionIndex($id = null) {
        $this->pageTitle = 'Phrases';

        $criteria = new CDbCriteria();
        $criteria->addCondition("deleted = 0");

        $products = Phrase::model()->findAll($criteria);

        $this->render('index', array(
            'products' => $products,
            'categoryId' => $id,
        ));
    }

    public function actionAdd() {
        $this->pageTitle = 'Phrases / Add phrase';

        $errors = array();

        $model = new Phrase;
        $contentModel = new Content;
        $contentModel->language = Yii::app()->params['defaultLanguage'];

        $rootCategory = Phrasecategory::model()->findByPk(1);
        $categories = $rootCategory->getTableRows();

        if (isset($_POST['Phrase'])) {
            $model->attributes = $_POST['Phrase'];
            $contentModel->attributes = $_POST['Content'];

            $transaction = Yii::app()->db->beginTransaction();

            if ($model->save()) {
                $contentModel->module = 'phrase';
                $contentModel->module_id = $model->id;
                $contentModel->language = Yii::app()->params['defaultLanguage'];

                if ($contentModel->save()) {
                    $transaction->commit();
                    $this->redirect(array('/admin/phrase'));
                } else {
                    $transaction->rollback();
                    $errors = $contentModel->getErrors();
                }
            } else {
                $transaction->rollback();
                $errors = $model->getErrors();
            }
        }

        $this->render('add', array(
            'errors' => $errors,
            'model' => $model,
            'contentModel' => $contentModel,
            'categories' => $categories,
        ));
    }

    public function actionEdit($id) {
        $this->pageTitle = 'Phrases / Edit phrase';

        $errors = array();

        $model = Phrase::model()->findByPk($id);
        $contentModel = Content::model()->getModuleContent('phrase', $id);
        
        $rootCategory = Phrasecategory::model()->findByPk(1);
        $categories = $rootCategory->getTableRows();

        if (isset($_POST['Phrase'])) {
            $model->attributes = $_POST['Phrase'];
            $contentModel->attributes = $_POST['Content'];

            $transaction = Yii::app()->db->beginTransaction();

            if ($model->save()) {

                if ($contentModel->save()) {
                    $transaction->commit();
                    $this->redirect(array('/admin/phrase'));
                } else {
                    $transaction->rollback();
                    $errors = $contentModel->getErrors();
                }
            } else {
                $transaction->rollback();
                $errors = $model->getErrors();
            }
        }

        $this->render('edit', array(
            'errors' => $errors,
            'model' => $model,
            'contentModel' => $contentModel,
            'title' => $contentModel->title,
            'categories' => $categories,
        ));
    }

    public function actionTranslate($id) {
        $this->pageTitle = 'Phrases / Translate phrase';

        $errors = array();

        $model = Phrase::model()->findByPk($id);
        $contentModel = Content::model()->getModuleContent('phrase', $id, 'ru');

        $rootCategory = Phrasecategory::model()->findByPk(1);
        $categories = $rootCategory->getTableRows();

        if (isset($_POST['Content'])) {
            if ($contentModel->language != 'ru') {
                $contentModel->isNewRecord = true;
                $contentModel->id = null;
            }
            $contentModel->attributes = $_POST['Content'];
            $contentModel->language = 'ru';

            $transaction = Yii::app()->db->beginTransaction();
            if ($contentModel->save()) {
                $transaction->commit();
                $this->redirect(array('/admin/phrase'));
            } else {
                $transaction->rollback();
                $errors = $contentModel->getErrors();
            }
        } else {
            $contentModel->language = 'ru';
        }

        $this->render('translate', array(
            'errors' => $errors,
            'model' => $model,
            'contentModel' => $contentModel,
            'title' => $contentModel->title,
            'categories' => $categories,
        ));
    }

    public function actionDelete($id) {
        $model = Phrase::model()->findByPk($id);
        $model->deleted = 1;
        $model->save();

        $this->redirect(array('/admin/phrase'));
    }

}
