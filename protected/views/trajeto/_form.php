<?php
/* @var $this TrajetoController */
/* @var $model Trajeto */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'trajeto-form',
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
        <?php echo $form->labelEx($model,'descricao', array('class'=>'col-sm-2 control-label')); ?>
        <div class="col-sm-10">
            <?php echo $form->textField($model,'descricao',array('class'=>'form-control', 'placeholder' => 'Descricao')); ?>
            <?php echo $form->error($model,'descricao', array('class'=>'help-block')); ?>
        </div>
    </div>
        <div class="form-group">
        <?php echo $form->labelEx($model,'veiculo_id', array('class'=>'col-sm-2 control-label')); ?>
        <div class="col-sm-10">
            <?php echo $form->textField($model,'veiculo_id', array('class'=>'form-control', 'placeholder' => 'Veiculo Id')); ?>
            <?php echo $form->error($model,'veiculo_id', array('class'=>'help-block')); ?>
        </div>
    </div>
        <div class="form-group">
        <?php echo $form->labelEx($model,'hora_inicio', array('class'=>'col-sm-2 control-label')); ?>
        <div class="col-sm-10">
            <?php echo $form->textField($model,'hora_inicio', array('class'=>'form-control', 'placeholder' => 'Hora Inicio')); ?>
            <?php echo $form->error($model,'hora_inicio', array('class'=>'help-block')); ?>
        </div>
    </div>
        <div class="form-group">
        <?php echo $form->labelEx($model,'hora_fim', array('class'=>'col-sm-2 control-label')); ?>
        <div class="col-sm-10">
            <?php echo $form->textField($model,'hora_fim', array('class'=>'form-control', 'placeholder' => 'Hora Fim')); ?>
            <?php echo $form->error($model,'hora_fim', array('class'=>'help-block')); ?>
        </div>
    </div>
        <div class="form-group">
        <?php echo $form->labelEx($model,'bairro_origem_id', array('class'=>'col-sm-2 control-label')); ?>
        <div class="col-sm-10">
            <?php echo $form->textField($model,'bairro_origem_id', array('class'=>'form-control', 'placeholder' => 'Bairro Origem Id')); ?>
            <?php echo $form->error($model,'bairro_origem_id', array('class'=>'help-block')); ?>
        </div>
    </div>
        <div class="form-group">
        <?php echo $form->labelEx($model,'bairro_destino_id', array('class'=>'col-sm-2 control-label')); ?>
        <div class="col-sm-10">
            <?php echo $form->textField($model,'bairro_destino_id', array('class'=>'form-control', 'placeholder' => 'Bairro Destino Id')); ?>
            <?php echo $form->error($model,'bairro_destino_id', array('class'=>'help-block')); ?>
        </div>
    </div>
        <div class="form-group">
        <?php echo $form->labelEx($model,'preco_mensalista', array('class'=>'col-sm-2 control-label')); ?>
        <div class="col-sm-10">
            <?php echo $form->textField($model,'preco_mensalista',array('class'=>'form-control', 'placeholder' => 'Preco Mensalista')); ?>
            <?php echo $form->error($model,'preco_mensalista', array('class'=>'help-block')); ?>
        </div>
    </div>
        <div class="form-group">
        <?php echo $form->labelEx($model,'preco_avulso', array('class'=>'col-sm-2 control-label')); ?>
        <div class="col-sm-10">
            <?php echo $form->textField($model,'preco_avulso',array('class'=>'form-control', 'placeholder' => 'Preco Avulso')); ?>
            <?php echo $form->error($model,'preco_avulso', array('class'=>'help-block')); ?>
        </div>
    </div>
        <div class="form-group">
        <?php echo $form->labelEx($model,'ativo', array('class'=>'col-sm-2 control-label')); ?>
        <div class="col-sm-10">
            <?php echo $form->textField($model,'ativo',array('class'=>'form-control', 'placeholder' => 'Ativo')); ?>
            <?php echo $form->error($model,'ativo', array('class'=>'help-block')); ?>
        </div>
    </div>
        <div class="form-group">
        <?php echo $form->labelEx($model,'created', array('class'=>'col-sm-2 control-label')); ?>
        <div class="col-sm-10">
            <?php echo $form->textField($model,'created', array('class'=>'form-control', 'placeholder' => 'Created')); ?>
            <?php echo $form->error($model,'created', array('class'=>'help-block')); ?>
        </div>
    </div>
    <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Criar' : 'Atualizar', array('class'=>'btn btn-default')); ?>
    </div>
</div>
<?php $this->endWidget(); ?>
