<?php $this->pageTitle = Html::formatTitle($product->content->title, $product->content->meta_title) . ' - ' . $this->pageTitle; ?>
<script type="text/javascript">
$(document).ready(function () {
    $('#orderForm input[name=productNodeId]:first').click().attr('checked', true);
});
</script>
<div class="border">
    <table class="flowers">
        <tr>
            <td class="left">
                <div class="images">
                <?php
                $attachetImages = Attachment::model()->getAttachments('product', $product->id);
                foreach ($attachetImages AS $image) {
                    echo CHtml::image(Image::thumb(Yii::app()->params['images'] . $image->image, 
                            $this->settings['PRODUCT_INFO_IMAGE_WIDTH'], $this->settings['PRODUCT_INFO_IMAGE_HEIGHT']), 
                            $product->content->title, array('id' => 'product-image-big-'.$image->id));
                }
                ?>
                </div>
                <div class="thumb">
                    <?php 
                    foreach ($attachetImages AS $image) {
                        $imageLink = Yii::app()->params['images'] . $image->image;
                        echo CHtml::link(CHtml::image(Image::thumb($imageLink, 
                                $this->settings['PRODUCT_INFO_THUMB_WIDTH'], $this->settings['PRODUCT_INFO_THUMB_HEIGHT']), 
                                $product->content->title, array('id' => 'product-image-thumb-'.$image->id)), $imageLink, array('rel' => 'image-group'));
                    }
                    ?>
                </div>
            </td>
            <td class="right">
                <?php 
                echo CHtml::beginForm('', 'post', array('id' => 'tmpForm'));
                echo CHtml::hiddenField('action', '');
                echo CHtml::hiddenField('productId', '');
                echo CHtml::hiddenField('productNodeId', '');
                echo CHtml::hiddenField('productType', '');
                echo CHtml::hiddenField('price', '');
                echo CHtml::endForm();
                
                echo CHtml::beginForm(array('/cart'), 'post', array('id' => 'orderForm'));
                echo CHtml::hiddenField('action', 'addItem');
                echo CHtml::hiddenField('productId', $product->id);
                echo CHtml::hiddenField('price', $product->mainNode->price);
                ?>
                <div class="prod-title"><h1><?php echo $product->content->title; ?><span><?php echo $product->code; ?></span></h1></div>
                <div class="prod-desc"><?php echo $product->content->body; ?></div>
                <div class="prod-price"><?php echo number_format($product->mainNode->price / $this->currencyValue,2,'.','').Yii::app()->params['currencies'][$this->currency]; ?></div>
                <?php if (count($product->productNodes) == 1 AND !$product->productNodes[0]->size): ?>
                <input id="<?php echo $product->productNodes[0]->id; ?>" type="hidden" name="productNodeId" value="<?php echo $product->productNodes[0]->id; ?>">
                <?php else: ?>
                <ul class="prod-size">
                    <?php foreach ($product->productNodes AS $node): ?>
                    <li><input id="<?php echo $node->id; ?>" type="radio" name="productNodeId" value="<?php echo $node->id; ?>">&nbsp;<label for="<?php echo $node->id; ?>"><?php echo Yii::t('vars', $node->size).' ('.$node->precise_size.')'; ?></label></li>
                    <?php endforeach; ?>
                </ul>
                <?php endif; ?>
                <input class="prod-order" type="submit" name="" value="<?php echo Yii::t('app', 'Buy'); ?>">
                <div class="note">
                    <p><?php echo Yii::t('app', 'Вы можете добавить подарок в корзину, выбрав его ниже на этой странице, либо далее в процессе заказа.'); ?></p>
                    <p><?php echo Yii::t('app', 'Предлагаем бесплатную услугу фотографмм доставки. Выберите ее в процессе заказа.'); ?></p>
                </div>
                <?php echo CHtml::endForm(); ?>
            </td>
        </tr>
        <?php if ($showGift): ?>
        <tr>
            <td colspan="2">
                <div class="hr"></div>
                <p><?php echo Yii::t('app', 'Вы можете добавить <strong>подарок</strong> к цветам'); ?>:</p>
                <div class="gift-wrap">
                    <div class="selection">
                        <?php
                        $this->widget('zii.widgets.CMenu', array(
                            'items' => $gifts['items'],
                            'activeCssClass' => 'current',
                            'activateParents' => true,
                            'htmlOptions' => array(
                                'class' => 'gift-select',
                            )
                        ));
                        ?>
                    </div>
                    <div class="list gift-list"></div>
                </div>
            </td>
        </tr>
        <?php endif; ?>
    </table>
</div>