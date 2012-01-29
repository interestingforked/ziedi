<div class="block withsidebar">
    <div class="block_head">
        <div class="bheadl"></div>
        <div class="bheadr"></div>
        <h2>Order nr: <?php echo $order->key; ?></h2>
        <ul class="tabs">
            <li><a href="/admin/order">Go to order list</a></li>
        </ul>
    </div>
    <div class="block_content">
        <div class="sidebar">
            <ul class="sidemenu">
                <li><a href="#sb1">Order info</a></li>
                <li><a href="#sb2">Order details</a></li>
                <li><a href="#sb3">Order items</a></li>
            </ul>
        </div>
        <div class="sidebar_content" id="sb1">
            <ul class="list">
                <li><strong>Number</strong>: <?php echo $order->key; ?></li>
                <li><strong>Session ID</strong>: <?php echo $order->session_id; ?></li>
                <li><strong>E-mail sent</strong>: <?php echo ($order->sent ? 'Yes' : 'No'); ?></li>
                <li><strong>Status</strong>: 
                <?php switch ($order->status) {
                    case 1: echo 'New order'; break;
                    case 2: echo 'Waiting for payment'; break;
                    case 3: echo 'Completed'; break;
                } ?></li>
                <li><strong>Payment method</strong>: <?php echo $checkoutData->paymentMethod[$order->payment_method] ?></li>
                <li><strong>Item quantity</strong>: <?php echo $order->quantity; ?></li>
                <li><strong>Total sum</strong>: <?php echo $order->total; ?></li>
                <li><strong>Shipping sum</strong>: <?php echo $order->shipping; ?></li>
                <li><strong>Additional sum</strong>: <?php echo $order->additional; ?></li>
                <li><strong>IP address</strong>: <?php echo $order->ip; ?></li>
            </ul>
        </div>
        <div class="sidebar_content" id="sb2">
            <div style="width:45%;float:left;">
            <h3>Customer details</h3>
            <ul class="list">
                <li><strong>Name</strong>: <?php echo $orderDetail->b_name; ?></li>
                <li><strong>Surname</strong>: <?php echo $orderDetail->b_surname; ?></li>
                <li><strong>Phone</strong>: <?php echo $orderDetail->b_phone; ?></li>
                <li><strong>E-mail</strong>: <?php echo $orderDetail->b_email; ?></li>
            </ul>
            </div>
            <div style="width:45%;float:left;">
            <h3>Addressee details</h3>
            <ul class="list">
                <li><strong>Name</strong>: <?php echo $orderDetail->a_name; ?></li>
                <li><strong>Surname</strong>: <?php echo $orderDetail->a_surname; ?></li>
                <li><strong>Phone</strong>: <?php echo $orderDetail->a_phone; ?></li>
            </ul>
            </div>
            <div style="clear:both;height:30px;"></div>
            <div style="width:45%;float:left;">
            <h3>Time of delivery</h3>
            <ul class="list">
                <li><strong>Shipping date</strong>: 
                    <?php echo $orderDetail->shipping_date_day.' '.$checkoutData->shippingDateMonth[$orderDetail->shipping_date_month].' '.$orderDetail->shipping_date_year; ?></li>
                <li><strong>Shipping time</strong>: <?php echo $checkoutData->shippingTime[$orderDetail->shipping_time]; ?></li>
                <?php if ($orderDetail->shipping_time == 5): ?>
                <li><strong>Exact shipping interval</strong>: 
                    <?php echo $orderDetail->exact_interval_from_h.':'.$orderDetail->exact_interval_from_m; ?> - 
                    <?php echo $orderDetail->exact_interval_till_h.':'.$orderDetail->exact_interval_till_m; ?>
                </li>
                <?php endif; ?>
                <li><strong>Shipping city</strong>: <?php echo $checkoutData->shippingCity[$orderDetail->shipping_city]; ?></li>
                <li><strong>Shipping place type</strong>: <?php echo $checkoutData->shippingPlaceType[$orderDetail->shipping_place_type]; ?></li>
                <li><strong>Full address</strong>: <?php echo $orderDetail->full_address; ?></li>
                <li><strong>Clarify everything</strong>: <?php echo ($orderDetail->clarify_everything ? 'Yes' : 'No'); ?></li>
                <li><strong>Clarify address fr</strong>: <?php echo ($orderDetail->clarify_address_fr ? 'Yes' : 'No'); ?></li>
            </ul>
            </div>
            <?php if ($orderDetail->phrase): ?>
            <div style="width:45%;float:left;">
            <h3>Phrase</h3>
            <ul class="list">
                <li><strong>Phrase ID</strong>: <?php echo $orderDetail->phrase_id; ?></li>
                <li><strong>Phrase</strong>: <?php echo $orderDetail->phrase; ?></li>
                <li><strong>Signature</strong>: <?php echo $orderDetail->phrase_sign; ?></li>
             </ul>
            </div>
            <?php endif; ?>
            <div style="clear:both;height:30px;"></div>
        </div>
        <div class="sidebar_content" id="sb3">
            <table cellpadding="0" cellspacing="0" width="100%" class="sortable">
                <thead>
                    <tr>
                        <th>&nbsp;</th>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Subtotal</th>
                        <th>Date created</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                foreach ($orderItems AS $item):
                    $product = $products['item_'.$item->id];
                    $attachedImage = Attachment::model()->getAttachment('product', $product->mainNode->id);
                    ?>
                    <tr>
                        <td><?php echo CHtml::image(Image::thumb(Yii::app()->params['images'].$attachedImage->image, 60));; ?></td>
                        <td><?php echo CHtml::link($product->content->title, array('/product/'.$product->slug.'-'.$product->id), array('target' => '_blank')); ?></td>
                        <td><?php echo $item->quantity; ?></td>
                        <td><?php echo $item->price; ?></td>
                        <td><?php echo $item->subtotal; ?></td>
                        <td><?php echo $item->created; ?></td>
                        <td class="delete">
                            <?php echo CHtml::link('View', array('/admin/product/edit/'.$item->product_id)); ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
       </div>
    </div>
    <div class="bendl"></div>
    <div class="bendr"></div>
</div>