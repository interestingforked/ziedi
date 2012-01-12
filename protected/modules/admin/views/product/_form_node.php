<?php 
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'product-node-form',
    'enableAjaxValidation' => false,
));
echo $form->errorSummary($model); 
?>
<p>
    <?php echo $form->labelEx($model, 'sort'); ?><br/>
    <?php echo $form->textField($model,'sort', array('class' => 'text tiny')); ?>
    <span class="note error"><?php echo $form->error($model, 'sort'); ?></span>
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
    <?php echo $form->checkBox($model, 'active', array('class' => 'checkbox')); ?>
    <?php echo $form->labelEx($model, 'active'); ?>
    <span class="note error"><?php echo $form->error($model, 'active'); ?></span>
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
    <?php echo $form->checkBox($model, 'new', array('class' => 'checkbox')); ?>
    <?php echo $form->labelEx($model, 'new'); ?>
    <span class="note error"><?php echo $form->error($model, 'new'); ?></span>
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
    <?php echo $form->checkBox($model, 'sale', array('class' => 'checkbox')); ?>
    <?php echo $form->labelEx($model, 'sale'); ?>
    <span class="note error"><?php echo $form->error($model, 'sale'); ?></span>
</p>
<p>
    <?php echo $form->labelEx($model, 'price'); ?><br/>
    <?php echo $form->textField($model,'price', array('class' => 'text tiny')); ?>
</p>
<p>
    <?php echo $form->labelEx($model, 'old_price'); ?><br/>
    <?php echo $form->textField($model,'old_price', array('class' => 'text tiny')); ?>
    <span class="note error"><?php echo $form->error($model, 'old_price'); ?></span>
</p>
<p>
    <?php echo $form->labelEx($model, 'quantity'); ?><br/>
    <?php echo $form->textField($model,'quantity', array('class' => 'text tiny')); ?>
    <span class="note error"><?php echo $form->error($model, 'quantity'); ?></span>
</p>
<p>
    <?php echo $form->labelEx($model, 'size'); ?><br/>
    <?php echo $form->textField($model,'size', array('class' => 'text')); ?>
    <span class="note error"><?php echo $form->error($model, 'size'); ?></span>
</p>
<hr/>
<p>
    <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('id' => 'submit', 'class' => 'submit small')); ?>
</p>
<?php $this->endWidget(); ?>