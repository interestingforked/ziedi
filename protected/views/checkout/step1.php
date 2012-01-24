<?php $this->pageTitle = Yii::app()->name . ' - ' . Yii::t('app', 'Kam un no kā piegādāt'); ?>

<script type="text/javascript">
$(document).ready(function () {
    $('#goBack').click(function () {
        location.href='/<?php echo Yii::app()->language.CHtml::normalizeUrl('/checkout'); ?>';
    });
    $('#step1-form').submit(function () {
        var accept = true;
        $('input').each(function (index) {
            if ($(this).val() == '') {
                accept = false;
                return false;
            }
        });
        if ( ! accept) {
            alert('<?php echo Yii::t('app', 'Заполните все необходимые поля!'); ?>');
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
                <li>1</li><li>2</li><li class="current">3. <?php echo Yii::t('app', 'Kam un no kā piegādāt'); ?></li><li>4</li>
            </ul>
        </div>
        <?php echo CHtml::beginForm('', 'post', array('id' => 'step1-form')); ?>
        <div class="over-ordering">
            <table class="ordering">
                <tr><td colspan="2"><p style="font-weight:bold;"><?php echo Yii::t('app', 'Informācija par adresātu'); ?></p></td></tr>
                <tr>
                    <td class="first"><?php echo Yii::t('app', 'Vārds'); ?></td>
                    <td><?php echo CHtml::textField('a_name', $data->a_name, array('class' => 'form-text', 'size' => 20)); ?></td>
                </tr>
                <tr>
                    <td class="first"><?php echo Yii::t('app', 'Uzvārds'); ?></td>
                    <td><?php echo CHtml::textField('a_surname', $data->a_surname, array('class' => 'form-text', 'size' => 20)); ?></td>
                </tr>
                <tr>
                    <td class="first"><?php echo Yii::t('app', 'Tālrunis'); ?></td>
                    <td><?php echo CHtml::textField('a_phone', $data->a_phone, array('class' => 'form-text', 'size' => 20)); ?></td>
                </tr>
                <tr class="next">
                    <td colspan="2" align="right"></td>
                </tr>
            </table>
            <table class="ordering">
                <tr><td colspan="2"><p style="font-weight:bold;">Informācija par sūtītāju</p></td></tr>
                <tr>
                    <td class="first"><?php echo Yii::t('app', 'Jūsu vārds'); ?></td>
                    <td><?php echo CHtml::textField('b_name', $data->b_name, array('class' => 'form-text', 'size' => 20)); ?></td>
                </tr>
                <tr>
                    <td class="first"><?php echo Yii::t('app', 'Jūsu uzvārds'); ?></td>
                    <td><?php echo CHtml::textField('b_surname', $data->b_surname, array('class' => 'form-text', 'size' => 20)); ?></td>
                </tr>
                <tr>
                    <td class="first"><?php echo Yii::t('app', 'Jūsu tālrunis'); ?></td>
                    <td><?php echo CHtml::textField('b_phone', $data->b_phone, array('class' => 'form-text', 'size' => 20)); ?></td>
                </tr>
                <tr>
                    <td class="first"><?php echo Yii::t('app', 'Jūsu e-pasts'); ?></td>
                    <td><?php echo CHtml::textField('b_email', $data->b_email, array('class' => 'form-text', 'size' => 20)); ?></td>
                </tr>
            </table>
        </div>
        <div style="margin-top:10px; padding-right:10px;margin-left:150px;">
            <div style="padding-top:8px;"><input type="button" id="goBack" value="<?php echo Yii::t('app', 'Atgriezties'); ?>" name="" style="width: 90px; height: 28px; border: 1px solid #307714; cursor: pointer; text-align: center; padding: 4px 4px 7px 4px; background-color: #ece9be; color: #000000;">
                &nbsp;<input type="submit" value="<?php echo Yii::t('app', 'Turpināt'); ?>" name="" style="width: 90px; height: 28px; border: 1px solid #307714;font-weight:bold; cursor: pointer; text-align: center; padding: 4px 4px 7px 4px; background-color: #ece9be; color: #000000;"></div>
        </div>
        <?php echo CHtml::endForm(); ?>
    </div><br>

</div>