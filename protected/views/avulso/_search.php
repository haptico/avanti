<?php
/* @var $this AvulsoController */
/* @var $model Avulso */
/* @var $form CActiveForm */
?>
<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
        'htmlOptions' => array(
            'class' => 'form-inline'
        )
)); ?>

                        <div class="form-group">
        <?php echo $form->label($model,'data', array('class' => 'sr-only')); ?>
        <?php echo $form->textField($model,'data', array('class'=>'form-control', 'placeholder' => 'Data')); ?>
    </div>

        <div class="form-group">
        <?php echo $form->label($model,'valor', array('class' => 'sr-only')); ?>
        <?php echo $form->textField($model,'valor', array('class'=>'form-control', 'placeholder' => 'Valor')); ?>
    </div>

<?php echo CHtml::submitButton('Buscar', array('class'=>'btn btn-default')); ?>
<?php $this->endWidget(); ?>
