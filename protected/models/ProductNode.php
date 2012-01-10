<?php

/**
 * @property string $id
 * @property string $product_id
 * @property integer $active
 * @property integer $new
 * @property integer $main
 * @property integer $sale
 * @property string $price
 * @property string $old_price
 * @property integer $quantity
 * @property integer $sort
 * @property string $color
 * @property string $size
 * @property string $created
 * @property Product $product
 */
class ProductNode extends CActiveRecord {

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'product_nodes';
    }

    public function rules() {
        return array(
            array('product_id, price', 'required'),
            array('active, main, new, sale, preorder, notify, quantity, sort, deleted, never_runs_out', 'numerical', 'integerOnly' => true),
            array('product_id', 'length', 'max' => 11),
            array('price, old_price', 'length', 'max' => 15),
            array('color, size', 'length', 'max' => 30),
            array('id, product_id, active, main, new, sale, preorder, notify, price, old_price, quantity, sort, color, size, never_runs_out, deleted, created', 'safe', 'on' => 'search'),
        );
    }

    public function relations() {
        return array(
            'product' => array(self::BELONGS_TO, 'Product', 'product_id'),
        );
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'product_id' => 'Product',
            'active' => 'Active',
            'main' => 'Main',
            'new' => 'New',
            'sale' => 'Sale',
            'preorder' => 'Preorder',
            'notify' => 'Notify',
            'price' => 'Price',
            'old_price' => 'Old Price',
            'quantity' => 'Quantity',
            'sort' => 'Sort',
            'color' => 'Color',
            'size' => 'Size',
            'never_runs_out' => 'Never runs out',
            'deleted' => 'Deleted',
            'created' => 'Created',
        );
    }

    public function defaultScope() {
        return array(
            'order' => 'sort ASC',
        );
    }
    
    public function scopes() {
        return array(
            'active' => array(
                'condition' => 'active = 1'
            ),
            'notDeleted' => array(
                'condition' => 'deleted = 0'
            ),
        );
    }

}