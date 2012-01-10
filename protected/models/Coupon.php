<?php

/**
 * @property string $id
 * @property integer $percentage
 * @property integer $once
 * @property string $code
 * @property string $value
 * @property string $issue_date
 * @property string $term_date
 * @property string $created
 * @property string $used
 * @property Cart[] $carts
 */
class Coupon extends CActiveRecord {

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'coupons';
    }

    public function rules() {
        return array(
            array('percentage, once, free_delivery, max_count, not_for_sale, only_rbk', 'numerical', 'integerOnly' => true),
            array('code, value', 'length', 'max' => 30),
            array('issue_date, term_date, created, used', 'safe'),
            array('id, percentage, once, free_delivery, max_count, not_for_sale, only_rbk, code, value, issue_date, term_date, created, used', 'safe', 'on' => 'search'),
        );
    }

    public function relations() {
        return array(
            'carts' => array(self::HAS_MANY, 'Cart', 'coupon_id'),
            'orders' => array(self::HAS_MANY, 'Order', 'coupon_id'),
        );
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'percentage' => 'Percentage',
            'once' => 'Use once',
            'max_count' => 'Max use count',
            'free_delivery' => 'Free delivery',
            'not_for_sale' => 'Not for sale',
            'only_rbk' => 'Only RBK',
            'code' => 'Code',
            'value' => 'Value',
            'issue_date' => 'Issue Date',
            'term_date' => 'Term Date',
            'created' => 'Created',
            'used' => 'Used',
        );
    }

    public function getActiveCoupon($couponId) {
        return $this->findBySql(
                "SELECT * FROM coupons WHERE id = :coupon_id " .
                "AND issue_date <= CURRENT_DATE " .
                "AND (term_date IS NULL OR term_date >= CURRENT_DATE) " .
                "AND (once != 1 OR (once = 1 AND used IS NULL))", array(
            ':coupon_id' => $couponId,
        ));
    }

    public function checkCode($couponCode) {
        return $this->findBySql(
                "SELECT * FROM coupons WHERE code = :coupon_code " .
                "AND issue_date <= CURRENT_DATE " .
                "AND (term_date IS NULL OR term_date >= CURRENT_DATE) " .
                "AND (once != 1 OR (once = 1 AND used IS NULL))", array(
            ':coupon_code' => $couponCode,
        ));
    }

}