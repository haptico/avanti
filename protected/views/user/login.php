<?php
$this->pageTitle = Yii::app()->name . ' - ' . Yii::t("user", "Login");
$this->breadcrumbs = array(
    Yii::t("user", "Login"),
);
?>
<?php echo CHtml::beginForm('', 'POST', array('class' => 'form-signin')); ?>

<h2 class="form-signin-heading"><?php echo Yii::t("user", "Login"); ?></h2>

<?php if (Yii::app()->user->hasFlash('loginMessage')): ?>

    <div class="success">
        <?php echo Yii::app()->user->getFlash('loginMessage'); ?>
    </div>

<?php endif; ?>

<?php echo CHtml::errorSummary($model); ?>

<?php echo CHtml::activeLabelEx($model, 'username', array('class' => 'sr-only')); ?>
<?php echo CHtml::activeTextField($model, 'username', array('class' => 'form-control', 'placeholder' => 'Login ou Email address')) ?>

<?php echo CHtml::activeLabelEx($model, 'password', array('class' => 'sr-only')); ?>
<?php echo CHtml::activePasswordField($model, 'password', array('class' => 'form-control', 'placeholder' => 'Password')) ?>

<div class="checkbox">
    <label>
        <?php echo CHtml::activeCheckBox($model, 'rememberMe'); ?>
        <?php echo CHtml::activeLabelEx($model, 'rememberMe'); ?>
    </label>
</div>

<?php echo CHtml::submitButton(Yii::t("user", "Login"), array('class' => 'btn btn-lg btn-primary')); ?>

    <?php // echo CHtml::link(Yii::t("user", "Register"), $this->registrationUrl); ?> &nbsp;&nbsp;<?php echo CHtml::link(Yii::t("user", "Lost Password?"), $this->recoveryUrl); ?>

<?php
echo CHtml::endForm();

$form = new CForm(array(
    'elements' => array(
        'username' => array(
            'type' => 'text',
            'maxlength' => 32,
        ),
        'password' => array(
            'type' => 'password',
            'maxlength' => 32,
        ),
        'rememberMe' => array(
            'type' => 'checkbox',
        )
    ),
    'buttons' => array(
        'login' => array(
            'type' => 'submit',
            'label' => 'Login',
        ),
    ),
        ), $model);
?>