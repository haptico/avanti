<?php
/* @var $this BairroController */
/* @var $model Bairro */
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
        <?php echo $form->label($model,'nome', array('class' => 'sr-only')); ?>
        <?php echo $form->textField($model,'nome',array('class'=>'form-control', 'placeholder' => 'Nome')); ?>
    </div>

    <?php echo CHtml::submitButton('Buscar', array('class'=>'btn btn-default')); ?>
<?php $this->endWidget(); ?>
