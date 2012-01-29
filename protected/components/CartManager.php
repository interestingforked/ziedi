<?php

class CartManager {

    protected $manager;

    public function __construct() {
        $this->manager = new CartHttpSession();
    }

    public function create() {
        return $this->manager->create();
    }
    
    public function getCart() {
        return $this->manager->getCart();
    }

    public function addItem($productId, $productNodeId, $price, $currency) {
        $price = $this->format_price($price);
        if (!$price)
            return false;
        $this->manager->addItem($productId, $productNodeId, $price, $currency);
    }

    public function removeItem($productId, $productNodeId) {
        $this->manager->removeItem($productId, $productNodeId);
    }

    public function changeQuantity($productId, $productNodeId, $quantity) {
        $this->manager->setQuantity($productId, $productNodeId, $quantity);
    }

    public function changeNode($productId, $productNodeId, $newProductNodeId, $price) {
        $price = $this->format_price($price);
        if (!$price)
            return false;
        $this->manager->changeNode($productId, $productNodeId, $newProductNodeId, $price);
    }

    public function getList() {
        return $this->manager->getList();
    }

    public function getItems() {
        return $this->manager->getItems();
    }

    public function delete() {
        $this->manager->delete();
    }

    public function close() {
        $this->manager->close();
    }

    public function count() {
        return $this->manager->count();
    }

    public function total() {
        return $this->manager->total();
    }

    public function getTotalCount() {
        return $this->manager->getTotalCount();
    }

    public function getTotalPrice() {
        return $this->manager->getTotalPrice();
    }

    public function setCoupon($couponId) {
        $this->manager->setCoupon($couponId);
    }

    public function getCoupon() {
        return ($this->manager->getCoupon()) ? $this->manager->getCoupon() : false;
    }
    
    public function setAnonymousDelivery($value) {
        $this->manager->setAnonymousDelivery($value);
    }
    
    public function setFreeDeliveryPhoto($value) {
        $this->manager->setFreeDeliveryPhoto($value);
    }
    
    public function getAnonymousDelivery() {
        return $this->manager->getAnonymousDelivery();
    }
    
    public function getFreeDeliveryPhoto() {
        return $this->manager->getFreeDeliveryPhoto();
    }
    
    public function setItemAsGift($productId, $productNodeId, $gift = true) {
        $this->manager->setItemAsGift($productId, $productNodeId, $gift);
    }
    
    public function setItemAsPostcard($productId, $productNodeId, $postcard = true) {
        $this->manager->setItemAsPostcard($productId, $productNodeId, $postcard);
    }
    
    public function getPhrase() {
        return $this->manager->getPhrase();
    }
    
    public function setPhrase($id, $phrase, $sign) {
        $this->manager->setPhrase($id, $phrase, $sign);
    }

    public function format_price($price) {
        $price = trim(preg_replace('/([^0-9\.])/i', '', $price));
        $price = trim(preg_replace('/(^[0]+)/i', '', $price));
        if (!is_numeric($price)) {
            return false;
        }
        return $price;
    }

    public function moveToDatabase() {
        if (!$this->manager instanceof CartHttpSession)
            return false;
        if ($this->count() == 0)
            return false;
        $cartDatabaseManager = new CartDatabase();
        $cart = $cartDatabaseManager->create();
        foreach ($this->getItems() AS $item) {
            $cartDatabaseManager->addItem($item['product_id'], $item['product_node_id'], $item['price']);
            if ($item['quantity'] > 1)
                $cartDatabaseManager->setQuantity($item['product_id'], $item['product_node_id'], $item['quantity']);
        }
        $this->manager->delete();
        $this->manager = new CartDatabase();
    }

}
