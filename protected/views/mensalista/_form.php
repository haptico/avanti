<?php
/* @var $this MensalistaController */
/* @var $model Mensalista */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'mensalista-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id'); ?>
		<?php echo $form->error($model,'user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'trajeto_id'); ?>
		<?php echo $form->textField($model,'trajeto_id'); ?>
		<?php echo $form->error($model,'trajeto_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ponto_id'); ?>
		<?php echo $form->textField($model,'ponto_id'); ?>
		<?php echo $form->error($model,'ponto_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'data_inicio'); ?>
		<?php echo $form->textField($model,'data_inicio'); ?>
		<?php echo $form->error($model,'data_inicio'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'data_fim'); ?>
		<?php echo $form->textField($model,'data_fim'); ?>
		<?php echo $form->error($model,'data_fim'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->