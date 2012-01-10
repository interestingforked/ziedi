<?php

/**
 * @property string $id
 * @property string $cart_id
 * @property string $product_id
 * @property string $product_node_id
 * @property integer $quantity
 * @property string $price
 * @property string $created
 * @property Cart $cart
 */
class CartItem extends CActiveRecord {

    public static function model($className=__CLASS__) {
        return parent::model($className);
    }
    
    public function tableName() {
        return 'cart_items';
    }

    public function rules() {
        return array(
            array('cart_id, product_id, product_node_id', 'required'),
            array('quantity', 'numerical', 'integerOnly' => true),
            array('cart_id, product_id, product_node_id', 'length', 'max' => 11),
            array('price', 'length', 'max' => 15),
            array('created', 'safe'),
            array('id, cart_id, product_id, product_node_id, quantity, price, created', 'safe', 'on' => 'search'),
        );
    }

    public function relations() {
        return array(
            'productNode' => array(self::BELONGS_TO, 'ProductNode', 'product_node_id'),
            'cart' => array(self::BELONGS_TO, 'Cart', 'cart_id'),
            'product' => array(self::BELONGS_TO, 'Product', 'product_id'),
        );
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'cart_id' => 'Cart',
            'product_id' => 'Product',
            'product_node_id' => 'Product Node',
            'quantity' => 'Quantity',
            'price' => 'Price',
            'created' => 'Created',
        );
    }
    
}