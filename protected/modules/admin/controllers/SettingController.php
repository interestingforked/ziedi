<?php

class SettingController extends AdminController {

    public function actionIndex() {
        $this->pageTitle = 'Settings';

        if ($_POST) {
            foreach ($_POST AS $key => $value) {
                $setting = Setting::model()->findByKey($key);
                if ($setting) {
                    $setting->value = $value;
                    $setting->save();
                }
            }
        }
        $settings = Setting::model()->findAll();

        $this->render('index', array(
            'settings' => $settings,
        ));
    }

}
