<?php

class PhrasecategoryController extends AdminController {

    public function actionIndex() {
        $this->pageTitle = 'Phrase categories';

        $rootCategory = Phrasecategory::model()->findByPk(1);
        $tableRows = $rootCategory->getTableRows();

        $this->render('index', array(
            'categories' => $tableRows['items'],
        ));
    }

    public function actionAdd() {
        $this->pageTitle = 'Phrase categories / Add category';

        $errors = array();

        $rootCategory = Phrasecategory::model()->findByPk(1);
        $categories = $rootCategory->getTableRows();

        $categoryModel = new Phrasecategory;
        $contentModel = new Content;
        $contentModel->language = Yii::app()->params['defaultLanguage'];

        if (isset($_POST['Phrasecategory'])) {
            $categoryModel->attributes = $_POST['Phrasecategory'];
            $contentModel->attributes = $_POST['Content'];
            
            if ($categoryModel->parent_id > 1) {
                $parentCategorySlug = Category::model()->getCategorySlug($categoryModel->parent_id);
                if ($parentCategorySlug) 
                    $categoryModel->slug = $parentCategorySlug . '/' . $categoryModel->slug;
            }

            $transaction = Yii::app()->db->beginTransaction();
            if ($categoryModel->save()) {
                $contentModel->module = 'phrasecategory';
                $contentModel->module_id = $categoryModel->id;
                $contentModel->language = Yii::app()->params['defaultLanguage'];

                if ($contentModel->save()) {
                    $transaction->commit();
                    $this->redirect(array('/admin/phrasecategory'));
                } else {
                    $transaction->rollback();
                    $errors = $contentModel->getErrors();
                }
            } else {
                $transaction->rollback();
                $errors = $categoryModel->getErrors();
            }
        }

        $this->render('add', array(
            'errors' => $errors,
            'categories' => $categories,
            'categoryModel' => $categoryModel,
            'contentModel' => $contentModel,
        ));
    }

    public function actionEdit($id) {
        $this->pageTitle = 'Phrase categories / Edit category';

        $errors = array();

        $rootCategory = Phrasecategory::model()->findByPk(1);
        $categories = $rootCategory->getTableRows();

        $categoryModel = Phrasecategory::model()->findByPk($id);
        $contentModel = Content::model()->getModuleContent('phrasecategory', $id);

        if (isset($_POST['Phrasecategory'])) {
            $categoryModel->attributes = $_POST['Phrasecategory'];
            $contentModel->attributes = $_POST['Content'];

            $transaction = Yii::app()->db->beginTransaction();
            if ($categoryModel->save()) {
                if ($contentModel->save()) {
                    $transaction->commit();
                    $this->redirect(array('/admin/phrasecategory'));
                } else {
                    $transaction->rollback();
                    $errors = $contentModel->getErrors();
                }
            } else {
                $transaction->rollback();
                $errors = $categoryModel->getErrors();
            }
        }

        $this->render('edit', array(
            'errors' => $errors,
            'categories' => $categories,
            'categoryModel' => $categoryModel,
            'contentModel' => $contentModel,
            'title' => $contentModel->title,
        ));
    }

    public function actionTranslate($id) {
        $this->pageTitle = 'Phrase categories / Translate category';

        $errors = array();

        $rootCategory = Phrasecategory::model()->findByPk(1);
        $categories = $rootCategory->getTableRows();

        $categoryModel = Phrasecategory::model()->findByPk($id);
        $contentModel = Content::model()->getModuleContent('phrasecategory', $id, 'ru');

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
                $this->redirect(array('/admin/phrasecategory'));
            } else {
                $transaction->rollback();
                $errors = $contentModel->getErrors();
            }
        } else {
            $contentModel->language = 'ru';
        }

        $this->render('translate', array(
            'errors' => $errors,
            'categories' => $categories,
            'categoryModel' => $categoryModel,
            'contentModel' => $contentModel,
            'title' => $contentModel->title,
        ));
    }

    public function actionMoveU($id) {
        $model = Phrasecategory::model()->findByPk($id);
        $sort = $model->sort;
        if ($sort > 1) {
            $upperModel = Phrasecategory::model()->findBySql(
                    "SELECT * FROM phrase_categories WHERE parent_id = :parent_id AND sort < :sort", array(
                ':parent_id' => $model->parent_id,
                ':sort' => $sort,
                    ));
            if ($upperModel) {
                $model->sort = $upperModel->sort;
                $model->save();
                $upperModel->sort = $sort;
                $upperModel->save();
            }
        }
        $this->redirect(array('/admin/phrasecategory'));
    }

    public function actionMoveD($id) {
        $model = Phrasecategory::model()->findByPk($id);
        $sort = $model->sort;
        $maxModel = Phrasecategory::model()->findBySql(
                "SELECT MAX(sort) as sort FROM phrase_categories WHERE parent_id = :parent_id", array(':parent_id' => $model->parent_id)
        );
        if ($sort < $maxModel->sort) {
            $upperModel = Phrasecategory::model()->findBySql(
                    "SELECT * FROM phrase_categories WHERE parent_id = :parent_id AND sort > :sort", array(
                ':parent_id' => $model->parent_id,
                ':sort' => $sort,
                    ));
            if ($upperModel) {
                $model->sort = $upperModel->sort;
                $model->save();
                $upperModel->sort = $sort;
                $upperModel->save();
            }
        }
        $this->redirect(array('/admin/phrasecategory'));
    }

    public function actionDelete($id) {
        $model = Phrasecategory::model()->findByPk($id);
        $model->deleted = 1;
        $model->save();

        $this->redirect(array('/admin/phrasecategory'));
    }

}
