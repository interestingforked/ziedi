<?php

/**
 * @property string $id
 * @property string $user_id
 * @property string $coupon_id
 * @property string $key
 * @property string $total_price
 * @property integer $total_count
 * @property string $created
 * @property Coupon $coupon
 * @property User $user
 * @property CartItem[] $items
 * @property Order[] $orders
 */
class Cart extends CActiveRecord {

    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'cart';
    }

    public function rules() {
        return array(
            array('user_id', 'required'),
            array('total_count', 'numerical', 'integerOnly' => true),
            array('user_id, coupon_id', 'length', 'max' => 11),
            array('key', 'length', 'max' => 32),
            array('total_price', 'length', 'max' => 15),
            array('created', 'safe'),
            array('id, user_id, coupon_id, key, total_price, total_count, created', 'safe', 'on' => 'search'),
        );
    }

    public function relations() {
        return array(
            'coupon' => array(self::BELONGS_TO, 'Coupon', 'coupon_id'),
            'user' => array(self::BELONGS_TO, 'User', 'user_id'),
            'items' => array(self::HAS_MANY, 'CartItem', 'cart_id'),
            'orders' => array(self::HAS_MANY, 'Order', 'cart_id'),
        );
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'user_id' => 'User',
            'coupon_id' => 'Coupon',
            'key' => 'Key',
            'total_price' => 'Total Price',
            'total_count' => 'Total Count',
            'created' => 'Created',
        );
    }
    
    public function getByUserId($userId) {
        return $this->findByAttributes(array(
            'user_id' => $userId,
            'closed' => 0,
        ));
    }

}