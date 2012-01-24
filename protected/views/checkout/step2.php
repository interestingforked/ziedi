<?php $this->pageTitle = Yii::app()->name . ' - ' . Yii::t('app', 'Kam un no kā piegādāt'); ?>

<script type="text/javascript">
$(document).ready(function () {
    $('#goBack').click(function () {
        location.href='/<?php echo Yii::app()->language.CHtml::normalizeUrl('/checkout/step1'); ?>';
    });
    $('#step2-form').submit(function () {
        var accepted = $('#rules').prop('checked');
        if ( ! accepted) {
            alert('<?php echo Yii::t('app', 'Вы должны подвердить, что вы согласны с условиями!'); ?>');
            return false;
        }
        return true;
    });
});
</script>

<div class="border">
    <div style="background-color:#cdea99; padding:10px;">
        <div class="steps">
            <ul class="order-steps">
                <li>1</li><li>2</li><li>3</li><li class="current">4. <?php echo Yii::t('app', 'Pasūtījuma cena'); ?></li>
            </ul>
        </div>
        <?php echo CHtml::beginForm('', 'post', array('id' => 'step2-form')); ?>
        <div class="over-ordering">
            <table class="ordering">
                <?php foreach ($cartItems as $item): ?>
                <tr>
                    <td class="first"><?php echo $item['product']->content->title; ?></td>
                    <td><?php echo $item['item']['quantity']; ?> x <?php echo number_format($item['item']['price'] / $this->currencyValue,2,'.','').' '.Yii::app()->params['currencies'][$this->currency]; ?></td>
                </tr>
                <?php endforeach; ?>
                <tr>
                    <td class="first"><?php echo Yii::t('app', 'Piegādes cena'); ?></td>
                    <td><?php echo number_format($order->shipping / $this->currencyValue,2,'.','').' '.Yii::app()->params['currencies'][$this->currency]; ?></td>
                </tr>
                <tr>
                    <td class="first"><?php echo Yii::t('app', 'Pilna summa apmaksai'); ?></td>
                    <td><?php echo number_format(($order->total + $order->shipping + $order->additional) / $this->currencyValue,2,'.','').' '.Yii::app()->params['currencies'][$this->currency]; ?></td>
                </tr>
                <tr>
                    <td class="first"><?php echo Yii::t('app', 'Apmaksas veids'); ?></td>
                    <td><?php echo CHtml::dropDownList('payment_method', $order->payment_method, $checkoutData->paymentMethod) ?></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="checkbox" name="rules" id="rules" value="1" />&nbsp;<label for="rules"><?php echo Yii::t('app', 'Ar <a href="">piegādes noteikumiem</a> esmu iepazinies un tiem piekritu'); ?></label></td>
                </tr>
            </table>
        </div>
        <div style="margin-top:10px; padding-right:10px;margin-left:150px;">
            <div style="padding-top:8px;"><input type="button" id="goBack" value="<?php echo Yii::t('app', 'Atgriezties'); ?>" name="" style="width: 90px; height: 28px; border: 1px solid #307714; cursor: pointer; text-align: center; padding: 4px 4px 7px 4px; background-color: #ece9be; color: #000000;">
                &nbsp;<input type="submit" value="<?php echo Yii::t('app', 'Nosūtīt pasūtījumu'); ?>" name="" style=" height: 28px; border: 1px solid #307714;font-weight:bold; cursor: pointer; text-align: center; padding: 4px 4px 7px 4px; background-color: #ece9be; color: #000000;"></div>
        </div>
        <?php echo CHtml::endForm(); ?>
    </div><br>
        
</div>