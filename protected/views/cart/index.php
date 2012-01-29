<?php $this->pageTitle = Yii::app()->name . ' - ' . Yii::t('app', 'Cart'); ?>
<script type="text/javascript">
$(document).ready(function () {
    $('#orderForm input[name=productNodeId]:first').click().attr('checked', true);
    $('.orderButton').click(function () {
        if (parseFloat($('#totalPrice').val()) < 15) {
            alert('<?php echo Yii::t('app', 'Jūsu pasūtījuma summa nedrīkst būt mazaka par 15 Ls!'); ?>');
            return false;
        }
        var serializedInputs = $('#phrase_id,#phrase,#phrase_sign').serialize();
        $.ajax({
            type: 'POST',
            url: '/<?php echo Yii::app()->language.CHtml::normalizeUrl('/checkout/phrase'); ?>',
            data: serializedInputs,
            success: function (responseData) {
                location.href='/<?php echo Yii::app()->language.CHtml::normalizeUrl('/checkout'); ?>';
            },
            dataType: 'json'
        });
    });
});
</script>
<div class="border">
    <div style="background-color:#cdea99; padding:10px;">
        <div class="steps">
            <ul class="order-steps">
                <li class="current">1. <?php echo Yii::t('app', 'Groza pārskats'); ?></li><li>2</li><li>3</li><li>4</li>
            </ul>
        </div>
        <div class="over-ordering">
            <?php if (!$items): ?>
            <div class="options"><?php echo Yii::t('app', 'Cart is empty'); ?></div>
            <?php else: ?>
            <?php 
            echo CHtml::beginForm('', 'post', array('id' => 'tmpForm'));
            echo CHtml::hiddenField('action', '');
            echo CHtml::hiddenField('productId', '');
            echo CHtml::hiddenField('productNodeId', '');
            echo CHtml::hiddenField('productType', '');
            echo CHtml::hiddenField('price', '');
            echo CHtml::endForm();
            
            echo CHtml::beginForm();
            echo CHtml::hiddenField('action', 'updateCart');
            ?>
            <table class="sh-cart">
                <?php 
                foreach ($items AS $item): 
                    $itemId = $item['item']['product_id'].'-'.$item['item']['product_node_id'];
                ?>
                <tr>
                    <td width="110">
                        <?php
                        $attachetImage = Attachment::model()->getAttachment('product', $item['product']->id);
                        echo CHtml::image(Image::thumb(Yii::app()->params['images'] . $attachetImage->image, 90), $item['product']->content->title);
                        ?>
                    </td>
                    <td class="name">
                        <input type="hidden" name="products[<?php echo $itemId; ?>][productId]" value="<?php echo $item['item']['product_id']; ?>">
                        <input type="hidden" name="products[<?php echo $itemId; ?>][productNodeId]" value="<?php echo $item['item']['product_node_id']; ?>">
                        <span class="title">
                            <?php echo CHtml::link($item['product']->content->title, array('/product/'.$item['product']->slug.'-'.$item['product']->id)); ?>
                        </span>
                        <span><?php echo Yii::t('app', 'Price'); ?>: <?php echo number_format($item['product']->mainNode->price / $this->currencyValue,2,'.','').Yii::app()->params['currencies'][$this->currency]; ?></span></td>
                    <td width="60">
                        <input class="dig" type="text" name="products[<?php echo $itemId; ?>][quantity]" value="<?php echo $item['item']['quantity']; ?>" />
                    </td>
                    <td><?php echo number_format($item['item']['subtotal'] / $this->currencyValue,2,'.','').Yii::app()->params['currencies'][$this->currency]; ?></td>
                    <td align="right">
                        <a href="#" class="deleteCartItem" rel="<?php echo $item['item']['product_id'].'__'.$item['item']['product_node_id']; ?>"><?php echo Yii::t('app', 'Dzēst'); ?></a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
            <div class="options"><?php echo CHtml::checkBox('anonymous_delivery', $options['anonymous_delivery']); ?>&nbsp; <?php echo Yii::t('app', 'Piegādāt anonīmi'); ?></div>
            <div class="options"><?php echo CHtml::checkBox('free_delivery_photo', $options['free_delivery_photo']); ?>&nbsp; <?php echo Yii::t('app', 'Bezmaksas piegādes foto'); ?></div>
            <?php endif; ?>
        </div>
        <div style="text-align:right; margin-top:10px; padding-right:10px;">
            <?php echo CHtml::hiddenField('totalPrice', number_format($total['price'] / $this->currencyValue,2,'.','')); ?>
            <div><b style="font-weight:bold;font-size:85%;"><?php echo Yii::t('app', 'Kopsumma bez piegādes'); ?>: <?php echo number_format($total['price'] / $this->currencyValue,2,'.','').Yii::app()->params['currencies'][$this->currency]; ?></b></div>
            <div style="padding-top:8px;">
                <input type="submit" title="Pārrēķināt" value="Pārrēķināt" name="" style="width: 90px; height: 28px; border: 1px solid #307714; cursor: pointer; text-align: center; padding: 4px 4px 7px 4px; background-color: #ece9be; color: #000000;">
                &nbsp;<input type="button" class="orderButton" title="Pasūtīt" value="Pāsūtīt" name="" style="width: 90px; height: 28px; border: 1px solid #307714;font-weight:bold; cursor: pointer; text-align: center; padding: 4px 4px 7px 4px; background-color: #ece9be; color: #000000;"></div>
        </div>
        
    </div><br>
    <table class="gifts">
        <tr>
            <td colspan="5">
                <div class="gift-wrap">
                    <div><?php echo Yii::t('app', 'Приложить <strong>Открытку</strong>'); ?></div>
                    <div class="selection">
                        <?php
                        $this->widget('zii.widgets.CMenu', array(
                            'items' => $postcards['items'],
                            'activeCssClass' => 'current',
                            'activateParents' => true,
                            'htmlOptions' => array(
                                'class' => 'gift-select',
                                'title' => 'postcardList'
                            )
                        ));
                        ?>
                    </div>
                    <div class="list" id="postcardList"></div>
                </div>
                <div class="gift-wrap">
                    <div><?php echo Yii::t('app', 'Не знаете, что написать?'); ?></div>
                    <div class="selection">
                        <?php
                        $this->widget('zii.widgets.CMenu', array(
                            'items' => $phrases['items'],
                            'activeCssClass' => 'current',
                            'activateParents' => true,
                            'htmlOptions' => array(
                                'class' => 'gift-select',
                                'title' => 'poetryList'
                            )
                        ));
                        ?>
                    </div>
                    <div class="add-card">
                        <table class="card-text">
                            <tr>
                                <td><?php echo Yii::t('app', 'Поздравление в стихах'); ?>:</td>
                                <td><?php echo Yii::t('app', 'Ваш текст в открытке'); ?>:</td>
                            </tr>
                            <tr>
                                <td>
                                    <?php echo CHtml::textArea('poetryVariant', null, array('rows' => 5, 'cols' => 30)); ?>
                                    <?php echo CHtml::hiddenField('poetryId', 0); ?>
                                </td>
                                <td>
                                    <?php echo CHtml::textArea('phrase', '', array('rows' => 5, 'cols' => 30)); ?>
                                    <?php echo CHtml::hiddenField('phrase_id', 0); ?>
                                </td>
                            </tr>
                            <tr>
                                <td><ul class="poetry" id="poetryList"></ul></td>
                                <td><?php echo Yii::t('app', 'Подпись в открытке'); ?>:</td>
                            </tr>
                            <tr>
                                <td><input type="button" id="submitPhrase" value="<?php echo Yii::t('app', 'Разместить в открытке'); ?>" name="" style="border: 1px solid #307714;font-weight:bold; cursor: pointer; text-align: center;font-size:95%; padding: 2px 4px 2px 4px; background-color:#ааа; color: #000000;"></td>
                                <td><?php echo CHtml::textField('phrase_sign', '', array('style' => 'wodth:250px;')); ?></td>
                            </tr>
                        </table>
                        <?php echo CHtml::endForm(); ?>
                    </div>
                </div>
                <div class="gift-wrap">
                    <div><?php echo Yii::t('app', 'Приложить <strong>подарок</strong>'); ?></div>
                    <div class="selection">
                        <?php
                        $this->widget('zii.widgets.CMenu', array(
                            'items' => $gifts['items'],
                            'activeCssClass' => 'current',
                            'activateParents' => true,
                            'htmlOptions' => array(
                                'class' => 'gift-select',
                                'title' => 'giftList'
                            )
                        ));
                        ?>
                    </div>
                    <div class="list" id="giftList"></div>
                </div>
            </td>
        </tr>
    </table>
</div>