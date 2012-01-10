<?php

/**
 * @property string $id
 * @property string $order_id
 * @property string $type
 * @property string $country_id
 * @property string $region_id
 * @property string $district_id
 * @property string $name
 * @property string $surname
 * @property string $phone
 * @property string $email
 * @property string $house
 * @property string $street
 * @property string $city
 * @property string $district
 * @property string $postcode
 * @property string $created
 * @property Countrie $country
 * @property District $district0
 * @property Order $order
 * @property Region $region
 */
class OrderDetail extends CActiveRecord {

    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'order_details';
    }

    public function rules() {
        return array(
            array('order_id, type', 'required'),
            array('order_id, country_id, region_id, district_id', 'length', 'max' => 11),
            array('type, postcode', 'length', 'max' => 10),
            array('name, surname, house, flat', 'length', 'max' => 30),
            array('phone', 'length', 'max' => 20),
            array('email', 'length', 'max' => 128),
            array('street', 'length', 'max' => 60),
            array('city', 'length', 'max' => 50),
            array('district', 'length', 'max' => 100),
            array('created', 'safe'),
            array('id, order_id, type, country_id, region_id, district_id, name, surname, phone, email, house, flat, street, city, district, postcode, created', 'safe', 'on' => 'search'),
        );
    }

    public function relations() {
        return array(
            'country' => array(self::BELONGS_TO, 'Country', 'country_id'),
            'district' => array(self::BELONGS_TO, 'District', 'district_id'),
            'order' => array(self::BELONGS_TO, 'Order', 'order_id'),
            'region' => array(self::BELONGS_TO, 'Region', 'region_id'),
        );
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'order_id' => 'Order',
            'type' => 'Type',
            'country_id' => 'Country',
            'region_id' => 'Region',
            'district_id' => 'District',
            'name' => 'Name',
            'surname' => 'Surname',
            'phone' => 'Phone',
            'email' => 'Email',
            'house' => 'House',
            'flat' => 'Flat',
            'street' => 'Street',
            'city' => 'City',
            'district' => 'District',
            'postcode' => 'Postcode',
            'created' => 'Created',
        );
    }
    
    public function getOrderPaymentData($orderId) {
        return $this->findByAttributes(array(
            'order_id' => $orderId,
            'type' => 'payment'
        ));
    }
    
    public function getOrderShipingData($orderId) {
        return $this->findByAttributes(array(
            'order_id' => $orderId,
            'type' => 'shipping'
        ));
    }

}