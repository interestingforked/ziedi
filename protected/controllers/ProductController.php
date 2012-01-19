<?php

class ProductController extends Controller {

    public function actionIndex($id) {
        if (Yii::app()->request->isAjaxRequest AND $_POST) {
            $cart = $this->cart->getList();
            if (!$cart)
                $cart = $this->cart->create();
            if ($_POST['action'] == 'addItem') {
                $this->cart->addItem($_POST['productId'], $_POST['productNodeId'], $_POST['price'], $this->currency);
            }
            echo Yii::t('app', 'Prece ir pievienota pirkuma grozam!');
            Yii::app()->end();
        }
        $id = explode('/', $id);
        $productId = end($id);
        array_pop($id);
        $categoryId = '/';
        $category = null;
        $showGift = false;
        if (count($id) > 0) {
            $categoryId = implode('/', $id);
            $category = Category::model()->getCategory($categoryId);
            $showGift = ($category->getparent->gift != 1 AND $category->getparent->postcard != 1);
            if (!$category) {
                if (Yii::app()->request->isAjaxRequest)
                    throw new CHttpException(404, 'The requested page does not exist.');
                else
                    echo 'false';
            }
            if ($category->parent_id > 1) {
                $parentCategories = array();
                $slugs = explode('/', $categoryId);
                for ($i = 0; $i < (count($slugs) - 1); $i++)
                    $parentCategories[] = Category::model()->getCategory($slugs[$i]);
                foreach ($parentCategories as $parentCategory)
                    $this->breadcrumbs[$parentCategory->content->title] = array('/' . $parentCategory->slug);
            }
            $this->breadcrumbs[$category->content->title] = array('/' . $categoryId);
        }
        $productId = explode('-', $productId);
        $productId = end($productId);
        $productModel = Product::model()->findByPk($productId);
        if (!$productModel) {
            if (Yii::app()->request->isAjaxRequest)
                throw new CHttpException(404, 'The requested page does not exist.');
            else
                echo 'false';
        }

        $nodeId = Yii::app()->getRequest()->getParam('node', 0);
        $product = $productModel->getProduct($nodeId);
        if (!$product) {
            if (Yii::app()->request->isAjaxRequest)
                throw new CHttpException(404, 'The requested page does not exist.');
            else
                echo 'false';
        }
        
        if ( ! $category) {
            foreach ($productModel->categories AS $productCategory) {
                if (!$showGift AND $productCategory->getparent) {
                    $showGift = ($productCategory->getparent->gift != 1 AND $productCategory->getparent->postcard != 1);
                } else if (!$showGift AND ($productCategory->gift != 1 AND $productCategory->postcard != 1)) {
                    $showGift = true;
                }
            }
        }
        
        if (Yii::app()->request->isAjaxRequest) {
            if ($nodeId > 0) {
                echo number_format($product->mainNode->price / $this->currencyValue,2,'.','');
                Yii::app()->end();
            }
            $this->renderPartial('ajax', array(
                'category' => $category,
                'product' => $product,
            ));
            Yii::app()->end();
        }

        $this->metaTitle = $product->content->meta_title;
        $this->metaDescription = $product->content->meta_description;
        $this->metaKeywords = $product->content->meta_keywords;

        $session = new CHttpSession();
        $session->open();
        $categoryPage = $session->get('categoryPage');
        if ($categoryPage) {
            $categoryId = $categoryId . (($categoryOrder) ? '&' : '?') . 'page=' . $categoryPage;
        }
        
        $giftRoot = Category::model()->getGiftParent();
        $gifts = $giftRoot->getListed('gifts');

        $this->breadcrumbs[] = $product->content->title;
        $this->render('index', array(
            'category' => $category,
            'categoryLink' => $categoryId,
            'product' => $product,
            'gifts' => $gifts,
            'showGift' => $showGift
        ));
    }

    public function actionNotify() {
        if ($_POST) {
            if (Notifying::model()->checkNotify($_POST) == 0) {
                $notify = new Notifying();
                $notify->product_id = $_POST['productId'];
                $notify->product_node_id = $_POST['productNodeId'];
                $notify->email = $_POST['email'];
                $notify->save();

                Yii::app()->user->setFlash('notification', Yii::t('app', 'Когда данный товар появится на складе, вам будет выслано уведомление.'));
            }
            Yii::app()->controller->redirect($_POST['returnUrl'] . '#notification');
        } else {
            Yii::app()->controller->redirect('/');
        }
    }

}