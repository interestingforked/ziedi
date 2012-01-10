<?php

/**
 * @property string $id
 * @property string $order_id
 * @property string $product_id
 * @property string $product_node_id
 * @property integer $quantity
 * @property string $price
 * @property string $subtotal
 * @property string $created
 * @property ProductNode $productNode
 * @property Order $order
 * @property Product $product
 */
class OrderItem extends CActiveRecord {
    
    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'order_items';
    }

    public function rules() {
        return array(
            array('order_id, product_id, product_node_id', 'required'),
            array('quantity', 'numerical', 'integerOnly' => true),
            array('order_id, product_id, product_node_id', 'length', 'max' => 11),
            array('price, subtotal', 'length', 'max' => 15),
            array('created', 'safe'),
            array('id, order_id, product_id, product_node_id, quantity, price, subtotal, created', 'safe', 'on' => 'search'),
        );
    }

    public function relations() {
        return array(
            'productNode' => array(self::BELONGS_TO, 'ProductNode', 'product_node_id'),
            'order' => array(self::BELONGS_TO, 'Order', 'order_id'),
            'product' => array(self::BELONGS_TO, 'Product', 'product_id'),
        );
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'order_id' => 'Order',
            'product_id' => 'Product',
            'product_node_id' => 'Product Node',
            'quantity' => 'Quantity',
            'price' => 'Price',
            'subtotal' => 'Subtotal',
            'created' => 'Created',
        );
    }

}