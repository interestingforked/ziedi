<div class="block">
    <div class="block_head">
        <div class="bheadl"></div>
        <div class="bheadr"></div>
        <h2>Phrases</h2>
        <ul class="tabs">
            <li><a href="/admin/phrase/add">Add phrase</a></li>
        </ul>
    </div>
    <div class="block_content">
        <?php if (!$products OR count($products) == 0): ?>
        <div class="message info"><p>No phrases found!</p></div>
        <?php else: ?>
        <table cellpadding="0" cellspacing="0" width="100%" class="sortable">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Status</th>
                    <th>language</th>
                    <th>Date created</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
            <?php 
            foreach ($products AS $product):
                $product->content = Content::model()->getModuleContent('phrase', $product->id, 'lv');
                if (!$product->content) {
                    $product->content = Content::model()->getModuleContent('phrase', $product->id, 'ru');
                }
            ?>
                <tr>
                    <td><?php echo CHtml::link($product->content->title, array('/admin/phrase/edit/'.$product->id)); ?></td>
                    <td><?php echo ($product->active ? 'Active' : 'Disabled'); ?></td>
                    <td><?php echo Yii::app()->params['languages'][$product->content->language]; ?></td>
                    <td><?php echo $product->created; ?></td>
                    <td class="delete">
                        <?php echo CHtml::link('Edit', array('/admin/phrase/edit/'.$product->id)); ?>
                        <?php echo CHtml::link('Delete', array('/admin/phrase/delete/'.$product->id), array('class' => 'delete')); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <div id="pager" class="pagination right">
            <form>
                <a class="first" href="#">&laquo;&laquo;</a>
                <a class="prev previous" href="#">&laquo;</a>
                <input type="text" class="pagedisplay"/>
                <a class="next" href="#">&raquo;</a>
                <a class="last" href="#">&raquo;&raquo;</a>
                <select class="pagesize">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                    <option value="200">200</option>
                </select>
            </form>
        </div>
        <?php endif; ?> 
    </div>
    <div class="bendl"></div>
    <div class="bendr"></div>
</div>