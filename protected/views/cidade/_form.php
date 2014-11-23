<?php
/* @var $this CidadeController */
/* @var $model Cidade */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'cidade-form',
        'htmlOptions' => array(
            'class' => 'form-horizontal'
        ),
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>


<p class="note">Fields with <span class="required">*</span> are required.</p>
<?php echo $form->errorSummary($model, NULL, NULL, array()); ?>
    <div class="form-group">
        <?php echo $form->labelEx($model,'nome', array('class'=>'col-sm-2 control-label')); ?>
        <div class="col-sm-10">
            <?php echo $form->textField($model,'nome',array('class'=>'form-control', 'placeholder' => 'Nome')); ?>
            <?php echo $form->error($model,'nome', array('class'=>'help-block')); ?>
        </div>
    </div>
        <div class="form-group">
        <?php echo $form->labelEx($model,'uf_id', array('class'=>'col-sm-2 control-label')); ?>
        <div class="col-sm-10">
            <?php echo $form->textField($model,'uf_id', array('class'=>'form-control', 'placeholder' => 'Uf Id')); ?>
            <?php echo $form->error($model,'uf_id', array('class'=>'help-block')); ?>
        </div>
    </div>
    <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Criar' : 'Atualizar', array('class'=>'btn btn-default')); ?>
    </div>
</div>
<?php $this->endWidget(); ?>
