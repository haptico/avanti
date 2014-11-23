<?php
/* @var $this PontoController */
/* @var $model Ponto */
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

        <div class="form-group">
        <?php echo $form->label($model,'descricao', array('class' => 'sr-only')); ?>
        <?php echo $form->textField($model,'descricao',array('class'=>'form-control', 'placeholder' => 'Descricao')); ?>
    </div>

            <div class="form-group">
        <?php echo $form->label($model,'ativo', array('class' => 'sr-only')); ?>
        <?php echo $form->textField($model,'ativo',array('class'=>'form-control', 'placeholder' => 'Ativo')); ?>
    </div>

        <div class="form-group">
        <?php echo $form->label($model,'created', array('class' => 'sr-only')); ?>
        <?php echo $form->textField($model,'created', array('class'=>'form-control', 'placeholder' => 'Created')); ?>
    </div>

    <?php echo CHtml::submitButton('Buscar', array('class'=>'btn btn-default')); ?>
<?php $this->endWidget(); ?>
