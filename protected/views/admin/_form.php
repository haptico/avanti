<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'user-form',
    'enableAjaxValidation' => true,
    'htmlOptions' => array('enctype' => 'multipart/form-data', 'class' => 'form-horizontal'),
        ));
?>

<p class="note"><?php echo Yii::t("user", 'Fields with <span class="required">*</span> are required.'); ?></p>

<?php echo $form->errorSummary(array($model)); ?>

<div class="form-group">
    <?php echo $form->labelEx($model, 'username', array('class' => 'col-sm-2 control-label')); ?>
    <div class="col-sm-6">
        <?php echo $form->textField($model, 'username', array('size' => 20, 'maxlength' => 20, 'class' => 'form-control')); ?>
        <?php echo $form->error($model, 'username', array('class' => 'help-block')); ?>
    </div>
</div>

<div class="form-group">
    <?php echo $form->labelEx($model, 'password', array('class' => 'col-sm-2 control-label')); ?>
    <div class="col-sm-6">
        <?php echo $form->passwordField($model, 'password', array('size' => 60, 'maxlength' => 128, 'class' => 'form-control')); ?>
        <?php echo $form->error($model, 'password', array('class' => 'help-block')); ?>
    </div>
</div>

<div class="form-group">
    <?php echo $form->labelEx($model, 'email', array('class' => 'col-sm-2 control-label')); ?>
    <div class="col-sm-6">
        <?php echo $form->textField($model, 'email', array('size' => 60, 'maxlength' => 128, 'class' => 'form-control')); ?>
        <?php echo $form->error($model, 'email', array('class' => 'help-block')); ?>
    </div>
</div>

<div class="form-group">
    <?php echo $form->labelEx($model, 'superuser', array('class' => 'col-sm-2 control-label')); ?>
    <div class="col-sm-2">
        <?php echo $form->dropDownList($model, 'superuser', User::itemAlias('AdminStatus'), array('class' => 'form-control')); ?>
        <?php echo $form->error($model, 'superuser', array('class' => 'help-block')); ?>
    </div>
</div>

<div class="form-group">
    <?php echo $form->labelEx($model, 'status', array('class' => 'col-sm-2 control-label')); ?>
    <div class="col-sm-2">
        <?php echo $form->dropDownList($model, 'status', User::itemAlias('UserStatus'), array('class' => 'form-control')); ?>
        <?php echo $form->error($model, 'status', array('class' => 'help-block')); ?>
    </div>
</div>

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <?php echo CHtml::submitButton($model->isNewRecord ? Yii::t("user", 'Create') : Yii::t("user", 'Save'), array('class' => 'btn btn-default')); ?>
    </div>
</div>

<?php $this->endWidget(); ?>