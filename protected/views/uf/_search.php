<?php
/* @var $this UfController */
/* @var $model Uf */
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
    <?php echo $form->label($model, 'sigla', array('class' => 'sr-only')); ?>
    <?php echo $form->textField($model, 'sigla', array('class' => 'form-control', 'placeholder' => 'sigla')); ?>
</div>

<div class="form-group">
    <?php echo $form->label($model, 'nome', array('class' => 'sr-only')); ?>
    <?php echo $form->textField($model, 'nome', array('class' => 'form-control', 'placeholder' => 'nome')); ?>
</div>

<?php echo CHtml::submitButton('Buscar', array('class' => 'btn btn-default')); ?>
<?php $this->endWidget(); ?>
