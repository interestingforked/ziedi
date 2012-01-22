<?php $this->pageTitle = Yii::app()->name . ' - ' . Yii::t('app', 'Piegādes laiks un adrese'); ?>

<script type="text/javascript">
$(document).ready(function () {
    $('#goBack').click(function () {
        location.href='<?php echo CHtml::normalizeUrl('/cart'); ?>';
    });
});
</script>

<div class="border">
    <div style="background-color:#cdea99; padding:10px;">
        <div class="steps">
            <ul class="order-steps">
                <li>1</li><li class="current">2. <?php echo Yii::t('app', 'Piegādes laiks un adrese'); ?></li><li>3</li><li>4</li>
            </ul>
        </div>
        <?php echo CHtml::beginForm(); ?>
        <div class="over-ordering">
            <table class="ordering">
                <tr>
                    <td class="first"><?php echo Yii::t('app', 'Piegādes datums'); ?></td>
                    <td><?php echo CHtml::dropDownList('shipping_date_day', $data->shipping_date_day, $checkoutData->shippingDateDay) ?>
                        <?php echo CHtml::dropDownList('shipping_date_month', $data->shipping_date_month, $checkoutData->shippingDateMonth) ?>
                        <?php echo CHtml::dropDownList('shipping_date_year', $data->shipping_date_year, $checkoutData->shippingDateYear) ?>
                    </td> 
                </tr>
                <tr style="display:none;">
                    <td></td><td><span id="shipping_date_error" style="color: red; font-weight: bold;"><?php echo Yii::t('app', 'Šīs datums ir pagatnē'); ?></span></td>
                </tr>
                <tr>
                    <td class="first"><?php echo Yii::t('app', 'Piegādes laiks'); ?></td>
                    <td><?php echo CHtml::dropDownList('shipping_time', $data->shipping_time, $checkoutData->shippingTime) ?></td>
                </tr>
                <tr style="display:none;" id="shippingExactTime">
                    <td class="first"><?php echo Yii::t('app', 'Precīzs diapazons'); ?></td>
                    <td>
                        <span><?php echo Yii::t('app', 'no'); ?>:</span>
                        <span><?php echo CHtml::dropDownList('exact_interval_from_h', $data->exact_interval_from_h, $checkoutData->exactIntervalFromHours) ?></span>
                        <span><?php echo CHtml::dropDownList('exact_interval_from_m', $data->exact_interval_from_m, $checkoutData->exactIntervalFromMinutes) ?></span>
                        <span><?php echo Yii::t('app', 'līdz'); ?>:</span>
                        <span><?php echo CHtml::dropDownList('exact_interval_till_h', $data->exact_interval_till_h, $checkoutData->exactIntervalTillHours) ?></span>
                        <span><?php echo CHtml::dropDownList('exact_interval_till_m', $data->exact_interval_till_m, $checkoutData->exactIntervalTillMinutes) ?></span>
                    </td>
                </tr>
                <tr>
                    <td class="first"><?php echo Yii::t('app', 'Pilsēta'); ?></td>
                    <td><?php echo CHtml::dropDownList('shipping_city', $data->shipping_city, $checkoutData->shippingCity) ?></td>
                </tr>
                <tr>
                    <td class="first"><?php echo Yii::t('app', 'Piegādes cena'); ?></td>
                    <td>
                        <strong>
                            <span id="thePrice"><?php echo number_format($price / $this->currencyValue,2,'.',''); ?></span>
                            <?php echo Yii::app()->params['currencies'][$this->currency]; ?>
                        </strong>
                        <input type="hidden" name="price" id="price" value="<?php echo number_format($price / $this->currencyValue,2,'.',''); ?>">
                        <input type="hidden" name="shippingPrice" id="shippingPrice" value="<?php echo $order->shipping; ?>">
                    </td>
                </tr>
                <tr>
                    <td class="first"><?php echo Yii::t('app', 'Piegādes adrese'); ?></td>
                    <td><?php echo CHtml::dropDownList('shipping_place_type', $data->shipping_place_type, $checkoutData->shippingPlaceType) ?></td>
                </tr>
                <tr>
                    <td class="first"><?php echo Yii::t('app', 'Precīza adrese'); ?></td>
                    <td><textarea class="form-textarea" name="full_address" cols="30" rows="3"><?php echo $data->full_address; ?></textarea>
                        <p style="font-size:85%;padding-top:3px;"><?php echo Yii::t('app', 'Norādiet precīzo adresi, firmas nosaukumu, darba laiku, koda atslēgu'); ?>...</p>
                    </td>
                </tr>
                <tr>
                    <td class="first" style="text-align:right;"><?php echo number_format(3 / $this->currencyValue,2,'.',''); ?> <?php echo Yii::app()->params['currencies'][$this->currency]; ?> <span><?php echo CHtml::checkBox('clarify_everything', $data->clarify_everything, array('class' => 'form-checkbox')) ?></span></td>
                    <td><?php echo Yii::t('app', 'Mēs paši noskaidrosim ielu, mājas vai dzīvokļa numuru, firmas nosaukumu vai koda atslēgu.'); ?></td>
                </tr>
                <tr>
                    <td class="first" style="text-align:right;"><?php echo CHtml::checkBox('clarify_address_fr', $data->clarify_address_fr, array('class' => 'form-checkbox')) ?></td>
                    <td><?php echo Yii::t('app', 'Mēs noskaidrosim adresi, sazinoties ar saņēmēju (šinī gadījumā piegādes laiku nosaka saņēmējs)'); ?></td>
                </tr>
            </table>
        </div>
        <div style="margin-top:10px; padding-right:10px;margin-left:150px;">
            <div style="padding-top:8px;"><input type="button" id="goBack" value="<?php echo Yii::t('app', 'Atgriezties'); ?>" name="" style="width: 90px; height: 28px; border: 1px solid #307714; cursor: pointer; text-align: center; padding: 4px 4px 7px 4px; background-color: #ece9be; color: #000000;">
                &nbsp;<input type="submit" value="<?php echo Yii::t('app', 'Turpināt'); ?>" name="" style="width: 90px; height: 28px; border: 1px solid #307714;font-weight:bold; cursor: pointer; text-align: center; padding: 4px 4px 7px 4px; background-color: #ece9be; color: #000000;"></div>
        </div>
        <?php echo CHtml::endForm(); ?>
    </div><br>
</div>