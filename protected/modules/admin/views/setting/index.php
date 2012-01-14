<div class="block">
    <div class="block_head">
        <div class="bheadl"></div>
        <div class="bheadr"></div>
        <h2>Settings</h2>
    </div>
    <div class="block_content">
        <?php if (!$settings OR count($settings) == 0): ?>
        <div class="message info"><p>No settings found!</p></div>
        <?php else:
        echo CHtml::beginForm(); ?>
        <table width="100%">
        <?php foreach ($settings AS $setting): ?>
            <tr>
                <td><?php echo CHtml::label($setting->key, $setting->key); ?></td>
                <td><?php echo CHtml::textField($setting->key, $setting->value, array('class' => 'text medium')); ?></td>
            </tr>
        <?php endforeach; ?>
        </table>
        <p>
            <?php echo CHtml::submitButton('Save', array('id' => 'submit', 'class' => 'submit small')); ?>
        </p>
        <?php 
        echo CHtml::endForm();
        endif; ?> 
    </div>
    <div class="bendl"></div>
    <div class="bendr"></div>
</div>