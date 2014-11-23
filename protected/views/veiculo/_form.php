<?php
/* @var $this VeiculoController */
/* @var $model Veiculo */
/* @var $form CActiveForm */
?>
<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'veiculo-form',
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

<p class="note">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

<div class="form-group">
    <?php echo $form->labelEx($model, 'descricao', array('class' => 'col-sm-2 control-label')); ?>
    <div class="col-sm-6">
        <?php echo $form->textField($model, 'descricao', array('size' => 60, 'maxlength' => 4000, 'class' => 'form-control', 'placeholder' => 'Descrição')); ?>
        <?php echo $form->error($model, 'descricao', array('class' => 'help-block')); ?>
    </div>
</div>

<div class="form-group">
    <?php echo $form->labelEx($model, 'placa', array('class' => 'col-sm-2 control-label')); ?>
    <div class="col-sm-6">
        <?php echo $form->textField($model, 'placa', array('size' => 8, 'maxlength' => 8, 'class' => 'form-control', 'placeholder' => 'Placa')); ?>
        <?php echo $form->error($model, 'placa', array('class' => 'help-block')); ?>
    </div>
</div>

<div class="form-group">
    <?php echo $form->labelEx($model, 'vagas', array('class' => 'col-sm-2 control-label')); ?>
    <div class="col-sm-2">
        <?php echo $form->numberField($model, 'vagas', array('class' => 'form-control', 'placeholder' => 'Vaga')); ?>
        <?php echo $form->error($model, 'vagas', array('class' => 'help-block')); ?>
    </div>
</div>

<div class="form-group">
    <?php echo $form->labelEx($model, 'tipo_veiculo_id', array('class' => 'col-sm-2 control-label')); ?>
    <div class="col-sm-4">
        <?php echo CHtml::dropDownList("tipo_veiculo_id", 'tipo_veiculo_id', CHtml::listData(TipoVeiculo::model()->findAll(), 'id', 'nome'), array("id" => "tipo_veiculo_id", "class" => "form-control input-sm")); ?>
        <?php echo $form->error($model, 'tipo_veiculo_id', array('class' => 'help-block')); ?>
    </div>
</div>

<div class="form-group">
    <?php echo $form->labelEx($model, 'user_id', array('class' => 'col-sm-2 control-label')); ?>
    <div class="col-sm-4">
        <?php echo CHtml::dropDownList("user_id", 'user_id', CHtml::listData(User::model()->findAll(), 'id', 'username'), array("id" => "user_id", "class" => "form-control input-sm")); ?>
        <?php echo $form->error($model, 'user_id', array('class' => 'help-block')); ?>
    </div>
</div>

<div class="form-group">
    <?php echo $form->labelEx($model, 'ativo', array('class' => 'col-sm-2 control-label')); ?>
    <div class="col-sm-2">
        <?php echo CHtml::dropDownList("user_id", 'user_id', array("S" => "Ativo", "N" => "Inativo"), array("id" => "user_id", "class" => "form-control input-sm")); ?>
        <?php echo $form->error($model, 'ativo', array('class' => 'help-block')); ?>
    </div>
</div>

<div class="form-group">
    <?php echo $form->labelEx($model, 'created', array('class' => 'col-sm-2 control-label')); ?>
    <div class="col-sm-3">
        <!--<div class="input-group-addon">@</div>-->
        <?php echo $form->textField($model, 'created', array('class' => 'form-control date', 'placeholder' => 'Criado em')); ?>
        <?php echo $form->error($model, 'created', array('class' => 'help-block')); ?>
    </div>
</div>

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' => 'btn btn-default')); ?>
    </div>
</div>

<?php $this->endWidget(); ?>
<!-- form -->