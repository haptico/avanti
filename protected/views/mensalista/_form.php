<?php
/* @var $this MensalistaController */
/* @var $model Mensalista */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'mensalista-form',
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
        <?php echo $form->labelEx($model,'user_id', array('class'=>'col-sm-2 control-label')); ?>
        <div class="col-sm-10">
            <?php echo $form->textField($model,'user_id', array('class'=>'form-control', 'placeholder' => 'User Id')); ?>
            <?php echo $form->error($model,'user_id', array('class'=>'help-block')); ?>
        </div>
    </div>
        <div class="form-group">
        <?php echo $form->labelEx($model,'trajeto_id', array('class'=>'col-sm-2 control-label')); ?>
        <div class="col-sm-10">
            <?php echo $form->textField($model,'trajeto_id', array('class'=>'form-control', 'placeholder' => 'Trajeto Id')); ?>
            <?php echo $form->error($model,'trajeto_id', array('class'=>'help-block')); ?>
        </div>
    </div>
        <div class="form-group">
        <?php echo $form->labelEx($model,'ponto_id', array('class'=>'col-sm-2 control-label')); ?>
        <div class="col-sm-10">
            <?php echo $form->textField($model,'ponto_id', array('class'=>'form-control', 'placeholder' => 'Ponto Id')); ?>
            <?php echo $form->error($model,'ponto_id', array('class'=>'help-block')); ?>
        </div>
    </div>
        <div class="form-group">
        <?php echo $form->labelEx($model,'data_inicio', array('class'=>'col-sm-2 control-label')); ?>
        <div class="col-sm-10">
            <?php echo $form->textField($model,'data_inicio', array('class'=>'form-control', 'placeholder' => 'Data Inicio')); ?>
            <?php echo $form->error($model,'data_inicio', array('class'=>'help-block')); ?>
        </div>
    </div>
        <div class="form-group">
        <?php echo $form->labelEx($model,'data_fim', array('class'=>'col-sm-2 control-label')); ?>
        <div class="col-sm-10">
            <?php echo $form->textField($model,'data_fim', array('class'=>'form-control', 'placeholder' => 'Data Fim')); ?>
            <?php echo $form->error($model,'data_fim', array('class'=>'help-block')); ?>
        </div>
    </div>
    <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Criar' : 'Atualizar', array('class'=>'btn btn-default')); ?>
    </div>
</div>
<?php $this->endWidget(); ?>
