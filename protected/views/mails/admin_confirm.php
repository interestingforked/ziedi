<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    </head>
    <body>
        <table align="center" cellpadding="0" cellspacing="0">
            <tbody>
                <tr>
                    <td style="background-color: rgb(255, 255, 255);" valign="top">
                        <table align="center" border="0" cellpadding="0" cellspacing="0" width="550">
                            <tbody>
                                <tr>
                                    <td bgcolor="#ffffff" height="78"><a target="_blank" target="_blank" shape="rect" href="http://www.aizietziedi.lv"><img alt="Aizietziedi" src="http://www.aizietziedi.lv/images/mail/aizietziedi_logo1.gif" border="0" height="29" width="215"><br><img alt="" src="http://www.aizietziedi.lv/images/mail/spacer.gif" height="8" width="10"><br><img alt="Aizietziedi" src="http://www.aizietziedi.lv/images/mail/aizietziedi_logo2.gif" border="0" height="39" width="195"></a></td>
                                </tr>
                                <tr>
                                    <td style="background-color: rgb(255, 255, 255);" height="10"><img alt="" src="http://www.aizietziedi.lv/images/mail/spacer.gif" height="28" width="550"></td>
                                </tr>
                                <tr>
                                    <td style="background-color: rgb(255, 255, 255);" align="center">
                                        <table style="border-width: 1px; border-style: solid; border-color: rgb(225, 225, 225);" align="center" cellpadding="9" cellspacing="0" width="550">
                                            <tbody>
                                                <tr>
                                                    <td style="background-color: rgb(255, 255, 255);">
                                                        <h2 style="margin-top: 20px; font: 15px/15px arial,sans-serif;">Уважаемый администратор заказов Aizietziedi.lv!</h2>
                                                        <p style="font-family: arial,sans-serif; font-size: 14px;">Поступил новый заказ с сайта. Ниже смотри информацию о заказе..</p>
                                                        <h3 style="padding-bottom: 6px; margin-top: 10px; padding-left: 2px; padding-right: 2px; font: 16px/16px arial,sans-serif; margin-bottom: 10px; background: #f1f1f1; padding-top: 6px;"><strong>Данные заказа</strong></h3>
                                                        <p style="font-family: arial,sans-serif; font-size: 14px;"><strong>Код заказа:</strong> <strong><?php echo $order->key; ?></strong></p>
                                                        <p style="font-family: arial,sans-serif; font-size: 14px;"><strong>Вид платежа:</strong> <strong><?php echo $checkoutData->paymentMethod[$order->payment_method]; ?></strong></p>
                                                        <p style="font-family: arial,sans-serif; font-size: 14px;"><strong>Email:</strong> <?php echo $data->b_email; ?></p>
                                                        <br>
                                                        <table style="margin-bottom: 20px;" cellpadding="0" cellspacing="0" width="497">
                                                            <tbody>
                                                                <tr>
                                                                    <td width="248">
                                                                        <p style="font-family: arial,sans-serif; font-size: 14px;">
                                                                            <strong>Отправитель:</strong><br>
                                                                            <?php echo $data->b_name.' '.$data->b_surname; ?><br>
                                                                            <?php echo $data->b_phone; ?><br/>
                                                                            <?php echo $data->b_email; ?><br/>
                                                                        </p>
                                                                    </td>
                                                                    <td width="249" valign="top">
                                                                        <p style="font-family: arial,sans-serif; font-size: 14px;">
                                                                            <strong>Адресат</strong>:<br>
                                                                            <?php echo $data->b_name.' '.$data->b_surname; ?><br>
                                                                            <?php echo $data->b_phone; ?><br/>
                                                                            <?php echo $data->full_address; ?></p>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <p style="font-family: arial,sans-serif; font-size: 14px;"><strong>Сумма заказа:</strong> <?php echo number_format(($order->total + $order->shipping + $order->addtional) / $this->currencyValue,2,'.','').' '.Yii::app()->params['currencies'][$order->currency]; ?>. (включая доставку)</p>
                                                        <h3 style="padding-bottom: 6px; margin-top: 10px; padding-left: 2px; padding-right: 2px; font: 16px/16px arial,sans-serif; margin-bottom: 10px; background: #f1f1f1; padding-top: 6px;"><strong><strong>Информация о заказе</strong>:</strong></h3>
                                                        <p style="font-family: arial,sans-serif; font-size: 14px;"><strong>Дата заказа:</strong> <?php echo $order->created; ?></p>
                                                        <p style="font-family: arial,sans-serif; font-size: 14px;"><strong>Дата доставки:</strong> <?php echo $data->shipping_date_day.'.'.$data->shipping_date_month.'.'.$data->shipping_date_year; ?> (<?php echo $checkoutData->shippingTime[$data->shipping_time]; ?>)</p>
                                                        <?php if ($data->shipping_time == 5): ?>
                                                        <p style="font-family: arial,sans-serif; font-size: 14px;"><strong>Точный диапазон времени:</strong> <?php echo $data->exact_interval_from_h.':'.$data->exact_interval_from_m; ?> - <?php echo $data->exact_interval_till_h.':'.$data->exact_interval_till_h; ?></p>
                                                        <?php endif; ?>
                                                        <span style="font-family: arial,sans-serif; font-size: 14px;">
                                                            <table style="margin-top: 20px; margin-bottom: 20px;" cellpadding="0" cellspacing="0" width="497">
                                                                <tbody>
                                                                    <?php 
                                                                    $i = 0;
                                                                    foreach ($items AS $item): 
                                                                    $i++;
                                                                    $product = Product::model()->findByPk($item['product_id']);
                                                                    $productNode = $product->getProduct($item['product_node_id']);   
                                                                    ?>
                                                                    <tr>
                                                                        <td width="90">
                                                                            <?php
                                                                            $attachedImage = Attachment::model()->getAttachment('product', $item['product_id']);
                                                                            if ($attachedImage):
                                                                                echo CHtml::image(Yii::app()->getBaseUrl(true).Image::thumb(Yii::app()->params['images'].$attachedImage->image, 63));
                                                                            endif;
                                                                            ?>
                                                                        </td>
                                                                        <td><p><?php echo $i; ?> <strong><?php echo $productNode->content->title; ?></strong> <?php echo number_format($productNode->mainNode->price / $this->currencyValue,2,'.','').' '.Yii::app()->params['currencies'][$order->currency]; ?></p></td>
                                                                        <td><p>Размер: <?php echo $productNode->mainNode->size; ?></p></td>
                                                                    </tr>
                                                                    <?php endforeach; ?>
                                                                </tbody>
                                                            </table>
                                                        </span>
                                                    </td>
                                                </tr>
                                                <tr><td></td></tr>
                                                <tr>
                                                    <td>
                                                        <p style="font-family: arial,sans-serif; font-size: 14px;">Мы надеемся что Вы будете полностью удовлетворены нашими услугами.<br>
                                                        </p>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="background-color: rgb(255, 255, 255);" height="28"><img alt="" src="http://www.aizietziedi.lv/images/mail/spacer.gif" height="28" width="550"></td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
    </body>
</html>