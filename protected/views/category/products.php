<h1><?php echo $category->content->title; ?></h1>
<div class="hr"></div>
<table class="flowers">
<?php 
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
        $image = CHtml::image(Image::thumb(Yii::app()->params['images'].$attachetImage->image, $this->settings['CATEGORY_PRODUCT_IMAGE_SIZE']), $product->content->title);
    } else {
        $image = CHtml::image(Image::thumb('/images/fl1.jpg', $this->settings['CATEGORY_PRODUCT_IMAGE_SIZE']), $product->content->title);
    }
?>
        <td class="border">
            <div><?php echo $image; ?></div>
            <div class="fl-title"><?php echo CHtml::link($product->content->title, $link, array('title' => $product->content->title)); ?></div>
            <div class="price"><?php echo number_format($product->mainNode->price / $this->currencyValue,2,'.','').Yii::app()->params['currencies'][$this->currency]; ?></div>
        </td>
<?php if ($j == 0): ?>
        <td style="width:15px;">&nbsp;</td>
<?php endif; ?>        
<?php if ($c % 2 == 0): ?>
    </tr>
    <tr><td colspan="3" style="height:15px;"></td></tr>
    <tr>
<?php endif;
if ($c == $limit) break;
$j++;
endforeach;
if ($c < 2): ?>
        <td style="width:15px;">&nbsp;</td>
        <td></td>
<?php endif; ?>
</table>