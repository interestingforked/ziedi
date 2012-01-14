<?php

class AdminController extends CController {

    public $layout = '/layout';
    public $pageTitle = '';
    public $menu = array();
    public $user = null;
    public $languages;
    protected $classifier;

    public function init() {
        parent::init();

        $user = User::model()->findByPk(Yii::app()->user->id);
        if (!$user) {
            $this->redirect(array('/user/login'));
        }
        if ($user->superuser != 1) {
            $this->redirect(array('/'));
        }
        $userProfile = $user->profile;
        $this->user = array(
            'user' => $user,
            'profile' => $userProfile,
            'fullname' => $userProfile->firstname . ' ' . $userProfile->lastname
        );

        $activeMenuId = $this->getId();
        $this->menu = array(
            array(
                'label' => 'Dashboard',
                'url' => array('/admin'),
                'active' => ($activeMenuId == 'default')
            ),
            array(
                'label' => 'Content',
                'url' => array('/admin/page'),
                'active' => (in_array($activeMenuId, array('page', 'article', 'gallery', 'block'))),
                'items' => array(
                    array(
                        'label' => 'Pages',
                        'url' => array('/admin/page'),
                        'active' => ($activeMenuId == 'page')
                    ),
                    /*
                    array(
                        'label' => 'News',
                        'url' => array('/admin/article'),
                        'active' => ($activeMenuId == 'article')
                    ),
                     */
                    array(
                        'label' => 'Gallery',
                        'url' => array('/admin/gallery'),
                        'active' => ($activeMenuId == 'gallery')
                    ),
                    array(
                        'label' => 'Blocks',
                        'url' => array('/admin/block'),
                        'active' => ($activeMenuId == 'block')
                    ),
                )
            ),
            array(
                'label' => 'Catalog',
                'url' => array('/admin/category'),
                'active' => (in_array($activeMenuId, array('category', 'product', 'coupon', 'productreport'))),
                'items' => array(
                    array(
                        'label' => 'Categories',
                        'url' => array('/admin/category'),
                        'active' => ($activeMenuId == 'category')
                    ),
                    array(
                        'label' => 'Products',
                        'url' => array('/admin/product'),
                        'active' => ($activeMenuId == 'product')
                    ),
                    /*
                    array(
                        'label' => 'Coupons',
                        'url' => array('/admin/coupon'),
                        'active' => ($activeMenuId == 'coupon')
                    ),
                     */
                )
            ),
            array(
                'label' => 'Orders',
                'url' => array('/admin/order'),
                'active' => ($activeMenuId == 'order'),
                'items' => array(
                    array(
                        'label' => 'Reports',
                        'url' => array('/admin/order/report'),
                        'active' => ($activeMenuId == 'order')
                    ),
                )
            ),
            /*
            array(
                'label' => 'Users',
                'url' => array('/admin/user'),
                'active' => ($activeMenuId == 'user'),
                'items' => array(
                    array(
                        'label' => 'Reports',
                        'url' => array('/admin/user/report'),
                        'active' => ($activeMenuId == 'user')
                    ),
                )
            ),
            array(
                'label' => 'Newsletters',
                'url' => array('/admin/newsletter'),
                'active' => ($activeMenuId == 'newsletter')
            ),
             */
            array(
                'label' => 'Files',
                'url' => array('/admin/file'),
                'active' => ($activeMenuId == 'file')
            ),
            array(
                'label' => 'Deleted',
                'url' => array('/admin/deleted'),
                'active' => ($activeMenuId == 'deleted')
            ),
            array(
                'label' => 'Settings',
                'url' => array('/admin/setting'),
                'active' => ($activeMenuId == 'setting')
            ),
        );

        $this->languages = Yii::app()->params['languages'];
        $this->classifier = Classifier::model();
    }

}
