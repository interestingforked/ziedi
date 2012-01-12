<?php

class SiteController extends Controller {

    public function actionIndex() {
        
        $this->metaTitle = Yii::app()->params['indexTitle'];

        $this->render('index', array(

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