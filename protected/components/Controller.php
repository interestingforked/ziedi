<?php

class Controller extends CController {

    public $layout = '//layouts/layout';
    public $menu = array();
    public $categories = array();
    public $bottomMenu = array();
    public $breadcrumbs = array();
    public $metaTitle = '';
    public $metaDescription = '';
    public $metaKeywords = '';
    public $background = '';
    public $link = '';
    protected $classifier;
    protected $wishlistManager;
    protected $cart;

    public function init() {
        parent::init();
        if (isset($_GET['lang']))
            Yii::app()->setLanguage($_GET['lang']);
        else
            Yii::app()->setLanguage(Language::getdefaultLanguage());

        $this->classifier = Classifier::model();
    }

    public static function processUrl() {
        if (isset($_GET['lang'])) {
            return Language::getLanguageByCode(Yii::app()->language, Yii::app()->controller->route);
        } else {
            return Language::getLanguageByCode(Language::getdefaultLanguage(), Yii::app()->controller->route);
        }
    }

    protected function beforeAction($action) {
        self::processUrl();

        $id = $_SERVER['REQUEST_URI'];

        $rootPage = Page::model()->findByPk(1);
        $this->menu = $rootPage->getListed($id);

        $rootCategory = Category::model()->findByPk(1);
        $this->categories = $rootCategory->getListed($id);

        $this->wishlistManager = new WishlistManager();
        $this->cart = new CartManager();

        if (isset($_GET['lang']))
            Yii::app()->setLanguage($_GET['lang']);
        else
            Yii::app()->setLanguage(Language::getdefaultLanguage());

        $this->setLanguage(Yii::app()->language);

        $link = ($_SERVER['REQUEST_URI'] != '/') ? $_SERVER['REQUEST_URI'] : '/' . Yii::app()->language . '/';
        $this->link = array(
            'ru' => str_replace('/lv/', '/ru/', $link),
            'lv' => str_replace('/ru/', '/lv/', $link),
        );

        return parent::beforeAction($action);
    }

    public function bottomMenu() {
        return $this->renderPartial('//elements/bottom_menu', array(
            'language' => Yii::app()->language,
            'cartCount' => $this->cart->count(),
            'wishListCount' => $this->wishlistManager->count(),
        ));
    }

    public function search() {
        return $this->renderPartial('//elements/search');
    }
    
    private function setLanguage($language = null) {
        $session = new CHttpSession();
        $session->open();
        if ($language) {
            $language = Language::getdefaultLanguage();
        }
        $session->add('language', $language);
    }

}