<?php $this->pageTitle = Yii::app()->name . ' - ' . Yii::t('app', 'Cart'); ?>
<div class="border">
    <div style="background-color:#cdea99; padding:10px;">
        <div class="steps">
            <ul class="order-steps">
                <li class="current">1. <?php echo Yii::t('app', 'Groza pārskats'); ?></li><li>2</li><li>3</li><li>4</li>
            </ul>
        </div>
        <div class="over-ordering">
            <table class="sh-cart">
                <?php foreach ($items AS $item): ?>
                <tr>
                    <td width="110">
                        <?php
                        $attachetImage = Attachment::model()->getAttachment('product', $item['product']->id);
                        echo CHtml::image(Image::thumb(Yii::app()->params['images'] . $attachetImage->image, 90), $item['product']->content->title);
                        ?>
                    </td>
                    <td class="name">
                        <span class="title"><?php echo $item['product']->content->title; ?></span>
                        <span><?php echo Yii::t('app', 'Price'); ?>: <?php echo number_format($item['product']->mainNode->price,2,'.','').Yii::app()->params['currencies'][$this->currency]; ?></span></td>
                    <td width="60">
                        <input class="dig" type="text" name="quantity" value="<?php echo $item['item']['quantity']; ?>" />
                    </td>
                    <?php 
                    $subtotal = $item['product']->mainNode->price * $item['item']['quantity'];
                    ?>
                    <td><?php echo number_format($subtotal,2,'.','').Yii::app()->params['currencies'][$this->currency]; ?></td>
                    <td  align="right">
                        <?php 
                        echo CHtml::beginForm(array('/cart'));
                        echo CHtml::hiddenField('action', 'removeItem');
                        echo CHtml::hiddenField('productId', $item['item']['product_id']);
                        echo CHtml::hiddenField('productNodeId', $item['item']['product_node_id']);
                        echo CHtml::submitButton(Yii::t('app', 'Dzēst'), array(
                            'style' => 'border: none; cursor: pointer; background: none; color: #254E2D; font-size:100%',
                            'onmouseout' => "this.style.color='#254E2D'",
                            'onmouseover' => "this.style.color='#A61925'",
                        ));
                        echo CHtml::endForm(); 
                        ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
            <div class="options"><input type="checkbox" />&nbsp; Piegādāt anonīmi</div>
            <div class="options"><input type="checkbox" />&nbsp; Bezmaksas piegādes foto</div>
        </div>
        <div style="text-align:right; margin-top:10px; padding-right:10px;">
            <div><b style="font-weight:bold;font-size:85%;">Kopsumma bez piegādes: 88.00 Ls</b></div>
            <div style="padding-top:8px;"><input type="submit" title="pārrēķināt" value="Pārrēķināt" name="" style="width: 90px; height: 28px; border: 1px solid #307714; cursor: pointer; text-align: center; padding: 4px 4px 7px 4px; background-color: #ece9be; color: #000000;">
                &nbsp;<input type="submit" title="Pasūtīt" value="Pāsūtīt" name="" style="width: 90px; height: 28px; border: 1px solid #307714;font-weight:bold; cursor: pointer; text-align: center; padding: 4px 4px 7px 4px; background-color: #ece9be; color: #000000;"></div>
        </div>
    </div><br>
    <table class="gifts">
        <tr>
            <td colspan="5">
                <div class="gift-wrap">
                    <div>Приложить <strong>Открытку</strong></div>
                    <div class="selection">
                        <ul class="gift-select">
                            <li class="current">Любимой</li>
                            <li><a href="#">Маме</a></li>
                        </ul>
                    </div>
                    <div class="list">
                        <div class="one"><div class="img"><img src="img/fl1.jpg" width="80" height="80" /></div><span>2.00Ls</span><span><a href="">Pasūtīt</a></span></div>
                        <div class="one"><div class="img"><img src="img/kart.jpg" width="80" height="47" /></div><span>2.00Ls</span><span><a href="">Pasūtīt</a></span></div>
                        <div class="one"><div class="img"><img src="img/kart1.jpg" width="70" height="80" /></div><span>2.00Ls</span><span><a href="">Pasūtīt</a></span></div>
                        <div class="one"><div class="img"><img src="img/fl1.jpg" width="70" height="70" /></div><span>2.00Ls</span><span><a href="">Pasūtīt</a></span></div>
                        <div class="one"><div class="img"><img src="img/fl1.jpg" width="70" height="70" /></div><span>2.00Ls</span><span><a href="">Pasūtīt</a></span></div>
                        <div class="one"><div class="img"><img src="img/fl1.jpg" width="70" height="70" /></div><span>2.00Ls</span><span><a href="">Pasūtīt</a></span></div>
                        <div class="one"><div class="img"><img src="img/fl1.jpg" width="70" height="70" /></div><span>2.00Ls</span><span><a href="">Pasūtīt</a></span></div>
                        <div class="one"><div class="img"><img src="img/fl1.jpg" width="70" height="70" /></div><span>2.00Ls</span><span><a href="">Pasūtīt</a></span></div>
                        <div class="one"><div class="img"><img src="img/fl1.jpg" width="70" height="70" /></div><span>2.00Ls</span><span><a href="">Pasūtīt</a></span></div>
                        <div class="one"><div class="img"><img src="img/fl1.jpg" width="70" height="70" /></div><span>2.00Ls</span><span><a href="">Pasūtīt</a></span></div>
                        <div class="one"><div class="img"><img src="img/fl1.jpg" width="70" height="70" /></div><span>2.00Ls</span><span><a href="">Pasūtīt</a></span></div>
                    </div>
                </div>

                <div class="gift-wrap">
                    <div>Не знаете, что написать?</div>
                    <div class="selection">
                        <ul class="gift-select">
                            <li class="current">Любимой</li>
                            <li><a href="">Другу</a></li>
                            <li><a href="">Подруге</a></li>
                            <li><a href="">Маме</a></li>
                        </ul>
                    </div>
                    <div class="add-card">
                        <table class="card-text">
                            <tr>
                                <td>Поздравление в стихах:</td>
                                <td>Ваш текст в открытке:</td>
                            </tr>
                            <tr>
                                <td><textarea rows="5" cols="30" name=""></textarea></td>
                                <td><textarea rows="5" cols="30" name=""></textarea></td>
                            </tr>
                            <tr>
                                <td><ul class="poetry"><li>1</li><li><a href="">2</a></li><li><a href="">3</a></li><li><a href="">4</a></li></ul></td>
                                <td>Подпись в открытке:</td>
                            </tr>
                            <tr>
                                <td><input type="submit" title="Разместить в открытке" value="Разместить в открытке" name="" style="border: 1px solid #307714;font-weight:bold; cursor: pointer; text-align: center;font-size:95%; padding: 2px 4px 2px 4px; background-color:#ааа; color: #000000;"></td>
                                <td><input type="text" style="width:250px;"></input></td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="gift-wrap">
                    <div>Приложить <strong>подарок</strong></div>
                    <div class="selection">
                        <ul class="gift-select">
                            <li class="current">Игрушки</li>
                            <li><a href="">Шарфы</a></li>
                            <li><a href="">Украшения</a></li>
                            <li><a href="">Конфеты</a></li>
                        </ul>
                    </div>
                    <div class="list">
                        <div class="one"><div class="img"><img src="img/fl1.jpg" width="80" height="80" /></div><span>2.00Ls</span><span><a href="">Pasūtīt</a></span></div>
                        <div class="one"><div class="img"><img src="img/kart.jpg" width="80" height="47" /></div><span>2.00Ls</span><span><a href="">Pasūtīt</a></span></div>
                        <div class="one"><div class="img"><img src="img/kart1.jpg" width="70" height="80" /></div><span>2.00Ls</span><span><a href="">Pasūtīt</a></span></div>
                        <div class="one"><div class="img"><img src="img/fl1.jpg" width="70" height="70" /></div><span>2.00Ls</span><span><a href="">Pasūtīt</a></span></div>
                        <div class="one"><div class="img"><img src="img/fl1.jpg" width="70" height="70" /></div><span>2.00Ls</span><span><a href="">Pasūtīt</a></span></div>
                        <div class="one"><div class="img"><img src="img/fl1.jpg" width="70" height="70" /></div><span>2.00Ls</span><span><a href="">Pasūtīt</a></span></div>
                        <div class="one"><div class="img"><img src="img/fl1.jpg" width="70" height="70" /></div><span>2.00Ls</span><span><a href="">Pasūtīt</a></span></div>
                        <div class="one"><div class="img"><img src="img/fl1.jpg" width="70" height="70" /></div><span>2.00Ls</span><span><a href="">Pasūtīt</a></span></div>
                        <div class="one"><div class="img"><img src="img/fl1.jpg" width="70" height="70" /></div><span>2.00Ls</span><span><a href="">Pasūtīt</a></span></div>
                        <div class="one"><div class="img"><img src="img/fl1.jpg" width="70" height="70" /></div><span>2.00Ls</span><span><a href="">Pasūtīt</a></span></div>
                        <div class="one"><div class="img"><img src="img/fl1.jpg" width="70" height="70" /></div><span>2.00Ls</span><span><a href="">Pasūtīt</a></span></div>
                    </div>
                </div>
            </td>
        </tr>
    </table>
</div>