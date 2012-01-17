<?php

class SiteController extends Controller {

    public function actionIndex() {
        $this->metaTitle = $this->settings['INDEX_TITLE'];
        
        $products = array();
        $category = Category::model()->getCategory($this->settings['INDEX_CATEGORY']);
        if ($category) {
            foreach ($category->products AS $product) {
                if ($product->active == 0)
                    continue;
                if ($product->deleted == 1)
                    continue;
                $product->getProduct();
                $products[] = $product;
            }
        }
        $this->render('index', array(
            'category' => $category,
            'products' => $products,
        ));
    }

    public function actionError() {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

}