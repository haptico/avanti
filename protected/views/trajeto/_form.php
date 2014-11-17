<?php
/* @var $this TrajetoController */
/* @var $model Trajeto */
/* @var $form CActiveForm */
?>
<div class="col-md-10">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'trajeto-form',
        'htmlOptions' => array(
            'class' => 'form-horizontal'
        ),
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
    ));
    ?>

    <div class="row">
        <div class="col-md-12"><p class="note">Fields with <span class="required">*</span> are required.</p></div>
    </div>

    <div class="row">
        <div class="col-md-12"><?php echo $form->errorSummary($model, NULL, NULL, array()); ?>
        </div>
    </div>
    <div class="form-group">
        <?php echo $form->labelEx($model, 'descricao', array('class' => 'col-sm-2 control-label')); ?>
        <div class="col-sm-10">
            <?php echo $form->textField($model, 'descricao', array('class' => 'form-control', 'placeholder' => 'Descrição')); ?>
            <?php echo $form->error($model, 'descricao', array('class' => 'help-block')); ?>
        </div>
    </div>
    <div class="form-group">
        <?php echo $form->labelEx($model, 'veiculo_id', array('class' => 'col-sm-2 control-label')); ?>
        <div class="col-sm-10">
            <?php echo $form->textField($model, 'veiculo_id', array('class' => 'form-control', 'placeholder' => 'veiculo_id')); ?>
            <?php echo $form->error($model, 'veiculo_id', array('class' => 'help-block')); ?>
        </div>
    </div>
    <div class="form-group">
        <?php echo $form->labelEx($model, 'hora_inicio', array('class' => 'col-sm-2 control-label')); ?>
        <div class="col-sm-10">
            <?php echo $form->textField($model, 'hora_inicio', array('class' => 'form-control', 'placeholder' => 'hora_inicio')); ?>
            <?php echo $form->error($model, 'hora_inicio', array('class' => 'help-block')); ?>
        </div>
    </div>
    <div class="form-group">
        <?php echo $form->labelEx($model, 'hora_fim', array('class' => 'col-sm-2 control-label')); ?>
        <div class="col-sm-10">
            <?php echo $form->textField($model, 'hora_fim', array('class' => 'form-control', 'placeholder' => 'hora_fim')); ?>
            <?php echo $form->error($model, 'hora_fim', array('class' => 'help-block')); ?>
        </div>
    </div>
    <div class="form-group">
        <?php echo $form->labelEx($model, 'bairro_origem_id', array('class' => 'col-sm-2 control-label')); ?>
        <div class="col-sm-10">
            <?php echo $form->textField($model, 'bairro_origem_id', array('class' => 'form-control', 'placeholder' => 'bairro_origem_id')); ?>
            <?php echo $form->error($model, 'bairro_origem_id', array('class' => 'help-block')); ?>
        </div>
    </div>
    <div class="form-group">
        <?php echo $form->labelEx($model, 'bairro_destino_id', array('class' => 'col-sm-2 control-label')); ?>
        <div class="col-sm-10">
            <?php echo $form->textField($model, 'bairro_destino_id', array('class' => 'form-control', 'placeholder' => 'bairro_destino_id')); ?>
            <?php echo $form->error($model, 'bairro_destino_id', array('class' => 'help-block')); ?>
        </div>
    </div>
    <div class="form-group">
        <?php echo $form->labelEx($model, 'preco_mensalista', array('class' => 'col-sm-2 control-label')); ?>
        <div class="col-sm-10">
            <?php echo $form->textField($model, 'preco_mensalista', array('class' => 'form-control', 'placeholder' => 'preco_mensalista')); ?>
            <?php echo $form->error($model, 'preco_mensalista', array('class' => 'help-block')); ?>
        </div>
    </div>
    <div class="form-group">
        <?php echo $form->labelEx($model, 'preco_avulso', array('class' => 'col-sm-2 control-label')); ?>
        <div class="col-sm-10">
            <?php echo $form->textField($model, 'preco_avulso', array('class' => 'form-control', 'placeholder' => 'preco_avulso')); ?>
            <?php echo $form->error($model, 'preco_avulso', array('class' => 'help-block')); ?>
        </div>
    </div>
    <div class="form-group">
        <?php echo $form->labelEx($model, 'ativo', array('class' => 'col-sm-2 control-label')); ?>
        <div class="col-sm-10">
            <?php echo $form->textField($model, 'ativo', array('class' => 'form-control', 'placeholder' => 'ativo')); ?>
            <?php echo $form->error($model, 'ativo', array('class' => 'help-block')); ?>
        </div>
    </div>
    <div class="form-group">
        <?php echo $form->labelEx($model, 'created', array('class' => 'col-sm-2 control-label')); ?>
        <div class="col-sm-10">
            <?php echo $form->textField($model, 'created', array('class' => 'form-control', 'placeholder' => 'created')); ?>
            <?php echo $form->error($model, 'created', array('class' => 'help-block')); ?>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <?php echo CHtml::submitButton($model->isNewRecord ? 'Criar' : 'Atualizar', array('class' => 'btn btn-default')); ?>
        </div>
    </div>
    <?php $this->endWidget(); ?>
</div>