<?php

/**
 * @property string $id
 * @property string $wishlist_id
 * @property string $product_id
 * @property string $product_node_id
 * @property integer $quantity
 * @property string $created
 */
class WishlistItem extends CActiveRecord {

    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'wishlist_items';
    }

    public function rules() {
        return array(
            array('wishlist_id, product_id, product_node_id', 'required'),
            array('quantity', 'numerical', 'integerOnly' => true),
            array('wishlist_id, product_id, product_node_id', 'length', 'max' => 11),
            array('id, wishlist_id, product_id, product_node_id, quantity, created', 'safe', 'on' => 'search'),
        );
    }

    public function relations() {
        return array(
            'productNode' => array(self::BELONGS_TO, 'ProductNode', 'product_node_id'),
            'product' => array(self::BELONGS_TO, 'Product', 'product_id'),
            'wishlist' => array(self::BELONGS_TO, 'Wishlist', 'wishlist_id'),
        );
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'wishlist_id' => 'Wishlist',
            'product_id' => 'Product',
            'product_node_id' => 'Product Node',
            'quantity' => 'Quantity',
            'created' => 'Created',
        );
    }
    
}