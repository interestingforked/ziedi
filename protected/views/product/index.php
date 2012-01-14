<?php $this->pageTitle = Html::formatTitle($product->content->title, $product->content->meta_title) . ' - ' . $this->pageTitle; ?>
<script type="text/javascript">
$(document).ready(function () {
    $('input[name=productNodeId]:first').attr('checked', true);
    
    var firstGiftUrl = $('.gift-select a:first').attr('href');
    $.get(firstGiftUrl, function (data) {
        $('.list').html(data);
    });
    
    $('.gift-select a').click(function () {
        var url = $(this).attr('href');
        $.get(url, function (data) {
            $('.list').html(data);
        });
        return false;
    });
    
    $('.list .img a').live('click', function () {
        $.fancybox({
            'transitionIn' : 'elastic',
            'transitionOut' : 'elastic',
            'href' : this.href,
            'width' : 640,
            'height' : 480,
            'ajax' : {
                type : "GET"
            }
        });
        return false;
    });
    
    $('.images img').each(function (index) {
        if (index > 0) $(this).css('display', 'none');
    });
    
    $('.thumb img').hover(function () {
        var imageID = $(this).attr('id');
        $('.images img').css('display', 'none');
        $('#' + imageID.replace('thumb', 'big')).css('display', 'inline');
    });
    
    $('a[rel="image-group"]').fancybox({
        'titleShow' : false,
        'transitionIn' : 'elastic',
        'transitionOut' : 'elastic',
        'cyclic':true
    });
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
                    echo CHtml::image(Image::thumb(Yii::app()->params['images'] . $image->image, 300), $product->content->title, array('id' => 'product-image-big-'.$image->id));
                }
                ?>
                </div>
                <div class="thumb">
                    <?php 
                    foreach ($attachetImages AS $image) {
                        $imageLink = Yii::app()->params['images'] . $image->image;
                        echo CHtml::link(CHtml::image(Image::thumb($imageLink, 66), $product->content->title, array('id' => 'product-image-thumb-'.$image->id)), $imageLink, array('rel' => 'image-group'));
                    }
                    ?>
                </div>
            </td>
            <td class="right">
                <?php 
                echo CHtml::beginForm(array('/cart'));
                echo CHtml::hiddenField('action', 'addItem');
                echo CHtml::hiddenField('productId', $product->id);
                ?>
                <div class="prod-title"><h1><?php echo $product->content->title; ?></h1></div>
                <div class="prod-desc"><?php echo $product->content->body; ?></div>
                <div class="prod-price"><?php echo number_format($product->mainNode->price,2,'.','').Yii::app()->params['currencies'][$this->currency]; ?></div>
                <ul class="prod-size">
                    <?php foreach ($product->productNodes AS $node): ?>
                    <li><input id="<?php echo $node->id; ?>" type="radio" name="productNodeId" value="<?php echo $node->id; ?>">&nbsp;<label for="<?php echo $node->id; ?>"><?php echo $node->size; ?></label></li>
                    <?php endforeach; ?>
                </ul>
                <input class="prod-order" type="submit" name="" value="<?php echo Yii::t('app', 'Buy'); ?>">
                <div class="note">
                    <p><?php echo Yii::t('app', 'Вы можете добавить подарок в корзину, выбрав его ниже на этой странице, либо далее в процессе заказа.'); ?></p>
                    <p><?php echo Yii::t('app', 'Предлагаем бесплатную услугу фотографмм доставки. Выберите ее в процессе заказа.'); ?></p>
                </div>
                <?php echo CHtml::endForm(); ?>
            </td>
        </tr>
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
                    <div class="list"></div>
                </div>
            </td>
        </tr>
    </table>
</div>