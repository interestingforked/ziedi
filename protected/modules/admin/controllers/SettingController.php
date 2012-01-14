<?php

class SettingController extends AdminController {

    public function actionIndex() {
        $this->pageTitle = 'Settings';

        $settings = Setting::model()->findAll();
        
        if ($_POST) {
            foreach ($_POST AS $key => $value) {
                $setting = Setting::model()->findByKey($key);
                if ($setting) {
                    $setting->value = $value;
                    $setting->save();
                }
            }
        }

        $this->render('index', array(
            'settings' => $settings,
        ));
    }

}
