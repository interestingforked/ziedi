<?php

class CheckoutController extends Controller {

    public function actionIndex() {
        $messages = null;
        
        $checkoutData = new CheckoutData(); 
 
        $session = new CHttpSession();
        $session->open();
        
        $cart = $this->cart->getCart();

        $order = Order::model()->getBySessionId($session->getSessionID());
        if ( ! $order) {
            $order = new Order();
            $orderId = 0;
        } else {
            $orderId = $order->id;
        }
        $orderDetail = OrderDetail::model()->getDetails($orderId);
        if (!$orderDetail) {
            $orderDetail = new OrderDetail();
            $orderDetail->isNewRecord = true;
            $orderDetail->id = null;
            
            $orderDetail->shipping_date_day = date('d');
            $orderDetail->shipping_date_month = date('n');
            $orderDetail->shipping_date_year = date('Y');
            
            $nowHour = (int)date('G');
            if ($nowHour > 0 AND $nowHour < 8) {
                $orderDetail->shipping_time = 1;
            } else if ($nowHour > 0 AND $nowHour < 8) {
                $orderDetail->shipping_time = 2;
            } else if ($nowHour > 14 AND $nowHour < 18) {
                $orderDetail->shipping_time = 3;
            } else {
                $orderDetail->shipping_time = 4;
            }

        }

        if ($_POST) {
            $request = Yii::app()->getRequest();
            
            if (!$order->session_id) {
                $order->session_id = $session->getSessionID();
                $order->status = 1;
                $order->ip = Yii::app()->request->getUserHostAddress();
                $order->save();
            }
            
            $order->quantity = $cart['total_count'];
            $order->total = $cart['total_price'];
            $order->shipping = $request->getParam('shippingPrice');
            $order->save();
            
            $orderDetail->order_id = $order->id;
            $orderDetail->shipping_date_day = $request->getParam('shipping_date_day');
            $orderDetail->shipping_date_month = $request->getParam('shipping_date_month');
            $orderDetail->shipping_date_year = $request->getParam('shipping_date_year');
            $orderDetail->shipping_time = $request->getParam('shipping_time');
            $orderDetail->exact_interval_from_h = $request->getParam('exact_interval_from_h');
            $orderDetail->exact_interval_from_m = $request->getParam('exact_interval_from_m');
            $orderDetail->exact_interval_till_h = $request->getParam('exact_interval_till_h');
            $orderDetail->exact_interval_till_m = $request->getParam('exact_interval_till_m');
            $orderDetail->shipping_city = $request->getParam('shipping_city');
            $orderDetail->shipping_place_type = $request->getParam('shipping_place_type');
            $orderDetail->full_address = $request->getParam('full_address');
            $orderDetail->clarify_everything = $request->getParam('clarify_everything', 0);
            $orderDetail->clarify_address_fr = $request->getParam('clarify_address_fr', 0);
            
            $additionalSum = 0;
            if ($orderDetail->clarify_everything) {
                $additionalSum += 3;
            }
            if ($orderDetail->shipping_time == 5) {
                $additionalSum += 7;
            }
            $order->additional = $additionalSum;
            $order->save();
            
            if ($orderDetail->save()) {
                Yii::app()->controller->redirect(array('/checkout/step1'));
            } else {
                $messages = $orderDetail->getErrors();
            }
        }
        $this->breadcrumbs[] = Yii::t('app', 'Checkout');
        $this->render('index', array(
            'messages' => $messages,
            'data' => $orderDetail,
            'checkoutData' => $checkoutData,
            'price' => $cart['total_price'],
            'order' => $order,
        ));
    }

    public function actionStep1() {
        $messages = null;
        
        $session = new CHttpSession();
        $session->open();
        
        $order = Order::model()->getBySessionId($session->getSessionID());
        if (!$order) {
            Yii::app()->controller->redirect(array('/cart'));
        }
        $orderDetail = OrderDetail::model()->getDetails($order->id);

        if ($_POST) {
            $request = Yii::app()->getRequest();

            $orderDetail->a_name = $request->getParam('a_name');
            $orderDetail->a_surname = $request->getParam('a_surname');
            $orderDetail->a_phone = $request->getParam('a_phone');
            $orderDetail->b_name = $request->getParam('b_name');
            $orderDetail->b_surname = $request->getParam('b_surname');
            $orderDetail->b_phone = $request->getParam('b_phone');
            $orderDetail->b_email = $request->getParam('b_email');
            
            if ($orderDetail->save()) {
                Yii::app()->controller->redirect(array('/checkout/step2'));
            } else {
                $messages = $orderDetail->getErrors();
            }
        }
        $this->breadcrumbs[] = Yii::t('app', 'Checkout');
        $this->render('step1', array(
            'messages' => $messages,
            'data' => $orderDetail,
            'order' => $order,
        ));
    }

