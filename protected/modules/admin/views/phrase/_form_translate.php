<?php 
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'product-form',
    'enableAjaxValidation' => false,
));
echo $form->errorSummary(array($model, $contentModel)); 
?>
<p>
    <?php echo $form->labelEx($model, 'category_id'); ?>
    <span class="note error"><?php echo $form->error($model, 'category_id'); ?></span><br/>
    <select name="Phrase[category_id]" id="Phrase_category_id" class="styled big" disabled="disabled">
        <?php 
        $rendered = new Renderer();
        $rendered->renderRecursive($categories['items'], $model->category_id, Renderer::RENDER_OPTION_LIST);
        ?>
    </select>
</p>
<p>
    <?php echo $form->labelEx($contentModel, 'title'); ?><br/>
    <?php echo $form->textField($contentModel,'title', array('class' => 'text medium')); ?>
    <span class="note error"><?php echo $form->error($contentModel, 'title'); ?></span>
</p>
<p>
    <?php echo $form->labelEx($contentModel, 'language'); ?><br/>
    <?php echo $form->dropDownList($contentModel,'language', $this->languages, array('class' => 'styled small', 'disabled' => 'disabled')); ?>
</p>
<p>
    <?php echo $form->checkBox($model, 'active', array('class' => 'checkbox', 'disabled' => 'disabled')); ?>
    <?php echo $form->labelEx($model, 'active'); ?>
    <span class="note error"><?php echo $form->error($model, 'active'); ?></span>
</p>
<hr/>
<p>
    <?php echo $form->labelEx($contentModel, 'body'); ?><br/>
    <?php echo $form->textArea($contentModel,'body', array('class' => 'wysiwyg')); ?>
</p>
<hr/>
<p>
    <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('id' => 'submit', 'class' => 'submit small')); ?>
</p>
<?php $this->endWidget(); ?>