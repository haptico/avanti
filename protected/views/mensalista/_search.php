<?php
/* @var $this MensalistaController */
/* @var $model Mensalista */
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
    <?php echo $form->label($model, 'data_inicio', array('class' => 'sr-only')); ?>
    <?php echo $form->textField($model, 'data_inicio', array('class' => 'form-control', 'placeholder' => 'Data Inicio')); ?>
</div>

<div class="form-group">
    <?php echo $form->label($model, 'data_fim', array('class' => 'sr-only')); ?>
    <?php echo $form->textField($model, 'data_fim', array('class' => 'form-control', 'placeholder' => 'Data Fim')); ?>
</div>

<?php echo CHtml::submitButton('Buscar', array('class' => 'btn btn-default')); ?>
<?php $this->endWidget(); ?>
