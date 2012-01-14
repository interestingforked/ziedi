<?php
$this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Login");
$this->breadcrumbs=array(
	UserModule::t("Login"),
);
?>

<h1><?php echo UserModule::t("Login"); ?></h1>
<div class="hr-title"><hr></div>

<?php if(Yii::app()->user->hasFlash('loginMessage')): ?>
<div class="success">
    <?php echo Yii::app()->user->getFlash('loginMessage'); ?>
</div>
<?php endif; ?>
<?php if(Yii::app()->user->hasFlash('recoveryMessage')): ?>
<div class="success">
    <?php echo Yii::app()->user->getFlash('recoveryMessage'); ?>
</div>
<?php endif; ?>

<div id="login-form">
<?php echo CHtml::beginForm(); ?>
    <?php echo CHtml::errorSummary($model); ?>
    <dt><?php echo CHtml::activeLabelEx($model,'username'); ?></dt>
    <dd><?php echo CHtml::activeTextField($model,'username',array('class'=>'field')) ?></dd>
    <dt><?php echo CHtml::activeLabelEx($model,'password'); ?></dt>
    <dd><?php echo CHtml::activePasswordField($model,'password',array('class'=>'field')) ?></dd>
<div><br>
<?php echo CHtml::submitButton(UserModule::t("Login"), array('class' => 'button')); ?>
</div>
<?php echo CHtml::endForm(); ?>
</div><!-- form -->


<?php
$form = new CForm(array(
    'elements'=>array(
        'username'=>array(
            'type'=>'text',
            'maxlength'=>32,
        ),
        'password'=>array(
            'type'=>'password',
            'maxlength'=>32,
        ),
        'rememberMe'=>array(
            'type'=>'checkbox',
        )
    ),
    'buttons'=>array(
        'login'=>array(
            'type'=>'submit',
            'label'=>'Login',
        ),
    ),
), $model);
?>