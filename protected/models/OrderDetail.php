<?php

class OrderDetail extends CActiveRecord {

    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'order_details';
    }

    public function relations() {
        return array(
            'order' => array(self::BELONGS_TO, 'Order', 'order_id'),
        );
    }
    
    public function getDetails($orderId) {
        return $this->findByAttributes(array(
            'order_id' => $orderId,
        ));
    }

}