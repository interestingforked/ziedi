<div class="block">
    <div class="block_head">
        <div class="bheadl"></div>
        <div class="bheadr"></div>
        <h2>Phrases / Add phrase</h2>
    </div>
    <div class="block_content">
        <?php 
        echo $this->renderPartial('_form', array(
            'errors' => $errors,
            'model' => $model,
            'contentModel' => $contentModel,
            'categories' => $categories,
        ));
        ?>
    </div>
    <div class="bendl"></div>
    <div class="bendr"></div>
</div>