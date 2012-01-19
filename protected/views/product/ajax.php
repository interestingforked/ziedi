<script type="text/javascript">
$(document).ready(function () {
    $('input[name=productNodeId]:first').attr('checked', true);
});
</script>
<div class="border">
    <table class="flowers">
        <tr>
            <td class="left">
                <?php
                $attachetImage = Attachment::model()->getAttachment('product', $product->id);
                echo CHtml::image(Image::thumb(Yii::app()->params['images'] . $attachetImage->image, 200), $product->content->title);
                ?>
            </td>
        </tr>
        <tr>
            <td class="right" align="right">
                <?php 
                echo CHtml::beginForm(array('/cart'));
                echo CHtml::hiddenField('action', 'addItem');
                echo CHtml::hiddenField('productId', $product->id);
                echo CHtml::hiddenField('productNodeId', $product->mainNode->id);
                ?>
                <div class="prod-title"><h1><?php echo $product->content->title; ?></h1></div>
                <div class="prod-desc"><?php echo $product->content->body; ?></div>
                <div class="prod-price"><?php echo number_format($product->mainNode->price / $this->currencyValue,2,'.','').Yii::app()->params['currencies'][$this->currency]; ?></div>
                <?php echo CHtml::endForm(); ?>
            </td>
        </tr>
    </table>
</div>