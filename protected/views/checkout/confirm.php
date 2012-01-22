<?php
$this->pageTitle = Yii::app()->name . ' - ' . Yii::t('app', 'Order confirmed');
?>

<div class="border">
    <div style="background-color:#cdea99; padding:10px;">
        <div class="steps">
            <ul class="order-steps">
                <li>1</li><li>2</li><li>3</li><li>4</li>
            </ul>
        </div>
        <div class="over-ordering">
            <table class="ordering">
                <tr>
                    <td>
                        <p><?php echo Yii::t('app', 'Ваш заказ принят и в ближайшее время будет обработан нашими сотрудниками.'); ?></p>
                        <p><?php echo Yii::t('app', 'Номер вашего заказа'); ?>: <?php echo $key; ?>.
                        <?php echo Yii::t('app', 'Сохраните его для получения дальнейшей информации.'); ?>
                        </p>
                    </td>
                </tr>
            </table>
        </div>
    </div><br>
        
</div>