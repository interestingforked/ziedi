<?php
$this->pageTitle = Html::formatTitle($page->content->title, $page->content->meta_title). ' - ' . $this->pageTitle;
?>
<div class="border">
<div class="padding">
<h1><?php echo Html::formatTitle($page->content->title, $page->content->meta_title); ?></h1>
<div class="hr"></div>
<div class="text"><?php echo $page->content->body; ?></div>
</div>
</div>