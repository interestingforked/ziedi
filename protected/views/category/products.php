<!--<h1><?php echo $category->content->title; ?></h1>
<div class="hr"></div>-->
<table class="flowers">
<?php 
$productCount = count($products);
$columns = 3;
$rows = ceil($productCount / $columns);
$c = 0;
for ($i = 0; $i < $rows; $i++) {
    echo '<tr>';
    for ($j = 0; $j < $columns; $j++) {
        if (!isset($products[$c])) {
            echo '<td style="width:0px;">&nbsp;</td><td></td>';
            break;
        }
        $product = $products[$c];
        $link = CHtml::normalizeUrl(array('/'.$category->slug.'/'.$product->slug.'-'.$product->id));
        $attachetImage = Attachment::model()->getAttachment('product', $product->id);
        if ($attachetImage) {
            $image = CHtml::image(Image::thumb(Yii::app()->params['images'].$attachetImage->image, $this->settings['CATEGORY_PRODUCT_IMAGE_WIDTH'], $this->settings['CATEGORY_PRODUCT_IMAGE_HEIGHT']), $product->content->title);
        } else {
            $image = CHtml::image(Image::thumb('/images/fl1.jpg', $this->settings['CATEGORY_PRODUCT_IMAGE_WIDTH'], $this->settings['CATEGORY_PRODUCT_IMAGE_HEIGHT']), $product->content->title);
        }
        ?>
        <td class="cell">
	   <div class="cell-border">
            <div class="cat-img"><?php echo CHtml::link($image, $link); ?></div>
            <div class="fl-title"><?php echo CHtml::link($product->content->title, $link, array('title' => $product->content->title)); ?></div>
            <div class="price">
                <div class="left"><?php echo number_format($product->mainNode->price / $this->currencyValue,2,'.','').Yii::app()->params['currencies'][$this->currency]; ?></div>
                <?php 
                $formId = 'order_form_'.$product->id.'_'.$product->mainNode->id;
                echo CHtml::beginForm(array('/cart'), 'post', array('id' => $formId));
                echo CHtml::hiddenField('action', 'addItem');
                echo CHtml::hiddenField('productId', $product->id);
                echo CHtml::hiddenField('productNodeId', $product->mainNode->id);
                echo CHtml::hiddenField('price', $product->mainNode->price);
                ?>
                <div class="right"><a href="#" class="addToCartButton" rel="<?php echo $formId; ?>"><?php echo Yii::t('app', 'В корзину'); ?></a></div>
                <?php echo CHtml::endForm(); ?>
            </div>
	  </div>
        </td>
        <?php
        if ($j < 2) {
            echo '<td style="width:0px;"></td>';
        }
        $c++;
    }
    echo '</tr>';
    echo '<tr><td colspan="3" style="height:5px;padding:0;"></td></tr>';
}
?>
</table>