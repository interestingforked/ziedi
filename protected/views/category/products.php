<!--<h1><?php echo $category->content->title; ?></h1>
<div class="hr"></div>-->
<table class="flowers">
<?php 
$productCount = count($products);
$columns = 2;
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
           <div><?php echo $image; ?></div>
            <div class="fl-title"><?php echo CHtml::link($product->content->title, $link, array('title' => $product->content->title)); ?></div>
            <div class="price"><?php echo number_format($product->mainNode->price / $this->currencyValue,2,'.','').Yii::app()->params['currencies'][$this->currency]; ?></div>
	  </div>
        </td>
        <?php
        if ($j == 0) {
            echo '<td style="width:0px;"></td>';
        }
        $c++;
    }
    echo '</tr>';
    echo '<tr><td colspan="3" style="height:5px;padding:0;"></td></tr>';
}

/*

$i = 0;
$c = 0;
$j = 0;
foreach ($products as $product):
    $i++;
    if ($offset >= $i) {
        continue;
    }
    $c++;
    $link = CHtml::normalizeUrl(array('/'.$category->slug.'/'.$product->slug.'-'.$product->id));
    $attachetImage = Attachment::model()->getAttachment('product', $product->id);
    if ($attachetImage) {
        $image = CHtml::image(Image::thumb(Yii::app()->params['images'].$attachetImage->image, $this->settings['CATEGORY_PRODUCT_IMAGE_SIZE'], $this->settings['CATEGORY_PRODUCT_IMAGE_SIZE']), $product->content->title);
    } else {
        $image = CHtml::image(Image::thumb('/images/fl1.jpg', $this->settings['CATEGORY_PRODUCT_IMAGE_SIZE'], $this->settings['CATEGORY_PRODUCT_IMAGE_SIZE']), $product->content->title);
    }
?>
        <td class="cell">
	   <div class="cell-border">
           <div><?php echo $image; ?></div>
            <div class="fl-title"><?php echo CHtml::link($product->content->title, $link, array('title' => $product->content->title)); ?></div>
            <div class="price"><?php echo number_format($product->mainNode->price / $this->currencyValue,2,'.','').Yii::app()->params['currencies'][$this->currency]; ?></div>
	  </div>
        </td>
<?php if ($j == 0): ?>
        <td style="width:0px;"></td>
<?php endif;
$j++;
if ($c % 2 == 0): ?>
    </tr>
    <tr><td colspan="3" style="height:5px;padding:0;"></td></tr>
    <tr>
<?php 
$j= 0;
endif;
if ($c == $limit) break;
endforeach;
if ($c < 2): ?>
        <td style="width:0px;">&nbsp;</td>
        <td></td>
<?php endif; */ ?>
</table>