    public function actionStep2() {
        $messages = null;
        
        $checkoutData = new CheckoutData(); 

        $session = new CHttpSession();
        $session->open();
        
        $order = Order::model()->getBySessionId($session->getSessionID());
        if (!$order) {
            Yii::app()->controller->redirect(array('/cart'));
        }
        $orderDetail = OrderDetail::model()->getDetails($order->id);
        
        $cart = $this->cart->getList();
        $cartItems = array();
        foreach ($this->cart->getItems() AS $cartItem) {
            $product = Product::model()->findByPk($cartItem['product_id']);
            if (!$product) {
                continue;
            }
            $productNode = $product->getProduct($cartItem['product_node_id']);
            if ($productNode->mainNode->sale) {
                $saleSum += $productNode->mainNode->price;
            }
            $cartItems[] = array(
                'item' => $cartItem,
                'product' => $productNode
            );
        }

        if ($_POST) {
            $request = Yii::app()->getRequest();
            
            $order->payment_method = $request->getParam('payment_method');
            $order->currency = $this->currency;
            $order->key = Order::model()->getMaxNumber(date('ym'));
            if ($order->save()) {
                
                $orderItem = new OrderItem();
                foreach ($this->cart->getItems() AS $item) {
                    $orderItem->isNewRecord = true;
                    $orderItem->id = null;
                    $orderItem->order_id = $order->id;
                    $orderItem->product_id = $item['product_id'];
                    $orderItem->product_node_id = $item['product_node_id'];
                    $orderItem->quantity = $item['quantity'];
                    $orderItem->price = $item['price'];
                    $orderItem->subtotal = $item['subtotal'];
                    $orderItem->save();
                }
                $this->cart->close();
                
                Yii::app()->controller->redirect(array('/checkout/confirm'));
            } else {
                $messages = $order->getErrors();
            }

        }
        $this->breadcrumbs[] = Yii::t('app', 'Checkout');
        $this->render('step2', array(
            'messages' => $messages,
            'data' => $orderDetail,
            'order' => $order,
            'checkoutData' => $checkoutData,
            'cartItems' => $cartItems,
        ));
    }
    
    public function actionConfirm() {
        $session = new CHttpSession();
        $session->open();
        
        $order = Order::model()->getBySessionId($session->getSessionID());
        if (!$order) {
            Yii::app()->controller->redirect(array('/cart'));
        }
        $orderDetail = OrderDetail::model()->getDetails($order->id);

        if ($order->sent != 1) {
            
            $checkoutData = new CheckoutData();
            
            $items = $order->items;
            $subject = Yii::app()->name.' - Подтверждение заказа';
            $adminEmail = Yii::app()->params['adminEmail'];
            $headers = "MIME-Version: 1.0\r\nFrom: {$adminEmail}\r\nReply-To: {$adminEmail}\r\nContent-Type: text/html; charset=utf-8";
            $adminMail = $this->renderPartial('//mails/admin_confirm', array(
                'order' => $order, 
                'items' => $items, 
                'data' => $orderDetail,
                'checkoutData' => $checkoutData,
                ), true);
            
            $mail = $this->renderPartial('//mails/confirm', array(
                'order' => $order, 
                'items' => $items, 
                'data' => $orderDetail,
                'checkoutData' => $checkoutData,
                ), true);
            
            $email = $orderDetail->b_email;
            
            if (mail($email, '=?UTF-8?B?' . base64_encode($subject) . '?=', $mail, $headers, "-f {$adminEmail}")
                    AND mail($adminEmail, '=?UTF-8?B?' . base64_encode($subject) . '?=', $adminMail, $headers, "-f {$adminEmail}")) {
                $order->sent = 1;
                $order->status = 3;
                $order->save();
                $order->processQuantity(); 
            }
        }
        $this->breadcrumbs[] = Yii::t('app', 'Checkout');
        $this->render('confirm', array(
            'key' => $order->key,
        ));
    }

}