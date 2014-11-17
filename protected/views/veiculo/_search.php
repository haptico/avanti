<?php
/* @var $this VeiculoController */
/* @var $model Veiculo */
/* @var $form CActiveForm */
?>
<?php
$form = $this->beginWidget('CActiveForm', array(
    'action' => Yii::app()->createUrl($this->route),
    'method' => 'get',
    'htmlOptions' => array(
        'class' => 'form-inline'
    )
        ));
?>

<div class="form-group">
    <?php echo $form->label($model, 'descricao', array('class' => 'sr-only')); ?>
    <?php echo $form->textField($model, 'descricao', array('size' => 60, 'maxlength' => 4000, 'class' => 'form-control', 'placeholder' => 'Descrição')); ?>
</div>

<div class="form-group">
    <?php echo $form->label($model, 'placa', array('class' => 'sr-only')); ?>
    <?php echo $form->textField($model, 'placa', array('size' => 8, 'maxlength' => 8,'class' => 'form-control', 'placeholder' => 'Placa')); ?>
</div>

<div class="form-group">
    <?php echo $form->label($model, 'vagas', array('class' => 'sr-only')); ?>
    <?php echo $form->textField($model, 'vagas', array('class' => 'form-control', 'placeholder' => 'Vagas')); ?>
</div>

<div class="form-group">
    <?php echo $form->label($model, 'tipo_veiculo_id', array('class' => 'sr-only')); ?>
    <?php echo $form->textField($model, 'tipo_veiculo_id', array('class' => 'form-control', 'placeholder' => 'Veiculo')); ?>
</div>

<div class="form-group">
    <?php echo $form->label($model, 'user_id', array('class' => 'sr-only')); ?>
    <?php echo $form->textField($model, 'user_id', array('class' => 'form-control', 'placeholder' => 'Motorista')); ?>
</div>

<div class="form-group">
    <?php echo $form->label($model, 'ativo', array('class' => 'sr-only')); ?>
    <?php echo $form->textField($model, 'ativo', array('size' => 1, 'maxlength' => 1, 'class' => 'form-control', 'placeholder' => 'Ativo')); ?>
</div>

<div class="form-group">
    <?php echo $form->label($model, 'created', array('class' => 'sr-only')); ?>
    <?php echo $form->textField($model, 'created', array('class' => 'form-control', 'placeholder' => 'Criado em')); ?>
</div>

<div class="form-group buttons">
    <?php echo CHtml::submitButton('Buscar', array('class' => 'btn btn-default')); ?>
</div>

<?php $this->endWidget(); ?>